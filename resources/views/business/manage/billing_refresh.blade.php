<div class="col-10 m-auto">
                    @if($current_user_role != 'manager')
                    
                        <div class="row justify-content-between align-items-center">
                            <h4 class="text-center mb-4">Billing</h4>
                            <h5><span>Overdue:</span> <span class="text-danger ml-2 h4"> ${{$failed_invoices->sum('amount_due')/100}}</span></h5>
                        </div>
                    @endif
                    </div>
                    <div class="row flex-column align-items-center mt-3">
                        <div class="col-lg-10">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @if($current_user_role != "manager")
                                <li class="nav-item">
                                    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                </li>
                            @endif
                                <li class="nav-item">
                                    <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab" aria-controls="users" aria-selected="false">Users ({{$users->count()}})</a>
                                </li>
                            @if($current_user_role != "manager")
                                <li class="nav-item">
                                    <a class="nav-link" id="seats-tab" data-toggle="tab" href="#seats" role="tab" aria-controls="seats" aria-selected="false">Seats ({{$slots->sum('counter')}}/{{$slots_count}})</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="cards-tab" data-toggle="tab" href="#cards" role="tab" aria-controls="cards" aria-selected="false">Cards ({{$cards->count()}})</a>
                                </li>
                            @endif
                            </ul>
                            
                            <div class="tab-content" id="myTabContent">
                            @if($current_user_role != "manager")
                                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                @if(count($upcoming))
                                    <div class="col-lg-12 p-3 mb-2">
                                        <div class="row justify-content-between align-items-center">
                                            <strong>Active Subscriptions</strong>
                                            <span><strong>Renewal date</strong> {{\Carbon\Carbon::createFromTimestamp($upcoming[0]->period_end)}} (in {{\Carbon\Carbon::createFromTimestamp($upcoming[0]->period_end)->diff(\Carbon\Carbon::now())->days}} day(s))</span>
                                        </div>
                                    </div>
                                @endif
                                    <div class="col-lg-12">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-lg-5 pl-0">
                                                <strong class="text-secondary">Plan & Quantity</strong>
                                            </div>
                                            <div class="col-lg-5 pr-0">
                                                <strong class="text-secondary">Plan Total</strong>
                                            </div>
                                            <div class="col-lg-2 p-0"></div>
                                        </div>
                                    </div>
                                    @if (!$plans->isEmpty())
                                    <div class="col-lg-12 mb-1">
                                        @foreach ( $plans as $item)
                                        <div class="row justify-content-between align-items-center  mb-1">
                                            <div class="col-lg-5 pl-0">
                                                <span>{{$item->descriptor}} x {{$item->counter}}</span>
                                                @if($item->status == 'legacy')
                                                <span class="badge badge-primary payment-status ml-2">legacy</span>
                                                @endif
                                                @if($item->subscription_status != 'active')
                                                <span class="badge badge-danger payment-status ml-2">{{str_replace('_', ' ', $item->subscription_status)}}</span>
                                                @endif
                                            </div>
                                            <div class="col-lg-5 pr-0">
                                                <span>${{($item->amount*$item->counter)/ 100}} / month</span>
                                            </div>
                                            <div class="col-lg-2 p-0 d-flex justify-content-end">
                                            @if($item->status != 'legacy')
                                                <button type="button"
                                                 data-plan-id="{{$item->plan_id}}"
                                                 data-descriptor="{{$item->descriptor}}"
                                                 data-counter="{{$item->counter}}"
                                                 data-amount="{{$item->amount}}"
                                                 data-sum="{{($item->amount*$item->counter)/ 100}}"
                                                 class="btn btn-sm btn-secondary modify-plan" data-toggle="modal" data-target="#modify">Modify</button>
                                                @endif
                                                @if($item->subscription_status !== 'canceled_at_period_end')
                                                <button type="button" class="ml-1 btn btn-sm btn-secondary cancel-plan" data-plan-id="{{$item->plan_id}}" data-toggle="modal" data-target="#cancel_plan">Cancel</button>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="col-lg-12 d-flex justify-content-end">
                                        <div class="col-lg-4 p-0">
                                            <div class="row">
                                                <div class="col-lg-6 pl-0"><strong>Total Monthly Price</strong></div>
                                                <div class="col-lg-6 pr-0 text-right"><span>${{ $plans->sum(function($plan) {return $plan->amount * $plan->counter / 100;}) }} / month</span></div>
                                            </div>
                                            @if($tax)
                                            <div class="row">
                                                <div class="col-lg-6 pl-0"><strong>Total with taxes</strong></div>
                                                <div class="col-lg-6 pr-0 text-right"><span>$740 / month</span></div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-lg-12 mt-4">
                                        <div class="row justify-content-between align-items-center">
                                            <span>You don't have any seats purchased yet.</span>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#add_seats">Add Seats</button>
                                        </div>
                                    </div>                                        
                                    @endif
                                    <hr>
                                    <div class="text-center mt-5">
                                        <div class="row align-items-center m-0">
                                            <div class="col">
                                                <strong>Invoices</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-4 mb-2">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-lg-2 pl-0">
                                                <strong class="text-secondary text-uppercase">id</strong>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <strong class="text-secondary">Date</strong>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <strong class="text-secondary">Amount w/Tax</strong>
                                            </div>
                                            <div class="col-lg-2 pr-0 text-right">
                                                <strong class="text-secondary"></strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                    @if($upcoming)
                                        @foreach ($upcoming as $item)
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-lg-2 pl-0">
                                                <span>{{$item->number}}</span>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                                <span>{{\Carbon\Carbon::createFromTimestamp($item->period_end)}}
                                                    <strong>{{\Carbon\Carbon::createFromTimestamp($item->period_end)->diff(\Carbon\Carbon::now())->days}}</strong>
                                                </span>
                                            </div>
                                            <div class="col-lg-4 text-center">
                                            <span>${{$item->total / 100}}</span>
                                            </div>
                                            <div class="col-lg-2 text-right">
                                                <div class="row align-items-center justify-content-end">
                                                    @if($item->invoice_pdf)
                                                    <a href="#" class="btn btn-sm btn-link">
                                                        <img src="../../images/pdfs-128.png" height="31" alt="">
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                        @if($invoices)
                                        @foreach ($invoices as $item)
                                            <div class="row justify-content-between align-items-center mt-2">
                                                <div class="col-lg-2 pl-0">
                                                    <span>{{$item->number}}</span>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                    <span>{{\Carbon\Carbon::createFromTimestamp($item->period_end)}}
                                                        <strong>{{\Carbon\Carbon::createFromTimestamp($item->period_end)->diff(\Carbon\Carbon::now())->days}}</strong>
                                                    </span>
                                                </div>
                                                <div class="col-lg-4 text-center">
                                                <span>${{$item->total/ 100}}</span>
                                                </div>
                                                <div class="col-lg-2 text-right">
                                                    <div class="row align-items-center justify-content-end">
                                                        @if($item->status !== 'paid')
                                                        <button type="button" data-date="{{\Carbon\Carbon::createFromTimestamp($item->period_end)}}" data-number="{{$item->number}}" data-amount="{{$item->amount_due/100}}"
                                                        @if($item->hosted_invoice_url)
                                                         data-hosted-invoice="{{$item->hosted_invoice_url}}"
                                                        @endif
                                                         data-invoice-id="{{$item->invoice_id}}"
                                                         data-toggle="modal" data-target="#pay_invoice" class="btn btn-sm btn-primary pay-invoice mr-2">Pay</button>
                                                        @else
                                                        <span class="badge badge-success mr-2">PAID</span>
                                                        @endif
                                                        @if($item->invoice_pdf)
                                                        <a href="{{$item->invoice_pdf}}">
                                                        <!-- <a href="{{url('/billing/get-invoices-pdf/'.$item->id.'/download')}}"> -->
                                                        <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="file" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" style="width: 1.5em; height: 2.8em;">
                                                            <g class="fa-group">
                                                                <path fill="#cb0606" d="M256 0H24A23.94 23.94 0 0 0 0 23.88V488a23.94 23.94 0 0 0 23.88 24H360a23.94 23.94 0 0 0 24-23.88V128H272a16 16 0 0 1-16-16z" class="fa-secondary">
                                                                </path>
                                                                <text fill="white" x="20%" y="70%" style="font-size: 8em;">
                                                                    <tspan>PDF</tspan>
                                                                </text>
                                                                <path fill="#fb8d8d" d="M384 121.9v6.1H272a16 16 0 0 1-16-16V0h6.1a24 24 0 0 1 17 7l97.9 98a23.9 23.9 0 0 1 7 16.9z" class="fa-primary">
                                                                </path>
                                                            </g>
                                                        </svg>                                                        
                                                        </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        @endif

                                    </div>
                                    <hr>
                                </div>
                                @endif
                                <div class="tab-pane fade @if($current_user_role == 'manager') fade active show @endif" id="users" role="tabpanel" aria-labelledby="users-tab">
                                    <div class="col-lg-12 pt-4 pl-0 pr-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="user_email" placeholder="Enter user's work email" aria-label="Enter user's work email">
                                            <div class="input-group-append">
                                                <select class="btn btn-outline-secondary" id="user_type_select">
                                                    <option value="unassigned">Choose User Type</option>
                                                    <option value="manager">Manager</option>
                                                    <option value="franchisee">Franchisee</option>
                                                </select>
                                                <button id="add_user_button" type="button" class="btn btn-outline-success">
                                                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                                                Add user</button>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">Each user needs a seat.</small>
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong><span>Unassigned</span><span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                                <div class="col-lg-4 pr-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-dark" id="basic-addon1">
                                                                <i class="fas fa-search" style="color:white;"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control email-filter" placeholder="Filter by name or email" aria-label="Filter by name or email" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 table-unassigned">
                                            @foreach ($users->where('role', null) as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <div class="col p-0">
                                                <span class="user-email">{{$item->email}}</span>
                                                <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-secondary edit-manager" data-admin-id="{{$item->administrator_id}}" data-toggle="modal" data-target="#edit_manager">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger remove-manager" data-admin-id="{{$item->administrator_id}}" data-toggle="modal" data-target="#remove_item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                            
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong>Admins <span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            @foreach ($users->where('role','admin') as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <div class="col p-0">
                                                <span class="user-email">{{$item->email}}</span>
                                                <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                                    <span class="badge badge-{{$item->status == 'active' ? 'success' : 'secondary'}} payment-status ml-2">{{$item->status == 'active' ? "paid" : "freemium"}}</span>
                                                </div>
                                                @if(is_permit_administrator(['admin']))
                                                <button class="btn btn-primary" data-toggle="modal" data-target="#">Change Admin</button>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong><span>{{$users->where('role','manager')->count()}} Managers</span><span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 table-manager">
                                            @foreach ($users->where('role','manager') as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <div class="col p-0">
                                                <span class="user-email">{{$item->email}}</span>
                                                <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                                    <span class="badge badge-{{$item->status == 'active' ? 'success' : 'secondary'}} payment-status ml-2">{{$item->status == 'active' ? "paid" : "freemium"}}</span>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-secondary edit-manager" data-admin-id="{{$item->administrator_id}}" data-toggle="modal" data-target="#edit_manager">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger remove-manager" data-admin-id="{{$item->administrator_id}}" data-toggle="modal" data-target="#remove_item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong><span>{{$users->where('role','franchisee')->count()}} Franchisees</span><span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 table-franchisee">
                                            @foreach ($users->where('role','franchisee') as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <div class="col p-0">
                                                <span class="user-email">{{$item->email}}</span>
                                                <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                                    <span class="badge badge-{{$item->status == 'active' ? 'success' : 'secondary'}} payment-status ml-2">{{$item->status == 'active' ? "paid" : "freemium"}}</span>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <button type="button" class="btn btn-secondary edit-manager" data-admin-id="{{$item->administrator_id}}" data-toggle="modal" data-target="#edit_manager">
                                                        <i class="fas fa-pen"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger remove-manager" data-admin-id="{{$item->administrator_id}}" data-toggle="modal" data-target="#remove_item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($current_user_role != 'manager')
                                    <div class="tab-pane fade" id="seats" role="tabpanel" aria-labelledby="seats-tab">
                                        <div class="col-lg-12 p-3 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong>Inactive Seats ({{$slots->sum('counter')}})</strong>
                                                <button class="btn btn-outline-success" data-toggle="modal" data-target="#add_seats">Add Seats</button>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="input-group">
                                                    <input type="text" id="autocomplete_assign" class="form-control" placeholder="Enter user email to assign" aria-label="Enter user email to assign">
                                                    <div class="input-group-append">
                                                        <select class="btn btn-outline-secondary" id="plan_select">
                                                        @foreach($slots as $item)
                                                            <option value='{"plan":"{{$item->plan_id}}","pack":"{{$item->pack_id}}"}'>
                                                            {{$item->descriptor}} {{$item->pack_id}} x {{$item->counter}}</option>
                                                        @endforeach
                                                        </select>
                                                        <button type="button" class="btn btn-outline-success" id="assign_user_button" >
                                                            <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                                                            Assign User(s)</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <strong class="mt-5 mb-4 d-block">Active Seats ({{$slots_count - $slots->sum('counter')}}/{{$slots_count}})</strong>
                                        <div class="col-lg-12 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong><span>{{$users->where('role', 'admin')->where('id_bb', '!=', null)->count()}} Admin Seats</span><span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                                <div class="col-lg-4 pr-0">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-dark" id="basic-addon1">
                                                                <i class="fas fa-search" style="color:white;"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control email-filter" placeholder="Filter by name or email" aria-label="Filter by name or email" aria-describedby="basic-addon1">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            @foreach ($users->where('role', 'admin')->where('id_bb', '!=', null) as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <span class="user-email">{{$item->email}}</span>
                                                <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong><span>{{$users->where('role', 'manager')->where('id_bb', '!=', null)->count()}} Managers</span><span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            @foreach ($users->where('role', 'manager')->where('id_bb', '!=', null) as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <div class="col p-0">
                                                    <span class="user-email">{{$item->email}}</span>
                                                    <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                                </div>
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-secondary change-seat"
                                                 data-value='{"plan":"{{$item->plan_id}}","pack":"{{$item->pack_id}}"}'
                                                 data-id="{{$item->administrator_id}}" data-user-id="{{$item->user_id}}" data-toggle="modal" data-target="#edit_seat">Edit</button>
                                                    <button type="button" class="btn btn-danger deactivate-button" data-id="{{$item->id}}" data-user-id="{{$item->user_id}}" data-toggle="modal" data-target="#deactivate">Deactivate</button>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-2">
                                            <div class="row justify-content-between align-items-center">
                                                <strong><span>{{$users->where('role', 'franchisee')->where('id_bb', '!=', null)->count()}} Franchisee</span><span class="ml-2 badge badge-primary" data-toggle="tooltip" data-placement="top" title="Tooltip on top">?</span></strong>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            @foreach ($users->where('role', 'franchisee')->where('id_bb', '!=', null) as $item)
                                            <div class="row justify-content-between align-items-center border-bottom pb-2 pt-2"
                                                        data-item-id="{{$item->administrator_id}}">
                                                <div class="col p-0">
                                                <span class="user-email">{{$item->email}}</span>
                                                <strong class="user-name">{{$item->first_name.' '.$item->last_name}}</strong>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary change-seat" 
                                                    data-value='{"plan":"{{$item->plan_id}}","pack":"{{$item->pack_id}}"}'
                                                    data-id="{{$item->administrator_id}}" data-user-id="{{$item->user_id}}" data-toggle="modal" data-target="#edit_seat">Edit</button>
                                                <button type="button" class="btn btn-danger deactivate-button" data-id="{{$item->id}}" data-user-id="{{$item->user_id}}" data-toggle="modal" data-target="#deactivate">Deactivate</button>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="cards" role="tabpanel" aria-labelledby="cards-tab">
                                    <div class="col-lg-12 mt-2 mb-4 pt-2">
                                        <div class="row justify-content-between align-items-center">
                                            <strong>Manage Credit Cards</strong>
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#add_card">Add Card</button>
                                        </div>
                                    </div>
                                    @if(!$cards->isEmpty())
                                    <div class="col-lg-12 mt-4 mb-2">
                                        <div class="row justify-content-between align-items-center">
                                            <div class="col-lg-3 pl-0">
                                                <strong class="text-secondary">Expires</strong>
                                            </div>
                                            <div class="col-lg-3 text-center">
                                                <strong class="text-secondary">Number</strong>
                                            </div>
                                            <div class="col-lg-3">
                                                <strong class="text-secondary text-center">Card Type</strong>
                                            </div>
                                            <div class="col-lg-3 pr-0 text-right"></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 table-cards">
                                        @foreach ($cards as $item)
                                        <div class="row justify-content-between align-items-center mb-2" data-card-id={{$item->id}}>
                                            <div class="col-lg-3 pl-0">
                                                <div class="col-lg-12">
                                                    <div class="row align-items-center">
                                                        <img src="../../images/true.png" width="20" alt="">
                                                    <span class="ml-2 exp-card">{{$item->exp_month}} / {{$item->exp_year}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 text-center">
                                                <span class="last-four">****{{$item->last4}}</span>
                                            </div>
                                            <div class="col-lg-3 text-center">
                                                <div class="col-lg-12">
                                                    <div class="row align-items-center">
                                                        <img src="../../images/visa.png" width="20" alt="">
                                                        <span class="ml-2">{{strtoupper($item->brand)}}</span>
                                                        @if($item->is_default)
                                                        <span class="badge badge-sm badge-success ml-2">Currently Default</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 pr-0 text-right">
                                                @if(!$item->is_default)
                                                    <button type="button" data-card-id="{{$item->id}}" data-last4="{{$item->last4}}" class="btn btn-sm btn-primary set-default" data-toggle="modal" data-target="#set_as_default">Set as Default</button>
                                                @endif
                                                    <button type="button" data-card-id="{{$item->id}}" data-last4="{{$item->last4}}" class="btn btn-sm btn-danger ml-2 remove-card" data-toggle="modal" data-target="#remove_card">Remove</button>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                    @else
                                    <hr>
                                    <span>You did not add any credit cards yet.</span>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <script>
                    cards = @php echo json_encode($cards->map(function($item){
                                    return [
                                            "id"        => $item->id,
                                            "exp"       => $item->exp_month.'/'.$item->exp_year,
                                            "last4"     => $item->last4,
                                            "brand"     => $item->brand,
                                            "default"   => $item->is_default
                                        ];
                    }));
                    @endphp;
                    users = @php 
                     echo json_encode($users->map(function ($item) {
                                        return ["label" => $item->email.' '.$item->first_name.' '.$item->last_name,
                                                "id"    => $item->administrator_id,
                                                "value" => $item->email];
                                    }));
                    @endphp
                    </script>