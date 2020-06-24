<nav class="navbar navbar-light bg-white cr-navbar px-1 px-md-3" id="navbar-auth" style="padding: 0 1rem;">
    <div class="d-flex justify-content-between col-12 px-0">
        <div class="align-self-center d-flex">
            <a class="navbar-brand py-0 mr-2 mr-lg-3 align-self-center" href="{!! url('/') !!}">
               <img src="{{ asset('img/jm_logo.jpg') }}" style="width: 45px;" alt="logo">
            </a>
            <div style="background-color: #eee; width: 1px; height: 55px;" class="align-self-center"></div>
            <a href="{{ config('app.url') }}/user/messages" class="cr-nav-text mx-3 align-self-center"
               style="position:relative;margin-top:0!important;color: rgba(256,256,256,0.8);" data-toggle="tooltip"
               data-placement="bottom" title="{!! trans('main.notifications') !!}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                     x="0px" y="0px" viewBox="0 0 512 512"
                     style="enable-background:new 0 0 30 30; width: 25px; height: 25px; fill: #4E5C6E; opacity: 0.7; vertical-align: middle; margin-top: -3px;"
                     xml:space="preserve">
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
                <span style="position: absolute; top: -10px; left: -10px;"
                      class="global-chat-typing chat-dot-typing-icon"></span>
                <span class="notification realtime__total-count-of-unread-chats-with-unread-messages"
                      style="display: none; margin-top: 0; top: -8px; right: -12px; color: #ffffff !important; background-color: #ffa200;">0</span>
            </a>
            <div style="background-color: #eee; width: 1px; height: 55px;" class="align-self-center"></div>
            <a href="{{ config('app.url') }}/business/dashboard" class="cardinal_links mx-sm-3 mx-2 align-self-center d-md-block d-none"  style="margin-top:0!important; font-weight: bold;">
                Employer
            </a>

        </div>
        <div class="align-self-center">
            <ul class="navbar-nav flex-row ml-auto cr-nav-items" id="auth-no-login" style="height: 40px;vertical-align: middle;box-sizing: border-box;">
                <li class="nav-item align-self-center">
                    <a class="align-self-center mr-0 mr-lg-0 d-flex" href="{!! url('/') !!}" style="padding: 5px 10px; font-size: 15px;">
                        {!! trans('main.explore_jobs_nav') !!}
                    </a>
                </li>
                <li class="nav-item align-self-center align-self-center ml-1 ml-lg-3 mr-0">
                    @include('components.thumbnail.thumbnail_user')
                </li>
            </ul>
        </div>
    </div>

</nav>

