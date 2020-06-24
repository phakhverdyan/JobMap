<div class="thumbnail avatar thumbnail-business" id="business-navbar">
    <div class="current-lang avatar rounded" style="overflow: hidden;">
        <img src="{{ asset('img/profilepic2.png') }}" class="userpic rounded">
    </div>
    <div>
        <ul class="fade-fast business-fade-fast">
            <div class="text-center pt-4" style="cursor: default; height: 170px; position: relative;">
                <div class="border bg-white avatar_edit_icon" id="" style="position: absolute; right: 85px; top:5px; width: 30px; height: 30px; z-index: 3; border-radius: 25px; display: none;">
                    <a href="{!! url('/user/resume/create?tab=basic') !!}">
                        <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px" height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="fill:rgba(6,70,166,0.2)!important; vertical-align: middle; margin-top: 3px">
                            <g id="background">
                                <rect fill="none" height="32" width="32"></rect>
                            </g>
                            <g id="edit">
                                <polygon points="10,28 4,28 4,22  "></polygon>
                                <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"></rect>
                                <polygon points="4,32 4,30 26,30 26,32 4,32  "></polygon>
                            </g>
                        </svg>
                    </a>
                </div>
                <div style="width: 102px; height: 102px; margin: 0 auto; overflow: hidden; border-radius: 5px;" class="avatar_hover">
                    <a href="{!! url('/user/resume/create?tab=basic') !!}">
                        <img src="{{ asset('img/profilepic2.png') }}" class="rounded menu-userpic" id="" style="position: relative; width: 102px; height: 102px; z-index: 1;" />
                    </a>
                </div>
                <div>
                    <img src="{{ asset('img/business-logo-small.png') }}" class="rounded business-logo menu-business-picture" id="" style="max-width: 100%; z-index: 3; background-color: #fff;" />
                </div>
                <div class="d-flex justify-content-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 26 26" id="Слой_1" version="1.1" viewBox="0 0 26 26" xml:space="preserve" width="20px" height="20px" style="vertical-align: middle;margin-top: 12px; fill:#4E5C6E;" class="mr-1"><path fill="#4E5C6E" d="M25,13c0-6.6166992-5.3828125-12-12-12S1,6.3833008,1,13c0,3.383606,1.413208,6.4386597,3.673645,8.6222534  c0.0529175,0.0689087,0.1156006,0.1247559,0.1889648,0.171814C7.0038452,23.7769165,9.8582764,25,13,25  s5.9961548-1.2230835,8.1373901-3.2059326c0.0733643-0.0470581,0.1360474-0.1029053,0.1889648-0.171814  C23.586792,19.4386597,25,16.383606,25,13z M13,2.5c5.7900391,0,10.5,4.7104492,10.5,10.5  c0,2.4549561-0.8532715,4.7108154-2.2702637,6.5008545c-0.6505127-2.0978394-2.5076294-3.7401123-5.0281372-4.4957886  c1.3735962-0.9940796,2.2720337-2.6046143,2.2720337-4.4244995c0-3.0141602-2.4550781-5.4663086-5.4736328-5.4663086  s-5.4736328,2.4521484-5.4736328,5.4663086c0,1.8198853,0.8984375,3.4304199,2.2720337,4.4244995  c-2.5205078,0.7556763-4.3776245,2.3979492-5.0281372,4.4957886C3.3532715,17.7108154,2.5,15.4549561,2.5,13  C2.5,7.2104492,7.2099609,2.5,13,2.5z M9.0263672,10.5805664c0-2.1870117,1.7822266-3.9663086,3.9736328-3.9663086  s3.9736328,1.7792969,3.9736328,3.9663086S15.1914063,14.546875,13,14.546875S9.0263672,12.7675781,9.0263672,10.5805664z   M6.0307617,20.8319702C6.2562256,18.0820313,9.1723633,16.046875,13,16.046875s6.7437744,2.0351563,6.9692383,4.7850952  C18.1130981,22.4855347,15.6757202,23.5,13,23.5S7.8869019,22.4855347,6.0307617,20.8319702z" fill="#1D1D1B"/></svg>
                    </span>
                    <p id="ddd" class="border-bottom-0 mb-0 menu-firstname menu-business-name--" style="color: #4E5C6E;font-family: sans-regular;font-size: 15px;font-weight: 700;line-height: 45px;">

                    </p>
                </div>

            </div>

            <hr />

            {{--<li>
                <a href="{!! url('/business/dashboard') !!}">
                    <span style="padding-left: 11px; padding-right: 20px;">
                      @svg('/img/sidebar/dashboard.svg', [
                      ])
                    </span>
                    <span>{!! trans('sidebar.menu.dashboard') !!}</span>
                </a>
            </li>--}}

            <p class="mb-0 pl-1 py-3 collapse_candidates">
                <span style="padding-left: 11px; padding-right: 20px;">
                   @svg('/img/sidebar/candidates.svg', [
                       'width' => '20px',
                       'height' => '20px',
                       'style' => 'vertical-align: middle;',
                      ])
                </span>
                <span style="font-weight: 500;">Candidates</span>
                <span class="float-right plus_icon toggle_arrow mt-0"></span>
            </p>

            <div class="candidates_menu advanced_menu">
              <li>
                <a href="{!! url('/business/candidate/manage').'?p=new' !!}" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.applicants') !!}">
                    <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/manage_candidate.svg', [
                        ])
                    </span>
                    <span>{!! trans('sidebar.menu.applicants') !!}</span>
                    {{-- <span class="countApplicantsTotal ml-2 px-1 rounded" style="background: rgb(0, 0, 0, 0.05); display: none;"></span> --}}
                </a>
                {{-- <span class="notification animated countApplicantsNew" style="display: none"></span> --}}
              </li>
              {{--<li>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.employees') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/employees.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.employees') !!}</span>
                  </a>
              </li>--}}
              <li class="relative">
                  <a href="{!! url('/business/interviews') !!}" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.interviews') !!}">
                      <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/interviews.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.interviews') !!}</span>
                  </a>
                  <span class="notification realtime__count-of-upcoming-interviews" style="background-color: #28a745; display: none;"></span>
              </li>
              <li class="relative">
                  <a href="{!! url('/business/messages') !!}">
                      <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/messages.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.messages') !!}</span>
                      <span style="position: relative; border-left: 0;" class="global-chat-typing">
                        <span class="[ chat-typing-icon ]" style="position: absolute; top: -3px; left: 25px; display: inline-block; font-size: 5px;"></span>
                      </span>
                  </a>
                  <span class="notification realtime__total-count-of-unread-chats-with-unread-messages"
                        style="display: none;">...</span>
              </li>
            </div>


            <p class="mb-0 pl-1 py-3 collapse_career">
                <span style="padding-left: 11px; padding-right: 20px;">
                   @svg('/img/sidebar/career.svg', [
                       'width' => '20px',
                       'height' => '20px',
                       'style' => 'vertical-align: middle;',
                      ])
                </span>
                <span style="font-weight: 500;">Manage Career Page</span>
                <span class="float-right plus_icon toggle_arrow collapsed mt-0"></span>
            </p>

            <div class="career_menu advanced_menu" style="display: none;">

              @if (is_permit_administrator(['career_page']))
                <li>
                    <a href="{!! url('/business/profile/edit') !!}">
                        <span style="padding-left: 10px; padding-right: 20px;">
                          @svg('/img/sidebar/career_page.svg', [
                          ])
                        </span>
                        <span>{!! trans('sidebar.menu.career_page') !!}</span>
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
                          <span>{!! trans('sidebar.menu.brands') !!}</span>
                          <span class="countBrands ml-2 px-1 rounded"
                                style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
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
                      <span>{!! trans('sidebar.menu.locations') !!}</span>
                      <span class="countLocations ml-2 px-1 rounded"
                            style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                  </a>
              </li>
              @endif

              <li>
                  <a href="{!! url('/business/job/manage') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/jobs.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.jobs') !!}</span>
                      <span class="countJobs ml-2 px-1 rounded"
                            style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                  </a>
              </li>
                @if (is_permit_administrator(['managers', 'franchisees']))
                  <li>
                      <a href="{!! url('/business/manage/manager') !!}">
                          <span style="padding-left: 10px; padding-right: 20px;">
                            @svg('/img/sidebar/manage_manager.svg', [
                            ])
                          </span>
                          <span>{!! trans('sidebar.menu.managers') !!}</span>
                          <span class="countManagers ml-2 px-1 rounded"
                                style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                      </a>
                  </li>
                @endif
{{--                @if (is_permit_administrator(['departments']))--}}
{{--                  <li>--}}
{{--                      <a href="{!! url('/business/manage/department/list') !!}">--}}
{{--                          <span style="padding-left: 10px; padding-right: 20px;">--}}
{{--                            @svg('/img/sidebar/department.svg', [--}}
{{--                            ])--}}
{{--                          </span>--}}
{{--                          <span>{!! trans('sidebar.menu.departments') !!}</span>--}}
{{--                          <span class="countDepartments ml-2 px-1 rounded" style="background: rgb(0, 0, 0, 0.05); display: none;"></span>--}}
{{--                      </a>--}}
{{--                  </li>--}}
{{--                @endif--}}
            </div>

            @if (is_permit_administrator(['connect_jobmap']))
            <p class="mb-0 pl-1 py-3 collapse_connect">
                <span style="padding-left: 11px; padding-right: 20px;">
                   @svg('/img/sidebar/connect.svg', [
                       'width' => '20px',
                       'height' => '20px',
                       'style' => 'vertical-align: middle;',
                      ])
                </span>
                <span style="font-weight: 500;">Connect JobMap</span>
                <span class="float-right plus_icon toggle_arrow collapsed mt-0"></span>
            </p>

            <div class="advanced_guides advanced_menu" style="display: none;">
              {{--<li>
                  <a href="{{ url('/') }}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/jobmap.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.jobmap') !!}</span>
                  </a>
              </li>--}}
                <li class="">
                    <a href="{!! url('/business/widget/manager') !!}">
                    <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->
                        <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/website_button.svg', [
                        ])
                      </span>
                        <span>Widget</span>
                    </a>
                </li>
{{--              <li>--}}
{{--                  <a href="{!! url('/business/button/manager') !!}">--}}
{{--                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->--}}
{{--                      <span style="padding-left: 8px; padding-right: 17px;">--}}
{{--                        @svg('/img/sidebar/website_button.svg', [--}}
{{--                        ])--}}
{{--                      </span>--}}
{{--                      <span>{!! trans('sidebar.menu.website_button') !!}</span>--}}
{{--                      --}}{{-- <span class="notification countIntegration- countIntegration-WebsiteButton" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span> --}}
{{--                  </a>--}}
{{--              </li>--}}
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
              </li>
              <li>
                  <a href="{!! url('/business/CR-email') !!}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/cr_email.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.cr_email') !!}</span>
                      <span class="notification countIntegration- countIntegration-CREmail" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>
                  </a>
              </li>--}}
{{--              <li>--}}
{{--                  <a href="{!! url('/business/email-forwarder') !!}">--}}
{{--                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->--}}
{{--                      <span style="padding-left: 8px; padding-right: 17px;">--}}
{{--                        @svg('/img/sidebar/email_forwarder.svg', [--}}
{{--                        ])--}}
{{--                      </span>--}}
{{--                      <span>{!! trans('sidebar.menu.email_forwarder') !!}</span>--}}
{{--                      <span class="notification countIntegration- countIntegration-EmailForwarder" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>--}}
{{--                  </a>--}}
{{--              </li>--}}
              {{--<li>
                  <a href="{!! url('business/CR-link') !!}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/cr_link.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.cr_link') !!}</span>
                  </a>
              </li>--}}
            </div>
            @endif

            <hr style="margin-top: 32px;">
            @if (is_admin())
            <li>
                <a href="{!! url('/business/billing') !!}">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/billing.svg', [
                      ])
                    </span>
                    <span>{!! trans('sidebar.menu.billing') !!}</span>
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
                    <span>{!! trans('sidebar.menu.settings') !!}</span>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#supportModal">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/support.svg', [
                      ])
                    </span>
                    <span>Support</span>
                </a>
            </li>
            <li>
              <a href="#">
                <span style="padding-left: 8px; padding-right: 17px;">
                  @svg('/img/sidebar/logout.svg', [
                  ])
                </span>
                <span class="text fs-16 clear-padding" data-toggle="modal" data-target="#logoutModal">{!! trans('modals.logout') !!}</span>
              </a>
            </li>
            <li class="no-hover">
                <a style="width: 100%;margin: 0px;">
                    <img src="{{ asset('img/JobMap_white.svg') }}" style="
                        display: block;
                        text-align: center;
                        margin: auto;
                        margin-top: 50px;
                        height: 67px;
                    "/>
                    <span style="
                        display: block;
                        text-align: center;
                        opacity: 0.4;
                        line-height: 13px;
                        font-size: 12px;
                        margin: 10px 0;
                        font-weight: bold;
                    ">{!! trans('sidebar.text.updated') !!}</span>
                    <span style="
                        display: block;
                        text-align: center;
                        opacity: 0.4;
                        margin-bottom: 30px;
                        line-height: 0px;
                        font-size: 13px;
                    ">Nov 21 2018</span>
                </a>
            </li>
        </ul>
        <ul id="menu-content" class="menu-content fade-fast-adaptive-business pt-0">
            <div class="text-center pt-4" style="cursor: default; height: 170px; position: relative;">
                <div class="border bg-white avatar_edit_icon" id="" style="position: absolute; right: 85px; top:5px; width: 30px; height: 30px; z-index: 3; border-radius: 25px; display: none;">
                    <a href="{!! url('/user/resume/create?tab=basic') !!}">
                        <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px" height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="fill:rgba(6,70,166,0.2)!important; vertical-align: middle; margin-top: 3px">
                            <g id="background">
                                <rect fill="none" height="32" width="32"></rect>
                            </g>
                            <g id="edit">
                                <polygon points="10,28 4,28 4,22  "></polygon>
                                <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"></rect>
                                <polygon points="4,32 4,30 26,30 26,32 4,32  "></polygon>
                            </g>
                        </svg>
                    </a>
                </div>
                <div style="width: 102px; height: 102px; margin: 0 auto; overflow: hidden; border-radius: 5px;" class="avatar_hover">
                    <a href="{!! url('/user/resume/create?tab=basic') !!}">
                        <img src="{{ asset('img/profilepic2.png') }}" class="rounded menu-userpic" id="" style="position: relative; width: 102px; height: 102px; z-index: 1;" />
                    </a>
                </div>
                <div>
                    <img src="{{ asset('img/business-logo-small.png') }}" class="rounded business-logo menu-business-picture" id="" style="max-width: 100%; z-index: 3; background-color: #fff;" />
                </div>
                <div class="d-flex justify-content-center">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 26 26" id="Слой_1" version="1.1" viewBox="0 0 26 26" xml:space="preserve" width="20px" height="20px" style="vertical-align: middle;margin-top: 12px; fill:#4E5C6E;" class="mr-1"><path fill="#4E5C6E" d="M25,13c0-6.6166992-5.3828125-12-12-12S1,6.3833008,1,13c0,3.383606,1.413208,6.4386597,3.673645,8.6222534  c0.0529175,0.0689087,0.1156006,0.1247559,0.1889648,0.171814C7.0038452,23.7769165,9.8582764,25,13,25  s5.9961548-1.2230835,8.1373901-3.2059326c0.0733643-0.0470581,0.1360474-0.1029053,0.1889648-0.171814  C23.586792,19.4386597,25,16.383606,25,13z M13,2.5c5.7900391,0,10.5,4.7104492,10.5,10.5  c0,2.4549561-0.8532715,4.7108154-2.2702637,6.5008545c-0.6505127-2.0978394-2.5076294-3.7401123-5.0281372-4.4957886  c1.3735962-0.9940796,2.2720337-2.6046143,2.2720337-4.4244995c0-3.0141602-2.4550781-5.4663086-5.4736328-5.4663086  s-5.4736328,2.4521484-5.4736328,5.4663086c0,1.8198853,0.8984375,3.4304199,2.2720337,4.4244995  c-2.5205078,0.7556763-4.3776245,2.3979492-5.0281372,4.4957886C3.3532715,17.7108154,2.5,15.4549561,2.5,13  C2.5,7.2104492,7.2099609,2.5,13,2.5z M9.0263672,10.5805664c0-2.1870117,1.7822266-3.9663086,3.9736328-3.9663086  s3.9736328,1.7792969,3.9736328,3.9663086S15.1914063,14.546875,13,14.546875S9.0263672,12.7675781,9.0263672,10.5805664z   M6.0307617,20.8319702C6.2562256,18.0820313,9.1723633,16.046875,13,16.046875s6.7437744,2.0351563,6.9692383,4.7850952  C18.1130981,22.4855347,15.6757202,23.5,13,23.5S7.8869019,22.4855347,6.0307617,20.8319702z" fill="#1D1D1B"/></svg>
                    </span>
                    <p id="" class="border-bottom-0 mb-0 menu-business-name" style="color: #4E5C6E;font-family: sans-regular;font-size: 15px;font-weight: 700;line-height: 45px;">

                    </p>
                </div>

            </div>

            <hr />

            <li>
                <a href="{!! url('/business/dashboard') !!}">
                    <span style="padding-left: 11px; padding-right: 20px;">
                      @svg('/img/sidebar/dashboard.svg', [
                      ])
                    </span>
                    <span>{!! trans('sidebar.menu.dashboard') !!}</span>
                </a>
            </li>

            <p class="mb-0 pl-1 py-3 collapse_candidates">
                <span style="padding-left: 11px; padding-right: 20px;">
                   @svg('/img/sidebar/candidates.svg', [
                       'width' => '20px',
                       'height' => '20px',
                       'style' => 'vertical-align: middle;',
                      ])
                </span>
                <span style="font-weight: 500;">Candidates</span>
                <span class="float-right plus_icon toggle_arrow mt-0"></span>
            </p>

            <div class="candidates_menu advanced_menu">
              <li>
                <a href="{!! url('/business/candidate/manage').'?p=new' !!}" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.applicants') !!}">
                    <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/manage_candidate.svg', [
                        ])
                    </span>
                    <span>{!! trans('sidebar.menu.applicants') !!}</span>
                    {{-- <span class="countApplicantsTotal ml-2 px-1 rounded" style="background: rgb(0, 0, 0, 0.05); display: none;"></span> --}}
                </a>
                {{-- <span class="notification animated countApplicantsNew" style="display: none"></span> --}}
              </li>
              {{--<li>
                  <a href="#" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.employees') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/employees.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.employees') !!}</span>
                  </a>
              </li>--}}
              <li class="relative">
                  <a href="{!! url('/business/interviews') !!}" data-toggle="tooltip" data-placement="top" title="{!! trans('sidebar.menu.interviews') !!}">
                      <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/interviews.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.interviews') !!}</span>
                  </a>
                  <span class="notification realtime__count-of-upcoming-interviews" style="background-color: #28a745; display: none;"></span>
              </li>
              <li class="relative">
                  <a href="{!! url('/business/messages') !!}">
                      <span style="padding-left: 11px; padding-right: 20px;">
                        @svg('/img/sidebar/messages.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.messages') !!}</span>
                      <span style="position: relative; border-left: 0;" class="global-chat-typing">
                        <span class="[ chat-typing-icon ]" style="position: absolute; top: -3px; left: 25px; display: inline-block; font-size: 5px;"></span>
                      </span>
                  </a>
                  <span class="notification realtime__total-count-of-unread-chats-with-unread-messages"
                        style="display: none;">...</span>
              </li>
            </div>

            @if (is_permit_administrator(['connect_jobmap']))
            <p class="mb-0 pl-1 py-3 collapse_connect">
                <span style="padding-left: 11px; padding-right: 20px;">
                   @svg('/img/sidebar/connect.svg', [
                       'width' => '20px',
                       'height' => '20px',
                       'style' => 'vertical-align: middle;',
                      ])
                </span>
                <span style="font-weight: 500;">Connect CloudResume</span>
                <span class="float-right plus_icon toggle_arrow collapsed mt-0"></span>
            </p>

            <div class="advanced_guides advanced_menu" style="display: none;">
              <li>
                  <a href="{{ url('/') }}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/jobmap.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.jobmap') !!}</span>
                  </a>
              </li>
              <li>
                  <a href="{!! url('/business/button/manager') !!}">
                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/website_button.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.website_button') !!}</span>
                      {{-- <span class="notification countIntegration- countIntegration-WebsiteButton" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span> --}}
                  </a>
              </li>
              <li>
                  <a href="{!! url('/business/candidate/manage-ats') !!}" data-toggle="tooltip"
                     title="Import from Email, Excel, ATS, CSV">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/manager_ats.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.import') !!}</span>
                      <span class="notification countIntegration- countIntegration-ATSImport" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>
                  </a>
              </li>
              <li>
                  <a href="{!! url('/business/CR-email') !!}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/cr_email.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.cr_email') !!}</span>
                      <span class="notification countIntegration- countIntegration-CREmail" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>
                  </a>
              </li>
{{--              <li>--}}
{{--                  <a href="{!! url('/business/email-forwarder') !!}">--}}
{{--                  <!-- <img src="{{ asset('img/sidebar/setup.png') }}" /> -->--}}
{{--                      <span style="padding-left: 8px; padding-right: 17px;">--}}
{{--                        @svg('/img/sidebar/email_forwarder.svg', [--}}
{{--                        ])--}}
{{--                      </span>--}}
{{--                      <span>{!! trans('sidebar.menu.email_forwarder') !!}</span>--}}
{{--                      <span class="notification countIntegration- countIntegration-EmailForwarder" style=" margin-top: 10px; color:#fff; line-height: 1; background: #dc3545;">1</span>--}}
{{--                  </a>--}}
{{--              </li>--}}
              <li>
                  <a href="{!! url('business/CR-link') !!}">
                      <span style="padding-left: 8px; padding-right: 17px;">
                        @svg('/img/sidebar/cr_link.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.cr_link') !!}</span>
                  </a>
              </li>
            </div>
            @endif

            <p class="mb-0 pl-1 py-3 collapse_career">
                <span style="padding-left: 11px; padding-right: 20px;">
                   @svg('/img/sidebar/career.svg', [
                       'width' => '20px',
                       'height' => '20px',
                       'style' => 'vertical-align: middle;',
                      ])
                </span>
                <span style="font-weight: 500;">Manage Career Page</span>
                <span class="float-right plus_icon toggle_arrow collapsed mt-0"></span>
            </p>

            <div class="career_menu advanced_menu" style="display: none;">

                @if (is_permit_administrator(['career_page']))
                  <li>
                      <a href="{!! url('/business/profile/edit') !!}">
                          <span style="padding-left: 10px; padding-right: 20px;">
                            @svg('/img/sidebar/career_page.svg', [
                            ])
                          </span>
                          <span>{!! trans('sidebar.menu.career_page') !!}</span>
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
                            <span>{!! trans('sidebar.menu.brands') !!}</span>
                            <span class="countBrands ml-2 px-1 rounded"
                                  style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                        </a>
                    </li>
                @endif
              <li>
                  <a href="{!! url('/business/branch/locations') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/branch_locations.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.locations') !!}</span>
                      <span class="countLocations ml-2 px-1 rounded"
                            style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                  </a>
              </li>
              <li>
                  <a href="{!! url('/business/job/manage') !!}">
                      <span style="padding-left: 10px; padding-right: 20px;">
                        @svg('/img/sidebar/jobs.svg', [
                        ])
                      </span>
                      <span>{!! trans('sidebar.menu.jobs') !!}</span>
                      <span class="countJobs ml-2 px-1 rounded"
                            style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                  </a>
              </li>
                @if (is_permit_administrator(['managers', 'franchisees']))
                  <li>
                      <a href="{!! url('/business/manage/manager') !!}">
                          <span style="padding-left: 10px; padding-right: 20px;">
                            @svg('/img/sidebar/manage_manager.svg', [
                            ])
                          </span>
                          <span>{!! trans('sidebar.menu.managers') !!}</span>
                          <span class="countManagers ml-2 px-1 rounded"
                                style="background: rgb(0, 0, 0, 0.05); display: none;"></span>
                      </a>
                  </li>
                @endif
{{--                @if (is_permit_administrator(['departments']))--}}
{{--                  <li>--}}
{{--                      <a href="{!! url('/business/manage/department/list') !!}">--}}
{{--                          <span style="padding-left: 10px; padding-right: 20px;">--}}
{{--                            @svg('/img/sidebar/department.svg', [--}}
{{--                            ])--}}
{{--                          </span>--}}
{{--                          <span>{!! trans('sidebar.menu.departments') !!}</span>--}}
{{--                          <span class="countDepartments ml-2 px-1 rounded" style="background: rgb(0, 0, 0, 0.05); display: none;"></span>--}}
{{--                      </a>--}}
{{--                  </li>--}}
{{--                @endif--}}
            </div>

            <hr style="margin-top: 32px;">

            @if (is_admin())
            <li>
                <a href="{!! url('/business/billing') !!}">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/billing.svg', [
                      ])
                    </span>
                    <span>{!! trans('sidebar.menu.billing') !!}</span>
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
                    <span>{!! trans('sidebar.menu.settings') !!}</span>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#supportModal">
                    <span style="padding-left: 8px; padding-right: 17px;">
                      @svg('/img/sidebar/support.svg', [
                      ])
                    </span>
                    <span>Support</span>
                </a>
            </li>
            <li>
              <a href="#">
                <span style="padding-left: 8px; padding-right: 17px;">
                  @svg('/img/sidebar/logout.svg', [
                  ])
                </span>
                <span class="text fs-16 clear-padding" data-toggle="modal" data-target="#logoutModal">{!! trans('modals.logout') !!}</span>
              </a>
            </li>
            <li class="no-hover">
                <a style="width: 100%;margin: 0px;">
                    <img src="{{ asset('img/JobMap_white.svg') }}" style="
                        display: block;
                        text-align: center;
                        margin: auto;
                        margin-top: 50px;
                        height: 67px;
                    "/>
                    <span style="
                        display: block;
                        text-align: center;
                        opacity: 0.4;
                        line-height: 13px;
                        font-size: 12px;
                        margin: 10px 0;
                        font-weight: bold;
                    ">{!! trans('sidebar.text.updated') !!}</span>
                    <span style="
                        display: block;
                        text-align: center;
                        opacity: 0.4;
                        margin-bottom: 30px;
                        line-height: 0px;
                        font-size: 13px;
                    ">Nov 21 2018</span>
                </a>
            </li>
        </ul>
    </div>
</div>
