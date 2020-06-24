@extends('layouts.main_user')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-3 pl-0 sidebar_adaptive">
          @include('components.sidebar.sidebar_user')
        </div>
        <div class="col-12 col-xl-7 mx-auto mt-5" id="print-builder">


        </div>              
    </div>
</div>

@endsection

@section('script')
  <script src="{{ asset('/js/app/print-builder.js?v='.time()) }}"></script>
@stop
