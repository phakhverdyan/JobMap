<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>admin panel</title>
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/css/main.css') }}">
</head>
<body>

	<style type="text/css">
		p{
			font-family: 'Open Sans', sans-serif;
		}
		.btn-landing{
			border:1px solid #3b77d7;
			color:#3b77d7;
			fill:#3b77d7;
			background: #fff;
			font-weight: lighter;
			font-size: 24px;
		}
		.btn-landing:hover{
			background: #3b77d7;
			color:#fff;
			fill:#fff;
		}
		.btn-landing.active{
			background: #3b77d7;
			color:#fff;
			fill:#fff;
		}
		.build_CR{
			color:#fff;
			font-size: 24px;
			background: #ffc107;
			border:1px solid #ffc107;
		}
		.build_CR:hover{
			color:#ffc107;
			background: #fff;
			border:1px solid #ffc107;
		}
		.font-14{
			font-size: 14px;
		}
		.font-16{
			font-size: 16px;
		}
		.font-18{
			font-size: 18px;
		}
		.font-38{
			font-size: 38px;
		}
		@media only screen and (max-width: 768px){
			.build_CR {
		  		font-size: 15px;
			} 
		}
		.rotate {
			-webkit-animation: rotation 7s infinite linear;
			opacity: 0.2;
		}

		@-webkit-keyframes rotation {
				from {
						-webkit-transform: rotate(0deg);
				}
				to {
						-webkit-transform: rotate(359deg);
				}
		}
	</style>

	<div class="container-fluid px-0" style="overflow: hidden;">
		<div class="col-12">
			<div class="container">
				<div class="col-12">
					<p class="text-center pt-2"><img src="{{ asset('img/landing/cr-logo.png') }}" width="70px" class="wow animated fadeInDown"></p>
				</div>
			</div>
		</div>

		<div class="col-12 wow animated fadeInRight">
			<div class="container">
				<div class="col-12 pb-5">
					<div class="d-flex justify-content-between flex-lg-row flex-column-reverse">
						<div class="col-lg-8 col-md-12 mt-3">
							<p class="mb-1"><strong>Director's teachers (1)</strong></p>
							<p class="text-muted"><a href="#">Yale</a>, New York</p>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>
									</div>
								</div>
								<div class="d-flex">
									<div class="mr-3">
										<a href="#">31 students</a>
									</div>
									<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
									</div>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Math</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>


						</div>
						<div class="col-lg-4 col-md-12 mt-3">
							<p class="text-center"><strong>Add Teacher</strong></p>
							<p>
								<div class="input-group col-12 mb-3 px-0">
	                                <div class="d-flex" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);border: 1px solid rgba(78,92,110,.1); border-top-left-radius: 5px; border-bottom-left-radius: 5px; flex: 1;">
	                                	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512; width: 30px; height: 30px; margin-top: 4px; fill:#9BA6B2;" xml:space="preserve" class="mx-2">
											<g>
												<g>
													<g>
														<path d="M50.918,445.739c1.143,0,2.295-0.23,3.405-0.717c27.221-11.853,73.19-18.022,136.678-18.347l6.161,12.339     c2.116,4.216,7.245,5.939,11.452,3.814c4.215-2.108,5.931-7.228,3.814-11.443l-8.525-17.067     c-1.451-2.893-4.403-4.719-7.637-4.719c-69.538,0-118.204,6.468-148.762,19.772c-4.318,1.886-6.289,6.912-4.412,11.238     C44.493,443.819,47.625,445.739,50.918,445.739z"></path>
														<path d="M494.933,460.8h-17.067v-42.667c0-2.261-0.905-4.437-2.5-6.033l-51.268-51.26c1.604-3.337,2.569-7.031,2.569-10.974     c0-14.114-11.486-25.6-25.6-25.6c-14.114,0-25.6,11.486-25.6,25.6s11.486,25.6,25.6,25.6c3.942,0,7.629-0.964,10.965-2.56     l48.768,48.759V460.8H17.067C7.654,460.8,0,468.454,0,477.867v25.6C0,508.177,3.823,512,8.533,512s8.533-3.823,8.533-8.533v-25.6     h477.867v25.6c0,4.71,3.814,8.533,8.533,8.533c4.719,0,8.533-3.823,8.533-8.533v-25.6C512,468.454,504.337,460.8,494.933,460.8z      M401.067,358.4c-4.71,0-8.533-3.831-8.533-8.533s3.823-8.533,8.533-8.533s8.533,3.831,8.533,8.533S405.777,358.4,401.067,358.4z     "></path>
														<path d="M121.83,255.249c6.221,16.196,26.803,68.42,41.737,90.82l1.348,2.039c10.957,16.614,29.286,44.424,91.085,44.424     c61.79,0,80.128-27.81,91.085-44.424l1.348-2.039c14.933-22.4,35.507-74.624,41.737-90.82c11.145-2.773,19.43-12.86,19.43-24.849     v-34.133c0-11.127-7.134-20.617-17.067-24.141V128c0-33.69-17.741-95.923-83.362-101.931c-0.128-4.028-1.459-7.27-2.944-9.668     C297.839,2.842,274.287,0,256,0C104.158,0,102.4,143.616,102.4,145.067c0,4.71,3.814,8.525,8.516,8.525h0.017     c4.702,0,8.516-3.806,8.533-8.516c0.017-5.222,1.937-128.009,136.533-128.009c24.132,0,33.801,5.222,35.712,8.311     c0.265,0.435,0.99,1.604-0.683,4.941c-1.323,2.645-1.178,5.786,0.375,8.303c1.562,2.509,4.301,4.045,7.262,4.045     c75.657,0,76.791,81.86,76.8,85.333v51.2c0,4.71,3.814,8.533,8.533,8.533c4.71,0,8.533,3.831,8.533,8.533V230.4     c0,4.702-3.823,8.533-8.533,8.533c-3.558,0-6.741,2.21-7.996,5.538c-0.247,0.674-25.446,67.644-41.771,92.126l-1.399,2.116     c-10.223,15.514-24.235,36.753-76.834,36.753c-52.608,0-66.611-21.239-76.834-36.753l-1.399-2.116     c-16.324-24.482-41.523-91.452-41.779-92.126c-1.246-3.328-4.429-5.538-7.987-5.538c-4.702,0-8.533-3.831-8.533-8.533v-34.133     c0-2.313,0.922-4.412,2.423-5.948c3.098,6.955,9.421,13.21,20.045,14.268l29.201,21.897C173.414,243.106,187.554,256,204.8,256     h17.067C240.691,256,256,240.691,256,221.867C256,240.691,271.309,256,290.133,256H307.2c17.237,0,31.394-12.894,33.664-29.525     l31.189-23.381c3.772-2.825,4.54-8.175,1.707-11.947c-2.825-3.772-8.175-4.548-11.947-1.707l-21.751,16.316     c-3.251-10.402-12.86-18.022-24.329-18.022H281.6c-14.114,0-25.6,11.486-25.6,25.6c0-14.114-11.486-25.6-25.6-25.6h-34.133     c-11.46,0-21.069,7.62-24.328,18.022l-16.282-12.211c6.716-16.23,12.8-40.235,14.524-57.088     c26.897-0.478,104.713-3.763,139.332-25.37c7.851,30.31,33.05,55.817,34.321,57.08c3.336,3.336,8.73,3.336,12.066,0     c3.336-3.337,3.336-8.73,0-12.066c-0.316-0.316-31.633-31.983-31.633-62.234c0-3.831-2.56-7.202-6.255-8.226     c-3.678-1.024-7.629,0.546-9.591,3.831c-12.425,20.693-93.022,29.995-146.287,29.995c-4.71,0-8.533,3.823-8.533,8.533     c0,13.85-6.545,41.515-13.508,58.539c-2.722-1.638-3.49-4.693-3.558-7.339c0-4.71-3.823-8.533-8.533-8.533     c-14.114,0-25.6,11.486-25.6,25.6V230.4C102.4,242.389,110.686,252.476,121.83,255.249z M273.067,213.333     c0-4.702,3.823-8.533,8.533-8.533h34.133c4.71,0,8.533,3.831,8.533,8.533v8.533c0,9.412-7.654,17.067-17.067,17.067h-17.067     c-9.412,0-17.067-7.654-17.067-17.067V213.333z M187.733,213.333c0-4.702,3.831-8.533,8.533-8.533H230.4     c4.702,0,8.533,3.831,8.533,8.533v8.533c0,9.412-7.654,17.067-17.067,17.067H204.8c-9.412,0-17.067-7.654-17.067-17.067V213.333z     "></path>
														<path d="M298.658,307.226c0.009-4.702-3.797-8.533-8.499-8.559c-0.162,0-15.42-0.171-30.345-7.637     c-2.398-1.195-5.231-1.195-7.629,0c-14.925,7.467-30.191,7.637-30.319,7.637c-4.71,0-8.533,3.823-8.533,8.533     s3.823,8.533,8.533,8.533c0.725,0,16.845-0.094,34.133-7.654c17.28,7.56,33.408,7.654,34.133,7.654     C294.835,315.733,298.641,311.927,298.658,307.226z"></path>
														<path d="M315.708,409.95c-3.191,0.017-6.118,1.809-7.578,4.659l-8.533,16.708c-2.142,4.198-0.469,9.344,3.721,11.486     c1.237,0.631,2.569,0.93,3.874,0.93c3.106,0,6.101-1.698,7.612-4.651l6.153-12.066c46.643,0.128,84.207,3.618,111.735,10.377     c4.591,1.135,9.199-1.672,10.317-6.246c1.126-4.582-1.664-9.199-6.246-10.325C406.878,413.474,366.345,409.651,315.708,409.95z"></path>
														<path d="M247.467,418.133V435.2c0,4.71,3.823,8.533,8.533,8.533s8.533-3.823,8.533-8.533v-17.067c0-4.71-3.823-8.533-8.533-8.533     S247.467,413.423,247.467,418.133z"></path>
														<path d="M247.467,324.267c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533h17.067     c4.719,0,8.533-3.823,8.533-8.533c0-4.71-3.814-8.533-8.533-8.533H247.467z"></path>
													</g>
												</g>
											</g>
										</svg>
	                                    <input type="text" class="form-control border-0 bg-white" placeholder="Teacher email" style="box-shadow: none; height: 30px; margin-top: 3px;">
	                                </div>
	                                <button class="btn btn-outline-primary mx-0" type="button" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
	                                	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 487.958 487.958" style="enable-background:new 0 0 487.958 487.958; margin-top: -6px; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
											<g>
												<path d="M483.058,215.613l-215.5-177.6c-4-3.3-9.6-4-14.3-1.8c-4.7,2.2-7.7,7-7.7,12.2v93.6c-104.6,3.8-176.5,40.7-213.9,109.8   c-32.2,59.6-31.9,130.2-31.6,176.9c0,3.8,0,7.4,0,10.8c0,6.1,4.1,11.5,10.1,13.1c1.1,0.3,2.3,0.4,3.4,0.4c4.8,0,9.3-2.5,11.7-6.8   c73-128.7,133.1-134.9,220.2-135.2v93.3c0,5.2,3,10,7.8,12.2s10.3,1.5,14.4-1.8l215.4-178.2c3.1-2.6,4.9-6.4,4.9-10.4   S486.158,218.213,483.058,215.613z M272.558,375.613v-78.1c0-3.6-1.4-7-4-9.5c-2.5-2.5-6-4-9.5-4c-54.4,0-96.1,1.5-136.6,20.4   c-35,16.3-65.3,44-95.2,87.5c1.2-39.7,6.4-87.1,28.1-127.2c34.4-63.6,101-95.1,203.7-96c7.4-0.1,13.4-6.1,13.4-13.5v-78.2   l180.7,149.1L272.558,375.613z"/>
											</g>
										</svg>
	                                </button>
	                            </div>
							</p>
							<p><strong>2 Invites sent</strong></p>
							<div>
								<div class="w-100">
									<p class="text-muted mb-0">test@gmail.com <a data-toggle="modal" data-target="#editModal">edit</a></p>
									<div class="d-flex justify-content-between flex-sm-row flex-column">
										<span class="mr-3 pt-2">3 days ago</span>
										<span><button class="btn btn-sm btn-landing font-16">Resend</button></span>
									</div>
								</div>
								<div class="w-100">
									<p class="text-muted mb-0">test@gmail.com</p>
									<div class="d-flex justify-content-between flex-sm-row flex-column">
										<span class="mr-3 pt-2">3 days ago</span>
										<span><button class="btn btn-sm btn-landing font-16">Resend</button></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



		<footer class="py-5" style="background: #343434;">
			<div class="container">
				<p class="text-center mb-0">
					<img class="p-0" src="/img/C_logo_white.png" width="45px">
				</p>
			</div>
		</footer>
		
	</div>

<!-- edit MODAL -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header pt-0">
                    <h5 class="modal-title">Edit</h5>
                    <button type="button" class="close text-right mt-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pb-3">
                   <p><input type="text" name="" value="test@gmail.com" class="form-control"></p>
                   <div class="row">
                   		<div class="col-6">
                   			<button class="btn btn-outline-primary btn-block">Delete</button>
                   		</div>
                   		<div class="col-6">
                   			<button class="btn btn-primary btn-block">Save</button>
                   		</div>
                   </div>
                </div>

            </div>
        </div>
    </div>
<!-- edit MODAL END -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
