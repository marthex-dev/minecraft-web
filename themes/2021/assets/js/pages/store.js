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

$(function() {

    $('[data-toggle="count-down"]').each(function() {
        
        var $this = $(this);

        var countDownDate = new Date($this.attr('data-countdown')).getTime();

        var x = setInterval(function() {

            var now = new Date().getTime();
            var distance = countDownDate - now;

            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $this.html(days + "g " + hours + "s "
              + minutes + "d " + seconds + "s ")
                
            if (distance < 0) {
              clearInterval(x);
              $this.html('İndirim Bitti!');
            }

        }, 1000);

    });

});