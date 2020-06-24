<hr class="my-0">
<!-- ONE LOCATION BEGIN -->
<div class="card border-0">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect text-left" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
                                    <span>
                                        <img src="{{ $picture }}" style="width: 35px;" class="mr-2">
                                    </span>
            <a href="{{ request()->getSchemeAndHttpHost() }}/business/view/{{ $args['id'] }}/{{ $args['slug'] }}"
               style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">
                {{ $args['name'] }}
            </a>

            <div class="float-right collapsed Bobik" id="accord_buttonB{{ $args['id'] }}"></div>

            <!-- <div class="btn-group float-right mr-3" role="group">
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
                    <a href="{{ request()->getSchemeAndHttpHost() }}/business/view/{{ $args['id'] }}/{{ $args['slug'] }}"
                       class="dropdown-item"
                       role='button'>View Business</a>
                </div>
            </div> -->

        </h5>
    </div>

    <div id="collapseB{{ $args['id'] }}" class="collapse text-left" role="tabpanel"
         aria-labelledby="heading{{ $args['id'] }}" data-parent="#accordion">
        <div class="card-body pt-0 mt-2">
            <div class="col-12 px-0">

                <div class="d-flex">
                    <p class="MarksBeautifulFontColor mb-0">
                                                <span>
                                                    <strong>
                                                        <span data-toggle="tooltip" data-placement="top"
                                                              title="Industry"
                                                              style="font-size: 16px;">Locations</span>
                                                    </strong>
                                                    <span class="ml-2 mr-5" data-toggle="tooltip" data-placement="top"
                                                          title="Job Category">{{ $args['locations_count'] }}</span>
                                                </span>
                        <span class="ml-2">
                                                    <strong style="font-size: 16px;">Jobs</strong>
                                                    <span class="ml-2 mr-5">{{ $args['jobs_count'] }}</span>
                                                </span>
                    </p>
                </div>
                <div class="pt-2">
                    <pre class="coll_title">{{ $args['description'] }}</pre>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
$(document).ready(
    function(){
        $('#accord_buttonB{{ $args['id'] }}').click(function(){
            $('#collapseB{{ $args['id'] }}').slideToggle();
            $('#accord_buttonB{{ $args['id'] }}').toggleClass('collapsed');
        });
    });
</script>