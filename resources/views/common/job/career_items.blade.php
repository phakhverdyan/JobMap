<div class="col-12 bg-white mt-4" style="border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-12 px-0">
                @if($type_items != 'description')
                    <div class="title_left_sorting text-left py-3">
                        @if (isset($show_searchbar) && $show_searchbar)
                            @if (isset($without_filters) && $without_filters)
                                @include('common.job.simple_search_bar')
                            @else
                                @include('common.job.job_search_bar')
                            @endif
                        @endif
                    </div>

                    <div class="row text-left" id="items-list">
                        @if($items !== null)
                            @forelse ($items->items as $item)
                                @if (isset($item->html_career) && $item->html_career)
                                    {!! $item->html_career !!}
                                @elseif (isset($item->html_career_ubis) && $item->html_career_ubis)
                                    {!! $item->html_career_ubis !!}
                                @endif
                            @empty
                                <p class="m-3">{!! trans('main.business.jobs.not_found') !!}</p>
                            @endforelse
                        @else
                            <p class="m-3">{!! trans('main.business.jobs.not_found') !!}</p>
                        @endif

                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@if($items !== null && $items->pages > 1)
    <div class="col-12 mt-2 px-0">
        <div class="py-2">
            <ul class="pagination justify-content-center mb-0" id="items-pagination">
                <?php
                    $active = '';
                    $inactive = '';
                    if ($current_page == 1) {
                        $active = 'active';
                        $inactive = 'inactive';
                    }
                ?>
                <li class="page-item {!! $inactive !!}"><a class="page-link" href="{!! !$inactive ? request()->fullUrlWithQuery(['page' => $current_page - 1]) : 'javascript:;' !!}">{!! trans('main.buttons.previous') !!}</a></li>
                <li class="page-item {!! $active !!}"><a class="page-link" href="{!! !$active ? request()->fullUrlWithQuery(['page' => 1]) : 'javascript:;' !!}">1</a></li>
                @if ($items->pages < 8 )
                    @for($i = 2; $i < $items->pages; $i++)
                        <?php
                            $active = '';
                            if ($current_page == $i) {
                                $active = 'active';
                            }
                        ?>
                        <li class="page-item {!! $active !!}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $i]) !!}">{{ $i }}</a></li>
                    @endfor
                @else
                    @if ($current_page > 4)
                        <li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>
                        @if ($current_page > $items->pages -4)
                            @for($i =  $items->pages -4; $i < $items->pages; $i++)
                                <?php
                                    $active = '';
                                    if ($current_page == $i) {
                                        $active = 'active';
                                    }
                                ?>
                                <li class="page-item {!! $active !!}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $i]) !!}">{{ $i }}</a></li>
                            @endfor
                        @else
                            <li class="page-item"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $current_page-1]) !!}">{{ $current_page-1 }}</a></li>
                            <li class="page-item active"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $current_page]) !!}">{{ $current_page }}</a></li>
                            <li class="page-item"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $current_page+1]) !!}">{{ $current_page+1 }}</a></li>
                            <li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>
                        @endif
                    @else
                        @for($i = 2; $i < 6; $i++)
                            <?php
                                $active = '';
                                if ($current_page == $i) {
                                    $active = 'active';
                                }
                            ?>
                            <li class="page-item {!! $active !!}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $i]) !!}">{{ $i }}</a></li>
                        @endfor
                        <li class="page-item inactive"><a class="page-link" href="javascript:;">...</a></li>
                    @endif
                @endif
                <?php
                    $active = '';
                    $inactive = '';
                    if ($current_page == $items->pages) {
                        $active = 'active';
                        $inactive = 'inactive';
                    }
                ?>
                <li class="page-item {!! $active !!}"><a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $items->pages]) !!}">{{ $items->pages }}</a></li>
                <li class="page-item {!! $inactive !!}"><a class="page-link" href="{!! !$inactive ? request()->fullUrlWithQuery(['page' => $current_page + 1]) : 'javascript:;' !!}">{!! trans('main.buttons.next') !!}</a></li>

                {{--<li class="page-item">
                    <a class="page-link" href="{!! $current_page != 1 ? request()->fullUrlWithQuery(['page' => $current_page - 1]) : 'javascript:;' !!}">{!! trans('main.buttons.previous') !!}</a>
                </li>
                <li class="page-item {!! $current_page == 1 ? 'active' : '' !!}">
                    <a class="page-link" href="{!! $current_page != 1 ? request()->fullUrlWithQuery(['page' => 1]) : 'javascript:;' !!}">{{ 1 }}</a>
                </li>
                @for($i = 2; $i < $items->pages; ++$i)
                    <li class="page-item {!! $current_page == $i ? 'active' : '' !!}">
                        <a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $i]) !!}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {!! $current_page == $items->pages ? 'active' : '' !!}">
                    <a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $items->pages]) !!}">{{ $items->pages }}</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="{!! $current_page !== $items->pages ? request()->fullUrlWithQuery(['page' => $current_page + 1]) : 'javascript:;' !!}">{!! trans('main.buttons.next') !!}</a>
                </li>--}}
                {{--<li class="page-item">
                    <a class="page-link" href="{!! request()->fullUrlWithQuery(['page' => $items->pages]) !!}">{!! trans('main.buttons.last') !!}</a>
                </li>--}}
            </ul>
        </div>
    </div>
@endif
