<style type="text/css">
    .nav-side-menu {
        overflow-y: auto;
        overflow-x: hidden;
    }
</style>
<!-- sidebar -->
<div class="nav-side-menu">
    <div class="menu-list"  style="padding-top: 31px;">

        <ul id="menu-content" class="menu-content collapse out mt-0">
            <li class="switcher-to-business-block relative disabled-hover min-hide">
                <div class="d-flex justify-content-between justify-content-end mb-0 px-3" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border: 1px solid rgba(78,92,110,.1); background-color: #f4f4f4;">
                    <div class="business_switch" style="opacity: 0.7; cursor: pointer;">{!! trans('sidebar.text.now_in_job_mode') !!}</div>
                    <button type="button" class="btn btn-sm business_switch_caret show-yes-businesses" aria-haspopup="true" aria-expanded="false"  style="background-color: transparent;">
                        <span class="carrot" style="vertical-align: middle;"></span>
                    </button>

                    <div class="switcher_to_business business-list business-list-outclick bg-white rounded border-top-right-0">
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
            </li>

            <div class="show-no-businesses min-hide hide">
                <a class="profile-switcher mx-3 btn btn-primary d-block mb-3 mt-2" href="{!! url('/business/signup') !!}" role="button" style="width: auto;">
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

            <div class="d-flex min-hide" style="margin:40px 0 40px 0;">
                <div class="ml-3 rounded" style="overflow: hidden;width: 35px; height: 35px;">
                  <div>
                      <img src="{{ asset('img/profilepic2.png') }}" class="rounded menu-userpic" id=""
                           style="position: relative; width: 35px; height: 35px; z-index: 1; top:-1px;"/>
                  </div>
                </div>
                @if (!Auth::user()->businesses->first() || \App\Business\Administrator::where('user_id', Auth::user()->id)->where('role', 'admin')->first())
                <div class="ml-3">
                    <a href="{!! url('/user/resume/create?tab=basic') !!}">
                        <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px"
                             height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                             style="fill:rgba(6,70,166,0.2)!important; vertical-align: middle;"><g id="background">
                                <rect fill="none" height="32" width="32"></rect>
                            </g>
                            <g id="edit">
                                <polygon points="10,28 4,28 4,22  "></polygon>
                                <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)"
                                      width="28.284" x="4.858" y="8.757"></rect>
                                <polygon points="4,32 4,30 26,30 26,32 4,32  "></polygon>
                            </g></svg>
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

            <div class="d-flex mb-3 px-3 block-checkbox min-hide">
              <p class="mb-0 align-self-center yes-no">{!! trans('sidebar.checkbox.yes') !!}</p>
              <div class="align-self-center mx-3">
                <label class="switch mb-0">
                    <input type="checkbox" class="job-status-change" checked id="sidebar-looking_job">
                    <span class="slider round"></span>
                </label>
              </div>
              <p class="mb-0 align-self-center">{!! trans('sidebar.checkbox.looking_for_a_job_now') !!}</p>
            </div>
            {{--
              <div class="px-3 mb-3 block-checkbox" style="display: none">
                <p class="mb-0 align-self-center yes-no">{!! trans('sidebar.checkbox.yes') !!}</p>
                <div class="align-self-center mx-3">
                  <label class="switch mb-0">
                      <input type="checkbox" class="job-status-change" checked id="sidebar-its_urgent">
                      <span class="slider round"></span>
                  </label>
                </div>
                <p class="mb-0 align-self-center">{!! trans('sidebar.checkbox.its_urgent') !!}</p>
              </div>
            --}}
            {{--
              <div class="px-3 block-checkbox" style="display: none">
                <p class="mb-0 align-self-center yes-no">{!! trans('sidebar.checkbox.yes') !!}</p>
                <div class="align-self-center mx-3">
                  <label class="switch mb-0">
                      <input type="checkbox" class="job-status-change" checked id="sidebar-new_job">
                      <span class="slider round"></span>
                  </label>
                </div>
                <p class="mb-0 align-self-center">{!! trans('sidebar.checkbox.open_to_new_opportunities') !!}</p>
              </div>
            --}}

            <hr class="min-hide"/>

            <p class="pl-4 ml-1 pr-3 min-hide">
                <a href="{!! url('/user/step-by-step-guide') !!}" id="sidebar_toggle"
                   style="color: #4E5C6E;font-family: sans-regular;font-size: 15px;font-weight: 400;line-height: 45px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                         id="Layer_1" x="0px" y="0px" viewBox="0 0 489.5 489.5"
                         style="enable-background:new 0 0 489.5 489.5; width: 20px; height: 20px; fill:#4E5C6E; vertical-align: middle; margin-top: -3px;"
                         xml:space="preserve" class="mr-2">
                                  <g>
                                      <g>
                                          <path d="M449.9,21.25H39.5C17.7,21.25,0,38.95,0,60.75v277.4c0,21.8,17.7,39.5,39.5,39.5h161v44.1h-31.4c-5.2,0-9.5,4.3-9.5,9.5    v27.5c0,5.2,4.3,9.5,9.5,9.5h151.3c5.2,0,9.5-4.3,9.5-9.5v-27.5c0-5.2-4.3-9.5-9.5-9.5H289v-44.1h161c21.8,0,39.5-17.7,39.5-39.5    V60.75C489.4,38.95,471.8,21.25,449.9,21.25z M53.8,323.35V75.15h381.7v248.2H53.8z"/>
                                      </g>
                                  </g>
                        <g>
                            <g>
                                <path d="M339.9,178.15l-18.9-3.2c-1.8-7.1-4.6-13.9-8.4-20.4l11.1-15.5c2-2.9,1.7-6.8-0.8-9.3l-6.7-6.7l-6.7-6.7    c-2.5-2.3-6.4-2.6-9.3-0.6l-15.5,11.2c-6.4-3.8-13.3-6.6-20.4-8.4l-3.2-18.8c-0.6-3.5-3.6-6-7.1-6h-9.4h-9.4c-3.5,0-6.5,2.5-7.1,6    l-3.2,18.9c-7.2,1.8-14.2,4.7-20.8,8.7l-15.4-11c-2.9-2-6.8-1.7-9.3,0.8l-6.7,6.7l-6.7,6.7c-2.5,2.5-2.8,6.4-0.8,9.3l11.2,15.7    c-3.8,6.4-6.5,13.4-8.3,20.4l-18.7,3c-3.5,0.6-6,3.6-6,7.1v9.4v9.3c0,3.5,2.5,6.5,6,7.1l19,3.2c1.9,7,4.7,13.9,8.6,20.2l-11,15.4    c-2,2.9-1.7,6.8,0.8,9.3l6.7,6.7l6.7,6.7c2.5,2.5,6.4,2.8,9.3,0.8l15.7-11.2c6.4,3.8,13.4,6.5,20.4,8.3l3.1,18.7    c0.6,3.5,3.6,6,7.1,6h9.4h9.4c3.5,0,6.5-2.5,7.1-6l3.2-19c6.9-1.8,13.6-4.6,19.8-8.3l15.5,11.1c2.9,2,6.8,1.7,9.3-0.8l6.7-6.7    l6.7-6.7c2.5-2.5,2.8-6.4,0.8-9.3l-11-15.5c3.8-6.4,6.6-13.3,8.4-20.4l18.8-3.2c3.5-0.6,6-3.6,6-7.1v-9.4v-9.4    C345.9,181.75,343.4,178.75,339.9,178.15z M274.4,199.45l-27.8,34c-0.9,1.1-2.6,1.1-3.5,0l-27.8-34c-1.2-1.2-0.3-3,1.2-3H231    v-38.1c0-1.6,1.3-3,3-3h21.5c1.6,0,3,1.3,3,3v38.1H273C274.5,196.45,275.4,198.25,274.4,199.45z"/>
                            </g>
                        </g>
                    </svg>
                    <strong>{!! trans('sidebar.menu.step_by_step') !!}</strong>
                </a>
                <span class="notification" style=" margin-top: 11px; background: #dc3545;">1</span>
            </p>

            <hr class="min-hide"/>

            <li>
                <a href="{!! url('/user/dashboard') !!}">
                                <span style="padding-left: 11px; padding-right: 20px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 59.314 59.315"
                                         style="enable-background:new 0 0 512.001 512.001; fill:#7b7b7b; vertical-align: middle;"
                                         xml:space="preserve" width="20px" height="20px">
                                    <g>
                                        <g>
                                            <path d="M58.314,6.245H1c-0.553,0-1,0.447-1,1V41.5c0,0.553,0.447,1,1,1h16.961v4.432c0,0.553,0.447,1,1,1h21.396    c0.553,0,1-0.447,1-1V42.5h16.957c0.553,0,1-0.447,1-1V7.245C59.314,6.693,58.867,6.245,58.314,6.245z M57.314,8.245v25.229H2    V8.245H57.314z M39.355,45.932H19.961V42.5h19.396v3.432H39.355z M40.355,40.5H18.961H2v-5.027h55.314V40.5H40.355z"/>
                                            <path d="M46.853,53.07c0.554,0,1-0.446,1-1s-0.446-1-1-1h-34.39c-0.553,0-1,0.446-1,1s0.447,1,1,1H46.853z"/>
                                            <path d="M7.653,30.165l8.708-8.373l8.583,4.126c0.313,0.15,0.682,0.128,0.974-0.06l6.337-4.062l11.882,8.462    c0.171,0.121,0.374,0.186,0.58,0.186c0.082,0,0.165-0.01,0.246-0.029c0.283-0.072,0.523-0.268,0.652-0.531l8.287-16.938    c0.242-0.496,0.037-1.095-0.459-1.338c-0.496-0.243-1.095-0.037-1.338,0.459l-7.77,15.88l-11.473-8.171    c-0.332-0.236-0.776-0.246-1.121-0.027l-6.436,4.125l-8.706-4.185c-0.376-0.181-0.825-0.109-1.127,0.181l-9.209,8.854    c-0.397,0.383-0.41,1.016-0.027,1.414C6.622,30.535,7.254,30.547,7.653,30.165z"/>
                                        </g>
                                    </g>
                                    </svg>
                                </span>
                    <span class="min-hide ">{!! trans('sidebar.menu.dashboard') !!}</span>
                </a>
            </li>
            <li>
                <a href="{!! url('/user/resume/create') !!}">
                                  <span style="padding-left: 11px; padding-right: 20px;">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                           version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.001 512.001"
                                           style="enable-background:new 0 0 512.001 512.001; fill:#7b7b7b; vertical-align: middle;"
                                           xml:space="preserve" width="20px" height="20px">
                                        <g>
                                            <g>
                                                <path d="M172.832,330.685l-19.068,68.677H99.896c-6.862,0-12.425,5.563-12.425,12.425c0,6.862,5.563,12.425,12.425,12.425h63.314    h0.001c0.514,0,1.019-0.041,1.518-0.102c0.128-0.016,0.253-0.039,0.381-0.058c0.416-0.065,0.825-0.148,1.226-0.252    c0.065-0.017,0.132-0.022,0.196-0.04l77.778-21.595c2.065-0.573,3.946-1.671,5.462-3.186l239.37-239.37    c16.327-16.327,16.327-42.893,0-59.219l-14.536-14.536c-7.909-7.91-18.424-12.265-29.609-12.265s-21.701,4.355-29.61,12.265    l-8.971,8.971V27.091C406.417,12.153,394.27,0,379.339,0H125.385c-3.295,0-6.456,1.31-8.786,3.639L14.252,105.987    c-2.33,2.33-3.639,5.49-3.639,8.786v370.138c0,14.938,12.153,27.091,27.091,27.091h341.636c14.931,0,27.078-12.153,27.078-27.091    V312.72c0-6.862-5.563-12.425-12.425-12.425c-6.862,0-12.425,5.563-12.425,12.425v172.191c0,1.235-0.999,2.24-2.228,2.24H37.703    c-1.235,0-2.24-1.005-2.24-2.24V127.199h75.269c14.933,0,27.079-12.148,27.079-27.079V24.85h241.527    c1.229,0,2.228,1.005,2.228,2.24v91.852c0,0.235,0.022,0.465,0.035,0.696l-81.586,81.586H99.896    c-6.862,0-12.425,5.563-12.425,12.425s5.563,12.425,12.425,12.425h175.269l-74.218,74.218H99.896    c-6.862,0-12.425,5.563-12.425,12.425s5.563,12.425,12.425,12.425h76.201l-0.078,0.078    C174.503,326.738,173.405,328.62,172.832,330.685z M112.961,100.118c0,1.229-1,2.229-2.229,2.229H53.039l59.922-59.922V100.118z     M432.96,103.424c3.216-3.214,7.491-4.985,12.038-4.985c4.548,0,8.822,1.771,12.037,4.986l14.536,14.536    c6.638,6.638,6.638,17.438,0,24.074l-15.518,15.518l-38.611-38.611L432.96,103.424z M399.87,136.514l38.611,38.611L240.988,372.62    l-38.611-38.611L399.87,136.514z M191.078,357.856l26.062,26.062l-36.08,10.017L191.078,357.856z"/>
                                            </g>
                                        </g>
                                        </svg>
                                  </span>
                    <span class="min-hide ">{!! trans('sidebar.menu.resume_builder') !!}</span>
                </a>
                <span class="min-hide notification animated countResumeBuilder hide" style="background: #dc3545;"></span>
            </li>
            <li>
                <a href="{!! url('/user/resume/view') !!}">
                <!-- <img src="{{ asset('img/sidebar/jobs.png') }}" /> -->
                    <!-- <span>My resume</span> -->
                    <span style="padding-left: 11px; padding-right: 20px;">
                                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                           version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                           style="enable-background:new 0 0 512.001 512.001; fill:#7b7b7b; vertical-align: middle;"
                                           xml:space="preserve" width="20px" height="20px"><g><g>
                                            <g>
                                                <path d="M431.279,0H80.721c-5.633,0-10.199,4.566-10.199,10.199v491.602c0,5.633,4.566,10.199,10.199,10.199h266.562    c2.705,0,5.298-1.075,7.212-2.987l83.997-83.998c1.912-1.912,2.987-4.506,2.987-7.212V10.199C441.479,4.566,436.912,0,431.279,0z     M357.463,477.196l-0.044-49.257l49.257,0.045L357.463,477.196z M421.081,212.151c-5.565,0.08-10.053,4.609-10.053,10.192    c0,5.583,4.489,10.112,10.052,10.192v175.064l-73.862-0.067c-0.003,0-0.006,0-0.009,0c-2.705,0-5.298,1.075-7.212,2.987    c-1.914,1.915-2.989,4.513-2.987,7.221l0.067,73.862H90.92v-259.06h0.873c5.633,0,10.199-4.566,10.199-10.199    c0-5.633-4.566-10.199-10.199-10.199H90.92V20.398h330.161V212.151z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M325.318,66.347h-55.833c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h55.833    c5.632,0,10.199-4.566,10.199-10.199C335.517,70.913,330.95,66.347,325.318,66.347z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M390.63,113.204H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,117.77,396.261,113.204,390.63,113.204z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M390.63,160.128H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,164.694,396.261,160.128,390.63,160.128z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M250.335,268.291H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h120.805    c5.633,0,10.199-4.566,10.199-10.199C260.535,272.857,255.968,268.291,250.335,268.291z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M391.649,309.543H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,314.109,397.281,309.543,391.649,309.543z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M391.649,350.853H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,355.419,397.281,350.853,391.649,350.853z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M239.681,421.227h-8.614c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h8.614    c5.633,0,10.199-4.566,10.199-10.199C249.88,425.793,245.314,421.227,239.681,421.227z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M195.825,421.227H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h66.295    c5.633,0,10.199-4.566,10.199-10.199C206.024,425.793,201.457,421.227,195.825,421.227z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M199.196,52.209c-5.223-5.574-12.599-8.771-20.237-8.771c-7.638,0-15.015,3.197-20.237,8.771    c-5.222,5.574-7.933,13.143-7.436,20.766l1.285,19.698c0.553,8.471,5.033,16.225,11.985,20.742    c4.374,2.843,9.389,4.263,14.403,4.263c5.014,0,10.029-1.421,14.403-4.263c6.953-4.517,11.433-12.272,11.985-20.742l1.285-19.698    C207.128,65.351,204.419,57.783,199.196,52.209z M186.276,71.647l-1.285,19.698c-0.136,2.081-1.161,3.935-2.743,4.963    c-1.999,1.298-4.581,1.297-6.581,0c-1.582-1.028-2.607-2.883-2.743-4.963l-1.285-19.698c-0.133-2.045,0.565-3.995,1.966-5.491    s3.302-2.319,5.352-2.319c2.05,0,3.95,0.824,5.352,2.319C185.711,67.651,186.41,69.601,186.276,71.647z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M244.543,169.528l-2.229-12.302c-3.089-17.054-16.601-30.666-33.624-33.872c-2.57-0.483-5.196-0.728-7.807-0.728h-6.712    c-2.705,0-5.299,1.075-7.212,2.987c-2.137,2.137-4.978,3.314-8,3.314c-3.022,0-5.864-1.177-8-3.314    c-1.912-1.912-4.507-2.987-7.212-2.987h-6.712c-2.611,0-5.237,0.245-7.809,0.729c-17.021,3.206-30.533,16.816-33.623,33.871    l-2.229,12.302c-0.539,2.975,0.269,6.035,2.208,8.356c1.937,2.32,4.804,3.661,7.827,3.661h111.097c3.023,0,5.89-1.341,7.828-3.661    C244.273,175.564,245.082,172.503,244.543,169.528z M135.624,161.147l0.051-0.285c1.593-8.793,8.556-15.81,17.325-17.461    c1.329-0.25,2.685-0.377,4.035-0.377h2.948c11.209,8.383,26.744,8.383,37.953,0h2.948c1.348,0,2.706,0.127,4.034,0.376    c8.77,1.651,15.733,8.669,17.326,17.462l0.052,0.285H135.624z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M357.875,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C368.074,216.71,363.507,212.143,357.875,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M319.862,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C330.062,216.71,325.494,212.143,319.862,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M129.804,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C140.003,216.71,135.437,212.143,129.804,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M243.84,212.143h-12.671c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.671    c5.633,0,10.199-4.566,10.199-10.199C254.039,216.71,249.473,212.143,243.84,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M205.828,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C216.027,216.71,211.461,212.143,205.828,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M395.886,212.143h-12.672c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.672    c5.632,0,10.199-4.566,10.199-10.199C406.085,216.71,401.518,212.143,395.886,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M281.851,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C292.05,216.71,287.483,212.143,281.851,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g><g>
                                            <g>
                                                <path d="M167.817,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C178.016,216.71,173.45,212.143,167.817,212.143z"
                                                      data-original="#000000" class="active-path"
                                                      data-old_color="#4266ff"></path>
                                            </g>
                                        </g></g>
                                    </svg>
                                  </span>
                    <span class="min-hide ">{!! trans('sidebar.menu.resume_overview') !!}</span>
                </a>
            </li>
            <li class="relative">
                <a href="{!! url('/user/messages') !!}">
                                <span style="padding-left: 11px; padding-right: 20px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512.019 512.019; fill:#7b7b7b; vertical-align: middle;"
                                         xml:space="preserve" width="20px" height="20px">
                                    <g>
                                        <g>
                                            <path d="M467,122H332V45c0-24.813-20.187-45-45-45H45C20.187,0,0,20.187,0,45v422c0,24.813,20.187,45,45,45h242    c24.813,0,45-20.187,45-45v-83.787L383.213,332H467c24.813,0,45-20.187,45-45V167C512,142.187,491.813,122,467,122z M30,45    c0-8.271,6.729-15,15-15h242c8.271,0,15,6.729,15,15v15H30V45z M302,467c0,8.271-6.729,15-15,15H45c-8.271,0-15-6.729-15-15v-45    h272V467z M302,392H30V90h272v32h-15c-24.813,0-45,20.187-45,45v120c0,24.813,20.187,45,45,45h15C302,338.893,302,385.533,302,392    z M482,287c0,8.271-6.729,15-15,15h-90c-3.978,0-7.793,1.58-10.606,4.393L332,340.787v-23.784V317c0-8.284-6.716-15-15-15h-30    c-8.271,0-15-6.729-15-15V167c0-8.271,6.729-15,15-15h180c8.271,0,15,6.729,15,15V287z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M437,182H317c-8.284,0-15,6.716-15,15s6.716,15,15,15h120c8.284,0,15-6.716,15-15S445.284,182,437,182z"></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M377,242h-60c-8.284,0-15,6.716-15,15s6.716,15,15,15h60c8.284,0,15-6.716,15-15S385.284,242,377,242z"></path>
                                        </g>
                                    </g>
                                    </svg>
                                </span>
                    <span class="min-hide ">{!! trans('sidebar.menu.messages') !!}</span>
                    <span style="position: relative; border-left: 0;" class="min-hide global-chat-typing">
                                    <span class="[ chat-typing-icon ]"
                                          style="position: absolute; top: -3px; left: 25px; display: inline-block; font-size: 5px;"></span>
                                </span>
                </a>
                <span class="min-hide notification hide realtime__total-count-of-unread-chats-with-unread-messages" ></span>
            </li>
            <li class="relative">
                <a href="{!! url('/user/interviews') !!}">
                                <span style="padding-left: 11px; padding-right: 20px;">
                                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                        style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle;"
                                        xml:space="preserve" width="20px" height="20px">
                                    <g>
                                        <g>
                                            <path d="M427.047,371.878C441.768,358.176,451,338.65,451,317c0-41.355-33.645-75-75-75c-41.355,0-75,33.645-75,75    c0,5.136,0.521,10.152,1.509,15h-2.347c-5.542-49.902-38.391-91.68-83.228-110.014C231.722,208.278,241,188.706,241,167    c0-41.355-33.645-75-75-75s-75,33.645-75,75c0,21.65,9.232,41.176,23.953,54.878c-46.02,18.568-79.562,61.451-84.354,112.499    C12.83,340.397,0,357.223,0,377v120c0,8.284,6.716,15,15,15c10.432,0,471.568,0,482,0c8.284,0,15-6.716,15-15    C512,440.473,476.815,391.958,427.047,371.878z M376,272c24.813,0,45,20.187,45,45s-20.187,45-45,45s-45-20.187-45-45    S351.187,272,376,272z M166,122c24.813,0,45,20.187,45,45s-20.187,45-45,45s-45-20.187-45-45S141.187,122,166,122z M166,242    c52.805,0,96.631,39.183,103.932,90H61.078C68.448,281.183,112.692,242,166,242z M30,377c0-8.271,6.729-15,15-15    c11.179,0,259.305,0,271.041,0c2.705,3.595,5.731,6.932,9.025,9.986c-12.275,5.019-23.65,11.794-33.814,20.014H30V377z     M241.838,482H30v-60.1h233.806C252.042,439.441,244.284,459.98,241.838,482z M272.068,482c7.301-50.817,51.127-90,103.932-90    c53.308,0,97.552,39.183,104.922,90H272.068z"/>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path d="M467,0H316c-24.813,0-45,20.187-45,45v62c0,19.556,12.539,36.239,30,42.43V197c0,6.067,3.654,11.537,9.26,13.858    c5.604,2.322,12.057,1.039,16.347-3.251L382.213,152H467c24.813,0,45-20.187,45-45V45C512,20.187,491.813,0,467,0z M482,107    c0,8.271-6.729,15-15,15h-91c-3.979,0-7.794,1.58-10.606,4.393L331,160.787V137c0-8.284-6.716-15-15-15c-8.271,0-15-6.729-15-15    V45c0-8.271,6.729-15,15-15h151c8.271,0,15,6.729,15,15V107z"/>
                                        </g>
                                    </g>
                                    </svg>
                                </span>
                                <span class="min-hide ">{!! trans('sidebar.menu.interviews') !!}</span>
                            </a>
                            <span class="min-hide notification realtime__count-of-upcoming-interviews" style="background-color: #28a745; ">1</span>
                        </li>
                        <li>

                            <a href="{!! url('/user/resume/sent') !!}">
                                <!-- <img src="{{ asset('img/sidebar/candidates.png') }}" /> -->
                                <span style="padding-left: 11px; padding-right: 20px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 490.282 490.282" style="enable-background:new 0 0 512.001 512.001; fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="20px" height="20px"><g><g>
                                        <path d="M0.043,245.197c0.6,10.1,7.3,18.6,17,21.5l179.6,54.3l6.6,123.8c0.3,4.9,3.6,9.2,8.3,10.8c1.3,0.5,2.7,0.7,4,0.7   c3.5,0,6.8-1.4,9.2-4.1l63.5-70.3l90,62.3c4,2.8,8.7,4.3,13.6,4.3c11.3,0,21.1-8,23.5-19.2l74.7-380.7c0.9-4.4-0.8-9-4.2-11.8   c-3.5-2.9-8.2-3.6-12.4-1.9l-459,186.8C5.143,225.897-0.557,235.097,0.043,245.197z M226.043,414.097l-4.1-78.1l46,31.8   L226.043,414.097z M391.443,423.597l-163.8-113.4l229.7-222.2L391.443,423.597z M432.143,78.197l-227.1,219.7l-179.4-54.2   L432.143,78.197z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                        </g></g>
                                    </svg>
                                </span>
                    <span class="min-hide ">{!! trans('sidebar.menu.sent_resumes') !!}</span>
                    <span class="min-hide countSentResumes ml-2 px-1 rounded"
                          style="background: rgba(0, 0, 0, 0.05); display: none;"></span>
                </a>
                <span class="min-hide notification hide countSentResumesAsk"></span>
            </li>
            <li>
                <a href="{!! url('/user/references') !!}">
                    <img src="{{ asset('img/sidebar/candidates.png') }}"/>
                    <span class="min-hide ">{!! trans('sidebar.menu.references') !!}</span>
                </a>
                <span class="min-hide notification hide countReferences"></span>
            </li>
            <li>
                <a href="{{ url('/map') }}">
                                <span style="padding-left: 11px; padding-right: 20px;">
                                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        id="Layer_1"
                                        style="enable-background:new 0 0 30 30; width: 20px; height: 20px; fill:#7b7b7b; vertical-align: middle;"
                                        version="1.1" viewBox="0 0 30 30" xml:space="preserve">
                                    <path d="M25,17.238v7.481l-6-1.5v-3.168l-2-2.813v6.008l-5,1.429V8.781l0.011-0.003c0.018-0.739,0.127-1.455,0.314-2.14  l-0.788,0.197c-0.34,0.085-0.697,0.079-1.035-0.017L4.339,5.056C3.668,4.865,3,5.368,3,6.066v17.179c0,0.893,0.592,1.678,1.45,1.923  l6.194,1.77c0.233,0.066,0.479,0.066,0.712,0l6.147-1.756c0.337-0.096,0.694-0.102,1.035-0.017l7.158,1.79  C26.358,27.121,27,26.619,27,25.936V15.643L25,17.238z M10,24.674l-5-1.428V7.326l5,1.428V24.674z"></path>
                                    <g>
                                        <path d="M21,2c-3.866,0-7,3.134-7,7c0,4.604,4.551,6.745,5.121,7.258c0.582,0.524,1.063,1.575,1.258,2.241   c0.094,0.323,0.359,0.487,0.621,0.494c0.263-0.007,0.527-0.171,0.621-0.494c0.194-0.665,0.675-1.717,1.258-2.241   C23.449,15.745,28,13.604,28,9C28,5.134,24.866,2,21,2z M21,11c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S22.105,11,21,11z"></path>
                                    </g>
                                    </svg>
                                </span>
                    <span class="min-hide ">{!! trans('sidebar.menu.explore_jobs') !!}</span>
                </a>
                <span class="min-hide notification hide countReferences"></span>
            </li>


            <div class="btn-group col-12 px-0 formSendFeedback min-hide" role="group" aria-label="Basic example" style="margin: 30px 0;">
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
            <li>
                <a href="{!! url('/user/settings') !!}">
                    <img src="{{ asset('img/sidebar/settings.png') }}"/>
                    <span class="min-hide ">{!! trans('sidebar.menu.settings') !!}</span>
                </a>
            </li>
            <li>
                <a href="#" data-toggle="modal" data-target="#supportModal">
                    <span style="padding-left: 10px; padding-right: 22px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 422.694 422.694" style="enable-background:new 0 0 422.694 422.694; fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
                            <g>
                              <g>
                                <path d="M333.069,311.067c3.384-27.872,5.067-55.924,5.04-84c6.79-3.763,12.664-8.981,17.2-15.28    c12.88-18.16,13.92-44.08,3.2-77.12c-0.568-1.707-1.696-3.173-3.2-4.16l-5.36-3.6c0.861-29.88-9.402-59.016-28.8-81.76    c-24-26.56-60.72-40-109.44-40s-85.52,13.76-109.44,40c-19.398,22.744-29.661,51.88-28.8,81.76l-5.36,3.6    c-1.504,0.987-2.632,2.453-3.2,4.16c-18.56,57.2,2.16,81.84,19.84,92.24c-0.496,28.206,1.028,56.412,4.56,84.4    c-43.52,17.04-90.64,47.36-89.28,98.24c0,4.418,3.582,8,8,8h406.64c4.418,0,8-3.582,8-8    C423.949,358.427,376.349,328.027,333.069,311.067z M85.007,207.001c-15.928-16.007-12.889-42.764-6.018-65.054l6.8-4.56    c2.457-1.64,3.81-4.5,3.52-7.44c-1.516-27.051,7.29-53.67,24.64-74.48c20.72-22.72,53.52-34.48,97.36-34.64    c43.84-0.16,76.64,11.92,97.44,34.88c17.35,20.81,26.156,47.429,24.64,74.48c-0.29,2.94,1.063,5.8,3.52,7.44l6.88,4.56    c8,26.64,7.6,46.88-1.84,60.24c-1.303,1.817-2.776,3.504-4.4,5.04c-2.8-60.72-17.04-106.24-42.8-135.6    c-11.494-13.195-26.015-23.407-42.32-29.76h-0.72c-14.677-5.557-30.227-8.456-45.92-8.56c-29.292-1.201-57.554,10.916-76.88,32.96    C98.411,100.997,87.754,157.157,85.007,207.001z M271.549,280.747l0.08-0.32c5.285-6.488,9.647-13.676,12.96-21.36    c2.001-4.712,3.606-9.582,4.8-14.56l21.2-8.96c3.919-0.363,7.799-1.058,11.6-2.08c-0.3,24.064-1.848,48.096-4.64,72    c-14.978-5.004-30.263-9.039-45.76-12.08v-11.36C271.746,281.594,271.666,281.166,271.549,280.747z M236.989,257.867    c0,4.948-4.011,8.96-8.96,8.96c-4.948,0-8.96-4.012-8.96-8.96s4.012-8.96,8.96-8.96c0,0,0,0,0,0    c4.948,0.085,8.89,4.165,8.804,9.113c-0.001,0.056-0.002,0.111-0.004,0.167L236.989,257.867z M227.949,233.227l0.08-0.32    c-13.785-0.092-25.034,11.009-25.125,24.793s11.009,25.034,24.793,25.125c13.104,0.087,24.044-9.974,25.052-23.039l17.2-7.28    c-14.08,33.04-48.48,45.68-58.48,48.72c-43.84-24-66.56-48-65.68-71.36c1.44-37.28,61.12-64,67.92-67.2    c14.153-5.654,26.685-14.724,36.48-26.4c20.56,37.52,28.8,69.84,24.88,96.64l-26.4,11.12    C243.978,237.217,236.218,233.172,227.949,233.227z M100.669,219.947l0.32-0.24c1.52-50.08,10.4-109.12,40-143.04    c16.151-18.65,40.003-28.804,64.64-27.52c11.804,0.092,23.531,1.925,34.8,5.44c-0.347,7.498,0.628,14.999,2.88,22.16    c3.44,13.28,6.96,26.96,0,40c0,0,0,0,0,0.56c-0.148,0.259-0.282,0.526-0.4,0.8c0,0.72-6.08,17.2-35.44,29.92    c-12.64,5.44-75.76,35.12-77.52,81.2c-0.64,16.64,6.8,32.88,22.08,48.72c-0.639,1.125-0.996,2.387-1.04,3.68v11.28    c-15.773,3.084-31.326,7.2-46.56,12.32c-3.055-26.713-4.338-53.598-3.84-80.48C101.106,223.193,101.134,221.517,100.669,219.947z     M308.749,219.387c-0.991,0.033-1.968,0.25-2.88,0.64l-13.6,5.76c1.28-30.08-9.6-65.44-32.96-105.36c5.49-15.529,5.49-32.471,0-48    c-1.04-3.84-2-8-2.56-11.12c9.935,5.286,18.826,12.334,26.24,20.8c24.56,28.08,37.76,73.12,39.28,134.4    C317.912,218.071,313.364,219.04,308.749,219.387z M203.309,401.307H16.269c6.32-60.08,104-85.2,134.56-91.68v14    c0,18.16,22.08,32,52.48,34.32V401.307z M166.829,323.707L166.829,323.707v-32c12.544,9.639,25.931,18.126,40,25.36    c1.156,0.624,2.447,0.953,3.76,0.96h1.76c15.828-4.239,30.632-11.641,43.52-21.76v27.6c0,7.6-17.36,18.56-44.48,18.56    C184.269,342.427,166.829,331.067,166.829,323.707z M219.309,401.307v-43.28c30.4-2.08,52.48-16,52.48-34.32v-14    c30.8,6.4,128,31.44,134.56,91.68L219.309,401.307z"></path>
                              </g>
                            </g>
                        </svg>
                    </span>
                    <span class="min-hide ">Support</span>
                </a>
            </li>
            <li>
              <a href="#">
                <span style="padding-left: 10px; padding-right: 22px;">
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 129 129" enable-background="new 0 0 129 129" style="fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
                      <g>
                        <g>
                          <path d="m88.6,94.4c0.8,0.8 1.8,1.2 2.9,1.2s2.1-0.4 2.9-1.2l27-27c0.2-0.2 0.4-0.4 0.5-0.6 0,0 0.1-0.1 0.1-0.2 0.1-0.2 0.2-0.4 0.3-0.5 0-0.1 0-0.2 0.1-0.2 0.1-0.2 0.1-0.3 0.2-0.5 0.1-0.3 0.1-0.5 0.1-0.8 0-0.3 0-0.5-0.1-0.8 0-0.2-0.1-0.4-0.2-0.5 0-0.1 0-0.2-0.1-0.2-0.1-0.2-0.2-0.4-0.3-0.6 0,0 0-0.1-0.1-0.1-0.1-0.2-0.3-0.4-0.5-0.6l-27-27c-1.6-1.6-4.2-1.6-5.8,0-1.6,1.6-1.6,4.2 0,5.8l20,20h-71.1c-2.3,0-4.1,1.8-4.1,4.1 0,2.3 1.8,4.1 4.1,4.1h71.1l-20,20c-1.6,1.4-1.6,4 0,5.6z"/>
                          <path d="m10.5,122.5h54c2.3,0 4.1-1.8 4.1-4.1v-40.3c0-2.3-1.8-4.1-4.1-4.1s-4.1,1.8-4.1,4.1v36.2h-45.8v-99.7h45.8v36.2c0,2.3 1.8,4.1 4.1,4.1s4.1-1.8 4.1-4.1v-40.3c0-2.3-1.8-4.1-4.1-4.1h-54c-2.3,0-4.1,1.8-4.1,4.1v107.9c0.1,2.3 1.9,4.1 4.1,4.1z"/>
                        </g>
                      </g>
                    </svg>
                </span>
                <span class="min-hide text fs-16 clear-padding" data-toggle="modal" data-target="#logoutModal">{!! trans('modals.logout') !!}</span>
              </a>
            </li>
            <li class="no-hover logo-block">
                <a style="width: 100%; margin-left: 0;">
                    <img src="{{ asset('img/JobMap_white.svg') }}" />
                    <span style="
                                display: block;
                                text-align: center;
                                opacity: 0.3;
                                line-height: 15px;
                                font-size: 13px;
                                margin: 10px 0;
                                font-weight: bold;
                            ">{!! trans('sidebar.text.updated') !!}</span>
                    <span style="
                                display: block;
                                text-align: center;
                                opacity: 0.3;
                                margin-bottom: 30px;
                                line-height: 15px;
                                font-size: 13px;
                            ">Nov 21 2018</span>
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
    var sc_project = 11657179;
    var sc_invisible = 1;
    var sc_security = "dd52e090";
</script>
<script type="text/javascript"
        src="https://www.statcounter.com/counter/counter.js"
        async></script>
<noscript>
    <div class="statcounter"><a title="Web Analytics"
                                href="http://statcounter.com/" target="_blank"><img
                    class="statcounter"
                    src="//c.statcounter.com/11657179/0/dd52e090/1/" alt="Web
Analytics"></a></div>
</noscript>
<!-- End of StatCounter Code for Default Guide -->
