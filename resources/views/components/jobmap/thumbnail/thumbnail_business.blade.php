<div class="thumbnail avatar thumbnail-user" id="user-navbar">
    <div class="current-lang avatar">
        <img src="{{ asset('img/profilepic2.png') }}" class="userpic">
    </div>
    <ul class="fade-fast">
        <a href="#">
            <li>
                <div style="position: relative;width: 100px; margin-left: -50px;left: 50%;"><img
                            class="user-image userpic" style="width: 100px" src="{{ asset('img/profilepic2.png') }}">
                </div>
            </li>
        </a>
        <a href="#">
            <li>
                <p class="text blue fs-16 clear-padding" id="user-username"></p>
            </li>
        </a>
        <div class="divide-line thumbnail-divide responsive mt-top-4"></div>
        <li class="mt-top-4">
            <a href="#">
                <div class="thumbnail-input-wrapper col-md-10  mx-auto">
                    <input class="thumbnail-input" type="text" placeholder="{!! trans('fields.placeholder.feedback') !!}">
                </div>
            </a>
            <div class="col-md-2 clear-padding mt-2">
                <i class="nc-icon nc-send-2 send-icon"></i>
            </div>
        </li>
        <a href="#">
            <li class="navigation">
                <a href="{!! url('/user/dashboard') !!}">
                    <p class="text blue fs-16 clear-padding">{!! trans('main.user_menu.dashboard') !!}</p>
                </a>
            </li>
        </a>
        <a href="#">
            <li class="navigation">
                <a href="{!! url('/user/resume/create') !!}">
                    <p class="text blue fs-16 clear-padding">{!! trans('main.user_menu.edit_my_resume') !!}</p>
                </a>
            </li>
        </a>
        <a href="#">
            <li class="navigation">
                <a href="{!! url('/user/messages') !!}">
                    <p class="text blue fs-16 clear-padding">{!! trans('main.user_menu.messages') !!}<span class="notification"></span></p>
                </a>
            </li>
        </a>
        <a href="#">
            <li class="navigation">
                <a href="{!! url('/') !!}">
                    <p class="text blue fs-16 clear-padding">{!! trans('main.user_menu.sent_resumes') !!}</p>
                </a>
            </li>
        </a>
        <a href="#">
            <li class="navigation">
                <a href="{!! url('/user/settings') !!}">
                    <p class="text blue fs-16 clear-padding">{!! trans('main.user_menu.settings') !!}</p>
                </a>
            </li>
        </a>
        <div class="divide-line thumbnail-divide responsive mt-2"></div>
        <a href="#">
            <li>
                <p class="text fs-16 clear-padding" data-toggle="modal"
                   data-target="#logoutModal">{!! trans('main.user_menu.logout') !!}</p>
            </li>
        </a>
    </ul>
</div>
