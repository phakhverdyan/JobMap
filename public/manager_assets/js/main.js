var template = function(name, parameters) {
	var html = $('#' + name + '-template').html() || null;

	if (!html) {
		throw new Error('The `' + name + '` template does not exist');
	}

	return ejs.render(html, parameters);
};

// ---------------------------------------------------------------------- //

var request = function(options, callback) {
	// examples of usage:
	// - request('query', 'login', { email: '', password: '' }, [ 'token' ], callback); // <--- GraphQL request
	// - request({ method: 'GET', data: { param: 1 } }, callback); // <--- REST API request to /api endpoint by default

	if (Array.isArray(options)) {
		options = { many: options, parallel: true };
	}

	if (typeof options == 'string') {
		return (function(type, name, data, params, callback) {
			data = data || {};

			if (typeof data == 'string') {
				data = data.split(/&/).map(function(part) {
					part = part.split(/=/);
					var part_name = part[0];
					var part_value = decodeURIComponent(part[1]);
					part = {};
					part[part_name] = part_value;
					return part;
				}).reduce(function(data, part) {
					return Object.assign(data, part);
				}, {});
			}

			var query = '';
			query += type;
			query += ' { ';
			query += name;

			if (Object.keys(data).length > 0) {
				query += ' (' + Object.keys(data).map(function(key) {
					return key + ': ' + JSON.stringify(data[key]);
				}).join(', ') + ')';
			}

			query += ' { ';

			if (Array.isArray(params)) {
				query += params.join(', ');
			} else {
				query += params;
			}

			query += ' }';
			query += ' }';

			return request({
				root: '/graphql',
				url: '',
				method: 'POST',

				data: {
					query: query,
				},
			}, function(response) {
				response.data = response.data[name];
				return callback(response);
			});
		}).apply(null, arguments);
	}

	if (options.many) {
		var responses = {};
		var requests = options.many;
		
		if (options.parallel) {
			return requests.map(function(options, request_index) {
				return request(options, function(response) {
					responses[request_index] = response;

					if (Object.keys(responses).length < requests.length) {
						return;
					}

					responses.length = requests.length;
					return callback.apply(null, Array.prototype.slice.call(responses));
				});
			});
		}

		return request({
			url: '/',

			data: {
				requests: requests.map(function(request) {
					if (typeof request == 'string') {
						request = { url: request };
					}

					var query_string = $.param(request.data || {});
					return request.url + (query_string ? '?' + query_string : '');
				}),
			},
		}, function(response) {
			return callback.apply(null, response.responses);
		});
	}

	var data = null;

	if (typeof options.data == 'string') {
		data = options.data;

		if (Array.isArray(options.fields) && options.fields.length > 0) {
			if (data) {
				data += '&';
			}

			data += '@=' + options.fields;
		}
	} else if (options.data instanceof FormData) {
        data = options.data;
    } else {
		data = {};
		options.data && Object.assign(data, options.data);

		if (Array.isArray(options.fields) && options.fields.length > 0) {
			Object.assign(data, { '@': options.fields });
		}
	}

	if (typeof options == 'string') {
		options = { url: options };
	}

	options.root = (options.root === undefined ? '/api' : options.root);
	options.url = options.url.replace(/\/{2,}/, '/').replace(/^\//, '');

	return $.ajax({
        method: (options.method || 'GET'),

        url: (
        	options.root
        	+
        	(options.url && options.url[0] != '/' ? '/' : '')
        	+
        	options.url
        	+
        	(window.user && window.user.api_token ? '?api_token=' + window.user.api_token : '')
        ),

        data: data,

        beforeSend: function(request) {
	        document.cookie.split(/;/).map(function(cookie) {
	        	return cookie.trim().split(/=/);
	        }).forEach(function(cookie) {
	        	if (cookie[0] == 'api-token') {
	        		request.setRequestHeader('Authorization', 'Bearer ' + cookie[1]);
	        		return;
	        	}

	        	if (cookie[0] == 'CSRF-TOKEN') {
	        		request.setRequestHeader('X-CSRF-Token', cookie[1]);
	        		return;
	        	}
	        });
	    },
    }).done(function(response, textStatus, xhr) {
    	// var error = response.error || response.exception;

		if (response.error && response.error != 'Validation') {
    		return callback && callback(response);
		}

    	return callback && callback(response);
    }).fail(function(xhr) {
    	if (xhr.statusText == 'abort') {
			return;
		}

		var response = xhr.responseJSON || null;

		if (response && response.error) {
			return callback && callback(response);
		}
		
		if (response && response.exception) {
			return callback && callback(Object.assign({
				error: 'INTERNAL_ERROR',
			}, response));
		}

		console.error(xhr.responseJSON);
		$.notify('Server error: ' + xhr.status, 'error');
    });
};

// ---------------------------------------------------------------------- //

var Validator = function(element, response) {
	var self = this;
	self.$element = $(element);

	self.fails = function() {
		Validator.clear(self.$element);

		var show_errors = function(validation_fields) {
			Object.keys(validation_fields).forEach(function(validation_field) {
				var errors = validation_fields[validation_field];
				var $form_control = self.$element.find('[data-name="' + validation_field + '"]');
				$form_control.addClass('is-invalid');

				$form_control.add($form_control.parents().slice(0, 2)).toArray().some(function(element) {
					var $invalid_feedback = $(element).siblings('.invalid-feedback:first');

					if ($invalid_feedback.length == 0) {
						return false;
					}

					$invalid_feedback.addClass('d-block').html(errors.join('<br />'));
					return true;
				});
			});
		};

		if (response.error == 'Validation') {
			show_errors(response.validation_fields);
			// $.notify('Form validation fails!', 'error');
			return true;
		}

		if (response.errors && response.errors[0].validation) {
			show_errors(response.errors[0].validation);
			return true;
		}

		return false;
	};
};

Validator.clear = function(element) {
	$(element).find('.form-control.is-invalid').each(function() {
		var $form_control = $(this);
		$form_control.removeClass('is-invalid');

		$form_control.add($form_control.parents().slice(0, 2)).toArray().some(function(element) {
			var $invalid_feedback = $(element).siblings('.invalid-feedback:first');

			if ($invalid_feedback.length == 0) {
				return false;
			}

			$invalid_feedback.removeClass('d-block').html('');
			return true;
		});
	});
};

// ---------------------------------------------------------------------- //

var locale = function() {
	return document.body.parentElement.lang || 'en';
};

// ---------------------------------------------------------------------- //

var Router = function(options) {
	var self = this;
	self.current_route = null;

	self.update = function() {
		if (self.current_route) {
			self.current_route.off && self.current_route.off.apply(self.current_route, [ self ]);
		}

		options.clear && options.clear();
		self.current_route = null;

		var found = options.routes.some(function(route) {
			var match = window.location.pathname.match(route.path);

			if (!match) {
				return false;
			}

			self.current_route = route;

			self.current_route.on && self.current_route.on.apply(self.current_route, Array.prototype.slice.apply(match, [1]).concat([
				self,
			]));

			return true;
		});

		if (!found) {
			options.default && options.default();
		}
	};

	self.go = function(path) {
		$(function() {
			if (window.location.pathname != path) {
				history.pushState({}, null, path);
			}

			self.update();
		});
	};

	self.replace = function(path) {
		$(function() {
			if (window.location.pathname != path) {
				history.replaceState({}, null, path);
			}

			self.update();
		});
	};

	window.onpopstate = function() {
		self.update();
	};

	$(document).on('click', 'a[href]:not(a[href^="#"])', function(event) {
		var $self = $(this);

		var route_exists = options.routes.some(function(route) {
			return $self.attr('href').match(route.path);
		});

		if (route_exists) {
			event.preventDefault();
			self.go($self.attr('href'));
		}
	});

	$(function() {
		self.update();
	});
};