<div class="container-video-carousel align-center background-<?php the_field('background_colour');?>">
	<h1><?php the_field('heading'); ?></h1>
	
	<div class="video-carousel">
		<?php while(has_sub_field('video_carousel')) { ?>
			<div class="video">
				<?php the_sub_field('video_embed'); ?>
			</div>
		<?php } ?>
	</div>

</div>

