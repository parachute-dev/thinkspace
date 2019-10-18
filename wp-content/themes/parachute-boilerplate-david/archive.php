<?php
/*
Template Name: News
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

		<div id="content-container" class="container" >

			<section id="news" class="col-md-12">
				<?php

				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 10,
					'order' => 'DESC',
					'orderby' => 'date',
					'fancy_rows' => true,
					'latest_news' => false,
					'category' => get_queried_object()->term_id,
					'paged' => get_query_var('paged'),
					'show_pager' => true,
				
				);
		

				?>

				<?php get_custom_template('templates/news-list.php', $args); ?>
			</section>
		</div>
	</div>
</div>
<?php get_footer(); ?>