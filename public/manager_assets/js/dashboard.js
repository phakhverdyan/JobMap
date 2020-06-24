dashboard.router = new Router({
	routes: [
		{
			path: /^[/]manager[/]?$/i,
			
			on: function(router) {
				$('.sidebar__menu__item[data-name="applicants"]').addClass('active');

				(function load_applicants(options) {
					request({
						data: {
							page: options.page,
						},

						url: '/businesses/' + business.id + '/applicants',
					}, function(response) {
						var $applicants_items = $('.applicants-items');
						$applicants_items.html('');

						response.data.forEach(function(applicant) {
							var $applicants_item = $(template('applicants-item', applicant));
							$applicants_item.appendTo($applicants_items);

							$applicants_item.click(function(event) {
								event.preventDefault();
								dashboard.applicant_sidebar.open(applicant);
							});
						});

						if (response.data.length == 0) {
							$('.applicants-items').addClass('d-none');
							$('.applicants-no-items').removeClass('d-none');
						} else {
							$('.applicants-items').removeClass('d-none');
							$('.applicants-no-items').addClass('d-none');
						}

						if (response.pagination) {
							$('.applicants-items-pagination').removeClass('d-none');

							$('.applicants-items-pagination').html(template('pagination', {
								pagination: response.pagination,
							}));

							$('.applicants-items-pagination .page-link[data-page]').click(function(event) {
								event.preventDefault();
								var page = parseInt($(this).attr('data-page'));
								load_applicants({ page: page });
							});
						} else {
							$('.applicants-items-pagination').addClass('d-none');
						}
					});
				})({ page: 1 });
			},
		},
	],

	default: function() {
		alert('404 Not Found');
	},

	clear: function() {
		$('.sidebar__menu__item').removeClass('active');
		// modals.close();
	},
});

dashboard.applicant_sidebar = {};

dashboard.applicant_sidebar.open = function(applicant) {
	$('.applicant__additional-information__wrapper').html(template('applicant__additional-information__wrapper', applicant));
	$('.applicant__additional-information').addClass('active');
  	$('.applicant__additional-information').removeClass('non-active');
};

dashboard.applicant_sidebar.close = function() {
	$('.applicant__additional-information').removeClass('active');
  	$('.applicant__additional-information').addClass('non-active');
};

$(function() {
	$('.applicant__additional-information__close-button').click(function(event) {
		event.preventDefault();
		dashboard.applicant_sidebar.close();
	});

	$('#slider__switcher__select').change(function() {
		window.location.href = '/manager/switch_business/' + $(this).val();
	});
});