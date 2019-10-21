		<!-- Book online banner -->
		<div class="container-fluid book-online" >
			<div class="row">
				<div class="container ">
					<div class="row is-flex">
						<div class="col-sm-3 col-lg-2 col-xs-6">
							<h3>BOOK ONLINE: 
								
								</h3><h5 class="hidden-xs xs-hidden">Choose an adventure</h5>
						</div>
						<div class="col-lg-4 col-sm-3 product-selection eq-height hidden-xs xs-hidden">
										<small>Type</small>
							<div class="select-container" id="product-trigger">

								<p id="selection-1">Select</p>

								<ul id="product-selection">
									<?php
									$taxonomy     = 'booking_link_category';
									$orderby      = 'slug';

									$args = array(
										'taxonomy'     => $taxonomy,
										'orderby'      => $orderby,
										'hierarchical' => $hierarchical
									);
									$all_categories = get_terms( $args ); ?>
							

									<?php foreach ($all_categories as $cat) { ?>
										<li data-target="<?php echo $cat->slug; ?>"><?php echo $cat->name; ?></li>
									<?php } wp_reset_query(); ?>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-sm-3 activity-selection-container eq-height hidden-xs xs-hidden">
								<small>Activity</small>
							<div class="select-container" id="activity-trigger">
								<p id="selection-2">Select</p>

								<?php foreach ($all_categories as $cat) { ?>
									<ul class="activity-selection" id="<?php echo $cat->slug; ?>">
										<?php  $args = array( 'post_type' => 'booking_links', 'posts_per_page' => -1, 'booking_link_category' => $cat->slug );
										$productLoop = new WP_Query($args);
										?>
										<?php while($productLoop->have_posts()): $productLoop->the_post(); ?>
											<li data-activity="<?php echo get_field('Link',$productLoop->ID); ?>" data-title="<?php the_title(); ?>"><?php the_title(); ?></li>
										<?php endwhile; wp_reset_query(); ?>
									</ul>
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-2 col-sm-3 next-step col-xs-6">
							<a id="home-product-link " class="button white-button booking-link" href="https://book.snowfactor.com">Book <span></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>