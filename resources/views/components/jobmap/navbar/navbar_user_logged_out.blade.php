<nav class="navbar navbar-light cr-navbar px-1 px-md-3" id="navbar" style="padding: 0 1rem; background-color: #fff;">
    <div class="d-flex justify-content-between col-12 px-0">
        <div class="align-self-center d-flex">
            <a class="navbar-brand py-0 mr-2 mr-lg-3 align-self-center" href="{!! url('/') !!}">
               <img src="{{ asset('img/jm_logo.jpg') }}" style="width: 45px;">
            </a>
            <div style="background-color: #eee; width: 1px; height: 55px;" class="align-self-center"></div>
            <a href="javascript:;" class="cr-nav-text mx-2 align-self-center widget_toggle d-lg-none d-block "
               style="margin-top:0!important;" data-toggle="tooltip" data-placement="bottom"
               title="{!! trans('main.navbar.create_my_JobMap') !!}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                     x="0px" y="0px" viewBox="0 0 512 512"
                     style="enable-background:new 0 0 30 30; width: 25px; height: 25px; fill:#4E5C6E; opacity: 0.7; vertical-align: middle; margin-top: -3px;"
                     xml:space="preserve">
                    <g>
                        <g>
                            <path d="M150.997,181.001c-33.09,0-60.999,26.908-60.999,59.999h121.998C211.996,207.91,184.087,181.001,150.997,181.001z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <polygon points="331.994,10.004 331.994,91.003 412.992,91.003"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M150.997,91.003c-16.538,0-30.999,13.462-30.999,29.999s14.462,29.999,30.999,29.999    c16.538,0,30.999-13.462,30.999-29.999S167.535,91.003,150.997,91.003z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M286.994,211.001h86.86c14.394-14.42,30.138-30.18,48.137-48.187v-41.811H316.994c-8.284,0-15-6.716-15-15V0.005H44.999    C20.099,0.005,0,21.103,0,46.004v419.992c0,24.898,20.099,45.999,44.999,45.999h331.993c24.901,0,44.999-21.101,44.999-45.999    V332.49l-84.095,84.082l-79.158,56.381c-17.855,12.686-42.439,10.86-58.153-5.068c-4.845-4.907-7.866-10.765-10.012-16.89h-24.577    c-8.291,0-15-6.709-15-15s6.709-15,15-15h24.802c1.436-3.898,2.968-7.798,5.539-11.309l54.579-74.354    c0.758-1.115,2.646-3.691,93.008-94.334h-56.93c-8.291,0-15-6.709-15-15S278.704,211.001,286.994,211.001z M196.996,390.997    H74.999c-8.291,0-15-6.709-15-15c0-8.291,6.709-15,15-15h121.998c8.291,0,15,6.709,15,15    C211.996,384.288,205.287,390.997,196.996,390.997z M196.996,330.998H74.999c-8.291,0-15-6.709-15-15s6.709-15,15-15h121.998    c8.291,0,15,6.709,15,15S205.287,330.998,196.996,330.998z M241.995,256c0,8.291-6.709,15-15,15H74.999c-8.291,0-15-6.709-15-15    v-15c0-33.914,19.074-63.148,46.85-78.487c-10.384-10.791-16.851-25.383-16.851-41.511c0-33.09,27.908-59.999,60.999-59.999    c33.09,0,60.999,26.909,60.999,59.999c0,16.128-6.465,30.72-16.849,41.511c27.776,15.338,46.848,44.572,46.848,78.487V256z     M286.994,151.002h59.999c8.291,0,15,6.709,15,15s-6.709,15-15,15h-59.999c-8.291,0-15-6.709-15-15    S278.704,151.002,286.994,151.002z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M503.201,166.44c-11.701-11.699-30.72-11.699-42.421,0.001c-0.698,0.699-20.482,20.506-46.784,46.861l42.386,42.386    l46.819-46.812C514.909,197.168,514.956,178.195,503.201,166.44z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M392.809,234.536c-37.671,37.763-80.857,81.106-102.958,103.458c20.723,5.149,36.962,21.477,41.937,42.267    l103.381-103.365L392.809,234.536z"/>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M276.081,366.139H265.52l-44.983,61.281c-4.358,5.938-3.761,14.161,1.41,19.406c5.171,5.246,13.385,5.962,19.384,1.688    l62.172-44.274v-10.664C303.502,378.443,291.197,366.139,276.081,366.139z"/>
                        </g>
                    </g>
                </svg>
            </a>

            <a href="javascript:;" class="mx-3 align-self-center d-lg-block d-none show-cv-widget"
               style="margin-top:0!important;" data-toggle="tooltip" data-placement="bottom"
               title="{!! trans('main.navbar.create_my_JobMap') !!}">
                <strong>{!! trans('main.navbar.create_my_JobMap') !!}</strong>
            </a>
            <a href="{!! url('/landing') !!}" class="cardinal_links align-self-center mx-2 d-md-flex d-none">{!! trans('main.hiring_add') !!}</a>
            <a href="{!! url('/latest/applications') !!}" class="cardinal_links align-self-center mx-2 d-md-flex d-none"><strong>{!! trans('main.latest') !!}</strong></a>
        </div>
        <div class="align-self-center d-flex">
                <p class="mb-0 px-1 align-self-center">
                    {!! trans('main.buttons.lang') !!}
                </p>
                <a class="align-self-center mr-md-3 mr-1 d-flex" href="{{ url('/') }}" style="padding: 5px 10px; font-size: 15px;">
                    {!! trans('main.explore_jobs_nav') !!}
                </a>

            <a class="cr-nav-text mr-2 align-self-center" href="#" id="show-sign-in" data-toggle="modal" data-target="#signInModal" style="color: #4E5C6E;">
                {!! trans('main.buttons.login') !!}
            </a>

                <!-- <li class="nav-item d-lg-block d-none">
                    <a class="cr-nav-button" href="#" id="show-sign-in" style="margin-top: -5px;">{!! trans('main.buttons.get_started') !!}</a>
                </li> -->
        </div>
    </div>
</nav>

