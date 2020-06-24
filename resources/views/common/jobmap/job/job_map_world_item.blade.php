<div class="col-12">
    <div class="text-left d-flex flex-column flex-lg-row">
        <a href="?type=employers"
           class="cardinal_links">{!! trans_choice('main.counters.c_employers', $data->count_employers, ['count' => $data->count_employers]) !!}</a>
        <a href="?type=jobs"
           class="cardinal_links ml-4 mxa-0">{!! trans_choice('main.counters.c_jobs', $data->count_jobs, ['count' => $data->count_jobs]) !!}</a>
        <a href="?type=headquarters"
           class="cardinal_links ml-4 mxa-0">{!! trans_choice('main.counters.c_headquarters', $data->count_headquarters, ['count' => $data->count_headquarters]) !!}</a>
        <a href="?type=locations"
           class="cardinal_links ml-4 mxa-0">{!! trans_choice('main.counters.c_branches', $data->count_locations, ['count' => $data->count_locations]) !!}</a>
        <a href="?type=keywords"
           class="cardinal_links ml-4 mxa-0">{!! trans_choice('main.counters.c_keywords', $data->count_keywords, ['count' => $data->count_jobs]) !!}</a>
    </div>
</div>

<div class="col-12 mt-3 bg-white rounded">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-12 pt-3 pb-2 px-0">
                <div class="title_left_sorting text-left d-flex flex-column flex-lg-row">
                    <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                        <input type="text" class="form-control border-0 ml-2" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
                               placeholder="{!! trans('fields.placeholder.find') !!} {{ getDisplayingTitle($type_items) }}"  id="items-search" value="{{ $keywords }}">
                        <div class="align-self-center mr-3 mr-lg-0">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                <g id="Search">
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                    
                    <div class="d-flex ml-auto">
                        <div class="d-flex mr-0 pt-1">
                            <span class="pt-2 mr-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px"
                                     viewBox="0 0 417.138 417.138"
                                     style="height:15px; opacity: 0.8;"
                                     xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
                                        <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
                                    </g>
                                </g>
                                </svg>
                            </span>
                            <select class="border-0 bg-white form-control form-control-sm"
                                    id="items-sort">
                                @if($type_items == 'jobs')
                                    <option @if($sort == 'title' && $order == 'asc') selected @endif value="title"
                                            data-order="asc">{!! trans('main.sort.title_az') !!}
                                    </option>
                                    <option @if($sort == 'title' && $order == 'desc') selected @endif value="title"
                                            data-order="desc">{!! trans('main.sort.title_za') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'asc') selected
                                            @endif value="created_date"
                                            data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'desc') selected
                                            @endif value="created_date"
                                            data-order="desc">{!! trans('main.sort.c_date_newest') !!}
                                    </option>
                                @elseif($type_items == 'locations' || $type_items == 'headquarters')
                                    <option @if($sort == 'name' && $order == 'asc') selected @endif value="name"
                                            data-order="asc">{!! trans('main.sort.name_az') !!}
                                    </option>
                                    <option @if($sort == 'name' && $order == 'desc') selected @endif value="name"
                                            data-order="desc">{!! trans('main.sort.name_za') !!}
                                    </option>
                                    <option @if($sort == 'street' && $order == 'asc') selected @endif value="street"
                                            data-order="asc">{!! trans('main.sort.street_az') !!}
                                    </option>
                                    <option @if($sort == 'street' && $order == 'desc') selected @endif value="street"
                                            data-order="desc">{!! trans('main.sort.street_za') !!}
                                    </option>
                                    <option @if($sort == 'city' && $order == 'asc') selected @endif value="city"
                                            data-order="asc">{!! trans('main.sort.city_az') !!}
                                    </option>
                                    <option @if($sort == 'city' && $order == 'desc') selected @endif value="city"
                                            data-order="desc">{!! trans('main.sort.city_za') !!}
                                    </option>
                                    <option @if($sort == 'country' && $order == 'asc') selected @endif value="country"
                                            data-order="asc">{!! trans('main.sort.country_az') !!}
                                    </option>
                                    <option @if($sort == 'country' && $order == 'desc') selected @endif value="country"
                                            data-order="desc">{!! trans('main.sort.country_za') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'asc') selected
                                            @endif value="created_date"
                                            data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'desc') selected
                                            @endif value="created_date"
                                            data-order="desc">{!! trans('main.sort.c_date_newest') !!}
                                    </option>
                                @elseif($type_items == 'keywords')
                                    <option @if($sort == 'name' && $order == 'asc') selected @endif value="name"
                                            data-order="asc">{!! trans('main.sort.name_az') !!}
                                    </option>
                                    <option @if($sort == 'name' && $order == 'desc') selected @endif value="name"
                                            data-order="desc">{!! trans('main.sort.name_za') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'asc') selected
                                            @endif value="created_date"
                                            data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'desc') selected
                                            @endif value="created_date"
                                            data-order="desc">{!! trans('main.sort.c_date_newest') !!}
                                    </option>
                                @else
                                    <option @if($sort == 'name' && $order == 'asc') selected @endif value="name"
                                            data-order="asc">{!! trans('main.sort.name_az') !!}
                                    </option>
                                    <option @if($sort == 'name' && $order == 'desc') selected @endif value="name"
                                            data-order="desc">{!! trans('main.sort.name_za') !!}
                                    </option>
                                    <option @if($sort == 'street' && $order == 'asc') selected @endif value="street"
                                            data-order="asc">{!! trans('main.sort.street_az') !!}
                                    </option>
                                    <option @if($sort == 'street' && $order == 'desc') selected @endif value="street"
                                            data-order="desc">{!! trans('main.sort.street_za') !!}
                                    </option>
                                    <option @if($sort == 'city' && $order == 'asc') selected @endif value="city"
                                            data-order="asc">{!! trans('main.sort.city_az') !!}
                                    </option>
                                    <option @if($sort == 'city' && $order == 'desc') selected @endif value="city"
                                            data-order="desc">{!! trans('main.sort.city_za') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'asc') selected
                                            @endif value="created_date"
                                            data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
                                    </option>
                                    <option @if($sort == 'created_date' && $order == 'desc') selected
                                            @endif value="created_date"
                                            data-order="desc">{!! trans('main.sort.c_date_newest') !!}
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="pt-1 mr-2" id="page-limit-headquarters">
                            <select class="border-0 bg-white form-control form-control-sm"
                                    id="items-limit">
                                <option @if($limit == 25) selected
                                        @endif value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
                                <option @if($limit == 50) selected
                                        @endif value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
                                <option @if($limit == 100) selected
                                        @endif value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
                                <option @if($limit == 200) selected
                                        @endif value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 px-0 text-left mb-3">
                    <p class="title_left_sorting text-left pt-3" id="items-display">
                        <strong>{!! trans('main.label.displaying', [
                        'item' => getDisplayingTitle($type_items),
                        'start' => $start,
                        'end' => $end,
                        'count' => ($items->count) ?? 0
                        ]) !!}</strong></p>
                </div>
                <div class="row text-left flex-column flex-lg-row px-3" id="items-list">
                    @php
                        $i = 0;
                        $j = 0;
                        $count = count($items->items);
                    @endphp
                    @foreach($items->items as $item)
                        @if($type_items != 'keywords')
                            @php
                                $picture = ($item->picture_50) ?? $item->business->picture_50;
                                $name = (isset($item->title)) ? $item->category_name . ' ' .$item->title : $item->name;
                                $slug = ($type_items != 'jobs') ? str_slug($name) : '';
                                $params = $item->id . '/' . $slug;
                                $url = $link . $params;
                                $class = '';
                                if($type_items == 'jobs'){
                                    if(count($item->assign_locations) > 1){
                                        $url = 'javascript:void(0)';
                                        $class = 'job-locations';
                                    } else {
                                        $url = $link . $item->assign_locations[0]->job_id;
                                    }
                                }
                            @endphp
                        @else
                            @php
                                $name = $item->name;
                                $class = '';
                                $url = $link . '?a_keywords=' . $item->id;
                            @endphp
                        @endif
                        @if($i == 0)
                            <div class="col-12 col-lg-4 pxa-0">
                                @endif
                                <div style="position: relative;">
                                    <p>
                                        <a href="{{ $url }}" class="breadcrumb_custom {!! $class !!}"
                                           target="_blank">@if($type_items != 'keywords')<img
                                                    src="{{ $picture }}"
                                                    class="mr-2"
                                                    style="width: 20px; height: 20px; margin-top: -3px; border-radius: 3px;">@endif{{ trim($name) }}
                                        </a>
                                    </p>
                                    @if($type_items == 'jobs')
                                        <div class="bg-white p-2 rounded border job-locations-view"
                                             style="position: absolute; top: 20px; right: 0; width: 230px; display: none; z-index: 222; box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); max-height: 265px; overflow: auto;">
                                            <p class="mb-0">
                                                <strong>{!! trans_choice('main.label.available_in_locations', count($item->assign_locations), ['count' => count($item->assign_locations)]) !!}</strong>
                                            </p>
                                            @foreach($item->assign_locations as $assign)
                                                <div class="mb-0 mt-2">
                                                    <a href="{{ $link . $assign->job_id }}"
                                                       class="breadcrumb_custom mt-2 w-100 d-flex" target="_blank">
                                                        <img src="{{ $picture }}" class="mr-2"
                                                             style="width: 20px; height: 20px; border-radius: 3px;">
                                                        <div>
                                                            {{ $assign->name }}
                                                            <p class="mb-0 text-muted" style="font-size: 12px;">
                                                                {{ $assign->street . ' ' . $assign->street_number }}
                                                                , {{ $assign->city }}, {{ $assign->country }}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                                @php
                                    ++$i;
                                    ++$j;
                                @endphp
                                @if($i == 3 || ($i !=3 && $j == $count))
                                    @php
                                        $i = 0;
                                    @endphp
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@if($items->pages > 1)
    <div class="col-12 px-0">
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

