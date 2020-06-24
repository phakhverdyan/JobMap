@extends('layouts.common_user')

@section('content')

<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-11 col-lg-10 text-center my-4">
                <form autocomplete="off">
                    <div class="bg-white referer-step-wizard">
                        <div class="bg-white py-4">
                            <div>
                                <p class="text-center mt-0"><img class="business-logo-medium border" src="{!! $data->user_pic !!}" style="width: 80px; height: 80px; background-color: transparent; border-radius: 10px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2);"></p>
                                {{--<div class="p-4 mb-3 d-inline-block rounded bg-white">
                                    <svg version="1.1" id="Capa_1" width="50px" height="50px" xmlns="http://www.w3.org/2000/svg"  x="0px" y="0px"
										 viewBox="0 0 482.9 482.9" style="enable-background:new 0 0 482.9 482.9;" xml:space="preserve">
											<path d="M239.7,260.2c0.5,0,1,0,1.6,0c0.2,0,0.4,0,0.6,0c0.3,0,0.7,0,1,0c29.3-0.5,53-10.8,70.5-30.5
												c38.5-43.4,32.1-117.8,31.4-124.9c-2.5-53.3-27.7-78.8-48.5-90.7C280.8,5.2,262.7,0.4,242.5,0h-0.7c-0.1,0-0.3,0-0.4,0h-0.6
												c-11.1,0-32.9,1.8-53.8,13.7c-21,11.9-46.6,37.4-49.1,91.1c-0.7,7.1-7.1,81.5,31.4,124.9C186.7,249.4,210.4,259.7,239.7,260.2z
												 M164.6,107.3c0-0.3,0.1-0.6,0.1-0.8c3.3-71.7,54.2-79.4,76-79.4h0.4c0.2,0,0.5,0,0.8,0c27,0.6,72.9,11.6,76,79.4
												c0,0.3,0,0.6,0.1,0.8c0.1,0.7,7.1,68.7-24.7,104.5c-12.6,14.2-29.4,21.2-51.5,21.4c-0.2,0-0.3,0-0.5,0l0,0c-0.2,0-0.3,0-0.5,0
												c-22-0.2-38.9-7.2-51.4-21.4C157.7,176.2,164.5,107.9,164.6,107.3z" fill="#4266ff"/>
											<path d="M446.8,383.6c0-0.1,0-0.2,0-0.3c0-0.8-0.1-1.6-0.1-2.5c-0.6-19.8-1.9-66.1-45.3-80.9c-0.3-0.1-0.7-0.2-1-0.3
												c-45.1-11.5-82.6-37.5-83-37.8c-6.1-4.3-14.5-2.8-18.8,3.3c-4.3,6.1-2.8,14.5,3.3,18.8c1.7,1.2,41.5,28.9,91.3,41.7
												c23.3,8.3,25.9,33.2,26.6,56c0,0.9,0,1.7,0.1,2.5c0.1,9-0.5,22.9-2.1,30.9c-16.2,9.2-79.7,41-176.3,41
												c-96.2,0-160.1-31.9-176.4-41.1c-1.6-8-2.3-21.9-2.1-30.9c0-0.8,0.1-1.6,0.1-2.5c0.7-22.8,3.3-47.7,26.6-56
												c49.8-12.8,89.6-40.6,91.3-41.7c6.1-4.3,7.6-12.7,3.3-18.8c-4.3-6.1-12.7-7.6-18.8-3.3c-0.4,0.3-37.7,26.3-83,37.8
												c-0.4,0.1-0.7,0.2-1,0.3c-43.4,14.9-44.7,61.2-45.3,80.9c0,0.9,0,1.7-0.1,2.5c0,0.1,0,0.2,0,0.3c-0.1,5.2-0.2,31.9,5.1,45.3
												c1,2.6,2.8,4.8,5.2,6.3c3,2,74.9,47.8,195.2,47.8s192.2-45.9,195.2-47.8c2.3-1.5,4.2-3.7,5.2-6.3
												C447,415.5,446.9,388.8,446.8,383.6z" fill="#4266ff"/>
									</svg>
                                </div>--}}
                                <h5 class="h5 mb-0">{!! $data->username !!}</h5>
                            </div>
                        </div>
                        <div class="card-body px-0 py-3 referer-step-1">
                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-lg-10">
                                    <div class="row justify-content-center">
                                        <div class="col-12 col-sm-11 col-lg-10 text-center">
                                            <div class="mb-4">
                                                <p class="mb-0">{!! trans('profile.reference_user.hello',['user' => $data->reference->full_name]) !!}</p>
                                                <p class="mb-0">{!! trans('profile.reference_user.text',['user' => $data->username]) !!}</p>
                                            </div>
                                        </div>
                                        <div class="col-10 col-md-8">
                                            <div class="bg-white mb-2">
                                                <button type="button" class="w-100 btn btn-primary py-4">
                                                    {!! trans('profile.reference_user.create_account') !!}
                                                </button>
                                            </div>
                                            <div class="bg-white mb-2">
                                                <button type="button" class="w-100 btn btn-yellow py-4">
                                                    {!! trans('profile.reference_user.i_dont_want_to_help') !!}
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="bg-white mb-2 mb-md-0">
                                                        <button type="button"
                                                                class="w-100 btn btn-success py-4">
                                                            {!! trans('profile.reference_user.more_info') !!}
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="bg-white">
                                                        <button type="button" class="w-100 btn btn-outline-primary py-4 next-btn">
                                                            {!! trans('profile.reference_user.skip_for_now') !!}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-5 referer-step-2">
                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-lg-10">
                                    <div class="row justify-content-center">
                                        <div class="col-10 text-left">
                                            <div class="form-group mb-3">
                                                <small class="form-text text-muted mb-2">Confirm your first name</small>
                                                <input type="text" class="form-control bg-light"
                                                       placeholder="Enter your first name"  autocomplete="off">
                                            </div>
                                            <div class="form-group mb-3">
                                                <small class="form-text text-muted mb-2">You last name</small>
                                                <input type="text" class="form-control bg-light"
                                                       placeholder="Enter you last name"  autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-11 col-sm-10">
                                            <div class="form-group mb-4 text-left">
                                                <small class="form-text text-muted mb-2">How would you recommend {first-name}?</small>
                                                <textarea maxlength="1000"
                                                          class="form-control bg-light"
                                                          rows="3"
                                                          placeholder="Tell us about how you would recommend {first-name}"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-10 d-flex">
                                            <div class="col-6 pl-0">
                                                    <div class="bg-white mb-2">
                                                        <button type="button" class="w-100 btn btn-outline-primary py-4">
                                                            Reference explication and more
                                                        </button>
                                                    </div>
                                            </div>
                                            <div class="col-6 pr-0">
                                                <div class="bg-white mb-3">
                                                    <button type="button" class="w-100 btn btn-outline-primary py-4 next-btn">
                                                        Send Reference
                                                    </button>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="col-10">
                                            <p class="mb-0">By clicking send you confirm that everything written here is right and
                                                that your first name and last name.
                                                You might be contacted by a future employer that would like to have
                                                further information on "full name of the user".</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-5 referer-step-3">
                            <div class="row justify-content-center">
                                <div class="col-12 col-sm-11 col-lg-10">
                                    <div class="row justify-content-center">
                                        <div class="col-11 col-sm-10 col-md-7">
                                            <p class="mb-3 mb-sm-5">Your reference will be added to the profile of "full name of user". It will surely help to stand out from the crowd.</p>
                                        </div>
                                        <div class="col-11 col-md-10">
                                            <p class="mb-3">You can either close this window or continue by creating your account and have the first ever expiring Resume.</p>
                                        </div>
                                        <div class="col-10 col-md-8">
                                            <div class="bg-white mb-2">
                                                <button type="button" class="w-100 btn btn-outline-primary py-4">
                                                    Create account
                                                </button>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="bg-white mb-2 mb-sm-0">
                                                        <button type="button" class="w-100 btn btn-outline-primary py-4">
                                                            More info
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="bg-white">
                                                        <button type="button" class="w-100 btn btn-outline-primary py-4">
                                                            I have business
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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