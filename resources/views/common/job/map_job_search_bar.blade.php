@php
    $jobTypes = job_types();
    $resultTypeRequest = request()->get('result_type');
@endphp
<form class="d-flex">

    <div class="d-flex justify-content-between flex-lg-row flex-column col-10 px-0 mx-auto pt-5" id="map-filters-search-bar" style="display: none !important;">
        <div class="align-self-center d-flex flex-lg-row flex-column">
            {{-- <select class="form-control" name="result_type" style="width: 180px;">
                <option value="">{{ __('widget.statuses.result_type') }}</option>
                <option value="job" {{ request()->get('result_type') == 'job' ? 'selected="selected"' : '' }}>{{ __('widget.result_types.job') }}</option>
                <option value="business" {{ request()->get('result_type') == 'business' ? 'selected="selected"' : '' }}>{{ __('widget.result_types.business') }}</option>
                <option value="location" {{ request()->get('result_type') == 'location' ? 'selected="selected"' : '' }}>{{ __('widget.result_types.location') }}</option>
            </select> --}}
            <div class="search-tabs" id="result-type-tabs">
                <div class="tab-item {{ ($resultTypeRequest == 'job' || $resultTypeRequest == '') ? 'active' : '' }}" data-type="job">
                    Jobs
                </div>
                <div class="tab-item {{ $resultTypeRequest == 'business' ? 'active' : '' }}" data-type="business">
                    Businesses
                </div>
                <div class="tab-item {{ $resultTypeRequest == 'location' ? 'active' : '' }}" data-type="location">
                    Locations
                </div>
            </div>
        </div>
        <div class="align-self-center mt-0 mt-lg-0">

            <div class="d-flex flex-1 mr-0 pb-1" style="position: relative;">

                <div class="d-flex ml-2">

                    <select class="form-control" name="status" style="width: 120px;">
                        <option value="">{{ __('widget.statuses.all_vacancies') }}</option>
                        <option value="open" {{ request()->get('status') == 'open' ? 'selected="selected"' : '' }}>{{ __('widget.statuses.open') }}</option>
                        <option value="closed" {{ request()->get('status') == 'closed' ? 'selected="selected"' : '' }}>{{ __('widget.statuses.closed') }}</option>
                    </select>

                    <select class="form-control mx-2" name="type" style="width: 120px;">
                        <option value="">{{ __('widget.employment_types.all_types') }}</option>
                        @foreach ($jobTypes as $jobType)
                            <option value="{{ $jobType->key }}"
                            @if ($jobType->key == request()->get('type'))
                                selected="selected"
                            @endif
                            >{{ $jobType->localized_name }}</option>
                        @endforeach
                    </select>

                    <select class="form-control" name="sort" style="width: 120px;">
                        <option value="newest" {{ request()->get('sort') == 'newest' ? 'selected="selected"' : '' }}>{{ __('widget.orders.newest') }}</option>
                        <option value="oldest" {{ request()->get('sort') == 'oldest' ? 'selected="selected"' : '' }}>{{ __('widget.orders.oldest') }}</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

</form>

@push('css')
    {{-- expr --}}
@endpush
