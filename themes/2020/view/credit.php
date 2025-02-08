<?php require 'static/header.php' ?>

<?php if (isset($action[1]) && $action[1]=="yukle"): ?>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-12">

                <?=(isset($response))?$response:""?>
                <div class="card mb-3">
                    <div class="card-header">
                        Kredi Yükle
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="username">Kullanıcı Adı :</label>
                                <div class="col-md-10">
                                    <input class="form-control" disabled="" id="username" value="<?=$readUser['username']?>" type="text" placeholder="Kredi göndereceğiniz oyuncunun kullanıcı adını yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="credit">Miktar :</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="credit" type="number" name="credit" placeholder="Yüklenecek Miktar">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="apiType">Ödeme :</label>
                                <div class="col-md-10">
                                    <select id="apiType" name="apiType" class="form-control">
                                    <?php if (isset($payments) && $payments): ?>

                                        <?php foreach ($payments as $readPayments): ?>

                                            <option value="<?=$readPayments['id']?>"><?=$readPayments['heading']?></option>

                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-right">
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-3">Kredi Yükle</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <?php require 'static/credit-history.php' ?>
            </div>

        </div>
    </div>
</section>

<?php elseif (isset($action[1]) && $action[1]=="gonder"): ?>

<section id="chest" class="min-height-500">
    <div class="container">
        <div class="row">
            
            <div class="col-lg-8 col-md-12">

                <?php if ($readSettings['sendCreditStatus']==1): ?>
                <?=(isset($response))?$response:""?>
                <div class="card mb-3">
                    <div class="card-header">
                        Kredi Gönder
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="username">Kullanıcı Adı :</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="username" name="username" type="text" placeholder="Kredi göndereceğiniz oyuncunun kullanıcı adını yazınız.">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="credit">Miktar :</label>
                                <div class="col-md-10">
                                    <input class="form-control" id="credit" type="number" name="credit" placeholder="Gönderilecek Miktar">
                                </div>
                            </div>
                            <div class="form-group row mb-0 text-right">
                                <div class="col-md-12 mt-3">
                                    <button type="submit" class="btn btn-3">Kredi Gönder</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                    <?php echo alert('danger', 'Kredi gönderme yönetici tarafından kapatılmış.'); ?>
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