$(function() {
    if($('select[name="smtpType"]').val() == '0') {
        $('#smtpTypeDiv').hide();
    } else {
        $('#smtpTypeDiv').fadeIn(600);
    }
    $('select[name="smtpType"]').change(function(){
        if($('select[name="smtpType"]').val() == '0') {
            $('#smtpTypeDiv').hide();
        } else {
            $('#smtpTypeDiv').fadeIn(600);
        }
    });

});