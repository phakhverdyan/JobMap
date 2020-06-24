<div class="col-12 px-0">
    <div class="d-flex flex-column flex-lg-row pxa-0 p-3"
         style="border-bottom:1px solid #e9ecef;">
        <div class="text-center text-lg-left">
            <img src="{{ $picture }}"
                 class="rounded"
                 style="width: 60px; height: 60px;">
        </div>
        <div class="ml-4 mxa-0 text-center text-lg-left w-100">
            <div class="d-flex justify-content-between flex-column flex-lg-row">
              <div class="flex-1">
                <div class="mb-2">
                    <a href="{{ url('/map/view/job/' . $args['id']) }}"
                       data-id="" class="view-job-link open-sans"
                       style="font-size: 16px; color:#1D1D1D; font-weight: bold;">{{ $args['localized_title'] }}</a>
                </div>
                <p class="mb-1 open-sans" style="opacity: 0.5;">
                    <span>
                        <?php
                        $str = '';
                        foreach ($types as $di) {
                            $str .= $di['name'] . ',';
                        }
                        echo rtrim($str, ',');
                        ?>
                    </span>
                    <span class="mx-1">•</span>
                    <span class="rounded">{{ $args['salary'] . $args['salary_type'] }}</span>
                </p>
              </div>
              <div class="d-flex">
                  <div class="text-center">
                    <div class="mb-2" style="opacity: 0.4;">
                      <span class="ml-2 mxa-0">{{ $d }}</span>
                    </div>
                    <div class="align-self-center">
                        <a href="/map/view/job/{{ $args['id'] }}"
                           data-id=""
                           class="view-job-link btn border-0 px-4 py-1"
                           role="button"
                           style="background-color: #4266ff; color:#fff; border-radius: 20px;">{!! trans('main.buttons.view_job') !!}</a>
                    </div>
                  </div>
                  <div>
                    <a data-toggle="modal" data-target="#ShareModal" data-link="{{ url('/map/view/job/' . $args['job_id']) }}?locale={{ \App::getLocale() }}">
                        @svg('/img/share.svg', [
                         'width' => '25px',
                         'height' => '25px',
                         'style' => 'opacity: 0.5;',
                        ])
                    </a>
                  </div>
              </div>
            </div>

            {{--<div class="small_big_description">
              <pre class="mb-0 pre_discription discription_cut" style="opacity: 0.7;">{{ $args['localized_description'] }}</pre>
              <a class="more_less">{{ strtolower(trans('main.more')) }}</a>
            </div>--}}
            <div class="d-flex justify-content-between mt-3">

            </div>
        </div>
    </div>
</div>
