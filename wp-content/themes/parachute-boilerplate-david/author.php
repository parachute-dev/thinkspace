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

<?php get_template_part('toolbar'); ?>


	<div class="content-container" id="content-author">
	<div class="container">
		<section id="left-column">
		<header>
			<h1>Author</h1>
			<article class="user-content">
				<?php while ( have_posts() ) : the_post(); ?>
					<h2><?php the_title();?></h2>
					<?php the_content();?>
				<?php endwhile; ?>
			</article>
		</header>
		</section>
		<aside id="right-column">
		</aside>
		</div> 
	</div>


<?php get_footer(); ?>