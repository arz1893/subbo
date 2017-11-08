$(document).ready(function () {
    $('#album-form').validate({
        rules: {
            title: {
                required: true,
                minlength: 3
            },
            description: "required",
            category_list: "required",
            price: {
                required: true,
                min: parseFloat($('#min_price').data('value'))
            }
        },
        messages: {
            title: {
                required: "Title field is required",
                minlength: "at least 3 characters are required for title"
            },
            description: "description field is required",
            category_list: "you haven't choose your album category",
            price: {
                required: "price field is required",
                min: "the minimum price required is " + parseFloat($('#min_price').data('value'))
            }
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
            price: {
                required: true,
                min: parseFloat($('#min_price').data('value'))
            }
        },
        messages: {
            title: {
                required: "Title field is required",
                minlength: "at least 3 characters are required for title"
            },
            description: "description field is required",
            category_list: "you haven't choose your album category",
            price: {
                required: "price field is required",
                min: "the minimum price required is " + parseFloat($('#min_price').data('value'))
            }
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