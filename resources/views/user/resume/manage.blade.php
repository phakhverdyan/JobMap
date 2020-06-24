@extends('layouts.main_user')
@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-3 pl-0">
            @include('components.sidebar.sidebar_user') 
        </div>

        <div class="col-8 mx-auto text-center my-3 my-sm-5">
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off">
                        <div class="card border-0">
                            @include('components.resume_builder.header')
                            <div class="card-body p-0">
                                <div class="row no-gutters justify-content-center">
                                    @include('components.resume_builder.tabs')
                                    <div class="col-9 border border-left-0 mt-0">
                                        <div class="row justify-content-center">
                                            @include('components.resume_builder.edit')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('components.resume_builder.footer')
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection