
    <script> var realPath = "/<?=$realPath?>"; </script>
    <script src="/<?=$realPath?>assets/js/jquery.js?v=<?=$logicBuild?>"></script>
    <script src="/<?=$realPath?>assets/js/jquery-ui.js?v=<?=$logicBuild?>"></script>
    <script src="/<?=$realPath?>assets/js/popper.js?v=<?=$logicBuild?>"></script>
    <script src="/<?=$realPath?>assets/js/bootstrap.js?v=<?=$logicBuild?>"></script>
    <script src="/<?=$realPath?>assets/js/swiper.js?v=<?=$logicBuild?>"></script>
    
    <?php if (isset($externalJS)) : ?>
    
        <?php foreach ($externalJS as $externalURL) : ?>
    
            <script src="<?=$externalURL?>?v=<?=$logicBuild?>"></script>
    
        <?php endforeach; ?>
    
    <?php endif; ?>
    
    <script src="/<?=$realPath?>assets/js/script.js?v=<?=$logicBuild?>"></script>

    <?php if ($readTheme['broadcast']==1 && $readTheme['headerTheme']=="1" && $broadcastTotal > 0): ?>

    <script type="text/javascript">

        var swiper = new Swiper('.swiper-broadcast', {
            direction: 'vertical',
            autoplay: {
                delay: 7500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

    </script>

    <?php endif; ?>
    <?php 

    if ($readSettings['liveChat']==1):
    
        echo $readSettings['liveChatJS'];

    endif;

    ?>

    </body>
</html>