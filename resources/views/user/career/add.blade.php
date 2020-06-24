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
                <div class="col-md-12 text-center mt-4">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 437.955 437.955" style="enable-background:new 0 0 437.955 437.955;" xml:space="preserve" width="70px" height="70px" class="">
                        <g>
                            <g>
                                <path d="M328.728,64.036h-72.25V10c0-5.522-4.478-10-10-10h-55c-5.522,0-10,4.478-10,10v54.036h-72.25c-27.57,0-50,22.43-50,50   v273.919c0,27.57,22.43,50,50,50h219.5c27.57,0,50-22.43,50-50V114.036C378.728,86.466,356.298,64.036,328.728,64.036z M201.478,20   h35v73.955h-35V20z M358.728,387.955c0,16.542-13.458,30-30,30h-219.5c-16.542,0-30-13.458-30-30V114.036c0-16.542,13.458-30,30-30   h72.25v9.919h-10c-5.522,0-10,4.478-10,10s4.478,10,10,10h95c5.522,0,10-4.478,10-10s-4.478-10-10-10h-10v-9.919h72.25   c16.542,0,30,13.458,30,30V387.955z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"></path>
                                <path d="M218.978,51c5.79,0,10.5-4.71,10.5-10.5s-4.71-10.5-10.5-10.5s-10.5,4.71-10.5,10.5S213.188,51,218.978,51z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"></path>
                                <path d="M290.978,357.955h-144c-5.522,0-10,4.478-10,10s4.478,10,10,10h144c5.522,0,10-4.478,10-10S296.5,357.955,290.978,357.955z   " data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"></path>
                                <path d="M176.978,267.955c0,5.522,4.478,10,10,10h64c5.522,0,10-4.478,10-10s-4.478-10-10-10h-64   C181.455,257.955,176.978,262.433,176.978,267.955z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"></path>
                                <path d="M248.978,217.955c0-16.542-13.458-30-30-30s-30,13.458-30,30s13.458,30,30,30S248.978,234.497,248.978,217.955z    M208.978,217.955c0-5.514,4.486-10,10-10s10,4.486,10,10s-4.486,10-10,10S208.978,223.469,208.978,217.955z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"></path>
                                <path d="M290.978,153.955h-144c-5.522,0-10,4.478-10,10v144c0,5.522,4.478,10,10,10h144c5.522,0,10-4.478,10-10v-31.892   c0-5.522-4.478-10-10-10s-10,4.478-10,10v21.892h-124v-124h124v68.001c0,5.522,4.478,10,10,10s10-4.478,10-10v-78.001   C300.978,158.433,296.5,153.955,290.978,153.955z" data-original="#000000" class="active-path" data-old_color="#4266ff" fill="#4266ff"></path>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="col-md-12 text-center pb-3 card border-top-0 border-left-0 border-right-0 rounded-0">
                    <h3 class="mx-auto mt-2 text-muted">Add job</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12  pt-5">
                    <h6 class="h6 mb-4">Job title</h6>
                    <small class="form-text text-muted mb-2">Enter Job title</small>
                    <input type="text" name="" class="form-control" placeholder="Type job title here"  autocomplete="off">
                </div>
                <div class="col-md-12  pt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="h6 mb-4">Salary</h6>
                            <small class="form-text text-muted mb-2">Enter Salary</small>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" name="" class="form-control" placeholder="123,00"  autocomplete="off">
                                </div>
                                <div class="col-md-2 pl-1">
                                    <select class="form-control">
                                        <option selected>$</option>
                                        <option>€</option>
                                        <option>£</option>
                                        <option>₽</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-3">
                            <h6 class="h6 mb-4">Hours/Week</h6>
                            <small class="form-text text-muted mb-2">Enter Hours/Week</small>
                            <input type="text" name="" class="form-control" placeholder="40"  autocomplete="off">
                        </div>
                    </div>

                </div>
                <div class="col-md-12  pt-5">
                    <h6 class="h6 mb-4">Job Category</h6>
                    <small class="form-text text-muted mb-2">Select job categories</small>
                    <div id="job_category"></div>
                </div>
                <div class="col-md-12  pt-5">
                    <h6 class="h6 mb-4">Job type</h6>
                    <small class="form-text text-muted mb-2">Select job typies</small>
                    <div id="job_type"></div>
                </div>
                <div class="col-md-12  pt-5">
                    <h6 class="h6 mb-4">Career level</h6>
                    <small class="form-text text-muted mb-2">Select career level</small>
                    <div id="career_level"></div>
                </div>
                <div class="col-md-12  pt-5">
                    <h6 class="h6 mb-4">Speaking language needed</h6>
                    <small class="form-text text-muted mb-2">Select languagies</small>
                    <div id="language_level"></div>
                </div>
                <div class="col-md-12 pt-5">
                    <h6 class="h6 mb-4">Time table</h6>
                    <small class="form-text text-muted mb-2">Choose options</small>
                </div>
                <div class="col-md-12 pt-5">
                    <h6 class="h6 mb-4">Job description</h6>
                    <small class="form-text text-muted mb-2">Enter job description</small>
                    <textarea class="form-control" placeholder="Max 2500 characters" rows='6' style="resize: none;"></textarea>
                </div>
                <div class="col-md-12  pt-5">
                    <h6 class="h6 mb-4">Certification required</h6>
                    <small class="form-text text-muted mb-2">Choose certifications</small>
                    <div id="certification_required"></div>
                </div>
                <div class="col-md-12 pt-5">
                    <h6 class="h6 mb-4">Special notes</h6>
                    <small class="form-text text-muted mb-2">Enter special notes</small>
                    <textarea class="form-control" placeholder="Max 2500 characters" rows='6' style="resize: none;"></textarea>
                </div>
                <div class="col-md-10 pb-0 card mx-auto mt-5 px-0">
                    <div class="panel-group" id="accordion">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title mb-0">
							        <a data-toggle="collapse" href="#collapse1" data-parent="#accordion" class="h5 modal-title text-center bg-light py-2 card border-top-0 border-left-0 border-right-0 rounded-0" style="text-decoration: none; color:#000;">Add locations to job</a>
							      </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse pb-4">
                                <div class="col-md-12 mx-auto mt-1 px-0 pb-2">
                                    <input class="form-control" type="text" name="" placeholder="Type location name or address" style="border: none;border-bottom: 1px solid rgba(0,0,0,.125); border-radius: 0px;" />
                                </div>
                                <div class="col-md-10 mx-auto mt-1">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" role="button">Assign all</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-primary btn-block" role="button">Unassign all</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mx-auto" style="overflow-y: auto; height: 400px;">
                                    <div class="row">
                                        <!-- Assigned begin -->
                                        <div class="col-md-12 py-3 mx-auto card border-left-0 border-right-0 border-top-0 rounded-0">
                                            <div class="row">
                                                <div class="col-md-11 pt-3 mx-auto pl-0">
                                                    <h5 class="pl-4 pb-2">Assigned</h5>
                                                </div>
                                                <!-- one item begin -->
                                                <div class="col-md-11 mt-2 mx-auto pl-4 pr-0">
                                                    <div class="row">
                                                        <div class="col-md-1 pt-2 mt-2 pr-5">
                                                            <input class="form-control" type="checkbox" name="" style="width: 20px; height: 20px;" />
                                                        </div>
                                                        <div class="col-md-10 pl-0">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <p class="my-0 px-3"><strong>Location name</strong></p>
                                                                    <p class="my-0 px-3">Location address</p>
                                                                </div>
                                                                <div class="col-md-3 text-right">
                                                                    <p class="my-0 small"><strong>Created</strong></p>
                                                                    <p class="my-0">Jan 23, 2017</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- one item eof -->
                                            </div>

                                        </div>
                                        <!-- Assigned EOF -->
                                        <!-- Unsassigned BEGIN  -->
                                        <div class="col-md-12 pt-3 mx-auto">
                                            <div class="row">
                                                <div class="col-md-11 pt-3 pl-0 mx-auto">
                                                    <h5 class="pl-4 pb-2">Unsassigned</h5>
                                                </div>
                                                <!-- one item begin -->
                                                <div class="col-md-11 mt-2 mx-auto pl-4 pr-0">
                                                    <div class="row">
                                                        <div class="col-md-1 pt-2 mt-2 pr-5">
                                                            <input class="form-control" type="checkbox" name="" style="width: 20px; height: 20px;" />
                                                        </div>
                                                        <div class="col-md-10 pl-0">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <p class="my-0 px-3"><strong>Location name</strong></p>
                                                                    <p class="my-0 px-3">Location address</p>
                                                                </div>
                                                                <div class="col-md-3 text-right">
                                                                    <p class="my-0 small"><strong>Created</strong></p>
                                                                    <p class="my-0">Jan 23, 2017</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- one item eof -->
                                                <!-- one item begin -->
                                                <div class="col-md-11 mt-3 mx-auto pl-4 pr-0">
                                                    <div class="row">
                                                        <div class="col-md-1 pt-2 mt-2 pr-5">
                                                            <input class="form-control" type="checkbox" name="" style="width: 20px; height: 20px;" />
                                                        </div>
                                                        <div class="col-md-10 pl-0">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <p class="my-0 px-3"><strong>Location name</strong></p>
                                                                    <p class="my-0 px-3">Location address</p>
                                                                </div>
                                                                <div class="col-md-3 text-right">
                                                                    <p class="my-0 small"><strong>Created</strong></p>
                                                                    <p class="my-0">Jan 23, 2017</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- one item eof -->
                                                <!-- one item begin -->
                                                <div class="col-md-11 mt-3 mx-auto pl-4 pr-0">
                                                    <div class="row">
                                                        <div class="col-md-1 pt-2 mt-2 pr-5">
                                                            <input class="form-control" type="checkbox" name="" style="width: 20px; height: 20px;" />
                                                        </div>
                                                        <div class="col-md-10 pl-0">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <p class="my-0 px-3"><strong>Location name</strong></p>
                                                                    <p class="my-0 px-3">Location address</p>
                                                                </div>
                                                                <div class="col-md-3 text-right">
                                                                    <p class="my-0 small"><strong>Created</strong></p>
                                                                    <p class="my-0">Jan 23, 2017</p>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- one item eof -->
                                            </div>
                                            <!-- Unsassigned EOF -->
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 offset-md-8 px-0 mt-2">
                    <button class="btn btn-primary btn-block" role="button">Save</button>
                </div>

            </div>
        </div>
    </div>

@endsection