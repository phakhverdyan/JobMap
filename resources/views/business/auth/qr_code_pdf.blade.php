<!DOCTYPE html>
<html lang="en">
<head>
    <title>JobMap Scanner</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

</head>
<style type="text/css">

    .row{
        display: block;
        clear: both;

    }
    .col-lg-6{
        width: 50%;
        float: left;
    }
</style>
<body style="margin:0;">
    <div class="main-wrapper" style="max-width: 100%;">
        <div class="container" style="margin:0 auto;">
            <h1 style="font-size: {{$title_one_size}}rem; color: {{$title_one_color}}; font-family: Roboto, sans-serif; text-align: center; margin: 0; padding: 0;">{{$title_one}}</h1>
            <h1 style="font-size: {{$title_two_size}}rem; color: {{$title_two_color}}; font-family: Roboto, sans-serif; text-align: center; margin: 0; padding: 0 0 2rem 0;">{{$title_two}}</h1>
            <div class="svg-block" style="width: 100%; text-align: center;">{!! $svg !!}</div>
            <div class="brand-block" style="text-align: center; padding-top: 40px;">
                <div style="width: 30%; float: left; text-align: right;padding-left: 25px;">
                    <img class="pull-right img-thumbnail" alt="logo" style="width: 105px; height: 105px;" src="{{asset("img/jm_logo.png")}}">
                </div>
                <div style="width: 60%; float: right; text-align: left;">
                    <h2 style="font-size: 2.2rem; width: 100%;margin-bottom: 10px;margin-top: 10px; padding-left: 25px;">www.JobMap.co</h2>
                    <div style="text-align: left;">
                        <img style="width: 150px; height: 45px;" alt="" src="{{asset("img/google-play.png")}}">
                        <img style="width: 150px; height: 45px;" alt="" src="{!! asset("img/app-store-apple.png") !!}">
                    </div>
                </div>

                <span style="text-align: left;">

                    <span style="width: 300px; height: 50px; float: left;">

                    </span>
                 </span>
            </div>
        </div>
    </div>
</body>
</html>
