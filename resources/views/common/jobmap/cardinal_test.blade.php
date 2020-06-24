@extends('layouts.common_user')

@section('content')

  <link rel="stylesheet" type="text/css" href="{{ asset('css/slick.css?' . time()) }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/slick-theme.css?' . time()) }}"/>
  <style type="text/css">
    body{
      background: #fff!important;
    }
    .slick-prev:before,
    .slick-next:before{
        color: #999;
    }

    #job-map {
      height: 82vh!important;
      transition: all 1s;
    }

    #job-map.half-map {
      height: 50vh!important;
      transition: all 1s;
    }

    .content.hide {
      display: none;
      transition: all 1s;
      animation-delay: 1s;
    }

    .content {
      display: block;
      transition: all 1s;
      animation-delay: 1s;
    }

    .content__search-form.fixed-full-map {
      position: absolute;
      animation: openAnimation 0.5s both ease-in;
      
    }

    @keyframes openAnimation {
      0% {
        top:0;
        left:0;
      }

      100% {
        
        top: 170px;
        left: 15px;
      }
    }

    .content__search-form {
      transition: all 1s;
      position: relative;
    }

    .map__button-full-map {
      position: absolute; 
      left: 50%; transform: translateX(-50%); 
      z-index: 5;
    }
  </style>


    <div class="container-fluid px-0 mt-3 user-landing">
        <div>
          <div class="col-md-12 px-0 half-map" id="job-map"></div>
        </div>
        <div class="container">

            <button class="btn btn-viewcp [ map__button-full-map ] "> {!! trans('main.buttons.explore_full_map') !!} </button>

            
            <div class="col-12 mx-auto pt-5 pb-2 animated fadeInDown px-0" style="position: inherit;">
                <form action="/search/jobs?" id="search-form" autocomplete="off">
                    <label class="text-left [ content__search-form__label ]" style="color:#555;">{!! trans('fields.label.job_title_or_company') !!}</label>
                    <div class="d-flex flex-column flex-lg-row [ content__search-form ]">
                        <div class="col-12 col-lg-10 px-0 pxa-0" id="title-box">
                            <div class="form-control bg-white rounded-0 d-flex border"
                                 style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075);">
                                <button class="btn border-0 p-0 align-self-center" style="background: transparent;">
                                    @svg('/img/menu-options.svg', [
                                        'width' => '20px',
                                        'height' => '20px',
                                        'style' => 'fill:#B2B2B2; vertical-align: middle;',
                                        'class' => 'mr-3',
                                    ])
                                </button>
                                <input type="text" name="title" placeholder="{!! trans('fields.placeholder.job_title_or_company') !!}" autocomplete="off"
                                       style="font-size: 17px; border:none; box-shadow: none; padding: 9px 0;width: 100%; background-color: inherit!important;">
                            </div>
                        </div>
                        <div class="col-12 col-lg-2 px-0 pxa-0" id="button-box">
                            <button type="button" id="search-button"
                                    class="btn btn-primary w-100 border-top-left-0 border-bottom-left-0 cardinal_button">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Capa_1" x="0px" y="0px" width="30px" height="30px"
                                         viewBox="0 0 485.213 485.213"
                                         style="enable-background:new 0 0 485.213 485.213; vertical-align: middle; margin-top: -4px; opacity: 0.8;"
                                         xml:space="preserve" fill="#fff">
                                        <g>
                                            <g>
                                                <path d="M363.909,181.955C363.909,81.473,282.44,0,181.956,0C81.474,0,0.001,81.473,0.001,181.955s81.473,181.951,181.955,181.951    C282.44,363.906,363.909,282.437,363.909,181.955z M181.956,318.416c-75.252,0-136.465-61.208-136.465-136.46    c0-75.252,61.213-136.465,136.465-136.465c75.25,0,136.468,61.213,136.468,136.465    C318.424,257.208,257.206,318.416,181.956,318.416z"/>
                                                <path d="M471.882,407.567L360.567,296.243c-16.586,25.795-38.536,47.734-64.331,64.321l111.324,111.324    c17.772,17.768,46.587,17.768,64.321,0C489.654,454.149,489.654,425.334,471.882,407.567z"/>
                                            </g>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="[ content ] pb-5">
              <div class="text-left mt-2 pb-5 wow fadeInLeft d-flex justify-content-between flex-column flex-lg-row col-12 pxa-0 px-0" style="font-size: 16px;">
                  <a href="{{ url('/landing')}}" class="cardinal_links align-self-center mx-2 d-md-flex d-none"><strong>Hiring?</strong></a>
              </div>

              <div class="mb-5">
                  <p class="title_left_sorting text-center" style="font-size: 25px;">
                      <a href="javascript:;" class="cardinal_links">
                          <strong>Explore Top Employers</strong>
                      </a>
                  </p>

                  <div class="business_slick">

                    <div>
                      <div class="px-3 mb-3">
                        <div class="company_item bg-white pt-3">
                          <a href="https://jobmap.co/business/view/8/soluflex" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/295/energie-cardio" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/energiecardio.png') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/236/sushi-shop" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/sushishop.jpg') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/279/pizza-delight" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/pizzadelight.jpg') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/294/scores" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/scores.png') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/282/taco-time" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/tacotime.jpg') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/266/thai-express" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/thaiexpress.jpg') }}" style="width: 145px; border-radius: 10px;"></a>
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
                          <a href="https://jobmap.co/business/view/245/country-style" target="_blank"><img class="mx-auto" src="{{ asset('img/landing/businesses/countrystyle.png') }}" style="width: 145px; border-radius: 10px;"></a>
                          <div class="py-4 text-center">
                            <p class="mb-2"><strong>Country Style</strong></p>
                            <p class="mb-0"><a href="https://jobmap.co/business/view/245/country-style" target="_blank">{!! trans('landing.button.view_career_page') !!}</a></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              <div class="pt-5">
                  <p class="title_left_sorting text-center" style="font-size: 25px;">
                      <a href="javascript:;" class="cardinal_links">
                          <strong>Latest jobs near you</strong>
                      </a>
                  </p>

                  <div class="d-flex flex-wrap justify-content-between">

                    <div>
                      <div class="px-3 mb-3">
                        <div class="company_item bg-white p-3">
                          <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                            <img src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 55px; border-radius: 10px;" class="align-self-center">
                            <span class="align-self-center"><strong>Cashier</strong></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="px-3 mb-3">
                        <div class="company_item bg-white p-3">
                          <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                            <img src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 55px; border-radius: 10px;" class="align-self-center">
                            <span class="align-self-center"><strong>Cashier</strong></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="px-3 mb-3">
                        <div class="company_item bg-white p-3">
                          <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                            <img src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 55px; border-radius: 10px;" class="align-self-center">
                            <span class="align-self-center"><strong>Cashier</strong></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="px-3 mb-3">
                        <div class="company_item bg-white p-3">
                          <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                            <img src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 55px; border-radius: 10px;" class="align-self-center">
                            <span class="align-self-center"><strong>Cashier</strong></span>
                          </a>
                        </div>
                      </div>
                    </div>
                    <div>
                      <div class="px-3 mb-3">
                        <div class="company_item bg-white p-3">
                          <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                            <img src="{{ asset('img/landing/businesses/soluflex.png') }}" style="width: 55px; border-radius: 10px;" class="align-self-center">
                            <span class="align-self-center"><strong>Cashier</strong></span>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <p class="mb-0 mt-2 px-3"><a href="{!! url('/explore-employers') !!}" class="btn btn-outline-primary seeall_btn">{!! trans('main.buttons.see_all') !!}</a></p>
              </div>

              <div class="pt-5">
                <p class="title_left_sorting text-center" style="font-size: 25px;">
                    <a href="javascript:;" class="cardinal_links">
                        <strong>Explore most popular industries</strong>
                    </a>
                </p>   
                <div class="d-flex justify-content-between">

                  <div class="px-3 mb-3">
                    <div class="">
                      <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                        <span class="align-self-center"><strong>Accounting</strong></span>
                      </a>
                    </div>
                  </div>
                  <div class="px-3 mb-3">
                    <div class="">
                      <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                        <span class="align-self-center"><strong>Accounting</strong></span>
                      </a>
                    </div>
                  </div>
                  <div class="px-3 mb-3">
                    <div class="">
                      <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                        <span class="align-self-center"><strong>Accounting</strong></span>
                      </a>
                    </div>
                  </div>
                  <div class="px-3 mb-3">
                    <div class="">
                      <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                        <span class="align-self-center"><strong>Accounting</strong></span>
                      </a>
                    </div>
                  </div>
                  <div class="px-3 mb-3">
                    <div class="">
                      <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                        <span class="align-self-center"><strong>Accounting</strong></span>
                      </a>
                    </div>
                  </div>
                  <div class="px-3 mb-3">
                    <div class="">
                      <a href="https://jobmap.co/business/view/8/soluflex" target="_blank" class="d-flex">
                        <span class="align-self-center"><strong>Accounting</strong></span>
                      </a>
                    </div>
                  </div>
                </div>

                <p class="mb-0 mt-2 px-3"><a href="{!! url('/explore-employers') !!}" class="btn btn-outline-primary seeall_btn">{!! trans('main.buttons.see_all') !!}</a></p>
              </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3&amp;key=AIzaSyD3mcG8oAZzzlCSGZt5B4u5h5LmBX1SgjE"></script>
    <script src="{{ asset('/js/app/CustomGoogleMapMarker.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/job-map.js?v='.time()) }}"></script>

    <script type="text/javascript">
      $('.business_slick').slick({
        infinite: true,
        slidesToShow: 4,
        slidesToScroll: 4,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 4000,
      });

      $('.jobs_slick').slick({
        infinite: true,
        slidesToShow: 6,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 4000,
      });
    </script>

    <script type="text/javascript">
      $(document).ready(function(){
        $(".map__button-full-map").click(function(){
          $("#job-map").toggleClass('half-map');
          $('.content').toggleClass('hide');
          $('.content__search-form').toggleClass('fixed-full-map');
          $('.content__search-form__label').toggle();
        });
      });
    </script>


@endsection
