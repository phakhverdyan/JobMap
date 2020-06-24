@extends('layouts.main_business')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-12 col-xl-8 mx-auto mt-3 ">
                <div class="col-12 rounded bg-white py-3 help-how-to-start-block" style="display:none;">
                    <p class="mb-1 text text-center fw-lighter" style="font-size:30px;">
                        {!! trans('guides.cr_link.title') !!}
                        <button type="button" class="close pt-0 mt-0 help-how-to-start-hide help-how-to-start-gotit"
                                style="cursor: pointer">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </p>
                    <div class="d-flex justify-content-between mb-3 mt-5 flex-wrap flex-column flex-lg-row mxa-auto">
                        <div class="text-center mt-1"><img src="{{ asset('img//integration-icons/monster.png') }}"
                                                           style="width: 90px;"></div>
                        <div class="text-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 217.7 46"
                                 enable-background="new 0 0 217.7 46" xml:space="preserve" width="90" height="25"
                                 style="vertical-align: middle;">
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#EE3551"
                                      d="M126.8,34.4c-6.3,0-11.4-5.1-11.4-11.4c0-6.3,5.1-11.4,11.4-11.4  c6.3,0,11.4,5.1,11.4,11.4C138.2,29.3,133.1,34.4,126.8,34.4z M126.8,16.9c-3.4,0-6.1,2.7-6.1,6.1c0,3.4,2.7,6.1,6.1,6.1  c3.4,0,6.1-2.7,6.1-6.1C132.9,19.7,130.1,16.9,126.8,16.9z"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#EE3551"
                                      d="M156.7,37.7c-8.1,0-14.6-6.6-14.6-14.7c0-8.1,6.6-14.7,14.6-14.7  c8.1,0,14.7,6.6,14.7,14.7C171.4,31.1,164.8,37.7,156.7,37.7z M156.7,13.7c-5.1,0-9.3,4.2-9.3,9.3c0,5.2,4.2,9.3,9.3,9.3  c5.1,0,9.3-4.2,9.3-9.3C166.1,17.9,161.9,13.7,156.7,13.7z"/>
                                <path fill="#181417"
                                      d="M212.1,36.9V21.5c0-5.3-2.1-7.9-6.2-7.9c-6.1,0-6.2,5.2-6.3,7.7l0,0.2v15.4H194V21.4l0-0.2  c-0.1-2.5-0.2-7.7-6.3-7.7c-4.1,0-6.2,2.7-6.2,7.9v15.4h-5.6V20.2c0-2.6,0.5-4.9,1.6-6.8c1.9-3.3,5.4-5,9.8-5c5.5,0,8.3,2.6,9.5,4.4  c1.4-2.1,4.2-4.4,9.5-4.4c4.4,0,7.9,1.8,9.8,5c1,1.9,1.6,4.2,1.6,6.8v16.7H212.1z"/>
                                <path fill="#181417"
                                      d="M28.6,37.6c-9.2,0-14.9-7.7-14.9-14.8c0-7.9,6.7-14.4,14.9-14.4c8.2,0,15,6.5,15,14.5  C43.5,30,37.8,37.6,28.6,37.6z M28.6,13.6c-5.8,0-9.3,4.9-9.3,9.4c0,4.5,3.6,9.4,9.3,9.4c5.2,0,9.4-4.3,9.4-9.5  C37.9,18.4,34.4,13.6,28.6,13.6z"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#010101"
                                      d="M96.6,37.6c-1.5,0-3-0.2-4.5-0.7c-6.1-1.9-10.2-7.8-10.1-14.5  l0-0.2V0h5.6v11.4c2.6-2,5.8-3.1,9.1-3.1c8.1,0,14.7,6.6,14.7,14.7c0,3.9-1.5,7.6-4.3,10.4C104.2,36.1,100.5,37.6,96.6,37.6  C96.6,37.6,96.6,37.6,96.6,37.6z M96.6,13.6c-0.3,0-0.6,0-0.9,0c-4.3,0.4-7.8,3.8-8.3,8c-0.3,2.7,0.5,5.4,2.2,7.4  c1.8,2,4.3,3.2,7,3.2c0.4,0,0.8,0,1.2-0.1c4.3-0.5,7.7-4,8.1-8.3c0.3-2.7-0.6-5.2-2.4-7.2C101.7,14.7,99.2,13.6,96.6,13.6z"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" fill="#181417"
                                      d="M62.6,37.6c-1.5,0-3-0.2-4.5-0.7C52,35.1,47.9,29.1,48,22.4l0-0.2  V0h5.6v11.4c2.6-2,5.8-3.1,9.1-3.1c8.1,0,14.7,6.6,14.7,14.7c0,3.9-1.5,7.6-4.3,10.4C70.2,36.1,66.5,37.6,62.6,37.6  C62.6,37.6,62.6,37.6,62.6,37.6z M62.6,13.6c-0.3,0-0.6,0-0.9,0c-4.3,0.4-7.8,3.8-8.3,8c-0.3,2.7,0.5,5.4,2.2,7.4  c1.8,2,4.3,3.2,7,3.2c0.4,0,0.8,0,1.2-0.1c4.3-0.5,7.7-4,8.1-8.3c0.3-2.7-0.6-5.2-2.4-7.2C67.8,14.7,65.3,13.6,62.6,13.6z"/>
                                <path fill="#181417"
                                      d="M0,46v-5.8l0.2,0c3.2-0.2,3.2-2.5,3.2-5.9V14.6H9v19.7c0,4.2,0,6.8-3,9.3C4.3,45.1,2.1,46,0.2,46H0z"/>
                                <circle fill="#181417" cx="6" cy="8.5" r="3.4"/>
                            </svg>
                        </div>
                        <div class="text-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 438.4 96.3" width="100" height="25"
                                 style="vertical-align: middle;">
                                <path fill="#343e45"
                                      d="M331.3 24.8c0-2.7 2.2-4.8 5.1-4.8 3.1 0 5.2 2.2 5.2 4.8 0 2.6-2.2 4.8-5.2 4.8-2.9.1-5.1-2.2-5.1-4.8zm8.8 10.5c.2 0 .4.2.4.4v31.5c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c0-.2.2-.4.4-.4h7.3zM73.7 59.8l25-31.8c.1-.1 0-.3-.2-.3H74.4c-.2 0-.4-.2-.4-.4v-6.9c0-.2.2-.4.4-.4h35.8c.2 0 .4.2.4.4v7.1c0 .1 0 .2-.1.3L85.2 59.6c-.1.1 0 .3.2.3h24.8c.2 0 .4.2.4.4v6.9c0 .2-.2.4-.4.4H74c-.2 0-.4-.2-.4-.4v-7.1c0-.1.1-.2.1-.3zm95.7-39.4c0-.2.2-.4.4-.4h14.9c13.7 0 19 5 19 13.6 0 8.9-6.4 12.6-10.7 13.1-.1 0-.2.1-.1.2L205 67.1c.1.2 0 .5-.3.5h-9.4c-.2 0-.4-.1-.4-.3l-10.8-19.7c-.1-.1-.2-.2-.3-.2H178c-.1 0-.2.1-.2.2v19.6c0 .2-.2.4-.4.4h-7.7c-.2 0-.4-.2-.4-.4V20.4zM185 40.1c6.2 0 10.3-1.4 10.3-6.6 0-4.4-2.9-6.3-10.1-6.3h-7.1c-.1 0-.2.1-.2.2v12.5c0 .1.1.2.2.2h6.9zm79.9 4.6c-.2.2-.4.2-.6 0-.9-.8-3.2-2.9-6.3-2.9-3.6 0-9 2.4-9 9.7 0 7.5 5.9 9.7 9.2 9.7 3 0 5.5-1.9 6.2-2.7.2-.2.4-.2.6 0l4.8 5.2c.2.2.1.4 0 .6-2.4 2.2-6.2 4.2-11.3 4.2-8.2 0-17.5-5.3-17.5-16.9 0-11.3 8.8-16.9 17.5-16.9 4.8 0 8.5 1.9 11.4 4.6.2.2.2.4 0 .6l-5 4.8zm-51.5 9.6c-.1 0-.2.1-.2.2.4 3.7 4.4 7.4 8.6 7.4 4.4 0 6.5-1.8 8.4-4.1.1-.2.4-.2.5-.1l5.1 3.9c.2.1.2.4.1.6-3.3 3.8-7.5 6.1-13.4 6.1-9.3 0-17.5-6.3-17.5-16.9 0-10.2 7.7-16.9 17-16.9 8.8 0 15.6 7.4 15.6 17.5v1.8c0 .2-.2.4-.4.4l-23.8.1zm16.1-6.1c.1 0 .2-.1.2-.2 0-3.9-3.5-7.5-7.9-7.5s-8 2.7-8.5 7.4c0 .1.1.2.2.2l16 .1zm149.4 6.1c-.1 0-.2.1-.2.2.4 3.7 4.4 7.4 8.6 7.4 4.4 0 6.5-1.8 8.4-4.1.1-.2.4-.2.5-.1l5.1 3.9c.2.1.2.4.1.6-3.3 3.8-7.5 6.1-13.4 6.1-9.3 0-17.5-6.3-17.5-16.9 0-10.2 7.7-16.9 17-16.9 8.8 0 15.6 7.4 15.6 17.5v1.8c0 .2-.2.4-.4.4l-23.8.1zm16.1-6.1c.1 0 .2-.1.2-.2 0-3.9-3.5-7.5-7.9-7.5s-8 2.7-8.5 7.4c0 .1.1.2.2.2l16 .1zM274.4 35.3h6.3c.2 0 .4.1.4.3l.9 4.8h.1c3.4-6.6 11.4-5.6 12.1-5.5.2 0 .3.2.3.6v6.2c0 .2-.2.4-.4.4 0 0-1.5-.3-2.8-.3-5.2 0-8.9 4.7-9.3 11v14.3c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c.1-.2.3-.4.5-.4zm133.4 0h6.3c.2 0 .4.1.4.3l.9 4.8h.1c3.4-6.6 11.4-5.6 12.1-5.5.2 0 .3.2.3.6v6.2c0 .2-.2.4-.4.4 0 0-1.5-.3-2.8-.3-5.2 0-8.9 4.7-9.3 11v14.3c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c.1-.2.3-.4.5-.4zm-63.1 6.5v-6.1c0-.2.2-.4.4-.4h6.1c.1 0 .2-.1.2-.2v-5.9c0-.2.1-.3.3-.4l7.3-2.7c.3-.1.5.1.5.4v8.6c0 .1.1.2.2.2h8.3c.2 0 .4.2.4.4v6.1c0 .2-.2.4-.4.4h-8.3c-.1 0-.2.1-.2.2v13.9c0 2.8.5 5.2 4.5 5.2 1.5 0 3-.3 4-.7.2-.1.4.1.4.3V67c0 .2-.1.4-.3.5-1.3.6-3.8.9-6.1.9-3.9 0-6.5-.8-8-2.3-1.4-1.4-2.5-3.6-2.5-9.1V42.4c0-.1-.1-.2-.2-.2h-6.1c-.3 0-.5-.2-.5-.4zm-32.5 19.6c-3.2 0-5.9-2-6-5.6V35.7c0-.2-.2-.4-.4-.4h-7.3c-.2 0-.4.2-.4.4v19.2c0 7.9 5.9 13.5 14 13.5h.2c8.1 0 14-5.6 14-13.5V35.7c0-.2-.2-.4-.4-.4h-7.3c-.2 0-.4.2-.4.4v20.1c-.1 3.6-2.8 5.6-6 5.6zm-173.7 2.3c0-.1.2-.2.3-.1 2.1 2.7 6.3 4.8 10.9 4.8 7.8 0 15.6-6.1 15.6-16.9 0-11.5-7.8-16.9-15.9-16.9-5.1 0-9 2.5-11 5.5-.1.1-.2.1-.3-.1l-.9-4.3c0-.2-.2-.3-.4-.3h-5.9c-.2 0-.4.2-.4.4v46.8c0 .2.2.4.4.4h7.3c.2 0 .4-.2.4-.4V63.7zm10.2-2.6c-5.3 0-9.5-3.6-9.5-9.7s4.2-9.7 9.5-9.7c3.1 0 8.7 2.1 8.7 9.7s-5.8 9.7-8.7 9.7zm-33.9-36.3c0-2.7 2.2-4.8 5.1-4.8 3.1 0 5.2 2.2 5.2 4.8 0 2.6-2.2 4.8-5.2 4.8-2.9.1-5.1-2.2-5.1-4.8zm8.8 10.5c.2 0 .4.2.4.4v31.5c0 .2-.2.4-.4.4h-7.3c-.2 0-.4-.2-.4-.4V35.7c0-.2.2-.4.4-.4h7.3z"/>
                                <path fill="#b2e522" fill-rule="evenodd"
                                      d="M52.9 26.5c-.6-.2-1.3-.1-2 .1l-2.7.9V2.4c0-1.3-1.1-2.4-2.4-2.4H10.3C9 0 7.9 1.1 7.9 2.4v25.2l-2.7-.9c-.7-.2-1.4-.3-2-.1-1 .2-3.2 1.2-3.2 5.1v21c.3 1.8 1.5 3.9 4.2 3.9h9c.9 1.1 3.1 2.9 7.3 3.2.1 3.1 1.9 5.7 4.6 6.8v5.9c0 .1-.1.2-.2.2-12.6.4-20.6 4.4-22.9 5.7C.6 79.2.3 80.9.3 82v4.6c.1 1.6 1.4 2.9 3.1 2.9 1.5 0 2.8-1.3 2.9-2.8.1-1.5-.9-2.7-2.3-3.1-.1 0-.2-.1-.2-.2v-1.7c0-.4.2-.8.6-1 3.4-1.9 12.1-2.8 18.7-3.2H25c.1 0 .2.1.2.2.3 5.3.9 9.8 1.1 12.6h-.2c-1.1 0-2.1 1.3-2.1 3s1 3 2.1 3h4c1.1 0 2.1-1.3 2.1-3s-1-3-2.1-3h-.2s.7-7.3 1.1-12.6c0-.1.1-.2.2-.2h1.9c6.6.3 15.3 1.3 18.7 3.2.4.2.6.6.6 1v1.7c0 .1-.1.2-.2.2-1.4.3-2.4 1.6-2.3 3.1.1 1.5 1.4 2.8 2.9 2.8 1.6 0 3-1.2 3.1-2.9V82c0-1.1-.3-2.7-1.7-3.6-2.3-1.3-10.4-5.3-22.9-5.8-.1 0-.2-.1-.2-.2v-5.9c2.7-1.1 4.5-3.7 4.6-6.8 4.1-.3 6.3-2.2 7.3-3.2h9c2.7 0 3.9-2.1 4.2-3.9v-21c-.1-3.9-2.3-4.8-3.3-5.1zm-45 21.8l-4.1 3.1c-.1.1-.2 0-.2-.1V31.6c0-.8.1-1.8.5-1.7l3.6 1.2c.1 0 .2.2.2.3v16.9zm44.5 3.1l-4.1-3.1V31.5c0-.1.1-.2.2-.3l3.6-1.2c.5-.1.5.9.5 1.7v19.7s-.1.1-.2 0z"
                                      clip-rule="evenodd"/>
                                <path fill="#343e45"
                                      d="M428.7 30.7c0-.7.1-1.3.4-1.9.3-.6.6-1.1 1-1.5.4-.4.9-.8 1.5-1 .6-.3 1.2-.4 1.9-.4s1.3.1 1.9.4c.6.3 1.1.6 1.5 1 .4.4.8.9 1 1.5s.4 1.2.4 1.9-.1 1.3-.4 1.9-.6 1.1-1 1.5-.9.8-1.5 1c-.6.3-1.2.4-1.9.4s-1.3-.1-1.9-.4c-.6-.3-1.1-.6-1.5-1s-.8-.9-1-1.5c-.3-.6-.4-1.3-.4-1.9zm.9 0c0 .5.1 1.1.3 1.5.2.5.5.9.9 1.3s.8.6 1.3.9 1 .3 1.5.3 1.1-.1 1.5-.3.9-.5 1.3-.9.6-.8.9-1.3c.2-.5.3-1 .3-1.5s-.1-1.1-.3-1.5-.5-.9-.9-1.3-.8-.6-1.3-.9-1-.3-1.5-.3-1.1.1-1.5.3-.9.5-1.3.9-.6.8-.9 1.3-.3.9-.3 1.5z"/>
                                <path fill="#343e45"
                                      d="M431.6 27.9h1.8c1.6 0 2.2.6 2.2 1.6s-.7 1.5-1.2 1.5l1.4 2.3v.1h-1.1l-1.3-2.3h-.7v2.3h-.9v-5.5zm1.8 2.3c.7 0 1.2-.2 1.2-.8 0-.5-.3-.7-1.2-.7h-.8v1.4h.8z"/>
                            </svg>
                        </div>
                        <div class="text-center mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 viewBox="0 0 320 80" width="100" height="25" style="vertical-align: middle;">
                                <path d="M287.31 13.4a5.24 5.24 0 0 0-4.22-1.76 5 5 0 0 0-4.22 1.92 9 9 0 0 0-1.49 5.59V37a24.49 24.49 0 0 0-7-5.52 16.88 16.88 0 0 0-5.2-1.56 25.92 25.92 0 0 0-3.6-.24A18.43 18.43 0 0 0 247.06 36c-3.67 4.23-5.51 10.09-5.51 17.65A33.74 33.74 0 0 0 243 63.6a24 24 0 0 0 4.06 8 19.15 19.15 0 0 0 6.41 5.24 17.87 17.87 0 0 0 8 1.84 19.14 19.14 0 0 0 3.75-.35 14.73 14.73 0 0 0 2.27-.55 19.32 19.32 0 0 0 5.12-2.66 30.13 30.13 0 0 0 4.81-4.54v1.17a7.52 7.52 0 0 0 1.6 5.13 5.66 5.66 0 0 0 8.21.08 7.48 7.48 0 0 0 1.8-5.17V18.48a7.76 7.76 0 0 0-1.72-5.08zm-12.15 49.22a11.56 11.56 0 0 1-4.18 5 10.7 10.7 0 0 1-5.78 1.64 10.45 10.45 0 0 1-5.78-1.72 11.84 11.84 0 0 1-4.18-5.16 20.67 20.67 0 0 1-1.52-8.37 20.86 20.86 0 0 1 1.45-8.14 12 12 0 0 1 4-5.4 9.68 9.68 0 0 1 5.94-1.88h.12a9.93 9.93 0 0 1 5.74 1.84 12.56 12.56 0 0 1 4.22 5.28 19.89 19.89 0 0 1 1.56 8.29 20.36 20.36 0 0 1-1.59 8.62zm-37.9.51a4.38 4.38 0 0 0-3-1 4 4 0 0 0-2.62.78c-1.52 1.41-2.74 2.54-3.67 3.36a33.69 33.69 0 0 1-3.13 2.31 12.3 12.3 0 0 1-3.44 1.57 14 14 0 0 1-3.95.51 6.6 6.6 0 0 1-.9 0 10.72 10.72 0 0 1-5-1.57 11.55 11.55 0 0 1-4.3-4.66A17.22 17.22 0 0 1 205.6 57h23.54c3.17 0 5.65-.34 7.37-1.2s2.62-2.9 2.62-5.91a20.41 20.41 0 0 0-2.54-9.66 19.64 19.64 0 0 0-7.59-7.74 23.28 23.28 0 0 0-12.12-3h-.35a27.4 27.4 0 0 0-9.53 1.75 21.07 21.07 0 0 0-7.54 5 22.48 22.48 0 0 0-4.61 7.86 30.26 30.26 0 0 0-1.6 9.94c0 7.59 2.15 13.54 6.45 18 4.06 4.19 9.69 6.38 16.84 6.61h1.25a27.65 27.65 0 0 0 9-1.33 22.39 22.39 0 0 0 6.48-3.32 16 16 0 0 0 3.87-4.23 7.8 7.8 0 0 0 1.29-3.8 3.58 3.58 0 0 0-1.17-2.84zm-28.14-22.4a9.58 9.58 0 0 1 7.39-3.09 9.94 9.94 0 0 1 7.58 3.05c1.91 2 3 5.25 3.32 9.4H205.6c.4-4.09 1.57-7.29 3.52-9.36zM189 63.13a4.38 4.38 0 0 0-3-1 4 4 0 0 0-2.62.78c-1.52 1.41-2.74 2.54-3.67 3.36a33.69 33.69 0 0 1-3.13 2.31 12.3 12.3 0 0 1-3.44 1.57 14 14 0 0 1-3.95.51 6.6 6.6 0 0 1-.9 0 10.72 10.72 0 0 1-5-1.57 11.55 11.55 0 0 1-4.3-4.66 17.22 17.22 0 0 1-1.64-7.43h23.54c3.17 0 5.65-.34 7.37-1.2s2.62-2.9 2.62-5.91a20.41 20.41 0 0 0-2.54-9.66 19.64 19.64 0 0 0-7.58-7.71 23.28 23.28 0 0 0-12.12-3h-.35a27.4 27.4 0 0 0-9.54 1.72 21.07 21.07 0 0 0-7.54 5 22.48 22.48 0 0 0-4.61 7.86 30.26 30.26 0 0 0-1.6 9.94c0 7.59 2.15 13.54 6.45 18 4.06 4.19 9.69 6.38 16.84 6.61h1.25a27.65 27.65 0 0 0 9-1.33A22.39 22.39 0 0 0 185 74a16 16 0 0 0 3.87-4.23 7.8 7.8 0 0 0 1.29-3.8 3.58 3.58 0 0 0-1.16-2.84zm-28.14-22.4a9.58 9.58 0 0 1 7.39-3.09 9.94 9.94 0 0 1 7.58 3.05c1.91 2 3 5.25 3.32 9.4h-21.8c.39-4.09 1.56-7.29 3.52-9.36zm-21.65-27.17A5.26 5.26 0 0 0 135 11.8a5 5 0 0 0-4.22 1.92c-1.31 1.52-1.65 3.24-1.65 5.7V37.2a23.57 23.57 0 0 0-6.62-5.57 17.21 17.21 0 0 0-5.2-1.56 25.92 25.92 0 0 0-3.6-.24 18.38 18.38 0 0 0-14.54 6.34c-3.63 4.23-5.47 10.1-5.47 17.65a35.11 35.11 0 0 0 1.37 9.94 24.13 24.13 0 0 0 4.1 8 19.15 19.15 0 0 0 6.41 5.24 17.87 17.87 0 0 0 8 1.84 19.72 19.72 0 0 0 3.75-.35 14.67 14.67 0 0 0 2.27-.55 19.32 19.32 0 0 0 5.12-2.66 31.93 31.93 0 0 0 4.81-4.54v1.17a7.52 7.52 0 0 0 1.6 5.13 5.62 5.62 0 0 0 8.17.08 7.53 7.53 0 0 0 1.56-5.2V18.68a7.87 7.87 0 0 0-1.65-5.12zm-11.9 49.22a11.37 11.37 0 0 1-4.22 5 10.57 10.57 0 0 1-5.74 1.64 10.44 10.44 0 0 1-5.78-1.72 11.58 11.58 0 0 1-4.18-5.16 20.68 20.68 0 0 1-1.52-8.37 21.64 21.64 0 0 1 1.41-8.14 12.08 12.08 0 0 1 4.06-5.4 9.57 9.57 0 0 1 5.9-1.88h.16a9.72 9.72 0 0 1 5.6 1.88 12.35 12.35 0 0 1 4.26 5.28 20.52 20.52 0 0 1 1.56 8.29 21 21 0 0 1-1.51 8.58zM26 71.27v-28.8c.82.08 1.6.12 2.42.12A20.27 20.27 0 0 0 39 39.65v31.62c0 2.7-.49 4.7-1.71 6a6.16 6.16 0 0 1-4.77 2 6 6 0 0 1-4.69-2c-1.21-1.33-1.84-3.33-1.84-6zm-.12-69C34-.69 43.28-.53 50.23 5.5a11.79 11.79 0 0 1 3.36 4.5c.7 2.27-2.46-.23-2.89-.55a30.92 30.92 0 0 0-7.07-3.6C29.95 1.66 17 9.29 9 21.15A64.11 64.11 0 0 0 1.61 38a9.59 9.59 0 0 1-.7 2.11c-.35.67-.16-1.8-.16-1.88a52 52 0 0 1 1.41-7.36C5.87 17.94 14.08 7.18 25.88 2.25zm10.59 32A9.92 9.92 0 1 1 40.81 21a9.88 9.88 0 0 1-4.34 13.29zm20.87 2.53v1.5a21.48 21.48 0 0 1 6.9-6.13 18.79 18.79 0 0 1 8.65-1.94 17.35 17.35 0 0 1 8.45 2.06 13 13 0 0 1 5.55 5.82 13.56 13.56 0 0 1 1.55 4.78 48.84 48.84 0 0 1 .35 6.48v22.24A7.92 7.92 0 0 1 87.13 77a5.41 5.41 0 0 1-4.27 1.86A5.48 5.48 0 0 1 78.52 77a7.81 7.81 0 0 1-1.62-5.4V51.7c0-4-.59-7-1.68-9.09s-3.3-3.14-6.55-3.14a9.84 9.84 0 0 0-5.82 1.9A11 11 0 0 0 59 46.65c-.58 1.79-.91 5.09-.91 10v14.96c0 2.45-.52 4.23-1.65 5.47a5.68 5.68 0 0 1-4.34 1.82 5.38 5.38 0 0 1-4.29-1.9 7.82 7.82 0 0 1-1.67-5.4V37c0-2.29.5-4 1.51-5.09a5.1 5.1 0 0 1 4.07-1.71 5.41 5.41 0 0 1 2.83.74 5.29 5.29 0 0 1 2.06 2.25 8 8 0 0 1 .74 3.64z"
                                      fill="#2164f3" fill-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-center mt-1">
                            <img src="{{ asset('img//integration-icons/career_b.png') }}" style="width: 90px;">
                        </div>
                        <div class="text-center mt-1">
                            <img src="{{ asset('img//integration-icons/snag.png') }}" style="width: 90px;">
                        </div>
                        <div class="text-center mt-1"><img src="{{ asset('img//integration-icons/linkedin.png') }}"
                                                           style="width: 90px;"></div>
                    </div>
                    {!! trans('guides.cr_link.text') !!}
                    <p class="mb-0 text-center">
                        <button type="button" class="btn btn-success help-how-to-start-hide help-how-to-start-gotit">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 version="1.1" id="Capa_1" x="0px" y="0px" width="15px" height="15px"
                                 viewBox="0 0 448.8 448.8"
                                 style="enable-background:new 0 0 448.8 448.8; vertical-align: middle; margin-top: -3px; fill:#fff;"
                                 xml:space="preserve">
                              <g>
                                  <g id="check">
                                      <polygon
                                              points="142.8,323.85 35.7,216.75 0,252.45 142.8,395.25 448.8,89.25 413.1,53.55"></polygon>
                                  </g>
                              </g>
                          </svg>
                            {!! trans('main.buttons.got_it') !!}
                        </button>
                    </p>
                </div>
                <p class="text-right mb-1 mt-5" style="opacity: 0.4;">
                    <button type="button" class="pt-0 mt-0 border-0 help-how-to-start-show"
                            style="background-color: inherit; font-size: 13px; cursor: pointer;">
                        <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px"
                             style="vertical-align: middle; margin-top: -3px;">
                            <path class="heroicon-ui"
                                  d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>
                        {!! trans('main.help') !!}
                    </button>
                </p>
                <div class="col-12 rounded bg-white py-3">
                    <div class="d-flex justify-content-around flex-lg-row flex-column mt-5">
                        <div class="col-lg-5 col-12 text-center">
                            <p><strong>{!! trans('pages.title.cr_link.item_1') !!}</strong></p>
                            <p class="mb-0">{!! trans('pages.text.cr_link.your_link') !!} </p>
                            <div class="btn-group col-lg-8 col-12 mx-auto mb-3">
                                <input id="crLink-CodeBitLyBusiness" type="text" name="" class="form-control border-top-right-0 border-bottom-right-0" value=""
                                       readonly>
                                <button type="button" class="btn btn-primary" data-clipboard-action="copy"
                                        data-clipboard-target="#crLink-CodeBitLyBusiness"
                                        id="clipboard-button">{!! trans('main.buttons.copy') !!}</button>
                            </div>
                            <p>{!! trans('pages.text.cr_link.item_1') !!}</p>
                        </div>
                        <div class="col-lg-5 col-12 text-center" id="formGenerateCode">
                            <p><strong>{!! trans('pages.title.cr_link.item_2') !!}</strong></p>
                            <div class="form-group input-group mb-2">
                                <input type="text" id="crLink-TitleJob" name="job"
                                       class="form-control ui-autocomplete-input"
                                       placeholder="{!! trans('fields.placeholder.cr_link_type_job_title') !!}"
                                       autocomplete="off"
                                       style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                <span class="input-group-btn border-0 hide"
                                      style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                    <button class="btn mx-0 border-0" type="button" id="crLink-TitleJob-clear"
                                            style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between flex-lg-row flex-column mt-3">
                                <div class="col-lg-6 col-12 pl-0 pxa-0">
                                    <div class="form-group input-group mb-2">
                                        <input type="text" id="crLink-TitleLocation" name="location"
                                               class="form-control ui-autocomplete-input"
                                               placeholder="{!! trans('fields.placeholder.cr_link_location') !!}"
                                               autocomplete="off"
                                               style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                        <span class="input-group-btn border-0 hide"
                                              style="border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                <button class="btn mx-0 border-0" type="button"
                                                        id="crLink-TitleLocation-clear"
                                                        style="background-color: #f4f4f4; border-top-right-radius: 10px; border-bottom-right-radius: 10px;">
                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                </button>
                                            </span>
                                    </div>
                                    <button id="crLink-GenerateLink"
                                            class="btn btn-primary mb-3">{!! trans('main.buttons.generate_link') !!}</button>
                                    <div id="crLink-ShowCode" style="display: none">
                                        <p class="mb-0">{!! trans('pages.text.cr_link.your_link') !!} </p>
                                        <div class="btn-group col-12 mx-auto mb-3 px-0">
                                            <input id="crLink-CodeBitLyBusinessJob" type="text" name="" class="form-control" value=""
                                                   readonly>
                                            <button type="button" class="btn btn-primary" data-clipboard-action="copy"
                                                    data-clipboard-target="#crLink-CodeBitLyBusinessJob"
                                                    id="clipboard-button-too">{!! trans('main.buttons.copy') !!}</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 pr-0 pxa-0 d-flex">
                                    <div class="mr-3">
                                        <label class="custom-control custom-checkbox m-0 pl-3">
                                            <input id="crLink-NoLocation" type="checkbox" name="location_no"
                                                   class="custom-control-input" data-time="0">
                                            <span class="custom-control-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="text-left">
                                        <p class="mb-1"><strong>{!! trans('fields.label.no_location') !!}</strong></p>
                                        <p class="mb-0">{!! trans('pages.text.cr_link.item_2') !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        @endsection
        @section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
            <script src="{{ asset('/js/app/share-button.js?v='.time()) }}"></script>
            <script src="http://code.interactjs.io/v1.3.3/interact.min.js"></script>
            <script src="{{ asset('/js/app/cr_link.js?v='.time()) }}"></script>
@stop