@extends('layouts.jobmap.common_jobmap')

@section('content')


<div class="container-fluid mt-1 user-landing">
    <div class="row">
        <div class="col-12">
            <div class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active" style="height: 760px; background-image: url('{{ asset('/img/landing/user-landing-bg.jpg') }}')"></div>
                    {{--<div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')"></div>--}}
                    {{--<div class="carousel-item" style="background-image: url('http://placehold.it/1900x1080')"></div>--}}
                </div>
            </div>

            <div class="row section-content" style="height: 760px;">
                <div class="col-md-12 d-flex" style="align-items: center;">
                    <div class="mt-4 col-10 row white-section offset-1 d-flex justify-content-center">
                        <div class="row d-flex justify-content-center mt-4">
                            <p class="main-title-white fs-40 col-8 text-center lh-50">CloudResume and JobMap working together as one!</p>
                        </div>
                        <div class="row d-flex justify-content-center mt-4">
                            <p class="sub-title-white fs-35 col-6 text-center">CRM, JobSearch engine, ATS? We got you covered. In the cloud for an easy access anytime, anywhere!</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row white-section">
                <div class="col-12">
                    <div class="row mb-5">
                        <div class="col-12 d-flex justify-content-center mt-4">
                            <button type="button" class="btn btn-primary lh-50">create account box</button>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-4">
                            <p class="main-title-blue text-center fs-35">For more informations</p>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-4">
                            <div class="col-4 d-flex justify-content-around">
                                <button type="button"  class="btn btn-outline-primary lh-50 col-5">CloudResume</button>
                                <button type="button"  class="btn btn-outline-primary lh-50 col-5">FAQ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
