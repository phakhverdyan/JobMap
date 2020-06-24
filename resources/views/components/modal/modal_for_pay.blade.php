<!-- start of modal for pay -->

<div class="modal fade bd-example-modal-lg" id="modalForPay" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header p-3">
                <h5 class="modal-title">What you will miss if you stay on freemium plan:</h5>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="col-12">
                    <ul>
                        <li>Everything from Freemium</li>
                        <li>Access to the widget section</li>
                        <li>Access to the QR code section</li>
                        <li>Full access to ATS:
                            <ul>
                                <li>candidate pdf and all his account infos</li> 
                                <li>video presentation</li> 
                                <li>add notes to candidates</li> 
                                <li>ask for interviews with interview manager</li> 
                                <li>ask for a Resume update</li> 
                                <li>Instant message candidates on the cellphone from the app</li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-12">
                    <a class="btn btn-outline-primary btn-block py-3 mt-2" href="{!! url('/business/manage/manager') !!}">Go to the payment</a>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- <div class="modal fade bd-example-modal-lg" id="create-cart-modal" tabindex="-1" role="dialog"
            data-secret="
            @php
            \Stripe\Stripe::setApiKey(env('STRIPE_API_KEY'));
            echo $intent = \Stripe\SetupIntent::create()->client_secret;
            @endphp
            "
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Credit Card</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <p class="error-message" style="color: red; font-weight: bold;"></p>
                                    <form id="create-card-form" method="post" autocomplete="off">
                                        <div class="row">
                                            <div class=" col-lg-12">

                                            <div id="card-element"></div>

                                            </div>
                                            <div class="col-lg-12">
                                                <button class="btn btn-outline-primary ml-3 mt-3 pull-right" type="submit">Add Card</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="confirmation-subscription-modal" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" data-toggle="buttons"> -->
                            <!-- <div class="row justify-content-center" style="padding-bottom: 15px;">
                                <div class="interval-billing-paid-sub-block mr-3">
                                    <span class="text-label" style="padding-right: 10px;"><span class="month-price"></span> Monthly</span>
                                    <label class="switch">
                                        <input type="checkbox" name="interval-billing-paid" class="primary" value="1">
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="text-label">Yearly <span class="year-price"></span></span>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="input-group input-group-sm mb-3 w-25">
                                    <div class="input-group-prepend mr-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Quantity </span>
                                    </div>
                                    <input id="quantity-billing" min="1" type="number" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value='1'>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                or
                            </div> -->
                            <!-- @foreach(\App\Business\BusinessBillingPlan::where('status','active')->orderBy('quantity', 'desc')->get() as $plan)
                            <div class="row justify-content-center">
                                <div class="plan-colorized col-5" style="{{$plan->color_css}}">{{ $plan->descriptor }}</div>
                                <div class="text-secondary black col-2">
                                    <span>Price:</span>
                                    <span>${{intdiv($plan->amount, 100)}}.
                                    <sup>{{($plan->amount - floor($plan->amount)) > 0 ? ($plan->amount - floor($plan->amount))*100 : '00'  }}</sup> </span>
                                </div>
                                <div class="input-group input-group-sm mb-3 col-3">
                                    <div class="input-group-prepend mr-3">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Quantity</span>
                                    </div>
                                    @if($plan->purchase_max_quantity > 1 || $plan->purchase_max_quantity == -1)
                                    <input min="1" {{$plan->purchase_max_quantity > 1 ? 'max="'.$plan->purchase_max_quantity.'"' : '' }} type="number" class="form-control quantity-billing" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm" value='1'>
                                    @else
                                    <span class="ml-2">{{$plan->purchase_max_quantity}}</span>
                                    @endif
                                </div>
                                <div class="col-2">
                                    <label class="btn btn-outline-success btn-sm">
                                        <input id="buy-package-{{$plan->id}}" name="package" class="hide" type="radio" value="{{$plan->id}}" autocomplete="off"> Select
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            <div class="row justify-content-center">
                                <p>Confirmation Subscription</p>
                            </div>
                            <div class="row justify-content-center">
                                <p class="error-stripe"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center bg-light">
                        <div class="bg-white">
                            <button type="button" data-action="0" class="btn btn-outline-warning confirmation-subscription-button" data-dismiss="modal" aria-label="close">
                                Cancel
                            </button>
                            <button type="button" data-action="1" class="btn btn-outline-primary confirmation-subscription-button" data-dismiss="modal" aria-label="close">
                                Buy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-lg" id="confirmation-subscription-modal-for-one" tabindex="-1" role="dialog"
             aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container" data-toggle="buttons">
                        @foreach(\App\Business\BusinessBillingPlan::where('status','active')->where('quantity',1)->get() as $plan)
                            <div class="row justify-content-center">
                                <div class="plan-colorized col-5" style="{{$plan->color_css}}">{{ $plan->descriptor }}</div>
                                <div class="text-secondary black col-2">
                                    <span>Price:</span>
                                    <span>${{intdiv($plan->amount, 100)}}.
                                    <sup>{{($plan->amount - floor($plan->amount)) > 0 ? ($plan->amount - floor($plan->amount))*100 : '00'  }}</sup> </span>
                                </div>
                                <div class="input-group input-group-sm mb-3 col-3">
                                </div>
                                <div class="col-2">
                                    <label class="btn btn-outline-success btn-sm">
                                        <input id="buy-package-{{$plan->id}}" name="package" class="hide" type="radio" value="{{$plan->id}}" autocomplete="off"> Select
                                    </label>
                                </div>
                            </div>
                            @endforeach
                            <div class="row justify-content-center">
                                <p>Confirmation Subscription</p>
                            </div>
                            <div class="row justify-content-center">
                                <p class="error-stripe"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center bg-light">
                        <div class="bg-white">
                            <button type="button" data-action="0" class="btn btn-outline-warning confirmation-subscription-button" data-dismiss="modal" aria-label="close">
                                Cancel
                            </button>
                            <button type="button" data-action="1" class="btn btn-outline-primary confirmation-subscription-button" data-dismiss="modal" aria-label="close">
                                Buy
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

<!-- eof modal for pay -->