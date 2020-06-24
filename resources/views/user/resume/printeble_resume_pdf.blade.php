<!DOCTYPE html>
<html>
<head>
	<title>{{ $user->username }}</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700" rel="stylesheet">
</head>
<style type="text/css">
	body{
		font-family: 'Montserrat', sans-serif;
		color: #4E5C6E;
		font-weight: 400;
		font-size: 14px;
	}
</style>
<body style="margin:0;">
	<div class="main-wrapper" style="max-width: 100%;">
		<div class="container" style="width: 1024px; margin:0 auto; padding: 10px 10px;">
			<table style="width: 100%;" border="0" cellspacing="0" cellpadding="0">
			  <tr style="background-color: #efefef; height: 220px;">
			    <th style="width: 33.33333%;  height: 220px; padding: 1rem 0;">
			    	@if (isset( $data['picture']))
						<p style="text-align: center; margin:0 auto;"><img src="{{ $data['picture']}}" style="width: 200px; height: 200px;vertical-align: middle;"></p>
					@endif
			    </th>
			    <th style="width: 66.66667%;  height: 220px; text-align: center;">
			    	<p style="font-size: 60px; margin: 0 auto; margin-top: 50px; font-weight: 500;">
			          {{ $user->first_name.' '.$user->last_name }}
			        </p>
			        
			        <p style="margin-bottom:0px; margin-top: 10px; padding-top: 30px; font-size: 20px; font-weight: 500;">{{ $data['headline'] }}</p>
			    </th>
			  </tr>
			  <tr>
			    <td style="background-color: #efefef; padding: 10px;">
			    	@if (isset($data['about']))
								<p style="font-size: 1.75rem; margin-bottom:5px; text-align: center; font-weight: 500;">{!! trans('resume_builder.print.about_me') !!}</p>
								<p style="text-align: justify; line-height: 1.4; font-size: 14px;">{!! $data['about'] !!}</p>
							@endif
							
							<p style="font-size: 1.75rem; margin-bottom:5px; text-align: center; font-weight: 500;">{!! trans('main.label.contact') !!}</p>
							<table style="width: 100%; margin-top: 30px;">
								<tbody>
									@if (isset( $data['phone']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//print_resume_img/phone.svg') }}" width="50px" height="50px">
								              	<p style="margin-top: 5px;">{{ $data['phone'] }}</p>
											</td>
										</tr>
									@endif
									@if (isset( $data['email']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//print_resume_img/email.svg') }}" width="50px" height="50px">
								              	<p style="margin-top: 5px;">{{ $user['email'] }}</p>
											</td>
										</tr>
									@endif
									@if (isset( $data['location']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//print_resume_img/location.svg') }}" width="50px" height="50px">
								              	<p style="margin-top: 5px;">{{ $data['location'] }}</p>
											</td>
										</tr>
									@endif
									@if (isset( $data['facebook']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//icons/facebook.svg') }}" width="30px" height="30px">
												<p style="margin-top: 5px;">{{ $user->basic->facebook }}</p>
											</td>
										</tr>
									@endif
									@if (isset( $data['instagram']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//icons/instagram_print.svg') }}" width="30px" height="30px">
												<p style="margin-top: 5px;">{{ $user->basic->instagram }}</p>
											</td>
										</tr>
									@endif
									@if (isset( $data['linkedin']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//icons/linkedin.svg') }}" width="30px" height="30px">
												<p style="margin-top: 5px;">{{ $user->basic->linkedin }}</p>
											</td>
										</tr>
									@endif
									@if (isset( $data['twitter']))
										<tr>
											<td style="text-align: center;">
												<img src="{{ asset('img//icons/twitter.svg') }}" width="30px" height="30px">
												<p style="margin-top: 5px;">{{ $user->basic->twitter }}</p>
											</td>
										</tr>
									@endif
									<!-- <tr>
										<td style="text-align: center;">
											<img src="{{ asset('img//landing/cr-logo.svg') }}" width="60px" height="60px">
							              	<p style="margin-top: 5px;">{!! request()->getSchemeAndHttpHost() !!}/u/{{ $user->username }}</p>
							              	<p><img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ route('user.public_profile', $user->username) }}" width="100px" height="100px"></p>
										</td>
									</tr> -->
								</tbody>
							</table>
			    </td>
			    <td style="vertical-align: baseline; ">
			    	<table style="width: 100%; margin-top: 30px; padding: 0 15px;">
						<tbody>
							<tr>
								<td>
									@if (isset( $data['education']))
										<p style="font-size: 1.75rem; margin-bottom:5px; font-weight: 500; margin-top: 5px;">{!! trans('resume_builder.print.education') !!}</p>
										<table style="width: 100%; margin-top: 10px;">
											<tbody>
												@foreach($data['education'] as $education)
													<tr>
														<td style="padding-bottom: 15px;">
															<p style="margin:0; font-size: 1.25rem;">
																<strong>{{ $education->degree }}</strong>  
																<small>{{ $education->study }}</small>  
												            </p>
															<p style="margin:0;">
																{{ $education->school_name }} / {!! trans('resume_builder.print.january') !!} {{ $education->year_from }} - {{ $education->current ? trans('resume_builder.print.i_currently_study_here') : trans('resume_builder.print.january') . ' '. $education->year_to }}
															</p>
															<p style="margin-top:0;">{!! $education->description !!}</p>

															@if ($education->achievement_title || $education->achievement_description)
																<p style="margin: 0;">{{ $education->achievement_title ? $education->achievement_title : '' }}</p>
																@if ($education->achievement_description)
																	<p style="margin: 0;">{!! $education->achievement_description !!}</p>
																@endif
															@endif
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endif
								</td>
							</tr>
							
						</tbody>
					</table>
			    </td>
			  </tr>
			  <tr>
			    <td style="background-color: #efefef; padding: 10px; ">
			    	<table style="width: 100%; margin-top: 30px;">
						<tbody>
							<tr>
								<td style="text-align: center;">
									<img src="{{ asset('img//landing/cr-logo.svg') }}" width="60px" height="60px">
					              	<p style="margin-top: 5px;">{!! request()->getSchemeAndHttpHost() !!}/u/{{ $user->username }}</p>
					              	<p><img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ route('user.public_profile', $user->username) }}" width="100px" height="100px"></p>
								</td>
							</tr>
							<tr>
								<td>
									@if (isset( $data['skill']))
										<p style="font-size: 1.75rem; margin-bottom:5px; text-align: center; font-weight: 500;">{!! trans('resume_builder.print.skills') !!}</p>
										<table style="width: 100%; margin-top: 30px;">
											<tbody>
												@foreach($data['skill'] as $skill)
													<tr>
														<td style="text-align: center; padding-bottom: 15px;">
															{{ $skill->title }}
															<div style="width:130px; height: 12px; border: 1px solid rgba(6,70,166,0.2)!important; border-radius: .25rem!important; margin: 0 auto;">
												              <div class="bg-primary rounded" style="width: {{ $skill->level }}%; height: 12px; border-radius: .25rem!important; background-color: #4266ff!important;"></div>
												            </div>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endif
								</td>
							</tr>
							<tr>
								<td>
									@if (isset( $data['languages']))
										<p style="font-size: 1.75rem; margin-bottom:5px; text-align: center; font-weight: 500;">{!! trans('resume_builder.print.languages') !!}</p>
										<table style="width: 100%; margin-top: 30px;">
											<tbody>
												@foreach($data['languages'] as $language)
													<tr>
														<td style="text-align: center; padding-bottom: 15px;">
															{{ $language->title }}
															<div style="width:130px; height: 12px; border: 1px solid rgba(6,70,166,0.2)!important; border-radius: .25rem!important; margin: 0 auto;">
												              <div class="bg-primary rounded" style="width:{{ $language->level }}%;  height: 12px; border-radius: .25rem!important; background-color: #4266ff!important; "></div>
												            </div>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
					<table style="width: 100%; margin-top: 30px;">
						<tbody>
							<tr>
								<td style="text-align: center;">
									@if (isset( $data['hobby']) || isset( $data['interest']))
										<p style="font-size: 1.75rem; margin-bottom:5px; text-align: center; font-weight: 500;">{!! trans('resume_builder.items.hobbies_interests') !!}</p>
										<table style="width: 100%; margin-top: 30px;">
											<tbody>
											@if (isset( $data['interest']))
												@foreach($data['interest'] as $interest)
													<tr>
														<td style="text-align: center; padding-bottom: 15px;">
															{{ $interest->title }}
														</td>
													</tr>
												@endforeach
											@endif
											@if (isset( $data['hobby']))
												@foreach($data['hobby'] as $hobby)
													<tr>
														<td style="text-align: center; padding-bottom: 15px;">
															{{ $hobby->title }}
														</td>
													</tr>
												@endforeach
											@endif
											</tbody>
										</table>
									@endif
								</td>
							</tr>
							
						</tbody>
					</table>
			    </td>
			    <td style="vertical-align: baseline; padding: 0 15px;">
			    	@if (isset( $data['experience']))
								<p style="font-size: 1.75rem; margin-bottom:5px; font-weight: 500;">{!! trans('resume_builder.print.experience') !!}</p>
								<table style="width: 100%; margin-top: 10px;">
									<tbody>
									@foreach($data['experience'] as $experience)
										<tr>
											<td style="padding-bottom: 15px;">
												<p style="margin:0; font-size: 1.25rem;">
													<strong>{{ $experience->title }}</strong>
									            </p>
												<p style="margin:0;">
													{{ $experience->company }} / {{ date('Y',strtotime($experience->date_from)) }} - {{ $experience->current ? trans('resume_builder.print.i_am_currently_working_here') : date('Y',strtotime($experience->date_to)) }}</p>
												<p style="margin:0;">{{ $experience->industry ? ($experience->industry->name . ' / ') : ' / ' }}
													{{ $experience->sub_industry ? ($experience->sub_industry->name . ' / ') : '' }}</p>
												<p style="margin:0;">{!! $experience->description !!}</p>
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							@endif
							@if (isset( $data['certification']))
								<p style="font-size: 1.75rem; margin-bottom:5px; font-weight: 500;">{!! trans('resume_builder.items.permit_certification') !!}</p>
								<table style="width: 100%; margin-top: 10px;">
									<tbody>
										@foreach($data['certification'] as $certification)
											<tr>
												<td style="padding-bottom: 15px;">
													<p style="margin:0; font-size: 1.25rem;">
														<strong>{{ $certification->title }}</strong>
										            </p>
													<p style="margin:0;">{{ $certification->type }} / {{ $certification->year }}</p>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@endif

							@if (isset( $data['distinction']))
								<p style="font-size: 1.75rem; margin-bottom:5px; font-weight: 500;">{!! trans('resume_builder.items.distinctions_achievements') !!}</p>
								<table style="width: 100%; margin-top: 10px;">
									<tbody>
										@foreach($data['distinction'] as $distinction)
											<tr>
												<td style="padding-bottom: 15px;">
													<p style="margin:0; font-size: 1.25rem;">
														<strong>{{ $distinction->title }}</strong>
										            </p>
													<p style="margin:0;">2018</p>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							@endif

							@if (isset($data['availability']))
								<table style="width: 100%; border-spacing: 0 10px;">
									<tbody>
									<tr>
										<td>
											<strong>{!! trans('resume_builder.print.available_for') !!}</strong>
											{{ $data['availability']->full_time ? trans('resume_builder.availability.full_time') : '' }} {{ $data['availability']->part_time ? trans('resume_builder.availability.part_time') : '' }}
											{{ $data['availability']->internship ? trans('resume_builder.availability.internship') : '' }} {{ $data['availability']->contractual ? trans('resume_builder.availability.contractual') : '' }}
											{{ $data['availability']->summer_positions ? trans('resume_builder.availability.summer_positions') : '' }} {{ $data['availability']->recruitment ? trans('resume_builder.availability.recruitment') : '' }}
											{{ $data['availability']->field_placement ? trans('resume_builder.availability.field_placement') : '' }} {{ $data['availability']->volunteer ? trans('resume_builder.availability.volunteer') : '' }}
										</td>
									</tr>
									</tbody>
								</table>
							@endif

							@if (isset($data['availabilities']))

								<table class="w-100" style="table-layout: fixed; width: 100%;">
									<thead>
									<tr class="text-center">
										<th colspan="2" class="table-heading border-0"></th>
										<th class="table-heading border-0 text-center">
											<img src="{{ asset('img//print_resume_img/morning.svg') }}" width="7" style="padding-bottom: 30px;">
										</th>
										<th class="table-heading border-0 text-center">
											<img src="{{ asset('img//print_resume_img/day.svg') }}" width="7" style="padding-bottom: 30px;">
										</th>
										<th class="table-heading border-0 text-center">
											<img src="{{ asset('img//print_resume_img/evening.svg') }}" width="7" style="padding-bottom: 30px;">
										</th>
										<th class="table-heading border-0 text-center">
											<img src="{{ asset('img//print_resume_img/night.svg') }}" width="7" style="padding-bottom: 30px;">
										</th>
									</tr>
									</thead>
									<tbody class="text-left">
				                    <?php
										$days = [
											trans('resume_builder.print.monday'),
											trans('resume_builder.print.tuesday'),
											trans('resume_builder.print.wednesday'),
											trans('resume_builder.print.thursday'),
											trans('resume_builder.print.friday'),
											trans('resume_builder.print.saturday'),
											trans('resume_builder.print.sunday'),
										];
				                    ?>
									@for($d = 1; $d <= 7; ++$d)
										<tr class="text-center">
											<td colspan="2" class="text-left">{{ $days[$d - 1] }}</td>
											@for($i = 1; $i <= 4; ++$i)
				                                <?php
				                                	$checkbox = false;
				                                	$field = 'time_' . $i;
				                                ?>
												@isset($data['availabilities']->$field)
				                                    <?php
				                                    	$checkbox = strpos($data['availabilities']->$field, (string)$d);
				                                    ?>
												@endisset
												<td class="align-middle">
													<div class="align-items-center justify-content-center">
														<label class="custom-control custom-checkbox m-0 pl-3">
															{{--<input type="checkbox"
																   class="custom-control-input"
																   @if($checkbox !== false) checked="checked"
																   @endif onclick="return false;">--}}
															<span>
																@if($checkbox !== false)
																	<img src="{!! asset('img/print_resume_img/da.svg') !!}"  width="1" style="vertical-align: middle; padding-left: 7px">
																@else
																	{{--&#9675;--}}
																@endif
															</span>
															<span class="custom-control-indicator"></span>
														</label>
													</div>
												</td>
											@endfor
										</tr>
									@endfor

									</tbody>
								</table>

							@endif
			    </td>
			  </tr>
			</table>

		</div>
	</div>
</body>
</html>