<?php
	global $post;
	/* 
	 * Figure out something better here for production? This pulls back to many pages getting siblings top-level 
	 * but a lot of top-level pages right now have no children as nothing is properly ordered
	 */

	$post_type = get_post_type();
	$name = "Menu";

	$post_from = 0;
	// $args = array(
	// 	'post_type'=> $post_type,
	// 	'title_li'=> '',
	// 	'link_after' => '</span>' ,
	// 	'link_before' => '<span>',
	// );

	// $nav_pages = get_pages($args);
	$sidebar_title = !empty(get_field('sidebar_title', $post->ID)) ? get_field('sidebar_title', $post->ID) : get_the_title();

	// Old way that just gets siblings of the current post and also the children if it's the selected item, taken out at RCS request 18/06/28
	// $child_of = wp_get_post_parent_id( $post->ID ); 

	// Get all our post's ancestors, last item in the array is the highest-level (top) ancestor
	$post_ancestors = get_post_ancestors( $post );
	$child_of = 0;

	// If we've got ancestors then nab the top-most one and get its children
	if(!empty($post_ancestors)){
		$child_of = end($post_ancestors);
		$ancestor_top_obj = get_post($child_of);
		if(!empty( $ancestor_top_obj )) $sidebar_title = $ancestor_top_obj->post_title;
	}
	else{
		$child_of = wp_get_post_parent_id( $post->ID );
	}

	if ($post->ID == 2925 || $child_of == 2925) {

		$child_of = 2925;
	}

	/* Custom sidebar navigation structure */
	$sidebar_pages = null;

	// The child items of the current post in case we want to prepend it to the sidebar array
	$sidebar_nav_items = get_field('sidebar_nav_items', $post->ID);
	$sidebar_nav_start_node = get_field('sidebar_nav_start_node', $post->ID);

	if( !empty($sidebar_nav_items) && is_array($sidebar_nav_items) ){
		$args = array(
			'include' => $sidebar_nav_items,
			'post_status' => 'publish'
		);

		$sidebar_pages = get_posts($args);

		if(empty($sidebar_pages)) $sidebar_pages = array();
		array_unshift($sidebar_pages, $post); // For now just prepend the posts array with the current object
	}
	else if( !empty($sidebar_nav_start_node) && is_int($sidebar_nav_start_node) ){
		$args = array(
			'post_parent' => $sidebar_nav_start_node,
			'post_status' => 'publish',
			'order' => 'ASC',
			'orderby' => 'menu_order'
		);

		$sidebar_pages = get_children($args);

		if(empty($sidebar_pages)) $sidebar_pages = array();
		array_unshift($sidebar_pages, $post); // For now just prepend the posts array with the current object
	}
	else{
		$args = array(
			'post_type' => $post_type,
			'parent' => 0,
			'post_status' => 'publish',
			'order' => 'ASC',
			'orderby' => 'menu_order'
		);

		// Exclude our post ancestors so we can add our top-most ancestor to the posts array in order to show the full nav tree for this post
		if(!empty($post_ancestors)) $args['exclude'] = $post_ancestors;
	
		$sidebar_pages = get_pages( $args );
		if(!empty($sidebar_pages) && !empty($ancestor_top_obj)) $sidebar_pages[] = $ancestor_top_obj;
	}
?>

<nav class="sub-content-nav">
	<?php if( !empty($sidebar_pages) && $post_type != 'box_office' ): ?>
		<dl class="sidebar-content-tabs-control-list sub-content-nav-list level-1 dropdown-menu">
			<dt class="sub-content-nav-list-title dropdown-title">
				<button class="button dropdown-menu-control" title="Click/tap to toggle menu">
					<span class="text"><?php echo $sidebar_title; ?></span>

					<span class="icon-container">
						<svg class="dropdown-minus-static icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 4.568" xml:space="preserve">
							<use xlink:href="#minus"></use>
						</svg>

						<svg class="dropdown-minus-animated icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 4.568" xml:space="preserve">
							<use xlink:href="#minus"></use>
						</svg>
					</span>
				</button>
			</dt>

			<?php foreach($sidebar_pages as $p): ?>
				<?php 
					$current = $post->ID == $p->ID ? ' current_page_item' : '';
					$active_tree = in_array($p->ID, $post_ancestors) ? ' active-tree' : '';
				?>
				<dd id="sidebar-content-nav-<?php echo $p->post_name; ?>" class="sub-content-nav-item dropdown-item<?php echo $current . $active_tree; ?>">
					<a href="<?php echo get_permalink( $p->ID ); ?>" title="<?php echo $p->post_title ?>">
						<?php echo $p->post_title; ?>
					</a>

					<?php if( $post->ID == $p->ID || in_array($p->ID, $post_ancestors) ): ?>
						<?php
							$child_args = array(
								'post_type' => $p->post_type,
								'parent' => $p->ID,
								'post_status' => 'publish'
							);

							$child_pages = get_pages( $child_args );
						?>

						<?php if(!empty($child_pages)): ?>
							<dl class="sidebar-content-tabs-control-list sub-content-nav-list level-2">
								<?php foreach($child_pages as $p1): ?>
									<?php $current = $post->ID == $p1->ID ? ' current_page_item' : ''; ?>
									<dd id="sidebar-content-nav-item-<?php echo $p1->post_name; ?>" class="sub-content-nav-item<?php echo $current; ?>">
										<a href="<?php echo get_permalink( $p1->ID ); ?>" title="<?php echo $p1->post_title ?>">
											<?php echo $p1->post_title; ?>
										</a>

										<?php if($post->ID == $p->ID || in_array($p1->ID, $post_ancestors) ): ?>
											<?php
												$grandchildren_args = array(
													'post_type' => $p1->post_type,
													'parent' => $p1->ID,
													'post_status' => 'publish'
												);

												$grandchildren_pages = get_pages( $grandchildren_args );
											?>

											<?php if(!empty($grandchildren_pages)): ?>
												<dl class="sidebar-content-tabs-control-list sub-content-nav-list level-3">
													<?php foreach($grandchildren_pages as $p2): ?>
														<?php $current = $post->ID == $p2->ID ? ' current_page_item' : ''; ?>
														<dd id="sidebar-content-nav-item-<?php echo $p2->post_name; ?>" class="sub-content-nav-item<?php echo $current; ?>">
															<a href="<?php echo get_permalink( $p2->ID ); ?>" title="<?php echo $p2->post_title ?>">
																<?php echo $p2->post_title; ?>
															</a>
														</dd>
													<?php endforeach; ?>
												</dl>
											<?php endif; ?>
										<?php endif; ?>
									</dd>
								<?php endforeach; ?>
							</dl>
						<?php endif; ?>
					<?php endif; ?>
				</dd>
			<?php endforeach; ?>
		</dl>
	<?php else: ?>
		<ul class="sub-content-nav-list level-1">
			<header class="sub-content-nav-list-title w-arrow">
				<a href="#!" class="menu-breadcrumb">
					<?php echo $name; ?>
				</a>
				<?php 

				$child_of = wp_get_post_parent_id( $post->ID ); 

				if ($post->ID == 2925 || $child_of == 2925) {

					$child_of = 2925;
				}

				if (get_depth() > 0 ) {
					?>

					<span class="divider">/</span>
					<a class="menu-breadcrumb" href="<?php the_permalink(wp_get_post_parent_id( $post_ID )); ?>"><?php echo get_the_title(wp_get_post_parent_id( $post_ID )); ?></a>
					<?php
				}

				?>
			</header>
			
			<?php if ($post_type != "box_office" && $post->ID != 21330) { ?>
				<?php
				$args = array(
				'post_type'=> $post_type,
				'title_li'=> '',
				'link_after' => '</span>' ,
				'link_before' => '<span>',
				'child_of' => $child_of
				);
				wp_list_pages( $args );
			}else {  

				wp_nav_menu( array(
					'menu' => 'box-office',
					'title_li'=> '',
					'link_after' => '</span>' ,
					'link_before' => '<span>'					
				));
			}
			?>
		</ul>
	<?php endif; ?>
</nav>