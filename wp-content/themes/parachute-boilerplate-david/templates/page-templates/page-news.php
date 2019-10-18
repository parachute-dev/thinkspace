<?php
/*
Theme Name: Parachute Boilerplate
Theme URI: http://www.thisisparachute.com
Description: 
Version: 1
Author: Parachute Digital Ltd.
Author URI: http://www.thisisparachute.com
Template Name: News
*/
get_header(); ?>

<!-- Page Specific Header Start -->

<!-- Page Specific Header End  -->

<?php include (get_stylesheet_directory() . '/components/helper/toolbar.php'); ?>
<div id="page-body">
	<div id="page-body-inner">
		<?php if(have_posts()): ?>
			<?php while(have_posts()): the_post(); ?>
				<?php
					echo get_all_flexible_content_blocks();
				?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</div>
<?php get_footer(); ?>