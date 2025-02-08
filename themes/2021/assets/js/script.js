if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}

$('[data-toggle="tooltip"]').tooltip();

function copy(element, button) {
    let input = document.createElement('input');
    input.name = "copy-element";
    input.style.setProperty("opacity", 0);
    input.style.setProperty("position", "absolute");
    input.style.setProperty("left", "-99999px");
    input.style.setProperty("top", "-99999px");
    input.value = element;
    document.body.appendChild(input);
    let targetInput = document.body.querySelector('input[name="copy-element"]');
    targetInput.select();
    document.execCommand('copy');
    $(button).text("IP Adresi Kopyalandı!");
    setTimeout(() => $(button).text("OYNA"), 1000);
}

$(window).on('load', function() {
    $('.fade-in').css({ position: 'relative', opacity: 0, top: -14 });
    setTimeout(
        function() {
            $('#preload-content').fadeOut(400, function() {
                $('#preload').fadeOut(800);
                setTimeout(
                    function() {
                        $('.fade-in').each(function(index) {
                            $(this).delay(400 * index).animate({ top: 0, opacity: 1 }, 800);
                        });
                    },
                    800
                );
            });
        },
        400
    );
});