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

	<div class="content-container" id="content-page">
	<div class="page-width">
		<section id="left-column">
		<header>
			<h1>Index</h1>
			<?php woocommerce_content(); ?>
		</header>
		</section>
		<aside id="right-column">
		</aside>
		</div>
	</div>

<?php get_footer(); ?>