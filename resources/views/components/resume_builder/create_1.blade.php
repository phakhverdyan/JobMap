<div class="col-12 pb-3 pt-5 form-tab-content active resume-builder-step" data-builder-step="BasicInfo">
    <div class="row justify-content-center" id="user-basic-info">
        <div class="col-11">
            <div class="row text-left">
                <div class="col-12">
                    <div class="mb-2 d-flex justify-content-between flex-lg-row flex-column">
                        <div class="text-center col-lg-4 col-12 pxa-0">
                            <h5 class="h5 mb-3 text light-grey">{!! trans('resume_builder.basic.profile_picture') !!}</h5>
                            <div class="p-1 mb-3 d-inline-block rounded bg-white user-pic-view"
                                 style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                                <img src="" class="resume-userpic" style="width: 150px; height: 150px;">
                            </div>
                            <div class="d-block">
                                <div class="d-inline-block bg-white">
                                    <button type="button" class="btn btn-outline-primary" id="resume-user-pic-change-btn">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489.711 489.711" style="enable-background:new 0 0 489.711 489.711; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="20px" height="20px" class="mr-2">
                                            <g>
                                                <g>
                                                    <path d="M112.156,97.111c72.3-65.4,180.5-66.4,253.8-6.7l-58.1,2.2c-7.5,0.3-13.3,6.5-13,14c0.3,7.3,6.3,13,13.5,13    c0.2,0,0.3,0,0.5,0l89.2-3.3c7.3-0.3,13-6.2,13-13.5v-1c0-0.2,0-0.3,0-0.5v-0.1l0,0l-3.3-88.2c-0.3-7.5-6.6-13.3-14-13    c-7.5,0.3-13.3,6.5-13,14l2.1,55.3c-36.3-29.7-81-46.9-128.8-49.3c-59.2-3-116.1,17.3-160,57.1c-60.4,54.7-86,137.9-66.8,217.1    c1.5,6.2,7,10.3,13.1,10.3c1.1,0,2.1-0.1,3.2-0.4c7.2-1.8,11.7-9.1,9.9-16.3C36.656,218.211,59.056,145.111,112.156,97.111z"></path>
                                                    <path d="M462.456,195.511c-1.8-7.2-9.1-11.7-16.3-9.9c-7.2,1.8-11.7,9.1-9.9,16.3c16.9,69.6-5.6,142.7-58.7,190.7    c-37.3,33.7-84.1,50.3-130.7,50.3c-44.5,0-88.9-15.1-124.7-44.9l58.8-5.3c7.4-0.7,12.9-7.2,12.2-14.7s-7.2-12.9-14.7-12.2l-88.9,8    c-7.4,0.7-12.9,7.2-12.2,14.7l8,88.9c0.6,7,6.5,12.3,13.4,12.3c0.4,0,0.8,0,1.2-0.1c7.4-0.7,12.9-7.2,12.2-14.7l-4.8-54.1    c36.3,29.4,80.8,46.5,128.3,48.9c3.8,0.2,7.6,0.3,11.3,0.3c55.1,0,107.5-20.2,148.7-57.4    C456.056,357.911,481.656,274.811,462.456,195.511z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                        {!! trans('main.buttons.modify') !!}
                                    </button>
                                </div>
                            </div>   
                        </div>
                        <div class="col-lg-8 col-12 pxa-0">
                            <div class="text-left px-3 pxa-0">
                                <div class="d-inline-flex">
                                    <div>
                                        <label class="mb-0">
                                            Language 
                                            <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">
                                                <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                            </svg>
                                        </label>
                                        <select class="form-control form-control-sm mb-1 d-inline-flex" name="current_language_prefix">
                                            <option value="en">English</option>
                                            <option value="fr">French</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pxa-0">
                                <h5 class="h5 mb-2 text-center text light-grey">{!! trans('resume_builder.basic.headline') !!}</h5>
                                <div class="form-group mb-0">
                                    <input name="headline" type="text" class="form-control [ multilanguage multilanguage_en ]" placeholder="{!! trans('resume_builder.basic.headline_ex') !!}">
                                    <input name="headline_fr" type="text" class="form-control [ multilanguage multilanguage_fr ] d-none" placeholder="{!! trans('resume_builder.basic.headline_ex') !!}">
                                </div>
                                <p class="text-center">{!! trans('resume_builder.basic.headline_ex_sub_text') !!}</p>
                            </div>

                            <div class="col-12 pxa-0">
                                <div class="row">
                                    <div class="col-6 my-1">
                                        <div class="form-group mb-2">
                                            <label class="text light-grey">{!! trans('fields.label.first_name') !!}</label>
                                            <input type="text" name="first_name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6 my-1">
                                        <div class="form-group mb-2">
                                            <label class="text light-grey">{!! trans('fields.label.last_name') !!}</label>
                                            <input type="text" name="last_name" class="form-control">
                                        </div>
                                    </div>
                                </div>          
                            </div>


                            <div class="col-12 pxa-0">
                                <div class="form-group w-100 mb-4">
                                    <label class="text light-grey">{!! trans('fields.label.birth_date') !!}</label>
                                    <div class="d-flex flex-lg-row flex-column">
                                        <div class="mr-2 col-lg-4 col-12 my-1 mxa-0 pl-0 pxa-0">
                                            <select class="form-control border-0" name="user-year" style="width: 100%;">
                                                @for($i = date('Y') - 13; $i>= date('Y') - 150; $i--)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mr-2 col-lg-5 col-12 my-1 mxa-0 pxa-0">
                                            <select class="form-control border-0" name="user-month" style="width: 100%;">
                                                @for($m = 1; $m <= 12; $m++)
                                                    <option value="{{ date('m', mktime(0, 0, 0, $m, 1)) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="mr-2 col-lg-3 col-12 my-1 mxa-0 pxa-0">
                                            <select class="form-control border-0" name="user-day" style="width: 100%;">
                                                @for($d = 1; $d <= date('t'); $d++)
                                                    <option value="{{ $d }}">{{ $d }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-2 d-flex justify-content-between flex-lg-row flex-column">
                        <div class="col-lg-6 col-12 px-0">
                            <div class="col-12 pl-0 pxa-0">
                                <h5 class="h5 mb-2 text-center text light-grey">{!! trans('fields.label.location') !!}</h5>
                                <div class="form-group mb-2">
                                    <label class="text light-grey">{!! trans('fields.label.street_address') !!}</label>
                                    <div id="input-street-check" class="" style="display: none">
                                        <span style="font-size: 13px;">{!! trans('fields.errors.street_address') !!}</span>
                                        <button class="btn" type="button" id="input-street-number-keep">{!! trans('main.buttons.street_address_keep') !!}</button>
                                        <button class="btn" type="button" id="input-street-number-clear">{!! trans('main.buttons.street_address_clear') !!}</button>
                                    </div>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control border-right-0"
                                               placeholder="{!! trans('fields.placeholder.street_address') !!}" name="street" id="user-location-street">
                                        <span class="input-group-btn border-0" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                            <button class="btn mx-0 border-0" type="button" id="user-location-street-clear"
                                                    style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 pl-0 pxa-0">
                                <label class="text light-grey text-left">{!! trans('fields.label.city_region_country') !!}</label>
                                <div class="form-group input-group mb-2">
                                    <span class="input-group-addon" id="basic-addon1" style="border-top-left-radius: 10px; border-bottom-left-radius: 10px;">
                                        <i class="glyphicon"></i> 
                                    </span>
                                    <input type="text" id="user-location" name="city" class="form-control"
                                           placeholder="{!! trans('fields.placeholder.city') !!}">
                                    <span class="input-group-btn border-0" style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        <button class="btn mx-0 border-0" type="button" id="user-location-clear"
                                                style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 px-0">
                            <div class="col-12 pr-0 pxa-0">
                                <h5 class="h5 mb-2 text-center text light-grey">{!! trans('main.label.contact') !!}</h5>
                                <div class="row">
                                    <div class="col-12 selectskill mb-2">
                                        <div class="d-flex flex-column flex-lg-row">
                                            <div class="col-12 col-lg-6 pl-0 pxa-0">
                                                <label>{!! trans('fields.label.phone_code') !!}</label>
                                                <div id="country-phone" class="bfh-selectbox bfh-countries"
                                                     data-country="CA" data-flags="true">
                                                    <input type="hidden" name="phone_country_code" value="CA"
                                                           class="country"><a
                                                            class="bfh-selectbox-toggle   form-control"
                                                            role="button" data-toggle="bfh-selectbox" href="#"
                                                            style="padding: 8px 20px;">
                                                            <span class="bfh-selectbox-option" id="phone_code">
                                                                <i class="glyphicon bfh-flag-CA"></i>+1 <span>Canada</span></span></a>
                                                    <div class="bfh-selectbox-options">
                                                        <div class="bfh-selectbox-filter-container"><input
                                                                    type="text"
                                                                    class="bfh-selectbox-filter form-control"
                                                                    placeholder="search"  autocomplete="off"></div>
                                                        @include('components.phone_flag')</div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 pr-0 pxa-0">
                                                <label>{!! trans('fields.label.phone_number') !!}</label>
                                                <input type="tel" class="form-control" id="input-phone"  autocomplete="off" value=""
                                                       placeholder="{!! trans('fields.placeholder.phone_number') !!}" name="phone_number">
                                            </div>
                                        </div>
{{--                                        <label class="text light-grey text-left">{!! trans('fields.label.phone_number') !!}</label>--}}
{{--                                        <div class="row no-gutters text-left">--}}
{{--                                            <div class="col-3">--}}
{{--                                                <div id="mobile-phone" class="bfh-selectbox bfh-countries mr-2" data-country="CA"--}}
{{--                                                     data-flags="true"></div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-12">--}}
{{--                                                <input type="tel" class="form-control" name="mobile_phone"--}}
{{--                                                       placeholder="{!! trans('fields.placeholder.phone_number') !!}">--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb-2">
                                            <label class="text light-grey">{!! trans('fields.label.website') !!}</label>
                                            <input type="text" class="form-control" name="website"
                                                   placeholder="{!! trans('fields.placeholder.website') !!}">
                                        </div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>
                            <img src="{{ asset('img/icons/facebook.svg') }}" width="30px" height="30px">
                            Facebook
                        </label>
                        <input type="text" name="facebook" placeholder="facebook.com/user123" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>
                            <img src="{{ asset('img/icons/instagram.svg') }}" width="30px" height="30px">
                            Instagram
                        </label>
                        <input type="text" name="instagram" placeholder="instagram.com/user123" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>
                            <img src="{{ asset('img/icons/linkedin.svg') }}" width="30px" height="30px">
                            LinkedIn
                        </label>
                        <input type="text" name="linkedin" placeholder="linkedin.com/user123" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>
                            <img src="{{ asset('img/icons/twitter.svg') }}" width="30px" height="30px">
                            Twitter
                        </label>
                        <input type="text" name="twitter" placeholder="twitter.com/user123" class="form-control">
                    </div>

                    <div class="col-12 px-0 pxa-0">
                        <div class="form-group mb-0">
                            <h5 class="h5 text-left text light-grey">
                                {!! trans('fields.label.about_me') !!} 
                                <span class="h6 text-secondary">{!! trans('main.label.max_characters', ['count' => 1000]) !!}</span>
                            </h5>
                            <textarea name="about" maxlength="1000" class="form-control text-secondary [ multilanguage multilanguage_en ]"
                                      rows="6"></textarea>
                            <textarea name="about_fr" maxlength="1000" class="form-control text-secondary [ multilanguage multilanguage_fr ] d-none"
                                      rows="6"></textarea>
                        </div>
                        <p class="text-center">{!! trans('resume_builder.basic.about_me_sub_text') !!}</p>
                    </div>


                </div>
                

                
                
                
            </div>
        </div>
    </div>
</div>