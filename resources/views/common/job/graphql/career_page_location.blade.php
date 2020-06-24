<div class="col-4 pt-0">
    <div class="card border-0" style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">

        <div class="col-md-12 card rounded-0 py-3">
            <div class="row">

                <div class="col-md-3">
                    <div class="rounded p-1 bg-white d-inline-block mr-2"
                         style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                        <img src="{{ $picture }}" width="25px">
                    </div>
                </div>
                <div class="col-md-8 pl-0">
                    <h6>{{ $args['name'] }}</h6>
                    <p class="mb-1" style=" opacity: 0.5;"><img
                                src="{{ asset('img/sidebar/locations.png') }}"
                                style="margin-top: -5px;"> {{ $args['street'].' '.$args['street_number'].','.$location }}</p>
                </div>

            </div>
        </div>

        <div class="col-md-12 card rounded-0 border-top-0 py-3">
            <div class="row">
                <div class="col-md-7 text-center">
                    <p class="mb-0"><a href="#" style="text-decoration: none;"> {{ $args['jobs_count_open'] }} Open
                            positions</a></p>
                </div>
                <div class="col-md-5 text-center">
                    <p class="mb-0"><a href="#" style="text-decoration: none;"> {{ $args['jobs_count_close'] }}
                            Closed</a></p>
                </div>
            </div>

        </div>

        <div class="col-md-12 text-center py-3 mt-0 card rounded-0 border-top-0">
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

        <div class="col-md-12 pt-0 card rounded-0 border-top-0 border-bottom-0">
            <div class="row">

            <!-- <div class="col-md-6 mx-auto">
														<button class="btn btn-outline-primary btn-block"><img src="{{ asset('img/share.svg') }}" style="width: 12px; margin-top: 5px; float: left;">Share</button>
													</div>

													<div class="col-md-6 mx-auto">
														<button class="btn btn-outline-primary btn-block"><img src="{{ asset('img/star.svg') }}" style="width: 12px; margin-top: 5px; float: left;">Follow</button>
													</div> -->

                <div class="col-md-12 my-3 mx-auto">
                    <button class="btn btn-outline-primary btn-block  py-2 send-resume" data-id="{{ $args['id'] }}" data-b-id="{{ $args['business']['id'] }}" >Send
                        CloudResume
                    </button>
                </div>

            </div>
        </div>


        <div class="col-md-12">
            <div class="row">
                <div class="col-8 px-0">
                    <a href="{{ url('/map/view/location/' . $args['id']) }}" class="btn btn-outline-secondary btn-block py-3"
                       style="border-bottom-right-radius: 0px; border-bottom-left-radius: 5px; border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        View Location
                    </a>
                </div>
                <div class="col-2 px-0">
                    <button class="btn btn-outline-secondary btn-block py-3 rounded-0 border-left-0 border-right-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 59 59"
                             style="enable-background:new 0 0 59 59; fill:#868e96;"
                             xml:space="preserve" height="18px" width="20px">
														<path d="M47,39c-2.671,0-5.182,1.04-7.071,2.929c-0.524,0.524-0.975,1.1-1.365,1.709l-17.28-10.489  C21.741,32.005,22,30.761,22,29.456c0-1.305-0.259-2.549-0.715-3.693l17.284-10.409C40.345,18.142,43.456,20,47,20  c5.514,0,10-4.486,10-10S52.514,0,47,0S37,4.486,37,10c0,1.256,0.243,2.454,0.667,3.562L20.361,23.985  c-1.788-2.724-4.866-4.529-8.361-4.529c-5.514,0-10,4.486-10,10s4.486,10,10,10c3.495,0,6.572-1.805,8.36-4.529L37.664,45.43  C37.234,46.556,37,47.759,37,49c0,2.671,1.04,5.183,2.929,7.071C41.818,57.96,44.329,59,47,59s5.182-1.04,7.071-2.929  C55.96,54.183,57,51.671,57,49s-1.04-5.183-2.929-7.071C52.182,40.04,49.671,39,47,39z"/>
                            <g>
														</svg>
                    </button>
                </div>
                <div class="col-2 px-0">
                    <button class="btn btn-outline-secondary btn-block py-3"
                            style="border-bottom-right-radius: 5px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; border-top-right-radius: 0px;">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" viewBox="0 0 55.867 55.867"
                             style="enable-background:new 0 0 55.867 55.867; fill:#868e96;"
                             xml:space="preserve" height="18px" width="20px">
														<path d="M11.287,54.548c-0.207,0-0.414-0.064-0.588-0.191c-0.308-0.224-0.462-0.603-0.397-0.978l3.091-18.018L0.302,22.602  c-0.272-0.266-0.37-0.663-0.253-1.024c0.118-0.362,0.431-0.626,0.808-0.681l18.09-2.629l8.091-16.393  c0.168-0.342,0.516-0.558,0.896-0.558l0,0c0.381,0,0.729,0.216,0.896,0.558l8.09,16.393l18.091,2.629  c0.377,0.055,0.689,0.318,0.808,0.681c0.117,0.361,0.02,0.759-0.253,1.024L42.475,35.363l3.09,18.017  c0.064,0.375-0.09,0.754-0.397,0.978c-0.308,0.226-0.717,0.255-1.054,0.076l-16.18-8.506l-16.182,8.506  C11.606,54.51,11.446,54.548,11.287,54.548z M3.149,22.584l12.016,11.713c0.235,0.229,0.343,0.561,0.287,0.885L12.615,51.72  l14.854-7.808c0.291-0.154,0.638-0.154,0.931,0l14.852,7.808l-2.836-16.538c-0.056-0.324,0.052-0.655,0.287-0.885l12.016-11.713  l-16.605-2.413c-0.326-0.047-0.607-0.252-0.753-0.547L27.934,4.578l-7.427,15.047c-0.146,0.295-0.427,0.5-0.753,0.547L3.149,22.584z  "/>
                            <g>
														</svg>
                    </button>
                </div>
            </div>

        </div>

    </div>
</div>
