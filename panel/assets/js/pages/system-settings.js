$(function() {
    if($('select[name="oneSignalStatus"]').val() == '1') {
        $('#oneSignalDiv').fadeIn(600);
    } else {
        $('#oneSignalDiv').hide();
    }
    $('select[name="oneSignalStatus"]').change(function(){
        if($('select[name="oneSignalStatus"]').val() == '1') {
            $('#oneSignalDiv').fadeIn(600);
        } else {
            $('#oneSignalDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="liveChat"]').val() == '1') {
        $('#liveChatDiv').fadeIn(600);
    } else {
        $('#liveChatDiv').hide();
    }
    $('select[name="liveChat"]').change(function(){
        if($('select[name="liveChat"]').val() == '1') {
            $('#liveChatDiv').fadeIn(600);
        } else {
            $('#liveChatDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="bonusCreditStatus"]').val() == '1') {
        $('#bonusCreditDiv').fadeIn(600);
    } else {
        $('#bonusCreditDiv').hide();
    }
    $('select[name="bonusCreditStatus"]').change(function(){
        if($('select[name="bonusCreditStatus"]').val() == '1') {
            $('#bonusCreditDiv').fadeIn(600);
        } else {
            $('#bonusCreditDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="analyticsStatus"]').val() == '1') {
        $('#analyticsDiv').fadeIn(600);
    } else {
        $('#analyticsDiv').hide();
    }
    $('select[name="analyticsStatus"]').change(function(){
        if($('select[name="analyticsStatus"]').val() == '1') {
            $('#analyticsDiv').fadeIn(600);
        } else {
            $('#analyticsDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="recaptchaStatus"]').val() == '1') {
        $('#recaptchaDiv').fadeIn(600);
    } else {
        $('#recaptchaDiv').hide();
    }
    $('select[name="recaptchaStatus"]').change(function(){
        if($('select[name="recaptchaStatus"]').val() == '1') {
            $('#recaptchaDiv').fadeIn(600);
        } else {
            $('#recaptchaDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="maintenanceMode"]').val() == '1') {
        $('#maintenanceDiv').fadeIn(600);
    } else {
        $('#maintenanceDiv').hide();
    }
    $('select[name="maintenanceMode"]').change(function(){
        if($('select[name="maintenanceMode"]').val() == '1') {
            $('#maintenanceDiv').fadeIn(600);
        } else {
            $('#maintenanceDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="maintenanceDuration"]').val() == '1') {
        $('#maintenanceDurationDiv').fadeIn(600);
    } else {
        $('#maintenanceDurationDiv').hide();
    }
    $('select[name="maintenanceDuration"]').change(function(){
        if($('select[name="maintenanceDuration"]').val() == '1') {
            $('#maintenanceDurationDiv').fadeIn(600);
        } else {
            $('#maintenanceDurationDiv').hide();
        }
    });

});

var editor = CodeMirror.fromTextArea(document.getElementById("liveChatJS"), {
    mode: "css",
    theme: "ambiance",
    lineNumbers: true
});

$("#maintenanceExpiryTime").timepicker({showMeridian:!1,icons:{up:"mdi mdi-chevron-up",down:"mdi mdi-chevron-down"}});