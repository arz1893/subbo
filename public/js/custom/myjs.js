$(document).ready(function(){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.modal').modal();
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    $(".button-collapse").sideNav({
        menuWidth: 250
    });
    $('.parallax').parallax();
    $('.carousel').carousel();
    $('.slider').slider();
    $('.materialboxed').materialbox();
    $(".dropdown-button").dropdown();
    $('ul.tabs').tabs('select_tab', 'tab_id');
    $('.scrollspy').scrollSpy();
    $('#categoryList').selectize({
        placeholder: 'Choose . . .'
    });
    // $('#select_currency').selectize();
    // $('#select_currency').material_select();
    $('#order-history-table').dataTable({
        scrollX: true
    });

    $('#table-sold-album').dataTable({
        scrollX: true
    });

    $('#confirm_change_currency').change(function(){
        $("#select_currency").prop("disabled", !$(this).is(':checked'));
    });

    $('#btn-max-withdraw').click(function () {
        var withdraw_value = $('#max-withdraw').val();
        $('#txt_withdraw_amount').val(withdraw_value);
    });

    $('.venobox').venobox({
        numeratio: true,            // default: false
        infinigall: true            // default: false
    });

    $('.image-viewer').viewer({
        title: false,
        toolbar: false,
        rotatable: false
    });

    $('#album-form').validate({
        rules: {
            title: {
                required: true,
                minlength: 3
            },
            description: "required",
            category_list: "required",
            price: "required"
        },
        messages: {
            title: {
                required: "Title field is required",
                minlength: "at least 3 characters are required for title"
            },
            description: "description field is required",
            category_list: "you haven't choose your album category",
            price: "price field is required"
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });

    $('#form-add-password').validate({
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            password: {
                required: true,
                minlength: 4
            },
            password_confirmation: {
                minlength: 4,
                equalTo: "#password"
            }
        },
        // Specify validation error messages
        messages: {
            password: {
                required: "Please input your new password",
                minlength: "Your password must be at least 4 characters long"
            },
            password_confirmation: {
                minlength: "Your password must be at least 4 characters long",
                equalTo: "Your password didn't match"
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });

    $('#form-password').validate({
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            current_password: "required",
            new_password: {
                required: true,
                minlength: 4
            },
            password_confirmation: {
                minlength: 4,
                equalTo: '#new_password'
            }
        },
        // Specify validation error messages
        messages: {
            current_password: "Please input your current password",
            new_password: {
                required: "Please input your new password",
                minlength: "Your password must be at least 4 characters long"
            },
            password_confirmation: {
                minlength: "Your password must be at least 4 characters long",
                equalTo: "Your password didn't match"
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
            // $.ajax({
            //     method: 'POST',
            //     url: window.location.protocol + "//" + window.location.host + "/" + 'user/change-password',
            //     dataType: 'json',
            //     data: {data: $(form).serializeArray(), _token: CSRF_TOKEN},
            //     success: function (response) {
            //         console.log(response);
            //     }
            // })
        }
    });

    $('#form-bank-account').validate({
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            bank_name: "required",
            account_number: {
                required: true,
                number: true,
                maxlength: 19
            }
        },
        // Specify validation error messages
        messages: {
            bank_name: "Please input your bank name",
            account_number: {
                required: "Please input valid account number",
                number: "invalid account number",
                maxlength: "invalid account number"
            }
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });

    
    $('#select_profile_picture').on('change', function () {
        $('#form_upload_profile_picture').submit();
    });

    $('.btn-add-image').on('click', function () {
        $('#upload-image').removeAttr('style');
    });
});

Dropzone.options.uploadImage = {
    autoProcessQueue: false,
    clickable: '.btn-add-image',
    dictDefaultMessage: 'Preview',
    maxFiles: 25,
    maxFileSize: 10000,
    parallelUploads: 25,
    timeout: 300000,
    addRemoveLinks: true,
    dictResponseError: 'Error while uploading file',
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init:function(){
        var self = this;
        // config
        self.options.addRemoveLinks = true;
        self.options.dictRemoveFile = "Delete";
        //New file added
        // self.on("addedfile", function (file) {
        //     console.log('new file added ', file);
        // });
        // // Send file starts
        // self.on("sending", function (file) {
        //     console.log('upload started', file);
        //     $('.meter').show();
        // });
        //
        // // File upload Progress
        // self.on("totaluploadprogress", function (progress) {
        //     console.log("progress ", progress);
        //     $('.roller').width(progress + '%');
        // });
        //
        // self.on("queuecomplete", function (progress) {
        //     $('.meter').delay(999).slideUp(999);
        // });
        //
        // On removing file
        self.on("removedfile", function (file) {
            console.log("file removed");
            console.log(file);
        });
        
        self.on("canceled", function (file) {
            console.log("upload canceled");
            console.log(file);
        });

        self.on("maxfilesexceeded", function (file) {
            alert("Files too many!");
            this.removeAllFiles();
        });

        self.on("error", function (file, response) {
            $(file.previewElement).find('#dz-error-message').text(response);
            return false;
        });

        $('#btnSubmitImage').on('click', function () {
            var result = $('#album-form').valid();
            if (result == true) {
                self.processQueue();
            }
        });

        // on complete process
        self.on("complete", function (file) {
            if (self.getUploadingFiles().length === 0 && self.getQueuedFiles().length === 0) {
                $('#album-form').submit();
            }
        });
    }
};

function selectCover(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var val = $(selected).data('id');
    var modal = $('#popUpConfirm');
    modal.data('id', val);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/getpicturename',
        dataType: 'json',
        data: {pict_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            if(response != null) {
                $('#infoContent').text("You want to choose " + response.alias +" as your cover ?");
            }
        }
    });
}

function setDeleteTarget(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var val = $(selected).data('id');
    var modal = $('#popUpDeleteImage');
    modal.data('id', val);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/getpicturename',
        dataType: 'json',
        data: {pict_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertContentImage').text("Are you sure want to delete " + response.alias +" ?");
        }
    });
}

function setDeleteTargetAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var val = $(selected).data('id');
    var modal = $('#popUpDeleteAlbum');
    modal.data('id', val);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/getalbumname',
        dataType: 'json',
        data: {album_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertContentAlbum').text("Are you sure want to delete " + response +" ?");
        }
    });
}

function applyCover() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var modal = $('#popUpConfirm');
    var id = modal.data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/setalbumcover',
        dataType: 'json',
        data: {pict_id: id, _token: CSRF_TOKEN},

        success: function (response) {
            if(response == "success") {
                location.reload()
                // console.log(response);
            }
        }
    });
}

function deleteImage() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var image_id = $('#popUpDeleteImage').data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'image/deleteimage',
        dataType: 'json',
        data: {image_id: image_id, _token: CSRF_TOKEN},

        success: function (response) {
            location.reload();
        }
    });
}

function setPublishTargetAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $(selected).data('id');
    var modal = $('#popUpSetPublish');
    modal.data('id', album_id);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/getalbumname',
        dataType: 'json',
        data: {album_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertPublishContent').text("Are you sure want to publish " + response + "? (once published you can't edit this album anymore)");
        }
    });
}

function setUnpublishTargetAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $(selected).data('id');
    var modal = $('#popUpSetUnpublish');
    modal.data('id', album_id);

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/getalbumname',
        dataType: 'json',
        data: {album_id: modal.data('id'), _token: CSRF_TOKEN},
        success: function (response) {
            $('#alertUnpublishContent').text("Are you sure want to unpublish " + response + "?");
        }
    });
}

function publishAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $('#popUpSetPublish').data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/publishalbum',
        dataType: 'json',
        data: {album_id: album_id, _token: CSRF_TOKEN},
        success: function (album_id) {
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + 'album' + "/" + album_id);
        }
    });
}

function unpublishAlbum(selected) {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $('#popUpSetUnpublish').data('id');

    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/unpublishalbum',
        dataType: 'json',
        data: {album_id: album_id, _token: CSRF_TOKEN},
        success: function (album_id) {
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + 'album' + "/" + album_id);
        }
    });
}

function deleteAlbum() {
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var album_id = $('#popUpDeleteAlbum').data('id');
    console.log(album_id);
    $.ajax({
        method: 'POST',
        url: window.location.protocol + "//" + window.location.host + "/" + 'album/deletealbum',
        dataType: 'json',
        data: {album_id: album_id, _token: CSRF_TOKEN},

        success: function (response) {
            window.location.replace(window.location.protocol + "//" + window.location.host + "/" + 'album');
        }
    });
}

function facebookShare(selected) {
    var url = $(selected).data('url');
    window.open(url, '_blank');
}

function copyLinkAddress(selected) {
    Materialize.toast('Link copied to clipboard', 3000);
    var url = document.createElement("input");
    url.setAttribute('value', $(selected).data('url'));
    document.body.appendChild(url);
    url.select();
    document.execCommand("copy");

    document.body.removeChild(url);
}

function getCountry() {
    alert('function triggered !');
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    var countryId = null;
    $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
        countryId = data.country_code;

        jQuery.getJSON(
            "https://restcountries.eu/rest/v1/alpha/" + countryId,
            function (data) {
                $.ajax({
                    method: 'POST',
                    url: window.location.protocol + "//" + window.location.host + "/session/set-country-detail",
                    dataType: 'json',
                    data: {country_name: data.nativeName, _token: CSRF_TOKEN},
                    success: function (response) {
                        console.log(response);
                        $('#get_country_loader').css('display', 'none');
                    }
                });

            });
    });
}

function urlChecking() {
    if(
        new String(window.location.href).valueOf() == new String(window.location.protocol + "//" + window.location.host + '/login').valueOf()
        || new String(window.location.href).valueOf() == new String(window.location.protocol + "//" + window.location.host + '/register').valueOf()) {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var countryId = null;
        $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
            countryId = data.country_code;

            jQuery.getJSON(
                "https://restcountries.eu/rest/v1/alpha/" + countryId,
                function (data) {
                    $.ajax({
                        method: 'POST',
                        url: window.location.protocol + "//" + window.location.host + "/session/set-country-detail",
                        dataType: 'json',
                        data: {country_name: data.nativeName, _token: CSRF_TOKEN},
                        success: function (response) {
                            console.log(response);
                            $('#get_country_loader').css('display', 'none');
                        }
                    });

                });
        });
    }
}