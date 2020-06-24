var config = (function(fs) {
	if (!fs.existsSync(__dirname + '/config.js')) {
		throw new Error('The `config.js` is not found');
	}

	try {
		var string = fs.readFileSync(__dirname + '/config.js');
	}
	catch (error) {
		throw new Error('An error was caused during reading the `config.js` file');
	}

	try {
		return eval('(' + string + ')');
	}
	catch (error) {
		throw new Error('Error reading the config file: ' + JSON.stringify(error.stack));
	}
})(require('fs'));

// ---------------------------------------------------------------------- //

var async = require('async');

// ---------------------------------------------------------------------- //

var IndeedConnection = require('./components/indeed-connection')(config);

// ---------------------------------------------------------------------- //

var indeedConnection = new IndeedConnection({
	email: 		'cedric@jobmap.co',
	password: 	'diva1234',
});

var tasks = [];

tasks.push(function(callback) {
	return indeedConnection.login(callback);
});

// tasks.push(function(callback) {
// 	return indeedConnection.getJobs({}, callback);
// });

// tasks.push(function(data, callback) {
// 	console.log(JSON.stringify(data, null, '\t'));
// 	return callback(null);
// });

// tasks.push(function(callback) {
// 	return indeedConnection.getCandidates({
// 		job_id: '94182e0ba1b1',
// 	}, function(error, data) {
// 		console.log(error, data);
// 		return callback(null);
// 	});
// });

tasks.push(function(callback) {
	return indeedConnection.getEmailFromCandidateResume({
		candidate_id: '5c21aae88eb1',
	}, function(error, email) {
		console.log(error, email);
		return callback(null);
	});
});

async.waterfall(tasks, function(error) {
	if (error) {
		console.error(error.stack);
		return;
	}

	console.log('DONE!');
});
