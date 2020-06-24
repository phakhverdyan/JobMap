<div class="text-left mb-3 item-{{ $args['status'] }}" data-id="{{ $args['id'] ?? 0}}">
    <div class="d-flex justify-content-between">
        <h6 class="h6 mt-0 mb-0">{{ $args['full_name'] }}</h6>
        <div class="d-inline-flex align-items-center ml-3">
            @if ($args['status'] != 'incoming')
                <button type="button" class="btn btn-link p-0 mr-2 border-0 reference-edit" data-type="{{ $args['status'] }}"
                        data-toggle="modal" data-target="{{ $args['status'] == 'confirmed' ? '#formRefEditModal' : '#requestedRefEditModal' }}">
                    <span class="d-flex align-items-center justify-content-center">
                        <svg enable-background="new 0 0 32 32" id="svg2" version="1.1" viewBox="0 0 32 32" width="16px" height="16px" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" style="fill:rgba(6,70,166,0.2)!important;"><g id="background"><rect fill="none" height="32" width="32"/></g><g id="edit"><polygon points="10,28 4,28 4,22  "/><rect height="8.485" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 41.6274 8.7574)" width="28.284" x="4.858" y="8.757"/><polygon points="4,32 4,30 26,30 26,32 4,32  "/></g>
                        </svg>
                    </span>
                </button>
            @endif
            <button type="button" class="btn btn-link p-0 border-0 reference-delete">
                <span class="d-flex align-items-center justify-content-center">
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"  x="0px" y="0px" viewBox="0 0 51.976 51.976" style="enable-background:new 0 0 51.976 51.976; fill:rgba(6,70,166,0.2)!important;" xml:space="preserve">
                         <path d="M44.373,7.603c-10.137-10.137-26.632-10.138-36.77,0c-10.138,10.138-10.137,26.632,0,36.77s26.632,10.138,36.77,0
                             C54.51,34.235,54.51,17.74,44.373,7.603z M36.241,36.241c-0.781,0.781-2.047,0.781-2.828,0l-7.425-7.425l-7.778,7.778
                             c-0.781,0.781-2.047,0.781-2.828,0c-0.781-0.781-0.781-2.047,0-2.828l7.778-7.778l-7.425-7.425c-0.781-0.781-0.781-2.048,0-2.828
                             c0.781-0.781,2.047-0.781,2.828,0l7.425,7.425l7.071-7.071c0.781-0.781,2.047-0.781,2.828,0c0.781,0.781,0.781,2.047,0,2.828
                             l-7.071,7.071l7.425,7.425C37.022,34.194,37.022,35.46,36.241,36.241z"/>
                     </svg>
                </span>
            </button>
        </div>
    </div>
    <div class="mt-3">
        <div class="d-flex align-items-start justify-content-between">
            <div>
                <p class="mb-0 font-weight-bold">{{ $args['company'] }}</p>
                <p class="mb-0">{{ $args['status'] == 'equested' ? $args['email'] : $args['message'] }}</p>
            </div>
        </div>
        @if ($args['status'] == 'incoming')
            <div class="btn-group mt-2 w-100" role="group" aria-label="Basic example">
                <button class="btn btn-outline-success w-50 mb-0 reference-confirmed">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                        <g>
                            <g id="check">
                                <polygon points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"/>
                            </g>
                        </g>
                    </svg>
                </button>
                <button class="btn btn-outline-primary w-50 mb-0 reference-delete" style="margin-left: 1px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 298.667 298.667" style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                        <g>
                            <g>
                                <polygon points="298.667,30.187 268.48,0 149.333,119.147 30.187,0 0,30.187 119.147,149.333 0,268.48 30.187,298.667     149.333,179.52 268.48,298.667 298.667,268.48 179.52,149.333"/>
                            </g>
                        </g>
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>