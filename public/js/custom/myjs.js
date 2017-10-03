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
    $('.tap-target').tapTarget('open');
    $(".dropdown-button").dropdown();
    $('ul.tabs').tabs('select_tab', 'tab_id');
    $('.scrollspy').scrollSpy();
    $('#categoryList').selectize({
        placeholder: 'Choose . . .'
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

    $('#phone_number').intlTelInput();

    $('#select_profile_picture').on('change', function () {
        $('#form_upload_profile_picture').submit();
    });

    $('.btn-add-image').on('click', function () {
        $('#upload-image').removeAttr('style');
    });

    $('.btn-add-image-ios').on('click', function () {
        $('#upload-image-ios').removeAttr('style');
    });

    $("body").on("contextmenu", "#showcase_cover", function(e) {
        return false;
    });

    $('#snap-pay-button').click(function (event) {
        event.preventDefault();
        $(this).attr("disabled", "disabled");
        var album_id = $('#album_id').val();
        console.log(album_id);

        $.ajax({

            url: '/payment/midtrans_token',
            method: 'POST',
            dataType: 'json',
            cache: false,
            data: {album_id: album_id,_token: CSRF_TOKEN},
            success: function (data) {
                //location = data;
                console.log('token = ' + data);

                function changeResult(type, data) {
                    $("#result-type").val(type);
                    $("#result-data").val(JSON.stringify(data));
                    //resultType.innerHTML = type;
                    //resultData.innerHTML = JSON.stringify(data);
                }

                snap.pay(data, {

                    onSuccess: function (result) {
                        changeResult('success', result);
                        console.log(result.status_message);
                        console.log(result);
                        $('#form-midtrans').submit();
                    },
                    onPending: function (result) {
                        changeResult('pending', result);
                        console.log(result.status_message);
                        $('#form-midtrans').submit();
                    },
                    onError: function (result) {
                        changeResult('error', result);
                        console.log(result.status_message);
                        $('#form-midtrans').submit();
                    }
                });
            }
        });
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

    $('#album-form-ios').validate({
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
});

Dropzone.options.uploadImage = {
    autoProcessQueue: false,
    clickable: '.btn-add-image',
    dictDefaultMessage: 'Preview',
    maxFiles: 25,
    maxFileSize: 10000,
    parallelUploads: 25,
    timeout: 3000000,
    addRemoveLinks: true,
    dictResponseError: 'Error while uploading file',
    acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
    init:function(){
        var self = this;
        var counter = 0;
        // config
        self.options.addRemoveLinks = true;
        self.options.dictRemoveFile = "Delete";
        self.options.timeout = 3000000;

        //New file added
        self.on("addedfile", function (file) {
            counter++;
            // console.log('new file added ', counter);
        });

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
        
        $('#upload_validation_button').on('click', function (e) {
            e.preventDefault();
            var result = $('#album-form').valid();
            if (result == true && self.getQueuedFiles().length > 0) {
                $('#upload_confirm').modal('open');
            }
        });

        $('#btnSubmitImage').on('click', function (e) {
            e.preventDefault();
            self.processQueue();
        });

        // on complete process
        self.on("success", function (file, response) {
            if(response === 'success') {
                counter--;
            }

            // console.log(self.getUploadingFiles().length, counter);

            if (self.getUploadingFiles().length === 0 && counter === 0) {
                // console.log('all file uploaded');
                $('#album-form').submit();
            }
        });
    }
};

Dropzone.options.uploadImageIos = {
    autoProcessQueue: false,
    clickable: '.btn-add-image-ios',
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
        var counter = 0;

        // config
        self.options.addRemoveLinks = true;
        self.options.dictRemoveFile = "Delete";

        self.on('addedfile', function (file) {
            counter++;
        });

        self.on('sending', function (file, xhr, formData) {
            formData.append('fileName', counter + '_' + file.name);
            counter--;
        });

        self.on("processing", function (file) {
            $('.btn-add-image').addClass('disabled');
            $('#btnUploadImage').addClass('disabled');
        });

        // On removing file
        self.on("removedfile", function (file) {
            console.log("file removed");
            console.log(file.name);
            console.log(counter);
        });

        self.on("canceled", function (file) {
            console.log("upload canceled");
            console.log(file);
        });

        self.on("maxfilesexceeded", function (file) {
            alert("Files too many!");
            self.removeAllFiles();
        });

        self.on("error", function (file, response) {
            $(file.previewElement).find('#dz-error-message').text(response);
            return false;
        });

        // on complete process
        // self.on("complete", function (file) {
        //     $('.btn-add-image').removeClass('disabled');
        //     $('#btnUploadImage').removeClass('disabled');
        // });

        self.on("success", function (file, response) {
            console.log(self.getUploadingFiles(), counter);

            if (self.getUploadingFiles().length == 0 && counter == 0) {
                // console.log('all file uploaded');
                $('#album-form-ios').submit();
            }
        });

        $('#upload_validation_button_ios').on('click', function (e) {
            e.preventDefault();
            var isValid = $('#album-form-ios').valid();
            console.log(isValid, self.getQueuedFiles().length);
            if(isValid === true && self.getQueuedFiles().length > 0) {
                $('#upload_confirm_ios').modal('open');
            }
        });

        $('#btnSubmitImageIos').on('click', function (e) {
            e.preventDefault();
            self.processQueue();
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
    var id = $(selected).data('id');

    if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
        var $input = $('#copy' + id);
        $input.val();
        var el = $input.get(0);
        var editable = el.contentEditable;
        var readOnly = el.readOnly;
        el.contentEditable = true;
        el.readOnly = false;
        var range = document.createRange();
        range.selectNodeContents(el);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(range);
        el.setSelectionRange(0, 999999);
        el.contentEditable = editable;
        el.readOnly = readOnly;

        var successful = document.execCommand('copy');
        $input.blur();

        if(successful) {
            Materialize.toast('Link copied to clipboard', 3000);
        }
    }

    else {
        var url = document.createElement("input");
        url.setAttribute('value', $('#copy' + id).val());
        document.body.appendChild(url);
        url.select();
        document.execCommand("copy");
        document.body.removeChild(url);
        Materialize.toast('Link copied to clipboard', 3000);
    }
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
        || new String(window.location.href).valueOf() == new String(window.location.protocol + "//" + window.location.host + '/register').valueOf())
    {

        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        var countryId = null;
        $.getJSON('//freegeoip.net/json/?callback=?', function(data) {
            console.log(data);
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

// function getOS() {
//     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
//     var userAgent = navigator.userAgent || navigator.vendor || window.opera;
//
//     var os = '';
//
//     // iOS detection from: http://stackoverflow.com/a/9039885/177710
//     if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
//         console.log("iOS");
//         os = 'iOS';
//     }
//
//     if(os == 'iOS') {
//         $.ajax({
//             method: 'POST',
//             url: window.location.protocol + "//" + window.location.host + '/os-detection',
//             dataType: 'json',
//             data: {os: os, _token: CSRF_TOKEN},
//             success: function (response) {
//                 if (response == 'success') {
//                     window.location.replace(window.location.protocol + "//" + window.location.host + '/create-blank-album');
//                 }
//             }
//         });
//     } else {
//         window.location.replace(window.location.protocol + "//" + window.location.host + '/create-blank-album');
//     }
//
//
//
//     // // Opera 8.0+
//     // var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
//     //
//     // // Firefox 1.0+
//     // var isFirefox = typeof InstallTrigger !== 'undefined';
//     //
//     // // Safari 3.0+ "[object HTMLElementConstructor]"
//     // var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || safari.pushNotification);
//     //
//     // // Internet Explorer 6-11
//     // var isIE = /*@cc_on!@*/false || !!document.documentMode;
//     //
//     // // Edge 20+
//     // var isEdge = !isIE && !!window.StyleMedia;
//     //
//     // // Chrome 1+
//     // var isChrome = !!window.chrome && !!window.chrome.webstore;
//     //
//     // // Blink engine detection
//     // var isBlink = (isChrome || isOpera) && !!window.CSS;
//     //
//     // var output = 'Detecting browsers by ducktyping:<hr>';
//     // output += 'isFirefox: ' + isFirefox + '<br>';
//     // output += 'isChrome: ' + isChrome + '<br>';
//     // output += 'isSafari: ' + isSafari + '<br>';
//     // output += 'isOpera: ' + isOpera + '<br>';
//     // output += 'isIE: ' + isIE + '<br>';
//     // output += 'isEdge: ' + isEdge + '<br>';
//     // output += 'isBlink: ' + isBlink + '<br>';
//     // $('#is_browser').html(output);
// }

function showCopyUrl(selected) {
    var id = $(selected).data('id');
    $('#copy' + id).toggleClass('hide');
}

function copy_text_address(selected, copy_text) {
    $(selected).select();
}

// function checkOS() {
//     var os = navigator.userAgent.toLowerCase();
//     console.log(os);
// }