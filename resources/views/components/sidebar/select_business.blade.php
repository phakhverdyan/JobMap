<div class="input-group relative" style="width: auto;">
    <div class="input-group-btn" style=" border:1px solid rgba(78,92,110,.1);">
        <a href="javascript:void(0)" class="switch-to-user profile-switcher btn btn-sm clear-mg px-1 text-left" title="" data-original-title="View your user menu" style="border-radius: 5px;border-top-right-radius: 0px;border-bottom-right-radius: 0px; color:#9BA6B2; ">
            <i class="fa fa-refresh" aria-hidden="true" style="padding: 4px 5px;"></i>
            {!! trans('sidebar.text.switch_to_job_seeker') !!}
        </a>
        <button type="button" class="btn btn-sm bg-white business_switch_caret" aria-haspopup="true" aria-expanded="false"  style="border-radius: 5px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
            <span class="carrot"></span>
        </button>      
    </div>
</div>

<div style="" class="switcher_to_business business-list bg-white rounded border-top-right-0">
    <div class="text-center">
        <a class="profile-switcher btn btn-primary ml-0 mx-auto mb-3 mt-2" href="{!! url('/business/signup') !!}" role="button" style="width: auto;">
            <!-- <i class="fa fa-plus" aria-hidden="true" style="padding: 0 5px;"></i> -->
            <svg id="Layer_1" width="25px" height="25px" style="enable-background:new 0 0 512 512; float: left; margin-right: 5px;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <g>
                    <g>
                        <g>
                            <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z" fill="#ffffff"></path>
                        </g>
                    </g>
                    <g>
                        <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9" fill="#ffffff"></polygon>
                    </g>
                </g>
            </svg>
            {!! trans('sidebar.text.create_new_business') !!}
        </a>
    </div>
</div>