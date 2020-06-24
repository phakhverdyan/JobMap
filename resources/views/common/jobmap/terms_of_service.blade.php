@extends('layouts.jobmap.common_user')

@section('content')

    <div class="col-12 px-0 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10 text-center my-5">
                    <div class="card border-0">
                        <div class="bg-white text-center pt-4">
                            <i class="fa fa-external-link-square text-primary" aria-hidden="true"
                               style="font-size: 45px"></i>
                            <h3 class="h3 text-secondary mt-3">{!! trans('pages.title.terms.title') !!}</h3>
                        </div>
                        <div class="card-body px-0">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class=" mb-3">
                                        <div class="px-3 pt-3">
                                            <div class="row justify-content-center">
                                                <div class="col-12 col-sm-11 col-md-6">
                                                    {!! trans('pages.text.terms.box_1.item_1') !!}
                                                </div>
                                                <div class="col-12 col-sm-11 col-md-6">
                                                    {!! trans('pages.text.terms.box_1.item_2') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-5">
                                        <div class="px-3 pt-3">
                                            <div class="row justify-content-center">
                                                <div class="col-12 col-sm-11 col-md-6">
                                                    {!! trans('pages.text.terms.box_2.item_1') !!}
                                                </div>
                                                <div class="col-12 col-sm-11 col-md-6">
                                                    {!! trans('pages.text.terms.box_2.item_2') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-center mt-5">
                            <button class="btn btn-primary px-5">Continue</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection
