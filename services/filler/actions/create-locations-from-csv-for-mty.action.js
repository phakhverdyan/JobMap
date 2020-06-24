var async 	= require('async');
var fs 		= require('fs');
var mysql 	= require('mysql');
var needle 	= require('needle');

// ---------------------------------------------------------------------- //

module.exports = function(api, settings, callback) {
	console.log('Started.');

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

			console.log(JSON.stringify(body, null, '\t'));
			var result = {};
			result.latitude = body.results[0].geometry.location.lat;
			result.longitude = body.results[0].geometry.location.lng;

			body.results[0].address_components.forEach(function(address_component) {
				if (address_component.types.indexOf('street_number') > -1) {
					result.street_number = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('route') > -1) {
					result.route = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('locality') > -1) {
					result.locality = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('administrative_area_level_1') > -1) {
					result.region = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('country') > -1) {
					result.country = address_component.long_name;
					result.country_code = address_component.short_name;
					return;
				}

				if (address_component.types.indexOf('postal_code') > -1) {
					result.postal_code = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('premise') > -1) {
					result.premise = address_component.long_name;
					return;
				}

				if (address_component.types.indexOf('sublocality') > -1) {
					result.sublocality = address_component.long_name;
					return;
				}
			});

			return callback(null, result);
		});
	};

	var DB = null;
	var tasks = [];

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
		var tasks = [];

		tasks.push(function(callback) {
			return fs.readFile('./files/05_12_18_locations_mty_list.csv', callback);
		});

		tasks.push(function(buffer, callback) {
			var lines = buffer.toString().split(/[\r\n]+/);

			lines = lines.filter(function(line) {
				return line[0] != ';';
			});

			var locations = lines.map(function(line) {
				var parts = line.split(/;/);

				var brand_name_replacements = {
					'Ben & Florentine': 'Ben et Florentine',
					'Big Smoke Burger': 'Big Smoke',
					'Built': 'Built Custom Burgers',
					'Cultures Express': 'Cultures',
					'Koryo Korean BBQ': 'Koryo',
					'Ranch1': 'Ranch one',
					'Sushi Shop Express': 'Sushi Shop',
					'Taco Time Canada': 'Taco Time',
					'Taco Time US': 'Taco Time',
					'Thai Express US': 'Thai Express',
					'The Works': 'The Works Burger',
					'Timothy\'s World Coffee': 'Timothy\'s',
					'Van Houtte': 'Café Van Houtte',
					'Au Vieux Duluth Express': 'Au Vieux Duluth',
				};

				parts[1] = parts[1].split(/\s*-\s*/)[0];
				parts[1] = brand_name_replacements[parts[1]] ? brand_name_replacements[parts[1]] : parts[1];

				return {
					name: parts[0].split(/\s*-\s*/).slice(2).join(' - '),
					brand_name: parts[1],
					address: parts[2],
					city: parts[3],
				};
			});

			return callback(null, locations);
		});

		return async.waterfall(tasks, callback);
	});

	tasks.push(function(locations, callback) {
		return api.login({
			email: 'cynthia@mtygroup.com',
			password: '5678dino5678',
		}, function(error, data) {
			if (error) {
				return callback(error);
			}

			console.log('logged in!');
			return callback(null, locations);
		});
	});

	tasks.push(function(locations, callback) {
		var tasks = [];

		locations.forEach(function(location) {
			tasks.push(function(callback) {
				var tasks = [];

				tasks.push(function(callback) { // find brand by name
					console.log('Trying to find brand with name {' + location.brand_name + '}...');
					var sql = 'SELECT * FROM businesses WHERE name = ? AND parent_id = 233 LIMIT 1';

					return DB.query(sql, [ location.brand_name ], function(error, brands) {
						if (error) {
							return callback(error);
						}

						return callback(null, brands[0] || null);
					});
				});

				tasks.push(function(brand, callback) {
					if (!brand) {
						console.log('Have not found brand by this name :(');
						return callback(null);
					}

					console.log('FOUND BRAND!!! YEAH! Let\'s talk with Google Geocoder and get good location!');

					var tasks = [];

					tasks.push(function(callback) {
						return geocode(location.address + ' ' + location.city + ' Canada', callback);
					});

					tasks.push(function(geocode_response, callback) {
						console.log('Trying to find this lociation in our DB using coordinates..');
						var sql = 'SELECT * FROM business_locations WHERE business_id = ?';
						sql += ' AND ABS(latitude - ?) < 0.001';
						sql += ' AND ABS(longitude - ?) < 0.001';
						sql += ' LIMIT 1';

						console.log(sql, [
							brand.id,
							geocode_response.latitude,
							geocode_response.longitude,
						]);

						return DB.query(sql, [
							brand.id,
							geocode_response.latitude,
							geocode_response.longitude,
						], function(error, locations) {
							if (error) {
								return callback(error);
							}

							return callback(null, geocode_response, locations[0] || null);
						});
					});

					tasks.push(function(geocode_response, existent_location, callback) {
						if (existent_location) {
							console.log('The location already exists. No need to add it twice, right?');
							return callback(null);
						}

						console.log('The location does not exist in that brand. Ready to create it!???');
						var tasks = [];

						tasks.push(function(callback) {
							return api.createLocation({
								business_id: brand.parent_id,
								brand_id: brand.id,
								name: "",
								name_fr: location.name,
								main: 0,
								street: geocode_response.route || geocode_response.premise || 'Unknown',
								street_number: geocode_response.street_number || '0',
								latitude: geocode_response.latitude,
								longitude: geocode_response.longitude,
								suite: "",
								type: "location",
								city: geocode_response.locality || geocode_response.sublocality || 'Unknown',
								region: geocode_response.region || 'Unknown',
								country: "Canada",
								country_code: "CA",
								phone: brand.phone,
								phone_code: brand.phone_code,
								phone_country_code: brand.phone_country_code,
								amenities: "",
								logo: null,
								department_locations: "",
								manager_locations: "",
								job_locations: "",
							}, callback);
						});

						tasks.push(function(response, callback) {
							if (response.data) {
								console.log('The location was created!!! ID: ' + response.data.id);
								return callback(null);
							}
							
							console.log(response.errors);
							process.exit();
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

	tasks.push(function(callback) {
		DB.end();
		console.log('Disconnected from MySQL DB.');
		return callback(null);
	});

	return async.waterfall(tasks, callback);
};
