<div class="d-flex flex-lg-row flex-column justify-content-between mb-3 px-lg-0" id="widget-{{ $args['id'] }}">
    <div class="d-flex align-self-center mr-3 pl-lg-0">
        <div class="mr-2 align-self-center">
            <img class="rounded brand-logo-{{ $brand['id'] or '' }}" src="{{ asset('img/business-logo-small.png') }}" style="width: 35px; height: 35px;">
        </div>
        <div class="align-self-center mr-2">
            <p class="h6 mb-0">{{ $brand['name'] or '-' }}</p>
        </div>
        <div class="align-self-center flex-1"></div>
    </div>
    <div class="btn-group row flex-1 px-3 align-self-center" role="group" aria-label="Large button group">
        <div class="btn-group flex-1" type="group">
            <textarea type="text" name="" id="websiteWidgetCode{{ $args['id'] }}" class="form-control rounded-left" value="code" style="border-top-right-radius: 0px; border-bottom-right-radius: 0px; resize: none; overflow: auto;" readonly>{{ htmlspecialchars('' .
                '<div class="jm-w" style="position: relative; min-height: 200px; width: 100%;">' . "\n" .
                    "\t" . '<div class="jm-w__loader" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">' . "\n" .
                        "\t\t" . '<img src="' . asset('/img/widget_loading.gif') . '">' . "\n" .
                    "\t" . '</div>' . "\n" .
                    "\t" . '<' . 'script async src="' . url('/widget.' . $args['id'] . '.js') . '"></' . 'script' . '>' . "\n" .
                '</div>' .
            '') }}</textarea>
            <button class="btn btn-outline-primary js-copy_code" data-code-id="#websiteWidgetCode{{ $args['id'] }}">{!! trans('main.buttons.copy_btn') !!}</button>
        </div>
        <a href="{{ url('/widget/' . $args['id'] . '/preview') }}" target="_blank" class="btn btn-outline-primary js-preview-button" style="line-height: 3em;">
            {!! trans('main.buttons.preview') !!}
        </a>
        <button type="button" data-id="{{ $args['id'] }}" class="btn btn-outline-primary js-edit-button">
            {!! trans('main.buttons.edit') !!}
        </button>
        <button type="button" data-id="{{ $args['id'] }}" class="btn btn-outline-primary js-delete-button">
            {!! trans('main.buttons.delete') !!}
        </button>
    </div>
</div>
