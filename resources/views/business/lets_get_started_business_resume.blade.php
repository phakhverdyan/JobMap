@extends('layouts.main_business')

@section('script')
    <script src="{{ asset('/js/app/lets_get_started.js?' . time()) }}"></script>
@endsection

@section('content')
    <style type="text/css">
        body{
            background: #fff!important;
        }
    </style>

    <div class="container" style="margin-top: 60px;">
        <div class="col-12">
            <p class="text-center mb-0 pb-3"><img src="{{ asset('img/landing/cr-logo.png') }}" width="70px" class="wow animated fadeInDown"></p>
            <p class="text-center mb-5" style="font-size: 30px;">{!! trans('lets_get_started.business.resume.title') !!}</p>
            <div class="d-flex justify-content-center flex-column-reverse flex-lg-row">
                <div class="border rounded bg-white p-3 mr-3 we_help_you width-100-lg mb-3 blockResult" style="display: none;">
                    <p><strong>{!! trans('lets_get_started.business.resume.we_will_guide_you_with') !!}</strong></p>
                    {{--<p><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none" class="mr-2">1</p>
                    <p><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none" class="mr-2">2</p>
                    <p><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none" class="mr-2">3</p>--}}
                </div>
                <div class="width-100-lg mb-3">
                    <div class="border rounded p-3">
                        <p class="text-center" style="font-size: 17px;">{!! trans('lets_get_started.business.resume.do_you_own_a_website') !!}</p>
                        <div class="d-flex justify-content-around flex-column flex-lg-row" data-toggle="buttons">
                            <label class="btn btn-outline-primary option01 btnChoiceLetsGetStartResume" data-text="{!! trans('lets_get_started.business.resume.you_own_a_website') !!}">
                                <input type="radio" name="item1"  autocomplete="off" checked="" value="1">
                                <span>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none;" class="mr-2 active_icon option01">
                                    {!! trans('lets_get_started.business.buttons.yes') !!}
                                </span>
                            </label>
                            <label class="btn btn-outline-primary option02 btnChoiceLetsGetStartResume">
                                <input type="radio" name="item1"  autocomplete="off" checked="" value="1">
                                <span>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none;" class="mr-2 active_icon ">
                                    {!! trans('lets_get_started.business.buttons.no_we_dont_have_one') !!}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="border rounded p-3 mt-3">
                        <p class="text-center" style="font-size: 17px;">{!! trans('lets_get_started.business.resume.does_your_website_have_a_job_posting_section') !!}</p>
                        <div class="d-flex justify-content-around flex-column flex-lg-row" data-toggle="buttons">
                            <label class="btn btn-outline-primary option01 btnChoiceLetsGetStartResume" data-text="{!! trans('lets_get_started.business.resume.your_website_have_a_job_posting_section') !!}">
                                <input type="radio" name="item2"  autocomplete="off" checked="" value="2">
                                <span>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none;" class="mr-2 active_icon option01">
                                    {!! trans('lets_get_started.business.buttons.yes') !!}
                                </span>
                            </label>
                            <label class="btn btn-outline-primary option02 btnChoiceLetsGetStartResume">
                                <input type="radio" name="item2"  autocomplete="off" checked="" value="2">
                                <span>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none;" class="mr-2 active_icon option01">
                                    {!! trans('lets_get_started.business.buttons.no_we_dont_have_a_job_section_on_our_website') !!}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="border rounded p-3 mt-3">
                        <div class="d-flex justify-content-around">
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"  width="40px" height="40px">
                                    <rect x="64" y="64" style="fill:#ECEFF1;"/>
                                    <polygon style="fill:#CFD8DC;" points="256,296.384 448,448 448,148.672 "/>
                                    <path style="fill:#F44336;" d="M464,64h-16L256,215.616L64,64H48C21.504,64,0,85.504,0,112v288c0,26.496,21.504,48,48,48h16V148.672  l192,147.68L448,148.64V448h16c26.496,0,48-21.504,48-48V112C512,85.504,490.496,64,464,64z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 291.319 291.319" style="enable-background:new 0 0 291.319 291.319;" xml:space="preserve" width="40px" height="40px">
                                    <g>
                                        <path style="fill:#720E9E;" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659   S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z"/>
                                        <path style="fill:#FFFFFF;" d="M212.353,114.98l0.155-0.027l4.825-5.371l-0.237-0.018l0.51-0.801h-67.595l2.604,9.249h18.444   l-31.044,28.722c-6.336-9.24-21.184-30.479-31.544-46.411h19.254v-6.555l0.264-1.884l-0.264-0.036v-0.765H54.631v9.24H77.49   c8.876,7.328,47.358,54.049,48.76,58.51c0.564,4.179,1.366,28.841-0.291,30.698c-1.994,2.868-22.814,1.32-26.483,1.593   l-0.137,9.058c6.7,0.2,26.801-0.009,33.584-0.009c13.364,0,36.77-0.346,40.065-0.082l0.41-8.576l-26.901-0.401   c-0.564-3.887-1.183-28.422-0.619-31.098c2.54-7.765,43.816-39.902,48.059-41.112l3.997-0.901h12.472   C210.405,118.002,212.353,114.98,212.353,114.98z M202.266,179.079l11.689,0.892l13.628-49.979   c-2.276-0.082-22.95-1.93-25.636-2.431L202.266,179.079z M200.245,187.091l0.064,12.208l5.917,0.492l6.391,0.446l1.875-11.944   l-6.737-0.31C207.756,187.983,200.245,187.091,200.245,187.091z"/>
                                    </g>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 216 216" style="enable-background:new 0 0 216 216;" xml:space="preserve" width="40px" height="40px">
                                    <path d="M108,0C48.353,0,0,48.353,0,108s48.353,108,108,108s108-48.353,108-108S167.647,0,108,0z M179.237,121.063  c-1.419-1.622-3.498-2.651-5.822-2.651c-4.275,0-7.74,3.466-7.74,7.74s3.466,7.74,7.74,7.74c1.655,0,3.184-0.523,4.442-1.407  l-1.809,14.973l-20.748-2.075l-7.98,23.461l-23.142-7.182l3.511-12.768l-20.907-4.628l3.099-13.846  c3.414,2.673,7.71,4.271,12.383,4.271c11.106,0,20.109-9.003,20.109-20.109c0-11.106-9.003-20.109-20.109-20.109  c-11.106,0-20.109,9.003-20.109,20.109c0,4.656,1.587,8.94,4.244,12.349L88.67,152.884l-9.495-5.427l-9.414,26.97l-22.977-7.187  l6.553-20.757l-22.005-5.604l26.214-99.306l23.541,5.993l-9.321,36.564L52.999,133h13.406l2.394-8h8.618h8.618l2.394,8h13.406  L83.067,84h-5.65h-4.693l6.765-19.741l23.618,7.231l-9.422,28.887l28.237-41.974l3.807,2.713l2.187-9.257l23.845,5.267  l-10.73,50.523l6.637-23.473V133h12V84h-10.886l8.594-28.04l23.62,7.55l-3.83,11.81l7.501,0.798L179.237,121.063z M113.007,114.582  c0-5.112,4.145-9.257,9.257-9.257s9.257,4.144,9.257,9.257s-4.144,9.257-9.257,9.257S113.007,119.694,113.007,114.582z M72.485,116  l5.148-17.177L82.78,116H72.485z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="40px" height="40px">
                                    <path style="fill:#1976D2;" d="M496,112.011H272c-8.832,0-16,7.168-16,16s7.168,16,16,16h177.376l-98.304,76.448l-70.496-44.832  l-17.152,27.008l80,50.88c2.592,1.664,5.6,2.496,8.576,2.496c3.456,0,6.944-1.12,9.824-3.36L480,160.715v207.296H272  c-8.832,0-16,7.168-16,16s7.168,16,16,16h224c8.832,0,16-7.168,16-16v-256C512,119.179,504.832,112.011,496,112.011z"/>
                                    <path style="fill:#2196F3;" d="M282.208,19.691c-3.648-3.04-8.544-4.352-13.152-3.392l-256,48C5.472,65.707,0,72.299,0,80.011v352  c0,7.68,5.472,14.304,13.056,15.712l256,48c0.96,0.192,1.952,0.288,2.944,0.288c3.712,0,7.328-1.28,10.208-3.68  c3.68-3.04,5.792-7.584,5.792-12.32v-448C288,27.243,285.888,22.731,282.208,19.691z"/>
                                    <path style="fill:#FAFAFA;" d="M144,368.011c-44.096,0-80-43.072-80-96s35.904-96,80-96s80,43.072,80,96  S188.096,368.011,144,368.011z M144,208.011c-26.464,0-48,28.704-48,64s21.536,64,48,64s48-28.704,48-64  S170.464,208.011,144,208.011z"/>
                                </svg>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 24 24" id="Layer_1" version="1.1" viewBox="0 0 24 24" xml:space="preserve" width="40px" height="40px"><g><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_1_" x1="0" x2="24" y1="12" y2="12"><stop offset="0" style="stop-color:#95DCF6"/><stop offset="1" style="stop-color:#507EFF"/></linearGradient><path d="M20.4970703,10.6772461C20.4990234,10.6186523,20.5,10.5595703,20.5,10.5   C20.5,6.9160156,17.5839844,4,14,4c-2.3662109,0-4.5400391,1.2973633-5.6796875,3.347168C7.8291016,7.1191406,7.2949219,7,6.75,7   c-1.9355469,0-3.5341797,1.4746094-3.7246094,3.4257812C1.203125,11.2114258,0,13.0097656,0,15c0,2.7568359,2.2431641,5,5,5h14.25   c2.6191406,0,4.75-2.1308594,4.75-4.75C24,13.0883789,22.5517578,11.2319336,20.4970703,10.6772461z" fill="url(#SVGID_1_)"/><radialGradient cx="12.333333" cy="19.75" gradientUnits="userSpaceOnUse" id="SVGID_2_" r="10.1980391"><stop offset="0" style="stop-color:#009ADA"/><stop offset="1" style="stop-color:#1E88E5;stop-opacity:0"/></radialGradient><path d="M20.4970703,10.6772461C20.4990234,10.6186523,20.5,10.5595703,20.5,10.5   C20.5,6.9160156,17.5839844,4,14,4c-2.3662109,0-4.5400391,1.2973633-5.6796875,3.347168C7.8291016,7.1191406,7.2949219,7,6.75,7   c-1.9355469,0-3.5341797,1.4746094-3.7246094,3.4257812C1.203125,11.2114258,0,13.0097656,0,15c0,2.7568359,2.2431641,5,5,5h14.25   c2.6191406,0,4.75-2.1308594,4.75-4.75C24,13.0883789,22.5517578,11.2319336,20.4970703,10.6772461z" fill="url(#SVGID_2_)"/><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_3_" x1="14.9440107" x2="23.5559902" y1="13.2420845" y2="17.2579155"><stop offset="0" style="stop-color:#FFFFFF;stop-opacity:0.06"/><stop offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/></linearGradient><circle cx="19.25" cy="15.25" fill="url(#SVGID_3_)" r="4.75"/><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_4_" x1="8.5935068" x2="1.3435068" y1="12.5630245" y2="17.4796906"><stop offset="0" style="stop-color:#FFFFFF;stop-opacity:0"/><stop offset="1" style="stop-color:#FFFFFF;stop-opacity:0.06"/></linearGradient><circle cx="5" cy="15" fill="url(#SVGID_4_)" r="5"/><circle cx="6.75" cy="10.75" fill="#56C7DA" opacity="0.2" r="3.75"/><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_5_" x1="14" x2="14" y1="4" y2="17"><stop offset="0" style="stop-color:#00ACCD;stop-opacity:0.2"/><stop offset="0.1274437" style="stop-color:#1AB4D2;stop-opacity:0.1745113"/><stop offset="0.4001057" style="stop-color:#5CCADF;stop-opacity:0.1199789"/><stop offset="0.7929201" style="stop-color:#C5ECF4;stop-opacity:0.041416"/><stop offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/></linearGradient><circle cx="14" cy="10.5" fill="url(#SVGID_5_)" r="6.5"/><linearGradient gradientUnits="userSpaceOnUse" id="SVGID_6_" x1="2.4570346" x2="23.0878239" y1="8.6383133" y2="18.2586079"><stop offset="0" style="stop-color:#FFFFFF;stop-opacity:0.1"/><stop offset="1" style="stop-color:#FFFFFF;stop-opacity:0"/></linearGradient><path d="M20.4970703,10.6772461C20.4990234,10.6186523,20.5,10.5595703,20.5,10.5   C20.5,6.9160156,17.5839844,4,14,4c-2.3662109,0-4.5400391,1.2973633-5.6796875,3.347168C7.8291016,7.1191406,7.2949219,7,6.75,7   c-1.9355469,0-3.5341797,1.4746094-3.7246094,3.4257812C1.203125,11.2114258,0,13.0097656,0,15c0,2.7568359,2.2431641,5,5,5h14.25   c2.6191406,0,4.75-2.1308594,4.75-4.75C24,13.0883789,22.5517578,11.2319336,20.4970703,10.6772461z" fill="url(#SVGID_6_)"/></g><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/><g/></svg>
                            </div>
                        </div>
                        <p class="text-center mt-2 font-response-14" style="font-size: 17px;">{!! trans('lets_get_started.business.resume.do_you_use_free_emails_to_receive_candidates') !!}</p>
                        <div class="d-flex justify-content-around flex-column flex-lg-row" data-toggle="buttons">
                            <label class="btn btn-outline-primary option01 btnChoiceLetsGetStartResume" data-text="{!! trans('lets_get_started.business.resume.you_use_free_emails_to_receive_candidates') !!}">
                                <input type="radio" name="item3"  autocomplete="off" checked="" value="3">
                                <span>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none;" class="mr-2 active_icon option01">
                                    {!! trans('lets_get_started.business.buttons.yes') !!}
                                </span>
                            </label>
                            <label class="btn btn-outline-primary option02 btnChoiceLetsGetStartResume">
                                <input type="radio" name="item3"  autocomplete="off" checked="" value="3">
                                <span>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px; display: none;" class="mr-2 active_icon option01">
                                    {!! trans('lets_get_started.business.buttons.no_we_have_a_custom_email_address') !!}
                                </span>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-3">
                <button id="btnNextReceive" role="button" class="btn btn-primary btn-block col-lg-6 col-11 mx-auto">{!! trans('lets_get_started.business.buttons.next') !!}</button>
            </div>
        </div>
    </div>

@endsection



