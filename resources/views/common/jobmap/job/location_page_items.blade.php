<div class="col-12 bg-white mt-2 mb-4" style="border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-12 px-0">
                @include('common.job.career_items', [ 'items' => $items, 'show_searchbar' => true, 'type_items' => 'job' ])
            </div>
        </div>
    </div>
</div>
@if($items->pages > 1)
    <div class="col-12 mt-2 px-0">
        <div class="py-2">
            <ul class="pagination justify-content-center mb-0" id="items-pagination">
                <li class="page-item"><a class="page-link"
                                         href="@if($current_page !== 1) {!! request()->fullUrlWithQuery(['page' => $current_page - 1]) !!} @endif">{!! trans('main.buttons.previous') !!}</a>
                </li>
                @for($i = 1; $i <= $items->pages; ++$i)
                    <li class="page-item @if($current_page == $i) active @endif"><a class="page-link"
                                                                                    href="{!! request()->fullUrlWithQuery(['page' => $i]) !!}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item"><a class="page-link"
                                         href="@if($current_page !== $items->pages) {!! request()->fullUrlWithQuery(['page' => $current_page + 1]) !!} @endif">{!! trans('main.buttons.next') !!}</a>
                </li>
                <li class="page-item"><a class="page-link"
                                         href="{!! request()->fullUrlWithQuery(['page' => $items->pages]) !!}">{!! trans('main.buttons.last') !!}</a>
                </li>
            </ul>
        </div>
    </div>
@endif
