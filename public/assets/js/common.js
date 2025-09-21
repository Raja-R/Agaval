var common = {};
common.toastr = function (type, message) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    if (type == 'error_msg') {
        var message_obj = JSON.parse(message);
        $.each(message_obj, function (index,value) {
            toastr.error(value);
        });
    }else if (type == 'success_msg') {
        toastr.success(message);
    }else{
        toastr.info(message);
    }
};

common.toastr_popup = function (type, message) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    if (type == 'error_msg') {
        toastr.error(message);
    }else if (type == 'success_msg') {
        toastr.success(message);
    }else{
        toastr.info(message);
    }
};