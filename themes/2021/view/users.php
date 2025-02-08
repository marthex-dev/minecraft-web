<?php require 'static/header.php' ?>

<?php if ($user['total'] > 0): ?>

<section id="profile" class="min-height-500">
    <div class="container">
        <div class="row">

        	<div class="col-lg-4 col-md-12">
                <div class="card overflow-hidden">
                    <div class="card-body pt-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="avatar-md text-center profile-user-wid mb-4 mx-auto">
                                    <img src="<?=avatar($user['username'], '72')?>" alt="" class="img-thumbnail rounded-circle">
                                </div>
                                <div class="table-responsive mt-3">
                                    <table class="table table-nowrap mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Kullanıcı Adı:</th>
                                                <td><?=$user['realname']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Yetki:</th>
                                                <td>
                                                    <?php
                                                    if ($user['permission']=="0"):
                                                        echo "<span class='badge badge-pill badge-secondary'>Oyuncu</span>";
                                                    elseif ($user['permission']=="1"):
                                                        echo "<span class='badge badge-pill badge-dark'>Youtuber</span>";
                                                    elseif ($user['permission']=="2"):
                                                        echo "<span class='badge badge-pill badge-info'>Destek</span>";
                                                    elseif($user['permission']=="3"):
                                                        echo "<span class='badge badge-pill badge-warning'>Yazar</span>";
                                                    elseif($user['permission']=="4"):
                                                        echo "<span class='badge badge-pill badge-primary'>Görevli</span>";
                                                    elseif($user['permission']=="5"):
                                                        echo "<span class='badge badge-pill badge-success'>Moderatör</span>";
                                                    elseif($user['permission']=="6"):
                                                        echo "<span class='badge badge-pill badge-danger'>Yönetici</span>";
                                                    else:
                                                        echo "Hata!";
                                                    endif;
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kredi:</th>
                                                <td><?=$user['credit']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Son Giriş:</th>
                                                <td><?=convertTime(date("Y-m-d H:i:s", ($user['lastlogin']/1000)), 2, true)?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Kayıt Tarihi:</th>
                                                <td><?=convertTime(date("Y-m-d H:i:s", ($user['regdate']/1000)), 2, true)?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Skype:</th>
                                                <td><?=$user['skype']?></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Discord:</th>
                                                <td><?=$user['discord']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php else: ?>
<section id="profile" class="min-height-500">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <?=alert('danger', 'Oyuncu bulunamadı.')?>
            
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require 'static/footer.php' ?>