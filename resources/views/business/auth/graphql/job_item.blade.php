<div class="card border-0 job-item" data-item-id="{{ $args['id'] }}">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect" role="tab"
         id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
            <a class="collapsed Bobik-" data-toggle="collapse" href="#collapse{{ $args['id'] }}"
               aria-expanded="true" aria-controls="collapse{{ $args['id'] }}"
               style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">
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

                @if($args['salary'])
                <span class="ml-2 mxa-0">
                            <strong style="font-size: 16px;">{{ $args['salary_type'] }}{{ $args['salary'] }}</strong>
                            <span class="ml-0 mr-2">{!! trans('main.label.per_hour') !!}</span>
                        </span>
                @endif
                @if($args['hours'])
                <span class="ml-2 mxa-0">
                            <strong style="font-size: 16px;">{{ $args['hours'] }}{!! trans('main.label.h') !!}</strong>
                            <span class="ml-0 mr-2">{!! trans('main.label.per_week') !!}</span>
                        </span>
                @endif
                @if($type_name)
                    <span class="ml-2 mxa-0">
                            <strong style="font-size: 16px;">{{ $type_name }}</strong>
                        </span>
                @endif
            </a>
            <div class="btn-group float-right mr-3" role="group">
                <button id="btnGroupDrop1" type="button"
                        class="border-0 dropdown-toggle morewithoutcaret"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                         id="Layer_1" x="0px" y="0px" width="20px" height="18px"
                         viewBox="0 0 210 210"
                         style="enable-background:new 0 0 210 210; vertical-align: middle; fill:#4E5C6E;"
                         xml:space="preserve" ata-toggle="tooltip" data-placement="top"
                         title="More">
                        <g id="XMLID_103_">
                            <path id="XMLID_104_"
                                  d="M115,0H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15V15   C130,6.716,123.284,0,115,0z"/>
                            <path id="XMLID_105_"
                                  d="M115,80H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15V95   C130,86.716,123.284,80,115,80z"/>
                            <path id="XMLID_106_"
                                  d="M115,160H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15v-20   C130,166.716,123.284,160,115,160z"/>
                        </g>
                    </svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                    {{-- @if (is_admin() or is_permit_administrator(['locations'])) --}}
{{--                        <button class="dropdown-item business-job-assign" type="button" role='button' data-toggle="modal" data-target="#ManaInLocModal" data-id="{{ $args['id'] }}">{!! trans('main.buttons.apply_this_job') !!}</button>--}}
                        <button class="dropdown-item business-job-assign-new" type="button" role='button' data-toggle="modal" data-target="#ManaInLocModal" data-id="{{ $args['id'] }}">{!! trans('modals.buttons.assign_job_to_location') !!}</button>
                    {{-- @endif --}}

                    {{--<button class="dropdown-item business-job-status-assign" type="button" role='button'
                            data-toggle="modal" data-target="#OpenClosedModal" data-id="{{ $args['id'] }}">{!! trans('main.buttons.opened_in', ['count' => $args['locations_count_open']]) !!}</button>--}}
                    {{--<button type="button" class="dropdown-item" type="button" role='button'>--}}
                        {{--0 Candidate--}}
                    {{--</button>--}}

                    @if ($isEdit)
                        <a class="dropdown-item" href="{{ url('/business/job/edit?id='.$args['id']) }}" role='button'>{!! trans('main.buttons.edit') !!}</a>
                    @endif
                    <button class="dropdown-item" type="button" data-toggle="modal"
                            data-target="#customShareModal" role='button' data-id="{{ $args['id'] }}" data-title="{{ $args['localized_title'] }}">{!! trans('main.buttons.share') !!}
                    </button>
                    @if ($isEdit)
                        <a class="dropdown-item business-job-clone" data-id="{{ $args['id'] }}"
                           href="{{ url('/business/job/clone?id='.$args['id']) }}" role='button'>{!! trans('main.buttons.clone') !!}</a>
                        <button class="dropdown-item business-job-delete" type="button" role='button' data-toggle="modal"
                                data-target="#deleteModal" data-id="{{ $args['id'] }}">{!! trans('main.buttons.delete') !!}
                        </button>
                    @endif
                </div>
            </div>
            {{--<a data-toggle="modal" data-target="#selectShareModal" data-id="{{ $args['id'] }}" class="float-right mr-3">--}}
{{--            <a data-toggle="modal" data-target="#customShareModal" data-id="{{ $args['id'] }}" data-title="{{ $args['localized_title'] }}" class="float-right mr-3">--}}
{{--                @svg('/img/share.svg','sharebutton_svg_class')--}}
{{--            </a>--}}
            <div class="float-right mr-3" style="height: 23px;">
                <label class="switch">
                    <input type="checkbox" class="job-status-change" data-id="{{ $args['id'] }}"
                           @if($args['status'] == 1) checked @endif>
                    <span class="slider round"></span>
                </label>
            </div>


        </h5>
    </div>

{{--    <div id="collapse{{ $args['id'] }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $args['id'] }}"--}}
{{--         data-parent="#accordion">--}}
{{--        <div class="card-body pt-0">--}}
{{--            <div class="col-12 px-0">--}}

{{--                <div class="d-flex">--}}
{{--                    <div class="MarksBeautifulFontColor mb-0 d-flex flex-column flex-md-row">--}}
{{--                        <span>--}}
{{--                            --}}{{--<strong>--}}
{{--                                --}}{{--<span data-toggle="tooltip" data-placement="top" title="Industry"--}}
{{--                                      --}}{{--style="font-size: 16px;">Finance</span>--}}
{{--                            --}}{{--</strong>--}}
{{--                            --}}{{--<span class="ml-2 mr-5" data-toggle="tooltip" data-placement="top"--}}
{{--                                  --}}{{--title="Job Category">Marketing</span>--}}
{{--                        </span>--}}
{{--                        <span class="ml-2 mxa-0">--}}
{{--                            <strong style="font-size: 16px;">{{ $args['salary_type'] }}{{ $args['salary'] }}</strong>--}}
{{--                            <span class="ml-0 mr-5">{!! trans('main.label.per_hour') !!}</span>--}}
{{--                        </span>--}}
{{--                        <span class="ml-2 mxa-0">--}}
{{--                            <strong style="font-size: 16px;">{{ $args['hours'] }}{!! trans('main.label.h') !!}</strong>--}}
{{--                            <span class="ml-0 mr-5">{!! trans('main.label.per_week') !!}</span>--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                <div class="pt-2">--}}
{{--                    <pre class="coll_title">{!! $args['description'] !!}</pre>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
</div>
<!-- ONE LOCATION EOF -->
<hr class="my-0">
