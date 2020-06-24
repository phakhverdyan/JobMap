var needle 		= require('needle');
var async 		= require('async');
var pdf_parse 	= require('pdf-parse');

// ---------------------------------------------------------------------- //

var ACCOUNT_MAIN_PAGE_URL = 'https://secure.indeed.com/';
var ACCOUNT_LOGIN_PAGE_URL = 'https://secure.indeed.com/account/login';
var ACCOUNT_VIEW_PAGE_URL = 'https://secure.indeed.com/account/view';
var JOBS_PAGE_URL = 'https://employers.indeed.com/j#jobs';
var JOBS_REQUEST_URL = 'https://employers.indeed.com/j/jobs';
var CANDIDATES_API_URL = 'https://cpqa-employers.indeed.com/api/candidates';
var CANDIDATE_RESUME_FILE_URL = 'https://employers.indeed.com/c/resume';
var JOBS_API_CREATE_URL = 'https://employers.indeed.com/p/ats/api/jobs';
var LOCALE = 'ru';
var USER_AGENT = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36';

// ---------------------------------------------------------------------- //

var IndeedConnection = function(credentials) {
	var self = this;
	self.cookies = null;

	self.getCookieHeader = function(callback) {
		var cookie_names_with_quotes = [
			'SHOE',
			'SOCK',
			'IRF',
			'LC',
		];

		return Object.keys(self.cookies).map(function(cookie_name) {
			if (cookie_names_with_quotes.indexOf(cookie_name) > -1) {
				return cookie_name + '="' + self.cookies[cookie_name] + '"';
			}

			return cookie_name + '=' + self.cookies[cookie_name];
		}).join('; ');
	};

	self.login = function(callback) {
		var tasks = [];

		tasks.push(function(callback) {
			return needle.request('GET', ACCOUNT_LOGIN_PAGE_URL, {}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 200) {
					return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				var match = body.match(/window\.model\s*=\s*(\{.*?\});/);

				if (!match || match.length < 1) {
					return callback(new Error('Could not find window.model variable'));
				}

				try {
					var model_data = JSON.parse(match[1]);
				} catch (error) {
					console.log(error);
					return callback(new Error('JSON parse error'));
				}

				self.cookies = Object.assign({}, response.cookies);
				return callback(null, model_data);
			});
		});

		tasks.push(function(model_data, callback) {
			console.log(self.getCookieHeader());
			process.exit();
			
			return needle.request('POST', ACCOUNT_LOGIN_PAGE_URL, {
				action: 		'login',
				__email: 		credentials.email,
				__password: 	credentials.password,
				remember: 		1,
				login_tk: 		model_data.loginTk,
				hl: 			model_data.extraParams.hl,
				cfb: 			model_data.extraParams.cfb,
				pvr: 			model_data.extraParams.pvr,
				form_tk: 		model_data.extraParams.form_tk,
				surftok: 		model_data.extraParams.surftok,
				tmpl: 			model_data.extraParams.tmpl,
			}, {
				json: 		false,

				headers: {
					'Cookie': self.getCookieHeader(),
					'User-Agent': USER_AGENT,
				},
			}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 302) {
					return callback(new Error('Incorrect password or email address'));
					// return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				if (response.headers.location != ACCOUNT_MAIN_PAGE_URL) {
					return callback(new Error('Incorrect password or email address'));
					// return callback(new Error('Wrong location: ' + response.headers.location));
				}

				// console.log(response.cookies);
				Object.assign(self.cookies, response.cookies);
				return callback(null);
			});
		});

		return async.waterfall(tasks, callback);
	};

	self.getUser = function(callback) {
		return needle.request('GET', ACCOUNT_VIEW_PAGE_URL, {}, {
			headers: {
				'Cookie': self.getCookieHeader(),
				'User-Agent': USER_AGENT,
			},
		}, function(error, response, body) {
			if (error) {
				return callback(error);
			}

			if (response.statusCode !== 200) {
				console.log(response.headers.location);
				console.log(response.cookies);
				return callback(new Error('Wrong status code: ' + response.statusCode));
			}

			var match = body.match(/window\.model\s*=\s*(\{.*?\});/);

			if (!match || match.length < 1) {
				return callback(new Error('Could not find window.model variable'));
			}

			try {
				var model_data = JSON.parse(match[1]);
			} catch (error) {
				console.log(error);
				return callback(new Error('JSON parse error'));
			}

			return callback(null, model_data.user && model_data.user.globalAccount || null);
		});
	};

	self.getJobs = function(options, callback) {
		var tasks = [];

		tasks.push(function(callback) {
			return needle.request('GET', JOBS_PAGE_URL, {}, {
				headers: {
					'Cookie': self.getCookieHeader(),
					'User-Agent': USER_AGENT,
				},
			}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 200) {
					return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				var match = body.match(/indeed\.draw\.start\(([\s\S]*?)\);/);

				if (!match || match.length == 0) {
					return callback(new Error('Could not find JSON data'));
				}

				var draw_data = null;

				try {
					draw_data = eval('(' + match[1] + ')');
				} catch (error) {
					console.error(error);
					return callback(new Error('Evaluating JSON string error'));
				}

				try {
					draw_data = JSON.parse(draw_data);
				} catch (error) {
					console.error(error);
					return callback(new Error('Parsing JSON error'));
				}

				Object.assign(self.cookies, response.cookies);
				return callback(null, draw_data);
			});
		});

		tasks.push(function(draw_data, callback) {
			return needle.request('GET', JOBS_REQUEST_URL, {
				ts: Date.now(),
			}, {
				json: true,

				headers: {
					'Cookie': self.getCookieHeader(),
					'User-Agent': USER_AGENT,
					'X-INDEED-API': 1,
					'X-INDEED-APPNAME': 'jobs-management',
					'X-INDEED-APPTYPE': 'desktop',
					'X-INDEED-RPC': 1,
					'X-INDEED-TK': draw_data.tk,
				},
			}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 200) {
					return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				Object.assign(self.cookies, response.cookies);
				return callback(null, body);
			});
		});

		return async.waterfall(tasks, callback);
	};

	self.getCandidates = function(options, callback) {
		options = options || {};
		options.job_id = options.job_id || 0;

		var tasks = [];

		tasks.push(function(callback) {
			return needle.request('GET', 'https://employers.indeed.com/c#candidates', {
				id: options.job_id,
			}, {
				headers: {
					'Cookie': self.getCookieHeader(),
					'User-Agent': USER_AGENT,
				},
			}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 200) {
					return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				var match = body.match(/var\s+json\s+=\s+('[\s\S]*?');/);

				if (!match || match.length == 0) {
					return callback(new Error('Could not find JSON data'));
				}

				var draw_data = null;

				try {
					draw_data = eval('(' + match[1] + ')');
				} catch (error) {
					console.error(error);
					return callback(new Error('Evaluating JSON string error'));
				}

				try {
					draw_data = JSON.parse(draw_data);
				} catch (error) {
					console.error(error);
					return callback(new Error('Parsing JSON error'));
				}

				Object.assign(self.cookies, response.cookies);
				return callback(null, draw_data);
			});
		});

		tasks.push(function(draw_data, callback) {
			return needle.request('GET', CANDIDATES_API_URL, {
				'X-INDEED-APPTYPE': 'desktop',
				'X-INDEED-APPNAME': 'cand',
				'co': draw_data.co,
				'X-INDEED-TK': draw_data.tk,
			}, {
				headers: {
					'Cookie': self.getCookieHeader(),
					'User-Agent': USER_AGENT,
				},
			}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 200) {
					return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				Object.assign(self.cookies, response.cookies);
				return callback(null, body);
			});
		});

		return async.waterfall(tasks, callback);
	};

	self.getCandidateResume = function(options, callback) {
		options = options || {};

		if (!options.candidate_id) {
			return callback(new Error('The `candidate_id` parameter is required'));
		}

		var tasks = [];

		tasks.push(function(callback) {
			return needle.request('GET', CANDIDATE_RESUME_FILE_URL, {
				id: options.candidate_id,
				ctx: 'draw-candidatedetails',
			}, {
				headers: {
					'Cookie': self.getCookieHeader(),
					'User-Agent': USER_AGENT,
				},
			}, function(error, response, body) {
				if (error) {
					return callback(error);
				}

				if (response.statusCode !== 200) {
					return callback(new Error('Wrong status code: ' + response.statusCode));
				}

				return callback(null, body);
			});
		});

		return async.waterfall(tasks, callback);
	};

	self.getEmailFromCandidateResume = function(options, callback) {
		options = options || {};

		if (!options.candidate_id) {
			return callback(new Error('The `candidate_id` parameter is required'));
		}

		var tasks = [];

		tasks.push(function(callback) {
			return self.getCandidateResume({
				candidate_id: options.candidate_id,
			}, callback);
		});

		tasks.push(function(resume_buffer, callback) {
			return pdf_parse(resume_buffer).then(function(pdf_data) {
				return callback(null, pdf_data.text);
			}).catch(callback);
		});

		tasks.push(function(resume_text, callback) {
			var matches = resume_text.match(/\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/g);
			return callback(null, matches && matches.length > 0 ? matches[0] : null);
		});

		return async.waterfall(tasks, callback);
	};
};

// ---------------------------------------------------------------------- //

module.exports = function() {
	return IndeedConnection;
}