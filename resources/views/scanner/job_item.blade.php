@php
    //var_dump($job['job']['type']['getLocalizedNameAttribute']);
@endphp
<div class="card border-0 job-item" data-item-id="{{ $args['id'] }}">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect d-flex align-content-center" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0 align-self-center" style="color: #4E5C6E;">
            <div class="mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     id="Layer_1" x="0px" y="0px" viewBox="0 0 512.019 512.019"
                     style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle; margin-top: -3px;"
                     xml:space="preserve" width="20px" height="20px" class="mr-2">
                    <g>
                        <g>
                            <g>
                                <path d="M480.009,106.676h-448c-17.643,0-32,14.357-32,32v298.667c0,17.643,14.357,32,32,32h448c17.643,0,32-14.357,32-32V138.676    C512.009,121.033,497.652,106.676,480.009,106.676z M490.676,437.343c0,5.888-4.779,10.667-10.667,10.667h-448    c-5.888,0-10.667-4.779-10.667-10.667V138.676c0-5.888,4.779-10.667,10.667-10.667h448c5.888,0,10.667,4.779,10.667,10.667    V437.343z"
                                      data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M309.343,42.676H202.676c-17.643,0-32,14.357-32,32v42.667c0,5.888,4.779,10.667,10.667,10.667h149.333    c5.888,0,10.667-4.779,10.667-10.667V74.676C341.343,57.033,326.985,42.676,309.343,42.676z M320.009,106.676h-128v-32    c0-5.888,4.779-10.667,10.667-10.667h106.667c5.888,0,10.667,4.779,10.667,10.667V106.676z"
                                      data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M511.668,242.655c-1.493-5.717-7.403-9.088-13.013-7.637l-169.963,44.331c-47.552,12.416-97.835,12.416-145.387,0    L13.364,235.017c-5.611-1.451-11.541,1.92-13.013,7.637c-1.493,5.696,1.92,11.52,7.637,13.013l169.941,44.331    c25.557,6.656,51.819,9.984,78.08,9.984s52.544-3.328,78.08-9.984l169.941-44.331    C509.748,254.175,513.161,248.351,511.668,242.655z"
                                      data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M256.009,192.009c-23.531,0-42.667,19.136-42.667,42.667c0,23.531,19.136,42.667,42.667,42.667    s42.667-19.136,42.667-42.667C298.676,211.145,279.54,192.009,256.009,192.009z M256.009,256.009    c-11.755,0-21.333-9.579-21.333-21.333c0-11.755,9.579-21.333,21.333-21.333c11.755,0,21.333,9.579,21.333,21.333    C277.343,246.431,267.764,256.009,256.009,256.009z"
                                      data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                            </g>
                        </g>
                    </g>
                </svg>
                {{ $args['localized_title'] }}
            </div>


            @if($args['salary'])
                <span class="ml-0 mxa-0" style="font-size: 14px;">
														<strong>{{ $args['salary_type'] }}{{ $args['salary'] }}</strong>
														<span class="ml-0 mr-2">{!! trans('main.label.per_hour') !!}</span>
													</span>
            @endif
            @if($args['hours'])
                <span class="ml-2 mxa-0" style="font-size: 14px;">
														<strong>{{ $args['hours'] }}{!! trans('main.label.h') !!}</strong>
														<span class="ml-0 mr-2">{!! trans('main.label.per_week') !!}</span>
													</span>
            @endif
            @if($type_name)
                <span class="ml-2 mxa-0" style="font-size: 14px;">
														<strong>{{ $type_name }}</strong>
													</span>
            @endif
        </h5>
        <div class="btn-group mr-0 ml-auto" role="group">
            <button type="button" class="btn btn-info apply-job" data-job-id="{{ $args['id'] }}" data-job-name="{{ $args['localized_title'] }}">Apply</button>
        </div>
    </div>
</div>
<!-- ONE LOCATION EOF -->
