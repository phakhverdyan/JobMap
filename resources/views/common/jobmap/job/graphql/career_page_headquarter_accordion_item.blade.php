<hr class="my-0">
<!-- ONE LOCATION BEGIN -->
<div class="card border-0 col-md-12 px-0">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect text-left" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
                                    <span>
                                        <img src="{{ $picture }}" style="width: 35px;" class="mr-2">
                                    </span>
            <a class="collapsed Bobik" data-toggle="collapse" href="#collapse{{ $args['id'] }}" aria-expanded="true"
               aria-controls="collapse{{ $args['id'] }}"
               style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">

                {{ $args['name'] }}
            </a>

            <div class="btn-group float-right mr-3" role="group">
                <button id="btnGroupDrop{{ $args['id'] }}" type="button"
                        class="border-0 dropdown-toggle morewithoutcaret" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Layer_1" x="0px" y="0px" width="20px" height="18px"
                         viewBox="0 0 210 210"
                         style="enable-background:new 0 0 210 210; vertical-align: middle; fill:#4E5C6E;"
                         xml:space="preserve" ata-toggle="tooltip" data-placement="top" title="More">
                                        <g id="XMLID_103_">
                                            <path id="XMLID_104_"
                                                  d="M115,0H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15V15   C130,6.716,123.284,0,115,0z"/>
                                            <path id="XMLID_105_"
                                                  d="M115,80H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15V95   C130,86.716,123.284,80,115,80z"/>
                                            <path id="XMLID_106_"
                                                  d="M115,160H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15v-20   C130,166.716,123.284,160,115,160z"/>
                                        </g>
                                        </svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a href="/jobmap/view/location/{{ $args['id'] }}" class="dropdown-item"
                       role='button'>View Location</a>
                    <button class="dropdown-item" type="button">Send
                        CloudResume
                    </button>
                    <button class="dropdown-item" type="button">Share
                    </button>
                    <button class="dropdown-item" type="button">Favorite
                    </button>
                </div>
            </div>
        </h5>
    </div>

    <div id="collapse{{ $args['id'] }}" class="collapse text-left" role="tabpanel"
         aria-labelledby="heading{{ $args['id'] }}" data-parent="#accordion">
        <div class="card-body pt-0">
            <div class="col-12 px-0">
                <p class="mb-1" style=" opacity: 0.5;"><img
                            src="{{ asset('img/sidebar/locations.png') }}"
                            style="margin-top: -5px;"> {{ $args['street'].' '.$args['street_number'].','.$location }}</p>
                <div class="d-flex flex-row text-center justify-content-start">

                    @foreach($args['amenities'] as $amenity)
                        <div class="border rounded-circle"
                             style="padding-top: 7px;width: 40px;height: 40px; box-shadow: 0 4px 10px 0 rgba(0,0,0,.14), 0 1px 2px 0 rgba(0,0,0,.12), 0 3px 1px -2px rgba(0,0,0,.2);"
                             data-toggle="tooltip" title="{{ $amenity['amenity']['name'] }}">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                 version="1.1" id="Layer_1" x="0px" y="0px"
                                                                 viewBox="0 0 512 512"
                                                                 style="enable-background:new 0 0 512 512; fill:#007bff; width: 20px;"
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
                <br>
                <p class="mb-0"><a href="#" style="text-decoration: none;"> {{ $args['jobs_count_open'] }} Open
                        positions</a></p>
                <br>
                <p class="mb-0"><a href="#" style="text-decoration: none;"> {{ $args['jobs_count_close'] }}
                        Closed</a></p>

                <div class="pt-2">
                    <pre class="coll_title">{{ $args['description'] }}</pre>
                </div>

            </div>
        </div>
    </div>
</div>