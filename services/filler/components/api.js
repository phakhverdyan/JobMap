var needle 	= require('needle');
var async 	= require('async');

// ---------------------------------------------------------------------- //

var api = { config: null, token: null };

api.request = function(type, name, request_parameters, response_parameters, callback) {
	var request_parameter_string = '';

	if (request_parameters && Object.keys(request_parameters).length > 0) {
		request_parameter_string = '(' + Object.keys(request_parameters).map(function(parameter_name) {
			return parameter_name + ': ' + JSON.stringify(request_parameters[parameter_name]);
		}).join(', ') + ')';
	}

	// console.log('[API]', type + ' { ' + name + request_parameter_string + ' { ' + response_parameters.join(', ') + ' } }');

	return needle.request('POST', api.config.uri, {
		query: type + ' { ' + name + request_parameter_string + ' { ' + response_parameters.join(', ') + ' } }',
	}, {
		headers: Object.assign({}, api.token ? {
			authorization: 'Bearer ' + api.token,
		} : {}),
	}, function(error, response, body) {
		if (error) {
			return callback(error);
		}

		// if (response.statusCode !== 200) {
		// 	return callback(new Error('Wrong status code: ' + response.statusCode));
		// }
		
		var output = {};
		output.data = body.data && body.data[name];

		if (body.errors) {
			output.errors = body.errors;
		}

		return callback(null, output);
	});
};

// ---------------------------------------------------------------------- //

api.createCheck = function(data, callback) {
	return api.request('mutation', 'createCheck', data, [ 'response' ], callback);
};

api.login = function(data, callback) {
	return api.request('query', 'login', data, [ 'token', 'last_active_business', 'redirect' ], function(error, response) {
		if (error) {
			return callback(error);
		}

		api.token = (response.data ? response.data.token : null);
		return callback(null, response);
	});
};

api.createUser = function(data, callback) {
	return api.request('mutation', 'createUser', data, [ 'username token first_name' ], function(error, response) {
		if (error) {
			return callback(error);
		}

		api.token = (response.data ? response.data.token : null);
		return callback(null, response);
	});
};

api.me = function(callback) {
	return api.request('query', 'me', null, [ 'id', 'email', 'username', 'first_name', 'last_name' ], callback);
};

api.createBusiness = function(data, callback) {
	return api.request('mutation', 'createBusiness', data, [ 'id', 'token', 'error_message' ], callback);
};

api.createLocation = function(data, callback) {
	// console.log('[api.createLocation]', JSON.stringify(data, null, '\t'));
	return api.request('mutation', 'createLocation', data, [ 'id', 'token' ], callback);
};

api.businessLocations = function(data, callback) {
	return api.request('query', 'businessLocations', data, [ 'items{id, name}' ], callback);
};

module.exports = function(config) {
	api.config = config;
	return api;
};