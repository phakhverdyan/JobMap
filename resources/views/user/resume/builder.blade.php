@extends('layouts.main_user')

@section('content')

    <div class="container">
		<div class="row">
			<div class="form-tab-container col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
				<!-- vertical tab navigation -->
				<div class="form-tab-menu col-lg-3 col-md-3 col-sm-3 col-xs-2">
					<div class="list-group">
						<!-- menu links -->
						<a href="#" class="list-group-item active text-center">
							<div class="icon job-icon"></div>
							<span>Job Preferences</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon info-icon"></div>
							<span>Availabilitie</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon education-icon"></div>
							<span>Basic Info</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon skills-icon"></div>
							<span>Education</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon experience-icon"></div>
							<span>Expirience</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon additional-info-icon"></div>
							<span>Certifications &amp; Licences</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon additional-info-icon"></div>
							<span>Certifications &amp; Licences</span>
						</a>
						<a href="#" class="list-group-item text-center">
							<div class="icon print-icon"></div>
							<span>Save &amp; Print</span>
						</a>
					</div>
				</div>
				<!-- form content -->
				<div class="col-lg-9 col-md-9 col-sm-9 col-xs-10 form-tab">

					<!-- view 1 -->
					<div class="form-tab-content active">
						<!-- job-info block -->
						<div class="job-info">
							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="work status" src="{{ asset('/ui/app/img/bag.png') }}">
									<span>Choose your work status</span>
								</div>
							</div>
							<!-- content (checkboxes) -->
							<div class="row">
								<div class="form-checkbox col-md-11 col-md-offset-1 clear-padding-left">
									<div class="checkbox-container middle">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Working, but still looking</span>
									</div>

									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Looking for job</span>
									</div>
									
									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Not looking</span>
									</div>
								</div>
							</div>

							<!-- divide line -->
							<div class="divide-line"></div>

							<!-- Industry block -->
							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="work status" src="{{ asset('/ui/app/img/industry.png') }}">
									<span>Choose your Industry</span>
								</div>
							</div>
							<!-- content (select) -->
							<div class="row">
								<div class="col-md-4 col-md-offset-1 col-sm-4 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div class="custom-select-wrapper"><select name="sources" id="sources" class="custom-select sources" placeholder="select" style="display: none;">
										<option value="profile">test 1</option>
										<option value="word">test 2</option>
										<option value="hashtag">test 3</option>
									</select><div class="custom-select sources"><span class="custom-select-trigger">select</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">test 1</span><span class="custom-option undefined" data-value="word">test 2</span><span class="custom-option undefined" data-value="hashtag">test 3</span></div></div></div>
								</div>
							</div>

							<!-- divide line -->
							<div class="divide-line"></div>

							<!-- Salary block -->
							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="work status" src="{{ asset('/ui/app/img/salary.png') }}">
									<span>Choose your salary</span>
									<p class="sub-title">salary per hour</p>
								</div>
							</div>
							<!-- content (slider) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div id="salary-slider" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 15%; width: 45%;"><span class="price-range-both value"><i>$75 - </i>300</span></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 15%;"><span class="price-range-min value">$75</span></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 60%;"><span class="price-range-max value">$300</span></span></div>
								</div>
							</div>

							<!-- divide line -->
							<div class="divide-line"></div>

							<!-- Hours block -->
							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="work status" src="{{ asset('/ui/app/img/hours.png') }}">
									<span>Select hours</span>
									<p class="sub-title">hours per week availability</p>
								</div>
							</div>
							<!-- content (slider) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div id="hours-slider" class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header" style="left: 15%; width: 45%;"><span class="price-range-both value"><i>$75 - </i>300</span></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 15%;"><span class="price-range-min value">h75</span></span><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 60%;"><span class="price-range-max value">h300</span></span></div>
								</div>
							</div>

						</div>
						<!-- next button -->
						<a class="button small text-blue next pull-right">Continue</a>
						<!-- end job-info block -->
					</div>

					<!-- view 2 -->
					<div class="form-tab-content">
						<!-- Available-for block -->
						<div class="availability-info">
							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/available.png') }}">
									<span>Available For</span>
								</div>
							</div>
							<!-- content (checkboxes) -->
							<div class="row">
								<div class="form-checkbox availability-form col-md-12 col-xs-12">
									
									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Internship</span>
									</div>

									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Full Time</span>
									</div>

									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Part Time</span>
									</div>

									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Volunteering</span>
									</div>
								</div>
							</div>

							<!-- divide line -->
							<div class="divide-line"></div>

							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/availabilities.png') }}">
									<span>Availabilities</span>
									<div class="days-icons">
										<div class="day-icon">
											<img alt="day" src="{{ asset('/ui/app/img/sun.png') }}">
										</div>
										<div class="day-icon">
											<img alt="evening" src="{{ asset('/ui/app/img/evening.png') }}">
										</div>
										<div class="day-icon">
											<img alt="night" src="{{ asset('/ui/app/img/moon.png') }}">
										</div>
									</div>
								</div>
							</div>
							<!-- content (select) -->
							<div class="row">
								<div class="days-list-container col-md-3 col-md-offset-1 col-sm-3 col-sm-offset-1 col-xs-1 col-xs-offset-1 clear-padding">
									<ul class="days-list">
										<li>Monday</li>
										<li>Tuesday</li>
										<li>Wednesday</li>
										<li>Thursday</li>
										<li>Friday</li>
										<li>Saturday</li>
										<li>Sunday</li>
									</ul>
								</div>
								<div class="col-md-7 col-md-offset-1 col-sm-7 col-sm-offset-1 col-xs-10 clear-padding">
									<!-- days table -->
									<div class="days-table-container">
										<!-- 1 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding top-left-corner">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding top-border">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding top-right-corner">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
										<!-- 2 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
										<!-- 3 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
										<!-- 4 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
										<!-- 5 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
										<!-- 6 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
										<!-- 7 -->
										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding bottom-left-corner">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-4 clear-padding bottom-right-corner">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							
						</div>
						<a class="button small text-blue next pull-right">Continue</a>
						<!-- end available-for -->
					</div>

					<!-- view 3 -->
					<div class="form-tab-content">
						<!-- User-info block -->
						<div class="user-info">
							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="work status" src="{{ asset('/ui/app/img/headline.png') }}">
									<span>Headline</span>
								</div>
							</div>
							<!-- content (input) -->
							<div class="row">
								<div class="input-form col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<input class="form-control" type="text" placeholder="(ex. Looking for opportunities in IT)"  autocomplete="off">
										</div>
									</div>
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>

								<div class="input-form col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div class="row input-row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="Street address (ex. 55 Main St. Appt. 5)"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="City"  autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="Country"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="Province / State"  autocomplete="off">
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- divide line -->
							<div class="divide-line"></div>

							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="profile picture" src="{{ asset('/ui/app/img/profile.png') }}">
									<span>Profie picture</span>
								</div>
							</div>
							<!-- content (file input) -->
							<div class="row">
								<div class="input-form col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<a class="button upload left" href="#">+  Choose File</a>
											<input class="form-control input-upload" type="text">
										</div>
									</div>
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
							</div>

							<!-- Choose gender  -->
							<!-- title -->
							<div class="row">
								<div class="title col-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="work status" src="{{ asset('/ui/app/img/gender.png') }}">
									<span>Gender</span>
								</div>
							</div>
							<!-- content (checkbox) -->
							<div class="row">
								<div class="form-checkbox col-md-12 col-sm-12 col-xs-12">
									
									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Male</span>
									</div>

									<div class="checkbox-container middle mt-left-5">
										<label class="control checkbox-label">
											<input type="checkbox" checked="checked">
											<div class="control-indicator"></div>
										</label>
										<span class="checkbox-text">Female</span>
									</div>

								</div>

								<!-- divide line -->
								<div class="divide-line"></div>

								<!-- content (inputs) -->
								<div class="input-form col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div class="row input-row">
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="Mobile phone (ex. 514-552-2911)"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-6">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="Home phone"  autocomplete="off">
											</div>
										</div>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<input class="form-control" type="text" placeholder="Website (ex. http://www.yourwebsite.com)"  autocomplete="off">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- end User-info -->
						<!-- next button -->
						<a class="button small text-blue next pull-right">Continue</a>
					</div>

					<!-- view 4 -->
					<div class="form-tab-content">
						<!-- education-info block -->
						<div class="education-info">
							<!-- title -->
							 <div class="row">
								<div class="title ol-md-offset-1 col-sm-offset-1 col-xs-offset-1">
									<img alt="education" src="{{ asset('/ui/app/img/education2.png') }}">
									<span>Education</span>
								</div>
							</div>
							<!-- content (table) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-11 col-xs-offset-1 clear-padding">
									<!-- days table -->
									<div class="days-table-container">
										<!-- header -->
										<div class="days-table">
											<div class="cell col-md-12 col-sm-12 col-xs-12 clear-padding">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="School Name ( ex. Boston University)"  autocomplete="off">
												</div>
											</div>
										</div>

										<div class="days-table">
											<div class="cell col-md-3 col-sm-3 col-xs-3 clear-padding">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="From year"  autocomplete="off">
												</div>
											</div>
											<div class="cell col-md-3 col-sm-3 col-xs-3 clear-padding">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="To year"  autocomplete="off">
												</div>
											</div>
											<div class="cell col-md-6 col-sm-6 col-xs-6 clear-padding">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="Grade"  autocomplete="off">
												</div>
											</div>
										</div>

										<div class="days-table">
											<div class="cell col-md-6 col-sm-6 col-xs-6 clear-padding">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="Degree ( ex. Bachelor’s )"  autocomplete="off">
												</div>
											</div>
											<div class="cell col-md-6 col-sm-6 col-xs-6 clear-padding">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="Field of study ( ex. Computer Scince )"  autocomplete="off">
												</div>
											</div>
										</div>

										<div class="side-line-container">
											<a class="button more side-lines" href="#">+  Add Education</a>
										</div>

									</div>
								</div>
							</div>
						</div>
						<!-- end education-info -->
						<!-- next button -->
						<a class="button small text-blue next pull-right">Continue</a>
					</div>

					<!-- view 5 -->
					<div class="form-tab-content">
						<!-- experience-info block -->
						<div class="experience-info">
							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/experience1.png') }}">
									<span>Experience</span>
								</div>
							</div>
							<!-- content (table) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-11 col-xs-offset-1 clear-padding">
									<!-- days table -->
									<div class="days-table-container">

										<div class="days-table">
											<div class="col-md-12 col-sm-12 clear-padding header">
												<div class="input-group table-input">
													<input class="form-control" type="text" placeholder="Job Title"  autocomplete="off">
												</div>
											</div>
										</div>

										<div class="days-table checkbox-container">
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Full Time</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Volunteer</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Internship</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name small-text">Field Placement/<br> Work Practicum</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Casual</span>
											</div>
										</div>

										<div class="days-table checkbox-container">
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Part Time</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Contract</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">Undisclosed</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name small-text">Summer  Positions</span>
											</div>
											<div class="clear-padding cell">
												<label class="control checkbox-label">
													<input type="checkbox">
													<div class="control-indicator"></div>
												</label>
												<span class="name">N/A</span>
											</div>
										</div>

										<div class="days-table">
											<div class="table-input">
												<div class="clear-padding cell">
													<div class="input-group">
														<input class="form-control white" type="text" placeholder="Company name (ex. McDonald's)"  autocomplete="off">
													</div>
												</div>
												<div class="clear-padding cell">
													<div class="input-group">
														<input class="form-control white" type="text" placeholder="Address"  autocomplete="off">
													</div>
												</div>
											</div>
										</div>

										<div class="days-table extend">
											<div class="table-textarea">
												<div class="clear-padding cell">
													<div class="input-group">
														<textarea class="form-control white" placeholder="Job description (ex. I was interacting with a lot of clients in the drive-through, a lot of team work was involved, had an amazing time with the staff)..."></textarea>
													</div>
												</div>
											</div>
										</div>

										<div class="days-table date-select-container">
											<div class="table-select">
												<div class="clear-padding cell">
														<span class="name">From</span>
														<div class="custom-select-wrapper"><select name="sources" class="custom-select sources" placeholder="MM" style="display: none;">
															<option value="profile">june</option>
															<option value="word">july</option>
															<option value="hashtag">august</option>
														</select><div class="custom-select sources"><span class="custom-select-trigger">MM</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">june</span><span class="custom-option undefined" data-value="word">july</span><span class="custom-option undefined" data-value="hashtag">august</span></div></div></div>
														<div class="custom-select-wrapper"><select name="sources" class="custom-select sources" placeholder="YYY" style="display: none;">
															<option value="profile">1997</option>
															<option value="word">1998</option>
															<option value="hashtag">1997</option>
														</select><div class="custom-select sources"><span class="custom-select-trigger">YYY</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">1997</span><span class="custom-option undefined" data-value="word">1998</span><span class="custom-option undefined" data-value="hashtag">1997</span></div></div></div>
												</div>
												<div class="clear-padding cell">
													<span class="name">To</span>
													<div class="custom-select-wrapper"><select name="sources" class="custom-select sources" placeholder="MM" style="display: none;">
														<option value="profile">june</option>
														<option value="word">july</option>
														<option value="hashtag">august</option>
													</select><div class="custom-select sources"><span class="custom-select-trigger">MM</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">june</span><span class="custom-option undefined" data-value="word">july</span><span class="custom-option undefined" data-value="hashtag">august</span></div></div></div>
													<div class="custom-select-wrapper"><select name="sources" class="custom-select sources" placeholder="YYY" style="display: none;">
														<option value="profile">1997</option>
														<option value="word">1998</option>
														<option value="hashtag">1999</option>
													</select><div class="custom-select sources"><span class="custom-select-trigger">YYY</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">1997</span><span class="custom-option undefined" data-value="word">1998</span><span class="custom-option undefined" data-value="hashtag">1999</span></div></div></div>
												</div>
												<div class="clear-padding cell">
													<label class="control checkbox-label">
														<input type="checkbox">
														<div class="control-indicator"></div>
													</label>
													<span class="name small-text">I work  there now</span>
												</div>
											</div>
										</div>

										<div class="days-table extend">
											<div class="table-textarea">
												<div class="clear-padding cell">
													<div class="input-group">
														<textarea class="form-control white" placeholder="Accomplishments (ex. I was awarded employee of the month 3 time"></textarea>
													</div>
												</div>
											</div>
										</div>

										<div class="side-line-container">
											<a class="button more side-lines" href="#">+  Add Education</a>
										</div>
										
									</div>

								</div>
							</div>
						</div>
						<!-- next button -->
						<a class="button small text-blue next pull-right">Continue</a>
						<!-- end experience-info blocl -->
					</div>

					<!-- view 6 -->
					<div class="form-tab-content">
						<!-- additional-info block -->
						<div class="additional-info">
							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/headline.png') }}">
									<span>Headline</span>
								</div>
							</div>
							<!-- content (input) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding input-form">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<input class="form-control" type="text" placeholder="(ex. Riding motorcycle, Travel)"  autocomplete="off">
										</div>
									</div>
								</div>
							</div>

							<!-- divide line -->
							<div class="divide-line"></div>

							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/licence.png') }}">
									<span>Licences / Permits / Certifications</span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<div class="row input-row">
										<div class="col-md-8 col-sm-8 col-xs-12">
											<div class="input-group">
												<input class="form-control" type="text" placeholder="Street address (ex. 55 Main St. Appt. 5)"  autocomplete="off">
											</div>
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<div class="custom-select-wrapper"><select name="sources" id="sources" class="custom-select sources" placeholder="select" style="display: none;">
												<option value="profile">test 1</option>
												<option value="word">test 2</option>
												<option value="hashtag">test 3</option>
											</select><div class="custom-select sources"><span class="custom-select-trigger">select</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">test 1</span><span class="custom-option undefined" data-value="word">test 2</span><span class="custom-option undefined" data-value="hashtag">test 3</span></div></div></div>
										</div>
									</div>
								</div>
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding input-form">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<a class="button upload left" href="#">+  Choose File</a>
											<input class="form-control input-upload" type="text">
										</div>
									</div>
								</div>
								<!-- divide line -->
								<div class="divide-line"></div>
							</div>
						</div>
						<!-- end additional-info block -->
						<!-- next button -->
						<a class="button small text-blue next pull-right">Continue</a>
					</div>

					<!-- view 7 -->
					<div class="form-tab-content">
						<!-- additional-info block -->
						<div class="additional-info-second">
							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/brush.png') }}">
									<span>Main skills / Competences</span>
								</div>
							</div>
							<!-- content (input) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding input-form">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<div class="skills-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="width: 0%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>
											<input class="form-control" type="text" placeholder="(ex. Riding motorcycle, Travel, etc.)"  autocomplete="off">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="side-line-container col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<a class="button more side-lines" href="#">+  Add More</a>
								</div>
							</div>

							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/chat.png') }}">
									<span>Spoken languages</span>
								</div>
							</div>
							<!-- content (input) -->
							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding input-form">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<div class="skills-slider ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"><div class="ui-slider-range ui-corner-all ui-widget-header ui-slider-range-min" style="width: 0%;"></div><span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default" style="left: 0%;"></span></div>
											<input class="form-control" type="text" placeholder="(ex. Riding motorcycle, Travel, etc.)"  autocomplete="off">
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="side-line-container col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
									<a class="button more side-lines" href="#">+  Add More</a>
								</div>
							</div>

							<!-- title -->
							<div class="row">
								<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
									<img alt="work status" src="{{ asset('/ui/app/img/user_talk.png') }}">
									<span>References</span>
								</div>
							</div>

							<div class="row">
								<div class="checkbox-container middle col-md-offset-1 mt-2">
									<label class="control checkbox-label">
										<input type="checkbox" checked="checked">
										<div class="control-indicator"></div>
									</label>
									<span class="checkbox-text">Female</span>
								</div>
							</div>

							<div class="row">
								<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding input-form">
									<div class="col-md-12 col-sm-12 col-xs-12 clear-padding">
										<div class="input-group">
											<a class="button right more" href="#">+ Add More</a>
											<input class="form-control input-upload" type="text">
										</div>
									</div>
								</div>
							</div>

							<!-- title -->
							<div class="distinctions">
								<div class="row">
									<div class="col-md-offset-1 col-sm-offset-1 col-xs-offset-1 title">
										<img alt="work status" src="{{ asset('/ui/app/img/goblet.png') }}">
										<span>Distinctions / Outstanding achievements</span>
									</div>
								</div>

								<div class="row">
									<div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
										<div class="row input-row">
											<div class="col-md-8 col-sm-8 col-xs-12">
												<div class="input-group">
													<input class="form-control" type="text" placeholder="">
												</div>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<div class="custom-select-wrapper"><select name="sources" id="sources" class="custom-select sources" placeholder="select" style="display: none;">
													<option value="profile">test 1</option>
													<option value="word">test 2</option>
													<option value="hashtag">test 3</option>
												</select><div class="custom-select sources"><span class="custom-select-trigger">select</span><div class="custom-options"><span class="custom-option undefined" data-value="profile">test 1</span><span class="custom-option undefined" data-value="word">test 2</span><span class="custom-option undefined" data-value="hashtag">test 3</span></div></div></div>
											</div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="side-line-container col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1 clear-padding">
										<a class="button more side-lines" href="#">+  Add More</a>
									</div>
								</div>
							</div>

						</div>
						<!-- end additional-info-second -->
						<a class="button small text-blue next pull-right">Continue</a>
					</div>

					<!-- end view 7 -->

				</div>
			</div>
		</div>
    </div>
    <br />
    
@endsection