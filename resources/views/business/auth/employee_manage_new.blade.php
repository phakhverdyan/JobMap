@extends('layouts.main_business')

@section('content')

	<style type="text/css">
		.addto:hover{
			background-color: #f7f7f7;
			transition: 0.5s;
			box-shadow: 0 5px 23px rgba(0,0,0,0.3);
		}
		.addto{
			background-color: #fff;
			transition: 0.5s;
		}
		.filtersvg{
			height: 18px;
			cursor: pointer;
			opacity: 0.2;
		}
		.jobsvg,.managersvg{
		   fill: #0275d8;
		   width: 25px;
		   height: 30px;
		   cursor: pointer;
		}
		.leftmodalsorting:hover{
			border-bottom:2px solid #4266ff;
			padding-bottom: 2px;
		}
		.addnewlocationsvg{
			width: 40px;
			height: 40px;
			fill: #0275d8;
			transition: all .2s ease-in-out;
		}
		.perpage:hover .filtersvg{
            opacity: 1;
        }
        .perpage:hover{
            border-bottom:2px solid #4266ff;
            padding-bottom: 11px;
            fill:#0275d8;
        }
	</style>

    <div class="container-fluid pl-0">
		<div class="row">
				<!-- left menu begin -->
				<div id="slide-out" class="col-3 sidebar_adaptive">
                    @include('components.sidebar.sidebar_business')
                </div>
				<!-- left menu eof -->

				<!-- content block begin-->
				<div class="col-8 mx-auto pb-5 mt-5 card bg-white content-main" style="background-color: #eee;">
					<div class="row">

						<div class="col-12 pt-3 pb-2 text-center">
							<div class="row">
								<div class="col-12">
									<div class="row">
										<div class="btn-group text-center col-md-12" data-toggle="buttons">
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												New
											</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												Viewed
											</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												Contacted
											</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												Interview
											</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												Moved
											</button>
									        <button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												Employees
											</button>
											<button class="btn btn-outline-primary btn-block py-2 mt-0">
												<img src="{{ asset('img/logo-small.png') }}"/><br/>
												Ex-employees
											</button>
									    </div>
									</div>
								</div>
								{{-- <div class="col-md-12 text-right">
									<small>
										<a href="{!! url('business/candidate/edit') !!}" class="form-text text-muted mb-0">
											<span style="vertical-align: middle;">
												<img src="{{ asset('img/edit.png') }}" style="margin-top: -5px;">
											</span>
											Edit pipeline
										</a>
									</small>
								</div> --}}
								<div class="col-md-12 mt-3 mb-3 border rounded-0 border-right-0 border-left-0">
									<div class="row d-flex justify-content-center">
										<div class="btn-group w-100 col-md-6 mt-3 mb-3 " data-toggle="buttons">
											<label class="active btn btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center">
												<input type="radio" name="options" id="option1"  autocomplete="off" checked="">
												Import Employees
											</label>
											<label class="btn  btn-outline-primary mb-0 py-4 w-50 d-flex flex-column justify-content-center align-items-center">
												<input type="radio" name="options" id="option2"  autocomplete="off">
												Confirmed Employees
											</label>
										</div>
									</div>
								</div>
								<div class="col-md-12 mt-3 mb-3">
									<div class="row d-flex justify-content-center flex-column">
										<p>
											<img height='40' src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGhlaWdodD0iMTc2LjM4OW1tIiBzdHlsZT0ic2hhcGUtcmVuZGVyaW5nOmdlb21ldHJpY1ByZWNpc2lvbjsgdGV4dC1yZW5kZXJpbmc6Z2VvbWV0cmljUHJlY2lzaW9uOyBpbWFnZS1yZW5kZXJpbmc6b3B0aW1pemVRdWFsaXR5OyBmaWxsLXJ1bGU6ZXZlbm9kZDsgY2xpcC1ydWxlOmV2ZW5vZGQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDE3NjM5IDE3NjM5IiB3aWR0aD0iMTc2LjM4OW1tIiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj48ZGVmcz48c3R5bGUgdHlwZT0idGV4dC9jc3MiPgogICA8IVtDREFUQVsKICAgIC5maWwwIHtmaWxsOiMxRTcxNDV9CiAgIF1dPgogIDwvc3R5bGU+PC9kZWZzPjxnIGlkPSJMYXllcl94MDAyMF8xIj48cGF0aCBjbGFzcz0iZmlsMCIgZD0iTTk1OTYgMzYzNGwwIDEwMjY1IC02MTAzIC0xMDU4IDAgLTgxNDkgNjEwMyAtMTA1OHptMjkwIDExODVsNDA1MyAwYzIyNCwwIDI2Nyw0NCAyNjcsMjY3bDAgNzM2MGMwLDIyMyAtNDMsMjY3IC0yNjcsMjY3bC00MDUzIDAgMCAtNjk0IDE1NDcgMCAwIC0xMDY2IC0xNTQ3IDAgMCAtMzIwIDE1NDcgMCAwIC0xMDY3IC0xNTQ3IDAgMCAtMzIwIDE1NDcgMCAwIC0xMDY3IC0xNTQ3IDAgMCAtMzIwIDE1NDcgMCAwIC0xMDY2IC0xNTQ3IDAgMCAtMzIwIDE1NDcgMCAwIC0xMDY3IC0xNTQ3IDAgMCAtNTg3em0tNzgwMyAxMDc3NGwxMzQ3NCAwIDIgLTEzNDc2IC0xMzQ3OCAwIDIgMTM0NzZ6Ii8+PHBvbHlnb24gY2xhc3M9ImZpbDAiIHBvaW50cz0iNzEyOSw2ODYxIDY1NzMsODEzMyA2MTQxLDY5MzggNTQ0Niw2OTY5IDYxMzYsODcxMCA1MzU5LDEwNDEzIDYwNDIsMTA0NjQgNjU5MCw5MjM5IDcxMDAsMTA1MzUgNzg4NiwxMDU3OCA3MDM0LDg3MDMgNzg0OSw2ODA5ICIvPjxwb2x5Z29uIGNsYXNzPSJmaWwwIiBwb2ludHM9IjExNzUzLDEyMDE5IDEzNTEzLDEyMDE5IDEzNTEzLDEwOTUzIDExNzUzLDEwOTUzICIvPjxwb2x5Z29uIGNsYXNzPSJmaWwwIiBwb2ludHM9IjExNzUzLDEwNjMzIDEzNTEzLDEwNjMzIDEzNTEzLDk1NjYgMTE3NTMsOTU2NiAiLz48cG9seWdvbiBjbGFzcz0iZmlsMCIgcG9pbnRzPSIxMTc1Myw5MjQ2IDEzNTEzLDkyNDYgMTM1MTMsODE3OSAxMTc1Myw4MTc5ICIvPjxwb2x5Z29uIGNsYXNzPSJmaWwwIiBwb2ludHM9IjExNzUzLDY0NzMgMTM1MTMsNjQ3MyAxMzUxMyw1NDA2IDExNzUzLDU0MDYgIi8+PHBvbHlnb24gY2xhc3M9ImZpbDAiIHBvaW50cz0iMTE3NTMsNzg1OSAxMzUxMyw3ODU5IDEzNTEzLDY3OTMgMTE3NTMsNjc5MyAiLz48L2c+PC9zdmc+'/>
											Download excelsheet for import
										</p>
										<button type="button" class="btn btn-outline-primary btn-lg col-3 align-self-center">Import Employee</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12 border border-left-0 border-right-0 border-bottom-0 mt-3">
							<div class="row">
							<div class="col-md-12 card rounded-0 border-right-0 border-left-0 border-top-0">
								<div class="row">
									<div class="col-md-12 py-2" style="border-bottom:2px solid #eee;">
										<div class="row">
											<div class="col-md-12 text-right">
												<span class="pr-1">Per page:</span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">6</a></span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">12</a></span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">24</a></span>
												<span class="perpage h6 px-1"><a href="#" style="text-decoration: none;">48</a></span>
											</div>
										</div>
									</div>
									<div class="col-md-12 pb-2">
										<div class="row">
											<div class="col-md-4 mt-1 pt-2">
												<p class="mb-1 h6">Employee</p>
											</div>

											<div class="col-md-4 offset-md-4">
												<div class="row">
													<div class="col-md-2 offset-md-3 text-center pt-2 mt-1 pr-0">
														<span>
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 417.138 417.138" style="height:21px; opacity: 0.8;" xml:space="preserve">
															<g>
																<g>
																	<path d="M153.289,333.271c9.35,0,17-7.65,17-17v-299.2c0-6.517-3.683-12.467-9.35-15.3c-5.667-2.833-12.75-2.267-17.85,1.7    l-111.067,83.3c-7.65,5.667-9.067,16.15-3.4,23.8c5.667,7.65,16.15,9.067,23.8,3.4l83.867-62.9v265.2    C136.289,325.621,143.939,333.271,153.289,333.271z"/>
																	<path d="M263.789,86.771c-9.35,0-17,7.65-17,17v296.367c0,6.517,3.683,12.183,9.35,15.3c2.55,1.133,5.1,1.7,7.65,1.7    c3.683,0,7.083-1.133,10.2-3.4l111.067-81.883c7.65-5.667,9.067-16.15,3.683-23.8c-5.667-7.65-16.15-9.067-23.8-3.683    l-84.15,62.05v-262.65C280.789,94.421,273.139,86.771,263.789,86.771z"/>
																</g>
															</g>
															</svg>
														</span>
													</div>
													<div class="col-md-7 pt-2 pl-0">
														<select class="form-control form-control-sm">
															<option>Name</option>
															<option>Added date Asc.</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-12 mt-0 px-0">
								<input type="text" name="" class="form-control border-top-0 border-right-0 border-left-0 rounded-0 bg-light" placeholder="Search a job category, job title, location or more">
							</div>

							<div class="col-md-11 mx-auto my-4">
								<div class="row">

									<div class="col-md-12 px-0">
										<div class="card text-left mb-3">

                                                <div class="card-header d-flex justify-content-between">

                                                        <div style="box-sizing: border-box;padding-top: 5px;">
                                                            <span>
                                                                <img src="http://cloudresume-backend/img/view.png" style="width: 20px; margin-top: -5px;">
                                                                    3
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <span class="pl-1 pr-4">
                                                                 <a href="#"><img src="http://cloudresume-backend/img/star.png" style="width: 20px; margin-top: -5px;"></a>
                                                            </span>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                              <a href="#" role="button" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Send to">Send</a>
                                                              <button type="button" class="btn btn-outline-primary">
                                                                <svg height="18px" viewBox="0 0 1792 1792" width="20px" xmlns="http://www.w3.org/2000/svg" style="vertical-align: middle; margin-bottom: 3px;" data-toggle="tooltip" data-placement="top" title="Move to pipeline">
                                                                    <path d="M1216 1568v192q0 14-9 23t-23 9h-256q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h256q14 0 23 9t9 23zm-480-128q0 12-10 24l-319 319q-10 9-23 9-12 0-23-9l-320-320q-15-16-7-35 8-20 30-20h192v-1376q0-14 9-23t23-9h192q14 0 23 9t9 23v1376h192q14 0 23 9t9 23zm672-384v192q0 14-9 23t-23 9h-448q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h448q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-640q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h640q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-832q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h832q14 0 23 9t9 23z" fill="#4266ff"></path>
                                                                </svg>
                                                              </button>

                                                              <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#pipeline">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="20px" height="18px" viewBox="0 0 487.23 487.23" style="enable-background:new 0 0 487.23 487.23; vertical-align: middle; margin-bottom: 3px;" xml:space="preserve" data-toggle="tooltip" data-placement="top" title="Ask update">
                                                                <g>
                                                                    <g>
                                                                        <path d="M55.323,203.641c15.664,0,29.813-9.405,35.872-23.854c25.017-59.604,83.842-101.61,152.42-101.61    c37.797,0,72.449,12.955,100.23,34.442l-21.775,3.371c-7.438,1.153-13.224,7.054-14.232,14.512    c-1.01,7.454,3.008,14.686,9.867,17.768l119.746,53.872c5.249,2.357,11.33,1.904,16.168-1.205    c4.83-3.114,7.764-8.458,7.796-14.208l0.621-131.943c0.042-7.506-4.851-14.144-12.024-16.332    c-7.185-2.188-14.947,0.589-19.104,6.837l-16.505,24.805C370.398,26.778,310.1,0,243.615,0C142.806,0,56.133,61.562,19.167,149.06    c-5.134,12.128-3.84,26.015,3.429,36.987C29.865,197.023,42.152,203.641,55.323,203.641z" fill="#4266ff"></path>
                                                                        <path d="M464.635,301.184c-7.27-10.977-19.558-17.594-32.728-17.594c-15.664,0-29.813,9.405-35.872,23.854    c-25.018,59.604-83.843,101.61-152.42,101.61c-37.798,0-72.45-12.955-100.232-34.442l21.776-3.369    c7.437-1.153,13.223-7.055,14.233-14.514c1.009-7.453-3.008-14.686-9.867-17.768L49.779,285.089    c-5.25-2.356-11.33-1.905-16.169,1.205c-4.829,3.114-7.764,8.458-7.795,14.207l-0.622,131.943    c-0.042,7.506,4.85,14.144,12.024,16.332c7.185,2.188,14.948-0.59,19.104-6.839l16.505-24.805    c44.004,43.32,104.303,70.098,170.788,70.098c100.811,0,187.481-61.561,224.446-149.059    C473.197,326.043,471.903,312.157,464.635,301.184z" fill="#4266ff"></path>
                                                                    </g>
                                                                </g>
                                                                </svg>
                                                              </button>

                                                              <button type="button" class="btn btn-outline-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 14 14" style="enable-background:new 0 0 14 14; vertical-align: middle; margin-bottom: 3px; fill:#4266ff;" xml:space="preserve" width="20px" height="18px" data-toggle="tooltip" data-placement="top" title="Message">
                                                                <g>
                                                                    <g>
                                                                        <path style="" d="M7,9L5.268,7.484l-4.952,4.245C0.496,11.896,0.739,12,1.007,12h11.986    c0.267,0,0.509-0.104,0.688-0.271L8.732,7.484L7,9z"></path>
                                                                        <path style="" d="M13.684,2.271C13.504,2.103,13.262,2,12.993,2H1.007C0.74,2,0.498,2.104,0.318,2.273L7,8    L13.684,2.271z"></path>
                                                                        <polygon style="" points="0,2.878 0,11.186 4.833,7.079   "></polygon>
                                                                        <polygon style="" points="9.167,7.079 14,11.186 14,2.875   "></polygon>
                                                                    </g>
                                                                </g>
                                                                </svg>
                                                              </button>

                                                              <button type="button" class="btn btn-outline-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28" style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px; fill:#4266ff;" xml:space="preserve" width="20px" height="18px" data-toggle="tooltip" data-placement="top" title="Add Note">
                                                                <g>
                                                                    <g>
                                                                        <path style="" d="M24,11.518V0H0v24h11.518c1.614,2.411,4.361,3.999,7.482,4c4.971-0.002,8.998-4.029,9-9    C27.999,15.879,26.411,13.132,24,11.518z M11.517,14c-0.412,0.616-0.743,1.289-0.994,2H4v2h6.058C10.022,18.329,10,18.661,10,19    c0,1.055,0.19,2.061,0.523,3H2V2h20v8.523C21.061,10.19,20.055,10,19,10c-2.143,0-4.107,0.751-5.652,2H4v2H11.517z M19,25.883    c-3.801-0.009-6.876-3.084-6.885-6.883c0.009-3.801,3.084-6.876,6.885-6.884c3.799,0.008,6.874,3.083,6.883,6.884    C25.874,22.799,22.799,25.874,19,25.883z"></path>
                                                                        <polygon style="" points="20,8 4,8 4,10 19,10 20,10   "></polygon>
                                                                        <polygon style="" points="20.002,18 20.002,14 18,14 18,18 14,18 14,20 18,20 18,24 20.002,24 20.002,20 24,20     24,18   "></polygon>
                                                                    </g>
                                                                </g>
                                                                </svg>
                                                              </button>

                                                            </div>

                                                    </div>
                                                    <!-- <div class="d-flex justify-content-end">
																<span class="mr-auto pl-3">
																	<img src="http://cloudresume-backend/img/star.png" style="width: 20px; margin-top: -5px;">
																</span>


																<span>
																	<a href="#">History</a>
																</span>
													</div> -->


                                                </div>
                                                <div class="card-body p-0">
                                                    <div class="row no-gutters">
                                                        <div class="col-2 text-center">
                                                            <div class="px-2 py-3 h-100 border border-left-0 border-top-0 border-bottom-0">
                                                                <div class="rounded p-1 bg-white d-inline-block" style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                                                                    <a href="http://cloudresume-backend/business/candidate/list/profie/view">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="60px" height="60px" enable-background="new 0 0 800 261.953" xml:space="preserve" viewBox="0 0 201.99998 67.488425" version="1.1" y="0px" x="0px">
                                                                                                    <path fill="#f40009" d="m168.12 56.832c-0.003 0-0.6185 0.54875-0.6185 0.54875-0.8795 0.78625-1.7845 1.628-2.877 1.207-0.30175-0.10975-0.514-0.51175-0.565-0.82375-0.0497-2.2505 0.96375-4.3358 1.9465-6.3662l0.252-0.531c2.827-4.7202 6.113-10.282 10.939-14.142 0.81325-0.58675 1.6958-1.0798 2.6272-0.69525 0.21425 0.20075 0.46375 0.54875 0.46375 0.896 0 0.11025-0.0977 0.40275-0.15425 0.49375-1.3478 2.1782-2.6315 4.465-3.8798 6.6602-2.4395 4.3365-4.9702 8.8185-8.134 12.753zm-26.149-11.124c-0.18475 0.12875-3.445-0.9695-4.075-3.9882-0.5345-2.599 1.2552-4.6298 2.9868-5.6535 0.74325-0.58575 1.8628-0.7865 2.684-0.495 0.76225 0.513 0.96875 1.4285 0.96875 2.415 0 0.605-0.0802 1.2265-0.151 1.7935 0 0-0.0135 0.11025-0.0157 0.1285-0.54325 2.0302-1.3745 4.0248-2.3978 5.7998zm-12.454 12.277c-0.3325-0.494-0.44275-1.0342-0.45375-1.6182-0.0638-3.5875 3.796-10.012 6.5205-13.512h0.006c1.1418 2.5 3.7272 4.107 5.288 4.7842-1.9385 4.3182-8.5868 13.566-11.36 10.346zm47.054 0.637c-0.64525 0.439-1.5518 0.1015-1.2128-0.9045 0.84425-2.5615 4.2008-7.7815 4.2008-7.7815l9.349-16.582h-6.404c-0.30425 0.5-0.95525 1.6482-0.95525 1.6482-0.29625-0.4935-1.1822-1.591-1.547-1.828-1.5645-0.98875-3.86-0.52125-5.4435 0.375-6.8848 4.0258-11.908 11.98-15.87 18.182 0 0-4.1702 6.895-6.4852 7.4078-1.8072 0.1465-1.6208-2.288-1.5425-2.8552 0.69875-4.099 2.3215-7.9958 3.9565-11.527 3.3252-2.3052 7.1202-5.324 10.569-8.6355 7.4845-7.1545 13.794-15.26 14.716-17.071 0 0-0.99825 0.2015-2.177 0.23775-5.758 8.032-17.541 19.706-21.113 21.443 1.5825-3.8062 11.807-21.974 20.508-30.664l1.3692-1.3178c2.117-2.0675 4.3108-4.1898 6.0202-4.5375 0.1805-0.0182 0.413 0 0.61375 0.4215 0.0763 1.6098-0.523 2.7992-1.2105 4.153l-0.9635 1.9763s1.3648-0.25625 2.261-0.54975c1.04-1.9568 2.1918-4.153 1.7672-6.7688-0.14175-0.84174-0.751-1.482-1.5472-1.6285-2.5955-0.494-5.4242 1.4265-7.7002 2.9822l-0.092 0.0545c-11.7 9.1665-21.58 22.377-30.218 40.417-0.626 0.475-3.0448 1.0428-3.456 0.768 0.853-1.756 1.927-4.1168 2.4645-6.6782 0.093-0.732 0.1795-1.4818 0.1795-2.2135 0-1.5748-0.378-3.0562-1.7888-4.0805-1.654-0.8235-3.6982-0.439-5.0765 0.18275-6.1745 2.5615-10.789 8.8925-14.119 14.106-1.791 3.3125-3.5768 6.8602-4.0712 10.923-0.34825 3.183 0.36075 5.2322 2.1705 6.2572 1.8612 0.95075 4.2038-0.0375 5.124-0.51275 6.2552-3.2932 10.626-9.8978 14.071-15.936 0.137-0.018 2.018-0.0725 3.4408-0.439 0.019 0 0.027 0 0.0585 0.0192-0.0815 0.27325-0.81675 2.4695-0.81675 2.4695-2.1835 6.4032-3.1932 10.758-1.1308 13.338 2.9472 3.6412 7.8265-0.1275 11.796-5.105-0.852 5.9645 2.2392 6.898 4.5955 6.441 2.7068-0.7315 5.723-3.623 7.1228-5.1045-0.4495 1.7378-0.32725 4.8485 2.135 5.1592 1.6878 0.312 2.9508-0.606 4.4122-1.393 5.2422-2.8545 11.518-12.366 13.147-15.116h-2.1362c-2.316 3.5002-5.2632 8.0895-8.9705 10.268zm-80.761-35.518h5.9998l3.3862-5.5h-6.001zm95.841-14.611c-4.5748 2.5985-9.317 4.2813-15.058 3.696-1.591 1.7935-3.14 3.6412-4.5678 5.5438 8.0572 2.0492 16.599-2.5065 21.363-6.8422 5.0395-4.373 7.6238-9.8797 7.6238-9.8797s-3.7775 4.3175-9.3612 7.4822zm-50.45-1.39c-0.954 10.941-9.4588 17.364-11.563 17.875-1.2752 0.25575-3.4512-0.311-1.5088-4.9028 2.8608-6.1848 7.7448-11.435 12.985-14.125 0.1275 0.4575 0.12425 0.7495 0.0867 1.1525zm-16.572 27.572c-0.60925-1.317-2.0558-2.1588-3.5972-2.0675-5.0058 0.45775-9.902 4.5742-12.473 10.484-1.349 3.0375-2.0852 5.5438-2.568 9.5322 1.5565-1.7925 4.7315-4.738 8.3345-6.3482 0 0 0.49025-3.8238 2.9902-7.227 0.946-1.4092 2.8392-3.6778 4.965-3.0742 1.8572 0.6225 1.2045 5.7638-1.264 10.739-1.8265 3.6598-4.6215 7.32-7.4495 9.8442-2.5002 2.1225-6.1995 4.6838-9.436 2.708-2.0385-1.207-3.0782-3.7325-2.8585-6.9892 0.974-9.2392 5.1798-17.107 11.198-26.072 6.206-8.3248 13.047-16.869 22.263-21.426 1.8798-0.95125 3.6205-1.1708 5.1252-0.58525 0 0-8.651 4.757-12.775 13.558-1.049 2.2325-2.508 5.2505-1.0388 7.922 0.76775 1.3902 2.131 1.5002 3.2285 1.427 5.0548-1.1712 8.3205-5.8915 10.989-10.209 1.547-3.275 2.922-6.5318 2.922-10.155 0-0.439-0.0228-1.0242-0.06-1.4638 2.415-1.2802 7.367 0.988 7.367 0.988 3.8698 1.2812 12.11 7.5938 14.889 8.8008 1.3558-1.5732 3.5838-3.9515 4.8382-5.141l-1.816-1.1162c-2.9075-1.7748-5.9808-3.4582-9.0058-5.123-6.8698-3.7502-12.462-2.4332-15.308-1.4085-1.1185 0.40225-2.1408 0.75-2.1408 0.75-2.112-2.3052-5.5758-2.0862-8.128-1.4637-9.1785 2.6345-17.7 9.0562-26.836 20.199-6.717 8.7275-10.884 16.266-13.104 23.712-1.7118 5.0128-2.232 12.386 1.946 16.759 3.5522 3.713 8.2625 2.9088 11.589 1.5735 7.2068-3.5495 13.684-11.198 16.912-19.998 0.77875-2.616 1.6432-6.3118 0.30225-9.1298zm-79.885-8.4888c-0.012 0.0365-1.224 2.8172-1.224 2.8172-0.17525 0.14625-0.45225 0.0733-0.76975 0l-0.544-0.092c-1.7082-0.53025-2.9968-1.6648-3.394-3.0185-0.548-2.6348 1.7028-4.7022 2.6945-5.452 0.9515-0.65925 2.4308-1.0068 3.2898-0.3295 0.52975 0.62225 0.7305 1.427 0.7305 2.3058 0.00025 1.189-0.36675 2.5245-0.783 3.769zm-2.6035 5.287s-0.055 0.16525-0.0822 0.21925c-0.007 0-2.755 4.482-2.755 4.482-1.6585 2.2142-3.7292 4.996-6.3178 6.331-0.76725 0.25625-1.8278 0.42125-2.3682-0.25525-1.1458-1.3725-0.55525-3.2752-0.0755-4.812l0.16975-0.549c1.3755-3.732 3.558-7.026 5.6822-10.082 0.0265-0.018 0.086-0.0362 0.1075-0.0362 0.005 0.0183 0.0135 0.0183 0.0172 0.055 1.333 2.561 3.8325 3.7498 5.7018 4.2995 0.0113 0 0.0233 0.0182 0.0233 0.055 0.00025 0.0545-0.0303 0.12825-0.103 0.29225zm34.376-2.9455c1.2292-1.7012 4.807-6.2572 5.6792-7.0255 2.9335-2.5808 4.106-1.4452 4.2075-0.64075-2.7378 4.9032-5.969 10.52-9.007 15.57 0.006-0.018-0.95075 1.4452-0.95075 1.4452-1.3418 2.0488-2.6928 3.8052-4.8965 5.031-0.31425 0.092-0.83225 0.12875-1.177-0.12825-0.415-0.2745-0.57875-0.732-0.532-1.208 0.132-1.573 1.7338-6.384 6.6765-13.044zm-30.465-11.124c-3.7925-2.4882-11.415 2.2688-17.52 10.428-5.583 7.3192-7.9938 15.826-5.3702 19.76 3.9028 4.6288 11.148-2.104 14.229-5.7078l0.3975-0.42125c2.0952-2.2505 3.714-4.9585 5.2808-7.5568 0 0 1.44-2.3785 1.5088-2.4885 0.89-0.164 1.962-0.42025 3.17-0.768-0.0172 0.0545-4.6218 7.794-4.152 11.636 0.14625 1.172 0.0345 5.4532 4.2145 6.752 5.571 0.93375 10.02-3.3848 13.944-7.227 0 0 0.66875-0.63975 1.047-1.005-0.0957 0.38325-0.2205 0.8945-0.2205 0.8945-1.631 5.672 0.5675 6.862 1.9428 7.3012 4.1562 1.2082 9.1215-4.83 9.1375-4.83-0.12875 1.902-0.50525 3.4755 1.4998 4.738 1.8925 0.6775 3.8078-0.35525 5.2635-1.325 5.2438-3.6958 9.4682-9.48 12.88-14.48h-2.1765c-0.0257 0-5.3708 7.747-8.8415 9.4308-0.005 0-0.637 0.32425-1.001 0.0677-0.4505-0.3845-0.27275-1.1835 0.005-1.7495 0.0175-0.037 13.401-23.249 13.401-23.249h-6.319s-0.69025 1.1168-0.7465 1.19c-0.0425-0.0365-0.14375-0.2285-0.214-0.3205-3.915-5.4155-12.781 2.9145-19.456 12.574-2.5698 3.7145-5.8415 7.8968-9.234 10.916 0 0-5.0258 4.607-7.1732 1.297-0.785-1.3908-0.5435-3.424-0.10075-4.7592 2.5002-7.1172 6.8085-13.576 11.711-17.474 1.384-1.0788 2.8882-1.3908 3.6348-0.93325 0.71125 0.4215 0.826 1.4635 0.376 2.1772-1.1418-0.0365-2.0565 0.3105-2.8002 1.079-1.465 1.537-1.974 3.0192-1.5082 4.41 2.2628 3.22 6.7755-3.1472 6.5572-7.026-0.078-1.3908-0.82-2.7078-1.9272-3.3488-1.6502-0.9875-4.1678-0.73175-5.797 0.0555-2.181 0.823-5.6335 3.6952-7.6488 5.9278-2.537 2.7998-6.888 5.9098-8.2488 5.5615 0.44575-1.1898 4.121-8.7092 0.25475-11.526zm31.762 40.709c-7.442-4.794-17.542-5.6352-33.83-1.1162-17.364 4.0805-23.154 6.6962-30.757 1.4452-2.921-2.5795-3.9683-6.7328-3.1862-12.715 1.8138-9.7525 6.7152-19.138 15.422-29.548 4.8598-5.4155 9.3675-10.063 15.32-11.929 4.562-1.1708 4.1355 2.4145 3.5835 2.9272-0.5825 0-1.561 0.0918-2.3172 0.58525-0.61375 0.476-2.2985 2.013-2.389 4.0805-0.1305 3.165 3.145 2.5062 4.5578 0.7685 1.5228-1.9582 3.7732-5.7083 2.003-9.2033-0.742-1.244-2.024-2.1037-3.6158-2.3965-5.4505-0.3115-10.527 2.2867-15.212 5.1592-10.243 7.117-18.439 16.979-23.076 27.774-2.6738 6.5132-5.0918 15.843-1.4672 23.437 2.8038 5.269 8.6248 8.0678 15.57 7.4825 4.8708-0.51175 10.76-2.086 14.722-3.0365 3.9612-0.952 24.238-7.9222 30.901 4.209 0 0 2.2155-4.3008 7.7522-4.3925 4.552-0.42 11.119 1.3178 15.901 4.83-1.5932-2.396-6.1102-5.9272-9.8785-8.361z"></path>
                                                                                                </svg></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-10">
                                                        	<div class="row">
                                                        		<div class="col-8">
                                                        			<div class="p-3">
		                                                                <a href="http://cloudresume-backend/business/candidate/list/profie/view" class="h5 font-weight-bold mb-0" style="opacity: 0.8;">Full name</a>
		                                                                <p class="mb-0 font-weight-bold" style="opacity: 0.8; font-size: 15px;">
		                                                                    Headline</p>
		                                                                <div class="d-flex align-items-center">
		                                                                    <div class="mr-2">
		                                                                        <img src="http://cloudresume-backend/img/flags/shiny/16/Canada.png" alt="company-flag">
		                                                                    </div>
		                                                                    <p class="mb-0" style="opacity: 0.8;">
		                                                                        City of candidate</p>
		                                                                </div>

		                                                                 <a class="mb-0 font-weight-bold" style="opacity: 0.8; font-size: 15px; cursor: pointer;" role="button" data-toggle="modal" data-target="#pipeline">
		                                                                    1 | Applied jobs</a>
		                                                            </div>
                                                        		</div>

                                                        	</div>

                                                        </div>

                                                        <!--  -->

                                                    </div>
                                                </div>
                                            </div>
									</div>

								</div>
							</div>

							<div class="mx-auto mt-2">
								<nav aria-label="Page navigation example">
								  <ul class="pagination">
								    <li class="page-item"><a class="page-link" href="#"><</a></li>
								    <li class="page-item"><a class="page-link" href="#">1</a></li>
								    <li class="page-item"><a class="page-link" href="#">2</a></li>
								    <li class="page-item"><a class="page-link" href="#">3</a></li>
								    <li class="page-item"><a class="page-link" href="#">></a></li>
								  </ul>
								</nav>
							</div>

						</div>
				</div>
		</div>
	</div>
 	<!--pipeline MODAL!!!!!!!!!!!!!!! -->
    <div class="modal fade" id="pipeline" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body pb-3">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <p class="h6 text-center">You are moving candidate in to your employee list.In which location do you want to move employee?</p>
            <form autocomplete="off">
				<div class="form-group">
					<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Search location by name and address"  autocomplete="off">
				</div>
				<div class="btn-group text-center w-100" data-toggle="buttons">
					<button class="btn btn-outline-primary btn-block py-2 mt-0">Assign All</button>
					<button class="btn btn-outline-primary btn-block py-2 mt-0">Unassign All</button>
				</div>
            </form>
			<p class="mt-2">Assigned</p>
			<div class="card">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
			<p class="mt-4">Unassigned</p>
			<div class="card mt-2">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
			<div class="card mt-2">
				<div class="card-block d-flex">
					<div class="col-2">
						<label class="custom-control custom-checkbox m-0 pl-3 mt-2">
							<input type="checkbox" class="custom-control-input">
							<span class="custom-control-indicator"></span>
						</label>
					</div>
					<div class="col-6" style="text-align: left;">
						<p style="margin-bottom: 0;font-weight: bold;">Location Name</p>
						<p style="margin-bottom: 0;">Location Address</p>
					</div>
					<div class="col-4">
						<p style="margin-bottom: 0;text-align: right;">Jan 23, 2017</p>
					</div>
				</div>
			</div>
          </div>

        </div>

       </div>

    </div>
    <!-- pipeline MODAL END!!!!!!!!!!!!!!! -->

@endsection
