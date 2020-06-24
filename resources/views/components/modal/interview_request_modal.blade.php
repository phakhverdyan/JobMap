<!--[ Interview request MODAL ]-->
<form class="modal fade" id="interview-request-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 pt-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28"
                         style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                         xml:space="preserve" width="20px" height="18px" data-toggle="tooltip"
                         data-placement="top" title="Candidate Notes" fill="#4E5C6E">
                        <g>
                            <g>
                                <path style=""
                                      d="M24,11.518V0H0v24h11.518c1.614,2.411,4.361,3.999,7.482,4c4.971-0.002,8.998-4.029,9-9    C27.999,15.879,26.411,13.132,24,11.518z M11.517,14c-0.412,0.616-0.743,1.289-0.994,2H4v2h6.058C10.022,18.329,10,18.661,10,19    c0,1.055,0.19,2.061,0.523,3H2V2h20v8.523C21.061,10.19,20.055,10,19,10c-2.143,0-4.107,0.751-5.652,2H4v2H11.517z M19,25.883    c-3.801-0.009-6.876-3.084-6.885-6.883c0.009-3.801,3.084-6.876,6.885-6.884c3.799,0.008,6.874,3.083,6.883,6.884    C25.874,22.799,22.799,25.874,19,25.883z"/>
                                <polygon style="" points="20,8 4,8 4,10 19,10 20,10   "/>
                                <polygon style=""
                                         points="20.002,18 20.002,14 18,14 18,18 14,18 14,20 18,20 18,24 20.002,24 20.002,20 24,20     24,18   "/>
                            </g>
                        </g>
                    </svg>
                    <span class="modal-title" id="interview-request-modal__title">{!! trans('modals.interview_request.send_interview_request') !!}</span>
                </h5>
                <button type="button" class="close pt-0 mt-0" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0 pb-3">
                <div class="d-flex px-3">
                    <div style="width: 80px;">
                        <div style="width: 40px; border-radius: 5px">
                            <img class="mr-3 user-logo-modal"
                                 src="{{ asset('img/profilepic2.png') }}"
                                 style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">
                        </div>
                        <img class="business-logo-modal"
                             src="{{ asset('img/business-logo-small.png') }}"
                             style="width: 20px; height: 20px; background-color: transparent;">
                    </div>
                    <div class="w-100">
                        <p class="mb-0"><strong class="user-name-modal"></strong></p>
                        <p class="text-right pt-2 mb-0">
                            <div class="form-group">
                                <label for="interview-request-modal__type">{!! trans('modals.interview_request.interview_type') !!}</label>
                                <select name="type" class="form-control" id="interview-request-modal__type">
                                    <option value="in_person">{!! trans('modals.interview_request.type.in_person') !!}</option>
                                    <option value="via_phone">{!! trans('modals.interview_request.type.via_phone') !!}</option>
                                    <option value="via_skype_voice">{!! trans('modals.interview_request.type.via_skype_voice') !!}</option>
                                    <option value="via_skype_video">{!! trans('modals.interview_request.type.via_skype_video') !!}</option>
                                    <option value="via_im">{!! trans('modals.interview_request.type.via_im') !!}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="interview-request-modal__address">{!! trans('modals.interview_request.address') !!}</label>
                                <input type="text" name="address" class="form-control" id="interview-request-modal__address">
                            </div>
                            <div class="form-group">
                                <label for="interview-request-modal__messenger-identifier">{!! trans('modals.interview_request.messenger_identifier') !!}</label>
                                <input type="text" name="messenger_identifier" class="form-control" id="interview-request-modal__messenger-identifier">
                            </div>
                            <div class="form-group">
                                <label for="interview-request-modal__phone-number">{!! trans('modals.interview_request.phone_number') !!}</label>
                                <input type="text" name="phone_number" class="form-control" id="interview-request-modal__phone-number">
                            </div>
                            <div class="form-group">
                                <label for="interview-request-modal__interviewer-name">{!! trans('modals.interview_request.interview_name') !!}</label>
                                <input type="text" name="interviewer_name" class="form-control" id="interview-request-modal__interviewer-name">
                            </div>
                            <div class="form-group">
                                <label for="interview-request-modal__date">{!! trans('modals.interview_request.interview_data') !!}</label>
                                <div class="input-group date" id="interview-request-modal__date" data-target-input="nearest">
                                    <input type="text" name="date" class="form-control datetimepicker-input" data-target="#interview-request-modal__date">
                                    <div class="input-group-addon" data-target="#interview-request-modal__date" data-toggle="datetimepicker">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <button class="btn btn-success btn-block" data-dismiss="modal" id="interview-request-modal__button">{!! trans('modals.interview_request.send_interview_request') !!}</button>
            </div>
        </div>
    </div>
    <input type="hidden" name="with_user_id" value="0" id="interview-request-modal__user-id">
    <input type="hidden" name="with_business_id" value="0" id="interview-request-modal__business-id">
    <input type="hidden" name="id" value="0" id="interview-request-modal__id">
</form>
<form class="modal fade" id="interview-request-moving-to-pipeline-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 pt-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28"
                         style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                         xml:space="preserve" width="20px" height="18px" data-toggle="tooltip"
                         data-placement="top" title="Candidate Notes" fill="#4E5C6E">
                        <g>
                            <g>
                                <path style=""
                                      d="M24,11.518V0H0v24h11.518c1.614,2.411,4.361,3.999,7.482,4c4.971-0.002,8.998-4.029,9-9    C27.999,15.879,26.411,13.132,24,11.518z M11.517,14c-0.412,0.616-0.743,1.289-0.994,2H4v2h6.058C10.022,18.329,10,18.661,10,19    c0,1.055,0.19,2.061,0.523,3H2V2h20v8.523C21.061,10.19,20.055,10,19,10c-2.143,0-4.107,0.751-5.652,2H4v2H11.517z M19,25.883    c-3.801-0.009-6.876-3.084-6.885-6.883c0.009-3.801,3.084-6.876,6.885-6.884c3.799,0.008,6.874,3.083,6.883,6.884    C25.874,22.799,22.799,25.874,19,25.883z"/>
                                <polygon style="" points="20,8 4,8 4,10 19,10 20,10   "/>
                                <polygon style=""
                                         points="20.002,18 20.002,14 18,14 18,18 14,18 14,20 18,20 18,24 20.002,24 20.002,20 24,20     24,18   "/>
                            </g>
                        </g>
                    </svg>
                    <span class="modal-title">{!! trans('modals.interview_request.moving_to_pipeline') !!}</span>
                </h5>
                <button type="button" class="close pt-0 mt-0" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0 pb-3">
                <div class="d-flex px-3">
                    <div class="w-100">
                        <p class="pt-2 mb-0">
                            {!! trans('modals.interview_request.do_you_want_to_move') !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <button class="btn btn-success btn-block mt-0" data-dismiss="modal" id="interview-request-moving-to-pipeline-modal__yes">{!! trans('modals.interview_request.yes') !!}</button>
                <button class="btn btn-danger btn-block mt-0" data-dismiss="modal" id="interview-request-moving-to-pipeline-modal__no">{!! trans('modals.interview_request.no') !!}</button>
            </div>
        </div>
    </div>
</form>
<form class="modal fade" id="interview-request-finishing-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0 pt-0">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         xmlns:xlink="http://www.w3.org/1999/xlink"
                         version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 28 28"
                         style="enable-background:new 0 0 28 28; vertical-align: middle; margin-bottom: 3px;"
                         xml:space="preserve" width="20px" height="18px" data-toggle="tooltip"
                         data-placement="top" title="Candidate Notes" fill="#4E5C6E">
                        <g>
                            <g>
                                <path style=""
                                      d="M24,11.518V0H0v24h11.518c1.614,2.411,4.361,3.999,7.482,4c4.971-0.002,8.998-4.029,9-9    C27.999,15.879,26.411,13.132,24,11.518z M11.517,14c-0.412,0.616-0.743,1.289-0.994,2H4v2h6.058C10.022,18.329,10,18.661,10,19    c0,1.055,0.19,2.061,0.523,3H2V2h20v8.523C21.061,10.19,20.055,10,19,10c-2.143,0-4.107,0.751-5.652,2H4v2H11.517z M19,25.883    c-3.801-0.009-6.876-3.084-6.885-6.883c0.009-3.801,3.084-6.876,6.885-6.884c3.799,0.008,6.874,3.083,6.883,6.884    C25.874,22.799,22.799,25.874,19,25.883z"/>
                                <polygon style="" points="20,8 4,8 4,10 19,10 20,10   "/>
                                <polygon style=""
                                         points="20.002,18 20.002,14 18,14 18,18 14,18 14,20 18,20 18,24 20.002,24 20.002,20 24,20     24,18   "/>
                            </g>
                        </g>
                    </svg>
                    <span class="modal-title">{!! trans('modals.interview_request.finish_the_interview') !!}</span>
                </h5>
                <button type="button" class="close pt-0 mt-0" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-0 pb-3">
                <div class="d-flex px-3">
                    <div class="w-100">
                        <p class="pt-2 mb-0">
                            {!! trans('modals.interview_request.resulting_notes') !!}
                        </p>
                        <p class="text-right pt-2 mb-0">
                            <div class="form-group">
                                <label for="interview-request-finishing-modal__internal-description">{!! trans('modals.interview_request.internal_description') !!}</label>
                                <textarea name="address" class="form-control" id="interview-request-finishing-modal__internal-description"></textarea>
                                <small class="form-text text-muted">{!! trans('modals.interview_request.applicants_will_not_see_text') !!}</small>
                            </div>
                        </p>
                        <p class="text-right pt-2 mb-0">
                            <div class="form-group">
                                <label for="interview-request-finishing-modal__external-description">{!! trans('modals.interview_request.external_description') !!}</label>
                                <textarea name="address" class="form-control" id="interview-request-finishing-modal__external-description"></textarea>
                                <small class="form-text text-muted">{!! trans('modals.interview_request.text_will_be_shown') !!}</small>
                            </div>
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-light">
                <button class="btn btn-success btn-block mt-0" data-dismiss="modal" id="interview-request-finishing-modal__finish">{!! trans('modals.interview_request.finish') !!}</button>
            </div>
        </div>
    </div>
</form>
@push('scripts')
    <script>
        $(function() {
            var update_type_dependencies = function() {
                var type = $('#interview-request-modal__type').val();

                if (type == 'in_person') {
                    $('#interview-request-modal__address').parent().show();
                    $('#interview-request-modal__messenger-identifier').parent().hide();
                }
                else if (type == 'via_phone') {
                    $('#interview-request-modal__address').parent().hide();
                    $('#interview-request-modal__messenger-identifier').parent().hide();
                }
                else if (type == 'via_skype_voice' || type == 'via_skype_video') {
                    $('#interview-request-modal__address').parent().hide();
                    $('#interview-request-modal__messenger-identifier').siblings('label').text('Skype username:');
                    $('#interview-request-modal__messenger-identifier').parent().show();
                }
                else if (type == 'via_im') {
                    $('#interview-request-modal__address').parent().hide();
                    $('#interview-request-modal__messenger-identifier').siblings('label').text('IM username:');
                    $('#interview-request-modal__messenger-identifier').parent().show();
                }
                else {
                    $('#interview-request-modal__address').parent().hide();
                    $('#interview-request-modal__messenger-identifier').parent().hide();
                }
            };

            $('#interview-request-modal__type').change(function() {
                update_type_dependencies();
            });

            $('#interview-request-modal__date').datetimepicker({
                widgetPositioning: {
                    vertical: 'top',
                },
            });

            var createInterviewRequest = function(data, done) {
                // Loader.disabled = true;

                return new GraphQL('mutation', 'createInterviewRequest', {
                    previous_interview_request_id:  data.previous_interview_request_id || 0,
                    with_user_id:                   data.with_user_id || 0,
                    with_business_id:               data.with_business_id || 0,
                    business_id:                    data.business_id || 0,

                    type:                           data.type || '',
                    address:                        data.address || '',
                    phone_number:                   data.phone_number || '',
                    messenger_identifier:           data.messenger_identifier || '',
                    interviewer_name:               data.interviewer_name || '',
                    date:                           data.date,
                }, [
                    'id',
                    'user_id',
                    'type',
                    'address',
                    'phone_number',
                    'messenger_identifier',
                    'interviewer_name',
                    'state',
                ], true, false, function() {
                    // Loader.disabled = false;
                    Loader.stop();
                }, function(response) {
                    // Loader.disabled = false;
                    return done && done(response);
                }, false).request();
            };

            var initialize = function(data) {
                data = data || {};
                
                if (data.type) {
                    $('#interview-request-modal__type').val(data.type);
                }

                if (data.phone_number) {
                    $('#interview-request-modal__phone-number').val(data.phone_number);
                }

                if (data.address) {
                    $('#interview-request-modal__address').val(data.address);
                }

                if (data.interviewer_name) {
                    $('#interview-request-modal__interviewer-name').val(data.interviewer_name);
                }

                if (data.date) {
                    $('#interview-request-modal__date input').val(moment(data.date).format($('#interview-request-modal__date').data('datetimepicker').actualFormat));
                }

                var global_business_id = 0;

                if (window.location.pathname.indexOf('/business') === 0) {
                    global_business_id = parseInt(APIStorage.read('business-id')) || 0;
                }

                $('#interview-request-modal__type').prop('disabled', global_business_id ? false : true);
                $('#interview-request-modal__address').prop('disabled', global_business_id ? false : true);
                $('#interview-request-modal__messenger-identifier').prop('disabled', global_business_id ? false : true);
                $('#interview-request-modal__phone-number').prop('disabled', global_business_id ? false : true);
                $('#interview-request-modal__interviewer-name').prop('disabled', global_business_id ? false : true);

                $('#interview-request-modal__user-id').val(data.user_id);
                $('#interview-request-modal__business-id').val(data.business_id);
                $('#interview-request-modal__id').val(data.id);
                update_type_dependencies();
            };

            $('#interview-request-modal').data({
                initialize:                 initialize,
            });

            $(document).on('click', '#interview-request-modal__button', function(event) {
                event.preventDefault();
                event.stopPropagation();
                var business_id = 0;

                if (window.location.pathname.indexOf('/business') === 0) {
                    business_id = parseInt(APIStorage.read('business-id')) || 0;
                }

                var data = $('#interview-request-modal').serializeArray().reduce(function(data, field) {
                    data[field.name] = field.value;
                    return data;
                }, {});

                console.log(data);

                return createInterviewRequest({
                    previous_interview_request_id:  data.id,
                    business_id:                    business_id,
                    with_user_id:                   parseInt(data.with_user_id) || 0,
                    with_business_id:               parseInt(data.with_business_id) || 0,

                    type:                           data.type,
                    address:                        data.address,
                    phone_number:                   data.phone_number,
                    messenger_identifier:           data.messenger_identifier,
                    interviewer_name:               data.interviewer_name,
                    date:                           data.date,
                }, function(data) {
                    $('#interview-request-modal').modal('hide');
                    $('#send-message').modal('hide');
                    $.notify('Interview request sent!', 'success');

                    // if (business_id) {
                    //     new GraphQL('query', 'pipeline', {
                    //         'business_id': business_id,
                    //     }, [
                    //         'items{' + [
                    //             'id',
                    //             'name',
                    //             'type',
                    //         ].join(' ') + '}',
                    //
                    //         'token',
                    //     ], true, false, function() {
                    //         Loader.stop();
                    //     }, function(second_data) {
                    //         var pipeline = '';
                    //
                    //         second_data.items.some(function(current_pipeline) {
                    //             if (current_pipeline.type == 'to_interview') {
                    //                 pipeline = 'to_interview';
                    //                 return true;
                    //             }
                    //
                    //             if (current_pipeline.name == 'To interview') {
                    //                 pipeline = current_pipeline.id;
                    //                 return true;
                    //             }
                    //
                    //             return false;
                    //         });
                    //
                    //         if (pipeline) {
                    //             $('#interview-request-moving-to-pipeline-modal__yes').attr('data-user-id', data.user_id);
                    //             $('#interview-request-moving-to-pipeline-modal__yes').attr('data-pipeline', pipeline);
                    //             $('#interview-request-moving-to-pipeline-modal').modal('show');
                    //         }
                    //     }).request();
                    //}
                });
            });

            $(document).on('click', '#interview-request-moving-to-pipeline-modal__no', function(event) {
                event.preventDefault();
                $('#interview-request-moving-to-pipeline-modal').modal('hide');
            });

            $(document).on('click', '#interview-request-moving-to-pipeline-modal__yes', function(event) {
                event.preventDefault();

                new GraphQL('mutation', 'candidateUpdatePipeline', {
                    'business_id': parseInt(APIStorage.read('business-id')) || 0,
                    'user_id': $(this).attr('data-user-id'),
                    'pipeline': $(this).attr('data-pipeline'),
                }, [ 'id', 'token' ], true, false, function () {
                    Loader.stop();
                }, function(data) {
                    $('#interview-request-moving-to-pipeline-modal').modal('hide');
                    $.notify('The candidate was moved!', 'success');
                }).request();
            });

            $(document).on('click', '#interview-request-finishing-modal__finish', function(event) {
                event.preventDefault();

                return new GraphQL('mutation', 'updateInterviewRequest', {
                    interview_request_id:   $(this).attr('data-id'),
                    business_id:            parseInt(business && business.currentID) || 0,
                    state:                  'finished',
                    internal_description:   $('#interview-request-finishing-modal__internal-description').val(),
                    external_description:   $('#interview-request-finishing-modal__external-description').val(),
                }, [
                    'id',
                    'user_id',
                    'type',
                    'address',
                    'phone_number',
                    'messenger_identifier',
                    'interviewer_name',
                    'state',
                ], true, false, function() {
                    Loader.stop();
                }, function(response) {
                    $.notify('The interview was finished!', 'success');
                }, false).request();
            });
        });
    </script>
@endpush
<!--[ /Interview request MODAL ]-->