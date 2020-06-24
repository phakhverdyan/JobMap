
	<nav class="navbar navbar-fixed-top navbar-expand navbar-light cr-navbar px-1 px-md-2"  style="background-color: #fff;">
      <div class="d-flex justify-content-between col-12 px-0">
          <div id="nav-logo-block" class="align-self-center d-flex">
              <a class="navbar-brand py-0 align-self-center mr-auto ml-auto" href="{!! url('/user/dashboard') !!}">
                  <img src="{{ asset('img/jm_logo.jpg') }}" style="width: 45px;" alt="logo">
              </a>
          </div>
        <div class="align-self-center d-flex mr-auto">
            <div class="align-self-center" style="background-color: #eee; width: 1px; height: 55px;"></div>

            <a href="#" id="toggle-menu" data-activates="slide-out" class="button-collapse table-mode-show"><i class="fas fa-bars"></i></a>

            <div class="align-self-center table-mode-show" style="background-color: #eee; width: 1px; height: 55px;margin-right: 5px;"></div>

          <a href="{!! url('/user/messages') !!}" class="cr-nav-text mx-3 margin-sm-2 align-self-center"  style="position:relative;margin-top:0!important;color: rgba(256,256,256,0.8);" data-toggle="tooltip" data-placement="bottom" title="{!! trans('main.notifications') !!}">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 30 30; width: 25px; height: 25px; fill:#4E5C6E; opacity:0.7; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
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
              <span style="position: absolute; top: -10px; left: -10px;" class="global-chat-typing chat-dot-typing-icon"></span>
                <span class="notification realtime__total-count-of-unread-chats-with-unread-messages" style="display: none; margin-top: 0; top: -8px; right: -12px; color: #ffffff !important; background-color: #ffa200;">0</span>
          </a>
          <div class="align-self-center" style="background-color: #eee; width: 1px; height: 55px;"></div>
{{--          <a href="{{ url('/') }}" class="cr-nav-text mx-sm-3 mx-2 align-self-center"  style="margin-top:0!important;color: rgba(256,256,256,0.8);" data-toggle="tooltip" data-placement="bottom" title="{!! trans('navbar.explore_jobmap') !!}">--}}
{{--              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 30 30; width: 25px; height: 25px; fill:#1dc343; opacity:0.7; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 30 30" xml:space="preserve"><path d="M25,17.238v7.481l-6-1.5v-3.168l-2-2.813v6.008l-5,1.429V8.781l0.011-0.003c0.018-0.739,0.127-1.455,0.314-2.14  l-0.788,0.197c-0.34,0.085-0.697,0.079-1.035-0.017L4.339,5.056C3.668,4.865,3,5.368,3,6.066v17.179c0,0.893,0.592,1.678,1.45,1.923  l6.194,1.77c0.233,0.066,0.479,0.066,0.712,0l6.147-1.756c0.337-0.096,0.694-0.102,1.035-0.017l7.158,1.79  C26.358,27.121,27,26.619,27,25.936V15.643L25,17.238z M10,24.674l-5-1.428V7.326l5,1.428V24.674z"/><g><path d="M21,2c-3.866,0-7,3.134-7,7c0,4.604,4.551,6.745,5.121,7.258c0.582,0.524,1.063,1.575,1.258,2.241   c0.094,0.323,0.359,0.487,0.621,0.494c0.263-0.007,0.527-0.171,0.621-0.494c0.194-0.665,0.675-1.717,1.258-2.241   C23.449,15.745,28,13.604,28,9C28,5.134,24.866,2,21,2z M21,11c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S22.105,11,21,11z"/>--}}
{{--              </g>--}}
{{--              </svg>--}}
{{--          </a>--}}
          <div class=" align-self-center d-md-block email_confirm_push_separator" style="background-color: #eee; width: 1px; height: 55px; display: none !important;"></div>
          <a href="javascript;" class="cr-nav-text mx-sm-3 mx-2 align-self-center d-md-block email_confirm_push" style="margin-top:0!important;color: rgba(256,256,256,0.8); display: none !important;" data-toggle="modal" data-target="#verificationCodeGoTime">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" style="width: 25px; height: 25px; fill:#4E5C6E; opacity:0.7; vertical-align: middle; margin-top: -3px;" >
                <path style="line-height:normal;text-indent:0;text-align:start;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#000;text-transform:none;block-progression:tb;isolation:auto;mix-blend-mode:normal" d="M 2.5 2 C 1.6774686 2 1 2.6774686 1 3.5 L 1 11.5 C 1 12.322531 1.6774686 13 2.5 13 L 7.2753906 13 C 7.8970971 14.741637 9.5487862 16 11.5 16 C 13.979359 16 16 13.979359 16 11.5 C 16 10.440389 15.616209 9.477153 15 8.7070312 L 15 3.5 C 15 2.6774686 14.322531 2 13.5 2 L 2.5 2 z M 2.5 3 L 13.5 3 C 13.533508 3 13.562289 3.0135998 13.59375 3.0195312 L 8 6.8925781 L 2.40625 3.0195312 C 2.4377112 3.0135998 2.4664925 3 2.5 3 z M 2 3.953125 L 8 8.1074219 L 14 3.9550781 L 14 7.7617188 C 13.284198 7.2811365 12.424149 7 11.5 7 C 9.0206409 7 7 9.0206409 7 11.5 C 7 11.67136 7.0319923 11.833538 7.0507812 12 L 2.5 12 C 2.2185314 12 2 11.781469 2 11.5 L 2 3.953125 z M 11.5 8 C 13.438919 8 15 9.5610811 15 11.5 C 15 13.438919 13.438919 15 11.5 15 C 9.5610811 15 8 13.438919 8 11.5 C 8 9.5610811 9.5610811 8 11.5 8 z M 13.271484 10.021484 L 11.5 11.792969 L 10.291016 10.583984 L 9.5839844 11.291016 L 11.5 13.207031 L 13.978516 10.728516 L 13.271484 10.021484 z" font-weight="400" font-family="sans-serif" white-space="normal" overflow="visible"/>
            </svg>
          </a>
        </div>
        <div class="align-self-center">
          <div class="justify-content-center mr-2 ml-auto d-flex">
            <a class="px-md-4 align-self-center mr-3 d-flex" href="{{ url('/') }}" style="padding: 5px 10px; font-size: 15px;">
              {!! trans('main.explore_jobs_nav') !!}
            </a>
            @include('components.thumbnail.thumbnail_user')
          </div>
        </div>
      </div>

	    <!-- <div style="background-color: #eee; width: 1px; height: 55px;"></div> -->

	    <a href="https://jobmap.co/cardinal" class="cr-nav-text mr-3 jobs_navbar"  style="margin-top:0!important;color: rgba(256,256,256,0.8);">
			{!! trans('navbar.jobs_link') !!}
	    </a>

		<!-- <button class="navbar-toggler order-3" type="button" data-toggle="collapse" data-target="#collapsingNavbar">
			<span class="navbar-toggler-icon"></span>
		</button> -->
		<button class="navbar-toggle ml-auto mr-0" type="button" data-toggle="collapse" data-target="#collapsingNavbar" aria-expanded="true">
			<span class="sr-only"></span>
			<span class="icon-bar top-bar"></span>
			<span class="icon-bar middle-bar"></span>
			<span class="icon-bar bottom-bar"></span>
		</button>


	</nav>

