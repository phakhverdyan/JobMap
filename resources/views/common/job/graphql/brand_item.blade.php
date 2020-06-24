<!-- ONE JOB START -->
<div class="col-12 px-0">
    <div class="d-flex flex-column flex-lg-row pxa-0 p-3 justify-content-between" style="border-bottom:1px solid #e9ecef;">
        <div class="d-flex">
          <div class="text-center text-lg-left">
              <img src="{{ $picture }}" class="rounded"
                   style="width: 60px; height: 60px;">
          </div>
          <div class="ml-4 mxa-0 text-center text-lg-left w-100">
              <div class="d-flex justify-content-between flex-column flex-lg-row">
                  <div class="mb-2">
                      <a href="/business/view/{{ $args['id'] }}/{{ $args['slug'] }}" style="font-size: 16px; color:#1D1D1D; font-weight: bold;">{{ $args['localized_name'] ?: $args['name'] }}</a>
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
                      {{ $args['street'].' '.$args['street_number'].', '.$location }}
                  </span>
              </p>
              @if (isset($args['jobs_count_open']) && isset($args['jobs_count_close']))
              <p class="mb-1">
                  <span class="mxa-0">
                      <a href="#" style="text-decoration: none;"> {!! trans_choice('main.counters.c_open_positions', $args['jobs_count_open'], ['count' => $args['jobs_count_open']]) !!}</a>
                      <span class="ml-3">
                          <a href="#" style="text-decoration: none;"> {{ $args['jobs_count_close'] }} {!! ucfirst(trans('main.status.closed')) !!}</a>
                      </span>
                  </span>
              </p>
              @endif
              @if (isset($args['amenities']))
              <div class="col-md-12 text-center mt-0 rounded-0 border-top-0">
                  <div class="d-flex flex-row justify-content-start">
                      @foreach($args['amenities'] as $amenity)
                          <div class="border rounded-circle"
                               style="padding-top: 7px;width: 40px;height: 40px; box-shadow: 0 4px 10px 0 rgba(0,0,0,.14), 0 1px 2px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);"
                               data-toggle="tooltip" title="{{ $amenity['amenity']['name'] }}">
      						<span>
      							<svg xmlns="http://www.w3.org/2000/svg"
                                       xmlns:xlink="http://www.w3.org/1999/xlink"
                                       version="1.1" id="Layer_1" x="0px" y="0px"
                                       viewBox="0 0 512 512"
                                       style="enable-background:new 0 0 512 512; fill:#4266ff; width: 20px;"
                                       xml:space="preserve">
      							<g>
      								<g>
      									<g>
      										<path d="M486.4,460.8c-1.476,0-2.944,0.128-4.386,0.384c-5.888-10.607-17.092-17.451-29.747-17.451     c-12.655,0-23.859,6.844-29.747,17.451c-1.442-0.256-2.91-0.384-4.386-0.384c-14.114,0-25.6,11.486-25.6,25.6     c0,3.004,0.614,5.845,1.579,8.533H358.4v-51.2h42.667c4.71,0,8.533-3.823,8.533-8.533V93.867c0-4.71-3.823-8.533-8.533-8.533     h-256c-4.71,0-8.533,3.823-8.533,8.533v409.6c0,4.71,3.823,8.533,8.533,8.533H486.4c14.114,0,25.6-11.486,25.6-25.6     S500.514,460.8,486.4,460.8z M358.4,102.4h34.133v51.2H358.4V102.4z M358.4,170.667h34.133v51.2H358.4V170.667z M358.4,238.933     h34.133v51.2H358.4V238.933z M358.4,307.2h34.133v51.2H358.4V307.2z M358.4,375.467h34.133v51.2H358.4V375.467z M187.733,494.933     H153.6v-51.2h34.133V494.933z M187.733,426.667H153.6v-51.2h34.133V426.667z M187.733,358.4H153.6v-51.2h34.133V358.4z      M187.733,290.133H153.6v-51.2h34.133V290.133z M187.733,221.867H153.6v-51.2h34.133V221.867z M187.733,153.6H153.6v-51.2h34.133     V153.6z M238.933,494.933H204.8v-51.2h34.133V494.933z M238.933,426.667H204.8v-51.2h34.133V426.667z M238.933,358.4H204.8v-51.2     h34.133V358.4z M238.933,290.133H204.8v-51.2h34.133V290.133z M238.933,221.867H204.8v-51.2h34.133V221.867z M238.933,153.6     H204.8v-51.2h34.133V153.6z M290.133,494.933H256v-51.2h34.133V494.933z M290.133,426.667H256v-51.2h34.133V426.667z      M290.133,358.4H256v-51.2h34.133V358.4z M290.133,290.133H256v-51.2h34.133V290.133z M290.133,221.867H256v-51.2h34.133V221.867     z M290.133,153.6H256v-51.2h34.133V153.6z M341.333,494.933H307.2v-51.2h34.133V494.933z M341.333,426.667H307.2v-51.2h34.133     V426.667z M341.333,358.4H307.2v-51.2h34.133V358.4z M341.333,290.133H307.2v-51.2h34.133V290.133z M341.333,221.867H307.2v-51.2     h34.133V221.867z M341.333,153.6H307.2v-51.2h34.133V153.6z M486.4,494.933h-68.267c-4.702,0-8.533-3.831-8.533-8.533     s3.831-8.533,8.533-8.533c1.638,0,3.191,0.469,4.625,1.391c2.338,1.502,5.257,1.775,7.834,0.734     c2.577-1.041,4.48-3.277,5.103-5.982c1.801-7.774,8.619-13.21,16.572-13.21c7.953,0,14.771,5.436,16.572,13.21     c0.623,2.705,2.526,4.941,5.103,5.982c2.577,1.041,5.495,0.768,7.834-0.734c5.547-3.584,13.167,0.802,13.158,7.142     C494.933,491.102,491.102,494.933,486.4,494.933z"/>
      										<path d="M187.733,59.733v-25.6h59.733c4.71,0,8.533-3.823,8.533-8.533v-8.533h34.133V25.6c0,4.71,3.823,8.533,8.533,8.533H358.4     V51.2H213.333c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h213.333v353.954c0,4.71,3.823,8.533,8.533,8.533     s8.533-3.823,8.533-8.533V59.733c0-4.71-3.823-8.533-8.533-8.533h-59.733V25.6c0-4.71-3.823-8.533-8.533-8.533H307.2V8.533     c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533v8.533H179.2c-4.71,0-8.533,3.823-8.533,8.533v25.6     h-59.733c-4.71,0-8.533,3.823-8.533,8.533v435.2H51.2v-34.995c19.447-3.968,34.133-21.197,34.133-41.805     c0-1.109-0.486-110.933-42.667-110.933C0.486,307.2,0,417.024,0,418.133c0,20.608,14.686,37.837,34.133,41.805v34.995h-25.6     c-4.71,0-8.533,3.823-8.533,8.533S3.823,512,8.533,512h102.4c4.71,0,8.533-3.823,8.533-8.533v-435.2H179.2     C183.91,68.267,187.733,64.444,187.733,59.733z M17.067,418.133c0-42.513,11.418-93.867,25.6-93.867     c14.182,0,25.6,51.354,25.6,93.867c0,14.114-11.486,25.6-25.6,25.6S17.067,432.247,17.067,418.133z"/>
      									</g>
      								</g>
      							</g>
      							</svg>
      						</span>
                          </div>
                      @endforeach

                  </div>
              </div>
              @endif
          </div>
        </div>
        <div>
          <div class="align-self-center mb-2">
            <div class="d-flex">
              <div class="pt-1" style="opacity: 0.4;">
                  <span class="ml-2 mxa-0">{{ $d }}</span>
              </div>
              <span class="ml-2" data-toggle="tooltip" title="Email & share">
                  {{--<a data-toggle="modal" data-target="#ShareModal" data-link="{{ url('/') }}/map/view/location/{{ $args['id'] }}/{{ str_slug($args['name']) }}?locale={{ \App::getLocale() }}">
                      @svg('/img/share.svg', [
                       'width' => '25px',
                       'height' => '25px',
                       'style' => 'fill: #4266ff;'
                       ])
                  </a>--}}
              </span>
            </div>
          </div>
          <div class="align-self-center text-right">
            <a href="{{ url('/') }}/business/view/{{ $args['id'] }}/{{ str_slug($args['name']) }}" class="view-job-link btn border-0 px-4 py-1" role="button" style="background-color: #4266ff; color:#fff; border-radius: 20px;">{!! trans('main.buttons.view') !!}</a>
          </div>
      </div>

    </div>
</div>
<!-- ONE JOB EOF -->
