@extends('layouts.common_business')

@section('content')

    <div class="container mt-2 text-center">
        <p class="text large bold text-center mt-2">Button Manager</p>
    </div>

    <div class="row">
        <div class="divide-line black responsive"></div>
    </div>

    @include('components.call_to_action')
    @include('components.keep_in_touch')
    @include('components.footer.footer_focus')
@endsection