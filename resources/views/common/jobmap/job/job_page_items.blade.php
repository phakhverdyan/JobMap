
<div class="col-12 bg-white mt-4" style="border-radius: 10px;">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="col-12 px-0">

                <div class="title_left_sorting text-left d-flex flex-column flex-lg-row py-3">
                    <div class="d-flex col-12 pl-0 col-lg-4 pxa-0 justify-content-between mb-3 mb-lg-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
                        <input type="text" class="form-control w-100 border-0" style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
                                       placeholder="{!! trans('fields.placeholder.find') !!} {!! getDisplayingTitle($type_items) !!}" id="items-search"
                                       value="{{ $keywords }}">
                        <div class="align-self-center mr-3 mr-lg-0">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 250.313 250.313" style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;" xml:space="preserve" widht="17px" height="17px">
                                <g id="Search">
                                    <path style="fill-rule:evenodd;clip-rule:evenodd;" d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <div class="d-flex ml-auto w-100 justify-content-between justify-content-lg-end flex-md-row flex-column">
                        <div class="d-flex mr-0 pt-1 mb-3 mb-md-0">
                            <span class="pt-2 mr-0">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Capa_1" x="0px" y="0px"
                                     viewBox="0 0 417.138 417.138"
                                     style="height:15px; opacity: 0.8; fill:#184ba2;"
                                     xml:space="preserve">
                                <g>
                                    <g>
                                        <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
                                        <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
                                    </g>
                                </g>
                                </svg>
                            </span>
                            <select class="border-0 form-control form-control-sm bg-white"
                                    id="items-sort" style="box-shadow: none!important; color:#47546b;">
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
                                @elseif($type_items == 'locations')
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
                                @endif
                            </select>
                        </div>
                        <div class="pt-1 mb-3 mb-md-0">
                            <select class="border-0 form-control form-control-sm bg-white" id="items-limit" style="box-shadow: none!important; color:#47546b;">
                                <option @if($limit == 25) selected @endif value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
                                <option @if($limit == 50) selected @endif value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
                                <option @if($limit == 100) selected @endif value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
                                <option @if($limit == 200) selected @endif value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
                            </select>
                        </div>
                        <div class="btn-group pxa-0" role="group" aria-label="Basic example">
                            @if($type_items == 'nearby-jobs')
                                <div class="d-inline-flex">
                                    <button class="btn btn-outline-primary rounded d-flex" type="button"
                                            aria-expanded="false" data-toggle="modal"
                                            data-target="#jobfiltermodal"
                                            id="filters-modal"
                                            style="background-color: #fff; border:1px solid #4E5C6E; color:#4E5C6E;">
                                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Layer_1"
                                             x="0px"
                                             y="0px" viewBox="0 0 511.999 511.999" xml:space="preserve"
                                             height="20px" style="fill:#4E5C6E; vertical-align: middle;">
                                            <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z" style="fill:#4E5C6E;"/>
                                        </svg>
                                        <span>
                                            {!! trans('main.buttons.filters') !!}
                                        </span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row text-left" id="items-list">
                    @foreach($items->items as $item)
                        {!! $item->html_career !!}
                    @endforeach
                </div>
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
