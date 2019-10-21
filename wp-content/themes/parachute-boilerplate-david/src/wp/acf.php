<?php

//Load the Global Options
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

// Save local JSON
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
function my_acf_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/src/wp/acf-json';
    
    
    // return
    return $path;
    
}

add_filter('acf/settings/load_json', 'my_acf_json_load_point');

function my_acf_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    
    // append path
    $path[] = get_stylesheet_directory() . '/src/wp/acf-json';
    
    
    // return
    return $paths;
    
}



add_action('acf/init', 'my_acf_init');
function my_acf_init() {
    
    // check function exists
    if( function_exists('acf_register_block') ) {
        
        acf_register_block(array(
            'name'              => 'video_carousel',
            'title'             => __('Video Carousel'),
            'description'       => __('A custom carousel.'),
            'render_template'   => '/templates/blocks/video-carousel.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'banner', 'carousel' ),
        ));

        acf_register_block(array(
            'name'              => 'banner_carousel',
            'title'             => __('Banner Carousel'),
            'description'       => __('A custom carousel.'),
            'render_template'   => '/templates/blocks/banner-carousel.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'banner', 'carousel' ),
        ));
  
        acf_register_block(array(
            'name'              => 'content_listings',
            'title'             => __('Content Listings'),
            'description'       => __('A custom related content block'),
            'render_template'   => '/templates/blocks/content-listings.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'listings','content' ),
        ));

        acf_register_block(array(
            'name'              => 'Newsletter',
            'title'             => __('newsletter'),
            'description'       => __('A custom carousel.'),
            'render_template'   => '/templates/blocks/newsletter.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'newsletter' ),
        ));
        acf_register_block(array(
            'name'              => 'news-events',
            'title'             => __('News and Events'),
            'description'       => __('A custom carousel.'),
            'render_template'   => '/templates/blocks/news-events.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'news','events' ),
        ));
    
        acf_register_block(array(
            'name'              => 'two-block-content',
            'title'             => __('Two Block Content'),
            'description'       => __('A custom content block'),
            'render_template'   => '/templates/blocks/2-block-content.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'content' ),
        ));     

        acf_register_block(array(
            'name'              => 'offer-banner',
            'title'             => __('Offer Banner'),
            'description'       => __('A custom content block'),
            'render_template'   => '/templates/blocks/offer-banner.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'content' ),
        ));     

                    acf_register_block(array(
            'name'              => 'recommendations',
            'title'             => __('Recommendations'),
            'description'       => __('A custom content block'),
            'render_template'   => '/templates/blocks/recommendations.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'content' ),
        ));     
     
                    acf_register_block(array(
            'name'              => 'enquiry',
            'title'             => __('Enquiry'),
            'description'       => __('A custom content block'),
            'render_template'   => '/templates/blocks/enquiry.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'content' ),
        ));     


    }
}