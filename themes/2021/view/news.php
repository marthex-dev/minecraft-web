<?php require 'static/header.php' ?>

<?php if ($totalNews > 0): ?>

<section id="news-list" class="min-height-500">
    <div class="container">
        <div class="row">

            <div class="col-lg-8 col-md-12">
                <div class="row">

                    <?php if(isset($response)): ?>
                    <div class="col-md-12">
                        <?=$response?>
                    </div>
                    <?php endif; ?>

                    <div class="col-md-12 mb-3">
                        <div class="card news-card">
                            <img class="card-img-top" src="<?=$find_read_page.$news['NewsImage']?>" alt="Card image cap">
                            <div class="card-body py-4 px-4">
                                <h5 class="news-header d-block"><?=$news['NewsName']?></h5>
                                <small class="news-sub-header"><?=ConvertTime($news['NewsDate'])?> <span style="color: <?=$news['CategoryColor']?>;"><?=$news['CategoryName']?></span> kategorisinde yayınlandı.</small>
                                <div class="news-content">
                                    <p class="news-description"><?=catchEmoji($news["content"])?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($readSettings['commentsStatus']==1): ?>
                        <?php if($news['commentsStatus']==1): ?>
                            <?php if ($totalComments > 0): ?>
                            <div class="col-md-12">
                                <div class="card sidebar mb-3">
                                    <div class="card-header">
                                        <i class="mdi mdi-comment-multiple mr-2"></i>
                                        Yorumlar
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            
                                            <?php foreach ($comments as $key => $readComments): ?>
                                                <?php if ($key!=0): ?>
                                                <hr>
                                                <?php endif; ?>
                                                <li class="media">
                                                    <img src="<?=avatar($readComments['username'], '40')?>" class="mr-3 rounded-circle" alt="Oyuncu - <?=$readComments['username']?>">
                                                    <div class="media-body">
                                                        <span class="float-right"><?=ConvertTime($readComments['creationDate'])?></span>
                                                        <h6 class="mt-0 mb-1">
                                                            <a href="oyuncu/<?=$readComments['username']?>">
                                                                <?=$readComments['realname']?>
                                                            </a>
                                                        </h6>
                                                        <p class="mb-0"><?=catchEmoji($readComments['message'])?></p>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                            <?php if(isset($_SESSION['login'])): ?>
                                <?php if($totalComments < 1): ?>
                                    <div class="col-md-12">
                                        <?=alert('warning', 'İlk yorumu sen yapmak ister misin?')?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-md-12">
                                    <div class="card sidebar mb-3">
                                        <div class="card-header">
                                            <i class="mdi mdi-comment-edit mr-2"></i>
                                            Yorum yap
                                        </div>
                                        <div class="card-body">
                                            <div class="media">
                                                <img src="<?=avatar($readUser['username'], '40')?>" class="mr-3 rounded-circle" alt="Oyuncu - <?=$readUser['username']?>">
                                                <div class="comments-body media-body">
                                                    <form action="" method="post">
                                                        <textarea class="form-control" name="message" rows="5"></textarea>
                                                        <button class="btn btn-1 float-right mt-3">Yorumu gönder</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-md-12">
                                    <?=alert('danger', 'Yorum yapmak için giriş yapmanız gerekiyor.')?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-4">
                <?php require 'static/sidebar.php' ?>
            </div>

        </div>
    </div>
</section>

<?php endif; ?>

<?php require 'static/footer.php' ?>