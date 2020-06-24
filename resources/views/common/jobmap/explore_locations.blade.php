@extends('layouts.jobmap.common_user')

@section('content')


<div class="container-fluid mt-3 user-landing">
    <div class="row">
        <div class="container">  
            <div class="col-12 mt-0">
                <div class="px-3" style="height: 300px;">
                    <p>Explore JobMap</p>
                    <div>MAP</div>
                </div>
            </div>
        </div>         
    </div>
    <div class="row">
        <div class="container pb-5">
            <div class="col-12 text-center" style="margin-top: -19px;">
                <button class="btn btn-outline-primary">Explore Full Map</button>
            </div>
            <div class="col-12 mx-auto pt-5 pb-2 animated fadeInDown px-0">
                <form action="/search/jobs?" id="search-form" autocomplete="off">
                    <div class="d-flex flex-column flex-lg-row">
                        <div class="col-12 col-lg-5 px-0 pxa-0" id="title-box">
                            <label class="text-left" style="color:#555;">Job title, keywords or company</label>
                            <div class="form-control d-flex border"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <p class="my-0 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#0646a6;"
                                         xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </p>
                                <input type="text" name="title" placeholder="Barista, Nurse" autocomplete="off"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%">
                            </div>

                        </div>
                        <div class="col-12 col-lg-5 px-0 pxa-0" id="location-box">
                            <label class="text-left" style="color:#555;">Location</label>
                            <div class="form-control d-flex border"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <p class="my-0 mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;width: 25px;height: 20px;vertical-align: middle;margin-top: 10px;fill:#0646a6;"
                                         xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M341.476,338.285c54.483-85.493,47.634-74.827,49.204-77.056C410.516,233.251,421,200.322,421,166    C421,74.98,347.139,0,256,0C165.158,0,91,74.832,91,166c0,34.3,10.704,68.091,31.19,96.446l48.332,75.84    C118.847,346.227,31,369.892,31,422c0,18.995,12.398,46.065,71.462,67.159C143.704,503.888,198.231,512,256,512    c108.025,0,225-30.472,225-90C481,369.883,393.256,346.243,341.476,338.285z M147.249,245.945    c-0.165-0.258-0.337-0.51-0.517-0.758C129.685,221.735,121,193.941,121,166c0-75.018,60.406-136,135-136    c74.439,0,135,61.009,135,136c0,27.986-8.521,54.837-24.646,77.671c-1.445,1.906,6.094-9.806-110.354,172.918L147.249,245.945z     M256,482c-117.994,0-195-34.683-195-60c0-17.016,39.568-44.995,127.248-55.901l55.102,86.463    c2.754,4.322,7.524,6.938,12.649,6.938s9.896-2.617,12.649-6.938l55.101-86.463C411.431,377.005,451,404.984,451,422    C451,447.102,374.687,482,256,482z"/>
                                            </g>
                                        </g>
                                        <g>
                                            <g>
                                                <path d="M256,91c-41.355,0-75,33.645-75,75s33.645,75,75,75c41.355,0,75-33.645,75-75S297.355,91,256,91z M256,211    c-24.813,0-45-20.187-45-45s20.187-45,45-45s45,20.187,45,45S280.813,211,256,211z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </p>
                                <input type="text" name="location" placeholder="Montreal, Quebec" autocomplete="off"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%">
                            </div>

                        </div>
                        <div class="col-12 col-lg-2 px-0 pxa-0" id="button-box">
                            <label class="text-right"><a href="/advanced-search"
                                                         class="cardinal_links">Advanced</a></label>
                            <button type="button" id="search-button"
                                    class="btn btn-primary w-100 border-top-left-0 border-bottom-left-0 cardinal_button">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px"
                                         viewBox="0 0 485.213 485.213"
                                         style="enable-background:new 0 0 485.213 485.213; vertical-align: middle; margin-top: -4px; opacity: 0.8;"
                                         xml:space="preserve" fill="#fff">
                                        <g>
                                            <g>
                                                <path d="M363.909,181.955C363.909,81.473,282.44,0,181.956,0C81.474,0,0.001,81.473,0.001,181.955s81.473,181.951,181.955,181.951    C282.44,363.906,363.909,282.437,363.909,181.955z M181.956,318.416c-75.252,0-136.465-61.208-136.465-136.46    c0-75.252,61.213-136.465,136.465-136.465c75.25,0,136.468,61.213,136.468,136.465    C318.424,257.208,257.206,318.416,181.956,318.416z"/>
                                                <path d="M471.882,407.567L360.567,296.243c-16.586,25.795-38.536,47.734-64.331,64.321l111.324,111.324    c17.772,17.768,46.587,17.768,64.321,0C489.654,454.149,489.654,425.334,471.882,407.567z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 pxa-0">
                <div class="row flex-column flex-lg-row">

                    <div class="col-lg-4 col-12 mt-1">
                        <div class="border rounded px-3 py-2 bg-white">
                            <p>Explore Jobs</p>
                            <div>Jobs</div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12 mt-1">
                        <div class="border rounded px-3 py-2 bg-white">
                            <p>Explore Careers</p>
                            <div>somethink</div>
                        </div> 
                    </div>

                    <div class="col-lg-4 col-12 mt-1">
                        <div class="border rounded px-3 py-2 bg-white">
                            <p>Explore locations, employers and more..</p>
                            <div>somethink</div>
                        </div>
                    </div>
                </div>
            </div>           
        </div>
    </div>
</div>


@endsection
