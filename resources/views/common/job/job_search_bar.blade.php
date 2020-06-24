@php
    $job_types = job_types();
@endphp
<form class="d-flex" id="career-page-search-brand">
    <div class="d-flex flex-column flex-1 mr-3" style="position: relative;">
        <div class="d-flex mb-3">
            <input class="form-control" name="keywords" type="text" placeholder="{{ __('widget.search') }}" value={{ request()->get('keywords') }}>

            <button type="submit" class="btn border-0" style="margin-left: -15px; background-color: #f4f4f4; border-radius: 15px;">
                <img src="{{ asset ('/img/widget-search.png') }}" alt="Search" style="opacity: 0.3;">
            </button>
        </div>


        <div class="d-flex mb-3">

            <select class="form-control" name="status">
                <option value="">{{ __('widget.statuses.all_vacancies') }}</option>
                <option value="open" {{ request()->get('status') == 'open' ? 'selected="selected"' : '' }}>{{ __('widget.statuses.open') }}</option>
                <option value="closed" {{ request()->get('status') == 'closed' ? 'selected="selected"' : '' }}>{{ __('widget.statuses.closed') }}</option>
            </select>

            <select class="form-control mx-2" name="type">
                <option value="">{{ __('widget.employment_types.all_types') }}</option>
                @foreach ($job_types as $job_type)
                    <option value="{{ $job_type->key }}"
                    @if ($job_type->key == request()->get('type'))
                        selected="selected"
                    @endif
                    >{{ $job_type->localized_name }}</option>
                @endforeach
            </select>

            <select class="form-control" name="sort">
                <option value="newest" {{ request()->get('sort') == 'newest' ? 'selected="selected"' : '' }}>{{ __('widget.orders.newest') }}</option>
                <option value="oldest" {{ request()->get('sort') == 'oldest' ? 'selected="selected"' : '' }}>{{ __('widget.orders.oldest') }}</option>
            </select>

        </div>
    </div>
</form>

