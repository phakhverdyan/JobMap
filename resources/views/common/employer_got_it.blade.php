@extends('layouts.common_business')

@section('content')
    
    <div class="container text-center sign-up-business-wizard" style="margin-top: 60px;">
        <div class="col-12 col-sm-11 col-md-11 text-center mx-auto border rounded bg-white py-3">
            <p class="h2 mb-4">CloudResume's model is Unique</p>
            <!-- <p class="mb-5"><strong>Let us show you how we make it 100% risk free for employers worldwide.</strong></p> -->
            <p class="mb-4 h5" style="font-weight: 400;">Let us show you how we make it 100% risk-free for employers worldwide</p>
            <p class="mb-4 h6" style="font-weight: 400;"><img src="{{ asset('img//sidebar/active.png') }}" style="margin-top: -3px;"> Here's what's free for all employers</p>
            <!-- <p><strong>Here's what's free for all employers</strong></p> -->
            <div class="row justify-content-around">
                <div class="col-md-4 col-12 text-left">
                    <p class="btn_grey_color">Unlimited job posting</p>
                    <p class="btn_grey_color">Unlimited office/branch locations</p>
                    <p class="btn_grey_color">Managing your candidate pipeline</p>
                    <p class="btn_grey_color">Unlimited ATS-Imported candidates</p>
                </div>
                <div class="col-md-4 col-12 text-left">
                    <p class="btn_grey_color">Unlimited HR Managers</p>
                    <p class="btn_grey_color">Unlimited manual job renewal after 30 days</p>
                    <p class="btn_grey_color">Unlimited Departements</p>
                </div>
            </div>
            <p class="text-center mt-3">
                <a href="{!! url('/employer_got_it_step2') !!}" role="button" class="btn btn-primary px-5">Got it</a>
            </p>
        </div>
    </div>

@endsection
