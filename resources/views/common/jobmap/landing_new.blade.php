@extends('layouts.common_business_landing')

@section('content')

    <div class="section_one">
      <div class="container">
          <div class="d-flex flex-lg-row flex-column">
            <div class="col-lg-6 align-self-center" style="overflow: hidden;">
              <h2 class="mb-2 section__one-title">
                <div class="slick_slider">
                  <div>{!! trans('landing.slider.text_1') !!}</div>
                  <div>{!! trans('landing.slider.text_3') !!}</div>
                  <div>{!! trans('landing.slider.text_4') !!}</div>
                </div>

              </h2>
              <div class="d-flex my-3">
                <p class="h3 align-self-center mr-3 my-5" style="white-space: nowrap;">
                  {!! trans('landing.just_ask') !!}
                </p>
                <div class="align-self-center" style="width: 75px; height: 75px;">
                  <div class="icons_slider">
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/energiecardio.png') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/sushishop.jpg') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/pizzadelight.jpg') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/scores.png') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/tacotime.jpg') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/thaiexpress.jpg') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                    <div class="align-self-center">
                      <a href="#section_five_anchor">
                        <img src="{{ asset('img/landing/businesses/countrystyle.png') }}" style="width: 75px; height: 75px; border-radius: 10px;">
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 align-self-center">
              <img src="{{ asset('img/Design.png') }}">
            </div>
          </div>
      </div>
    </div>

    <div class="how_works">
      <div class="container">
        <h2 class="mb-5 section__one-title text-center"> {!! trans('landing.new.title_1') !!} </h2>
        <div class="d-flex flex-lg-row flex-column mb-5">
          <div class="col-lg-6 align-self-start text-center">
            <img src="{{ asset('img/slide2_left.png') }}" style="height: 260px;">
            <div class="px-lg-4">
              <h4>{!! trans('landing.new.item_11') !!}</h4>
              <!-- <p>Be visible on your website, google, JobMap and more!</p> -->
            </div>
          </div>
          <div class="col-lg-6 align-self-start text-center">
            <img src="{{ asset('img/slide2_right.png') }}" style="height: 260px;">
            <div class="px-lg-4">
              <h4>{!! trans('landing.new.item_12') !!}</h4>
              <!-- <p>From your website to JobMap or Google Jobs and even paper resumes in store!</p> -->
            </div>
          </div>
        </div>

        <!-- <p class="text-center"><a href="#section_two_anchor" class="mb-5 text-center"> Here's how it works </a></p> -->

      </div>
    </div>

    <div class="section_two p-relative" id="section_two_anchor">
      <div class="container">
        <div class="d-flex flex-lg-row flex-column">
          <div class="col-lg-12 mb-3 align-self-center section_two_block">
            <p class="mb-3 h3"> {!! trans('landing.new.title_2') !!} </p>
            <div>
              <p class="mb-1">{!! trans('landing.new.after_title_2') !!}</p>
              <ul>
                <li class="my-3">{!! trans('landing.new.item_21') !!}</li>
                <li class="my-3">{!! trans('landing.new.item_22') !!}</li>
                <li class="my-3">{!! trans('landing.new.item_23') !!}</li>
                <li class="my-3">{!! trans('landing.new.item_24') !!}</li>
              </ul>
            </div>
          </div>

        </div>
      </div>

    </div>

    <div class="section_four mt-0">
      <div class="container">
        <h2 class="mb-3 section__one-title text-center mb-5">{!! trans('landing.new.title_8') !!}</h2>

        <div class="align-self-center">
          <img src="{{ asset('img/landing/second_image.jpg') }}" class="img_shadow" width="100%">
        </div>
      </div>
    </div>

    <div class="section_three">
      <div class="container">
        <p class="mb-5 h3 text-center">{!! trans('landing.new.title_3') !!}</p>
        <div class="d-flex flex-lg-row flex-column">
          <div class="col-lg-6 align-self-center">
            <img src="{{ asset('img//landing/jobmap3.png') }}" class="img_rounded">
          </div>
          <div class="col-lg-6 align-self-start">
            <h2 class="mb-5">{!! trans('landing.new.sub_title_3') !!}</h2>
            <div>
              <ul class="mb-3">
                <li class="my-3">{!! trans('landing.new.item_31') !!}</li>
                <li class="my-3">{!! trans('landing.new.item_32') !!}</li>
                <li class="mt-3">{!! trans('landing.new.item_33') !!}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="section_four">
      <div class="container">
        <div class="align-self-center text-center mb-5">
          <h2 class="mb-3 section__one-title"> {!! trans('landing.new.title_4') !!} </h2>
          <!-- <p>{!! trans('landing.new.item_41') !!}</p> -->
          <p>{!! trans('landing.new.item_42') !!}</p>
        </div>
        <div class="align-self-center">
          <img src="{{ asset('img/google_jobs.png') }}" class="img_shadow">
        </div>
      </div>
    </div>

    <div class="section_four_social">
      <div class="container">

        <p class="h2 mb-5 text-center">{!! trans('landing.new.before_title_5') !!}</p>
        <div class="d-flex flex-lg-row flex-column">
          <div class="col-lg-6 align-self-center">
            <img src="{{ asset('img/landing/socialsection.png') }}">
          </div>
          <div class="col-lg-6 align-self-center">
            <h3 class="mb-3"> {!! trans('landing.new.title_5') !!}</h3>
            <p>{!! trans('landing.new.item_51') !!}</p>
            <p><strong>{!! trans('landing.new.item_52') !!}</strong></p>
          </div>
        </div>
      </div>
    </div>


    <div class="section_five" id="section_five_anchor">
      <div class="container">
        <h3 class="text-center">{!! trans('landing.new.title_6') !!}</h3>
        <p class="text-center mb-5">{!! trans('landing.new.sub_title_6') !!}</p>

        <div class="business_slick">

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/8/soluflex" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Soluflex</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/8/soluflex" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/295/energie-cardio" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/energiecardio.png') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Energie Cardio</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/295/energie-cardio" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/236/sushi-shop" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/sushishop.jpg') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Sushi Shop</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/236/sushi-shop" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/279/pizza-delight" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/pizzadelight.jpg') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Pizza Delight</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/279/pizza-delight" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/294/scores" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/scores.png') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Scores</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/294/scores" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/282/taco-time" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/tacotime.jpg') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Taco Time</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/282/taco-time" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/266/thai-express" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/thaiexpress.jpg') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Thai Express</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/266/thai-express" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>

          <div>
            <div class="px-3 mb-3">
              <div class="company_item bg-white pt-3">
                <a href="https://jobmap.co/business/view/245/country-style" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/countrystyle.png') }}" style="width: 175px; border-radius: 10px;"></a>
                <div class="py-4 text-center">
                  <p class="mb-2"><strong>Country Style</strong></p>
                  <p class="mb-0"><a href="https://jobmap.co/business/view/245/country-style" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <div class="section_six">
      <div class="container">
        <h2 class="text-center mb-3">{!! trans('landing.new.title_7') !!}</h2>
        <p class="text-center h5">{!! trans('landing.new.sub_title_7') !!}</p>

        <div class="d-flex flex-lg-row flex-column margin_top100">
          <div class="col-lg-6 align-self-center mb-5 mb-lg-0">
            <img src="{{ asset('img/landing/bluesection.png') }}" alt="">
          </div>
          <div class="col-lg-6 align-self-center">

            <div class="mb-5">
              <div class="d-flex">
                <div class="mr-3">
                  @svg('/img/landing/manager_ats.svg', [
                    'width' => '36px',
                    'height' => '36px',
                    'style' => 'fill:#45456c;',
                  ])

                </div>
                <div class="col-10">
                  <h3 class=" mt-0">{!! trans('landing.new.item_71') !!}</h3>
                  <p>{!! trans('landing.new.item_71_text') !!}</p>
                </div>
              </div>
            </div>

            <div class="mb-5">
              <div class="d-flex">
                <div class="mr-3">
                  @svg('/img/landing/blue_secicon.svg', [
                    'width' => '36px',
                    'height' => '36px',
                    'style' => 'fill:#45456c;',
                  ])
                </div>
                <div class="col-10">
                  <h3 class="mt-0">{!! trans('landing.new.item_72') !!}</h3>
                  <p>{!! trans('landing.new.item_72_text') !!}</p>
                </div>
              </div>
            </div>

            <div class="mb-5">
              <div class="d-flex">
                <div class="mr-3">
                  @svg('/img/landing/blue_3icon.svg', [
                    'width' => '36px',
                    'height' => '36px',
                    'style' => 'fill:#45456c;',
                  ])
                </div>
                <div class="col-10">
                  <h3 class=" mt-0">{!! trans('landing.new.item_73') !!}</h3>
                  <p>{!! trans('landing.new.item_73_text') !!}</p>
                </div>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div class="section_nine py-5">
      <div class="container pt-2 text-center">
            <div class="pricing_section">
                <h2 class="mb-3 h1 section__one-title">{!! trans('pages.text.pricing_new.after_title') !!}</h2>
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
                        {!! trans('landing.pricing.benefit_list.first_section.1') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.2') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.3') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.4') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.5') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.6') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.7') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.8') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.9') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.10') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.11') !!}
                      </li>
                      <li class="py-2">
                        @svg('img/checked_pricing.svg', [
                          'width' => '20px',
                          'height' => '20px',
                          'class' => 'mr-2',
                          'style' => 'vertical-align:middle; margin-top:-3px;'
                        ])
                        {!! trans('landing.pricing.benefit_list.first_section.12') !!}
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
            {!! trans('landing.pricing.benefit_list.second_section.title') !!}
          </h2>
          <span class="align-self-start"><small>{!! trans('landing.pricing.benefit_list.second_section.month_free') !!}</small></span>
        </div>
        <p class="text-center mb-5 response_title_pricing" style="font-size: 18pt;">
          {!! trans('landing.pricing.benefit_list.second_section.description_1') !!}
        </p>
        <p class="text-center mb-5 response_title_pricing">
          {!! trans('landing.pricing.benefit_list.second_section.description_2') !!}
        </p>

        <div>
          <div class="d-flex justify-content-between flex-lg-row flex-column mb-4 py-5">
            <div class="col-lg-6 align-self-center">
              @svg('img/ribbon.svg', [
                'width' => '100%',
                'height' => '250px',
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
                  {!! trans('landing.pricing.benefit_list.second_section.list.1') !!}
                </li>
                <li class="py-2">
                  @svg('img/checked_pricing.svg', [
                    'width' => '20px',
                    'height' => '20px',
                    'class' => 'mr-2',
                    'style' => 'vertical-align:middle; margin-top:-3px;'
                  ])
                  {!! trans('landing.pricing.benefit_list.second_section.list.2') !!}
                </li>
                <li class="py-2">
                  @svg('img/checked_pricing.svg', [
                    'width' => '20px',
                    'height' => '20px',
                    'class' => 'mr-2',
                    'style' => 'vertical-align:middle; margin-top:-3px;'
                  ])
                  {!! trans('landing.pricing.benefit_list.second_section.list.3') !!}
                </li>
                <li class="py-2">
                  @svg('img/checked_pricing.svg', [
                    'width' => '20px',
                    'height' => '20px',
                    'class' => 'mr-2',
                    'style' => 'vertical-align:middle; margin-top:-3px;'
                  ])
                  {!! trans('landing.pricing.benefit_list.second_section.list.4') !!}
                </li>
                <li class="py-2">
                  @svg('img/checked_pricing.svg', [
                    'width' => '20px',
                    'height' => '20px',
                    'class' => 'mr-2',
                    'style' => 'vertical-align:middle; margin-top:-3px;'
                  ])
                  {!! trans('landing.pricing.benefit_list.second_section.list.5') !!}
                </li>
                <li class="py-2">
                  @svg('img/checked_pricing.svg', [
                    'width' => '20px',
                    'height' => '20px',
                    'class' => 'mr-2',
                    'style' => 'vertical-align:middle; margin-top:-3px;'
                  ])
                  {!! trans('landing.pricing.benefit_list.second_section.list.6') !!}
                </li>
                <li class="py-2">
                  @svg('img/checked_pricing.svg', [
                    'width' => '20px',
                    'height' => '20px',
                    'class' => 'mr-2',
                    'style' => 'vertical-align:middle; margin-top:-3px;'
                  ])
                  {!! trans('landing.pricing.benefit_list.second_section.list.7') !!}
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
              <p class="h5 mb-3"><strong>{!! trans('landing.pricing.benefit_list.second_section.plans.monthly') !!}</strong></p>
              <p>{!! trans('landing.pricing.benefit_list.second_section.plans.monthly_price') !!}</p>
            </div>
            <div class="col-lg-4 text-center">
              <p>
                @svg('img/2019.svg', [
                    'width' => '76px',
                    'height' => '76px',
                ])
              </p>
              <p class="h5 mb-3"><strong>{!! trans('landing.pricing.benefit_list.second_section.plans.yearly') !!}</strong></p>
              <p>{!! trans('landing.pricing.benefit_list.second_section.plans.yearly_price') !!}</p>
            </div>
            <div class="col-lg-4 text-center">
              <p>
                @svg('img/partnership.svg', [
                    'width' => '76px',
                    'height' => '76px',
                ])
              </p>
              <p class="h5 mb-3"><strong>{!! trans('landing.pricing.benefit_list.second_section.plans.partnerships') !!}</strong></p>
              <p>{!! trans('landing.pricing.benefit_list.second_section.plans.partnerships_price') !!}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(
    function () {
        $('.mobile_hamb').on('click', function () {
            $('.mobile_menu').slideToggle();
        });
    });

    $(document).ready(function(){
        $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>

<script type="text/javascript">
  $('.slick_slider').slick({
    autoplay: true,
    autoplaySpeed: 4000,
    arrows: false,
    fade: true,
  });

  $('.icons_slider').slick({
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    fade: true,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
  });

  $('.business_slick').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 4,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 4000,
  });
</script>

<script type="text/javascript">
  $(document).on('click', 'a[href^="#"]', function (event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: ($($.attr(this, 'href')).offset().top - 50)
    }, 500);
});
</script>
@endsection
