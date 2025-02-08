function ajaxVIP($dataID)
{

  Swal.fire({
  
      title: 'UYARI!',
      icon: 'warning',
      html: 'Ürünü satın almak istiyor musunuz? ',
      showCancelButton: true,
      confirmButtonText: 'Evet, istiyorum',
      cancelButtonText: 'Hayır'
  
  }).then((result) => {

      if (result.isConfirmed) {

        $('#preload').css("opacity", "0.5").show();
        $('#preload-content').fadeIn(800);

        $.ajax({
          type: "POST",
          url: realPath + "/ajax/vip.ajax.php",
          data : {id : $dataID},
          success: function(result) {

            if (result == 1) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Lütfen giriş yapınız!',
                confirmButtonText: 'Tamam',

              });

            }else if (result == 2) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Kullanıcı Bulunamadı!',
                confirmButtonText: 'Tamam',

              });

            }else if (result == 3) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Ürün Bulunamadı!',
                confirmButtonText: 'Tamam',

              });
              
            }else if (result == 4) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Sunucu Bulunamadı!',
                confirmButtonText: 'Tamam',

              });
              
            }else if (result == 5) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Ürün stokları tükenmiş!',
                confirmButtonText: 'Tamam',

              });
              
            }else if (result == 6) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Yeterli krediniz bulunmuyor!',
                confirmButtonText: 'Tamam',

              });
              
            }else if (result == 7) {

              Swal.fire({
                
                icon: 'error',
                title: 'Hata!',
                text: 'Yetkiliyle iletişime geçiniz!',
                confirmButtonText: 'Tamam',

              });
              
            }else {

              $('#buyResponse').html(result);

            }

            $('#preload').fadeOut(800);
          
          }
        });

      }

  });

}