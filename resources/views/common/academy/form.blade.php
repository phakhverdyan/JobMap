
<div class="container-fluid px-0" style="overflow: hidden;">
	<div class="col-12 bg-white buttons_div">
		<span style="position: absolute; top: -25px; right: 60px; font-size: 16px;" class="d-flex">
		    <a class="cr-nav-text mr-3" href="#" id="show-sign-in" data-toggle="modal" data-target="#signInModal" style="color:#9c9c9c;">Login</a>
		    <a href="#" style="color:#9c9c9c;"><strong><i>Hiring?</i></strong></a>
		</span>
		<div class="container">
			<div class="col-12">
				<p class="text-center mt-5">
					<a href="{{ url('/') }}">
						<img src="{{ asset('img/landing/cr-logo.png') }}" width="70px" class="wow animated fadeInDown">
					</a>
				</p>
			</div>
		</div>
	</div>

	<div class="col-12 pb-5">
		<div class="container">
			<div class="col-12 mt-5 wow animated fadeInDown">

				@include('common.academy.form_header')

				<div class="text-center col-12 col-lg-6 mx-auto mt-5">
					<div class="mb-3 mx-auto text-center font-16">
						Track your {{ $child }} career progress
					</div>
					<div class="mb-0 mx-auto text-center font-16">
						<strong>Activate and Share this link</strong>
					</div>
				</div>

				<form id="form-user-academy" data-type="{{ $active }}" autocomplete="off">
					<div class="col-12 col-lg-6 mx-auto">
						<p class="mt-3">
							<div class="input-group col-12 mb-3 px-0">
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
									<input type="text" id="link-user-profile" name="token" class="form-control border-0 bg-white" readonly value="{!! route($routeName,['token' => $token ]) !!}" style="box-shadow: none; height: 30px; margin-top: 3px;">
								</div>
								<button class="btn btn-outline-primary mx-0" type="button" style="border-top-left-radius: 0; border-bottom-left-radius: 0;" data-clipboard-action="copy" data-clipboard-target="#link-user-profile" id="clipboard-button">
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
						<div class="row">
							<div class="col-6">
								<p class="mt-3"><input type="text" name="first_name" value="{{ $data['first_name'] or "" }}" placeholder="First name" class="form-control rounded"  autocomplete="off"></p>
							</div>
							<div class="col-6">
								<p class="mt-3"><input type="text" name="last_name" value="{{ $data['last_name'] or "" }}" placeholder="Last name" class="form-control rounded"  autocomplete="off"></p>
							</div>
						</div>
						<div class="form-group mb-3">
							<label>Pick a username</label>
							<input type="text" class="form-control" placeholder="Pick a username" name="username" value="{{ $data['username'] or "" }}"  autocomplete="off">
						</div>
						<p class="mt-3"><input type="text" name="email"  value="{{ $data['email'] or "" }}"placeholder="Your Email" class="form-control rounded"  autocomplete="off"></p>
						<div class="d-flex justify-content-center flex-column flex-sm-row mb-2">
							<div class="col-12 col-sm-4 pl-0 pxa-0">
								<div class="mb-2 mb-sm-0">
									<label class="form-control-label">Year</label>
									<select class="select" name="user-year" style="width: 100%;">
										@for($i = date('Y') - 13; $i>= date('Y') - 150; $i--)
											<option @isset($data['birthdate'])
													@if($i == date('Y', $data['birthdate']))
													{{ "selected" }}
													@endif
													@endisset
													value="{{ $i }}">{{ $i }}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="col-12 col-sm-4 pxa-0">
								<div class="mb-2 mb-sm-0">
									<label class="form-control-label">Month</label>
									<select class="select" name="user-month" style="width: 100%;">
										@for($m = 1; $m <= 12; $m++)
											<option @isset($data['birthdate'])
													@if($m == date('n', $data['birthdate']))
													{{ "selected" }}
													@endif
													@endisset
													@empty($data['birthdate'])
													@if($m == date('n'))
													{{ "selected" }}
													@endif
													@endempty
													value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
										@endfor
									</select>
								</div>
							</div>
							<div class="col-12 col-sm-4 pr-0 pxa-0">
								<div class="mb-2 mb-sm-0">
									<label class="form-control-label">Day</label>
									<select class="select" name="user-day" style="width: 100%;">
										@for($d = 1; $d <= date('t'); $d++)
											<option @isset($data['birthdate'])
													@if($d == date('j', $data['birthdate']))
													{{ "selected" }}
													@endif
													@endisset
													@empty($data['birthdate'])
													@if($d == date('j'))
													{{ "selected" }}
													@endif
													@endempty
													value="{{ $d }}">{{ $d }}</option>
										@endfor
									</select>
								</div>
							</div>
						</div>
						<div class="form-group mb-3">
							<div class="input-group mb-3">
								<span class="input-group-addon" id="basic-addon1"><i class="glyphicon"></i> </span>
								<input type="text" class="form-control border-right-0" placeholder="Enter your location" id="academy-location" name="city"  autocomplete="off">
								<span class="input-group-btn border-0">
									<button class="btn mx-0" type="button" id="academy-location-clear" style="background-color: #e9ecef; border: 1px solid #ced4da; border-left: 0px;">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
								</span>
							</div>
						</div>
						{{--<div class="row">
							<div class="col-6">
								<p class="mt-3"><input type="text" name="city" placeholder="City" class="form-control rounded" id=""></p>
							</div>
							<div class="col-6">
								<p class="mt-3"><input type="text" name="region" placeholder="Region" class="form-control rounded"></p>
							</div>
						</div>--}}
						<p class="mt-3"><input type="text" name="teaching" placeholder="What are you teaching" class="form-control rounded"  autocomplete="off"></p>
						<p class="mt-3"><input type="text" name="academy" placeholder="Academy name" class="form-control rounded"  autocomplete="off"></p>
						<div class="row">
							<div class="col-6">
								<p class="mt-3"><input type="password" class="form-control" placeholder="Choose password" name="password" autocomplete="new-password"></p>
							</div>
							<div class="col-6">
								<p class="mt-3"><input type="password" class="form-control" placeholder="Confirm password" name="confirm_password" autocomplete="new-password"></p>
							</div>
						</div>
					</div>
					<div class="text-center col-12 col-lg-8 mx-auto mt-5">
						<button class="btn py-2 build_CR_green btn-block">
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510; vertical-align: middle; margin-top: -4px;" xml:space="preserve" class="mr-2">
								<g>
									<g id="check-circle-outline">
										<path d="M150.45,206.55l-35.7,35.7L229.5,357l255-255l-35.7-35.7L229.5,285.6L150.45,206.55z M459,255c0,112.2-91.8,204-204,204    S51,367.2,51,255S142.8,51,255,51c20.4,0,38.25,2.55,56.1,7.65l40.801-40.8C321.3,7.65,288.15,0,255,0C114.75,0,0,114.75,0,255    s114.75,255,255,255s255-114.75,255-255H459z"/>
									</g>
								</g>
							</svg>
							Activate and Share this link
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@include('common.academy.form_footer')

</div>
