function getSidebarFallbackNav() {
  $nav_items = array();

  $menu = 258;

  if ($box_office == "box_office_template") {
    $menu = 262;
  }

  $skywalker = new Parachute_Nav_Walker();
  $args = array(
    'menu' => $menu,
    'container'=>'',
    'container_class'=>'',
    'menu_class'=>'',
    'echo' => false,
    'depth' => 0,
    'walker' => $skywalker
  );

  $menu_items = parachute_wp_nav_menu($args);

  if(!empty($menu_items)){
    $menu_items_level_0 = $menu_items[0];
    $menu_child_items = $menu_items[1];
  }

  if( !empty($menu_items_level_0) ){
    $p = null;
    $p1 = null;
    $p2 = null;
    $p3 = null;
    $p4 = null;
    $p5 = null;

    $nav_items = $menu_items_level_0;

    foreach($menu_items_level_0 as $p) {
      if($p->menu_item_parent != 0) continue;
      $has_children = false;
      $has_children_class = '';
      $swuppable = ''; // Does this trigger a swup reload based on the href of this link? We don't want this for dropdown/accordion controls
      $menu_items_level_1 = null;

      // Get the first-level children of this page in our menu
      if( isset($menu_child_items[$p->db_id]) ){
        $menu_items_level_1 = $menu_child_items[$p->db_id];

        /* 
          * We aren't showing "columns" (1st level children of a level-0 item) as children, 
          * check to see if a column contains any nav blocks (children) and if not, mark this as having no child elements
          */
        foreach($menu_items_level_1 as $tmp){
          if($tmp->menu_item_parent != $p->ID) continue;
          if( isset($menu_child_items[$tmp->db_id]) ){
            $has_children = true;
            $has_children_class = ' has-children';
            $swuppable = ' data-no-swup';
          }
        }

        $tmp = null;
      }

      // Get the children if there are any
      if($has_children == true && !empty($menu_items_level_1)) {

        // Level 1
        foreach($menu_items_level_1 as $p1) {
          if($p1->menu_item_parent != $p->ID) continue;
          $has_children = false;
          $has_children_class = '';
          $columns = array();

          // Get the first-level children of this page in our menu
          if( isset($menu_child_items[$p1->db_id]) ){
            $has_children = true;
            $has_children_class = ' has-children';
            $columns = $menu_child_items[$p1->db_id];
            $nav_blocks = array();
          }

          /* 
            * This is now using the data from the main navigation which has an additional level in it to handle "columns".
            * We want to get the child items of these columns but not output them directly. Just iterate over them.
          */

          if( !empty($columns) ){
            foreach($columns as $column) {
              if($column->menu_item_parent != $p1->ID) continue;
              $has_children = false;
              $has_children_class = '';
              $swuppable = '';
              
              // Get the second-level children of this page in our menu (i.e. - the children of the column items)
              if( isset($menu_child_items[$column->db_id]) ){
                $has_children = true;
                $has_children_class = ' has-children';
                $swuppable = ' data-no-swup';

                foreach($menu_child_items[$column->db_id] as $child){
                  $nav_blocks[] = $child;
                }
              }
            } // foreach columns as column

            // Nav blocks are what we're really after as these aren't just structural like columns
            if( !empty( $nav_blocks ) ){
              foreach( $nav_blocks as $block ) {
                $has_children = false;
                $has_children_class = '';
                $swuppable = '';
                $menu_items_level_3 = array();

                // Get the first-level children of this page in our menu
                if( isset($menu_child_items[$block->db_id]) ){
                  $has_children = true;
                  $has_children_class = ' has-children';
                  $swuppable = ' data-no-swup';

                  foreach($menu_child_items[$block->db_id] as $c3){
                    $menu_items_level_3[] = $c3;
                  }
                }

                // If this page has child blocks then show it
                if($has_children == true && !empty($menu_items_level_3)) {

                  // Level 3
                  foreach($menu_items_level_3 as $p3) {

                    $has_children = false;
                    $has_children_class = '';
                    // $swuppable = ' data-no-swup';
                    $menu_items_level_4 = array();

                    // Get the first-level children of this page in our menu
                    if( isset($menu_child_items[$p3->db_id]) ){
                      $has_children = true;
                      $has_children_class = ' has-children';
                      $swuppable = '';

                      foreach($menu_child_items[$p3->db_id] as $c4){
                        $menu_items_level_4[] = $c4;
                      }
                    }
                  } // menu_items_level_3 as p3
                } // has_children true & !empty(menu_items_level_3)
              } // !empty(nav_blocks)
            } // columns as column
          } // !empty(columns)
        } // $has_children == true && !empty($menu_items_level_1)
      } // $menu_items_level_0 as $p
    } // !empty($menu_items_level_0)
  } // !empty($menu_items_level_0)

  return $nav_items;
}