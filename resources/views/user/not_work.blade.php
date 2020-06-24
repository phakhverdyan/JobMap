@extends('layouts.main_user_notwork')

@section('content')

    <br><br><br>
    <div class="" style="display: block">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-3">
                    <p class="text-center mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 24 24" height="50px" id="Layer_1" version="1.1" viewBox="0 0 24 24" width="50px" xml:space="preserve" style="fill:#9BA6B2; vertical-align: middle;"><g><path d="M23.4,8.4L20,5.8V2c0-0.6-0.4-1-1-1h-5.4l-0.9-0.7c-0.4-0.4-1-0.4-1.4,0L10.4,1H5C4.4,1,4,1.4,4,2v3.8L0.7,8.3   c0,0-0.7,0.5-0.7,1.3C0,10.8,0,23,0,23c0,0.6,0.4,1,1,1h22c0.6,0,1-0.4,1-1c0,0,0-12.4,0-13.5C24,8.9,23.4,8.4,23.4,8.4z M5,7.3   V5.1V2h4.1h5.8H19v3.1v2.2v5.1l-4.5,3.3l-1.8-1.4c-0.4-0.4-1-0.4-1.4,0l-1.8,1.4L5,12.4V7.3z M2,9.5L4,8v3.6l-2-1.5V9.5z M2,11.6   l6.4,4.9L2,21.4V11.6z M3.1,22l8.9-6.5l8.9,6.5H3.1z M22,21.4l-6.4-4.9l6.4-4.9V21.4z M22,10.2l-2,1.5V8l2,1.5V10.2z"/><rect height="1" width="10" x="7" y="5"/><rect height="1" width="10" x="7" y="8"/><rect height="1" width="10" x="7" y="11"/></g></svg>
                    </p>
                    <p class="mt-4 text-center mb-1">
                        It looks like you did not verify your account email
                    </p>
                    <p class="text-center"><strong>Please check your Junkmail/Spam/Inbox</strong></p>

                    <div class="d-flex flex-column flex-lg-row justify-content-between mt-5">
                        <button class="btn btn-primary col-lg-5 col-12 resend-verification-code">Resend</button>
                        <button class="btn btn-outline-primary col-lg-5 col-12" data-toggle="modal" data-dismiss="modal" data-target="#anotherEmail">Change Email</button>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection