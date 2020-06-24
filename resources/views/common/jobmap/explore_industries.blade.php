@extends('layouts.jobmap.common_user')

@section('content')

    <style type="text/css">
        .alphabet_link {
            font-size: 28px;
            margin: 0 7px;
        }
    </style>
    <div class="container-fluid mt-3 user-landing">
        <div class="row">
            <div class="container py-5">
                <div class="col-12">
                    <p class="title_left_sorting d-flex animated fadeInDown" style="font-size: 24px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             viewBox="0 0 490 490" enable-background="new 0 0 490 490"
                             style="enable-background:new 0 0 512 512; width: 30px; height: 30px; vertical-align: middle; fill:#4E5C6E;"
                             class="mr-2">
                            <g>
                                <g>
                                    <path d="m488.8,487.8v-253.3l-86.5,88.6v-88.6l-86.5,88.6v-88.6l-91.7,94.9-10.4-212.6h-76.1l-10.4,216.8h-24l-10.4-216.8h-75.1l-17.7,371.1h490v-0.1l-1.2,0zm-18.7-20.8h-448.2l15.7-329.4h36.5l10.4,216.8h65.7l10.4-216.8h35.4l10.4,216.9h24l66.7-68.8v68.8h19.8l66.7-68.8v68.8h19.8l66.7-68.8v181.3z"/>
                                    <rect width="33.4" x="415.9" y="375.3" height="20.8"/>
                                    <rect width="33.4" x="328.4" y="375.3" height="20.8"/>
                                    <rect width="33.4" x="240.8" y="375.3" height="20.8"/>
                                    <polygon
                                            points="186.6,50.1 214.8,15.7 199.1,2.1 165.8,42.8 165.8,101.2 186.6,101.2   "/>
                                    <polygon points="59.5,50.1 88.6,15.7 72,2.1 38.6,42.8 38.6,101.2 59.5,101.2   "/>
                                </g>
                            </g>
                        </svg>
                        <strong>{!! trans('main.explore_industries') !!}</strong>
                    </p>

                    <div class="col-12 text-center">
                        <p class="title_left_sorting d-flex justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 485.5 485.5"
                                 style="enable-background:new 0 0 485.5 485.5; width: 20px; height: 20px; fill:#4E5C6E;"
                                 xml:space="preserve" class="mr-2">
                        <g>
                            <g>
                                <path d="M422.1,126.2H126.4c-27.4,0-49.8-22.3-49.8-49.8c0-27.4,22.3-49.8,49.8-49.8h295.8c7.4,0,13.3-6,13.3-13.3    c0-7.4-6-13.3-13.3-13.3H126.4C84.3,0,50,34.3,50,76.4v332.7c0,42.1,34.3,76.4,76.4,76.4h295.8c7.4,0,13.3-6,13.3-13.3V139.5    C435.4,132.2,429.5,126.2,422.1,126.2z M408.8,458.9H126.4c-27.4,0-49.8-22.3-49.8-49.8V134.4c13.4,11.5,30.8,18.5,49.8,18.5    h282.4L408.8,458.9L408.8,458.9z"/>
                                <path d="M130.6,64.3c-7.4,0-13.3,6-13.3,13.3s6,13.3,13.3,13.3h249.8c7.4,0,13.3-6,13.3-13.3s-6-13.3-13.3-13.3H130.6z"/>
                                <path d="M177.4,400.7c1.5,0.5,3,0.8,4.5,0.8c5.5,0,10.6-3.4,12.5-8.8l16.2-45.3H273c0.5,0,1.1,0,1.6-0.1l16.2,45.4    c1.9,5.4,7.1,8.8,12.5,8.8c1.5,0,3-0.3,4.5-0.8c6.9-2.5,10.5-10.1,8-17l-60.6-169.9l0,0c-0.1-0.4-0.3-0.8-0.5-1.2    c-0.1-0.2-0.2-0.4-0.3-0.6c-0.1-0.2-0.2-0.4-0.3-0.6c-0.1-0.2-0.3-0.4-0.4-0.7c-0.1-0.1-0.2-0.3-0.3-0.4c-0.1-0.2-0.3-0.4-0.5-0.6    c-0.1-0.1-0.2-0.3-0.4-0.4c-0.1-0.2-0.3-0.3-0.5-0.5s-0.3-0.3-0.5-0.5c-0.1-0.1-0.3-0.2-0.4-0.4c-0.2-0.2-0.4-0.3-0.6-0.5    c-0.1-0.1-0.3-0.2-0.4-0.3c-0.2-0.1-0.4-0.3-0.6-0.4c-0.2-0.1-0.4-0.2-0.6-0.3s-0.4-0.2-0.6-0.3c-0.4-0.2-0.8-0.4-1.2-0.5l0,0H247    c-0.4-0.1-0.8-0.2-1.2-0.3c-0.2,0-0.3-0.1-0.5-0.1c-0.3-0.1-0.5-0.1-0.8-0.2c-0.2,0-0.4,0-0.6-0.1c-0.2,0-0.5-0.1-0.7-0.1    s-0.4,0-0.6,0c-0.2,0-0.4,0-0.7,0c-0.2,0-0.5,0-0.7,0.1c-0.2,0-0.4,0-0.6,0.1c-0.3,0-0.5,0.1-0.8,0.2c-0.2,0-0.3,0.1-0.5,0.1    c-0.4,0.1-0.8,0.2-1.1,0.3h-0.1l0,0c-0.4,0.1-0.8,0.3-1.2,0.5c-0.2,0.1-0.4,0.2-0.6,0.3c-0.2,0.1-0.4,0.2-0.6,0.3    c-0.2,0.1-0.4,0.3-0.7,0.4c-0.1,0.1-0.3,0.2-0.4,0.3c-0.2,0.2-0.4,0.3-0.6,0.5c-0.1,0.1-0.3,0.2-0.4,0.4c-0.2,0.2-0.3,0.3-0.5,0.5    s-0.3,0.3-0.5,0.5c-0.1,0.1-0.2,0.3-0.4,0.4c-0.2,0.2-0.3,0.4-0.5,0.6c-0.1,0.1-0.2,0.3-0.3,0.4c-0.1,0.2-0.3,0.4-0.4,0.6    c-0.1,0.2-0.2,0.4-0.3,0.6c-0.1,0.2-0.2,0.4-0.3,0.6c-0.2,0.4-0.4,0.8-0.5,1.2l0,0l-60.8,169.9    C166.9,390.6,170.5,398.2,177.4,400.7z M242.7,257.8l22.5,63h-45.1L242.7,257.8z"/>
                            </g>
                        </g>
                        </svg>
                            <strong>{!! trans('main.directory') !!}</strong>
                        </p>
                        <p>
                            @foreach($letters as $letter)
                                <a href="{!! url('/explore-industries-in-letter') !!}/{!! $letter !!}"
                                   class="cardinal_links alphabet_link">{!! $letter !!}</a>
                            @endforeach
                        </p>
                    </div>

                    <div class="col-12 px-0" style="margin-top: 70px;">
                        <p class="title_left_sorting">
                            <strong>{!! trans('main.label.all_industries') !!}</strong>
                        </p>

                        <?php
                        $i = 0;
                        $j = 0;
                        foreach ($all as $l) {
                        ++$j;
                        if ($i == 0) {
                        ?>
                        <div class="row @if($j != 1) mt-3 @endif">
                            <?php
                            }
                            ?>
                            <div class="col-lg-3 col-12 col-md-6">
                                <p><a href="/search/jobs?popular_industries={!! $l['id'] !!}" class="cardinal_links"
                                      style="font-size: 17px;">{{ $l['name'] }}</a></p>
                            </div>
                            <?php
                            ++$i;
                            if ($i == 4 || ($i != 4 && $j == count($all))) {
                            $i = 0;
                            ?>
                        </div>
                        <?php
                        }
                        }
                        ?>

                    </div>
                    {!! $all->links() !!}
                </div>
            </div>
        </div>
    </div>


@endsection
