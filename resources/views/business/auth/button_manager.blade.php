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
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="col-3 pl-0 sidebar_adaptive">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-xl-8 col-11 mx-auto billing-info-wrapper content-main">
                <div>
                    <div>
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-11 text-center my-4">
                                <div class="card border-0">
                                    <div class="py-4 px-0">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <p class="mb-0">
                                                    {!! trans('pages.text.button.header') !!}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 py-4">
                                        <div class="border border-top-0 border-right-0 border-left-0 pb-4">
                                            <div class="row justify-content-center">
                                                <div class="col-11">
                                                    <div class="d-flex align-items-center flex-wrap justify-content-center mb-2">
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/wordpress.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/Blogger.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/webflow.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/tumblr.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/weebly.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/strikingly.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/shopify.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/squarespace.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/volusion.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/bigcommerce.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/Magento.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/woocommerce.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/Jimdo.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 50px; height: 60px;">
                                                                <img src="{!! asset('img/Yola.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 50px; height: 60px;">
                                                                <img src="{!! asset('img/1&1.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 50px; height: 60px;">
                                                                <img src="{!! asset('img/webnode.jpg') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/wix.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>

                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/Joomla.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/HCJ.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                        <a href="#" class="d-inline-flex mr-2 mb-2">
                                                            <div style="width: 100px; height: 60px;">
                                                                <img src="{!! asset('img/pagecloud.png') !!}"
                                                                     style="max-width: 100%;">
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mb-2 mt-5">
                                                        <a class="btn btn-link" href="#" role="button">{!! trans('main.buttons.see_all') !!}</a>
                                                    </div>
                                                    <h6 class="h6 mb-2">{!! trans('pages.text.button.how_to_use') !!}</h6>
                                                    <div>
                                                        <a class="btn btn-lg btn-link " href="{!! url('/faq') !!}"
                                                           role="button">{!! trans('main.buttons.faq') !!}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="border-0 pb-4">
                                            <div class="py-4">
                                                <div class="row justify-content-center px-3">
                                                    <div class="col-12">
                                                        <div class="row justify-content-center">
                                                            <div class="col-12">
                                                                <h5 class="h5 mb-3">{!! trans('pages.text.button.your_buttons') !!}</h5>
                                                            </div>
                                                            <div class="col-lg-7 col-12">
                                                                <div class="mb-4">
                                                                    <button type="button" class="btn btn-lg btn-success w-100 p-3 js-create-button">
                                                                        @svg('/img/button_custom.svg', [
                                                                           'width' => '50px',
                                                                           'height' => '50px',
                                                                        ])
                                                                        <div> {!! trans('main.buttons.create_custom') !!}</div>
                                                                    </button>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- <p class="h5 pl-3 text-left">{!! trans('pages.text.button.count_buttons', [
                                                            'count' => 0
                                                        ]) !!}</p> -->
                                                        <div class="js-buttons_view">

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


                    <div class="modal fade" id="create-button-modal" tabindex="-1" role="dialog"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="share_button_create_form" class="share_button_form">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{!! trans('modals.title.create_button') !!}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="container-fluid px-0">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="row text-left justify-content-center">
                                                        <div class="col-12">
                                                            <div class="row bg-white mb-3">
                                                                <div class="col-lg-4 col-12">
                                                                    <h6 class="h6 mb-3 text-center">{!! trans('fields.label.button_name') !!}</h6>
                                                                </div>
                                                                <div class="col-lg-8 col-12">
                                                                    <input type="text" class="form-control bg-light"
                                                                           placeholder="{!! trans('fields.placeholder.button_name') !!}" name="button_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="text-center">

                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-lg-4 col-12">
                                                                        <h6 class="h6 mb-3">{!! trans('fields.label.background_color') !!}</h6>
                                                                        <input type="color" name="bg_color"
                                                                               class="form-control" value="#ffffff">
                                                                    </div>
                                                                    <div class="col-lg-8 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.border_color') !!}</h6>
                                                                                <input type="color" name="border_color"
                                                                                       class="form-control"
                                                                                       value="#000000">
                                                                            </div>
                                                                            <div class="col-lg-6 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.border_size') !!}</h6>
                                                                                <input type="number" name="border_size"
                                                                                       class="form-control" value="1">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-lg-4">
                                                                        <h6 class="h6 mb-3">{!! trans('fields.label.background_color_hover') !!}</h6>
                                                                        <input type="color" name="bg_hover_color"
                                                                               class="form-control" value="#ffffff">
                                                                    </div>
                                                                    <div class="col-lg-8 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.border_color_hover') !!}</h6>
                                                                                <input type="color"
                                                                                       name="border_hover_color"
                                                                                       class="form-control"
                                                                                       value="#000000">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-lg-8 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12 icon-right">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.width') !!}</h6>
                                                                                <input type="number" name="width"
                                                                                       class="form-control"
                                                                                       value="200">
                                                                                <i>px</i>
                                                                            </div>
                                                                            <div class="col-lg-6 col-12 icon-right">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.height') !!}</h6>
                                                                                <input type="number" name="height"
                                                                                       class="form-control" value="40">
                                                                                <i>px</i>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-12 mb-2">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.button_text') !!}</h6>
                                                                            </div>
                                                                            <div class="col-lg-8 col-12">
                                                                                <input type="text"
                                                                                       class="form-control bg-light"
                                                                                       name="button_message"
                                                                                       value="{!! trans('fields.placeholder.button_text') !!}"
                                                                                       placeholder="{!! trans('fields.placeholder.button_text') !!}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-12 mb-2">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.font_style') !!}</h6>
                                                                            </div>
                                                                            <div class="col-lg-8 col-12">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-2">
                                                                                            <p class="mb-0 mr-2">
                                                                                                {!! trans('fields.label.color') !!}</p>
                                                                                            <input type="color"
                                                                                                   name="font_color"
                                                                                                   class="form-control bg-light">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-2">
                                                                                            <p class="mb-0 mr-2">{!! trans('fields.label.color_hover') !!}</p>
                                                                                            <input type="color"
                                                                                                   name="font_hover_color"
                                                                                                   class="form-control bg-light">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-2">
                                                                                            <p class="mb-0 mr-2">
                                                                                                {!! trans('fields.label.size') !!}</p>
                                                                                            <input type="number"
                                                                                                   name="font_size"
                                                                                                   class="form-control bg-light"
                                                                                                   value="14">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-0">
                                                                                            <p class="mb-0 mr-2">
                                                                                                {!! trans('fields.label.family') !!}</p>
                                                                                            <select class="js-example-basic-single form-control"
                                                                                                    name="font_family"
                                                                                                    style="padding: 8px 9px;">
                                                                                                <option value="Arial">
                                                                                                    Arial
                                                                                                </option>
                                                                                                <option value="Arial Black">
                                                                                                    Arial Black
                                                                                                </option>
                                                                                                <option value="Helvetica">
                                                                                                    Helvetica
                                                                                                </option>
                                                                                                <option value="Impact">
                                                                                                    Impact
                                                                                                </option>
                                                                                                <option value="Tahoma">
                                                                                                    Tahoma
                                                                                                </option>
                                                                                                <option value="Verdana">
                                                                                                    Verdana
                                                                                                </option>
                                                                                                <option value="Times">
                                                                                                    Times
                                                                                                </option>
                                                                                                <option value="Times New Roman">
                                                                                                    Times
                                                                                                    New
                                                                                                    Roman
                                                                                                </option>
                                                                                                <option value="Georgia">
                                                                                                    Georgia
                                                                                                </option>
                                                                                                <option value="Sans">
                                                                                                    Sans
                                                                                                </option>

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                                <h6 class="h6 mb-3">{!! trans('fields.label.change_style') !!}</h6>
                                                                <div class="d-flex align-items-center justify-content-between flex-column flex-lg-row"
                                                                     data-toggle="buttons">
                                                                    <label class="btn btn-primary shape_style px-4 py-3"
                                                                           style="border-radius: 15px">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option1" value="style1"
                                                                               autocomplete="off" checked>
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-3">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option2" value="style2"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-3 rounded-0">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option3" value="style3"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-4 rounded-0"
                                                                           style="border-radius: 15px">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option4" value="style4"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-4">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option5" value="style5"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-4 rounded-circle">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option6" value="style6"
                                                                               autocomplete="off">
                                                                    </label>
                                                                </div>

                                                                <div class="form-group mb-2 mt-4 js-preview"
                                                                     id="preview-btn">
                                                                    <button type="button"
                                                                            class="btn btn-outline-primary w-100 p-3">
                                                                        {!! trans('fields.label.preview') !!}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-center bg-light">
                                        <div class="d-inline-block bg-white">
                                            <button type="button"
                                                    class="btn btn-outline-primary js-submit">
                                                {!! trans('main.buttons.create_get_code') !!}
                                            </button>
                                        </div>
                                        <div class="d-inline-block bg-white">
                                            <button type="button"
                                                    class="btn btn-outline-primary js-reset">
                                                {!! trans('main.buttons.reset') !!}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="edit-button-modal" tabindex="-1" role="dialog"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form id="share_button_edit_form" class="share_button_form">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{!! trans('modals.title.edit_button') !!}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="container-fluid px-0">
                                            <div class="row justify-content-center">
                                                <div class="col-12">
                                                    <div class="row text-left justify-content-center">
                                                        <div class="col-12">
                                                            <div class="row bg-white mb-3">
                                                                <div class="col-lg-4 col-12">
                                                                    <h6 class="h6 mb-3 text-center">{!! trans('fields.label.button_name') !!}</h6>
                                                                </div>
                                                                <div class="col-lg-8 col-12">
                                                                    <input type="text" class="form-control bg-light"
                                                                           placeholder="{!! trans('fields.placeholder.button_name') !!}" name="button_name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="text-center">

                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-lg-4 col-12">
                                                                        <h6 class="h6 mb-3">{!! trans('fields.label.background_color') !!}</h6>
                                                                        <input type="color" name="bg_color"
                                                                               class="form-control" value="#ffffff">
                                                                    </div>
                                                                    <div class="col-lg-8 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.border_color') !!}</h6>
                                                                                <input type="color" name="border_color"
                                                                                       class="form-control"
                                                                                       value="#000000">
                                                                            </div>
                                                                            <div class="col-lg-6 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.border_size') !!}</h6>
                                                                                <input type="number" name="border_size"
                                                                                       class="form-control" value="1">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-lg-4">
                                                                        <h6 class="h6 mb-3">{!! trans('fields.label.background_color_hover') !!}</h6>
                                                                        <input type="color" name="bg_hover_color"
                                                                               class="form-control" value="#ffffff">
                                                                    </div>
                                                                    <div class="col-lg-8 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.border_color_hover') !!}</h6>
                                                                                <input type="color"
                                                                                       name="border_hover_color"
                                                                                       class="form-control"
                                                                                       value="#000000">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-lg-8 col-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-6 col-12 icon-right">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.width') !!}</h6>
                                                                                <input type="number" name="width"
                                                                                       class="form-control"
                                                                                       value="200">
                                                                                <i>px</i>
                                                                            </div>
                                                                            <div class="col-lg-6 col-12 icon-right">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.height') !!}</h6>
                                                                                <input type="number" name="height"
                                                                                       class="form-control" value="40">
                                                                                <i>px</i>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-12 mb-2">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.button_text') !!}</h6>
                                                                            </div>
                                                                            <div class="col-lg-8 col-12">
                                                                                <input type="text"
                                                                                       class="form-control bg-light"
                                                                                       name="button_message"
                                                                                       value="{!! trans('fields.placeholder.button_text') !!}"
                                                                                       placeholder="{!! trans('fields.placeholder.button_text') !!}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row justify-content-center mb-3">
                                                                    <div class="col-12 mb-2">
                                                                        <div class="row">
                                                                            <div class="col-lg-4 col-12">
                                                                                <h6 class="h6 mb-3">{!! trans('fields.label.font_style') !!}</h6>
                                                                            </div>
                                                                            <div class="col-lg-8 col-12">
                                                                                <div class="row">
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-2">
                                                                                            <p class="mb-0 mr-2">
                                                                                                {!! trans('fields.label.color') !!}</p>
                                                                                            <input type="color"
                                                                                                   name="font_color"
                                                                                                   class="form-control bg-light">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-2">
                                                                                            <p class="mb-0 mr-2">{!! trans('fields.label.color_hover') !!}</p>
                                                                                            <input type="color"
                                                                                                   name="font_hover_color"
                                                                                                   class="form-control bg-light">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-2">
                                                                                            <p class="mb-0 mr-2">
                                                                                                {!! trans('fields.label.size') !!}</p>
                                                                                            <input type="number"
                                                                                                   name="font_size"
                                                                                                   class="form-control bg-light"
                                                                                                   value="14">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-6">
                                                                                        <div class="form-group d-flex align-items-center mb-0">
                                                                                            <p class="mb-0 mr-2">
                                                                                                {!! trans('fields.label.family') !!}</p>
                                                                                            <select class="js-example-basic-single form-control"
                                                                                                    name="font_family"
                                                                                                    style="padding: 8px 9px;">
                                                                                                <option value="Arial">
                                                                                                    Arial
                                                                                                </option>
                                                                                                <option value="Arial Black">
                                                                                                    Arial Black
                                                                                                </option>
                                                                                                <option value="Helvetica">
                                                                                                    Helvetica
                                                                                                </option>
                                                                                                <option value="Impact">
                                                                                                    Impact
                                                                                                </option>
                                                                                                <option value="Tahoma">
                                                                                                    Tahoma
                                                                                                </option>
                                                                                                <option value="Verdana">
                                                                                                    Verdana
                                                                                                </option>
                                                                                                <option value="Times">
                                                                                                    Times
                                                                                                </option>
                                                                                                <option value="Times New Roman">
                                                                                                    Times
                                                                                                    New
                                                                                                    Roman
                                                                                                </option>
                                                                                                <option value="Georgia">
                                                                                                    Georgia
                                                                                                </option>
                                                                                                <option value="Sans">
                                                                                                    Sans
                                                                                                </option>

                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>


                                                                <h6 class="h6 mb-3">{!! trans('fields.label.change_style') !!}</h6>
                                                                <div class="d-flex align-items-center justify-content-between flex-column flex-lg-row"
                                                                     data-toggle="buttons">
                                                                    <label class="btn btn-primary shape_style px-4 py-3"
                                                                           style="border-radius: 15px">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option1" value="style1"
                                                                               autocomplete="off" checked>
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-3">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option2" value="style2"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-3 rounded-0">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option3" value="style3"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-4 rounded-0"
                                                                           style="border-radius: 15px">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option4" value="style4"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-4">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option5" value="style5"
                                                                               autocomplete="off">
                                                                    </label>
                                                                    <label class="btn btn-primary shape_style px-4 py-4 rounded-circle">
                                                                        <input type="radio" name="button-shape-options"
                                                                               id="option6" value="style6"
                                                                               autocomplete="off">
                                                                    </label>
                                                                </div>

                                                                <div class="form-group mb-2 mt-4 js-preview"
                                                                     id="preview-btn">
                                                                    <button type="button"
                                                                            class="btn btn-outline-primary w-100 p-3">
                                                                        {!! trans('fields.label.preview') !!}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer justify-content-center bg-light">
                                        <div class="d-inline-block bg-white">
                                            <button type="button"
                                                    class="btn btn-outline-primary js-submit">
                                                {!! trans('main.buttons.create_get_code') !!}
                                            </button>
                                        </div>
                                        <div class="d-inline-block bg-white">
                                            <button type="button"
                                                    class="btn btn-outline-primary js-reset">
                                                {!! trans('main.buttons.reset') !!}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--Confirm modal for delete-->
                    <div class="modal fade bd-example-modal-lg" id="delete-button-modal" tabindex="-1" role="dialog"
                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{!! trans('modals.title.button') !!}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row justify-content-center">
                                            <div class="col-11">
                                                {!! trans('modals.text.remove_button') !!}
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

        @endsection
        @section('script')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
            <script src="{{ asset('/js/app/share-button.js?v='.time()) }}"></script>
            <script src="http://code.interactjs.io/v1.3.3/interact.min.js"></script>
@stop