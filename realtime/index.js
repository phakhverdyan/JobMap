var fs 	= require('fs');

// ---------------------------------------------------------------------- //

var config = (function() {
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
		console.error('Error reading the `config.js` file:');
		throw error;
	}
})();

Object.assign(config, (function() {
	if (!fs.existsSync(__dirname + '/config.env.js')) {
		return {};
	}

	try {
		var string = fs.readFileSync(__dirname + '/config.env.js');
	}
	catch (error) {
		throw new Error('An error was caused during reading the `config.env.js` file');
	}

	try {
		return eval('(' + string + ')');
	}
	catch (error) {
		console.error('Error reading the `config.env.js` file:');
		throw error;
	}
})());

// ---------------------------------------------------------------------- //

var express 	= require('express');
var https 		= require('https');

// ---------------------------------------------------------------------- //

var server = https.createServer({
    key: 	fs.readFileSync('/home/devjobmap/conf/web/ssl.realtime.jobmap.co.key'),
    cert: 	fs.readFileSync('/home/devjobmap/conf/web/ssl.realtime.jobmap.co.crt'),
    ca: 	fs.readFileSync('/home/devjobmap/conf/web/ssl.realtime.jobmap.co.ca'),
	// requestCert: false,
	// rejectUnauthorized: false,
}, express());

// ---------------------------------------------------------------------- //

var io 			= require('socket.io').listen(server);
var crypto 		= require('crypto');
var mysql 		= require('mysql');

// ---------------------------------------------------------------------- //

var DB = mysql.createConnection(config.database);

DB.connect(function(error) {
	if (error) {
		console.error(error.stack);
		return;
	}

	DB.query('UPDATE users SET is_online = 0, last_seen_at = CURRENT_TIMESTAMP() WHERE is_online = 1');
	DB.query('UPDATE businesses SET business_is_online = 0, is_online = 0, last_seen_at = CURRENT_TIMESTAMP() WHERE is_online = 1');

	DB.on('error', function(error) {
		if (error.code == 'PROTOCOL_CONNECTION_LOST') {
			console.log('Lost MySQL connection. Reconnecting...');
			DB.connect();
			return;
		}
	});
});

var onUserOnlineStatusChanged = function(user_id, status) {
	if (status == 'online') {
		DB.query('UPDATE users SET is_online = 1, last_seen_at = NULL WHERE id = ? LIMIT 1', [
			user_id,
		], function(error) {
			error && console.error(error.stack);
		});
	} else {
		DB.query('UPDATE users SET is_online = 0, last_seen_at = CURRENT_TIMESTAMP() WHERE id = ? LIMIT 1', [
			user_id,
		], function(error) {
			error && console.error(error.stack);
		});
	}
};

var onBusinessOnlineStatusChanged = function(business_id, status) {
	if (status == 'online') {
		DB.query('UPDATE businesses SET business_is_online = 1, is_online = 1, last_seen_at = NULL WHERE id = ? LIMIT 1', [
			business_id,
		], function(error) {
			error && console.error(error.stack);
		});
	} else {
		DB.query('UPDATE businesses SET business_is_online = 0, is_online = 0, last_seen_at = CURRENT_TIMESTAMP() WHERE id = ? LIMIT 1', [
			business_id,
		], function(error) {
			error && console.error(error.stack);
		});
	}
};

// ---------------------------------------------------------------------- //

var users = {};
var businesses = {};

// ---------------------------------------------------------------------- //

setInterval(function() {
	Object.keys(users).forEach(function(user_id) {
		if (users[user_id].length > 0) {
			return;
		}

		if (Date.now() - users[user_id].last_seen_at < config.time_before_offline * 1000) {
			return;
		}

		onUserOnlineStatusChanged(user_id, 'offline');
		delete users[user_id];
	});

	Object.keys(businesses).forEach(function(business_id) {
		if (businesses[business_id].length > 0) {
			return;
		}

		if (Date.now() - businesses[business_id].last_seen_at < config.time_before_offline * 1000) {
			return;
		}

		onBusinessOnlineStatusChanged(business_id, 'offline');
		delete businesses[business_id];
	});
}, 15 * 1000);

// ---------------------------------------------------------------------- //

io.on('connection', function(socket) {
	console.log('Socket connected.');

	socket.on('subscribeToUser', function(user) {
		console.log('subscribeToUser', user);

		if (!user.id) {
			console.log('subscribeToUser', 'Broken input data.');
			return;
		}

		if (!user.realtime_token) {
			console.log('subscribeToUser', 'User #' + user.id + ':', 'has no realtime token.');
			return;
		}

		if (crypto.createHmac('sha256', 'Bobik-realtime-User-token').update(String(user.id)).digest('hex') !== user.realtime_token) {
			console.log('subscribeToUser', 'User #' + user.id + ':', 'wrong realtime token.');
			console.log(crypto.createHmac('sha256', 'Bobik-realtime-User-token').update(String(user.id)).digest('hex'), '!=', user.realtime_token);
			return;
		}

		console.log('subscribeToBusiness', 'User #' + user.id + ' successfully subscribed.');
		socket.join('user-' + user.id);

		if (!users[user.id]) {
			users[user.id] = [];
			users[user.id].last_seen_at = null;
			onUserOnlineStatusChanged(user.id, 'online');
		}

		users[user.id].push(socket);
		socket.user_id = user.id;
	});

	socket.on('subscribeToBusiness', function(business) {
		console.log('subscribeToBusiness', business);

		if (!business.id) {
			console.log('subscribeToBusiness', 'Broken input data.');
			return;
		}

		if (!business.realtime_token) {
			console.log('subscribeToBusiness', 'Business #' + business.id + ':', 'has no realtime token.');
			return;
		}

		if (crypto.createHmac('sha256', 'Bobik-realtime-Business-token').update(String(business.id)).digest('hex') !== business.realtime_token) {
			console.log('subscribeToBusiness', 'Business #' + business.id + ':', 'wrong realtime token.');
			console.log(crypto.createHmac('sha256', 'Bobik-realtime-Business-token').update(String(business.id)).digest('hex'), '!=', business.realtime_token);
			return;
		}

		console.log('subscribeToBusiness', 'Business #' + business.id + ' successfully subscribed.');
		socket.join('business-' + business.id);

		if (!businesses[business.id]) {
			businesses[business.id] = [];
			businesses[business.id].last_seen_at = null;
			onBusinessOnlineStatusChanged(business.id, 'online');
		}

		businesses[business.id].push(socket);
		socket.business_id = business.id;
	});

	socket.on('getOnlineStatuses', function(features) {
		socket.emit('requestedOnlineStatuses', features.map(function(feature) {
			if (feature.type == 'User') {
				feature.id = parseInt(feature.id);

				if (!feature.id) {
					return null;
				}

				return {
					type: 			'User',
					id: 			feature.id,
					status: 		(users[feature.id] && users[feature.id].length > 0 ? 'online' : 'offline'),
					last_seen_at: 	(users[feature.id] && users[feature.id].last_seen_at || null),
				};
			}

			if (feature.type == 'Business') {
				feature.id = parseInt(feature.id);

				if (!feature.id) {
					return null;
				}

				return {
					type: 			'Business',
					id: 			feature.id,
					status: 		(businesses[feature.id] && businesses[feature.id].length > 0 ? 'online' : 'offline'),
					last_seen_at: 	(businesses[feature.id] && businesses[feature.id].last_seen_at || null),
				};
			}

			return null;
		}).filter(function(feature) {
			return feature;
		}));
	});

	socket.on('chats.typing', function(data) {
		console.log('chats.typing', JSON.stringify(data));

		if (!data.chat_id || !data.secret_token) {
			return;
		}

		if (crypto.createHmac('sha256', 'Bobik-Chat-secret-token').update(String(data.chat_id)).digest('hex') !== data.secret_token) {
			console.log('subscribeToUser', 'Chat #' + data.chat_id + ':', 'wrong chat secret token.');
			console.log(crypto.createHmac('sha256', 'Bobik-Chat-secret-token').update(String(data.chat_id)).digest('hex'), '!=', user.realtime_token);
			return;
		}

		if (!data.interlocutor_id) {
			return;
		}

		if (data.interlocutor_type == 'Business') {
			io.sockets.to('user-' + data.user_id).emit('chat.typing', {
				chat_id: data.chat_id,
			});

			return;
		}

		if (data.interlocutor_type == 'User') {
			io.sockets.to('business-' + data.business_id).emit('chat.typing', {
				chat_id: data.chat_id,
			});

			return;
		}

		return;
	});

	socket.on('disconnect', function() {
		if (socket.user_id && users[socket.user_id]) {
			users[socket.user_id].splice(users[socket.user_id].indexOf(socket), 1);

			if (users[socket.user_id].length == 0) {
				users[socket.user_id].last_seen_at = new Date;
			}
		}

		if (socket.business_id && businesses[socket.business_id]) {
			businesses[socket.business_id].splice(businesses[socket.business_id].indexOf(socket), 1);

			if (businesses[socket.business_id].length == 0) {
				businesses[socket.business_id].last_seen_at = new Date;
			}
		}

		console.log('Socket disconnected.');
	});
});

// ---------------------------------------------------------------------- //

var Express = express();

Express.get('/:event', function(request, response) {
	if (!request.params.event) {
		return response.status(400).send({
			error: 'No event param',
		});
	}

	if (Array.isArray(request.query.receivers) && request.query.receivers.length > 0) {
		var count_of_valid_receivers = 0;
		var collection = io.sockets;
		
		request.query.receivers.forEach(function(receiver) {
			if (receiver.type == 'User' && receiver.id > 0) {
				collection.to('user-' + receiver.id);
				++count_of_valid_receivers;
				return;
			}

			if (receiver.type == 'Business' && receiver.id > 0) {
				io.sockets.to('business-' + receiver.id);
				++count_of_valid_receivers;
				return;
			}
		});
		
		(count_of_valid_receivers > 0) && collection.emit(request.params.event, request.query.data);
	}
	else {
		io.emit(request.params.event, request.query.data);
	}

	return response.status(200).send({
		receivers: 	request.query.receivers,
		event: 		request.params.event,
		data: 		request.query.data,
	});
});

// ---------------------------------------------------------------------- //

Express.listen(config.express.port, function() {
	console.log('Express for local events is listening #' + config.express.port + ' port...');
});

server.listen(config.io.port, function() {
	console.log('Express for Socket.io is listening #' + config.io.port + ' port...');
});
