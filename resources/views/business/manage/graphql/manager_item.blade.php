<div class="card border-0 manager-item" data-item-id="{{ $args['id'] }}">
    <div class="card-header bg-white border-0 py-3 BobikHoverEffect" role="tab" id="heading{{ $args['id'] }}">
        <h5 class="mb-0 mt-0">
            <a class="collapsed Bobik" data-toggle="collapse" href="#collapse{{ $args['id'] }}" aria-expanded="true"
               aria-controls="collapse{{ $args['id'] }}"
               style="font-size: 16px; font-family: sans-regular; color: #4E5C6E;">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 437.955 437.955" style="enable-background:new 0 0 512 512; fill:#7b7b7b; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="22px" class="mr-2"><g><g>
                    <path d="M328.728,64.036h-72.25V10c0-5.522-4.478-10-10-10h-55c-5.522,0-10,4.478-10,10v54.036h-72.25c-27.57,0-50,22.43-50,50   v273.919c0,27.57,22.43,50,50,50h219.5c27.57,0,50-22.43,50-50V114.036C378.728,86.466,356.298,64.036,328.728,64.036z M201.478,20   h35v73.955h-35V20z M358.728,387.955c0,16.542-13.458,30-30,30h-219.5c-16.542,0-30-13.458-30-30V114.036c0-16.542,13.458-30,30-30   h72.25v9.919h-10c-5.522,0-10,4.478-10,10s4.478,10,10,10h95c5.522,0,10-4.478,10-10s-4.478-10-10-10h-10v-9.919h72.25   c16.542,0,30,13.458,30,30V387.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                    <path d="M218.978,51c5.79,0,10.5-4.71,10.5-10.5s-4.71-10.5-10.5-10.5s-10.5,4.71-10.5,10.5S213.188,51,218.978,51z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                    <path d="M290.978,357.955h-144c-5.522,0-10,4.478-10,10s4.478,10,10,10h144c5.522,0,10-4.478,10-10S296.5,357.955,290.978,357.955z   " data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                    <path d="M176.978,267.955c0,5.522,4.478,10,10,10h64c5.522,0,10-4.478,10-10s-4.478-10-10-10h-64   C181.455,257.955,176.978,262.433,176.978,267.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                    <path d="M248.978,217.955c0-16.542-13.458-30-30-30s-30,13.458-30,30s13.458,30,30,30S248.978,234.497,248.978,217.955z    M208.978,217.955c0-5.514,4.486-10,10-10s10,4.486,10,10s-4.486,10-10,10S208.978,223.469,208.978,217.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                    <path d="M290.978,153.955h-144c-5.522,0-10,4.478-10,10v144c0,5.522,4.478,10,10,10h144c5.522,0,10-4.478,10-10v-31.892   c0-5.522-4.478-10-10-10s-10,4.478-10,10v21.892h-124v-124h124v68.001c0,5.522,4.478,10,10,10s10-4.478,10-10v-78.001   C300.978,158.433,296.5,153.955,290.978,153.955z" data-original="#000000" class="active-path" data-old_color="#4266ff"></path>
                    </g></g>
                </svg>
                {{ $args['first_name'].' '.$args['last_name'] }}
                @if ($isCurrentUser)
                     (you)
                @endif
            </a>



            <div class="btn-group float-right mr-3" role="group">

                    @if ($isAccess)
                <button id="btnGroupDrop-{{ $args['id'] }}" type="button"
                        class="border-0 dropdown-toggle morewithoutcaret" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Layer_1" x="0px" y="0px" width="20px" height="18px"
                         viewBox="0 0 210 210"
                         style="enable-background:new 0 0 210 210; vertical-align: middle; fill:#4E5C6E;"
                         xml:space="preserve" data-toggle="tooltip" data-placement="top" title="More">
                                        <g id="XMLID_103_">
                                            <path id="XMLID_104_"
                                                  d="M115,0H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15V15   C130,6.716,123.284,0,115,0z"/>
                                            <path id="XMLID_105_"
                                                  d="M115,80H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15V95   C130,86.716,123.284,80,115,80z"/>
                                            <path id="XMLID_106_"
                                                  d="M115,160H95c-8.284,0-15,6.716-15,15v20c0,8.284,6.716,15,15,15h20c8.284,0,15-6.716,15-15v-20   C130,166.716,123.284,160,115,160z"/>
                                        </g>
                                        </svg>
                </button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop-{{ $args['id'] }}">
{{--                    <button class="dropdown-item business-manager-assign" type="button" role='button' style="font-size: 14px;"--}}
{{--                            data-toggle="modal" data-target="#ManaInLocModal" data-id="{{ $args['id'] }}">{!! trans('main.buttons.quick_apply') !!}--}}
                    @if ($isAccessLocation)
                    <button class="dropdown-item business-manager-assign-new" type="button" role='button' style="font-size: 14px;"
                            data-toggle="modal" data-target="#ManaInLocModal" data-id="{{ $args['id'] }}">{!! trans('main.buttons.quick_apply') !!}
                    </button>
                    @endif
                    @if ($isAdmin && is_permit_administrator(['admin']))
                        <button class="dropdown-item business-manager__set-admin" type="button" role='button' data-id="{{ $args['id'] }}"
                                data-toggle="modal" data-target="#setAdminModal">Instant Promote</button>
                    @endif
                    {{--<button class="dropdown-item" type="button" role='button'>Instant Demote</button>--}}
                    {{--<button class="dropdown-item" type="button" role='button'>{{ $args['locations_count'] }} locations</button>--}}
                    @if ($args['role'] === "franchisee")
                        <a href="{{ url('/business/manage/franchisee/edit?id='.$args['id']) }}" class="dropdown-item"
                           role='button'>{!! trans('main.buttons.edit') !!}</a>
                    @else
                        <a href="{{ url('/business/manage/manager/edit?id='.$args['id']) }}" class="dropdown-item"
                           role='button'>{!! trans('main.buttons.edit') !!}</a>
                    @endif

                    @if (!$isCurrentUser)
                        <button class="dropdown-item business-manager-delete" type="button" data-toggle="modal" style="font-size: 14px;"
                                data-target="#deleteModal" data-id="{{ $args['id'] }}" role='button'>{!! trans('main.buttons.delete') !!}
                        </button>
                    @endif

                </div>
                    @endif
            </div>
            <div class="float-right user-sub-block mr-3">
            @if ($args['role'] != 'manager' && is_permit_administrator(['admin']))
                @if($days_left > 0)
                    <label class="days-left">1 Month Free ( {{$days_left}} days left )</label>
                @elseif($billing['is_paid'] !== 1)
                    <label class="days-left">Freemium</label>
                @endif
            @endif


                @if(isset($billing['user_paid_id']) && $billing['user_paid_id'] != $auth_user_id)
                    <span id="text-user-paid" class="text-label"><span>{{$user_paid['email']}}</span><br/><span>{{$user_paid['first_name']}} {{$user_paid['last_name']}}</span></span>
                @endif

                <span class="text-label">
                {{$billing['descriptor']}} {{$billing['pack_id']}} 
                </span>
                @if (is_permit_administrator(['franchisee']) || is_permit_administrator(['admin']))
                <label class="switch">
                    <input type="checkbox" name="billing-paid" class="primary" {{($billing['is_paid'] === 1 && $billing['user_paid_id'] === $auth_user_id )?"checked":""}} data-id="{{ $args['id'] }}" value="{{ $args['id'] }}">
                    <span class="slider round"></span>
                </label>
                <span class="text-label">Paid</span>
                @endif
            </div>
        </h5>
    </div>

    <div id="collapse{{ $args['id'] }}" class="collapse" role="tabpanel" aria-labelledby="heading{{ $args['id'] }}"
         data-parent="#accordion">
        <div class="card-body pt-0">
            <div class="col-12 px-0">
                <div class="d-flex">
                    <p class="MarksBeautifulFontColor mb-0">
                        <span>
                            <strong style="font-size: 16px;">{{ $manager }}</strong>
                            <span class="ml-5">{{ $args['email'] }}</span>
                                            </span>

                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="my-0">
