<?php
/*
Template Name: Home Page
*/
get_header(); ?>

<!-- Page Specific Header Start -->

<!-- Page Specific Header End  -->

<?php include(get_stylesheet_directory() . '/toolbar.php'); ?>

<div id="page-body">
	<div id="page-body-inner">
		<?php the_content(); ?>
	</div>
</div>

<div class="slider">
	<div class="slide">
		<h1>Learn. Everywhere</h1>
		<h3>Join a global community of students</h3>
		<a href="" class="button button-pink">Find out more</a>
	</div>
</div>

<div class="find-your-course background-black container-padding-small">
	<div class="container">
		
			<form action="" class="is-flex row">
				<div class="col-md-4">
						<h3>Find Your <br>Course</h3>
				</div>
					<div class="col-md-3">
							<div class="input-group">
                                <label for="interest">Interest</label>
                                <div class="select-container input-element list-container background-white input-interest  active" id="enquire-select-an-interest">
                                    <i class="fa fa-sort" aria-hidden="true"></i>
                                    <ul>
                                  <!--       <li data-value="2" class="selected"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Booking</span></li>
                                        <li data-value="7"><i class="fa fa-table" aria-hidden="true"></i><span>Leagues</span></li>
                                        <li data-value="6"><i class="fa fa-birthday-cake" aria-hidden="true"></i><span>Kids Parties</span></li>
                                        <li data-value="15"><i class="fa fa-glass" aria-hidden="true"></i><span>Functions</span></li>
                                        <li data-value="3"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Coaching</span></li>
                                        <li data-value="4"><i class="fa fa-handshake-o" aria-hidden="true"></i><span>Corporate Events</span></li>
                                        <li data-value="20"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Bubble Football Parties</span></li>
                                        <li data-value="40"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Nerf Parties</span></li>

                                        <li data-value="1"><i class="fa fa-envelope-open" aria-hidden="true"></i><span>General Enquiry</span></li> -->

                                    </ul>
                                    <input readonly="readonly" required="" type="text" name="enquire-select-an-interest" id="enquire-select-an-interest" value="" class="no-event" placeholder="Select an interest" aria-required="true">

                                    <input type="hidden" value="15" name="interest-sc" class="input-value" id="interest-sc">

                                </div>
                            </div>

					</div>
					<div class="col-md-3">
						<div class="input-group">
                                <label for="interest">Interest</label>
                                <div class="select-container input-element list-container background-white input-interest  active" id="enquire-select-an-interest">
                                    <i class="fa fa-sort" aria-hidden="true"></i>
                                    <ul>
                                  <!--       <li data-value="2" class="selected"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Booking</span></li>
                                        <li data-value="7"><i class="fa fa-table" aria-hidden="true"></i><span>Leagues</span></li>
                                        <li data-value="6"><i class="fa fa-birthday-cake" aria-hidden="true"></i><span>Kids Parties</span></li>
                                        <li data-value="15"><i class="fa fa-glass" aria-hidden="true"></i><span>Functions</span></li>
                                        <li data-value="3"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Coaching</span></li>
                                        <li data-value="4"><i class="fa fa-handshake-o" aria-hidden="true"></i><span>Corporate Events</span></li>
                                        <li data-value="20"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Bubble Football Parties</span></li>
                                        <li data-value="40"><i class="fa fa-futbol-o" aria-hidden="true"></i><span>Nerf Parties</span></li>

                                        <li data-value="1"><i class="fa fa-envelope-open" aria-hidden="true"></i><span>General Enquiry</span></li> -->

                                    </ul>
                                    <input readonly="readonly" required="" type="text" name="enquire-select-an-interest" id="enquire-select-an-interest" value="" class="no-event" placeholder="Select an interest" aria-required="true">

                                    <input type="hidden" value="15" name="interest-sc" class="input-value" id="interest-sc">

                                </div>
                            </div>
					</div>
					<div class="col-md-2">
						<button class="button">Search Now</button>
					</div>
			</form>
		
	</div>
</div>


<div class="container-content-image style-  position-">
    <div class="container">
        <div class="row is-flex">
            <div class="col-md-6 container-content-image-image-container">
                <div class="container-content-image-image-container-image"  style="background-image:url()">
                </div>
            </div>
            <div class="col-md-6 container-content-image-content-container">
                    <h4>Flexible learning taught by working experts.</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem veniam sapiente deleniti tenetur saepe nesciunt laborum iusto voluptates accusamus non, eligendi alias officiis, porro nihil sunt, in odit rerum ad?
                    	</p>
                   
                    <div class="logo-box">
                    	<img src="<?php bloginfo('template_url');?>/assets/img/steinberg.png" alt="">
                    	<img src="<?php bloginfo('template_url');?>/assets/img/chichester.png" alt="">
                    	<img src="<?php bloginfo('template_url');?>/assets/img/ludo.png" alt="">
                    </div>
            </div>
        </div>
    </div>
</div>


<div class="horizontal-scrolling background-purple container-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<header class="header-with-toolbar">
					<h4>Popular Courses</h4>
					<ul>
						<li>Film & TV</li>
						<li>Games</li>
						<li>Music</li>
					</ul>
				</header>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
			<div class="horizontal-scrolling-element">
				<div class="card ">
					<div class="card-image"></div>
					<div class="card-content text-align-center">
						<h5>How To Write Music</h5>
						<h6>Only <strong>£49 </strong></h6>
						<div class="card-content-hidden">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe error quis eligendi quidem perferendis nam laudantium voluptate itaque nemo aliquid. Illo, suscipit, iste. Magni molestiae incidunt amet fugiat, harum voluptatum.</p>
							<a href="" class="button button-pink">View Course</a>
						</div>
					</div>
				</div>
				
			</div>
			</div>
		</div>
		<div class="row button-row">
			<a href="" class="button">See all courses</a>
		</div>
	</div>
</div>


<div class="horizontal-scrolling-media background-pink container-padding" >
	<div class="container">
		<div class="row">
			<header><h3>Tutorials, Reviews &amp; Interviews</h3></header>
		</div>
		<div class="row">
			<div class="video">
				VIDEO
			</div>
		</div>
		<div class="row button-row">
			<a href="'" class="button">See all tutorials</a>
		</div>
	</div>
</div>

<div class="free-download container-padding background-black text-align-center" >
	<div class="container">
		<div class="row">
			<header> 
				<h5>Start your composing career today with our</h5>
				<h2>FREE GUIDE</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum, deleniti nemo assumenda, libero perferendis, dolore magni officiis aperiam ratione magnam autem, molestias explicabo quos esse dolorem provident ipsam? Quo, quisquam!</p>
				<form action="">
					<input type="text" placeholder="Enter your email address">
				</form>
				<div class="logo-box">
					<img src="" alt="">
				</div>

			</header> 
		</div>
	</div>
</div>
<div class="follow-us container-padding text-align-center">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<header>
					<h5>Keep in touch</h5>
					<h3>Newsletter</h3>
				</header>
			</div>
			<div class="col-md-6">
				<header>
					<h5>Follow us on</h5>
					<h3>Social Media</h3>
				</header>
				<ul class="social-media">
					<li class="fa fa-facebook"></li>
					<li class="fa fa-twitter"></li>
					<li class="fa fa-soundcloud"></li>
					<li class="fa fa-youtube"></li>
				</ul>
			</div>
		</div>
	</div>
</div>

<div class="filter-container">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul>
					<li><a href="">Film & TV </a></li>
					<li><a href="">Film & TV </a></li>
					<li><a href="">Film & TV </a></li>
				</ul>
			</div>

		</div>
	</div>
</div>

<div class="page-banner">
	<div class="container">
		<div class="row is-flex">
			<div class="col-md-6 page-banner-image">
				<div class="page-banner-image-image">
					
				</div>

			</div>
			<div class="col-md-6">
				<div class="page-banner-content">
					<h5>Discover Our</h5>
					<h1>Online Master's Degree Courses</h1>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="faq-container container-padding">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php for ($i = 0; $i< 10; $i++) { ?>
				<div class="faq-element">
					<div class="faq-element-header"><h4>FAQ Header</h4></div>
					<div class="faq-element-content">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum dolorum expedita iure possimus neque eum libero. Praesentium nesciunt eligendi blanditiis, obcaecati nulla, libero, minus eum magni numquam consectetur dolorem eveniet.</p>
					</div> 

</div>
<?php }?>

			</div>
		</div>
	</div>
</div>

<div class="card-grid">
	<div class="container">
		<div class="row">
										<?php for ($i = 0; $i< 10; $i++) { ?>

			<div class="col-md-3 col-xs-6">
			<div class="card">
				<div class="card-image card-image-landspace" style="background-color:purple;"></div>
				<div class="card-content text-align-center">
					<h5>Tutor Name</h5>
					<h6>Subtitle</h6>
					<hr class="background-blue">
					<p>short description</p>
				</div>
			</div>
			</div>
		<?php }?>
		</div>
	</div>
</div>

<div class="card-grid">
	<div class="container">
		<div class="row">
							<?php for ($i = 0; $i< 10; $i++) { ?>

			<div class="col-md-3 col-xs-6">
			<div class="card">
				<div class="card-image" style="background-color:purple;"></div>
				<div class="card-content text-align-center">
					<h5>Blog Name</h5>
					<h6>Subtitle</h6>
					<hr class="background-blue">
				</div>
			</div>
			</div>
		<?php }?>
		</div>
	</div>
</div>

<div class="contact-container">
	<div class="container">
	<div class="row">
		<div class="col-md-6">
		
			
		</div>
		<div class="col-md-6">
			
		</div>
	</div>
	</div>
</div>
<?php get_footer(); ?>