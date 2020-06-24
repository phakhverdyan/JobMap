
@extends('layouts.jobmap.common_user')

@section('content')
    <style type="text/css">
        .nav-link.active{
            color: #4266ff;
        }
        .pagination{
            padding-top: 30px;
            justify-content: center!important;
        }
    </style>

    <div class="container-fluid px-0 mt-5 user-landing">
        <div class="container">
            <ul class="nav justify-content-center">
                <li class="nav-item"><a class="nav-link {{(request()->is('latest/applications*')) ? 'active' : ''}}" href="{!! url("/latest/applications") !!}">Applications</a></li>
                <li class="nav-item"><a class="nav-link {{(request()->is('latest/jobs*')) ? 'active' : ''}}" href="{!! url("/latest/jobs") !!}">Jobs</a></li>
                <li class="nav-item"><a class="nav-link {{(request()->is('latest/locations*')) ? 'active' : ''}}" href="{!! url("/latest/locations") !!}">Locations</a></li>
                <li class="nav-item"><a class="nav-link {{(request()->is('latest/businesses*')) ? 'active' : ''}}" href="{!! url("/latest/businesses") !!}">Businesses</a></li>
            </ul>

            <div class="container-items" style="min-height: 500px;">
                @if(!empty($objects))
                    @foreach($objects as $object)
                        @php
                            $img_url = asset('img/business-logo-small.png');
                            if ($object->business_picture) {
                                $img_url = Storage::disk('business')->url('/' . $object->business_id . '/50.50.') . $object->business_picture;
                            }


                        @endphp
                        <div class="col-12 px-0">
                            <div class="d-flex flex-column flex-lg-row pxa-0 px-3 py-2" style="border-bottom:1px solid #e9ecef;">
                                <div class="text-center text-lg-left">
                                    <img src="{{$img_url}}" class="rounded" style="width: 60px; height: 60px;">
                                </div>
                                <div class="ml-4 mxa-0 text-center text-lg-left w-100">
                                    <div class="d-flex justify-content-between flex-column flex-lg-row">
                                        <div class="flex-1">
                                            <div class="mb-1 d-flex flex-wrap">
                                                @php

                                                $name = $object->business_name;
                                                if($type == "jobs"){
                                                    $name = $name." - ".$object->job_name;
                                                    $ref =  '/map/view/job/'.$object->job_id;
                                                }
                                                elseif ($type == "businesses") {
                                                    $ref =  '/business/view/'.$object->business_id.'/'.$object->slug;
                                                }
                                                elseif ($type == "applications") {
                                                    $ref =  '#';
                                                }
                                                elseif ($type == "locations")
                                                {
                                                    $ref =  '/map/view/location/'.$object->id.'/'.$object->slug;
                                                }
                                                @endphp
                                                <a href="{{$ref}}" class=" open-sans mr-2" style="font-size: 16px; color:#1D1D1D; font-weight: bold;">{{$name}}</a>
                                            </div>
                                            <p class="mb-1 open-sans">
                                                <span>
                                                    <i class="glyphicon bfh-flag-{{$object->country_code}}"></i>
                                                    {{$object->street}} {{$object->street_number}}, {{$object->city}}, {{$object->region}}, {{$object->country}}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="d-flex">
                                            <div class="text-center">
                                                <div class="mb-2" style="opacity: 0.4;">
                                                    @php

                                                        if ($object->created_at) {
                                                            $your_date = $object->created_at->timestamp;
                                                        } else {
                                                            $your_date = time();
                                                        }
                                                        $datediff = time() - $your_date;
                                                        $days = round($datediff / (60 * 60 * 24));

                                                        Carbon\Carbon::setLocale( App::getLocale());
                                                        $dt = Carbon\Carbon::now();
                                                        $d = ($days == 0) ? trans('fields.today') : $dt->subDays($days)->diffForHumans();
                                                    @endphp
                                                    <span class="ml-2 mxa-0">{{$d}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="pagination-items justify-content-center">
                        {{ $objects->links("vendor.pagination.bootstrap-4") }}
                    </div>


                @endif
            </div>




        </div>
    </div>

@endsection
@section('script')

@endsection
