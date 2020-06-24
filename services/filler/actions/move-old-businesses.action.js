var async 	= require('async');
var mysql 	= require('mysql');
var crypto 	= require('crypto');
var needle 	= require('needle');

// ---------------------------------------------------------------------- //

var get_user_password_from_email = function(user) {
	return Buffer.from(crypto.createHash('sha256').update(user.email).digest('hex')).toString('base64').slice(0, 8);
};

var get_user_username_from_email = function(user) {
	var postfix = String(new Date(user.created_at).getTime()).slice(-6, -3);
	return user.email.split(/\./).slice(0, -1).join('').replace(/[@_-]/g, '') + postfix;
};

var fix_user_first_name = function(user) {
	return user.first_name.match(/^[a-zA-Z]+$/) ? user.first_name : 'Unknown';
};

var fix_user_last_name = function(user) {
	return user.last_name.match(/^[a-zA-Z]+$/) ? user.last_name : 'Unknown';
};

// ---------------------------------------------------------------------- //

module.exports = function(api, settings, callback) {
	var country_codes = {};

	// ------------------------------------------------------------------ //
	
	var geocode = function(address, callback) {
		return needle.request('GET', 'https://maps.googleapis.com/maps/api/geocode/json', {
			address: 	address,
			key: 		settings.google_maps.key,
			language: 	'en',
		}, function(error, response, body) {
			if (error) {
				return callback(error);
			}

			if (response.statusCode !== 200) {
				return callback(new Error('Wrong status code: ' + response.statusCode));
			}

			if (body.results.length == 0) {
				return callback(null, null);
			}

			var result = {
				street_number: 	'',
				street: 		'',
				city: 			'',
				region: 		'',
				country: 		'',
				country_code: 	'',
				zip_code: 		'',
				latitude: 		-1.0,
				longitude: 		-1.0,
			};

			body.results[0].address_components.forEach(function(address_component) {
				if (address_component.types.indexOf('street_number') > -1) {
					result.street_number = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('route') > -1) {
					result.street = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('locality') > -1) {
					result.city = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('administrative_area_level_1') > -1) {
					result.region = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('postal_code') > -1) {
					result.zip_code = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('country') > -1) {
					result.country = address_component.long_name;

					Object.keys(country_codes).some(function(country_code) {
						if (country_codes[country_code] == result.country) {
							result.country_code = country_code;
							return true;
						}

						return false;
					});

					return;
				}
			});

			result.latitude = body.results[0].geometry.location.lat;
			result.longitude = body.results[0].geometry.location.lng;
			return callback(null, result);
		});
	};

	var get_country_codes = function(callback) {
		return needle.request('GET', 'http://country.io/names.json', {}, function(error, response, body) {
			if (error) {
				return callback(error);
			}

			if (response.statusCode !== 200) {
				return callback(new Error('Wrong status code: ' + response.statusCode));
			}

			return callback(null, body);
		});
	};

	// ------------------------------------------------------------------ //

	var DB = null;
	var tasks = [];

	tasks.push(function(callback) {
		return get_country_codes(function(error, current_country_codes) {
			if (error) {
				return callback(error);
			}

			country_codes = current_country_codes;
			return callback(null);
		});
	});

	tasks.push(function(callback) {
		DB = mysql.createConnection(settings.database);

		return DB.connect(function(error) {
			if (error) {
				return callback(error);
			}

			console.log('Connected to MySQL DB.');
			return callback(null);
		});
	});

	tasks.push(function(callback) {
		var sql = 'SELECT * FROM users';
		sql += ' WHERE (SELECT COUNT(businesses.id) as count FROM businesses WHERE businesses.user_id = users.id) > 0';

		return DB.query(sql, function(error, users) {
			return callback(error, users);
		});
	});

	tasks.push(function(users, callback) {
		var tasks = [];

		users.forEach(function(user, user_index) {
			tasks.push(function(callback) {
				if (settings.ignore_users_with_such_emails.indexOf(user.email) > -1) {
					return callback(null);
				}

				var tasks = [];

				tasks.push(function(callback) {
					return api.createCheck({
						username: 			get_user_username_from_email(user),
						first_name: 		fix_user_first_name(user),
						last_name: 			fix_user_last_name(user),
						email: 				user.email,
						password: 			get_user_password_from_email(user),
						confirm_password: 	get_user_password_from_email(user),
					}, callback);
				});

				tasks.push(function(response, callback) {
					if (response.errors) {
						if (response.errors[0].message == 'validation') {
							if (response.errors[0].validation.email == 'The email has already been taken.') {
								return callback(null, true);
							}
						}

						console.log(JSON.stringify(response.errors, null, '\t'));
						return callback(new Error('Bad response'));
					}

					return callback(null, false);
				});

				tasks.push(function(user_exists, callback) {
					if (user_exists) {
						return api.login({
							email: 		user.email,
							password: 	get_user_password_from_email(user),
						}, callback);
					}

					return api.createUser({
						username: 				get_user_username_from_email(user),
						first_name: 			fix_user_first_name(user),
						last_name: 				fix_user_last_name(user),
						email: 					user.email,
						password: 				get_user_password_from_email(user),
						confirm_password: 		get_user_password_from_email(user),
						social: 				'',
						social_id: 				'',
						social_token: 			'',
						gender: 				'',
						user_pic: 				'',
						user_pic_original: 		'',
						type: 					'student',
						inviting_business_id: 	'0',
						language: 				1,
					}, callback);
				});

				tasks.push(function(response, callback) {
					if (response.errors) {
						return callback(null, []);
					}

					// console.log('Logged in account { id: ' + user.id + ', email: "' + user.email + '" }');

					return DB.query('SELECT * FROM businesses WHERE user_id = ?', [ user.id ], function(error, businesses) {
						return callback(error, businesses);
					});
				});

				tasks.push(function(businesses, callback) {
					var tasks = [];

					businesses.forEach(function(business, business_index) {
						tasks.push(function(callback) {
							// console.log('Processing users: ' + (user_index + 1) + '/' + users.length);
							// console.log('Processing business: ' + (business_index + 1) + '/' + businesses.length);
							var tasks = [];

							tasks.push(function(callback) {
								var sql = 'SELECT * FROM branches WHERE business_id = ? ORDER BY id ASC LIMIT 1';

								return DB.query(sql, [ business.id ], function(error, branches) {
									if (error) {
										return callback(error);
									}

									return callback(null, branches.length > 0 ? branches[0] : null);
								});
							});

							tasks.push(function(first_branch, callback) {
								if (!first_branch) {
									console.log('Business {ID: ' + business.id + '} has no branches!');

									return setTimeout(function() {
										return callback(null);
									}, 5000);
								}

								var tasks = [];

								tasks.push(function(callback) {
									var address = [
										first_branch.street,
										first_branch.city,
										first_branch.state,
										first_branch.country,
									];

									return geocode(address.join(', '), callback);
								});

								tasks.push(function(address, callback) {
									if (!address.street || !address.city || !address.region || !address.country) {
										console.log('Can\'t create this business because geocode can\'t process its address');
										console.log('BUSINESS ID: ' + business.id, JSON.stringify(address, null, '\t'));

										return setTimeout(function() {
											return callback(null, null);
										}, 5000);
									}

									return api.createBusiness({
										name: 					business.name,
										description: 			business.description || business.name,
										industry_id: 			16,
										sub_industry_id: 		0,
										size_id: 				1,
										type: 					'private',
										street: 				address.street,
										street_number: 			address.street_number || '1',
										suite: 					'',
										keywords: 				'',
										latitude: 				address.latitude,
										longitude: 				address.longitude,
										website: 				business.website || first_branch.website || '',
										city: 					address.city,
										region: 				address.region,
										country: 				address.country,
										country_code: 			address.country_code || 'CA',
										phone: 					'0000000000',
										phone_code: 			'+1 ',
										phone_country_code: 	address.country_code || 'CA',
										zip_code: 				address.zip_code || '00000',
										language: 				'1',
										images: 				[],
										crop_data_images: 		[],
										facebook: 				'',
										facebook_fr: 			'',
										instagram: 				'',
										instagram_fr: 			'',
										linkedin: 				'',
										linkedin_fr: 			'',
										twitter: 				'',
										twitter_fr: 			'',
										amenities: 				'',
									}, callback);
								});

								tasks.push(function(business_response, callback) {
									if (!business_response) {
										return callback(null);
									}

									// console.log('business_response', JSON.stringify(business_response, null, '\t'));
									var locations_response = null;
									var tasks = [];

									tasks.push(function(callback) {
										return api.businessLocations({
											business_id: 	business_response.data.id,
											limit: 			999999999,
										}, callback);
									});

									tasks.push(function(current_locations_response, callback) {
										locations_response = current_locations_response;
										return callback(null);
									});

									tasks.push(function(callback) {
										return DB.query('SELECT * FROM branches WHERE business_id = ? AND id != ?', [
											business.id,
											first_branch.id,
										], function(error, branches) {
											return callback(error, branches);
										});
									});

									tasks.push(function(branches, callback) {
										var tasks = [];

										branches.forEach(function(branch, branch_index) {
											tasks.push(function(callback) {
												// console.log('Processing users: ' + (user_index + 1) + '/' + users.length);
												// console.log('Processing business: ' + (business_index + 1) + '/' + businesses.length);
												// console.log('Processing location: ' + (branch_index + 1) + '/' + branches.length);
												// console.log(JSON.stringify(locations_response.data, null, '\t'));

												var branch_already_exists = locations_response.data.items.some(function(location) {
													return location.name.trim() == branch.name.trim();
												});

												if (branch_already_exists) {
													// console.log('This branch {ID: ' + branch.id + '} already exists.');

													// return setTimeout(function() {
														return callback(null, null);
													// }, 1000);
												}

												var tasks = [];

												tasks.push(function(callback) {
													var address = [
														branch.street,
														branch.city,
														branch.state,
														branch.country,
													];

													return geocode(address.join(', '), callback);
												});

												tasks.push(function(address, callback) {
													if (!address.street || !address.city || !address.region || !address.country) {
														console.log('Can\'t create this branch because geocode can\'t process its address');
														console.log('BRANCH ID: ' + branch.id, JSON.stringify(address, null, '\t'));

														return setTimeout(function() {
															return callback(null, null);
														}, 5000);
													}

													return api.createLocation({
														business_id: 			business_response.data.id,
														name: 					branch.name,
														name_fr: 				'',
														main: 					0,
														street: 				address.street,
														street_number: 			address.street_number || '1',
														latitude: 				address.latitude,
														longitude: 				address.longitude,
														suite: 					'',
														type: 					'location',
														city: 					address.city,
														region: 				address.region,
														country: 				address.country,
														country_code: 			address.country_code,
														phone: 					'0000000000',
														phone_code: 			'+1 ',
														phone_country_code: 	address.country_code,
														amenities: 				'',
														department_locations: 	'',
														manager_locations: 		'',
														job_locations: 			'',
													}, callback);
												});

												tasks.push(function(location_response, callback) {
													if (!location_response) {
														return callback(null);
													}

													console.log('Location created {ID: ' + location_response.data.id + '}');
													// console.log('location_response', JSON.stringify(location_response, null, '\t'));
													return callback(null);
												});

												return async.waterfall(tasks, callback);
											});
										});

										return async.series(tasks, function(error) {
											return callback(error);
										});
									});

									return async.waterfall(tasks, callback);
								});

								return async.waterfall(tasks, callback);
							});

							return async.waterfall(tasks, callback);
						});
					});
					
					return async.series(tasks, function(error) {
						return callback(error);
					});
				});

				return async.waterfall(tasks, function(error) {
					if (error) {
						return callback(error);
					}

					console.log('Progress: Users: ' + (user_index + 1) + '/' + users.length);
					console.log('Progress: ' + Math.round((user_index + 1) / users.length * 100) + '%');
					return callback(null);
				});
			});
		});

		return async.series(tasks, function(error) {
			return callback(error);
		});
	});
	
	tasks.push(function(callback) {
		console.log('YEEEAAAH!!! DONE!');
		DB.end();
		console.log('Disconnected from MySQL DB.');
		return callback(null);
	});

	return async.waterfall(tasks, callback);
};