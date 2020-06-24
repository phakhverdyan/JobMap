var needle 	= require('needle');
var mysql 	= require('mysql');
var async 	= require('async');

// ---------------------------------------------------------------------- //

module.exports = function(api, settings, callback) {
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

			var result = {};
			result.latitude = body.results[0].geometry.location.lat;
			result.longitude = body.results[0].geometry.location.lng;
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
			var done = false;
			var last_business_id = 0;

			return async.whilst(function() {
				return !done;
			}, function(callback) {
				var tasks = [];

				tasks.push(function(callback) {
					return DB.query('SELECT * FROM businesses WHERE id > ? ORDER BY id ASC LIMIT 100', [ last_business_id ], function(error, business) {
						return callback(error, business);
					});
				});

				tasks.push(function(businesses, callback) {
					var tasks = [];

					businesses.forEach(function(business) {
						tasks.push(function(callback) {
							var tasks = [];

							tasks.push(function(callback) {
								return geocode([
									business.street + ' ' + business.street_number,
									business.city,
									business.region,
									business.country,
								].join(', '), callback);
							});

							tasks.push(function(location, callback) {
								business.latitude 	= location.latitude;
								business.longitude 	= location.longitude;
								return callback(null);
							});

							tasks.push(function(callback) {
								return DB.query('UPDATE businesses SET latitude = ?, longitude = ? WHERE id = ? LIMIT 1', [
									business.latitude,
									business.longitude,
									business.id,
								], function(error) {
									return callback(error);
								});
							});

							tasks.push(function(callback) {
								console.log('Processed business: ' + business.id);
								return callback(null);
							});

							return async.waterfall(tasks, callback);
						});
					});

					return async.series(tasks, function(error) {
						if (error) {
							return callback(error);
						}

						if (businesses.length > 0) {
							last_business_id = businesses[businesses.length - 1].id;
						}
						else {
							done = true;
						}

						return callback(null);
					});
				});

				return async.waterfall(tasks, callback);
			}, callback);
		});

		tasks.push(function(callback) {
			var done = false;
			var last_business_location_id = 0;

			return async.whilst(function() {
				return !done;
			}, function(callback) {
				var tasks = [];

				tasks.push(function(callback) {
					return DB.query('SELECT * FROM business_locations WHERE id > ? ORDER BY id ASC LIMIT 100', [
						last_business_location_id,
					], function(error, business_locations) {
						return callback(error, business_locations);
					});
				});

				tasks.push(function(business_locations, callback) {
					var tasks = [];

					business_locations.forEach(function(business_location) {
						tasks.push(function(callback) {
							var tasks = [];

							tasks.push(function(callback) {
								return geocode([
									business_location.street + ' ' + business_location.street_number,
									business_location.city,
									business_location.region,
									business_location.country,
								].join(', '), callback);
							});

							tasks.push(function(location, callback) {
								business_location.latitude 		= location.latitude;
								business_location.longitude 	= location.longitude;
								return callback(null);
							});

							tasks.push(function(callback) {
								return DB.query('UPDATE business_locations SET latitude = ?, longitude = ? WHERE id = ? LIMIT 1', [
									business_location.latitude,
									business_location.longitude,
									business_location.id,
								], function(error) {
									return callback(error);
								});
							});

							tasks.push(function(callback) {
								console.log('Processed business_location: ' + business_location.id);
								return callback(null);
							});

							return async.waterfall(tasks, callback);
						});
					});

					return async.series(tasks, function(error) {
						if (error) {
							return callback(error);
						}

						if (business_locations.length > 0) {
							last_business_location_id = business_locations[business_locations.length - 1].id;
						}
						else {
							done = true;
						}

						return callback(null);
					});
				});

				return async.waterfall(tasks, callback);
			}, callback);
		});

		return async.waterfall(tasks, callback);
	});

	tasks.push(function(callback) {
		console.log('YEEEAAAH!!! DONE!');
		DB.end();
		console.log('Disconnected from MySQL DB.');
		return callback(callback);
	});

	return async.waterfall(tasks, callback);
};