    <footer class="footer">
		<p class="text-center mt-1">
			<img class="footer-logo" src="{{ asset('/ui/app/img/logo-white-large.png') }}">
		</p>
		<div class="row mt-2 text-center">
			<div class="col">
				<p class="footer-title">{!! trans('main.footer.general.title') !!}</p>
				<p class="footer-link"><a href="{!! url('/about') !!}" >{!! trans('main.footer.general.about') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/contact') !!}">{!! trans('main.footer.general.contact') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/privacy-policy') !!}">{!! trans('main.footer.general.privacy_policy') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/terms-of-service') !!}">{!! trans('main.footer.general.terms_of_service') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/site_map') !!}">{!! trans('main.footer.general.site_map') !!}</a></p>
			</div>
			<div class="col">
				<p class="footer-title">{!! trans('main.footer.job_seekers.title') !!}</p>
				<p class="footer-link"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.job_seekers.create_resume') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/user/career/list') !!}">{!! trans('main.footer.job_seekers.explore_jobs') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/') !!}#what-is">{!! trans('main.footer.job_seekers.what_is') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/') !!}#how-it-works">{!! trans('main.footer.job_seekers.how_it') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/') !!}#benefits">{!! trans('main.footer.job_seekers.benefits') !!}</a></p>
				<p class="footer-link">
					{{--<a href="{!! url('/') !!}#user-login">{!! trans('main.footer.general.privacy_policy') !!}Login</a>--}}
					<a href="#" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.job_seekers.login') !!}</a>
				</p>
				<p class="footer-link"><a href="{!! url('/faq') !!}#job-seeker">{!! trans('main.footer.job_seekers.faq') !!}</a></p>
			</div>
			<div class="col">
				<p class="footer-title">{!! trans('main.footer.employers.title') !!}</p>
				<p class="footer-link"><a href="{!! url('/business/pricing') !!}">{!! trans('main.footer.employers.pricing') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/how-it-works') !!}">{!! trans('main.footer.employers.how_it') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/how-it-works-together') !!}">{!! trans('main.footer.employers.how_cr') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/landing-employer') !!}#benefits">{!! trans('main.footer.employers.benefits') !!}</a></p>
				<p class="footer-link"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.employers.create_account') !!}</a></p>
				<p class="footer-link">
					{{--<a href="{!! url('/landing-employer') !!}#empoyer-login">{!! trans('main.footer.general.privacy_policy') !!}Login</a>--}}
					<a href="#" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.employers.login') !!}</a>
				</p>
				<p class="footer-link"><a href="{!! url('/about') !!}#mission">{!! trans('main.footer.employers.mission') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/about') !!}#product">{!! trans('main.footer.employers.product') !!}</a></p>
				<p class="footer-link"><a href="{!! url('/faq') !!}#employer">{!! trans('main.footer.employers.faq') !!}</a></p>
			</div>
		</div>
    </footer>
