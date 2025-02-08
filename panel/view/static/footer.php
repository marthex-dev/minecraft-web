				<footer class="footer">
        		    <div class="container-fluid">
        		        <div class="row">
        		            <div class="col-sm-6">
        		                <script>document.write(new Date().getFullYear())</script> © RabiWebV1.0
        		            </div>
        		            <div class="col-sm-6">
        		                <div class="text-sm-right d-none d-sm-block">
        		                    <a href="https://rabi.web.tr">RabiWeb Yazılım Hizmetleri</a>
        		                </div>
        		            </div>
        		        </div>
        		    </div>
        		</footer>
        	</div>
        </div>
        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js?v=<?=$RabiwebVersion?>"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js?v=<?=$RabiwebVersion?>"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js?v=<?=$RabiwebVersion?>"></script>
        <script src="assets/libs/simplebar/simplebar.min.js?v=<?=$RabiwebVersion?>"></script>
        <script src="assets/libs/node-waves/waves.min.js?v=<?=$RabiwebVersion?>"></script>
        
        <?php
          if (isset($extraResourcesJS)) {
            $extraResourcesJS->getResources();
          }
        ?>
        
        <!-- App js -->
        <script src="assets/js/app.js?v=<?=$RabiwebVersion?>"></script>

        <!-- Script js -->
        <?php
          if (isset($extraResourcesScript)) {
            $extraResourcesScript->getResources();
          }
        ?>

    </body>
</html>