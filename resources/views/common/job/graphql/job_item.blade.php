<!-- ONE JOB START -->
@php
    $jobType = job_type_by_key($args['type_key']);
    $salary = $args['salary'];
    $salaryFull = $args['salary_type'] . $salary;
    $full_address = '';
    
    if ($args['location']) {
        $full_address = $args['location']['street_number'] . ' ' . $args['location']['street']  .', ' . $args['location']['city'] . ', ' . $args['location']['region'] . ', ' . $args['location']['country'];
    }
    
    if (isset($args['location_street'])) {
        $full_address = $args['location_street'] . ' ' .$args['location_street_number'] . ', ' . $args['location_city'] . ', ' . $args['location_region'] . ', ' . $args['location_country'];
    }

@endphp

<div class="col-12 px-0">
    <div class="d-flex flex-column flex-lg-row pxa-0 px-3 py-2" style="border-bottom:1px solid #e9ecef;">
        <div class="text-center text-lg-left">
            <img src="{{ $picture }}" class="rounded"
                 style="width: 60px; height: 60px;">
        </div>
        <div class="ml-4 mxa-0 text-center text-lg-left w-100">
            <div class="d-flex justify-content-between flex-column flex-lg-row">
              <div class="flex-1">
                <div class="mb-1 d-flex- flex-wrap-">
                    <a href="{{ url('/map/view/job/' . $args['job_location_id']) }}"
                       data-id="{{ $args['id'] }}" class="view-job-link open-sans mr-2"
                       style="font-size: 16px; color:#1D1D1D; font-weight: bold; display: block;">{{ $args['localized_title'] }}</a>
                    <div style="display: block;">
                        @if ($args['status'])
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:rgb(40, 167, 69);" xml:space="preserve">
                               <g><g id="check"><polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon></g></g>
                            </svg>
                            <small style="color:rgb(40, 167, 69);">{!! trans('main.status.jobs.open') !!}</small>
                        @else
                            <svg style="width:17px;height:17px; vertical-align: middle; margin-top: -1px;" viewBox="0 0 24 24">
                                <path fill="#dc3545" d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                            </svg>
                            <small style="color:#dc3545">{!! trans('main.status.jobs.closed') !!}</small>
                        @endif
                    </div>
                </div>
                <p class="mb-1 open-sans" style="opacity: 0.5;">
                    @if ($jobType)
                        <span>{{ $jobType }}</span>
                    @endif

                    @if ($jobType && $salary)
                        <span class="mx-1">•</span>
                    @endif

                    @if ($salary)
                            <span class="rounded ml-0 mxa-0">
                            <span>{{ $salaryFull }}</span>
                            <span class="ml-0 mr-0">{!! trans('main.label.per_hour') !!}</span>
                        </span>
                    @endif

                    @if ($salary && $args['hours'])
                            <span class="mx-1">•</span>
                    @endif

                    @if ($args['hours'])
                            <span class="rounded ml-0 mxa-0">
                                <span>{{ $args['hours'] }}{!! trans('main.label.h') !!}</span>
                            <span class="ml-0 mr-0">{!! trans('main.label.per_week') !!}</span>
                        </span>
                    @endif
                </p>
                <p class="mb-1 open-sans">
                    <span>
                      <i class="glyphicon bfh-flag-{{ isset($args['location_country_code']) ? $args['location_country_code'] : ($args['location'] ? $args['location']['country_code'] : '') }}"></i>
                        {{ $full_address }}
                    </span>
                </p>
              </div>
              <div class="d-flex">
                <div class="text-center">
                  <div class="mb-2" style="opacity: 0.4;">
                    <span class="ml-2 mxa-0">{{ $d }}</span>
                  </div>
                  <div class="align-self-center">
                    {{--
                      <a href="{{ url('/') }}/map/view/{{ $args['job_id']>0 ? 'job' : 'job-union' }}/{{ $args['job_id']>0 ? $args['job_id'] : $args['id'] }}" data-id="{{ $args['id'] }}" class="view-job-link btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">
                        {!! trans('main.buttons.view_job') !!}
                      </a>
                    --}}
                    {{--
                      <a href="{{ url('/') }}/map/view/{{ $args['job_id']>0 ? 'job' : 'job-union' }}/{{ $args['location']['id']>0 ? $args['location']['id'] : $args['job_id'] }}" data-id="{{ $args['id'] }}" class="btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">
                        {!! trans('main.buttons.view_job') !!}
                      </a>
                    --}}
                    <a href="{{ url('/') }}/map/view/{{ isset($args['job_location_id']) ? 'job' : 'job-union' }}/{{ $args['job_location_id'] }}" data-id="{{ $args['job_id'] }}" class="btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">
                      {!! trans('main.buttons.view_job') !!}
                    </a>
                    {{--
                      <a href="{{ route('map.view.location.job', ['job_id' => $args['job_id'], 'location_id' => $args['location']['id']]) }}" data-id="{{ $args['id'] }}" class="btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">{!! trans('main.buttons.view_job') !!}</a>
                    --}}
                  </div>
                </div>
                <div>
                  <div class="align-self-center">
                    <span class="ml-2" data-toggle="tooltip" title="{{ trans('fields.tooltips.email_share_this_job') }}">
                        <a data-toggle="modal" data-target="#ShareModal" data-title="{{ $args['localized_title'] }}" data-description="{{ $args['full_address'] }}" data-image="{{ $big_picture }}" data-link="{{ url('/map/view/job/' . $args['job_id']) }}?locale={{ \App::getLocale() }}">
                            @svg('/img/share.svg', [
                             'width' => '25px',
                             'height' => '25px',
                             'style' => 'opacity: 0.5;',
                            ])
                        </a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
            {{--<p class="mb-1 open-sans">
                <span>{{ \App::isLocale('fr') ? $args['category']['name_fr'] : $args['category']['name'] }}</span>
            </p>--}}

            {{--<div class="small_big_description">
              <pre class="mb-0 pre_discription discription_cut" style="opacity: 0.7;">{{ $args['localized_description'] }}</pre>
              <a class="more_less">{!! trans('fields.more') !!}</a>
            </div>--}}
        </div>
    </div>
</div>
<!-- ONE JOB EOF -->
