function(config) {
	var elements = {};
	elements.root = document.getElementsByClassName('jm-w')[0] || null;
	elements.loader = document.getElementsByClassName('jm-w__loader')[0] || null;
	var current_page = 1;

	var request = function(options, done) {
		var xhr = new XMLHttpRequest;
		options.data = options.data || {};

		var query = Object.keys(options.data).map(function(field_name) {
			return encodeURIComponent(field_name) + '=' + encodeURIComponent(options.data[field_name]);
		}).join('&');

		xhr.open('GET', options.url + (query ? '?' + query : ''));

		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4) {
				done(JSON.parse(xhr.responseText));
			}
		};

		xhr.send();
	};

	var search = function(done) {
		elements.body.className = elements.body.className.split(/\s+/).concat([ 'loading' ]).join(' ');

		request({
			url: config.main_url + '/api/widgets/' + config.id + '/v1',

			data: {
				phrase: elements.search_input.value,
				short: 1,
				page: current_page,
				employment_type: elements.search_employment_type.value,
				status: elements.search_status.value,
				locale: elements.language_switcher.value,
				order: elements.search_order.value,
			},
		}, function(response) {
			if (response.error) {
				console.error(response.error);
				return;
			}

			elements.body.className = elements.body.className.split(/\s+/).filter(function(className) {
				return className != 'loading';
			}).join(' ');

			elements.title.innerText = response.title;
			elements.modal_footer.children[1].innerText = response.title;

			elements.short_description.children[0].innerText = '' +
				response.description.slice(0, 200).trim() +
				(response.description.length > 200 ? '...' : '')
			+ '';

			elements.description.children[0].innerText = response.description;
			elements.short_description.children[1].classList[response.description.length > 200 ? 'remove' : 'add']('hidden');
			elements.description.children[1].classList[response.description.length > 200 ? 'remove' : 'add']('hidden');
			elements.no_jobs.innerText = response.no_jobs;

			elements.search_status.children[0].innerText = response.statuses.open_jobs;
			elements.search_status.children[1].innerText = response.statuses.closed_jobs;
			elements.search_status.children[2].innerText = response.statuses.all_vacancies;

			response.employment_types.forEach(function(employment_type, index) {
				elements.search_employment_type.children[index].innerText = employment_type;
			});

			elements.search_order.children[0].innerText = response.orders.newest;
			elements.search_order.children[1].innerText = response.orders.oldest;
			elements.search_input.setAttribute('placeholder', response.search);
			elements.modal_apply.innerText = response.apply_to_this_job;
			elements.modal_spoken_languages.children[0].innerText = response.languages_spoken;
			elements.modal_hours_a_week.children[0].innerText = response.hours_a_week;
			elements.modal_hours_a_week.children[2].innerText = response.hours;
			elements.modal_career_levels.children[0].innerText = response.career_level;
			elements.modal_footer.children[0].innerText = response.powered_by_jm_visit_full_career_page_of;

			if (response.data.length == 0) {
				elements.jobs.style.display = 'none';
				elements.pagination.style.display = 'none';
				elements.no_jobs.style.display = '';
				return;
			}

			elements.jobs.style.display = '';
			elements.pagination.style.display = '';
			elements.no_jobs.style.display = 'none';
			elements.jobs.innerHTML = response.data.join('\n');
			elements.pagination.innerHTML = response.pagination;
			var header_top_position = 0;
			header_top_position += (window.pageYOffset || document.documentElement.scrollTop);
			header_top_position += elements.header.getBoundingClientRect().top;
			window.scrollTo(0, header_top_position);
		});
	};

	var update_modal = function(data, data_as_string) {
		elements.modal.setAttribute('data-data', data_as_string);
		var content = elements.modal.getElementsByClassName('jm-w-modal__content')[0];
		var title = elements.modal.getElementsByClassName('jm-w-modal__title')[0];
		var category = elements.modal.getElementsByClassName('jm-w-modal__category')[0];
		var address = elements.modal.getElementsByClassName('jm-w-modal__address')[0];
		var description = elements.modal.getElementsByClassName('jm-w-modal__description')[0];
		var spoken_languages = elements.modal.getElementsByClassName('jm-w-modal__spoken-languages')[0];
		var hours_a_week = elements.modal.getElementsByClassName('jm-w-modal__hours-a-week')[0];
		var career_level = elements.modal.getElementsByClassName('jm-w-modal__career-levels')[0];
		title.innerText = data.localized_title;
		category.innerText = (data.category ? data.category.localized_name : '');
		category.style.display = (data.category ? '' : 'none');
		// address.children[0].src = config.main_url + '/img/countries/flags/' + data.country_code + '.png';
		// address.children[0].alt = data.country_code;
		address.children[0].innerText = data.address;

		spoken_languages.children[1].innerText = data.languages.map(function(language) {
			return language.name;
		}).join(', ');

		spoken_languages.style.display = (data.languages.length > 0 ? '' : 'none');

        if (!data.hours) {
            hours_a_week.style.display = 'none';
        } else {
            hours_a_week.children[1].innerText = data.hours;
        }

		description.innerHTML = data.localized_description;

		career_level.children[1].innerText = data.career_levels.map(function(career_level) {
			return career_level.localized_name;
		}).join(', ');

		career_level.style.display = (data.career_levels.length > 0 ? '' : 'none');
		content.scrollTop = 0;
	};

	var initialize = function() {
		elements.image = document.getElementsByClassName('jm-w__image')[0] || null;
		elements.header = document.getElementsByClassName('jm-w__header')[0] || null;
		elements.body = document.getElementsByClassName('jm-w__body')[0] || null;
		elements.search = document.getElementsByClassName('jm-w__search')[0] || null;
		elements.search_status = document.getElementsByClassName('jm-w__search-status')[0] || null;
		elements.search_employment_type = document.getElementsByClassName('jm-w__search-employment-type')[0] || null;
		elements.search_input = document.getElementsByClassName('jm-w__search-input')[0] || null;
		elements.search_order = document.getElementsByClassName('jm-w__search-order')[0] || null;
		elements.jobs = document.getElementsByClassName('jm-w__jobs')[0] || null;
		elements.no_jobs = document.getElementsByClassName('jm-w__no-jobs')[0] || null;
		elements.pagination = document.getElementsByClassName('jm-w__pagination')[0] || null;
		elements.language_switcher = document.getElementsByClassName('jm-w__language-switcher')[0] || null;
		elements.title = document.getElementsByClassName('jm-w__title')[0] || null;
		elements.short_description = document.getElementsByClassName('jm-w__description')[0] || null;
		elements.description = document.getElementsByClassName('jm-w__description')[1] || null;
		elements.modal = document.getElementsByClassName('jm-w-modal')[0] || null;
		elements.modal_apply = document.getElementsByClassName('jm-w-modal__apply-button')[0] || null;
		elements.modal_spoken_languages = document.getElementsByClassName('jm-w-modal__spoken-languages')[0] || null;
		elements.modal_hours_a_week = document.getElementsByClassName('jm-w-modal__hours-a-week')[0] || null;
		elements.modal_career_levels = document.getElementsByClassName('jm-w-modal__career-levels')[0] || null;
		elements.modal_footer = document.getElementsByClassName('jm-w-modal__footer')[0] || null;
		elements.uploader = document.getElementsByClassName('jm-w-uploader')[0] || null;

		elements.search_status.onchange = function() {
			search();
		};

		elements.search_employment_type.onchange = function() {
			search();
		};

		elements.search.onsubmit = function(event) {
			event.preventDefault();
			search();
		};

		elements.search_order.onchange = function() {
			search();
		};

		document.addEventListener('click', function(event) {
			var has_parent_as_modal = function() {
				for (var current_element = event.target; current_element; current_element = current_element.parentElement) {
					if (current_element == elements.modal) {
						return true;
					}

					continue;
				}

				return false;
			};

			if (!has_parent_as_modal()) {
				elements.modal.classList.remove('show');
			}

			if (event.target.matches('.jm-w__pagination .pagination a')) {
				event.preventDefault();
				current_page = event.target.href.split(/-/).pop();
				search();
				return;
			}

			if (event.target.matches('.jm-w-job .jm-w-job__location a')) {
				return;
			}

			if (event.target.matches('.jm-w-job .jm-w-job__apply-button')) {
				event.preventDefault();
				var jm_w_job = event.target.parentElement;

				while (jm_w_job && !jm_w_job.matches('.jm-w-job')) {
					jm_w_job = jm_w_job.parentElement;
				}

				if (!jm_w_job) {
					return;
				}

				var data = JSON.parse(atob(jm_w_job.getAttribute('data-data')));
				elements.uploader.classList.remove('hidden');
				event.target.classList.add('loading');

	            elements.uploader.children[0].contentWindow.postMessage(JSON.stringify({
	            	action: 'jm-w.apply',
	            	business_id: config.business_id,
	            	location_id: data.location_id,
	            	job_id: data.job_id,
	            }), config.main_url);

				return;
			}

			if (event.target.matches('.jm-w-modal__apply-button')) {
				var data = JSON.parse(atob(elements.modal.getAttribute('data-data')));
				elements.uploader.classList.remove('hidden');
				event.target.classList.add('loading');

	            elements.uploader.children[0].contentWindow.postMessage(JSON.stringify({
	            	action: 'jm-w.apply',
	            	business_id: config.business_id,
	            	location_id: data.location_id,
	            	job_id: data.job_id,
	            }), config.main_url);

				return;
			}

			if (event.target.matches('.jm-w-job, .jm-w-job *')) {
				event.preventDefault();
				var jm_w_job = event.target;

				while (jm_w_job && !jm_w_job.matches('.jm-w-job')) {
					jm_w_job = jm_w_job.parentElement;
				}

				if (!jm_w_job) {
					return;
				}

				update_modal(JSON.parse(atob(jm_w_job.getAttribute('data-data'))), jm_w_job.getAttribute('data-data'));
				elements.modal.classList.add('show');
				return;
			}

			if (event.target.matches('.jm-w__description-toggle')) {
				event.preventDefault();

				if (elements.short_description.classList.contains('hidden')) {
					elements.short_description.classList.remove('hidden');
					elements.description.classList.add('hidden');
				} else {
					elements.short_description.classList.add('hidden');
					elements.description.classList.remove('hidden');
				}
			}
		});

		elements.language_switcher.onchange = function() {
			search();

			elements.uploader.children[0].src = '' +
				config.main_url + '/widget/' + config.id +
				'/resume_uploader?locale=' + elements.language_switcher.value +
			'';
		};

		elements.language_switcher.value = config.locale;

		elements.modal.getElementsByClassName('jm-w-modal__close')[0].onclick = function(event) {
			event.preventDefault();
			elements.modal.classList.remove('show');
		};

		window.addEventListener('message', function(event) {
			console.log('PARENT WINDOW: ', event);

	        if (event.data == 'jm-w.open') {
	            elements.uploader.classList.remove('hidden');

	            elements.uploader.children[0].contentWindow.postMessage(JSON.stringify({
	            	action: 'jm-w.toggle',
	            }), config.main_url);

	            return;
	        }

	        if (event.data == 'jm-w.opened') {
	        	elements.uploader.classList.remove('hidden');
	        	elements.root.getElementsByClassName('jm-w-modal__apply-button')[0].classList.remove('loading');

	        	Array.prototype.slice.call(elements.root.getElementsByClassName('jm-w-job__apply-button')).forEach(function(element) {
	        		element.classList.remove('loading');
	        	});

	        	return;
	        }

	        if (event.data == 'jm-w.close') {
	            elements.uploader.classList.add('hidden');
	            return;
	        }
	    });

	    elements.image.children[1].onload = function() {
	    	elements.image.classList.remove('hidden');
	    };
	};

	request({
		url: config.main_url + '/api/widgets/' + config.id + '/v1',

		data: {
			locale: config.locale,
		},
	}, function(response) {
		elements.loader.style.display = 'none';
		elements.root.innerHTML += response.data;
		initialize();
	});
}
