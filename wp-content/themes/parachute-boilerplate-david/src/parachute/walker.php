<?php
/*
 * Parachute_Nav_Walker()
 *
 * Our custom walker class is really just there to provide us with the raw data for each
 * Wordpress menu so we can display it exactly as we wish without constraint. Our custom
 * walker will not display a menu for you.
 *
 * - Ross
 */
if( ! class_exists( 'Parachute_Nav_Walker' ) ) :
    class Parachute_Nav_Walker extends Walker_Nav_Menu{
        /**
         * Display array of elements hierarchically.
         *
         * Does not assume any existing order of elements.
         *
         * $max_depth = -1 means flatly display every element.
         * $max_depth = 0 means display all levels.
         * $max_depth > 0 specifies the number of display levels.
         *
         * @since 2.1.0
         *
         * @param array $elements  An array of elements.
         * @param int   $max_depth The maximum hierarchical depth.
         * @return string The hierarchical item output.
         */
        public function walk( $elements, $max_depth ) {
            $args = array_slice(func_get_args(), 2);
            $output = array(); // Originally a string for HTML markup in the Walker_Nav_Menu
    
            //invalid parameter or nothing to walk
            if ( $max_depth < -1 || empty( $elements ) ) {
                return $output;
            }
    
            $parent_field = $this->db_fields['parent'];
    
            // flat display
            if ( -1 == $max_depth ) {
                $output[0] = $elements;
                return $output;
            }
    
            /*
             * Need to display in hierarchical order.
             * Separate elements into two buckets: top level and children elements.
             * Children_elements is two dimensional array, eg.
             * Children_elements[10][] contains all sub-elements whose parent is 10.
             */
            $top_level_elements = array();
            $children_elements  = array();
            foreach ( $elements as $e) {
                if ( empty( $e->$parent_field ) )
                    $top_level_elements[] = $e;
                else
                    $children_elements[ $e->$parent_field ][] = $e;
            }
    
            /*
             * When none of the elements is top level.
             * Assume the first one must be root of the sub elements.
             */
            if ( empty($top_level_elements) ) {
    
                $first = array_slice( $elements, 0, 1 );
                $root = $first[0];
    
                $top_level_elements = array();
                $children_elements  = array();
                foreach ( $elements as $e) {
                    if ( $root->$parent_field == $e->$parent_field )
                        $top_level_elements[] = $e;
                    else
                        $children_elements[ $e->$parent_field ][] = $e;
                }
            }
    
            /* 
             * Return a nice ordered array with all of our navigation elements and our child elements.
             * 
             * Cross-reference the post_parent property of the child elements with the ID's for hierarchichal navs.
             * 
             */
            $output[0] = $elements;
            $output[1] = $children_elements;
    
            return $output;
        }
    }
endif; /* ! class_exists( 'Parachute_WP_Nav' ) */