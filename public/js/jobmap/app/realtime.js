window.realtime = (function() {
	var subscribed_to_user = null;
	var subscribed_to_businesses = [];
	var socket_connected = false;
	var socket_port = (window.location.host.indexOf('devx') > -1 ? 3332 : 3333);
	var socket = io([ 'com', 'co' ].indexOf(window.location.host.split('.').pop()) > -1 ? 'https://realtime.jobmap.co:' + socket_port : ':3333');

	var subscribeToUser = function(user) {
		subscribed_to_user = {
			id: user.id,
			realtime_token: user.realtime_token,
		};

		if (socket_connected) {
			// console.log('subscribeToUser', subscribed_to_user);
			socket.emit('subscribeToUser', subscribed_to_user);
		}
	};

	var subscribeToBusiness = function(business) {
		var subscribed_to_business = {
			id: business.id,
			realtime_token: business.realtime_token,
		};

		subscribed_to_businesses.push(subscribed_to_business);
		
		if (socket_connected) {
			// console.log('subscribeToBusiness', subscribed_to_business);
			socket.emit('subscribeToBusiness', subscribed_to_business);
		}
	};

	var updateOnlineStatuses = function() {
		if (!socket_connected) {
			return;
		}

		var features = $('.realtime__online-status').toArray().map(function(element) {
			return $(element).attr('data-type') + ':' + $(element).attr('data-id');
		}).filter(function(feature, feature_index, features) {
			return features.indexOf(feature) == feature_index;
		}).map(function(feature) {
			feature = feature.split(':');

			return {
				id: 	parseInt(feature[1]),
				type: 	feature[0],
			};
		});

		// console.log('getOnlineStatuses', features);
		(features.length > 0) && socket.emit('getOnlineStatuses', features);
	};

	var on = function() {
		return socket.on.apply(socket, arguments);
	};

	var off = function() {
		return socket.off.apply(socket, arguments);
	};

	var emit = function() {
		return socket.emit.apply(socket, arguments);
	};

	socket.on('connect', function() {
		socket_connected = true;

		if (subscribed_to_user) {
			// console.log('subscribeToUser', subscribed_to_user);
			socket.emit('subscribeToUser', subscribed_to_user);
		}

		subscribed_to_businesses.forEach(function(subscribed_to_business) {
			// console.log('subscribeToBusiness', subscribed_to_business);
			socket.emit('subscribeToBusiness', subscribed_to_business);
		});

		$(function() {
			updateOnlineStatuses();
			setInterval(updateOnlineStatuses, 15 * 1000);
		});
	});

	socket.on('requestedOnlineStatuses', function(features) {
		// console.log('requestedOnlineStatuses', features);
		var $online_statuses = $('.realtime__online-status');

		features.forEach(function(feature) {
			$online_statuses.filter(function() {
				return $(this).attr('data-type') == feature.type && $(this).attr('data-id') == feature.id;
			}).removeClass('online offline').addClass(feature.status);
		})
	});

	socket.on('disconnect', function() {
		socket_connected = false;
	});

	return {
		subscribeToUser: 		subscribeToUser,
		subscribeToBusiness: 	subscribeToBusiness,
		updateOnlineStatuses: 	updateOnlineStatuses,
		on: 					on,
		off: 					off,
		emit: 					emit,
	};
})();
