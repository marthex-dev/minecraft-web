$(function() {
    if($('select[name="storeWebhook"]').val() == '1') {
        $('#storeWebhookContent').fadeIn(600);
    } else {
        $('#storeWebhookContent').hide();
    }
    $('select[name="storeWebhook"]').change(function(){
        if($('select[name="storeWebhook"]').val() == '1') {
            $('#storeWebhookContent').fadeIn(600);
        } else {
            $('#storeWebhookContent').hide();
        }
    });

});

$(function() {
    if($('select[name="creditWebhook"]').val() == '1') {
        $('#creditWebhookContent').fadeIn(600);
    } else {
        $('#creditWebhookContent').hide();
    }
    $('select[name="creditWebhook"]').change(function(){
        if($('select[name="creditWebhook"]').val() == '1') {
            $('#creditWebhookContent').fadeIn(600);
        } else {
            $('#creditWebhookContent').hide();
        }
    });

});

$(function() {
    
    if($('select[name="caseWebhook"]').val() == '1') {
        $('#caseWebhookContent').fadeIn(600);
    } else {
        $('#caseWebhookContent').hide();
    }
    $('select[name="caseWebhook"]').change(function(){
        if($('select[name="caseWebhook"]').val() == '1') {
            $('#caseWebhookContent').fadeIn(600);
        } else {
            $('#caseWebhookContent').hide();
        }
    });

});

$(function() {
    
    if($('select[name="supportWebhook"]').val() == '1') {
        $('#supportWebhookContent').fadeIn(600);
    } else {
        $('#supportWebhookContent').hide();
    }
    $('select[name="supportWebhook"]').change(function(){
        if($('select[name="supportWebhook"]').val() == '1') {
            $('#supportWebhookContent').fadeIn(600);
        } else {
            $('#supportWebhookContent').hide();
        }
    });

});

$(function() {
    
    if($('select[name="commentsWebhook"]').val() == '1') {
        $('#commentsWebhookContent').fadeIn(600);
    } else {
        $('#commentsWebhookContent').hide();
    }
    $('select[name="commentsWebhook"]').change(function(){
        if($('select[name="commentsWebhook"]').val() == '1') {
            $('#commentsWebhookContent').fadeIn(600);
        } else {
            $('#commentsWebhookContent').hide();
        }
    });

});