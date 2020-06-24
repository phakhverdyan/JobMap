<div class="col-12 item-row" data-id="{{ $args['id'] }}">
    <div class="mb-3 border rounded p-2 bg-light">
        <div class="d-flex align-items-center justify-content-between">
            <p class="mb-0 text-grey">{{ $args['title'] }} <span class="font-weight-bold">{{ $args['year'] }}</span>
            </p>
            <div class="d-flex align-items-center">
                <button type="button" class="btn btn-link p-0 mr-2" data-toggle="modal"
                        data-target="#editModalDistinction" data-id="{{ $args['id'] }}"
                        data-item-action="resume-distinction-edit">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <svg enable-background="new 0 0 32 32" id="svg2" version="1.1"
                                             viewBox="0 0 32 32" width="16px" height="16px" fill-opacity="0.3"
                                             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><g id="background"><rect
                                                        fill="none" height="32" width="32"></rect></g><g id="edit"><polygon
                                                        points="10,28 4,28 4,22  "></polygon><rect height="8.485"
                                                                                                   transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)"
                                                                                                   width="28.284"
                                                                                                   x="4.858"
                                                                                                   y="8.757"></rect><polygon
                                                        points="4,32 4,30 26,30 26,32 4,32  "></polygon></g>
                                        </svg>
                                    </span>
                </button>
                <button type="button" class="btn btn-link p-0" data-item-action="resume-distinction-delete"
                        data-id="{{ $args['id'] }}">
                                    <span class="d-flex align-items-center justify-content-center">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="20px"
                                             height="20px" fill-opacity="0.3" x="0px" y="0px"
                                             viewBox="0 0 51.976 51.976"
                                             style="enable-background:new 0 0 51.976 51.976;" xml:space="preserve">
                                            <path d="M44.373,7.603c-10.137-10.137-26.632-10.138-36.77,0c-10.138,10.138-10.137,26.632,0,36.77s26.632,10.138,36.77,0
                                                                                            C54.51,34.235,54.51,17.74,44.373,7.603z M36.241,36.241c-0.781,0.781-2.047,0.781-2.828,0l-7.425-7.425l-7.778,7.778
                                                                                            c-0.781,0.781-2.047,0.781-2.828,0c-0.781-0.781-0.781-2.047,0-2.828l7.778-7.778l-7.425-7.425c-0.781-0.781-0.781-2.048,0-2.828
                                                                                            c0.781-0.781,2.047-0.781,2.828,0l7.425,7.425l7.071-7.071c0.781-0.781,2.047-0.781,2.828,0c0.781,0.781,0.781,2.047,0,2.828
                                                                                            l-7.071,7.071l7.425,7.425C37.022,34.194,37.022,35.46,36.241,36.241z"></path>
                                        </svg>
                                    </span>
                </button>
            </div>
        </div>
    </div>
</div>