<hr class="my-0">
<!-- ONE LOCATION BEGIN -->
<div class="card border-0 col-md-12 px-0">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect text-left" role="tab" id="headingJ{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
                                    <span>
                                        <img src="{{ $picture }}" style="width: 35px;" class="mr-2">
                                    </span>
            <a class="collapsed Bobik" data-toggle="collapse" href="#collapseJ{{ $args['id'] }}" aria-expanded="true"
               aria-controls="collapseJ{{ $args['id'] }}" style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">

                {{ $args['title'] }}
            </a>

            <div class="btn-group float-right mr-3" role="group">
                <button id="btnGroupDropJ{{ $args['id'] }}" type="button"
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
                    <a href="/jobmap/view/job/{{ $args['job_id'] }}" data-id="{{ $args['id'] }}" class="dropdown-item view-job-link"
                       role='button'>View job</a>
                </div>
            </div>
        </h5>
    </div>

    <div id="collapseJ{{ $args['id'] }}" class="collapse text-left" role="tabpanel" aria-labelledby="headingJ{{ $args['id'] }}" data-parent="#accordion2">
        <div class="card-body pt-0">
            <div class="col-12 px-0">

                <div class="d-flex">
                    <p class="mb-1" style=" opacity: 0.5;">
                        @foreach($args['types'] as $type)
                            {{ $type['type']['name'] }}
                        @endforeach
                    </p>
                </div>
                <div class="pt-2">
                    <pre class="coll_title">{{ $args['description'] }}</pre>
                </div>

            </div>
        </div>
    </div>
</div>