<nav class="navbar navbar-light bg-white cr-navbar px-1 px-md-3" id="navbar-auth" style="padding: 0 1rem;">
    <div class="d-flex justify-content-between col-12 px-0">
        <div class="align-self-center d-flex">
            <a class="navbar-brand py-0 mr-2 mr-lg-3 align-self-center" href="{!! url('/') !!}">
                <img src="{{ asset('img/jm_logo.jpg') }}" style="width: 45px;" alt="logo">
            </a>
            <div style="background-color: #eee; width: 1px; height: 55px;" class="align-self-center"></div>
            <a href="{!! url('/user/messages') !!}" class="cr-nav-text mx-3 align-self-center"
               style="position:relative;margin-top:0!important;color: rgba(256,256,256,0.8);" data-toggle="tooltip"
               data-placement="bottom" title="{!! trans('main.messages') !!}">
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
            <a href="{{ config('services.jobmap_url') }}/map" class="cr-nav-text mx-sm-3 mx-2 align-self-center"  style="margin-top:0!important;color: rgba(256,256,256,0.8);" data-toggle="tooltip" data-placement="bottom" title="{!! trans('navbar.explore_jobmap') !!}">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 30 30; width: 25px; height: 25px; fill:#1dc343; opacity:0.7; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 30 30" xml:space="preserve"><path d="M25,17.238v7.481l-6-1.5v-3.168l-2-2.813v6.008l-5,1.429V8.781l0.011-0.003c0.018-0.739,0.127-1.455,0.314-2.14  l-0.788,0.197c-0.34,0.085-0.697,0.079-1.035-0.017L4.339,5.056C3.668,4.865,3,5.368,3,6.066v17.179c0,0.893,0.592,1.678,1.45,1.923  l6.194,1.77c0.233,0.066,0.479,0.066,0.712,0l6.147-1.756c0.337-0.096,0.694-0.102,1.035-0.017l7.158,1.79  C26.358,27.121,27,26.619,27,25.936V15.643L25,17.238z M10,24.674l-5-1.428V7.326l5,1.428V24.674z"/><g><path d="M21,2c-3.866,0-7,3.134-7,7c0,4.604,4.551,6.745,5.121,7.258c0.582,0.524,1.063,1.575,1.258,2.241   c0.094,0.323,0.359,0.487,0.621,0.494c0.263-0.007,0.527-0.171,0.621-0.494c0.194-0.665,0.675-1.717,1.258-2.241   C23.449,15.745,28,13.604,28,9C28,5.134,24.866,2,21,2z M21,11c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S22.105,11,21,11z"/>
                </g>
                </svg>
            </a>
        </div>
        <div class="align-self-center">
            <div class="d-lg-block d-none  align-self-center">
              <div class="d-flex mx-3 justify-content-between search_navbar" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px; width: 250px;">
                  <input type="text" name="search" class="form-control w-100 border-0 jm_nav_search"
                         style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
                         placeholder="Job title, keywords, or company" id="nav-search" autocomplete="disabled">
                  <div class="align-self-center mr-2 mt-1">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                           x="0px" y="0px" viewBox="0 0 250.313 250.313"
                           style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px"
                           height="17px">
                          <g id="Search">
                              <path style="fill-rule:evenodd;clip-rule:evenodd;"
                                    d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                          </g>
                      </svg>
                  </div>
              </div>
            </div>
        </div>
        <div class="align-self-center">
            <ul class="navbar-nav flex-row ml-auto cr-nav-items" id="auth-no-login" style="height: 40px;vertical-align: middle;box-sizing: border-box;">
                <li class="nav-item d-lg-block d-none align-self-center">
                    <a class="px-4 align-self-center mr-3" href="{!! url() !!}" style="padding: 5px 10px; font-size: 15px;">
                        <strong>Explore</strong> Jobs
                    </a>
                </li>
                <li class="nav-item align-self-center mr-0">
                    @include('components.thumbnail.thumbnail_user')
                </li>
            </ul>
        </div>
    </div>
    <!-- <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#collapsingNavbar"
            aria-expanded="true">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar top-bar"></span>
        <span class="icon-bar middle-bar"></span>
        <span class="icon-bar bottom-bar"></span>
    </button> -->
</nav>
	
