<?php 
    session_start();
    require '../../../connect.php';
    
    require '../helper.php';

    $product = $db->from('Products')
                ->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')
                ->select('count(*) as total, Products.*, ProductsCategories.heading as categoryHeading')
                ->where('Products.id', post('id'))
                ->first();

    $date = date('Y-m-d');

?>

<div class="store-modal modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title"><?=$product['heading']?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Kapat">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="row">
                    <div id="buyResponse" class="col-md-12"></div>
                    <div class="col-md-4 mb-3">
                        <div class="product-image">
                            <img src="<?=$find_read_page.$product['image']?>" alt="Ürün - <?=$product['heading']?>" class="img-fluid rounded">
                        </div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <table class="info-table w-100">
                            <tbody>
                                <tr>
                                    <th class="py-2">Ürün Adı:</th>
                                    <td class="text-right">
                                        <?=$product['heading']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2">Kategori:</th>
                                    <td class="text-right">
                                        <?=$product['categoryHeading']?>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2">Fiyat:</th>
                                    <td class="text-right">
                                        <?php if ($product['discount']=="1"): ?>
                                            <?php if ($product['discountDuration'] == "1"): ?>
                                                <?php if ($product['discountExpiry'] > $date): ?>
                                                    <?=$product['discountPrice']?> Kredi
                                                <?php else: ?>
                                                    <?=$product['price']?> Kredi
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?=$product['discountPrice']?> Kredi
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?=$product['price']?> Kredi
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if ($product['discount']=="1"): ?>
                                    <?php if ($product['discountDuration'] == "1"): ?>
                                        <?php if ($product['discountExpiry'] > $date): ?>
                                            <tr>
                                                <th class="py-2">İndirim:</th>
                                                <td class="text-right">
                                                    <div class="store-card-discount">
                                                        <span><?=discountTotal($product['price'], $product['discountPrice'])?></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <tr>
                                            <th class="py-2">İndirim:</th>
                                            <td class="text-right">
                                                <div class="store-card-discount">
                                                    <span><?=discountTotal($product['price'], $product['discountPrice'])?></span>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($product['stockStatus']=="1"): ?>
                                <tr>
                                    <th class="py-2">Stok:</th>
                                    <td class="text-right text-primary font-weight-bold">
                                        <?=$product['stock']?> Adet
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <th class="py-2">Süre:</th>
                                    <td class="text-right">
                                        <?php if ($product['duration']=="1"): ?>
                                        <?=$product['durationDay']?> Gün
                                        <?php else: ?>
                                        Sınırsız
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 mb-3">
                        <div class="info-heading mb-3 text-center">
                            <span>Ürün açıklaması</span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="info-description">
                            <?=$product['content']?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
            <div id="CouponForm" class="d-none w-100">
                <form id="userCheck" name="userCheck" method="post" action="oyuncu">
                    <div class="row">
                        
                        <div class="col-md-4 d-flex align-items-center">
                            <div class="display-hizala">
                                <span>Ödenecek Tutar : </span>
                                &nbsp;
                                <span class="text-primary">10 Kredi</span>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="user-form d-flex">
                                <input type="text" autocomplete="off" class="form-control" placeholder="Kupon kodunuzu giriniz." name="couponCode" />

                                <button type="submit" class="btn btn-1 py-0 ml-2">Kullan</button>
                            </div>
                        </div>

                    </div>
                </form>
                <hr style="border-top: 1px solid rgba(255, 255, 255, .075);" class="mb-2">
            </div>
            <!--<button id="CouponButton" type="button" class="btn btn-2">Kupon Kodu</button>-->
            <button type="button" data-dismiss="modal" class="btn btn-2">İptal</button>
            <?php if (isset($_SESSION['login']) && $_SESSION['login']): ?>
            <button type="button" onclick="storeBuy('<?=$product['id']?>')" class="btn btn-1">Satın Al</button>
            <?php else: ?>
            <a href="giris-yap" class="btn btn-1">Giriş Yap</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#CouponButton").click(function() {
      
        if ($("#CouponForm").hasClass("d-block")) {

            $("#CouponForm").removeClass("d-block");
            $("#CouponForm").addClass("d-none");

        }else {

            $("#CouponForm").addClass("d-block");
            $("#CouponForm").removeClass("d-none");


        }
      
    });
</script>