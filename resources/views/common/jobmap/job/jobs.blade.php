@extends('layouts.jobmap.main_business')

@section('content')
<style type="text/css">
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
			border-bottom:2px solid #007bff;
			padding-bottom: 2px;
		}
		.addnewlocationsvg{
			width: 40px;
			height: 40px;
			fill: #0275d8;
			transition: all .2s ease-in-out;
		}
		.test:hover .filtersvg{
			opacity: 1;
		}	
		.test:hover{
			border-bottom:2px solid #007bff;
			padding-bottom: 14px;
			fill:#0275d8;
		}
	</style>
    <div class="container-fluid pl-0">
		<div class="row">
			<!-- left menu begin -->
			<div class="col-md-3">
				@include('components.jobmap.sidebar.sidebar_business')
			</div>
			<!-- left menu eof -->

			<!-- content block begin-->
			<div class="col-md-8 pb-5 mt-5 card">
				<div class="row">
					<div class="col-md-12 mx-auto pt-2 card rounded-0 border-top-0 border-right-0 border-left-0 mb-0">
						<div class="row">

							<div class="col-md-12 px-0" style="border-bottom:2px solid #eee;">
								<div class="row">
									<div class="col-md-4">
										<span class="h6 px-3">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 511.999 511.999" xml:space="preserve" height="30px" style="opacity:0.3">
											<g>
												<g>
													<path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z"/>
												</g>
											</g>
											</svg>
										</span>

										<span class="leftmodalsorting h6 px-3" data-toggle="modal" data-target="#JobModal">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="366.736px" height="366.736px" viewBox="0 0 366.736 366.736" style="enable-background:new 0 0 366.736 366.736;" xml:space="preserve" class="jobsvg">
											<g>
												<path d="M338.11,75.789h-77.312V61.955c0-16.314-13.271-29.587-29.586-29.587h-95.688c-16.313,0-29.586,13.272-29.586,29.587   v13.834H28.627C12.842,75.789,0,88.63,0,104.414v201.328c0,15.784,12.842,28.626,28.627,28.626h309.482   c15.785,0,28.627-12.842,28.627-28.626V104.414C366.737,88.631,353.896,75.789,338.11,75.789z M130.939,61.955   c0-2.529,2.058-4.587,4.586-4.587h95.688c2.528,0,4.586,2.058,4.586,4.587v13.834h-104.86V61.955z M28.628,100.789H338.11   c2,0,3.627,1.626,3.627,3.625v65.598c-38.738,14.37-97.169,22.858-158.474,22.858c-61.17,0-119.521-8.459-158.263-22.781v-65.675   C25.001,102.415,26.628,100.789,28.628,100.789z M338.11,309.368H28.628c-2,0-3.627-1.626-3.627-3.626V196.575   c35.458,11.697,82.077,19.008,132.882,20.84c-0.003,0.145-0.021,0.285-0.021,0.432v5.513c0,10.335,8.408,18.743,18.744,18.743   h13.527c10.336,0,18.744-8.408,18.744-18.743v-5.513c0-0.147-0.02-0.291-0.021-0.438c50.837-1.848,97.449-9.18,132.883-20.9   v109.234C341.737,307.742,340.11,309.368,338.11,309.368z"/>
											</g>

											</svg>
										</span>
									</div>
									<div class="col-md-8">
										<div class="d-flex justify-content-end">
											<div class="pr-3">
												<span class="pr-1">Per page:</span>
												<span class="test h6 px-1"><a href="#" style="text-decoration: none;">25</a></span>
												<span class="test h6 px-1"><a href="#" style="text-decoration: none;">50</a></span>
												<span class="test h6 px-1"><a href="#" style="text-decoration: none;">100</a></span>
												<span class="test h6 px-1"><a href="#" style="text-decoration: none;">200</a></span>
											</div>
											<div class="pr-3">
												<span class="test h6 mr-1 ml-3">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 50 50" xml:space="preserve" class="filtersvg">
													<g>
														<rect y="3" width="50" height="2"/>
														<rect y="17" width="50" height="2"/>
														<rect y="31" width="50" height="2"/>
														<rect y="45" width="50" height="2"/>
													</g>
													</svg>
												</span>
												<span class="test h6 ml-1">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="22px" height="18px" viewBox="0 0 965.199 965.199" xml:space="preserve" class="filtersvg">
													<g>
														<path d="M263.85,30c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202.1c0,16.6,13.4,30,30,30h202.1c16.6,0,30-13.4,30-30V30   H263.85z"/>
														<path d="M613.55,30c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202.1c0,16.6,13.4,30,30,30h202c16.6,0,30-13.4,30-30V30z"/>
														<path d="M963.25,30c0-16.6-13.4-30-30-30h-202c-16.601,0-30,13.4-30,30v202.1c0,16.6,13.399,30,30,30h202.1c16.601,0,30-13.4,30-30   V30H963.25z"/>
														<path d="M263.85,381.6c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202c0,16.6,13.4,30,30,30h202.1c16.6,0,30-13.4,30-30v-202   H263.85z"/>
														<path d="M613.55,381.6c0-16.6-13.4-30-30-30h-202c-16.6,0-30,13.4-30,30v202c0,16.6,13.4,30,30,30h202c16.6,0,30-13.4,30-30V381.6z   "/>
														<path d="M963.25,381.6c0-16.6-13.4-30-30-30h-202c-16.601,0-30,13.4-30,30v202c0,16.6,13.399,30,30,30h202.1   c16.601,0,30-13.4,30-30v-202H963.25z"/>
														<path d="M233.85,703.1h-202c-16.6,0-30,13.4-30,30v202.1c0,16.602,13.4,30,30,30h202.1c16.6,0,30-13.398,30-30V733.1   C263.85,716.6,250.45,703.1,233.85,703.1z"/>
														<path d="M583.55,703.1h-202c-16.6,0-30,13.4-30,30v202.1c0,16.602,13.4,30,30,30h202c16.6,0,30-13.398,30-30V733.1   C613.55,716.6,600.149,703.1,583.55,703.1z"/>
														<path d="M933.25,703.1h-202c-16.601,0-30,13.4-30,30v202.1c0,16.602,13.399,30,30,30h202.1c16.601,0,30-13.398,30-30V733.1   C963.25,716.6,949.85,703.1,933.25,703.1z"/>
													</g>
													</svg>
												</span>
											</div>
										</div>
									</div>
									
								</div>
							</div>
							<div class="col-md-12 pb-2">
								<div class="d-flex justify-content-end">
									<div class="text-center pt-2 mt-1 pr-0 pr-2">
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
									<div class="pt-2 pl-0">
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

				<div class="row">
					<div class="col-md-12 mx-auto mt-0 px-0">
						<input type="text" name="" class="form-control border-top-0 border-right-0 border-left-0 rounded-0" placeholder="Find jobs by title">
					</div>
				</div>

				<div class="row">
					<div class="col-10 mx-auto px-0 mt-4">
	                    <div class="mb-4">
	                        <a href="{!! url('/business/job/add') !!}" class="btn btn-lg btn-outline-primary w-100 p-4" style="cursor:pointer;">
								<span class="d-block h3 mb-0">
									<svg id="Layer_1" width="45px" height="45px" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g><g><path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z" fill="#007bff"></path></g></g><g><polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7     384,247.9 264.1,247.9  " fill="#007bff"></polygon></g></g></svg>
								</span>
	                            Add Job
	                        </a>
	                    </div>
	                </div>
				</div>

				<!-- ONE LOCATION BEGIN -->
				<div class="row">
					<div class="col-md-10 mx-auto card py-3 rounded-0">
						<div class="row  px-0">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<p><strong>Job title</strong></p>
										<p>Job type</p>
									</div>
									<div class="col-md-2  offset-md-2">Jan 23, 2017</div>
									<div class="col-md-2 text-right">		
										<div style="position: relative;">	   
									      <img src="img/more.svg" alt="more" class="" data-toggle="dropdown" role="button" width="30%" style="opacity: 0.3; width: 29px; " />
										   <div class="dropdown-menu dropdown-menu-right">
										    <button class="dropdown-item" type="button">Edit</button>
										    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#ShareModal">Share</button>
										    <button class="dropdown-item" type="button">Clone</button>
										    <button class="dropdown-item" type="button">Delete</button>
										  </div> 
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="row no-gutters">
									<div class="col-md-4">
										<button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#ManaInLocModal">Quick Apply to</button>
									</div>
									<div class="col-md-4">
										<button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#OpenClosedModal">Opened in 21 locations</span></button>
									</div>
									<div class="col-md-4">
										<button class="btn btn-outline-primary btn-block rounded-0" role='button'>31 candidates</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ONE LOCATION EOF -->

				<!-- ONE LOCATION BEGIN -->
				<div class="row">
					<div class="col-md-10 mx-auto card py-3 rounded-0">
						<div class="row  px-0">
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-6">
										<p><strong>Job title</strong></p>
										<p>Job type</p>
									</div>
									<div class="col-md-2  offset-md-2">Jan 23, 2017</div>
									<div class="col-md-2 text-right">			<div style="position: relative;">	   
									      <img src="img/more.svg" alt="more" class="" data-toggle="dropdown" role="button" width="30%" style="opacity: 0.3; width: 29px; " />
										  <div class="dropdown-menu dropdown-menu-right">
										    <button class="dropdown-item" type="button">Edit</button>
										    <button class="dropdown-item" type="button" data-toggle="modal" data-target="#ShareModal">Share</button>
										    <button class="dropdown-item" type="button">Clone</button>
										    <button class="dropdown-item" type="button">Delete</button>
										  </div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12">
								<div class="row no-gutters">
									<div class="col-md-4">
										<button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#ManaInLocModal">Quick Apply to</button>
									</div>
									<div class="col-md-4">
										<button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#OpenClosedModal">Opened in 21 locations</span></button>
									</div>
									<div class="col-md-4">
										<button class="btn btn-outline-primary btn-block rounded-0" role='button'>31 candidates</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ONE LOCATION EOF -->

			</div>
			<!-- content block eof -->

		</div>
	</div>

<!-- MODAL WINDOWS -->
<!-- LOCATION FILTER MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="JobModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Filter jobs by location</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	        <input class="form-control" type="text" name="" placeholder="Type a job title" />

	        <div class="row py-3">
	        	<!-- one item begin -->
	        	<div class="col-md-12">
	        		<div class="row">
	        			<div class="col-md-1 pt-3">
	        				<label class="custom-control custom-checkbox m-0 pl-3">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-indicator"></span>
							</label>
	        			</div>
	        			<div class="col-md-8  pl-0">
	        				<p class="mt-3">Location</p>
	        			</div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        </div>

	      </div>

	      	<div class="row pb-2 px-3">
	      		<div class="col-md-6">
	      			<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Clear</button>
	      		</div>
	      		<div class="col-md-6">
	      			<button type="button" class="btn btn-primary btn-block" role="button">Set</button>
	      		</div>     
	      </div>
	    </div>
	  </div>
	</div>
	<!-- LOCATION FILTER MODAL END!!!!!!!!!!!!!!! -->
	<!-- SORT JOBS BY FILTER MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="SortByModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Sort jobs by</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	       	<div class="row">
	       		<div class="col-md-6 pr-0">
	       			<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Name</button>
	       		</div>
	       		<div class="col-md-6 pl-0">
					<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Added date Asc.</button>
	       		</div>
	       	</div>
	       	<div class="row">
	       		<div class="col-md-6 pr-0">
					<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Locations Asc.</button>
	       		</div>
	       		<div class="col-md-6 pl-0">
	       			<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Candidates Asc.</button>
	       		</div>
	       	</div>
	      </div>

	      	<div class="row pb-2 px-3">
	      		<div class="col-md-6">
	      			<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Clear</button>
	      		</div>
	      		<div class="col-md-6">
	      			<button type="button" class="btn btn-primary btn-block" role="button">Set</button>
	      		</div>       
	      </div>
	    </div>
	  </div>
	</div>
	<!-- SORT JOBS BY FILTER MODAL END!!!!!!!!!!!!!!! -->

	<!-- DISPLAY RESULTS FILTER MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="DisplayResModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Displat results</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	       	<div class="row">
	       		<div class="col-md-6 pr-0">
	       			<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">25</button>
	       		</div>
	       		<div class="col-md-6 pl-0">
					<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">50</button>
	       		</div>
	       	</div>
	       	<div class="row">
	       		<div class="col-md-6 pr-0">
					<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">100</button>
	       		</div>
	       		<div class="col-md-6 pl-0">
	       			<button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">200</button>
	       		</div>
	       	</div>
	      </div>

	      	<div class="row pb-2 px-3">
	      		<div class="col-md-12">
	      			<button type="button" class="btn btn-primary btn-block" role="button">Set</button>
	      		</div>


	        
	      </div>
	    </div>
	  </div>
	</div>
	<!-- DISPLAY RESULTS FILTER MODAL END!!!!!!!!!!!!!!! -->


	<!-- Quick apply job MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="ManaInLocModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Quick apply job to locations</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	       	 <input class="form-control" type="text" name="" placeholder="Type a location by name or address" />
	       	 <div class="row pb-3 pt-1 px-3">
	      		<div class="col-md-6 pl-0">
	      			<button type="button" class="btn btn-secondary btn-block"  role="button" data-toggle="modal" data-target="#assignall">Assign all</button>
	      		</div>
	      		<div class="col-md-6 pr-0">
	      			<button type="button" class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#unassignall">Unassign all</button>
	      		</div>
	      	</div>

	        <div class="row py-3 card border rounded-0 border-top-0">
	        	<h5 class="pl-3 pb-2">Assigned</h5>
	        	<!-- one item begin -->
	        	<div class="col-md-12 mt-2">
	        		<div class="row">
	        			<div class="col-md-1 pt-1 mt-2 pr-5">
	        				<label class="custom-control custom-checkbox m-0 pl-3">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-indicator"></span>
							</label>
	        			</div>
	        			<div class="d-inline-flex pl-0">
	        				<div class="row">
	        					<div class="col-md-12">
	        						<p class="my-0 px-3">Location name</p>
	        						<p class="my-0 px-3">Location address</p>		
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        </div>

	        <div class="row py-3">
	        	<h5 class="pl-3 pb-2">Unsassigned</h5>
	        	<!-- one item begin -->
	        	<div class="col-md-12 mt-2">
	        		<div class="row">
	        			<div class="col-md-1 pt-1 mt-2 pr-5">
	        				<label class="custom-control custom-checkbox m-0 pl-3">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-indicator"></span>
							</label>
	        			</div>
	        			<div class="d-inline-flex pl-0">
	        				<div class="row">
	        					<div class="col-md-12">
	        						<p class="my-0 px-3">Location name</p>
	        						<p class="my-0 px-3">Location address</p>		
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        	<!-- one item begin -->
	        	<div class="col-md-12 mt-2">
	        		<div class="row">
	        			<div class="col-md-1 pt-1 mt-2 pr-5">
	        				<label class="custom-control custom-checkbox m-0 pl-3">
								<input type="checkbox" class="custom-control-input">
								<span class="custom-control-indicator"></span>
							</label>
	        			</div>
	        			<div class="d-inline-flex pl-0">
	        				<div class="row">
	        					<div class="col-md-12">
	        						<p class="my-0 px-3">Location name</p>
	        						<p class="my-0 px-3">Location address</p>			
	        					</div>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        </div>

	      </div>

	      	<div class="row pb-2 px-3">
	      		<div class="col-md-6">
	      			<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Clear</button>
	      		</div>
	      		<div class="col-md-6">
	      			<button type="button" class="btn btn-primary btn-block" role="button">Set</button>
	      		</div>
	      	</div>

	    </div>
	  </div>
	</div>
	<!-- Quick apply job MODAL END!!!!!!!!!!!!!!! -->


	<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h5></h5>
	        <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	       	 <p><strong>Share this location, get more applicants</strong></p>
	       	 <input class="form-control text-center" type="text" name="sharelink" value="{{ url('/') }}/l/434343" readonly>
	         <button type="button" class="btn btn-primary btn-block mt-3" role='button'>Copy link</button>
	      </div>

	    </div>
	  </div>
	</div>
	<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->


	<!-- OPEN | CLOSED LOCATIONS FILTER MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="OpenClosedModal" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Opened in 21 locations | Closed in 2 locations</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pb-5">
	       	 <input class="form-control" type="text" name="" placeholder="Type a location by name or address" />
	       	 <div class="row pb-3 pt-1 px-3">
	      		<div class="col-md-6 pl-0">
	      			<button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Assigned to location</button>
	      		</div>
	      		<div class="col-md-6 pr-0">
	      			<button type="button" class="btn btn-primary btn-block" role="button">Unassigned</button>
	      		</div>
	      	</div>

	        <div class="row py-3 card border rounded-0 border-top-0">
	        	<h5 class="pl-3 pb-2">Open</h5>
	        	<!-- one item begin -->
	        	<div class="col-md-12 mt-2">
	        		<div class="row">
	        			<div class="col-md-8 text-center ml-3 card">
	        				<p class="my-0 px-3">Locations name</p>
	        				<p class="my-0 px-3">Address</p>
	        			</div>
	        			<div class="col-sm-5 col-md-2 offset-md-1">
					      	<label class="switch mt-3">
							  <input type="checkbox" checked>
							  <span class="slider round"></span>
							</label>
					    </div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        </div>

	        <div class="row py-3">
	        	<h5 class="pl-3 pb-2">Closed</h5>
	        	<!-- one item begin -->
	        	<div class="col-md-12 mt-2">
	        		<div class="row">
	        			<div class="col-md-8 text-center ml-3 card">
							<p class="my-0 px-3">Locations name</p>
	        				<p class="my-0 px-3">Address</p>
	        			</div>
	        			<div class="col-sm-5 col-md-2 offset-md-1">
					      	<label class="switch mt-3">
							  <input type="checkbox">
							  <span class="slider round"></span>
							</label>
					    </div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        	<!-- one item begin -->
	        	<div class="col-md-12 mt-2">
	        		<div class="row">
	        			<div class="col-md-8 text-center ml-3 card">
	        				<p class="my-0 px-3">Locations name</p>
	        				<p class="my-0 px-3">Address</p>
	        			</div>
	        			<div class="col-sm-5 col-md-2 offset-md-1">
					      	<label class="switch mt-3">
							  <input type="checkbox">
							  <span class="slider round"></span>
							</label>
					    </div>
	        		</div>
	        	</div>
	        	<!-- one item eof -->
	        </div>

	      </div>

	    </div>
	  </div>
	</div>
	<!-- OPEN | CLOSED JOBS FILTER MODAL END!!!!!!!!!!!!!!! -->

	<!--Assign all MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="assignall" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body pb-3">
	      	<p class="text-center">Are you sure you want to Assign all</p>
	      	<div class="col-md-12 mt-5 mb-2">
	      		<div class="row">
	      			<div class="col-md-4 offset-md-2">
	      				<button class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
	      			</div>
	      			<div class="col-md-4">
	      				<button class="btn btn-success btn-block" data-dismiss="modal">Accept</button>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	    </div>
	   </div>
	  
	</div>
	<!-- Assign all MODAL END!!!!!!!!!!!!!!! -->

	<!--Assign all MODAL!!!!!!!!!!!!!!! -->
	<div class="modal fade" id="unassignall" tabindex="-1" role="dialog" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-body pb-3">
	      	<p class="text-center">Are you sure you want to unassignall all</p>
	      	<div class="col-md-12 mt-5 mb-2">
	      		<div class="row">
	      			<div class="col-md-4 offset-md-2">
	      				<button class="btn btn-danger btn-block" data-dismiss="modal">Cancel</button>
	      			</div>
	      			<div class="col-md-4">
	      				<button class="btn btn-success btn-block" data-dismiss="modal">Accept</button>
	      			</div>
	      		</div>
	      	</div>
	      </div>
	    </div>
	   </div>
	</div>
	<!-- Assign all MODAL END!!!!!!!!!!!!!!! -->

	<!-- MODAL WINDOWS EOF -->

@endsection
