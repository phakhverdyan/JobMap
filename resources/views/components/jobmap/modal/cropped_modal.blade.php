<div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog"
     tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="avatar-form" action="" enctype="multipart/form-data" method="post">
                <div class="modal-header">
                    <h4 class="modal-title" id="avatar-modal-label">Change Resume Picture</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="avatar-body">

                        <!-- Upload image and data -->
                        <div class="avatar-upload">
                            <input type="hidden" class="avatar-src" name="avatar_src">
                            <input type="hidden" class="avatar-data" name="avatar_data">
                            <label for="avatar-input">Local upload</label>
                            <input type="file" class="avatar-input" id="avatar-input" name="avatar_file">
                        </div>

                        <!-- Crop and preview -->
                        <div class="row">
                            <div class="col-md-9">
                                <div class="avatar-wrapper"></div>
                            </div>
                            <div class="col-md-3">
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

                        <div class="row avatar-btns">
                            <div class="col-md-9">

                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-block avatar-save">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->