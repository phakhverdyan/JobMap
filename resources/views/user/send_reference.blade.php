@extends('layouts.common_user')

@section('content')

    <br><br>
    <div class="page page-sign-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-11 text-center">
                    <div class="">
                        <div class="text-left d-flex align-items-start flex-column flex-lg-row">
                            <div class="p-1 mb-3 d-inline-block rounded bg-white mr-3" style="box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);">
                                <img src="{{ $picture }}" style="width: 100px; height: 100px;">
                            </div>
                            <div>
                                <h5 class="h5 mb-1 mt-0 overview_color"> {{ $user->first_name }} {{ $user->last_name }} </h5>
                                @if (!empty($basic->headline))
                                    <p class="mb-1 d-flex align-item-center"> {{ $basic->headline }} </p>
                                @endif
                                <p class="mb-1 d-flex align-item-center"> {{ $location }} </p>
                                @if (!empty($user->mobile_phone))
                                    <p class="mb-1 d-flex align-item-center"> {{ $user->mobile_phone }} </p>
                                @endif
                                <p class="mb-1 d-flex align-item-center"> {{ $user->email }} </p>
                                @if (!empty($basic->website))
                                    <p class="mb-1 d-flex align-item-center">{{ $basic->website }}</p>
                                @endif
                                @if (!empty($basic->about))
                                    <p class="mb-0 text-muted">{{ $basic->about }}</p>
                                @endif
                                <p class="mb-1 d-flex align-item-center"> Send you return reference {{ $date }} </p>
                            </div>
                        </div>
                    </div>
                    <form class="my-5 py-5 bg-white border rounded" action="" method="post" id="send-reference-form">
                        <div class="row justify-content-center sign-up-user-wizard">
                            <div class="col-11 col-sm-10 col-md-10 col-lg-9 text-left sign-up-step-1">
                                <h3 class="h3 mb-5 text-center">Give your reference to this person</h3>
                                <input type="hidden" name="id" value="{{ $reference->id }}">
                                <div class="form-group mb-2">
                                    <textarea class="form-control" placeholder="Enter message" name="message"></textarea>
                                </div>
                                <div class="mt-4 text-center">
                                    <div class="d-inline-block bg-white">
                                        <button class="btn btn-primary px-5" id="send-reference-button">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
