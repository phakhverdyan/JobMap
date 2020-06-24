@extends('layouts.main_user')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-center justify-content-lg-center flex-lg-row flex-column-reverse">  
        <div class="px-5 pxa-0 mxa-0 card my-5 mr-2 py-3 rounded">
          <div class="col-12 mx-auto pt-4">
            <div class="d-flex justify-content-between flex-xl-row flex-column mb-4">
              <div class="">
                  <div class="text-left d-flex align-items-start flex-column flex-lg-row">
                    <div class="p-1 mb-3 d-inline-block rounded bg-white mr-3" style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                      <img src="" style="width: 100px; height: 100px;">
                    </div>
                    <div>
                        <h5 class="h5 mb-1 mt-0 overview_color">
                            First name Last Name
                        </h5>
                        <p class="mb-1 d-flex align-item-center">
                            City, Region, Country
                        </p>
                        <p class="mb-1 d-flex align-item-center">
                            website
                        </p>
                        <p class="mb-0 text-muted">Description</p>
                    </div>
                  </div>
              </div>
              <div>
                <p class="mt-0 mb-1 text-center" style="color:#28a745; font-size: 16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;vertical-align: middle;margin-top: -3px; fill:#28a745;" xml:space="preserve" width="20px" height="20px">
                        <g>
                            <g>
                                <g>
                                    <polygon points="234.53,285.912 169.76,224.259 142.172,253.242 236.775,343.294 380.923,182.799 351.154,156.061    "/>
                                    <path d="M420.499,65.192c-48.502-8.692-93.168-35.18-115.476-50.195C290.447,5.186,273.496,0,256.001,0     s-34.447,5.186-49.022,14.996C184.671,30.011,140.005,56.5,91.503,65.192c-28.726,5.148-49.576,30.002-49.576,59.097v120.71     c0,39.877,11.157,78.749,33.159,115.539c17.214,28.781,41.064,56.288,70.888,81.757c50.147,42.825,99.804,65.156,101.892,66.086     L256,512l8.134-3.619c2.089-0.929,51.745-23.261,101.892-66.086c29.823-25.469,53.675-52.976,70.888-81.757     c22.004-36.789,33.159-75.662,33.159-115.539V124.29C470.075,95.194,449.225,70.34,420.499,65.192z M430.061,245     c0,59.45-30.033,115.375-89.267,166.224c-34.432,29.558-69.39,48.824-84.791,56.643C220.601,449.879,81.941,371.328,81.941,245     V124.29c0-9.695,6.99-17.985,16.621-19.711c55.718-9.985,105.843-39.616,130.761-56.388c7.947-5.35,17.172-8.178,26.678-8.178     c9.506,0,18.732,2.828,26.678,8.177c24.919,16.773,75.043,46.402,130.761,56.387c9.63,1.726,16.621,10.016,16.621,19.711V245z"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                    Verified Resume
                </p>
                <p class="mt-0 mb-1 text-center" style="letter-spacing: 0px;"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Looking & open to new opportunities</p>
                <p class="mt-0 mb-1 text-center" style="letter-spacing: 0px;"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2"><strong>Updated</strong> 3 days ago</p>
                <p class="mb-1"><button class="btn btn-primary btn-block" data-toggle="tooltip" title="Coming soon">Connect</button></p>
                <p><button class="btn btn-primary btn-block" data-toggle="tooltip" title="Coming soon">Message</button></p>
              </div>
            </div>
            <div class="col-12 px-0 mb-4">
                <div class="d-flex justify-content-between flex-xl-row flex-column">
                    <div class="my-1 col-xl-6 col-lg-12 px-0">
                        <h5 class="text-left h5 mb-1 mt-0 overview_color">Job Preferences</h5>
                        <p class="mb-0 text-muted text-left"><strong>I'm a </strong> Student</p>
                        <p class="mb-0 text-muted text-left"><strong>I'm now </strong> Employed</p>
                        <p class="mb-0 text-muted text-left"><strong>Interested in these job types:</strong> First Job, Student, Professional</p>
                        <p class="mb-0 text-muted text-left"><strong>Preferred Industries</strong> Industry, Sub-industry</p>
                        <p class="mb-3 text-muted text-left"><strong>Preferred jobs</strong> Job-category, Job sub-category</p> 
                          <!-- EDU START -->
                          <div class="col-12 px-0 mb-3">
                              <div class="col-12 mb-3 px-0 text-left">
                                  <div>
                                      <p class="text-left h5 mb-1 mt-0 overview_color">Education</p>
                                      <p class="mb-0 text-left h5 mb-1 mt-0">Education School name</p>
                                      <p class="text-left text-muted mt-0 mb-0">January - January</p>
                                      <div class="d-flex align-items-center">
                                          <div>
                                            <span style="vertical-align: middle; margin-top: -3px;" class="item-location-flag bfh-flag-ca">
                                              <i class="glyphicon"></i> 
                                            </span>
                                          </div>
                                          <p class="mb-0" style="opacity: 0.8;">
                                              Location</p>
                                      </div>
                                      <p class="mb-0">Education study</p>
                                      <p class="mb-0"
                                         style="opacity: 0.8; font-size: 15px;">
                                          <strong>Education grade</strong>, Education degree</p>
                                  </div>
                                  <div class="text-muted mt-2">
                                      <p class="mb-0">Education description</p>
                                  </div>
                              </div>
                          </div>
                        <!-- EDU END -->

                        <!-- EXP START -->
                          <div class="col-12 px-0">
                              <div class="text-left mb-3">
                                  <div class="p-0">
                                      <div class="row no-gutters">
                                          <div class="col-12 mb-3">
                                              <div>
                                                  <p class="mb-0 text-left h5 mb-1 mt-0 overview_color">Experience</a>
                                                  <p class="mb-0 text-left h5 mb-1 mt-0">Exp company</p>
                                                  <p class="text-left text-muted my-0">Date from - date to</p>
                                                  <div class="d-flex align-items-center">
                                                      <div>
                                                        <span style="vertical-align: middle; margin-top: -3px;" class="item-location-flag bfh-flag-ca">
                                                          <i class="glyphicon"></i> 
                                                        </span>
                                                      </div>
                                                      <p class="mb-0"
                                                         style="opacity: 0.8;">
                                                          Location</p>
                                                  </div>
                                                  <p class="mb-0 font-weight-bold"
                                                     style="opacity: 0.8; font-size: 15px;">
                                                      Exp title</p>
                                                  <p class="mb-0"
                                                     style="opacity: 0.8; font-size: 15px;">
                                                      Exp industry</p>
                                              </div>
                                              <div class="pb-3 pt-2">
                                                  <p class="mb-0 text-muted">Exp description</p>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        <!-- EXP END -->
                    </div>
                    <div class="col-xl-6 col-lg-12 px-0 my-1">
                        <div class="mb-3">
                            <h5 class="text-left h5 mb-1 mt-0 overview_color">Skills</h5>
                              <div class="text-left">
                                  <div>
                                      <h6 class="mt-0 h6 my-0"></h6>
                                  </div>
                                  <div class="d-flex align-items-baseline">
                                      <div class="bg-light rounded border mr-3"
                                           style="width:100px; height: 12px">
                                          <div class="bg-primary rounded"
                                               style="width: 50%; height: 100%;"></div>
                                      </div>
                                      <span class="text-left mb-0 mr-3 text-muted" style="flex:1;"><strong>Skill title</strong> Skill description</span>
                                  </div>
                              </div>
                        </div>
                        <div class="mb-4">
                              <p class="text-left h5 mt-0 mb-1 overview_color">Languages</p>
                              <div class="d-flex align-items-baseline">
                                  <div class="bg-light rounded border mr-3"
                                       style="width:100px; height: 12px">
                                      <div class="bg-primary rounded"
                                           style="width: 50%; height: 100%;"></div>
                                  </div>
                                  <p class="text-left mb-0 mr-3 text-muted" style="flex:1;">language title</p>
                              </div>
                        </div>
                        <div>
                          <div class="mb-4">
                            <p class="text-left h5 mt-0 mb-1 overview_color" style="word-break: break-all;">Permits/Certifications/Licenses</p>
                            <div class="text-left">
                                <p class="mb-0 text-muted">
                                    <strong>Title</strong>
                                    <span class="text-secondary">Certification type</span>
                                    <span class="font-weight-bold">Certification year</span>
                                </p>
                            </div>
                          </div>
                          <div class="mb-3">
                                <p class="text-left h5 mb-1 overview_color" style="word-break: break-all;">Distinctions/Achievements</p>
                                <div class="text-left">
                                    <p class="mb-0 text-muted">
                                        <strong>distinction title</strong>
                                        <span class="font-weight-bold">distinction year</span>
                                    </p>
                                </div>
                          </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <p class="text-left h5 mt-0 mb-1 overview_color">Hobbies and Interests</p>
                                <div class="text-left mb-1">
                                    <div>
                                        <p class="mt-0 h6 my-0"></p>
                                        <p class="mb-0 text-muted"><strong>hobby title</strong> hobby description</p>
                                    </div>
                                </div>

                                <div class="text-left mb-1">
                                    <div>
                                        <p class="h6 my-0"></p>
                                        <p class="mb-0 text-muted"><strong>interest title</strong> interest description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                      
            </div>


          </div>
        </div>
        <div class="px-5 pxa-0 card my-5 py-3 rounded align-self-start">
            <div class="col-12">
                <p><button class="btn btn-warning btn-block">I'm Interested</button></p> 
                <div class="my-1 text-left">
                    <h5 class="h5 mb-1 mt-0 overview_color">Hiring? <span class="text-muted" style="font-size: 13px;"><strong>Access Mark's...</strong></span></h5>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Phone number</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Email</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Social Networks, Website</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Full Address</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Availabilities</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">References</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Salary, distance, hours</p>
                    <p class="mb-0 text-muted"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Instant message</p>
                </div>
            </div> 
        </div>
    </div>
</div>
@endsection