<div class="col-12 px-0">
    <div class="card rounded-0 border-left-0 border-right-0 border-top-0">
        <div>
            <div class="d-flex col-12 px-0 align-items-start justify-content-between p-3">
                <div class="text-left w-100">
                    <div class="d-inline-flex w-100 align-items-start">
                        <div class="rounded p-1 bg-white d-inline-block mr-2">
                            <img src="{{ $picture }}" style="width: 50px" class="rounded">
                        </div>
                        <div class="w-100">
                            <h6 class="h6 mb-0 mt-0 resume-business-name">
                                <strong>{{ $args['business']['name'] }}</strong></h6>
                            <p class="mb-1 resume-business-date">
                                <strong>{!! trans('main.last_applied') !!}</strong> {{ $args['updated_at']->format('M d, Y') }}
                            </p>
                            <p class="mb-0">
                                <a href="javascript:void(0)" class="resume-history"
                                   data-id="{{ $args['business']['id'] }}">{!! trans('main.view_history_to', ['name' => $args['business']['name']]) !!}</a>
                            </p>
                        </div>
                    </div>
                    <div class="d-flex w-100 mt-5 flex-wrap flex-md-nonwrap">

                        <div class="my-3 my-md-0 col-sm-4 col-6 max-content">
                            <p class="mb-1 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 490.282 490.282"
                                     style="enable-background:new 0 0 512.001 512.001; fill:#9BA6B2; vertical-align: middle;"
                                     xml:space="preserve" width="40px" height="40px"><g>
                                        <g>
                                            <path d="M0.043,245.197c0.6,10.1,7.3,18.6,17,21.5l179.6,54.3l6.6,123.8c0.3,4.9,3.6,9.2,8.3,10.8c1.3,0.5,2.7,0.7,4,0.7   c3.5,0,6.8-1.4,9.2-4.1l63.5-70.3l90,62.3c4,2.8,8.7,4.3,13.6,4.3c11.3,0,21.1-8,23.5-19.2l74.7-380.7c0.9-4.4-0.8-9-4.2-11.8   c-3.5-2.9-8.2-3.6-12.4-1.9l-459,186.8C5.143,225.897-0.557,235.097,0.043,245.197z M226.043,414.097l-4.1-78.1l46,31.8   L226.043,414.097z M391.443,423.597l-163.8-113.4l229.7-222.2L391.443,423.597z M432.143,78.197l-227.1,219.7l-179.4-54.2   L432.143,78.197z"
                                                  data-original="#000000" class="active-path"
                                                  data-old_color="#4266ff"></path>
                                        </g>
                                    </g>
                            </svg>
                            </p>
                            <div class="rs_steps done_check text-center mx-auto" style="padding-top: 4px;">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px"
                                     viewBox="0 0 448.8 448.8"
                                     style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px;"
                                     xml:space="preserve"><g>
                                        <g id="check">
                                            <polygon
                                                    points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                                        </g>
                                    </g></svg>
                            </div>
                            <p class="mb-0 text-center rs_font-size-12">{!! trans('main.buttons.sent') !!}</p>
                        </div>

                        <div class="rs_stick_notactive flex-1">
                            <p class="text-center" style="margin-top: -15px;">
                                <button class="[ sent-item__wave ] btn btn-primary btn-sm" data-toggle="tooltip"
                                        title="{!! trans('main.wave_hint') !!}"
                                        data-candidate-id="{{ $args['id'] }}" style="height: 36px;">
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                                         xml:space="preserve" width="24px" height="24px">
                                <g>
                                    <g>
                                        <path d="M402.034,77.436C388.486,48.9,369.347,23.147,345.899,1.937c-3.071-2.777-7.814-2.541-10.595,0.531
                                      c-2.778,3.072-2.541,7.815,0.531,10.595c21.976,19.878,39.93,44.022,52.647,70.806c1.79,3.767,6.277,5.324,9.993,3.559
                                      C402.217,85.653,403.81,81.179,402.034,77.436z"/>
                                    </g>
                                </g>
                                        <g>
                                            <g>
                                                <path d="M359.714,88.616c-9.581-18.225-21.992-34.925-36.707-49.369c-2.957-2.9-7.706-2.858-10.609,0.098
                                      c-2.901,2.956-2.857,7.705,0.099,10.607c13.592,13.341,25.067,28.771,33.938,45.645c1.342,2.553,3.948,4.012,6.647,4.012
                                      C358.646,99.609,362.361,93.651,359.714,88.616z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M72.529,318.782c-10.942-9.899-20.969-20.941-29.8-32.818c-8.834-11.881-16.52-24.662-22.845-37.987
                                      c-1.776-3.741-6.25-5.336-9.993-3.559c-3.741,1.776-5.336,6.251-3.559,9.993c13.548,28.537,32.686,54.286,56.134,75.497
                                      c1.436,1.299,3.234,1.938,5.029,1.938C74.302,331.845,77.639,323.403,72.529,318.782z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M95.87,281.895c-13.593-13.344-25.066-28.772-33.937-45.646c-1.926-3.665-6.459-5.074-10.13-3.148
                                      c-3.666,1.928-5.076,6.463-3.148,10.13c9.231,17.559,21.469,34.413,36.707,49.37c2.954,2.899,7.703,2.86,10.607-0.099
                                      C98.87,289.545,98.826,284.797,95.87,281.895z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M499.781,371.92l-13.367-17.98c1.904-7.314,8.028-25.754,4.968-51.339c-3.324-27.768-11.94-32.114-14.678-48.103
                                      c-6.713-39.192,11.373-92.947,15.066-103.325c0.155-0.437,0.247-0.707,0.277-0.803c7.899-24.969,13.117-41.466-12.029-53.564
                                      c-22.497-10.822-46.173-1.213-60.314,24.482c-0.866,1.574-19.008,34.933-26.809,80.441l-92.57-124.504
                                      c-2.472-3.326-7.172-4.018-10.495-1.544c-3.324,2.472-4.016,7.171-1.544,10.494l103.578,139.309
                                      c4.091,5.502,12.838,3.055,13.486-3.765c4.912-51.683,26.576-91.522,27.497-93.194c3.853-7.006,18.18-29.018,40.668-18.198
                                      c14.204,6.834,11.611,10.803,4.122,35.816c-5.497,15.446-22.878,69.093-15.72,110.888c3.435,20.051,11.442,21.223,14.568,47.355
                                      c1.252,10.46,0.869,21.125-1.127,31.831c-0.482,2.363-3.211,13.553-13.584,26.015c-2.649,3.184-2.217,7.913,0.967,10.564
                                      c3.189,2.655,7.919,2.21,10.564-0.967c1.427-1.714,2.733-3.412,3.935-5.084l10.503,14.126c6.101,8.205,4.388,19.843-3.815,25.942
                                      l-15.78,11.733c-5.794,4.308-2.714,13.52,4.48,13.52c4.236,0,4.927-2.383,20.251-13.215
                                      C507.72,407.815,510.817,386.761,499.781,371.92z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M450.504,441.011c-2.472-3.326-7.172-4.018-10.494-1.544l-72.417,53.844c-8.293,6.165-20.053,4.433-26.217-3.855
                                      c-2.995-3.154-13.062-22.889-37.872-30.259c-44.591-13.246-59.616-46.662-68.075-55.748c-2.471-3.324-7.171-4.016-10.495-1.543
                                      c-3.323,2.472-4.015,7.171-1.543,10.495c7.916,8.427,25.751,46.297,75.842,61.176c19.255,5.72,26.879,21.366,30.107,24.829
                                      c11.08,14.901,32.252,18.061,47.205,6.943l72.418-53.844C452.285,449.033,452.976,444.334,450.504,441.011z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <g>
                                                    <path d="M102.826,250.247c-0.021-0.028-0.037-0.049-0.048-0.065C102.791,250.199,102.807,250.222,102.826,250.247z"/>
                                                    <path d="M102.755,250.152C102.753,250.149,102.753,250.149,102.755,250.152L102.755,250.152z"/>
                                                    <path d="M317.375,203.536L218.852,71.023v-0.001c-7.985-10.737-5.469-26.482,6.624-33.883
                                        c10.155-6.217,23.866-3.343,31.216,6.541l10.675,14.358c2.471,3.325,7.171,4.016,10.494,1.544
                                        c3.324-2.471,4.016-7.17,1.544-10.494l-10.675-14.358c-19.083-25.665-59.451-18.936-68.091,12.115
                                        c-21.714-23.89-61.463-12.786-66.591,19.229c-1.479,9.233,0.392,18.453,5.278,26.291c-31.77-0.685-50.429,35.775-31.132,61.726
                                        l11.734,15.782c-32.355-0.346-49.896,36.267-30.972,61.72c9.667,13.002,12.875,17.316,13.804,18.566
                                        c-0.002-0.003-0.003-0.005-0.005-0.006c0.003,0.004,0.011,0.015,0.023,0.03c-0.006-0.009-0.012-0.016-0.016-0.021
                                        c0.103,0.139,0.18,0.242,0.232,0.312c-0.054-0.073-0.119-0.16-0.168-0.226c0.044,0.059,0.112,0.151,0.208,0.28
                                        c0.001,0.002,0.003,0.004,0.004,0.005c1.996,2.685,16.408,22.068,99.43,133.73c1.472,1.98,3.733,3.026,6.025,3.025
                                        c6.073,0,9.723-6.987,6.014-11.976C77.984,191.69,115.436,242.065,100.994,222.641c-12.373-16.643,0.388-39.717,20.698-37.654
                                        c11.121,1.128,16.275,9.205,16.393,9.308l68.253,91.798c1.472,1.98,3.733,3.025,6.025,3.025c6.089,0,9.715-6.998,6.014-11.976
                                        c-9.24-12.428-88.916-119.589-98.147-132.004c-7.48-10.06-6.135-24.148,3.063-32.073c10.362-8.927,25.938-7.154,34.018,3.712
                                        l92.621,124.573c1.472,1.98,3.733,3.025,6.025,3.025c1.556,0,3.125-0.481,4.469-1.481c3.324-2.472,4.016-7.171,1.544-10.494
                                        c-8.17-10.993-103.364-139.027-108.796-146.334c-7.825-10.523-5.477-25.424,5.307-33.021c10.247-7.214,24.856-4.645,32.568,5.727
                                        c2.024,2.722,113.197,152.247,114.287,153.713c2.474,3.33,7.179,4.011,10.494,1.544
                                        C319.156,211.557,319.848,206.859,317.375,203.536z M103.049,250.548C103.122,250.645,103.103,250.62,103.049,250.548
                                        L103.049,250.548z"/>
                                                </g>
                                            </g>
                                        </g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                              </svg>
                                </button>
                            </p>
                        </div>

                        @foreach ($pipeline_items as $pipeline_item_index => $pipeline_item)
                            @if ($pipeline_item_index > 0)
                                <div class="rs_stick_notactive flex-1"></div>
                            @endif
                            <div class="my-3 my-md-0 col-sm-4 col-6 max-content">
                                <p class="mb-1 text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         style="enable-background:new 0 0 50 50;fill:#9BA6B2; vertical-align: middle;"
                                         version="1.1" viewBox="0 0 50 50" xml:space="preserve" width="40px"
                                         height="40px"><g id="Layer_1">
                                            <path d="M25,39c13.036,0,23.352-12.833,23.784-13.379L49.275,25l-0.491-0.621C48.352,23.833,38.036,11,25,11   S1.648,23.833,1.216,24.379L0.725,25l0.491,0.621C1.648,26.167,11.964,39,25,39z M25,13c10.494,0,19.47,9.46,21.69,12   C44.473,27.542,35.509,37,25,37C14.506,37,5.53,27.54,3.31,25C5.527,22.458,14.491,13,25,13z"/>
                                            <path d="M25,34c4.963,0,9-4.038,9-9s-4.037-9-9-9s-9,4.038-9,9S20.037,34,25,34z M25,18c3.859,0,7,3.14,7,7s-3.141,7-7,7   s-7-3.14-7-7S21.141,18,25,18z"/>
                                        </g>
                                        <g/></svg>
                                </p>
                                <div class="rs_steps notactive text-center mx-auto" style="padding-top: 4px;">
                                    {{ $pipeline_item_index + 2 }}
                                </div>
                                <p class="mb-0 text-center rs_font-size-12">{{ $pipeline_item->name }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @if(isset($args['request']))
                <div class="border border-left-0 border-right-0 border-bottom-0 p-3 update-request-box"
                     data-id="{{ $args['request'] }}">
                    <div class="row">
                        <div class="col-12">
                            <h6 class="h6 mb-3">{!! trans('main.requested_you_update', ['name' => $args['business']['name']]) !!}</h6>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <div class="bg-white">
                                        <button class="btn btn-outline-warning p-3 w-100 resume-update-btn"
                                                type="button">
                                          <span class="d-flex flex-column align-items-center">
                                              <svg version="1.1" class="mb-2"
                                                   id="Capa_1"
                                                   xmlns="http://www.w3.org/2000/svg"
                                                   xmlns:xlink="http://www.w3.org/1999/xlink"
                                                   x="0px" y="0px"
                                                   width="25px" height="25px"
                                                   viewBox="0 0 344.37 344.37"
                                                   style="enable-background:new 0 0 344.37 344.37;"
                                                   xml:space="preserve">
                                                      <path d="M334.485,37.463c-6.753-1.449-13.396,2.853-14.842,9.603l-9.084,42.391C281.637,40.117,228.551,9.155,170.368,9.155
                                                          c-89.603,0-162.5,72.896-162.5,162.5c0,6.903,5.596,12.5,12.5,12.5c6.903,0,12.5-5.597,12.5-12.5
                                                          c0-75.818,61.682-137.5,137.5-137.5c49.429,0,94.515,26.403,118.925,68.443l-41.674-8.931c-6.752-1.447-13.396,2.854-14.841,9.604
                                                          c-1.446,6.75,2.854,13.396,9.604,14.842l71.536,15.33c1.215,0.261,2.449,0.336,3.666,0.234c2.027-0.171,4.003-0.836,5.743-1.962
                                                          c2.784-1.801,4.738-4.634,5.433-7.875l15.331-71.536C345.535,45.555,341.235,38.911,334.485,37.463z"
                                                            fill="#ffc107"/>
                                                      <path d="M321.907,155.271c-6.899,0.228-12.309,6.006-12.081,12.905c1.212,36.708-11.942,71.689-37.042,98.504
                                                          c-25.099,26.812-59.137,42.248-95.844,43.46c-1.53,0.05-3.052,0.075-4.576,0.075c-47.896-0.002-92.018-24.877-116.936-65.18
                                                          l43.447,11.65c6.668,1.787,13.523-2.168,15.311-8.837c1.788-6.668-2.168-13.522-8.836-15.312l-70.664-18.946
                                                          c-3.202-0.857-6.615-0.409-9.485,1.247c-2.872,1.656-4.967,4.387-5.826,7.589L0.43,293.092
                                                          c-1.788,6.668,2.168,13.522,8.836,15.311c1.085,0.291,2.173,0.431,3.245,0.431c5.518,0,10.569-3.684,12.066-9.267l10.649-39.717
                                                          c29.624,46.647,81.189,75.367,137.132,75.365c1.797,0,3.604-0.029,5.408-0.089c43.381-1.434,83.608-19.674,113.271-51.362
                                                          s45.209-73.031,43.776-116.413C334.586,160.453,328.805,155.026,321.907,155.271z"
                                                            fill="#ffc107"/>
                                              </svg>
                                              {!! trans('main.buttons.update') !!}
                                          </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-white">
                                        <button class="btn btn-outline-success p-3 w-100 accept-resume-request"
                                                type="button" data-id="{{ $args['request'] }}">
                                            <span class="d-flex flex-column align-items-center">
                                                <svg class="mb-2"
                                                     enable-background="new 0 0 48 48"
                                                     height="25px" width="25px"
                                                     id="Layer_1" version="1.1"
                                                     viewBox="0 0 48 48"
                                                     xml:space="preserve"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path clip-rule="evenodd"
                                                          data-original="#000000"
                                                          class="active-path"
                                                          data-old_color="#4266ff"
                                                          fill="#28a745"
                                                          d="M45.037,28.426C45.629,29.123,46,30.015,46,31.001  c0,1.461-0.792,2.727-1.963,3.424C44.629,35.123,45,36.015,45,37.001c0,1.462-0.793,2.726-1.963,3.424  C43.629,41.122,44,42.014,44,43c0,2.209-1.791,4-4,4l-23.404-0.002v-0.024c-1.602-0.069-3.018-0.824-3.975-1.976H6  c-2.762,0-5-5.373-5-12s2.238-12,5-12h8.387L22,10v-5c0.541-3.262,3-3,3-3c2.212,0,3,1,3,1c3,3,3,8,3,8c0,6.608-3,10-3,10h15  c2.209,0,4,1.791,4,4C47,26.462,46.207,27.728,45.037,28.426z M6,22.998c-0.771,0-3,3.438-3,10s2.229,10,3,10h5.578  c-0.056-0.198-0.119-0.393-0.152-0.6C10.834,39.526,10,34.805,10,30.998c0-4.043,2.203-6.897,3-8h0.002l0,0H6z M43,23H23.561  l2.941-3.325C26.527,19.646,29,16.691,29,11.006c0-0.042-0.054-4.232-2.414-6.591l-0.117-0.105  c-0.673-0.423-1.599-0.314-1.599-0.314c-0.533,0-0.77,0.686-0.87,1.185v5.444l-9.379,13.543l-0.109,0.152  C13.696,25.441,12,27.773,12,30.998c0,3.714,0.867,8.484,1.398,11.073c0.268,1.611,1.648,2.833,3.285,2.904L40,45  c1.103,0,2-0.897,2-2c0-0.584-0.266-1.019-0.487-1.281l-1.529-1.801l2.028-1.211C42.631,38.338,43,37.7,43,37.001  c0-0.584-0.266-1.021-0.488-1.283l-1.528-1.803l2.03-1.209C43.631,32.339,44,31.701,44,31.001c0-0.584-0.266-1.019-0.487-1.281  l-1.529-1.801l2.028-1.211C44.631,26.339,45,25.701,45,25.001C45,23.897,44.103,23,43,23z M7.5,40.998c-0.828,0-1.5-0.672-1.5-1.5  s0.672-1.5,1.5-1.5S9,38.67,9,39.498S8.328,40.998,7.5,40.998z"
                                                          fill-rule="evenodd"/>
                                                </svg>
                                            </span>
                                            {!! trans('main.buttons.updated') !!}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>