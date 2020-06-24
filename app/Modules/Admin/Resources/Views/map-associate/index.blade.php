@extends('admin::layouts.app')

@section('content')
    <div class="ml-3 mt-2" style="width: 100%;">

        <div class="col-12">
            <div class="d-inline-flex">
                <div>
                    <p>Create new Map Associate</p>
                    <div class="d-flex justify-content-around">
                        <div class="mr-3" style=""><input type="text" name="" class="form-control form-control-sm text-center" value="username"></div>
                        <div class="mr-3"><input type="text" name="" class="form-control form-control-sm text-center" value="*****"></div>
                        <div class="mr-3"><button class="btn btn-primary btn-sm">Create</button></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mt-3 d-inline-flex">
                <div>
                    <p>Map Associate list</p>
                    <div class="d-flex justify-content-around">
                        <div class="mr-3" style="font-size: 15px;"><p>Username</p></div>
                        <div class="mr-3" style="font-size: 15px;"><p>*******</p></div>
                        <div class="mr-3"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modifyadmin">Modify</button></div>
                        <div class="mr-3" style="font-size: 15px;"><strong>Created 30.30.30</strong></div>
                        <div class="mr-3"><a href="#" class="btn btn-success btn-sm"  role="button">Supervise Map</a></div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection