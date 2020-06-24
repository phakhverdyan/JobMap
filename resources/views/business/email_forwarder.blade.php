@extends('layouts.main_business')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-12 col-xl-8 mx-auto mt-3 ">
                <div class="col-12 rounded bg-white py-3 help-how-to-start-block">
                    <p class="mb-1 text text-center fw-lighter" style="font-size:30px;">
                        {!! trans('guides.email_fr.title') !!}
                        <button type="button" class="close pt-0 mt-0 help-how-to-start-hide help-how-to-start-gotit" style="cursor: pointer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>
                    <div class="d-flex flex-column flex-lg-row justify-content-between mt-5">
                        <div class="text-center col-lg-3 col-12">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 440.125 440.125" style="enable-background:new 0 0 440.125 440.125; fill:#7b7b7b;" xml:space="preserve" width="50" height="50">
                                    <g>
                                        <g>
                                            <path d="M313.938,187.702L212.563,86.327c-3.079-3.958-7.836-6.37-12.85-6.301c-0.746,0.023-1.49,0.099-2.225,0.099H55.963    c-8.836,0-15.999,7.415-16,16.251v328c0.001,8.836,7.164,15.749,16,15.749h248c8.836,0,15.999-6.913,16-15.749v-221.4    C320.92,197.164,318.605,191.296,313.938,187.702L313.938,187.702z M215.963,135.002l49.375,49.124h-49.375L215.963,135.002    L215.963,135.002z M287.963,408.126h-216v-296h112v85.676c-0.843,5.145,0.873,10.379,4.6,14.025    c0.041,0.042,0.083,0.084,0.125,0.125c0.074,0.067,0.149,0.008,0.225,0.074c3.639,3.482,8.706,5.099,13.675,4.099h85.375V408.126z    "/>
                                            <path d="M393.932,107.689L292.557,6.314c-3.02-3.891-7.919-6.376-12.844-6.313c-0.744,0.032-1.486,0.124-2.219,0.124H135.963    c-4.189,0-8.351,1.851-11.313,4.812c-2.962,2.962-4.686,7.25-4.687,11.439v43.749h32v-28h112V97.72l38.656,38.405h65.344v192h-28    v32h44c4.189,0,8.351-1.599,11.313-4.561c2.962-2.962,4.686-6.999,4.687-11.188V122.971    C400.897,117.296,398.49,111.196,393.932,107.689z M295.963,104.126V55.002l49.375,49.124H295.963z"/>
                                        </g>
                                    </g>
                                </svg>
                            </p>
                            <p><strong>{!! trans('guides.email_fr.link_1') !!}</strong></p>
                        </div>
                        <div class="text-center col-lg-3 col-12">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#7b7b7b;" xml:space="preserve" width="50" height="50">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M503.917,298.99l-20.438-5.115l10.833-18.063c2.521-4.198,1.854-9.573-1.604-13.031l-30.167-30.167     c-3.479-3.5-8.854-4.115-13.042-1.604l-18.042,10.833l-5.104-20.438c-1.188-4.74-5.458-8.073-10.354-8.073h-10.667V106.667     c0-23.531-19.146-42.667-42.667-42.667h-320C19.146,64,0,83.135,0,106.667V320c0,23.531,19.146,42.667,42.667,42.667h244.04     l19.147,4.792l-10.833,18.063c-2.521,4.198-1.854,9.573,1.604,13.031l30.167,30.167c3.479,3.479,8.854,4.094,13.042,1.604     l18.042-10.833l5.104,20.438c1.188,4.74,5.458,8.073,10.354,8.073H416c4.896,0,9.167-3.333,10.354-8.073l5.104-20.438     l18.042,10.833c4.188,2.49,9.563,1.875,13.042-1.604l30.167-30.167c3.458-3.458,4.125-8.833,1.604-13.031l-10.833-18.063     l20.438-5.115c4.75-1.188,8.083-5.448,8.083-10.344v-42.667C512,304.438,508.667,300.177,503.917,298.99z M42.667,85.333h320     c0.443,0,0.814,0.225,1.25,0.253L211.688,210.604c-5.583,3.625-13.417,2.938-17.083,0.688L41.424,85.585     C41.858,85.559,42.227,85.333,42.667,85.333z M285.417,298.99c-4.75,1.188-8.083,5.448-8.083,10.344v32H42.667     c-11.771,0-21.333-9.573-21.333-21.333V106.667c0-3.021,0.668-5.875,1.805-8.482l158.883,130.294     c6.208,4.052,13.354,6.188,20.646,6.188c7.25,0,14.396-2.125,21.646-6.885L382.194,98.184c1.138,2.608,1.806,5.461,1.806,8.483     v106.667h-10.667c-4.896,0-9.167,3.333-10.354,8.073l-5.104,20.438l-18.042-10.833c-4.188-2.51-9.563-1.854-13.042,1.604     l-30.167,30.167c-3.458,3.458-4.125,8.833-1.604,13.031l10.833,18.063L285.417,298.99z M490.667,343.677l-18.313,4.583     c-3.479,0.865-6.292,3.417-7.479,6.792c-0.958,2.74-2,5.417-3.271,8.01c-1.563,3.25-1.396,7.063,0.458,10.156l9.667,16.135     l-18.375,18.385l-16.125-9.677c-3.104-1.844-6.917-2.021-10.167-0.448c-2.583,1.26-5.25,2.302-7.979,3.25     c-3.396,1.188-5.958,4-6.833,7.479l-4.583,18.323h-26l-4.583-18.323c-0.875-3.479-3.438-6.292-6.833-7.479     c-2.729-0.948-5.396-1.99-7.979-3.25c-3.25-1.583-7.083-1.417-10.167,0.448l-16.125,9.677l-18.375-18.385l9.667-16.135     c1.854-3.094,2.021-6.906,0.458-10.156c-1.271-2.594-2.313-5.271-3.271-8.01c-1.188-3.375-4-5.927-7.479-6.792l-18.313-4.583     v-26.021l18.313-4.583c3.479-0.865,6.292-3.417,7.479-6.792c0.958-2.74,2-5.417,3.271-8.01c1.563-3.25,1.396-7.063-0.458-10.156     l-9.667-16.135l18.375-18.385l16.125,9.677c3.104,1.844,6.938,2.031,10.167,0.448c2.583-1.26,5.25-2.302,7.979-3.25     c3.396-1.188,5.958-4,6.833-7.479l4.583-18.323h26l4.583,18.323c0.875,3.479,3.438,6.292,6.833,7.479     c2.729,0.948,5.396,1.99,7.979,3.25c3.229,1.563,7.063,1.396,10.167-0.448l16.125-9.677l18.375,18.385l-9.667,16.135     c-1.854,3.094-2.021,6.906-0.458,10.156c1.271,2.594,2.313,5.271,3.271,8.01c1.188,3.375,4,5.927,7.479,6.792l18.313,4.583     V343.677z"/>
                                                <path d="M394.667,277.333c-29.417,0-53.333,23.927-53.333,53.333S365.25,384,394.667,384S448,360.073,448,330.667     S424.083,277.333,394.667,277.333z M394.667,362.667c-17.646,0-32-14.354-32-32c0-17.646,14.354-32,32-32s32,14.354,32,32     C426.667,348.313,412.313,362.667,394.667,362.667z"/>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </p>
                            <p><strong>{!! trans('guides.email_fr.link_2') !!}</strong></p>
                        </div>
                        <div class="text-center col-lg-3 col-12">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002; fill:#7b7b7b;" xml:space="preserve" width="50px" height="50px">
                                    <g>
                                        <g>
                                            <g>
                                                <path d="M394.667,42.667h-128c-11.782,0-21.333,9.551-21.333,21.333v128c0,11.782,9.551,21.333,21.333,21.333h128     c11.782,0,21.333-9.551,21.333-21.333V64C416,52.218,406.449,42.667,394.667,42.667z M290.347,192     c7.707-22.268,32.007-34.072,54.275-26.365c12.366,4.28,22.085,13.999,26.365,26.365H290.347z M309.333,117.333     c0-11.782,9.551-21.333,21.333-21.333C342.449,96,352,105.551,352,117.333c0,11.782-9.551,21.333-21.333,21.333     C318.885,138.667,309.333,129.116,309.333,117.333z M394.667,192h-1.387c-4.028-18.843-16.331-34.868-33.493-43.627     c17.25-16.053,18.221-43.051,2.167-60.301c-16.053-17.25-43.051-18.221-60.301-2.167c-17.25,16.053-18.221,43.051-2.167,60.301     c0.696,0.748,1.419,1.471,2.167,2.167c-17.203,8.734-29.548,24.763-33.6,43.627h-1.387V64h128V192z"></path>
                                                <path d="M432.429,0.002C432.357,0.001,432.285,0,432.214,0h-282.88c-2.835-0.016-5.56,1.097-7.573,3.093L56.427,88.427     c-1.997,2.013-3.11,4.738-3.093,7.573v389.547c0.058,14.586,11.868,26.395,26.453,26.453h352     c14.668,0.177,26.701-11.57,26.878-26.238c0.001-0.072,0.001-0.144,0.002-0.215V26.88     C458.844,12.213,447.097,0.179,432.429,0.002z M437.334,485.547c0,2.828-2.292,5.12-5.12,5.12h-352     c-2.818,0.236-5.293-1.858-5.529-4.675c-0.012-0.148-0.018-0.296-0.018-0.445V100.374l64-64v44.16     c-0.057,2.627-2.173,4.743-4.8,4.8h-27.2v21.333h32c12.352-2.351,21.299-13.133,21.333-25.707V21.333h272.213     c2.828,0,5.12,2.292,5.12,5.12V485.547z"></path>
                                                <rect x="192" y="256" width="170.667" height="21.333"></rect>
                                                <rect x="149.333" y="309.333" width="213.333" height="21.333"></rect>
                                                <rect x="149.333" y="362.667" width="213.333" height="21.333"></rect>
                                                <rect x="149.333" y="416" width="170.667" height="21.333"></rect>
                                                <rect x="341.334" y="416" width="21.333" height="21.333"></rect>
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </p>
                            <p><strong>{!! trans('guides.email_fr.link_3') !!}</strong></p>
                        </div>
                        <div class="text-center col-lg-3 col-12">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#7b7b7b;" xml:space="preserve" width="50px" height="50px"><g><g>
                                    <g>
                                        <path d="M451.72,237.26c-17.422-8.71-50.087-8.811-51.469-8.811c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5    c8.429,0.001,32.902,1.299,44.761,7.228c1.077,0.539,2.221,0.793,3.348,0.793c2.751,0,5.4-1.52,6.714-4.147    C456.927,243.618,455.425,239.113,451.72,237.26z"></path>
                                    </g>
                                </g><g>
                                    <g>
                                        <path d="M489.112,344.041l-30.975-8.85c-1.337-0.382-2.271-1.62-2.271-3.011v-10.339c2.52-1.746,4.924-3.7,7.171-5.881    c10.89-10.568,16.887-24.743,16.887-39.915v-14.267l2.995-5.989c3.287-6.575,5.024-13.936,5.024-21.286v-38.65    c0-4.142-3.358-7.5-7.5-7.5H408.27c-26.244,0-47.596,21.352-47.596,47.596v0.447c0,6.112,1.445,12.233,4.178,17.699l3.841,7.682    v12.25c0,19.414,9.567,36.833,24.058,47.315l0.002,10.836c0,1.671,0,2.363-6.193,4.133l-15.114,4.318l-43.721-15.898    c0.157-2.063-0.539-4.161-2.044-5.742l-13.971-14.678v-24.64c1.477-1.217,2.933-2.467,4.344-3.789    c17.625-16.52,27.733-39.844,27.733-63.991v-19.678c5.322-11.581,8.019-23.836,8.019-36.457v-80.19c0-4.142-3.358-7.5-7.5-7.5    H232.037c-39.51,0-71.653,32.144-71.653,71.653v16.039c0,12.621,2.697,24.876,8.019,36.457v16.931    c0,28.036,12.466,53.294,32.077,69.946v25.22l-13.971,14.678c-1.505,1.581-2.201,3.679-2.044,5.742l-46.145,16.779    c-3.344,1.216-6.451,2.863-9.272,4.858l-7.246-3.623c21.57-9.389,28.403-22.594,28.731-23.25c1.056-2.111,1.056-4.597,0-6.708    c-5.407-10.814-6.062-30.635-6.588-46.561c-0.175-5.302-0.341-10.311-0.658-14.771c-2.557-35.974-29.905-63.103-63.615-63.103    s-61.059,27.128-63.615,63.103c-0.317,4.461-0.483,9.47-0.658,14.773c-0.526,15.925-1.182,35.744-6.588,46.558    c-1.056,2.111-1.056,4.597,0,6.708c0.328,0.656,7.147,13.834,28.76,23.234l-20.127,10.063C6.684,358.176,0,368.991,0,381.02    v55.409c0,4.142,3.358,7.5,7.5,7.5s7.5-3.358,7.5-7.5V381.02c0-6.312,3.507-11.987,9.152-14.81l25.063-12.531l8.718,8.285    c6.096,5.793,13.916,8.688,21.739,8.688c7.821,0,15.645-2.897,21.739-8.688l8.717-8.284l8.172,4.086    c-3.848,6.157-6.032,13.377-6.032,20.94v57.725c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-57.725    c0-10.296,6.501-19.578,16.178-23.097l48.652-17.691l20.253,30.381c2.589,3.884,6.738,6.375,11.383,6.835    c0.518,0.051,1.033,0.076,1.547,0.076c4.098,0,8.023-1.613,10.957-4.546l12.356-12.356v78.124c0,4.142,3.358,7.5,7.5,7.5    c4.142,0,7.5-3.358,7.5-7.5v-78.124l12.356,12.356c2.933,2.934,6.858,4.547,10.957,4.547c0.513,0,1.029-0.025,1.546-0.076    c4.646-0.46,8.795-2.951,11.384-6.835l20.254-30.38l48.651,17.691c9.676,3.519,16.178,12.801,16.178,23.097v57.725    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-57.725c0-10.428-4.143-20.208-11.093-27.441l1.853-0.529    c1.869-0.534,4.419-1.265,6.979-2.52l19.149,19.149v69.066c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-69.066    l19.016-19.016c1.011,0.514,2.073,0.948,3.191,1.267l30.976,8.85c7.07,2.02,12.009,8.567,12.009,15.921v62.044    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-62.044C512,360.371,502.588,347.892,489.112,344.041z M48.115,330.794    c-14.029-5.048-21.066-11.778-24.07-15.453c2.048-5.354,3.376-11.486,4.275-17.959c4.136,9.917,11.063,18.383,19.795,24.423    V330.794z M91.08,351.092c-6.397,6.078-16.418,6.077-22.813-0.001l-6.975-6.628c1.177-2.205,1.824-4.705,1.824-7.324v-7.994    c5.232,1.635,10.794,2.517,16.558,2.517c5.757,0,11.316-0.886,16.557-2.512l-0.001,7.988c0,2.62,0.646,5.121,1.824,7.327    L91.08,351.092z M79.676,316.662c-22.396,0-40.615-18.22-40.615-40.615c0-4.142-3.358-7.5-7.5-7.5c-0.42,0-0.83,0.043-1.231,0.11    c0.022-0.645,0.043-1.291,0.065-1.93c0.167-5.157,0.328-10.028,0.625-14.206c0.958-13.476,6.343-25.894,15.163-34.968    c8.899-9.156,20.793-14.198,33.491-14.198s24.591,5.042,33.491,14.198c8.82,9.074,14.205,21.492,15.163,34.968    c0.296,4.177,0.458,9.047,0.628,14.203c0.015,0.443,0.03,0.892,0.045,1.338c-8.16-12.572-20.762-21.837-37.045-27.069    c-15.043-4.833-27.981-4.534-28.527-4.52c-1.964,0.055-3.828,0.877-5.191,2.291l-13.532,14.034    c-2.875,2.982-2.789,7.73,0.193,10.605s7.73,2.788,10.605-0.193l11.26-11.677c9.697,0.474,40.894,4.102,53.027,30.819    C116.738,302.04,99.816,316.662,79.676,316.662z M111.229,330.819l0.001-8.945c8.725-6.007,15.662-14.457,19.801-24.449    c0.899,6.458,2.226,12.576,4.27,17.918C132.314,318.983,125.244,325.773,111.229,330.819z M183.403,209.145v-18.608    c0-1.129-0.255-2.244-0.746-3.261c-4.826-9.994-7.273-20.598-7.273-31.518V139.72c0-31.239,25.415-56.653,56.653-56.653h104.769    v72.692c0,10.92-2.447,21.524-7.273,31.518c-0.491,1.017-0.746,2.132-0.746,3.261v21.355c0,20.311-8.165,39.15-22.991,53.047    c-1.851,1.734-3.772,3.36-5.758,4.875c-0.044,0.03-0.086,0.063-0.129,0.094c-13.889,10.545-30.901,15.67-48.667,14.519    C213.201,281.965,183.403,248.897,183.403,209.145z M225.632,360.056c-0.052,0.052-0.173,0.175-0.418,0.149    c-0.244-0.024-0.34-0.167-0.381-0.229l-23.325-34.988l7.506-7.887l35.385,24.187L225.632,360.056z M256.095,331.113    l-40.615-27.762v-14c10.509,5.681,22.276,9.234,34.791,10.044c1.977,0.128,3.942,0.191,5.901,0.191    c14.341,0,28.143-3.428,40.538-9.935v13.7L256.095,331.113z M287.357,359.978c-0.041,0.062-0.137,0.205-0.381,0.229    c-0.245,0.031-0.365-0.098-0.418-0.149l-18.767-18.767l35.385-24.188l7.507,7.887L287.357,359.978z M424.308,353.65l-17.02-17.019    c0.297-1.349,0.465-2.826,0.464-4.455l-0.001-3.165c4.723,1.55,9.701,2.47,14.852,2.624c0.578,0.018,1.151,0.026,1.727,0.026    c5.692,0,11.248-0.86,16.536-2.501v3.02c0,1.496,0.188,2.962,0.542,4.371L424.308,353.65z M452.591,305.196    c-7.949,7.714-18.45,11.788-29.537,11.446c-21.704-0.651-39.361-19.768-39.361-42.613v-14.021c0-1.165-0.271-2.313-0.792-3.354    l-4.633-9.266c-1.697-3.395-2.594-7.195-2.594-10.991v-0.447c0-17.974,14.623-32.596,32.596-32.596h64.673v31.15    c0,5.034-1.19,10.075-3.441,14.578l-3.786,7.572c-0.521,1.042-0.792,2.189-0.792,3.354v16.038    C464.924,287.126,460.544,297.478,452.591,305.196z"></path>
                                    </g>
                                </g><g>
                                    <g>
                                        <path d="M472.423,380.814c-4.142,0-7.5,3.358-7.5,7.5v48.115c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-48.115    C479.923,384.173,476.565,380.814,472.423,380.814z"></path>
                                    </g>
                                </g><g>
                                    <g>
                                        <path d="M39.577,390.728c-4.142,0-7.5,3.358-7.5,7.5v38.201c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-38.201    C47.077,394.087,43.719,390.728,39.577,390.728z"></path>
                                    </g>
                                </g><g>
                                    <g>
                                        <path d="M317.532,158.475c-28.366-28.366-87.715-22.943-111.917-19.295c-7.623,1.149-13.155,7.6-13.155,15.339v17.278    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-17.279c0-0.255,0.168-0.473,0.392-0.507    c9.667-1.457,28.85-3.705,48.725-2.38c23.388,1.557,40.328,7.428,50.349,17.45c2.929,2.929,7.678,2.929,10.606,0    C320.461,166.152,320.461,161.403,317.532,158.475z"></path>
                                    </g>
                                </g><g>
                                    <g>
                                        <path d="M167.884,396.853c-4.142,0-7.5,3.358-7.5,7.5v32.077c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-32.077    C175.384,400.212,172.026,396.853,167.884,396.853z"></path>
                                    </g>
                                </g><g>
                                    <g>
                                        <path d="M344.306,396.853c-4.142,0-7.5,3.358-7.5,7.5v32.077c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-32.077    C351.806,400.212,348.448,396.853,344.306,396.853z"></path>
                                    </g>
                                </g></g> </svg>
                            </p>
                            <p><strong>{!! trans('guides.email_fr.link_4') !!}</strong></p>
                        </div>
                    </div>


                    <p class="mt-5"><strong>{!! trans('guides.email_fr.text_box_1.title') !!}</strong></p>
                    <ul style="list-style: none;" class="pxa-0">
                        <li>{!! trans('guides.email_fr.text_box_1.text') !!}</li>
                    </ul>

                    <div class="d-flex flex-column-reverse">
                        <div class="col-12 pxa-0 pl-0">
                            <p class="mt-3"><strong>{!! trans('guides.email_fr.text_box_2.title') !!}</strong></p>
                            <ul style="list-style: none;" class="pxa-0">
                                {!! trans('guides.email_fr.text_box_2.text', [
                                'image' => asset('img//sidebar/active.png')
                            ]) !!}
                            </ul>
                        </div>
                        <div class="col-12 pxa-0 mt-5">
                            <div class="border rounded p-3">
                                <p class="text-center mb-0">
                                    {!! trans('guides.email_fr.hint') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <p class="mb-0 text-center">
                        <button type="button" class="btn btn-success help-how-to-start-hide help-how-to-start-gotit">
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
                <p class="text-right mb-1 mt-5" style="opacity: 0.4;">
                  <button type="button" class="pt-0 mt-0 border-0 help-how-to-start-show" style="background-color: inherit; font-size: 13px; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px;"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                      {!! trans('main.help') !!}
                  </button>
                </p>
                <div class="col-12 rounded bg-white mb-3 py-3">
                    <div class="d-flex justify-content-around flex-lg-row flex-column">
                        <div class="mx-auto text-center">
                            <p><strong>{!! trans('pages.text.email_fr') !!}</strong></p>
                            <div class="btn-group col-12 mx-auto mb-3">
                                <input id="emailForwarder-copy" type="text" name="" class="form-control border-top-right-0 border-bottom-right-0 email-forwarder-business" value="" readonly>
                                <button type="button" class="btn btn-primary" data-clipboard-action="copy" data-clipboard-target="#emailForwarder-copy" id="clipboard-button">{!! trans('main.buttons.copy') !!}</button>
                            </div>

                        </div>
                    </div> 
                </div>
                
                
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="{{ asset('/js/app/share-button.js?v='.time()) }}"></script>
    <script src="http://code.interactjs.io/v1.3.3/interact.min.js"></script>
    <script>
        var clipboard = new Clipboard('#clipboard-button');
        clipboard.on('success', function (e) {
            $.notify('Copied!', 'success');
            e.clearSelection();
        });
    </script>
@stop