@extends('layouts.main_user')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
          @include('components.sidebar.sidebar_user')
        </div>
        <div class="col-12 col-xl-8 mx-auto mt-2 mb-5 content-main">
            <p class="text-center mt-5" id="no-interview-requests-yet" style="font-size: 20px; display: none;">{!! trans('pages.errors.u_interviews') !!}</p>
            {{--<div class="[ interview-requests-content__how-to-start ]" style="display: none;">--}}
            <div class="help-how-to-start-block interview-requests-content__how-to-start" style="display:none;">
                <div class="col-12 bg-white rounded mt-4 p-3 pxa-0 pb-4">
                    <p class="h3 text-center">
                        {!! trans('guides.u_interviews.title') !!}
                      {{--<button type="button" class="close pt-0 mt-0 interview-requests-content__hide-how-to-start" data-dismiss="modal" aria-label="Close" style="cursor: pointer;">--}}
                      <button type="button" class="close pt-0 mt-0 help-how-to-start-hide help-how-to-start-gotit" style="cursor: pointer;">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </p>
                    <div class="d-flex justify-content-center flex-lg-row flex-column mt-5">
                      <div class="text-center col-lg-4 col-12 mt-2">
                        <p class="mb-3">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001; fill:#9BA6B2; vertical-align: middle;  margin-top: -3px;" xml:space="preserve" width="50px" height="50px">
                            <g>
                                <g>
                                    <path d="M172.832,330.685l-19.068,68.677H99.896c-6.862,0-12.425,5.563-12.425,12.425c0,6.862,5.563,12.425,12.425,12.425h63.314    h0.001c0.514,0,1.019-0.041,1.518-0.102c0.128-0.016,0.253-0.039,0.381-0.058c0.416-0.065,0.825-0.148,1.226-0.252    c0.065-0.017,0.132-0.022,0.196-0.04l77.778-21.595c2.065-0.573,3.946-1.671,5.462-3.186l239.37-239.37    c16.327-16.327,16.327-42.893,0-59.219l-14.536-14.536c-7.909-7.91-18.424-12.265-29.609-12.265s-21.701,4.355-29.61,12.265    l-8.971,8.971V27.091C406.417,12.153,394.27,0,379.339,0H125.385c-3.295,0-6.456,1.31-8.786,3.639L14.252,105.987    c-2.33,2.33-3.639,5.49-3.639,8.786v370.138c0,14.938,12.153,27.091,27.091,27.091h341.636c14.931,0,27.078-12.153,27.078-27.091    V312.72c0-6.862-5.563-12.425-12.425-12.425c-6.862,0-12.425,5.563-12.425,12.425v172.191c0,1.235-0.999,2.24-2.228,2.24H37.703    c-1.235,0-2.24-1.005-2.24-2.24V127.199h75.269c14.933,0,27.079-12.148,27.079-27.079V24.85h241.527    c1.229,0,2.228,1.005,2.228,2.24v91.852c0,0.235,0.022,0.465,0.035,0.696l-81.586,81.586H99.896    c-6.862,0-12.425,5.563-12.425,12.425s5.563,12.425,12.425,12.425h175.269l-74.218,74.218H99.896    c-6.862,0-12.425,5.563-12.425,12.425s5.563,12.425,12.425,12.425h76.201l-0.078,0.078    C174.503,326.738,173.405,328.62,172.832,330.685z M112.961,100.118c0,1.229-1,2.229-2.229,2.229H53.039l59.922-59.922V100.118z     M432.96,103.424c3.216-3.214,7.491-4.985,12.038-4.985c4.548,0,8.822,1.771,12.037,4.986l14.536,14.536    c6.638,6.638,6.638,17.438,0,24.074l-15.518,15.518l-38.611-38.611L432.96,103.424z M399.87,136.514l38.611,38.611L240.988,372.62    l-38.611-38.611L399.87,136.514z M191.078,357.856l26.062,26.062l-36.08,10.017L191.078,357.856z"></path>
                                </g>
                            </g>
                          </svg>
                        </p>
                        <p style="font-size: 18px; color:#9BA6B2;"><strong>{!! trans('guides.u_interviews.item_1_title') !!}</strong></p>
                        <p>{!! trans('guides.u_interviews.item_1_text') !!}</p>
                        <p><a class="btn btn-primary" role="button" href="{!! url('/user/resume/create') !!}">{!! trans('main.buttons.get_started') !!}</a></p>
                        <div class="interview_stick" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                      </div>  
                    </div>
                <div class="mt-0 interview_stick" style="height: 1px; width: 66.7%; margin: 0 auto; background-color: #9BA6B2;"></div>

                <div class="d-flex justify-content-around flex-lg-row flex-column">
                  <div class="text-center col-lg-4 col-12" style="overflow: hidden;">
                    <div class="mb-2" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                    <p class="mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 30 30; width: 50px; height: 50px; fill:#9BA6B2; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 30 30" xml:space="preserve"><path d="M25,17.238v7.481l-6-1.5v-3.168l-2-2.813v6.008l-5,1.429V8.781l0.011-0.003c0.018-0.739,0.127-1.455,0.314-2.14  l-0.788,0.197c-0.34,0.085-0.697,0.079-1.035-0.017L4.339,5.056C3.668,4.865,3,5.368,3,6.066v17.179c0,0.893,0.592,1.678,1.45,1.923  l6.194,1.77c0.233,0.066,0.479,0.066,0.712,0l6.147-1.756c0.337-0.096,0.694-0.102,1.035-0.017l7.158,1.79  C26.358,27.121,27,26.619,27,25.936V15.643L25,17.238z M10,24.674l-5-1.428V7.326l5,1.428V24.674z"></path><g><path d="M21,2c-3.866,0-7,3.134-7,7c0,4.604,4.551,6.745,5.121,7.258c0.582,0.524,1.063,1.575,1.258,2.241   c0.094,0.323,0.359,0.487,0.621,0.494c0.263-0.007,0.527-0.171,0.621-0.494c0.194-0.665,0.675-1.717,1.258-2.241   C23.449,15.745,28,13.604,28,9C28,5.134,24.866,2,21,2z M21,11c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S22.105,11,21,11z"></path>
                      </g>
                      </svg>
                    </p>
                    <p style="font-size: 18px; color:#9BA6B2;"><strong>{!! trans('guides.u_interviews.item_2_title') !!}</strong></p>
                    <p>{!! trans('guides.u_interviews.item_2_text') !!}</p>
                    <p><a class="btn btn-primary" role="button" href="https://jobmap.co/cardinal">{!! trans('main.buttons.go_to_jobmap') !!}</a></p>
                    <div class="mt-2" style="width: 1px; margin: 0 auto; background-color: #9BA6B2; height: 100%;"></div>
                  </div>
                  <div class="text-center col-lg-4 col-12" style="overflow: hidden;">
                    <div class="mb-2" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                    <p class="mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve" width="50px" height="50px">
                        <g>
                            <g>
                                <path d="M256,60c-57.897,0-105,47.103-105,105c0,35.943,18.126,69.015,48.487,88.467c31.003,19.863,69.06,21.974,104.426,5.703    c7.525-3.462,10.82-12.37,7.357-19.896c-3.462-7.525-12.369-10.82-19.896-7.358c-25.86,11.898-53.454,10.545-75.703-3.709    C193.961,214.298,181,190.669,181,165c0-41.355,33.645-75,75-75s75,33.645,75,75c0,8.271-6.729,15-15,15    c-7.558,0-14.618-5.732-14.998-14.772C301.001,165.152,301,165.076,301,165c0-24.813-20.187-45-45-45s-45,20.187-45,45    s20.187,45,45,45c11.516,0,22.031-4.353,29.999-11.494C293.966,205.648,304.483,210,316,210c24.813,0,45-20.187,45-45    C361,107.103,313.897,60,256,60z M270.789,167.406C269.631,174.535,263.45,180,256,180c-8.271,0-15-6.729-15-15s6.729-15,15-15    c7.691,0,14.04,5.82,14.895,13.285C270.671,164.648,270.634,166.035,270.789,167.406z"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M480.999,196.976c-0.004-3.879-1.566-7.756-4.393-10.583L421,130.787V15c0-8.284-6.716-15-15-15H106    c-8.284,0-15,6.716-15,15v115.787l-55.606,55.606c-0.052,0.052-0.096,0.11-0.147,0.163c-2.811,2.896-4.24,6.709-4.246,10.42    c0,0.01-0.001,0.019-0.001,0.029V467c0,24.845,20.216,45,45,45h360c24.839,0,45-20.207,45-45V197.005    C481,196.995,480.999,196.986,480.999,196.976z M421,173.213L444.787,197L421,220.787V173.213z M121,137.005    c0-0.003,0-0.007,0-0.01V30h270v106.995c0,0.003,0,0.007,0,0.01v113.782L309.787,332H202.213L121,250.787V137.005z M91,173.213    v47.574L67.213,197L91,173.213z M61,460.787V233.213L174.787,347L61,460.787z M82.214,482l119.999-120h107.574l119.999,120H82.214    z M451,460.787L337.213,347L451,233.213V460.787z"></path>
                            </g>
                        </g>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                        <g>
                            <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256   C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z   "/>
                            <path d="M316.75,216.812h-44.531v-32.5c0-9.969,10.312-12.281,15.125-12.281c4.781,0,28.767,0,28.767,0v-43.859L283.141,128   c-44.983,0-55.25,32.703-55.25,53.672v35.141H195.25V262h32.641c0,58.016,0,122,0,122h44.328c0,0,0-64.641,0-122h37.656   L316.75,216.812z"/>
                        </g>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                        <g>
                            <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256   C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z   "/>
                            <g>
                                <g>
                                    <path d="M128.094,383.891h48v-192h-48V383.891z M320.094,191.891c-41.094,0.688-61.312,30.641-64,32v-32h-48v192h48v-112     c0-4.108,10.125-37,48-32c20.344,1.328,31.312,28.234,32,32v112l47.812,0.219V251.188     C382.219,232,372.625,192.578,320.094,191.891z M152.094,127.891c-13.25,0-24,10.734-24,24s10.75,24,24,24s24-10.734,24-24     S165.344,127.891,152.094,127.891z"/>
                                </g>
                            </g>
                        </g>
                      </svg>
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                        <g>
                            <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256   C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z   "/>
                            <g>
                                <g>
                                    <path d="M278.062,135.945c8.719-4.891,12.53-8.062,12.53-8.062h-83.281c-16.688,0-63.031,18.953-63.031,63.203     c0,44.258,48.062,53.758,65.5,53.039c-9.781,11.938-1.406,22.844,3.844,28.422c5.219,5.625,4.156,7.375-2.094,7.375     c-6.281,0-83.625,0.844-83.625,56.219s102.781,59.375,136.562,29.531c33.781-29.844,26.47-71,0.345-89.594     c-26.125-18.609-35.875-27.391-19.156-42.141c16.719-14.75,29.969-26.688,29.969-54.086c0-27.406-22.656-41.422-22.656-41.422     S269.344,140.867,278.062,135.945z M265.156,333.328c0,23.891-20.281,35.469-54.719,35.469     c-34.469,0-52.938-17.203-52.938-42.844c0-25.656,25.094-38.297,72.125-38.297C242.375,297.484,265.156,309.422,265.156,333.328z      M215.344,233.219c-41.469,0-60.281-96.898-11.5-96.898C241.812,134.898,270.375,233.219,215.344,233.219z M352.75,160.039     v-31.516h-16.281v31.516h-31.875v16.359h31.875v31.57h16.281v-31.57h31.344v-16.359H352.75z"/>
                                </g>
                            </g>
                        </g>
                     </svg>
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                        <g>
                            <path d="M256,0C114.609,0,0,114.609,0,256c0,141.392,114.609,256,256,256c141.392,0,256-114.608,256-256   C512,114.609,397.392,0,256,0z M256,472c-119.297,0-216-96.702-216-216c0-119.297,96.703-216,216-216c119.298,0,216,96.703,216,216   C472,375.298,375.298,472,256,472z"/>
                            <path d="M384,170.922c-4.312,2.562-17.248,7.671-29.312,8.953c7.735-4.491,19.188-19.203,22.016-30.89   c-7.436,5.109-24.516,12.562-32.95,12.562c0,0,0,0.023,0.016,0.039C334.141,150.75,320.608,144,305.577,144   c-29.154,0-52.81,25.461-52.81,56.875c0,4.36,0.481,8.595,1.357,12.672h-0.017c-39.562-1.094-85.811-22.446-111.874-59   c-16,29.852-2.156,63.046,16.015,75.141c-6.203,0.516-17.671-0.766-23.061-6.407c-0.375,19.797,8.484,46.048,40.735,55.562   c-6.221,3.61-17.19,2.579-21.984,1.781c1.687,16.75,23.437,38.623,47.202,38.623c-8.47,10.534-37.373,29.706-73.141,23.596   C152.298,358.782,180.625,368,210.608,368c85.205,0,151.376-74.359,147.814-166.093c0-0.11-0.031-0.219-0.031-0.313   c0-0.25,0.031-0.5,0.031-0.719c0-0.281-0.031-0.562-0.031-0.859C366.141,194.328,376.546,184.234,384,170.922z"/>
                        </g>
                     </svg>
                    </p>
                    <p style="font-size: 18px; color:#9BA6B2;"><strong>{!! trans('guides.u_interviews.item_3_title') !!}</strong></p>
                    <p>{!! trans('guides.u_interviews.item_3_text') !!}</p>
                    <div class="mt-2" style="width: 1px; margin: 0 auto; background-color: #9BA6B2; height: 100%;"></div>
                  </div>
                  <div class="text-center col-lg-4 col-12" style="position: relative;">
                    <div class="mb-2" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                    <p class="mb-3">  
                      <img src="{{ asset('img/handsbig3.png') }}" style="width: 55px;">
                    </p>
                    <p style="font-size: 18px; color:#9BA6B2;"><strong>{!! trans('guides.u_interviews.item_4_title') !!}</strong></p>
                    <p>{!! trans('guides.u_interviews.item_4_text') !!}</p>
                    <div class="mt-2 interview_stick" style="height: 143px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                  </div>
                </div>

                <div class="mt-0 interview_stick" style="height: 1px; width: 66.7%; margin: 0 auto; background-color: #9BA6B2;"></div>

                <div class="d-flex justify-content-center flex-lg-row flex-column">
                  <div class="text-center col-lg-4 col-12">
                    <div class="mb-2" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                    <p class="mb-3">
                      <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;  margin-top: -3px;" xml:space="preserve" width="50px" height="50px">
                        <g>
                            <g>
                                <path d="M427.047,371.878C441.768,358.176,451,338.65,451,317c0-41.355-33.645-75-75-75c-41.355,0-75,33.645-75,75    c0,5.136,0.521,10.152,1.509,15h-2.347c-5.542-49.902-38.391-91.68-83.228-110.014C231.722,208.278,241,188.706,241,167    c0-41.355-33.645-75-75-75s-75,33.645-75,75c0,21.65,9.232,41.176,23.953,54.878c-46.02,18.568-79.562,61.451-84.354,112.499    C12.83,340.397,0,357.223,0,377v120c0,8.284,6.716,15,15,15c10.432,0,471.568,0,482,0c8.284,0,15-6.716,15-15    C512,440.473,476.815,391.958,427.047,371.878z M376,272c24.813,0,45,20.187,45,45s-20.187,45-45,45s-45-20.187-45-45    S351.187,272,376,272z M166,122c24.813,0,45,20.187,45,45s-20.187,45-45,45s-45-20.187-45-45S141.187,122,166,122z M166,242    c52.805,0,96.631,39.183,103.932,90H61.078C68.448,281.183,112.692,242,166,242z M30,377c0-8.271,6.729-15,15-15    c11.179,0,259.305,0,271.041,0c2.705,3.595,5.731,6.932,9.025,9.986c-12.275,5.019-23.65,11.794-33.814,20.014H30V377z     M241.838,482H30v-60.1h233.806C252.042,439.441,244.284,459.98,241.838,482z M272.068,482c7.301-50.817,51.127-90,103.932-90    c53.308,0,97.552,39.183,104.922,90H272.068z"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M467,0H316c-24.813,0-45,20.187-45,45v62c0,19.556,12.539,36.239,30,42.43V197c0,6.067,3.654,11.537,9.26,13.858    c5.604,2.322,12.057,1.039,16.347-3.251L382.213,152H467c24.813,0,45-20.187,45-45V45C512,20.187,491.813,0,467,0z M482,107    c0,8.271-6.729,15-15,15h-91c-3.979,0-7.794,1.58-10.606,4.393L331,160.787V137c0-8.284-6.716-15-15-15c-8.271,0-15-6.729-15-15    V45c0-8.271,6.729-15,15-15h151c8.271,0,15,6.729,15,15V107z"></path>
                            </g>
                        </g>
                      </svg>
                    </p>
                    <p style="font-size: 18px; color:#9BA6B2;"><strong>{!! trans('guides.u_interviews.item_5_title') !!}</strong></p>
                    <p>{!! trans('guides.u_interviews.item_5_text') !!}</p>
                  </div>  
                </div>
                <p class="mb-0 text-center">
                  {{--<button class="btn btn-success interview-requests-content__hide-how-to-start">--}}
                  <button class="btn btn-success help-how-to-start-hide help-how-to-start-gotit">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:#fff;" xml:space="preserve">
                        <g>
                            <g id="check">
                                <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                            </g>
                        </g>
                    </svg>
                      {!! trans('main.buttons.got_it') !!}
                  </button>
                </p>
                </div>
            </div>
          <!-- 
          <div class="col-12 bg-white border rounded mt-4 p-3 pxa-0">
            <p class="h3 text-center">How it works</p>
            <div class="d-flex justify-content-around flex-lg-row flex-column mt-5">
              <div class="col-lg-5 col-12">
                <p class="text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 490.282 490.282" style="enable-background:new 0 0 512.001 512.001; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve" width="50px" height="50px"><g><g>
                      <path d="M0.043,245.197c0.6,10.1,7.3,18.6,17,21.5l179.6,54.3l6.6,123.8c0.3,4.9,3.6,9.2,8.3,10.8c1.3,0.5,2.7,0.7,4,0.7   c3.5,0,6.8-1.4,9.2-4.1l63.5-70.3l90,62.3c4,2.8,8.7,4.3,13.6,4.3c11.3,0,21.1-8,23.5-19.2l74.7-380.7c0.9-4.4-0.8-9-4.2-11.8   c-3.5-2.9-8.2-3.6-12.4-1.9l-459,186.8C5.143,225.897-0.557,235.097,0.043,245.197z M226.043,414.097l-4.1-78.1l46,31.8   L226.043,414.097z M391.443,423.597l-163.8-113.4l229.7-222.2L391.443,423.597z M432.143,78.197l-227.1,219.7l-179.4-54.2   L432.143,78.197z"></path>
                      </g></g> 
                  </svg>
                </p>
                <p class="text-center" style="font-size: 18px; color:#9BA6B2;"><strong>You send your CloudResume</strong></p>
                <p>Send your resume via JobMap or print and give it in person. Employers can scan your CloudResume QR code and will be able to send you interview invites.</p>
              </div>
              <div class="col-lg-5 col-12">
                <p class="text-center">
                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;  fill:#9BA6B2; vertical-align: middle;" xml:space="preserve" width="50px" height="50px">
                    <g>
                        <g>
                            <path d="M427.047,371.878C441.768,358.176,451,338.65,451,317c0-41.355-33.645-75-75-75c-41.355,0-75,33.645-75,75    c0,5.136,0.521,10.152,1.509,15h-2.347c-5.542-49.902-38.391-91.68-83.228-110.014C231.722,208.278,241,188.706,241,167    c0-41.355-33.645-75-75-75s-75,33.645-75,75c0,21.65,9.232,41.176,23.953,54.878c-46.02,18.568-79.562,61.451-84.354,112.499    C12.83,340.397,0,357.223,0,377v120c0,8.284,6.716,15,15,15c10.432,0,471.568,0,482,0c8.284,0,15-6.716,15-15    C512,440.473,476.815,391.958,427.047,371.878z M376,272c24.813,0,45,20.187,45,45s-20.187,45-45,45s-45-20.187-45-45    S351.187,272,376,272z M166,122c24.813,0,45,20.187,45,45s-20.187,45-45,45s-45-20.187-45-45S141.187,122,166,122z M166,242    c52.805,0,96.631,39.183,103.932,90H61.078C68.448,281.183,112.692,242,166,242z M30,377c0-8.271,6.729-15,15-15    c11.179,0,259.305,0,271.041,0c2.705,3.595,5.731,6.932,9.025,9.986c-12.275,5.019-23.65,11.794-33.814,20.014H30V377z     M241.838,482H30v-60.1h233.806C252.042,439.441,244.284,459.98,241.838,482z M272.068,482c7.301-50.817,51.127-90,103.932-90    c53.308,0,97.552,39.183,104.922,90H272.068z"></path>
                        </g>
                    </g>
                    <g>
                        <g>
                            <path d="M467,0H316c-24.813,0-45,20.187-45,45v62c0,19.556,12.539,36.239,30,42.43V197c0,6.067,3.654,11.537,9.26,13.858    c5.604,2.322,12.057,1.039,16.347-3.251L382.213,152H467c24.813,0,45-20.187,45-45V45C512,20.187,491.813,0,467,0z M482,107    c0,8.271-6.729,15-15,15h-91c-3.979,0-7.794,1.58-10.606,4.393L331,160.787V137c0-8.284-6.716-15-15-15c-8.271,0-15-6.729-15-15    V45c0-8.271,6.729-15,15-15h151c8.271,0,15,6.729,15,15V107z"></path>
                        </g>
                    </g>
                  </svg>
                </p>
                <p class="text-center" style="font-size: 18px; color:#9BA6B2;"><strong>Interested employer will send you an interview request</strong></p>
                <p>When employers see that they are interested, they push a button to send you a request. You will receive it on this website on via our mobile app.</p>
              </div>
            </div>
          </div> -->

            <p class="mt-4 d-flex justify-content-between">
                {{--<button type="button" class="pt-0 mt-0 border-0 ml-auto interview-requests-content__show-how-to-start" style="background-color: inherit; font-size: 13px; opacity: 0.4; cursor: pointer;">--}}
                <button type="button" class="pt-0 mt-0 border-0 ml-auto help-how-to-start-show" style="background-color: inherit; font-size: 13px; opacity: 0.4; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px;"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                    {!! trans('main.help') !!}
                </button>
            </p>

            <div id="interview-requests-content" style="display: none;">
              <!-- WHEN YOU GOT INTERVIEW -->
              <!-- <p class="mt-4 d-flex justify-content-between">
                <strong>
                    <span class="realtime__count-of-upcoming-interviews">0</span> Upcoming Interviews
                </strong>
              </p> -->
                
                <div class="text-center col-md-12 d-flex flex-column flex-lg-row flex-wrap my-3 px-0" id="interview-request-buttons">
                    <button class="p-item btn btn-outline-primary rounded-0 flex-1 py-2 mt-0 releative" type="button" data-id="pending">
                        <span class="mb-0">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 486.463 486.463" style="enable-background:new 0 0 486.463 486.463; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
                              <g>
                                <g>
                                  <path d="M243.225,333.382c-13.6,0-25,11.4-25,25s11.4,25,25,25c13.1,0,25-11.4,24.4-24.4    C268.225,344.682,256.925,333.382,243.225,333.382z"/>
                                  <path d="M474.625,421.982c15.7-27.1,15.8-59.4,0.2-86.4l-156.6-271.2c-15.5-27.3-43.5-43.5-74.9-43.5s-59.4,16.3-74.9,43.4    l-156.8,271.5c-15.6,27.3-15.5,59.8,0.3,86.9c15.6,26.8,43.5,42.9,74.7,42.9h312.8    C430.725,465.582,458.825,449.282,474.625,421.982z M440.625,402.382c-8.7,15-24.1,23.9-41.3,23.9h-312.8    c-17,0-32.3-8.7-40.8-23.4c-8.6-14.9-8.7-32.7-0.1-47.7l156.8-271.4c8.5-14.9,23.7-23.7,40.9-23.7c17.1,0,32.4,8.9,40.9,23.8    l156.7,271.4C449.325,369.882,449.225,387.482,440.625,402.382z"/>
                                  <path d="M237.025,157.882c-11.9,3.4-19.3,14.2-19.3,27.3c0.6,7.9,1.1,15.9,1.7,23.8c1.7,30.1,3.4,59.6,5.1,89.7    c0.6,10.2,8.5,17.6,18.7,17.6c10.2,0,18.2-7.9,18.7-18.2c0-6.2,0-11.9,0.6-18.2c1.1-19.3,2.3-38.6,3.4-57.9    c0.6-12.5,1.7-25,2.3-37.5c0-4.5-0.6-8.5-2.3-12.5C260.825,160.782,248.925,155.082,237.025,157.882z"/>
                                </g>
                              </g>
                            </svg>
                        </span>
                        <p class="mb-0 mt-1" style="font-size:12px;" data-id="1">
                            <span style="font-weight: lighter;">{!! trans('main.tabs.u_interviews.pending') !!}</span>
                        </p>
                        <span class="notification_dashboard_business" style="font-size: 12px !important; top: -8px; right: 3px; background-color: #dc3545; display: none;">0</span>
                    </button>
                    <button class="p-item btn btn-outline-primary rounded-0 flex-1 py-2 mt-0 releative" type="button" data-id="upcoming">
                        <span class="mb-0">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 203.543 203.543" enable-background="new 0 0 203.543 203.543" style="vertical-align: middle;" width="20px" height="20px">
                              <g>
                                <path d="m194.139,11.918h-39.315v-5.918c0-3.313-2.687-6-6-6s-6,2.687-6,6v5.918h-35.053v-5.918c0-3.313-2.687-6-6-6s-6,2.687-6,6v5.918h-33.563v-5.918c0-3.313-2.687-6-6-6s-6,2.687-6,6v5.918h-40.804c-3.313,0-6,2.687-6,6v135.572c0,3.313 2.687,6 6,6h36.826c5.901,25.214 28.555,44.053 55.541,44.053s49.64-18.84 55.541-44.053h36.826c3.313,0 6-2.687 6-6v-135.572c0.001-3.313-2.685-6-5.999-6zm-143.931,12v5.422c0,3.313 2.687,6 6,6s6-2.687 6-6v-5.422h33.563v5.422c0,3.313 2.687,6 6,6s6-2.687 6-6v-5.422h35.053v5.422c0,3.313 2.687,6 6,6s6-2.687 6-6v-5.422h33.315v24.536h-172.735v-24.536h34.804zm51.563,167.625c-24.842,0-45.053-20.211-45.053-45.053s20.211-45.053 45.053-45.053 45.053,20.21 45.053,45.053-20.21,45.053-45.053,45.053zm57.028-44.053c0.006-0.334 0.025-0.665 0.025-1 0-31.459-25.594-57.053-57.053-57.053s-57.053,25.594-57.053,57.053c0,0.335 0.02,0.666 0.025,1h-29.34v-87.035h172.735v87.035h-29.339z"/>
                                <path d="m107.771,148.004v-29.026c0-3.313-2.687-6-6-6s-6,2.687-6,6v31.512c0,1.591 0.632,3.117 1.757,4.243l13.79,13.791c1.172,1.171 2.707,1.757 4.243,1.757 1.535,0 3.071-0.586 4.243-1.757 2.343-2.343 2.343-6.142 0-8.485l-12.033-12.035z"/>
                              </g>
                            </svg>
                        </span>
                        <p class="mb-0 mt-1" style="font-size:12px;" data-id="1">
                            <span style="font-weight: lighter;">{!! trans('main.tabs.u_interviews.upcoming') !!}</span>
                        </p>
                        <span class="notification_dashboard_business" style="font-size: 12px !important; top: -8px; right: 3px; background-color: #dc3545; display: none;">0</span>
                    </button>
                    <button class="p-item btn btn-outline-primary rounded-0 flex-1 py-2 mt-0 releative" type="button" data-id="archived">
                        <span class="mb-0">
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" version="1.1" viewBox="0 0 64 64" enable-background="new 0 0 64 64" width="20px" height="20px" style="vertical-align: middle;">
                            <g>
                              <g>
                                <path d="m34.688,3.315c-15.887,0-28.812,12.924-28.81,28.729-0.012,0.251-0.157,4.435 1.034,8.941l-3.881-2.262c-0.964-0.56-2.192-0.235-2.758,0.727-0.558,0.96-0.234,2.195 0.727,2.755l9.095,5.302c0.019,0.01 0.038,0.013 0.056,0.022 0.097,0.052 0.196,0.09 0.301,0.126 0.071,0.025 0.14,0.051 0.211,0.068 0.087,0.019 0.173,0.025 0.262,0.033 0.062,0.006 0.124,0.025 0.186,0.025 0.035,0 0.068-0.012 0.104-0.014 0.034-0.001 0.063,0.007 0.097,0.004 0.05-0.005 0.095-0.026 0.144-0.034 0.097-0.017 0.189-0.038 0.282-0.068 0.078-0.026 0.155-0.057 0.23-0.093 0.084-0.04 0.163-0.084 0.241-0.136 0.071-0.046 0.139-0.096 0.203-0.15 0.071-0.06 0.134-0.125 0.197-0.195 0.059-0.065 0.11-0.133 0.159-0.205 0.027-0.04 0.063-0.069 0.087-0.11 0.018-0.031 0.018-0.067 0.033-0.098 0.027-0.055 0.069-0.103 0.093-0.162l3.618-8.958c0.417-1.032-0.081-2.207-1.112-2.624-1.033-0.414-2.207,0.082-2.624,1.114l-1.858,4.6c-1.24-4.147-1.099-8.408-1.095-8.525 0-13.664 11.117-24.78 24.779-24.78 13.663,0 24.779,11.116 24.779,24.78 0,13.662-11.116,24.778-24.779,24.778-1.114,0-2.016,0.903-2.016,2.016s0.901,2.016 2.016,2.016c15.888,0 28.812-12.924 28.812-28.81-0.002-15.888-12.926-28.812-28.813-28.812z"/>
                                <path d="m33.916,36.002c0.203,0.084 0.417,0.114 0.634,0.129 0.045,0.003 0.089,0.027 0.134,0.027 0.236,0 0.465-0.054 0.684-0.134 0.061-0.022 0.118-0.054 0.177-0.083 0.167-0.08 0.321-0.182 0.463-0.307 0.031-0.027 0.072-0.037 0.103-0.068l12.587-12.587c0.788-0.788 0.788-2.063 0-2.851-0.787-0.788-2.062-0.788-2.851,0l-11.632,11.631-10.439-4.372c-1.033-0.431-2.209,0.053-2.64,1.081-0.43,1.027 0.055,2.208 1.08,2.638l11.688,4.894c0.004,0.001 0.008,0.001 0.012,0.002z"/>
                              </g>
                            </g>
                          </svg>
                        </span>
                        <p class="mb-0 mt-1" style="font-size:12px;" data-id="1">
                            <span style="font-weight: lighter;">{!! trans('main.tabs.u_interviews.history') !!}</span>
                        </p>
                        <span class="notification_dashboard_business" style="font-size: 12px !important; top: -8px; right: 3px; background-color: #efefef; display: none;">0</span>
                    </button>
                </div>

                <div class="[ interview-requests ] col-12 bg-white rounded p-3"></div>
                <!-- WHEN YOU GOT INTERVIEW END -->
            </div>
        </div>              
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $(document).on('click', '.interview-request__send-message', function(event) {
                event.preventDefault();
                
                $('#new-chat-message-modal').data('initialize')({
                    with_user_id: parseInt($(this).attr('data-user-id')),
                    with_business_id: parseInt($(this).attr('data-business-id')),
                });

                $('#new-chat-message-modal').modal('show');
            });
        });
    </script>
@endpush

@push('ejs-templates')
    @include('components.interview-requests-ejs-templates')
@endpush