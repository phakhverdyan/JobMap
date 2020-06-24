@extends('layouts.main_business')

@section('content')
    <style type="text/css">

        .select2.select2-container.select2-container--default .selection .select2-selection.select2-selection--multiple,
        .select2.select2-container .selection .select2-selection{
            background-color: #f4f4f4;
            box-shadow: none!important;
            border-radius: 10px!important;
            border: none!important;
            color: #495057;
            font-size: 14px;
        }
        .select2-selection__rendered .select2-selection__clear{
            /*display: none;*/
        }
        .select2-container--focus:focus,
        .select2.select2-container .selection .select2-selection:focus{
            border: none!important;
            outline: none!important;
        }
        .select2-selection__rendered{
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered .select2-selection__choice{
            color: #fff;
            background-color: #4266ff;
            border-color: #4266ff;
            font-weight: 400;
            padding: .25rem .5rem;
            font-size: .875rem;
            line-height: 1.5;
            border-radius: 10px;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            margin: 3.5px 5px 1px 0;
        }
        .select2-container .select2-search--inline::before{
            display: table;
            clear: both;
        }
        .select2-container .select2-search--inline{
            float: none;
            display: block;
        }
        .select2-container--default .select2-search--inline .select2-search__field{
            padding: 8px 9px;
            margin-top: 0;
            width: 100%!important;
            display: block!important;
        }
        .select2-dropdown{
            border: 1px solid rgba(0,0,0,.15)!important;
            border-radius: .25rem!important;
        }
        .qr-code-loading:before{
            content: "";
            display: block;
            opacity: .1;
            background-color: #000000;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9999;
        }
        .qr-code-loading .fa.fa-circle-o-notch, .brand-loading .fa.fa-circle-o-notch{
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 9999;
            color: #6a86ff;
        }
        .brand-loading .fa.fa-circle-o-notch{
            z-index: 1;
        }
        #avatar-block{
            z-index: 999;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #FFFFFF;
            padding-top: 25px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div id="slide-out" class="pr-0 pl-0 sidebar_adaptive" style="width: 320px;">
                @include('components.sidebar.sidebar_business')
            </div>
            <div class="col-xl-9 col-11 mt-5 pb-5 mx-auto scanner-wrapper content-main">
                <div class="col-12 text-center- mx-auto rounded bg-white py-3" style="min-height: 500px;">
                    <div class="row">

{{--                        <div class="col-md-12">--}}
{{--                            <div id="select-location-scanner-block" class="col-lg-6 col-12 pt-3 ml-auto mr-auto">--}}
{{--                                <label for="select-location-scanner">Select Location</label>--}}
{{--                                <select id="select-location-scanner" class="form-control" name="select_location_scanner">--}}
{{--                                    <option></option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="brand-loading">
                            <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                        </div>
                        <div class="col-12">                                    
                            <div class="panel-group selectBrandPanel" id="accordion" style="display:none;">
                                <div class="panel panel-default assign-panel" style="box-shadow: 0 5px 23px rgba(0,0,0,0.2);">
                                    <div class="panel-heading">
                                        <h4 class="panel-title my-0">
                                            <a id="card-select-location-scanner-action" data-toggle="collapse" href="#data-table-assigned-locations-collapse" data-parent="#accordion" class="h5 modal-title text-center py-3 card border-top-0 border-left-0 border-right-0 rounded-0 addto main-panel collapsed" style="text-decoration: none; color: #7b7b7b; font-size: 15px;font-weight: 400;" data-type-panel="location" aria-expanded="false">
                                                <p class="text-center mb-0"><img src="https://treemix-dev.top/img/sidebar/locations.png" alt=""></p>
                                                Select Brand</a>
                                        </h4>
                                    </div>
                                    <div id="data-table-assigned-locations-collapse" class="panel-collapse pb-4 collapse" style="">
                                        <div class="col-md-12 mx-auto" style="overflow-y: auto; height: auto;">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                    <h4 class="dataTable-header">{!! trans('main.header_step_selected_brand') !!}</h4>
                                                    <table class="table table-responsive display responsive no-wrap" id="card-select-location-scanner-table" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"></th>
                                                        </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div id="card-qr-code-action" class="card" style="margin-top: 30px; display: none;">
                                <div class="card-content">
                                    <div class="card-header">
                                        <h5 class="modal-title text-center" id="exampleModalLabel" style="width: 100%;">
                                            Download and Print JobMap Scanner
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-6">
                                                    <button id="QRCodeDefaultStepAction" type="button" class="btn btn-outline-primary"  style="width: 100%; font-size: 18px; min-height: 100%;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 393 353">
                                                            <title>intercAsset 3</title>
                                                            <g style="isolation: isolate">
                                                                <g id="c50b1aa3-d523-41bd-b6b7-fb0956f89f1b" data-name="Layer 2">
                                                                    <g id="a69c4d59-ca8a-4315-90ff-144f556098cd" data-name="Layer 1">
                                                                        <g>
                                                                            <path d="M64,27H319a10,10,0,0,1,10,10V285a5,5,0,0,1-5,5H59a5,5,0,0,1-5-5V37A10,10,0,0,1,64,27Z" fill="#f9f9f9"/>
                                                                            <path d="M64,26.75H319a10,10,0,0,1,10,10v23a0,0,0,0,1,0,0H54a0,0,0,0,1,0,0v-23a10,10,0,0,1,10-10Z" fill="#ededed"/>
                                                                            <circle cx="73" cy="43.25" r="6" fill="#e74c3c"/>
                                                                            <circle cx="92.5" cy="43" r="6" fill="#f1c40f"/>
                                                                            <circle cx="112" cy="43" r="6" fill="#2ecc71"/>
                                                                            <g>
                                                                                <g>
                                                                                    <image width="81" height="85" transform="translate(279)" opacity="0.06" xlink:href="data:image/png;base64,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" style="mix-blend-mode: multiply"/>
                                                                                    <rect x="283.29" y="9.92" width="62.49" height="65.96" rx="12.38" ry="12.38" fill="#fff"/>
                                                                                </g>
                                                                                <path d="M327.49,50.31v1.85a.91.91,0,0,1-.27.65.89.89,0,0,1-.65.27H302.5a.89.89,0,0,1-.65-.27.88.88,0,0,1-.28-.65V50.31a.94.94,0,0,1,.93-.93h24.07a.89.89,0,0,1,.65.27A.91.91,0,0,1,327.49,50.31Zm-19.44-6.49a.9.9,0,0,0-.65.28.89.89,0,0,0-.27.65V46.6a.89.89,0,0,0,.27.65.86.86,0,0,0,.65.28h13a1,1,0,0,0,.93-.93V44.75a.86.86,0,0,0-.28-.65.9.9,0,0,0-.65-.28ZM304.35,42h20.37a.91.91,0,0,0,.65-.27.89.89,0,0,0,.27-.65V39.2a.92.92,0,0,0-.92-.93H304.35a.94.94,0,0,0-.93.93v1.85a.86.86,0,0,0,.28.65A.89.89,0,0,0,304.35,42Zm5.55-5.55h9.26a1,1,0,0,0,.93-.93V33.64a.86.86,0,0,0-.28-.65.9.9,0,0,0-.65-.28H309.9a.92.92,0,0,0-.65.28.89.89,0,0,0-.27.65v1.85a.89.89,0,0,0,.27.65A.88.88,0,0,0,309.9,36.42Z" fill="#003fae"/>
                                                                            </g>
                                                                            <g>
                                                                                <rect x="216.04" y="81" width="66.96" height="66.96" rx="5.99" ry="5.99" fill="#ededed"/>
                                                                                <g>
                                                                                    <rect x="229.5" y="94.46" width="40.04" height="40.04" rx="1.01" ry="1.01" fill="#ededed"/>
                                                                                    <path d="M266,98v33H233V98h33m2.49-7h-38A4.51,4.51,0,0,0,226,95.47v38a4.51,4.51,0,0,0,4.51,4.51h38a4.51,4.51,0,0,0,4.51-4.51v-38A4.51,4.51,0,0,0,268.53,91Z" fill="#fff"/>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <rect x="97.04" y="81" width="66.96" height="66.96" rx="5.99" ry="5.99" fill="#ededed"/>
                                                                                <g>
                                                                                    <rect x="110.5" y="94.46" width="40.04" height="40.04" rx="1.01" ry="1.01" fill="#ededed"/>
                                                                                    <path d="M147,98v33H114V98h33m2.49-7h-38A4.51,4.51,0,0,0,107,95.47v38a4.51,4.51,0,0,0,4.51,4.51h38a4.51,4.51,0,0,0,4.51-4.51v-38A4.51,4.51,0,0,0,149.53,91Z" fill="#fff"/>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <rect x="97.04" y="200" width="66.96" height="66.96" rx="5.99" ry="5.99" fill="#ededed"/>
                                                                                <g>
                                                                                    <rect x="110.5" y="213.46" width="40.04" height="40.04" rx="1.01" ry="1.01" fill="#ededed"/>
                                                                                    <path d="M147,217v33H114V217h33m2.49-7h-38a4.51,4.51,0,0,0-4.51,4.51v38a4.51,4.51,0,0,0,4.51,4.51h38a4.51,4.51,0,0,0,4.51-4.51v-38a4.51,4.51,0,0,0-4.51-4.51Z" fill="#fff"/>
                                                                                </g>
                                                                            </g>
                                                                            <path d="M193.72,81.82a.81.81,0,0,0-.82-.82H172.22a.81.81,0,0,0-.82.82v35.56a.81.81,0,0,0,.82.82h7.66a.81.81,0,0,0,.82-.82V90.19a.81.81,0,0,1,.82-.82H192.9a.81.81,0,0,0,.82-.82Z" fill="#e5e5e5"/>
                                                                            <path d="M208.6,112.5a1.74,1.74,0,0,0-1.74-1.74H188a1.74,1.74,0,0,0-1.74,1.74v11.4a1.74,1.74,0,0,1-1.74,1.74h-11.4a1.74,1.74,0,0,0-1.74,1.74v4a1.74,1.74,0,0,0,1.74,1.74H192a1.74,1.74,0,0,0,1.74-1.74v-11.4a1.74,1.74,0,0,1,1.74-1.74h11.4a1.74,1.74,0,0,0,1.74-1.74Z" fill="#e5e5e5"/>
                                                                            <path d="M201.16,127.49v11.18a1.85,1.85,0,0,1-1.85,1.85H188.13a1.85,1.85,0,0,0-1.85,1.85v3.74a1.85,1.85,0,0,0,1.85,1.85h18.62a1.85,1.85,0,0,0,1.85-1.85V127.49a1.85,1.85,0,0,0-1.85-1.85H203A1.85,1.85,0,0,0,201.16,127.49Z" fill="#e5e5e5"/>
                                                                            <path d="M245.8,176.27v-12a1.45,1.45,0,0,0-1.45-1.45h-12a1.45,1.45,0,0,1-1.45-1.45v-4.54a1.45,1.45,0,0,1,1.45-1.45h19.42a1.45,1.45,0,0,1,1.45,1.45v19.42a1.45,1.45,0,0,1-1.45,1.45h-4.54A1.45,1.45,0,0,1,245.8,176.27Z" fill="#e5e5e5"/>
                                                                            <path d="M111.88,176.63v-12.7a1.09,1.09,0,0,0-1.09-1.09H98.09A1.09,1.09,0,0,1,97,161.75v-5.26a1.09,1.09,0,0,1,1.09-1.09h20.14a1.09,1.09,0,0,1,1.09,1.09v20.14a1.09,1.09,0,0,1-1.09,1.09H113A1.09,1.09,0,0,1,111.88,176.63Z" fill="#e5e5e5"/>
                                                                            <path d="M171.4,206.29v-12.5a1.19,1.19,0,0,0-1.19-1.19h-12.5a1.19,1.19,0,0,1-1.19-1.19v-5.06a1.19,1.19,0,0,1,1.19-1.19h19.94a1.19,1.19,0,0,1,1.19,1.19v19.94a1.19,1.19,0,0,1-1.19,1.19h-5.06A1.19,1.19,0,0,1,171.4,206.29Z" fill="#e5e5e5"/>
                                                                            <rect x="201.16" y="185.16" width="22.32" height="7.44" rx="1.09" ry="1.09" fill="#e5e5e5"/>
                                                                            <rect x="156.52" y="170.28" width="37.2" height="7.44" rx="1.09" ry="1.09" fill="#e5e5e5"/>
                                                                            <path d="M161.94,155.4H143.66a2,2,0,0,0-2,2v12.86H128.78a2,2,0,0,0-2,2v12.86H99a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2h33.16a2,2,0,0,0,2-2V177.72h12.86a2,2,0,0,0,2-2V162.84h12.86a2,2,0,0,0,2-2v-3.4A2,2,0,0,0,161.94,155.4Z" fill="#e5e5e5"/>
                                                                            <rect x="223.48" y="222.36" width="22.32" height="7.44" rx="1.09" ry="1.09" transform="translate(8.56 460.72) rotate(-90)" fill="#e5e5e5"/>
                                                                            <path d="M251.22,259.56H238.36V246.7a2,2,0,0,0-2-2H223.48V231.82a2,2,0,0,0-2-2H201.32a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2H216V250.1a2,2,0,0,0,2,2h12.86V265a2,2,0,0,0,2,2h18.28a2,2,0,0,0,2-2v-3.4A2,2,0,0,0,251.22,259.56Z" fill="#e5e5e5"/>
                                                                            <path d="M266.1,200H253.24V187.18a2,2,0,0,0-2-2h-3.4a2,2,0,0,0-2,2V200H232.94a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2H266.1a2,2,0,0,0,2-2v-3.4A2,2,0,0,0,266.1,200Z" fill="#e5e5e5"/>
                                                                            <path d="M275.56,216.94V229.8H249.68a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2h25.88V250.1a2,2,0,0,0,2,2H281a2,2,0,0,0,2-2V216.94a2,2,0,0,0-2-2h-3.4A2,2,0,0,0,275.56,216.94Z" fill="#e5e5e5"/>
                                                                            <path d="M206.58,259.56H193.72V231a1.19,1.19,0,0,0-1.19-1.19H172.59A1.19,1.19,0,0,0,171.4,231v5.06a1.19,1.19,0,0,0,1.19,1.19h12.5a1.19,1.19,0,0,1,1.19,1.19v21.13H173.42a2,2,0,0,0-2,2V265a2,2,0,0,0,2,2h33.16a2,2,0,0,0,2-2v-3.4A2,2,0,0,0,206.58,259.56Z" fill="#e5e5e5"/>
                                                                            <path d="M221.46,170.28H208.6V157.42a2,2,0,0,0-2-2H173.42a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2h27.74V175.7a2,2,0,0,0,2,2h18.28a2,2,0,0,0,2-2v-3.4A2,2,0,0,0,221.46,170.28Z" fill="#e5e5e5"/>
                                                                            <path d="M223.48,202.06a2,2,0,0,0-2-2h-3.4a2,2,0,0,0-2,2v12.86H193.72V202.06a2,2,0,0,0-2-2h-3.4a2,2,0,0,0-2,2v14.56c0,.06,0,.1,0,.16s0,.1,0,.16v3.4a2,2,0,0,0,2,2h33.16a2,2,0,0,0,2-2v-3.4c0-.06,0-.1,0-.16s0-.1,0-.16Z" fill="#e5e5e5"/>
                                                                            <path d="M262.7,155.4a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2h12.86v22.32H262.7a2,2,0,0,0-2,2v3.4a2,2,0,0,0,2,2h14.56c.06,0,.1,0,.16,0s.1,0,.16,0H281a2,2,0,0,0,2-2V157.42a2,2,0,0,0-2-2h-3.4c-.06,0-.1,0-.16,0s-.1,0-.16,0Z" fill="#e5e5e5"/>
                                                                            <g>
                                                                                <g>
                                                                                    <image width="127" height="133" transform="translate(0 111)" opacity="0.06" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH8AAACFCAYAAABytCdsAAAACXBIWXMAAAsSAAALEgHS3X78AAAHdklEQVR4Xu2a63ITORBGzwSH3Ags7LK8/+stS4DEuSee/SG11aNoPI6TmLD9naoujY0tp3y6W9KYru97RExmUy94Cl3XdVOvEeP0L1yZ3XPMX0muhSsBNqMWs3z8XEmxkXwn249j12JzejeOXW+cDI9q+5X0DthpXPvnfCKIx9FXsajG5bVpeWwSrCW/kr5TxRsXO270STCYDtGi1eZN8AK4d+O9e7yMxybBpPws3le3iZ4BuzlmbpyxOgEkv40X1hJ/l+PWjXbtk6Hvum6tBFgp34k36Sb3LbDn4q0bLQmmOoBoMyb+FrgBrt147R5bctyTu8BUAozKb4jfpcg+AA5zHOTYz9FKAFX+NHXlt8Rf5bjMcZHDnr8mfb93rJEATfkN8VbZh8AR8A54n8djSiLsUzpALV/S18NXvsm3Sr+iCJ8DZznmpO97J78G1kiAVW2/Y1jxRyTRf7j4QEmCI1bLByXAFP4IV8u/oVT7HDgFfgI/SN+5yfeFtjIBHsivqn5Gqfj3wEfgTxefSAnwjmHl+42f3zCKafzxzm/0fOWb/O+k772W7+chz/OAVuXX6/w+Se4HkvAvwN/AXwzlHzCsen8ctHnFNCbMH+Pq1m/yrdvuUgrN5hhE13WLuvoH8htV/5aUWcekqv9Mkv8lX38idQSr+rGd/vIjEKtobfrqjd81w2XWF5tfLgbHPxpHwLHK91VvLf8Tqdo/kyr/M2ndt6qvK77V7iV/Na2zvk8C6wD13srE+ySp7wNYEixZyh/Z4fuW/5GUALbef6RUva05rTVewjfDb/78HmDXxYz0/fYMO4M/+tk9AH9bGHhY+SZtRpr8gNRe3lMSwHb5x/nf9ihrjtr881J3gvp2uom/J4n3G8Jzyj0ASwC6ruus9bfk15V/SDnXH1Ok+w2ejnQvg9/A+c5s17X4c9K5/2cOvw+7de8BhvLrtr9LEmt3845y2OZON3K2x1g3NT83lBtuVpx+E97qystjmOHl225/n+HtW2vzOsdvH/uObVNty3N9y91uu9ut9qanWj48rH7rAH532bqbJLaDTwD/62rrxzYr0taxO8kf+U8a/qdbf8eu9WudEmC7eF/WAXwSTP24Bgwrv04Am9hHvb5L+q+j9lUX61ihLou91faNOgG6KsSvZ6xIVxXq0t0q+fAwu/xz4vVRF+jKQp2S76kTQEnwumgV6EpHY/JV6b8PdSGu7esxlS9+Lya7tOQHRvIDI/mBkfzASH5gJD8wkh8YyQ+M5AdG8gMj+YGR/MBIfmAkPzCSHxjJD4zkB0byAyP5gZH8wEh+YCQ/MJIfGMkPjOQHRvIDI/mBkfzASH5gJD8wkh8YyQ+M5AdG8gMj+YGR/MBIfmAkPzCSHxjJD4zkB0byAyP5gZH8wEh+YCQ/MJIfGMkPjOQHRvIDI/mBkfzASH5gJD8wkh8YyQ+M5AdG8gMj+YGR/MBIfmAkPzCSHxjJD4zkB0byAyP5gZH8wEh+YCQ/MJIfGMkPjOQHRvIDI/mBkfzASH5gJD8wkh8Yyf//0rvRrgeMyfdvaL5RvBpquWv7ekzl1wmx9oeIrdAq2JWOpuS3ZEv666UfiSar5NsbFznWmlBsldqRj3seesONA/l1lbcmHZtQbJ/a132Ouxz2uC5e+r7vIcu3B+4FJtpPtmpCJcF28b4WFD+3wE2OW4ozczWg1fa9/FvKhNd5tA8aZJPYGvZ9myMv/dqFTwBfrEtq+V78XZ7gCrjM4xVpYp9Vqv7t4cVbxd+SnFwCFy4uKQnQ9DSjULd8yyab9DzHBXAE7OX3WwJNnRzE0/HruxWn+ZkDZznM0xVF/oPK9/JhKN+q3iY+pUx+CLwF3uT37ebrLod4fnxx3lGq/Zzk5ifwI4+nDOX7ZXpJS35PaSf15N9J4vfzeztKC3pDSQBDifA0vCwv3tzMScJPgG95/E7yNSfJv6G0fb+5L/L7vu+7roOHlT8niT+iiN8ltXn/x7SqX/Kfht/VW7u3Nf6C5OUE+Bf4mseT/Pw5j2z7MPwQa/unJOl7FPE95Q85IC0DtgdQ+38+6r2YrfNW9d+Af3J8Jcm3tn/NSMuHSn6uft9ebvIkuzlMri0NV6QMO6RsAH3rVwI8DV/5tsmzqj+jyP9KqfwfpMSw3f5Svm/5MF75fsd/RVnPbUdvf8Q5cMxw9+9bv+Q/jd7FmPwTyppv671v+QtgUYuHhvxq7bcPM5H2R1jrOQPekdq+XxKs9YunY8W4YHimtxOY3+XbMa9e65u0Kt8w0VBE1vJPSS2/XvP9mV9JsBm+Uv1NnfreyzxHfbYfbfdGU35V/ZA+sN4LXFIq3qrelga1/Oej3vBZ9VsHsLDnBrffx8TDispvJIBd+73AOWUz6M/5Ous/HS/Nr/v1by4W/se3SfEA3cS/06UMsNihSJ5V49haL/mbUYvxa79t/vzoz/KT4mEN+bBMACgJYKMP7fBfFr/zX1TRu5F1xMOa8o0qCeoAiX9pejfWsbZ041HyDZcEoDa/LVrLQLrYRCIbyh+jSgrxzGwqeYxnlS9+L/4DwB1bqJTVrpIAAAAASUVORK5CYII=" style="mix-blend-mode: multiply"/>
                                                                                    <rect x="4.25" y="120.98" width="108" height="114" rx="12.38" ry="12.38" fill="#fff"/>
                                                                                </g>
                                                                                <g>
                                                                                    <path d="M26.22,191l12.59-28.45a4.92,4.92,0,0,1,4.65-3.15h.47a4.85,4.85,0,0,1,4.59,3.15L61.12,191a4,4,0,0,1,.41,1.6,3.77,3.77,0,0,1-3.77,3.82,4,4,0,0,1-3.82-2.74L51.51,188H35.61l-2.53,5.94a3.9,3.9,0,0,1-3.66,2.48,3.66,3.66,0,0,1-3.67-3.72A4.14,4.14,0,0,1,26.22,191Zm22.35-10-5-11.93-5,11.93Z" fill="#003fae"/>
                                                                                    <path d="M65.3,188.13V188c0-6,4.59-8.83,11.15-8.83a19.65,19.65,0,0,1,6.76,1.14v-.46c0-3.26-2-5.06-5.94-5.06a18.21,18.21,0,0,0-5.42.77,3.23,3.23,0,0,1-4.38-3,3.25,3.25,0,0,1,2.11-3.05,24.08,24.08,0,0,1,8.83-1.44c4.29,0,7.38,1.13,9.35,3.09s3,5.11,3,8.83v12.6a3.77,3.77,0,0,1-3.82,3.77,3.52,3.52,0,0,1-3.77-3.26v0a10.62,10.62,0,0,1-8.36,3.51C69.58,196.59,65.3,193.6,65.3,188.13Zm18-1.81v-1.39a12.11,12.11,0,0,0-5-1c-3.36,0-5.42,1.35-5.42,3.82v.11c0,2.11,1.75,3.35,4.28,3.35C80.84,191.17,83.31,189.16,83.31,186.32Z" fill="#003fae"/>
                                                                                </g>
                                                                            </g>
                                                                            <g>
                                                                                <g>
                                                                                    <image width="169" height="177" transform="translate(224 176)" opacity="0.06" xlink:href="data:image/png;base64,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" style="mix-blend-mode: multiply"/>
                                                                                    <rect x="228.12" y="185.04" width="150" height="158.33" rx="12.38" ry="12.38" fill="#fff"/>
                                                                                </g>
                                                                                <g>
                                                                                    <path d="M332.46,237.78h-2.3v-5.13a13.25,13.25,0,0,0-13.24-13.23H289.13a13.25,13.25,0,0,0-13.24,13.23v5.13h-2.1A13.26,13.26,0,0,0,260.55,251v21.35a13.26,13.26,0,0,0,13.24,13.24h2.08v16.78a6.62,6.62,0,0,0,6.61,6.61h41a6.62,6.62,0,0,0,6.61-6.61V285.61h2.32a13.26,13.26,0,0,0,13.24-13.24V251A13.26,13.26,0,0,0,332.46,237.78Zm-51.58-5.13a8.24,8.24,0,0,1,8.23-8.22h27.77a8.24,8.24,0,0,1,8.23,8.22v5.13H280.88Zm44.25,69.78a1.61,1.61,0,0,1-1.6,1.59h-41a1.61,1.61,0,0,1-1.6-1.59V274.74h44.25Zm15.56-30a8.24,8.24,0,0,1-8.23,8.22h-2.3v-5.87h3.3a2.51,2.51,0,1,0,0-5H272.19a2.51,2.51,0,0,0,0,5h3.7v5.87h-2.1a8.24,8.24,0,0,1-8.23-8.22V251a8.25,8.25,0,0,1,8.23-8.23h58.67a8.25,8.25,0,0,1,8.23,8.23Z" fill="#003fae"/>
                                                                                    <path d="M287,287.07h31.92a2.51,2.51,0,1,0,0-5H287a2.51,2.51,0,0,0,0,5Z" fill="#003fae"/>
                                                                                    <path d="M319.07,292.31H287.14a2.51,2.51,0,1,0,0,5h31.92a2.51,2.51,0,0,0,0-5Z" fill="#003fae"/>
                                                                                    <path d="M332.4,247.62h-5.08a2.51,2.51,0,1,0,0,5h5.08a2.51,2.51,0,1,0,0-5Z" fill="#003fae"/>
                                                                                </g>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>

                                                        Modify Text & Print
                                                    </button>
                                                </div>
                                                <div class="col-6">
                                                    <button id="QRCodeCustomStepAction" type="button" class="btn btn-outline-primary" style="width: 100%; font-size: 18px; min-height: 100%;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 390 352">
                                                            <title>intercAsset 2</title>
                                                            <g style="isolation: isolate">
                                                                <g id="b81e42fe-d594-415b-b9ca-7a0a052bfef7" data-name="Layer 2">
                                                                    <g id="ba635141-f231-48fa-86bb-dcb09a1e9dd7" data-name="Layer 1">
                                                                        <path d="M61,26H316a10,10,0,0,1,10,10V284a5,5,0,0,1-5,5H56a5,5,0,0,1-5-5V36A10,10,0,0,1,61,26Z" fill="#f9f9f9"/>
                                                                        <path d="M61,25.75H316a10,10,0,0,1,10,10v23a0,0,0,0,1,0,0H51a0,0,0,0,1,0,0v-23A10,10,0,0,1,61,25.75Z" fill="#ededed"/>
                                                                        <circle cx="70" cy="42.25" r="6" fill="#e74c3c"/>
                                                                        <circle cx="89.5" cy="42" r="6" fill="#f1c40f"/>
                                                                        <circle cx="109" cy="42" r="6" fill="#2ecc71"/>
                                                                        <g>
                                                                            <image width="81" height="85" transform="translate(278)" opacity="0.06" xlink:href="data:image/png;base64,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" style="mix-blend-mode: multiply"/>
                                                                            <rect x="282.39" y="9.22" width="62.49" height="65.96" rx="12.38" ry="12.38" fill="#fff"/>
                                                                        </g>
                                                                        <rect x="138.09" y="116.82" width="34.18" height="47.38" transform="translate(-21.88 252.19) rotate(-74.4)" fill="#ededed"/>
                                                                        <path d="M192.52,94.86a5.29,5.29,0,0,0-3.67-6.5l-35.47-9.9a5.28,5.28,0,0,0-6.5,3.66L139.67,108l45.63,12.74,7.22-25.83Z" fill="#f4f4f4"/>
                                                                        <path d="M151.57,241.55l7.21-25.84L113.14,203l-7.21,25.83a5.27,5.27,0,0,0,3.67,6.49l35.47,9.91A5.29,5.29,0,0,0,151.57,241.55ZM133,220.12a4.86,4.86,0,1,1-6,3.37A4.87,4.87,0,0,1,133,220.12Z" fill="#ededed"/>
                                                                        <rect x="126.18" y="159.47" width="34.18" height="47.38" transform="translate(-71.66 271.91) rotate(-74.4)" fill="#d8d8d8"/>
                                                                        <polygon points="227.02 164.37 195.18 132.64 185.5 142.35 179.73 163.04 204.12 187.35 227.02 164.37" fill="#ededed"/>
                                                                        <path d="M251.69,139.62a5,5,0,0,0,0-7.11L227,107.88a5,5,0,0,0-7.12,0l-18,18,31.84,31.73Z" fill="#f4f4f4"/>
                                                                        <polygon points="163.86 219.89 160.82 230.79 167.79 223.8 163.86 219.89" fill="#ededed"/>
                                                                        <polygon points="197.4 194.09 176.8 173.54 166.79 209.38 174.5 217.06 197.4 194.09" fill="#d8d8d8"/>
                                                                        <polygon points="232.35 170.84 225.36 173.83 206.45 192.8 220.16 224.93 250 212.19 232.59 171.41 232.35 170.84" fill="#ededed"/>
                                                                        <path d="M284.79,191.87l-13.7-32.1a5,5,0,0,0-3.27-2.87,5.14,5.14,0,0,0-3.33.22l-23.39,10,17.65,41.34,23.39-10A5,5,0,0,0,284.79,191.87Z" fill="#f4f4f4"/>
                                                                        <path d="M159.81,239.59l-1.11,3.95a8.85,8.85,0,0,1-10.89,6.14l-7-2,2,4.75a5,5,0,0,0,3.27,2.87,5.08,5.08,0,0,0,3.33-.22l23.39-10-5.56-13Z" fill="#ededed"/>
                                                                        <polygon points="174.51 224.84 181.58 241.4 211.42 228.66 199.21 200.06 174.51 224.84" fill="#d8d8d8"/>
                                                                        <g>
                                                                            <image width="169" height="177" transform="translate(221 175)" opacity="0.06" xlink:href="data:image/png;base64,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" style="mix-blend-mode: multiply"/>
                                                                            <rect x="225.12" y="184.04" width="150" height="158.33" rx="12.38" ry="12.38" fill="#fff"/>
                                                                        </g>
                                                                        <g>
                                                                            <image width="127" height="133" transform="translate(0 104)" opacity="0.06" xlink:href="data:image/png;base64,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" style="mix-blend-mode: multiply"/>
                                                                            <rect x="4.25" y="113.98" width="108" height="114" rx="12.38" ry="12.38" fill="#fff"/>
                                                                        </g>
                                                                        <g id="62721f37-2a90-4271-a371-9de955bab665" data-name="Page-1">
                                                                            <g id="d695ee99-16ff-4e51-8cac-32bf7e3f93a4" data-name="016---Paint-Bucket">
                                                                                <path id="a382b5d9-ff95-4073-bad9-ac975582c7a2" data-name="Shape" d="M76.17,144.17H70.33C67.82,139,64.24,136,60.42,136s-7.45,3-10,8.25c-6.52.83-11.64,8.32-11.64,17.42a21.13,21.13,0,0,0,3.55,12.06,18.05,18.05,0,0,0-2.88,6c-.27,1-.47,2.09-.67,3.11a34.35,34.35,0,0,1-.8,3.56c-9.6.85-19,4.12-19,9.67S29.53,206,43.5,206,68,201.74,68,196.08c0-4.86-8-8.78-19.48-9.7.11-.79.25-1.59.4-2.38l.1-.54A29.3,29.3,0,0,1,50.17,179a10.85,10.85,0,0,0,1.5.13h24.5c7.07,0,12.83-7.85,12.83-17.5S83.24,144.17,76.17,144.17Zm-15.75-5.84c2.66,0,5.26,2.1,7.29,5.84H53.13C55.16,140.43,57.76,138.33,60.42,138.33Zm-8.75,8.17c5.79,0,10.5,6.8,10.5,15.17s-4.71,15.16-10.5,15.16a5.15,5.15,0,0,1-.56,0l.07-.15a7.27,7.27,0,0,1,3.07-2.87,8,8,0,0,0,2.22-1.86l.1-.12q.32-.37.6-.78a15.48,15.48,0,0,0,2.51-7v0a17.92,17.92,0,0,0,.15-2.31c0-7.68-4.22-12.84-8.16-12.84S43.5,154,43.5,161.67a17,17,0,0,0,2.11,8.48l-.39.36-.32.3c-.28.27-.55.55-.81.83-.06.07-.13.12-.18.19a19.25,19.25,0,0,1-2.74-10.16C41.17,153.3,45.88,146.5,51.67,146.5Zm-4.21,22.17a14.83,14.83,0,0,1-1.63-7c0-6.51,3.4-10.5,5.84-10.5s5.83,4,5.83,10.5a15.68,15.68,0,0,1-.13,2.05c0,.24-.09.47-.13.71l-1.12.37A31.77,31.77,0,0,0,47.46,168.67Zm18.21,27.41c0,3.59-9.1,7.59-22.17,7.59s-22.17-4-22.17-7.59c0-2.81,5.84-6.16,15.73-7.24-.07.13-.13.28-.21.41A5.1,5.1,0,0,1,32,192a1.15,1.15,0,0,0-.86.24,1.17,1.17,0,0,0,.61,2.08c.26,0,.52,0,.78,0a7.36,7.36,0,0,0,6.37-3.93A14.05,14.05,0,0,0,40,187.88h0a34.3,34.3,0,0,0,1.1-4.58c.2-1,.39-2,.64-3a15.46,15.46,0,0,1,3-5.87,20.53,20.53,0,0,1,3.14-3.18,26,26,0,0,1,8.7-4.17c0,.07,0,.15-.07.21l-.1.21a11.79,11.79,0,0,1-.63,1.35c-.11.2-.25.36-.37.54a9.5,9.5,0,0,1-.54.81h0l-.07.08a6.07,6.07,0,0,1-1.65,1.42,9.46,9.46,0,0,0-4,3.84c-.27.51-.52,1.08-.76,1.67A28.94,28.94,0,0,0,46.73,183l-.1.54a17.26,17.26,0,0,0-.26,7.73,6,6,0,0,0,3.76,4.14,1.17,1.17,0,1,0,.74-2.22,3.64,3.64,0,0,1-2.25-2.53,8.35,8.35,0,0,1-.25-2C59.08,189.57,65.67,193.14,65.67,196.08Zm10.5-19.25H58c3.85-3,6.46-8.68,6.46-15.16S61.89,149.52,58,146.5H68.81a37.49,37.49,0,0,1,2.59,11.91,3.51,3.51,0,1,0,2.33-.06,40.69,40.69,0,0,0-2.4-11.85h4.84c5.79,0,10.5,6.8,10.5,15.17S82,176.83,76.17,176.83Zm-3.5-16.33a1.17,1.17,0,1,1-1.17,1.17A1.16,1.16,0,0,1,72.67,160.5Z" fill="#003fae"/>
                                                                                <path id="e349ced2-4152-4c5d-b9d2-dbd00ad1878c" data-name="Shape" d="M44.54,199c-9.93,1.1-15.55-2.15-15.61-2.18a1.17,1.17,0,0,0-1.2,2c.22.13,4.68,2.74,12.71,2.74a39.81,39.81,0,0,0,4.36-.24,1.19,1.19,0,0,0,.94-.69,1.2,1.2,0,0,0-.13-1.16A1.16,1.16,0,0,0,44.54,199Z" fill="#003fae"/>
                                                                            </g>
                                                                        </g>
                                                                        <g>
                                                                            <path d="M305.38,47.35a2.8,2.8,0,0,0-3.93.44,2.77,2.77,0,0,0,.45,3.91,2.81,2.81,0,0,0,3.92-.44,2.76,2.76,0,0,0,.6-2A2.71,2.71,0,0,0,305.38,47.35Zm-.55,3.11a1.52,1.52,0,0,1-1.19.57,1.54,1.54,0,0,1-.95-.33,1.51,1.51,0,0,1-.57-1,1.46,1.46,0,0,1,.33-1.1,1.52,1.52,0,0,1,1.19-.57,1.48,1.48,0,0,1,.95.33,1.5,1.5,0,0,1,.24,2.11Z" fill="#003fae"/>
                                                                            <path d="M316.59,40.82A2.78,2.78,0,0,0,319.23,39a2.74,2.74,0,0,0-.13-2.12,2.81,2.81,0,0,0-2.52-1.57,2.69,2.69,0,0,0-1.21.28,2.77,2.77,0,0,0-1.31,3.71A2.84,2.84,0,0,0,316.59,40.82Zm-1.45-3.27a1.5,1.5,0,0,1,.78-.86,1.52,1.52,0,0,1,.66-.15,1.55,1.55,0,0,1,1.38.85,1.5,1.5,0,0,1,.06,1.14,1.53,1.53,0,0,1-.77.87,1.67,1.67,0,0,1-.66.15,1.54,1.54,0,0,1-1.38-.86A1.5,1.5,0,0,1,315.14,37.55Z" fill="#003fae"/>
                                                                            <path d="M309.65,36.32a3.38,3.38,0,0,0,.63.07,2.78,2.78,0,0,0,.62-5.49,2.7,2.7,0,0,0-.63-.07A2.77,2.77,0,0,0,307.55,33a2.75,2.75,0,0,0,.35,2.09A2.81,2.81,0,0,0,309.65,36.32Zm-.86-3a1.51,1.51,0,0,1,1.48-1.17,2,2,0,0,1,.34,0,1.54,1.54,0,0,1,1,.67,1.5,1.5,0,0,1,.19,1.13,1.53,1.53,0,0,1-1.48,1.17,1.39,1.39,0,0,1-.35,0,1.52,1.52,0,0,1-.95-.67A1.5,1.5,0,0,1,308.79,33.27Z" fill="#003fae"/>
                                                                            <path d="M304.59,37.91a2.78,2.78,0,0,0,1-1.87,2.69,2.69,0,0,0-.59-2,2.77,2.77,0,0,0-2.19-1,2.83,2.83,0,0,0-1.74.61,2.78,2.78,0,0,0,1.75,4.95A2.82,2.82,0,0,0,304.59,37.91Zm-2.94-1.24a1.54,1.54,0,0,1-.32-1.11,1.54,1.54,0,0,1,2.71-.77,1.54,1.54,0,0,1,.32,1.11,1.51,1.51,0,0,1-1.51,1.34A1.54,1.54,0,0,1,301.65,36.67Z" fill="#003fae"/>
                                                                            <path d="M330.65,31.67a.83.83,0,0,0-.61-.25c-.37,0-1.33,0-7.2,5l-.35.3a15.69,15.69,0,0,0-14.64-10h0a15.4,15.4,0,0,0-7.3,2.1c-2.7,1.59-4.18,3.71-4.18,6,0,2.73,1.54,3.87,2.78,4.79,1,.75,1.81,1.35,1.81,2.64s-.8,1.89-1.81,2.64c-1.23.92-2.78,2.06-2.78,4.8,0,2.26,1.49,4.39,4.19,6a15.42,15.42,0,0,0,7.3,2.11h0a15.63,15.63,0,0,0,11.05-4.54,15.39,15.39,0,0,0,4.58-10.8c1-1.13,1.94-2.25,2.82-3.3,1.5-1.81,2.65-3.3,3.42-4.43C330.77,33.15,331.22,32.23,330.65,31.67ZM318,52.27a14.32,14.32,0,0,1-10.15,4.17h0c-4.11,0-10.21-2.86-10.21-6.8,0-2.1,1.1-2.91,2.26-3.78s2.33-1.72,2.33-3.66-1.24-2.85-2.33-3.66-2.27-1.68-2.27-3.78c0-2.42,2.23-4.09,3.56-4.87A14.2,14.2,0,0,1,307.85,28h0a14.36,14.36,0,0,1,13.6,9.64c-2.76,2.42-5.75,5.2-8,7.44-3.71.48-4.21,2.94-4.58,4.76-.31,1.54-.52,2.29-1.71,2.38a.64.64,0,0,0-.19,1.23,11.75,11.75,0,0,0,4,.77h0A6.07,6.07,0,0,0,317.35,49c1.46-1.48,3.13-3.25,4.77-5.09A14.06,14.06,0,0,1,318,52.27Zm-1.95-3.38a4.79,4.79,0,0,1-5.05,4h0a9.62,9.62,0,0,1-2-.22,5.07,5.07,0,0,0,1.08-2.64c.35-1.72.68-3.35,3.39-3.74Zm8.81-10.07c-2.53,3-5.59,6.39-8.11,9l-.39-.39-1.72-1.74c2.29-2.27,5.21-5,7.95-7.35h0c.31-.28.63-.55.94-.81a49.06,49.06,0,0,1,5.68-4.4A47.84,47.84,0,0,1,324.88,38.82Z" fill="#003fae"/>
                                                                        </g>
                                                                        <path d="M341.77,219.44c-2.58-2.59-7.76-1.11-16.29,4.63A176.25,176.25,0,0,0,301,244.89c-12.66,12.66-22.29,25.1-25.49,32.77a11.35,11.35,0,0,0-1.64-.45,12.85,12.85,0,0,0-9.89,2.3,14.41,14.41,0,0,0-5.55,8.11,23.64,23.64,0,0,1-4.9,9.23,2.11,2.11,0,0,0,.19,2.94,16,16,0,0,0,10.74,4,19.42,19.42,0,0,0,11.26-3.74,22.47,22.47,0,0,0,3.12-2.71,13.45,13.45,0,0,0,3.6-11.19c7.53-2.7,20.66-12.68,33.9-25.92a176.25,176.25,0,0,0,20.82-24.5C342.88,227.2,344.36,222,341.77,219.44Zm-66,75a17.62,17.62,0,0,1-2.48,2.16c-4.87,3.48-10.84,3.89-15.18,1.21a27.87,27.87,0,0,0,4.41-9.19h0a.36.36,0,0,0,0-.11,10.29,10.29,0,0,1,3.89-5.61,8.67,8.67,0,0,1,6.63-1.6,6.48,6.48,0,0,1,4.27,2.9C279.16,287.19,278.51,291.5,275.74,294.47ZM281,282.21a7.92,7.92,0,0,0-1.87-2.33,50.35,50.35,0,0,1,6.29-10.67l6.59,6.58C287.37,279.13,283.57,281.3,281,282.21Zm14.41-9L288,265.81q1.94-2.47,4.16-5.12l8.4,8.41C298.74,270.6,297,272,295.4,273.25ZM333,234.33a176.08,176.08,0,0,1-19.66,22.92c-3.33,3.34-6.57,6.37-9.64,9.09l-8.83-8.83c2.8-3.17,5.85-6.43,9.08-9.65a176.86,176.86,0,0,1,22.92-19.66c8.43-5.83,11.33-5.84,11.89-5.76C338.85,223,338.84,225.91,333,234.33Z" fill="#003fae"/>
                                                                        <path d="M274,288.79a2.11,2.11,0,0,0-2.85.83,1.54,1.54,0,0,1-.21.29,9.32,9.32,0,0,1-1.21,1,7.73,7.73,0,0,1-2.61,1.24,2.1,2.1,0,0,0,.53,4.14,2.5,2.5,0,0,0,.54-.07,12.27,12.27,0,0,0,4-1.89,17.54,17.54,0,0,0,1.84-1.6,5.5,5.5,0,0,0,.81-1.12A2.1,2.1,0,0,0,274,288.79Z" fill="#003fae"/>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>

                                                        Customize Colors
                                                        <br>
                                                        <span style="width: 100%; font-size: 14px;">Change the look & feel of the Scan Code</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div id="QRCodeDefaultStepCard" class="card" style="margin-top: 30px; display: none;">
                                <div class="card-content" >
                                    <div class="qr-code-loading" style="display: none;">
                                        <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                                    </div>
                                    <div class="card-header" style="position: relative;">
                                        <h5 class="card-title" id="exampleModalLabel">QRCode PDF</h5>
                                        <button type="button" class="btn btn-outline-primary button-back" style="position: absolute; right: 20px; top: 20px;">
                                            Back
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-2">
                                                    <p style="margin-bottom: 7px;">One Text Color</p>
                                                    <label for="one-text-color" style="float: left; display: inline-block; width: 35px; height: 35px; margin: 0; border: 1px solid #000000; border-right: none;" id="style-one-text-color"></label>
                                                    <input style="width: 120px;display: inline-block; height: 35px; padding: 5px; border: 1px solid #000000; border-left: none; outline: none;" id="one-text-color" class="jscolor {zIndex: 9000, styleElement:'style-one-text-color'}" name="one_text_color" value="000000" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>
                                                        {!! trans('fields.label.qr_code_title_one_size') !!}
                                                        <input step="0.1" min="1" max="6" style="margin-top: 5px;" type="number" class="form-control" name="qr_code_title_one_size" placeholder="" value="3" />
                                                    </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>
                                                        {!! trans('fields.label.qr_code_title_one') !!}
                                                        <input style="margin-top: 5px;" type="text" class="form-control" name="qr_code_title_one" placeholder="" value="Scan & Apply" />
                                                    </label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <p style="margin-bottom: 7px;">Two Text Color</p>
                                                    <label for="two-text-color" style="float: left; display: inline-block; width: 35px; height: 35px; margin: 0; border: 1px solid #000000; border-right: none;" id="style-two-text-color"></label>
                                                    <input style="width: 120px;display: inline-block; height: 35px; padding: 5px; border: 1px solid #000000; border-left: none; outline: none;" id="two-text-color" class="jscolor {zIndex: 9000, styleElement:'style-two-text-color'}" name="two_text_color" value="000000" />
                                                </div>
                                                <div class="col-lg-2">
                                                    <label>
                                                        {!! trans('fields.label.qr_code_title_two_size') !!}
                                                        <input step="0.1" min="1" max="6" style="margin-top: 5px;" type="number" class="form-control" name="qr_code_title_two_size" placeholder="" value="3" />
                                                    </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <label>
                                                        {!! trans('fields.label.qr_code_title_two') !!}
                                                        <input style="margin-top: 5px;" type="text" class="form-control" name="qr_code_title_two" placeholder="" value="Scan & Apply" />
                                                    </label>
                                                </div>
                                                <div class="col-lg-12" style="margin-top: 5px;">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="clearfix selector-setting-block" style="display: none;">
                                                                <p style="margin-bottom: 10px;">{!! trans('fields.label.qr_code_settings') !!}</p>
                                                                <select name="selector-setting" style="width: 230px;"></select>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 text-right">
                                                            {{--                                    <button type="button" class="btn btn-primary button-refresh-pdf" >--}}
                                                            {{--                                        Refresh PDF--}}
                                                            {{--                                    </button>--}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12" style="margin-top: 15px;">
                                                    <div class="qr-code text-center">
                                                        <object width="820" height="1200" type="application/pdf" data=""></object>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div id="QRCodeCustomStepCard" class="card" style="margin-top: 30px; display: none;">
                                <div class="card-content ">
                                    <div class="qr-code-loading" style="display: none;">
                                        <i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i>
                                    </div>
                                    <div class="card-header" style="position: relative;">
                                        <h5 class="card-title" id="exampleModalLabel">QRCode Custom</h5>
                                        <button type="button" class="btn btn-outline-primary button-back" style="position: absolute; right: 20px; top: 20px;">
                                            Back
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="container" style="max-width: 100%;padding: 0;">
                                            <div class="row justify-content-center">
                                                <div class="col-lg-4">
                                                    <div class="d-inline-block bg-light px-5 pt-4 pb-3 mb-4 business-pic-view text-center">
                                                        <input name="logo" type="file" style="display: none;">
                                                        <img class=" img-thumbnail" alt="Your business logo"
                                                             style="width: 100%; height: auto;"
                                                             src="{{ asset('img/jm_logo.png') }}">
                                                        <div class="mt-3 bg-white">
                                                            <button id="business-pic-change-btn" type="button"
                                                                    class="btn btn-outline-primary">
                                                                <div class="button__content flex__flex-row">{!! trans('main.buttons.change_logo') !!}</div>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {{--                            <div class="clearfix" style="margin-bottom: 15px;">--}}
                                                    {{--                                <p style="margin-bottom: 10px;">Background color</p>--}}
                                                    {{--                                <label for="backgroundColor" style="float: left; display: inline-block; width: 35px; height: 35px; margin: 0; border: 1px solid #000000; border-right: none;" id="styleBackgroundColor"></label>--}}
                                                    {{--                                <input style="height: 35px; padding: 5px; border: 1px solid #000000; border-left: none; outline: none;" id="backgroundColor" class="jscolor {zIndex: 9000, styleElement:'styleBackgroundColor'}" name="backgroundColor" value="000000" />--}}
                                                    {{--                            </div>--}}
                                                    <div class="clearfix" style="margin-bottom: 15px;">
                                                        <p style="margin-bottom: 10px;">Single color</p>
                                                        <label for="singleColor" style="float: left; display: inline-block; width: 35px; height: 35px; margin: 0; border: 1px solid #000000; border-right: none;" id="styleSingleColor"></label>
                                                        <input style="height: 35px; padding: 5px; border: 1px solid #000000; border-left: none; outline: none;" id="singleColor" class="jscolor {zIndex: 9000, styleElement:'styleSingleColor'}" name="singleColor" value="000000" />
                                                    </div>
                                                    <div class="clearfix" style="margin-bottom: 15px;">
                                                        <p style="margin-bottom: 10px;">Eye out color</p>
                                                        <label for="outEyeColor" style="float: left; display: inline-block; width: 35px; height: 35px; margin: 0; border: 1px solid #000000; border-right: none;" id="styleOutEyeColor"></label>
                                                        <input style="height: 35px; padding: 5px; border: 1px solid #000000; border-left: none; outline: none;" id="outEyeColor" class="jscolor {zIndex: 9000, styleElement:'styleOutEyeColor'}" name="outEyeColor" value="000000" />
                                                    </div>
                                                    <div class="clearfix" style="margin-bottom: 15px;">
                                                        <p style="margin-bottom: 10px;">Eye inner color</p>
                                                        <label for="innerEyeColor" style="float: left; display: inline-block; width: 35px; height: 35px; margin: 0; border: 1px solid #000000; border-right: none;" id="styleInnerEyeColor"></label>
                                                        <input style="height: 35px; padding: 5px; border: 1px solid #000000; border-left: none; outline: none;" id="innerEyeColor" class="jscolor {zIndex: 9000, styleElement:'styleInnerEyeColor'}" name="innerEyeColor" value="000000" />
                                                    </div>
                                                    <div class="clearfix selector-setting-block" style="display: none;">
                                                        <p style="margin-bottom: 10px;">{!! trans('fields.label.qr_code_settings') !!}</p>
                                                        <select name="selector-setting" style="width: 230px;"></select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="qr-code" style="width: 600px; height: 600px;"></div>
                                                    <div class="col-lg-12" style="margin-top: 25px;">
                                                        <div class="row">
                                                            <div class="col-lg-6">

                                                            </div>
                                                            <div class="col-lg-8 text-right">
                                                                <button type="button" class="btn btn-primary button-save-setting" style="margin-right: 15px;" >
                                                                    Save setting
                                                                </button>
                                                                <button type="button" class="btn btn-primary button-reset-svg" style="margin-right: 15px;">
                                                                    Reset SVG
                                                                </button>
                                                                <button type="button" class="btn btn-primary button-download-svg" >
                                                                    Download SVG
                                                                </button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12" id="avatar-block" style="display: none;">
                                                    <div class="row">
                                                        <div class="col-md-9">
                                                            <div class="avatar-wrapper"></div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="row avatar-btns">
                                                                <div class="col-md-12">
                                                                    <button type="button" class="btn btn-primary btn-block avatar-save">{!! trans('main.buttons.save') !!}</button>
                                                                </div>
                                                            </div>
                                                            <div class="row avatar-btns">
                                                                <div class="col-md-12">
                                                                    <button type="button" class="btn btn-primary btn-block avatar-close">{!! trans('main.buttons.close') !!}</button>
                                                                </div>
                                                            </div>
                                                            <p>{!! trans('modals.text.size_previews') !!}</p>
                                                            <div class="avatar-preview preview-lg">
                                                            </div>
                                                            <div class="avatar-preview preview-md">
                                                            </div>
                                                            <div class="avatar-preview preview-sm">
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
    </div>

    <div class="modal fade bd-example-modal-lg" style="z-index: 9999;" id="QRCodeCustomSaveTemplateStepModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel" style="width: 100%;">
                        Save template
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="{!! trans('main.buttons.close') !!}">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <label class="form-group">
                                    Name:
                                    <input name="name_template" class="form-control">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center bg-light">
                    <div class="bg-white">
                        <button type="button" class="btn btn-outline-warning"
                                data-dismiss="modal" aria-label="{!! trans('main.buttons.close') !!}">
                            {!! trans('main.buttons.close') !!}
                        </button>
                        <button type="button" class="btn btn-outline-primary button-save-template">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('/js/jscolor.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/cropper.min.js?v='.time()) }}"></script>
    <script src="{{ asset('/js/app/qr-code-functions.js?v='.time()) }}"></script>

    <script type="application/javascript">
        jQuery(document).ready(function ($) {
            GlobalQRCodeFunc = new QRCodeFunc(GlobalQRCodeType.scanner);
        });
    </script>
@endsection
