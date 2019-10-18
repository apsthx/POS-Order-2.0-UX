var service_base_url = $('#service_base_url').val();


$(function () {
    data();
});


function data() {
    $('body').loading();
    url = service_base_url + 'smss/data';
    $.ajax({
        url: url,
        method: "POST",
        success: function (res)
        {
            $('body').loading('stop');
            $('#result-page').html(res);
        }
    });
}

function modalsend() {
    CKEDITOR.instances['advt_message'].setData("");
    $('#formsend')[0].reset();
    $('#send').modal('show', {backdrop: 'true'});
}

$(document).ready(function () {
    $('input[type=radio][name=advt_type]').change(function () {
        if (this.value == '1') {
            $('#input_advt_message').hide();
        }
        else if (this.value == '2') {
            $('#input_advt_message').show();
        }
    });
});


$(document).ready(function () {
    $('input[type=radio][name=sends]').change(function () {
        if (this.value == '1') {
            $('#customer_group_id').prop('readonly', true);
            $('#start_customer_id').prop('readonly', true);
            $('#end_customer_id').prop('readonly', true);
            $('#customer_name').prop('readonly', false);
            $('#start_customer_id').val('');
            $('#end_customer_id').val('');
        }
        else if (this.value == '2') {
            $('#customer_name').prop('readonly', true);
            $('#customer_group_id').prop('readonly', false);
            $('#start_customer_id').prop('readonly', false);
            $('#end_customer_id').prop('readonly', false);
            $('#customer_name').val('');
        }
    });
});

CKEDITOR.replace('advt_message', {
    language: 'th',
    filebrowserBrowseUrl: service_base_url + 'uploadimage',
    filebrowserImageBrowseUrl: service_base_url + 'uploadimage',
    filebrowserFlashBrowseUrl: service_base_url + 'uploadimage',
    toolbar: [
        {name: 'document', items: ['Source', '-', 'Save', 'NewPage', 'DocProps', 'Preview', 'Print']},
        {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo']},
        '/',
        {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat']},
        {name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl']},
        {name: 'links', items: ['Link', 'Unlink', 'Anchor']},
        {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'Iframe']},
        '/',
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize']},
        {name: 'colors', items: ['TextColor', 'BGColor']},
        {name: 'tools', items: ['Maximize', 'ShowBlocks']}
    ]
});


function getAutocomplete(textbox) {
    $(textbox).autocomplete({
        source: service_base_url + 'smss/getText',
        minLength: 2,
        select: function (event, ui) {
            $("#customer_id_pri").val(ui.item.id)
        }
    });
}

function date_start() {
    $('#end_customer_id').val($('#start_customer_id').val());
}

function send() {
    advt_type = $('input[type=radio][name=advt_type]:checked').val();
    sends = $('input[type=radio][name=sends]:checked').val();
    customer_id_pri = $("#customer_id_pri").val();
    customer_group_id = $("#customer_group_id").val();
    start_customer_id = $("#start_customer_id").val();
    end_customer_id = $("#end_customer_id").val();
    if (start_customer_id == '') {
        start_customer_id = null;
    }
    if (end_customer_id == '') {
        end_customer_id = null;
    }
    advt_header = $("#advt_header").val();
    advt_message = CKEDITOR.instances['advt_message'].getData();
    console.log(advt_type + '/' + sends + '/' + customer_id_pri + '/' + customer_group_id + '/' + start_customer_id + '/' + end_customer_id + '/' + advt_header + '/' + advt_message);
    if (advt_type == 1) {
        $.ajax({
            url: service_base_url + 'sms/sendSMSadvt',
            method: "POST",
            data: {
                sends: sends,
                customer_id_pri: customer_id_pri,
                customer_group_id: customer_group_id,
                start_customer_id: start_customer_id,
                end_customer_id: end_customer_id,
                advt_header: advt_header
            },
            success: function (response)
            {
                if (response == 1) {
                    //console.log(response);
                    location.reload();
                } else {
                    //console.log(response);
                    location.reload();
                }
            }
        });
    } else {
        $.ajax({
            url: service_base_url + 'email/sendEmailadvt',
            method: "POST",
            data: {
                sends: sends,
                customer_id_pri: customer_id_pri,
                customer_group_id: customer_group_id,
                start_customer_id: start_customer_id,
                end_customer_id: end_customer_id,
                advt_header: advt_header,
                advt_message: advt_message
            },
            success: function (response)
            {
                if (response == 1) {
                    //console.log(response);
                    location.reload();
                } else {
                    //console.log(response);
                    location.reload();
                }
            }
        });
    }
    return false;
}

