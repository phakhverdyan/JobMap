<style type="text/css">
    .nav-side-menu {
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>

<!-- sidebar -->
<div class="nav-side-menu">
    <div class="menu-list">

        <ul id="menu-content" class="menu-content collapse out mt-0" style="padding-top: 30px;">
            <li class="switcher-to-business-block relative disabled-hover min-hide">
                <div class="d-flex justify-content-between mb-0 px-3" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border: 1px solid rgba(78,92,110,.1); background-color: #f4f4f4;">
                    <div class="business_switch" style="opacity: 0.7; cursor: pointer;">
                        {!! trans('sidebar.text.now_in_employer_mode') !!}
                    </div>
                    <button type="button" class="btn btn-sm business_switch_caret" aria-haspopup="true" aria-expanded="false"  style="background-color: transparent;">
                      <span class="carrot" style="vertical-align: middle;"></span>
                    </button>
                    <div class="switcher_to_business business-list-outclick bg-white rounded border-top-right-0">
                        <div class="mt-3 px-1">
                            <a href="javascript:void(0)" class="btn btn-success switch-to-user text-center profile-switcher btn btn-sm clear-mg px-1 text-left" title="" data-original-title="View your user menu" style="border-radius: 5px; font-weight: lighter;">
                                <i class="fa fa-refresh" aria-hidden="true" style="padding: 4px 5px;"></i>
                                {!! trans('sidebar.text.switch_to_job_seeker') !!}
                            </a>
                        </div>
                        <hr>
                        <div style="" class="business-list ">
                            <div class="text-center show-yes-businesses">
                                <a class="profile-switcher btn btn-primary ml-0 mx-auto mb-3 mt-2 business-link__create_new" href="{!! url('/business/signup') !!}" role="button" style="width: auto;">
                                    <!-- <i class="fa fa-plus" aria-hidden="true" style="padding: 0 5px;"></i> -->
                                    <svg id="Layer_1" width="25px" height="25px" style="enable-background:new 0 0 512 512; float: left; margin-right: 5px;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z" fill="#ffffff"></path>
                                                </g>
                                            </g>
                                            <g>
                                                <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9" fill="#ffffff"></polygon>
                                            </g>
                                        </g>
                                    </svg>
                                    {!! trans('sidebar.text.create_new_business') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- -->
            </li>
            <div class="min-hide menu-buss" style="margin: 50px 0 50px 0;">
                <div class="d-flex">
                    <div>
                        <img src="{{ asset('img/business-logo-small.png') }}"
                             class="rounded business-logo menu-business-picture mt-0 ml-3" id=""
                             style="position: relative;"/>
                    </div>
                    <div class="ml-3 align-self-center" style="line-height: 1.5;">
                        {!! trans('sidebar.text.managing') !!}
                        <span class="menu-business-name" style="font-weight: 700;"></span>
                    </div>
                </div>

                <div class="d-flex mt-3">
                    <div class="ml-3 rounded" style="overflow: hidden; width: 35px; height: 35px;">
                      <div>
                          <img src="{{ asset('img/profilepic2.png') }}" class="rounded menu-userpic" id=""
                               style="position: relative; width: 35px; height: 35px; z-index: 1; top:-1px;"/>
                      </div>
                    </div>
                    @if (\App\Business\Administrator::where('user_id', Auth::user()->id)->where('role', 'admin')->first())

                    <div class="ml-3">
                        <a href="{!! url('/user/resume/create?tab=basic') !!}">
                            <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32"
                                 width="16px" height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                                 style="fill:rgba(6,70,166,0.2)!important; vertical-align: middle;"><g id="background">
                                    <rect fill="none" height="32" width="32"></rect>
                                </g>
                                <g id="edit">
                                    <polygon points="10,28 4,28 4,22  "></polygon>
                                    <rect height="8.485"
                                          transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)"
                                          width="28.284" x="4.858" y="8.757"></rect>
                                    <polygon points="4,32 4,30 26,30 26,32 4,32  "></polygon>
                                </g>
                            </svg>
                        </a>
                    </div>
                    @endif
                    <div class="ml-3" style="line-height: 1.5;">
                        <p class="mb-0">
                            {!! trans('sidebar.text.signed') !!}<span class="menu-firstname" style="font-weight: 700;"></span>
                        </p>
                        <p class="mb-0">
                            <span class="menu-username" style="font-size: 13px; opacity: 0.6;"></span>
                            <a class="menu-profile-link" href="{{ config('app.url').'/u/' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" height="16" viewBox="0 0 48 48" width="16"
                                     style="vertical-align: middle; fill:#4E5C6E;" data-toggle="tooltip"
                                     title="{!! trans('sidebar.text.view_profile') !!}" class="svg_hover">
                                    <path d="M0 0h48v48h-48z" fill="none"/>
                                    <path d="M38 38h-28v-28h14v-4h-14c-2.21 0-4 1.79-4 4v28c0 2.21 1.79 4 4 4h28c2.21 0 4-1.79 4-4v-14h-4v14zm-10-32v4h7.17l-19.66 19.66 2.83 2.83 19.66-19.66v7.17h4v-14h-14z"/>
                                </svg>
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="btn-group col-12 px-0 formQuickApplImport min-hide" role="group" aria-label="Basic example" style="margin-bottom: 30px;">
                <div class="input-group form-control py-1 d-flex border-top-right-0 border-bottom-right-0 rounded-0"
                     style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border: 1px solid rgba(78,92,110,.1);">
                    <p class="my-0 mr-2 pt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 382.117 382.117"
                             style="enable-background:new 0 0 382.117 382.117; vertical-align: middle;  fill:#555;"
                             xml:space="preserve" width="15px" height="15px" class="mx-2">
                             <path d="M336.764,45.945H45.354C20.346,45.945,0,65.484,0,89.5v203.117c0,24.016,20.346,43.555,45.354,43.555h291.41  c25.008,0,45.353-19.539,45.353-43.555V89.5C382.117,65.484,361.772,45.945,336.764,45.945z M336.764,297.72H45.354  c-3.676,0-6.9-2.384-6.9-5.103V116.359l131.797,111.27c2.702,2.282,6.138,3.538,9.676,3.538l22.259,0.001  c3.536,0,6.974-1.257,9.677-3.539l131.803-111.274v176.264C343.664,295.336,340.439,297.72,336.764,297.72z M191.059,192.987  L62.87,84.397h256.378L191.059,192.987z"/>
                        </svg>
                    </p>
                    <div class="d-flex flex-column w-100" style="font-size: 14px">
                        <input type="text" class="border-0 js-import_email" name="email" autocomplete="off"
                               placeholder="{!! trans('sidebar.text.enter_email') !!}"
                               style="box-shadow: none; height: 30px;/* margin-top: 3px;*/">
                    </div>
                </div>

                <button class="btn btn-outline-primary mx-0 js-submit_email" type="button"
                        style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                         id="Layer_1" x="0px" y="0px" viewBox="0 0 512.297 512.297"
                         style="enable-background:new 0 0 512.297 512.297;  vertical-align: middle; margin-top: -5px;"
                         xml:space="preserve" width="20px" height="20px">
                            <g>
                                <g>
                                    <path d="M506.049,230.4l-192-192c-13.439-13.439-36.418-3.921-36.418,15.085v85.431    c-122.191,5.079-229.968,88.278-264.124,206.683C2.101,385.123-0.745,417.65,0.154,452.659c0.113,4.11,0.142,5.296,0.142,6.159    c0,21.677,28.579,29.538,39.666,10.911c23.767-39.933,50.761-70.791,80.333-93.599c53.462-41.233,109.122-53.174,157.335-48.352    v109.707c0,19.006,22.979,28.524,36.418,15.085l192-192C514.38,252.239,514.38,238.731,506.049,230.4z M320.297,385.982v-76.497    c0-9.773-6.641-18.296-16.117-20.686c-2.596-0.655-6.908-1.513-12.758-2.331c-60.43-8.455-130.633,4.548-197.184,55.876    c-16.371,12.626-31.961,27.299-46.688,44.105l0.326-1.708c1.701-8.759,3.879-17.804,6.624-27.315    c30.45-105.558,130.034-178.409,240.312-176.032c1.864,0.033,2.552,0.048,3.415,0.078c12.063,0.416,22.069-9.25,22.069-21.321    v-55.163l140.497,140.497L320.297,385.982z"></path>
                                </g>
                            </g>
                        </svg>
                </button>
            </div>

            {{--<li>
                <a href="{!! url('/business/dashboard') !!}">
                    <span style="padding-left: 11px; padding-right: 20px;">
                      @svg('/img/sidebar/dashboard.svg', [
                      ])
                    </span>
                    <span>{!! trans('sidebar.menu.dashboard') !!}</span>
                </a>
            </li>--}}

{{--            <p class="mb-0 pl-3 py-3 collapse_candidates">--}}
{{--                <span style="padding-left: 11px; padding-right: 20px;">--}}
{{--                   @svg('/img/sidebar/candidates.svg', [--}}
{{--                       'width' => '20px',--}}
{{--                       'height' => '20px',--}}
{{--                       'style' => 'vertical-align: middle;',--}}
{{--                      ])--}}
{{--                </span>--}}
{{--                <span style="font-weight: 500;">{!! trans('sidebar.menu.candidates') !!}</span>--}}
{{--                <span class="float-right plus_icon toggle_arrow mt-0"></span>--}}
{{--            </p>--}}

{{--            <div class="candidates_menu advanced_menu">--}}
{{--              --}}
{{--            </div>--}}

            <li>
                <a  href="#"
                    id="business-candidate-manage-link"
                    data-href="{!! url('/business/candidate/manage').'?p=new' !!}" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.applicants') !!}">
                    <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/manage_candidate.svg', [
                        ])
                    </span>
                    <span class="min-hide">{!! trans('sidebar.menu.applicants') !!}</span>
                    <span class="notification countApplicantsNew hide min-hide" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">0</span>
                    {{--<span class="countApplicantsTotal ml-2 px-1 rounded" style="background: rgb(0, 0, 0, 0.05); display: none;"></span>--}}
                </a>
                {{-- <span class="notification animated countApplicantsNew" style="display: none"></span> --}}
            </li>
            <li class="relative">
                <a href="{!! url('/business/interviews') !!}" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.interviews') !!}">
                      <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/interviews.svg', [
                        ])
                      </span>
                    <span class="min-hide">{!! trans('sidebar.menu.interviews') !!}</span>
                </a>
                <span class="notification realtime__count-of-upcoming-interviews min-hide hide" style="background-color: #28a745;"></span>
            </li>
            <li class="relative">
                <a href="{!! url('/business/messages') !!}">
                      <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/messages.svg', [
                        ])
                      </span>
                    <span class="min-hide">{!! trans('sidebar.menu.messages') !!}</span>
                    <span style="position: relative; border-left: 0;" class="global-chat-typing min-hide">
                        <span class="[ chat-typing-icon ] " style="position: absolute; top: -3px; left: 25px; display: inline-block; font-size: 5px;"></span>
                      </span>
                </a>
                <span class="notification hide realtime__total-count-of-unread-chats-with-unread-messages min-hide">...</span>
            </li>

{{--            <p class="mb-0 pl-3 py-3 collapse_career">--}}
{{--                <span style="padding-left: 11px; padding-right: 20px;">--}}
{{--                   @svg('/img/sidebar/career.svg', [--}}
{{--                       'width' => '20px',--}}
{{--                       'height' => '20px',--}}
{{--                       'style' => 'vertical-align: middle;',--}}
{{--                      ])--}}
{{--                </span>--}}
{{--                <span style="font-weight: 500;">{!! trans('sidebar.menu.manage_career_page') !!}</span>--}}
{{--                <span class="float-right plus_icon toggle_arrow collapsed mt-0"></span>--}}
{{--            </p>--}}

{{--            <div class="career_menu advanced_menu" style="display: none;">--}}

{{--              --}}
{{--            </div>--}}

            @if (is_permit_administrator(['career_page']))
                <li>
                    <a href="{!! url('/business/profile/edit') !!}">
                          <span style="padding-left: 10px; padding-right: 20px;">
                            @svg('/img/sidebar/career_page.svg', [
                            ])
                          </span>
                        <span class="min-hide">{!! trans('sidebar.menu.career_page') !!}</span>
                    </a>
                </li>
            @endif
            @if (is_permit_administrator(['brands']))
                <li>
                    <a href="{!! url('business/brands') !!}">
                          <span style="padding-left: 10px; padding-right: 20px;">
                            @svg('/img/sidebar/brands.svg', [
                            ])
                          </span>
                        <span class="min-hide">{!! trans('sidebar.menu.brands') !!}</span>
                        <span class="countBrands ml-2 px-1 rounded min-hide hide" style="background: rgba(0, 0, 0, 0.05);"></span>
                    </a>
                </li>
            @endif

            @if (is_permit_administrator(['locations']))
                <li>
                    <a href="{!! url('/business/branch/locations') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/branch_locations.svg', [
                        ])
                      </span>
                        <span class="min-hide">{!! trans('sidebar.menu.locations') !!}</span>
                        <span class="countLocations ml-2 px-1 rounded min-hide hide" style="background: rgba(0, 0, 0, 0.05);"></span>
                    </a>
                </li>
            @endif

            <li>
                <a href="{!! url('/business/job/manage') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/jobs.svg', [
                        ])
                      </span>
                    <span class="min-hide">{!! trans('sidebar.menu.jobs') !!}</span>
                    <span class="countJobs ml-2 px-1 rounded min-hide hide" style="background: rgba(0, 0, 0, 0.05);"></span>
                </a>
            </li>
            @if (is_permit_administrator(['managers', 'franchisees']))
                <li>
                    <a href="{!! url('/business/manage/manager') !!}">
                          <span style="padding-left: 10px; padding-right: 20px;">
                            @svg('/img/sidebar/manage_manager.svg', [
                            ])
                          </span>
                        <span class="min-hide">{!! trans('sidebar.menu.billing') !!}</span>
                        <span class="countManagers ml-2 px-1 rounded min-hide hide" style="background: rgba(0, 0, 0, 0.05);"></span>
                    </a>
                </li>
            @endif
            <li>
                <a  href="#" id="business-widget-link"
                    data-href="{!! url('/business/widget/manager') !!}">
                <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->
                    <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/website_button.svg', [
                        ])
                      </span>
                    <span class="min-hide">Widget</span>
                    {{-- <span class="notification countIntegration- countIntegration-WebsiteButton" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span> --}}
                </a>
            </li>

            <li>
                <a  href="{!! url('/business/scanner') !!}">
                    <span style="padding-left: 10px; padding-right: 20px;">
                      @svg('/img/sidebar/settings.svg', [
                      ])
                    </span>
                    <span class="min-hide">{!! trans('sidebar.menu.scanner') !!}</span>
                </a>
            </li>

{{--            @if (is_permit_administrator(['connect_jobmap']))--}}
{{--            <p class="mb-0 pl-3 py-3 collapse_connect">--}}
{{--                <span style="padding-left: 11px; padding-right: 20px;">--}}
{{--                   @svg('/img/sidebar/connect.svg', [--}}
{{--                       'width' => '20px',--}}
{{--                       'height' => '20px',--}}
{{--                       'style' => 'vertical-align: middle;',--}}
{{--                      ])--}}
{{--                </span>--}}
{{--                <span style="font-weight: 500;">Connect JobMap</span>--}}
{{--                <span class="float-right plus_icon toggle_arrow collapsed mt-0"></span>--}}
{{--            </p>--}}

{{--            <div class="advanced_guides advanced_menu" style="display: none;">--}}
              {{--<li>
                  <a href="{!! url('/business/candidate/manage-ats') !!}" data-toggle="tooltip"
                     title="Import from Email, Excel, ATS, CSV">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/manager_ats.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.import') !!}</span>
                      <span class="notification countIntegration- countIntegration-ATSImport" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>
                  </a>
              </li>--}}
{{--              <li>--}}
{{--                  <a href="{!! url('/business/widget/manager') !!}">--}}
{{--                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->--}}
{{--                      <span style="padding-left: 8px; padding-right: 17px;">--}}
{{--                        @svg('/img/sidebar/website_button.svg', [--}}
{{--                        ])--}}
{{--                      </span>--}}
{{--                      <span>Widget</span>--}}
{{--                      --}}{{-- <span class="notification countIntegration- countIntegration-WebsiteButton" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span> --}}
{{--                  </a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                  <a href="{!! url('/business/email-forwarder') !!}">--}}
{{--                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->--}}
{{--                      <span style="padding-left: 8px; padding-right: 17px;">--}}
{{--                        @svg('/img/sidebar/email_forwarder.svg', [--}}
{{--                        ])--}}
{{--                      </span>--}}
{{--                      <span>{!! trans('sidebar.menu.email_forwarder') !!}</span>--}}
{{--                      --}}{{-- <span class="notification countIntegration- countIntegration-EmailForwarder" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span> --}}
{{--                  </a>--}}
{{--              </li>--}}
              {{--<li>
                  <a href="{!! url('/business/button/manager') !!}">
                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/website_button.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.website_button') !!}</span>
                      <span class="notification countIntegration- countIntegration-WebsiteButton" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>
                  </a>
              </li>
              <li>
                  <a href="{!! url('business/CR-link') !!}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/cr_link.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.cr_link') !!}</span>
                  </a>
              </li>
              <li>
                  <a href="{{ url('/') }}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/jobmap.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.jobmap') !!}</span>
                  </a>
              </li>--}}
              {{--<li>
                  <a href="{!! url('/business/CR-email') !!}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/cr_email.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.cr_email') !!}</span>
                      <span class="notification countIntegration- countIntegration-CREmail" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>
                  </a>
              </li>--}}
{{--            </div>--}}
{{--            @endif--}}



            <div class="min-hide btn-group col-12 px-0 formSendFeedback" role="group" aria-label="Basic example" style="margin: 30px 0;">
              <div class="input-group form-control py-1 d-flex border-top-right-0 border-bottom-right-0 rounded-0"
                   style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border: 1px solid rgba(78,92,110,.1);">
                  <p class="my-0 mr-2 pt-1">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                           id="Capa_1" x="0px" y="0px" viewBox="0 0 513.52 513.52"
                           style="enable-background:new 0 0 512.001 512.001; fill:#7b7b7b; vertical-align: middle;"
                           xml:space="preserve" width="20px" height="20px">
                        <g>
                            <g>
                                <g>
                                    <path d="M421.88,0L192.52,229.408L162.36,350.08l120.688-30.16L417.08,185.872V383.36h-224v61.84l-74.208-61.84H33.08v-288h128     v-32h-160v352h106.208l117.792,98.16v-98.16h224V153.872l63.36-63.312L421.88,0z M206.328,306.096l9.312-37.216l27.92,27.92     L206.328,306.096z M274.856,282.848l-45.248-45.264L376.68,90.56l45.2,45.2L274.856,282.848z M444.568,113.136l-45.264-45.248     l22.576-22.64l45.312,45.312L444.568,113.136z"></path>
                                    <rect x="65.08" y="127.36" width="160" height="32"></rect>
                                    <rect x="65.08" y="191.36" width="96" height="32"></rect>
                                    <rect x="65.08" y="255.36" width="64" height="32"></rect>
                                    <rect x="65.08" y="319.36" width="64" height="32"></rect>
                                    <rect x="257.08" y="63.36" width="32" height="32"></rect>
                                    <rect x="193.08" y="63.36" width="32" height="32"></rect>
                                </g>
                            </g>
                        </g>
                      </svg>
                  </p>
                  <div class="d-flex flex-column w-100" style="font-size: 14px">
                      <textarea type="text" name="message" class="border-0 inputSendFeedback"
                                style="resize: none; box-shadow: none; height: 36px;"
                                placeholder="{!! trans('sidebar.text.feedback') !!}"></textarea>
                  </div>
              </div>

              <a class="btn btn-outline-primary mr-0 d-flex align-items-center btnSendFeedback rounded-0" role="button">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                       id="Capa_1" x="0px" y="0px" viewBox="0 0 487.958 487.958"
                       style="enable-background:new 0 0 487.958 487.958;" xml:space="preserve" width="15px" height="15px">
                      <g>
                          <path d="M483.058,215.613l-215.5-177.6c-4-3.3-9.6-4-14.3-1.8c-4.7,2.2-7.7,7-7.7,12.2v93.6c-104.6,3.8-176.5,40.7-213.9,109.8   c-32.2,59.6-31.9,130.2-31.6,176.9c0,3.8,0,7.4,0,10.8c0,6.1,4.1,11.5,10.1,13.1c1.1,0.3,2.3,0.4,3.4,0.4c4.8,0,9.3-2.5,11.7-6.8   c73-128.7,133.1-134.9,220.2-135.2v93.3c0,5.2,3,10,7.8,12.2s10.3,1.5,14.4-1.8l215.4-178.2c3.1-2.6,4.9-6.4,4.9-10.4   S486.158,218.213,483.058,215.613z M272.558,375.613v-78.1c0-3.6-1.4-7-4-9.5c-2.5-2.5-6-4-9.5-4c-54.4,0-96.1,1.5-136.6,20.4   c-35,16.3-65.3,44-95.2,87.5c1.2-39.7,6.4-87.1,28.1-127.2c34.4-63.6,101-95.1,203.7-96c7.4-0.1,13.4-6.1,13.4-13.5v-78.2   l180.7,149.1L272.558,375.613z"/>
                      </g>
                  </svg>
              </a>
            </div>

            @if (is_admin())
            <li>
                <a href="{!! url('/business/billing') !!}">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/billing.svg', [
                      ])
                    </span>
                    <span class="min-hide">{!! trans('sidebar.menu.billing') !!}</span>
                </a>
                <span class="notification p-1 d-none" style="background-color: #ffc107; font-size: 10px!important; top:-4px;"
                      data-toggle="tooltip" title="Looks like there's a problem with billing" data-type="billing">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                         style="enable-background:new 0 0 512 512; fill:#fff;" xml:space="preserve"
                         width="25px" height="25px">
                        <g>
                            <g>
                                <path d="M256,0C114.497,0,0,114.507,0,256c0,141.503,114.507,256,256,256c141.503,0,256-114.507,256-256    C512,114.497,397.493,0,256,0z M256,472c-119.393,0-216-96.615-216-216c0-119.393,96.615-216,216-216    c119.393,0,216,96.615,216,216C472,375.393,375.385,472,256,472z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M256,128.877c-11.046,0-20,8.954-20,20V277.67c0,11.046,8.954,20,20,20s20-8.954,20-20V148.877    C276,137.831,267.046,128.877,256,128.877z"/>
                            </g>
                        </g>
                        <g>
                            <g>
                                <circle cx="256" cy="349.16" r="27"/>
                            </g>
                        </g>
                    </svg>
                </span>
            </li>

            @endif

            <li>
                <a href="{!! url('/business/settings') !!}">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/settings.svg', [
                      ])
                    </span>
                    <span class="min-hide">{!! trans('sidebar.menu.settings') !!}</span>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#supportModal">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/support.svg', [
                      ])
                    </span>
                    <span class="min-hide">Support</span>
                </a>
            </li>
            <li>
              <a href="#">
                <span style="padding-left: 8px; padding-right: 17px;">
                  @svg('/img/sidebar/logout.svg', [
                  ])
                </span>
                <span class="min-hide text fs-16 clear-padding" data-toggle="modal" data-target="#logoutModal">{!! trans('modals.logout') !!}</span>
              </a>
            </li>
            <li class="no-hover logo-block">
                <a style="width: 100%;margin: 0px;">
                    <img src="{{ asset('img/JobMap_white.svg') }}" alt=""/>
                    <span class="updated-text" >{!! trans('sidebar.text.updated') !!}</span>
                    <span class="updated-text-date" >Nov 21 2018</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- end sidebar -->
<div class="sidenav-bg mask-strong"></div>

<!-- FEEDBACK MODAL -->
<div class="modal fade" id="FeedbackModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pt-0">
                <h5 class="modal-title">Feedback</h5>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="col-12">
                    <p class="form-text mb-2">Thank you for wanting to write us your feedback.</p>
                    <textarea type="text" class="form-control mt-4" name="" placeholder="Type your feedback"></textarea>
                </div>
                <div class="col-12">
                    <button class="btn btn-outline-primary btn-block py-3 mt-2">Send Feedback</button>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="feedbackModalSend" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pt-0">
                <h5 class="modal-title">{!! trans('modals.feedback') !!}</h5>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="col-12">
                    <p class="form-text mb-2">{!! trans('modals.thank_you_for_sending_us_your_feedback') !!}</p>
                </div>
                <div class="col-12">
                    <button class="btn btn-outline-primary btn-block py-3 mt-2">{!! trans('modals.close') !!}</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- EOF FEEDBACK MODAL -->

<!-- Learn more MODAL -->
<div class="modal fade" id="LearnMore" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header pt-0">
                <h5 class="modal-title">Learn more</h5>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                LearnMOre
            </div>

        </div>
    </div>
</div>
<!-- EOF Learn more MODAL -->


<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
    var sc_project = 11657175;
    var sc_invisible = 1;
    var sc_security = "30982d09";
</script>
<script type="text/javascript"
        src="https://www.statcounter.com/counter/counter.js"
        async></script>
<noscript>
    <div class="statcounter"><a title="Web Analytics
Made Easy - StatCounter" href="http://statcounter.com/"
                                target="_blank"><img class="statcounter"
                                                     src="//c.statcounter.com/11657175/0/30982d09/1/" alt="Web
Analytics Made Easy - StatCounter"></a></div>
</noscript>
<!-- End of StatCounter Code for Default Guide -->
