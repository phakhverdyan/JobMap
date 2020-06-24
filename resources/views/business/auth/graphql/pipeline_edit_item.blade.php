<div class="input-group mb-3 pipeline-item" data-id="{{ $args['id'] }}">
    <span class="input-group-addon px-0"
          id="pipeline-item{{ $args['id'] }}">
        <svg version="1.1" class="mx-2"
             xmlns="http://www.w3.org/2000/svg"
             width="20px" height="25px" viewBox="0 0 16 16">
        <path fill="#B7B7B7" d="M0 7h16v2h-16v-2z"></path>
        <path fill="#B7B7B7" d="M7 6h2v-3h2l-3-3-3 3h2z"></path>
        <path fill="#B7B7B7"
              d="M9 10h-2v3h-2l3 3 3-3h-2z"></path>
        </svg>
    </span>
    <input type="text" class="form-control border-right-0 pipeline-edit-item-name [ multilanguage multilanguage-en ]"
           value="{{ $args['name'] }}" data-id="{{ $args['id'] }}" data-name="name">
    <span class="input-group-addon [ multilanguage multilanguage-en ]">(En)</span>
    <input type="text" class="form-control border-right-0 pipeline-edit-item-name [ multilanguage multilanguage-fr ] d-none"
           value="{{ $args['name_fr'] }}" data-id="{{ $args['id'] }}" placeholder="Translate from English: {{ $args['name'] }}"
           data-name="name_fr">
    <span class="input-group-addon [ multilanguage multilanguage-fr ] d-none">(Fr)</span>
    <span class="input-group-btn border-0">
        <div class="dropdown">
            <button class="btn btn-outline-primary mx-0 dropdown-toggle rounded-0 h-100" type="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="[ pipeline-edit-item-internal__title ]">{{ $args['internal'] ? trans('main.label.internal') : trans('main.label.external') }}</span>
            </button>
            <div class="dropdown-menu w-100" style="min-width: 0;">
                <button class="[ pipeline-edit-item-internal__item ] dropdown-item text-center px-2" type="button"
                        data-internal="0" data-id="{{ $args['id'] }}">
                    <span>{!! trans('main.label.external') !!}</span>
                </button>
                <button class="[ pipeline-edit-item-internal__item ] dropdown-item text-center px-2" type="button"
                        data-internal="1" data-id="{{ $args['id'] }}">
                    <span>{!! trans('main.label.internal') !!}</span>
                </button>
            </div>
        </div>
    </span>
    <span class="input-group-btn border-0">
        <div class="dropdown">
            <button class="[ pipeline-edit-item-icon__title ] btn btn-outline-primary dropdown-toggle rounded-0"
                    type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @svg('/img/pipeline/' . (isset($args['icon']) && $args['icon'] ? $args['icon'] : 'default') . '.svg', 'pipeline-edit-icon')
            </button>
            <div class="dropdown-menu w-100" style="min-width: 0;">
              @foreach(config('lists.pipeline_icons') as $pipeline_icon)
                <button class="[ pipeline-edit-item-icon__item ] dropdown-item text-center px-2" type="button" data-icon="{{ $pipeline_icon }}" data-id="{{ $args['id'] }}">
                  @svg('/img/pipeline/' . $pipeline_icon . '.svg', 'pipeline-edit-icon')
                </button>
              @endforeach
            </div>
        </div>
    </span>
    <span class="input-group-btn border-0">
      {{--@if($args['type'] == 'custom')--}}
      @if(!$args['not_delete'])
          <button class="btn mx-0 pipeline-item-delete" type="button"
                  style="background-color: #e9ecef; border: 1px solid #ced4da; border-left: 0px;"
                  data-id="{{ $args['id'] }}">
            <i class="fa fa-times" aria-hidden="true"></i>
          </button>
      @endif
    </span>
</div>