@extends('layouts.main_business')

@section('content')

	<style type="text/css">
		.addto:hover{
			background-color: #f7f7f7;
			transition: 0.5s;
			box-shadow: 0 5px 23px rgba(0,0,0,0.3);
		}
		.addto{
			background-color: #fff;
			transition: 0.5s;
		}
		.filtersvg{
			height: 18px;
			cursor: pointer;
			opacity: 0.2;
		}
		.jobsvg,.managersvg{
		   fill: #0275d8;
		   width: 25px;
		   height: 30px;
		   cursor: pointer;
		}
		.leftmodalsorting:hover{
			border-bottom:2px solid #4266ff;
			padding-bottom: 2px;
		}
		.addnewlocationsvg{
			width: 40px;
			height: 40px;
			fill: #0275d8;
			transition: all .2s ease-in-out;
		}
		.perpage:hover .filtersvg{
            opacity: 1;
        }
        .perpage:hover{
            border-bottom:2px solid #4266ff;
            padding-bottom: 11px;
            fill:#0275d8;
        }
	</style>

    <div class="container-fluid pl-0">
		<div class="row">
				<!-- left menu begin -->
				<div  id="slide-out" class="col-3 sidebar_adaptive">
                    @include('components.sidebar.sidebar_business')
                </div>
				<!-- left menu eof -->

				<!-- content block begin-->
				<div class="col-8 mx-auto pb-5 mt-5 card content-main" style="background-color: #eee;">
					<div class="row">

						<div class="col-12 card rounded-0 pt-3 pb-2 text-center">
							<div class="row">
								<div class="col-12">
									<div class="row">

										<div class="btn-group text-center col-md-12" data-toggle="buttons">
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">New</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">Viewed</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">Contacted</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">Interview</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">Moved</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">Employees</button>
											<button class="btn btn-outline-primary btn-block py-2 mt-0">Ex-employees</button>
									    </div>

									</div>
								</div>
								<div class="col-md-12">
									<div class="row">
										<div class="btn-group w-100 col-md-12 mt-3 mb-3" data-toggle="buttons">
											<label class="active btn btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center">
												<input type="radio" name="options" id="option1"  autocomplete="off" checked="">
												Import Employees
											</label>
											<label class="btn  btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center">
												<input type="radio" name="options" id="option2"  autocomplete="off">
												Confirmed Employees
											</label>
										</div>
									</div>
								</div>
								{{-- <div class="col-md-12 text-right">

									<small>
										<a href="{!! url('business/candidate/edit') !!}" class="form-text text-muted mb-0">
											<span style="vertical-align: middle;">
												<img src="{{ asset('img/edit.png') }}" style="margin-top: -5px;">
											</span>
											Edit pipeline
										</a>
									</small>
								</div> --}}


							</div>
						</div>

						<div class="col-md-12 card rounded-0 mt-3">
							<div class="row">
							<div class="col-md-12 card rounded-0 border-right-0 border-left-0 border-top-0">
								<div class="row">
									<div class="col-md-12 py-2" style="border-bottom:2px solid #eee;">
										<div class="row">
											<div class="col-md-12 text-right">
												<span class="pr-1">Per page:</span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">6</a></span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">12</a></span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">24</a></span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">48</a></span>
											</div>
										</div>
									</div>
									<div class="col-md-12 pb-2">
										<div class="row">

											<div class="col-md-4 mt-1 pt-2">
												<p class="mb-1 h6">Candidates</p>
											</div>

											<div class="col-md-4 offset-md-4">
												<div class="row">
													<div class="col-md-2 offset-md-3 text-center pt-2 mt-1 pr-0">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 417.138 417.138" style="height:21px; opacity: 0.8;" xml:space="preserve">
															<g>
																<g>
																	<path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
																	<path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
																</g>
															</g>
															</svg>
														</span>
													</div>
													<div class="col-md-7 pt-2 pl-0">
														<select class="form-control form-control-sm">
															<option>Name</option>
															<option>Added date Asc.</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 mt-0 px-0">
								<input type="text" name="" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" placeholder="Search a job category, job title, location or more">
							</div>

							<div class="col-md-11 mx-auto my-4">
								<div class="row">

									<div class="col-md-12 card rounded-0 py-4">
										<div class="row">

											<div class="col-md-12">
												<div class="row">

													<div class="col-md-9">
														<div class="row">
															<div class="col-md-12">
																<span class="pl-1 pr-4">
																	<img src="{{ asset('img/star.png') }}" style="width: 20px; margin-top: -5px;">
																</span>

																<span>
																	<img src="{{ asset('img/view.png') }}" style="width: 20px; margin-top: -5px;">
																	Vieved 3 times
																</span>

																<span class="pl-2">
																	<a href="#">History</a>
																</span>

															</div>

															<div class="col-md-12 pt-2">
																<div class="row">
																	<div class="pl-3"><img src="{{ asset('img/avatar.png') }}" style="max-width: 100%;"></div>
																	<div class="col-md-8">
																		<h6>Full name</h6>
																		<p class="mb-1"><img src="{{ asset('img/sidebar/locations.png') }}" style="margin-top: -5px;"> City of candidate</p>
																		<p class="mb-1">Headline</p>
																	</div>
																</div>
															</div>

														</div>
													</div>

													<div>
														<p class="mb-1 mt-2"><img src="{{ asset('img/page-blank.png') }}" style="width: 20px; margin-top: -5px;" /> <a href="{!! url('/business/candidate/list/profie/view') !!}"> View CloudResume </a></p>
														<p class="mb-1"><img src="{{ asset('img/share.png') }}" style="width: 20px; margin-top: -5px;" /> <a href="#">Move to other Location </a></p>
													</div>

												</div>
											</div>

											<div class="col-md-12 text-center">
												<p>Small description of candidate</p>
											</div>

											<div class="col-md-12">
												<div class="row">
													<div class="col-md-3">
														<button class="btn btn-outline-primary btn-block" role='button' data-toggle="modal" data-target="#pipeline">
															Employee
														</button>
													</div>

													<div class="col-md-3">
														<button class="btn btn-outline-primary btn-block">
															Ask update
														</button>
													</div>

													<div class="col-md-3">
														<button class="btn btn-outline-primary btn-block">
															Message
														</button>
													</div>

													<div class="col-md-3">
														<button class="btn btn-outline-primary btn-block">
															Add note
														</button>
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>
							</div>

							<div class="mx-auto mt-2">
								<nav aria-label="Page navigation example">
								  <ul class="pagination">
								    <li class="page-item"><a class="page-link" href="#"><</a></li>
								    <li class="page-item"><a class="page-link" href="#">1</a></li>
								    <li class="page-item"><a class="page-link" href="#">2</a></li>
								    <li class="page-item"><a class="page-link" href="#">3</a></li>
								    <li class="page-item"><a class="page-link" href="#">></a></li>
								  </ul>
								</nav>
							</div>

						</div>
				</div>
		</div>
	</div>
 	<!--pipeline MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="pipeline" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body pb-3">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <p class="h6 text-center">You are moving candidate in to your employee list.In which location do you want to move employee?</p>
            <form autocomplete="off">
				<div class="form-group">
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search location by name and address"  autocomplete="off">
				</div>
				<div class="btn-group text-center w-100" data-toggle="buttons">
					<button class="btn btn-outline-primary btn-block py-2 mt-0">Assign All</button>
					<button class="btn btn-outline-primary btn-block py-2 mt-0">Unassign All</button>
				</div>
            </form>
			<p class="mt-2">Assigned</p>
			<div class="card">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
			<p class="mt-4">Unassigned</p>
			<div class="card mt-2">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
          </div>

        </div>

       </div>

    </div>
    <!-- pipeline MODAL END!!!!!!!!!!!!!!! -->

@endsection
