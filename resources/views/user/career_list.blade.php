@extends('layouts.main_user')

@section('content')

<br />
<div class="container">
		<div class="col">
			<div class="table-container shadow z-index-2">
				<div class="table settings-table search-features" id="active-table">
					<div class="cell white hover settings-cell col-3 top-left-corner bottom-left-corner">
						<br>
						<div class="text-center">
							<div class="settings-title-container">
								<p class="text middle grey bold"><span class="text bold blue">Map</span></p>
							</div>
						</div>
					</div>

					<div class="cell white settings-cell col-md-3 col-sm-2 col-xs-4 clear-padding">
						<br>
						<div class="text-center">
							<div class="settings-title-container">
								<p class="text middle grey bold"><span class="text bold blue">Businesses:</span> 26</p>
							</div>
						</div>
					</div>

					<div class="cell white settings-cell col-md-3 col-sm-2 col-xs-4 clear-padding">
						<br>
						<div class="text-center">
							<div class="settings-title-container">
								<p class="text middle grey bold"><span class="text bold blue">Job positions:</span> 145</p>
							</div>
						</div>
					</div>

					<div class="cell white settings-cell col-md-3 col-sm-2 col-xs-4 clear-padding">
						<br>
						<div class="text-center">
							<div class="settings-title-container">
								<p class="text middle grey bold"><span class="text bold blue">City:</span> 322</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br />

	<div class="container">
		<div id="map-canvas" class="small-map relative container-map"></div>
	</div>
	<br />

	<div class="container relative">
		<div class="col-md-12 col-xs-12 fade-in" >
			<div class="card">
				<div class="search-company-content clear-margin">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1 text-center">
							<span class="header-title">Businesses</span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="items">
								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app//img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app//img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->
							</div>
							<a class="button small link">More<img src="{{ asset('/ui/app/img/left-arrow.png') }}"></a>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<!-- title -->
							<div class="items">
								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<br/>

		<div class="col-md-12 col-xs-12 fade-in mt-2" >
			<div class="card">
				<div class="search-company-content clear-margin">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1 text-center">
							<span class="header-title">JOB POSITIONS IN YOUR AREA</span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="items">
								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app//img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app//img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->
							</div>
							<a class="button small link">More<img src="{{ asset('/ui/app/img/left-arrow.png') }}"></a>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<!-- title -->
							<div class="items">
								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<br/>

		<div class="col-md-12 col-xs-12 fade-in" >
			<div class="card">
				<div class="search-company-content clear-margin">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-sm-offset-0 col-xs-11 col-xs-offset-1 text-center">
							<span class="header-title">Top Businesses with available job positions in city</span>
						</div>
					</div>
					<div class="col-md-12">
						<div class="col-md-6 col-sm-12 col-xs-12">
							<div class="items">
								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app//img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app//img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->
							</div>
							<a class="button small link">More<img src="{{ asset('/ui/app/img/left-arrow.png') }}"></a>
						</div>
						<div class="col-md-6 col-sm-12 col-xs-12">
							<!-- title -->
							<div class="items">
								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->

								<!-- item -->
								<div class="row">
									<!-- logo -->
									<div class="col-md-3">
										<div class="col-md-10 company-logo">
											<img src="{{ asset('/ui/app/img/bmw.png') }}">
										</div>
									</div>
									<!-- description -->
									<div class="col-md-9 clear-md-padding">

										<div class="">
											<div class="">
												<span class="title">Ford company</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Need someone for something</span>
											</div>
										</div>

										<div class="">
											<div class="text-wrapper">
												<div class="logo-wrapper">
													<img alt="education" src="{{ asset('/ui/app/img/case.png') }}">
												</div>
												<span class="text">Description: Lorem ipsum</span>
												<span class="info-text pull-right">View job</span>
											</div>
										</div>

									</div>
									<!-- end description -->
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
								<!-- end item -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<br />

@endsection