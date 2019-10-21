
<?php $styles = get_block_styles($args); ?>
<section id="breadcrumbs" class="row" <?php echo $styles; ?>>
	<div id="breadcrumbs-inner" class="container">
		<span class="home-crumb">
			<a href="<?php echo $link; ?>" title="Home">
				<span class="text sr-only">Home</span>
				<span class="icon-container">
				    <svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 28" xml:space="preserve">
				        <use xlink:href="#home"></use>
				    </svg>      
				</span>
			</a>
		</span>
		<?php bcn_display(); ?>
	</div>
	<?php echo get_block_custom_css($args); ?>
</section>