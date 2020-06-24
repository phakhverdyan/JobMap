@extends('layouts.common_user')

@section('content')

    <div class="page page-sign-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-11 col-lg-11 text-center">
                    <form class="my-5 py-5 bg-white border rounded" action="" method="post" id="change-password-form" autocomplete="off">
                        <div class="row justify-content-center sign-up-user-wizard">
                            <div class="col-11 col-sm-10 col-md-10 col-lg-9 text-left sign-up-step-1">
                                <h3 class="h3 mb-5 text-center">Thanks for joining CloudResume</h3>
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <div class="form-group mb-2">
                                    <input type="password" class="form-control" placeholder="Choose password"
                                           name="password" autocomplete="new-password">
                                </div>
                                <div class="form-group mb-0">
                                    <input type="password" class="form-control" placeholder="Confirm password"
                                           name="confirm_password" autocomplete="new-password">
                                </div>
                                <div class="mt-4 text-center">
                                    <div class="d-inline-block bg-white">
                                        <button class="btn btn-primary px-5" id="change-password-button">Confirm
                                        </button>
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
