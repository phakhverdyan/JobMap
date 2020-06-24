@extends('layouts.main_business')

@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 text-center my-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card border-0">
                            <div class="card-header bg-white text-center py-4 border border-bottom-0">

                                <div class="row justify-content-center">
                                    <div class="col-12">
                                        <svg height="50px" viewBox="0 0 1792 1792" width="50px"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1216 1568v192q0 14-9 23t-23 9h-256q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h256q14 0 23 9t9 23zm-480-128q0 12-10 24l-319 319q-10 9-23 9-12 0-23-9l-320-320q-15-16-7-35 8-20 30-20h192v-1376q0-14 9-23t23-9h192q14 0 23 9t9 23v1376h192q14 0 23 9t9 23zm672-384v192q0 14-9 23t-23 9h-448q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h448q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-640q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h640q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-832q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h832q14 0 23 9t9 23z"
                                                  fill="#4266ff"/>
                                        </svg>
                                        <h3 class="h3 mb-0 text-secondary"
                                            style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                                            Manage Department</h3>
                                    </div>
                                </div>

                            </div>
                            <div class="card-body p-0">
                                <div class="row no-gutters justify-content-center">
                                    <div class="col-12 border pb-3 pt-5">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                <h6 class="h6 mb-3 text-left">Add new department</h6>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control bg-light"
                                                           placeholder="Enter pipeline">
                                                    <span class="input-group-btn">
                                                            <button class="btn btn-outline-primary"
                                                                    type="button">Add</button>
                                                    </span>
                                                </div>
                                                <h6 class="h6 mb-3 text-left">Edit departments</h6>
                                                <div id="pipeline-sortable" class="p-0 m-0">

                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="New">
                                                            <span class="input-group-btn">
                                                                        <button class="btn mx-0" type="button" style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                                        </button>
                                                            </span>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="New">
                                                            <span class="input-group-btn">
                                                                        <button class="btn mx-0" type="button" style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                                        </button>
                                                            </span>
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="New">
                                                            <span class="input-group-btn">
                                                                        <button class="btn mx-0" type="button" style="background-color: #e9ecef; border: 1px solid #ced4da;">
                                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                                        </button>
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
            </div>
        </div>
    </div>
</div>
@endsection