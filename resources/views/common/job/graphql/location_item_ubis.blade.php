<!-- ONE JOB START -->
<div class="col-12 px-0 unconfirmed-business__location-item" data-id="{{ $args['id'] }}">
    <div class="d-flex flex-column flex-lg-row pxa-0 p-3" style="border-bottom:1px solid #e9ecef;">
        <div class="text-center text-lg-left">
            <img src="{{ $picture }}" class="rounded"
                 style="width: 60px; height: 60px;">
        </div>
        <div class="ml-4 mxa-0 text-center text-lg-left w-100">
            <div class="d-flex justify-content-between flex-column flex-lg-row">
                <div class="mb-2">
                    <span href="{{ url('/') }}/map/view/location/{{ $args['id'] }}/{{ str_slug($args['name']) }}" style="font-size: 16px; color:#1D1D1D; font-weight: bold;">{{ $args['name'] }}</span>
                </div>
                <div class="pt-1" style="opacity: 0.4;">                            
                    <span class="ml-2 mxa-0">{{ $d }}</span>
                </div>
            </div>
            <p class="mb-1 open-sans">            
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 18.999 18.999" style="enable-background:new 0 0 18.999 18.999;fill:#4266ff; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
                    <g>
                      <g>
                        <path d="M9.5,2c1.609,0,3.12,0.614,4.254,1.73C14.879,4.837,15.5,6.309,15.5,7.87s-0.62,3.03-1.745,4.139    L9.5,16.193l-4.254-4.186C4.121,10.9,3.501,9.431,3.501,7.868s0.62-3.032,1.745-4.141C6.38,2.614,7.892,2,9.5,2 M9.5,0    C7.453,0,5.404,0.768,3.843,2.305c-3.124,3.074-3.124,8.057,0,11.131L9.5,18.999l5.657-5.565c3.124-3.072,3.124-8.056,0-11.129    C13.596,0.768,11.548,0,9.5,0z"/>
                      </g>
                      <g>
                        <path d="M9.5,5.499c0.668,0,1.296,0.26,1.768,0.731c0.976,0.976,0.976,2.562,0,3.537    c-0.473,0.472-1.1,0.731-1.768,0.731s-1.295-0.26-1.768-0.731c-0.976-0.976-0.976-2.562,0-3.537    C8.205,5.759,8.833,5.499,9.5,5.499 M9.5,4.499c-0.896,0-1.792,0.342-2.475,1.024c-1.367,1.367-1.367,3.584,0,4.951    c0.684,0.684,1.578,1.024,2.475,1.024s1.792-0.342,2.475-1.024c1.366-1.367,1.366-3.584,0-4.951    C11.292,4.84,10.396,4.499,9.5,4.499z"/>
                      </g>
                    </g>
                  </svg>
                    {{ $args['street'].' '.$args['street_number'].','.$location }}
                </span>
            </p>

            <div class="d-flex justify-content-between mt-3 px-lg-0 px-3">
                <div class="align-self-center">
                  <span data-toggle="tooltip" title="{!! trans('main.coming_soon') !!}">
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" id="Capa_1" x="0px" y="0px" width="20px"
                             height="20px" viewBox="0 0 488.501 488.5"
                             style="enable-background:new 0 0 488.501 488.5; vertical-align: middle; margin-top: -3px; opacity: 0.4; fill:#4266ff;"
                             xml:space="preserve">
                            <g>
                                <path d="M487.312,159.162C479.501,99.042,432.172,51.138,372.2,42.651c-6.532-0.929-13.158-1.395-19.69-1.395   c-43.417,0-83.353,20.523-108.664,54.18c-25.362-33.038-65.015-53.168-107.866-53.168c-6.626,0-13.358,0.482-19.994,1.437   C58.812,51.915,11.987,97.287,2.111,154.046c-7.496,43.113,5.169,85.801,34.788,117.292c3.901,4.676,9.132,10.621,13.882,15.994   l4.058,4.619c29.976,34.18,93.586,95.86,137.779,135.619c13.798,12.435,32.765,19.674,52.036,19.674h0.546   c19.921-0.467,38.991-7.476,52.339-19.947c37.189-34.693,61.598-59.484,102.257-101.827l1.552-1.625   c45.996-47.485,53.818-57.042,56.387-60.507C481.734,234.053,492.24,197.084,487.312,159.162z M415.922,229.792   c-12.265,15.056-8.984,11.245-53.053,56.738l-1.73,1.781c-39.946,41.584-63.883,65.75-100.17,99.601   c-3.586,3.35-11.607,5.315-16.251,5.315c-6.103,0-12.173-2.061-16.21-5.698c-42.096-37.886-105.078-98.697-133.365-130.964   l-4.162-4.696c-4.613-5.228-10.889-12.692-14.637-16.817c-17.771-19.563-26.055-45.31-21.431-71.821   c5.944-34.19,34.2-61.529,68.695-66.483c4.121-0.586,8.272-0.886,12.372-0.886c32.764,0,62.405,19.407,75.531,49.43   c5.672,12.991,18.421,21.374,32.523,21.374c14.217,0,27.03-8.494,32.649-21.662c14.542-34.165,50.526-54.542,88.01-49.293   c35.616,5.048,64.826,34.625,69.472,70.341C437.184,189.346,430.537,211.85,415.922,229.792z"/>
                            </g>
                        </svg>
                    </a>
                  </span>
                </div>
                {{--<div class="align-self-center">
                  <span class="ml-2" data-toggle="tooltip" title="Email & share">
                      <a data-toggle="modal" data-target="#ShareModal" data-link="{{ url('/') }}/map/view/location/{{ $args['id'] }}/{{ str_slug($args['name']) }}">
                          @svg('/img/share.svg', [
                           'width' => '25px',
                           'height' => '25px',
                           'style' => 'opacity: 0.4;fill: #4266ff;'
                           ])
                      </a>
                  </span>
                </div>--}}
                <div class="align-self-center">
                  <button class="ubis-send-resume btn border-0 px-4 py-1" style="background-color: #4266ff; color:#fff; border-radius: 20px;" data-b-id="{{ $args['business']['id'] }}">
                      {!! trans('main.buttons.i_m_interested') !!}
                  </button>
                </div>
                {{--<div class="align-self-center">
                    <a href="{{ url('/') }}/map/view/unconfirmed-location/{{ $args['id'] }}/{{ str_slug($args['name']) }}" class="view-job-link btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">{!! trans('main.buttons.view') !!}</a>
                </div>--}}
            </div>

        </div>
    </div>
</div>
<!-- ONE JOB EOF -->
