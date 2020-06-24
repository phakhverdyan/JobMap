{{--row border border-left-0 border-right-0 px-3 pt-3--}}
<div class="row pt-3 px-3" id="button-{{ $args['id'] }}">
    <div class="col-12 mb-3">
        <div class="row">
            <div class="col-lg-4 col-12">
                <legend class="w-100 border-bottom-0 pt-2"
                        style="    letter-spacing: -1px;">
                    {{ $args['title'] }}
                </legend>
            </div>
            <div class="col-lg-5 col-12 js-button_preview">
                {!!   htmlspecialchars_decode(base64_decode($args['code']))   !!}
            </div>
            <div class="col-lg-3 col-12">
                <div class="btn-group row w-100" role="group"
                     aria-label="Large button group">
                    <button type="button" data-id="{{ $args['id'] }}"
                            class="btn btn-outline-primary col-6 p-3 js-edit-button">
                        {!! trans('main.buttons.edit') !!}
                    </button>
                    <button type="button" data-id="{{ $args['id'] }}"
                            class="btn btn-outline-primary col-6 p-3 js-delete-button">
                        {!! trans('main.buttons.delete') !!}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 mb-3">
        <div class="btn-group row w-100" role="group"
             aria-label="Large button group">
            <button type="button" class="btn btn-outline-primary col-lg-2 col-12">
                <span class="d-inline-flex flex-column align-items-center justify-content-center js-copy_code"
                      data-clipboard-target="#exampleFormControlTextarea{{ $args['id'] }}" data-id="{{ $args['id'] }}"><svg
                            version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg"
                            width="15px" height="15px" x="0px"
                            y="0px"
                            viewBox="0 0 488.3 488.3"
                            style="enable-background:new 0 0 488.3 488.3;"
                            xml:space="preserve">
                        <path d="M314.25,85.4h-227c-21.3,0-38.6,17.3-38.6,38.6v325.7c0,21.3,17.3,38.6,38.6,38.6h227c21.3,0,38.6-17.3,38.6-38.6V124
                            C352.75,102.7,335.45,85.4,314.25,85.4z M325.75,449.6c0,6.4-5.2,11.6-11.6,11.6h-227c-6.4,0-11.6-5.2-11.6-11.6V124
                            c0-6.4,5.2-11.6,11.6-11.6h227c6.4,0,11.6,5.2,11.6,11.6V449.6z"
                              data-original="#000000"
                              class="active-path"
                              data-old_color="#4266ff"
                              fill="#4266ff"/>
                        <path d="M401.05,0h-227c-21.3,0-38.6,17.3-38.6,38.6c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5c0-6.4,5.2-11.6,11.6-11.6h227
                            c6.4,0,11.6,5.2,11.6,11.6v325.7c0,6.4-5.2,11.6-11.6,11.6c-7.5,0-13.5,6-13.5,13.5s6,13.5,13.5,13.5c21.3,0,38.6-17.3,38.6-38.6
                            V38.6C439.65,17.3,422.35,0,401.05,0z"
                              data-original="#000000"
                              class="active-path"
                              data-old_color="#4266ff"
                              fill="#4266ff"/>
                    </svg>
                    {!! trans('main.buttons.copy_code') !!}
                </span>
            </button>
            <button type="button" class="btn col-lg-10 col-12 p-0">
                <textarea class="form-control text-secondary" id="exampleFormControlTextarea{{ $args['id'] }}"
                          style="white-space: pre-line" readonly rows="4">{{ base64_decode($args['code']) }}</textarea>
            </button>
        </div>
    </div>
</div>
