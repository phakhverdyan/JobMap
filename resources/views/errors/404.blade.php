@extends('layouts.common_user')


@section('title', 'Page Not Found')

@section('content')
    <?php
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Cookie;
    if ($ccc = Cookie::get('language')) {
        App::setLocale($ccc);
    }
    ?>
    <div class="error-404 text-center" style="margin: 10%">
        <h1>
            {!! trans('main.errors.404') !!}
        </h1>
    </div>

@endsection