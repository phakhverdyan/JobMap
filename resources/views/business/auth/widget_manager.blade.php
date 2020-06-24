@extends('layouts.main_business')

@section('content')
    <style type="text/css">
        .shape_style {
            background-color: #0062cc;
        }

        .shape_style:not([disabled]):not(.disabled).active, .shape_style:not([disabled]):not(.disabled):active, .show > .shape_style.dropdown-toggle {
            background-color: #4266ff;
            border: none;
        }

        .select2-selection__rendered {
            line-height: 36px !important;
        }

        .select2-selection {
            height: 38px !important;
        }

        .select2-selection__arrow {
            height: 34px !important;
        }
        .tooltip-inner {
          white-space:nowrap;
          max-width:none;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="col-3- pl-0- sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-xl-8 col-12 mx-auto billing-info-wrapper website-widget content-main">
                <div>
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-12 text-center my-4">
                                <div class="bg-white border-0">
                                    <div class="py-4 px-0">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <p class="mb-0">
                                                    {!! trans('pages.text.button.header') !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0">
                                        <div class="border-0">
                                            <div class="">
                                                <div class="row justify-content-center px-3">
                                                    <div class="col-12">
                                                        <div>
                                                            <div class="d-flex justify-content-between flex-lg-row flex-column mb-3">
                                                                <h5 class="h5 mb-0 align-self-center">Your Widget styles</h5>
                                                                <button type="button" class="btn btn-outline-new js-create-widget-button" {{-- data-toggle="modal" data-target="#customWidget" --}}>
                                                                    @svg('/img/button_custom.svg', [
                                                                       'width' => '20px',
                                                                       'height' => '20px',
                                                                       'class' => 'mr-3',
                                                                       'style' => 'vertical-align:middle; margin-top:-3px;',
                                                                    ])
                                                                    Create Widget
                                                                </button>
                                                            </div>

                                                            <!-- ONE WIDGET CREATED -->
                                                            <div class="js-widget-view mt-3"></div>

                                                            <!-- /ONE WIDGET CREATED -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="mb-3 mt-3 row justify-content-center">
                                        <div class="form-group align-ite1ms-center mb-0 col-3">
                                            <p class="mb-0 mr-2">
                                                Select widget for preview
                                            </p>
                                            <select class="form-control" name="widget_preview">
                                                <option selected disabled>Choose widget</option>
                                            </select>
                                            <div id="widget_preview_box" class="mb-3 mt-3">
                                                Widget preview box
                                            </div>
                                        </div>
                                    </div> --}}

                                    <!--Confirm modal for delete-->
                                    <div class="modal fade bd-example-modal-lg" id="delete-widget-modal" tabindex="-1" role="dialog"
                                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.widget') !!}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row justify-content-center">
                                                            <div class="col-11">
                                                                {!! trans('modals.text.remove_widget') !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-center bg-light">
                                                    <div class="bg-white">
                                                        <button type="button" class="btn btn-outline-warning" data-dismiss="modal"
                                                                aria-label="{!! trans('main.buttons.cancel') !!}">
                                                            {!! trans('main.buttons.cancel') !!}
                                                        </button>
                                                        <button type="button" class="btn btn-outline-primary"
                                                                id="business-website-button-confirm-delete">
                                                            {!! trans('main.buttons.remove') !!}
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





                </div>
            </div>
        </div>
    </div>
        @include('components.modal.widget_modal')

        @endsection
        @section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
            <script src="{{ asset('/js/app/business-widget-admin.js?v='.time()) }}"></script>
            <script src="{{ asset('/libs/colorpicker/i18n/jquery.ui.colorpicker-en.js?v='.time()) }}"></script>
            <script src="{{ asset('/libs/colorpicker/i18n/jquery.ui.colorpicker-fr.js?v='.time()) }}"></script>
            <script src="{{ asset('/libs/colorpicker/jquery.colorpicker.js?v='.time()) }}"></script>
            <script src="http://code.interactjs.io/v1.3.3/interact.min.js"></script>

            <script>
                $(document).ready( function() {
                    let _locale = APIStorage.read('language');
                    if(!_locale) _locale = "en";
                    $('input.select-color-rgba').each( function() {
                        $(this).colorpicker({
                            parts:      'full',
                            showNoneButton: false,
                            alpha:      true,
                            showTransparentButton:      false,
                            colorFormat: "RGBA",
                            regional: _locale,
                            select: function (event, data) {
                                // console.log(event);
                                // console.log(data);
                                $(this).css({"background-color": data.formatted});
                            }
                        });
                    });
                    $('input.select-color').each( function() {
                        $(this).colorpicker({
                            parts:      'full',
                            showNoneButton: false,
                            alpha:      false,
                            colorFormat: "RGB",
                            select: function (event, data) {
                                // console.log(event);
                                // console.log(data);
                                $(this).css({"background-color": data.formatted});
                            }
                        });
                    });
                });
            </script>
@endsection
