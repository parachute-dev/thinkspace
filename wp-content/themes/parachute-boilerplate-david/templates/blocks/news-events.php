		<!-- NEWS AND EVENTS -->
		<div class="container-fluid news-events-container">
			<div class="row">
				<div class="container">
					<div class="row">
						<div class="news-events">
							<!-- HEADER -->
							<div class="news-events-header">
								<h2>News &amp; Events</h2>
								<h5>
									<a href="#!">VIEW ALL</a>
								</h5>
							</div>
						</div>
						<!-- CONTENT -->
						<div class="row">


							<?php for ($i=0; $i < 2; $i++) { ?>

								<div class="col-md-6 col-xs12">
									<div class="news-events-block">
										<div class="news-events-img" style="background-image:url('<?php echo get_template_directory_uri();?>/assets/img/news-<?php echo $i?>.jpg');">
										</div>
										<div class="news-events-inner-content">
											<!-- CONTENT wrapper-->
											<div class="news-events-inner-wrapper">

												<!-- DATE -->
												<div class="news-events-date">
													<h6>POSTED 2 DAYS AGO</h6>
												</div>
												<!-- TITLE -->
												<div class="news-events-title">
													<h3>snow factor birthday park-y</h3>
												</div>
												<!-- CONTENT -->
												<div class="news-events-content">
													<p>
														Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
													tempor incididunt ut labore et dolore magna ostrud exer tempor </br>
													incididunt ut labore et dolore magna ostrud exer tempor incididunt ut labore et dolore magna ostrud exer
												</p>
											</div>
										</div>

										<!-- buttn link -->
										<div class="news-events-content-link">
											<a href="#!">
												<i class="fa fa-plus"></i>
											</a>
										</div>

									</div>

								</div>
							</div>

						<?php } ?>


					</div>
				</div>
			</div>
		</div>

	</div>