function ajaxCase($caseID)
{

    Swal.fire({
  
        title: 'UYARI!',
        icon: 'warning',
        text: 'Kasayı açmak istiyor musunuz?',
        showCancelButton: true,
        confirmButtonText: 'Evet, istiyorum',
        cancelButtonText: 'Hayır'
  
    }).then((result) => {
      
        if (result.isConfirmed) {
            
            $('#preload').css("opacity", "0.5").show();
            $('#preload-content').fadeIn(800);

            $.ajax({

                type: "POST",
                url: realPath + "/ajax/case.ajax.php",
                data : {id : $caseID},
                success: function(result) {

                    if (result == 1 || result == 4 || result == 8) {

                        $('#caseAlert').html('<div class="alert alert-danger border-radius-20" role="alert"> <i class="fa fa-times-circle mr-2"></i> Hata! Yetkiliyle iletişime geçiniz.</div>');

                    }else if (result == 2) {

                        $('#caseAlert').html('<div class="alert alert-danger border-radius-20" role="alert"> <i class="fa fa-times-circle mr-2"></i> Kasa bulunamadı!</div>');

                    }else if (result == 3) {

                        $('#caseAlert').html('<div class="alert alert-danger border-radius-20" role="alert"> <i class="fa fa-times-circle mr-2"></i> Kullanıcı bulunamadı!</div>');

                    }else if (result == 5) {

                        $('#caseAlert').html('<div class="alert alert-danger border-radius-20" role="alert"> <i class="fa fa-times-circle mr-2"></i> Kasayı açmak için beklemeniz gerekiyor.</div>');

                    }else if (result == 6) {

                        $('#caseAlert').html('<div class="alert alert-danger border-radius-20" role="alert"> <i class="fa fa-times-circle mr-2"></i> Kasayı açmak için beklemeniz gerekiyor.</div>');

                    }else if (result == 7) {

                        $('#caseAlert').html('<div class="alert alert-danger border-radius-20" role="alert"> <i class="fa fa-times-circle mr-2"></i> Yeterli krediniz bulunmuyor.</div>');

                    }else{

                        $('#caseResponse').show('puff', '', '1000');
                        $('#caseResponse').html(result);

                    }

                    $('#preload').fadeOut(800);

                }

            });
        }

    });

}