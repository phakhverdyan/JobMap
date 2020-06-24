
<div class="modal fade" id="questionnaireModalResult" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="logoutModalLabel">{!! trans('modals.title.questionnaire') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--<p>
                    <button class="btn btn-outline-primary">Filter</button>
                </p>--}}
                <div>
                    <div class="mb-3">
                        <div class="d-flex">
                            <div class="align-self-center mr-2">
                                <img id="candidate-questions_business-picture" src="{{ url('/') }}/business/3/50.50.4b223c47ecfcce40d93f6e4fb513f3c0.jpg?v=96183" width="60px" height="60px" class="rounded">
                            </div>
                            <div class="align-self-center">
                                <p class="mb-0 h4" id="candidate-questions_business-title" ></p>
                                <p class="mb-0" id="candidate-questions_job-title"></p>
                                <p class="mb-0" id="candidate-questions_location-title"></p>

                            </div>
                        </div>
                    </div>
                    <!-- ONE ANSWER-->
                    <div class="mb-3 p-3" id="candidate-questions_block-questions-question-clone" style="display: none">
                        <p class="mb-1 h5 question"></p>
                        <p class="mb-0 pl-3 answer"></p>
                        <hr>
                    </div>
                    <!-- ONE ANSWER EOF -->
                    <div class="col-12 px-0" id="candidate-questions_block-questions">

                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center bg-light">
                <div class="col-md-4 mx-auto">
                    <button class="btn btn-success btn-block" data-dismiss="modal">{!! trans('modals.buttons.ok') !!}</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="questionnaireModalResultNull" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="logoutModalLabel">{!! trans('modals.title.questionnaire') !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{--<p>
                    <button class="btn btn-outline-primary">Filter</button>
                </p>--}}
                <div>
                    <div class="mb-3">
                        <p>{!! trans('modals.text.no_question') !!}</p>
                    </div>

                </div>
            </div>

            <div class="modal-footer justify-content-center bg-light">
                <div class="col-md-4 mx-auto">
                    <button class="btn btn-success btn-block" data-dismiss="modal">{!! trans('modals.buttons.ok') !!}</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="questionnaireModalRun" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div id="no-click" class="modal fade show" tabindex="-1" role="dialog" style="overflow: auto; display: block; z-index: -1"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px; top:10px;">
                    <span aria-hidden="true">&times;</span>
                </button>--}}
                <p class="mt-3" style="font-size: 18px; font-weight: 500;">{!! trans('modals.title.question') !!}</p>
                
                <div>

                    <div class="col-12 px-0">
                        <!-- ONE ANSWER-->
                        <div class="mb-3 p-3">
                            <p class="mb-2" style="font-weight: 500;" id="job-question__question">Question yes/no</p>
                            <p class="mb-0" style="display: none" id="job-question__answer">
                                <input type="text" name="answer" placeholder="{!! trans('modals.text.answer_here') !!}" class="form-control">
                            </p>
                            <p class="mb-0" style="display: none" id="job-question__answer_radio">
                                <label>{!! trans('modals.answer.yes') !!}</label>
                                <input type="radio" name="answer" value="yes" class="form-control">
                                <label>{!! trans('modals.answer.no') !!}</label>
                                <input type="radio" name="answer" value="no" class="form-control">
                            </p>
                        </div>
                        <!-- ONE ANSWER EOF -->

                    </div>

                </div>
            </div>

            <div class="modal-footer justify-content-between bg-light">
                <div class="align-self-center">
                    <button type="button" class="btn btn-outline-primary px-3" id="job-question__btn-prev">{!! trans('modals.buttons.back') !!}</button>
                </div>
                <div class="align-self-center">
                    <button type="button" class="btn btn-primary px-3" id="job-question__btn-next">{!! trans('modals.buttons.next') !!}</button>
                </div>
                <div class="align-self-center">
                    <button type="button" class="btn btn-primary px-3" id="job-question__btn-finish">{!! trans('modals.buttons.finish') !!}</button>
                </div>
            </div>
            
        </div>
    </div>
</div>
