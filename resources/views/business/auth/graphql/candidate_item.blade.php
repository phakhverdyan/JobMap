<!-- ONE LOCATION BEGIN -->
@php
    if (empty($args['user']['first_name']) && empty($args['user']['last_name'])) {
        $fullName = $args['user']['email'];
    } else {
        $fullName = $args['user']['first_name'] . ' ' . $args['user']['last_name'];
    }
@endphp

<div class="card border-0 candidate-card" data-id="{{ $args['user_id'] }}" data-candidate-id="{{ $args['id'] }}" clicked-on="{{ $args['business_clicked_on'] ? '1' : '0' }}">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
            <a class="collapsed Bobik" data-toggle="collapse" href="#collapse{{ $args['id'] }}" aria-expanded="true"
               aria-controls="collapse{{ $args['id'] }}"
               style="font-size: 16px; color: #4E5C6E;">
                <div class="d-lg-inline-flex d-flex flex-column flex-lg-row">
                    <div class="text-center text-lg-left mb-3">
                        <div {!! $filters !!} style="width: 60px; border-radius: 5px; overflow: hidden; margin:0 auto;">
                            <img class="mr-3 mxa-0 candidate-picture" src="{{ $user_picture }}"
                                 style="width: 60px; height: 60px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                        </div>
                        @if($picture)
                            <img class="business-logo-medium rounded" src="{{ $picture }}"
                                 style="width: 20px; height: 20px; background-color: #fff;">
                        @endif
                    </div>
                    <div class="text-center text-lg-left mxa-0" style="margin-left: 20px">
                        <div class="mb-1 d-flex flex-column flex-lg-row">
                            <p class="mb-0" data-candidate_id="{{ $args['user']['id'] }}">
                                <strong class="candidate-name">{{ $fullName }}</strong>
                                @if ($notes_rating['rating'] >0)
                                    <span class="ml-3 candidate-rating {{ $notes_rating['class_color'] }}">{{ $notes_rating['rating'] }}/10</span>
                                @endif

                                <button type="button" class="btn btn-outline-success [ candidate-overview ] btn-sm ml-3" data-id="{{ $args['id'] }}">
                                    <span>
                                        {!! trans('main.buttons.resume_overview') !!}
                                    </span>
                                </button>

                                @if ($candidate_import)
                                    <button type="button" class="btn btn-outline-warning btn-sm candidate_edit-show-form" data-id="{{ $args['id'] }}" style="cursor:pointer;" data-toggle="modal" data-target="#editCandidate" data-dismiss="modal">
                                        <span>
                                          {!! trans('main.buttons.edit_candidate') !!}
                                      </span>
                                    </button>
                                    <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm {{ $read_only ? 'disabled' : '' }}" data-user-id="{{ $args['user_id'] }}">
                                        <span>{!! trans('main.buttons.interview') !!}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm  [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                                        {!! trans('main.buttons.update') !!}
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}">
                                        {!! trans('main.buttons_hint.message') !!}
                                    </button>
                                @else
                                    <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm {{ $read_only ? 'disabled' : '' }}" data-user-id="{{ $args['user_id'] }}">
                                        <span>{!! trans('main.buttons.interview') !!}</span>
                                    </button>
                                    <button type="button" class="btn btn-outline-danger btn-sm  [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                                        {!! trans('main.buttons.update') !!}
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}">
                                        {!! trans('main.buttons_hint.message') !!}
                                    </button>
                                @endif

                                @if(!empty($user_video))
{{--                                    <button type="button" class="btn btn-outline-new btn-sm  [ candidate-video ] " data-user-video="{{$user_video}}" data-id="{{ $args['user']['id'] }}">--}}
{{--                                        Video--}}
{{--                                    </button>--}}

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
                                <span class="item-location-flag bfh-flag-{{ $args['user']['country_code'] }}"><i
                                            class="glyphicon"></i> </span>
                                {{ $location_user }}
                            </p>
                        @endif

                            <span><small>{!! trans('main.last_applied_to', ['location' => $applied_to])!!}</small></span>

                        <?php
                            $str = '';
                            if ($args['user']['preference']['looking_job'] == 'yes') {
                                $str = trans('sidebar.checkbox.looking_for_a_job_now');
                                if ($args['user']['preference']['its_urgent'] == 'yes') {
                                    $str .= ', ' . trans('sidebar.checkbox.its_urgent');
                                }
                            } else {
                                $str .= trans('sidebar.checkbox.open_to_new_opportunities');
                            }
                            /*if ($args['user']['preference']['new_job'] == 'yes') {
                                if (strlen($str) > 0) {
                                    $str .= ', ';
                                }
                                $str .= trans('sidebar.checkbox.open_to_new_opportunities');
                            }*/
                        ?>
                        @if (strlen($str) > 0)
                            <br>
                            <span><small style="text-decoration: underline;">{!! $str !!}</small></span>
                        @endif
                    </div>
                </div>
            </a>

            {{--@if (empty($download_resume))--}}
               {{--  <button type="button" class="btn btn-outline-success [ candidate-overview ] btn-sm ml-3" data-id="{{ $args['id'] }}">
                    <span>
                        {!! trans('main.buttons.resume_overview') !!}
                    </span>
                </button> --}}

           {{-- @else
                <a href="{{ $download_resume }}" type="button" download class="btn btn-primary btn-sm ml-3">
                    <span>
                        {!! trans('main.buttons.download_resume') !!}
                    </span>
                </a>
            @endif--}}
{{--             @if ($candidate_import)
                <button type="button" class="btn btn-outline-warning btn-sm candidate_edit-show-form" data-id="{{ $args['id'] }}" style="cursor:pointer;" data-toggle="modal" data-target="#editCandidate" data-dismiss="modal">
                    <span>
                      {!! trans('main.buttons.edit_candidate') !!}
                  </span>
                </button>
                <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm {{ $read_only ? 'disabled' : '' }}" data-user-id="{{ $args['user_id'] }}">
                    <span>{!! trans('main.buttons.interview') !!}</span>
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm  [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                    {!! trans('main.buttons.update') !!}
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}">
                    {!! trans('main.buttons_hint.message') !!}
                </button>
            @else
                <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm {{ $read_only ? 'disabled' : '' }}" data-user-id="{{ $args['user_id'] }}">
                    <span>{!! trans('main.buttons.interview') !!}</span>
                </button>
                <button type="button" class="btn btn-outline-danger btn-sm  [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                    {!! trans('main.buttons.update') !!}
                </button>
                <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}" data-id="{{ $args['user']['id'] }}">
                    {!! trans('main.buttons_hint.message') !!}
                </button>
            @endif --}}
            <div class="btn-group float-right mr-3 pt-2 [ candidate-tools ] hide mxa-0 d-block mb-1" role="group">
                <div class="btn-group float-right flex-column flex-md-row w-100" role="group" aria-label="Basic example">

                    {{--<button type="button" class="[ candidate__interview ] btn btn-outline-primary {{ $read_only ? 'disabled' : '' }}" data-user-id="{{ $args['user_id'] }}">
                        <span>{!! trans('main.buttons.interview') !!}</span>
                    </button>--}}

                    {{--<button type="button" class="btn btn-outline-primary [ candidate-resume-update ] {{ $read_only ? 'disabled' : '' }}"
                            data-id="{{ $args['user']['id'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" width="20px" height="18px" viewBox="0 0 487.23 487.23"
                             style="enable-background:new 0 0 487.23 487.23; vertical-align: middle; margin-bottom: 3px;"
                             xml:space="preserve" data-toggle="tooltip" data-placement="top"
                             title="{!! trans('main.buttons_hint.ask_update') !!}">
                            <g>
                                <g>
                                    <path d="M55.323,203.641c15.664,0,29.813-9.405,35.872-23.854c25.017-59.604,83.842-101.61,152.42-101.61    c37.797,0,72.449,12.955,100.23,34.442l-21.775,3.371c-7.438,1.153-13.224,7.054-14.232,14.512    c-1.01,7.454,3.008,14.686,9.867,17.768l119.746,53.872c5.249,2.357,11.33,1.904,16.168-1.205    c4.83-3.114,7.764-8.458,7.796-14.208l0.621-131.943c0.042-7.506-4.851-14.144-12.024-16.332    c-7.185-2.188-14.947,0.589-19.104,6.837l-16.505,24.805C370.398,26.778,310.1,0,243.615,0C142.806,0,56.133,61.562,19.167,149.06    c-5.134,12.128-3.84,26.015,3.429,36.987C29.865,197.023,42.152,203.641,55.323,203.641z"/>
                                    <path d="M464.635,301.184c-7.27-10.977-19.558-17.594-32.728-17.594c-15.664,0-29.813,9.405-35.872,23.854    c-25.018,59.604-83.843,101.61-152.42,101.61c-37.798,0-72.45-12.955-100.232-34.442l21.776-3.369    c7.437-1.153,13.223-7.055,14.233-14.514c1.009-7.453-3.008-14.686-9.867-17.768L49.779,285.089    c-5.25-2.356-11.33-1.905-16.169,1.205c-4.829,3.114-7.764,8.458-7.795,14.207l-0.622,131.943    c-0.042,7.506,4.85,14.144,12.024,16.332c7.185,2.188,14.948-0.59,19.104-6.839l16.505-24.805    c44.004,43.32,104.303,70.098,170.788,70.098c100.811,0,187.481-61.561,224.446-149.059    C473.197,326.043,471.903,312.157,464.635,301.184z"/>
                                </g>
                            </g>
                        </svg>
                    </button>--}}

                    {{--<button type="button" class="btn btn-outline-primary [ candidate-send-message ] {{ $read_only ? 'disabled' : '' }}"
                            data-id="{{ $args['user']['id'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 14 14"
                             style="enable-background:new 0 0 14 14; vertical-align: middle; margin-bottom: 3px;"
                             xml:space="preserve" width="20px" height="18px" data-toggle="tooltip" data-placement="top"
                             title="{!! trans('main.buttons_hint.message') !!}">
                                            <g>
                                                <g>
                                                    <path style=""
                                                          d="M7,9L5.268,7.484l-4.952,4.245C0.496,11.896,0.739,12,1.007,12h11.986    c0.267,0,0.509-0.104,0.688-0.271L8.732,7.484L7,9z"/>
                                                    <path style=""
                                                          d="M13.684,2.271C13.504,2.103,13.262,2,12.993,2H1.007C0.74,2,0.498,2.104,0.318,2.273L7,8    L13.684,2.271z"/>
                                                    <polygon style="" points="0,2.878 0,11.186 4.833,7.079   "/>
                                                    <polygon style="" points="9.167,7.079 14,11.186 14,2.875   "/>
                                                </g>
                                            </g>
                                            </svg>
                    </button>--}}


                    {{-- <button type="button" class="btn btn-outline-primary candidate-job_questions"
                            data-user_id="{{ $args['user']['id'] }}" data-job_id="{{ $args['job_id'] }}"
                            data-toggle="modal"
                            data-target="#questionnaireModalResult">
                            @svg('/img/questionnaire.svg', [
                               'width' => '20px',
                               'height' => '18px',
                               'style' => 'vertical-align: middle; margin-bottom: 3px;',
                               'data-toggle' => 'tooltip',
                               'title' => 'Questionnaire',
                            ])
                    </button> --}}

                    <button type="button" class="btn btn-outline-primary candidate-notes"
                            data-id="{{ $args['user']['id'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28"
                             style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                             xml:space="preserve" width="20px" height="18px" data-toggle="tooltip" data-placement="top"
                             title="{!! trans('main.buttons_hint.candidate_notes') !!}">
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

                    {{--<button type="button" class="btn btn-outline-primary candidate-viewed"
                            data-id="{{ $args['user']['id'] }}">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                 id="Capa_1" x="0px" y="0px" viewBox="0 0 511.999 511.999"
                                 style="vertical-align: middle; margin-bottom: 3px;" height="18px"
                                 xml:space="preserve" data-toggle="tooltip" data-placement="top"
                                 title="{!! trans('main.buttons_hint.visit_history') !!}">
                                <g>
                                    <g>
                                        <path d="M508.745,246.041c-4.574-6.257-113.557-153.206-252.748-153.206S7.818,239.784,3.249,246.035    c-4.332,5.936-4.332,13.987,0,19.923c4.569,6.257,113.557,153.206,252.748,153.206s248.174-146.95,252.748-153.201    C513.083,260.028,513.083,251.971,508.745,246.041z M255.997,385.406c-102.529,0-191.33-97.533-217.617-129.418    c26.253-31.913,114.868-129.395,217.617-129.395c102.524,0,191.319,97.516,217.617,129.418    C447.361,287.923,358.746,385.406,255.997,385.406z"/>
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M255.997,154.725c-55.842,0-101.275,45.433-101.275,101.275s45.433,101.275,101.275,101.275    s101.275-45.433,101.275-101.275S311.839,154.725,255.997,154.725z M255.997,323.516c-37.23,0-67.516-30.287-67.516-67.516    s30.287-67.516,67.516-67.516s67.516,30.287,67.516,67.516S293.227,323.516,255.997,323.516z"/>
                                    </g>
                                </g>
                            </svg>
                            <span class="candidate-viewed-count"></span>
                        </span>
                    </button>--}}

                    <button type="button" class="btn btn-outline-primary candidate-history {{ $read_only ? 'disabled' : '' }}"
                            data-id="{{ $args['user']['id'] }}">
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


                    {{-- <button type="button" class="btn btn-outline-primary [ candidate-pin-to-top ] {{ $read_only ? 'disabled' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                             xml:space="preserve" width="20px" height="18px" data-toggle="tooltip" data-placement="top"
                             title="{!! trans('main.buttons_hint.to_top_in_pipeline') !!}">
                                            <g>
                                                <g>
                                                    <path d="M490.067,71.643l-49.709-49.709c-29.245-29.246-76.829-29.244-106.072,0c-5.858,5.858-5.858,15.356,0,21.214    l14.247,14.247l-76.525,76.525c-46.641-22.182-110.66-16.618-154.116,26.836l-21.212,21.212c-5.858,5.858-5.858,15.356,0,21.214    l77.94,77.941L3.458,487.421c-4.949,5.964-4.539,14.717,0.944,20.193c5.457,5.448,14.208,5.898,20.194,0.917l206.016-171.415    l78.205,78.205c2.929,2.929,6.768,4.394,10.607,4.394c3.838,0,7.679-1.464,10.607-4.394l21.21-21.21    c42.328-42.329,49.941-104.538,26.414-153.694l76.949-76.949l14.248,14.248c5.854,5.855,15.358,5.857,21.214,0    C519.31,148.471,519.31,100.888,490.067,71.643z M130.236,381.605l65.69-79.175l13.383,13.383L130.236,381.605z M330.028,372.897    l-10.604,10.603L205.61,269.685c-0.006-0.006-0.011-0.011-0.017-0.017l-77.091-77.091l10.605-10.606    c39.042-39.04,105.088-43.413,147.792-0.707l43.13,43.13C370.936,265.301,371.173,331.752,330.028,372.897z M361.268,214.378    c-3.115-3.884-6.453-7.627-10.025-11.198l-43.13-43.13c-3.386-3.386-6.84-6.534-10.352-9.454l71.985-71.987l63.644,63.644    L361.268,214.378z M477.643,144.076L367.925,34.359c16.728-7.971,37.391-5.038,51.22,8.79l49.709,49.709    C482.682,106.688,485.613,127.351,477.643,144.076z"/>
                                                </g>
                                            </g>
                                            </svg>
                    </button> --}}

                    <button type="button" class="btn btn-outline-primary candidate-send-data {{ $read_only ? 'disabled' : '' }}"
                            data-id="{{ $args['user']['id'] }}">
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
                            <button data-id="{{ $args['user_id'] }}" class="dropdown-item candidate-pipeline-move"
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
                <p class="mb-0 text-right"><label>{!! trans('main.resume_updated', ['days' => $user_days]) !!}</label></p>
            </div>


            <div class="float-right mr-3 pt-1 candidate-applied-info" style="color:#4E5C6E;">
                <p class="mb-0 text-right"><label>{!! trans('main.applied_to', ['job' => $job]) !!}</label></p>
                <label class="text-right" style="font-size: 13px;">{{ $days }}</label>
                <p class="mb-0 text-right"><label>{!! trans('main.resume_updated', ['days' => $user_days]) !!}</label></p>
            </div>

        </h5>
    </div>

    <div id="collapse{{ $args['id'] }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $args['id'] }}"
         data-parent="#accordion">
        <div class="card-body pt-0">
            <div class="col-12 px-0">

                <div class="d-flex">
                    <p class="MarksBeautifulFontColor mb-0">
                                                <span>
                                                    <strong style="font-size: 16px;">
                                                        {{ $args['user']['basic']['headline'] }}
                                                    </strong>
                                                    <span class="ml-5">{{ $args['user']['email'] }}</span>
                                                </span>
                    </p>
                </div>
                <div class="pt-2">
                    <p class="coll_title">{{ $args['user']['basic']['about'] }}</p>
                </div>

            </div>
        </div>
    </div>
</div>

<hr class="my-0">
