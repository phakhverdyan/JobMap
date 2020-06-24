@extends('layouts.common_user')

<?php extract($data); ?>

@section('content')
<div class="col-11 mx-auto resume_overview_xxl_screen mt-5" style="flex: 0 0 75%; max-width: 75%;">
  <div class="d-flex flex-lg-row flex-column" style="background-color: #dae0e5;">
    <div class="col-lg-4 py-3">
      <div class="text-center">
        <img src="{{ $data['picture']}}" style="width: 200px; height: 200px;" class="rounded">
      </div>
    </div>
    <div class="col-lg-8 align-self-center py-3 d-flex justify-content-between flex-lg-row flex-column">
      <div class="text-center">
        <p class="mb-1 resume_name" style="font-size: 60px;">
          {{ $user->first_name }} {{ $user->last_name }}
        </p>
        @if (!empty($basic->headline))
          <h3 class="resume_headline" style="font-weight: 400;">{{ $basic->headline }}</h3>
        @endif
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
                {!! trans('profile.public_profile.verified_resume') !!}
            </p>
            {{--<p class="mt-0 mb-1 text-center" style="letter-spacing: 0px;"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2">Looking & open to new opportunities</p>--}}
            <p class="mt-0 mb-1 text-center" style="letter-spacing: 0px;"><img src="{{ asset('img/sidebar/active.png') }}" class="mr-2"><strong>{!! trans('profile.public_profile.updated') !!}</strong> {{ $updated_at }}</p>

            @if (!\Illuminate\Support\Facades\Cookie::get('api-token'))
                <p class="mb-1"><a href="{!! url('/employers') !!}" class="btn btn-primary btn-block"> {!! trans('profile.public_profile.connect') !!}</a></p>
            @else
                <p class="mb-1"><a href="javascript:;" id="profile-user__add-to-pipeline-user" class="btn btn-primary btn-block" data-id="{{ $user->id }}"> {!! trans('profile.public_profile.add_to_pipeline') !!}</a></p>
            @endif
      </div>
    </div>
  </div>
  <div class="d-flex flex-lg-row flex-column">
    <!-- left side -->
    <div class="col-lg-4 py-3" style="background-color: #efefef;">
      
      @if(!empty($basic->about))
      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.print.about_me') !!}</h3>
        <p class="text-justify" style="line-height: 1.4;">
          {{ $basic->about }}
        </p>
      </div>
      @endif

      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('main.label.contact') !!}</h3>

        <div class="mb-3">
            <div class="text-center">
              <p class="mb-1">
                <img src="{{ asset('img/landing/cr-logo.png') }}" class="align-self-center" width="45px">
              </p>
              <p>{!! request()->getSchemeAndHttpHost() !!}/u/{{ $user->username }}</p>
            </div>
            <div class="text-center">
              <img src="https://upload.wikimedia.org/wikipedia/commons/8/8f/Qr-4.png" width="125px" height="125px">
            </div>
        </div>

        <div class="text-center mb-3">
          <p class="mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 58.365 58.365" style="enable-background:new 0 0 58.365 58.365;" xml:space="preserve"  width="50px">
              <path d="M57.863,26.632l-8.681-8.061V5.365h-10v3.921L29.182,0L0.502,26.632c-0.404,0.376-0.428,1.009-0.052,1.414  c0.375,0.404,1.008,0.427,1.414,0.052l3.319-3.082v33.349h16h16h16V25.015l3.319,3.082c0.192,0.179,0.437,0.267,0.681,0.267  c0.269,0,0.536-0.107,0.732-0.319C58.291,27.641,58.267,27.008,57.863,26.632z M41.182,7.365h6v9.349l-6-5.571V7.365z   M23.182,56.365V35.302c0-0.517,0.42-0.937,0.937-0.937h10.126c0.517,0,0.937,0.42,0.937,0.937v21.063H23.182z M51.182,56.365h-14  V35.302c0-1.62-1.317-2.937-2.937-2.937H24.119c-1.62,0-2.937,1.317-2.937,2.937v21.063h-14V23.158l22-20.429l14.28,13.26  l5.72,5.311v0l2,1.857V56.365z"/>
            </svg>
          </p>
          <p>
             {{ $location }} 
          </p>
        </div>

      </div>


      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.items.preferences') !!}</h3>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.im_now') !!} </strong> {{ $preference->current_job_name }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.im_a') !!} </strong> {{ $preference->current_type_name }}</p>

        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.looking_for') !!}</strong> {{ $preference->looking_job }}</p>

        @if (!\Illuminate\Support\Facades\Cookie::get('api-token'))
            <!-- <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.opened_opportunities') !!}</strong> {{ $preference->new_opportunities }}</p> -->
        @else
            <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.opened_opportunities') !!}</strong> {{ $preference->new_opportunities }}</p>
        @endif

        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.interested_job_types') !!}</strong> {{ $preference->interested_jobs_name }}</p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.preferred_industries') !!}</strong>
            {{ rtrim((isset($preference->industry) ? $preference->industry->name : '') . ', ' . (isset($preference->sub_industry) ? $preference->sub_industry->name : ''), ', ') }}
        </p>
        <p class="mb-0 text-muted text-left"><strong>{!! trans('resume_builder.overview.preferred_jobs') !!}</strong>
            {{ rtrim((isset($preference->category) ? $preference->category->name : '') . ', ' . (isset($preference->sub_category) ? $preference->sub_category->name : ''), ', ') }}
        </p>
        
        
        
      </div>

    
      @if(count($skill) > 0)
      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.items.skill') !!}</h3>
        @foreach($skill as $item)
          <div class="text-center mb-3">
            <p class="mb-1">{{ $item->title }}</p>
            <div class="bg-light rounded border mx-auto mr-3" style="width:130px; height: 12px">
              <div class="bg-primary rounded" style="width: {{ $item->level }}%; height: 100%;"></div>
            </div>
            <span class="text-left mb-0 mr-3 " style="flex:1;"></span>
          </div>
        @endforeach
      </div>
      @endif

      @if(count($languages) > 0)
      <div class="mb-5">
        <h3 class="text-center mb-4">{!! trans('resume_builder.items.languages') !!}</h3>
        @foreach($languages as $item)
          <div class="text-center mb-3">
            <p class="mb-1">{{ $item->title }}</p>
            <div class="bg-light rounded border mr-3 mx-auto" style="width:130px; height: 12px">
                <div class="bg-primary rounded" style="width: {{ $item->level }}%; height: 100%;"></div>
            </div>
          </div>
        @endforeach
      </div>
      @endif

      @if (count($hobby) > 0 || count($interest) > 0)
      <div>
        <h3 class="text-center mb-4" style="line-height: 1;">{!! trans('resume_builder.items.hobbies_interests') !!}</h3>

        <ul class="pl-0 d-table mx-auto text-left">
          @foreach($hobby as $item)
          <li>{{ $item->title }}</li>
          @endforeach
          @foreach($interest as $item)
          <li>{{ $item->title }}</li>
          @endforeach
        </ul>
      </div>
      @endif



    </div>
    <!-- /left side -->
    <!-- right side -->
    <div class="col-lg-8 py-3 pl-lg-4 pl-0 text-left">


      @if(count($education) > 0)
      <div class="mb-5">
        @foreach($education as $key => $item)
          @if ($key == 0)
            <h3 class="mb-4">{!! trans('resume_builder.items.education') !!}</h3>
          @endif
          <div class="mb-3">
            <p class="mb-0 h5">

              <strong>{{ $item->degree }}</strong>  

              <small>{{ $item->study }}</small>

            </p>
            <p class="mb-0">{{ $item->school_name }} / {{ $item->year_from }} - {{ $item->year_to }}</p>
            @if(!empty($item->description))
              <p style="font-size: 14px;">
               {{ $item->description }}
              </p>
            @endif
            <div style="font-size: 14px;">
              @if(!empty($achievement_title))
                <p class="mb-0">{{ $item->achievement_title }}</p>
              @endif
              @if(!empty($achievement_description))
              <p>
                {{ $item->achievement_description }}
              </p>
              @endif
            </div>
          </div>
        @endforeach
      </div>
      @endif

      @if(count($experience) > 0)
      <div class="mb-5">
        @foreach($experience as $key => $item)
          @if ($key == 0)
          
            <h3 class="mb-4">{!! trans('resume_builder.items.experience') !!}</h3>
          @endif

          <div class="mb-3">
            <p class="mb-0 h5"><strong>{{ $item->title }}</strong></p>
            <p class="mb-0"> {{ $item->company }} / {{ date('Y',strtotime($item->date_from)) }} - {{ $item->current ? trans('resume_builder.print.i_am_currently_working_here') : date('Y',strtotime($item->date_to)) }}</p>
            
            <p class="mb-0"> {{ rtrim((isset($item->industry) ? $item->industry->name : '') . ', ' . (isset($item->sub_industry) ? $item->sub_industry->name : ''), ', ') }}</p>

            @if(!empty($item->description))
              <p class="mb-0" style="font-size: 14px;">
               {{ $item->description }}
              </p>
            @endif
            @if(!empty($item->additional_info))
              <p class="mb-0" style="font-size: 14px;">
                {{ $item->additional_info }}
              </p>
            @endif
             <!-- <p style="font-size: 14px;">
                Additional field lorem ipsum because we need it to prove we were better than all the other candidates in this field!
             </p> -->
          </div>
        @endforeach
      </div>
      @endif

      @if (count($certification) > 0)
      <div class="mb-5">

        <h3 class="mb-4" style="word-break: break-all; line-height: 1;">{!! trans('resume_builder.items.permit_certification') !!}</h3>

        @foreach($certification as $item)
          <div class="mb-3">
            <p class="mb-0 h5"><strong>{{ $item->title }}</strong></p>
            <p class="mb-0">{{ $item->type }} / {{ $item->year }}</p>
          </div>
        @endforeach

      </div>
      @endif

      @if(count($distinction) > 0)
      <div class="mb-5">

        <h3 class="mb-4" style="word-break: break-all; line-height: 1;">{!! trans('resume_builder.items.distinctions_achievements') !!}</h3>
        
        @foreach($distinction as $item)
        <div class="mb-3">
          <p class="mb-0 h5"><strong>{{ $item->title }}</strong></p>
          <p class="mb-0">{{ $item->year }}</p>
        </div>
        @endforeach

      </div>
      @endif

      <!-- <div class="mb-5">
        <h3 class="mb-4">References</h3>

        <div class="mb-3">
          <p class="mb-0 h5"><strong>John Smith</strong></p>
          <p class="mb-0"> Videotron Inc / +1-514-374-3555 / johnsmith@gmail.com</p>
          <p class="mb-0" style="font-size: 14px;">
             References are made by lorem ipsum because it’s easier said than done and we know the difference between a real one and a fake one, so we are lorem ipsuming and it’s a lot easier. So brace yourself because winter is coming and he’s gonna  get you in the balls
           </p>
        </div>
      </div> -->

      @if (\Illuminate\Support\Facades\Cookie::get('api-token'))
        <div>
          <p class="mb-4 text-left"><strong>{!! trans('resume_builder.availability.available_for') !!} </strong>
            {{ $availability->full_time ? trans('resume_builder.availability.full_time').',' : '' }} {{ $availability->part_time ? trans('resume_builder.availability.part_time').',' : '' }}
            {{ $availability->internship ? trans('resume_builder.availability.internship').',' : '' }} {{ $availability->contractual ? trans('resume_builder.availability.contractual').',' : '' }}
            {{ $availability->summer_positions ? trans('resume_builder.availability.summer_positions').',' : '' }} {{ $availability->recruitment ? trans('resume_builder.availability.recruitment').',' : '' }}
            {{ $availability->field_placement ? trans('resume_builder.availability.field_placement').',' : '' }} {{ $availability->volunteer ? trans('resume_builder.availability.volunteer').',' : '' }}
          </p>
          <div class="table mb-0">
            <table class="w-100" style="table-layout: fixed">
              <thead>
              <tr class="text-center">
                <th colspan="2" class="table-heading border-0 text-center p-0"></th>
                <th class="table-heading border-0 text-center">
                  <svg version="1.1" id="Layer_1" width="20px" height="20px"
                       xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                       viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                        <path d="M45.5,32.4c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,30.7,43.3,32.4,45.5,32.4z"
                              fill="#4266ff"/>
                    <path d="M69,42c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7 C67,41.6,68,42,69,42z"
                          fill="#4266ff"/>
                    <path d="M19.2,40.8C19.9,41.6,21,42,22,42c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0 c-1.6,1.6-1.6,4.1,0,5.7L19.2,40.8z"
                          fill="#4266ff"/>
                    <path d="M86.9,66.7H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,66.7,86.9,66.7z"
                          fill="#4266ff"/>
                    <path d="M27.1,60.8c2.1,0.6,4.3-0.7,4.9-2.9c1.6-6.2,7.2-10.5,13.6-10.5s12,4.3,13.6,10.5c0.5,1.8,2.1,3,3.9,3c0.3,0,0.7,0,1-0.1 c2.1-0.6,3.4-2.7,2.9-4.9c-2.5-9.7-11.3-16.5-21.3-16.5c-10,0-18.8,6.8-21.3,16.5C23.6,58.1,24.9,60.3,27.1,60.8z"
                          fill="#4266ff"/>
                    </svg>
                </th>
                <th class="table-heading border-0 text-center">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="20px"
                       height="20px" x="0px" y="0px"
                       viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                        <path d="M45.5,23.5c-12.1,0-22,9.9-22,22c0,12.1,9.9,22,22,22c12.1,0,22-9.9,22-22C67.5,33.4,57.6,23.5,45.5,23.5z M45.5,59.5 c-7.7,0-14-6.3-14-14c0-7.7,6.3-14,14-14c7.7,0,14,6.3,14,14C59.5,53.2,53.2,59.5,45.5,59.5z"
                              fill="#4266ff"/>
                    <path d="M45.5,16.2c2.2,0,4-1.8,4-4V4.1c0-2.2-1.8-4-4-4c-2.2,0-4,1.8-4,4v8.1C41.5,14.5,43.3,16.2,45.5,16.2z"
                          fill="#4266ff"/>
                    <path d="M86.9,41.5h-8.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4C90.9,43.3,89.1,41.5,86.9,41.5z"
                          fill="#4266ff"/>
                    <path d="M45.5,74.8c-2.2,0-4,1.8-4,4v8.1c0,2.2,1.8,4,4,4c2.2,0,4-1.8,4-4v-8.1C49.5,76.5,47.7,74.8,45.5,74.8z"
                          fill="#4266ff"/>
                    <path d="M16.2,45.5c0-2.2-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4c0,2.2,1.8,4,4,4h8.1C14.5,49.5,16.2,47.7,16.2,45.5z"
                          fill="#4266ff"/>
                    <path d="M69,26c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7 C67,25.6,68,26,69,26z"
                          fill="#4266ff"/>
                    <path d="M71.8,66.2c-1.6-1.6-4.1-1.6-5.7,0c-1.6,1.6-1.6,4.1,0,5.7l5.8,5.8c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2 c1.6-1.6,1.6-4.1,0-5.7L71.8,66.2z"
                          fill="#4266ff"/>
                    <path d="M19.2,66.2l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7 C23.3,64.6,20.7,64.6,19.2,66.2z"
                          fill="#4266ff"/>
                    <path d="M19.2,24.8C19.9,25.6,21,26,22,26c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0 c-1.6,1.6-1.6,4.1,0,5.7L19.2,24.8z"
                          fill="#4266ff"/>
                    </svg>
                </th>
                <th class="table-heading border-0 text-center">
                  <svg version="1.1" id="Layer_1" width="20px" height="20px"
                       xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                       viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                        <path d="M45.5,26.3c2.2,0,4-1.8,4-4v-8.1c0-2.2-1.8-4-4-4s-4,1.8-4,4v8.1C41.5,24.5,43.3,26.3,45.5,26.3z"
                              fill="#4266ff"/>
                    <path d="M74.8,55.6c0,2.2,1.8,4,4,4h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4h-8.1C76.5,51.6,74.8,53.4,74.8,55.6z"
                          fill="#4266ff"/>
                    <path d="M4.1,59.6h8.1c2.2,0,4-1.8,4-4s-1.8-4-4-4H4.1c-2.2,0-4,1.8-4,4S1.9,59.6,4.1,59.6z"
                          fill="#4266ff"/>
                    <path d="M69,36.1c1,0,2-0.4,2.8-1.2l5.8-5.8c1.6-1.6,1.6-4.1,0-5.7c-1.6-1.6-4.1-1.6-5.7,0l-5.8,5.8c-1.6,1.6-1.6,4.1,0,5.7 C67,35.7,68,36.1,69,36.1z"
                          fill="#4266ff"/>
                    <path d="M19.2,34.9c0.8,0.8,1.8,1.2,2.8,1.2c1,0,2-0.4,2.8-1.2c1.6-1.6,1.6-4.1,0-5.7l-5.8-5.8c-1.6-1.6-4.1-1.6-5.7,0 c-1.6,1.6-1.6,4.1,0,5.7L19.2,34.9z"
                          fill="#4266ff"/>
                    <path d="M25.5,64.7c0.9,2,3.3,2.9,5.3,2c2-0.9,2.9-3.3,2-5.3c-0.8-1.8-1.3-3.8-1.3-5.8c0-7.7,6.3-14,14-14s14,6.3,14,14 c0,2-0.4,4-1.3,5.8c-0.9,2,0,4.4,2,5.3c0.5,0.2,1.1,0.4,1.7,0.4c1.5,0,3-0.9,3.6-2.3c1.3-2.9,2-6,2-9.1c0-12.1-9.9-22-22-22 c-12.1,0-22,9.9-22,22C23.5,58.8,24.2,61.8,25.5,64.7z"
                          fill="#4266ff"/>
                    <path d="M86.9,72.8H4.1c-2.2,0-4,1.8-4,4s1.8,4,4,4h82.8c2.2,0,4-1.8,4-4S89.1,72.8,86.9,72.8z"
                          fill="#4266ff"/>
                    </svg>
                </th>
                <th class="table-heading border-0 text-center">
                  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" width="20px"
                       height="20px" x="0px" y="0px"
                       viewBox="0 0 91 91" enable-background="new 0 0 91 91" xml:space="preserve">
                      <path d="M47.2,78.1c-11.6,0-22.5-6.3-28.3-16.3c-9-15.6-3.6-35.6,11.9-44.6c5.3-3.1,11.5-4.6,17.6-4.3c1.5,0.1,2.8,0.9,3.4,2.2
                        c0.7,1.3,0.5,2.9-0.3,4.1c-5,7.2-5.4,16.8-1,24.3c4.1,7,11.6,11.4,19.8,11.4c0.6,0,1.2,0,1.8-0.1c1.5-0.1,2.9,0.6,3.7,1.8
                        c0.8,1.2,0.9,2.8,0.2,4.1c-2.9,5.5-7.2,10-12.6,13.1C58.5,76.6,52.9,78.1,47.2,78.1z M41.4,21.5c-2.3,0.5-4.5,1.4-6.6,2.6
                        C23.1,31,19,46.1,25.8,57.8c4.4,7.6,12.6,12.3,21.4,12.3c4.3,0,8.5-1.1,12.3-3.3c2.1-1.2,4-2.7,5.6-4.4c-8.9-1.6-16.8-7-21.4-14.9
                        C39.1,39.5,38.4,30,41.4,21.5z" fill="#4266ff"/>
                    </svg>
                </th>
              </tr>
              </thead>
              <tbody class="text-left">
              <?php
              $days = [trans('main.days.monday'), trans('main.days.tuesday'), trans('main.days.wednesday'), trans('main.days.thursday'), trans('main.days.friday'), trans('main.days.saturday'), trans('main.days.sunday')];
              ?>
              @for($d = 1; $d <= 7; ++$d)
                <tr class="text-center">
                  <td colspan="2" class="text-left">{{ $days[$d - 1] }}</td>
                  @for($i = 1; $i <= 4; ++$i)
                        <?php
                        $checkbox = false;
                        $timeN='time_'.$i;
                        ?>
                    @isset($availability->$timeN)
                            <?php
                            $checkbox = strpos($availability->$timeN, (string)$d);
                            ?>
                    @endisset
                    <td class="align-middle">
                      <div class="d-flex align-items-center justify-content-center">
                        <label class="custom-control custom-checkbox m-0 pl-3">
                          <input type="checkbox"
                                 class="custom-control-input"
                                 @if($checkbox !== false) checked="checked"
                                 @endif onclick="return false;">
                          <span class="custom-control-indicator"></span>
                        </label>
                      </div>
                    </td>
                  @endfor
                </tr>
              @endfor

              </tbody>
            </table>
          </div>
        </div>
      @endif

    </div>

    <!-- /right side -->
  </div>
</div>
@endsection
