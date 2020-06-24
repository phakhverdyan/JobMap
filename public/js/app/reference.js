
function Reference() {

    this.incoming = [];
    this.confirmed = [];
    this.requested = [];
    this.incomingCount = 0;
    this.elemIncomingCount = $('.countReferences');

}

Reference.prototype = {
    init: function () {
        Loader.init();

        if (APIStorage.read('reference-back')) {
            $('#references__goto-resume-builder').show();
            APIStorage.remove('reference-back');
        }

        this.get();

        this.initEvents();
    },
    get: function () {
        var _this = this;
        new GraphQL("query", "references", {}, [
            'incoming{' +
                'id user_id email phone full_name company status html' +
            '}',
            'confirmed{' +
                'id user_id email phone full_name company status html' +
            '}',
            'requested{' +
                'id user_id email phone full_name company status html' +
            '}',
            'token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            _this.setData(data);
            _this.show();
        }, false).request();
    },
    setData: function (data) {
        var _this = this;
        _this.incoming = data.incoming;
        _this.confirmed = data.confirmed;
        _this.requested = data.requested;
        _this.incomingCount = data.incoming.length;
    },
    show: function () {
        var _this = this;
        if (_this.incomingCount == 0) {
            _this.elemIncomingCount.text('').fadeOut();

        } else {
            _this.elemIncomingCount.text(_this.incomingCount).fadeIn();
        }
        _this.showItemsType('incoming',_this.incoming);
        _this.showItemsType('confirmed',_this.confirmed);
        _this.showItemsType('requested',_this.requested);
    },
    showItemsType: function (type,data) {
        var block = $('#block-'+type),
            noBlock = $('#no-'+type);
        if (data.length == 0) {
            noBlock.fadeIn();
        } else {
            noBlock.fadeOut();
            $.each(data, function( index, value ) {
                block.prepend(value.html);
            });
        }
    },
    initEvents: function () {
        var _this = this,
            form = $('#formRefEditModal'),
            formResend = $('#requestedRefEditModal');
        var storeReference = function (mutation,params,needParams,id) {
            new GraphQL("mutation",mutation, params, needParams, true, false, function (data) {
                Loader.stop();
            }, function (data) {
                if (data.message) {
                    $($('#alredySendMessageModalReference')).modal('show');
                    return;
                }
                if (id == 0) {
                    $('#block-requested').prepend(data.html);
                    if (_this.requested.length == 0) {
                        $('#no-requested').fadeOut();
                    }
                    _this.requested.push(data);
                } else {
                    $('#block-confirmed').find('[data-id="' + id + '"]').replaceWith(data.html);
                    var i = -1;
                    do {
                        i++;
                    } while (_this.confirmed[i].id != id && i < _this.confirmed.length-1);
                    _this.confirmed[i] = data;
                }
                form.modal('hide');
                form.find('input').val('');
            }, form).request();
        };

        $('#reference-save').click(function () {
            var id = parseInt($('#reference-save').attr('data-id')),
                mutation,
                params = {
                    "email": FormValidate.getFieldValue('email', form),
                    "phone": FormValidate.getFieldValue('phone', form),
                    "full_name": FormValidate.getFieldValue('full_name', form),
                    "company": FormValidate.getFieldValue('company', form)
                },
                needParams = [
                    'id',
                    'user_id',
                    'email',
                    'phone',
                    'full_name',
                    'company',
                    'status',
                    'html',
                    "message",
                    'token'
                ];
            if (id == 0) {
                mutation = 'createReference';
                params["status"] = 'requested';
            } else {
                mutation = 'updateReference';
                params["id"] = id;
            }
            storeReference(mutation,params,needParams,id);
        });

        $('#reference-new').click(function () {
            form.find('input').val('');
            form.find('input[name="email"]').removeAttr('readonly');
            form.find('input[name="phone"]').removeAttr('readonly');
            $('#reference-save').attr('data-id', 0).text(trans('send'));
        });

        $('body').on('click', '.reference-edit',function () {
            var id, i;
            if ($(this).attr('data-type') == 'confirmed') {
                form.find('input').val('');
                id = $(this).closest('.item-confirmed').attr('data-id');
                $('#reference-save').attr('data-id', id).text(trans('send'));
                i = -1;
                do {
                    i++;
                } while (_this.confirmed[i].id != id && i < _this.confirmed.length-1);
                form.find('input[name="email"]').val(_this.confirmed[i].email).attr('readonly','readonly');
                form.find('input[name="phone"]').val(_this.confirmed[i].phone).attr('readonly','readonly');
                form.find('input[name="full_name"]').val(_this.confirmed[i].full_name);
                form.find('input[name="company"]').val(_this.confirmed[i].company);
            } else if ($(this).attr('data-type') == 'requested') {
                formResend.find('input').val('');
                id = $(this).closest('.item-requested').attr('data-id');
                $('#reference-resend').attr('data-id', id);
                $('#reference-new-resend').attr('data-id', id);
                i = -1;
                do {
                    i++;
                } while (_this.requested[i].id != id && i < _this.requested.length-1);
                formResend.find('#email-resend').text(_this.requested[i].email);
            }
        });

        var resendReference = function (email,id) {
            new GraphQL("mutation",'resendReference', {
                "email": email,
                "id": id
            }, [
                'id',
                'user_id',
                'email',
                'phone',
                'full_name',
                'company',
                'status',
                'html',
                'token'
            ], true, false, function (data) {
                Loader.stop();
            }, function (data) {
                //$('#block-requested').find('[data-id="' + id + '"]').replaceWith(data.html);
                var i = -1;
                do {
                    i++;
                } while (_this.requested[i].id != id && i < _this.requested.length - 1);
                _this.requested[i] = data;
                formResend.modal('hide');
                formResend.find('input').val('');
            }, formResend).request();
        };

        $('#reference-resend').click(function () {
            var email = formResend.find('#email-resend').text(),
                id = $(this).attr('data-id');
            resendReference(email,id);
        });

        $('#reference-new-resend').click(function () {
            var email = FormValidate.getFieldValue('email', formResend),
                id = $(this).attr('data-id');
            resendReference(email,id);
        });
        var id=0;
        $('body').on('click', '.reference-delete',function (e) {
            e.preventDefault();
            var elemReference = $(this).closest('[data-id]');
            id = elemReference.attr('data-id');
            var deleteModal = $('#deleteEditModalReference'),
                deleteButton = $('#resume-reference-confirm-delete');
            deleteModal.modal('show');
            deleteButton.click(function () {
                deleteModal.modal('hide');
                new GraphQL("mutation",'deleteReference', {
                    "id": id
                }, [
                    'token'
                ], true, false, function (data) {
                    Loader.stop();
                }, function (data) {
                    elemReference.remove();
                    var i = -1;
                    do {
                        i++;
                    } while (_this.requested[i].id != id && i < _this.requested.length - 1);
                    if (_this.requested[i].id != id) {
                        i = -1;
                        do {
                            i++;
                        } while (_this.confirmed[i].id != id && i < _this.confirmed.length - 1);
                        if (_this.confirmed[i].id != id) {
                            i = -1;
                            do {
                                i++;
                            } while (_this.incoming [i].id != id && i < _this.incoming.length - 1);
                            if (_this.incoming[i].id == id) {
                                _this.incoming.splice(i,1);
                                _this.incomingCount--;
                                if (_this.incomingCount == 0) {
                                    _this.elemIncomingCount.text('').fadeOut();
                                    $('#no-incoming').fadeIn();
                                } else {
                                    _this.elemIncomingCount.text(_this.incomingCount).fadeIn();
                                }
                            }
                        } else {
                            _this.confirmed.splice(i,1);
                            if (_this.confirmed.length == 0) {
                                $('#no-confirmed').fadeIn();
                            }
                        }
                    } else {
                        _this.requested.splice(i,1);
                        if (_this.requested.length == 0) {
                            $('#no-requested').fadeIn();
                        }
                    }
                }, false).request();
            });
        });


        $('body').on('click', '.reference-confirmed',function (e) {
            e.preventDefault();
            var elemReference = $(this).closest('[data-id]'),
                id = elemReference.attr('data-id');
            new GraphQL("mutation",'confirmedReference', {
                "id": id,
                "status": 'confirmed'
            }, [
                'id',
                'user_id',
                'email',
                'phone',
                'full_name',
                'company',
                'status',
                'html',
                'token'
            ], true, false, function (data) {
                Loader.stop();
            }, function (data) {
                elemReference.remove();
                var i = -1;
                do {
                    i++;
                } while (_this.incoming [i].id != id && i < _this.incoming.length - 1);
                _this.incomingCount--;
                if (_this.incomingCount == 0) {
                    _this.elemIncomingCount.text('').fadeOut();
                    $('#no-incoming').fadeIn();
                } else {
                    _this.elemIncomingCount.text(_this.incomingCount).fadeIn();
                }
                $('#block-confirmed').prepend(data.html);
                if (_this.confirmed.length == 0) {
                    $('#no-confirmed').fadeOut();
                }
                _this.confirmed.push(data);


            }, false).request();
        });
    }
};

$(document).ready(function () {

    var reference = new Reference();
    reference.init();
    
});
