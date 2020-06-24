<style type="text/css">
    .table th, .table td {
        padding: 10px;
    }
</style>

<div class="col-11 col-xl-9 mb-4 mx-auto mt-3 py-3 bg-white rounded">
    <p class="mb-2 text-left">
      <span>
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
               x="0px" y="0px" viewBox="0 0 414.339 414.339"
               style="enable-background:new 0 0 414.339 414.339; vertical-align: middle; margin-top: -3px; opacity: 0.2;"
               xml:space="preserve" width="20px" height="20px" class="mr-2">
              <g>
                  <path d="M408.265,162.615L230.506,58.601c-3.795-2.222-8.485-2.241-12.304-0.057c-3.815,2.187-6.17,6.246-6.174,10.644   l-0.036,46.966c-0.213,0.052-0.38,0.094-0.495,0.126c-4.442,1.239-9.163,2.603-14.854,4.294   c-18.457,5.483-37.417,12.593-59.668,22.374c-19.309,8.487-38.201,19.442-56.15,32.559c-12.826,9.373-24.894,20.182-35.867,32.126   C15.1,240.129-1.259,283.28,0.076,326.023c0.234,7.488,1.076,14.674,1.869,20.716c0.788,6.007,5.84,10.541,11.898,10.677   c0.093,0.002,0.186,0.003,0.277,0.003c5.94,0,11.048-4.263,12.086-10.139c3.304-18.678,8.574-34.022,16.111-46.91   c9.42-16.104,22.223-29.625,37.021-39.102c12.718-8.146,26.153-14.396,41.075-19.113c17.405-5.503,36.597-8.952,58.671-10.545   c8.907-0.644,18.502-0.967,30.2-1.021c0.354,0,1.112,0.007,2.098,0.02l0.032,44.29c0.003,4.372,2.332,8.413,6.113,10.607   c3.782,2.196,8.446,2.214,12.245,0.049l178.37-101.678c3.811-2.172,6.172-6.21,6.196-10.597   C414.366,168.896,412.05,164.831,408.265,162.615z"></path>
              </g>
          </svg>
      </span>
        {!! trans('resume_builder.link_box.title') !!}
    </p>
    <div class="col-12 d-flex flex-column flex-lg-row px-0 justify-content-between">
        <div class="btn-group mt-1 col-12 col-lg-7 px-0 align-self-center d-block d-md-flex" role="group" aria-label="Basic example">
            <button class="btn width-100-md btn-outline-success mr-0 d-flex align-items-center" type="button"
                    data-clipboard-action="copy" data-clipboard-target="#link-user-profile" id="overview__clipboard-button">
                <svg version="1.1" id="Capa_1" class="mr-2" xmlns="http://www.w3.org/2000/svg" width="15px"
                     height="15px" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 488.3 488.3"
                     style="enable-background:new 0 0 488.3 488.3;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                            C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                            c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z" data-original="#000000"
                              class="active-path" data-old_color="#28a745"></path>
                        <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                            c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                            V38.6C439.65,17.3,422.35,0,401.05,0z" data-original="#000000" class="active-path"
                              data-old_color="#28a745"></path>
                    </g>
                </g>
            </svg>
                {!! trans('main.buttons.copy_btn') !!}
            </button>
            <input type="text" id="link-user-profile"
                   value="{!! request()->getSchemeAndHttpHost() !!}/u/{{ $args['username'] }}"
                   class="form-control bg-light border-top-left-0 border-top-right-0 border-bottom-left-0 border-bottom-right-0"
                   readonly="" placeholder="{!! request()->getSchemeAndHttpHost() !!}/u/{{ $args['username'] }}" aria-label="Search for...">

            <a class="btn btn-outline-primary mr-0 d-flex align-items-center" role="button" data-toggle="modal"
               data-target="#emailmodal">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                     id="Layer_1" x="0px" y="0px" viewBox="0 0 512.625 512.625"
                     style="enable-background:new 0 0 478.703 478.703;" xml:space="preserve" width="15px" height="15px"
                     class="mr-2">
                <g>
                    <g>
                        <path d="M506.354,326.375C481.54,305.273,436.651,267.576,405.333,244V106.979c0-23.531-19.146-42.667-42.667-42.667h-320    C19.146,64.313,0,83.448,0,106.979v213.333c0,23.531,19.146,42.667,42.667,42.667h214.625    c3.565,12.277,14.788,21.333,28.208,21.333h77.167v40.781c0,12.802,10.417,23.219,23.208,23.219c6.625,0,11.583-3.115,14.75-5.458    c31.354-23.177,79.688-63.792,105.688-85.917c2.875-2.427,6.313-7.052,6.313-15.292    C512.625,333.406,509.188,328.781,506.354,326.375z M42.667,85.646h320c0.443,0,0.814,0.225,1.25,0.253L211.688,210.917    c-5.583,3.625-13.417,2.938-17.083,0.688L41.424,85.897C41.858,85.871,42.227,85.646,42.667,85.646z M256,328.469v13.177H42.667    c-11.771,0-21.333-9.573-21.333-21.333V106.979c0-3.021,0.668-5.875,1.805-8.482l158.883,130.294    c6.208,4.052,13.354,6.188,20.646,6.188c7.25,0,14.396-2.125,21.646-6.885L382.194,98.496c1.138,2.608,1.806,5.461,1.806,8.483    v128.38c-11.872,1.007-21.333,10.702-21.333,22.839v40.781H285.5C269.229,298.979,256,312.208,256,328.469z M491.292,341.646    v0.073c-26.104,22.188-73,61.542-103.333,83.99c-1.521,1.115-2.063,1.26-2.083,1.271c-1.042,0-1.875-0.844-1.875-1.885v-51.448    c0-5.896-4.771-10.667-10.667-10.667H285.5c-4.5,0-8.167-3.656-8.167-8.156v-26.354c0-4.5,3.667-8.156,8.167-8.156h87.833    c5.896,0,10.667-4.771,10.667-10.667v-51.448c0-1.042,0.833-1.885,1.813-1.885c0.083,0.01,0.625,0.156,2.146,1.271    c30.333,22.438,77.208,61.771,103.333,83.99C491.292,341.594,491.292,341.625,491.292,341.646z"></path>
                    </g>
                </g>
            </svg>
                {!! trans('main.buttons.email_btn') !!}
            </a>
        </div>
        <div class="pt-1 text-right">
            <a {{--id="user-resume-attach_file-click"--}} class="user-resume-attach_file-click btn btn-primary btn-sm mt-1" role="button" href="javascript:;">{!! trans('lets_get_started.user.upload_resume') !!}</a>
            <a href="{!! url('/user/print-builder') !!}" role="button" class="btn btn-warning btn-sm mt-1" data-toggle="tooltip" title="{!! trans('main.coming_soon') !!}">{!! trans('main.buttons.print_btn') !!}</a>
            <a href="{!! url('/user/resume/create') !!}" role="button"
               class="btn btn-primary btn-sm mt-1">{!! trans('main.buttons.resume_builder') !!}</a>
        </div>
    </div>
</div>
<hr>


<div class="col-11 mx-auto resume_overview_xxl_screen" style="flex: 0 0 75%; max-width: 75%;">
  <div class="d-flex flex-lg-row flex-column" style="background-color: #dae0e5;">
    <div class="col-lg-4 py-3">
      <div class="text-center">
        <img src="{{ $data['picture']}}" style="width: 200px; height: 200px;" class="rounded">
      </div>
    </div>
    <div class="col-lg-8 align-self-center py-3">
      <div class="text-center">
        <p class="mb-1 resume_name" style="font-size: 60px;">
          {{ $args['first_name'].' '.$args['last_name'] }}
        </p>
        @if($args['basic']['headline'])
          <h3 class="resume_headline" style="font-weight: 400;">{{ $args['basic']['headline'] }}</h3>
        @endif
      </div>
    </div>
  </div>
  <div class="d-flex flex-lg-row flex-column">
    <!-- left side -->
    <div class="col-lg-4 py-3" style="background-color: #efefef;">
      
      @if($args['basic']['about'])
      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.print.about_me') !!}</h3>
        <p class="text-justify" style="line-height: 1.4;">
          {{ $args['basic']['about'] }}
        </p>
      </div>
      @endif

      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('main.label.contact') !!}</h3>

        @if($data['phone'])
          <div class="text-center mb-3">
            <p class="mb-1">
              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 472.811 472.811" enable-background="new 0 0 472.811 472.811" width="50px">
                <g>
                  <path d="M358.75,0H114.061C97.555,0,84.128,13.428,84.128,29.934v412.944c0,16.505,13.428,29.934,29.934,29.934H358.75   c16.506,0,29.934-13.428,29.934-29.934V29.934C388.683,13.428,375.256,0,358.75,0z M99.128,75.236h274.556v312.687H99.128V75.236z    M114.061,15H358.75c8.234,0,14.934,6.699,14.934,14.934v35.302H99.128V29.934C99.128,21.699,105.827,15,114.061,15z    M358.75,457.811H114.061c-8.234,0-14.934-6.699-14.934-14.934v-44.955h274.556v44.955   C373.683,451.112,366.984,457.811,358.75,457.811z"/>
                  <path d="m236.406,404.552c-13.545,0-24.564,11.02-24.564,24.565s11.02,24.564 24.564,24.564 24.564-11.02 24.564-24.564-11.019-24.565-24.564-24.565zm0,39.129c-8.031,0-14.564-6.534-14.564-14.564 0-8.031 6.533-14.565 14.564-14.565s14.564,6.534 14.564,14.565c0,8.03-6.533,14.564-14.564,14.564z"/>
                  <path d="m202.406,47.645h68c2.762,0 5-2.239 5-5s-2.238-5-5-5h-68c-2.762,0-5,2.239-5,5s2.238,5 5,5z"/>
                  <path d="m184.409,47.645c1.31,0 2.6-0.53 3.53-1.46 0.93-0.94 1.47-2.22 1.47-3.54s-0.54-2.6-1.47-3.54c-0.931-0.93-2.221-1.46-3.53-1.46-1.32,0-2.601,0.53-3.54,1.46-0.93,0.93-1.46,2.22-1.46,3.54s0.53,2.6 1.46,3.54c0.93,0.93 2.22,1.46 3.54,1.46z"/>
                </g>
              </svg>
            </p>
            <p>{{ $data['phone'] }}</p>
          </div>
        @endif


        <div class="text-center mb-3">
          <p class="mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 452.84 452.84" enable-background="new 0 0 452.84 452.84" width="50px">
              <g>
                <path d="m449.483,190.4l.001-.001-57.824-38.335v-128.134c0-4.142-3.358-7.5-7.5-7.5h-315.49c-4.142,0-7.5,3.358-7.5,7.5v128.143l-57.814,38.326 .001,.002c-2.022,1.343-3.357,3.639-3.357,6.249v232.26c0,4.142 3.358,7.5 7.5,7.5h437.84c4.142,0 7.5-3.358 7.5-7.5v-232.26c0-2.61-1.335-4.906-3.357-6.25zm-388.313,26.229l-23.525-12.479h23.525v12.479zm-46.17-7.511l172.475,91.49-172.475,114.327v-205.817zm211.417,83.671l194.037,128.621h-388.073l194.036-128.621zm38.945,7.82l172.477-91.491v205.821l-172.477-114.33zm126.298-96.459h23.536l-23.536,12.484v-12.484zm28.794-15h-28.794v-19.09l28.794,19.09zm-43.794-157.72v193.161l-125.527,66.586-20.573-13.637c-2.511-1.665-5.776-1.665-8.287,0l-20.57,13.635-125.533-66.589v-193.156h300.49zm-315.49,157.72h-28.782l28.782-19.08v19.08z"/>
                <path d="m226.415,213.671h59.754c4.142,0 7.5-3.358 7.5-7.5s-3.358-7.5-7.5-7.5h-59.754c-28.813,0-52.254-23.441-52.254-52.254v-2.213c0-28.813 23.441-52.254 52.254-52.254s52.254,23.441 52.254,52.254v5.533c0,6.237-5.074,11.312-11.312,11.312s-11.312-5.074-11.312-11.312v-10.512c0-17.864-14.533-32.398-32.397-32.398s-32.397,14.533-32.397,32.398c0,17.864 14.533,32.397 32.397,32.397 8.169,0 15.636-3.045 21.34-8.052 4.644,7.483 12.932,12.478 22.369,12.478 14.508,0 26.312-11.803 26.312-26.312v-5.533c0-37.084-30.17-67.254-67.254-67.254s-67.254,30.17-67.254,67.254v2.213c5.68434e-14,37.085 30.17,67.255 67.254,67.255zm-2.767-57.049c-9.593,0-17.397-7.804-17.397-17.397s7.805-17.398 17.397-17.398 17.397,7.805 17.397,17.398-7.804,17.397-17.397,17.397z"/>
              </g>
            </svg>
          </p>
          <p>{{ $args['email'] }}</p>
        </div>

        <div class="text-center mb-3">
          <p class="mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58.365 58.365" style="enable-background:new 0 0 58.365 58.365;" xml:space="preserve"  width="50px">
              <path d="M57.863,26.632l-8.681-8.061V5.365h-10v3.921L29.182,0L0.502,26.632c-0.404,0.376-0.428,1.009-0.052,1.414  c0.375,0.404,1.008,0.427,1.414,0.052l3.319-3.082v33.349h16h16h16V25.015l3.319,3.082c0.192,0.179,0.437,0.267,0.681,0.267  c0.269,0,0.536-0.107,0.732-0.319C58.291,27.641,58.267,27.008,57.863,26.632z M41.182,7.365h6v9.349l-6-5.571V7.365z   M23.182,56.365V35.302c0-0.517,0.42-0.937,0.937-0.937h10.126c0.517,0,0.937,0.42,0.937,0.937v21.063H23.182z M51.182,56.365h-14  V35.302c0-1.62-1.317-2.937-2.937-2.937H24.119c-1.62,0-2.937,1.317-2.937,2.937v21.063h-14V23.158l22-20.429l14.28,13.26  l5.72,5.311v0l2,1.857V56.365z"/>
            </svg>
          </p>
          <p>
            {{ $data['location'] }}
          </p>
        </div>

        @if($args['basic']['website'])
        <?php
            $st = '';
            if (strpos($args['basic']['website'], 'http') === false) {
                $st = 'http://';
            }
        ?>
        <div class="text-center mb-3">
          <p class="mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 467.211 467.211" enable-background="new 0 0 467.211 467.211" width="50px">
              <g>
                <path d="m413.917,96.775h-360.622c-6.369,0-11.551,5.181-11.551,11.55v213.182c0,6.369 5.182,11.55 11.551,11.55h360.622c6.368,0 11.55-5.181 11.55-11.55v-213.181c-5.68434e-14-6.369-5.182-11.551-11.55-11.551zm1.55,224.732c0,0.855-0.695,1.55-1.55,1.55h-360.622c-0.855,0-1.551-0.696-1.551-1.55v-213.181c0-0.855 0.695-1.55 1.551-1.55h360.622c0.854,0 1.55,0.696 1.55,1.55v213.181z"/>
                <path d="m459.711,340.558h-11.744v-237.715c0-15.752-12.815-28.568-28.568-28.568h-371.586c-15.753,0-28.568,12.815-28.568,28.568v237.714h-11.745c-4.143,0-7.5,3.358-7.5,7.5v20.605c0,13.384 10.889,24.272 24.272,24.272h418.666c13.384,0 24.272-10.889 24.272-24.272v-20.605c0.001-4.141-3.356-7.499-7.499-7.499zm-425.467-237.715c-2.84217e-14-7.481 6.087-13.568 13.568-13.568h371.586c7.481,0 13.568,6.086 13.568,13.568v237.714h-398.722v-237.714zm177.361,252.715h44v3.922c0,1.755-1.428,3.184-3.184,3.184h-37.633c-1.756,0-3.184-1.428-3.184-3.184v-3.922zm240.607,13.105c0,5.113-4.159,9.272-9.272,9.272h-418.667c-5.113,0-9.272-4.16-9.272-9.272v-13.105h11.744 174.861v3.922c0,7.27 5.914,13.184 13.184,13.184h37.633c7.27,0 13.184-5.914 13.184-13.184v-3.922h174.861 11.744v13.105z"/>
              </g>
            </svg>
          </p>
          <p>
            {{ $args['basic']['website'] }}
          </p>
        </div>
        @endif

        <div class="text-center mb-3">
            @if ($args['basic']['facebook'])
              <div class="mb-2">
                <p class="mb-1"><img src="{{ asset('img/icons/facebook.svg') }}" width="30px" height="30px"></p>
                <p>{!! $args['basic']['facebook'] !!}</p>
              </div>
            @endif
            @if ($args['basic']['instagram'])
              <div class="mb-2">
                <p class="mb-1"><img src="{{ asset('img/icons/instagram.svg') }}" width="30px" height="30px"></p>
                <p>{!! $args['basic']['instagram'] !!}</p>
              </div>
            @endif
            @if ($args['basic']['linkedin'])
              <div class="mb-2">
                <p class="mb-1"><img src="{{ asset('img/icons/linkedin.svg') }}" width="30px" height="30px"></p>
                <p>{!! $args['basic']['linkedin'] !!}</p>
              </div>
            @endif
            @if ($args['basic']['twitter'])
              <div class="mb-2">
                <p class="mb-1"><img src="{{ asset('img/icons/twitter.svg') }}" width="30px" height="30px"></p>
                <p>{!! $args['basic']['twitter'] !!}</p>
              </div>
            @endif
        </div>

      </div>

      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.items.preferences') !!}</h3>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.im_now') !!} </strong> {{ $data['current_job_name'] }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.im_a') !!} </strong> {{ $data['current_type_name'] }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.looking_for') !!}</strong> {{ trans('main.buttons.'.$args['preference']['looking_job']) }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.opened_opportunities') !!}</strong> {{ trans('main.buttons.'.$args['preference']['new_opportunities']) }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.interested_job_types') !!}</strong> {{ $data['interested_jobs_name'] }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.preferred_industries') !!}</strong>
            {{ rtrim($args['preference']['industry']['name'] . ', ' . $args['preference']['sub_industry']['name'], ', ') }}
        </p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.preferred_jobs') !!}</strong>
            {{ rtrim($args['preference']['category']['name'] . ', ' . $args['preference']['sub_category']['name'], ', ') }}
        </p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.open_new_job') !!}</strong> {{ trans('main.buttons.'.$args['preference']['new_job']) }}</p>
        
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.preferences.max_distance') !!}</strong> {{ $args['preference']['distance'] }} {{ trans('main.distance.'.$args['preference']['distance_type']) }}
        </p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.preferences.hourly_salary') !!}</strong> {{ $args['preference']['salary'] }}{{--{{ $args['preference']['salary_type'] }}--}}{!! trans('resume_builder.overview.per_hour') !!}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.preferences.weekly_hours') !!}</strong> {{ $args['preference']['hours_from'] }}
            {!! trans('main.label.h') !!}-{{ $args['preference']['hours_to'] }}{!! trans('main.label.h') !!}</p>
        
        
      </div>

      <div class="mb-5">
        <div class="text-center">
          <p class="mb-1">
            <img src="{{ asset('img/landing/cr-logo.png') }}" class="align-self-center" width="45px">
          </p>
            {{--<span id="link-user-profile">--}}
            <p><a href="{!! request()->getSchemeAndHttpHost() !!}/u/{{ $args['username'] }}">{!! request()->getSchemeAndHttpHost() !!}/u/{{ $args['username'] }}</a></p>
            {{--</span>--}}
        </div>
        <div class="text-center">
          <img src="https://upload.wikimedia.org/wikipedia/commons/8/8f/Qr-4.png" width="125px" height="125px">
        </div>
      </div>

      @if(count($args['skill']) > 0)
      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.items.skill') !!}</h3>
        @foreach($args['skill'] as $skill)
          <div class="text-center mb-3">
            <p class="mb-1">{{ $skill['title'] }}</p>
            <div class="bg-light rounded border mx-auto mr-3" style="width:130px; height: 12px">
              <div class="bg-primary rounded" style="width: {{ $skill['level'] }}%; height: 100%;"></div>
            </div>
            <span class="text-left mb-0 mr-3 " style="flex:1;"></span>
          </div>
        @endforeach
      </div>
      @endif

      @if(count($args['languages']) > 0)
      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.items.languages') !!}</h3>
        @foreach($args['languages'] as $language)
          <div class="text-center mb-3">
            <p class="mb-1">{{ $language['title'] }}</p>
            <div class="bg-light rounded border mr-3 mx-auto" style="width:130px; height: 12px">
                <div class="bg-primary rounded" style="width: {{ $language['level'] }}%; height: 100%;"></div>
            </div>
          </div>
        @endforeach
      </div>
      @endif

      @if(count($args['interest']) > 0 || count($args['hobby']) > 0)
      <div>
        <h3 class="text-center mb-4" style="line-height: 1;">{!! trans('resume_builder.items.hobbies_interests') !!}</h3>

        <ul class="pl-0 d-table mx-auto text-left">
          @foreach($args['hobby'] as $hobby)
          <li>{{ $hobby['title'] }}</li>
          @endforeach
          @foreach($args['interest'] as $interest)
          <li>{{ $interest['title'] }}</li>
          @endforeach
        </ul>
      </div>
      @endif



    </div>
    <!-- /left side -->
    <!-- right side -->
    <div class="col-lg-8 py-3 pl-lg-4 pl-0 text-left">


      @if(count($args['education']) > 0)
      <div class="mb-5">
        @foreach($args['education'] as $key => $education)
          @if ($key == 0)
          <div class="d-flex justify-content-between">
            <h3 class="mb-4">{!! trans('resume_builder.items.education') !!}</h3>
            <button type="button" class="btn btn-link p-0 mr-2 border-0" data-link="{{ route('user.resume.create',['tab' => 'education']) }}">
              <span class="d-flex align-items-center justify-content-center">
                  <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px"
                       height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                       style="fill:rgba(6,70,166,0.2)!important;"><g id="background">
                        <rect fill="none" height="32" width="32"/></g>
                        <g id="edit">
                          <polygon points="10,28 4,28 4,22  "/>
                          <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"/>
                          <polygon points="4,32 4,30 26,30 26,32 4,32  "/>
                        </g>
                  </svg>
              </span>
            </button>
          </div>
          @endif
          <div class="mb-3">
            <p class="mb-0 h5">

              @if(!empty($education['degree']))
              <strong>{{ $education['degree'] }}</strong>  
              @endif

              @if(!empty($education['study']))
              <small>{{ $education['study'] }}</small>
              @endif

            </p>
            <p class="mb-0">{{ $education['school_name'] }} / {{ $education['year_from'] }} - {{ $education['year_to'] }}</p>
            @if(!empty($education['description']))
              <p style="font-size: 14px;">
               {{ $education['description'] }}
              </p>
            @endif
            <div style="font-size: 14px;">
              @if(!empty($education['achievement_title']))
                <p class="mb-0">{{ $education['achievement_title'] }}</p>
              @endif
              @if(!empty($education['achievement_description']))
              <p>
                {{ $education['achievement_description'] }}
              </p>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      @endif

      @if(count($args['experience']) > 0)
      <div class="mb-5">
        @foreach($args['experience'] as $key => $experience)
          @if ($key == 0)
          <div class="d-flex justify-content-between">
            <h3 class="mb-4">{!! trans('resume_builder.items.experience') !!}</h3>
            <div class="align-items-center">
              <button type="button" class="btn btn-link p-0 mr-2 border-0" data-link="{{ route('user.resume.create',['tab' => 'experience']) }}">
                <span class="d-flex align-items-center justify-content-center">
                    <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px"
                         height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                         style="fill:rgba(6,70,166,0.2)!important;"><g id="background">
                          <rect fill="none" height="32" width="32"/></g>
                          <g id="edit">
                            <polygon points="10,28 4,28 4,22  "/>
                            <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"/>
                            <polygon points="4,32 4,30 26,30 26,32 4,32  "/>
                          </g>
                    </svg>
                </span>
              </button>
            </div>
          </div>
          @endif

          <div class="mb-3">
            <p class="mb-0 h5"><strong>{{ $experience['title'] }}</strong></p>
            <p class="mb-0"> {{ $experience['company'] }} / {{ date('Y',strtotime($experience['date_from'])) }}-{{ $experience['current'] ? trans('fields.label.currently_work') : date('Y',strtotime($experience['date_to'])) }}</p>
            @if(!empty($experience['industry']['name']) || !empty($experience['sub_industry']['name']))
            <p class="mb-0"> {{ rtrim($experience['industry']['name'] . ' / ' . $experience['sub_industry']['name'], ' / ') }}</p>
            @endif
            @if(!empty($experience['description']))
              <p class="mb-0" style="font-size: 14px;">
               {{ $experience['description'] }}
              </p>
            @endif
            @if(!empty($experience['additional_info']))
                  <p class="mb-0" style="font-size: 14px;">
                      {{ $experience['additional_info'] }}
                  </p>
            @endif
             <!-- <p style="font-size: 14px;">
                Additional field lorem ipsum because we need it to prove we were better than all the other candidates in this field!
             </p> -->
          </div>
        @endforeach
      </div>
      @endif

      @if(count($args['certification']) > 0)
      <div class="mb-5">

        <div class="d-flex justify-content-between">
          <h3 class="mb-4" style="word-break: break-all; line-height: 1;">{!! trans('resume_builder.items.permit_certification') !!}</h3>
          <div class="align-items-center">
              <button type="button" class="btn btn-link p-0 mr-2 border-0" data-link="{{ route('user.resume.create',['tab' => 'certifications']) }}">
                <span class="d-flex align-items-center justify-content-center">
                    <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px"
                         height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                         style="fill:rgba(6,70,166,0.2)!important;"><g id="background">
                          <rect fill="none" height="32" width="32"/></g>
                          <g id="edit">
                            <polygon points="10,28 4,28 4,22  "/>
                            <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"/>
                            <polygon points="4,32 4,30 26,30 26,32 4,32  "/>
                          </g>
                    </svg>
                </span>
              </button>
          </div>
        </div>

        @foreach($args['certification'] as $certification)
          <div class="mb-3">
            <p class="mb-0 h5"><strong>{{ $certification['title'] }}</strong></p>
            <p class="mb-0">{{  trans('fields.values.'.$certification['type']) }} / {{ $certification['year'] }}</p>
          </div>
        @endforeach

      </div>
      @endif

      @if(count($args['distinction']) > 0)
      <div class="mb-5">

        <div class="d-flex justify-content-between">
          <h3 class="mb-4" style="word-break: break-all; line-height: 1;">{!! trans('resume_builder.items.distinctions_achievements') !!}</h3>
          <div class="align-items-center">
              <button type="button" class="btn btn-link p-0 mr-2 border-0" data-link="{{ route('user.resume.create',['tab' => 'certifications']) }}">
                <span class="d-flex align-items-center justify-content-center">
                    <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px"
                         height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                         style="fill:rgba(6,70,166,0.2)!important;"><g id="background">
                          <rect fill="none" height="32" width="32"/></g>
                          <g id="edit">
                            <polygon points="10,28 4,28 4,22  "/>
                            <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"/>
                            <polygon points="4,32 4,30 26,30 26,32 4,32  "/>
                          </g>
                    </svg>
                </span>
              </button>
          </div>
        </div>
        
        @foreach($args['distinction'] as $distinction)
        <div class="mb-3">
          <p class="mb-0 h5"><strong>{{ $distinction['title'] }}</strong></p>
          <p class="mb-0">{{ $distinction['year'] }}</p>
        </div>
        @endforeach

      </div>
      @endif

      <!-- <div class="mb-5">
        <div class="d-flex justify-content-between">
          <h3 class="mb-4">References</h3>
          <div class="align-items-center">
              <button type="button" class="btn btn-link p-0 mr-2 border-0" data-link="{{ route('user.resume.create',['tab' => 'references']) }}">
                <span class="d-flex align-items-center justify-content-center">
                    <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px"
                         height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                         style="fill:rgba(6,70,166,0.2)!important;"><g id="background">
                          <rect fill="none" height="32" width="32"/></g>
                          <g id="edit">
                            <polygon points="10,28 4,28 4,22  "/>
                            <rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"/>
                            <polygon points="4,32 4,30 26,30 26,32 4,32  "/>
                          </g>
                    </svg>
                </span>
              </button>
          </div>
        </div>

        <div class="mb-3">
          <p class="mb-0 h5"><strong>John Smith</strong></p>
          <p class="mb-0"> Videotron Inc / +1-514-374-3555 / johnsmith@gmail.com</p>
          <p class="mb-0" style="font-size: 14px;">
             References are made by lorem ipsum because it’s easier said than done and we know the difference between a real one and a fake one, so we are lorem ipsuming and it’s a lot easier. So brace yourself because winter is coming and he’s gonna  get you in the balls
           </p>
        </div>
      </div> -->


      <div>
          <p class="mb-4 text-left"><strong>{!! trans('resume_builder.availability.available_for') !!} </strong>
              {{ $args['availability']->full_time ? trans('resume_builder.availability.full_time').',' : '' }} {{ $args['availability']->part_time ? trans('resume_builder.availability.part_time').',' : '' }}
              {{ $args['availability']->internship ? trans('resume_builder.availability.internship').',' : '' }} {{ $args['availability']->contractual ? trans('resume_builder.availability.contractual').',' : '' }}
              {{ $args['availability']->summer_positions ? trans('resume_builder.availability.summer_positions').',' : '' }} {{ $args['availability']->recruitment ? trans('resume_builder.availability.recruitment').',' : '' }}
              {{ $args['availability']->field_placement ? trans('resume_builder.availability.field_placement').',' : '' }} {{ $args['availability']->volunteer ? trans('resume_builder.availability.volunteer').',' : '' }}
          </p>
          <div class="table mb-0">
              <table class="w-100" style="table-layout: fixed">
                  <thead>
                  <tr class="text-center">
                      <th colspan="2" class="table-heading border-0 text-center p-0"></th>
                      <th class="table-heading border-0 text-center">
                          <svg version="1.1" id="Layer_1" width="20px" height="20px"
                               xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                               viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                        <path d="M45.5,32.4c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,30.7,43.3,32.4,45.5,32.4z"
                              fill="#4266ff"/>
                              <path d="M69,42c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7 C67,41.6,68,42,69,42z"
                                    fill="#4266ff"/>
                              <path d="M19.2,40.8C19.9,41.6,21,42,22,42c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0 c-1.6,1.6-1.6,4.1,0,5.7L19.2,40.8z"
                                    fill="#4266ff"/>
                              <path d="M86.9,66.7H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,66.7,86.9,66.7z"
                                    fill="#4266ff"/>
                              <path d="M27.1,60.8c2.1,0.6,4.3-0.7,4.9-2.9c1.6-6.2,7.2-10.5,13.6-10.5s12,4.3,13.6,10.5c0.5,1.8,2.1,3,3.9,3c0.3,0,0.7,0,1-0.1 c2.1-0.6,3.4-2.7,2.9-4.9c-2.5-9.7-11.3-16.5-21.3-16.5c-10,0-18.8,6.8-21.3,16.5C23.6,58.1,24.9,60.3,27.1,60.8z"
                                    fill="#4266ff"/>
                    </svg>
                      </th>
                      <th class="table-heading border-0 text-center">
                          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="20px"
                               height="20px" x="0px" y="0px"
                               viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                        <path d="M45.5,23.5c-12.1,0-22,9.9-22,22c0,12.1,9.9,22,22,22c12.1,0,22-9.9,22-22C67.5,33.4,57.6,23.5,45.5,23.5z M45.5,59.5 c-7.7,0-14-6.3-14-14c0-7.7,6.3-14,14-14c7.7,0,14,6.3,14,14C59.5,53.2,53.2,59.5,45.5,59.5z"
                              fill="#4266ff"/>
                              <path d="M45.5,16.2c2.2,0,4-1.8,4-4V4.1c0-2.2-1.8-4-4-4c-2.2,0-4,1.8-4,4v8.1C41.5,14.5,43.3,16.2,45.5,16.2z"
                                    fill="#4266ff"/>
                              <path d="M86.9,41.5h-8.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4C90.9,43.3,89.1,41.5,86.9,41.5z"
                                    fill="#4266ff"/>
                              <path d="M45.5,74.8c-2.2,0-4,1.8-4,4v8.1c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4v-8.1C49.5,76.5,47.7,74.8,45.5,74.8z"
                                    fill="#4266ff"/>
                              <path d="M16.2,45.5c0-2.2-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1C14.5,49.5,16.2,47.7,16.2,45.5z"
                                    fill="#4266ff"/>
                              <path d="M69,26c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7 C67,25.6,68,26,69,26z"
                                    fill="#4266ff"/>
                              <path d="M71.8,66.2c-1.6-1.6-4.1-1.6-5.7,0c-1.6,1.6-1.6,4.1,0,5.7l5.8,5.8c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2 c1.6-1.6,1.6-4.1,0-5.7L71.8,66.2z"
                                    fill="#4266ff"/>
                              <path d="M19.2,66.2l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7 C23.3,64.6,20.7,64.6,19.2,66.2z"
                                    fill="#4266ff"/>
                              <path d="M19.2,24.8C19.9,25.6,21,26,22,26c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0 c-1.6,1.6-1.6,4.1,0,5.7L19.2,24.8z"
                                    fill="#4266ff"/>
                    </svg>
                      </th>
                      <th class="table-heading border-0 text-center">
                          <svg version="1.1" id="Layer_1" width="20px" height="20px"
                               xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                               viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                        <path d="M45.5,26.3c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,24.5,43.3,26.3,45.5,26.3z"
                              fill="#4266ff"/>
                              <path d="M74.8,55.6c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4h-8.1C76.5,51.6,74.8,53.4,74.8,55.6z"
                                    fill="#4266ff"/>
                              <path d="M4.1,59.6h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4S1.9,59.6,4.1,59.6z"
                                    fill="#4266ff"/>
                              <path d="M69,36.1c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7 C67,35.7,68,36.1,69,36.1z"
                                    fill="#4266ff"/>
                              <path d="M19.2,34.9c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0 c-1.6,1.6-1.6,4.1,0,5.7L19.2,34.9z"
                                    fill="#4266ff"/>
                              <path d="M25.5,64.7c0.9,2,3.3,2.9,5.3,2c2-0.9,2.9-3.3,2-5.3c-0.8-1.8-1.3-3.8-1.3-5.8c0-7.7,6.3-14,14-14s14,6.3,14,14 c0,2-0.4,4-1.3,5.8c-0.9,2,0,4.4,2,5.3c0.5,0.2,1.1,0.4,1.7,0.4c1.5,0,3-0.9,3.6-2.3c1.3-2.9,2-6,2-9.1c0-12.1-9.9-22-22-22 c-12.1,0-22,9.9-22,22C23.5,58.8,24.2,61.8,25.5,64.7z"
                                    fill="#4266ff"/>
                              <path d="M86.9,72.8H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,72.8,86.9,72.8z"
                                    fill="#4266ff"/>
                    </svg>
                      </th>
                      <th class="table-heading border-0 text-center">
                          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="20px"
                               height="20px" x="0px" y="0px"
                               viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                      <path d="M47.2,78.1c-11.6,0-22.5-6.3-28.3-16.3c-9-15.6-3.6-35.6,11.9-44.6c5.3-3.1,11.5-4.6,17.6-4.3c1.5,0.1,2.8,0.9,3.4,2.2
                        c0.7,1.3,0.5,2.9-0.3,4.1c-5,7.2-5.4,16.8-1,24.3c4.1,7,11.6,11.4,19.8,11.4c0.6,0,1.2,0,1.8-0.1c1.5-0.1,2.9,0.6,3.7,1.8
                        c0.8,1.2,0.9,2.8,0.2,4.1c-2.9,5.5-7.2,10-12.6,13.1C58.5,76.6,52.9,78.1,47.2,78.1z M41.4,21.5c-2.3,0.5-4.5,1.4-6.6,2.6
                        C23.1,31,19,46.1,25.8,57.8c4.4,7.6,12.6,12.3,21.4,12.3c4.3,0,8.5-1.1,12.3-3.3c2.1-1.2,4-2.7,5.6-4.4c-8.9-1.6-16.8-7-21.4-14.9
                        C39.1,39.5,38.4,30,41.4,21.5z" fill="#4266ff"/>
                    </svg>
                      </th>
                  </tr>
                  </thead>
                  <tbody class="text-left">
                  <?php
                  $days = [trans('main.days.monday'), trans('main.days.tuesday'), trans('main.days.wednesday'), trans('main.days.thursday'), trans('main.days.friday'), trans('main.days.saturday'), trans('main.days.sunday')];
                  ?>
                  @for($d = 1; $d <= 7; ++$d)
                      <tr class="text-center">
                          <td colspan="2" class="text-left">{{ $days[$d - 1] }}</td>
                          @for($i = 1; $i <= 4; ++$i)
                              <?php
                              $checkbox = false;
                              ?>
                              @isset($args['availability']['time_'.$i])
                                  <?php
                                  $checkbox = strpos($args['availability']['time_' . $i], (string)$d);
                                  ?>
                              @endisset
                              <td class="align-middle">
                                  <div class="d-flex align-items-center justify-content-center">
                                      <label class="custom-control custom-checkbox m-0 pl-3">
                                          <input type="checkbox"
                                                 class="custom-control-input"
                                                 @if($checkbox !== false) checked="checked"
                                                 @endif onclick="return false;">
                                          <span class="custom-control-indicator"></span>
                                      </label>
                                  </div>
                              </td>
                          @endfor
                      </tr>
                  @endfor

                  </tbody>
              </table>
          </div>
      </div>


    </div>
    <!-- /right side -->
  </div>
</div>

