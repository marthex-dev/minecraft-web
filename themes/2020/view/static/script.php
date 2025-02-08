
    <script> var realPath = "<?=$realPath?>"; </script>

    <script src="/<?=$realPath?>assets/js/jquery.js?v=<?=$RabiwebVersion?>"></script>
    <script src="/<?=$realPath?>assets/js/jquery-ui.js?v=<?=$RabiwebVersion?>"></script>
    <script src="/<?=$realPath?>assets/js/popper.js?v=<?=$RabiwebVersion?>"></script>
    <script src="/<?=$realPath?>assets/js/bootstrap.js?v=<?=$RabiwebVersion?>"></script>
    <script src="/<?=$realPath?>assets/js/swiper.js?v=<?=$RabiwebVersion?>"></script>
    
    <?php if (isset($externalJS)) : ?>
    
        <?php foreach ($externalJS as $externalURL) : ?>
    
            <script src="<?=$externalURL?>?v=<?=$RabiwebVersion?>"></script>
    
        <?php endforeach; ?>
    
    <?php endif; ?>
    
    <script src="/<?=$realPath?>assets/js/script.js?v=<?=$RabiwebVersion?>"></script>

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

    <?php if ($readSettings['onlineJS']==1): ?>

    <script type="text/javascript">

        var $onlineApi = <?=$readSettings['onlineApi']?>;

        var serverIP = "<?=$readSettings['serverIP']?>";

        var serverPort = <?=!empty($readSettings['serverPort'])?$readSettings['serverPort']:"25565"?>;
        
        $(document).ready(function () {

            if ($onlineApi == 1) {

                var $onlineJson = "https://eu.mc-api.net/v3/server/ping/"+ serverIP +":"+ serverPort;

            }else if ($onlineApi == 2) {

                var $onlineJson = "https://mcapi.tc/?"+ serverIP +"/json";

            }else if($onlineApi == 3){

                var $onlineJson = "https://api.keyubu.net/mc/ping.php?ip="+ serverIP +":"+ serverPort;

            }else if($onlineApi == 4){

                var $onlineJson = "https://api.mcsrvstat.us/2/"+ serverIP +":"+ serverPort;

            }else if($onlineApi == 5){

                var $onlineJson = "https://api.mcsrvstat.us/2/"+ serverIP +":19132";

            }else {

                var $onlineJson = "https://mcapi.us/server/status?ip="+ serverIP +"&port="+ serverPort;

            }

            $.ajax({
                url: $onlineJson,
                dataType: "json",
                success: function(data) {

                    if ($onlineApi == 2) {

                        var $onlineStatus = data["status"];
                        var $onlineCount = data["players"];

                    }else if($onlineApi == 1 || $onlineApi == 3 || $onlineApi == 4 || $onlineApi == 5){

                        var $onlineStatus = data["online"];
                        var $onlineCount = data["players"]["online"];

                    }else {

                        var $onlineStatus = data["online"];
                        var $onlineCount = data["players"]["now"];

                    }

                    if ($onlineStatus != "offline"){

                        $("#online-count").html($onlineCount);

                    }
                    else {

                        $("#online-count").html("0");
                    
                    }

                }
            });

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