@extends('layouts.main_business')

@section('content')
<div class="container-fluid">
	<div class="row">

		<div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
            @include('components.sidebar.sidebar_business')
		</div>

        <div class="col-8 mx-auto text-center my-4 pt-4 content-main" id="resume-overview">

        </div>

	</div>
</div>
@endsection
@section('script')
    <script src="{{ asset('/js/app/resume-overview.js?v='.time()) }}"></script>
@stop