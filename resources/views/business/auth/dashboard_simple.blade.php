@extends('layouts.main_business')

@section('content')

    <div class="container-fluid">
        <form id="business-candidate-form" autocomplete="off">
            <div class="row">
                <!-- left menu begin -->
                <div id="slide-out" class="sidebar_adaptive pl-0" style="width: 320px;">
                    @include('components.sidebar.sidebar_business')
                </div>
                <!-- left menu eof -->

                <!-- content block begin-->
                <div class="flex-1 mx-auto pb-5 mt-1 mx-lg-3 bg-white px-3 rounded content-main">
                    <div class="d-flex justify-content-between my-3 flex-lg-row flex-column-reverse">
                        <div class="align-self-center d-flex flex-lg-row flex-column my-lg-0 my-3">
                            <select class="form-control mr-lg-3 d-inline-block my-lg-0 my-3">
                                <option>1</option>
                            </select>
                            <div class="btn-group px-0 formQuickApplImport" role="group" aria-label="Basic example">
                                <div class="input-group form-control py-1 d-flex border-top-right-0 border-bottom-right-0 rounded-0" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border: 1px solid rgba(78,92,110,.1); background-color: #f4f4f4;">
                                    <div class="d-flex flex-column" style="font-size: 14px">
                                        <input type="text" class="border-0 js-import_email" name="email" autocomplete="off" placeholder="Quick applicant import" style="box-shadow: none; height: 30px;">
                                    </div>
                                </div>

                                <button class="btn btn-outline-primary mx-0 js-submit_email" type="button" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                                    @svg('/img/send.svg', [
                                       'width' => '20px',
                                       'height' => '20px',
                                       'style' => 'vertical-align: middle; margin-top: -5px;',
                                    ])
                                </button>
                            </div>
                        </div>
                        <div class="align-self-center">
                            <a href="{!! url('/business/job/manage') !!}" class="btn btn-primary addnewbutton" style="cursor:pointer;">
                                <span class="mb-0">
                                    View Jobs
                                </span>
                            </a>
                            <a href="{!! url('/business/job/add') !!}" class="btn btn-primary addnewbutton" style="cursor:pointer;">
                                @svg('/img/plus_add_button.svg', [
                                   'width' => '25px',
                                   'height' => '25px',
                                   'style' => 'fill:#fff;margin-right: 5px;vertical-align: middle;margin-top: -3px;',
                                  ])
                                <span class="mb-0">
                                    Add Job
                                </span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card border-0 candidate-card" data-id="103" data-candidate-id="121" clicked-on="0">
                        <div class="card-header bg-white border-0 py-3 BobikHoverEffect" role="tab" id="heading121">
                            <h5 class="mb-0 mt-0">
                                <a class="d-flex justify-content-between" data-toggle="collapse" href="#collapse121" aria-expanded="true" aria-controls="collapse121" onclick="$(this).find('.candidate_collapse').toggleClass('collapsed');" style="font-size: 16px; color: #4E5C6E;">
                                    <div class="d-lg-inline-flex d-flex flex-column flex-lg-row">
                                        <div class="text-center text-lg-left mb-3">
                                            <div style="width: 80px; border-radius: 5px; overflow: hidden; margin:0 auto;">
                                                <img class="mr-3 mxa-0 candidate-picture" src="https://jobmap.co/resume/103/100.100.2caf557372d128dcbe9ee1fd7b0cb254.png?v=86946" style="width: 80px; height: 80px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                                            </div>
                                            <img class="business-logo-medium rounded" src="https://jobmap.co/img/business-logo-small.png" style="width: 30px; height: 30px; background-color: #fff;">
                                        </div>
                                        <div class="text-center text-lg-left mxa-0" style="margin-left: 20px">
                                            <div class="mb-0 d-flex flex-column flex-lg-row">
                                                <p class="mb-0" data-candidate_id="103">
                                                    <strong class="candidate-name">Maksym Yudin</strong>
                                                </p>
                                            </div>
                                            
                                            <p class="mb-0">
                                                <small>
                                                    Applied 
                                                    <span style="font-size: 13px;">1 month ago</span>
                                                </small>
                                            </p>

                                            <p class="mb-0">
                                                <small>
                                                   Clerk 
                                                </small>
                                            </p>

                                            <p class="mb-0" style="font-size: 14px;">
                                                252 Main Street, New York
                                            </p>
                                            
                                        </div>
                                    </div>
                                    <span class="mt-0 align-self-center candidate_collapse">
                                        @svg('/img/arrow-down.svg', [
                                           'width' => '20px',
                                           'height' => '20px',
                                           'style' => 'fill: rgba(0,0,0,0.3);',
                                        ])
                                    </span>
                                </a>
                                
                                

                            </h5>
                        </div>

                        <div id="collapse121" class="collapse" role="tabpanel" aria-labelledby="heading121" data-parent="#accordion">
                            <div class="card-body px-3 pt-0">
                                <div class="col-12 px-0">
                                    <p class="mb-0" style="font-size: 14px;">
                                        <span class="item-location-flag bfh-flag-UA"><i class="glyphicon"></i> </span>
                                        Lubny,Poltava,Ukraine
                                    </p>
                                    <p class="my-3">
                                        <small>
                                            Last applied to New Maksimus Business
                                        </small>
                                    </p>

                                    <div class="d-flex flex-wrap">
                                        <button type="button" class="btn btn-outline-success [ candidate-overview ] btn-sm mr-3">
                                            <span>
                                                {!! trans('main.buttons.resume_overview') !!}
                                            </span>
                                        </button>
                                        <button type="button" class="[ candidate__interview ] btn btn-outline-new btn-sm mr-3">
                                            <span>{!! trans('main.buttons.interview') !!}</span>
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-sm mr-3  [ candidate-resume-update ]" data-toggle="tooltip" data-placement="top" title="{!! trans('main.buttons_hint.ask_update') !!}">
                                            {!! trans('main.buttons.update') !!}
                                        </button>
                                        <button type="button" class="btn btn-outline-primary btn-sm  [ candidate-send-message ]" >
                                            {!! trans('main.buttons_hint.message') !!}
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

</div>

  
    @include('components.modal.billing_from_trial')
    @include('components.modal.billing_from_X')
    @include('components.modal.add_candidate')
    @include('components.modal.questionnaire')
    @include('components.modal.edit_candidate')
    @include('components.modal.cant_click_on_candidate_in_archived_pipeline')

    </div>
@endsection
@section('script')
    <script>
        @php
            $active_pricing_strategy = \DB::table('pricing_strategy')->select(
                'monthly_price',
                'candidates',
                'free_version_candidates'
            )->where('active', 1)->first();
        @endphp
        window.active_pricing_strategy = {!! $active_pricing_strategy ? json_encode($active_pricing_strategy) : 'null' !!};
    </script>
    <script src="{{ asset('/js/app/business-applicants.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/business-ats.js?v='.time()) }}"></script>
@endsection