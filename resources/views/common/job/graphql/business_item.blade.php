<!-- ONE JOB START -->
<div class="col-12 px-0">
    <div class="d-flex flex-column flex-lg-row p-3" style="border-bottom:1px solid #e9ecef;">
        <div class="text-center text-lg-left">
            <img src="{{ $picture }}" class="rounded"
                 style="width: 60px; height: 60px;">
        </div>
        <div class="ml-4 w-100 text-center text-lg-left pxa-0 mxa-0">
            <div class="d-flex justify-content-between flex-column flex-lg-row">
                <div class="mb-2">
                    <a href="{{ config('app.url') }}/business/view/{{ $args['id'] }}/{{ $args['slug'] }}"
                       class="cardinal_links" style="font-size: 18px;">{{ $args['name'] }}</a>
                </div>
                <div class="pt-1" style="opacity: 0.4; letter-spacing: -1px;">
                    {{--<span data-toggle="tooltip" title="Coming Soon">--}}
                    {{--<a href="#">--}}
                    {{--<svg xmlns="http://www.w3.org/2000/svg"--}}
                    {{--xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                    {{--version="1.1" id="Capa_1" x="0px" y="0px" width="20px"--}}
                    {{--height="20px" viewBox="0 0 488.501 488.5"--}}
                    {{--style="enable-background:new 0 0 488.501 488.5; vertical-align: middle; margin-top: -3px; opacity: 0.4;"--}}
                    {{--xml:space="preserve">--}}
                    {{--<g>--}}
                    {{--<path d="M487.312,159.162C479.501,99.042,432.172,51.138,372.2,42.651c-6.532-0.929-13.158-1.395-19.69-1.395   c-43.417,0-83.353,20.523-108.664,54.18c-25.362-33.038-65.015-53.168-107.866-53.168c-6.626,0-13.358,0.482-19.994,1.437   C58.812,51.915,11.987,97.287,2.111,154.046c-7.496,43.113,5.169,85.801,34.788,117.292c3.901,4.676,9.132,10.621,13.882,15.994   l4.058,4.619c29.976,34.18,93.586,95.86,137.779,135.619c13.798,12.435,32.765,19.674,52.036,19.674h0.546   c19.921-0.467,38.991-7.476,52.339-19.947c37.189-34.693,61.598-59.484,102.257-101.827l1.552-1.625   c45.996-47.485,53.818-57.042,56.387-60.507C481.734,234.053,492.24,197.084,487.312,159.162z M415.922,229.792   c-12.265,15.056-8.984,11.245-53.053,56.738l-1.73,1.781c-39.946,41.584-63.883,65.75-100.17,99.601   c-3.586,3.35-11.607,5.315-16.251,5.315c-6.103,0-12.173-2.061-16.21-5.698c-42.096-37.886-105.078-98.697-133.365-130.964   l-4.162-4.696c-4.613-5.228-10.889-12.692-14.637-16.817c-17.771-19.563-26.055-45.31-21.431-71.821   c5.944-34.19,34.2-61.529,68.695-66.483c4.121-0.586,8.272-0.886,12.372-0.886c32.764,0,62.405,19.407,75.531,49.43   c5.672,12.991,18.421,21.374,32.523,21.374c14.217,0,27.03-8.494,32.649-21.662c14.542-34.165,50.526-54.542,88.01-49.293   c35.616,5.048,64.826,34.625,69.472,70.341C437.184,189.346,430.537,211.85,415.922,229.792z"/>--}}
                    {{--</g>--}}
                    {{--</svg>--}}
                    {{--</a>--}}
                    {{--</span>--}}
                    {{--<span class="ml-2" data-toggle="tooltip" title="Email & share this job">--}}
                    {{--<a data-toggle="modal" data-target="#ShareModal">--}}
                    {{--<svg xmlns="http://www.w3.org/2000/svg"--}}
                    {{--xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                    {{--version="1.1" id="Layer_1" x="0px" y="0px"--}}
                    {{--viewBox="0 0 512.297 512.297"--}}
                    {{--style="enable-background:new 0 0 512.297 512.297;  vertical-align: middle; margin-top: -3px; opacity: 0.4;"--}}
                    {{--xml:space="preserve" width="20px" height="20px">--}}
                    {{--<g>--}}
                    {{--<g>--}}
                    {{--<path d="M506.049,230.4l-192-192c-13.439-13.439-36.418-3.921-36.418,15.085v85.431    c-122.191,5.079-229.968,88.278-264.124,206.683C2.101,385.123-0.745,417.65,0.154,452.659c0.113,4.11,0.142,5.296,0.142,6.159    c0,21.677,28.579,29.538,39.666,10.911c23.767-39.933,50.761-70.791,80.333-93.599c53.462-41.233,109.122-53.174,157.335-48.352    v109.707c0,19.006,22.979,28.524,36.418,15.085l192-192C514.38,252.239,514.38,238.731,506.049,230.4z M320.297,385.982v-76.497    c0-9.773-6.641-18.296-16.117-20.686c-2.596-0.655-6.908-1.513-12.758-2.331c-60.43-8.455-130.633,4.548-197.184,55.876    c-16.371,12.626-31.961,27.299-46.688,44.105l0.326-1.708c1.701-8.759,3.879-17.804,6.624-27.315    c30.45-105.558,130.034-178.409,240.312-176.032c1.864,0.033,2.552,0.048,3.415,0.078c12.063,0.416,22.069-9.25,22.069-21.321    v-55.163l140.497,140.497L320.297,385.982z"/>--}}
                    {{--</g>--}}
                    {{--</g>--}}
                    {{--</svg>--}}
                    {{--</a>--}}
                    {{--</span>--}}
                    <span class="ml-2">{{ $d }}</span>
                </div>
            </div>
            {{--<p class="mb-1">--}}
                {{--<span style="font-weight: 800; font-size: 16px; opacity: 0.8;"><img--}}
                            {{--src="{{ asset('img/sidebar/locations.png') }}"--}}
                            {{--style="margin-top: -5px;"> {{ $args['street'].' '.$args['street_number'].','.$location }}--}}
            {{--</p></span>--}}
            <span class="ml-3 mxa-0">
                <a href="#" style="text-decoration: none;"> {!! trans_choice('main.counters.c_locations', $args['locations_count'], ['count' => $args['locations_count']]) !!}</a>
                <span class="ml-3"><a href="#" style="text-decoration: none;"> {!! trans_choice('main.counters.c_jobs', $args['jobs_count'], ['count' => $args['jobs_count']]) !!}</a></span>
            </span>
            {{--</p>--}}
        </div>
    </div>
</div>
<!-- ONE JOB EOF -->