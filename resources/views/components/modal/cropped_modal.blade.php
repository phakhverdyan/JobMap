<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
    <div id="no-click" class="modal fade show" tabindex="-1" role="dialog" style="overflow: auto; display: block; z-index: -1"></div>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="avatar-form" action="" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="avatar-modal-label">{!! trans('modals.title.cropped_resume') !!}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <div class="bg-white mb-3">
                                <a href="javascript:void(0)" role="button" class="btn btn-lg btn-outline-primary w-100 p-4" id="avatar-input-btn">
                                                        <span class="d-block mb-0">
                                                            <svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z" fill="#4266ff"></path></g></g><g><polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  " fill="#4266ff"></polygon></g></g></svg>
                                                        </span>
                                    {!! trans('main.buttons.upload_file') !!}
{{--                                    <p class="mb-0">{!! trans('modals.text.logo_optimal_size') !!}</p>--}}
                                </a>
                            </div>
                            <input type="file" class="avatar-input" id="avatar-input" name="avatar_file">
                        </div>

                        <!-- Crop and preview -->
                        <div class="row">
                            <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                            </div>
                            <div class="col-md-3">

                                <div class="row avatar-btns">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-primary btn-block avatar-save">{!! trans('main.buttons.save') !!}
                                        </button>
                                    </div>
                                </div>
                                <p>{!! trans('modals.text.size_previews') !!}</p>
                                <div class="avatar-preview preview-lg">
                                </div>
                                <div class="avatar-preview preview-md">
                                </div>
                                <div class="avatar-preview preview-sm">
                                </div>
                            </div>
                        </div>

                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg">
                                </div>
                                <p><input type="radio" name="filter" value="" checked> Normal</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg _1977">
                                </div>
                                <p><input type="radio" name="filter" value="1977"> 1977</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg aden">
                                </div>
                                <p><input type="radio" name="filter" value="aden"> Aden</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg brannan">
                                </div>
                                <p><input type="radio" name="filter" value="brannan"> Brannan</p>
                            </div>
                        </div>
                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg brooklyn">
                                </div>
                                <p><input type="radio" name="filter" value="brooklyn"> Brooklyn</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg clarendon">
                                </div>
                                <p><input type="radio" name="filter" value="clarendon"> Clarendon</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg earlybird">
                                </div>
                                <p><input type="radio" name="filter" value="earlybird"> Earlybird</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg gingham">
                                </div>
                                <p><input type="radio" name="filter" value="gingham"> Gingham</p>
                            </div>
                        </div>
                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg hudson">
                                </div>
                                <p><input type="radio" name="filter" value="hudson"> Hudson</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg inkwell">
                                </div>
                                <p><input type="radio" name="filter" value="inkwell"> Inkwell</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg kelvin">
                                </div>
                                <p><input type="radio" name="filter" value="kelvin"> Kelvin</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg lark">
                                </div>
                                <p><input type="radio" name="filter" value="lark"> Lark</p>
                            </div>
                        </div>
                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg lofi">
                                </div>
                                <p><input type="radio" name="filter" value="lofi"> Lo-Fi</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg maven">
                                </div>
                                <p><input type="radio" name="filter" value="maven"> Maven</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg mayfair">
                                </div>
                                <p><input type="radio" name="filter" value="mayfair"> Mayfair</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg moon">
                                </div>
                                <p><input type="radio" name="filter" value="moon"> Moon</p>
                            </div>
                        </div>
                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg nashville">
                                </div>
                                <p><input type="radio" name="filter" value="nashville"> Nashville</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg perpetua">
                                </div>
                                <p><input type="radio" name="filter" value="perpetua"> Perpetua</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg reyes">
                                </div>
                                <p><input type="radio" name="filter" value="reyes"> Reyes</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg rise">
                                </div>
                                <p><input type="radio" name="filter" value="rise"> Rise</p>
                            </div>
                        </div>
                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg slumber">
                                </div>
                                <p><input type="radio" name="filter" value="slumber"> Slumber</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg stinson">
                                </div>
                                <p><input type="radio" name="filter" value="stinson"> Stinson</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg toaster">
                                </div>
                                <p><input type="radio" name="filter" value="toaster"> Toaster</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg valencia">
                                </div>
                                <p><input type="radio" name="filter" value="valencia"> Valencia</p>
                            </div>
                        </div>
                        <div class="row image-filters">
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg walden">
                                </div>
                                <p><input type="radio" name="filter" value="walden"> Walden</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg willow">
                                </div>
                                <p><input type="radio" name="filter" value="willow"> Willow</p>
                            </div>
                            <div class="col-md-3">
                                <div class="avatar-preview preview-lg xpro2">
                                </div>
                                <p><input type="radio" name="filter" value="xpro2"> X-pro II</p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->