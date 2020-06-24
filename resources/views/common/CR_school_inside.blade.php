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
						<div class="col-lg-8 mx-auto col-md-12 mt-3">
							<p class="mb-1 font-18">2 directors , 13 teachers , 300 students</p>
							<p class="mb-1 font-18"><strong>School name</strong></p>
							<p class="text-muted mb-3">Houston, Texas, United States</p>
							

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column mb-3">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Director</p>
									</div>
								</div>
								<div class="d-flex">
									<div class="mr-3">
										<a href="#">31 teachers</a>
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
										<p class="text-muted mb-0">Proffesor, Math</p>	
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
