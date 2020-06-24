@php
    $locationUrl = url('/') . '/map/view/location/'. $args['id'] . '/' . str_slug($args['name']);
@endphp

<!-- ONE JOB START -->
<div class="col-12 px-0">
    <div class="d-flex flex-column flex-lg-row pxa-0 p-3 justify-content-between" style="border-bottom:1px solid #e9ecef;">
      <div class="d-flex flex-column flex-lg-row">
        <div class="text-center text-lg-left">
            <img src="{{ $picture }}" class="rounded"
                 style="width: 60px; height: 60px;">
        </div>
        <div class="ml-4 mxa-0 text-center text-lg-left w-100">
            <div class="d-flex justify-content-between flex-column flex-lg-row">
                <div class="mb-2">
                    <a href="{{ $locationUrl }}" style="font-size: 16px; color:#1D1D1D; font-weight: bold;">{{ $args['localized_name'] ?: $args['name'] }}</a>
                </div>
            </div>
            <p class="mb-1 open-sans">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 18.999 18.999" style="enable-background:new 0 0 18.999 18.999;fill:#4266ff; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
                    <g>
                      <g>
                        <path d="M9.5,2c1.609,0,3.12,0.614,4.254,1.73C14.879,4.837,15.5,6.309,15.5,7.87s-0.62,3.03-1.745,4.139    L9.5,16.193l-4.254-4.186C4.121,10.9,3.501,9.431,3.501,7.868s0.62-3.032,1.745-4.141C6.38,2.614,7.892,2,9.5,2 M9.5,0    C7.453,0,5.404,0.768,3.843,2.305c-3.124,3.074-3.124,8.057,0,11.131L9.5,18.999l5.657-5.565c3.124-3.072,3.124-8.056,0-11.129    C13.596,0.768,11.548,0,9.5,0z"/>
                      </g>
                      <g>
                        <path d="M9.5,5.499c0.668,0,1.296,0.26,1.768,0.731c0.976,0.976,0.976,2.562,0,3.537    c-0.473,0.472-1.1,0.731-1.768,0.731s-1.295-0.26-1.768-0.731c-0.976-0.976-0.976-2.562,0-3.537    C8.205,5.759,8.833,5.499,9.5,5.499 M9.5,4.499c-0.896,0-1.792,0.342-2.475,1.024c-1.367,1.367-1.367,3.584,0,4.951    c0.684,0.684,1.578,1.024,2.475,1.024s1.792-0.342,2.475-1.024c1.366-1.367,1.366-3.584,0-4.951    C11.292,4.84,10.396,4.499,9.5,4.499z"/>
                      </g>
                    </g>
                  </svg>
                    {{ $args['street'].' '.$args['street_number'].', '.str_replace(',', ', ', $location) }}
                </span>
            </p>
            @if (isset($args['jobs_count_open']) && isset($args['jobs_count_close']))
            <p class="mb-1">
                <span class="mxa-0">
                    {{-- <a href="{{ $locationUrl }}?jobs_tab=opened" style="text-decoration: none;"> --}} {!! trans_choice('main.counters.c_open_positions', $args['jobs_count_open'], ['count' => $args['jobs_count_open']]) !!}{{-- </a> --}}
                    <span class="ml-3">
                        {{-- <a href="{{ $locationUrl }}?jobs_tab=closed" style="text-decoration: none;"> --}} {{ $args['jobs_count_close'] }} {!! ucfirst(trans('main.status.closed')) !!}{{-- </a> --}}
                    </span>
                </span>
            </p>
            @endif
        </div>
      </div>
      <div>
          <div class="align-self-center mb-2">
            <div class="d-flex">
              <div class="pt-1" style="opacity: 0.4;">
                  <span class="ml-2 mxa-0">{{ $d }}</span>
              </div>
              <span class="ml-2" data-toggle="tooltip" title="Email & share">
                  {{--<a data-toggle="modal" data-target="#ShareModal" data-link="{{ url('/') }}/map/view/location/{{ $args['id'] }}/{{ str_slug($args['name']) }}?locale={{ \App::getLocale() }}">
                      @svg('/img/share.svg', [
                       'width' => '25px',
                       'height' => '25px',
                       'style' => 'fill: #4266ff;'
                       ])
                  </a>--}}
              </span>
            </div>
          </div>
          <div class="align-self-center text-right">
            <a href="{{ url('/') }}/map/view/location/{{ $args['id'] }}/{{ str_slug($args['name']) ?: $args['business']['slug'] ?? 'blank' }}" class="view-job-link btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">{!! trans('main.buttons.view') !!}</a>
          </div>
      </div>
    </div>
</div>
<!-- ONE JOB EOF -->
