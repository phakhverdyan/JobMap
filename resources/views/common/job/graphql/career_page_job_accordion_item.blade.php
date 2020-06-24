<!-- ONE LOCATION BEGIN -->
<div class="card border-0 col-md-12 px-0">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect text-left" role="tab" id="headingJ{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
            <span>
                <img src="{{ $picture }}" style="width: 35px;" class="mr-2">
            </span>
            <a href="{{ url('/map/view/job/' . $args['job_id']) }}" data-id="{{ $args['id'] }}" style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;" class="view-job-link">

                {{ $args['localized_title'] }}
            </a>

            <div class="float-right collapsed Bobik" id="accord_buttonJ{{ $args['id'] }}"></div>

        </h5>
    </div>

    <div id="collapseJ{{ $args['id'] }}" class="text-left accordion_effect" aria-labelledby="headingJ{{ $args['id'] }}" style="display: none;" >
        <div class="card-body pt-0 mt-2">
            <div class="col-12 px-0">

                <div class="d-flex">
                    <p class="mb-1" style=" opacity: 0.5;">
                        @foreach($args['types'] as $type)
                            {{ $type['type']['name'] }}
                        @endforeach
                    </p>
                </div>
                <div class="pt-2">
                    <pre class="coll_title">{{ $args['localized_description'] }}</pre>
                </div>

            </div>
        </div>
    </div>
    <hr class="my-0">
</div>

<script type="text/javascript">
    
$(document).ready(
    function(){
        $('#accord_buttonJ{{ $args['id'] }}').click(function(){
            $('#collapseJ{{ $args['id'] }}').slideToggle();
            $('#accord_buttonJ{{ $args['id'] }}').toggleClass('collapsed');
            return false;
        });
    });
</script>
