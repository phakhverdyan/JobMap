@extends('layouts.main_user')

@section('content')

    <div class="page animation" style="animation-duration: 800ms; opacity: 1;">
        <div class="container-fluid">
            <div class="row">
                <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                    @include('components.sidebar.sidebar_user')
                </div>
                @include('components.chat.chat-content')
            </div>
            <!-- Message Sidebar -->
            <!-- MODAL WINDOW -->
            <div class="modal fade" id="AddnewDialog" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header pt-0">
                            <h5 class="modal-title" id="exampleModalLabel">Add new dialog</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pb-5">
                            <input class="form-control" type="text" name="" placeholder="Type name"/>
                            <!-- <div class="row pb-3 pt-1 px-3">
                               <div class="col-md-6 pl-0">
                                   <button type="button" class="btn btn-outline-primary btn-block" role="button" data-toggle="modal" data-target="#assignall">Assign all</button>
                               </div>
                               <div class="col-md-6 pr-0">
                                   <button type="button" class="btn btn-primary btn-block" role="button" data-toggle="modal" data-target="#unassignall">Unassign all</button>
                               </div>
                           </div> -->

                            <div class="row py-3">
                                <!-- one item begin -->
                                <div class="col-md-12 py-2 one-message">
                                    <div class="d-inline-flex">
                                        <div class="border">
                                            <img src="{{ asset('img/profilepic2.png') }}" alt="avatar" width="50px;"/>
                                        </div>
                                        <div>
                                            <p class="my-0 px-3 coll_name"><strong>John</strong></p>
                                            <p class="my-0 px-3 coll_title">Project Manager</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- one item eof -->
                                <!-- one item begin -->
                                <div class="col-md-12 py-2 one-message">
                                    <div class="d-inline-flex">
                                        <div class="border">
                                            <img src="{{ asset('img/profilepic2.png') }}" alt="avatar" width="50px;"/>
                                        </div>
                                        <div>
                                            <p class="my-0 px-3 coll_name"><strong>Jill</strong></p>
                                            <p class="my-0 px-3 coll_title">Project Manager</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- one item eof -->
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <!-- MODAL WINDOW -->
        </div>
        <!-- <style>
            .typingg > div {
                display: block;
                width: 100%;
            }

            .spinner {
                margin: 100px auto 0;
                width: 70px;
                text-align: center;
                display: inline;
            }

            .spinner > div {
                width: 8px;
                height: 8px;
                background-color: #333;

                border-radius: 100%;
                display: inline-block;
                -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
                animation: sk-bouncedelay 1.4s infinite ease-in-out both;
            }

            .spinner .bounce1 {
                -webkit-animation-delay: -0.32s;
                animation-delay: -0.32s;
            }

            .spinner .bounce2 {
                -webkit-animation-delay: -0.16s;
                animation-delay: -0.16s;
            }

            @-webkit-keyframes sk-bouncedelay {
                0%, 80%, 100% {
                    -webkit-transform: scale(0)
                }
                40% {
                    -webkit-transform: scale(1.0)
                }
            }

            @keyframes sk-bouncedelay {
                0%, 80%, 100% {
                    -webkit-transform: scale(0);
                    transform: scale(0);
                }
                40% {
                    -webkit-transform: scale(1.0);
                    transform: scale(1.0);
                }
            }
        </style> -->
    </div>
@endsection