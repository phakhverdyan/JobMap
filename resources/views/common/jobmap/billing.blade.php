@extends('layouts.jobmap.common_user')
<link rel="stylesheet" href="{{ asset('/css/business_landing.css?v='.time()) }}">
<link rel="stylesheet" href="{{ asset('/css/business_landing_animation.css?v='.time()) }}">
@section('content')

    <div class="col-12 px-0 bg-white">
        <div class="pt-2 text-center">
            <div class="section_nine py-5">
              <div class="container pt-2 text-center">
                    <div class="pricing_section">
                        <h2 class="mb-3 h1 section__one-title">{!! trans('pages.text.pricing_new.after_title') !!}</h2>
                        <p class="text-center mb-5 response_title_pricing" style="font-size: 18pt; font-weight: 300;">
                          {!! trans('pages.text.pricing_new.title') !!}
                        </p>
                        <div class="d-flex justify-content-between flex-lg-row flex-column my-4">
                          <div class="col-lg-6 align-self-center">
                            @svg('img/gift.svg', [
                              'width' => '100%',
                            ])
                          </div>
                          <div class="col-lg-6 align-self-center">
                            <ul class="pl-0 text-left" style="list-style: none;">
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Create your career page
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Add your career page to your website
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Add unlimited locations (all your stores, offices, warehouses and more)
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Add unlimited job offering
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Add all your brands in one account
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Unlimited managers and franchisees
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Add a questionnaire before candidates apply
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                View resumes of candidates
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Receive notifications by email
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Free visibility on Google and Google Jobs
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Share your openings on Facebook and LinkedIn
                              </li>
                              <li class="py-2">
                                @svg('img/checked_pricing.svg', [
                                  'width' => '20px',
                                  'height' => '20px',
                                  'class' => 'mr-2',
                                  'style' => 'vertical-align:middle; margin-top:-3px;'
                                ])
                                Unify and control your HR Brand
                              </li>
                            </ul>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section_ten py-5">
              <div class="container">
                <div class="d-flex justify-content-center">
                  <h2 class="mb-3 h1 section__one-title text-center align-self-center">
                    JobMap Premium            
                  </h2>
                  <span class="align-self-start"><small>*1st month free</small></span>
                </div>
                <p class="text-center mb-5 response_title_pricing" style="font-size: 18pt; font-weight: 300;">
                  Enjoy premium features to enhance your human resources eperience.
                </p>
                <p class="text-center mb-5 response_title_pricing" style="font-weight: 300;">
                  JobMap isn't just you typical job advertising platform. We don't garanty or provide candidates. JobMap has multiple services that you
                  can use for free to optimize and add visibility, From your website to you social medias. Get the premium service to access all these greats features
                </p>

                <div>
                  <h3 class="text-center">Complete control over the candidate pipeline Feature:</h3>
                  <div class="d-flex justify-content-between flex-lg-row flex-column mb-4">
                    <div class="col-lg-6 align-self-center">
                      @svg('img/ribbon.svg', [
                        'width' => '80%',
                      ])
                    </div>
                    <div class="col-lg-6 align-self-center">
                      <ul class="pl-0 text-left" style="list-style: none;">
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Add notes on the candidates
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Print and share resumes
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Move candidates in the pipeline
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Send and manage interview requests
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Chat with Candidates within the platform for direct contact
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Send update requests to know if information are still up to date
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          Share information on the candidates within other managers
                        </li>
                        <li class="py-2">
                          @svg('img/checked_pricing.svg', [
                            'width' => '20px',
                            'height' => '20px',
                            'class' => 'mr-2',
                            'style' => 'vertical-align:middle; margin-top:-3px;'
                          ])
                          And a lot more to come
                        </li>
                      </ul>
                    </div>
                  </div>

                  <div class="d-flex justify-content-between flex-lg-row flex-column">
                    <div class="col-lg-4 text-center">
                      <p>
                        @svg('img/monthly.svg', [
                            'width' => '76px',
                            'height' => '76px',
                        ])
                      </p>
                      <p class="h5 mb-3"><strong>Monthly</strong></p>
                      <p>25$/Managers/month (recurring)</p>
                    </div>
                    <div class="col-lg-4 text-center">
                      <p>
                        @svg('img/2019.svg', [
                            'width' => '76px',
                            'height' => '76px',
                        ])
                      </p>
                      <p class="h5 mb-3"><strong>1 year</strong></p>
                      <p>Starting at 270$/1 year (10% discount)</p>
                    </div>
                    <div class="col-lg-4 text-center">
                      <p>
                        @svg('img/partnership.svg', [
                            'width' => '76px',
                            'height' => '76px',
                        ])
                      </p>
                      <p class="h5 mb-3"><strong>Partnerships</strong></p>
                      <p>On demand</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

@include('components.jobmap.modal.request_callback')

@endsection

@section('script')
    <script src="{{ asset('/js/jobmap/billing.js?v='.time()) }}"></script>
@endsection
