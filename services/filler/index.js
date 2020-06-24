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
		console.error('Error reading the config file:');
		throw error;
	}
})(require('fs'));

// ---------------------------------------------------------------------- //

var api = require('./components/api')(config.api);

// ---------------------------------------------------------------------- //

var current_action_name = process.argv[2] || null;

if (!current_action_name) {
	console.log('Please, set action as the first parameter in command.');
	console.log('Example: node index some-action-here');
	process.exit();
}

try {
	var current_action = require('./actions/' + current_action_name + '.action');
}
catch (error) {
	if (error.code == 'MODULE_NOT_FOUND' && error.message == 'Cannot find module \'./actions/' + current_action_name + '.action\'') {
		console.log('The action with such name `' + current_action_name + '` is not found.');
		process.exit();
	}

	console.error(error.stack);
	process.exit();
}

if (typeof current_action !== 'function') {
	console.log('The action `' + current_action_name + '` has broken file (it does not export a function). Please, check it and try again.');
	process.exit();
}

var current_action_settings = (function(fs) {
	if (!fs.existsSync(__dirname + '/actions/' + current_action_name + '.action.settings.js')) {
		return {};
	}

	try {
		var string = fs.readFileSync(__dirname + '/actions/' + current_action_name + '.action.settings.js');
	}
	catch (error) {
		throw new Error('An error was caused during reading the `./actions/' + current_action_name + '.action.settings.js` file');
	}

	try {
		return eval('(' + string + ')');
	}
	catch (error) {
		console.error('Error reading the action settings file:');
		throw error;
	}
})(require('fs'));

return current_action(api, current_action_settings, function(error) {
	if (error) {
		console.error(error.stack);
		return;
	}

	console.log('The action done.');
	console.log('Have a good one, man!');
});

// var api = require('./components/api')(config.api);

// api.login({}, function(error, response) {
// 	if (error) {
// 		console.error(error.stack);
// 		return;
// 	}

// 	api.me(function(error, response) {
// 		if (error) {
// 			console.error(error.stack);
// 			return;
// 		}

// 		console.log(JSON.stringify(response, null, '\t'));
// 	});
// });

// api.checkUser({
// 	first_name: "TestFN",
// 	last_name: "TestlN",
// 	username: "testfntestln",
// 	email: "testfntestln@mail.ru",
// 	password: "qwertypass",
// 	confirm_password: "qwertypass",
// 	social: "",
// 	social_id: "",
// 	social_token: "",
// 	gender: "",
// 	user_pic: "",
// 	user_pic_original: "",
// 	type: "student",
// 	inviting_business_id: "0",
// 	language: 1,
// }, function(error, result) {
// 	if (error) {
// 		console.error(error.stack);
// 		return;
// 	}

// 	console.log(JSON.stringify(result, null, '\t'))
// });