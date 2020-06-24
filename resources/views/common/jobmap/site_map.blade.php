@extends('layouts.jobmap.common_user')

@section('content')

<div class="col-12 px-0 bg-white py-5">
	<div class="container my-5 text-center">
		<p class="text large bold text-center mt-5">{!! trans('pages.title.site_map.jobmap') !!}</p>
		<div class="container">
			<div class="row">
				<div class="col">
					<p class="text bold fs-12 left">{!! trans('main.footer.general.title') !!}</p>
					<p class="text left"><a href="{{ config('services.jobmap_url') }}/about" >{!! trans('main.footer.general.about') !!}</a></p>
					<p class="text left"><a href="{{ config('services.jobmap_url') }}/contact">{!! trans('main.footer.general.contact') !!}</a></p>
					<p class="text left"><a href="{{ config('services.jobmap_url') }}/terms-of-service">{!! trans('main.footer.general.terms_of_service') !!}</a></p>
					<p class="text left"><a href="{{ config('services.jobmap_url') }}/sitemap">{!! trans('main.footer.general.site_map') !!}</a></p>
					<p class="text left"><a href="{{ config('services.jobmap_url') }}/faq">{!! trans('main.footer.general.general_faq') !!}</a></p>
				</div>
				<div class="col">
					<p class="text bold fs-12 left">{!! trans('main.footer.job_seekers.title') !!}</p>
					<p class="text left"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.job_seekers.create_resume') !!}</a></p>
					<p class="text left"><a href="http://jobmap.co/map">{!! trans('main.footer.job_seekers.explore_jobs') !!}</a></p>
					<p class="text left"><a href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.job_seekers.login') !!}</a></p>
				</div>
				<div class="col">
					<p class="text bold fs-12 left">{!! trans('main.footer.employers.title') !!}</p>
					<p class="text left"><a href="{{ config('services.jobmap_url') }}/pricing">{!! trans('main.footer.employers.pricing') !!}</a></p>
					<p class="text left"><a href="javascript:;" class="jobmap__signup">{!! trans('main.footer.employers.create_account') !!}</a></p>
					<p class="text left"><a href="javascript:;" id="show-sign-in" data-toggle="modal" data-target="#signInModal">{!! trans('main.footer.employers.login') !!}</a></p>
				</div>
			</div>
		</div>


	</div>
</div>	


@endsection
