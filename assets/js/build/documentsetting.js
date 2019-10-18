var service_base_url = $('#service_base_url').val();

$(function () {
    check_image_first();
});

function check_image_first() {
    image_id = $('#image_id').val();
    if (image_id !== "") {
        $('#show-image-div').show();
        $('#upload-div').hide();
    } else {
        $('#show-image-div').hide();
        $('#upload-div').show();
    }
}

function upload_image() {
    var myfiles = document.getElementById("upload-image");
    var files = myfiles.files;
    var data = new FormData();

    for (i = 0; i < files.length; i++) {
        data.append('file' + i, files[i]);
    }
    url = service_base_url + 'documentsetting/upload_image';
    $('body').loading();
    $.ajax({
        url: url,
        dataType: "json",
        type: 'POST',
        contentType: false,
        data: data,
        processData: false,
        cache: false
    }).done(function (res) {
        if (res.error) {
            $('#show-image-div').hide();
            $('#upload-div').show();
        } else {
            image_link = service_base_url + 'store/image/' + res.file_name;
            $('#image_a').attr("href", image_link);
            $('#image_show').attr("src", image_link);
            $('#show-image-div').show();
            $('#upload-div').hide();
        }
        $('body').loading('stop');
    });
}

function delete_image() {
    url = service_base_url + 'documentsetting/delete_image';
    $('body').loading();
    $.ajax({
        url: url,
        success: function () {
            $('#show-image-div').hide();
            $('#upload-div').show();
            $('body').loading('stop');
        }
    });
}