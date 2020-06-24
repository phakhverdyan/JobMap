$(document).ready(function () {

    Loader.init();

    new GraphQL("query", "printBuilder", { 'overview': 1 }, [
        'print_builder is_complete token'], true, false, function () {
        Loader.stop();
    }, function (data) {
        $('#print-builder').html(data.print_builder);

    }, false).request();

    $('#print-builder').on('click','.custom-checkbox.node',function (e) {
        e.preventDefault();
        let elemInput = $(this).find('input'),
            elemUl = $(this).parent().next('ul');
        if (elemInput.is(":checked")) {
            elemInput[0].checked = false;
            elemUl.find('input').each(function (i) {
                $(this)[0].checked = false;
            });
        } else {
            elemInput[0].checked = true;
            elemUl.find('input').each(function (i) {
                $(this)[0].checked = true;
            });
        }
    });

    $('#print-builder').on('submit','#formSelections',function (e) {
        e.preventDefault();
        let selections = $('#print-builder :input[name!="title"]').serialize(),
            form = $(this);
        new GraphQL("mutation", "savePrintBuilderSelection", {
            'selections': selections,
            'title': FormValidate.getFieldValue('title', form)
        }, [
            'item_selection token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('#block-items-selections .item-empty-selection').hide();
            $('#block-items-selections').prepend(data.item_selection);
            form.find('input[name="title"]').val('');
        }, form).request();

    });

    $('#print-builder').on('click', 'input', function () {
        FormValidate.fieldValidateClear($(this));
    });

    $('#print-builder').on('click', '.del-item-selection', function () {
        let elemDel = $(this).parent();
            id = $(this).parent().attr('data-id');
        new GraphQL("mutation", "delPrintBuilderSelection", { 'id': id }, [
            'result token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.result == 'success') {
                elemDel.remove();
            } else {
                console.log('error delete item selection');
            }
        }, false).request();

    });

    $('#print-builder').on('click', '.load-item-selection', function () {
        let id = $(this).parent().attr('data-id');
        new GraphQL("query", "loadPrintBuilderSelection", { 'id': id }, [
            'selection{title selections} token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {
            if (data.selection) {
                $('#print-builder').find('.custom-checkbox input[type="checkbox"]').each(function (i) {
                    $(this)[0].checked = false;
                });
                showLoadSelection(data.selection);
            } else {
                console.log('error delete item selection');
            }
        }, false).request();

    });

    let showLoadSelection = function (selection) {
        let selections = JSON.parse(selection.selections);
        $.each(selections, function( key, value ) {
            if (value instanceof Object) {
                $.each(value, function( k, v ) {
                    $('#print-builder').find('.custom-checkbox input[name="'+ key + '[' + k + ']"]').each(function (i) {
                        $(this)[0].checked = true;
                    });
                });
            } else {
                $('#print-builder').find('.custom-checkbox input[name="'+ key +'"]').each(function (i) {
                    $(this)[0].checked = true;
                });
            }
        });
    };

    $('#print-builder').on('click', '#print-preview', function () {
        var lang = $('#print-builder__select-language').val();
        APIStorage.create('language',lang);
        let selections = $('#print-builder :input[name!="title"]').serialize();
        let url = '/user/print-preview?' + selections;
        window.open(url,'_blank');
        /*new GraphQL("mutation", "printPreviewPdf", {
            'selections': selections,
        }, [
            'overview_pdf token'
        ], true, false, function () {
            Loader.stop();
        }, function (data) {


        }, false).request();*/
    });

    //load resume print builder module
    //app.run(load);

    $('#print-builder').on('change', '#print-builder__select-language', function () {
        var locale = $(this).val();
        new GraphQL("query", "printBuilder", { 'overview': 1, 'locale': locale }, [
            'print_builder is_complete token'], true, false, function () {
            Loader.stop();
        }, function (data) {
            $('#print-builder').html(data.print_builder);

        }, false).request();
    });

});