		<!-- 2 block content -->
		
			<?php 

			$image_position = get_field('image_position'); 
			$container_type =  get_field('container_type'); 
			$image = get_field('background_image'); 

			if ($container_type == "fixed"){
				$container = "container container-fixed";
			}else{
				$container ="container";
			}

			?>
			<div class="container-fluid two-block-container-container">
			<div class="row split-row eq-height two-block-container align-<?php echo $image_position; ?>">
				<div class="<?php echo $container; ?>">
					<div class="row">
				
						<div class="col-sm-6 col-xs-12 image-container ">
							<div class="background-image <?php the_field('two_block_image_position');?>-overlay" style="background-image:url(<?php echo $image['url']; ?>);background-repeat:no-repeat;background-size:cover;">
							</div>
						</div>
						<div class="col-sm-6 col-xs-12  user-content">

							<div class="two-block-content-wrapper">
								<?php if (get_field('sub_heading')) { ?>
								<h5><?php the_field('sub_heading'); ?></h5>
								<?php } ?>
								<h2><?php the_field('heading');?></h2>
								<?php the_field('content');?>
								<?php if (get_field('button_link')){ ?>
									<a class="pink-button button" href="<?php the_field('button_link') ?>" class="button button-border"><?php the_field('button_text') ?></a>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>