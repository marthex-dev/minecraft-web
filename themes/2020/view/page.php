<?php require 'static/header.php' ?>

<section id="pages" class="min-height-500">
    <div class="container">
        <div class="row">

            <?php if(isset($action[1]) && isset($readPage) && $readPage['total'] > 0): ?>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <?=$readPage['heading']?>
                    </div>
                    <div class="card-body">
                        <?=$readPage['content']?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="col-lg-12">
                <?=alert('danger', 'Sayfa Bulunamadı')?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php require 'static/footer.php' ?>