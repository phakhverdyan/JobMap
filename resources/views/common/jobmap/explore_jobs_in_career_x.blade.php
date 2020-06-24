@extends('layouts.jobmap.common_user')

@section('content')

<style type="text/css">
    .alphabet_link{
        font-size: 28px;
        margin: 0 7px;
    }
</style>
<div class="container-fluid mt-3 user-landing">
    <div class="row">
        <div class="container py-5">
            <div class="col-12">
                <p class="title_left_sorting d-flex animated fadeInDown" style="font-size: 24px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; width: 30px; height: 30px; vertical-align: middle; margin-top: 1px; fill:#4E5C6E;" class="mr-2" xml:space="preserve">
                        <g>
                            <g>
                                <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"></path>
                            </g>
                        </g>
                    </svg>
                    <strong>E{!! trans('main.explore_jobs_in', ['item' => $categoryData['name']]) !!}</strong>
                    <span class="ml-auto">
                        <a href="{!! url('/explore-jobs') !!}" class="btn btn-outline-primary seeall_btn" role="button">{!! trans('main.buttons.back_to_all_categories') !!}</a>
                    </span>
                </p>

                <div class="col-12 px-0" style="margin-top: 30px;">
                    <p class="title_left_sorting">
                        <strong>{!! trans('main.buttons.all') !!} {{ $categoryData['name'] }}</strong>

                    </p>
                    <?php
                    $i = 0;
                    $j = 0;
                    foreach ($categories as $l) {
                    ++$j;
                    if ($i == 0) {
                    ?>
                    <div class="row @if($j != 1) mt-3 @endif">
                        <?php
                        }
                        ?>
                            <div class="col-3">
                                <p><a href="/search/jobs?title={{ $l['name'] }}" class="cardinal_links" style="font-size: 17px;">{{ $l['name'] }}</a></p>
                            </div>
                        <?php
                        ++$i;
                        if ($i == 4 || ($i != 4 && $j == count($categories))) {
                        $i = 0;
                        ?>
                    </div>
                    <?php
                    }
                    }
                    ?>
                    {{--<div class="row">--}}
                        {{--<div class="col-3">--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                        {{--</div>--}}
                        {{--<div class="col-3">--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                        {{--</div>--}}
                        {{--<div class="col-3">--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                        {{--</div>--}}
                        {{--<div class="col-3">--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                            {{--<p><a href="#" class="cardinal_links" style="font-size: 17px;">Accountant Jobs</a></p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                </div>

            </div>
        </div>
    </div>
</div>


@endsection
