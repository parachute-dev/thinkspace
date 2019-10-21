<?php
/*
Description: The template file for content listings powered by the Advanced Custom Fields plugin or if you feed it a WP_Query object
Version: 1.0
Author: Parachute
Author URI: https://www.parachute.net
*/
?>
<?php if(!empty($args)): ?>
	<?php
        /* $args fallbacks */
        if( !isset($args['title']) ) $args['title'] = '';
        
        $title = $args['title'];
        $slug = slugify($title);
    ?>

    <a href="#" class="vertical-nav-anchor" title="<?php echo $title; ?>">
        <span class="sr-only title"><?php echo $title; ?></span>
    </a>
<?php endif; // if(empty($args)) ?>