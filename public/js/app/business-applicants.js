function BusinessApplicants(type) {
    //set type page
    this.type = type;
    this.typeClass = capitalizeFirstLetter(this.type);
    //current item ID
    this.currentID;
    //current business ID
    this.businessID = APIStorage.read('business-id');
    //create or update item form
    this.form = $('#business-' + this.type + '-form');
    //name query for create
    this.query = "createPipeline";
    //name query for update
    this.queryUpdate = "update" + this.typeClass;
    //name query for get item
    this.queryItem = "business" + this.typeClass;
    //name query for get all items
    this.queryItems = "business" + this.typeClass + "s";
    //element with sort list params
    this.sortElement = $('#business-' + this.type + '-sort');

    this.queryPipeline = "pipeline";
    this.queryUpdatePipeline = "updatePipeline";
    this.queryUpdatePositionPipeline = "updatePositionPipeline";
    this.queryDeletePipeline = "deletePipeline";

    //one time load location
    this.loadLocations = 0;

    //sort params
    this.sort;
    //order params
    this.order;
    //default limit items on page
    this.perPage = 25;
    //default page
    this.currentPage = 1;
    //pages count
    this.countPages = 1;
    //list limits
    this.perPageElement = $('#business-' + this.type + '-limit');
    //set param for empty items search
    this.search = 0;
    //set param for empty location items search
    this.searchLocation = 0;
    //default status for clone event
    this.cloneQuery = false;
    //default URL for redirect
    this.redirectURL = '';

    this.all_candidates = 'yes';
    this.looking_job = 'no';
    this.its_urgent = 'no';
    this.new_job = 'no';

    this.loadFilters = 0;

    this.filtering_job_ids = [];
    this.filtering_location_ids = [];
    this.filtering_manager_ids = [];
    this.filtering_city_region = [];

    this.viewed = [];
    this.history = [];
    this.requests = [];
    this.notes = [];

    this.msDepartments;
    this.msDepartmentsElement = $('#department');
    this.msJobTypes;
    this.msJobTypesElement = $('#job_type');
    this.msCertificates;
    this.msCertificatesElement = $('#certification_required');
    this.msLanguages;
    this.msLanguagesElement = $('#language_level');

    this.msCategory;
    this.msCategoryElement = $('#categories');

    this.msIndustry;
    this.msIndustryValue;
    this.msSubIndustry;
    this.msSubIndustryValue;
    this.industries;

    this.msExIndustry;
    this.msExIndustryValue;
    this.msSubExIndustry;
    this.msSubExIndustryValue;

    this.currentPipeline;

    this.cNewJob;
    this.cNewOpportunities;
    this.cDistance;
    this.cDistanceType;
    this.cSalary;
    this.cHours;

    this.fullTime;
    this.partTime;
    this.internship;
    this.contractual;
    this.summerPositions;
    this.recruitment;
    this.fieldPlacement;
    this.volunteer;

    this.headline;
    this.location;

    this.preference = {};
    this.availability = {};
    this.basic = {};

    this.education = [];
    this.experience = [];
    this.skill = [];
    this.language = [];
    this.certification = [];
    this.distinction = [];
    this.hobby = [];
    this.interest = [];
    this.reference = [];

    this.chatID;
    this.chatRoom;

    this.myLocations = 0;
    this.only_waves = 0;
}

BusinessApplicants.prototype = {
    init: function () {
        //init ajax loader
        Loader.init();

        var _this = this;
        var body = $('body');
        //get sort param from url
        if (this.sort = getUrlParameter('sort')) {
            this.sortElement.val(this.sort);
        }
        //get order param from url
        if (this.order = getUrlParameter('order')) {
            this.sortElement.find('option[value="' + this.sort + '"][data-order="' + this.order + '"]').prop('selected', true);
        }
        //get per-page limit from url
        if (getUrlParameter('per-page')) {
            this.perPage = +getUrlParameter('per-page');
        }
        //set active class on current page
        this.perPageElement.val(this.perPage);
        //get current page from url
        if (getUrlParameter('page')) {
            this.currentPage = +getUrlParameter('page')
        }
        //set per-page limit
        this.perPageElement.on('change', function () {
            var limit = $(this).val();
            _this.perPage = +limit;
            updateQueryStringParam('per-page', limit);
            updateQueryStringParam('page', 1);
            setTimeout(function () {
                _this.getItems();
            }, 0);
        });
        //set sort & order for items
        this.sortElement.change(function () {
            updateQueryStringParam('sort', $(this).val());
            _this.sort = $(this).val();
            updateQueryStringParam('order', $(this).find('option:selected').attr('data-order'));
            _this.order = $(this).find('option:selected').attr('data-order');
            updateQueryStringParam('page', 1);
            setTimeout(function () {
                _this.getItems();
            }, 0);
        });
        //search items by current type
        var timeout = null;
        $('#business-' + this.type + '-search').on('keyup', function (e) {
            if (e.which <= 90 && e.which >= 48 || e.which === 13 || e.which === 8) {
                var keywords = $(this).val().trim();
                _this.currentPage = 1;
                updateQueryStringParam('page', 1);
                updateQueryStringParam('search', keywords);
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getItems(keywords);
                }, 500);
            }
        });
        body.on('click', '.page-link.page', function () {
            _this.currentPage = +$(this).text();
            updateQueryStringParam('page', _this.currentPage);
            _this.getItems(undefined, true);
        });
        body.on('click', '.page-prev', function () {
            if (_this.currentPage > 1) {
                _this.currentPage -= 1;
                updateQueryStringParam('page', _this.currentPage);
                _this.getItems(undefined, true);
            }
        });
        body.on('click', '.page-next', function () {
            if (_this.currentPage < _this.countPages) {
                _this.currentPage += 1;
                updateQueryStringParam('page', _this.currentPage);
                _this.getItems(undefined, true);
            }
        });

        body.on('mouseover', '.candidate-card', function () {
            $(this).find('.candidate-tools').removeClass('hide');
            $(this).find('.candidate-applied-info').addClass('hide');
        }).on('mouseout', '.candidate-card *', function () {
            $(this).find('.candidate-tools').addClass('hide');
            $(this).find('.candidate-applied-info').removeClass('hide');
        });

        body.on('click', '.p-item', function () {
            var id = $(this).attr('data-id');
            $('.p-item').removeClass('active');
            $(this).addClass('active');
            updateQueryStringParam('p', id);
            _this.getItems(undefined, true);
            _this.getPipeline(false, true);
        });

        body.on('click', '.candidate-overview', function () {
            $('#candidate-overview__block-buttons').hide();
            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var id = $(this).attr('data-id');
            var params = {
                "business_id": _this.businessID,
                "id": id
            };
            var locale = APIStorage.read('language');
            if (locale != 'en') {
                params['locale'] = locale;
            }
            new GraphQL("query", "candidateOverview", params, [
                'overview',
                'id',
                'download_resume',
                'candidate_import',
                'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('#candidate-overview__block-buttons').show();
                if (data.download_resume) {
                    var filename = data.download_resume;
                    filename = filename.substr(filename.lastIndexOf('\\')+1);
                    $('#candidate-overview__block-buttons > a').attr('href', filename);
                    $('#candidate-overview__block-buttons > a').show();
                } else {
                    $('#candidate-overview__block-buttons > a').hide();
                }
                if (data.candidate_import) {
                    $('#candidate-overview__block-buttons .candidate_edit-show-form').attr('data-id',data.id);
                    $('#candidate-overview__block-buttons').show();
                } else {
                    $('#candidate-overview__block-buttons .candidate_edit-show-form').hide();
                }
                if (data.overview) {
                    $('#candidateOverviewModal').find('#candidate-overview-body').html(data.overview);
                    $('#candidateOverviewModal').modal('show');
                } else {
                    $('#candidateOverviewModal').find('#candidate-overview-body').html('')
                }
            }).request();
        });

        body.on('click', '.candidate__interview', function() {
            // if ($(this).hasClass('disabled')) {
            //     $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
            //     return;
            // }

            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var user_id = $(this).attr('data-user-id');
            $('#interview-request-modal').modal('show');
            $('#interview-request-modal__title').text(trans('send_interview_request'));

            $('#interview-request-modal').data('initialize')({
                user_id: user_id,
            });
        });

        body.on('click', '.candidate-pipeline-move', function () {
            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var userID = $(this).attr('data-id');
            var pipeline = $(this).attr('data-type');

            new GraphQL("mutation", "candidateUpdatePipeline", {
                "business_id": _this.businessID,
                "user_id": userID,
                "pipeline": pipeline
            }, ['id', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data) {
                    if (data.id) {
                        $('.candidate-card[data-id="' + userID + '"]').remove();
                        _this.getPipeline(false, true);
                        // var count = +$('#business-candidate-counts').text();
                        // $('#business-candidate-counts').text(count - 1);
                        // $('.p-item[data-id="' + _this.currentPipeline + '"]').find('p span:first').text(count - 1);

                        // $('.p-item[data-id="' + pipeline + '"]').find('p span:first').text(+$('.p-item[data-id="' + pipeline + '"]').find('p span:first').text() + 1);

                        // var countApplicantsNew = parseInt($('.countApplicantsNew').eq(0).text());
                        // if (pipeline == 'new') {
                        //     countApplicantsNew++;
                        // } else {
                        //     countApplicantsNew--;
                        // }
                        // if (countApplicantsNew == 0) {
                        //     //$('.countSentResumesAsk').toggle("bounce", { times: 5, distance : 10 }, "slow" );
                        //     $('.countApplicantsNew').fadeOut().text(0);
                        // } else {
                        //     //$('.countSentResumesAsk').fadeOut().text(countSentResumesAsk).toggle("bounce", /*{ times: 5, distance : 10 },*/ "slow" );
                        //     $('.countApplicantsNew').fadeIn();
                        //     $('.countApplicantsNew').text(countApplicantsNew).addClass('bounceIn');
                        //     setTimeout(function() {
                        //         $('.countApplicantsNew').removeClass('bounceIn');
                        //     },500);
                        // }
                    }
                }
            }).request();
        });

        body.on('click', '.candidate-viewed', function () {
            // if ($(this).hasClass('disabled')) {
            //     $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
            //     return;
            // }

            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var html = '';
            var id = $(this).attr('data-id');
            var name = $('.candidate-card[data-id="' + id + '"]').find('.candidate-name').text();
            $.map(_this.viewed[id], function (item) {
                html += '<div class="d-flex px-3">\n' +
                    '    <div>\n' +
                    '        <img class="mr-3" src="' + item.manager.user_pic + '"\n' +
                    '             style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                    '    </div>\n' +
                    '    <div>\n' +
                    '        <p class="mb-0 pt-2"><strong>' + item.manager.first_name + ' ' + item.manager.last_name + '</strong></p>\n' +
                    '    </div>\n' +
                    '    <div class="ml-auto pt-2">\n' +
                    '        ' + item.date + '\n' +
                    '    </div>\n' +
                    '</div>\n' +
                    '<hr>';
            });
            $('#viewed-modal-body').html(html);
            $('#viewed-name-modal').text(name);

            $('#viewed_candidate').modal('show');
        });

        body.on('click', '.candidate-send-data', function () {
            var id = $(this).attr('data-id');
            $('#candidate-send-data-go').attr('data-id',id);

            $('#send_candidate').modal('show');
        });
        $('#send_candidate input[name="email"]').keydown(function () {
            FormValidate.fieldValidateClear($(this));
        });
        body.on('click', '#candidate-send-data-go', function () {
            var id = $(this).attr('data-id');
            var form = $('#send_candidate');
            new GraphQL("query", "sendCandidateData", {
                "id": id,
                "email": FormValidate.getFieldValue('email', form)
            }, ['response', 'message'], true, false, function () {
                Loader.stop();
            }, function (data) {
                $('#send_candidate').modal('hide');
            },form).request();
        });

        body.on('click', '.candidate-notes', function () {
            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var id = $(this).attr('data-id');
            $('#candidate-note-message').val('');
            $('#candidate-note-rating').val('');
            $('#candidate-note-attach_file').val('');
            $('#candidate-note-attach_file-name').text('');
            _this.userNotes(id);
        });

        $('#candidate-note-attach_file-click').click(function () {
            $('#candidate-note-attach_file').click();
        });
        $('#candidate-note-attach_file').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#candidate-note-attach_file-name').text(filename);
        });
        $('#candidate-note-filters').keyup(function () {
            var keyword = $(this).val();
            $('#notes-modal-body .candidate-note-message').each(function() {
                var message = $(this).text();
                if (message.indexOf(keyword)==-1) {
                    $(this).closest('.candidate-note-item').removeClass('d-flex').hide();
                    $(this).closest('.candidate-note-item').next('hr').hide();
                } else {
                    $(this).closest('.candidate-note-item').addClass('d-flex').show();
                    $(this).closest('.candidate-note-item').next('hr').show();
                }
            });
        });

        body.on('click', '.candidate-job_questions', function () {
            $('#candidate-questions_block-questions').children().remove();
            var userId = $(this).attr('data-user_id');
            var jobId = $(this).attr('data-job_id');
            if (jobId) {
                new GraphQL("query", "questionsJob", { 'job_id': jobId, 'user_id': userId }, [
                    'items {' +
                        ' id localized_question type job {' +
                            ' id localized_title business {' +
                                ' id localized_name picture(width:200, height:200)' +
                            ' } location {' +
                            ' id localized_name' +'' +
                            ' }' +
                        ' } answers { id answer } ' +
                    ' }',
                    'token'
                ], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    if (data && data.items && data.items.length > 0) {
                        var questions = data.items;
                        $('#candidate-questions_business-title').text(questions[0].job.business.localized_name);
                        $('#candidate-questions_job-title').text(questions[0].job.localized_title);
                        $('#candidate-questions_location-title').text(questions[0].job.location ? questions[0].job.location.localized_title : '');

                        $.map(questions, function (item) {
                            questionElem = $('#candidate-questions_block-questions-question-clone').clone();
                            questionElem.removeAttr('id').show();
                            questionElem.find('.question').text(item.localized_question);
                            questionElem.find('.answer').text(item.answers[0].answer);
                            $('#candidate-questions_block-questions').append(questionElem);
                        });
                        $('#questionnaireModalResult').modal('show');
                    } else {
                        $('#questionnaireModalResultNull').modal('show');
                    }

                }).request();
            } else {
                $('#questionnaireModalResultNull').modal('show');
            }
        });

        body.on('click keydown', '#candidate-note-message', function () {
            FormValidate.fieldValidateClear($(this));
        });
        body.on('click', '#candidate-note-add', function () {
            var userID = $(this).attr('data-id');
            var messageEl = $('#candidate-note-message');
            var ratingEl = $('#candidate-note-rating');
            var form = $('#candidate_notes');
            var params = {
                "business_id": _this.businessID,
                "user_id": userID,
                "message": FormValidate.getFieldValue('message', form)
            };

            if (ratingEl.val().length > 0) {
                params['rating'] = parseInt(FormValidate.getFieldValue('rating', form));
            }

            new GraphQL("mutation", "candidateNote", params, ['manager{first_name last_name user_pic}', 'id', 'message', 'attach_file', 'rating', 'date'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data) {
                    _this.notes[userID].unshift(data);
                    messageEl.val('');
                    ratingEl.val('');
                    $('#candidate-note-attach_file-name').text('');
                    setTimeout(function () {
                        _this.userNotes(userID);
                    }, 100);
                    var rating_candidate = _this.CountRatingCandidate(userID);
                    if (rating_candidate > 0) {
                        var color_rating = 'text-success';
                        if (rating_candidate < 5) {
                            color_rating = 'text-danger';
                        } else if (rating_candidate < 8) {
                            color_rating = 'text-warning';
                        }
                        var elRatingParent = $('[data-candidate_id="' +userID+ '"]');
                        var elRating = elRatingParent.find('.candidate-rating');
                        if (elRating.length) {
                            elRating.removeClass('text-danger').removeClass('text-warning').removeClass('text-success');
                            elRating.addClass(color_rating);
                            elRating.text(rating_candidate + '/10');
                        } else {
                            var html = '<span class="ml-3 candidate-rating ' +color_rating+ '">' +rating_candidate+ '/10</span>';
                            elRatingParent.append(html);
                        }
                    }
                    $('#candidate-note-message').val('');
                    $('#candidate-note-rating').val('');
                    $('#candidate-note-attach_file').val('');
                    $('#candidate-note-attach_file-name').text('');
                }
            },form,new FormData($('#business-candidate-form').get(0))).request();
        });
        body.on('click', '.candidate-note-item-delete', function () {
            var userID = $('#candidate-note-add').attr('data-id');
            var noteID = $(this).attr('data-id');
            var itemNoteEl = $(this).closest('.candidate-note-item');
                new GraphQL("mutation", "deleteNote", { "id": noteID }, ['response', 'token'], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    if (data.response == 'ok') {
                        itemNoteEl.next('hr').remove();
                        itemNoteEl.remove();
                        _this.notes[userID].forEach(function(item, i, arr) {
                            if (item.id == noteID) {
                                _this.notes[userID].splice(i, 1);
                                return false;
                            }
                        });
                    }
                }).request();
        });

        body.on('click', '.candidate-history', function () {
            // if ($(this).hasClass('disabled')) {
            //     $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
            //     return;
            // }

            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var id = $(this).attr('data-id');
            var name = $('.candidate-card[data-id="' + id + '"]').find('.candidate-name').text();
            var picture = $('.candidate-card[data-id="' + id + '"]').find('.candidate-picture').attr('src');

            var html = '';

            console.log(_this.history[id]);
            $.map(_this.history[id], function (item) {
                if (item.candidate) {
                    html += '<div class="d-flex px-3 mt-1">\n' +
                        '                                        <div>';
                    if (item.candidate.job) {
                        html += '<p class="mb-1">\n' +
                            '                                                <svg xmlns="http://www.w3.org/2000/svg"\n' +
                            '                                                     xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                            '                                                     id="Capa_1"\n' +
                            '                                                     x="0px" y="0px" viewBox="0 0 512 512"\n' +
                            '                                                     style="enable-background:new 0 0 512 512; vertical-align: middle; margin-top: -4px;"\n' +
                            '                                                     xml:space="preserve" width="16px" height="16px" fill="#4E5C6E">\n' +
                            '<g>\n' +
                            '    <g>\n' +
                            '        <path d="M488.727,279.273c-6.982,0-11.636,4.655-11.636,11.636v151.273c0,6.982-4.655,11.636-11.636,11.636H46.545    c-6.982,0-11.636-4.655-11.636-11.636V290.909c0-6.982-4.655-11.636-11.636-11.636s-11.636,4.655-11.636,11.636v151.273    c0,19.782,15.127,34.909,34.909,34.909h418.909c19.782,0,34.909-15.127,34.909-34.909V290.909    C500.364,283.927,495.709,279.273,488.727,279.273z"/>\n' +
                            '    </g>\n' +
                            '</g>\n' +
                            '                            <g>\n' +
                            '                                <g>\n' +
                            '                                    <path d="M477.091,116.364H34.909C15.127,116.364,0,131.491,0,151.273v74.473C0,242.036,11.636,256,26.764,259.491l182.691,40.727    v37.236c0,6.982,4.655,11.636,11.636,11.636h69.818c6.982,0,11.636-4.655,11.636-11.636v-37.236l182.691-40.727    C500.364,256,512,242.036,512,225.745v-74.473C512,131.491,496.873,116.364,477.091,116.364z M279.273,325.818h-46.545v-46.545    h46.545V325.818z M488.727,225.745c0,5.818-3.491,10.473-9.309,11.636l-176.873,39.564v-9.309c0-6.982-4.655-11.636-11.636-11.636    h-69.818c-6.982,0-11.636,4.655-11.636,11.636v9.309L32.582,237.382c-5.818-1.164-9.309-5.818-9.309-11.636v-74.473    c0-6.982,4.655-11.636,11.636-11.636h442.182c6.982,0,11.636,4.655,11.636,11.636V225.745z"/>\n' +
                            '                                </g>\n' +
                            '                            </g>\n' +
                            '                            <g>\n' +
                            '                                <g>\n' +
                            '                                    <path d="M314.182,34.909H197.818c-19.782,0-34.909,15.127-34.909,34.909v11.636c0,6.982,4.655,11.636,11.636,11.636    s11.636-4.655,11.636-11.636V69.818c0-6.982,4.655-11.636,11.636-11.636h116.364c6.982,0,11.636,4.655,11.636,11.636v11.636    c0,6.982,4.655,11.636,11.636,11.636c6.982,0,11.636-4.655,11.636-11.636V69.818C349.091,50.036,333.964,34.909,314.182,34.909z"/>\n' +
                            '                                </g>\n' +
                            '                            </g>\n' +
                            '</svg>\n ' + item.candidate.job.title + '</p>';
                    }
                    var location = '';
                    var countryCode = '';
                    var locationName = '';

                    var locationData = item.candidate.location;
                    if (locationData) {
                        locationName = locationData.name;

                        location = locationData.city;
                        if (locationData.region !== null) {
                            location += ", " + locationData.region;
                        }
                        if (locationData.country !== null) {
                            location += ", " + locationData.country;
                        }

                        countryCode = locationData.country_code;
                    } else {
                        var businessData = item.candidate.business;
                        locationName = businessData.name;

                        location = businessData.city;
                        if (businessData.region !== null) {
                            location += ", " + businessData.region;
                        }
                        if (businessData.country !== null) {
                            location += ", " + businessData.country;
                        }
                        countryCode = businessData.country_code;
                    }
                    if (item.candidate.user.is_import) {
                        if (item.candidate.user.city || item.candidate.user.region || item.candidate.user.country || item.candidate.user.country_code) {
                            location = item.candidate.user.city;
                            if (item.candidate.user.region !== null) {
                                location += ", " + item.candidate.user.region;
                            }
                            if (item.candidate.user.country !== null) {
                                location += ", " + item.candidate.user.country;
                            }
                            countryCode = item.candidate.user.country_code;
                        } else {
                            location = ''
                        }
                    }
                    let user_video_html = "";
                    if(item.candidate.user_video){
                        user_video_html = '<div style="cursor: pointer;" class="[ candidate-video ] pull-right" data-user-video="'+item.candidate.user_video+'" data-id="'+item.candidate.user.id+'" style="background-image: url('+item.candidate.thumbnail_url+');">\n' +
                            '                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"\n' +
                            '                                             viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">\n' +
                            '                                            <path d="M175,0C78.343,0,0,78.343,0,175c0,96.656,78.343,175,175,175c96.656,0,175-78.344,175-175C350,78.343,271.656,0,175,0z\n' +
                            '                                                 M258.738,189.05l-104.386,71.812c-2.904,1.989-6.284,3.006-9.673,3.006c-2.728,0-5.436-0.648-7.93-1.951\n' +
                            '                                                c-5.605-2.965-9.125-8.777-9.125-15.103V103.188c0-6.326,3.52-12.139,9.125-15.104c5.605-2.94,12.377-2.535,17.603,1.055\n' +
                            '                                                l104.386,71.811c4.619,3.18,7.387,8.441,7.387,14.05C266.125,180.609,263.358,185.87,258.738,189.05z"/>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                                                                        <g>\n' +
                            '                                                                                        </g>\n' +
                            '                                        </svg>\n' +
                            '                                    </div>';

                    }


                    html += '<div class="mb-1">\n' +
                        '<img class="mr-1" src="' + item.candidate.business.picture_50 + '"\n' +
                        'style="width: 35px; height: 35px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                        locationName + user_video_html +
                        '</div>\n';
                    if (location.length > 0) {
                        html += '<p class="mb-0" style="font-size: 14px; padding-top: 15px;">\n' +
                            '<span class="item-location-flag bfh-flag-' + countryCode + '"><i' +
                            'class="glyphicon"></i> </span>\n' +
                            Langs.applied_to + ' ' + location +
                            '</p>\n' +
                            '</div>\n' +
                            '<div class="ml-auto">\n' +
                            '<p class="pt-1">' + item.candidate.date + '</p>\n' +
                            '</div>\n' +
                            '</div>\n';
                    }
                    html += '<hr>';
                } else if (item.pipeline) {
                    html += '<div class="d-flex px-3">\n' +
                        '    <div>\n' +
                        '        <img class="mr-3" src="' + item.pipeline.manager.user_pic + '"\n' +
                        '             style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                        '    </div>\n' +
                        '    <div>\n' +
                        '        <p class="mb-0 pt-2"><strong>' + item.pipeline.manager.first_name + ' ' + item.pipeline.manager.last_name + '</strong></p>\n' +
                        '<p>'+Langs.moved+' ' + name + ' '+Langs.to+' ' + item.pipeline.pipeline + '</p>' +
                        '    </div>\n' +
                        '    <div class="ml-auto pt-2">\n' +
                        '        ' + item.pipeline.date + '\n' +
                        '    </div>\n' +
                        '</div>\n' +
                        '<hr>';
                }
            });

            $('#history-modal-body').html(html);
            $('#history-name-modal').text(name);
            $('#history-picture-modal').attr('src', picture);

            $('#history').modal('show');
        });

        body.on('click', '.candidate-send-to-managers', function() {
            // if ($(this).hasClass('disabled')) {
            //     $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
            //     return;
            // }

            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // write some code here
        });

        body.on('click', '.candidate-resume-update', function () {
            // if ($(this).hasClass('disabled')) {
            //     $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
            //     return;
            // }

            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            var id = $(this).attr('data-id');
            var name = $('.candidate-card[data-id="' + id + '"]').find('.candidate-name').text();

            _this.resumeRequest(id);

            $('#candidate-send-request').attr('data-id', id);
            $('#candidate-resume-name').text(name);
            $('#pipeline').modal('show');
        });

        body.on('click', '.candidate-send-message', function () {
            // if ($(this).hasClass('disabled')) {
            //     $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
            //     return;
            // }

            // if (!_this.canClickOnCandidate($(this).parents('.candidate-card:first'))) {
            //     if (business.currentData.plan_id) {
            //         $('#from_x_to_y').modal('show');
            //     }
            //     else {
            //         $('#fromTrial').modal('show');
            //     }

            //     return;
            // }

            // _this.clickOnCandidateRequest($(this).parents('.candidate-card:first'));
            var id = $(this).attr('data-id');
            // $('#candidate-send-message').val('');
            // _this.sendMessage(id);
            $('#new-chat-message-modal').data('initialize')({
                with_user_id: parseInt($(this).attr('data-id')),
            });

            $('#new-chat-message-modal').modal('show');
        });

        body.on('click', '.candidate-video', function (event) {
            event.preventDefault();
            console.log("EVENT - candidate-video");
            $(document).find('#candidate-video-block').attr("src", $(this).attr("data-user-video"));
            $(document).find('#candidate-video-modal').modal('show');
        });

        $(document).find('#candidate-video-modal').on("hide.bs.modal", function(){
            console.log("EVENT - hide - candidate-video");
            $(document).find('#candidate-video-block').attr("src", "");
        });

        body.on('click', '.candidate-pin-to-top', function() {
            if ($(this).hasClass('disabled')) {
                $('#cant-click-on-candidate-in-archived-pipeline-modal').modal('show');
                return;
            }

            // write some code here
        });

        body.on('click', '#candidate-send-message-and-chat-open', function () {
            var id = $(this).attr('data-id');
            _this.createChat(id);
        });

        body.on('click', '#candidate-send-interview-request', function(event) {
            var user_id = parseInt($(this).attr('data-user-id'));
            $('#interview-request-modal').modal('show');
            $('#interview-request-modal__title').text(Langs.send_interview_request);

            $('#interview-request-modal').data('initialize')({
                user_id: user_id,
            });
        });

        body.on('click', '#candidate-send-add', function () {
            var id = $(this).attr('data-id');
            var message = $('#candidate-send-message').val();

            if (message) {
                _this.createChat(id, true);
            }
        });

        body.on('click', '#candidate-send-request', function () {
            var id = $(this).attr('data-id');
            new GraphQL("mutation", "resumeRequest", {
                "business_id": +_this.businessID,
                "user_id": +id
            }, ['id', 'response', 'date', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data) {
                    _this.requests[id] = data;
                    setTimeout(function () {
                        _this.resumeRequest(id);
                    }, 100);
                }
            }).request();
        });

        body.on('click', '#candidate-resume-remind', function () {
            var id = $(this).attr('data-id');
            var userID = $(this).attr('data-user-id');
            new GraphQL("mutation", "resumeRequest", {
                "business_id": +_this.businessID,
                "id": +id
            }, ['id', 'response', 'date', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data) {
                    _this.requests[userID] = data;
                    setTimeout(function () {
                        _this.resumeRequest(userID);
                    }, 100);
                }
            }).request();
        });

        body.on('click', '#filters-modal', function () {
            if (_this.loadFilters === 0) {
                _this.msFields(true);
                _this.getIndustry();
                _this.getExIndustry();
                _this.loadFilters = 1;
            }
        });
        body.on('click', '#set-filters', function () {
            _this.setFilters();
        });
        body.on('click', '.clear-filters', function () {
            if (_this.msDepartments)
                _this.msDepartments.setSelection([]);
            if (_this.msCertificates)
                _this.msCertificates.setSelection([]);
            if (_this.msLanguages)
                _this.msLanguages.setSelection([]);
            if (_this.msJobTypes)
                _this.msJobTypes.setSelection([]);
            if (_this.msCategory)
                _this.msCategory.setSelection([]);
            $('#jobfiltermodal').find('input[type="text"]').val('');
            $('#jobfiltermodal').find('input').prop('checked', false).parent().removeClass('active');
            $('#jobfiltermodal').find('#availabilities-1').prop('checked', true).parent().addClass('active');

            _this.preference = {};
            _this.availability = {};
            _this.basic = {};
            _this.education = [];
            _this.experience = [];
            _this.skill = [];
            _this.language = [];
            _this.certification = [];
            _this.distinction = [];
            _this.hobby = [];
            _this.interest = [];
            _this.reference = [];

            $('#user-resume-filters').html('');
            $('#filter-status').addClass('hide');

            _this.setFilters();
        });

        $('#user-availabilities').on('click', '#user-availabilities-all input', function () {
            var dataDay = $(this).attr('data-time');
            if ($(this).prop('checked')) {
                $('#user-availabilities').find('input[data-parent-time="' + dataDay + '"]').prop('checked', true);
            } else {
                $('#user-availabilities').find('input[data-parent-time="' + dataDay + '"]').prop('checked', false);
            }
        });

        $('#user-availabilities').on('click', 'input[data-parent-time]', function () {
            var dataDay = $(this).attr('data-parent-time');
            if (!$(this).prop('checked')) {
                $('#user-availabilities-all').find('input[data-time="' + dataDay + '"]').prop('checked', false);
            }
        });

        body.on('click', '#candidate-filter-preference', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterPreferenceModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-availability', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterAvailabilitiesModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-basic', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterBasicModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-education', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterEducationModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-experience', function () {
            if (_this.msExIndustry) {
                _this.msExIndustry.clear();
            }
            if (_this.msSubExIndustry) {
                _this.msSubExIndustry.clear();
            }
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterExperienceModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-skills', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterSkillsModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-certifications', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterCertificationsModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-interest', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterInterestsModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });
        body.on('click', '#candidate-filter-references', function () {
            $('#jobfiltermodal').on('hidden.bs.modal', function () {
                $('#filterReferencesModal').modal('show');
                $('#jobfiltermodal').unbind('hidden.bs.modal');
            });
            $('#jobfiltermodal').modal('hide');
        });

        body.on('change', 'input[name="my_locations"]', function () {
            if ($(this).prop('checked')) {
                _this.myLocations = 1;
            } else {
                _this.myLocations = 0;
            }
            setTimeout(function () {
                _this.getItems();
            }, 100);
        });

        body.on('click', '.candidates__wave-filter', function() {
            if ($(this).hasClass('enabled')) {
                $(this).removeClass('enabled').css({ 'color': '#9ba6b2', 'border-color': '#9ba6b2' });
                _this.only_waves = 0;
            } else {
                $(this).addClass('enabled').css({ 'color': '#007bff', 'border-color': '#007bff' });
                _this.only_waves = 1;
            }

            setTimeout(function() {
                _this.getItems();
            }, 100);
        });

        body.on('click', '.remove-f', function () {
            var filter = $(this).attr('data-filter');
            switch (filter) {
                case 'p':
                    _this.preference = {};
                    _this.preferenceClear();
                    break;
                case 'a':
                    _this.availability = {};
                    _this.availabilityClear();
                    break;
                case 'b':
                    _this.basic = {};
                    _this.basicClear();
                    break;
                case 'e':
                    var id = $(this).attr('data-id');
                    if (_this.education[id]) {
                        _this.education.splice(id, 1);
                    }
                    break;
                case 'ex':
                    var id = $(this).attr('data-id');
                    if (_this.experience[id]) {
                        _this.experience.splice(id, 1);
                    }
                    break;
                case 's':
                    var id = $(this).attr('data-id');
                    if (_this.skill[id]) {
                        _this.skill.splice(id, 1);
                    }
                    break;
                case 'l':
                    var id = $(this).attr('data-id');
                    if (_this.language[id]) {
                        _this.language.splice(id, 1);
                    }
                    break;
                case 'c':
                    var id = $(this).attr('data-id');
                    if (_this.certification[id]) {
                        _this.certification.splice(id, 1);
                    }
                    break;
                case 'd':
                    var id = $(this).attr('data-id');
                    if (_this.distinction[id]) {
                        _this.distinction.splice(id, 1);
                    }
                    break;
                case 'h':
                    var id = $(this).attr('data-id');
                    if (_this.hobby[id]) {
                        _this.hobby.splice(id, 1);
                    }
                    break;
                case 'i':
                    var id = $(this).attr('data-id');
                    if (_this.interest[id]) {
                        _this.interest.splice(id, 1);
                    }
                    break;
                case 'r':
                    var id = $(this).attr('data-id');
                    if (_this.reference[id]) {
                        _this.reference.splice(id, 1);
                    }
                    break;
            }
            $.each($('.remove-f[data-filter="' + filter + '"]'), function (k) {
                if ($(this).attr('data-id')) {
                    var id = +$(this).attr('data-id');
                    $(this).attr('data-id', id - 1);
                }
            });
            $(this).parent().remove();
        });

        $('#filterPreferenceModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterAvailabilitiesModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterBasicModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterEducationModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterExperienceModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterSkillsModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterCertificationsModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterInterestsModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });
        $('#filterReferencesModal').on('hidden.bs.modal', function () {
            $('#jobfiltermodal').modal('show');
        });

        $('#modal-preference-apply').on('click', function () {
            _this.cNewJob = FormValidate.getCheckedFieldValue('c_new_job');
            _this.cNewOpportunities = FormValidate.getCheckedFieldValue('c_new_opportunities');
            _this.cDistance = FormValidate.getFieldValue('c_distance');
            _this.cDistanceType = FormValidate.getCheckedFieldValue('c_distance_type');
            _this.cSalary = FormValidate.getFieldValue('c_salary');
            _this.cHours = $('#c_hourly_salary').slider('values');

            var filter = "Job Preference - ";
            filter += "New job - " + _this.cNewJob + "; ";
            _this.preference['new_job'] = _this.cNewJob;
            filter += "New opportunities - " + _this.cNewOpportunities + "; ";
            _this.preference['new_opportunities'] = _this.cNewOpportunities;
            if (_this.cDistance.length !== 0) {
                filter += "Distance - " + _this.cDistance + " " + _this.cDistanceType + "; ";
                _this.preference['distance'] = _this.cDistance;
                _this.preference['distance_type'] = _this.cDistanceType;
            } else {
                _this.preference['distance'] = null;
                _this.preference['distance_type'] = null;
            }
            if (_this.cSalary.length !== 0) {
                filter += "Salary - " + _this.cSalary + "; ";
                _this.preference['salary'] = _this.cSalary;
            } else {
                _this.preference['salary'] = null;
            }
            filter += "Hours - from " + _this.cHours[0] + " to " + _this.cHours[1] + ";";
            _this.preference['hours_from'] = _this.cHours[0];
            _this.preference['hours_to'] = _this.cHours[1];
            if (_this.msIndustry) {
                _this.preference['industries'] = _this.msIndustry.getSelection();
                var industries = "";
                $.map(_this.msIndustry.getSelection(), function (item) {
                    industries += item.name + ",";
                });
                filter += "Industries - " + industries + ";";
            }
            if (_this.msSubIndustry) {
                _this.preference['sub_industries'] = _this.msSubIndustry.getSelection();
                var industries = "";
                $.map(_this.msSubIndustry.getSelection(), function (item) {
                    industries += item.name + ",";
                });
                filter += "Sub-Industries - " + industries + ";";
            }

            $('#user-resume-filters').find('#ur-filter-1').remove();
            $('#user-resume-filters').append("<p class='mt-3 ml-4 mr-4'>" + filter + " <a data-filter='p' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");

            $('#filterPreferenceModal').modal('hide');
        });

        $('#modal-availability-apply').on('click', function () {
            _this.fullTime = +FormValidate.getCheckedFieldValue('full_time');
            _this.partTime = +FormValidate.getCheckedFieldValue('part_time');
            _this.internship = +FormValidate.getCheckedFieldValue('internship');
            _this.contractual = +FormValidate.getCheckedFieldValue('contractual');
            _this.summerPositions = +FormValidate.getCheckedFieldValue('summer_positions');
            _this.recruitment = +FormValidate.getCheckedFieldValue('recruitment');
            _this.fieldPlacement = +FormValidate.getCheckedFieldValue('field_placement');
            _this.volunteer = +FormValidate.getCheckedFieldValue('volunteer');

            var filter = Langs.availability + " - ";
            var c = 0;
            if (_this.fullTime !== 0) {
                c++;
                filter += Langs.full_time + ";";
                _this.availability['full_time'] = 1;
            } else {
                _this.availability['full_time'] = null;
            }
            if (_this.partTime !== 0) {
                c++;
                filter += Langs.part_time + ";";
                _this.availability['part_time'] = 1;
            } else {
                _this.availability['part_time'] = null;
            }
            if (_this.internship !== 0) {
                c++;
                filter += Langs.internship + ";";
                _this.availability['internship'] = 1;
            } else {
                _this.availability['internship'] = null;
            }
            if (_this.contractual !== 0) {
                c++;
                filter += Langs.contractual + ";";
                _this.availability['contractual'] = 1;
            } else {
                _this.availability['contractual'] = null;
            }
            if (_this.summerPositions !== 0) {
                c++;
                filter += Langs.summer_positions + ";";
                _this.availability['summer_positions'] = 1;
            } else {
                _this.availability['summer_positions'] = null;
            }
            if (_this.recruitment !== 0) {
                c++;
                filter += Langs.recruitment + ";";
                _this.availability['recruitment'] = 1;
            } else {
                _this.availability['recruitment'] = null;
            }
            if (_this.fieldPlacement !== 0) {
                c++;
                filter += Langs.field_placement + ";";
                _this.availability['field_placement'] = 1;
            } else {
                _this.availability['field_placement'] = null;
            }
            if (_this.volunteer !== 0) {
                c++;
                filter += Langs.volunteer + ";";
                _this.availability['volunteer'] = 1;
            } else {
                _this.availability['volunteer'] = null;
            }

            $('#user-resume-filters').find('#ur-filter-2').remove();
            if (c !== 0) {
                $('#user-resume-filters').append("<p id='ur-filter-2' class='mt-3 ml-4 mr-4'>" + filter + " <a data-filter='a' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            $('#filterAvailabilitiesModal').modal('hide');
        });

        $('#modal-basic-apply').on('click', function () {
            _this.headline = FormValidate.getFieldValue('headline');
            _this.location = FormValidate.getFieldValue('b_location');

            var filter = Langs.basic_info + " - ";
            var c = 0;
            if (_this.headline.length !== 0) {
                c++;
                filter += Langs.headline + " - " + _this.headline + "; ";
                _this.basic['headline'] = _this.headline;
            } else {
                _this.basic['headline'] = null;
            }
            if (_this.location.length !== 0) {
                c++;
                filter += Langs.location + " - " + _this.location + "; ";
                _this.basic['location'] = _this.location;
            } else {
                _this.basic['location'] = null;
            }

            $('#user-resume-filters').find('#ur-filter-3').remove();
            if (c !== 0) {
                $('#user-resume-filters').append("<p id='ur-filter-3' class='mt-3 ml-4 mr-4'>" + filter + " <a data-filter='b' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }

            $('#filterBasicModal').modal('hide');
        });

        $('#modal-education-apply').on('click', function () {
            var schoolName = FormValidate.getFieldValue('school_name');
            var eLocation = FormValidate.getFieldValue('e_location');
            var eYearFrom = FormValidate.getFieldValue('e_year_from');
            var eYearTo = FormValidate.getFieldValue('e_year_to');
            var eGrade = FormValidate.getFieldValue('grade');

            var filter = Langs.education + " - ";
            var c = 0;
            if (schoolName.length !== 0) {
                c++;
                filter += Langs.school_name + " - " + schoolName + "; ";
            }
            if (eLocation.length !== 0) {
                c++;
                filter += Langs.location + " - " + eLocation + "; ";
            }
            if (eYearFrom.length !== 0) {
                c++;
                filter += Langs.year_from + " - " + eYearFrom + "; ";
            }
            if (eYearTo.length !== 0) {
                c++;
                filter += Langs.year_to + " - " + eYearTo + "; ";
            }
            if (eGrade.length !== 0) {
                c++;
                filter += Langs.grade + " - " + eGrade + "; ";
            }

            if (c !== 0) {
                _this.education.push({
                    'school_name': schoolName,
                    'location': eLocation,
                    'year_from': eYearFrom,
                    'year_to': eYearTo,
                    'grade': eGrade
                });
                var l = $('.ur-filter-e').length;
                $('#user-resume-filters').append("<p class='ur-filter-e mt-3 ml-4 mr-4'>" + filter + " <a data-filter='e' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterEducationModal').find('input, select').val('');
            }, 200);

            $('#filterEducationModal').modal('hide');
        });

        $(body).on('change', 'select[name="ex_year_from"],select[name="ex_month_from"],select[name="ex_year_to"],select[name="ex_month_to"]', function () {
            $(this).parent().removeClass('has-error');
        });
        $('#modal-experience-apply').on('click', function () {
            var title = FormValidate.getFieldValue('ex_title');
            var company = FormValidate.getFieldValue('ex_company');
            var exLocation = FormValidate.getFieldValue('ex_location');
            var exDateFrom = FormValidate.getFieldDateMonthYear('ex_month_from', 'ex_year_from');
            var exDateTo = FormValidate.getFieldDateMonthYear('ex_month_to', 'ex_year_to');

            var exMonthFrom = FormValidate.getFieldValue('ex_month_from');
            var exYearFrom = FormValidate.getFieldValue('ex_year_from');
            var exMonthTo = FormValidate.getFieldValue('ex_month_to');
            var exYearTo = FormValidate.getFieldValue('ex_year_to');

            var error = 0;
            if (exMonthFrom.length !== 0 && exYearFrom.length === 0) {
                $('select[name="ex_year_from"]').parent().addClass('has-error');
                error = 1;
            }
            if (exMonthFrom.length === 0 && exYearFrom.length !== 0) {
                $('select[name="ex_month_from"]').parent().addClass('has-error');
                error = 1;
            }
            if (exMonthTo.length !== 0 && exYearTo.length === 0) {
                $('select[name="ex_year_to"]').parent().addClass('has-error');
                error = 1;
            }
            if (exMonthTo.length === 0 && exYearTo.length !== 0) {
                $('select[name="ex_month_to"]').parent().addClass('has-error');
                error = 1;
            }
            if (error === 1) {
                return false;
            }

            var filter = Langs.experience + " - ";
            var c = 0;
            if (title.length !== 0) {
                c++;
                filter += Langs.title + " - " + title + "; ";
            }
            if (company.length !== 0) {
                c++;
                filter += Langs.company + " - " + company + "; ";
            }
            if (exLocation.length !== 0) {
                c++;
                filter += Langs.location + " - " + exLocation + "; ";
            }
            if (exDateFrom.length !== 0) {
                c++;
                filter += Langs.date_from + " - " + exDateFrom + "; ";
            }
            if (exDateTo.length !== 0) {
                c++;
                filter += Langs.date_to + " - " + exDateTo + "; ";
            }

            if (_this.msExIndustry) {
                c++;
                var industries = "";
                $.map(_this.msExIndustry.getSelection(), function (item) {
                    industries += item.name + ",";
                });
                filter += Langs.industries + " - " + industries + ";";
            }
            if (_this.msSubExIndustry) {
                c++;
                var industries = "";
                $.map(_this.msSubExIndustry.getSelection(), function (item) {
                    industries += item.name + ",";
                });
                filter += Langs.sub_industries + " - " + industries + ";";
            }

            if (c !== 0) {
                var i = Object.assign({}, _this.msExIndustry.getSelection());
                var s = Object.assign({}, _this.msSubExIndustry.getSelection());
                _this.experience.push({
                    'title': title,
                    'company': company,
                    'location': exLocation,
                    'date_from': exDateFrom,
                    'date_to': exDateTo,
                    'industries': (_this.msExIndustry) ? i : null,
                    'sub_industries': (_this.msSubExIndustry) ? s : null
                });
                var l = $('.ur-filter-ex').length;
                $('#user-resume-filters').append("<p class='ur-filter-ex mt-3 ml-4 mr-4'>" + filter + " <a data-filter='ex' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterExperienceModal').find('input, select').val('');
            }, 200);

            $('#filterExperienceModal').modal('hide');
        });

        $('#modal-skill-apply').on('click', function () {
            var title = FormValidate.getFieldValue('sk_title');
            var level = $("#sk_skill-slider-range-min").slider("value");

            var filter = Langs.skill + " - ";

            if (title.length !== 0) {
                filter += title + " " + Langs.with_level + " - " + level + "%";

                _this.skill.push({
                    'title': title,
                    'level': level
                });
                var l = $('.ur-filter-sk').length;
                $('#user-resume-filters').append("<p class='ur-filter-sk mt-3 ml-4 mr-4'>" + filter + " <a data-filter='s' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }

            setTimeout(function () {
                $('#filterSkillsModal').find('input, select').val('');
                $("#sk_skill-slider-range-min").slider("value", 50);
                $("#sk_skill-slider-amount").html(50 + "%");
            }, 200);

            $('#filterSkillsModal').modal('hide');
        });

        $('#modal-language-apply').on('click', function () {
            var title = FormValidate.getFieldValue('l_title');
            var level = $("#l_language-slider-range-min").slider("value");

            var filter = Langs.language + " - ";

            if (title.length !== 0) {
                filter += title + " " + Langs.with_level + " - " + level + "%";

                _this.language.push({
                    'title': title,
                    'level': level
                });
                var l = $('.ur-filter-l').length;
                $('#user-resume-filters').append("<p class='ur-filter-l mt-3 ml-4 mr-4'>" + filter + " <a data-filter='l' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterSkillsModal').find('input, select').val('');
                $("#l_language-slider-range-min").slider("value", 50);
                $("#l_language-slider-amount").html(50 + "%");
            }, 200);

            $('#filterSkillsModal').modal('hide');
        });

        $('#modal-certification-apply').on('click', function () {
            var title = FormValidate.getFieldValue('cer_title');
            var type = FormValidate.getFieldValue('cer_type');
            var year = FormValidate.getFieldValue('cer_year');

            var filter = Langs.certification + " - ";

            if (title.length !== 0) {
                filter += title + "; " + Langs.type + " - " + type + ";";
                if (year.length !== 0) {
                    filter += " " + Langs.year + " - " + year + ";";
                }

                _this.certification.push({
                    'title': title,
                    'type': type,
                    'year': year
                });
                var l = $('.ur-filter-cer').length;
                $('#user-resume-filters').append("<p class='ur-filter-cer mt-3 ml-4 mr-4'>" + filter + " <a data-filter='c' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }

            setTimeout(function () {
                $('#filterCertificationsModal').find('input').val('');
                $('#filterCertificationsModal').find('select[name="cer_type"]').val('permit');
                $('#filterCertificationsModal').find('select[name="cer_year"]').val('');
            }, 200);

            $('#filterCertificationsModal').modal('hide');
        });

        $('#modal-distinction-apply').on('click', function () {
            var title = FormValidate.getFieldValue('dis_title');
            var year = FormValidate.getFieldValue('dis_year');

            var filter = Langs.distinction + " - ";

            if (title.length !== 0) {
                filter += title + ";";
                if (year.length !== 0) {
                    filter += " " + Langs.year + " - " + year + ";";
                }

                _this.distinction.push({
                    'title': title,
                    'year': year
                });
                var l = $('.ur-filter-dis').length;
                $('#user-resume-filters').append("<p class='ur-filter-dis mt-3 ml-4 mr-4'>" + filter + " <a data-filter='d' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterCertificationsModal').find('input, select').val('');
            }, 200);

            $('#filterCertificationsModal').modal('hide');
        });

        $('#modal-hobby-apply').on('click', function () {
            var title = FormValidate.getFieldValue('h_title');

            var filter = Langs.hobby + " - ";

            if (title.length !== 0) {
                filter += title + ";";

                _this.hobby.push({
                    'title': title
                });
                var l = $('.ur-filter-h').length;
                $('#user-resume-filters').append("<p class='ur-filter-h mt-3 ml-4 mr-4'>" + filter + " <a data-filter='h' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterInterestsModal').find('input, select').val('');
            }, 200);

            $('#filterInterestsModal').modal('hide');
        });

        $('#modal-interest-apply').on('click', function () {
            var title = FormValidate.getFieldValue('i_title');

            var filter = Langs.interest + " - ";

            if (title.length !== 0) {
                filter += title + ";";

                _this.interest.push({
                    'title': title
                });
                var l = $('.ur-filter-i').length;
                $('#user-resume-filters').append("<p data-id='" + l + "' class='ur-filter-i mt-3 ml-4 mr-4'>" + filter + " <a data-filter='i' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterInterestsModal').find('input, select').val('');
            }, 200);

            $('#filterInterestsModal').modal('hide');
        });

        $('#modal-reference-apply').on('click', function () {
            var title = FormValidate.getFieldValue('ref_full_name');
            var company = FormValidate.getFieldValue('ref_company');

            var filter = Langs.reference + " - ";
            var c = 0;

            if (title.length !== 0) {
                filter += Langs.name + " - " + title + ";";
                c++;
            }
            if (company.length !== 0) {
                filter += Langs.company + " - " + company + ";";
                c++;
            }

            if (c !== 0) {
                _this.reference.push({
                    'title': title,
                    'company': company
                });
                var l = $('.ur-filter-ref').length;
                $('#user-resume-filters').append("<p data-id='" + l + "' class='ur-filter-ref mt-3 ml-4 mr-4'>" + filter + " <a data-filter='r' data-id='" + l + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            setTimeout(function () {
                $('#filterReferencesModal').find('input, select').val('');
            }, 200);

            $('#filterReferencesModal').modal('hide');
        });

        var filter_geo = $('#job-location-filter-modal__filter-city_region-search');
        filter_geo.autocomplete({
            source: function (request, response) {
                new GraphQL("query", "geoStreet", {
                    "key": request.term
                }, [
                    'description',
                    'id',
                    'street'
                ], false, false, function () {
                    response([]);
                }, function (data) {
                    if (data.length !== 0) {
                        var transformed = $.map(data, function (el) {
                            return {
                                label: el.description,
                                id: el.id,
                                data: el
                            };
                        });
                        response(transformed);
                    } else {

                    }
                }).autocomplete();
            },
            select: function (event, ui) {
                let html = '<div style="display: inline; margin-right: 5px;">'
                    + '<a href="javascript:void(0)" class="cardinal_links clear-all-filter list-filter-cities-regions-clear-item"><img src="'
                    + document.location.origin
                    + '/img/round-delete-button.svg" style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>'
                    + '<span class="list-filter-cities-regions-value-item" data-geo>' + ui.item.data.description +'</span></div>';
                $('.list-filter-cities-regions').append(html);
            },
            close: function (event, ui) {
                $('#job-location-filter-modal__filter-city_region-search').val('');
            },
            response: function (e, u) {

            }
        }).attr('autocomplete', 'disabled');

        $(document).on('click', '#filters-modal', function(event) {
            var locations = [];
            var locations_loaded = false;
            var jobs = [];
            var jobs_loaded = false;
            var managers = [];
            var managers_loaded = false;

            new GraphQL('query', 'businessLocations', {
                business_id:    _this.businessID,
                limit:          1000000,
            }, [
                'items { id name }',
                'pages',
                'current_page',
            ], true, false, function() {
                //
            }, function(data) {
                locations = data.items;
                locations_loaded = true;
                try_to_continue();
            }, false).request();

            new GraphQL('query', 'businessJobs', {
                business_id:    _this.businessID,
                limit:          1000000,
            }, [
                'items { id title }',
                'pages',
                'current_page',
            ], true, false, function() {
                //
            }, function(data) {
                jobs = data.items;
                jobs_loaded = true;
                try_to_continue();
            }, false).request();

            new GraphQL('query', 'businessManagers', {
                business_id:    _this.businessID,
                limit:          1000000,
            }, [
                'items { id user_id first_name last_name}',
                'pages',
                'current_page',
            ], true, false, function() {
                //
            }, function(data) {
                //managers = data.items;
                var ids_t = [];
                data.items.forEach(function(manager) {
                    if (ids_t.indexOf(manager.user_id)===-1){
                        managers.push(manager);
                        ids_t.push(manager.user_id);
                    }
                });
                managers_loaded = true;
                try_to_continue();
            }, false).request();

            var try_to_continue = function() {
                if (!locations_loaded || !jobs_loaded || !managers_loaded) {
                    return;
                }

                var $filter_city_region_search = $('#job-location-filter-modal__filter-city_region-search');
                var $list_filter_cities_regions = $('.list-filter-cities-regions');
                //$list_filter_cities_regions.children().remove();
                $list_filter_cities_regions.empty();
                $.each(_this.filtering_city_region, function (index, value){
                    let v = value.substr(-1);
                    if (v == 'y') {
                        v = 'data-geo';
                    } else {
                        v = ' ';
                    }
                    let val = value.substr(0,value.length-4);
                    let html = '<div style="display: inline; margin-right: 5px;">'
                        + '<a href="javascript:void(0)" class="cardinal_links clear-all-filter list-filter-cities-regions-clear-item"><img src="'
                        + document.location.origin
                        + '/img/round-delete-button.svg" style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>'
                        + '<span class="list-filter-cities-regions-value-item"' + v +  ' >' + val +'</span></div>';
                    $list_filter_cities_regions.append(html);
                });

                var $all_locations_checkbox = $('#job-location-filter-modal__all-locations-checkbox');
                var $all_jobs_checkbox = $('#job-location-filter-modal__all-jobs-checkbox');
                var $all_managers_checkbox = $('#job-location-filter-modal__all-managers-checkbox');
                $all_locations_checkbox.prop('checked', _this.filtering_location_ids.length == 0);
                $all_jobs_checkbox.prop('checked', _this.filtering_job_ids.length == 0);
                $all_managers_checkbox.prop('checked', _this.filtering_manager_ids.length == 0);

                $all_locations_checkbox.click(function() {
                    $(this).prop('checked', true);

                    $locations.children().each(function() {
                        var $location = $(this);
                        var $location_checkbox = $location.find('input[type="checkbox"]');
                        $location_checkbox.prop('checked', false);
                    });
                });

                var $filter_locations_search = $('#job-location-filter-modal__filter-locations-search');
                $filter_locations_search.keyup(function () {
                    var key = $(this).val();
                    if (key.length > 0 ) {
                        $all_locations_checkbox.prop('checked', false);
                    } else {
                        $all_locations_checkbox.prop('checked', true);
                    }
                    $locations.children().each(function() {
                        $(this).find('input[type="checkbox"]').prop('checked', false);
                    });
                    $('#job-location-filter-modal__locations label').each(function (index, value) {
                        if ($(this).text().indexOf(key) == -1) {
                            $(this).parent().hide();
                        } else {
                            if(!$(this).parent().is(':visible')) {
                                $(this).parent().show();
                            }
                        }
                    });
                });

                $all_jobs_checkbox.click(function() {
                    $(this).prop('checked', true);

                    $jobs.children().each(function() {
                        var $job = $(this);
                        var $job_checkbox = $job.find('input[type="checkbox"]');
                        $job_checkbox.prop('checked', false);
                    });
                });

                var $filter_jobs_search = $('#job-location-filter-modal__filter-jobs-search');
                $filter_jobs_search.keyup(function () {
                    var key = $(this).val();
                    if (key.length > 0 ) {
                        $all_jobs_checkbox.prop('checked', false);
                    } else {
                        $all_jobs_checkbox.prop('checked', true);
                    }
                    $jobs.children().each(function() {
                        $(this).find('input[type="checkbox"]').prop('checked', false);
                    });
                    $('#job-location-filter-modal__jobs label').each(function (index, value) {
                        if ($(this).text().indexOf(key) == -1) {
                            $(this).parent().hide();
                        } else {
                            if(!$(this).parent().is(':visible')) {
                                $(this).parent().show();
                            }
                        }
                    });
                });

                $all_managers_checkbox.click(function() {
                    $(this).prop('checked', true);

                    $managers.children().each(function() {
                        var $manager = $(this);
                        var $manager_checkbox = $manager.find('input[type="checkbox"]');
                        $manager_checkbox.prop('checked', false);
                    });
                });

                var $filter_managers_search = $('#job-location-filter-modal__filter-managers-search');
                $filter_managers_search.keyup(function () {
                    var key = $(this).val();
                    if (key.length > 0 ) {
                        $all_managers_checkbox.prop('checked', false);
                    } else {
                        $all_managers_checkbox.prop('checked', true);
                    }
                    $managers.children().each(function() {
                        $(this).find('input[type="checkbox"]').prop('checked', false);
                    });
                    $('#job-location-filter-modal__managers label').each(function (index, value) {
                        if ($(this).text().indexOf(key) == -1) {
                            $(this).parent().hide();
                        } else {
                            if(!$(this).parent().is(':visible')) {
                                $(this).parent().show();
                            }
                        }
                    });
                });

                var $locations = $('#job-location-filter-modal__locations');
                $locations.html('');

                locations.forEach(function(location) {
                    $('' +
                        '<div class="mb-2" style="display: flex">' +
                            '<input type="checkbox" name="location_ids[]" value="' + location.id + '" class="align-self-center mr-3" id="job-location-filter-modal__location_' + location.id + '">' +
                            '<label class="mb-0" for="job-location-filter-modal__location_' + location.id + '">' + location.name + '</label>' +
                        '</div>' +
                    '').appendTo($locations);
                });

                $locations.children().each(function() {
                    var $location = $(this);
                    var $location_checkbox = $location.find('input[type="checkbox"]');
                    $location_checkbox.prop('checked', _this.filtering_location_ids.indexOf(parseInt($location_checkbox.val())) > -1);

                    $location_checkbox.click(function() {
                        $all_locations_checkbox.prop('checked', false);
                    });
                });

                var $jobs = $('#job-location-filter-modal__jobs');
                $jobs.html('');

                jobs.forEach(function(job) {
                    $('' +
                        '<div class="mb-2" style="display: flex">' +
                            '<input type="checkbox" name="job_ids[]" value="' + job.id + '" class="align-self-center mr-3" id="job-location-filter-modal__job_' + job.id + '">' +
                            '<label class="mb-0" for="job-location-filter-modal__job_' + job.id + '">' + job.title + '</label>' +
                        '</div>' +
                    '').appendTo($jobs);
                });

                $jobs.children().each(function() {
                    var $job = $(this);
                    var $job_checkbox = $job.find('input[type="checkbox"]');
                    $job_checkbox.prop('checked', _this.filtering_job_ids.indexOf(parseInt($job_checkbox.val())) > -1);

                    $job_checkbox.click(function() {
                        $all_jobs_checkbox.prop('checked', false);
                    });
                });

                var $managers = $('#job-location-filter-modal__managers');
                $managers.html('');

                managers.forEach(function(manager) {
                    $('' +
                        '<div class="mb-2" style="display: flex">' +
                        '<input type="checkbox" name="manager_ids[]" value="' + manager.user_id + '" class="align-self-center mr-3" id="job-location-filter-modal__managers_' + manager.user_id + '">' +
                        '<label class="mb-0" for="job-location-filter-modal__manager_' + manager.user_id + '">' + manager.first_name + ' ' + manager.last_name + '</label>' +
                        '</div>' +
                        '').appendTo($managers);
                });

                $managers.children().each(function() {
                    var $manager = $(this);
                    var $manager_checkbox = $manager.find('input[type="checkbox"]');
                    $manager_checkbox.prop('checked', _this.filtering_manager_ids.indexOf(parseInt($manager_checkbox.val())) > -1);

                    $manager_checkbox.click(function() {
                        $all_managers_checkbox.prop('checked', false);
                    });
                });

                $list_filter_cities_regions.on('click','.list-filter-cities-regions-clear-item', function() {
                    $(this).parent().remove();
                });

                $filter_city_region_search.keydown(function(e) {
                    //e = e || event;
                    if (e.keyCode == 13 && $(this).val().length >0) {
                        e.preventDefault();
                        let html = '<div style="display: inline; margin-right: 5px;">'
                                        + '<a href="javascript:void(0)" class="cardinal_links clear-all-filter list-filter-cities-regions-clear-item"><img src="'
                                        + document.location.origin
                                        + '/img/round-delete-button.svg" style="width: 15px; opacity: 0.3; margin-top: -3px; margin-right: 9px;"></a>'
                                        + '<span class="list-filter-cities-regions-value-item">' + $(this).val() +'</span></div>';
                        $list_filter_cities_regions.append(html);
                        $('#ui-id-2').hide();
                        $(this).val('');
                        return false;
                    }
                });

                $('#job-location-filter-modal__apply-button').click(function() {
                    var current_location_ids = [];
                    var current_job_ids = [];
                    var current_manager_ids = [];
                    var current_cities_regions = [];

                    $locations.children().each(function() {
                        var $location = $(this);
                        var $location_checkbox = $location.find('input[type="checkbox"]');

                        if (!$location_checkbox.prop('checked')) {
                            return;
                        }

                        current_location_ids.push(parseInt($location_checkbox.val()));
                    });
                    if (current_location_ids.length == 0 && $filter_locations_search.val().length > 0 && $all_locations_checkbox.is(':checked')) {
                        $locations.children().each(function() {
                            var $location = $(this);
                            var $location_checkbox = $location.find('input[type="checkbox"]');

                            if ($location.is(':visible')) {
                                current_location_ids.push(parseInt($location_checkbox.val()));
                            }
                        });
                    }

                    $jobs.children().each(function() {
                        var $job = $(this);
                        var $job_checkbox = $job.find('input[type="checkbox"]');

                        if (!$job_checkbox.prop('checked')) {
                            return;
                        }

                        current_job_ids.push(parseInt($job_checkbox.val()));
                    });
                    if (current_job_ids.length == 0 && $filter_jobs_search.val().length > 0 && $all_jobs_checkbox.is(':checked')) {
                        $jobs.children().each(function() {
                            var $job = $(this);
                            var $job_checkbox = $job.find('input[type="checkbox"]');

                            if ($job.is(':visible')) {
                                current_job_ids.push(parseInt($job_checkbox.val()));
                            }
                        });
                    }

                    $managers.children().each(function() {
                        var $manager = $(this);
                        var $manager_checkbox = $manager.find('input[type="checkbox"]');

                        if (!$manager_checkbox.prop('checked')) {
                            return;
                        }

                        current_manager_ids.push(parseInt($manager_checkbox.val()));
                    });
                    if (current_manager_ids.length == 0 && $filter_managers_search.val().length > 0 && $all_managers_checkbox.is(':checked')) {
                        $managers.children().each(function() {
                            var $manager = $(this);
                            var $manager_checkbox = $manager.find('input[type="checkbox"]');

                            if ($manager.is(':visible')) {
                                current_manager_ids.push(parseInt($manager_checkbox.val()));
                            }
                        });
                    }

                    $list_filter_cities_regions.children().each(function() {
                        var city_region = $(this).find('.list-filter-cities-regions-value-item'),
                            val = city_region.text();
                         if (city_region.attr('data-geo') !== undefined) {
                             val += '---y';
                         } else {
                             val += '---n';
                         }
                        current_cities_regions.push(val);
                    });

                    _this.filtering_location_ids = current_location_ids;
                    _this.filtering_job_ids = current_job_ids;
                    _this.filtering_manager_ids = current_manager_ids;
                    _this.filtering_city_region = current_cities_regions;
                    _this.getItems();
                    _this.getPipeline(false, true);
                    $('#job-location-filter-modal').modal('hide');
                });

                $('#job-location-filter-modal__clear-button').click(function() {
                    $all_locations_checkbox.prop('checked', true);
                    $all_jobs_checkbox.prop('checked', true);
                    $all_managers_checkbox.prop('checked', true);

                    $locations.children().each(function() {
                        var $location = $(this);
                        var $location_checkbox = $location.find('input[type="checkbox"]');
                        $location_checkbox.prop('checked', false);
                        $location.show();
                    });

                    $jobs.children().each(function() {
                        var $job = $(this);
                        var $job_checkbox = $job.find('input[type="checkbox"]');
                        $job_checkbox.prop('checked', false);
                        $job.show();
                    });

                    $managers.children().each(function() {
                        var $manager = $(this);
                        var $manager_checkbox = $manager.find('input[type="checkbox"]');
                        $manager_checkbox.prop('checked', false);
                        $manager.show();
                    });

                    $list_filter_cities_regions.children().each(function() {
                        $(this).remove();
                    });

                    _this.filtering_location_ids = [];
                    _this.filtering_job_ids = [];
                    _this.filtering_manager_ids = [];
                    _this.filtering_city_region = [];

                    $filter_locations_search.val('');
                    $filter_jobs_search.val('');
                    $filter_managers_search.val('');
                    $filter_city_region_search.val('');
                });

                $('#job-location-filter-modal').modal('show');
            };
        });

        // ------- REALTIME ------- //

        realtime.on('candidates.wave_was_created', function(data) {
            $('.candidate-card[data-candidate-id="' + data.candidate_id + '"]').find('.candidate__wave').show().each(function() {
                if (!$(this).hasClass('animated')) {
                    $('#business-wave-candidate-count').text(parseInt($('#business-wave-candidate-count').text()) + 1);
                }
            }).removeClass('animated bounceIn').each(function() {
                var $self = $(this);

                setTimeout(function() {
                    $self.addClass('animated bounceIn');
                });
            });

            $('.candidate-card[data-candidate-id="' + data.candidate_id + '"]').find('.candidate__dismiss-wave').show()
                .removeClass('animated bounceIn').each(function() {
                var $self = $(this);

                setTimeout(function() {
                    $self.addClass('animated bounceIn');
                });
            });

            _this.getPipeline(false, true);
        });

        realtime.on('candidates.wave_was_deleted', function(data) {
            $('.candidate-card[data-candidate-id="' + data.candidate_id + '"]').find('.candidate__wave').hide();
            $('.candidate-card[data-candidate-id="' + data.candidate_id + '"]').find('.candidate__dismiss-wave').hide();

            setTimeout(function() {
                _this.getPipeline(false, true);
            }, 500);
        });

        $(document).on('click', '.candidate__dismiss-wave', function(event) {
            event.preventDefault();
            var candidate_id = $(this).parents('.candidate-card:first').attr('data-candidate-id');

            new GraphQL('mutation', 'deleteCandidateWave', {
                'candidate_id': candidate_id,
            }, [
                'token',
            ], true, false, function() {
                Loader.stop();
            }, function() {
                //
            }).request();
        });

        //-popup add candidate
        body.on('click', '.candidate_add-show-form', function () {
            $('#candidate_add-resume-attach_file-name').text('');
            $('#candidate_add-form')[0].reset();
            FormValidate.fieldsValidateClear($('#candidate_add-form'));
            $('#candidate_add-form .candidate__user-location').val(currentLocation);
            $('#candidate_add-form .basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
            $('#candidate_add-form .basic-addon1').find('i').addClass('bfh-flag-' + currentCountryCode);
            userCity = currentCity;
            userRegion = currentRegion;
            userCountry = currentCountry;
            userCountryCode =currentCountryCode;
            //$('#candidate_add-form').find('select option').removeAttr('selected');
            $('#candidate_add-form').find('input[name="email"]').val($(this).closest('.card-header').find('h5 span').text());
        });
        $('#candidate_add-resume-attach_file-btn').click(function () {
            $('#candidate_add-resume-attach_file-input').click();
        });
        $('#candidate_add-resume-attach_file-input').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#candidate_add-resume-attach_file-name').text(filename);
            $('#candidate_add-resume-delete-btn').show();
            $('#candidate_resume_delete_input').val(false);
        });
        body.on('click', '#candidate_add-resume-delete-btn, #candidate_edit-resume-delete-btn', function () {
            $('#candidate_add-resume-attach_file-input, #candidate_edit-resume-attach_file-input').val('');
            $('#candidate_add-resume-attach_file-name, #candidate_edit-resume-attach_file-name').text('');
            $('#candidate_resume_delete_input').val(true);
            $(this).hide();
        });
        $('#candidate_add-form').on('click keydown', 'input', function () {
            FormValidate.fieldValidateClear($(this));
        });
        body.on('click', '#candidate_add-btn-click', function () {
            var form = $('#candidate_add-form');
            var language_prefix = 'en';
            if (business.currentData.language) {
                language_prefix = business.currentData.language.prefix;
            }

            new GraphQL("mutation", "createUserImport", {
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "email": FormValidate.getFieldValue('email', form),
                "mobile_phone": FormValidate.getFieldValue('mobile_phone', form),
                "invite_business_id": +_this.businessID,
                "language_prefix": language_prefix,
                //"pipeline_id": $('#candidate_add-select-pipeline').val(),
                "job_id": +$('#candidate_add-select-job').val(),
                "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
                "region": userRegion || '',
                "country": userCountry || '',
                "country_code": userCountryCode,
            }, [
                'pipeline',
                //'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {
                var urlData = explode('/business/candidate/', document.location.pathname);
                if (urlData[1] && urlData[1] === 'manage-ats') {
                    BusinessATS.getList();
                }
                if (urlData[1] && urlData[1] === 'manage') {
                    _this.getItems();
                    _this.getPipeline(false, true);
                }
                $('#addNewCandidate').modal('hide');
            },form,new FormData(form.get(0))).request();
        });
        //-popup edit candidate
        body.on('click', '.candidate_edit-show-form', function () {
            $('#candidate_edit-resume-attach_file-name').text('');
            $('#candidate_edit-form')[0].reset();
            //$('#candidate_add-form').find('select option').removeAttr('selected');
            var id = $(this).attr('data-id');
            new GraphQL('query', 'businessCandidate', {
                id: id,
            }, [
                'user {first_name last_name email mobile_phone attach_file city region country country_code} pipeline job_id id',
            ], true, false, function() {
                //
            }, function(data) {
                if (data.user.attach_file) {
                    $('#candidate_edit-resume-delete-btn').show();
                }
                $('#candidate_edit-resume-attach_file-name').text(data.user.attach_file);
                $('#candidate_edit-form').find('input[name="id"]').val(data.id);
                $('#candidate_edit-form').find('input[name="first_name"]').val(data.user.first_name);
                $('#candidate_edit-form').find('input[name="last_name"]').val(data.user.last_name);
                $('#candidate_edit-form').find('input[name="email"]').val(data.user.email);
                $('#candidate_edit-form').find('input[name="mobile_phone"]').val(data.user.mobile_phone);
                $('#candidate_edit-form').find('select option').removeAttr('selected');
                $('#candidate_edit-select-pipeline').val(data.pipeline);
                $('#candidate_edit-select-jov').val(data.job_id);
                userCity = data.user.city;
                userRegion = data.user.region;
                userCountry = data.user.country;
                userCountryCode = data.user.country_code;
                var location = data.user.city;
                if (data.user.region !== null) {
                    location += "," + data.user.region;
                }
                if (data.user.country !== null) {
                    location += "," + data.user.country;
                }
                $('#candidate_edit-form').find('input[name="city"]').val(location);
                $('#candidate_edit-form .basic-addon1').find('i').removeClassRegex(/^bfh-flag-/);
                $('#candidate_edit-form .basic-addon1').find('i').addClass('bfh-flag-' + userCountryCode);

            }, false).request();
        });
        $('#candidate_edit-resume-attach_file-btn').click(function () {
            $('#candidate_edit-resume-attach_file-input').click();
        });
        $('#candidate_edit-resume-attach_file-input').change(function () {
            var filename = $(this).val();
            filename = filename.substr(filename.lastIndexOf('\\')+1);
            $('#candidate_edit-resume-attach_file-name').text(filename);
            $('#candidate_edit-resume-delete-btn').show();
            $('#candidate_resume_delete_input').val(false);
        });
        $('#candidate_edit-form').on('click keydown', 'input', function () {
            FormValidate.fieldValidateClear($(this));
        });
        body.on('click', '#candidate_edit-btn-click', function () {
            var form = $('#candidate_edit-form');

            new GraphQL("mutation", "updateUserImport", {
                "id" : FormValidate.getFieldValue('id', form),
                "first_name": FormValidate.getFieldValue('first_name', form),
                "last_name": FormValidate.getFieldValue('last_name', form),
                "email": FormValidate.getFieldValue('email', form),
                "mobile_phone": FormValidate.getFieldValue('mobile_phone', form),
                "pipeline_id": $('#candidate_edit-select-pipeline').val(),
                "job_id": +$('#candidate_edit-select-job').val(),
                "city": (userCity && userCity !== "") ? userCity : FormValidate.getFieldValue('city'),
                "region": userRegion,
                "country": userCountry,
                "country_code": userCountryCode,
            }, [
                'pipeline',
                //'token'
            ], true, false, function () {
                Loader.stop();
            }, function (data) {
                _this.getItems();
                _this.getPipeline(false, true);
                $('#editCandidate').modal('hide');
            },form,new FormData(form.get(0))).request();
        });

        (function initialize_multilanguage() {
            var default_language = 'en';

            if (business.currentData.language) {
                default_language = business.currentData.language.prefix || 'en';
            }

            $('select[name="current_language_prefix"]').children('option').each(function() {
                $(this).text($(this).text().replace(/\s+\(Default\)$/, ''));
            });

            $('select[name="current_language_prefix"]').children('option[value="' + default_language + '"]').each(function() {
                $(this).text($(this).text() + ' (Default)');
            });

            $('select[name="current_language_prefix"]').val(default_language);

            $('select[name="current_language_prefix"]').change(function() {
                var current_language_prefix = $(this).val();

                body.find('.multilanguage').addClass('d-none');
                body.find('.multilanguage-' + $(this).val()).removeClass('d-none');

                // changing localized name in job category jack:

                // var available_locales = [
                //     current_language_prefix,
                // ].concat($(this).children().toArray().map(function(element) {
                //     return $(element).val();
                // }).filter(function(current_locale) {
                //     return current_locale != current_language_prefix;
                // }));

                //
            });

            this.form.find('.multilanguage').addClass('d-none');
            this.form.find('.multilanguage-' + default_language).removeClass('d-none');

            this.form.find('.multilanguage').parent().find('label:first').each(function() {
                $(this).html($(this).html() + ' (' + default_language + ')');
            });
        }).apply(this);

        _this.initFilterForJob();
        _this.updateBusinessInformer();

        var form = $('.candidate__user-form');
        var locationField = form.find('.candidate__user-location');
        var clearLocationField = form.find('.candidate__location-clear');
        if (locationField.length > 0) {
            GEO.init();
            //clear location field and focus
            clearLocationField.click(function () {
                locationField.val('');
                locationField.focus();
                clearLocationField.parent().addClass('hide');
                locationField.parent().parent().find('.glyphicon').attr('class','glyphicon');
                userCity = "";
                userRegion = "";
                userCountry = "";
                userCountryCode = "";
            });
            //autocomplete locations
            locationField.autocomplete({
                source: function (request, response) {
                    if (request.term.length === 0) {
                        clearLocationField.parent().addClass('hide');
                        locationField.addClass('autocomplete-border');
                    } else {
                        clearLocationField.parent().removeClass('hide');
                        locationField.removeClass('autocomplete-border');
                    }
                    //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler
                    new GraphQL("query", "geo", {
                        "key": request.term
                    }, ['fullName', 'city', 'region', 'country', 'countryCode'], false, false, function () {
                        response([]);
                    }, function (data) {
                        if (data.length !== 0) {
                            var transformed = $.map(data, function (el) {
                                return {
                                    label: el.fullName,
                                    id: el.countryCode,
                                    data: el
                                };
                            });
                            response(transformed);
                        } else {
                            userCity = "no_geo_data";
                            userRegion = "";
                            userCountry = "";
                            userCountryCode = "";
                            locationField.removeClass('ui-autocomplete-loading');
                        }
                    }).autocomplete();
                },
                select: function (event, ui) {
                    userCity = ui.item.data.city;
                    userRegion = ui.item.data.region;
                    userCountry = ui.item.data.country;
                    userCountryCode = ui.item.id;
                    var flag = $('.basic-addon1');
                    flag.find('i').removeClassRegex(/^bfh-flag-/);
                    flag.find('i').addClass('bfh-flag-' + ui.item.id);
                },
                response: function (e, u) {
                    locationField.removeClass('ui-autocomplete-loading');
                }
            }).attr('autocomplete', 'disabled').autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                    .append('<span><i class="glyphicon bfh-flag-' + item.id + '"></i> </span><span>' + item.label + '</span>')
                    .appendTo(ul);
            };

            locationField.keydown(function () {
                userCity = "no_geo_data";
                userRegion = "";
                userCountry = "";
                userCountryCode = "";
                locationField.parent().find('.glyphicon').attr('class','glyphicon');
                FormValidate.fieldValidateClear($(this));
            });
        }

    },

    CountRatingCandidate: function (userId) {
        var rating = 0;
        var count = 0;
        $.map(this.notes[userId], function (item) {
            if (item['rating']) {
                count++;
                rating += item['rating'];
            }
        });
        rating = rating / count;
        return rating.toFixed();
    },

    openJobFilterModal: function() {
        //
    },

    updateBusinessInformer: function() {
        // var current_count_of_candidates = business.currentData.plan_id * 1000;

        // if (current_count_of_candidates < window.active_pricing_strategy.free_version_candidates) {
        //     current_count_of_candidates = window.active_pricing_strategy.free_version_candidates;
        // };

        // $('.business-current-plan-limits-informer').text(business.currentData.count_of_clicked_candidates + ' / ' + current_count_of_candidates);

        // if (business.currentData.plan_id) {
        //     $('.business-on-free-plan-message').hide();
        //     $('.business-has-non-free-plan-message').show();
        // }
        // else {
        //     $('.business-on-free-plan-message').show();
        //     $('.business-has-non-free-plan-message').hide();
        // }
    },

    canClickOnCandidate: function($candidate_card) {
        // if (parseInt($candidate_card.attr('data-clicked') || '0')) {
        //     return true; // the candidate was clicked on, allow to click again
        // }

        // var candidates_count_per_step = window.active_pricing_strategy ? window.active_pricing_strategy.candidates : 1000;
        // var current_count_of_candidates = window.active_pricing_strategy.free_version_candidates;

        // if (business.currentData.plan_id > 0) {
        //     current_count_of_candidates = business.currentData.plan_id * candidates_count_per_step;
        // }

        // if (business.currentData.count_of_clicked_candidates < current_count_of_candidates) {
        //     return true;
        // }

        // return false;
    },

    clickOnCandidateRequest: function($candidate_card) {
        // var _this = this;

        // new GraphQL('mutation', 'candidateClickedOn', {
        //     business_id: business.currentData.id,
        //     candidate_id: $candidate_card.attr('data-candidate-id'),
        // }, [
        //     'id',
        //     'token',
        // ], true, false, function() {
        //     Loader.stop();
        // }, function(data) {
        //     $candidate_card.attr('clicked-on', '1');

        //     new GraphQL('query', 'business', {
        //         'id': business.currentID,
        //     }, [
        //         'count_of_clicked_candidates',
        //     ], true, false, function() {
        //         Loader.stop();
        //     }, function(data) {
        //         business.currentData.count_of_clicked_candidates = data.count_of_clicked_candidates
        //         _this.updateBusinessInformer();
        //     }, false).request();
        // }, false).request();
    },
    preferenceClear: function () {
        var modal = $('#filterPreferenceModal');
        modal.find('input[name="c_new_job"]').parent().removeClass('active');
        modal.find('input[name="c_new_opportunities"]').parent().removeClass('active');
        modal.find('input[name="c_distance"]').val('');
        modal.find('input[name="c_salary"]').val('');
        modal.find('input[name="c_distance_type"]').parent().removeClass('active');
        modal.find('input[name="c_distance_type"][value="km"]').prop('checked', true).parent().addClass('active');
        $("#c_hourly_salary").slider("values", [5, 60]);
        if(this.msIndustry){
            this.msIndustry.setSelection([]);
        }
        if(this.msSubIndustry){
            this.msSubIndustry.setSelection([]);
        }
    },
    availabilityClear: function () {
        var modal = $('#filterAvailabilitiesModal');
        modal.find('input[type="checkbox"]').prop('checked', false).parent().removeClass('active');
    },
    basicClear: function () {
        var modal = $('#filterBasicModal');
        modal.find('input[type="text"]').val('');
    },
    setResumeFilter: function (data) {
        var _this = this;
        if (data) {
            if (data.p) {
                _this.preference = data.p;

                var modal = $('#filterPreferenceModal');
                _this.preferenceClear();

                var filter = Langs.job_preference + " - ";
                filter += Langs.new_job + " - " + data.p.new_job + "; ";
                modal.find('input[name="c_new_job"][value="' + data.p.new_job + '"]').prop('checked', true).parent().addClass('active');
                filter += Langs.new_opportunities + " - " + data.p.new_opportunities + "; ";
                modal.find('input[name="c_new_opportunities"][value="' + data.p.new_opportunities + '"]').prop('checked', true).parent().addClass('active');
                if (data.p.distance) {
                    filter += Langs.distance + " - " + data.p.distance + " " + data.p.distance_type + "; ";
                    modal.find('input[name="c_distance"]').val(data.p.distance);
                    modal.find('input[name="c_distance_type"]').parent().removeClass('active');
                    modal.find('input[name="c_distance_type"][value="' + data.p.distance_type + '"]').prop('checked', true).parent().addClass('active');
                }
                if (data.p.salary) {
                    filter += Langs.salary + " - " + data.p.salary + "; ";
                    modal.find('input[name="c_salary"]').val(data.p.salary);
                }
                filter += Langs.hours_from + " " + data.p.hours_from + " to " + data.p.hours_to + ";";
                $("#c_hourly_salary").slider("values", [data.p.hours_from, data.p.hours_to]);

                var ind = [];
                if (data.p.industries) {
                    var industries = "";
                    $.map(data.p.industries, function (item) {
                        industries += item.name + ",";
                        ind.push(item.id);
                    });
                    filter += Langs.industries + " - " + industries + ";";
                }
                var sub = [];
                if (data.p.sub_industries) {
                    var industries = "";
                    $.map(data.p.sub_industries, function (item) {
                        industries += item.name + ",";
                        sub.push(item.id);
                    });
                    filter += Langs.sub_industries + " - " + industries + ";";
                }
                if (ind.length !== 0) {
                    _this.getIndustry(false, ind.join(","), sub.join(","));
                }

                $('#user-resume-filters').append("<p id='ur-filter-1' class='mt-3 ml-4 mr-4'>" + filter + " <a data-filter='p' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
            }
            if (data.a) {
                _this.availability = data.a;

                var modal = $('#filterAvailabilitiesModal');
                _this.availabilityClear();

                var filter = Langs.availability + " - ";
                var c = 0;
                if (data.a.full_time) {
                    c++;
                    filter += Langs.full_time + ";";
                    modal.find('input[name="full_name"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.part_time) {
                    c++;
                    filter += Langs.part_time + ";";
                    modal.find('input[name="part_time"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.internship) {
                    c++;
                    filter += Langs.internship + ";";
                    modal.find('input[name="internship"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.contractual) {
                    c++;
                    filter += Langs.contractual + ";";
                    modal.find('input[name="contractual"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.summer_positions) {
                    c++;
                    filter += Langs.summer_positions + ";";
                    modal.find('input[name="summer_positions"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.recruitment) {
                    c++;
                    filter += Langs.recruitment + ";";
                    modal.find('input[name="recruitment"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.field_placement) {
                    c++;
                    filter += Langs.field_placement + ";";
                    modal.find('input[name="field_placement"]').prop('checked', true).parent().addClass('active');
                }
                if (data.a.volunteer) {
                    c++;
                    filter += Langs.volunteer + ";";
                    modal.find('input[name="volunteer"]').prop('checked', true).parent().addClass('active');
                }

                if (c !== 0) {
                    $('#user-resume-filters').append("<p id='ur-filter-2' class='mt-3 ml-4 mr-4'>" + filter + " <a data-filter='a' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                }
            }
            if (data.b) {
                _this.basic = data.b;

                var modal = $('#filterBasicModal');
                _this.basicClear();

                var filter = Langs.basic_info + " - ";
                var c = 0;
                if (data.b.headline) {
                    c++;
                    filter += Langs.headline + " - " + data.b.headline + "; ";
                    modal.find('input[name="headline"]').val(data.b.headline);
                }
                if (data.b.location) {
                    c++;
                    filter += Langs.location + " - " + data.b.location + "; ";
                    modal.find('input[name="b_location"]').val(data.b.location);
                }

                if (c !== 0) {
                    $('#user-resume-filters').append("<p id='ur-filter-3' class='mt-3 ml-4 mr-4'>" + filter + " <a data-filter='b' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                }
            }
            if (data.e) {
                _this.education = data.e;
                $.each(data.e, function (k, v) {
                    var filter = Langs.education + " - ";
                    var c = 0;
                    if (v.school_name.length !== 0) {
                        c++;
                        filter += Langs.school_name + " - " + v.school_name + "; ";
                    }
                    if (v.location.length !== 0) {
                        c++;
                        filter += Langs.location + " - " + v.location + "; ";
                    }
                    if (v.year_from.length !== 0) {
                        c++;
                        filter += Langs.year_from + " - " + v.year_from + "; ";
                    }
                    if (v.year_to.length !== 0) {
                        c++;
                        filter += Langs.year_to + " - " + v.year_to + "; ";
                    }
                    if (v.grade.length !== 0) {
                        c++;
                        filter += Langs.grade  + " - " + v.grade + "; ";
                    }

                    if (c !== 0) {
                        $('#user-resume-filters').append("<p class='ur-filter-e mt-3 ml-4 mr-4'>" + filter + " <a data-filter='e' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.ex) {
                _this.experience = data.ex;
                $.each(data.ex, function (k, v) {
                    var filter = Langs.experience + " - ";
                    var c = 0;
                    if (v.title.length !== 0) {
                        c++;
                        filter += Langs.title + " - " + v.title + "; ";
                    }
                    if (v.company.length !== 0) {
                        c++;
                        filter += Langs.company + " - " + v.company + "; ";
                    }
                    if (v.location.length !== 0) {
                        c++;
                        filter += Langs.location + " - " + v.location + "; ";
                    }
                    if (v.date_from.length !== 0) {
                        c++;
                        filter += Langs.date_from + " - " + v.date_from + "; ";
                    }
                    if (v.date_to.length !== 0) {
                        c++;
                        filter += Langs.date_to + " - " + v.date_to + "; ";
                    }

                    var ind = [];
                    if (v.industries) {
                        c++;
                        var industries = "";
                        $.map(v.industries, function (item) {
                            industries += item.name + ",";
                            ind.push(item.id);
                        });
                        filter += Langs.industries + " - " + industries + ";";
                    }
                    var sub = [];
                    if (v.sub_industries) {
                        c++;
                        var industries = "";
                        $.map(v.sub_industries, function (item) {
                            industries += item.name + ",";
                            sub.push(item.id);
                        });
                        filter += Langs.sub_industries + " - " + industries + ";";
                    }
                    // if (ind.length !== 0) {
                    //     _this.getExIndustry(false, ind.join(","), sub.join(","));
                    // }

                    if (c !== 0) {
                        $('#user-resume-filters').append("<p class='ur-filter-ex mt-3 ml-4 mr-4'>" + filter + " <a data-filter='ex' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.s) {
                _this.skill = data.s;
                $.each(data.s, function (k, v) {
                    var filter = Langs.skill + " - ";

                    if (v.title.length !== 0) {
                        filter += v.title + " " + Langs.with_level + " - " + v.level + "%";
                        $('#user-resume-filters').append("<p class='ur-filter-sk mt-3 ml-4 mr-4'>" + filter + " <a data-filter='s' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.l) {
                _this.language = data.l;
                $.each(data.l, function (k, v) {
                    var filter = Langs.language + " - ";

                    if (v.title.length !== 0) {
                        filter += v.title + " " + Langs.with_level + " - " + v.level + "%";
                        $('#user-resume-filters').append("<p class='ur-filter-l mt-3 ml-4 mr-4'>" + filter + " <a data-filter='l' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.c) {
                _this.certification = data.c;
                $.each(data.c, function (k, v) {
                    var filter = Langs.certification + " - ";

                    if (v.title.length !== 0) {
                        filter += v.title + "; " + Langs.type + " - " + v.type + ";";
                        if (v.year.length !== 0) {
                            filter += " " + Langs.year + " - " + v.year + ";";
                        }
                        $('#user-resume-filters').append("<p class='ur-filter-cer mt-3 ml-4 mr-4'>" + filter + " <a data-filter='c' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.d) {
                _this.distinction = data.d;
                $.each(data.d, function (k, v) {
                    var filter = Langs.distinction + " - ";
                    if (v.title.length !== 0) {
                        filter += v.title + ";";
                        if (v.year.length !== 0) {
                            filter += " " + Langs.year + " - " + v.year + ";";
                        }
                        $('#user-resume-filters').append("<p class='ur-filter-dis mt-3 ml-4 mr-4'>" + filter + " <a data-filter='d' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.year+"</a> </p>");
                    }
                });
            }
            if (data.h) {
                _this.hobby = data.h;
                $.each(data.h, function (k, v) {
                    var filter = Langs.hobby + " - ";

                    if (v.title.length !== 0) {
                        filter += v.title + ";";
                        $('#user-resume-filters').append("<p class='ur-filter-h mt-3 ml-4 mr-4'>" + filter + " <a data-filter='h' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.i) {
                _this.interest = data.i;
                $.each(data.i, function (k, v) {
                    var filter = Langs.interest + " - ";

                    if (v.title.length !== 0) {
                        filter += v.title + ";";
                        $('#user-resume-filters').append("<p class='ur-filter-i mt-3 ml-4 mr-4'>" + filter + " <a data-filter='i' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
            if (data.r) {
                _this.reference = data.r;
                $.each(data.r, function (k, v) {
                    var filter = Langs.reference + " - ";
                    var c = 0;

                    if (v.title.length !== 0) {
                        filter += Langs.name + " - " + v.title + ";";
                        c++;
                    }
                    if (v.company.length !== 0) {
                        filter += Langs.company + " - " + v.company + ";";
                        c++;
                    }

                    if (c !== 0) {
                        $('#user-resume-filters').append("<p class='ur-filter-ref mt-3 ml-4 mr-4'>" + filter + " <a data-filter='r' data-id='" + k + "' href='javascript:void(0)' class='remove-f'>"+Langs.remove+"</a> </p>");
                    }
                });
            }
        }
    },
    userNotes: function (id) {
        var _this = this;
        var html = '';
        $.map(_this.notes[id], function (item) {
            var html_plus = '';
            if (item.attach_file) {
                html_plus += '<br><span>file - <a href="/candidate/' + id + '/' + item.attach_file + '" target="_blank"><small>' + item.attach_file + '</small></a></span> ';
            }
            if (item.rating) {
                if (html_plus.length ==0) {
                    html_plus = '<br>';
                }
                html_plus += '<span>rating - <small>' + item.rating + '</small></span>';
            }
            html += '<div class="d-flex px-3 mt-3 candidate-note-item">\n' +
                '    <div>\n' +
                '        <img class="mr-3" src="' + item.manager.user_pic + '"\n' +
                '             style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                '    </div>\n' +
                '    <div>\n' +
                '        <p class="mb-0"><strong>' + item.manager.first_name + ' ' + item.manager.last_name + '</strong></p>\n' +
                '        <span><small class="candidate-note-message">' + item.message + '</small></span>\n' +
                html_plus +
                '    </div>\n' +
                '    <div class="ml-auto text-right">\n' +
                '        <p class="mb-1">' + item.date + '</p>'+
                '        <button type="button" class="btn btn-outline-primary btn-sm candidate-note-item-delete" data-id="' + item.id + '"> <small>Delete</small> </button>' +
                '    </div>\n' +
                '</div>\n' +
                '<hr>';
        });
        $('#notes-modal-body').html(html);

        $('#candidate_notes').find('#candidate-note-add').attr('data-id', id);
        $('#candidate_notes').modal('show');
    },
    createChat: function(id, send) {
        var _this = this;

        var params = {
            "business_id": _this.businessID,
            "with_user_id": id,
        };

        new GraphQL('query', 'chat', params, [
            'id',
            'token',
        ], true, false, function() {
            Loader.stop();
        }, function(data) {
            if (!data || !data.id) {
                var createParams = {
                    "business_id": _this.businessID,
                    "with_user_id": id
                };
                new GraphQL("mutation", "createChat", createParams, [
                    'id',
                    'token',
                ], true, false, function () {
                    Loader.stop();
                }, function (data) {
                    _this.chatID = data.id;
                    _this.chatRoom = data.room;
                    if (send) {
                        _this.sendMessageToUser($('#candidate-send-message').val());
                    } else {
                        _this.sendMessageToUser($('#candidate-send-message').val(), function() {
                            _this.openChat();
                        });
                    }
                }, false).request();
            } else {
                _this.chatID = data.id;
                _this.chatRoom = data.room
                if (send) {
                    _this.sendMessageToUser($('#candidate-send-message').val());
                } else {
                    _this.sendMessageToUser($('#candidate-send-message').val(), function() {
                        _this.openChat();
                    });
                }
            }
        }, false).request();
    },
    sendMessageToUser: function(message, done) {
        var createParams = {
            "chat_id": this.chatID,
            "business_id": parseInt(this.businessID),
            "text": message,
        };
        new GraphQL("mutation", "createChatMessage", createParams, [
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('#send-message').modal('hide');
            $.notify('Instant message sent!', 'success');
            done && done(data);
        }, false).request();

    },
    openChat: function () {
        localStorage.setItem('chatRoom', this.chatRoom);
        location.href = $('#candidate-send-message-and-chat-open').data('link');
    },
    sendMessage: function (id) {
        var _this = this;
        var html = '';
        $.map(_this.notes[id], function (item) {
            html += '<div class="d-flex px-3 mt-3">\n' +
                '    <div>\n' +
                '        <img class="mr-3" src="' + item.manager.user_pic + '"\n' +
                '             style="width: 40px; height: 40px; box-shadow: 0 4px 10px 0 rgba(0, 0, 0, 0.14), 0 1px 2px 0 rgba(0, 0, 0, 0.12), 0 3px 1px -2px rgba(0, 0, 0, 0.2); border-radius: 5px;">\n' +
                '    </div>\n' +
                '    <div>\n' +
                '        <p class="mb-0"><strong>' + item.manager.first_name + ' ' + item.manager.last_name + '</strong></p>\n' +
                '        <span><small>' + item.message + '</small></span>\n' +
                '    </div>\n' +
                '    <div class="ml-auto">\n' +
                '        ' + item.date +
                '    </div>\n' +
                '</div>\n' +
                '<hr>';
        });
        $('#send-modal-body').html(html);


        $('#send-message').find('#candidate-send-add').attr('data-id', id);
        $('#send-message').find('#candidate-send-message-and-chat-open').attr('data-id', id);
        $('#send-message').find('#candidate-send-interview-request').attr('data-user-id', id);
        $('#send-message').modal('show');
    },
    resumeRequest: function (id) {
        var _this = this;
        var html = '';
        var remind = 0;
        var name = $('.candidate-card[data-id="' + id + '"]').find('.candidate-name').text();
        $.map(_this.requests[id], function (item) {
            if (item.response === 1) {
                html += '<div class="d-flex mt-3 px-3">\n' +
                    '                                            <div class="ml-auto">\n' +
                    '<span class="mr-3 badge badge-success">\n' +
                    '  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                    '       id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 94.026 94.026"\n' +
                    '       style="enable-background:new 0 0 94.026 94.026; vertical-align: middle; margin-top: -3px;"\n' +
                    '       xml:space="preserve" fill="#ffffff">\n' +
                    '  <g>\n' +
                    '      <g>\n' +
                    '          <g>\n' +
                    '              <path d="M76.497,6.772c3.207,4.848,3.565,12.041,1.078,21.434c6.192,2.121,14.082,8.084,15.953,24.516     c1.612,14.15-0.69,24.828-6.856,31.734c-4.978,5.579-11.988,8.407-20.841,8.407c-14.853,0-31.035-8.331-34.131-10.002     c-2.996-1.619-4.857-4.741-4.857-8.146V35.249c0-4.497,3.213-8.331,7.646-9.118c1.334-0.235,13.113-2.533,15.66-10.566     c2.774-8.749,9.098-14.402,16.112-14.402C70.4,1.163,74.131,3.206,76.497,6.772z M37.066,74.136     c3.143,1.646,16.955,8.504,28.766,8.504c5.895,0,10.217-1.633,13.213-4.989c4.143-4.642,5.598-12.638,4.328-23.771     c-1.215-10.654-5.619-16.543-12.404-16.583l-7.16-0.042l2.367-6.759c2.982-8.516,3.654-15.275,1.801-18.076     c-0.313-0.471-0.864-1.033-1.715-1.033c-1.971,0-4.871,2.548-6.367,7.268C55.903,31.247,41.545,35.13,37.067,36.046     L37.066,74.136L37.066,74.136z"/>\n' +
                    '          </g>\n' +
                    '          <g>\n' +
                    '              <path d="M20.011,82.123V30.336c0-1.118-0.906-2.024-2.025-2.024H2.023C0.906,28.312,0,29.218,0,30.336v51.787     c0,1.119,0.906,2.024,2.023,2.024h15.963C19.105,84.147,20.011,83.242,20.011,82.123z M13.927,76.173     c0,2.162-1.76,3.922-3.922,3.922c-2.162,0-3.922-1.76-3.922-3.922s1.76-3.922,3.922-3.922     C12.167,72.251,13.927,74.011,13.927,76.173z"/>\n' +
                    '          </g>\n' +
                    '      </g>\n' +
                    '  </g>\n' +
                    '  </svg>\n' +
                    name + ' ' + Langs.updated_his_resume +
                    '</span>\n' +
                    '                          <span>' + item.date + '</span>\n' +
                    '                      </div>\n' +
                    '                  </div>\n' +
                    '                  <hr>';
            } else {
                remind = 1;
                html += '<div class="d-flex px-3">\n' +
                    '                       <div>\n' +
                    '                           <button type="button" class="btn btn-outline-warning" id="candidate-resume-remind" data-id="' + item.id + '" data-user-id="' + id + '">'+Langs.remind+'</button>\n' +
                    '                       </div>\n' +
                    '                       <div class="ml-auto pt-2">\n' +
                    ' <span class="mr-3 badge badge-warning">\n' +
                    '   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"\n' +
                    '        id="Capa_1" x="0px" y="0px" width="13px" height="13px" viewBox="0 0 97.16 97.16"\n' +
                    '        style="enable-background:new 0 0 97.16 97.16; vertical-align: middle; margin-top: -3px;"\n' +
                    '        xml:space="preserve">\n' +
                    '   <g>\n' +
                    '       <g>\n' +
                    '           <path d="M48.58,0C21.793,0,0,21.793,0,48.58s21.793,48.58,48.58,48.58s48.58-21.793,48.58-48.58S75.367,0,48.58,0z M48.58,86.823    c-21.087,0-38.244-17.155-38.244-38.243S27.493,10.337,48.58,10.337S86.824,27.492,86.824,48.58S69.667,86.823,48.58,86.823z"/>\n' +
                    '           <path d="M73.898,47.08H52.066V20.83c0-2.209-1.791-4-4-4c-2.209,0-4,1.791-4,4v30.25c0,2.209,1.791,4,4,4h25.832    c2.209,0,4-1.791,4-4S76.107,47.08,73.898,47.08z"/>\n' +
                    '       </g>\n' +
                    '   </g>\n' +
                    '   </svg>\n' +
                    Langs.request_sent_waiting + '    ' + name +
                    ' </span>\n' +
                    '                           <span>' + item.date + '</span>\n' +
                    '                       </div>\n' +
                    '                   </div>\n' +
                    '                   <hr>';
            }

        });
        if (remind === 0 || _this.requests[id].length === 0) {
            $('#candidate-resume-send-button').removeClass('hide');
        } else {
            $('#candidate-resume-send-button').addClass('hide');
        }
        $('#candidate-resume-modal-body').html(html);
    },
    setFilters: function () {
        var _this = this;
        var types = [];
        if (this.msJobTypes) {
            types = $.map(this.msJobTypes.getSelection(), function (item) {
                return item.id;
            }).join(',');
        }
        var languages = [];
        if (this.msLanguages) {
            languages = $.map(this.msLanguages.getSelection(), function (item) {
                return item.id;
            }).join(',');
        }
        var certifications = [];
        if (this.msCertificates) {
            certifications = $.map(this.msCertificates.getSelection(), function (item) {
                return item.id;
            }).join(',');
        }
        var departments = [];
        if (this.msDepartments) {
            departments = $.map(this.msDepartments.getSelection(), function (item) {
                return item.id;
            }).join(',');
        }
        var categories = [];
        if (this.msCategory) {
            categories = $.map(this.msCategory.getSelection(), function (item) {
                return item.id;
            }).join(',');
        }

        var interestedJobs = [];
        $("input:checkbox[name=interested_jobs]:checked").each(function () {
            interestedJobs.push($(this).val());
        });
        var interested_jobs = interestedJobs.join(",");
        var type = [];
        $("input:checkbox[name=current_type]:checked").each(function () {
            type.push($(this).val());
        });
        var cJob = [];
        $("input:checkbox[name=current_job]:checked").each(function () {
            cJob.push($(this).val());
        });
        var lJob = [];
        $("input:checkbox[name=looking_job]:checked").each(function () {
            lJob.push($(this).val());
        });
        var current_type = type.join(",");
        var current_job = cJob.join(",");
        var looking_job = lJob.join(",");
        var availabilities = +FormValidate.getCheckedFieldValue("availabilities");
        var title = FormValidate.getFieldValue('title');
        var location = FormValidate.getFieldValue('location');
        var hours = FormValidate.getFieldValue('hours');
        var timeArray1 = [];
        var timeArray2 = [];
        var timeArray3 = [];
        var timeArray4 = [];
        $("input:checkbox[name=time_1]:checked").each(function () {
            timeArray1.push($(this).val());
        });
        $("input:checkbox[name=time_2]:checked").each(function () {
            timeArray2.push($(this).val());
        });
        $("input:checkbox[name=time_3]:checked").each(function () {
            timeArray3.push($(this).val());
        });
        $("input:checkbox[name=time_4]:checked").each(function () {
            timeArray4.push($(this).val());
        });
        var time1 = timeArray1.join(",");
        var time2 = timeArray2.join(",");
        var time3 = timeArray3.join(",");
        var time4 = timeArray4.join(",");

        var filters = '';
        if (types.length !== 0) {
            filters += 'types:' + types + ';';
        }
        if (languages.length !== 0) {
            filters += 'languages:' + languages + ';';
        }
        if (certifications.length !== 0) {
            filters += 'certifications:' + certifications + ';';
        }
        if (departments.length !== 0) {
            filters += 'departments:' + departments + ';';
        }
        if (categories.length !== 0) {
            filters += 'categories:' + categories + ';';
        }
        if (interested_jobs.length !== 0) {
            filters += 'interested_jobs:' + interested_jobs + ';';
        }
        if (type.length !== 0) {
            filters += 'current_type:' + current_type + ';';
        }
        if (cJob.length !== 0) {
            filters += 'current_job:' + current_job + ';';
        }
        if (lJob.length !== 0) {
            filters += 'looking_job:' + looking_job + ';';
        }
        if (availabilities.length !== 0 && (timeArray1.length !== 0 || timeArray2.length !== 0 || timeArray3.length !== 0 || timeArray4.length !== 0)) {
            filters += 'availabilities:' + availabilities + ';';
        }
        if (title.length !== 0) {
            filters += 'title:' + title + ';';
        }
        if (location.length !== 0) {
            filters += 'location:' + location + ';';
        }
        if (hours.length !== 0) {
            filters += 'hours:' + hours + ';';
        }
        if (time1.length !== 0) {
            filters += 'time1:' + time1 + ';';
        }
        if (time2.length !== 0) {
            filters += 'time2:' + time2 + ';';
        }
        if (time3.length !== 0) {
            filters += 'time3:' + time3 + ';';
        }
        if (time4.length !== 0) {
            filters += 'time4:' + time4 + ';';
        }

        var resumeFilter = {};
        if (Object.keys(_this.preference).length !== 0)
            resumeFilter['p'] = _this.preference;
        if (Object.keys(_this.availability).length !== 0)
            resumeFilter['a'] = _this.availability;
        if (Object.keys(_this.basic).length !== 0)
            resumeFilter['b'] = _this.basic;
        if (_this.education.length !== 0)
            resumeFilter['e'] = _this.education;
        if (_this.experience.length !== 0)
            resumeFilter['ex'] = _this.experience;
        if (_this.skill.length !== 0)
            resumeFilter['s'] = _this.skill;
        if (_this.language.length !== 0)
            resumeFilter['l'] = _this.language;
        if (_this.certification.length !== 0)
            resumeFilter['c'] = _this.certification;
        if (_this.distinction.length !== 0)
            resumeFilter['d'] = _this.distinction;
        if (_this.hobby.length !== 0)
            resumeFilter['h'] = _this.hobby;
        if (_this.interest.length !== 0)
            resumeFilter['i'] = _this.interest;
        if (_this.reference.length !== 0)
            resumeFilter['r'] = _this.reference;

        if (Object.keys(resumeFilter).length !== 0) {
            var url = JSON.stringify(resumeFilter);
            url = url.replaceAll("&", "_*_");
            filters += "r_f:" + url;
        }

        if (filters.length !== 0 || (filters.length === 0 && getUrlParameter('filters'))) {
            updateQueryStringParam('filters', filters);
            this.getItems();
            if (filters.length === 0) {
                removeQueryStringParam('filters');
            }
        }
        $('#jobfiltermodal').modal('hide');
    },
    getIndustry: function (sub, val, subVal) {
        var _this = this;
        if (sub) {
            if (typeof val === 'string') {
                _this.msIndustryValue = explode(",", val);
            }
        }
        if (subVal) {
            if (typeof subVal === 'string') {
                _this.msSubIndustryValue = explode(",", subVal);
            }
        }
        var select = (sub) ? $('#sub_industries') : $('#industries');
        var params = (sub) ? {parent_id: sub} : {};
        new GraphQL("query", "industries", params, [
            'id',
            'name'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                if (!sub) {
                    _this.industries = data;
                    if (_this.msIndustry) {
                        _this.msIndustry.setData(data);
                    } else {
                        _this.msIndustry = select.magicSuggest({
                            placeholder: Langs.choose_industry,
                            toggleOnClick: true,
                            allowFreeEntries: false,
                            data: data,
                            required: true,
                            hideTrigger: true,
                            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                            cls: 'jack input_style industries_box field-box'
                        });
                    }
                    if (val) {
                        var v = explode(",", val);
                        _this.msIndustry.setValue(v);
                        _this.getIndustry(val, val, subVal);
                    }
                } else {
                    if (_this.msSubIndustry) {
                        _this.msSubIndustry.setData(data);
                    } else {
                        _this.msSubIndustry = select.magicSuggest({
                            placeholder: Langs.choose_sub_industry,
                            toggleOnClick: true,
                            allowFreeEntries: false,
                            data: data,
                            hideTrigger: true,
                            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                            cls: 'jack input_style industries_box field-box'
                        });
                        if (subVal) {
                            var v = explode(",", subVal);
                            _this.msSubIndustry.setValue(v);
                        }
                    }
                }
                var a = _this.msIndustry;
                if (sub) {
                    a = _this.msSubIndustry;
                }
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#industries');
                    if (!sub) {
                        if (this.getValue().length !== 0) {
                            var id = this.getValue();
                            _this.msIndustryValue = id;
                            _this.msSubIndustryValue = null;
                            if (_this.msSubIndustry) {
                                _this.msSubIndustry.clear();
                            }
                            _this.getIndustry(id, id, null);
                        } else {
                            _this.msSubIndustry.clear();
                            _this.msSubIndustry.setData([]);
                            _this.msIndustryValue = null;
                            _this.msSubIndustryValue = null;
                        }
                    } else {
                        var id = this.getValue();
                        _this.msSubIndustryValue = id;
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
    },
    getExIndustry: function (sub, val, subVal) {
        var _this = this;
        if (sub) {
            if (typeof val === 'string') {
                _this.msExIndustryValue = explode(",", val);
            }
        }
        if (subVal) {
            if (typeof subVal === 'string') {
                _this.msSubExIndustryValue = explode(",", subVal);
            }
        }
        var select = (sub) ? $('#ex_sub_industries') : $('#ex_industries');
        var params = (sub) ? {parent_id: sub} : {};
        new GraphQL("query", "industries", params, [
            'id',
            'name'
        ], false, false, function () {
            Loader.stop();
        }, function (data) {
            if (data) {
                if (!sub) {
                    _this.industries = data;
                    if (_this.msExIndustry) {
                        _this.msExIndustry.setData(data);
                    } else {
                        _this.msExIndustry = select.magicSuggest({
                            placeholder: Langs.choose_industry,
                            toggleOnClick: true,
                            allowFreeEntries: false,
                            data: data,
                            required: true,
                            hideTrigger: true,
                            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                            cls: 'jack input_style industries_box field-box'
                        });
                    }
                    if (val) {
                        var v = explode(",", val);
                        _this.msExIndustry.setValue(v);
                        _this.getExIndustry(val, val, subVal);
                    }
                } else {
                    if (_this.msSubExIndustry) {
                        _this.msSubExIndustry.setData(data);
                    } else {
                        _this.msSubExIndustry = select.magicSuggest({
                            placeholder: Langs.choose_sub_industry,
                            toggleOnClick: true,
                            allowFreeEntries: false,
                            data: data,
                            hideTrigger: true,
                            noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                            cls: 'jack input_style industries_box field-box'
                        });
                        if (subVal) {
                            var v = explode(",", subVal);
                            _this.msSubExIndustry.setValue(v);
                        }
                    }
                }
                var a = _this.msExIndustry;
                if (sub) {
                    a = _this.msSubExIndustry;
                }
                $(a).unbind('selectionchange');
                $(a).on('selectionchange', function () {
                    FormValidate.fieldValidateClear('#industries');
                    if (!sub) {
                        if (this.getValue().length !== 0) {
                            var id = this.getValue();
                            _this.msExIndustryValue = id;
                            _this.msSubExIndustryValue = null;
                            if (_this.msSubExIndustry) {
                                _this.msSubExIndustry.clear();
                            }
                            _this.getExIndustry(id, id, null);
                        } else {
                            _this.msSubExIndustry.clear();
                            _this.msSubExIndustry.setData([]);
                            _this.msExIndustryValue = null;
                            _this.msSubExIndustryValue = null;
                        }
                    } else {
                        var id = this.getValue();
                        _this.msSubExIndustryValue = id;
                    }
                });
                Loader.contentLoader = true;
                Loader.loaderToElement = select;
                Loader.stop();
            }
        }).request(select, false, false);
    },
    msFields: function () {
        var _this = this;

        var categories;
        var departments;
        var types;
        var certifications;
        var languages;
        if (getUrlParameter('filters')) {
            var filters = getUrlParameter('filters');
            var f = explode('r_f:', filters);
            if (typeof f[0] !== 'undefined') {
                var filtersData = explode(';', f[0]);
                var modal = $('#jobfiltermodal');
                for (var i = 0; i < filtersData.length; i++) {
                    if (filtersData[i].length !== 0) {
                        var data = explode(':', filtersData[i]);
                        var name = data[0];
                        var info = (data[1]) ? data[1] : false;
                        switch (name) {
                            case 'current_type':
                                var items = explode(",", info);
                                $.map(items, function (item) {
                                    $('input[name="current_type"][value="' + item + '"]').prop('checked', 'checked').parent().addClass('active');
                                });
                                break;
                            case 'current_job':
                                var items = explode(",", info);
                                $.map(items, function (item) {
                                    $('input[name="current_job"][value="' + item + '"]').prop('checked', 'checked').parent().addClass('active');
                                });
                                break;
                            case 'looking_job':
                                var items = explode(",", info);
                                $.map(items, function (item) {
                                    $('input[name="looking_job"][value="' + item + '"]').prop('checked', 'checked').parent().addClass('active');
                                });
                                break;
                            case 'interested_jobs':
                                var items = explode(",", info);
                                $.map(items, function (item) {
                                    $('input[name="interested_jobs"][value="' + item + '"]').prop('checked', 'checked').parent().addClass('active');
                                });
                                break;
                            case 'availabilities':
                                $('input[name="availabilities"]').prop('checked', false).parent().removeClass('active');
                                $('input[name="availabilities"][value="' + info + '"]').prop('checked', 'checked').parent().addClass('active');
                                break;
                            case 'time1':
                                _this.setDefaultAvailabilities(1, info);
                                break;
                            case 'time2':
                                _this.setDefaultAvailabilities(2, info);
                                break;
                            case 'time3':
                                _this.setDefaultAvailabilities(3, info);
                                break;
                            case 'time4':
                                _this.setDefaultAvailabilities(4, info);
                                break;
                            case 'title':
                                modal.find('input[name="title"]').val(info);
                                break;
                            case 'location':
                                modal.find('input[name="location"]').val(info);
                                break;
                            case 'hours':
                                modal.find('input[name="hours"]').val(info);
                                break;
                            case 'departments':
                                departments = info;
                                break;
                            case 'categories':
                                categories = info;
                                break;
                            case 'types':
                                types = info;
                                break;
                            case 'languages':
                                languages = info;
                                break;
                            case 'certifications':
                                certifications = info;
                                break;
                        }
                    }
                }
            }
            if (typeof f[1] !== 'undefined') {
                var url = f[1];
                url = url.replaceAll("_*_", "&");
                var rF = JSON.parse(url);
                _this.setResumeFilter(rF);
            }
        }

        var params = {
            "business_id": _this.businessID,
            "limit": 0
        };
        if (departments) {
            params['default'] = departments;
        }
        new GraphQL("query", "businessDepartments", params, ['items{id name}, default {id name}'], false, false, function (data) {
            //show error
        }, function (data) {
            if (data.items) {
                _this.msDepartments = _this.msDepartmentsElement.magicSuggest({
                    placeholder: Langs.choose_departments,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: data.items,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
            }
            if (data.default) {
                _this.msDepartments.setSelection(data.default);
            }
        }).request(_this.msDepartmentsElement);

        new GraphQL("query", "categories", false, ['id name'], false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                _this.msCategory = _this.msCategoryElement.magicSuggest({
                    placeholder: Langs.choose_categories,
                    toggleOnClick: true,
                    allowFreeEntries: false,
                    data: data,
                    hideTrigger: true,
                    noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                    cls: 'jack'
                });
            }
            if (categories) {
                _this.msCategory.setValue(explode(",", categories));
            }
        }).request(_this.msCategoryElement);

        this.getMSList(function (items, defaultData) {
            _this.msJobTypes = _this.msJobTypesElement.magicSuggest({
                placeholder: Langs.type_contract_type,
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack'
            });
            if (defaultData) {
                _this.msJobTypes.setSelection(defaultData);
            }
            var timeout = null;
            $(_this.msJobTypes).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msJobTypes.setData(items);
                    }, 'jobTypes', _this.msJobTypesElement, _this.msJobTypes.getRawValue());
                }, 500);
            });
        }, 'jobTypes', _this.msJobTypesElement, undefined, types);

        this.getMSList(function (items, defaultData) {
            _this.msLanguages = _this.msLanguagesElement.magicSuggest({
                placeholder: Langs.ex_languages,
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack'
            });
            if (defaultData) {
                _this.msLanguages.setSelection(defaultData);
            }
            var timeout = null;
            $(_this.msLanguages).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msLanguages.setData(items);
                    }, 'worldLanguages', _this.msLanguagesElement, _this.msLanguages.getRawValue());
                }, 500);
            });
        }, 'worldLanguages', _this.msLanguagesElement, undefined, languages);

        this.getMSList(function (items, defaultData) {
            _this.msCertificates = _this.msCertificatesElement.magicSuggest({
                placeholder: Langs.type_certificate,
                toggleOnClick: true,
                allowFreeEntries: false,
                data: items,
                hideTrigger: true,
                noSuggestionText: '<strong>{{query}}</strong> ' + Langs.not_found,
                cls: 'jack'
            });
            if (defaultData) {
                _this.msCertificates.setSelection(defaultData);
            }
            var timeout = null;
            $(_this.msCertificates).on('keyup', function () {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    _this.getMSList(function (items) {
                        _this.msCertificates.setData(items);
                    }, 'certificates', _this.msCertificatesElement, _this.msCertificates.getRawValue());
                }, 500);
            });
        }, 'certificates', _this.msCertificatesElement, undefined, certifications);

    },
    setDefaultAvailabilities: function (n, info) {
        var time = info.split(",");
        var i = 1;
        $.each(time, function (k, v) {
            $('input[name="time_' + n + '"][value="' + v + '"]').prop('checked', true);
            i += 1;
        });
        if (time.length === 7) {
            $('#user-availabilities').find('input[data-time="' + (n - 1) + '"]').prop('checked', true);
        }
    },
    getMSList: function (callback, method, el, keywords, defaultData) {
        var params = {};
        var need = ['items{id name}'];
        if (keywords) {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
            }
        }
        if (defaultData) {
            params['default'] = defaultData;
            need.push('default{id name}')
        }

        new GraphQL("query", method, params, need, false, false, function (data) {
            //show error
        }, function (data) {
            if (data) {
                var items = $.map(data.items, function (item) {
                    return {
                        id: item.id,
                        name: item.name
                    };
                });
                callback(items, data.default);
            }
        }).request(el);
    },

    injectFilterParameters: function(parameters) {

    },

    //get all items by page type
    getItems: function (keywords, show, data) {
        var _this = this;
        var params = {
            "business_id": this.businessID
        };
        if (this.sort) {
            params['sort'] = this.sort;
        }
        if (this.order) {
            params['order'] = this.order;
        }
        params['limit'] = this.perPage;
        params['page'] = this.currentPage;

        if (p = getUrlParameter('p')) {
            params['p'] = p;
        } else {
            if (data) {
                var pipeline = data.type;
                if (data.type === 'custom') {
                    pipeline = data.id;
                }
                params['p'] = pipeline;
            } else {
                params['p'] = 'new';
            }
        }
        if (_this.myLocations === 0) {
            params['m'] = 0;
        }

        params['only_waves'] = _this.only_waves;
        _this.currentPipeline = params['p'];

        var notShowLoader = (show) ? show : false;

        if (typeof keywords !== 'undefined') {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
                this.search = 0;
            } else {
                if (this.search === 1) {
                    return;
                } else {
                    this.search = 1;
                }
            }
            notShowLoader = true;
        } else if (keywords = getUrlParameter('search')) {
            if (keywords.length > 1) {
                params['keywords'] = keywords;
            }
            $('#business-' + this.type + '-search').val(keywords);
        }

        if (getUrlParameter('filters')) {
            params['filters'] = Base64.encode(getUrlParameter('filters'));
            $('#filter-status').removeClass('hide');
        }

        if (_this.all_candidates != 'yes') {
            params['looking_job'] = _this.looking_job;
            params['its_urgent'] = _this.its_urgent;
            params['new_job'] = _this.new_job;
        }

        params['filtering_location_ids'] = _this.filtering_location_ids;
        params['filtering_job_ids'] = _this.filtering_job_ids;
        params['filtering_manager_ids'] = _this.filtering_manager_ids;
        params['filtering_city_region'] = _this.filtering_city_region;

        var listElement = $('.business-' + this.type + '-list');
        var needItems = '';
        var headers = true;

        switch (this.type) {
            case 'candidate':
                needItems = 'id job_id ' +
                    'user{id looking_job its_urgent new_job} ' +
                    'location{id name} ' +
                    'html ' +
                    'requests{id response date} ' +
                    'viewed{manager{first_name last_name user_pic} date} ' +
                    'notes{manager{first_name last_name user_pic} rating id message attach_file date}' +
                    'history{' +
                    'candidate{ ' +
                    ' location{name city region country country_code} ' +
                    ' job{id title} ' +
                    ' user{id city region country country_code is_import} ' +
                    ' business{name city region country country_code picture_50(width:50,height:50)} ' +
                    ' date' +
                    ' user_video' +
                    ' thumbnail_url} ' +
                    'pipeline{' +
                    ' pipeline ' +
                    '  manager{' +
                    '   first_name ' +
                    '   last_name ' +
                    '   user_pic} ' +
                    '  date }' +
                    '}';
                break;
        }
        var need = [
            'items {' +
            needItems +
            '}',
            'pages',
            'current_page',
            'count',
            'wave_count',
            'query',
            'token'
        ];

        var locale = APIStorage.read('language');
        if (locale != 'en') {
            params['locale'] = locale;
        }

        new GraphQL("query", this.queryItems, params, need, headers, false, function () {
            Loader.stop();
        }, function (data) {
            console.log("this.queryItems");
            console.log(data);
            listElement.html('');
            if (data.items) {
                $.map(data.items, function (item) {
                    var el = $(item.html);
                    el.find('.candidate-viewed-count').text(item.viewed.length);
                    listElement.append(el);
                    _this.viewed[item.user.id] = item.viewed;
                    _this.history[item.user.id] = item.history;
                    _this.requests[item.user.id] = item.requests;
                    _this.notes[item.user.id] = item.notes;
                });
            }
            $('#business-candidate-counts').text(data.count);
            $('#business-wave-candidate-count').text(data.wave_count);
            $('#pipeline-current').text($('#pipeline-buttons button[data-id="' + params['p'] + '"]').find('p span:last').text());
            _this.countPages = data.pages;
            _this.pagination(data.pages);
        }).request((notShowLoader) ? listElement : false);
    },
    editPipeline: function () {
        var _this = this;
        _this.getPipeline(true);

        var form = $('#pipeline-add-form');

        var listElement = $('#pipeline-sortable');

        var need = [
            'items {' +
            'html' +
            '}',
            'token'
        ];

        $('#pipeline-sortable').sortable({
            axis: 'y',
            update: function (event, ui) {
                var element = $(this).children('.pipeline-item');
                var positions = [];
                for (var i = 0; i < element.length; i++) {
                    positions[i] = +$(element.eq(i)).attr('data-id');
                }
                var data = JSON.stringify(positions);
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
                new GraphQL("mutation", _this.queryUpdatePositionPipeline, {
                    "business_id": _this.businessID,
                    "data": data
                }, ['token'], true, false, function () {
                    Loader.stop();
                }, function () {

                }).request();
            }
        });
        $('#pipeline-sortable').disableSelection();

        $('#pipeline-add').on('click', function () {
            new GraphQL("mutation", _this.query, {
                business_id:  _this.businessID,
                name:         FormValidate.getFieldValue('name', form),
                name_fr:      FormValidate.getFieldValue('name_fr', form),
                icon:         FormValidate.getFieldValue('icon', form),
            }, need, true, false, function () {
                Loader.stop();
            }, function (data) {
                var html = '';
                if (data.items) {
                    $.map(data.items, function (item) {
                        html += item.html;
                    });
                    listElement.html(html);
                    $('#pipeline-add-name-en').val('');
                    $('#pipeline-add-name-fr').val('');

                }

                var current_language_prefix = $('select[name="current_language_prefix"]').val();
                $('.multilanguage').addClass('d-none');
                $('.multilanguage-' + current_language_prefix).removeClass('d-none');
            }, form).request();
        });

        $('#pipeline-add-name-en').on('keyup', function () {
            FormValidate.fieldsValidateClear(form);
        });

        $('#pipeline-add-name-fr').on('keyup', function () {
            FormValidate.fieldsValidateClear(form);
        });

        $('#pipeline-sortable').on('click', '.pipeline-item-delete', function () {
            _this.currentID = $(this).attr('data-id');
            new GraphQL("query", "pipelineItem", {
                "id": _this.currentID,
                "business_id": _this.businessID
            }, ['candidates', 'token'], true, false, function () {
                Loader.stop();
            }, function (data) {
                if (data.candidates === 0) {
                    $('#deleteModal').modal('show');
                } else {
                    var modal = $('#deleteCModal');
                    modal.find('.modal-body span').text(data.candidates);
                    modal.modal('show')
                }
            }).request();
        });

        //confirm item delete
        $('.pipeline-confirm-delete').on('click', function () {
            var type = $(this).attr('data-type');
            _this.deletePipeline(type);
        });

        $('body').on('change', '.pipeline-edit-item-name', function() {
            var pipeline_id = $(this).attr('data-id');
            var name = $('.pipeline-edit-item-name[data-id="' + pipeline_id + '"][data-name="name"]').val();
            var name_fr = $('.pipeline-edit-item-name[data-id="' + pipeline_id + '"][data-name="name_fr"]').val();

            if (pipeline_id && (name.length != 0)) {
                //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
                new GraphQL("mutation", _this.queryUpdatePipeline, {
                    id:             pipeline_id,
                    business_id:    _this.businessID,
                    name:           name,
                    name_fr:        name_fr,
                }, [ 'token' ], true, false, function () {
                    //
                }, function() {

                }).request();
            }
        });

        $('body').on('click', '.pipeline-edit-item-internal__item', function(event) {
            var $dropdown = $(this).parents('.dropdown:first');
            event.preventDefault();
            var id = $(this).attr('data-id');
            var internal = parseInt($(this).attr('data-internal'));

            new GraphQL("mutation", _this.queryUpdatePipeline, {
                "id": id,
                "business_id": _this.businessID,
                "internal": internal,
            }, [ 'token' ], true, false, function () {
                Loader.stop();
            }, function() {
                $dropdown.find('.pipeline-edit-item-internal__title').text(internal ? Langs.internal : Langs.external);
            }).request();
        });

        $('body').on('click', '.pipeline-add-item-icon__item', function(event) {
            var $dropdown = $(this).parents('.dropdown:first');
            event.preventDefault();
            var icon = $(this).attr('data-icon');
            var svg_content = $(this).html();
            $dropdown.find('.pipeline-add-item-icon__title').html(svg_content);
            $dropdown.parents('form:first').find('input[name="icon"]').val(icon);
        });

        $('body').on('click', '.pipeline-edit-item-icon__item', function(event) {
            var $dropdown = $(this).parents('.dropdown:first');
            event.preventDefault();
            var id = $(this).attr('data-id');
            var icon = $(this).attr('data-icon');
            var svg_content = $(this).html();

            new GraphQL("mutation", _this.queryUpdatePipeline, {
                "id": id,
                "business_id": _this.businessID,
                "icon": icon,
            }, [ 'token' ], true, false, function () {
                Loader.stop();
            }, function() {
                $dropdown.find('.pipeline-edit-item-icon__title').html(svg_content);
            }).request();
        });
    },
    deletePipeline: function (type) {
        if (this.currentID) {
            var _this = this;
            //buildSchema, typeQuery, paramsQuery, needParamsFromResponse, headers, redirectTo, errorHandler, successHandler, form
            new GraphQL("mutation", _this.queryDeletePipeline, {
                "id": _this.currentID,
                "business_id": _this.businessID,
                "type": +type
            }, ['token'], true, false, function () {
                Loader.stop();
            }, function () {
                $('.pipeline-item[data-id="' + _this.currentID + '"]').remove();
                $('#business-candidate-counts').text(+$('#business-candidate-counts').text() - 1);
                $('#deleteModal').modal('hide');
                $('#deleteCModal').modal('hide');
            }, this.form).request();
        }
    },
    getPipeline: function (edit, update_only_counts) {
        var _this = this;
        var params = {
            "business_id": this.businessID
        };

        var filter_params = {};

        if (_this.all_candidates != 'yes') {
            filter_params['looking_job'] = _this.looking_job;
            filter_params['its_urgent'] = _this.its_urgent;
            filter_params['new_job'] = _this.new_job;
        }

        filter_params.filtering_location_ids = _this.filtering_location_ids;
        filter_params.filtering_job_ids = _this.filtering_job_ids;

        var filter_params_as_string = function() {
            return Object.keys(filter_params).reduce(function(params, filter_param_key) {
                return params.concat(filter_param_key + ': ' + JSON.stringify(filter_params[filter_param_key]));
            }, []).join(', ');
        };

        var listElement = $('#pipeline-buttons');
        var filter_params_string = filter_params_as_string();

        var needItems = [
            'id',
            'name',
            'name_fr',
            'localized_name',
            'type',
            'icon',
            'type_new',
            'not_delete',
            'candidates' + (filter_params_string ? '(' + filter_params_string + ')' : ''),
            'waving_candidates' + (filter_params_string ? '(' + filter_params_string + ')' : ''),
        ].join(' ');

        if (edit) {
            needItems = 'html';
            listElement = $('#pipeline-sortable');
        }
        var need = [
            'items {' +
                needItems +
            '}',
            'token',
        ];

        var current_p_match = window.location.search.match(/[?&]p=([a-z0-9]+)$|[?&]p=([a-z0-9]+)&/);
        var current_p = null;

        if (current_p_match) {
            current_p = current_p_match.slice(1).reduce(function(pipeline, current_pipeline) {
                return pipeline || current_pipeline;
            });
        }

        if (update_only_counts) {
            Loader.disabled = true;
        }

        new GraphQL("query", this.queryPipeline, params, need, true, false, function () {
            if (!update_only_counts) {
                Loader.stop();
            }
        }, function (data) {
            Loader.disabled = false;

            console.log(data);

            if (update_only_counts) {
                data.items.forEach(function(pipeline_item) {
                    var data_id = pipeline_item.type;

                    if (!pipeline_item.type || pipeline_item.type == 'custom') {
                        data_id = pipeline_item.id;
                    }

                    var $pipeline_item = $('.p-item[data-id="' + data_id + '"]:first');
                    $pipeline_item.find('.p-item');
                    var $count_of_candidates = $pipeline_item.find('.p-item__count-of-candidates');
                    $count_of_candidates.text(pipeline_item.candidates)
                    var $count_of_waving_candidates = $pipeline_item.find('.p-item__count-of-waving-candidates');

                    if (pipeline_item.waving_candidates > 0) {
                        if (parseInt($count_of_waving_candidates.text()) != pipeline_item.waving_candidates) {
                            $count_of_waving_candidates.text(pipeline_item.waving_candidates).addClass('animated bounceIn').css({
                                'visibility': 'visible',
                            });

                            setTimeout(function() {
                                $count_of_waving_candidates.removeClass('animated bounceIn');
                            }, 100);
                        }
                    }
                    else {
                        $count_of_waving_candidates.text('0').css({ 'visibility': 'hidden' });
                    }
                });

                return;
            }

            var html = '';
            var html_select = '';

            if (data.items) {
                $.map(data.items, function (item, k) {
                    if (edit) {
                        html += item.html;
                    }
                    else {
                        var pipeline = item.type;

                        if (!item.type || item.type == 'custom') {
                            pipeline = item.id;
                        }

                        html += '' +
                            '<button class="p-item btn btn-outline-primary rounded-0 flex-1 py-2 mt-0 releative" type="button" data-id="' + pipeline + '">' +
                                '<span class="mb-0">' + $('#pipeline-icon-' + (item.icon || 'default')).html() + '</span>' +
                                '<p class="mb-0 mt-1" style="font-size:12px;" data-id="' + item.id + '">' +
                                    '<span>' +
                                        '<strong class="p-item__count-of-candidates">' + item.candidates + '</strong>' +
                                    '</span>' +
                                    ' ' +
                                    '<span style="font-weight:lighter;">' + item.localized_name + '</span>' +
                                '</p>' +
                                ' ' +
                                '<span class="[ p-item__count-of-waving-candidates ] notification_dashboard_business" style="font-size: 12px !important; top:-8px; right:3px; opacity:0.7; ' + (item.waving_candidates == 0 ? 'visibility: hidden;' : '') + '">' + item.waving_candidates + '</span>' +
                            '</button>' +
                        '';

                        html_select += '<option value="' + pipeline +'">' + item.localized_name + '</option>';
                    }
                });

                listElement.html(html);
                //$('#candidate_add-select-pipeline').html(html_select);
                $('#candidate_edit-select-pipeline').html(html_select);

                var current_pipeline = data.items.reduce(function(current_pipeline, item) {
                    if (current_pipeline) {
                        return current_pipeline;
                    }

                    if (item.id == current_p || item.type == current_p) {
                        return item;
                    }

                    return null;
                }, null);

                current_pipeline = current_pipeline || data.items[1];
                $('.p-item[data-id="' + (current_pipeline.type == 'custom' ? current_pipeline.id : current_pipeline.type) + '"]').addClass('active');

                if (!edit) {
                    _this.getItems(undefined, true, current_pipeline);
                }
            }
        }).request(listElement);
        new GraphQL('query', 'brandsJobs', {
            business_id:    _this.businessID,
        }, [
            'items { id title business_locations__business_id business__name}',
        ], true, false, function() {
            //
        }, function(data) {
            let brands = {};
            data.items.forEach(job => {
                if (brands[job.business__name]) {
                    //jobs[job.business_locations__business_id][job.id] = job;
                } else {
                    brands[job.business__name] = {};
                    //jobs[job.business_locations__business_id][job.id] = job;
                }
                brands[job.business__name][job.id] = job;
            });
            var html_select = '<option value="0" readonly="" selected>Enter Job applied to</option>';

            /*$.map(data.items, function (item, k) {
                html_select += '<option value="' + item.id +'">' + item.title + '</option>';
            });*/
            $.map(brands, function (jobs, k) {
                html_select += '<optgroup label="' + k + '">';
                $.map(jobs, function (job, l) {
                    html_select += '<option value="' + job.id +'">' + job.title + '</option>';
                });
                html_select += '</optgroup>';
            });

            $('#candidate_add-select-job').html(html_select);
            $('#candidate_edit-select-job').html(html_select);
        }, false).request();
    },
    //pagination for items list
    pagination: function (pages) {
        var _this = this;
        var html = '';
        if (pages > 1) {
            html = '<li class="page-item"><a class="page-link page-prev" href="javascript:void(0)"><</a></li>';
            for (var i = 1; i <= pages; i++) {
                var active = '';
                if (_this.currentPage === i) {
                    active = 'active';
                }
                html += '<li class="page-item ' + active + '"><a class="page-link page" href="javascript:void(0)">' + i + '</a></li>';
            }
            html += '<li class="page-item"><a class="page-link page-next" href="javascript:void(0)">></a></li>';
        }
        $('.pagination-content').html(html);
    },
    initFilterForJob: function () {
        var _this = this;

        var update_all_candidates_trigger = function() {
            var at_least_one_checked = [
                _this.looking_job   == 'yes',
                _this.its_urgent    == 'yes',
                _this.new_job       == 'yes',
            ].some(function(result) {
                return result;
            });

            if (at_least_one_checked) {
                _this.all_candidates = 'no';
                $('#filter-all_candidates').prop('checked', false);
            }
            else {
                _this.all_candidates = 'yes';
                $('#filter-all_candidates').prop('checked', true);
            }
        };

        $('#filter-all_candidates').click(function() {
            $('#filter-looking_job').prop('checked', false);
            _this.looking_job = 'no';
            $('#filter-its_urgent').prop('checked', false);
            _this.its_urgent = 'no';
            $('#filter-new_job').prop('checked', false);
            _this.new_job = 'no';
            update_all_candidates_trigger();

            setTimeout(function() {
                _this.getItems();
                _this.getPipeline(false, true);
            }, 0);
        });

        $('#filter-looking_job').click(function() {
            var value;

            if ($(this).is(':checked')) {
                value = 'yes';
                $('#sidebar-its_urgent').closest('.block-checkbox').show();
                $('#sidebar-new_job').closest('.block-checkbox').hide();
            }
            else {
                value = 'no';
                $('#sidebar-its_urgent').closest('.block-checkbox').hide();
                $('#sidebar-new_job').closest('.block-checkbox').show();
            }

            _this.looking_job = value;
            update_all_candidates_trigger();

            setTimeout(function() {
                _this.getItems();
                _this.getPipeline(false, true);
            }, 0);
        });

        $('#filter-its_urgent').click(function () {
            var value;

            if ($(this).is(':checked')) {
                value = 'yes';
            }
            else {
                value = 'no';
            }

            _this.its_urgent = value;
            update_all_candidates_trigger();

            setTimeout(function() {
                _this.getItems();
                _this.getPipeline(false, true);
            }, 0);
        });

        $('#filter-new_job').click(function () {
            var value;

            if ($(this).is(':checked')) {
                value = 'yes';
            }
            else {
                value = 'no';
            }

            _this.new_job = value;
            update_all_candidates_trigger();

            setTimeout(function() {
                _this.getItems();
                _this.getPipeline(false, true);
            }, 0);
        });

        update_all_candidates_trigger();
    }
};
$(document).ready(function () {
    // setTimeout(function () {
    loadPromise.then(function () {
        var url = document.location.pathname;
        var pages = ['candidate'];
        var BusinessApplicant;
        var method;
        var page;
        for (var i = 0; i < pages.length; i++) {
            page = pages[i];
            var m = explode(page, url);
            if (typeof m[1] !== 'undefined') {
                method = m;
                break;
            }
        }
        if (typeof method !== 'undefined') {
            BusinessApplicant = new BusinessApplicants(page);
            BusinessApplicant.init();
            switch (method[1]) {
                // case '/add':
                //     app.scripts(BusinessItem.create());
                //     break;
                case '/edit':
                    app.scripts(BusinessApplicant, 'editPipeline');
                    // app.scripts(BusinessApplicant.editPipeline());
                    break;
                // case '/clone':
                //     app.scripts(BusinessItem.clone());
                //     break;
                default:
                    app.scripts(BusinessApplicant, 'getPipeline');
                    // app.scripts(BusinessApplicant.getPipeline());
                    break;
            }
        }
        // app.run();
    }).then(function () {
        app.runPromise();
    });
    // }, 500);
});
