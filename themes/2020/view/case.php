<?php require 'static/header.php' ?>

<?php if (isset($action[1]) && $action[1]=="liste"): ?>

	<?php if ($totalServers > 0): ?>

		<style type="text/css">
    	    .card-info {transition: all 0.3s ease;}
    	    .card-info:hover {transform: scale(1.075);}
    	</style>

		<section id="case" class="min-height-500">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="card">
		                    <div class="card-body">
		                        <div class="row">
		                        <?php if (isset($servers)): ?>
		                            <?php foreach ($servers as $key => $readServers): ?>

		                            <div class="col-lg-3 col-md-6" style="margin-top: 50px;">
		                                <a href="kasa/<?=$readServers['slug']?>">
		                                    <div class="card-info text-center">
		                                        <img src="<?=$find_read_page.$readServers['image']?>" class="img-fluid rounded" style="margin-top: -50px;">
		                                        <span class="card-heading"><?=$readServers['heading']?></span>
		                                    </div>
		                                </a>
		                            </div>

		                            <?php endforeach; ?>
		                        <?php endif; ?>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</section>

	<?php else: ?>

		<section id="case" class="min-height-500">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">

		                <?=alert('danger', 'Henüz sunucu eklenmemiş')?>
		            
		            </div>
		        </div>
		    </div>
		</section>

	<?php endif; ?>

<?php elseif (!isset($action[2])): ?>

		<section id="case" class="min-height-500">
		    <div class="container">
		        <div class="row">
		        	<div class="col-lg-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                Sunucular
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group">
                                	<?php if (isset($servers)): ?>

                                    	<?php foreach ($servers as $key => $readServers): ?>
                                    	
                                    		<a href="kasa/<?=$readServers['slug']?>" class="list-group-item list-group-item-action <?=($action[1]==$readServers['slug'])?"active disabled":""?>">
                                    			<?=$readServers['heading']?>
                                    		</a>
                                    	
                                    	<?php endforeach; ?>

                                	<?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

		            <div class="col-lg-9">

		            	<?php if (isset($totalCase) && $totalCase > 0): ?>

		                <div class="card">
		                    <div class="card-body">
		                        <div class="row">
		                            <?php foreach ($cases as $key => $readCase): ?>

		                            <div class="col-lg-3 col-md-6 mb-3">
		                                <a href="kasa/<?=$readServer['slug']?>/<?=$readCase['slug']?>">
		                                    <div class="card-info text-center">
		                                        <img src="<?=$find_read_page.$readCase['image']?>" class="img-fluid rounded">
		                                        <span class="card-heading"><?=$readCase['heading']?></span>
		                                        <?php if ($readCase['priceStatus']==1): ?>
		                                        <span class="price-actual"><?=$readCase['casePrice']?> Kredi</span>
		                                        <?php else: ?>
		                                        <span class="price-actual">Ücretsiz</span>
		                                        <?php endif; ?>
		                                    </div>
		                                </a>
		                            </div>

		                            <?php endforeach; ?>
		                        </div>
		                    </div>
		                </div>

		                <?php else: ?>

		                	<?=alert('danger', 'Henüz kasa eklenmemiş.')?>

		            	<?php endif; ?>

		            </div>

		        </div>
		    </div>
		</section>

<?php elseif (!isset($action[3])): ?>

	<section id="chest" class="min-height-500">
		<div class="container">
		    <div class="row">
		   	<?php if ($readCase['total'] > 0): ?>
		        <div class="col-lg-8 col-md-12">

		        	<div id="caseAlert"></div>

		            <div class="card mb-3">
		                <div class="card-body p-5">
		                    
		                	<div id="caseResponse" class="row d-flex-align-items-center justify-content-center">

		                		<div class="col-md-4 mb-md-0 mb-3 d-flex align-items-center justify-content-center">

		                			<div class="case-info text-center">

		                				<span class="case-heading"><?=$readCase['heading']?></span>
		                				
		                				<br>
		                				
		                				<?php if ($readCase['priceStatus']==1): ?>

		                				<span class="case-price"><?=$readCase['casePrice']?> Kredi</span>

		                				<?php else: ?>

		                				<span class="case-price">Ücretsiz<br>(<?=$readCase['caseDuration']?> saatte bir)</span>

		                				<?php endif; ?>

		                			</div>

		                		</div>

		                		<div class="col-md-4 mb-md-0 mb-3">
		                			<div class="card-info">
		                				<img src="<?=$find_read_page.$readCase['image']?>" class="img-fluid">
		                			</div>
		                		</div>

		                		<div class="col-md-4 mb-md-0 mb-3 d-flex align-items-center justify-content-center">
		                			<?php if ($_SESSION['login']): ?>

		                			<button onclick="ajaxCase('<?=$readCase['id']?>')" class="btn btn-1">Kasayı Aç</button>

		                			<?php else: ?>

		                			<a href="giris-yap" class="btn btn-1">Giriş Yap</a>

		                			<?php endif; ?>

		                		</div>

		                	</div>

		                </div>
		            </div>

		            <div class="card mb-3">
		                <div class="card-header text-center">
		                    Kasa İçeriği
		                </div>
		                <div class="card-body">
		                    
		                	<div class="row">
		                	<?php

		                		$caseContent = json_decode(base64_decode($readCase['caseContent']), true);

                                foreach ($caseContent as $key => $readCaseContent):

		                	?>
		                	<?php if ($readCaseContent['type']=="0"): ?>
		                		
		                		<div class="col-lg-3 col-md-6 mb-3">
    								<div class="card-info position-relative text-center h-100">
        								
        								<a href="javascript:;">
                                            <img src="<?=$find_read_page?>gold.png" class="img-fluid rounded">
                                        </a>
        								
                                        <hr>

        								<span class="card-heading"><?=$readCaseContent['award']?> Kredi</span>
        								
    								</div>
								</div>

							<?php elseif ($readCaseContent['type']=="1"): ?>

								<?php 

								$readProducts = $db->from('Products')->where('serverID', $readCase['serverID'])->where('id', $readCaseContent['award'])->select('count(*) as total, Products.*')->first();

								if ($readProducts['total'] > 0):
									
								?>

		                        <div class="col-lg-3 col-md-6 mb-3">
    								<div class="card-info position-relative text-center h-100">
        								
        								<a href="javascript:;">
                                            <img src="<?=$find_read_page.$readProducts['image']?>" class="img-fluid rounded">
                                        </a>
        								
                                        <hr>

        								<span class="card-heading"><?=$readProducts['heading']?></span>
        								
    								</div>
								</div>

								<?php endif; ?>

							<?php elseif ($readCaseContent['type']=="2"): ?>

								<div class="col-lg-3 col-md-6 mb-3">
    								<div class="card-info position-relative text-center h-100">
        								
        								<a href="javascript:;">
                                            <img src="<?=$find_read_page?>pas.png" class="img-fluid rounded">
                                        </a>
        								
                                        <hr>

        								<span class="card-heading">Hiçlik (Pas)</span>
        								
    								</div>
								</div>

							<?php endif; ?>

							<?php endforeach; ?>

		                    </div>

		                </div>
		            </div>

		        </div>
		        <?php if ($totalCaseHistory > 0): ?>
		        <div class="col-lg-4">
		            <div class="card sidebar mb-3">
		                <div class="card-header">
		                    Kasa Geçmişi
		                </div>
		                <div class="card-body p-0">
		                    <div class="table-responsive">
		                        <table class="table table-hover">
		                            <thead>
		                                <tr>
		                                    <th class="text-center">#</th>
		                                    <th>Kullanıcı</th>
		                                    <th class="text-center">Ödül</th>
		                                    <th class="text-center">Tarih</th>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            
		                                <?php foreach ($caseHistory as $readHistory): ?>
		                            
		                                <tr>
		                                    <td class="text-center">
		                                        <img class="rounded-circle" src="https://minotar.net/avatar/<?=$readHistory['username']?>/20.png" width="20" height="20" />
		                                    </td>
		                                    <td>
		                                        <a href="oyuncu/<?=$readHistory['username']?>"> <?=$readHistory['username']?> </a>
		                                    </td>
		                                    <td class="text-center">
		                                    	<?php if ($readHistory['type']==0): ?>
		                                        	<span> <?=$row['award']?> Kredi </span>

		                                        <?php elseif ($readHistory['type']==1): ?>

		                                        	<?php $products = $db->from('Products')->where('id', $readHistory['award'])->first(); ?>

		                                        	<span><?=$products['heading']?></span>

		                                        <?php elseif ($readHistory['type']==2): ?>
		                                        	
		                                        	<span> Hiçlik (Pas) </span>
		                                        
		                                        <?php endif; ?>
		                                    </td>
		                                    <td class="text-center">
		                                    	<?=ConvertTime($readHistory['creationDate'])?>
		                                    </td>
		                                </tr>
		                            
		                            	<?php endforeach; ?>
		                            
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        </div>

		        <?php else: ?>
		        
		        <div class="col-lg-4">
		        	
		        	<?=alert('danger', 'Kasa geçmişi bulunamadı.')?>
		        
		        </div>

		    	<?php endif; ?>

		    <?php else: ?>
		        
		        <div class="col-md-12">
		        	
		        	<?=alert('danger', 'Kasa bulunamadı.')?>
		        
		        </div>

		    <?php endif; ?>
		    </div>
		</div>
	</section>
	
<?php endif; ?>

<?php require 'static/footer.php' ?>