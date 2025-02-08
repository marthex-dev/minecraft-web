<?php require 'static/header.php' ?>

<?php if (isset($action[1]) && $action[1]=="eft"): ?>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-12">
            	<?php if (!empty($paymentDataList)): ?>
            	<div class="alert alert-warning" role="alert"> 
            		Ödeme yaptıktan sonra <b>Destek Bildirimi</b> açınız.
            	</div>
            	<?php foreach ($paymentDataList as $readPaymentDataList): ?>

				<div class="alert d-flex py-4 align-items-center justify-content-center text-center alert-success" role="alert"> 
					<div class="alert-centered">
						<p class="mb-2"><b>AD SOYAD:</b> <?=$readPaymentDataList['realname']?></p>
                    	<p class="mb-2"><b>BANKA:</b> <?=$readPaymentDataList['bankname']?></p>
                    	<p class="mb-2"><b>IBAN:</b> <?=$readPaymentDataList['iban']?></p>
					</div>
				</div>
				<?php endforeach; ?>
				<?php else: ?>
					<?=alert('danger', 'Henüz Banka hesabı eklenmemiş.')?>
				<?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php require 'static/credit-history.php' ?>
            </div>

        </div>
    </div>
</section>

<?php elseif (isset($action[1]) && $action[1]=="ininal"): ?>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-12">
                <?php if (!empty($paymentDataList)): ?>
                    
                <div class="alert alert-warning" role="alert"> 
                    Ödeme yaptıktan sonra <b>Destek Bildirimi</b> açınız.
                </div>

                <?php foreach ($paymentDataList as $readPaymentDataList): ?>

                <div class="alert d-flex py-4 align-items-center justify-content-center text-center alert-success" role="alert"> 
                    <div class="alert-centered">
                        <p class="mb-2"><b>BARKOD NO:</b></p>
                        <p class="mb-0"><?=$readPaymentDataList?></p>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php else: ?>
                    <?=alert('danger', 'Henüz İninal barkod eklenmemiş.')?>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php require 'static/credit-history.php' ?>
            </div>

        </div>
    </div>
</section>

<?php elseif (isset($action[1]) && $action[1]=="papara"): ?>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-12">
                <?php if (!empty($paymentDataList)): ?>
                <div class="alert alert-warning" role="alert"> 
                    Ödeme yaptıktan sonra <b>Destek Bildirimi</b> açınız.
                </div>

                <?php foreach ($paymentDataList as $readPaymentDataList): ?>

                <div class="alert d-flex py-4 align-items-center justify-content-center text-center alert-success" role="alert"> 
                    <div class="alert-centered">
                        <p class="mb-2"><b>PAPARA NO:</b></p>
                        <p class="mb-0"><?=$readPaymentDataList?></p>
                    </div>
                </div>
                <?php endforeach; ?>

                <?php else: ?>
                    <?=alert('danger', 'Henüz İninal barkod eklenmemiş.')?>
                <?php endif; ?>
            </div>

            <div class="col-lg-4">
                <?php require 'static/credit-history.php' ?>
            </div>

        </div>
    </div>
</section>

<?php endif; ?>

<?php require 'static/footer.php' ?>