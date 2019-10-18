		<div class="container-fluid container-banner-carousel ">
			<div class="row">
				<div id="banner-paging-container">
					<div class="container">
						<div class="row">
							<div id="banner-paging"></div>
						</div>
					</div>

				</div>

				<div class="banner-carousel align-center vertical-center">

					<?php 


					$height = get_field('banner_vertical_height');
					$style = get_field('banner_style');
					$style = get_field('banner_style');

					if ($style == "boxed") {
						$container_style = "-fluid";
					}

					$image = $banner['banner_image'];
					$horizontal = $banner['horizontal_alignment'];
					$vertical = $banner['vertical_alignment'];
					$text = $banner['text_alignment'];

					$banners = get_field('banner_items');

					if (!$banners) {

						$banners = array();
						$banner = array();
						$banner['horizontal_alignment'] = "center";
						$banner['vertical_alignment'] = "center";
						if (is_404()) {
							$banner["banner_title"] = "404";
						}else if (is_search()){
							$banner["banner_title"] = "Search Results";
						}else if (is_tax()){
							$banner["banner_title"] = "Category Name";
						}else{
							$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
							$banner["banner_title"] = get_the_title();
							$banner["banner_image"] = $image[0];

						}
						array_push($banners,$banner);

					}

					?>
					<?php  foreach ($banners as $banner){ ?>

						<?php 

						$image = $banner['banner_image'];
						$horizontal = $banner['horizontal_alignment'];
						$vertical = $banner['vertical_alignment'];
						$text = $banner['text_alignment'];

						?>


						<div class="slide style-<?php echo $style?> position-vertical-<?php echo $vertical; ?> position-horizontal-<?php echo $horizontal; ?> text-<?php echo $text; ?>">
							<div class="background-image" style="background-image:url(<?php echo $image['url']; ?>)">
							</div>
							<div class="overhang"></div>

							<div class="container">
								<div class="row">
									<div class="col-md-12">
										<div class="banner-content height-<?php echo $height; ?>">
											<?php if ($banner['banner_subtitle'] != ""){ ?>
												<h2><?php echo $banner['banner_subtitle']; ?></h2>
											<?php }?>
											<?php if ($banner['banner_title'] != ""){ ?>
												<h1><?php echo $banner['banner_title']; ?></h1>
											<?php }?>
											<?php echo $banner['banner_content']?>

											<?php if ($banner['banner_internal_link'] || $banner['banner_link']) { ?>
												<?php if ($banner['banner_link'] != null && $banner['banner_link'] != "" ) { 
													$link = $banner['banner_link'];
												}else {
													$link_obj = $banner['banner_internal_link'];
													$link = get_permalink($link_obj->ID);
												} 
												?>
												<a href="<?php echo $link; ?>" class="button white-button">
													<?php echo $banner['banner_cta_text']; ?>
												</a>
											<?php } ?>

										</div>

									</div>

								</div>
							</div>


						</div>

					<?php }?>
				</div>
			</div>
		</div>