$(function() {
	(function initialize_registration_form() {
		var $form = $('.landing__registration-form');

		$form.submit(function(event) {
			event.preventDefault();
			
			request('query', 'login', $form.serialize(), [
				'token',
				'last_active_business',
				'redirect',
			], function(response) {
				if (new Validator($form, response).fails()) {
					return;
				}

				if (response.errors) {
					$.notify(response.errors[0].message, 'error');
					return;
				}

				window.location.href = '/manager';
			});
		});
	})();
});