
@extends('layouts.jobmap.common_user')

@section('content')


    <div class="container-fluid mt-3 user-landing">
        <div class="row">
            <div class="container">
                <div class="col-12 mt-0">
                    <div class="px-3" style="height: 300px;">
                        <div>MAP</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container pb-5">
                <div class="col-12 text-center" style="margin-top: -19px;">
                    <button class="btn btn-outline-primary">Explore Full Map</button>
                </div>
                <div class="col-12 mx-auto animated fadeInDown">
                    <p class="text-right mt-4 wow fadeInRight text-center text-lg-left" style="font-size: 16px;">
                        <a href="#" class="cardinal_links"><strong>Hiring?</strong> Add unlimited jobs and locations for
                            free</a>
                    </p>
                </div>
                 <p class="p-4 mb-0 text-left" style="background: rgba(0,121,254,0.05);">
                    <a href="/map/world" id="link-location-world" class="breadcrumb_custom" data-toggle="tooltip" data-placement="top" title="Explore the World">World</a>
                    <span style="opacity: 0.2;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 292.359 292.359" style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                            <g>
                                <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                            </g>
                        </svg>
                    </span>
                    <a href="#" id="link-location-country"  class="breadcrumb_custom" data-toggle="tooltip" data-placement="top" title="Explore Country">Canada</a>
                    <span style="opacity: 0.2;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 292.359 292.359" style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                            <g>
                                <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                            </g>
                        </svg>
                    </span>
                    <a href="#" id="link-location-city"  class="breadcrumb_custom" data-toggle="tooltip" data-placement="top" title="Explore City">Monreal</a>
                    <span style="opacity: 0.2;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 292.359 292.359" style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                            <g>
                                <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                            </g>
                        </svg>
                    </span>
                    <a href="#" id="link-location-street"  class="breadcrumb_custom" data-toggle="tooltip" data-placement="top" title="Explore Street">McGill Street</a>
                    <span style="opacity: 0.2;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 292.359 292.359" style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                            <g>
                                <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                            </g>
                        </svg>
                    </span>
                    <a href="#" id="link-location-address"  class="breadcrumb_custom" data-toggle="tooltip" data-placement="top" title="Explore building/location">McGill Street 43</a>
                    <span style="opacity: 0.2;">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 292.359 292.359" style="enable-background:new 0 0 292.359 292.359; vertical-align: middle; margin-top: -3px;" xml:space="preserve">
                            <g>
                                <path d="M222.979,133.331L95.073,5.424C91.456,1.807,87.178,0,82.226,0c-4.952,0-9.233,1.807-12.85,5.424   c-3.617,3.617-5.424,7.898-5.424,12.847v255.813c0,4.948,1.807,9.232,5.424,12.847c3.621,3.617,7.902,5.428,12.85,5.428   c4.949,0,9.23-1.811,12.847-5.428l127.906-127.907c3.614-3.613,5.428-7.897,5.428-12.847   C228.407,141.229,226.594,136.948,222.979,133.331z"/>
                            </g>
                        </svg>
                    </span>
                    <span><strong>Explore jobs in this building</strong></span>
                </p>
                <div class="col-12 bg-white">
                    <div class="row border flex-column flex-lg-row">
                        <div class="col-12 col-lg-8 py-3">
                            <div class="d-flex flex-column flex-lg-row text-center text-lg-left">
                                <div>
                                    <img src="{{ asset('img/dhl.png') }}" style="width: 65px; height: 65px;">
                                </div>
                                <div class="ml-2">
                                    <p class="h4">DHL Corporation</p>
                                    <p>
                                        <a href="#" class="breadcrumb_custom">Address</a> 
                                        ,
                                        <a href="#" class="breadcrumb_custom">City</a> 
                                        ,
                                        <a href="#" class="breadcrumb_custom">Region</a> 
                                        ,
                                        <a href="#" class="breadcrumb_custom">Country</a>
                                    </p>
                                    <p>
                                        <strong>Releated keywords</strong>
                                        <a href="#" class="ml-3 breadcrumb_custom">Mining</a>
                                        <button class="btn btn-outline-primary btn-sm ml-2 seeall_btn">See all</button>
                                    </p>
                                </div>
                            </div>
                            <p class="text-center text-lg-left"><button class="btn btn-primary">Claim your applicants</button></p>
                            <p class="text-center text-lg-left">
                                <img src="http://crjmrepo/img/sidebar/active.png" style="margin-top: -3px;"> 
                                <strong>This employer accepts resumes even if no jobs are posted</strong>
                            </p>
                            <p class="text-center text-lg-left pxa-0" style="padding-left: 18px;">These are known as flash applicantions</p>
                        </div>
                        <div class="col-12 col-lg-4  py-3 text-center">
                            <p class="h5"><strong>Interest to work here?</strong></p>
                            <p>
                                <button class="btn btn-outline-primary send-resume" id="animate_hover" data-toggle="tooltip" data-placement="top" title="" data-original-title="Apply to this job." data-b-id="3">
                                    <span class="mb-0 pt-2 pb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 306 306; vertical-align: middle; margin-top: -3px;" xml:space="preserve" width="25px" height="25px" id="icon_fadeDown" class="animated fadeInDown mr-2">
                                            <g>
                                                <path d="M288,96H128V64h160V96z M384,256H128v32h256V256z M352,128H128v32h224V128z M384,192H128v32h256V192z M512,320v192H0V320   l64-128V0h288l96,96v96L512,320z M448,320h28.219L448,263.562V320z M96,320h31.984L192,416h128l64-96h32v-96V109.25L338.75,32H96   v192V320z M35.781,320H64v-56.438L35.781,320z M480,352h-78.875l-64,96h-162.25l-64.016-96H32v128h448V352z"></path>
                                            </g>
                                        </svg>
                                    </span>
                                    <span class="mb-0 pb-2" style="font-weight: 400;">Send Cloudresume</span>
                                </button>                            
                            </p>
                            <p><a href="#" class="btn seeall_btn" role="button">What is CloudResume?</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3 px-0">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p class="h6 pl-3 text-center text-lg-left pxa-0"><strong>Popular minig companies in this area</strong></p>
                            <div class="col-12 border bg-white">
                                <p class="text-right pt-2"><a href="#" class="btn seeall_btn" role="button">See all mining companies in Bedford</a></p>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="h6 pl-3 text-center text-lg-left pxa-0"><strong>Similar employers around this location</strong></p>
                            <div class="col-12 border bg-white">
                                <p class="text-right pt-2"><a href="#" class="btn seeall_btn" role="button">See all employers in this location</a></p>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                        <p><a href="#" class="breadcrumb_custom"><img src="{{ asset('img/dhl.png') }}" class="mr-2" style="width: 20px; height: 20px; margin-top: -3px;">DHL Company</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                

            </div>
        </div>
    </div>


@endsection
