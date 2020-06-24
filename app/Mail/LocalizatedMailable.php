<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class LocalizatedMailable extends Mailable {
	public $locale = 'en';
	public $name = '';
	public $subjectData = [];

	public function initialize($name, array $subjectData = [], array $viewData = []) {
		$this->subjectData = $subjectData;
		$this->subject(trans($name, $this->subjectData, $this->locale));
		$this->view($name, $viewData);
		return $this;
	}

	public function locale($locale) {
		$this->locale = $locale;
		return $this;
	}

	public function view($view, array $data = []) {
		$trying_views = [];

		if ($this->locale && $this->locale != 'en') {
			$trying_views[] = str_replace('emails.', 'emails.' . $this->locale . '.', $view);
		}

		$trying_views[] = str_replace('emails.', 'emails.en.', $view);
		$trying_views[] = $view;
		$right_view = null;

		foreach ($trying_views as $trying_view) {
			if (!\View::exists($trying_view)) {
				continue;
			}

			$right_view = $trying_view;
			break;
		}

		$this->view = $right_view;
        $this->viewData = array_merge($this->viewData, $data);
        return $this;
	}
}