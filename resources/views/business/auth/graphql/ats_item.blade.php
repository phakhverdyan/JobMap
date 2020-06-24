<div class="card border-0">
    <div class="card-header bg-white border-0 py-2 BobikHoverEffect d-flex justify-content-between" role="tab" id="heading1">
        <h5 class="mb-0 mt-0 title_left_sorting align-self-center">
            <span>{{ $args['email'] }}</span>
            <small><strong> {{ trans('pages.'.$args['status']) }}</strong></small>
        </h5>
        <div class="float-right d-flex">
                <?php \Carbon\Carbon::setLocale( \App::getLocale()); ?>
                <button class="btn btn-outline-success align-self-center btn-block text-center candidate_add-show-form" style="cursor:pointer;" data-toggle="modal" data-target="#addNewCandidate" data-dismiss="modal">
                    <svg id="Layer_1" width="25px" height="25px" style="enable-background:new 0 0 512 512; margin-right: 5px; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                            <g>
                                <g>
                                    <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                </g>
                            </g>
                            <g>
                                <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9" fill="#27cfc3"></polygon>
                            </g>
                        </g>
                      </svg>
                        <span class="mb-0">
                          {!! trans('main.buttons.add_information') !!}
                        </span>
                </button>
                <small class="mx-4 align-self-center" style="white-space: nowrap;">{{ $args['sended_at']->diffForHumans() }}</small>
                @if($args['status'] !== 'Exist')
                    <button type="button" data-id="{{$args['id']}}"
                            class="btn btn-outline-primary border-0 p-0 js-resendEmail"
                            style="background-color: transparent;" data-toggle="tooltip"
                            data-placement="top" title="Resend invitation">
                        <svg xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                             id="Capa_1" x="0px" y="0px" width="15px" height="15px"
                             viewBox="0 0 561 561"
                             style="enable-background:new 0 0 561 561; vertical-align: middle; margin-top: -4px;"
                             xml:space="preserve">
                            <g>
                                <g id="loop">
                                    <path d="M280.5,76.5V0l-102,102l102,102v-76.5c84.15,0,153,68.85,153,153c0,25.5-7.65,51-17.85,71.4l38.25,38.25    C471.75,357,484.5,321.3,484.5,280.5C484.5,168.3,392.7,76.5,280.5,76.5z M280.5,433.5c-84.15,0-153-68.85-153-153    c0-25.5,7.65-51,17.85-71.4l-38.25-38.25C89.25,204,76.5,239.7,76.5,280.5c0,112.2,91.8,204,204,204V561l102-102l-102-102V433.5z"/>
                                </g>
                            </g>
                        </svg>
                    </button>
                @endif
            </div>
    </div>
</div>
<!-- ONE LOCATION EOF -->
<hr class="my-0">