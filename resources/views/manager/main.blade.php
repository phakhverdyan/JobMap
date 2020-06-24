@extends('manager.layout')

@section('body')
	<div class="main-wrapper">
		<nav>
			<p class="sidebar__logo">
				<button class="navbar-toggler second-button" type="button"> 
					<div class="animated-icon2"><span></span><span></span><span></span><span></span></div> 
				</button>
				JobMap
			</p>
		</nav>
		<div class="dashboard">
			<div class="sidebar">
				<p class="sidebar__logo">
					<img src="{{ asset_no_cache('/manager_assets/img/sidebar/sidebar-logo.png') }}">
					JobMap
				</p>
				<p class="slider__switcher">
					<img src="{{ $business->image_url }}" width="50" height="50">
					<select id="slider__switcher__select">
						@foreach ($businesses as $current_business)
							<option value="{{ $current_business->id }}" {{ $current_business->id == $business->id ? 'selected' : '' }}>{{ $current_business->name }}</option>
						@endforeach
					</select>
				</p>
				<ul class="sidebar__menu primary">
					<li>
						<a href="/manager/" class="sidebar__menu__item" data-name="applicants">
							<img src="{{ asset_no_cache('/manager_assets/img/sidebar/applicants.png') }}" width="26" alt="Applicants">
							Applicants
						</a>
					</li>
					<li>
						<a href="/manager/locations" class="sidebar__menu__item" data-name="locations">
							<img src="{{ asset_no_cache('/manager_assets/img/sidebar/locations.png') }}" width="26" alt="Locations">
							Locations
						</a>
					</li>
					<li>
						<a href="/manager/jobs" class="sidebar__menu__item" data-name="jobs">
							<img src="{{ asset_no_cache('/manager_assets/img/sidebar/jobs.png') }}" width="26" alt="Jobs">
							Jobs
						</a>
					</li>
					<li>
						<a href="/manager/company" class="sidebar__menu__item" data-name="company">
							<img src="{{ asset_no_cache('/manager_assets/img/sidebar/company.png') }}" width="28" alt="Company">
							Company
						</a>
					</li>
				</ul>

				<ul class="sidebar__menu secondary">
					<li>
						<a href="#" class="sidebar__menu__item" data-name="options">
							<img src="{{ asset_no_cache('/manager_assets/img/sidebar/options.png') }}" width="26" alt="Options">
							Options
						</a>
						<div>
							<ul class="sidebar__optional-menu">
								<li><a href="#" class="sidebar__optional-menu__item" data-name="options.licences">Licenses</a></li>
								<li><a href="#" class="sidebar__optional-menu__item" data-name="options.permissions">Permissions</a></li>
								<li><a href="#" class="sidebar__optional-menu__item" data-name="options.billing">Billing</a></li>
								<li><a href="/manager/logout" class="sidebar__optional-menu__item">Log Out</a></li>
							</ul>
						</div>
					</li>
				</ul>

				<div class="sidebar__user-avatar">
					<p><a href="#"><img src="{{ asset_no_cache('/manager_assets/img/sidebar/question.png') }}" width="23" height="23"></a></p>
					<p><a href="#"><img src="{{ $user->image_url }}" width="50" height="50" class="img-avatar" alt=""></a></p>
				</div>
			</div>
			<div class="content is-applicants">
				<div class="content__wrapper" style="max-width: 960px; margin: 0 auto;">
					<p class="content-title">Applicants</p>
					<div class="applicants-content">
						<div class="[ applicants-no-items ] d-none">
							No Applicants Yet
						</div>

						<div class="[ applicants-items ] d-none">
							<!-- one applicant -->
							<div class="applicants-item">
								<div class="applicants-item__personal-info">
									<div class="applicant-photo">
										<img src="{{ asset_no_cache('/manager_assets/img/un-user.png') }}" width="60" height="60" alt="">
									</div>
									<div>
										<p class="applicant-name">Robert Vegiard</p>
										<p class="applicant-location">
											<img src="{{ asset_no_cache('/manager_assets/img/canada.png') }}" width="20" height="20" alt="Canada">
											Lonqueuil, Quebec, Canada
										</p>
										<p class="applicant-description">Proin venenatis felis ipsum, eu laoreet tortor luctus nec. Etiam scelerisque justo in odio interdum, eu efficitur nisi aliquet.</p>
										<p class="applicant-status"><a href="#">Looking for a job now</a></p>
									</div>
								</div>
								<div class="applicants-item__applied-info">
									<p class="applicant-applied-to">
										Applied to <span>Development Cordinator</span>
										<a href="javascript:;" class="applicant-open-more-info">
											<img src="{{ asset_no_cache('/manager_assets/img/arrow.png') }}" width="10" height="6">
										</a>
									</p>
									<p class="applicant-applied-date">1 week ago</p>
								</div>
							</div>
							<!-- /one applicant -->
						</div>

						<div class="[ applicants-items-pagination ] pt-3 d-none"></div>
						
						<!-- applicant section with more info -->
						<div class="applicant__additional-information">
							<div class="[ applicant__additional-information__close-button ] close-btn" style="cursor: pointer;">
								<a href="javascript:;" class="applicant-close-more-info">
									<img src="{{ asset_no_cache('/manager_assets/img/left-arrow.png') }}" width="39" height="28" alt="close" class="applicant__additional-information__close-button">
								</a>
							</div>
							<div class="applicant__additional-information__wrapper"></div>
						</div>
						<!-- /applicant section with more info -->
					</div>
				</div>
			</div>
		</div>
	</div>

	@include('components.ejs-pagination')
@endsection

@push('ejs-templates')
	<script type="text/ejs" id="applicants-item-template">
		<div class="applicants-item">
			<div class="applicants-item__personal-info">
				<div class="applicant-photo">
					<img src="<%= user.image_url %>" width="70" height="70" alt="">
				</div>
				<div>
					<p class="applicant-name"><%= user.full_name %></p>
					<% if (location) { %>
						<p class="applicant-location">
							<img src="/manager_assets/img/countries/flags/<%= location.country_code %>.png" width="20" height="20" alt="<%= location.country %>">
							<%= location.street_number %> <%= location.street %>, <%= location.city %>, <%= location.region %>, <%= location.country %>
						</p>
					<% } %>
					<% if (user.basic.localized_about) { %>
						<p class="applicant-description"><%= user.basic.localized_about %></p>
					<% } %>
					<% if (user.preference.looking_job == 'yes') { %>
						<p class="applicant-status"><a href="#">Looking for a job now</a></p>
					<% } %>
				</div>
			</div>
			<div class="applicants-item__applied-info">
				<p class="applicant-applied-to">
					<% if (job) { %>
						Applied to <span><%= job.localized_title %></span>
					<% } %>
				</p>
				<p class="applicant-applied-date"><%= moment(created_at).fromNow() %></p>
			</div>
		</div>
	</script>
	<script type="text/ejs" id="applicant__additional-information__wrapper-template">
		<div class="applicant__additional-information__header">
			<img src="<%= user.image_url %>" width="155" height="155" class="applicant__additional-information__avatar-image" alt="">
			<% if (user.resume_file_url) { %>
				<a href="<%- user.resume_file_url %>" class="download-btn" target="_blank">Download Resume</a>
			<% } %>
		</div>
		<p class="applicant-name"><%= user.full_name %></p>
		<div class="applicant__additional-information__main">
			<div>
				<% if (location) { %>
					<p class="applicant-place">
						<img src="{{ asset_no_cache('/manager_assets/img/sidebar/locations.png') }}" width="21" alt="">
						<img src="/manager_assets/img/countries/flags/<%= location.country_code %>.png" width="20" height="20" alt="<%= location.country %>">
						<%= location.street_number %> <%= location.street %>, <%= location.city %>, <%= location.region %>, <%= location.country %>
					</p>
				<% } %>
				<% if (user.email) { %>
					<p class="applicant-email">
						<img src="{{ asset_no_cache('/manager_assets/img/mail.png') }}" width="21" alt="">
						<span><strong>Email address: </strong></span>
						<%= user.email %>
					</p>
				<% } %>
				<% if (user.mobile_phone) { %>
					<p class="applicant-phone">
						<img src="{{ asset_no_cache('/manager_assets/img/phone-call.png') }}" width="21" alt="">
						<span><strong>Phone number:  </strong></span>
						<%= user.mobile_phone %>
					</p>
				<% } %>
				<% if (user.preference.looking_job == 'yes') { %>
					<p class="applicant-status">
						<img src="{{ asset_no_cache('/manager_assets/img/glass.png') }}" width="21" alt="">
						<span><strong>Looking for a job</strong></span>
					</p>
				<% } %>
				{{--
					<p class="applicant-availability">
						<img src="{{ asset_no_cache('/manager_assets/img/clock.png') }}" width="21" alt="">
						<span><strong>Availability:  </strong></span>
						40h per week
					</p>
					<p class="applicant-more">
						<img src="{{ asset_no_cache('/manager_assets/img/wheel.png') }}" width="21" alt="">
						<span><strong>Driving licence:  </strong></span>
						YES
					</p>
				--}}
			</div>
		</div>
		<% if (user.basic.localized_about) { %>
			<hr>
			<div class="applicant__additional-information__summary">
				<p class="applicant__additional-information__title"><strong>Summary</strong></p>
				<p><%= user.basic.localized_about %></p>
			</div>
		<% } %>
		<% if (user.education && user.education.length > 0) { %>
			<hr>
			<div class="applicant__additional-information__education">
				<p class="applicant__additional-information__title"><strong>Education</strong></p>
				<% user.education.forEach(function(education) { %>
					<!-- one education -->
					<div class="applicant__additional-information__one-item">
						<p class="school-name"><strong><%= education.school_name %></strong></p>
						<% if (education.description) { %>
							<p class="school-desc"><%= education.description %></p>
						<% } %>
						<p class="school-years"><%= education.year_from %> - <%= education.year_to %></p>
					</div>
					<!-- /one education -->
				<% }); %>
			</div>
		<% } %>
		<% if (user.experience && user.experience.length > 0) { %>
			<hr>
			<div class="applicant__additional-information__expirience">
				<p class="applicant__additional-information__title"><strong>Experience</strong></p>
				<% user.experience.forEach(function(experience) { %>
					<!-- one exp -->
					<div class="applicant__additional-information__one-item">
						<p class="exp-name"><strong><%= experience.title %></strong></p>
						<% if (experience.description) { %>
							<p class="exp-desc"><%= experience.description %></p>
						<% } %>
						<p class="exp-years"><%= new Date(experience.date_from).getFullYear() %> - <%= new Date(experience.date_to).getFullYear() %></p>
					</div>
					<!-- /one exp -->
				<% }); %>
			</div>
		<% } %>
	</script>
@endpush