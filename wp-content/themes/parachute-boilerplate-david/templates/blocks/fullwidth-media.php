      
<?php 
$backgroundColour = get_field ('background_colour');
$position = get_field('positioning');
$style = get_field('style');



 ?>
<div class="container-content-image style-<?php echo $style; ?> <?php echo $backgroundColour; ?> position-<?php echo $position;?>">
    <div class="container">
        <div class="row is-flex">
            <div class="col-md-6 content-image-image-container">
                <div class="background-image"  style="background-image:url(<?php if (get_field('background_image')) { $image = get_field('background_image'); echo $image['url']; } ?>)">
                </div>
            </div>
            <div class="col-md-6 content-content-container">
                <?php if (get_field('main_title')) { ?>
                    <h4><?php echo get_field('main_title'); ?></h4>
                <?php } ?>                      
                <?php if (get_field('main_content')) { ?>
                    <?php echo get_field('main_content'); ?>
                <?php } ?>

                <!-- BUTTON -->
                <?php if (get_field('internal_link') || get_field('external_link')) { ?>
                    <?php get_field('external_link') ? $link = get_field('external_link') : $link = get_field('internal_link') ?>

                    <a class="button" href="<?php echo $link; ?>">
                        <?php the_field('button_cta_text');?>
                    </a>

                <?php } ?>
            </div>
        </div>
    </div>
</div>
