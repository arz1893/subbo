$(document).ready(function(){

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $('.modal').modal();
    $('.carousel.carousel-slider').carousel({fullWidth: true});
    $(".button-collapse").sideNav({
        menuWidth: 250
    });
    $('.parallax').parallax({

    });
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


// function checkOS() {
//     var os = navigator.userAgent.toLowerCase();
//     console.log(os);
// }