function ajaxChest($dataID, $type = 1, $usernameInput)
{

    if ($type == 2) {

    Swal.fire({
  
            title: 'UYARI!',
            icon: 'warning',
            html: 'Ürünü teslim etmek istiyor musunuz? <br> Not : Oyuncunun aktif olduğundan emin olun.',
            showCancelButton: true,
            confirmButtonText: 'Evet, istiyorum',
            cancelButtonText: 'Hayır'
  
        }).then((result) => {

            if (result.isConfirmed) {

                $('#preload').css("opacity", "0.5").show();
                $('#preload-content').fadeIn(800);

                var username = $($usernameInput).val();

                $.ajax({
                    type: "POST",
                    url: realPath + "/ajax/chest.ajax.php",
                    data : {id : $dataID, username : username},
                    success: function(result) {
                        $('#chestResponse').html(result);
                        $('#preload').fadeOut(800);
                    }
                });

            }

        });

    }

    if ($type == 1) {

        Swal.fire({
  
            title: 'UYARI!',
            icon: 'warning',
            html: 'Ürünü teslim almak istiyor musunuz? <br> Not : Sunucuda aktif olduğunuzdan emin olun.',
            showCancelButton: true,
            confirmButtonText: 'Evet, istiyorum',
            cancelButtonText: 'Hayır'
  
        }).then((result) => {

            if (result.isConfirmed) {

                $('#preload').css("opacity", "0.5").show();
                $('#preload-content').fadeIn(800);

                $.ajax({
                    type: "POST",
                    url: realPath + "/ajax/chest.ajax.php",
                    data : {id : $dataID},
                    success: function(result) {
                        $('#chestResponse').html(result);
                        $('#preload').fadeOut(800);
                    }
                });
           
            }

        });

    }

}

function ajaxModal($dataID)
{

    $('#preload').css("opacity", "0.5").show();
    $('#preload-content').fadeIn(800);

    $.ajax({
      type: "POST",
      url: realPath + "/ajax/store.ajax.php",
      data : {id : $dataID},
      success: function(result) {
          $('#storeModal').html(result);
          $('#preload').fadeOut(800);
      }
    });

}

function storeBuy($dataID)
{

    $('#preload').css("opacity", "0.5").show();
    $('#preload-content').fadeIn(800);

    $.ajax({
      type: "POST",
      url: realPath + "/ajax/buy.ajax.php",
      data : {id : $dataID},
      success: function(result) {
          $('#buyResponse').html(result);
          $('#preload').fadeOut(800);
      }
    });

}