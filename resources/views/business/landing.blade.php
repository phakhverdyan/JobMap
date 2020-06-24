@extends('layouts.common_user')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active" style="background-image: url('{{ asset('/img/landing/landing-emp-1.jpg') }}')"></div>
                </div>
            </div>

            <div class="row section-content">
                <div class="col-12">
                    <div class="col-10 ml-5">
                        <div class="employer-main-title">
                            <div class="row mb-5">
                                <span class="landing-main-title">Get <span class="strong">never-expiring</span> resumes</span>
                            </div>
                            <div class="row">
                                <span class="landing-sub-title">Increase HR productivity with Real-time applicant CV’s</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-sm-12 col-md-5">
                                <span class="landing-primary-button py-3">Get started</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5 text-center">
                                <span class="landing-small-text mx-auto">No credit card required. Sign your business up in less than 30 seconds.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row section-content">
                <div class="col-12">
                    <div class="row mb-5">
                        <div class="col-12">
                            <img style="display: block;" class="mx-auto mt-4 mb-2" src="{{ asset('/img/landing/box-img.png') }}">
                            <p class="main-title-blue text-center mb-3">Set up CloudResume in 2 steps</p>
                            <p class="landing-small-blue-text text-center">Once you’re all set - any applicants that you’ll receive, will never expire.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-2 col-md-10 mx-5 mb-5 text-center">
                                    <img class="landing-card-title mb-4 mx-auto" src="{{ asset('/img/landing/landing-img-2.png') }}" >
                                    <span class="landing-card-title my-3">Create a Career page</span>
                                    <span class="landing-card-text mx-auto">
                                        It takes less than 4 minutes.
                                    </span>
                                    <div class="landing-secondary-button my-4">Get started</div>
                                </div>
                                <div class="col-lg-2 col-md-10 mx-5 mb-5">
                                    <img class="landing-card-title mb-4 mx-auto" src="{{ asset('/img/landing/landing-img-2.png') }}" >
                                    <span class="landing-card-title my-3">Link to it</span>
                                    <span class="landing-card-text mx-auto">
                                        In less than 2 minutes, your web technician
                                        can copy paste our button code to your website.
                                    </span>
                                </div>
                                <div class="col-lg-2 col-md-10 mx-5 mb-5">
                                    <img class="landing-card-title mb-4 mx-auto" src="{{ asset('/img/landing/landing-img-2.png') }}" >
                                    <span class="landing-card-title my-3">Get realtime resumes</span>
                                    <span class="landing-card-text mx-auto">
                                        Anyone applying through the button will generate a CloudResume that will
                                        never expire, you will see it in your
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</div>



    {{--<div class="row">--}}
      {{--<div class="divide-line black responsive"></div>--}}
    {{--</div>--}}



    {{--@include('components.call_to_action')--}}
    {{--@include('components.keep_in_touch')--}}

    {{--@include('components.footer.footer_user')--}}
@endsection