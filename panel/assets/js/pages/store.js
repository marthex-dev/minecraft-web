$(function() {
    if($('select[name="discount"]').val() == '1') {
        $('#discountDiv').fadeIn(600);
    } else {
        $('#discountDiv').hide();
    }
    $('select[name="discount"]').change(function(){
        if($('select[name="discount"]').val() == '1') {
            $('#discountDiv').fadeIn(600);
        } else {
            $('#discountDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="discountDuration"]').val() == '1') {
        $('#discountDurationDiv').fadeIn(600);
    } else {
        $('#discountDurationDiv').hide();
    }
    $('select[name="discountDuration"]').change(function(){
        if($('select[name="discountDuration"]').val() == '1') {
            $('#discountDurationDiv').fadeIn(600);
        } else {
            $('#discountDurationDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="duration"]').val() == '1') {
        $('#durationDiv').fadeIn(600);
        $('#durationCommandsDiv').fadeIn(600);
    } else {
        $('#durationDiv').hide();
        $('#durationCommandsDiv').hide();
    }
    $('select[name="duration"]').change(function(){
        if($('select[name="duration"]').val() == '1') {
            $('#durationDiv').fadeIn(600);
            $('#durationCommandsDiv').fadeIn(600);
        } else {
            $('#durationDiv').hide();
            $('#durationCommandsDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="stockStatus"]').val() == '1') {
        $('#stockDiv').fadeIn(600);
    } else {
        $('#stockDiv').hide();
    }
    $('select[name="stockStatus"]').change(function(){
        if($('select[name="stockStatus"]').val() == '1') {
            $('#stockDiv').fadeIn(600);
        } else {
            $('#stockDiv').hide();
        }
    });

});

function copyCommands(type = 0, list = false, table = false) {

    if (type == 0){

        var html = '<tr><td class="text-center w-100"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="bx bx-code-alt"></i></div></div><input type="text" class="form-control" name="commands[]" placeholder="Ürün satın aldığında konsola gönderilecek komudu giriniz."></div></td><td><a onclick="copyCommands(\'2\', this, \'#commandsTable\')" class="btn btn-sm btn-rounded-circle btn-danger"><i class="bx bx-trash-alt"></i></a></td></tr>';
        $(list + ' tr:last').after(html);

    }else if (type == 1){

        var html = '<tr><td class="text-center w-100"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><i class="bx bx-code-alt"></i></div></div><input type="text" class="form-control" name="expiryCommands[]" placeholder="Ürün süresi bittiğinde konsola gönderilecek komudu giriniz."></div></td><td><a onclick="copyCommands(\'2\', this, \'#expiryCommandsTable\')" class="btn btn-sm btn-rounded-circle btn-danger"><i class="bx bx-trash-alt"></i></a></td></tr>';
        $(list + ' tr:last').after(html);

    }else if (type == 2){

        if($(table).find("tbody tr").length > 1){
            $(list).closest('tr').remove();
        }else{
            $(list).closest('tr').find("input").val("");
        }

    }

}

function getServerFeatures(selectID)
{
  
  var id = $(selectID).val();

  $("#features").html('<tr><td colspan="2" class="text-center">Lütfen bekleyiniz...</td></tr>');

    $.ajax({
        type: "POST",
        url: "classes/ajax/vip.features.php",
        data : {serverID : id},
        success: function(data) {
            $("#features").html(data);
        }

    });

}