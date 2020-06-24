@extends('layouts.main_business')

@section('content')

<div class="container-fluid clear-left-padding">
		<div class="col-md-3 col-sm-2 col-xs-2 clear-left-padding">
            @include('components.sidebar.sidebar_business')
		</div>

		<div class="col-md-8 col-sm-10 col-xs-10">
			<div class="row">
				<p class="text large bold text-center mt-2">Integrations</p>
			</div>
		</div>
    </div>
</div>

@endsection