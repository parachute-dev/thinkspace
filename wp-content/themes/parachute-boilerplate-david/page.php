<?php

get_header(); ?>

<!-- Page Specific Header Start -->

<!-- Page Specific Header End  -->

<?php include (get_stylesheet_directory() . '/toolbar.php'); ?>
 
<div id="page-body"> 
	<div id="page-body-inner">
	 <?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	 <?php endwhile; ?>
	 <span class="button modal-trigger" data-modal="thanks">thanks!</span>
	</div>
</div>
<?php get_footer(); ?>