<?php get_header(); 


?>

<!-- Page Specific Header Start -->


		<div class="col-md-12">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content();?>
			<?php endwhile;?>
		</div>


<?php get_footer(); ?>