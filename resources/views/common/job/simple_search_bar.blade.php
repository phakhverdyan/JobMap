@php
    $job_types = job_types();
@endphp
<form class="d-flex" id="career-page-search-brand">
    <div class="d-flex flex-1 mr-3" style="position: relative;">
        <input class="form-control" name="keywords" type="text" placeholder="{{ __('widget.search') }}" value={{ request()->get('keywords') }}>

        <button type="submit" class="btn border-0" style="margin-left: -15px; background-color: #f4f4f4; border-radius: 15px;">
            <img src="{{ asset ('/img/widget-search.png') }}" alt="Search" style="opacity: 0.3;">
        </button>

    </div>
</form>

