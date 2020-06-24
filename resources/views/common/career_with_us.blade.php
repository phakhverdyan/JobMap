@extends('layouts.jobmap.common_widget')

@section('content')

  <div class="bg-white col-12 px-0">
      <div class="container mt-3 text-center">
        <div class="row justify-content-center">
            <div class="jm-w" style="position: relative; min-height: 200px; width: 100%;">
              <div class="jm-w__loader" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                <img src="{{ asset('/img/widget_loading.gif') }}">
              </div>
              <script async src="{{ asset('/widget.' . env('CAREER_WITH_US_WIDGET_ID', '1') . '.js') }}"></script>
            </div>
        </div>
      </div>
  </div>
@endsection
