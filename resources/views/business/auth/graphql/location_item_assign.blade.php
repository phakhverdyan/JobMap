<div class="col-md-11 mt-2 mx-auto pxa-0 pr-0 location_one-item">
     <div class="d-flex">
            <div class="align-self-center mr-2">
                     <label class="custom-control custom-checkbox m-0 pl-3">
                      <input type="checkbox" {{ $args['is_assigned'] ? 'checked' : '' }} data-aaa="{{ $args['is_assigned'] }}"
                             class="custom-control-input location-item " value="{{ $args['id'] }}" data-json="{{json_encode($args)}}">
                      <span class="custom-control-indicator"></span>
                  </label>
          </div>
      <div class="flex-1 align-self-center">
              <div class="d-flex flex-column flex-md-row">
                      <div class="align-self-center flex-1">
                              <p class="my-0 px-3 coll_name"><strong>{{ $args['name'] }}@if($args['main'] == 1) {!! trans('main.status.main_location') !!} @endif</strong></p>
                              <p class="my-0 px-3 coll_title">{{ $args['street_number'].' '.$args['street'].', '.$location }} </p>
                          </div>
                      <div class="align-self-center ml-3 text-right">
                              <p class="my-0 small">
                                     <strong>{{ trans('main.created') }}</strong></p>
                              <p class="my-0">{{ $args['created_at']->format('M d, Y') }}</p>
                          </div>
                  </div>
          </div>
   </div>
</div>
