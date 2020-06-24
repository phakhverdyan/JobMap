@extends('layouts.jobmap.common_user')

@section('content')
<div class="bg-white col-12 px-0">
    <div class="container mt-3 text-center">
      <div class="row justify-content-center">
          <div class="col-lg-9">
              <div class="mt-5 py-5">
                  <div class="row mb-4">
                    <h2 class="mx-auto">{!! trans('pages.title.about.title') !!}</h2>
                  </div>

                  <div class="row justify-content-center mb-5">
                      <div class="col-lg-11">
                          {!! trans('pages.text.about.box_1') !!}
                      </div>
                  </div>

              </div>
          </div>
      </div>
    </div>
</div>


@endsection
