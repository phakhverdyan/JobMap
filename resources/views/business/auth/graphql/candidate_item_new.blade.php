@php
//var_dump($args['last_wave']);
@endphp
<div class=" card border-0 candidate-card candidate-card-{{$access_id}}" data-business-id="{{ $args['business_id'] }}" data-location-id="{{ $args['location_id'] }}" data-user-id="{{ $args['user_id'] }}" data-candidate-id="{{ $args['id'] }}" clicked-on="{{ $args['business_clicked_on'] ? '1' : '0' }}">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0" style="position: relative;">
            <a class="collapsed Bobik" data-toggle="collapse" href="#collapse{{ $args['id'] }}" aria-expanded="true"
               aria-controls="collapse{{ $args['id'] }}"
               style="font-size: 16px; color: #4E5C6E;">
                <div class="d-lg-inline-flex d-flex flex-column flex-lg-row">
                    <div class="text-center text-lg-left mb-3">
                        <div {!! $filters !!} style="width: 60px; border-radius: 5px; overflow: hidden; margin:0 auto;">
                            <img class="mr-3 mxa-0 candidate-picture" src="{{ $user_picture }}"
                                 style="width: 60px; height: 60px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                        </div>
{{--                        @if($picture)--}}
{{--                            <img class="business-logo-medium rounded" src="{{ $picture }}"--}}
{{--                                 style="width: 20px; height: 20px; background-color: #fff;">--}}
{{--                        @endif--}}
                    </div>
                    <div class="text-center text-lg-left mxa-0" style="margin-left: 20px">
                        <div class="mb-1 d-flex flex-column flex-lg-row">
                            <p class="mb-0 candidate-rating-container" data-candidate-id="{{ $args['id'] }}">
                                @if($access && $access_tag !== "free")
                                    <strong class="candidate-name">{{ $fullName }}</strong>
                                @else
                                    <img src="/blur/{{$user['id']}}" alt="" srcset="">
                                @endif
                                @if ($notes_rating['rating'] >0)
                                    <span class="ml-3 candidate-rating {{ $notes_rating['class_color'] }}">{{ $notes_rating['rating'] }}/10</span>
                                @else
                                    <span class="ml-3 candidate-rating"></span>
                                @endif



                                @if($access && ($access_tag != "free"))

                                    <button type="button" class="btn btn-outline-success [ candidate-overview ] btn-sm ml-3" data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $args['user_id'] }}">
                                    <span>
                                        {!! trans('main.buttons.resume_overview') !!}
                                    </span>
                                    </button>

                                    @if ($candidate_import)
                                        <button type="button" class="btn btn-outline-warning btn-sm candidate_edit-show-form"  data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $args['user_id'] }}" style="cursor:pointer;" data-toggle="modal" data-target="#editCandidate" data-dismiss="modal">
                                        <span>
                                          {!! trans('main.buttons.edit_candidate') !!}
                                      </span>
                                        </button>
                                        <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm {{ $read_only ? 'disabled' : '' }}" data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $args['user_id'] }}">
                                            <span>{!! trans('main.buttons.interview') !!}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm  [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}"  data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $args['user_id'] }}" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                                            {!! trans('main.buttons.update') !!}
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}" data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $user['id'] }}">
                                            {!! trans('main.buttons_hint.message') !!}
                                        </button>
                                    @else
                                        <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm {{ $read_only ? 'disabled' : '' }}" data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $args['user_id'] }}">
                                            <span>{!! trans('main.buttons.interview') !!}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm  [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}" data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $user['id'] }}" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                                            {!! trans('main.buttons.update') !!}
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}" data-candidate-id="{{ $args['id'] }}" data-user-id="{{ $user['id'] }}">
                                            {!! trans('main.buttons_hint.message') !!}
                                        </button>
                                    @endif

                                    @if(!empty($user_video))
                                        <div class="[ candidate-video ]" data-user-video="{{$user_video}}" data-id="{{ $args['user']['id'] }}" style="background-image: url('{{$thumbnail_url}}');">
                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">
                                                    <path d="M175,0C78.343,0,0,78.343,0,175c0,96.656,78.343,175,175,175c96.656,0,175-78.344,175-175C350,78.343,271.656,0,175,0z
                                                         M258.738,189.05l-104.386,71.812c-2.904,1.989-6.284,3.006-9.673,3.006c-2.728,0-5.436-0.648-7.93-1.951
                                                        c-5.605-2.965-9.125-8.777-9.125-15.103V103.188c0-6.326,3.52-12.139,9.125-15.104c5.605-2.94,12.377-2.535,17.603,1.055
                                                        l104.386,71.811c4.619,3.18,7.387,8.441,7.387,14.05C266.125,180.609,263.358,185.87,258.738,189.05z"/>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                <g>
                                                </g>
                                                </svg>
                                        </div>
                                    @endif
                                @endif

                                </p>
                                <div>
                                    @if ($args['last_wave'] && $args['last_wave']['time_left'] > 0)
                                        <span class="[ candidate__wave ] ml-3 mxa-0 px-1 rounded"
                                              style="color: #4266ff; border: 1px solid #4266ff; font-size: 12px;">{!! trans('main.status.waving') !!}</span>
                                        <button class="[ candidate__dismiss-wave ] btn btn-outline-primary py-0 ml-2"
                                                style="font-size: 12px;">{!! trans('main.buttons.dismiss') !!}
                                        </button>
                                    @else
                                        <span class="[ candidate__wave ] ml-3 mxa-0 px-1 rounded"
                                              style="color: #4266ff; border: 1px solid #4266ff; font-size: 12px; display: none;">{!! trans('main.status.waving') !!}</span>
                                        <button class="[ candidate__dismiss-wave ] btn btn-outline-primary py-0 ml-2"
                                                style="font-size: 12px; display: none;">{!! trans('main.buttons.dismiss') !!}
                                        </button>
                                    @endif
                                </div>
                        </div>
                        @if (trim($location_user,','))
                            <p class="mb-0" style="font-size: 14px;">
                                <span class="item-location-flag bfh-flag-{{ $user['country_code'] }}"><i class="glyphicon"></i> </span>
                                {{ $location_user }}
                            </p>
                        @endif



{{--                        <span><small>{!! $applied_to !!}</small></span>--}}
{{--                        <span style="display: none;"><small>{!! trans('main.last_applied_to', ['location' => $applied_to])!!}</small></span>--}}

                        <?php
                        $str = '';
                        if ($user['preference']['looking_job'] == 'yes') {
                            $str = trans('sidebar.checkbox.looking_for_a_job_now');
                            if ($user['preference']['its_urgent'] == 'yes') {
                                $str .= ', ' . trans('sidebar.checkbox.its_urgent');
                            }
                        } elseif($user['preference']['new_opportunities'] == 'yes') {
                            $str .= trans('sidebar.checkbox.open_to_new_opportunities');
                        }
                        ?>
                        @if (strlen($str) > 0)
                            <br>
                        <div style="position: relative;">
                            <svg id="Layer_1" width="16px" height="16px" style="enable-background:new 0 0 128 128; position: relative; top: 3px;" version="1.1" viewBox="0 0 128 128" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><style type="text/css">
                                    .st0{fill:#31AF91;}
                                    .st1{fill:#FFFFFF;}
                                </style><g><circle class="st0" cx="64" cy="64" r="64"/></g><g><path class="st1" d="M54.3,97.2L24.8,67.7c-0.4-0.4-0.4-1,0-1.4l8.5-8.5c0.4-0.4,1-0.4,1.4,0L55,78.1l38.2-38.2   c0.4-0.4,1-0.4,1.4,0l8.5,8.5c0.4,0.4,0.4,1,0,1.4L55.7,97.2C55.3,97.6,54.7,97.6,54.3,97.2z"/></g></svg>

                            <span style="display: inline-block;"><small style="">{!! $str !!}</small></span>
                        </div>

                        @endif
                    </div>
                </div>
            </a>

            @if($access && ($access_tag != "free"))
            <div class="btn-group float-right mr-3 pt-2 [ candidate-tools ] hide mxa-0 d-block mb-1" role="group">
                <div class="btn-group float-right flex-column flex-md-row w-100" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-primary candidate-notes"
                            data-user-id="{{ $user['id'] }}" data-candidate-id="{{ $args['id'] }}" >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28"
                             style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                             xml:space="preserve" width="20px" height="18px"
                             data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.candidate_notes') !!}">
                                            <g>
                                                <g>
                                                    <path style=""
                                                          d="M24,11.518V0H0v24h11.518c1.614,2.411,4.361,3.999,7.482,4c4.971-0.002,8.998-4.029,9-9    C27.999,15.879,26.411,13.132,24,11.518z M11.517,14c-0.412,0.616-0.743,1.289-0.994,2H4v2h6.058C10.022,18.329,10,18.661,10,19    c0,1.055,0.19,2.061,0.523,3H2V2h20v8.523C21.061,10.19,20.055,10,19,10c-2.143,0-4.107,0.751-5.652,2H4v2H11.517z M19,25.883    c-3.801-0.009-6.876-3.084-6.885-6.883c0.009-3.801,3.084-6.876,6.885-6.884c3.799,0.008,6.874,3.083,6.883,6.884    C25.874,22.799,22.799,25.874,19,25.883z"/>
                                                    <polygon style="" points="20,8 4,8 4,10 19,10 20,10   "/>
                                                    <polygon style=""
                                                             points="20.002,18 20.002,14 18,14 18,18 14,18 14,20 18,20 18,24 20.002,24 20.002,20 24,20     24,18   "/>
                                                </g>
                                            </g>
                                            </svg>
                    </button>

                    <button type="button" class="btn btn-outline-primary candidate-history {{ $read_only ? 'disabled' : '' }}"
                            data-user-id="{{ $user['id'] }}" data-candidate-id="{{ $args['id'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 448 448"
                             style="vertical-align: middle; margin-bottom: 3px;" data-toggle="tooltip"
                             data-placement="top" title="{!! trans('main.buttons_hint.candidate_app_history') !!}"
                             height="18px">
                            <g>
                                <g>
                                    <g>
                                        <path d="M255.893,32C149.76,32,64,117.973,64,224H0l83.093,83.093l1.493,3.093L170.667,224h-64     c0-82.453,66.88-149.333,149.333-149.333S405.333,141.547,405.333,224S338.453,373.333,256,373.333     c-41.28,0-78.507-16.853-105.493-43.84L120.32,359.68C154.987,394.453,202.88,416,255.893,416C362.027,416,448,330.027,448,224     S362.027,32,255.893,32z"/>
                                        <polygon
                                                points="234.667,138.667 234.667,245.333 325.973,299.52 341.333,273.6 266.667,229.333 266.667,138.667    "/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </button>

                    <button type="button" class="btn btn-outline-primary candidate-send-data {{ $read_only ? 'disabled' : '' }}"
                            data-user-id="{{ $user['id'] }}" data-candidate-id="{{ $args['id'] }}">
                        {{--data-toggle="modal" data-target="#send_candidate">--}}
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 511.998 511.998"
                             style="vertical-align: middle; margin-bottom: 3px;" height="18px" xml:space="preserve"
                             data-toggle="tooltip" data-placement="top"
                             title="{!! trans('main.buttons_hint.manage_in_locations') !!}">
                                            <g>
                                                <g>
                                                    <path d="M506.256,163.568L376.963,34.918c-5.588-5.562-13.97-7.212-21.234-4.184c-7.277,3.021-12.014,10.123-12.014,17.998v58.399    c-64.097,4.236-96.104,30.811-101.887,36.106c-80.432,66.943-71.537,158.226-68.834,176.387c0.039,0.26,0.078,0.526,0.123,0.786    l2.599,14.944c1.397,8.031,7.628,14.34,15.633,15.828c1.195,0.221,2.391,0.331,3.574,0.331c6.764,0,13.151-3.522,16.711-9.467    l7.79-12.982c42.584-70.822,95.207-82.225,124.29-82.323v60.589c0,7.894,4.763,15.003,12.066,18.017    c7.303,3.008,15.691,1.319,21.253-4.269L506.328,191.13C513.917,183.502,513.884,171.157,506.256,163.568z M382.707,260.1v-31.389    c0-9.571-6.939-17.725-16.387-19.245c-22.494-3.619-93.291-7.979-154.432,63.376c3.944-29.122,16.991-68.262,55.248-99.938    c0.468-0.39,0.63-0.52,1.059-0.949c0.286-0.266,29.356-26.412,93.063-26.412h1.949c10.766,0,19.492-8.726,19.492-19.492V95.624    l82.245,81.823L382.707,260.1z"/>
                                                </g>
                                            </g>
                            <g>
                                <g>
                                    <path d="M435.33,369.056c-10.766,0-19.492,8.726-19.492,19.492v55.228H38.985V157.889h116.954    c10.766,0,19.492-8.726,19.492-19.492s-8.726-19.492-19.492-19.492H19.492C8.726,118.904,0,127.63,0,138.396v324.873    c0,10.766,8.726,19.492,19.492,19.492H435.33c10.766,0,19.492-8.726,19.492-19.492v-74.721    C454.822,377.782,446.096,369.056,435.33,369.056z"/>
                                </g>
                            </g>
                        </svg>
                    </button>

                    <button type="button"
                            class="btn dropdown-toggle btn-outline-primary border-top-right-0 border-bottom-right-0"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg height="18px" viewBox="0 0 1792 1792" width="20px"
                             xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-bottom: 3px;"
                             data-toggle="tooltip" data-placement="top"
                             title="{!! trans('main.buttons_hint.move_to_pipeline') !!}">
                            <path d="M1216 1568v192q0 14-9 23t-23 9h-256q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h256q14 0 23 9t9 23zm-480-128q0 12-10 24l-319 319q-10 9-23 9-12 0-23-9l-320-320q-15-16-7-35 8-20 30-20h192v-1376q0-14 9-23t23-9h192q14 0 23 9t9 23v1376h192q14 0 23 9t9 23zm672-384v192q0 14-9 23t-23 9h-448q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h448q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-640q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h640q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-832q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h832q14 0 23 9t9 23z"/>
                        </svg>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        @foreach($pipelines as $pipeline)
                            <?php
                            $candidate_item_pipeline = $pipeline['type'];

                            if (!$pipeline['type'] || $pipeline['type'] == 'custom') {
                                $candidate_item_pipeline = $pipeline['id'];
                            }
                            ?>
                            <button data-user-id="{{ $user['id'] }}" data-candidate-id="{{ $args['id'] }}" class="dropdown-item candidate-pipeline-move"
                                    type="button" role='button'
                                    data-type="{{ $candidate_item_pipeline }}">
                                @if ($args['pipeline'] == $candidate_item_pipeline)
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 406.834 406.834"
                                         style="enable-background:new 0 0 406.834 406.834;" xml:space="preserve"
                                         width="14px"
                                         height="14px">
                                                <polygon
                                                        points="385.621,62.507 146.225,301.901 21.213,176.891 0,198.104 146.225,344.327 406.834,83.72 "/>
                                                </svg>
                                @endif
                                {{ $pipeline['name'] }}
                            </button>
                        @endforeach
                    </div>
                </div>
{{--                <p class="mb-0 text-right"><label>{!! trans('main.resume_updated', ['days' => $user_days]) !!}</label></p>--}}
            </div>
                <div class="float-right mr-3 pt-1 candidate-applied-info" style="color:#4E5C6E;">
                    @if($general_application)
                        <p class="mb-0 text-right"><label><strong>{!! $job_title !!}</strong></label></p>
                    @else
                        <p class="mb-0 text-right"><label><strong>{!! trans('main.applied_to', ['job' => $job_title]) !!}</strong></label></p>
                    @endif

                        <p class="mb-0" style="font-size: 14px;">
                            <span class="item-location-flag bfh-flag-{{ $applied_to_country_code }}"><i class="glyphicon"></i> </span>
                            {!! $applied_to !!}
                        </p>

                    <label class="text-right" style="font-size: 13px;">{{ $days }}</label>

{{--                    <p class="mb-0 text-right"><label>{!! trans('main.resume_updated', ['days' => $user_days]) !!}</label></p>--}}
                </div>
            @else
                <div class="float-right mr-3 pt-1 candidate-applied-info--" style="color:#4E5C6E;">
                    @if($general_application)
                        <p class="mb-0 text-right"><label><strong>{!! $job_title !!}</strong></label></p>
                    @else
                        <p class="mb-0 text-right"><label><strong>{!! trans('main.applied_to', ['job' => $job_title]) !!}</strong></label></p>
                    @endif


                    <label class="text-right" style="font-size: 13px;">{{ $days }}</label>

{{--                    <p class="mb-0 text-right"><label>{!! trans('main.resume_updated', ['days' => $user_days]) !!}</label></p>--}}
                </div>
            @endif



        </h5>
    </div>

    @if($access && ($access_tag != "free"))
    <div id="collapse{{ $args['id'] }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $args['id'] }}" data-parent="#accordion">
        <div class="card-body pt-0">
            <div class="col-12 px-0">

                <div class="d-flex-">
                    <p class="MarksBeautifulFontColor mb-0">
                                                <span>
                                                    <strong style="font-size: 16px;">
                                                        {{ $user['basic']['headline'] }}
                                                    </strong>
                                                    <span class="ml-5">{{ $user['email'] }}</span>
                                                </span>
                    </p>
                    <div class="ml-5 mt-1" style="color:#4E5C6E;">
                        <p class="mb-0"><label>{!! trans('main.resume_updated', ['days' => $user_days]) !!}</label></p>
                    </div>
                </div>
                <div class="pt-2">
                    <p class="coll_title">{{ $user['basic']['about'] }}</p>
                </div>

            </div>
        </div>
    </div>
    @endif
</div>

