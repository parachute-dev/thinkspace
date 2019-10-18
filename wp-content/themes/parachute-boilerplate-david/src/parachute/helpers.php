<?php
/*
 * This function allows us to pass variables through to template parts.
 * It defines its scope as the same as wherever it's called so to make 
 * things a bit less leaky let's plank it in a function that calls the 
 * template can accept whatever arguments we pass to it.
 *
 * - Ross@Parachute
 */

function get_custom_template($path = '', $args = null){
    if ( $path != "") {
       include( locate_template( $path, false, false ) );
    }
}

function compareByName($a, $b) {
    return strcmp($a["name"], $b["name"]);
}

function get_depth(){
    global $wp_query;
    $object = $wp_query->get_queried_object();
    $parent_id  = $object->post_parent;
    $depth = 0;
    while ($parent_id > 0) {
            $page = get_page($parent_id);
            $parent_id = $page->post_parent;
            $depth++;
    }

    return $depth;
}

function compare_month_term_objs($a, $b) {
    $monthA = date_parse($a->name);
    $monthB = date_parse($b->name);

    return $monthA["month"] - $monthB["month"];
}

function addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

function getPseudoRandomString($length = 4) {
    $base64Chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/';
    $result = '';

    for ($i = 0; $i < $length; ++$i) {
        $result .= $base64Chars[mt_rand(0, strlen($base64Chars) - 1)];
    }

    return $result;
}