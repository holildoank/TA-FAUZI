var FormValidation = function () {
var validate_form_reservasi = function() {
        var form1 = $('#form_reservation');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                select_multi: {
                    maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                    minlength: jQuery.validator.format("At least {0} items must be selected")
                }
            },
            rules: {

                 reservation_name:{
                    required: true
                },
                reservation_address:{
                    required: true
                },
                reservation_phone:{
                    required: true,
                    digits:true
                },
                staff_id:{
                    required: true
                },
                select_product:{
                    required: true
                },
                reservation_startdatetime:{
                    required: true
                },
                product_id:{
                    required: true
                },

            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                // App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                // form.submit();

                    btnInsert();

                success1.show();
                error1.hide();
            }
        });
    }
    var validate_form_konfirmasi = function() {
            var form1 = $('#form_konfirmasi');
            var error1 = $('.alert-danger', form1);
            var success1 = $('.alert-success', form1);

            form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: true, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                messages: {
                    select_multi: {
                        maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                        minlength: jQuery.validator.format("At least {0} items must be selected")
                    }
                },
                rules: {

                     reservation_name:{
                        required: true
                    },
                    reservation_id:{
                        required: true
                    },
                    reservation_amount_paid:{
                        required: true,
                        digits:true
                    },
                    reservation_methode:{
                        required: true
                    },
                },

                invalidHandler: function (event, validator) { //display error alert on form submit
                    success1.hide();
                    error1.show();
                    // App.scrollTo(error1, -200);
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').addClass('has-error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    $(element)
                        .closest('.form-group').removeClass('has-error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .closest('.form-group').removeClass('has-error'); // set success class to the control group
                },

                submitHandler: function (form) {
                    // form.submit();

                        btnInsert();

                    success1.show();
                    error1.hide();
                }
            });
        }
        var validate_form_reservasi_front = function() {
                var form1 = $('#form_reservation_front');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: true, // do not focus the last invalid input
                    ignore: "",  // validate all fields including form hidden input
                    messages: {
                        select_multi: {
                            maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                            minlength: jQuery.validator.format("At least {0} items must be selected")
                        }
                    },
                    rules: {

                         customer_name:{
                             digits:false,
                            required: true
                        },
                        customer_email:{
                            required: true
                        },
                        customer_phone:{
                            required: true,
                            digits:true
                        },
                        product_id:{
                            required: true
                        },
                    },

                    invalidHandler: function (event, validator) { //display error alert on form submit
                        success1.hide();
                        error1.show();
                        // App.scrollTo(error1, -200);
                    },

                    highlight: function (element) { // hightlight error inputs
                        $(element)
                            .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },

                    unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                            .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },

                    success: function (label) {
                        label
                            .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },

                    submitHandler: function (form) {
                        // form.submit();

                            btnInsert();

                        success1.show();
                        error1.hide();
                    }
                });
            }
    return {
        //main function to initiate the module
        init: function () {

            validate_form_reservasi();
            validate_form_konfirmasi();
            validate_form_reservasi_front();

        }

    };


}();

jQuery(document).ready(function() {
    FormValidation.init();
});
