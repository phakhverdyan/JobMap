@extends('layouts.main_business')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>

            <div class="col-xl-8 col-11 mx-auto content-main">
                <div class="row">
                    <div class="col-12 text-center my-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="card-header bg-white text-center py-4 border-bottom-0">
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <svg height="50px" viewBox="0 0 1792 1792" width="50px"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1216 1568v192q0 14-9 23t-23 9h-256q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h256q14 0 23 9t9 23zm-480-128q0 12-10 24l-319 319q-10 9-23 9-12 0-23-9l-320-320q-15-16-7-35 8-20 30-20h192v-1376q0-14 9-23t23-9h192q14 0 23 9t9 23v1376h192q14 0 23 9t9 23zm672-384v192q0 14-9 23t-23 9h-448q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h448q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-640q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h640q14 0 23 9t9 23zm192-512v192q0 14-9 23t-23 9h-832q-14 0-23-9t-9-23v-192q0-14 9-23t23-9h832q14 0 23 9t9 23z"
                                                          fill="#4266ff"/>
                                                </svg>
                                                <h3 class="h3 mb-0 text-secondary"
                                                    style="font-family: 'Open Sans', sans-serif; letter-spacing: -1px">
                                                    {!! trans('pages.title.edit_pipeline') !!}</h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="row no-gutters justify-content-center">
                                            <div class="col-12 pb-3 pt-5">
                                                <div class="row justify-content-center">
                                                    <div class="col-11 pt-3">
                                                        <p class="mb-0 text-left">
                                                            <label class="mb-0">
                                                                Language 
                                                                <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style="vertical-align: middle; margin-top: -3px; cursor: pointer; opacity: 0.4;">
                                                                    <path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                                                                </svg>
                                                            </label>
                                                            <select name="current_language_prefix" class="form-control form-control-sm mb-1 d-inline-flex">
                                                                <option value="en">English (Default)</option>
                                                                <option value="fr">French</option>
                                                            </select>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-11">
                                                        <h6 class="h6 mb-3 text-center text-md-left">{!! trans('pages.text.edit_pipeline.add_new') !!}</h6>


                                                            <form id="pipeline-add-form" autocomplete="off">
                                                              <div class="input-group mb-3">
                                                                <span class="input-group-addon" id="basic-addon1">
                                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                                </span>
                                                                <input type="text" class="form-control border-right-0 [ multilanguage multilanguage-en ]"
                                                                       placeholder="{!! trans('fields.placeholder.edit_pipeline') !!}"
                                                                       id="pipeline-add-name-en" name="name">
                                                                <span class="input-group-addon [ multilanguage multilanguage-en ]">
                                                                    (En)
                                                                </span>
                                                                <input type="text" class="form-control border-right-0 [ multilanguage multilanguage-fr ] d-none"
                                                                       placeholder="{!! trans('fields.placeholder.edit_pipeline') !!}"
                                                                       id="pipeline-add-name-fr" name="name_fr">
                                                                <span class="input-group-addon [ multilanguage multilanguage-fr ] d-none">
                                                                    (Fr)
                                                                </span>
                                                                <div class="roudned-0 px-3 pt-2" style="border: 1px solid rgba(78,92,110,.1);">
                                                                  <div class="d-flex">
                                                                    <label class="custom-control custom-checkbox m-0 pl-3 mr-1">
                                                                        <input type="checkbox" class="custom-control-input">
                                                                        <span class="custom-control-indicator"></span>
                                                                    </label>
                                                                    <p class="mb-0 mr-1" style="padding-top: 2px;">
                                                                      {!! trans('fields.label.hide_from_job_seeker') !!}
                                                                    </p>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24" width="20px" style=" margin-top: 3px; cursor: pointer; fill:#4E5C6E;" data-toggle="tooltip" title="{!! trans('fields.placeholder.hide_from_job_seeker') !!}"><path class="heroicon-ui" d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM10.59 8.59a1 1 0 1 1-1.42-1.42 4 4 0 1 1 5.66 5.66l-2.12 2.12a1 1 0 1 1-1.42-1.42l2.12-2.12A2 2 0 0 0 10.6 8.6zM12 18a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg>
                                                                  </div>
                                                                </div>
                                                                <span class="input-group-btn border-0">
                                                                        <div class="dropdown">
                                                                            <input type="hidden" name="icon" value="default">
                                                                            <button class="[ pipeline-add-item-icon__title ] btn btn-outline-primary dropdown-toggle rounded-0"
                                                                                    type="button"
                                                                                    data-toggle="dropdown"
                                                                                    aria-haspopup="true"
                                                                                    aria-expanded="false"
                                                                                    data-icon="default">
                                                                              @svg('/img/pipeline/default.svg', 'pipeline-add-icon')
                                                                            </button>
                                                                            <div class="dropdown-menu w-100"
                                                                                 style="min-width: 0">
                                                                                @foreach(config('lists.pipeline_icons') as $pipeline_icon)
                                                                                  <button class="[ pipeline-add-item-icon__item ] dropdown-item text-center px-2" type="button" data-icon="{{ $pipeline_icon }}">
                                                                                    @svg('/img/pipeline/' . $pipeline_icon . '.svg', 'pipeline-edit-icon')
                                                                                  </button>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                </span>
                                                                <span class="input-group-btn border-0">
                                                                        <button class="btn btn-outline-primary mx-0"
                                                                                type="button" id="pipeline-add">
                                                                            {!! trans('main.buttons.add_pipeline') !!}
                                                                        </button>
                                                                </span>
                                                              </div>
                                                            </form>

                                                        <h6 class="h6 mb-3 text-center text-md-left">{!! trans('pages.text.edit_pipeline.drag') !!}</h6>

                                                        <div id="pipeline-sortable" class="p-0 m-0">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteCModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelC">{!! trans('modals.title.pipeline') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.remove_pipeline') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-primary pipeline-confirm-delete" data-type="1">
                            {!! trans('main.buttons.remove_pipeline_yes') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary pipeline-confirm-delete" data-type="2">
                            {!! trans('main.buttons.remove_pipeline_delete') !!}
                        </button>
                        <button type="button" class="btn btn-outline-warning"
                                data-dismiss="modal" aria-label="Close">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Confirm modal for delete-->
    <div class="modal fade bd-example-modal-lg" id="deleteModal" tabindex="-1" role="dialog"
         aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.pipeline') !!}</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="conteiner">
                        <div class="row justify-content-center">
                            <div class="col-11">
                                {!! trans('modals.text.remove_pipeline_item') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning"
                                data-dismiss="modal" aria-label="Close">
                            {!! trans('main.buttons.cancel') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary pipeline-confirm-delete" data-type="1">
                            {!! trans('main.buttons.remove') !!}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('/js/app/business-applicants.js?v='.time()) }}"></script>
@endsection