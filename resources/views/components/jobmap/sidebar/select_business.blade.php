<div class="input-group relative px-4">
    <div class="input-group-btn border w-100">
        <a href="javascript:void(0)" class="switch-to-user profile-switcher btn btn-outline-success btn-sm clear-mg pr-5 text-left" title="" data-original-title="View your user menu" style="border-radius: 5px;border-top-right-radius: 0px;border-bottom-right-radius: 0px;">
            <i class="fa fa-refresh" aria-hidden="true" style="padding: 4px 5px;  margin-right: 15px;"></i>
            Switch to user
        </a>
        <button type="button" class="btn btn-outline-success btn-sm dropdown-toggle bg-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  style="border-radius: 5px;border-top-left-radius: 0px;border-bottom-left-radius: 0px;">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul class="dropdown-menu" id="business-list">
            <li role="separator" class="divider"></li>
            <li>
                <a class="profile-switcher" href="{!! url('/business/signup') !!}">
                    <i class="fa fa-plus" aria-hidden="true" style="padding: 0 5px;"></i>
                    Create new business
                </a>
            </li>
        </ul>
    </div>
</div>