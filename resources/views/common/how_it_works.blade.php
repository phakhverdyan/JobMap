@extends('layouts.common_user')

@section('content')
    
    <div class="container mt-2 text-center">
		<p class="text large bold text-center mt-2">{!! trans('pages.title.how_it_works') !!}</p>
	</div>
	
	<div class="row">
		<div class="divide-line black responsive">{!! trans('pages.text.how_it_works') !!}</div>
	</div>

    @include('components.call_to_action')
    @include('components.keep_in_touch')

@endsection