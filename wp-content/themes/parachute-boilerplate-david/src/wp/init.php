<?php

function enqueue_scripts() {
  wp_enqueue_style( 'parachute-boilerplate-style', get_stylesheet_directory_uri() . '/assets/css/base.css' ); // 
  wp_enqueue_script( 'parachute-script', get_stylesheet_directory_uri() . '/assets/js/scripts.min.js' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

register_nav_menus( array(
	'main' => 'Main Navigation',
	'footer' => 'Footer Navigation',
) );


/**
 * Set WooCommerce image dimensions upon theme activation
 */
// Remove each style one by one
add_filter( 'woocommerce_enqueue_styles', 'woo_dequeue_styles' );

function woo_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-layout'] );		// Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] );	// Remove the smallscreen optimisation
	return $enqueue_styles;
}

// Or just remove them all in one line
add_filter( 'woocommerce_enqueue_styles', '__return_false' );