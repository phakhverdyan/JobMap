<div class="modal fade" id="addNewCandidateType" tabindex="-1" role="dialog" aria-labelledby="signInModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title mt-0" id="business-bg-modal-label">Add Candidate</h5>
              <button type="button" class="close mt-0" data-dismiss="modal" aria-label="Close" style="position: absolute; top: 5px; right: 10px;">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body pt-0" style="position: relative;">
              <div class="btn-group col-12 px-0 formQuickApplImport" role="group" aria-label="Basic example" style="margin-top: 30px;">
                <div class="input-group form-control py-1 d-flex rounded-0" style="box-shadow: inset 0 1px 1px rgba(0,0,0,0.075); border: 1px solid rgba(78,92,110,.1);">
                    <p class="my-0 mr-2 pt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 382.117 382.117" style="enable-background:new 0 0 382.117 382.117; vertical-align: middle;  fill:#555;" xml:space="preserve" width="15px" height="15px" class="mx-2">
                             <path d="M336.764,45.945H45.354C20.346,45.945,0,65.484,0,89.5v203.117c0,24.016,20.346,43.555,45.354,43.555h291.41  c25.008,0,45.353-19.539,45.353-43.555V89.5C382.117,65.484,361.772,45.945,336.764,45.945z M336.764,297.72H45.354  c-3.676,0-6.9-2.384-6.9-5.103V116.359l131.797,111.27c2.702,2.282,6.138,3.538,9.676,3.538l22.259,0.001  c3.536,0,6.974-1.257,9.677-3.539l131.803-111.274v176.264C343.664,295.336,340.439,297.72,336.764,297.72z M191.059,192.987  L62.87,84.397h256.378L191.059,192.987z"></path>
                        </svg>
                    </p>
                    <div class="d-flex flex-column w-100" style="font-size: 14px">
                        <input type="text" class="border-0 js-import_email" name="email" autocomplete="off" placeholder="{!! trans('sidebar.text.enter_email') !!}" style="box-shadow: none; height: 30px;">
                    </div>
                </div>

                <button class="btn btn-outline-primary mx-0 js-submit_email" type="button" style="border-top-left-radius: 0; border-bottom-left-radius: 0;">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512.297 512.297" style="enable-background:new 0 0 512.297 512.297;  vertical-align: middle; margin-top: -5px;" xml:space="preserve" width="20px" height="20px">
                            <g>
                                <g>
                                    <path d="M506.049,230.4l-192-192c-13.439-13.439-36.418-3.921-36.418,15.085v85.431    c-122.191,5.079-229.968,88.278-264.124,206.683C2.101,385.123-0.745,417.65,0.154,452.659c0.113,4.11,0.142,5.296,0.142,6.159    c0,21.677,28.579,29.538,39.666,10.911c23.767-39.933,50.761-70.791,80.333-93.599c53.462-41.233,109.122-53.174,157.335-48.352    v109.707c0,19.006,22.979,28.524,36.418,15.085l192-192C514.38,252.239,514.38,238.731,506.049,230.4z M320.297,385.982v-76.497    c0-9.773-6.641-18.296-16.117-20.686c-2.596-0.655-6.908-1.513-12.758-2.331c-60.43-8.455-130.633,4.548-197.184,55.876    c-16.371,12.626-31.961,27.299-46.688,44.105l0.326-1.708c1.701-8.759,3.879-17.804,6.624-27.315    c30.45-105.558,130.034-178.409,240.312-176.032c1.864,0.033,2.552,0.048,3.415,0.078c12.063,0.416,22.069-9.25,22.069-21.321    v-55.163l140.497,140.497L320.297,385.982z"></path>
                                </g>
                            </g>
                        </svg>
                </button>
              </div>
              <hr>
              <div>
                <p class="text-center">{!! trans('modals.text.import_ats_list') !!}</p>
                <div class="col-12 mx-auto mt-3">
                    <button type="button" class="btn btn-success btn-block js-uploadFile">{!! trans('main.buttons.select_import_file') !!}</button>
                </div>
                <div class="js-statusUpload">
                </div>
              </div>
              <form action="" id="ats_upload" class="js-formSubmit" method="post" enctype="multipart/form-data">
                    <input type="file" id="ats_files" class="js-fileInput" style="opacity: 0; " multiple name="ats[]"
                           accept=".csv, .xls, .xlsx"/>
                </form>
              <hr>

              <button class="btn btn-outline-success align-self-center btn-block text-center" style="cursor:pointer;" data-toggle="modal" data-target="#addNewCandidate" data-dismiss="modal">
                  <svg id="Layer_1" width="25px" height="25px" style="enable-background:new 0 0 512 512; margin-right: 5px; vertical-align: middle; margin-top: -3px;" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g>
                          <g>
                              <g>
                                  <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                              </g>
                          </g>
                          <g>
                              <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9" fill="#27cfc3"></polygon>
                          </g>
                      </g>
                  </svg>
                  <span class="mb-0">
                      Add New Candidate
                  </span>
              </button>

              <!-- <hr> -->

              {{--<div>
                <a class="align-self-center btn btn-outline-success" href="{!! url('/business/job-boards') !!}" role="button">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" width="25px" height="25px" style="enable-background:new 0 0 512 512; float: left; margin-right: 5px;" version="1.1" viewBox="0 0 512 512" xml:space="preserve">
                        <g>
                            <g>
                                <g>
                                    <path d="M256,48C141.1,48,48,141.1,48,256s93.1,208,208,208c114.9,0,208-93.1,208-208S370.9,48,256,48z M256,446.7     c-105.1,0-190.7-85.5-190.7-190.7S150.9,65.3,256,65.3S446.7,150.9,446.7,256S361.1,446.7,256,446.7z"></path>
                                </g>
                            </g>
                            <g>
                                <polygon points="264.1,128 247.3,128 247.3,247.9 128,247.9 128,264.7 247.3,264.7 247.3,384 264.1,384 264.1,264.7 384,264.7 384,247.9 264.1,247.9" fill="#27cfc3"></polygon>
                            </g>
                        </g>
                    </svg>                                
                    Connect with Job Boards
                </a>
               
              </div>--}}

              </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="{{ asset('/js/app/business-ats.js?v='.time()) }}"></script>
@endsection