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
            Your account has been blocked
        </h1>
        <h2>
            Ask your administrator to reactivate account to be able to access your business section
        </h2>
    </div>

@endsection