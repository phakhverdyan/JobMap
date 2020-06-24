<div class="card-header bg-white text-center pt-3 pb-3 pxa-0" style="border-bottom:0; border-top-left-radius: 5px; border-top-right-radius: 5px;">
    <div class="d-flex justify-content-start">
        <div class="col-12 d-flex flex-column-reverse flex-md-row">
            <div>
                <div id="progress-count" class="all_steps mx-auto"></div>
            </div>
            <div class="col-12 flex-auto my-sm-0 my-3">
                <p class="mb-1 text-left rb_steps_info" style="font-size: 25px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         enable-background="new 0 0 32 32" height="25px" id="Слой_1" version="1.1" viewBox="0 0 32 32"
                         width="25px" xml:space="preserve"
                         style="vertical-align: middle; margin-top: -3px; margin-left: -5px; fill:#4E5C6E;"><path
                                clip-rule="evenodd"
                                d="M11.727,26.71l9.977-9.999  c0.394-0.395,0.394-1.034,0-1.429h0v0l-9.97-9.991c-0.634-0.66-1.748-0.162-1.723,0.734v19.943  C9.988,26.861,11.094,27.345,11.727,26.71z M19.567,15.997l-7.55,7.566V8.431L19.567,15.997z"
                                fill="#4E5C6E" fill-rule="evenodd" id="Arrow_Drop_Right"/>
                        <g/>
                        <g/>
                        <g/>
                        <g/>
                        <g/>
                        <g/></svg>
                    <strong>{!! trans('resume_builder.header.current_step') !!} </strong><i id="current-step-title"></i>
                </p>
                <p class="mb-1 text-left">
                    <span class="ml-4 mxa-0 px-1 rounded" style="background: rgba(0, 0, 0, 0.05); font-size: 12px;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns"
                             xmlns:xlink="http://www.w3.org/1999/xlink" height="15px" version="1.1" viewBox="0 0 18 23"
                             width="15px"
                             style="vertical-align: middle; margin-top: -3px; margin-right: 3px;fill:#7b7b7b;"><title></title><desc></desc><defs></defs><g
                                    fill="none" fill-rule="evenodd" id="Page-1" stroke="none" stroke-width="1"><g
                                        fill="#7b7b7b" id="Icons-Device" transform="translate(-87.000000, -209.000000)"><g
                                            id="timer" transform="translate(87.000000, 209.500000)"><path
                                                d="M12,0 L6,0 L6,2 L12,2 L12,0 L12,0 Z M8,13 L10,13 L10,7 L8,7 L8,13 L8,13 Z M16,6.4 L17.5,5 C17,4.5 16.5,4 16,3.6 L14.6,5 C13.1,3.8 11.1,3 9,3 C4,3 1.77635684e-15,7 1.77635684e-15,12 C1.77635684e-15,17 4,21 9,21 C14,21 18,17 18,12 C18,9.9 17.3,7.9 16,6.4 L16,6.4 Z M9,19 C5.1,19 2,15.9 2,12 C2,8.1 5.1,5 9,5 C12.9,5 16,8.1 16,12 C16,15.9 12.9,19 9,19 L9,19 Z"
                                                id="Shape"></path></g></g></g></svg>
                        <span id="current-step-time"></span>
                    </span>
                    <span class="ml-3 px-1 rounded" id="current-step-type"></span>
                </p>
                <p class="mb-1 text-left rb_steps_info" style="font-size: 20px;"><strong>{!! trans('resume_builder.header.next_step') !!}</strong> <span>{!! trans('resume_builder.header.fill_in_your') !!}</span> <i id="next-step-title"></i></p>
                <div class="progress col-md-8 col-12">
                   <div id="progress-percent" class="progress-bar bg-warning" style="width:0%;"></div>
                </div>
                <p class="mt-1 mb-0 text-left">{!! trans('resume_builder.header.complete_percent', ['percent' => '0']) !!}</p>
            </div>
            <!-- <div class="ml-auto mxa-auto">
                <button type="button" class="btn btn-primary" id="resume-builder-step-save-too">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                         id="Capa_1" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 448.8 448.8"
                         style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:#fff;"
                         xml:space="preserve"><g>
                            <g id="check">
                                <polygon
                                        points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                            </g>
                        </g></svg>
                    {!! trans('main.buttons.save_continue') !!}
                </button>
            </div> -->
        </div>
    </div>
</div>
