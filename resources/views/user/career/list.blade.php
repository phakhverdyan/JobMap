@extends('layouts.main_user')

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- left menu begin -->
        <div class="col-md-3">menu</div>
        <!-- left menu eof -->

        <!-- content block begin-->
        <div class="col-md-8 pb-5 mt-5 card">
            <div class="row">
                <div class="col-md-12 mx-auto px-0 py-2 card rounded-0 border-top-0 border-right-0 border-left-0 jumbotron">
                    <div class="row">

                        <div class="col-md-1 ml-4">
                            <div class="mx-auto text-center pt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 511.999 511.999" xml:space="preserve" class="filtersvg mt-1 pl-0">
                                    <g>
                                        <g>
                                            <path d="M510.078,35.509c-3.388-7.304-10.709-11.977-18.761-11.977H20.682c-8.051,0-15.372,4.672-18.761,11.977    s-2.23,15.911,2.969,22.06l183.364,216.828v146.324c0,7.833,4.426,14.995,11.433,18.499l94.127,47.063    c2.919,1.46,6.088,2.183,9.249,2.183c3.782,0,7.552-1.036,10.874-3.089c6.097-3.769,9.809-10.426,9.809-17.594V274.397    L507.11,57.569C512.309,51.42,513.466,42.813,510.078,35.509z M287.27,253.469c-3.157,3.734-4.889,8.466-4.889,13.355V434.32    l-52.763-26.381V266.825c0-4.89-1.733-9.621-4.89-13.355L65.259,64.896h381.482L287.27,253.469z" />
                                        </g>
                                    </g>
                                </svg>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="row no-gutters">
                                <div class="col-md-5">
                                    <button class="btn btn-block btn-outline-primary" role='button' data-toggle="modal" data-target="#JobModal">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="366.736px" height="366.736px" viewBox="0 0 366.736 366.736" style="enable-background:new 0 0 366.736 366.736;" xml:space="preserve" class="jobsvg">
                                            <g>
                                                <path d="M338.11,75.789h-77.312V61.955c0-16.314-13.271-29.587-29.586-29.587h-95.688c-16.313,0-29.586,13.272-29.586,29.587   v13.834H28.627C12.842,75.789,0,88.63,0,104.414v201.328c0,15.784,12.842,28.626,28.627,28.626h309.482   c15.785,0,28.627-12.842,28.627-28.626V104.414C366.737,88.631,353.896,75.789,338.11,75.789z M130.939,61.955   c0-2.529,2.058-4.587,4.586-4.587h95.688c2.528,0,4.586,2.058,4.586,4.587v13.834h-104.86V61.955z M28.628,100.789H338.11   c2,0,3.627,1.626,3.627,3.625v65.598c-38.738,14.37-97.169,22.858-158.474,22.858c-61.17,0-119.521-8.459-158.263-22.781v-65.675   C25.001,102.415,26.628,100.789,28.628,100.789z M338.11,309.368H28.628c-2,0-3.627-1.626-3.627-3.626V196.575   c35.458,11.697,82.077,19.008,132.882,20.84c-0.003,0.145-0.021,0.285-0.021,0.432v5.513c0,10.335,8.408,18.743,18.744,18.743   h13.527c10.336,0,18.744-8.408,18.744-18.743v-5.513c0-0.147-0.02-0.291-0.021-0.438c50.837-1.848,97.449-9.18,132.883-20.9   v109.234C341.737,307.742,340.11,309.368,338.11,309.368z" />
                                            </g>

                                        </svg>
                                        <p class="pt-0 my-0" style="font-size: 14px;">Locations</p>
                                    </button>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-4 offset-md-2">
                            <div class="row no-gutters">
                                <div class="col-md-5">
                                    <button class="btn btn-outline-primary btn-block rounded-left pb-3 pt-2" role='button' data-toggle="modal" data-target="#SortByModal" style="border-bottom-right-radius: 0px; border-top-right-radius: 0px;">
                                        <p></p>
                                        <p class="pt-0 my-0 pb-2" style="font-size: 14px;">Sort by</p>
                                    </button>
                                </div>
                                <div class="col-md-5">
                                    <button class="btn btn-outline-primary btn-block rounded-right pb-3 pt-2 border-left-0" role='button' data-toggle="modal" data-target="#DisplayResModal" style="border-bottom-left-radius: 0px; border-top-left-radius: 0px;">
                                        <p></p>
                                        <p class="pt-0 my-0 pb-2" style="font-size: 14px;">25 per page</p>
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto mt-3 px-0">
                    <input type="text" name="" class="form-control" placeholder="Find jobs by title">
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto mt-3 px-0">
                    <a href="{!! url('/user/career/add')  !!}" class="btn btn-outline-primary btn-block pt-5 pb-5" role='button'>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 491.86 491.86" style="enable-background:new 0 0 491.86 491.86;" xml:space="preserve" class="addnewlocationsvg">
                            <g>
                                <g>
                                    <path d="M465.167,211.614H280.245V26.691c0-8.424-11.439-26.69-34.316-26.69s-34.316,18.267-34.316,26.69v184.924H26.69    C18.267,211.614,0,223.053,0,245.929s18.267,34.316,26.69,34.316h184.924v184.924c0,8.422,11.438,26.69,34.316,26.69    s34.316-18.268,34.316-26.69V280.245H465.17c8.422,0,26.69-11.438,26.69-34.316S473.59,211.614,465.167,211.614z" />
                                </g>
                            </g>
                        </svg>
                        <p class="pt-4">Add new job</p>
                    </a>
                </div>
            </div>

            <!-- ONE LOCATION BEGIN -->
            <div class="row">
                <div class="col-md-10 mx-auto card py-3 rounded-0">
                    <div class="row  px-0">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Job title</strong></p>
                                    <p>Job type</p>
                                </div>
                                <div class="col-md-2  offset-md-2">Jan 23, 2017</div>
                                <div class="col-md-2 text-right">
                                    <div style="position: relative;">
                                        <img src="img/more.svg" alt="more" class="" data-toggle="dropdown" role="button" width="30%" />
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Edit</button>
                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#ShareModal">Share</button>
                                            <button class="dropdown-item" type="button">Clone</button>
                                            <button class="dropdown-item" type="button">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#ManaInLocModal">Quick Apply to</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#OpenClosedModal">Opened in 21 locations</span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-outline-primary btn-block rounded-0" role='button'>31 candidates</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ONE LOCATION EOF -->

            <!-- ONE LOCATION BEGIN -->
            <div class="row">
                <div class="col-md-10 mx-auto card py-3 rounded-0">
                    <div class="row  px-0">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Job title</strong></p>
                                    <p>Job type</p>
                                </div>
                                <div class="col-md-2  offset-md-2">Jan 23, 2017</div>
                                <div class="col-md-2 text-right">
                                    <div style="position: relative;">
                                        <img src="img/more.svg" alt="more" class="" data-toggle="dropdown" role="button" width="30%" />
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <button class="dropdown-item" type="button">Edit</button>
                                            <button class="dropdown-item" type="button" data-toggle="modal" data-target="#ShareModal">Share</button>
                                            <button class="dropdown-item" type="button">Clone</button>
                                            <button class="dropdown-item" type="button">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#ManaInLocModal">Quick Apply to</button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-outline-primary btn-block rounded-0" role='button' data-toggle="modal" data-target="#OpenClosedModal">Opened in 21 locations</span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-outline-primary btn-block rounded-0" role='button'>31 candidates</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ONE LOCATION EOF -->

        </div>
        <!-- content block eof -->

    </div>
</div>

<!-- MODAL WINDOWS -->

<!-- LOCATION FILTER MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="JobModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Filter jobs by location</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <input class="form-control" type="text" name="" placeholder="Type a job title" />

                <div class="row py-3">
                    <!-- one item begin -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-1 pt-2">
                                <input class="form-control" type="checkbox" name="" />
                            </div>
                            <div class="col-md-8  pl-0">
                                <p class="mt-0">Location</p>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                </div>

            </div>

            <div class="row pb-2 px-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Clear</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-block" role="button">Set</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- LOCATION FILTER MODAL END!!!!!!!!!!!!!!! -->

<!-- SORT JOBS BY FILTER MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="SortByModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sort jobs by</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="row">
                    <div class="col-md-6 pr-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Name</button>
                    </div>
                    <div class="col-md-6 pl-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Added date Asc.</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pr-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Locations Asc.</button>
                    </div>
                    <div class="col-md-6 pl-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">Candidates Asc.</button>
                    </div>
                </div>
            </div>

            <div class="row pb-2 px-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Clear</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-block" role="button">Set</button>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- SORT JOBS BY FILTER MODAL END!!!!!!!!!!!!!!! -->

<!-- DISPLAY RESULTS FILTER MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="DisplayResModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Displat results</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="row">
                    <div class="col-md-6 pr-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">25</button>
                    </div>
                    <div class="col-md-6 pl-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">50</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 pr-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">100</button>
                    </div>
                    <div class="col-md-6 pl-0">
                        <button type="button" class="btn btn-outline-primary btn-block py-5 rounded-0" role="button">200</button>
                    </div>
                </div>
            </div>

            <div class="row pb-2 px-3">
                <div class="col-md-12">
                    <button type="button" class="btn btn-primary btn-block" role="button">Set</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DISPLAY RESULTS FILTER MODAL END!!!!!!!!!!!!!!! -->

<!-- Quick apply job MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="ManaInLocModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quick apply job to locations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <input class="form-control" type="text" name="" placeholder="Type a location by name or address" />
                <div class="row pb-3 pt-1 px-3">
                    <div class="col-md-6 pl-0">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Assign all</button>
                    </div>
                    <div class="col-md-6 pr-0">
                        <button type="button" class="btn btn-primary btn-block" role="button">Unassign all</button>
                    </div>
                </div>

                <div class="row py-3 card border rounded-0 border-top-0">
                    <h5 class="pl-3 pb-2">Assigned</h5>
                    <!-- one item begin -->
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-1 pt-2 mt-1 pr-5">
                                <input class="form-control" type="checkbox" name="" style="width: 30px; height: 30px;" />
                            </div>
                            <div class="d-inline-flex pl-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="my-0 px-3">Location name</p>
                                        <p class="my-0 px-3">Location address</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                </div>

                <div class="row py-3">
                    <h5 class="pl-3 pb-2">Unsassigned</h5>
                    <!-- one item begin -->
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-1 pt-2 mt-1 pr-5">
                                <input class="form-control" type="checkbox" name="" style="width: 30px; height: 30px;" />
                            </div>
                            <div class="d-inline-flex pl-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="my-0 px-3">Location name</p>
                                        <p class="my-0 px-3">Location address</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                    <!-- one item begin -->
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-1 pt-2 mt-1 pr-5">
                                <input class="form-control" type="checkbox" name="" style="width: 30px; height: 30px;" />
                            </div>
                            <div class="d-inline-flex pl-0">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="my-0 px-3">Location name</p>
                                        <p class="my-0 px-3">Location address</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                </div>

            </div>

            <div class="row pb-2 px-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Clear</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary btn-block" role="button">Set</button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Quick apply job MODAL END!!!!!!!!!!!!!!! -->

<!-- SHARE MODAL!!!!!!!!!!!!!!! -->
{{--<div class="modal fade" id="ShareModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5></h5>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <p><strong>Share this location, get more applicants</strong></p>
                <input class="form-control text-center" type="text" name="sharelink" value="/l/434343" readonly>
                <button type="button" class="btn btn-primary btn-block mt-3" role='button'>Copy link</button>
            </div>

        </div>
    </div>
</div>--}}
<!-- SHARE MODAL END!!!!!!!!!!!!!!! -->

<!-- OPEN | CLOSED LOCATIONS FILTER MODAL!!!!!!!!!!!!!!! -->
<div class="modal fade" id="OpenClosedModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Opened in 21 locations | Closed in 2 locations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <input class="form-control" type="text" name="" placeholder="Type a location by name or address" />
                <div class="row pb-3 pt-1 px-3">
                    <div class="col-md-6 pl-0">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Assigned to location</button>
                    </div>
                    <div class="col-md-6 pr-0">
                        <button type="button" class="btn btn-primary btn-block" role="button">Unassigned</button>
                    </div>
                </div>

                <div class="row py-3 card border rounded-0 border-top-0">
                    <h5 class="pl-3 pb-2">Open</h5>
                    <!-- one item begin -->
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-8 text-center ml-3 card">
                                <p class="my-0 px-3">Locations name</p>
                                <p class="my-0 px-3">Address</p>
                            </div>
                            <div class="col-sm-5 col-md-2 offset-md-1">
                                <label class="switch mt-3">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                </div>

                <div class="row py-3">
                    <h5 class="pl-3 pb-2">Closed</h5>
                    <!-- one item begin -->
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-8 text-center ml-3 card">
                                <p class="my-0 px-3">Locations name</p>
                                <p class="my-0 px-3">Address</p>
                            </div>
                            <div class="col-sm-5 col-md-2 offset-md-1">
                                <label class="switch mt-3">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                    <!-- one item begin -->
                    <div class="col-md-12 mt-2">
                        <div class="row">
                            <div class="col-md-8 text-center ml-3 card">
                                <p class="my-0 px-3">Locations name</p>
                                <p class="my-0 px-3">Address</p>
                            </div>
                            <div class="col-sm-5 col-md-2 offset-md-1">
                                <label class="switch mt-3">
                                    <input type="checkbox">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- one item eof -->
                </div>

            </div>

        </div>
    </div>
</div>
<!-- OPEN | CLOSED JOBS FILTER MODAL END!!!!!!!!!!!!!!! -->

<!-- MODAL WINDOWS EOF -->

@endsection
