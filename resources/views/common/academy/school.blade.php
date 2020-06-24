@extends('layouts.common_landing')

@section('content')

	<div class="container-fluid px-0" style="overflow: hidden;">
		<div class="col-12">
			<div class="container">
				<div class="col-12">
					<p class="text-center pt-5">
						<a href="{{ url('/') }}">
							<img src="{{ asset('img/landing/cr-logo.png') }}" width="70px" class="wow animated fadeInDown">
						</a>
					</p>
				</div>
			</div>
		</div>

		<div class="col-12 wow animated fadeInRight">
			<div class="container">
				<div class="col-12 pb-5">
					<div class="d-flex justify-content-between flex-lg-row flex-column-reverse">
						<div class="col-lg-8 mx-auto col-md-12 mt-3" id="blockItems">
							<p class="mb-1 font-18" id="schoolCounts"></p>
							<p class="mb-1 font-18" id="schoolName"><strong></strong></p>
							<p class="text-muted mb-3" id="schoolAddress"></p>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3" id="cloneItemList" style="display: none!important;">
								<div class="d-flex">
									<div>
										<a href="jawascript:;" class="schoolItemPic">
											<img src="" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18">
											<a href="jawascript:;" class="schoolItemName" style="color:#3e4552;">
												<strong></strong>
											</a>
										</p>
										<p class="text-muted mb-0 schoolItemType"></p>
									</div>
								</div>
								<div class="d-flex">
									<div class="mr-3">
										<a href="jawascript:;" class="schoolItemCountChildren"></a>
									</div>
									<div>
										<p class="text-muted mb-0 schoolItemDateAdd"></p>
										<p class="text-muted schoolItemDateUpdate"></p>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

@endsection
@section('script')
	{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>--}}
	<script src="{{ asset('/js/app/school.js?v='.time()) }}"></script>
@endsection
