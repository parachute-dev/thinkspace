<!DOCTYPE html>
<html lang="en" xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8">
	<title><?php wp_title();?></title>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="<?php bloginfo('template_url');?>/assets/js/lib/mmenu/mmenu.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url');?>/assets/js/lib/mmenu/mburger.css" rel="stylesheet" />
    <link href="<?php bloginfo('template_url');?>/assets/js/lib/mmenu/mhead.css" rel="stylesheet" />    
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet">


	<!--
		 _______  _______  ______    _______  _______  __   __  __   __  _______  _______
		|       ||   _   ||    _ |  |   _   ||       ||  | |  ||  | |  ||       ||       |
		|    _  ||  |_|  ||   | ||  |  |_|  ||       ||  |_|  ||  | |  ||_     _||    ___|
		|   |_| ||       ||   |_||_ |       ||       ||       ||  |_|  |  |   |  |   |___
		|    ___||       ||    __  ||       ||      _||       ||       |  |   |  |    ___|
		|   |    |   _   ||   |  | ||   _   ||     |_ |   _   ||       |  |   |  |   |___
		|___|    |__| |__||___|  |_||__| |__||_______||__| |__||_______|  |___|  |_______|
	-->
<?php wp_enqueue_script("jquery"); ?>

	<?php wp_head();?>

	<!-- BROWSER SPECIFIC CONDITIONALS START -->
			<!--[if IE]>
				<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	<!-- BROWSER SPECIFIC CONDITIONALS END -->