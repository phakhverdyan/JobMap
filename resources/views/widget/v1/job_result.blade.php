<div class="jm-w-job" data-data='{!! base64_encode(json_encode($data)) !!}'>
	<div class="jm-w-job__main-details">
		<a href="#" class="jm-w-job__title">{{ $job->localized_title }}</a>
		<div class="jm-w-job__location">
			<a href="{{ url('/map/view/job/' . $job_location_id) }}" target="_blank">
				<!-- <img src="{!! url('/img/placeholder.svg') !!}"> -->
				{{-- <img src="{{ url('/img/countries/flags/' . $location->country_code . '.png') }}" alt="{{ $location->country_code }}"> --}}
			</a>
			<span>{{ $location->street }} {{ $location->street_number }}, {{ $location->city }}, {{ $location->region }}, {{ $location->country }}</span>
		</div>
	</div>
    <div class="jm-w-job__job-status">
        @if($job->status)
            {{ __('widget.statuses.open') }}
        @else
            {{ __('widget.statuses.closed') }}
        @endif
    </div>
	<div class="jm-w-job__employment-type">{{ $job->type ? $job->type->localized_name : '-------' }}</div>
	@if($show_job_posted_date)
	<div class="jm-w-job__separator">●</div>
	<div class="jm-w-job__posted-time">
		@if ($days_ago == 0)
			{{ __('widget.today') }}
		@elseif ($days_ago == 1)
			{{ __('widget.yesterday') }}
		@else
			{{ __('widget.n_days_ago', ['days' => $days_ago]) }}
		@endif
	</div>
	@endif
	<div class="jm-w-job__buttons">
		<a href="#" class="jm-w-job__apply-button">{{ __('widget.buttons.apply') }}</a>
	</div>
</div>
