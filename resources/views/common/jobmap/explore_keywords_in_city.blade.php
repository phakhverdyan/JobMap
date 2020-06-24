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
                    <div class="title_left_sorting d-flex flex-column-reverse flex-lg-row animated fadeInDown">
                        <div class="title_left_sorting" style="font-size: 24px;">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1"
                                 id="Capa_1" x="0px" y="0px" viewBox="0 0 465.8 465.8"
                                 style="enable-background:new 0 0 512 512; width: 30px; height: 30px; vertical-align: middle; fill:#4E5C6E;"
                                 xml:space="preserve" class="mr-2">
                            <g>
                                <g>
                                    <path d="M175.2,111.1l50.5,37.3c2.1,1.6,4.6,2.3,7.1,2.3c2.5,0,5-0.8,7.1-2.3l50.5-37.3c3.1-2.3,4.9-5.8,4.9-9.7V36.8    c0-6.6-5.4-12-12-12H182.4c-6.6,0-12,5.4-12,12v64.6C170.4,105.2,172.2,108.8,175.2,111.1z M194.4,48.8h77.1v46.5l-38.6,28.5    l-38.5-28.4V48.8z"/>
                                    <path d="M415.6,75.8h-89.5c-6.6,0-12,5.4-12,12s5.4,12,12,12h89.5c14.5,0,26.2,11.8,26.2,26.2v264.8c0,14.5-11.8,26.2-26.2,26.2    H50.2C35.7,417,24,405.2,24,390.8V126c0-14.5,11.8-26.2,26.2-26.2h89.4c6.6,0,12-5.4,12-12s-5.4-12-12-12H50.2    C22.5,75.8,0,98.3,0,126v264.8C0,418.5,22.5,441,50.2,441h365.4c27.7,0,50.2-22.5,50.2-50.2V126C465.8,98.3,443.3,75.8,415.6,75.8    z"/>
                                    <path d="M86.9,201.5c0,23.1,18.8,41.9,41.9,41.9s41.9-18.8,41.9-41.9s-18.8-41.9-41.9-41.9S86.9,178.4,86.9,201.5z M146.7,201.5    c0,9.9-8,17.9-17.9,17.9s-17.9-8-17.9-17.9s8-17.9,17.9-17.9C138.7,183.6,146.7,191.6,146.7,201.5z"/>
                                    <path d="M128.8,252c-23.7,0-42.9,11-55.5,31.8c-9.1,15-14.8,35.3-17.1,60.3c-0.6,6.6,4.3,12.4,10.9,13c6.6,0.6,12.4-4.3,13-10.9    c4.3-46.6,20.7-70.2,48.7-70.2s44.4,23.6,48.7,70.2c0.6,6.2,5.8,10.9,11.9,10.9c0.4,0,0.7,0,1.1-0.1c6.6-0.6,11.5-6.4,10.9-13    c-2.3-25-8.1-45.2-17.1-60.3C171.7,263,152.5,252,128.8,252z"/>
                                    <path d="M381.3,182h-134c-6.6,0-12,5.4-12,12s5.4,12,12,12h134c6.6,0,12-5.4,12-12S387.9,182,381.3,182z"/>
                                    <path d="M393.3,279.9c0-6.6-5.4-12-12-12h-134c-6.6,0-12,5.4-12,12s5.4,12,12,12h134C387.9,291.9,393.3,286.6,393.3,279.9z"/>
                                    <path d="M247.3,310.7c-6.6,0-12,5.4-12,12s5.4,12,12,12h67c6.6,0,12-5.4,12-12s-5.4-12-12-12H247.3z"/>
                                    <path d="M381.3,224.8h-134c-6.6,0-12,5.4-12,12s5.4,12,12,12h134c6.6,0,12-5.4,12-12S387.9,224.8,381.3,224.8z"/>
                                </g>
                            </g>
                            </svg>
                            <strong>{!! trans('main.explore_keywords_in', ['item' => $city . ', ' . $country]) !!}</strong>
                        </div>
                        <span class="ml-auto mxa-0">
                            <a href="{!! url('/popular/' . $country) !!}" class="btn btn-outline-primary seeall_btn"
                               role="button">{!! trans('main.buttons.back_to_keywords_in', ['item' => $country]) !!}</a>
                        </span>
                    </div>

                    <div class="col-12 px-0" style="margin-top: 70px;">
                        <p class="title_left_sorting">
                            <strong>{!! trans('main.label.all_keywords_in', ['item' => $city . ', ' . $country]) !!} </strong>
                        </p>
                        <?php
                        $i = 0;
                        $j = 0;
                        foreach ($keywords as $l) {
                        ++$j;
                        if ($i == 0) {
                        ?>
                        <div class="row @if($j != 1) mt-3 @endif">
                            <?php
                            }
                            ?>
                            <div class="col-lg-3 col-12 col-md-6">
                                <p><a href="/search/jobs?a_keywords={!! $l->id !!}&location={{ $city . ', ' . $country }}" class="cardinal_links"
                                      style="font-size: 17px;">{{ $l->name }}</a></p>
                            </div>
                            <?php
                            ++$i;
                            if ($i == 4 || ($i != 4 && $j == count($keywords))) {
                            $i = 0;
                            ?>
                        </div>
                        <?php
                        }
                        }
                        ?>

                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
