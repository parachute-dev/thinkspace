		<!-- OFFER BANNER -->
		<div class="container-fluid offers-container">
			<div class="container">
				
					<!-- BANNER OFFER -->
					<div class="offer-banner">
						<?php $image = get_field('background_image'); ?>
						<div class="offer-banner-background" style="background-image:url('<?php echo $image['url']; ?>');">

						</div>
						<div class="offer-banner-content row">
							<div class="col-md-6">
								<h3><?php the_field('heading');?></h3>
								<?php the_field('content');?>
								<?php if(get_field('button_text')){?>
									<a id="home-product-link " class="button white-button booking-link" href=""><?php the_field('button_text');?></a>
								<?php }?>
							</div>
						</div>
					</div>
			
			</div>
		</div>