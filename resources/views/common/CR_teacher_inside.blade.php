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
							<p class="mb-1"><strong>Mark Bruk's students (1)</strong></p>
							<p class="text-muted mb-0">Neuroscience, psychology</p>
							<p class="text-muted"><a href="#">Yale</a>, New York</p>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

							<div class="d-flex w-100 justify-content-between flex-md-row flex-column">
								<div class="d-flex">
									<div>
										<a href="#">
											<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
										</a>
									</div>
									<div>
										<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
										<p class="text-muted mb-0">Waiter at Barrys</p>
										<p class="text-muted">Yale University</p>	
									</div>
								</div>
								<div>
									<p class="text-muted mb-0">Adde Feb 2018</p>
									<p class="text-muted">Updated 3 days ago</p>
								</div>
							</div>

						</div>
						<div class="col-lg-4 col-md-12 mt-3">
							<p class="text-center"><strong>Add students</strong></p>
							<p>
								<div class="input-group col-12 mb-3 px-0">
	                                <div class="d-flex" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);border: 1px solid rgba(78,92,110,.1); border-top-left-radius: 5px; border-bottom-left-radius: 5px; flex: 1;">
	                                	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 496 496" style="enable-background:new 0 0 496 496; margin-top: 4px; fill:#9BA6B2;" xml:space="preserve" width="30px" height="30px" class="mx-2">
			                            <g>
			                                <g>
			                                    <g>
			                                        <path d="M447.812,390.192c-5.368-32.232-27.968-58.68-58.976-69.016l-68.832-22.944V288h-16v11.816     c-8.504,5.656-32.624,20.184-56,20.184c-23.376,0-47.496-14.528-56-20.184V288h-16v10.232l-68.832,22.944     c-31,10.336-53.6,36.784-58.976,69.016L30.556,496h434.888L447.812,390.192z M182.716,312.864     C192.228,319.288,219.7,336,248.004,336s55.776-16.712,65.288-23.136l13.896,4.632l-79.184,79.192l-79.192-79.192     L182.716,312.864z M240.004,480h-119.16l7.12-71.2l-15.92-1.592l-7.28,72.8H49.452L63.98,392.84     c4.392-26.376,22.888-48.008,48.256-56.472l3.616-1.208l124.152,124.152V480z M132.812,329.496l19.032-6.344l96.16,96.16     l96.16-96.16l19.032,6.344L248.004,444.688L132.812,329.496z M391.244,480l-7.28-72.8l-15.92,1.592l7.12,71.2h-119.16v-20.688     l124.16-124.16l3.616,1.208c25.368,8.456,43.856,30.096,48.256,56.472L446.556,480H391.244z"></path>
			                                        <path d="M104.004,176c0-10.416-6.712-19.216-16-22.528V87.544l40,28.568V144.2c-9.656,7.312-16,18.784-16,31.792     c0,20.528,15.6,37.296,35.536,39.552c4.08,14.04,11.616,26.912,22.24,37.536l31.2,31.2c7.552,7.56,17.592,11.72,28.28,11.72     h37.496c10.68,0,20.728-4.16,28.28-11.712l31.2-31.2c10.624-10.624,18.16-23.504,22.24-37.536     c19.928-2.256,35.528-19.024,35.528-39.552c0-13.016-6.344-24.488-16-31.792V116.12l56-40V50.136L266.412,0.368L232.004,0     l-160,50.136V72v4.12v77.36c-9.288,3.304-16,12.104-16,22.52v32h48V176z M128.004,176c0-10.416,6.712-19.216,16-22.528v37.392     c0,2.616,0.152,5.208,0.376,7.784C134.9,195.44,128.004,186.552,128.004,176z M336.004,190.864     c0,19.232-7.488,37.312-21.088,50.912l-31.2,31.2c-4.464,4.464-10.648,7.024-16.968,7.024h-37.496     c-6.32,0-12.496-2.56-16.968-7.024l-31.2-31.2c-13.6-13.6-21.088-31.68-21.088-50.912V145.92     c19.64-4.464,51.128-9.92,88.008-9.92c36.816,0,68.344,5.464,88,9.928V190.864z M248.004,120c-47.632,0-86.224,8.568-104,13.336     v-15.384c14.136-4.008,54.24-13.952,104-13.952c49.64,0,89.84,9.952,104,13.952v15.376C334.228,128.568,295.636,120,248.004,120z      M351.628,198.64c0.224-2.568,0.376-5.16,0.376-7.776v-37.392c9.288,3.312,16,12.112,16,22.528     C368.004,186.552,361.108,195.44,351.628,198.64z M88.004,61.864L233.236,16h29.528l145.24,45.864v6.016l-49.424,35.304     C345.788,99.384,302.964,88,248.004,88c-54.96,0-97.784,11.384-110.576,15.184L88.004,67.88V61.864z M88.004,192h-16v-16     c0-4.408,3.592-8,8-8s8,3.592,8,8V192z"></path>
			                                        <rect x="88.004" y="224" width="16" height="48"></rect>
			                                        <rect x="56.004" y="224" width="16" height="48"></rect>
			                                    </g>
			                                </g>
			                            </g>
			                            </svg>
	                                    <input type="text" class="form-control border-0 bg-white" placeholder="Student email" style="box-shadow: none; height: 30px; margin-top: 3px;">
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
							<p class="mb-2 text-center">or share</p>
							<p class="text-center font-18">
								<div class="input-group col-12 mx-auto mb-3 px-0">
				                    <div class="d-flex" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);border: 1px solid rgba(78,92,110,.1); border-top-left-radius: 5px; border-bottom-left-radius: 5px; flex: 1;">
				                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 426.995 426.995" style="enable-background:new 0 0 426.995 426.995; margin-top: 4px; fill:#9BA6B2;" xml:space="preserve" width="30px" height="30px" class="mx-2">
											<g>
												<g>
													<path d="M64.064,149.662h127.477v-42.667H64.064C28.697,106.995,0,135.599,0,170.923v85.35c0,35.305,28.744,63.928,64.064,63.928    h127.477v-42.667H64.064c-11.797,0-21.398-9.561-21.398-21.261v-85.35C42.667,159.194,52.23,149.662,64.064,149.662z"/>
												</g>
											</g>
											<g>
												<g>
													<path d="M362.93,106.793H235.453v42.667H362.93c11.834,0,21.398,9.532,21.398,21.261v85.35c0,11.7-9.601,21.261-21.398,21.261    H235.453v42.667H362.93c35.321,0,64.064-28.623,64.064-63.928v-85.35C426.995,135.397,398.298,106.793,362.93,106.793z"/>
												</g>
											</g>
											<g>
												<g>
													<rect x="128.291" y="192.154" width="170.667" height="42.667"/>
												</g>
											</g>
										</svg>
				                        <input type="text" class="form-control border-0 bg-white" readonly placeholder="jobmap.co/teacher/123" style="box-shadow: none; height: 30px; margin-top: 3px;">
				                    </div>
				                    <button class="btn btn-outline-primary mx-0" type="button" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
				                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 470.333 470.333" style="enable-background:new 0 0 470.333 470.333; margin-top: -6px; vertical-align: middle;" xml:space="preserve" width="20px" height="20px">
											<g>
												<g>
													<path d="M333.483,0h-194.65c-9.35,0-17,7.65-17,17v73.667H48.167c-9.35,0-17,7.65-17,17v345.667c0,9.35,7.65,17,17,17h286.167    c9.35,0,17-7.65,17-17v-76.5h70.833c9.35,0,17-7.65,17-17V106.25c0-4.533-1.7-8.783-4.817-11.9L345.667,5.1    C342.55,1.7,338.017,0,333.483,0z M317.333,436.333H65.167V124.667h56.667v235.167c0,9.35,7.65,17,17,17h178.5V436.333z     M155.833,342.833V34h147.333v96.333c0,9.35,7.65,17,17,17h85v195.5H155.833z M405.167,113.333h-68V44.767L405.167,113.333    L405.167,113.333z"/>
												</g>
											</g>
										</svg>
				                    </button>
				                </div>
							</p>
							<p><strong>2 Invites sent</strong></p>
							<div>
								<div class="w-100">
									<p class="text-muted mb-0">test@gmail.com</p>
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


<!-- 
		<div class="col-12 wow animated fadeInLeft">
			<div class="container">
				<div class="d-flex justify-content-between">
					<div class="col-9 mt-3">
						<div class="d-flex w-100 justify-content-between flex-lg-row flex-column">
							<div class="d-flex">
								<div>
									<a href="#">
										<img src="{{ asset('img/landing/avatar.png') }}" style="width: 70px; height: 70px;" class="mr-3 rounded">
									</a>
								</div>
								<div>
									<p class="mb-1 font-18"><a href="#" style="color:#3e4552;"><strong>Mark Bruk</strong></a></p>
									<p class="text-muted mb-0">Waiter at Barrys</p>
									<p class="text-muted">Yale University</p>	
								</div>
							</div>
							<div>
								<p class="text-muted mb-0">Adde Feb 2018</p>
								<p class="text-muted">Updated 3 days ago</p>
							</div>
						</div>
					</div>
					<div class="col-3 mt-3 pb-5">
						
					</div>
				</div>

			</div>
		</div> -->



		<footer class="py-5" style="background: #343434;">
			<div class="container">
				<p class="text-center mb-0">
					<img class="p-0" src="{{ url('/') }}/img/C_logo_white.png" width="45px">
				</p>
			</div>
		</footer>
		
	</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
