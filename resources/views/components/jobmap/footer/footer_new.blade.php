

<footer>
      <div class="container footer_grey py-4">
        <div class="d-flex flex-wrap flex-md-row flex-column">

          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <a href="javascript:;" class="d-flex">
                <img src="{{ asset('img/jm_logo.png') }}" class="align-self-center" width="45px">
                <p class="mb-0 logo_title align-self-center ml-3">JobMap</p>
            </a>
          </div>
          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <h3 class="mb-3 h6"><strong>{!! trans('landing.new.footer.title_1') !!}</strong></h3>
            <p class="mb-1"><a href="/about">{!! trans('main.footer.general.about') !!}</a></p>
            <p class="mb-1"><a href="javascript:;" data-toggle="modal" data-target="#supportModal">{!! trans('main.footer.general.contact') !!}</a></p>
            <p class="mb-1"><a href="/faq">{!! trans('main.footer.general.general_faq') !!}</a></p>
            <p class="mb-1"><a href="/sitemap">{!! trans('main.footer.general.site_map') !!}</a></p>
            <p class="mb-1"><a href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.job_seekers.login') !!}</a></p>
          </div>

          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <h3 class="mb-3 h6"><strong>{!! trans('landing.new.footer.title_2') !!}</strong></h3>
            <p class="mb-1"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.job_seekers.create_resume') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/map') !!}">{!! trans('main.footer.job_seekers.explore_jobs') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/career-with-us') !!}">{!! trans('landing.button.a_career_with_us') !!}</a></p>
          </div>

          <div class="col-lg-3 col-md-3 mb-3 mb-lg-0">
            <h3 class="mb-3 h6"><strong>{!! trans('landing.new.footer.title_3') !!}</strong></h3>
            <p class="mb-1"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.employers.create_account') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/pricing') !!}">{!! trans('main.footer.employers.pricing') !!}</a></p>
            <p class="mb-1"><a href="{!! url('/landing') !!}">{!! trans('main.footer.employers.more_information') !!}</a></p>
          </div>

        </div>
      </div>
      <hr>
      <div class="container pb-3">
        <div class="d-flex justify-content-between flex-lg-row flex-column">

          <div class="align-self-center d-flex flex-lg-row flex-column">

            <div class="align-self-center mr-lg-4 mb-2 mb-lg-0">
              <select class="form-control border-0 footer__change-language">
                {{--<option>Languages</option>--}}
              </select>
            </div>

            <div class="align-self-center mr-lg-4 mb-2 mb-lg-0">
              <a href="{!! url('/terms-of-service') !!}">{!! trans('main.footer.general.terms_of_service') !!}</a>
            </div>

            <div class="align-self-center mr-lg-4 mb-2 mb-lg-0" style="opacity: 0.7;">
              2018 JobMap ®
            </div>

            <div class="align-self-center">
              <a href="tel:+18442441447">1-844-244-1447</a>
            </div>


          </div>

          <div class="align-self-center mt-3 mt-lg-0">
            <a href="#" class="mx-2">
                @svg('/img/social/arroba.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
               @svg('/img/social/instagram.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
              @svg('/img/social/facebook-circle.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
              @svg('/img/social/linkedin.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
            <a href="#" class="mx-2">
              @svg('/img/social/youtube-logo2.svg', [
                 'width' => '35px',
                 'height' => '35px',
                 'style' => 'fill: #45456c;',
                ])
            </a>
          </div>

        </div>
      </div>
    </footer>
    {{--<footer class="footer">
		<div class="container">
			<div class="text-center mb-5 d-lg-none d-block">
				<p class="mb-1"><img class="footer-logo align-self-center" src="{{ asset('img/JobMap_white.png') }}" style="width: 75px;"></p>
				<p class="footer-title footer-color text-center mb-0">JobMap</p>
			</div>
			<div class="d-flex justify-content-between flex-lg-row flex-column mb-5 mb-lg-0">
				<div class="align-self-center col-12 col-lg-5">
					<div class="d-flex justify-content-between flex-md-row flex-column text-center">
						<a href="{!! url('/about') !!}" class="footer-color flex-1">{!! trans('main.footer.general.about') !!}</a>
						<a href="#" data-toggle="modal" data-target="#supportModal" class="footer-color flex-1">{!! trans('main.footer.general.contact') !!}</a>
						<a href="{!! url('/terms-of-service') !!}" class="footer-color flex-1">{!! trans('main.footer.general.terms_of_service') !!}</a>
					</div>
				</div>
				<div class="align-self-center col-12 col-lg-2 text-center d-lg-block d-none">
					<img class="footer-logo align-self-center" src="{{ asset('img/JobMap_white.png') }}" style="width: 75px;">
				</div>
				<div class="align-self-center col-12 col-lg-5">
					<div class="d-flex justify-content-between flex-md-row flex-column text-center">
						<a href="{!! url('/faq') !!}"  class="footer-color flex-1">{!! trans('main.footer.general.general_faq') !!}</a>
						<a href="{!! url('/sitemap') !!}"  class="footer-color flex-1">{!! trans('main.footer.general.site_map') !!}</a>
						<a href="javascript:;"  class="footer-color flex-1 jobmap__signup">{!! trans('landing.nav.get_started') !!}</a>

					</div>
				</div>

			</div>

			<div class="d-flex justify-content-between flex-md-row flex-column mt-2 text-center">
				<div class="col-12 col-lg-4 col-md-6">
					<p class="footer-title text-center">{!! trans('main.footer.job_seekers.title') !!}</p>
					<ul class="pl-0 flex-wrap justify-content-md-center" style="list-style: none; line-height: 2;">
						<li class="footer-color"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.job_seekers.create_resume') !!}</a></li>
						<li class="footer-color"><a href="http://jobmap.co">{!! trans('main.footer.job_seekers.explore_jobs') !!}</a></li>
						<li class="footer-color"><a href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.job_seekers.login') !!}</a></li>
						<li class="footer-color"><a href="{!! url('/') !!}">{!! trans('main.footer.general.learn_more') !!}</a></li>
					</ul>
				</div>
				<div class="col-12 col-lg-4 d-lg-block d-none">
					<p class="footer-title footer-color text-center">JobMap</p>
					<ul class="mb-2 pl-0 d-flex bottom_section align-self-center justify-content-center" style="list-style: none;">
						<li class="align-self-center pr-1">
							<a href="http://instagram.com" >
								<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									 viewBox="0 0 291.319 291.319" style="enable-background:new 0 0 291.319 291.319; vertical-align: middle; margin-top: -2px;" xml:space="preserve" width="30px" height="30px">
								<g>
									<path style="fill:transparent;" d="M145.659,0c80.44,0,145.66,65.219,145.66,145.66S226.1,291.319,145.66,291.319S0,226.1,0,145.66
										S65.21,0,145.659,0z"/>
									<path style="fill:#FFFFFF;" d="M195.93,63.708H95.38c-17.47,0-31.672,14.211-31.672,31.672v100.56
										c0,17.47,14.211,31.672,31.672,31.672h100.56c17.47,0,31.672-14.211,31.672-31.672V95.38
										C227.611,77.919,213.4,63.708,195.93,63.708z M205.908,82.034l3.587-0.009v27.202l-27.402,0.091l-0.091-27.202
										C182.002,82.116,205.908,82.034,205.908,82.034z M145.66,118.239c22.732,0,27.42,21.339,27.42,27.429
										c0,15.103-12.308,27.411-27.42,27.411c-15.121,0-27.42-12.308-27.42-27.411C118.23,139.578,122.928,118.239,145.66,118.239z
										 M209.65,193.955c0,8.658-7.037,15.704-15.713,15.704H97.073c-8.667,0-15.713-7.037-15.713-15.704v-66.539h22.759
										c-2.112,5.198-3.305,12.299-3.305,18.253c0,24.708,20.101,44.818,44.818,44.818s44.808-20.11,44.808-44.818
										c0-5.954-1.193-13.055-3.296-18.253h22.486v66.539L209.65,193.955z"/>
								</g>
								</svg>
							</a>
						</li>
						<li class="align-self-center pr-1">
							<a href="http://facebook.com">
								<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 291.319 291.319" style="enable-background:new 0 0 291.319 291.319; vertical-align: middle; margin-top: -2px;" xml:space="preserve" width="30px" height="30px">
								<g>
									<path style="fill:transparent;" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659
										S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z"/>
									<path style="fill:#FFFFFF;" d="M163.394,100.277h18.772v-27.73h-22.067v0.1c-26.738,0.947-32.218,15.977-32.701,31.763h-0.055
										v13.847h-18.207v27.156h18.207v72.793h27.439v-72.793h22.477l4.342-27.156h-26.81v-8.366
										C154.791,104.556,158.341,100.277,163.394,100.277z"/>
								</g>
								</svg>
							</a>
						</li>
						<li class="align-self-center pr-1">
							<a href="http://linkedin.com">
								<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196; vertical-align: middle; margin-top: -2px;" xml:space="preserve" width="30px" height="30px">
								<g>
									<circle style="fill:transparent;" cx="56.098" cy="56.097" r="56.098"/>
									<g>
										<path style="fill:#F1F2F2;" d="M89.616,60.611v23.128H76.207V62.161c0-5.418-1.936-9.118-6.791-9.118
											c-3.705,0-5.906,2.491-6.878,4.903c-0.353,0.862-0.444,2.059-0.444,3.268v22.524H48.684c0,0,0.18-36.546,0-40.329h13.411v5.715
											c-0.027,0.045-0.065,0.089-0.089,0.132h0.089v-0.132c1.782-2.742,4.96-6.662,12.085-6.662
											C83.002,42.462,89.616,48.226,89.616,60.611L89.616,60.611z M34.656,23.969c-4.587,0-7.588,3.011-7.588,6.967
											c0,3.872,2.914,6.97,7.412,6.97h0.087c4.677,0,7.585-3.098,7.585-6.97C42.063,26.98,39.244,23.969,34.656,23.969L34.656,23.969z
											 M27.865,83.739H41.27V43.409H27.865V83.739z"/>
									</g>
								</g>
								</svg>
							</a>
						</li>
						<li class="align-self-center">
							<a href="http://youtube.com">
								<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 511.627 511.627" style="enable-background:new 0 0 511.627 511.627; vertical-align: middle; margin-top: -2px; fill:#fff;" xml:space="preserve">
								<g>
									<g>
										<path d="M459.954,264.376c-2.471-11.233-7.949-20.653-16.416-28.264c-8.474-7.611-18.227-12.085-29.27-13.418
											c-35.02-3.806-87.837-5.708-158.457-5.708c-70.618,0-123.341,1.903-158.174,5.708c-11.227,1.333-21.029,5.807-29.407,13.418
											c-8.376,7.614-13.896,17.035-16.562,28.264c-4.948,22.083-7.423,55.391-7.423,99.931c0,45.299,2.475,78.61,7.423,99.93
											c2.478,11.225,7.951,20.653,16.421,28.261c8.47,7.614,18.225,11.991,29.263,13.134c35.026,3.997,87.847,5.996,158.461,5.996
											c70.609,0,123.44-1.999,158.453-5.996c11.043-1.143,20.748-5.52,29.126-13.134c8.377-7.607,13.897-17.036,16.56-28.261
											c4.948-22.083,7.426-55.391,7.426-99.93C467.377,319.007,464.899,285.695,459.954,264.376z M165.025,293.218h-30.549v162.45
											h-28.549v-162.45h-29.98v-26.837h89.079V293.218z M242.11,455.668H216.7v-15.421c-10.278,11.615-19.989,17.419-29.125,17.419
											c-8.754,0-14.275-3.524-16.556-10.564c-1.521-4.568-2.286-11.519-2.286-20.844V314.627h25.41v103.924
											c0,6.088,0.096,9.421,0.288,9.993c0.571,3.997,2.568,5.995,5.996,5.995c5.138,0,10.566-3.997,16.274-11.991V314.627h25.41V455.668
											z M339.183,413.411c0,13.894-0.855,23.417-2.56,28.558c-3.244,10.462-9.996,15.697-20.273,15.697
											c-9.137,0-17.986-5.235-26.556-15.697v13.702h-25.406v-189.29h25.406v61.955c8.189-10.273,17.036-15.413,26.556-15.413
											c10.277,0,17.029,5.331,20.273,15.988c1.704,4.948,2.56,14.369,2.56,28.264V413.411z M435.685,390.003h-51.104v24.839
											c0,13.134,4.374,19.697,13.131,19.697c6.279,0,10.089-3.422,11.42-10.28c0.376-1.902,0.571-7.706,0.571-17.412h25.981v3.71
											c0,9.329-0.195,14.846-0.572,16.563c-0.567,5.133-2.56,10.273-5.995,15.413c-6.852,10.089-17.139,15.133-30.841,15.133
											c-13.127,0-23.407-4.855-30.833-14.558c-5.517-7.043-8.275-18.083-8.275-33.12v-49.396c0-15.036,2.662-26.076,7.987-33.119
											c7.427-9.705,17.61-14.558,30.557-14.558c12.755,0,22.85,4.853,30.263,14.558c5.146,7.043,7.71,18.083,7.71,33.119V390.003
											L435.685,390.003z"/>
										<path d="M302.634,336.043c-4.38,0-8.658,2.101-12.847,6.283v85.934c4.188,4.186,8.467,6.279,12.847,6.279
											c7.419,0,11.14-6.372,11.14-19.13v-60.236C313.773,342.418,310.061,336.043,302.634,336.043z"/>
										<path d="M397.428,336.043c-8.565,0-12.847,6.475-12.847,19.41v13.134h25.693v-13.134
											C410.274,342.511,405.99,336.043,397.428,336.043z"/>
										<path d="M148.473,113.917v77.375h28.549v-77.375L211.563,0h-29.121l-19.41,75.089L142.759,0h-30.262
											c5.33,15.99,11.516,33.785,18.559,53.391C140.003,79.656,145.805,99.835,148.473,113.917z"/>
										<path d="M249.82,193.291c13.134,0,23.219-4.854,30.262-14.561c5.332-7.043,7.994-18.274,7.994-33.689V95.075
											c0-15.225-2.669-26.363-7.994-33.406c-7.043-9.707-17.128-14.561-30.262-14.561c-12.756,0-22.75,4.854-29.98,14.561
											c-5.327,7.043-7.992,18.181-7.992,33.406v49.965c0,15.225,2.662,26.457,7.992,33.689
											C227.073,188.437,237.063,193.291,249.82,193.291z M237.541,89.935c0-13.134,4.093-19.701,12.279-19.701
											s12.275,6.567,12.275,19.701v59.955c0,13.328-4.089,19.985-12.275,19.985s-12.279-6.661-12.279-19.985V89.935z"/>
										<path d="M328.328,193.291c9.523,0,19.328-5.901,29.413-17.705v15.703h25.981V48.822h-25.981v108.777
											c-5.712,8.186-11.133,12.275-16.279,12.275c-3.429,0-5.428-2.093-5.996-6.28c-0.191-0.381-0.287-3.715-0.287-9.994V48.822h-25.981
											v112.492c0,9.705,0.767,16.84,2.286,21.411C313.961,189.768,319.574,193.291,328.328,193.291z"/>
									</g>
								</g>
								</svg>
							</a>
						</li>
					</ul>
					<p class="mb-1 text-center"><a href="tel:+18442441447" class="footer-color">1-844-244-1447</a></p>
					<p class="text-center footer-color mb-2" style="margin-top: 10px;">{!! trans('main.footer.general.powered_with') !!}</p>
					<p class="mb-0 text-center footer-color">JobMap Inc. <span class="align-self-center">®</span></p>
				</div>
				<div class="col-12 col-lg-4 col-md-6">
					<p class="footer-title text-center">{!! trans('main.footer.employers.title') !!}</p>
					<ul class="pl-0 flex-wrap justify-content-md-center" style="list-style: none; line-height: 2;">
						<li class="footer-color"><a href="{!! url('/user/signup') !!}">{!! trans('main.footer.employers.create_account') !!}</a></li>
						<li class="footer-color"><a href="{!! url('/pricing') !!}">{!! trans('main.footer.employers.pricing') !!}</a></li>
						<li class="footer-color"><a href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.employers.login') !!}</a></li>
						<li class="footer-color"><a href="{!! url('/employers') !!}">{!! trans('main.footer.general.learn_more') !!}</a></li>
					</ul>
				</div>
			</div>

			<div class="col-12 d-lg-none d-block">
				<ul class="mb-1 pl-0 d-flex bottom_section align-self-center justify-content-center" style="list-style: none;">
					<li class="align-self-center pr-1">
						<a href="http://instagram.com" >
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								 viewBox="0 0 291.319 291.319" style="enable-background:new 0 0 291.319 291.319; vertical-align: middle; margin-top: -2px;" xml:space="preserve" width="30px" height="30px">
							<g>
								<path style="fill:transparent;" d="M145.659,0c80.44,0,145.66,65.219,145.66,145.66S226.1,291.319,145.66,291.319S0,226.1,0,145.66
									S65.21,0,145.659,0z"/>
								<path style="fill:#FFFFFF;" d="M195.93,63.708H95.38c-17.47,0-31.672,14.211-31.672,31.672v100.56
									c0,17.47,14.211,31.672,31.672,31.672h100.56c17.47,0,31.672-14.211,31.672-31.672V95.38
									C227.611,77.919,213.4,63.708,195.93,63.708z M205.908,82.034l3.587-0.009v27.202l-27.402,0.091l-0.091-27.202
									C182.002,82.116,205.908,82.034,205.908,82.034z M145.66,118.239c22.732,0,27.42,21.339,27.42,27.429
									c0,15.103-12.308,27.411-27.42,27.411c-15.121,0-27.42-12.308-27.42-27.411C118.23,139.578,122.928,118.239,145.66,118.239z
									 M209.65,193.955c0,8.658-7.037,15.704-15.713,15.704H97.073c-8.667,0-15.713-7.037-15.713-15.704v-66.539h22.759
									c-2.112,5.198-3.305,12.299-3.305,18.253c0,24.708,20.101,44.818,44.818,44.818s44.808-20.11,44.808-44.818
									c0-5.954-1.193-13.055-3.296-18.253h22.486v66.539L209.65,193.955z"/>
							</g>
							</svg>
						</a>
					</li>
					<li class="align-self-center pr-1">
						<a href="http://facebook.com">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 291.319 291.319" style="enable-background:new 0 0 291.319 291.319; vertical-align: middle; margin-top: -2px;" xml:space="preserve" width="30px" height="30px">
							<g>
								<path style="fill:transparent;" d="M145.659,0c80.45,0,145.66,65.219,145.66,145.66c0,80.45-65.21,145.659-145.66,145.659
									S0,226.109,0,145.66C0,65.219,65.21,0,145.659,0z"/>
								<path style="fill:#FFFFFF;" d="M163.394,100.277h18.772v-27.73h-22.067v0.1c-26.738,0.947-32.218,15.977-32.701,31.763h-0.055
									v13.847h-18.207v27.156h18.207v72.793h27.439v-72.793h22.477l4.342-27.156h-26.81v-8.366
									C154.791,104.556,158.341,100.277,163.394,100.277z"/>
							</g>
							</svg>
						</a>
					</li>
					<li class="align-self-center pr-1">
						<a href="http://linkedin.com">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 112.196 112.196" style="enable-background:new 0 0 112.196 112.196; vertical-align: middle; margin-top: -2px;" xml:space="preserve" width="30px" height="30px">
							<g>
								<circle style="fill:transparent;" cx="56.098" cy="56.097" r="56.098"/>
								<g>
									<path style="fill:#F1F2F2;" d="M89.616,60.611v23.128H76.207V62.161c0-5.418-1.936-9.118-6.791-9.118
										c-3.705,0-5.906,2.491-6.878,4.903c-0.353,0.862-0.444,2.059-0.444,3.268v22.524H48.684c0,0,0.18-36.546,0-40.329h13.411v5.715
										c-0.027,0.045-0.065,0.089-0.089,0.132h0.089v-0.132c1.782-2.742,4.96-6.662,12.085-6.662
										C83.002,42.462,89.616,48.226,89.616,60.611L89.616,60.611z M34.656,23.969c-4.587,0-7.588,3.011-7.588,6.967
										c0,3.872,2.914,6.97,7.412,6.97h0.087c4.677,0,7.585-3.098,7.585-6.97C42.063,26.98,39.244,23.969,34.656,23.969L34.656,23.969z
										 M27.865,83.739H41.27V43.409H27.865V83.739z"/>
								</g>
							</g>
							</svg>
						</a>
					</li>
					<li class="align-self-center">
						<a href="http://youtube.com">
							<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="25px" height="25px" viewBox="0 0 511.627 511.627" style="enable-background:new 0 0 511.627 511.627; vertical-align: middle; margin-top: -2px; fill:#fff;" xml:space="preserve">
							<g>
								<g>
									<path d="M459.954,264.376c-2.471-11.233-7.949-20.653-16.416-28.264c-8.474-7.611-18.227-12.085-29.27-13.418
										c-35.02-3.806-87.837-5.708-158.457-5.708c-70.618,0-123.341,1.903-158.174,5.708c-11.227,1.333-21.029,5.807-29.407,13.418
										c-8.376,7.614-13.896,17.035-16.562,28.264c-4.948,22.083-7.423,55.391-7.423,99.931c0,45.299,2.475,78.61,7.423,99.93
										c2.478,11.225,7.951,20.653,16.421,28.261c8.47,7.614,18.225,11.991,29.263,13.134c35.026,3.997,87.847,5.996,158.461,5.996
										c70.609,0,123.44-1.999,158.453-5.996c11.043-1.143,20.748-5.52,29.126-13.134c8.377-7.607,13.897-17.036,16.56-28.261
										c4.948-22.083,7.426-55.391,7.426-99.93C467.377,319.007,464.899,285.695,459.954,264.376z M165.025,293.218h-30.549v162.45
										h-28.549v-162.45h-29.98v-26.837h89.079V293.218z M242.11,455.668H216.7v-15.421c-10.278,11.615-19.989,17.419-29.125,17.419
										c-8.754,0-14.275-3.524-16.556-10.564c-1.521-4.568-2.286-11.519-2.286-20.844V314.627h25.41v103.924
										c0,6.088,0.096,9.421,0.288,9.993c0.571,3.997,2.568,5.995,5.996,5.995c5.138,0,10.566-3.997,16.274-11.991V314.627h25.41V455.668
										z M339.183,413.411c0,13.894-0.855,23.417-2.56,28.558c-3.244,10.462-9.996,15.697-20.273,15.697
										c-9.137,0-17.986-5.235-26.556-15.697v13.702h-25.406v-189.29h25.406v61.955c8.189-10.273,17.036-15.413,26.556-15.413
										c10.277,0,17.029,5.331,20.273,15.988c1.704,4.948,2.56,14.369,2.56,28.264V413.411z M435.685,390.003h-51.104v24.839
										c0,13.134,4.374,19.697,13.131,19.697c6.279,0,10.089-3.422,11.42-10.28c0.376-1.902,0.571-7.706,0.571-17.412h25.981v3.71
										c0,9.329-0.195,14.846-0.572,16.563c-0.567,5.133-2.56,10.273-5.995,15.413c-6.852,10.089-17.139,15.133-30.841,15.133
										c-13.127,0-23.407-4.855-30.833-14.558c-5.517-7.043-8.275-18.083-8.275-33.12v-49.396c0-15.036,2.662-26.076,7.987-33.119
										c7.427-9.705,17.61-14.558,30.557-14.558c12.755,0,22.85,4.853,30.263,14.558c5.146,7.043,7.71,18.083,7.71,33.119V390.003
										L435.685,390.003z"/>
									<path d="M302.634,336.043c-4.38,0-8.658,2.101-12.847,6.283v85.934c4.188,4.186,8.467,6.279,12.847,6.279
										c7.419,0,11.14-6.372,11.14-19.13v-60.236C313.773,342.418,310.061,336.043,302.634,336.043z"/>
									<path d="M397.428,336.043c-8.565,0-12.847,6.475-12.847,19.41v13.134h25.693v-13.134
										C410.274,342.511,405.99,336.043,397.428,336.043z"/>
									<path d="M148.473,113.917v77.375h28.549v-77.375L211.563,0h-29.121l-19.41,75.089L142.759,0h-30.262
										c5.33,15.99,11.516,33.785,18.559,53.391C140.003,79.656,145.805,99.835,148.473,113.917z"/>
									<path d="M249.82,193.291c13.134,0,23.219-4.854,30.262-14.561c5.332-7.043,7.994-18.274,7.994-33.689V95.075
										c0-15.225-2.669-26.363-7.994-33.406c-7.043-9.707-17.128-14.561-30.262-14.561c-12.756,0-22.75,4.854-29.98,14.561
										c-5.327,7.043-7.992,18.181-7.992,33.406v49.965c0,15.225,2.662,26.457,7.992,33.689
										C227.073,188.437,237.063,193.291,249.82,193.291z M237.541,89.935c0-13.134,4.093-19.701,12.279-19.701
										s12.275,6.567,12.275,19.701v59.955c0,13.328-4.089,19.985-12.275,19.985s-12.279-6.661-12.279-19.985V89.935z"/>
									<path d="M328.328,193.291c9.523,0,19.328-5.901,29.413-17.705v15.703h25.981V48.822h-25.981v108.777
										c-5.712,8.186-11.133,12.275-16.279,12.275c-3.429,0-5.428-2.093-5.996-6.28c-0.191-0.381-0.287-3.715-0.287-9.994V48.822h-25.981
										v112.492c0,9.705,0.767,16.84,2.286,21.411C313.961,189.768,319.574,193.291,328.328,193.291z"/>
								</g>
							</g>
							</svg>
						</a>
					</li>
				</ul>
				<p class="mb-1 text-center"><a href="tel:+18442441447" class="footer-color">1-844-244-1447</a></p>
				<p class="text-center footer-color mb-2" style="margin-top: 15px;">{!! trans('main.footer.general.powered_with') !!}</p>
				<p class="mb-0 text-center footer-color">JobMap Inc. <span class="align-self-center">®</span></p>
			</div>

		</div>
    </footer>--}}
@include('components.modal.support')
<!-- Start of StatCounter Code for Default Guide -->
<script type="text/javascript">
var sc_project=11657174;
var sc_invisible=1;
var sc_security="2d923196";
</script>
<script type="text/javascript"
src="https://www.statcounter.com/counter/counter.js"
async></script>
<noscript><div class="statcounter"><a title="Web Analytics"
href="http://statcounter.com/" target="_blank"><img
class="statcounter"
src="//c.statcounter.com/11657174/0/2d923196/1/" alt="Web
Analytics"></a></div></noscript>
<!-- End of StatCounter Code for Default Guide -->
