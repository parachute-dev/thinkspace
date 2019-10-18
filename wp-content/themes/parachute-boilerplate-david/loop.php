<?php


?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<?php next_posts_link( __( '&larr; Older posts', 'parachute' ) ); ?>
		<?php previous_posts_link( __( 'Newer posts &rarr;', 'parachute' ) ); ?>
<?php endif; ?>

<?php if ( ! have_posts() ) : ?>
		<h1><?php _e( 'Not Found', 'parachute' ); ?></h1>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'parachute' ); ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>

<?php

	  ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', 'parachute') ) ) : ?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'parachute' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			

<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>
<?php
	$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
	$total_images = count( $images );
	$image = array_shift( $images );
	$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
?>
					<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>

				<p><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'parachute' ),
						'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'parachute' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
						$total_images
					); ?></p>

				<?php the_excerpt(); ?>
<?php endif; ?>

				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'parachute'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'parachute' ); ?>"><?php _e( 'More Galleries', 'parachute' ); ?></a>
				|
				<?php comments_popup_link( __( 'Leave a comment', 'parachute' ), __( '1 Comment', 'parachute' ), __( '% Comments', 'parachute' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'parachute' ), '|', '' ); ?>

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( in_category( _x('asides', 'asides category slug', 'parachute') ) ) : ?>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<?php the_excerpt(); ?>
		<?php else : ?>
			<?php the_content( __( 'Continue reading &rarr;', 'parachute' ) ); ?>
		<?php endif; ?>

				
				|
				<?php comments_popup_link( __( 'Leave a comment', 'parachute' ), __( '1 Comment', 'parachute' ), __( '% Comments', 'parachute' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'parachute' ), '| ', '' ); ?>

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'parachute' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<?php the_excerpt(); ?>
	<?php else : ?>
			<?php the_content( __( 'Continue reading &rarr;', 'parachute' ) ); ?>
			<?php wp_link_pages( array( 'before' => '' . __( 'Pages:', 'parachute' ), 'after' => '' ) ); ?>
	<?php endif; ?>

				<?php if ( count( get_the_category() ) ) : ?>
					<?php printf( __( 'Posted in %2$s', 'parachute' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					|
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<?php printf( __( 'Tagged %2$s', 'parachute' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					|
				<?php endif; ?>
				<?php comments_popup_link( __( 'Leave a comment', 'parachute' ), __( '1 Comment', 'parachute' ), __( '% Comments', 'parachute' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'parachute' ), '| ', '' ); ?>

		<?php comments_template( '', true ); ?>

	<?php endif;  ?>

<?php endwhile;  ?>


<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<?php next_posts_link( __( '&larr; Older posts', 'parachute' ) ); ?>
				<?php previous_posts_link( __( 'Newer posts &rarr;', 'parachute' ) ); ?>
<?php endif; ?>