@extends('layouts.main_user')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 mx-auto text-center my-4 pt-4" id="resume-overview">

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('/js/app/resume-overview.js?v='.time()) }}"></script>
@stop
