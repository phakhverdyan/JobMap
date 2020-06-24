<div class="modal fade" id="widget-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="business_widget_create_form" class="share_button_form">
                <div class="modal-header">
                    <h5 class="modal-title create-widget-title">{!! trans('modals.widget.create.title_create') !!}</h5>
                    <h5 class="modal-title update-widget-title">{!! trans('modals.widget.create.title_update') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container-fluid px-0">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row text-left justify-content-center">
                                    <div class="col-12">
                                        <div class="text-center">
                                            <div>
                                                <p class="h5">{!! trans('modals.widget.create.main_page') !!}</p>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.choose_brand') !!}</h6>
                                                        <select class="form-control" name="brand"></select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">

                                                        <label class="custom-control custom-checkbox m-0 pl-3">
                                                            <input type="checkbox" class="custom-control-input" name="show_job_posted_date" value="1" >
                                                            <span class="custom-control-indicator"></span>
                                                            <span style="padding: 2px 0 0 10px; font-weight: bold;">{!! trans('modals.widget.create.show_job_posted_date') !!}</span>
                                                        </label>


                                                    </div>
                                                </div>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.background_image_optional') !!}</h6>
                                                        <input type="button" class="form-control btn btn-primary select_background_image" value="Upload">
                                                        <p class="mt-3 mb-3">
                                                            <img src="" class="background-image-prev" style="max-width: 200px">
                                                        </p>
                                                        <input type="file" name="background_image" hidden>
                                                        <input type="input" name="background_image_file" hidden>

                                                        <div class="row text-left ml-1">
                                                            <input type="checkbox" id="show_background_image" name="show_background_image">
                                                            <label for="show_background_image" class="ml-1" style="line-height: 13px;">{!! trans('modals.widget.create.show_background_image') !!}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.background_color') !!}</h6>
                                                        <input style="border: 1px solid #000; color: transparent; background-color: transparent;" type="text" name="bg_color" class="form-control select-color-rgba" value="transparent">
                                                    </div>
                                                </div>
                                                {{-- <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">Show Background image</h6>
                                                        <input type="checkbox" id="scales" name="scales" checked>
                                                        <label for="scales">Show Background image</label>
                                                    </div>
                                                </div> --}}
                                                 <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <label for="size-widget" class="h6 mb-3">{!! trans('modals.widget.create.size_of_widget.title') !!}</label>
                                                        <select id="size-widget" name="size_widget">
                                                            <option value="small">{!! trans('modals.widget.create.size_of_widget.small') !!}</option>
                                                            <option value="medium">{!! trans('modals.widget.create.size_of_widget.medium') !!}</option>
                                                            <option value="big">{!! trans('modals.widget.create.size_of_widget.big') !!}</option>
                                                            <option value="full">{!! trans('modals.widget.create.size_of_widget.full') !!}</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="row justify-content-center mb-3 mt-4">
                                                    <div class="col-12 mb-2">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.font_style') !!}</h6>
                                                        <div class="row justify-content-center">

                                                            <div class="col-lg-4">
                                                                <div class="form-group d-flex align-items-center mb-2">
                                                                    <p class="mb-0 mr-2">{!! trans('modals.widget.create.color') !!}</p>
                                                                    <input style="border: 1px solid #000; color: transparent; background-color: #000000;" type="text" name="font_color" class="form-control select-color" value="000000">
                                                                </div>
                                                            </div>
                                                            {{-- <div class="col-lg-4">
                                                                <div class="form-group d-flex align-items-center mb-2">
                                                                    <p class="mb-0 mr-2">
                                                                        Size</p>
                                                                    <input type="number" name="font_size" class="form-control bg-light" value="14">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group d-flex align-items-center mb-0">
                                                                    <p class="mb-0 mr-2">
                                                                        Family</p>
                                                                    <select class="js-example-basic-single form-control" name="font_family" style="padding: 8px 9px;">
                                                                        <option value="Arial">
                                                                            Arial
                                                                        </option>
                                                                        <option value="Arial Black">
                                                                            Arial Black
                                                                        </option>
                                                                        <option value="Helvetica">
                                                                            Helvetica
                                                                        </option>
                                                                        <option value="Impact">
                                                                            Impact
                                                                        </option>
                                                                        <option value="Tahoma">
                                                                            Tahoma
                                                                        </option>
                                                                        <option value="Verdana">
                                                                            Verdana
                                                                        </option>
                                                                        <option value="Times">
                                                                            Times
                                                                        </option>
                                                                        <option value="Times New Roman">
                                                                            Times
                                                                            New
                                                                            Roman
                                                                        </option>
                                                                        <option value="Georgia">
                                                                            Georgia
                                                                        </option>
                                                                        <option value="Sans">
                                                                            Sans
                                                                        </option>

                                                                    </select>
                                                                </div>
                                                            </div> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <hr> --}}

                                            {{-- <div>
                                                <p class="h5">Button 1</p>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-4 col-12">
                                                        <h6 class="h6 mb-3">Background color</h6>
                                                        <input type="color" name="" class="form-control" value="#ffffff">
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <h6 class="h6 mb-3">Text color</h6>
                                                        <input type="color" name="" class="form-control" value="#ffffff">
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <h6 class="h6 mb-3">Border color</h6>
                                                        <input type="color" name="" class="form-control" value="#ffffff">
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>

                                            <div>
                                                <p class="h5">Button 2</p>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-4 col-12">
                                                        <h6 class="h6 mb-3">Background color</h6>
                                                        <input type="color" name="" class="form-control" value="#ffffff">
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <h6 class="h6 mb-3">Text color</h6>
                                                        <input type="color" name="" class="form-control" value="#ffffff">
                                                    </div>
                                                    <div class="col-lg-4 col-12">
                                                        <h6 class="h6 mb-3">Border color</h6>
                                                        <input type="color" name="" class="form-control" value="#ffffff">
                                                    </div>
                                                </div>
                                            </div> --}}

                                            <hr>

                                            <div>
                                                <p class="h5">{!! trans('modals.widget.create.links') !!}</p>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.text_color') !!}</h6>
                                                        <input style="border: 1px solid #000; color: transparent; background-color: #0000ff;" type="text" name="link_1_color" class="form-control select-color" value="0000ff">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.buttons_color') !!}</h6>
                                                        <input style="border: 1px solid #000; color: transparent; background-color: #4266ff;" type="text" name="button_background_color" class="form-control select-color" value="4266ff">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="row justify-content-center mb-3">
                                                    <div class="col-lg-6 col-12">
                                                        <h6 class="h6 mb-3">{!! trans('modals.widget.create.button_text_color') !!}</h6>
                                                        <input style="border: 1px solid #000; color: transparent; background-color: #ffffff;" type="text" name="button_text_color" class="form-control select-color" value="ffffff">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="d-inline-block bg-white">
                        <button type="button" class="btn btn-outline-primary js-submit">
                            {!! trans('modals.widget.create.button_create') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary js-update">
                            {!! trans('modals.widget.create.button_update') !!}
                        </button>
                    </div>
                    <div class="d-inline-block bg-white">
                        <button type="button" class="btn btn-outline-primary js-reset">
                            {!! trans('modals.widget.create.button_reset') !!}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
