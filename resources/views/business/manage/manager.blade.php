@extends('layouts.main_business')
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> -->
@section('content')

    <style type="text/css">
        .filtersvg {
            height: 18px;
            cursor: pointer;
            opacity: 0.2;
        }

        .jobsvg, .managersvg {
            fill: #0275d8;
            width: 25px;
            height: 30px;
            cursor: pointer;
        }

        .leftmodalsorting:hover {
            border-bottom: 2px solid #4266ff;
            padding-bottom: 2px;
        }

        .addnewlocationsvg {
            width: 40px;
            height: 40px;
            fill: #0275d8;
            transition: all .2s ease-in-out;
        }

        .perpage:hover .filtersvg {
            opacity: 1;
        }

        .perpage:hover {
            border-bottom: 2px solid #4266ff;
            padding-bottom: 8px;
            fill: #0275d8;
        }

        .addnewbutton:hover svg polygon {
            fill: #fff;
        }

        #ManaInLocModal .modal-lg{
            max-width: 1024px;
        }

        button.button-assign{
            width: 150px;
            display: inline-block;
            margin-top: 25px!important;
            margin-left: 25px;
            margin-bottom: 15px;
        }
        .button-assign-block{
            text-align: right;
        }
        .table-button-assign{
            width: 40px;
            display: inline-block;
            margin-top: 15px!important;
            margin-bottom: 15px;
            margin-left: 15px;
        }
        .quantity-billing::-webkit-outer-spin-button,
        .quantity-billing::-webkit-inner-spin-button {
            -webkit-appearance: none;
        }

        .quantity-billing[type=number] {
            -moz-appearance:textfield; /* Firefox */
        }

        .dataTables_processing {
            width: 100%;
            height: 100%;
            position: absolute;
            background-color: #8ca5d0;
            z-index: 9;
            opacity: 0.5;
        }

        .dataTables_processing .fa-spin {
            position: absolute;
            top: 40%;
            left: 40%;
            color: #003aff;
            font-size: 100px;
        }

        button .fa-spin{
            margin-right: 8px;
        }

        .border-bottom {
            border-bottom: 1px solid #cccccc;
        }
        .input-group-prepend {
            display: flex;
        }

        .input-group-text {
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: .375rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: .25rem;
        }

    </style>

    <div class="container-fluid">
        <div class="row">
                <div id="slide-out" class="pl-0 sidebar_adaptive">
                        @include('components.sidebar.sidebar_business')
                </div>
                <div class="flex-1 mx-auto pb-5 mt-5 bg-white rounded px-0 billing content-main">
                    <div id="business_table_processing" class="dataTables_processing" style="display:none;">
                            <i class="fa fa-circle-o-notch fa-spin  fa-3x fa-fw"></i>
                        <span class="sr-only">Loading..n.</span>
                    </div>
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
                                    <a class="nav-link" id="seats-tab" data-toggle="tab" href="#seats" role="tab" aria-controls="seats" aria-selected="false">Seats ({{$slots_count - $slots->sum('counter')}}/{{$slots_count}})</a>
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
                </div>
        </div>
</div>

{{-- Modal start --}}
    <!-- Modal -->
    @if($current_user_role != 'manager')
    <div class="modal fade" id="modify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modify Package</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Modifications are Pro-Rata.</div>
                <div>New Auto-Renew Date: <strong>{{\Carbon\Carbon::create()->format('F \t\h\e d')}}</strong></div>
                    <div class="col-lg-12 mb-4 mt-4">
                        <div class="row align-items-center">
                            <div class="btn-group mr-4" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" onclick="$('#hidden_counter').get(0).value++;$('#hidden_counter').trigger('change');">+</button>
                                <button type="button" class="btn btn-primary" onclick="$('#hidden_counter').get(0).value--;$('#hidden_counter').trigger('change');">-</button>
                            </div>
                            <input
                            @if($tax)
                                @if($tax->rate_1)  
                                    data-tax-1="{{$tax->rate_1}}"
                                @endif
                                @if($tax->rate_2)
                                    data-tax-2="{{$tax->rate_2}}"
                                @endif
                            @endif
                                    type="hidden" id="hidden_counter" value="0">
                            <span><strong id="m_counter">2</strong> x <span id="m_descriptor">40 Seats Plan</span></span>
                        </div>
                    </div>
                    <div class="col p-0 mb-2">
                        <strong>New Monthly Price:</strong>
                        <span>$<span id="m_month">300</span>/month</span>
                    </div>
                    <div class="col p-0">
                        <strong>New Monthly Price w/Taxes:</strong>
                        <span>$<span id="m_month_tax">330</span>/month</span>
                        <div><small>This amount will be processed every 30 days.</small></div>
                    </div>
                    <hr>
                    <div class="col p-0">
                        <strong>Price with Pro-Rata & Taxes:</strong>
                        <span>$<span id="m_prorate">110</span></span>
                        <div><small>This is the amount that will be processed today.</small></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modify_plan_button">
                    <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                        Confirm & Pay</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Modal -->
    @if($current_user_role != 'manager')
    <div class="modal fade" id="modify_legacy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Legacy Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>This is a legacy plan, are you sure that you want to cancel it as you will not have access to this plan anymore in the future.</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">
                    <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                        Confirm</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- Modal -->
    @if($current_user_role != 'manager')
    <div class="modal fade" id="cancel_plan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cancel Legacy Plan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <span>Are you sure that you wish to cancel this plan?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="cancel_plan_button">
                    <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                        Confirm</button>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--Modal -->
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-capitalize" id="exampleModalLabel">New admin user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="admin_user">To change the account admin, simply enter the new admin's email.</label>
                    <input type="text" class="form-control" id="admin_user" placeholder="Enter the email of the new admin user" aria-describedby="admin user">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                    Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="resend_invite" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Resend Invite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="admin_user">Where should we resend the invite email?</label>
                    <input type="text" class="form-control" id="m_resend_email" placeholder="email">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="resend_invite_button">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                    Resend Invite Email</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="remove_item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Confirm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>
                    This will unassign the selected user. Are you sure?
                </span>
                <span class="error-message"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirm">
                    <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                    Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@if($current_user_role != 'manager')
@php 
\Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));

try{
    $intent = \Stripe\SetupIntent::create([
        'customer' => $customer_id
    ]);
}
catch(\Exception $e) {
    $intent = null;
}

@endphp
<div class="modal fade" id="add_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="create-card-form" data-secret="{{$intent->client_secret}}">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                        <div id="card-element"></div>
                </div>
                <div class="error-message">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                Continue</button>
            </div>
        </form>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="payment_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Successful</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">Payment Processed. You will now receive</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="card_added" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Card Added</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">You can now use this card to add packages.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="set_as_default" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Default Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">This will set the card ending with <strong>****<span class="m_last4"></span></strong> as your default payment method.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="set_default_card_button" class="btn btn-primary">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                Make Default</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="pay_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pay invoice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    Next invoice will be paid
                </div>
                <div class="row justify-content-between">
                    <strong id="m_invoice_number"></strong>
                    <span id="m_invoice_date"></span>
                    <span id="m_invoice_amount"></span>
                </div>
                @if($cards)
                <div class="text-center">With <strong>****<span class="m_last4">{{$cards->where('is_default', 1)->first()->last_four}}</span></strong> as your default payment method.</div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="pay_invoice_button" class="btn btn-primary">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                Pay</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="remove_card" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Remove Card</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-left">Remove the card ending with <strong>****<span class="m_last4"></strong>?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="remove_card_button" class="btn btn-primary">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>Remove Card</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="add_seats" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Seats</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pl-0 pr-0">
                <div class="col-lg-12" >
                    <div class="col-lg-12 mb-4 p-0">
                        <strong class="d-block">Select the right access plan for your business</strong>
                        <span class="d-block">You can add/modify as many packages as you want anytime.</span>
                    </div>
                    <!-- <div class="row justify-content-start mb-2">
                    <label class="switch">
                        <input type="checkbox" class="year-month-switcher"
                            onchange="
                                $('[data-interval]').show();
                                $(this).val() ? $('[data-interval=month]').hide() : $('[data-interval=year]').hide()"
                        >
                        <span class="slider round"></span>
                    </label>
                    </div> -->
                    <div class="row justify-content-between btn-group btn-group-toggle" data-toggle="buttons">
                        @foreach (\App\Business\BusinessBillingPlan::where('status','active')->get() as $item)
                        <div class="col-lg-4 text-center" data-interval={{$item->interval_name}}>
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-lg-12 p-0">
                                    <h5 class="mb-2"><strong>{{$item->name}}</strong></h5>
                                        <div class="text-secondary mb-4">{{$item->quantity}} Seat{{$item->quantity > 1 ? 's' : '' }}</div>
                                        <strong>BETA Price</strong>
                                    <div class="text-secondary">${{$item->amount/100}}/Seat</div>
                                        <strong>Regular Price</strong>
                                        <div class="text-secondary mb-4"><del>${{$item->amount/50}} CAD</del></div>
                                        <h4>${{$item->amount/100}} CAD</h4>
                                    </div>
                                    <div class="col-lg-12 mt-4 p-0">
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary rounded-left"  style="border-radius: 0;" type="button" onclick="$(this).next().get(0).value > 0 ? $(this).next().get(0).value-- : 0;$('.quantity-billing').trigger('change');">-</button>
                                            <input type="number" data-amount="{{$item->amount/100}}" value=1 class="quantity-billing form-control text-center" min="0" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4" placeholder="1">
                                            <button class="btn btn-outline-secondary rounded-right" style="border-radius: 0;" type="button" onclick="$(this).prev().get(0).value++;$('.quantity-billing').trigger('change');">+</button>
                                        </div>
                                        <label class="btn btn-success btn-block mt-3" for="plan{{$item->id}}">
                                            <input class="hide" type="radio" name="package" id="plan{{$item->id}}" value="{{$item->id}}" autocomplete="off" >Select
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between align-items-center">
                <span>Total to pay <strong>$<span id="m_total_to_pay">0</span> + applicable taxes</strong></span>
                <span class="error-stripe"></span>
                <button type="button" class="confirmation-subscription-button btn btn-primary" data-target="#payment">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>Continue</button>
            </div>
        </div>
    </div>
</div>
@endif
@if($current_user_role != 'manager')
<!-- Modal -->
<div class="modal fade" id="choose_payment_method" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">Choose a payment method</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="cards"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-toggle="modal" data-target="#add_seats">Back</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#payment_success">Continue</button>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="edit_manager" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width:900px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit manager</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="business-manager-form" autocomplete="off">
        <div class="col-md-12  pt-1">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <label>{!! trans('fields.label.first_name') !!}</label>
                    <input type="text" name="first_name" class="form-control" placeholder="{!! trans('fields.placeholder.first_name') !!}"  autocomplete="off">
                </div>
                <div class="col-md-6 col-sm-12">
                    <label>{!! trans('fields.label.last_name') !!}</label>
                    <input type="text" name="last_name" class="form-control" placeholder="{!! trans('fields.placeholder.last_name') !!}"  autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-12  pt-1 pb-3 card border-right-0 border-left-0 border-top-0 rounded-0">
            <label>{!! trans('fields.label.email') !!}</label>
            <input type="email" name="email" class="form-control" placeholder="{!! trans('fields.placeholder.email') !!}"  autocomplete="off">
        </div>
        <div class="col-md-12  pt-1 pb-3 card border-right-0 border-left-0 border-top-0 rounded-0">
            <label>{!! trans('fields.label.role') !!}</label>
            <select name="role" class="btn btn-outline-secondary" id="user_type_select">
                <option value="unassigned">Unassigned</option>
                <option value="manager">Manager</option>
                <option value="franchisee">Franchisee</option>
            </select>
        </div>
            <div class="col-md-12 pt-4" id="manager-role-permissions">
                    <div class="row">
                        <div class="col-md-12 mx-auto text-center">

                            <small class="form-text text-muted mb-2">{!! trans('fields.label.choose_permissions') !!}</small>
                            @foreach(\App\Business\Permit::where('type', \App\Business\Permit::MANAGER_TYPE)->get() as $permit)
                                @if($permit->slug != "departments")
                                    <!-- one item begin -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8 text-left">{{ $permit->localized_title }}</div>
                                            <div class="col-md-3 offset-md-1">
                                                <label class="switch mt-1">
                                                    <input type="checkbox" name="permits[]" value="{{ $permit->id }}" class="manager__permit-item">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
            </div>
            @if (is_admin() || is_permit_administrator(['locations']))
            <div class="col-md-10 pb-0 card mx-auto mt-5 px-0" style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);" id="data-table-assigned-locations">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default assign-panel">
                        <div class="panel-heading">
                            <h4 class="panel-title my-0">
                                <a data-toggle="collapse" href="#data-table-assigned-locations-collapse" data-parent="#accordion"
                                    class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto main-panel"
                                    style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;" data-type-panel="location">
                                    <p class="text-center mb-0"><img
                                                src="{{ asset('img/sidebar/locations.png') }}" alt=""/></p>
                                    {!! trans('modals.title.add_locations_manager') !!}</a>
                            </h4>
                        </div>
                        <div id="data-table-assigned-locations-collapse" class="panel-collapse collapse pb-4">
                            <div class="col-md-12 mx-auto" style="overflow-y: auto; height: auto;">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <h4 class="dataTable-header">{!! trans('main.header_step_selected_brand') !!}</h4>
                                        <table class="table table-responsive display responsive no-wrap" id="business-table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </form>
      </div>
      <div class="modal-footer">
        <div class="d-flex justify-content-between flex-1">
                <button type="button" class="btn btn-secondary resend-invite" data-dismiss="modal" data-toggle="modal" data-target="#resend_invite">Resend invite</button>
            <div class="d-flex justify-content-end flex-1">
                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="business-manager-edit">
                <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
                Save changes</button>
            </div>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="invite_sent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Invite Sent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <span>We've just sent an email to <strong id="m_invite_email_sent">info.bmvo@gmail.com </strong><strong id="m_invite_name_sent">Mark Bruk</strong><br>
                    Please make sure they look at their junk/spam/trash folder.
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Got It</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="edit_seat" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change seat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
    <div class="col-12">
        <div class="row">
                Change seat:
            </div>
            <div class="row">
                <select id="m_plan_select">
                @foreach($slots as $item)
                    <option value='{"plan":"{{$item->plan_id}}","pack":"{{$item->pack_id}}"}'>
                    {{$item->descriptor}} {{$item->pack_id}} x {{$item->counter}}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="change_seat_button">
        <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>Save changes</button>
    </div>
    </div>
</div>
</div>
@endif
<!-- Modal -->
@if($current_user_role != 'manager')
<div class="modal fade" id="deactivate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deactivate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Deactivate ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deactivate_slot">
        <i class="fa fa-circle-o-notch fa-spin" style="display: none;"></i>
        Save changes</button>
      </div>
    </div>
  </div>
</div>
@endif
<!-- Modal -->
{{-- Modal end --}}
            @endsection
            @section('script')
            <script src="{{ asset('/js/app/business-items.js?v='.time()) }}"></script>
            <script src="{{ asset('/js/app/business-functions.js?v='.time()) }}"></script>
            <script src="{{ asset('/js/app/business-new-billing.js?v='.time()) }}"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>

            <script type="text/javascript">
                @if(!$cards->isEmpty())
                var cards = @php echo json_encode($cards->map(function($item){
                                        return [
                                            "id"        => $item->id,
                                            "exp"       => $item->exp_month.'/'.$item->exp_year,
                                            "last4"     => $item->last4,
                                            "brand"     => $item->brand,
                                            "default"   => $item->is_default
                                        ];
                }));
                @endphp;
                @endif 
                var users = @php 
                     echo json_encode($users->map(function ($item) {
                                        return [
                                            "label" => $item->email.' '.$item->first_name.' '.$item->last_name,
                                            "id"    => $item->administrator_id,
                                            "value" => $item->email];
                                    }));
                    @endphp
                
                // jQuery(document).ready(function ($) {
                //     let $BusinessFunc = new BusinessFunc();
                //     // $BusinessFunc.location_table_id = $(document).find("#location-table");
                //     $BusinessFunc.business_table_id = $(document).find("#business-table");
                //     $BusinessFunc.event_type = "manager";
                //     $BusinessFunc.form_type = "manager-edit";
                //     $BusinessFunc.init();
                //     $()
                // });

                jQuery(document).ready(function ($) {
                    let $BusinessFunc = new BusinessFunc();
                    // $BusinessFunc.location_table_id = $(document).find("#location-table");
                    $BusinessFunc.business_table_id = $(document).find("#business-table");
                    $BusinessFunc.form = $(document).find("#business-manager-form");
                    $BusinessFunc.form_type = "manager-edit";
                    $BusinessFunc.manager_role = "manager";
                    $BusinessFunc.button_create = $(document).find("#business-manager-edit");
                    $BusinessFunc.is_modal = true;
                    // $BusinessFunc.redirect_url = '{!! url('/business/manage/manager') !!}';
                    $BusinessFunc.init();
                    window.businessFunctions = $BusinessFunc; 
                });
            </script>
@endsection
