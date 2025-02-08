function getProducts()
{

    var $selectProducts = $("#productID");
    var id = $("select[name='serverID']").val();

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