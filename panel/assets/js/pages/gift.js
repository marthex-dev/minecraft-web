$(function() {
    if($('select[name="giftType"]').val() == '0') {
        $('#creditDiv').fadeIn(600);
        $('#productDiv').hide();
    } else {
        $('#productDiv').fadeIn(600);
        $('#creditDiv').hide();
    }
    $('select[name="giftType"]').change(function(){
        if($('select[name="giftType"]').val() == '0') {
            $('#creditDiv').fadeIn(600);
            $('#productDiv').hide();
        } else {
            $('#productDiv').fadeIn(600);
            $('#creditDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="giftTime"]').val() == '1') {
        $('#timeDiv').fadeIn(600);
    } else {
        $('#timeDiv').hide();
    }
    $('select[name="giftTime"]').change(function(){
        if($('select[name="giftTime"]').val() == '1') {
            $('#timeDiv').fadeIn(600);
        } else {
            $('#timeDiv').hide();
        }
    });

});

$(function() {
    if($('select[name="amountType"]').val() == '1') {
        $('#amountDiv').fadeIn(600);
    } else {
        $('#amountDiv').hide();
    }
    $('select[name="amountType"]').change(function(){
        if($('select[name="amountType"]').val() == '1') {
            $('#amountDiv').fadeIn(600);
        } else {
            $('#amountDiv').hide();
        }
    });

});

function getProducts()
{

    var $selectProducts = $("#productID");
    var id = $("select[name='productServer']").val();

    $selectProducts.html("<option>Bekleyiniz...</option>")

    $.ajax({
        url: 'classes/ajax/Case.Products.php',
        data: { id : id },
        type: 'POST',
        success: function(data){
            
            $selectProducts.html(data);

        }
    });

}