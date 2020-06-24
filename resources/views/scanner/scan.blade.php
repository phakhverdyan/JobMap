@extends('layouts.jobmap.common_user')

@section('style')
	<link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/cropper.min.css') }}">
@endsection

@section('content')

	<style type="text/css">
		.job-form__phone-number .form-control:focus{
			background-color: #f4f4f4;
		}
		.widget_toggle{
			display: none;
		}
		.loading:before{
			content: "";
			display: block;
			opacity: .1;
			background-color: #000000;
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 9999;
		}
		.loading .fa.fa-circle-o-notch{
			position: absolute;
			top: 50%;
			left: 50%;
			z-index: 9999;
			color: #6a86ff;
		}
		#avatar-block{
			z-index: 999;
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: #FFFFFF;
			padding-top: 25px;
		}
	</style>

	<div class="step-1 scan" style="display: block;">

		<div class=" [ job ]">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<div class="[ job__profile ]">
							<div class="[ job__profile-logo ]">
								<img src="{{ $location->business->middle_image_url }}" alt="" style="width: 150px; height: 150px;">
							</div>
							<div class="[ job__profile__info ]">
								<h3 class="[ job__profile__info-name ]">{{ $location->business->localized_name }}</h3>
								<p class="[ job__profile__info-location ] mb-0">
                                <span class="flag">
									<i class="glyphicon bfh-flag-{{ $location->country_code }}"></i>{{ $location->full_address }}
								</span>
								</p>
							</div>
						</div>
					</div>
					<div class="col-md-5">
						<div class="[ job__position ]">
							<div class="[ job__position-info ]">
								<h3 class="[ job__position-open ]">
									<span class="[ job__position-number ]">{{$job_count}} </span>
									Job Position
								</h3>
								<p class="[ job__position-name ] job-general-application mb-0">
									General application
								</p>
							</div>
							<button class="[ job__position-change-button ] btn btn-primary" data-toggle="modal" data-target="#JobChangeModal">Change</button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class=" [ job-form ] mt-5">
			<div class="container">
				<div class="row">
					<div class="col-md-7">
						<form id="scan-form" method="post" action="">
							{{ csrf_field() }}
							<input type="hidden" name="business_id" value="{{$business_id?$business_id:0}}">
							<input type="hidden" name="job_id" value="{{$job_id?$job_id:0}}">
							<input type="hidden" name="location_id" value="{{$location_id?$location_id:0}}">

							<div class="form-control text-center mb-3">
								<div class="d-inline-block bg-light px-5 pxa-0 pt-4 pb-3 mb-4 user-pic-view">
									<img class=" img-thumbnail" alt="Your business logo" style="width: 150px; height: 150px;" src="{{asset("img/business-logo-small.png")}}">
									<div class="mt-3 bg-white">
										<button id="user-pic-change-btn" type="button" class="btn btn-outline-primary py-3 px-3">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.711 489.711" style="enable-background:new 0 0 489.711 489.711; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="20px" class="mr-2">
                                                                    <g>
																		<g>
																			<path d="M112.156,97.111c72.3-65.4,180.5-66.4,253.8-6.7l-58.1,2.2c-7.5,0.3-13.3,6.5-13,14c0.3,7.3,6.3,13,13.5,13    c0.2,0,0.3,0,0.5,0l89.2-3.3c7.3-0.3,13-6.2,13-13.5v-1c0-0.2,0-0.3,0-0.5v-0.1l0,0l-3.3-88.2c-0.3-7.5-6.6-13.3-14-13    c-7.5,0.3-13.3,6.5-13,14l2.1,55.3c-36.3-29.7-81-46.9-128.8-49.3c-59.2-3-116.1,17.3-160,57.1c-60.4,54.7-86,137.9-66.8,217.1    c1.5,6.2,7,10.3,13.1,10.3c1.1,0,2.1-0.1,3.2-0.4c7.2-1.8,11.7-9.1,9.9-16.3C36.656,218.211,59.056,145.111,112.156,97.111z"></path>
																			<path d="M462.456,195.511c-1.8-7.2-9.1-11.7-16.3-9.9c-7.2,1.8-11.7,9.1-9.9,16.3c16.9,69.6-5.6,142.7-58.7,190.7    c-37.3,33.7-84.1,50.3-130.7,50.3c-44.5,0-88.9-15.1-124.7-44.9l58.8-5.3c7.4-0.7,12.9-7.2,12.2-14.7s-7.2-12.9-14.7-12.2l-88.9,8    c-7.4,0.7-12.9,7.2-12.2,14.7l8,88.9c0.6,7,6.5,12.3,13.4,12.3c0.4,0,0.8,0,1.2-0.1c7.4-0.7,12.9-7.2,12.2-14.7l-4.8-54.1    c36.3,29.4,80.8,46.5,128.3,48.9c3.8,0.2,7.6,0.3,11.3,0.3c55.1,0,107.5-20.2,148.7-57.4    C456.056,357.911,481.656,274.811,462.456,195.511z"></path>
																		</g>
																	</g>
                                                                </svg>
											Take your picture
										</button>
										<input type="file" name="logo_file" style="display: none;">
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="email">Email Address</label>
								<input type="email" name="email" class="form-control">
								<small>We will send you a password via email</small>
							</div>
							{{--						<div class="form-group mt-4">--}}
							{{--							<div class="[ job-form__choose-photo ]">--}}
							{{--								<label class="mb-0" for="file">Choose / Take your picture</label>--}}
							{{--								<input type="file" name="logo_file" id="file">--}}
							{{--							</div>--}}
							{{--						</div>--}}
							<div class="form-group mt-4">
								<div class="[ job-form__upload-resume ]">
									<label class="mb-0" for="resume_file"><span><img src="{{asset("img/resume.svg")}}" alt=""></span>Tap to
										attach your resume</label>
									<input type="file" name="resume_file" id="resume_file" style="display: none;">
								</div>
							</div>
							<!-- Phone number -->
							<label for="phone-number">Phone number</label>
							<div class="[ job-form__phone-number ]">
								<div class="row">
									<div class="col-md-4">
										<div id="country-phone" class="bfh-selectbox bfh-countries" data-country="CA" data-flags="true">
											<input type="hidden" name="phone_country_code" value="CA" class="country">
											<a class="bfh-selectbox-toggle form-control" role="button" data-toggle="bfh-selectbox" href="#" style="padding: 10px 20px;">
											<span class="bfh-selectbox-option" id="phone_code">
												<i class="glyphicon bfh-flag-CA"></i>+1 <span>Canada</span>
											</span>
											</a>
											<div class="bfh-selectbox-options">
												<div class="bfh-selectbox-filter-container">
													<input type="text" class="bfh-selectbox-filter form-control" placeholder="search"  autocomplete="off">
												</div>
												@include('components.phone_flag')
											</div>
										</div>

									</div>
									<div class="col-md-8">
										<input name="phone_number" class="[ phone-number ] form-control" type="text" placeholder="">
									</div>
								</div>

							</div>

							<!-- / Phone number-->
							<div class="form-group mt-4">
								<label for="first-name">First Name</label>
								<input type="text" name="first_name" class="form-control">
							</div>
							<div class="form-group mt-4">
								<label for="last-name">Last Name</label>
								<input type="text" name="last_name" class="form-control">
							</div>
							<label for="widget-user-location">Location</label>
							<div class="form-group input-group mb-4 text-left">

							<span class="input-group-addon" id="widget-user-location-flag" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                                        <i class="glyphicon"></i>
                                                    </span>
								<input type="text" name="city" id="widget-user-location" placeholder="" class="form-control" autocomplete="off">
								<span class="input-group-btn input-btn-clear border-0 hide" >
                                                        <button class="btn mx-0 border-0" type="button" id="user-location-clear" >
                                                            <i class="fa fa-times" aria-hidden="true"></i>
                                                        </button>
                                                    </span>
							</div>

							<button type="submit" class="[ job-form__apply-button ] mt-2 mb-5 btn btn-primary">Sign up to Apply</button>

							<input type="hidden" name="city_name">
							<input type="hidden" name="region">
							<input type="hidden" name="country">
							<input type="hidden" name="country_code">

						</form>
					</div>
					<div class="col-md-5">
						<div class="[ job-spontaneous-applicants ]" role="alert">
							<img src="{{asset("img/accept.svg")}}" alt="">
							<h3 class="mt-3 mb-2">Spontaneous Applicants Accepted</h3>
							<p>You can apply to this location even if there are no open jobs</p>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="step-2 scan mb-5" style="display: none;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 d-flex justify-content-center">
					<div class="[ no-photo ]">
						<div class="[ no-photo__page-header ] mt-5">
							<img src="{{asset("img/no-photo.svg")}}" alt="">
							<h3>No Photo?</h3>
						</div>
						<div class="[ no-photo__alert ] mt-4">
							<h4>Don’t be shy!</h4>
							<p class="mb-0 mt-3">Increase your chances of getting hired, just add a profile pictures,<br>it takes a few seconds!</p>
						</div>
						<form id="user-no-pic-form" action="">
							<div class="form-control text-center mb-5 mt-5">
								<div class="d-inline-block bg-light px-5 pxa-0 pt-4 pb-3 mb-4 user-pic-view">
									<img class=" img-thumbnail" alt="Your business logo" style="width: 150px; height: 150px;" src="{{asset("img/business-logo-small.png")}}">
									<div class="mt-3 bg-white">
										<button id="user-no-pic-change-btn" type="button" class="btn btn-outline-primary py-3 px-3">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.711 489.711" style="enable-background:new 0 0 489.711 489.711; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="20px" class="mr-2">
                                                                    <g>
																		<g>
																			<path d="M112.156,97.111c72.3-65.4,180.5-66.4,253.8-6.7l-58.1,2.2c-7.5,0.3-13.3,6.5-13,14c0.3,7.3,6.3,13,13.5,13    c0.2,0,0.3,0,0.5,0l89.2-3.3c7.3-0.3,13-6.2,13-13.5v-1c0-0.2,0-0.3,0-0.5v-0.1l0,0l-3.3-88.2c-0.3-7.5-6.6-13.3-14-13    c-7.5,0.3-13.3,6.5-13,14l2.1,55.3c-36.3-29.7-81-46.9-128.8-49.3c-59.2-3-116.1,17.3-160,57.1c-60.4,54.7-86,137.9-66.8,217.1    c1.5,6.2,7,10.3,13.1,10.3c1.1,0,2.1-0.1,3.2-0.4c7.2-1.8,11.7-9.1,9.9-16.3C36.656,218.211,59.056,145.111,112.156,97.111z"></path>
																			<path d="M462.456,195.511c-1.8-7.2-9.1-11.7-16.3-9.9c-7.2,1.8-11.7,9.1-9.9,16.3c16.9,69.6-5.6,142.7-58.7,190.7    c-37.3,33.7-84.1,50.3-130.7,50.3c-44.5,0-88.9-15.1-124.7-44.9l58.8-5.3c7.4-0.7,12.9-7.2,12.2-14.7s-7.2-12.9-14.7-12.2l-88.9,8    c-7.4,0.7-12.9,7.2-12.2,14.7l8,88.9c0.6,7,6.5,12.3,13.4,12.3c0.4,0,0.8,0,1.2-0.1c7.4-0.7,12.9-7.2,12.2-14.7l-4.8-54.1    c36.3,29.4,80.8,46.5,128.3,48.9c3.8,0.2,7.6,0.3,11.3,0.3c55.1,0,107.5-20.2,148.7-57.4    C456.056,357.911,481.656,274.811,462.456,195.511z"></path>
																		</g>
																	</g>
                                                                </svg>
											Take your picture
										</button>
										<input type="file" name="logo_file" style="display: none;">
									</div>
								</div>
							</div>
{{--							<div class="form-group mt-4">--}}
{{--								<div class="[ no-photo-form__choose-photo ]">--}}
{{--									<label class="mb-0" for="file">Add profile picture</label>--}}
{{--									<input type="file" name="file" id="file">--}}
{{--								</div>--}}
{{--							</div>--}}
						</form>
						<button class="btn btn-primary btn-to-step3">
							<p class="mb-0">Lower my chances of getting an interview &<br>skip to the next step</p>
							<span><img src="{{asset("img/right-arrow.svg")}}" alt=""></span>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="step-3 scan" style="display: none;">
		<div class="container">
			<div class="row">
				<div class="col-md-12 d-flex justify-content-center">
					<div class="[ almost-done ]">
						<div class="[ almost-done__page-header ] mt-5">
							<img src="{{asset("img/accept.svg")}}" alt="">
							<h3><span class="user_name">Friend,</span> you're almost done!</h3>
							<p>Dowload and login to JobMap to allow the following:</p>
						</div>
						<div class="[ almost-done__allow ] mt-4">
							<p class="mb-0">Allow</p>
							<div class="[ company-logo ]"><img src="{{ $location->business->middle_image_url }}" alt="" style="width: 40px; height: 40px;"></div>
							<p class="[ company-name ] mb-0">{{ $location->business->localized_name }}</p>
						</div>

						<div class="[ almost-done__feature ] mt-5">
							<div class="[ almost-done__feature-item ]">
								<img src="{{asset("img/tick.svg")}}" alt="">
								<p class="mb-0">Send you interview <strong>Requests</strong></p>
							</div>
							<div class="[ almost-done__feature-item ] mt-3">
								<img src="{{asset("img/tick.svg")}}" alt="">
								<p class="mb-0">Send you <strong>Messages</strong></p>
							</div>
						</div>
						<p class="mb-0 text-center mt-5">Get the App to allow & receive notifications</p>
						<button class="[ playstore-button ] btn btn-primary mt-3"><span><img src="{{asset("img/playstore.svg")}}" alt=""></span>Download from PlayStore
						</button>
						<button class="[ appstore-button ] btn btn-primary mt-3"><span><img src="{{asset("img/apple-logo.svg")}}" alt=""></span>Download from AppStore
						</button>
						<div class="[ almost-done__alert ] mt-4 mb-5">
							<p class="mb-0">Log into the JobMap mobile app to add a video selfie,<br>you’ll have much quicker replies that way!</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<div class="modal fade" id="JobChangeModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Jobs</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pb-5">
					<div class="row py-3">
						<div class="col-md-12">
							<div class="d-flex flex-lg-row flex-column justify-content-start" role="group" aria-label="Basic example">
								<div class="d-flex col-12 pl-0 col-lg-6 pxa-0 justify-content-between mb-3 mb-lg-0"
									 style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;">
									<input type="text" class="form-control border-0 ml-2"
										   style="background-color: #f4f4f4; box-shadow: none; border-radius: 10px;"
										   placeholder="{!! trans('fields.placeholder.cr_jobs_search') !!}"
										   id="scanner-job-search">
									<div class="align-self-center mr-3 mr-lg-0">
										<svg xmlns="http://www.w3.org/2000/svg"
											 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
											 x="0px" y="0px" viewBox="0 0 250.313 250.313"
											 style="enable-background:new 0 0 250.313 250.313; opacity: 0.1;"
											 xml:space="preserve" widht="17px" height="17px">
                                                <g id="Search">
													<path style="fill-rule:evenodd;clip-rule:evenodd;"
														  d="M244.186,214.604l-54.379-54.378c-0.289-0.289-0.628-0.491-0.93-0.76   c10.7-16.231,16.945-35.66,16.945-56.554C205.822,46.075,159.747,0,102.911,0S0,46.075,0,102.911   c0,56.835,46.074,102.911,102.91,102.911c20.895,0,40.323-6.245,56.554-16.945c0.269,0.301,0.47,0.64,0.759,0.929l54.38,54.38   c8.169,8.168,21.413,8.168,29.583,0C252.354,236.017,252.354,222.773,244.186,214.604z M102.911,170.146   c-37.134,0-67.236-30.102-67.236-67.235c0-37.134,30.103-67.236,67.236-67.236c37.132,0,67.235,30.103,67.235,67.236   C170.146,140.044,140.043,170.146,102.911,170.146z"/>
												</g>
                                            </svg>
									</div>
								</div>
								<div class="d-flex ml-auto">
									<div class="d-flex mr-0 pt-1">
                                                <span class="pt-2 mr-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
														 xmlns:xlink="http://www.w3.org/1999/xlink"
														 version="1.1" id="Capa_1" x="0px" y="0px"
														 viewBox="0 0 417.138 417.138"
														 style="height:15px; opacity: 0.8;"
														 xml:space="preserve">
                                                    <g>
                                                        <g>
                                                            <path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
                                                            <path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
                                                        </g>
                                                    </g>
                                                    </svg>
                                                </span>
										<select class="border-0 form-control form-control-sm bg-white" id="scanner-job-sort">
											<option value="title"
													data-order="asc">{!! trans('main.sort.title_az') !!}</option>
											<option value="title"
													data-order="desc">{!! trans('main.sort.title_za') !!}</option>
											<option value="created_date"
													data-order="asc">{!! trans('main.sort.c_date_oldest') !!}
											</option>
											<option value="created_date"
													data-order="desc">{!! trans('main.sort.c_date_newest') !!}
											</option>
										</select>
									</div>
									<div class="pt-1 mx-2" id="page-limit-headquarters">
										<select class="border-0 form-control form-control-sm bg-white" id="scanner-job-limit">
											<option value="25">{!! trans('main.limit', ['count' => 25]) !!}</option>
											<option value="50">{!! trans('main.limit', ['count' => 50]) !!}</option>
											<option value="100">{!! trans('main.limit', ['count' => 100]) !!}</option>
											<option value="200">{!! trans('main.limit', ['count' => 200]) !!}</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-12 col-sm-12">
							<table class="table table-responsive display responsive no-wrap" id="datatable-list-jobs" style="width:100%">
								<thead>
								<tr>
									<th scope="col"></th>
								</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary pull-right mr-3" data-dismiss="modal" role="button">Close</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="UserPictureCropperModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="loading" style="display: none;">
					<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
				</div>
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Jobs</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body pb-5">
					<div class="row">
						<div class="col-md-9">
							<div class="avatar-wrapper img-container" style="width: 100%;"><img src=""></div>
						</div>
						<div class="col-md-3">
							<div class="row avatar-btns">
								<div class="col-md-12">
									<button type="button" class="btn btn-primary btn-block avatar-save">{!! trans('main.buttons.save') !!}</button>
								</div>
							</div>

							<p class="mt-md-5">{!! trans('modals.text.size_previews') !!}</p>
							<div class="docs-preview clearfix">
								<div class="avatar-preview preview-lg"> </div>
								<div class="avatar-preview preview-md"> </div>
								<div class="avatar-preview preview-sm"> </div>
							</div>

						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary pull-right mr-3" data-dismiss="modal" role="button">Close</button>
				</div>
			</div>
		</div>
	</div>

@endsection
@section('script')
{{--	<script src="{{ asset('/libs/cropper/cropper.min.js') }}"></script>--}}
	<script src="{{ asset('/js/cropper.min.js') }}"></script>
	<script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/js/scan-page.js?v='.time()) }}"></script>

@endsection
