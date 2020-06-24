<div class="col-12 pb-3 pt-5 form-tab-content">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="d-flex justify-content-between flex-lg-row flex-column">
                <div class="col-lg-6 col-12 pxa-0">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                        data-target="#editModalSkill" id="resume-skill-add">
                                    <span class="d-block h3 mb-0">
                                        <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;"
                                             version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                             xmlns="http://www.w3.org/2000/svg">
                                             <g>
                                                <g>
                                                    <g>
                                                        <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "></polygon>
                                                </g>
                                            </g>
                                        </svg>
                                    </span>
                                    {!! trans('resume_builder.skills.add_btn') !!}
                                </button>
                            </div>
                            <p class="text-center mb-4">{!! trans('resume_builder.skills.text') !!}</p>
                        </div>
                    </div>
                    <div class="row items-list" data-type-item="resume-skill">
                        <div class="col-12 hide" id="resume-not-skill">
                            <div class="border bg-light rounded p-2 text-center">
                                <p class="mb-0" style="opacity: 0.8;">{!! trans('resume_builder.skills.no_items') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12 pxa-0">
                    <div class="row">
                        <div class="col-12">
                            <div>
                                <button type="button" class="btn btn-lg btn-outline-primary w-100 p-4" data-toggle="modal"
                                        data-target="#editModalLanguage" id="resume-language-add">
                                    <span class="d-block h3 mb-0">
                                        <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;"
                                             version="1.1" viewBox="0 0 512 512" xml:space="preserve"
                                             xmlns="http://www.w3.org/2000/svg">
                                             <g>
                                                <g>
                                                    <g>
                                                        <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                                    </g>
                                                </g>
                                                <g>
                                                    <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  "></polygon>
                                                </g>
                                            </g>
                                        </svg>
                                        </span>
                                    {!! trans('resume_builder.language.add_btn') !!}
                                </button>
                            </div>
                            <p class="text-center mb-4">{!! trans('resume_builder.language.text') !!}</p>
                        </div>
                    </div>
                    <div class="row items-list" data-type-item="resume-language">
                        <div class="col-12 hide" id="resume-not-language">
                            <div class="border bg-light rounded p-2 text-center">
                                <p class="mb-0" style="opacity: 0.8;">{!! trans('resume_builder.language.no_items') !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- MODALS -->
    <div class="modal fade" id="editModalSkill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">{!! trans('modals.title.skill') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="resume-skill-form">
                                            <div class="form-group mb-3">
                                                <label class="text-grey">{!! trans('fields.label.skill_title') !!}</label>
                                                {{--<input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.skill_title') !!}"
                                                       name="title">--}}
                                                <div id="skill-title"></div>
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="text-grey">{!! trans('fields.label.skill_description') !!}</label>
                                                <textarea maxlength="1000" class="form-control" rows="3"
                                                          name="description"></textarea>
                                            </div>
                                            <!-- SKILL SLIDER BEGIN -->
                                            <div class="pt-4 pl-0 pr-3">
                                                <label>{!! trans('fields.label.skill_level') !!}</label>
                                                <div class="d-flex flex-column flex-lg-row">
                                                    <div class="col-lg-8 col-12 pxa-0 mx-auto pt-2 my-1 pl-4">
                                                        <div id="skill-slider-range-min"></div>
                                                    </div>
                                                    <div class="col-lg-3 col-6 my-1 mx-auto card text-center "
                                                         style="background-color: #eee;">
                                                        <!-- <input type="text" id="amount skill-slider-amount" class="form-control"> -->
                                                        <h5 class="my-0 py-1" id="skill-slider-amount"
                                                            style="opacity: 0.6;">0%</h5>
                                                    </div>
                                                </div>
                                                <!-- SKILL SLIDER END -->
                                                <input type="hidden" name="item-id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-skill">
                            {!! trans('main.buttons.save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModalLanguage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">{!! trans('modals.title.language') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="resume-language-form">
                                            <div class="form-group mb-3">
                                                <label>{!! trans('fields.label.language_title') !!}</label>
                                                {{--<input type="text" class="form-control" placeholder="{!! trans('fields.placeholder.language_title') !!}"
                                                       name="title">--}}
                                                <div id="language-title"></div>
                                            </div>
                                            <!-- SKILL SLIDER BEGIN -->
                                            <div class="pt-4 pl-0 pr-3">
                                                <label>{!! trans('fields.label.language_level') !!}</label>
                                                <div class="d-flex flex-column flex-lg-row">
                                                    <div class="col-lg-8 col-12 pxa-0 mx-auto pt-2 my-1 pl-4">
                                                        <div id="language-slider-range-min"></div>
                                                    </div>
                                                    <div class="col-lg-3 col-6 mx-auto my-1 card text-center"
                                                         style="background-color: #eee;">
                                                        <!-- <input type="text" id="amount" class="form-control" readonly> -->
                                                        <h5 class="my-0 py-1" id="language-slider-amount"
                                                            style="opacity: 0.6;">
                                                            0%</h5>
                                                    </div>
                                                </div>
                                                <!-- SKILL SLIDER END -->
                                                <input type="hidden" name="item-id">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary" id="resume-save-language">
                            {!! trans('main.buttons.save') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalSkill" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skillModalLabel">{!! trans('modals.title.skill') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.update') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" id="resume-skill-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-skill-confirm-edit">
                            {!! trans('main.buttons.update') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalSkill" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="skillDeleteModalLabel">{!! trans('modals.title.skill') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('main.buttons.remove') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-skill-confirm-delete">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Confirm modal for edit-->
    <div class="modal fade bd-example-modal-lg" id="saveEditModalLanguage" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languageModalLabel">{!! trans('modals.title.language') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.update') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" id="resume-language-confirm-edit-cancel"
                                data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-language-confirm-edit">
                            {!! trans('main.buttons.update') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteEditModalLanguage" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="languageDeleteModalLabel">{!! trans('modals.title.language') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('main.buttons.remove') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal" aria-label="{!! trans('main.buttons.cancel') !!}">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary" id="resume-language-confirm-delete">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
