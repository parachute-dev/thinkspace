<!-- Modal Popup -->
<?php get_custom_template('templates/components/modal/general.php'); ?>
</div> <!-- .surround-inner -->
</div> <!-- #surround -->

<!-- FOOTER START -->
<footer id="footer">
	<div id="footer-main">
		<div class="container">
			<div class="row ">
				<div class="col-sm-7 col-xs-12">

					<div class="row">
						<div class="col-md-3 col-xs-6">
							<h5>
								Degree Courses
							</h5>
							<ul>
	<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>	
							</ul>
						</div>
						<div class="col-md-3 col-xs-6">
							<h5>
								Degree Courses
							</h5>
							<ul>
	<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>	
							</ul>
						</div>
						<div class="col-md-3 col-xs-6">
							<h5>
								Degree Courses
							</h5>
							<ul>
								<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>																
							</ul>
						</div>
						<div class="col-md-3 col-xs-6">
							<h5>
								Degree Courses
							</h5>
							<ul>
								<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>
	<li>
									<a href="#">MFA</a>
								</li>	
							</ul>
						</div>															
					</div>

				</div>

				<div class="col-sm-5 col-xs-12">

					<div class="logo">
						<img src="<?php bloginfo('template_url');?>/assets/img/logo-white.png" alt="Logo">
					</div>

					<div class="address">
						<p>119 Third Avenue, Almodington, West Sussex, PO20 7LB <br>
							Telephone: 01243 512730 <br>
							Email: contact@thinkspace.us 
						</p>
					</div>
					<div class="credit-cards">
						<ul>
							<li></li>
							<li></li>
						</ul>
					</div>


				</div>



			</div>
		</div>
	</div>
	<div id="footer-bottom">
		<div class="container-fluid">			
			<div class="row">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>&copy; Think Space Education</p>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</footer>

<!-- FOOTER END -->
<?php wp_footer(); 	?>

<!-- Global Javascript from Admin Area -->

<script src="<?php bloginfo('template_url');?>/assets/js/lib/mmenu/mmenu.js"></script>
<script src="<?php bloginfo('template_url');?>/assets/js/lib/mmenu/mburger.js"></script>
<script src="<?php bloginfo('template_url');?>/assets/js/lib/mmenu/mhead.js"></script>
<script>
  // init controller 
  var controller = new ScrollMagic.Controller();

  // build scenes
  new ScrollMagic.Scene({triggerElement: ".two-block-container"})
  .setClassToggle(".two-block-container", "animated")
  .addTo(controller);
  new ScrollMagic.Scene({triggerElement: ".offer-banner"})
  .setClassToggle(".offer-banner", "animated")
  .addTo(controller);

  new ScrollMagic.Scene({triggerElement: ".latest-offer-carousel"})
  .setClassToggle(".latest-offer-carousel", "animated")
  .addTo(controller);
  new ScrollMagic.Scene({triggerElement: ".news-events-container"})
  .setClassToggle(".news-events-container", "animated")
  .addTo(controller);

</script>        

<script>

</script>


<script>
	document.addEventListener(
		"DOMContentLoaded", () => {
			new Mhead( "#header-container", {
                // options
            });

			// new Mmenu( "#navmenu",  {
   //      // configuration
   //      offCanvas: {
   //      	clone: true
   //      }
   //  });

}
);
	jQuery(document).ready(function($) {
		jQuery(".mburger").click(function(event) {
			jQuery("body").toggleClass("mm-wrapper_opened");
		});
	});

	jQuery("#navmenu > ul > li a").click(function(event) {
		event.preventDefault();
		jQuery(this).parent().find(".mega-menu-left").toggleClass("menu-opened");
	});

		jQuery("#navmenu .mega-menu-left > li.has-children a").click(function(event) {
		event.preventDefault();
		jQuery(this).parent().toggleClass("menu-slide");
		jQuery(".menu-close-button").toggleClass("show");
	});

		jQuery(".menu-close-button").click(function(event) {
			jQuery("#navmenu .mega-menu-left li").removeClass("menu-slide");
					jQuery(".menu-close-button").removeClass("show");

		});


</script>

</body>
</html>