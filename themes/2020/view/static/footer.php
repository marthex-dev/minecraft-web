    <?php if ($readTheme['slice']=="1" && !isset($_SESSION['login'])): ?>

    <section class="slice">
        <div class="container<?=($readTheme['sliceType']==0)?"-fluid":""?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="slice-bg-div px-4 py-5" style="background: var(--slice-bg);overflow: hidden;border-radius: 6px;position: relative;background-position: center;">
                        <div class="slice-gradient" style="width: 100%;height: 100%;position: absolute;left: 0;top: 0;background: rgba(0, 0, 0, 0.6)"></div>
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-12 pb-3 pb-lg-0 text-center text-lg-left">
                                <div class="slice-content">
                                    <h2 class="text-white" style="font-weight: 800;"><?=$readTheme['sliceHeading']?></h2>
                                    <h2 class="mb-0" style="font-weight: 800;color: var(--primary);"><?=$readTheme['sliceSubHeading']?></h2>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12 text-center text-lg-right">
                                <div class="slice-bg">
                                    <a href="kayit-ol" class="btn-1 py-3 px-4 mr-2">Kayıt Ol</a>
                                    <a href="destek" class="btn-2 py-3 px-4">Daha Fazla Bilgi Al</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php endif; ?>

    <footer class="page-footer font-small">

        <?php if (!empty($readSettings['aboutUs']) OR !empty($readSettings['facebookURL']) OR !empty($readSettings['twitterURL']) OR !empty($readSettings['instagramURL']) OR !empty($readSettings['youtubeURL']) OR !empty($readSettings['discordURL']) OR !empty($readSettings['eMail']) OR !empty($readSettings['phone']) OR !empty($readSettings['whatsapp'])): ?>


        <div class="container footer-top text-center text-md-left">

            <div class="row text-md-left text-center">

                <?php if (!empty($readSettings['aboutUs'])): ?>

                <div class="col-lg-4 text-lg-left text-center <?=(empty($readSettings['facebookURL']) && empty($readSettings['twitterURL']) && empty($readSettings['instagramURL']) && empty($readSettings['youtubeURL']) && empty($readSettings['discordURL']) OR empty($readSettings['eMail']) && empty($readSettings['phone']) && empty($readSettings['whatsapp']))?"mx-auto":NULL?>">

                    <h5 class="font-weight-bold mt-3 mb-4">Hakkımızda</h5>
                    <p><?=$readSettings['aboutUs']?></p>

                </div>

                <hr class="clearfix w-100 d-md-none">

                <?php endif; ?>

                <?php if (!empty($readSettings['facebookURL']) OR !empty($readSettings['twitterURL']) OR !empty($readSettings['instagramURL']) OR !empty($readSettings['youtubeURL']) OR !empty($readSettings['discordURL'])): ?>

                <div class="col-lg-2 text-lg-left text-center social-media <?=(!empty($readSettings['aboutUs']))?"mx-auto":NULL?>">

                    <h5 class="font-weight-bold mt-3 mb-4">Sosyal Medya</h5>

                    <ul class="list-unstyled">
                        <?php if (!empty($readSettings['facebookURL'])): ?>
                        <li>
                            <a href="<?=$readSettings['facebookURL']?>" target="_blank"><i class="mdi mdi-facebook mr-1"></i> Facebook</a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($readSettings['twitterURL'])): ?>
                        <li>
                            <a href="<?=$readSettings['twitterURL']?>" target="_blank"><i class="mdi mdi-twitter mr-1"></i> Twitter</a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($readSettings['instagramURL'])): ?>
                        <li>
                            <a href="<?=$readSettings['instagramURL']?>" target="_blank"><i class="mdi mdi-instagram mr-1"></i> Instagram</a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($readSettings['youtubeURL'])): ?>
                        <li>
                            <a href="<?=$readSettings['youtubeURL']?>" target="_blank"><i class="mdi mdi-youtube mr-1"></i> Youtube</a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($readSettings['discordURL'])): ?>
                        <li>
                            <a href="<?=$readSettings['discordURL']?>" target="_blank"><i class="mdi mdi-discord mr-1"></i> Discord</a>
                        </li>
                        <?php endif; ?>
                    </ul>

                </div>

                <hr class="clearfix w-100 d-md-none">

                <?php endif; ?>

                <?php if (!empty($readSettings['eMail']) OR !empty($readSettings['phone']) OR !empty($readSettings['whatsapp'])): ?>

                <div class="col-lg-2 text-lg-left text-center social-media justify-content-baseline <?=(!empty($readSettings['aboutUs']) OR !empty($readSettings['facebookURL']) && !empty($readSettings['twitterURL']) && !empty($readSettings['instagramURL']) && !empty($readSettings['youtubeURL']) && !empty($readSettings['discordURL']))?"mx-auto":NULL?>">

                    <h5 class="font-weight-bold mt-3 mb-4">İletişim</h5>

                    <ul class="list-unstyled">
                        <?php if (!empty($readSettings['eMail'])): ?>
                        <li>
                            <a class="justify-content-start" href="mailto:<?=$readSettings['eMail']?>" target="_blank"><i class="mdi mdi-email mr-1"></i> <?=$readSettings['eMail']?></a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($readSettings['phone'])): ?>
                        <li>
                            <a class="justify-content-start" href="tel:<?=$readSettings['phone']?>"><i class="mdi mdi-phone mr-1"></i> <?=$readSettings['phone']?></a>
                        </li>
                        <?php endif; ?>
                        <?php if (!empty($readSettings['whatsapp'])): ?>
                        <li>
                            <a class="justify-content-start" href="<?=$readSettings['whatsapp']?>"><i class="mdi mdi-whatsapp mr-1"></i> <?=$readSettings['whatsapp']?></a>
                        </li>
                        <?php endif; ?>
                    </ul>

                </div>

                <?php endif; ?>

            </div>
        </div>

        <hr class="mb-0">

        <?php endif; ?>

        <div class="container footer-bottom py-3">
            <div class="row">
                <div class="col-md-6 col-12 text-center text-md-left">
                    <div class="footer-copyright">
                        Tüm hakları saklıdır © 
                    </div>
                </div>
                <div class="col-md-6 col-12 mt-md-0 mt-2">
                    <div class="footer-brand">
                        <a href="https://rabiweb.com.tr/" class="justify-content-center justify-content-md-end" target="_blank">RabiWeb v1.0</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<?php if ($readSettings['preloader']==1): ?>

    <div id="preload">
        <div id="preload-content">
            <div class="preload-spinner">
                <span class="bounce1"></span>
                <span class="bounce2"></span>
                <span class="bounce3"></span>
            </div>
            <div class="preload-text">Yükleniyor...</div>
        </div>
    </div>

<?php endif; ?>

<?php require 'script.php'; ?>