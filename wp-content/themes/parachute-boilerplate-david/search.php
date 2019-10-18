<?php
/*
Theme Name: Blank
Theme URI: http://www.wearedecoded.com
Description: 
Version: 1
Author: We Are Decoded
Author URI: http://www.wearedecoded.com
*/
get_header(); ?>

<!-- Page Specific Header Start -->

<!-- Page Specific Header End  -->

<?php include (get_stylesheet_directory() . '/toolbar.php'); ?>

<div id="page-body">
	<div id="page-body-inner">
		<?php get_custom_template('templates/masthead.php'); ?>
		<?php get_custom_template('templates/breadcrumbs.php'); ?>

		<?php if(have_posts()): ?>
			<div class="content-container container">
				<div class="content-container-inner-row row">
					<div class="content-archive-filters search-archive-filters col-xs-12 col-sm-10 col-md-10 col-sm-push-1 col-md-push-1">
						<div class="content-archive-filters-inner">
							<div class="content-archive-filters-inner-content">
								<form id="search-form" class="search-form" action="/" method="get">
									<h3 class="search-form-title sr-only">Search Results for: &quot;<?php echo get_search_query(); ?>&quot;</h3>

									<label for="search_input">
									  <span class="text sr-only">Search:</span>
									  <input id="search_input" type="search" name="s" placeholder="Enter show, artist, venue or keywords here..." value="<?php echo get_search_query(); ?>">

									  <button id="search_form_submit" class="submit-button button" type="submit" title="Click/tap to find what you're looking for">
									    <span class="text sr-only">Search</span>

									    <span class="icon-container">
									        <svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve">
									            <use xlink:href="#search"></use>
									        </svg>  
									    </span>
									  </button>
									</label>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="content-container" class="content-container container">
				<div id="content-container-inner-row" class="content-container-inner-row row">
					<div class="content col-xs-12 col-sm-10 col-md-10 col-sm-push-1 col-md-push-1">
						<?php
							$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

							$wp_query->query_vars['posts_per_page'] = 20;
							$wp_query->query_vars['$paged'] = $paged;

							$my_query = new WP_Query($wp_query->query_vars);
						?>

						<?php if($my_query->have_posts()): ?>
							<dl class="search-results content-listings row">
								<?php while($my_query->have_posts()): $my_query->the_post(); ?>
									<?php
										$preview_content = !empty(get_field('preview_content', $post->ID)) ? get_field('preview_content', $post->ID) : get_the_excerpt();
									?>

									<dd class="content-item search-result col-xs-12 col-sm-12 col-md-12">
										<div href="<?php echo get_permalink(); ?>" class="content-item-inner" title="<?php echo get_the_title(); ?>">
											<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="content-item-full-block-link"><span class="sr-only"><?php echo get_the_title(); ?></span></a>

											<div class="content-item-inner-content">
												<header class="content-item-header">
													<h4 class="content-item-title">
														<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
															<?php echo get_the_title(); ?>
														</a>
													</h4>
												</header>

												<div class="content-item-content">
													<?php echo $preview_content; ?>
												</div>
											</div>

											<div class="content-item-footer">
												<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"><?php echo get_permalink(); ?></a>
											</div>
										</div>
									</dd>
								<?php endwhile; ?>
							</dl>

							<div class="pagination">
								<?php
								/* Pagination */
								$big = 999999999;
								$paginate_args = array(
									'base'               => '%_%',
									'format'             => '?&paged=%#%',
									'total'              => $my_query->max_num_pages,
									'current'            => max( 1, get_query_var('paged') ),
									'show_all'           => false,
									'end_size'           => 1,
									'mid_size'           => 2,
									'prev_next'          => true,
									'prev_text'          => __('Prev'),
									'next_text'          => __('Next'),
									'type'               => 'list',
									'add_args'           => false,
									'add_fragment'       => '',
									'before_page_number' => '',
									'after_page_number'  => ''
								);

								echo paginate_links($paginate_args);
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div id="content-container" class="content-container container">
				<div id="content-container-inner-row" class="content-container-inner-row row">
					<div id="content" class="content col-xs-12 col-sm-10 col-md-10 col-sm-push-1 col-md-push-1">
						<article class="content-inner">
							<div class="content">
								<h3>No results found matching: &quot;<?php echo get_search_query(); ?>&quot;</h3>
							</div>
						</article>
					</div>
				</div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>