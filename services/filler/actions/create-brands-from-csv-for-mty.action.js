var async 	= require('async');
var fs 		= require('fs');

// ---------------------------------------------------------------------- //

module.exports = function(api, settings, callback) {
	// console.log('Started.');
	var tasks = [];

	tasks.push(function(callback) {
		var tasks = [];

		tasks.push(function(callback) {
			return fs.readFile('./files/05_12_18_brands_list.csv', callback);
		});

		tasks.push(function(buffer, callback) {
			var lines = buffer.toString().split(/[\r\n]+/);

			lines = lines.filter(function(line) {
				return line[0] != ';';
			}).slice(1);

			var brands = lines.map(function(line) {
				var parts = line.split(/;/);

				return {
					name: 			parts[0],
					description: 	'Please, fill the description here.',
					street_number: 	'8210',
					city: 			'Saint-Laurent, Québec, Canada', // parts[2],
					street: 		'Route Transcanadienne',
					phone_number: 	'5143368885',
					zip_code: 		'H4S 1M5',
					industry_id: 	1444, // Fast Food Restaurant

				};
			});

			return callback(null, brands);
		});

		return async.waterfall(tasks, callback);
	});

	tasks.push(function(brands, callback) {
		return api.login({
			email: 'cynthia@mtygroup.com',
			password: '5678dino5678',
		}, function(error, data) {
			if (error) {
				return callback(error);
			}

			// console.log('logged in!');
			return callback(null, brands);
		});
	});

	tasks.push(function(brands, callback) {
		var tasks = [];

		brands.forEach(function(brand) {
			tasks.push(function(callback) {
				return api.createBusiness({
					name: brand.name,
					name_fr: "",
					description: brand.description,
					description_fr: "",
					industry_id: brand.industry_id,
					size_id: 1,
					type: "private",
					street: brand.street,
					street_number: brand.street_number,
					suite: "",
					latitude: 45.488853,
					longitude: 73.72386899999999,
					website: "",
					city: 'Saint-Laurent',
					region: "Québec",
					country: "Canada",
					country_code: "CA",
					phone: brand.phone_number,
					phone_code: "+1 ",
					phone_country_code: "CA",
					zip_code: brand.zip_code,
					language_prefix: "en",
					images: [],
					crop_data_images: [],
					logo: "",
					logo_data: "",
					facebook: "",
					facebook_fr: "",
					instagram: "",
					instagram_fr: "",
					linkedin: "",
					linkedin_fr: "",
					twitter: "",
					twitter_fr: "",
					youtube: "",
					youtube_fr: "",
					snapchat: "",
					snapchat_fr: "",
					video: "",
					video_fr: "",
					amenities: "",
					keywords: "",
					keywords_fr: "",
					parent_id: "233",
				}, function(error, response) {
					if (error) {
						return callback(error);
					}

					if (response.errors) {
						console.log(response.errors);
						process.exit();
					}

					// console.log('BRAND WAS CREATED!');
					return callback(null);
				});
			});
		});

		return async.series(tasks, function(error) {
			return callback(error);
		});
	});

	return async.waterfall(tasks, callback);
};
