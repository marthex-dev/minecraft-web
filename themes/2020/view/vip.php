<?php require 'static/header.php' ?>

<?php if ($readSettings['vipGlobal'] == "1"): ?>

	<?php if (!isset($action[1])): ?>

		<?php if ($totalServers > 0): ?>

		<style type="text/css">
		    .card-info {transition: all 0.3s ease;}
		    .card-info:hover {transform: scale(1.075);}
		</style>

		<section id="VipServer" class="min-height-500">
		    <div class="container">
		        <div class="row">
		            <div class="col-lg-12">
		                <div class="card">
		                    <div class="card-body">
		                        <div class="row">
		                        <?php if (isset($servers)): ?>
		                            <?php foreach ($servers as $key => $readServers): ?>

		                            <div class="col-lg-3 col-md-6 mb-3" style="margin-top: 50px;">
		                                <a href="vip/<?=$readServers['slug']?>">
		                                    <div class="card-info text-center h-100 d-flex align-items-end justify-content-center">
		                                        <div>
		                                            <img src="<?=$find_read_page.$readServers['image']?>" class="img-fluid rounded" style="margin-top: -50px;">
		                                            <span class="card-heading"><?=$readServers['heading']?></span>
		                                        </div>
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

		<section id="VipServer" class="min-height-500">
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

	<style type="text/css">

		.ranks-list {height: 200px;background: var(--tertiary);font-size: 25px;display: flex;align-items: center;justify-content: center;text-align: center;}
		.ranks-col:first-child, .features-col:first-child {padding-left: 1rem !important;}
		.ranks-col:last-child, .features-col:last-child {padding-right: 1rem !important;}
		.ranks-col:first-child .ranks-list {border-top-left-radius: 6px;}
		.ranks-col:last-child .ranks-list {border-top-right-radius: 6px;}
		.features-col:last-child {font-weight: bold;}
		.ranks-col .ranks-name {display: block;font-size: 22px;position: relative;bottom: -5px;color: #fff;}
		.ranks-col .ranks-duration {color: #fcff02;font-size: 16px;position: relative;top: -5px;}
		.features-name {display: flex;align-items: center;justify-content: center;text-align: center;height: 50px;color: var(--secondary);}
		.features-col:first-child .features-name {text-align: right;justify-content: flex-end;padding-right: 15px;}
		.ranks-features .features-col {font-size: 15px;}
		.ranks-features .features-col .features-name {background: var(--tertiary);}
		.ranks-features .features-col .features-name .price {font-weight: bold;font-size: 15px;}
		.ranks-features .features-col .features-name .price-discount {font-size: 13px;}
		.ranks-features .features-col .features-name .btn {border-radius: 0;width: 100%;height: 100%;display: flex;align-items: center;justify-content: center;transition: all 0.3s ease;font-weight: bold;z-index: 2;border: 0;}
		.ranks-features .features-col .features-name .btn:hover {transform: scale(1.05);z-index: 3;color: #fff;}
		.ranks-features .features-col .features-name .btn.btn-disabled:hover {transform: scale(1) !important;}
		.ranks-features .features-col .features-name .mdi-check {color: var(--success);font-size: 24px;}
		.ranks-features .features-col .features-name .mdi-close {color: var(--primary);font-size: 24px;}
		.ranks-features:nth-child(1n+0) .features-col:nth-child(1n+0) .features-name {background: var(--tertiary);}
		.ranks-features:nth-child(2n+0) .features-col:nth-child(1n+0) .features-name {background: rgba(0,0,0,.075);}
		.ranks-features:nth-child(1n+0) .features-col:nth-child(2n+0) .features-name {background: rgba(0,0,0,.075);}
		.ranks-features:nth-child(2n+0) .features-col:nth-child(2n+0) .features-name {background: var(--tertiary);}

	</style>

	<?php

		$ranksColumn = "col";

	?>

	<?php if ($totalVips > 0): ?>

	<section id="ranks" class="min-height-500">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="buyResponse"></div>
				</div>
				<div class="col-md-12 d-none d-md-block">

					<div class="row">

						

						<div class="ranks-col ranks-disabled <?=$ranksColumn?> px-md-0">
							<div class="ranks-list">
								Özellikler
							</div>
						</div>

							<?php foreach ($vips as $key => $readVip): ?>
						
								<div class="ranks-col <?=$ranksColumn?> px-md-0">
									<a href="javascript:;">
										<div class="ranks-list" style="background: <?=$readVip['color']?>;">
											<div class="ranks-info">
												<span class="ranks-name"><?=$readVip['heading']?></span>
												<?php if ($readVip['duration']==1): ?>
												<span class="ranks-duration"><?=$readVip['durationDay']?> Gün</span>
												<?php else: ?>
												<span class="ranks-duration">Sınırsız</span>
												<?php endif; ?>
											</div>
										</div>
									</a>
								</div>

							<?php endforeach; ?>

					</div>

					<?php if ($totalVips > 0): ?>

						<?php if ($totalFeatures > 0): ?>

							<?php foreach ($features as $key2 => $readFeatures): ?>

								<div class="row ranks-features">

									<div class="<?=$ranksColumn?> features-col px-md-0">
										<span class="features-name">
											<?=$readFeatures['heading']?> : 
										</span>
									</div>

									<?php foreach ($vips as $key => $readVips): ?>

									<?php

										$featuresValue = json_decode(base64_decode($readVips['content']), true);

									?>

									<div class="<?=$ranksColumn?> features-col px-md-0">
										<span class="features-name">
											<?=$featuresValue[$readFeatures['slug']]?>
										</span>
									</div>

									<?php endforeach; ?>

								</div>

							<?php endforeach; ?>

						<?php endif; ?>

					<?php endif; ?>

					<div class="row ranks-features">

						<div class="<?=$ranksColumn?> features-col px-md-0">
							<span class="features-name">
								Fiyat : 
							</span>
						</div>

						<?php foreach ($vips as $key => $readVips): ?>

						<div class="<?=$ranksColumn?> features-col px-md-0">
							<span class="features-name">
								<?php if ($readVips['discount']==1 && $readVips['discountDuration']==0 OR $readVips['discount']==1 && $readVips['discountDuration']==1 && $readVips['discountExpiry'] > date('Y-m-d')): ?>
								<span class="price price-discount"><?=$readVips['price']?> Kredi</span>
								&nbsp;
								<span class="price price-actual"><?=$readVips['discountPrice']?> Kredi</span>
								<?php else: ?>
								<span class="price price-actual"><?=$readVips['price']?> Kredi</span>
								<?php endif; ?>
							</span>
						</div>

						<?php endforeach; ?>

					</div>

					<div class="row ranks-features">

						<div class="<?=$ranksColumn?> features-col px-md-0">
							<span class="features-name">
								
							</span>
						</div>

						<?php foreach ($vips as $key => $readVips): ?>

							<?php if ($readVips['stockStatus']==1 && $readVips['stock']==0): ?>

								<div class="<?=$ranksColumn?> features-col px-md-0">
									<span class="features-name">
										<a href="javascript:;" class="btn btn-danger btn-disabled">Stokta Yok!</a>
									</span>
								</div>

							<?php else: ?>
								
								<div class="<?=$ranksColumn?> features-col px-md-0">
									<span class="features-name">
										<?php if (isset($_SESSION['login'])): ?>
										<a onclick="ajaxVIP('<?=$readVips['id']?>')" class="btn btn-success" style="background: <?=$readVips['color']?>;">Satın Al</a>
										<?php else: ?>
										<a href="giris-yap" class="btn btn-success" style="background: <?=$readVips['color']?>;">Satın Al</a>
										<?php endif; ?>
									</span>
								</div>

							<?php endif; ?>

						<?php endforeach; ?>

					</div>

				</div>

				<div class="col-md-12 d-block d-md-none">

					<div class="row">

						<?php foreach ($vips as $key => $readVip): ?>
						
							<div class="col-12">

								<div class="row">

									<div class="col-12 ranks-col px-md-0" style="padding-left: 15px !important;">
										<a href="javascript:;">
											<div class="ranks-list" style="background: <?=$readVip['color']?>;border-top-right-radius: 6px;border-top-left-radius: 6px;">
												<div class="ranks-info">
													<span class="ranks-name"><?=$readVip['heading']?></span>
													<?php if ($readVip['duration']==1): ?>
													<span class="ranks-duration"><?=$readVip['durationDay']?> Gün</span>
													<?php else: ?>
													<span class="ranks-duration">Sınırsız</span>
													<?php endif; ?>
												</div>
											</div>
										</a>
									</div>

									<div class="col-12 ranks-features">

										<div class="row">
									
											<?php if ($totalFeatures > 0): ?>

												<?php foreach ($features as $key2 => $readFeatures): ?>

													<div class="col-6 features-col px-md-0" style="padding-right: 0px !important;">
														<span class="features-name justify-content-end" style="padding-right: 15px;">
															<?=$readFeatures['heading']?> : 
														</span>
													</div>

													<?php

														$featuresValue = json_decode(base64_decode($readVip['content']), true);

													?>

													<div class="col-6 features-col px-md-0" style="padding-left: 0px !important;">
														<span class="features-name">
															<?=$featuresValue[$readFeatures['slug']]?>
														</span>
													</div>

												<?php endforeach; ?>

											<?php endif; ?>

											<div class="col-6 features-col px-md-0" style="padding-right: 0px !important;">
												<span class="features-name justify-content-end" style="padding-right: 15px;">
													Fiyat : 
												</span>
											</div>

											<div class="col-6 features-col px-md-0" style="padding-left: 0px !important;">
												<span class="features-name">
													<?php if ($readVip['discount']==1 && $readVip['discountDuration']==0 OR $readVip['discount']==1 && $readVip['discountDuration']==1 && $readVip['discountExpiry'] > date('Y-m-d')): ?>
													<span class="price price-discount"><?=$readVip['price']?> Kredi</span>
													&nbsp;
													<span class="price price-actual"><?=$readVip['discountPrice']?> Kredi</span>
													<?php else: ?>
													<span class="price price-actual"><?=$readVip['price']?> Kredi</span>
													<?php endif; ?>
												</span>
											</div>

										</div>

									</div>

									<div class="col-12 ranks-features mb-3">
									
										<?php if ($readVip['stockStatus']==1 && $readVip['stock']==0): ?>

											<div class="features-col" style="padding-right: 0 !important;padding-left: 0 !important;<?=($key==0)?"margin-left: 1px;":""?>">
												<span class="features-name pr-0">
													<a style="border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;" href="javascript:;" class="btn btn-danger btn-disabled">Stokta Yok!</a>
												</span>
											</div>

										<?php else: ?>
											
											<div class="features-col" style="padding-right: 0 !important;padding-left: 0 !important;">
												<span class="features-name pr-0">
													<?php if (isset($_SESSION['login'])): ?>
													<a onclick="ajaxVIP('<?=$readVip['id']?>')" class="btn btn-success" style="background: <?=$readVip['color']?>;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;">Satın Al</a>
													<?php else: ?>
													<a href="giris-yap" class="btn btn-success" style="background: <?=$readVip['color']?>;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;">Satın Al</a>
													<?php endif; ?>
												</span>
											</div>

										<?php endif; ?>

									</div>

								</div>

							</div>

						<?php endforeach; ?>

					</div>

				</div>

				<?php if ($totalVips > 5): ?>
				<div class="col-12 mb-md-0 mt-3">
		            <div class="card-body pagination-card d-flex align-items-center justify-content-between">
		                <?php if ($prevPage == 0): ?>
		                    <a href="javascript:;" class="btn btn-2 disabled">« Önceki</a>
		                <?php else: ?>
		                    <a href="<?=$action['0']?>/<?=$action['1']?>?limit=<?=$prevPage?>" class="btn btn-2">« Önceki</a>
		                <?php endif; ?>
		                
		                <?php if ($totalPage == $_GET[$pageParam]): ?>
		                    <a href="javascript:;" class="btn btn-2 disabled">Sonraki »</a>
		                <?php else: ?>
		                    <a href="<?=$action['0']?>/<?=$action['1']?>?limit=<?=$nextPage?>" class="btn btn-2">Sonraki »</a>
		                <?php endif; ?>
		            </div>
		        </div>
		    	<?php endif; ?>
			</div>
		</div>
	</section>

	<?php else: ?>

	<section id="VipServer" class="min-height-500">
		<div class="container">
		    <div class="row">
		        <div class="col-lg-12">

		            <?=alert('danger', 'Henüz VIP eklenmemiş')?>
		        
		        </div>
		    </div>
		</div>
	</section>

	<?php endif; ?>

	<?php endif; ?>

<?php endif; // Global ?>

<?php require 'static/footer.php' ?>