<?php $backgroundColour = get_field ('background_colour');?>
<div class="container-fluid background-<?php echo $backgroundColour; ?>">
	<div class="row">
		<div class="content-listings-carousel">
			<div class="content-listings-carousel-inner">

				<?php 
				$height = get_field('height'); 
				$carousel_class = "";
				$columns = get_field('columns');

				switch ($columns){
					case "col-md-12":
					$bootstrap = "col-xs-12";
					break;
					case "col-md-6":
					$bootstrap = "col-xs-12 col-md-6";

					break;
					case "col-md-4":
					$bootstrap = "col-xs-12 col-md-4";

					break;
					case "col-md-3":
					$bootstrap = "col-xs-6 col-md-3";
					break;
					default:
					$bootstrap = "col-xs-12 col-md-4";
					break;
				}

				if (get_field('carousel')) {
					$carousel_class = "content-carousel";
					$bootstrap = "";
				} 
				?>
				<?php if (get_field('heading')) { ?>
					<div class="container">
						<div class="row">
							<div class="content-listings-carousel-header">
								<div class="content-listings-carousel-title">
									<h2><?php the_field('heading'); ?></h2>
									<?php if (get_field('sub_link_text')) { ?>
										<h5>
											<a href="<?php the_field('page_link');?>"><?php the_field('sub_link_text');?></a>
										</h5>
									<?php }?>
								</div>
								<?php if (get_field('carousel')) { ?>
									<div class="content-listings-carousel-scroller">
										<div class="left">
											<a href="#!">
												<i class="fa fa-arrow-left"></i>
											</a>
										</div>
										<div class="right">
											<a href="#!">
												<i class="fa fa-arrow-right"></i>
											</a>
										</div>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } ?>
				<!-- LATEST OFFER BODY -->
				<div class="container">
					<div class="row">
						<div class=" content-listings-carousel-content">

							<div class=" latest-offer <?php echo $carousel_class; ?>">

								<?php 
								if (get_field('related_content')) {
									$content = get_field('related_content');
								}else if (get_field('existing_content')) { 
									$content = array();
									$posts = get_field('existing_content');
									if( $posts ): 
										foreach( $posts as $post): 
											$item = array();
											$item["background_image"] = get_field('preview_image',$post->ID);
											$item["button_text"] = get_field('preview_text',$post->ID);
											if (get_field('preview_text',$post->ID)) {
												$item["button_text"] = get_field('preview_text',$post->ID);

											}else{
												$item["button_text"] = get_the_title($post->ID);		
											}
											$item["button_link"] = get_permalink($post->ID);

											array_push($content, $item);

										endforeach; 

										wp_reset_postdata(); 
									endif; 
									wp_reset_query();
									wp_reset_postdata(); 	
								}
							
								foreach ($content as $item){ ?>
									<div class="<?php echo $bootstrap; ?>">
										<?php $image = $item['background_image']; ?>

										<div class="offer-single-block  height-<?php echo $height; ?>">
											<div class="offer-single-block-background-image" style="background-image:url('<?php echo $image['url'];?>');">
											</div>
											<div class="offer-single-block-content">
												<h3><?php echo $item['heading'];?></h3>
												<?php echo $item['content'];?>
											</div>
											<?php if($item['button_text'] != "" && $item['button_text'] != null){?>
												<div class="offer-single-block-footer-link">
													<a href="<?php echo $item['button_link'];?>">
														<h3><?php echo $item['button_text'];?></h3>
														<i class="fa fa-plus"></i>
													</a>
												</div>

											<?php } ?>
										</div>
									</div>
								<?php }	?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>