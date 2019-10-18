<?php
/*
 * Let's modify this function a bit so we can get an object back that lets
 * us build custom filtering forms that are a bit cleverer!
 *
 * Originally wp_get_archives()
 *
 * - Ross@Parachute
*/
function parachute_get_archives( $args = '' ) {
    global $wpdb, $wp_locale;
    
    $defaults = array(
      'type' => 'monthly', 'limit' => '',
      'format' => 'html', 'before' => '',
      'after' => '', 'show_post_count' => false,
      'echo' => 1, 'order' => 'DESC',
      'post_type' => 'post'
    );
    
    $r = wp_parse_args( $args, $defaults );
    
    $post_type_object = get_post_type_object( $r['post_type'] );
    if ( ! is_post_type_viewable( $post_type_object ) ) {
      return;
    }
    $r['post_type'] = $post_type_object->name;
    
    if ( '' == $r['type'] ) {
      $r['type'] = 'monthly';
    }
    
    if ( ! empty( $r['limit'] ) ) {
      $r['limit'] = absint( $r['limit'] );
      $r['limit'] = ' LIMIT ' . $r['limit'];
    }
    
    $order = strtoupper( $r['order'] );
    if ( $order !== 'ASC' ) {
      $order = 'DESC';
    }
    
      // this is what will separate dates on weekly archive links
    $archive_week_separator = '&#8211;';
    
    $sql_where = $wpdb->prepare( "WHERE post_type = %s AND post_status = 'publish'", $r['post_type'] );

    /**
     * Filters the SQL WHERE clause for retrieving archives.
     *
     * @since 2.2.0
     *
     * @param string $sql_where Portion of SQL query containing the WHERE clause.
     * @param array  $r         An array of default arguments.
     */
    $where = apply_filters( 'getarchives_where', $sql_where, $r );

    /**
     * Filters the SQL JOIN clause for retrieving archives.
     *
     * @since 2.2.0
     *
     * @param string $sql_join Portion of SQL query containing JOIN clause.
     * @param array  $r        An array of default arguments.
     */
    $join = apply_filters( 'getarchives_join', '', $r );

    $output = '';
    $output_arr = array();

    $last_changed = wp_cache_get_last_changed( 'posts' );

    $limit = $r['limit'];
      
    if ( 'monthly' == $r['type'] ) {
        $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date $order $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
          $results = $wpdb->get_results( $query );
          wp_cache_set( $key, $results, 'posts' );
        }
        if ( $results ) {
          $after = $r['after'];
          foreach ( (array) $results as $result ) {
            $url = get_month_link( $result->year, $result->month );
            if ( 'post' !== $r['post_type'] ) {
              $url = add_query_arg( 'post_type', $r['post_type'], $url );
            }
            /* translators: 1: month name, 2: 4-digit year */
            $text = sprintf( __( '%1$s %2$d' ), $wp_locale->get_month( $result->month ), $result->year );
            if ( $r['show_post_count'] ) {
              $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
            }
  
            /* Parachute modifications */
            if(isset($r['return_array']) && $r['return_array'] == true){
             $output_arr[] = $result;
           }
           else{
             $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
           }
           /* End of Parachute modifications */
         }
       }
    } elseif ( 'yearly' == $r['type'] ) {
        $query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date $order $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
        $results = $wpdb->get_results( $query );
        wp_cache_set( $key, $results, 'posts' );
        }
        if ( $results ) {
            $after = $r['after'];
            foreach ( (array) $results as $result) {
                $url = get_year_link( $result->year );
                if ( 'post' !== $r['post_type'] ) {
                $url = add_query_arg( 'post_type', $r['post_type'], $url );
                }
                $text = sprintf( '%d', $result->year );
                if ( $r['show_post_count'] ) {
                $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
                }

                /* Parachute modifications */
                if(isset($r['return_array']) && $r['return_array'] == true){
                $output_arr[] = $result;
                }
                else{
                $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
                }
                /* End of Parachute modifications */
            }
        }
    } 
    elseif ( 'daily' == $r['type'] ) {
        $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, DAYOFMONTH(post_date) AS `dayofmonth`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date), DAYOFMONTH(post_date) ORDER BY post_date $order $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
        $results = $wpdb->get_results( $query );
        wp_cache_set( $key, $results, 'posts' );
        }
        if ( $results ) {
            $after = $r['after'];
            foreach ( (array) $results as $result ) {
                $url  = get_day_link( $result->year, $result->month, $result->dayofmonth );
                if ( 'post' !== $r['post_type'] ) {
                $url = add_query_arg( 'post_type', $r['post_type'], $url );
                }
                $date = sprintf( '%1$d-%2$02d-%3$02d 00:00:00', $result->year, $result->month, $result->dayofmonth );
                $text = mysql2date( get_option( 'date_format' ), $date );
                if ( $r['show_post_count'] ) {
                $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
                }
        
                /* Parachute modifications */
                if(isset($r['return_array']) && $r['return_array'] == true){
                $output_arr[] = $result;
            }
            else{
                $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
            }
            /* End of Parachute modifications */
            }
        }
    } elseif ( 'weekly' == $r['type'] ) {
        $week = _wp_mysql_week( '`post_date`' );
        $query = "SELECT DISTINCT $week AS `week`, YEAR( `post_date` ) AS `yr`, DATE_FORMAT( `post_date`, '%Y-%m-%d' ) AS `yyyymmdd`, count( `ID` ) AS `posts` FROM `$wpdb->posts` $join $where GROUP BY $week, YEAR( `post_date` ) ORDER BY `post_date` $order $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
        $results = $wpdb->get_results( $query );
        wp_cache_set( $key, $results, 'posts' );
        }
        $arc_w_last = '';
        if ( $results ) {
        $after = $r['after'];
        foreach ( (array) $results as $result ) {
            if ( $result->week != $arc_w_last ) {
            $arc_year       = $result->yr;
            $arc_w_last     = $result->week;
            $arc_week       = get_weekstartend( $result->yyyymmdd, get_option( 'start_of_week' ) );
            $arc_week_start = date_i18n( get_option( 'date_format' ), $arc_week['start'] );
            $arc_week_end   = date_i18n( get_option( 'date_format' ), $arc_week['end'] );
            $url            = add_query_arg( array( 'm' => $arc_year, 'w' => $result->week, ), home_url( '/' ) );
            if ( 'post' !== $r['post_type'] ) {
                $url = add_query_arg( 'post_type', $r['post_type'], $url );
            }
            $text           = $arc_week_start . $archive_week_separator . $arc_week_end;
            if ( $r['show_post_count'] ) {
                $r['after'] = '&nbsp;(' . $result->posts . ')' . $after;
            }
    
            /* Parachute modifications */
            if(isset($r['return_array']) && $r['return_array'] == true){
                $output_arr[] = $result;
            }
            else{
                $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
            }
            /* End of Parachute modifications */
            }
        }
        }
    } 
    elseif ( ( 'postbypost' == $r['type'] ) || ('alpha' == $r['type'] ) ) {
        $orderby = ( 'alpha' == $r['type'] ) ? 'post_title ASC ' : 'post_date DESC, ID DESC ';
        $query = "SELECT * FROM $wpdb->posts $join $where ORDER BY $orderby $limit";
        $key = md5( $query );
        $key = "wp_get_archives:$key:$last_changed";
        if ( ! $results = wp_cache_get( $key, 'posts' ) ) {
            $results = $wpdb->get_results( $query );
            wp_cache_set( $key, $results, 'posts' );
        }
        if ( $results ) {
            foreach ( (array) $results as $result ) {
            if ( $result->post_date != '0000-00-00 00:00:00' ) {
                $url = get_permalink( $result );
                if ( $result->post_title ) {
                /** This filter is documented in wp-includes/post-template.php */
                $text = strip_tags( apply_filters( 'the_title', $result->post_title, $result->ID ) );
                } else {
                $text = $result->ID;
                }
                $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
            }

            /* Parachute modifications */
            if(isset($r['return_array']) && $r['return_array'] == true){
                $output_arr[] = $result;
            }
            else{
                $output .= get_archives_link( $url, $text, $r['format'], $r['before'], $r['after'] );
            }
            /* End of Parachute modifications */
            }
        }
    }
  
    /* Parachute modifications */
    if(isset($r['return_array']) && $r['return_array'] == true){
        return $output_arr;
    }
    else{
        if ( $r['echo'] ) {
            echo $output;
        } else {
            return $output;
        }
    }
}
  
 /**
   * Returns the raw data for a navigation menu for use with Parachute_Nav_Walker()
   *
   * @since 3.0.0
   * @since 4.7.0 Added the `item_spacing` argument.
   *
   * @staticvar array $menu_id_slugs
   *
   * @param array $args {
   *     Optional. Array of nav menu arguments.
   *
   *     @type int|string|WP_Term $menu            Desired menu. Accepts a menu ID, slug, name, or object. Default empty.
   *     @type string             $menu_class      CSS class to use for the ul element which forms the menu. Default 'menu'.
   *     @type string             $menu_id         The ID that is applied to the ul element which forms the menu.
   *                                               Default is the menu slug, incremented.
   *     @type string             $container       Whether to wrap the ul, and what to wrap it with. Default 'div'.
   *     @type string             $container_class Class that is applied to the container. Default 'menu-{menu slug}-container'.
   *     @type string             $container_id    The ID that is applied to the container. Default empty.
   *     @type callable|bool      $fallback_cb     If the menu doesn't exists, a callback function will fire.
   *                                               Default is 'wp_page_menu'. Set to false for no fallback.
   *     @type string             $before          Text before the link markup. Default empty.
   *     @type string             $after           Text after the link markup. Default empty.
   *     @type string             $link_before     Text before the link text. Default empty.
   *     @type string             $link_after      Text after the link text. Default empty.
   *     @type bool               $echo            Whether to echo the menu or return it. Default true.
   *     @type int                $depth           How many levels of the hierarchy are to be included. 0 means all. Default 0.
   *     @type object             $walker          Instance of a custom walker class. Default empty.
   *     @type string             $theme_location  Theme location to be used. Must be registered with register_nav_menu()
   *                                               in order to be selectable by the user.
   *     @type string             $items_wrap      How the list items should be wrapped. Default is a ul with an id and class.
   *                                               Uses printf() format with numbered placeholders.
   *     @type string             $item_spacing    Whether to preserve whitespace within the menu's HTML. Accepts 'preserve' or 'discard'. Default 'preserve'.
   * }
   * @return string|false|void Menu output if $echo is false, false if there are no items or no menu was found.
   */
  if( !function_exists( 'parachute_wp_nav_menu' ) ) { 
  function parachute_wp_nav_menu( $args = array() ) {
      static $menu_id_slugs = array();
  
      $defaults = array( 'menu' => '', 'container' => 'div', 'container_class' => '', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
     'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'item_spacing' => 'preserve',
     'depth' => 0, 'walker' => '', 'theme_location' => '' );
  
      $args = wp_parse_args( $args, $defaults );
  
      if ( ! in_array( $args['item_spacing'], array( 'preserve', 'discard' ), true ) ) {
          // invalid value, fall back to default.
          $args['item_spacing'] = $defaults['item_spacing'];
      }
  
      /**
       * Filters the arguments used to display a navigation menu.
       *
       * @since 3.0.0
       *
       * @see wp_nav_menu()
       *
       * @param array $args Array of wp_nav_menu() arguments.
       */
      $args = apply_filters( 'wp_nav_menu_args', $args );
      $args = (object) $args;
  
      /**
       * Filters whether to short-circuit the wp_nav_menu() output.
       *
       * Returning a non-null value to the filter will short-circuit
       * wp_nav_menu(), echoing that value if $args->echo is true,
       * returning that value otherwise.
       *
       * @since 3.9.0
       *
       * @see wp_nav_menu()
       *
       * @param string|null $output Nav menu output to short-circuit with. Default null.
       * @param stdClass    $args   An object containing wp_nav_menu() arguments.
       */
      $nav_menu = apply_filters( 'pre_wp_nav_menu', null, $args );
  
      if ( null !== $nav_menu ) {
          if ( $args->echo ) {
              echo $nav_menu;
              return;
          }
  
          return $nav_menu;
      }
  
      // Get the nav menu based on the requested menu
      $menu = wp_get_nav_menu_object( $args->menu );
  
      // Get the nav menu based on the theme_location
      if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
          $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
  
      // get the first menu that has items if we still can't find a menu
      if ( ! $menu && !$args->theme_location ) {
          $menus = wp_get_nav_menus();
          foreach ( $menus as $menu_maybe ) {
              if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
                  $menu = $menu_maybe;
                  break;
              }
          }
      }
  
      if ( empty( $args->menu ) ) {
          $args->menu = $menu;
      }
  
      // If the menu exists, get its items.
      if ( $menu && ! is_wp_error($menu) && !isset($menu_items) )
          $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
  
      /*
       * If no menu was found:
       *  - Fall back (if one was specified), or bail.
       *
       * If no menu items were found:
       *  - Fall back, but only if no theme location was specified.
       *  - Otherwise, bail.
       */
      if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
          && isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) )
     return call_user_func( $args->fallback_cb, (array) $args );
  
   if ( ! $menu || is_wp_error( $menu ) )
    return false;
  
  $nav_menu = $items = array();
  
  $show_container = false;
  if ( $args->container ) {
          /**
           * Filters the list of HTML tags that are valid for use as menu containers.
           *
           * @since 3.0.0
           *
           * @param array $tags The acceptable HTML tags for use as menu containers.
           *                    Default is array containing 'div' and 'nav'.
           */
          $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
          if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags ) ) {
              $show_container = true;
              $class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
              $id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
              $nav_menu .= '<'. $args->container . $id . $class . '>';
          }
      }
  
      // Set up the $menu_item variables
      _wp_menu_item_classes_by_context( $menu_items );
  
      $sorted_menu_items = $menu_items_with_children = array();
      foreach ( (array) $menu_items as $menu_item ) {
          $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
          if ( $menu_item->menu_item_parent )
              $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
      }
  
      // Add the menu-item-has-children class where applicable
      if ( $menu_items_with_children ) {
          foreach ( $sorted_menu_items as &$menu_item ) {
              if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
                  $menu_item->classes[] = 'menu-item-has-children';
          }
      }
  
      unset( $menu_items, $menu_item );
  
      /**
       * Filters the sorted list of menu item objects before generating the menu's HTML.
       *
       * @since 3.1.0
       *
       * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
       * @param stdClass $args              An object containing wp_nav_menu() arguments.
       */
      $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );
  
      $items = walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
      unset($sorted_menu_items);
  
      // Attributes
      if ( ! empty( $args->menu_id ) ) {
          $wrap_id = $args->menu_id;
      } else {
          $wrap_id = 'menu-' . $menu->slug;
          while ( in_array( $wrap_id, $menu_id_slugs ) ) {
              if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
                  $wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
              else
                  $wrap_id = $wrap_id . '-1';
          }
      }
      $menu_id_slugs[] = $wrap_id;
  
      $wrap_class = $args->menu_class ? $args->menu_class : '';
  
      /**
       * Filters the HTML list content for navigation menus.
       *
       * @since 3.0.0
       *
       * @see wp_nav_menu()
       *
       * @param string   $items The HTML list content for the menu items.
       * @param stdClass $args  An object containing wp_nav_menu() arguments.
       */
      $items = apply_filters( 'wp_nav_menu_items', $items, $args );
      /**
       * Filters the HTML list content for a specific navigation menu.
       *
       * @since 3.0.0
       *
       * @see wp_nav_menu()
       *
       * @param string   $items The HTML list content for the menu items.
       * @param stdClass $args  An object containing wp_nav_menu() arguments.
       */
      $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );
  
      return $items;
  }
} /* ! function_exists( 'parachute_wp_nav_menu' ) */