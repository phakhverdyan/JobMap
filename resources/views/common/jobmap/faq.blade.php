@extends('layouts.jobmap.common_user')

@section('content')
	<div class="page page-sign-up col-12 px-0 bg-white">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-sm-11 col-md-10 text-center">
					<form class="my-5 py-4 py-sm-4 bg-white rounded" autocomplete="off">
						<div class="row justify-content-center">
							<div class="col-lg-11">
								<div class="row justify-content-center">
									<div class="col-12">
										<h2 class="h2 text-uppercase">{!!trans('faq.FAQ_top_title') !!}</h2>
										<p class="h6">{!!trans('faq.faq_full') !!}</p>
										<p class="h6">{!!trans('faq.where_we_answer') !!}</p>

										<p class="h6">
											Visit our Youtube channel for information, tips and tricks and more
											<a href="#" class="mx-2">
								              	@svg('/img/social/youtube-logo2.svg', [
								                 'width' => '35px',
								                 'height' => '35px',
								                 'style' => 'fill: #45456c; vertical-align:middle; margin-top:-3px;',
								                ])
								            </a>
										</p>

						                <ul class="nav border-bottom-0 d-flex flex-lg-row flex-column mx-0 px-0" id="myTab" role="tablist" style="list-style: none;">
										  <li class="nav-item col-lg-6 mx-0">
										    <a class="btn btn-outline-primary rounded btn-block d-flex flex-column justify-content-center align-items-center py-4 active" id="Students-tab" data-toggle="tab" href="#Students" role="tab" aria-controls="Students" aria-selected="true">
										    	<svg xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" class="mb-2" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
			                                       <path d="M431.279,0H80.721c-5.633,0-10.199,4.566-10.199,10.199v491.602c0,5.633,4.566,10.199,10.199,10.199h266.562    c2.705,0,5.298-1.075,7.212-2.987l83.997-83.998c1.912-1.912,2.987-4.506,2.987-7.212V10.199C441.479,4.566,436.912,0,431.279,0z     M357.463,477.196l-0.044-49.257l49.257,0.045L357.463,477.196z M421.081,212.151c-5.565,0.08-10.053,4.609-10.053,10.192    c0,5.583,4.489,10.112,10.052,10.192v175.064l-73.862-0.067c-0.003,0-0.006,0-0.009,0c-2.705,0-5.298,1.075-7.212,2.987    c-1.914,1.915-2.989,4.513-2.987,7.221l0.067,73.862H90.92v-259.06h0.873c5.633,0,10.199-4.566,10.199-10.199    c0-5.633-4.566-10.199-10.199-10.199H90.92V20.398h330.161V212.151z"></path>
	                                               <path d="M325.318,66.347h-55.833c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h55.833    c5.632,0,10.199-4.566,10.199-10.199C335.517,70.913,330.95,66.347,325.318,66.347z"></path>
	                                               <path d="M390.63,113.204H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,117.77,396.261,113.204,390.63,113.204z"></path>
	                                               <path d="M390.63,160.128H269.484c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199H390.63    c5.632,0,10.199-4.566,10.199-10.199C400.829,164.694,396.261,160.128,390.63,160.128z"></path>
	                                               <path d="M250.335,268.291H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h120.805    c5.633,0,10.199-4.566,10.199-10.199C260.535,272.857,255.968,268.291,250.335,268.291z"></path>
	                                               <path d="M391.649,309.543H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,314.109,397.281,309.543,391.649,309.543z"></path>
	                                               <path d="M391.649,350.853H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h262.12    c5.632,0,10.199-4.566,10.199-10.199C401.849,355.419,397.281,350.853,391.649,350.853z"></path>
	                                               <path d="M239.681,421.227h-8.614c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h8.614    c5.633,0,10.199-4.566,10.199-10.199C249.88,425.793,245.314,421.227,239.681,421.227z"></path>
	                                               <path d="M195.825,421.227H129.53c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h66.295    c5.633,0,10.199-4.566,10.199-10.199C206.024,425.793,201.457,421.227,195.825,421.227z"></path>
	                                               <path d="M199.196,52.209c-5.223-5.574-12.599-8.771-20.237-8.771c-7.638,0-15.015,3.197-20.237,8.771    c-5.222,5.574-7.933,13.143-7.436,20.766l1.285,19.698c0.553,8.471,5.033,16.225,11.985,20.742    c4.374,2.843,9.389,4.263,14.403,4.263c5.014,0,10.029-1.421,14.403-4.263c6.953-4.517,11.433-12.272,11.985-20.742l1.285-19.698    C207.128,65.351,204.419,57.783,199.196,52.209z M186.276,71.647l-1.285,19.698c-0.136,2.081-1.161,3.935-2.743,4.963    c-1.999,1.298-4.581,1.297-6.581,0c-1.582-1.028-2.607-2.883-2.743-4.963l-1.285-19.698c-0.133-2.045,0.565-3.995,1.966-5.491    s3.302-2.319,5.352-2.319c2.05,0,3.95,0.824,5.352,2.319C185.711,67.651,186.41,69.601,186.276,71.647z"></path>
	                                               <path d="M244.543,169.528l-2.229-12.302c-3.089-17.054-16.601-30.666-33.624-33.872c-2.57-0.483-5.196-0.728-7.807-0.728h-6.712    c-2.705,0-5.299,1.075-7.212,2.987c-2.137,2.137-4.978,3.314-8,3.314c-3.022,0-5.864-1.177-8-3.314    c-1.912-1.912-4.507-2.987-7.212-2.987h-6.712c-2.611,0-5.237,0.245-7.809,0.729c-17.021,3.206-30.533,16.816-33.623,33.871    l-2.229,12.302c-0.539,2.975,0.269,6.035,2.208,8.356c1.937,2.32,4.804,3.661,7.827,3.661h111.097c3.023,0,5.89-1.341,7.828-3.661    C244.273,175.564,245.082,172.503,244.543,169.528z M135.624,161.147l0.051-0.285c1.593-8.793,8.556-15.81,17.325-17.461    c1.329-0.25,2.685-0.377,4.035-0.377h2.948c11.209,8.383,26.744,8.383,37.953,0h2.948c1.348,0,2.706,0.127,4.034,0.376    c8.77,1.651,15.733,8.669,17.326,17.462l0.052,0.285H135.624z"></path>
	                                               <path d="M357.875,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C368.074,216.71,363.507,212.143,357.875,212.143z"></path>
	                                               <path d="M319.862,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C330.062,216.71,325.494,212.143,319.862,212.143z"></path>
	                                               <path d="M129.804,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C140.003,216.71,135.437,212.143,129.804,212.143z"></path>
	                                               <path d="M243.84,212.143h-12.671c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.671    c5.633,0,10.199-4.566,10.199-10.199C254.039,216.71,249.473,212.143,243.84,212.143z"></path>
	                                               <path d="M205.828,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C216.027,216.71,211.461,212.143,205.828,212.143z"></path>
	                                               <path d="M395.886,212.143h-12.672c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.567,10.199,10.199,10.199h12.672    c5.632,0,10.199-4.566,10.199-10.199C406.085,216.71,401.518,212.143,395.886,212.143z"></path>
	                                               <path d="M281.851,212.143h-12.67c-5.632,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.632,0,10.199-4.566,10.199-10.199C292.05,216.71,287.483,212.143,281.851,212.143z"></path>
	                                               <path d="M167.817,212.143h-12.67c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199h12.67    c5.633,0,10.199-4.566,10.199-10.199C178.016,216.71,173.45,212.143,167.817,212.143z"></path>
												</svg>
                                           		<span class="h5 mb-0">{!! trans('landing.nav.job_seeker') !!}</span>
										    </a>
										  </li>
										  <li class="nav-item col-lg-6 mx-0">
										    <a class="btn btn-outline-primary rounded btn-block d-flex flex-column justify-content-center align-items-center py-4" id="Employer-tab" data-toggle="tab" href="#Employer" role="tab" aria-controls="Employer" aria-selected="false">
										    	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" class="mb-2" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 128 128" enable-background="new 0 0 128 128" xml:space="preserve">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M28,40h-8v8h8V40z M60,32h-8v8h8V32z M76,32h-8v8h8V32z M92,32h-8v8h8V32z     M60,16h-8v8h8V16z M76,16h-8v8h8V16z M92,16h-8v8h8V16z M60,64h-8v8h8V64z M76,64h-8v8h8V64z M92,64h-8v8h8V64z M60,80h-8v8h8V80    z M92,80h-8v8h8V80z M60,96h-8v8h8V96z M92,96h-8v8h8V96z M60,48h-8v8h8V48z M76,48h-8v8h8V48z M92,48h-8v8h8V48z M28,56h-8v8h8    V56z M28,72h-8v8h8V72z M28,88h-8v8h8V88z M28,104h-8v8h8V104z M76,80h-8v8h8V80z M116,56h-8V8c0-4.422-3.578-8-8-8H44    c-4.422,0-8,3.578-8,8v16H12c-4.422,0-8,3.578-8,8v88c0,4.422,3.578,8,8,8h104c4.422,0,8-3.578,8-8V64    C124,59.578,120.422,56,116,56z M36,120H12V32h24V120z M100,120H76V96h-8v24H44V8h56V120z M116,120h-8v-8h8V120z M116,104h-8v-8h8    V104z M116,88h-8v-8h8V88z M116,72h-8v-8h8V72z"></path>
                                                </svg>
                                                <span class="h5 mb-0">{!! trans('landing.nav.employers') !!}</span>
										    </a>
										  </li>
										</ul>
									</div>
									<div class="col-12 mt-4">
										<div class="form-group mb-0 text-left">
											<small class="form-text text-muted mb-2">{!!trans('faq.search_question') !!}</small>
											<input type="text" class="form-control bg-light" placeholder="{!!trans('faq.search_input_placeholder') !!}"  autocomplete="off">
										</div>
									</div>

									
									

									<div class="tab-content col-12" id="myTabContent">
									  <div class="tab-pane fade show active" id="Students" role="tabpanel" aria-labelledby="Students-tab">
									  	<!-- STUDENTS FAQ -->
								  		<div class="col-12">
								  			<div class="panel-group mt-4">

	                                			<div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_1') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description">
				                                    	{!!trans('faq.students.text.id_1') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_2') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_2') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_3') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_3') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_4') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_4') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_6') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_6') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_7') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_7') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_8') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_8') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_9') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_9') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_10') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_10') !!}<br>
				                                    	{!!trans('faq.students.text.id_11') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_12') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_12') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_13') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_13') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_14') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_14') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_15') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_15') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_16') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_16') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.students.title.id_17') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description" style="display: none;">
				                                    	{!!trans('faq.students.text.id_17') !!}
				                                    </div>
				                                </div>
				                                
				                            </div>
										</div>
										<!-- /STUDENTS FAQ -->
									  </div>
									  <div class="tab-pane fade" id="Employer" role="tabpanel" aria-labelledby="Employer-tab">
									  	<!-- EMPLOYER FAQ -->
									  	<div class="col-12">
									  		<div class="panel-group mt-4">

	                                			<div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_1') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description">
				                                    	{!!trans('faq.employers.text.id_1') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_2') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_2') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_3') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_3') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_4') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_4') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_5') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_5') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_6') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_6') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_7') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_7') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_8') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_8') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_9') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_9') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_10') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_10') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_11') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_11') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_12') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_12') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_13') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_13') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_14') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_14') !!}
				                                    </div>
				                                </div>

				                                <div class="panel panel-default assign-panel mb-5">
			                                        <h5 class="panel-title mt-0 mb-3 text-left faq_title">
		                                                {!!trans('faq.employers.title.id_15') !!}
			                                        </h5>
				                                    <div class="text-justify faq_description"  style="display: none;">
				                                    	{!!trans('faq.employers.text.id_15') !!}
				                                    </div>
				                                </div>
				                            </div>
										</div>
										<!-- /EMPLOYER FAQ -->
									  </div>
									</div>
									
									<div class="col-11">
										<div class="mt-5">
											<div class="pt-3 pt-sm-5 pb-3">
												{!!trans('faq.cant_find') !!}
												<a href="#" class="mx-2">
									              @svg('/img/social/youtube-logo2.svg', [
									                 'width' => '35px',
									                 'height' => '35px',
									                 'style' => 'fill: #45456c; vertical-align:middle; margin-top:-3px;',
									                ])
									            </a>
												<div class="mt-3 text-center">
													<div class="d-inline-block bg-white">
														<!-- <button type="button" class="btn btn-outline-primary">Contact us</button> -->
														<button type="button" class="btn btn-success" data-toggle="modal" data-target="#supportModal">{!!trans('faq.contact_us') !!}</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

@endsection
