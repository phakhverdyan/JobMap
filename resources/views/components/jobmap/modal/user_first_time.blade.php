<div class="modal fade" id="userFirstTime" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="overflow: auto;">
    <div id="no-click" class="modal fade show" tabindex="-1" role="dialog" style="overflow: auto; display: block; z-index: -1"></div>
    <div class="modal-dialog modal-lg" style="max-width: 1024px;">
        <div class="modal-content">
            <div class="modal-body">
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; top:10px; right: 10px;">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
                <div class="col-12 mt-1 p-3 pxa-0 pb-4">
                    <p class="h3 text-center">
                        {!! trans('lets_get_started.user.how_to_start_receiving') !!}
                    </p>
                    <div class="d-flex justify-content-between flex-lg-row flex-column mt-5 mb-4">
                        <div class="text-center align-self-center col-lg-4 col-12 mt-2">
                            <p class="mb-3">
                                 @svg('/img/icons/upload_resume.svg', [
                                   'width' => '50px',
                                   'height' => '50px',
                                   'style' => 'vertical-align: middle;  margin-top: -3px;',
                                  ])
                            </p>
                            <p style="font-size: 18px; color:#9BA6B2;">
                                <strong>{!! trans('lets_get_started.user.upload_resume') !!}</strong></p>
                            <p>{!! trans('lets_get_started.user.add_your_pdf') !!}</p>
                            <p>
                                <form id="user-resume-attach_file-form" autocomplete="off">
                                    <span id="user-resume-attach_file-name"></span>
                                    <a id="user-resume-attach_file-click" class="user-resume-attach_file-click btn btn-primary btn-block py-5" role="button" href="javascript:;">{!! trans('lets_get_started.user.upload_resume') !!}</a>
                                    <input type="file" name="attach_file" id="user-resume-attach_file-input" style="display: none" accept=".pdf, .jpg, .jpeg, .png">
                                </form>
                            </p>
                        </div>
                        <div class="text-center align-self-center col-lg-4 col-12 mt-2">
                            <p class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001; fill:#9BA6B2; vertical-align: middle;  margin-top: -3px;" xml:space="preserve" width="50px" height="50px">
                                  <g>
                                      <g>
                                          <path d="M172.832,330.685l-19.068,68.677H99.896c-6.862,0-12.425,5.563-12.425,12.425c0,6.862,5.563,12.425,12.425,12.425h63.314    h0.001c0.514,0,1.019-0.041,1.518-0.102c0.128-0.016,0.253-0.039,0.381-0.058c0.416-0.065,0.825-0.148,1.226-0.252    c0.065-0.017,0.132-0.022,0.196-0.04l77.778-21.595c2.065-0.573,3.946-1.671,5.462-3.186l239.37-239.37    c16.327-16.327,16.327-42.893,0-59.219l-14.536-14.536c-7.909-7.91-18.424-12.265-29.609-12.265s-21.701,4.355-29.61,12.265    l-8.971,8.971V27.091C406.417,12.153,394.27,0,379.339,0H125.385c-3.295,0-6.456,1.31-8.786,3.639L14.252,105.987    c-2.33,2.33-3.639,5.49-3.639,8.786v370.138c0,14.938,12.153,27.091,27.091,27.091h341.636c14.931,0,27.078-12.153,27.078-27.091    V312.72c0-6.862-5.563-12.425-12.425-12.425c-6.862,0-12.425,5.563-12.425,12.425v172.191c0,1.235-0.999,2.24-2.228,2.24H37.703    c-1.235,0-2.24-1.005-2.24-2.24V127.199h75.269c14.933,0,27.079-12.148,27.079-27.079V24.85h241.527    c1.229,0,2.228,1.005,2.228,2.24v91.852c0,0.235,0.022,0.465,0.035,0.696l-81.586,81.586H99.896    c-6.862,0-12.425,5.563-12.425,12.425s5.563,12.425,12.425,12.425h175.269l-74.218,74.218H99.896    c-6.862,0-12.425,5.563-12.425,12.425s5.563,12.425,12.425,12.425h76.201l-0.078,0.078    C174.503,326.738,173.405,328.62,172.832,330.685z M112.961,100.118c0,1.229-1,2.229-2.229,2.229H53.039l59.922-59.922V100.118z     M432.96,103.424c3.216-3.214,7.491-4.985,12.038-4.985c4.548,0,8.822,1.771,12.037,4.986l14.536,14.536    c6.638,6.638,6.638,17.438,0,24.074l-15.518,15.518l-38.611-38.611L432.96,103.424z M399.87,136.514l38.611,38.611L240.988,372.62    l-38.611-38.611L399.87,136.514z M191.078,357.856l26.062,26.062l-36.08,10.017L191.078,357.856z"></path>
                                      </g>
                                  </g>
                              </svg>
                            </p>
                            <p style="font-size: 18px; color:#9BA6B2;">
                                <strong>{!! trans('lets_get_started.user.build_your_cloudresume') !!}</strong></p>
                            <p>{!! trans('lets_get_started.user.follow_our_step_by_step') !!}</p>
                            <p><a class="btn btn-primary btn-block py-5" role="button" href="{{ url('/user/resume/create') }}">{!! trans('lets_get_started.user.build_your_cloudresume') !!}</a>
                            </p>
                        </div>
                    </div>

                    <div class="mt-0 interview_stick" style="height: 1px; width: 66.7%; margin: 0 auto; background-color: #9BA6B2;"></div>

                    <div class="d-flex justify-content-around flex-lg-row flex-column">
                        <div class="text-center col-lg-4 col-12" style="overflow: hidden;">
                            <div class="mb-2" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                            <p class="mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" style="enable-background:new 0 0 30 30; width: 50px; height: 50px; fill:#9BA6B2; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 30 30" xml:space="preserve"><path d="M25,17.238v7.481l-6-1.5v-3.168l-2-2.813v6.008l-5,1.429V8.781l0.011-0.003c0.018-0.739,0.127-1.455,0.314-2.14  l-0.788,0.197c-0.34,0.085-0.697,0.079-1.035-0.017L4.339,5.056C3.668,4.865,3,5.368,3,6.066v17.179c0,0.893,0.592,1.678,1.45,1.923  l6.194,1.77c0.233,0.066,0.479,0.066,0.712,0l6.147-1.756c0.337-0.096,0.694-0.102,1.035-0.017l7.158,1.79  C26.358,27.121,27,26.619,27,25.936V15.643L25,17.238z M10,24.674l-5-1.428V7.326l5,1.428V24.674z"></path>
                                    <g>
                                        <path d="M21,2c-3.866,0-7,3.134-7,7c0,4.604,4.551,6.745,5.121,7.258c0.582,0.524,1.063,1.575,1.258,2.241   c0.094,0.323,0.359,0.487,0.621,0.494c0.263-0.007,0.527-0.171,0.621-0.494c0.194-0.665,0.675-1.717,1.258-2.241   C23.449,15.745,28,13.604,28,9C28,5.134,24.866,2,21,2z M21,11c-1.105,0-2-0.895-2-2s0.895-2,2-2s2,0.895,2,2S22.105,11,21,11z"></path>
                                    </g>
                                </svg>
                            </p>
                            <p style="font-size: 18px; color:#9BA6B2;">
                                <strong>{!! trans('lets_get_started.user.apply_to_any_company_on') !!}</strong></p>
                            <p>{!! trans('lets_get_started.user.choose_any_location_and_see') !!}</p>
                            <!-- <p><a class="btn btn-primary" role="button" href="https://jobmap.co/cardinal">Go to JobMap</a></p> -->
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
                                        <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256   C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z   "></path>
                                        <path d="M316.75,216.812h-44.531v-32.5c0-9.969,10.312-12.281,15.125-12.281c4.781,0,28.767,0,28.767,0v-43.859L283.141,128   c-44.983,0-55.25,32.703-55.25,53.672v35.141H195.25V262h32.641c0,58.016,0,122,0,122h44.328c0,0,0-64.641,0-122h37.656   L316.75,216.812z"></path>
                                    </g>
                                  </svg>
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                                    <g>
                                        <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256   C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z   "></path>
                                        <g>
                                            <g>
                                                <path d="M128.094,383.891h48v-192h-48V383.891z M320.094,191.891c-41.094,0.688-61.312,30.641-64,32v-32h-48v192h48v-112     c0-4.108,10.125-37,48-32c20.344,1.328,31.312,28.234,32,32v112l47.812,0.219V251.188     C382.219,232,372.625,192.578,320.094,191.891z M152.094,127.891c-13.25,0-24,10.734-24,24s10.75,24,24,24s24-10.734,24-24     S165.344,127.891,152.094,127.891z"></path>
                                            </g>
                                        </g>
                                    </g>
                                  </svg>
                                  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                                    <g>
                                        <path d="M256,0C114.609,0,0,114.609,0,256c0,141.391,114.609,256,256,256c141.391,0,256-114.609,256-256   C512,114.609,397.391,0,256,0z M256,472c-119.297,0-216-96.703-216-216S136.703,40,256,40s216,96.703,216,216S375.297,472,256,472z   "></path>
                                        <g>
                                            <g>
                                                <path d="M278.062,135.945c8.719-4.891,12.53-8.062,12.53-8.062h-83.281c-16.688,0-63.031,18.953-63.031,63.203     c0,44.258,48.062,53.758,65.5,53.039c-9.781,11.938-1.406,22.844,3.844,28.422c5.219,5.625,4.156,7.375-2.094,7.375     c-6.281,0-83.625,0.844-83.625,56.219s102.781,59.375,136.562,29.531c33.781-29.844,26.47-71,0.345-89.594     c-26.125-18.609-35.875-27.391-19.156-42.141c16.719-14.75,29.969-26.688,29.969-54.086c0-27.406-22.656-41.422-22.656-41.422     S269.344,140.867,278.062,135.945z M265.156,333.328c0,23.891-20.281,35.469-54.719,35.469     c-34.469,0-52.938-17.203-52.938-42.844c0-25.656,25.094-38.297,72.125-38.297C242.375,297.484,265.156,309.422,265.156,333.328z      M215.344,233.219c-41.469,0-60.281-96.898-11.5-96.898C241.812,134.898,270.375,233.219,215.344,233.219z M352.75,160.039     v-31.516h-16.281v31.516h-31.875v16.359h31.875v31.57h16.281v-31.57h31.344v-16.359H352.75z"></path>
                                            </g>
                                        </g>
                                    </g>
                                 </svg>
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#9BA6B2; vertical-align: middle;" xml:space="preserve">
                                    <g>
                                        <path d="M256,0C114.609,0,0,114.609,0,256c0,141.392,114.609,256,256,256c141.392,0,256-114.608,256-256   C512,114.609,397.392,0,256,0z M256,472c-119.297,0-216-96.702-216-216c0-119.297,96.703-216,216-216c119.298,0,216,96.703,216,216   C472,375.298,375.298,472,256,472z"></path>
                                        <path d="M384,170.922c-4.312,2.562-17.248,7.671-29.312,8.953c7.735-4.491,19.188-19.203,22.016-30.89   c-7.436,5.109-24.516,12.562-32.95,12.562c0,0,0,0.023,0.016,0.039C334.141,150.75,320.608,144,305.577,144   c-29.154,0-52.81,25.461-52.81,56.875c0,4.36,0.481,8.595,1.357,12.672h-0.017c-39.562-1.094-85.811-22.446-111.874-59   c-16,29.852-2.156,63.046,16.015,75.141c-6.203,0.516-17.671-0.766-23.061-6.407c-0.375,19.797,8.484,46.048,40.735,55.562   c-6.221,3.61-17.19,2.579-21.984,1.781c1.687,16.75,23.437,38.623,47.202,38.623c-8.47,10.534-37.373,29.706-73.141,23.596   C152.298,358.782,180.625,368,210.608,368c85.205,0,151.376-74.359,147.814-166.093c0-0.11-0.031-0.219-0.031-0.313   c0-0.25,0.031-0.5,0.031-0.719c0-0.281-0.031-0.562-0.031-0.859C366.141,194.328,376.546,184.234,384,170.922z"></path>
                                    </g>
                                 </svg>
                            </p>
                            <p style="font-size: 18px; color:#9BA6B2;">
                                <strong>{!! trans('lets_get_started.user.email_or_share_your_cloudresume') !!}</strong></p>
                            <p>{!! trans('lets_get_started.user.instead_of_attaching_a_pdf') !!}</p>
                            <div class="mt-2" style="width: 1px; margin: 0 auto; background-color: #9BA6B2; height: 100%;"></div>
                        </div>
                        <div class="text-center col-lg-4 col-12" style="position: relative;">
                            <div class="mb-2" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
                            <p class="mb-3">
                                <img src="{{ url('/') }}/img//handsbig3.png" style="width: 55px;">
                            </p>
                            <p style="font-size: 18px; color:#9BA6B2;">
                                <strong>{!! trans('lets_get_started.user.print_bring_your_cloudresume') !!}</strong></p>
                            <p>{!! trans('lets_get_started.user.employers_will_scan_your_resume') !!}</p>
                            <div class="mt-2 interview_stick" style="height: 50px; width: 1px; margin: 0 auto; background-color: #9BA6B2;"></div>
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
                            <p style="font-size: 18px; color:#9BA6B2;">
                                <strong>{!! trans('lets_get_started.user.receive_interviews_and_messages') !!}</strong></p>
                            <p>{!! trans('lets_get_started.user.you_will_receive_interviews_and_messages') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal" id="user-resume-attach_file-ok" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="exampleModalLabel">Thanks </h5>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row justify-content-center">
                        File uploaded successfully
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <div class="bg-white">
                    <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="Close">Ok</button>
                </div>
            </div>
        </div>
    </div>
</div>
