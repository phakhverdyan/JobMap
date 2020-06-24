<hr class="my-0">
<!-- ONE LOCATION BEGIN -->
<div class="card border-0">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect text-left" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
                                    <span>
                                        <img src="{{ $picture }}" style="width: 35px;" class="mr-2">
                                    </span>
            <a class="collapsed Bobik" data-toggle="collapse" href="#collapse{{ $args['id'] }}" aria-expanded="true"
               aria-controls="collapse{{ $args['id'] }}" style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">

                {{ $args['name'] }}
            </a>

            <div class="btn-group float-right mr-3" role="group">

            </div>
        </h5>
    </div>

    <div id="collapse{{ $args['id'] }}" class="collapse text-left" role="tabpanel" aria-labelledby="heading{{ $args['id'] }}" data-parent="#accordion">
        <div class="card-body pt-0">
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