<style>
	{!! $styles !!}
</style>
@if ($show_background_image && $background_image_url)
	<div class="jm-w__image hidden">
		<div class="jm-w__image__background" style="background-image: url('{{ $background_image_url }}');"></div>
		<img class="jm-w__image__image" src="{{ $background_image_url }}" alt="">
		<img class="jm-w__image__loader" src="{{ asset('/img/widget_loading.gif') }}">
	</div>
@endif
<div class="jm-w__header">
	<select class="jm-w__language-switcher">
		<option value="en" {{ $locale == 'en' ? 'selected' : '' }}>English</option>
		<option value="fr" {{ $locale == 'fr' ? 'selected' : '' }}>French</option>
	</select>
	<div class="jm-w__title">{{ $business->localized_name }}</div>
	<div class="jm-w__description-container">
		<div class="jm-w__description short">
			<span>
				{!! nl2br(e(trim(substr($business->localized_description, 0, 200)))) . (strlen($business->localized_description) > 200 ? '&hellip;' : '') !!}
			</span>
			<a href="#" class="jm-w__description-toggle {{ strlen($business->localized_description) > 200 ? '' : 'hidden' }}">more</a>
		</div>
		<div class="jm-w__description full hidden">
			<span>
				{!! nl2br(e($business->localized_description)) !!}
			</span>
			<a href="#" class="jm-w__description-toggle  {{ strlen($business->localized_description) > 200 ? '' : 'hidden' }}">less</a>
		</div>
	</div>
</div>
<div class="jm-w__body">
	<div class="jm-w__body-loader">
		<img src="{{ asset('/img/widget_loading.gif') }}">
	</div>
	<form class="jm-w__search">
		<div class="jm-w__search-cell" style="position: relative;">
			<input class="jm-w__search-input" type="text" placeholder="{{ __('widget.search') }}">
			<button type="submit">
				<img src="{{ asset('/img/widget-search.png?4') }}" alt="Search">
			</button>
		</div>
		<div class="jm-w__search-cell minimum-width">
			<select class="jm-w__search-status">
				<option value="open">{{ __('widget.statuses.open_jobs') }}</option>
				<option value="closed">{{ __('widget.statuses.closed_jobs') }}</option>
				<option value="">{{ __('widget.statuses.all_vacancies') }}</option>

			</select>
			<select class="jm-w__search-employment-type">
				<option value="">{{ __('widget.employment_types.all_types') }}</option>
				@foreach ($job_types as $job_type)
					<option value="{{ $job_type->key }}">{{ $job_type->localized_name }}</option>
				@endforeach
			</select>
			<select class="jm-w__search-order">
				<option value="newest">{{ __('widget.orders.newest') }}</option>
				<option value="oldest">{{ __('widget.orders.oldest') }}</option>
			</select>
		</div>
	</form>
	<div class="jm-w__jobs" style="{{ count($job_views) > 0 ? '' : 'display: none;' }}">
		@foreach ($job_views as $job_view)
			{!! $job_view !!}
		@endforeach
	</div>
	<div class="jm-w__pagination">{!! $pagination !!}</div>
	<div class="jm-w__no-jobs" style="{{ count($job_views) > 0 ? 'display: none;' : '' }}">{{ __('widget.no_jobs') }}</div>
</div>
<div class="jm-w-modal jm-w">
	<div class="jm-w-modal__header">
		<button type="button" class="jm-w-modal__close">×</button>
		<button type="button" class="jm-w-modal__apply-button">Apply to this Job</button>
	</div>
	<div class="jm-w-modal__content">
		<div class="jm-w-modal__title">-- Scheduler --</div>
		<div class="jm-w-modal__category">-- Administrative --</div>
		<div class="jm-w-modal__address">
			{{-- <img src="https://raisedtoday.com/img/countries/flags/US.png" alt="US"> --}}
			<span>-- Address --</span>
		</div>
		<div class="jm-w-modal__details">
			<p class="jm-w-modal__spoken-languages">
				<b>{{ __('widget.languages_spoken') }}</b>
				<span>-- languages --</span>
			</p>
			<p class="jm-w-modal__hours-a-week">
				<b>{{ __('widget.hours_a_week') }}</b>
				<span>-- 10 --</span>
				<span>{{ __('widget.hours') }}</span>
			</p>
			<p class="jm-w-modal__career-levels">
				<b>{{ __('widget.career_level') }}</b>
				<span>-- intermediate --</span>
			</p>
		</div>
		<div class="jm-w-modal__description">
			-- description --
		</div>
	</div>
	<div class="jm-w-modal__footer">
		<span>{{ __('widget.powered_by_jm_visit_full_career_page_of') }}</span> <a href="{{ url('/business/view/' . $business->id . '/' . $business->slug) }}" target="_blank">{{ $business->localized_name }}</a>
	</div>
</div>
<div class="jm-w-uploader hidden">
	<iframe class="jm-w-uploader__iframe" src="{{ url('/widget/' . $id . '/resume_uploader?locale=' . $locale) }}"></iframe>
</div>
