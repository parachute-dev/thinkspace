<?php
/* Flexible Content Helpers */
function get_flexible_content_block($content = null, $is_sidebar_content = false){
    if(empty($content)) return false;
    if(isset($content['active']) && $content['active'] != 'active') return false;
  
    $args = array();
    $block = isset($content['acf_fc_layout']) ? $content['acf_fc_layout'] : '';
  
    $styles = isset($content['styles']) ? $content['styles'][0] : null;
    if(!empty($styles) && $styles['active'] == 'active'){
      $args['styles'] = $styles;
    }
  
    if($block === 'banner_block'){
      $banner_items = isset($content['banner_items']) ? $content['banner_items'] : null;
      $banner_control_type = isset($content['banner_control_type']) ? $content['banner_control_type'] : 'dots';
      $banner_carousel_active = isset($content['banner_carousel_active']) ? $content['banner_carousel_active'] : false;
  
      $args['banner_items'] = $banner_items;
      $args['banner_control_type'] = $banner_control_type;
      $args['banner_carousel_active'] = $banner_carousel_active;
  
      return get_custom_template('templates/flexible-content/banner.php', $args);
    }
    else if($block === 'content_listings_block'){
      $content_listings = isset($content['content_listings']) ? $content['content_listings'] : null;
  
      $args = array(
       'content_listings' => $content_listings
      );
  
      if(isset($is_sidebar_content)) $args['is_sidebar_content'] = $is_sidebar_content;
  
          return get_custom_template('templates/flexible-content/content-listings.php', $args);
    }
    else if($block === 'content_block'){
        $content_blocks = isset($content['content_blocks']) ? $content['content_blocks'] : null;
    
        $args = array(
         'content_blocks' => $content_blocks
        );
    
        return get_custom_template('templates/flexible-content/content-block.php', $args);
    }
    else if($block === 'social_feeds_block'){
      return get_custom_template('templates/flexible-content/social-feeds.php');
    }
    else if($block === 'news_listings_block'){
      return get_custom_template('templates/flexible-content/news-listings.php', $args);
    }
    else if($block === 'breadcrumbs_block'){
      return get_custom_template('templates/flexible-content/breadcrumbs.php', $args);
    }
    else if($block === 'page_content_block'){
      $args['layout'] = $content['layout'];
  
      return get_custom_template('templates/flexible-content/page-content.php', $args);
    }
    else if($block === 'vertical_nav_anchor'){
      $args['title'] = $content['title'];
      return get_custom_template('templates/flexible-content/vertical-nav-anchor.php', $args);
    }
  
    return false;
  }

function get_all_flexible_content_blocks($flexible_content = null){
    $output = '';

    if( !class_exists('acf') || !function_exists('get_field') ) return false;

    if(empty($flexible_content)){
        global $post;
        $flexible_content = get_field('flexible_content', $post->ID);
    }

    if(!empty($flexible_content)){
        foreach($flexible_content as $content){
        $container_type_class = 'container';
        if(isset($content['container_type'])){
            if($content['container_type'] === 'fluid'){
            $container_type_class = 'container-fluid';
            }
        }


        // Force Breadcrumb to be full width -- DB
        if ($content['acf_fc_layout'] == "breadcrumbs_block") {
            $container_type_class = "container-fluid";

        }

        ob_start();
        echo '<div class="content-container ' .  $content['acf_fc_layout'] . '">';
            echo '<div class="content-container-inner ' . $container_type_class . '">';
                echo '<div class="content-container-inner-row row">';
                    echo '<div class="flexible-content">';
                        get_flexible_content_block($content);
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        $output .= ob_get_contents();
        ob_end_clean();
        }

        return $output;
    }
}

/* Expects a repeater field with flexible_content fields with the slugs "flexible_content_<POSITION>" */
function get_all_flexible_sidebar_content_blocks($flexible_content = null, $position = 'left'){
    $output = '';

    if(empty($flexible_content)){
        return false;
    }
    else{
        $flexible_content = $flexible_content['flexible_content_' . $position];
    }

    if(!empty($flexible_content)){
        foreach($flexible_content as $content){
        $container_type_class = 'container';
        if(isset($content['container_type'])){
            if($content['container_type'] === 'fluid'){
            $container_type_class = 'container-fluid';
            }
        }

        ob_start();
        echo '<div class="content-container">';
            echo '<div class="content-container-inner">';
                echo '<div class="content-container-inner-row">';
                    echo '<div class="flexible-content">';
                        get_flexible_content_block($content, true);
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';

        $output .= ob_get_contents();
        ob_end_clean();
        }

        return $output;
    }
}

function get_block_styles( $args = array() ){
    if(empty($args) || !isset($args['styles'])) return false;
    $styles = $args['styles'];
    $style_str = '';
    $active_styles = array();

    if( isset($styles['margin_top']) && $styles['margin_top'] != '') $active_styles['margin-top'] = $styles['margin_top'];
    if( isset($styles['margin_right']) && $styles['margin_right'] != '') $active_styles['margin-right'] = $styles['margin_right'];
    if( isset($styles['margin_bottom']) && $styles['margin_bottom'] != '') $active_styles['margin-bottom'] = $styles['margin_bottom'];
    if( isset($styles['margin_left']) && $styles['margin_left'] != '') $active_styles['margin-left'] = $styles['margin_left'];

    if( isset($styles['padding_top']) && $styles['padding_top'] != '') $active_styles['padding-top'] = $styles['padding_top'];
    if( isset($styles['padding_right']) && $styles['padding_right'] != '') $active_styles['padding-right'] = $styles['padding_right'];
    if( isset($styles['padding_bottom']) && $styles['padding_bottom'] != '') $active_styles['padding-bottom'] = $styles['padding_bottom'];
    if( isset($styles['padding_left']) && $styles['padding_left'] != '') $active_styles['padding-left'] = $styles['padding_left'];

    foreach($active_styles as $prop=>$value){
        $style_str .= $prop . ':' . $value . ';';
    }

    if(!empty($style_str)) $style_str = 'style="' . $style_str . '"';
    return $style_str;
}

function get_block_custom_css( $args = array() ){
    if(empty($args) || !isset($args['styles']) || !isset($args['styles']['custom_css'])) return false;
    $custom_css = $args['styles']['custom_css'];
    $style_block_str = '';

    if(!empty($custom_css)) $style_block_str = '<style type="text/css">' . $custom_css . '</style>';
    return $style_block_str;
}