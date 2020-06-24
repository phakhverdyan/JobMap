<!DOCTYPE html>
<html lang="eng">

<head>

    <meta charset="utf-8">

    <title>Title</title>
    <meta name="description" content="">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <meta property="og:image" content="path/to/image.jpg">
    <link rel="shortcut icon" href="/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-touch-icon-114x114.png">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#000">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#000">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <link rel="stylesheet" href="{{ asset('/css/main.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ asset('/css/back.css?v='.time()) }}">
    @yield('style')
</head>
<body>
    <style type="text/css">
        .connect{
            position: relative;
        }
        .connect::before{
            content: "";
            height: 1px;
            position: absolute;
            top:50%;
            width: 20px;
            left: -21px;
            background: #4E5C6E;
            opacity: 0.7;
        }
    </style>
    <div class="container width-100-lg" style="margin-top: 60px;">
        <div class="col-12">
            <p class="text-center mb-0 pb-3"><img src="{{ asset('img/landing/cr-logo.png') }}" width="70px" class="wow animated fadeInDown"></p>
            <p class="text-center mb-5" style="font-size: 35px;font-weight: lighter;">How do you currently receive candidates</p>
            <div class="d-flex justify-content-center flex-column-reverse flex-lg-row">
                <div class="border rounded bg-white p-3 mr-3 width-100-lg mb-3">
                    <p><strong>We will guide you with</strong></p>
                    <p><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px;" class="mr-2">1</p>
                    <p><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px;" class="mr-2">2</p>
                    <p><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px;" class="mr-2">3</p>
                    <p class="mb-0"><img src="{{ asset('img//sidebar/active.png') }}" class="mr-2">4</p>
                </div>
                <div class="width-100-lg col-lg-8 col-12 pxa-0 mb-3">
                    <div style="position: relative;">
                        <div class="business_stick" style="position: absolute; width: 1px; height: 420px; background-color: #4E5C6E; opacity: 0.7; left:27px; top:30px; z-index: 1;"></div>
                        <div class="text-center ml-5 mxa-0" data-toggle="buttons">
                            <label class="btn btn-outline-primary connect col-12" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#7b7b7b;" xml:space="preserve" width="40px" height="40px">
                                            <g>
                                                <g>
                                                    <path d="M504.5,248.5h-49.325l-1.707-17.064h18.967c12.976,0,23.532-10.557,23.532-23.532v-64.129    c0-12.976-10.557-23.533-23.532-23.533h-96.194c-12.976,0-23.532,10.557-23.532,23.533v64.129    c0,12.976,10.557,23.532,23.532,23.532h18.968l-1.707,17.064h-65.874v-38.705c0-8.972-4.985-17.037-13.008-21.047l-34.803-17.402    c-0.176-0.088-0.285-0.265-0.285-0.462v-11.359c9.72-7.216,16.032-18.775,16.032-31.783v-16.033    c0-21.816-17.749-39.564-39.564-39.564c-21.702,0-39.372,17.565-39.556,39.224c-0.001,0.027-0.001,0.055-0.002,0.082    c-0.001,0.086-0.007,0.171-0.007,0.258v16.033c0,13.008,6.312,24.567,16.032,31.783v11.359c0,0.197-0.109,0.374-0.285,0.462    l-34.803,17.401c-8.024,4.011-13.009,12.076-13.009,21.048V248.5h-17.064v-24.564c0-4.142-3.358-7.5-7.5-7.5h-8.532v-24.564    c0-4.142-3.358-7.5-7.5-7.5H79.645c-4.142,0-7.5,3.358-7.5,7.5V248.5H47.064V134.383c0-8.367,6.807-15.173,15.173-15.173    c4.052,0,7.863,1.579,10.729,4.444l5.133,5.133c-7.361,12.135-5.812,28.197,4.661,38.671l5.668,5.668    c1.406,1.407,3.314,2.197,5.303,2.197s3.897-0.79,5.303-2.197l34.009-34.01c2.929-2.929,2.929-7.677,0-10.606l-5.668-5.668    c-10.474-10.473-26.536-12.022-38.67-4.661l-5.133-5.134c-5.7-5.699-13.277-8.837-21.336-8.837    c-16.637,0-30.173,13.536-30.173,30.173V248.5H7.5c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h8.532v168.855    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-24.564h393.309c4.142,0,7.5-3.358,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5    H31.032V263.5h449.936v129.291h-24.566c-4.142,0-7.5,3.358-7.5,7.5c0,4.142,3.358,7.5,7.5,7.5h24.566v24.564    c0,4.142,3.358,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5V263.5h8.532c4.142,0,7.5-3.358,7.5-7.5    C512,251.858,508.642,248.5,504.5,248.5z M93.367,133.448c3.227-3.226,7.464-4.839,11.702-4.839c4.237,0,8.476,1.613,11.701,4.839    l0.365,0.365l-23.403,23.403l-0.365-0.365C86.915,150.399,86.915,139.9,93.367,133.448z M87.145,199.371h49.129v17.064H87.145    V199.371z M152.307,248.5H87.145v-17.064h65.162V248.5z M256,87.145c13.545,0,24.564,11.02,24.564,24.564v0.366    c-19.865-0.75-38.871-4.217-48.42-6.215C234.776,95.131,244.471,87.145,256,87.145z M231.437,127.743v-6.698    c10.725,2.171,29.381,5.356,49.128,6.043v0.655c0,13.545-11.02,24.564-24.564,24.564S231.437,141.287,231.437,127.743z     M248.5,248.5h-17.064v-16.548c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5V248.5h-17.064v-38.705h-0.001    c0-3.253,1.807-6.177,4.716-7.631l23.711-11.856L248.5,211.01V248.5z M241.68,182.977c3.63-2.904,5.787-7.302,5.787-12.093v-4.514    c2.751,0.607,5.603,0.937,8.533,0.937s5.782-0.33,8.532-0.937v4.514c0,4.791,2.157,9.189,5.787,12.093L256,197.297L241.68,182.977    z M312.629,248.5h-17.064v-16.548c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5V248.5H263.5v-37.49l20.701-20.701    l23.712,11.856c2.909,1.454,4.716,4.377,4.716,7.63V248.5z M408.579,248.5l6.468-64.696c0.026-0.265,0.247-0.465,0.514-0.465    h17.556c0.266,0,0.487,0.2,0.513,0.464l6.47,64.697H408.579z M448.556,182.311c-0.796-7.965-7.434-13.972-15.439-13.972h-17.556    c-8.004,0-14.642,6.006-15.439,13.972l-3.412,34.125h-20.468c-4.705,0-8.532-3.828-8.532-8.532v-64.129    c0-4.705,3.828-8.533,8.532-8.533h96.194c4.705,0,8.532,3.828,8.532,8.533v64.129c0,4.705-3.828,8.532-8.532,8.532h-20.467    L448.556,182.311z"></path>
                                                </g>
                                            </g>
                                            </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="display: none;" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We get candidates from <strong>Hiring Agencies</strong>/Staffing Firms</p>
                                </span>
                            </label>

                            <label class="btn btn-outline-primary connect col-12 align-self-center active" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 290.626 290.626" style="enable-background:new 0 0 512 512; vertical-align: middle;fill:#7b7b7b;" xml:space="preserve" width="40px" height="40px">
                                            <g>
                                                <g>
                                                    <g>
                                                        <path d="M281.251,267.188V112.5h9.374V89.063H243.75V75h9.375V51.563h-32.813V37.5h9.375V14.063H60.938V37.5h9.375v14.063H37.5     V75h9.375v14.063H0V112.5h9.375v154.688H0v9.375h70.313h150h70.313v-9.375H281.251z M46.875,267.188H18.75V112.5h28.125V267.188z      M46.875,103.126h-37.5v-4.688h37.5V103.126z M70.313,267.188H56.25V112.5V89.063V75h14.063V267.188z M70.313,65.626H46.875     v-4.688h23.438V65.626z M70.313,23.438h150v4.688h-150V23.438z M140.626,267.188h-0.001H98.438v-56.25h42.188V267.188z      M192.188,267.188H150v-56.25h42.188V267.188z M210.938,267.188h-9.375v-65.625h-112.5v65.625h-9.375v-75h131.25V267.188z      M210.938,51.563V75v107.813H79.688V75V51.563V37.5h131.25V51.563z M220.312,65.626v-4.688h23.438v4.688H220.312z      M234.376,89.063V112.5v154.688h-14.063V75h14.063V89.063z M271.875,267.188H243.75V112.5h28.125V267.188z M281.25,103.126h-37.5     v-4.688h37.5V103.126z"></path>
                                                        <path d="M201.563,65.625h-112.5v65.625h112.5V65.625z M192.188,121.875h-93.75V75h93.75V121.875z"></path>
                                                        <rect x="107.813" y="84.375" width="75" height="9.375"></rect>
                                                        <rect x="173.438" y="103.125" width="9.375" height="9.375"></rect>
                                                        <rect x="107.813" y="103.125" width="56.25" height="9.375"></rect>
                                                        <rect x="126.563" y="225" width="9.375" height="23.438"></rect>
                                                        <rect x="154.688" y="225" width="9.375" height="23.438"></rect>
                                                    </g>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We receive <strong>in-store</strong> resumes</p>
                                </span>
                            </label>
                            <label class="btn btn-outline-primary connect col-12 active" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 55 55" style="enable-background:new 0 0 55 55; fill:#7b7b7b; vertical-align: middle;" width="40px" height="40px" xml:space="preserve">
                                            <path d="M49,0c-3.309,0-6,2.691-6,6c0,1.035,0.263,2.009,0.726,2.86l-9.829,9.829C32.542,17.634,30.846,17,29,17  s-3.542,0.634-4.898,1.688l-7.669-7.669C16.785,10.424,17,9.74,17,9c0-2.206-1.794-4-4-4S9,6.794,9,9s1.794,4,4,4  c0.74,0,1.424-0.215,2.019-0.567l7.669,7.669C21.634,21.458,21,23.154,21,25s0.634,3.542,1.688,4.897L10.024,42.562  C8.958,41.595,7.549,41,6,41c-3.309,0-6,2.691-6,6s2.691,6,6,6s6-2.691,6-6c0-1.035-0.263-2.009-0.726-2.86l12.829-12.829  c1.106,0.86,2.44,1.436,3.898,1.619v10.16c-2.833,0.478-5,2.942-5,5.91c0,3.309,2.691,6,6,6s6-2.691,6-6c0-2.967-2.167-5.431-5-5.91  v-10.16c1.458-0.183,2.792-0.759,3.898-1.619l7.669,7.669C41.215,39.576,41,40.26,41,41c0,2.206,1.794,4,4,4s4-1.794,4-4  s-1.794-4-4-4c-0.74,0-1.424,0.215-2.019,0.567l-7.669-7.669C36.366,28.542,37,26.846,37,25s-0.634-3.542-1.688-4.897l9.665-9.665  C46.042,11.405,47.451,12,49,12c3.309,0,6-2.691,6-6S52.309,0,49,0z M11,9c0-1.103,0.897-2,2-2s2,0.897,2,2s-0.897,2-2,2  S11,10.103,11,9z M6,51c-2.206,0-4-1.794-4-4s1.794-4,4-4s4,1.794,4,4S8.206,51,6,51z M33,49c0,2.206-1.794,4-4,4s-4-1.794-4-4  s1.794-4,4-4S33,46.794,33,49z M29,31c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S32.309,31,29,31z M47,41c0,1.103-0.897,2-2,2  s-2-0.897-2-2s0.897-2,2-2S47,39.897,47,41z M49,10c-2.206,0-4-1.794-4-4s1.794-4,4-4s4,1.794,4,4S51.206,10,49,10z"/>
                                        </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We posting on <strong>social networks</strong>/social media</p>
                                </span>
                            </label>

                            <label class="btn btn-outline-primary connect col-12" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="40px" height="40px">
                                        <g>
                                            <g>
                                                <path d="M502.154,59.077H9.846C4.408,59.077,0,63.486,0,68.923V128v315.077c0,5.437,4.408,9.846,9.846,9.846h492.308    c5.438,0,9.846-4.409,9.846-9.846V128V68.923C512,63.486,507.592,59.077,502.154,59.077z M492.308,433.231H19.692V137.846h472.615    V433.231z M492.308,88.615h-59.077c-5.438,0-9.846,4.409-9.846,9.846c0,5.437,4.408,9.846,9.846,9.846h59.077v9.846H19.692V78.769    h472.615V88.615z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M462.769,157.538H49.231c-5.438,0-9.846,4.409-9.846,9.846v98.461c0,5.437,4.408,9.846,9.846,9.846h413.538    c5.438,0,9.846-4.409,9.846-9.846v-98.461C472.615,161.948,468.207,157.538,462.769,157.538z M452.923,256H59.077v-19.692h39.385    c5.438,0,9.846-4.409,9.846-9.846c0-5.437-4.408-9.846-9.846-9.846H59.077v-39.385h393.846V256z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M413.342,96.541c-0.128-0.629-0.315-1.25-0.561-1.851c-0.246-0.592-0.551-1.162-0.906-1.693    c-0.354-0.543-0.768-1.045-1.221-1.498c-0.453-0.453-0.955-0.866-1.497-1.221c-0.532-0.353-1.103-0.66-1.703-0.906    c-0.591-0.246-1.211-0.443-1.841-0.571c-1.27-0.246-2.57-0.246-3.84,0c-0.63,0.128-1.25,0.325-1.841,0.571    c-0.601,0.246-1.172,0.542-1.703,0.906c-0.542,0.354-1.044,0.768-1.497,1.221c-0.453,0.453-0.866,0.955-1.221,1.498    c-0.354,0.532-0.66,1.102-0.906,1.693c-0.246,0.601-0.443,1.221-0.561,1.851c-0.128,0.63-0.197,1.28-0.197,1.92    c0,0.639,0.069,1.29,0.197,1.92c0.118,0.63,0.315,1.25,0.561,1.84c0.246,0.601,0.551,1.172,0.906,1.703    c0.354,0.542,0.768,1.044,1.221,1.497c0.453,0.454,0.955,0.867,1.497,1.221c0.532,0.364,1.103,0.66,1.703,0.906    c0.591,0.246,1.211,0.443,1.841,0.561c0.63,0.128,1.28,0.197,1.92,0.197s1.29-0.069,1.92-0.197c0.63-0.118,1.25-0.315,1.841-0.561    c0.601-0.246,1.172-0.542,1.703-0.906c0.542-0.353,1.044-0.767,1.497-1.221c0.453-0.453,0.866-0.955,1.221-1.497    c0.354-0.532,0.66-1.103,0.906-1.703c0.246-0.591,0.433-1.21,0.561-1.84c0.128-0.631,0.197-1.281,0.197-1.92    C413.539,97.822,413.47,97.171,413.342,96.541z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M236.308,295.385H49.231c-5.438,0-9.846,4.409-9.846,9.846v98.462c0,5.437,4.408,9.846,9.846,9.846h187.077    c5.438,0,9.846-4.409,9.846-9.846v-98.462C246.154,299.794,241.746,295.385,236.308,295.385z M226.462,393.846H59.077v-78.769    h167.385V393.846z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M462.769,295.385H275.692c-5.438,0-9.846,4.409-9.846,9.846v98.462c0,5.437,4.408,9.846,9.846,9.846h187.077    c5.438,0,9.846-4.409,9.846-9.846v-98.462C472.615,299.794,468.207,295.385,462.769,295.385z M452.923,393.846H285.538v-78.769    h167.385V393.846z"></path>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M137.649,224.543c-0.118-0.63-0.315-1.25-0.561-1.841c-0.246-0.601-0.551-1.171-0.906-1.702    c-0.354-0.543-0.768-1.045-1.221-1.498c-0.453-0.453-0.955-0.866-1.497-1.221c-0.532-0.353-1.103-0.66-1.703-0.906    c-0.591-0.246-1.211-0.443-1.841-0.56c-1.27-0.257-2.58-0.257-3.84,0c-0.63,0.117-1.25,0.314-1.851,0.56    c-0.591,0.246-1.162,0.552-1.694,0.906c-0.542,0.354-1.044,0.768-1.497,1.221c-0.453,0.453-0.866,0.955-1.221,1.498    c-0.354,0.532-0.66,1.102-0.906,1.702c-0.246,0.592-0.443,1.211-0.561,1.841c-0.128,0.63-0.197,1.28-0.197,1.92    c0,2.59,1.054,5.13,2.885,6.96c0.453,0.453,0.955,0.866,1.497,1.221c0.532,0.354,1.103,0.66,1.694,0.906    c0.601,0.246,1.221,0.443,1.851,0.561c0.63,0.128,1.28,0.197,1.92,0.197s1.29-0.069,1.92-0.197c0.63-0.118,1.25-0.315,1.841-0.561    c0.601-0.246,1.172-0.551,1.703-0.906c0.542-0.353,1.044-0.767,1.497-1.221c0.453-0.453,0.866-0.955,1.221-1.497    c0.354-0.532,0.66-1.103,0.906-1.703c0.246-0.591,0.443-1.21,0.561-1.84c0.128-0.631,0.197-1.281,0.197-1.92    C137.846,225.822,137.777,225.172,137.649,224.543z"></path>
                                            </g>
                                        </g>
                                        </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="display: none;" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We post jobs <strong>Job Boards</strong> like Monster, Jobboom, Indeed, etc...</p>
                                </span>
                            </label>
                            <label class="btn btn-outline-primary connect col-12" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 954.4 954.4" style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="40px" height="40px">
                                        <g>
                                            <g>
                                                <path d="M406.301,70.8h309.3c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-309.3c-13.5,0-24.5,11-24.5,24.5v0.5    C381.7,59.8,392.7,70.8,406.301,70.8z"></path>
                                                <path d="M381.7,140.2c0,13.5,11,24.5,24.5,24.5h416c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-416    c-13.5,0-24.5,11-24.5,24.5V140.2L381.7,140.2z"></path>
                                                <path d="M381.7,234c0,13.5,11,24.5,24.5,24.5h416c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-416    c-13.5,0-24.5,11-24.5,24.5V234L381.7,234z"></path>
                                                <path d="M381.7,375.2c0,13.5,11,24.5,24.5,24.5h309.3c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5H406.301    c-13.5,0-24.5,11-24.5,24.5L381.7,375.2L381.7,375.2z"></path>
                                                <path d="M381.7,469.101c0,13.5,11,24.5,24.5,24.5h223.5c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5H406.301    c-13.5,0-24.5,11-24.5,24.5L381.7,469.101L381.7,469.101z"></path>
                                                <path d="M381.7,562.9c0,13.5,11,24.5,24.5,24.5h416c13.5,0,24.5-11,24.5-24.5v-0.5c0-13.5-11-24.5-24.5-24.5h-416    c-13.5,0-24.5,11-24.5,24.5V562.9L381.7,562.9z"></path>
                                                <path d="M381.7,723.5c0,13.2,10.7,23.8,23.8,23.8h403.9c13.2,0,23.8-10.699,23.8-23.8V723c0-13.2-10.7-23.8-23.8-23.8H405.5    c-13.199,0-23.8,10.7-23.8,23.8V723.5L381.7,723.5z"></path>
                                                <path d="M381.7,814.7c0,13.2,10.7,23.8,23.8,23.8h350.301c13.199,0,23.8-10.7,23.8-23.8v-0.5c0-13.2-10.7-23.8-23.8-23.8H405.5    c-13.199,0-23.8,10.7-23.8,23.8V814.7L381.7,814.7z"></path>
                                                <path d="M381.7,905.8c0,13.2,10.7,23.801,23.8,23.801h159.9c13.2,0,23.8-10.7,23.8-23.801v-0.5c0-13.199-10.7-23.8-23.8-23.8    H405.5c-13.199,0-23.8,10.7-23.8,23.8V905.8L381.7,905.8z"></path>
                                                <path d="M108,154.5v125.4h198.6V154.5c0-10.4-9.101-18.9-20.3-18.9H263.7c-4,0-7.7,1.8-10,4.8l-33.3,43.7l-8.1-15.8l12.9-25.3    c1.8-3.5-0.9-7.5-5.1-7.5h-25.9c-4.1,0-6.8,4-5.1,7.5l12.9,25.3l-8,15.6l-32.2-43.4c-2.3-3.1-6.1-4.9-10.1-4.9H128    C117.101,135.6,108,144,108,154.5z"></path>
                                                <path d="M207.3,121.6c33.5,0,60.8-27.3,60.8-60.8S240.8,0,207.3,0s-60.8,27.2-60.8,60.8C146.5,94.3,173.8,121.6,207.3,121.6z"></path>
                                                <path d="M108,608.8h198.6V483.4c0-10.4-9.101-18.9-20.3-18.9H263.7c-4,0-7.7,1.8-10,4.8L220.4,513l-8.1-15.8l12.9-25.3    c1.8-3.5-0.9-7.5-5.1-7.5h-25.9c-4.1,0-6.8,4-5.1,7.5l12.9,25.3l-8,15.6L161.8,469.4c-2.3-3.101-6.1-4.9-10.1-4.9H128    c-11.2,0-20.3,8.5-20.3,18.9L108,608.8L108,608.8z"></path>
                                                <path d="M146.5,389.7c0,33.5,27.3,60.8,60.8,60.8s60.8-27.3,60.8-60.8s-27.3-60.8-60.8-60.8S146.5,356.1,146.5,389.7z"></path>
                                                <path d="M306.601,829c0-10.399-9.101-18.899-20.3-18.899H263.7c-4,0-7.7,1.8-10,4.8l-33.3,43.7l-8.1-15.801l12.9-25.3    c1.8-3.5-0.9-7.5-5.1-7.5h-25.9c-4.1,0-6.8,4-5.1,7.5l12.9,25.3l-8,15.601L161.8,815c-2.3-3.1-6.1-4.899-10.1-4.899H128    c-11.2,0-20.3,8.5-20.3,18.899v125.4h198.601L306.601,829L306.601,829z"></path>
                                                <path d="M146.5,735.3c0,33.5,27.3,60.801,60.8,60.801s60.8-27.301,60.8-60.801s-27.3-60.8-60.8-60.8S146.5,701.7,146.5,735.3z"></path>
                                            </g>
                                        </g>
                                        </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" style="display: none;" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We have an <strong>ATS</strong>, Candidate Database in <strong>Excel</strong> or <strong>CSV format</strong></p>
                                </span>
                            </label>

                            <label class="btn btn-outline-primary connect col-12 active" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.625 512.625" style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="40px" height="40px">
                                        <g>
                                            <g>
                                                <path d="M506.354,326.375C481.54,305.273,436.651,267.576,405.333,244V106.979c0-23.531-19.146-42.667-42.667-42.667h-320    C19.146,64.313,0,83.448,0,106.979v213.333c0,23.531,19.146,42.667,42.667,42.667h214.625    c3.565,12.277,14.788,21.333,28.208,21.333h77.167v40.781c0,12.802,10.417,23.219,23.208,23.219c6.625,0,11.583-3.115,14.75-5.458    c31.354-23.177,79.688-63.792,105.688-85.917c2.875-2.427,6.313-7.052,6.313-15.292    C512.625,333.406,509.188,328.781,506.354,326.375z M42.667,85.646h320c0.443,0,0.814,0.225,1.25,0.253L211.688,210.917    c-5.583,3.625-13.417,2.938-17.083,0.688L41.424,85.897C41.858,85.871,42.227,85.646,42.667,85.646z M256,328.469v13.177H42.667    c-11.771,0-21.333-9.573-21.333-21.333V106.979c0-3.021,0.668-5.875,1.805-8.482l158.883,130.294    c6.208,4.052,13.354,6.188,20.646,6.188c7.25,0,14.396-2.125,21.646-6.885L382.194,98.496c1.138,2.608,1.806,5.461,1.806,8.483    v128.38c-11.872,1.007-21.333,10.702-21.333,22.839v40.781H285.5C269.229,298.979,256,312.208,256,328.469z M491.292,341.646    v0.073c-26.104,22.188-73,61.542-103.333,83.99c-1.521,1.115-2.063,1.26-2.083,1.271c-1.042,0-1.875-0.844-1.875-1.885v-51.448    c0-5.896-4.771-10.667-10.667-10.667H285.5c-4.5,0-8.167-3.656-8.167-8.156v-26.354c0-4.5,3.667-8.156,8.167-8.156h87.833    c5.896,0,10.667-4.771,10.667-10.667v-51.448c0-1.042,0.833-1.885,1.813-1.885c0.083,0.01,0.625,0.156,2.146,1.271    c30.333,22.438,77.208,61.771,103.333,83.99C491.292,341.594,491.292,341.625,491.292,341.646z"></path>
                                            </g>
                                        </g>
                                        </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We receive <strong>emails</strong> via an email like hiring@email.com</p>
                                </span>
                            </label>
                            <label class="btn btn-outline-primary connect col-12 active align-self-center" style="white-space: normal;">
                                <input type="checkbox" name="looking_job" id="option01"  autocomplete="off" checked="" value="yes">
                                <span class="d-flex">
                                    <div class="align-self-center mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 375.418 375.418" style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle;" xml:space="preserve" width="40px" height="40px">
                                            <g><g>
                                            <path d="M255.348,218.284l-38.493-6.036v-67.175c0-15.952-12.978-28.93-28.93-28.93h-0.433   c-15.953,0-28.931,12.978-28.931,28.93v107.881l-39.794-17.055c-7.996-3.427-17.104-2.614-24.366,2.176   c-7.262,4.788-11.597,12.841-11.597,21.539v0.363c0,7.361,3.155,14.389,8.656,19.28l67.102,59.669v28.989   c0,4.143,3.358,7.5,7.5,7.5s7.5-3.357,7.5-7.5V335.56c0-2.142-0.916-4.182-2.516-5.604l-69.618-61.906   c-2.303-2.048-3.624-4.989-3.624-8.071v-0.363c0-3.695,1.77-6.982,4.855-9.017s6.803-2.366,10.2-0.911l50.247,21.534   c0.457,0.196,0.937,0.35,1.435,0.453c0.756,0.157,1.518,0.192,2.263,0.117c0.08-0.008,0.157-0.023,0.236-0.033   c0.16-0.021,0.319-0.042,0.477-0.073c0.13-0.026,0.256-0.061,0.383-0.093c0.104-0.026,0.21-0.05,0.313-0.081   c0.144-0.043,0.284-0.095,0.424-0.146c0.086-0.031,0.173-0.06,0.257-0.094c0.137-0.056,0.269-0.12,0.402-0.184   c0.087-0.041,0.174-0.08,0.259-0.125c0.117-0.062,0.23-0.131,0.343-0.199c0.098-0.058,0.196-0.114,0.291-0.177   c0.093-0.061,0.181-0.128,0.271-0.193c0.109-0.079,0.218-0.157,0.323-0.242c0.073-0.059,0.141-0.123,0.211-0.184   c0.113-0.099,0.226-0.197,0.333-0.303c0.062-0.061,0.119-0.126,0.178-0.189c0.106-0.112,0.212-0.223,0.311-0.342   c0.065-0.078,0.124-0.161,0.186-0.241c0.084-0.109,0.169-0.216,0.247-0.33c0.087-0.127,0.165-0.26,0.244-0.393   c0.044-0.074,0.092-0.145,0.134-0.221c0.36-0.651,0.627-1.36,0.781-2.112c0.104-0.503,0.152-1.01,0.152-1.512V145.073   c0-7.681,6.249-13.93,13.931-13.93h0.433c7.681,0,13.93,6.249,13.93,13.93v72.025c0,0.277,0.017,0.549,0.047,0.818   c-0.396,3.934,2.339,7.537,6.292,8.156l44.881,7.037c0.035,0.006,0.071,0.011,0.106,0.017   c27.148,3.857,47.621,27.444,47.621,54.866v0.766c0,12.69-3.097,25.349-8.957,36.606L271.5,364.453   c-1.912,3.675-0.484,8.203,3.19,10.115c1.106,0.576,2.29,0.85,3.457,0.85c2.708,0,5.323-1.472,6.659-4.039l20.345-39.088   c6.968-13.388,10.651-28.44,10.651-43.532v-0.766c0-16.958-6.122-33.351-17.237-46.158   C287.461,229.042,272.116,220.68,255.348,218.284z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                            <path d="M231.583,170.476c3.79,1.673,8.217-0.041,9.891-3.83c3.308-7.49,4.985-15.47,4.985-23.716   c0-32.395-26.355-58.75-58.75-58.75s-58.75,26.355-58.75,58.75c0,8.569,1.806,16.834,5.369,24.564   c1.265,2.746,3.979,4.363,6.816,4.363c1.05,0,2.118-0.222,3.134-0.69c3.762-1.733,5.406-6.188,3.672-9.95   c-2.649-5.748-3.992-11.9-3.992-18.287c0-24.124,19.626-43.75,43.75-43.75s43.75,19.626,43.75,43.75   c0,6.146-1.247,12.086-3.707,17.655C226.079,164.374,227.794,168.803,231.583,170.476z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                            <path d="M254.137,205.937c3.228,2.598,7.948,2.085,10.545-1.141c14.043-17.452,21.777-39.424,21.777-61.866   c0-54.451-44.299-98.75-98.75-98.75s-98.75,44.299-98.75,98.75c0,34.593,17.617,66.068,47.126,84.196   c1.224,0.752,2.58,1.11,3.918,1.11c2.521,0,4.982-1.271,6.398-3.575c2.168-3.529,1.064-8.148-2.465-10.316   c-25.033-15.378-39.978-42.075-39.978-71.415c0-46.18,37.57-83.75,83.75-83.75s83.75,37.57,83.75,83.75   c0,19.311-6.385,37.451-18.464,52.462C250.398,198.619,250.909,203.34,254.137,205.937z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                            <path d="M85.915,220.426C68.817,198.005,59.78,171.207,59.78,142.93C59.78,72.389,117.168,15,187.709,15   s127.929,57.389,127.929,127.93c0,23.682-6.518,46.807-18.849,66.875c-2.168,3.529-1.065,8.148,2.464,10.316   c3.529,2.169,8.148,1.065,10.316-2.463c13.783-22.433,21.069-48.272,21.069-74.729C330.638,64.118,266.521,0,187.709,0   S44.78,64.118,44.78,142.93c0,31.592,10.1,61.535,29.208,86.592c1.476,1.936,3.709,2.952,5.969,2.952   c1.586,0,3.184-0.5,4.542-1.536C87.792,228.426,88.427,223.72,85.915,220.426z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                                        </g></g> </svg>
                                    </div>
                                    <img src="{{ asset('img//sidebar/active.png') }}" class="mr-2 active_icon align-self-center">
                                    <p class="mb-0 align-self-center fw-lighter">We have a <strong>website</strong> / online career page</p>
                                </span>
                            </label>
                        </div>
                        <div class="col-12 px-0 mt-3 d-flex">
                            <div class="mr-3">
                                <div style="width: 55px; height: 55px; margin: 0 auto; overflow: hidden; border-radius: 5px;" id="avatar_hover">
                                        <img src="{{ asset('img/business-logo-small.png') }}" class="border rounded" id="menu-userpic" style="position: relative; width: 55px; height: 55px; z-index: 1;" />
                                </div>
                                <div>
                                    <img src="{{ asset('img/profilepic2.png') }}" class="border rounded business-logo" id="menu-business-picture" style="width:25px; height: 25px; margin-top: -15px; margin-left: 40px;" />
                                </div>
                            </div> 
                            <p class="mb-0 align-self-center" style="font-size: 20px;">Business Name</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 px-0 mt-4">
                <button class="btn btn-success btn-block col-lg-6 col-11 mx-auto">Let's get started</button>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<script src="{{ asset('/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/libs/bootstrap4/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/notify.min.js') }}"></script>
<script src="{{ asset('/js/modal.js') }}"></script>
<script src="{{ asset('/js/app/user.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/business.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/app.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/main.js?v='.time()) }}"></script>
<script src="{{ asset('/js/app/signup.js?v='.time()) }}"></script>
<script src="{{ asset('/js/login_wizard.js?v='.time()) }}"></script>
<script src="{{ asset('/js/landing-animation.js') }}"></script>
<script src="{{ asset('/js/jquery-ui.js') }}"></script>
<script src="{{ asset('/js/main.js?v='.time()) }}"></script>
<script type="text/javascript">
    

    $( ".btn-outline-primary" ).click(function() {
        if($(this).hasClass('active') == true)
        {
            $(this).find('.active_icon').hide();
            console.log("non-active");
        }
        else
        {
            $(this).find('.active_icon').show();
            console.log("active");
        }
    });
</script>


</body>
</html>