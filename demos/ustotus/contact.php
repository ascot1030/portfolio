<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<!-- Cloned by RabinsXP.com-->
	<head>
		<title>Our Contacts | TOTUS</title>

		<?php include_once("blocks/meta_tags.php"); ?>
		<?php include_once("blocks/css.php"); ?>

		<!-- CSS Page Style -->
		<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
		<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms.css">
		<link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/custom/custom-sky-forms.css">
		<!--[if lt IE 9]><link rel="stylesheet" href="assets/plugins/sky-forms-pro/skyforms/css/sky-forms-ie8.css"><![endif]-->
		<link rel="stylesheet" href="assets/css/pages/page_contact.css">
	</head>

	<body>
		<div class="wrapper">
			<?php include_once("blocks/block_header.php"); ?>

			<!--=== Breadcrumbs v3 ===-->
			<div class="breadcrumbs-v3 img-v4 text-center breadcrumbs-lg">
				<div class="container">
					<h1>Contact Us</h1>
				</div><!--/end container-->
			</div>
			<!--=== End Breadcrumbs v3 ===-->			

			<!--=== Content Part ===-->
			<div class="container content">
				<div class="row margin-bottom-30">
					<div class="col-md-9 mb-margin-bottom-30">
						<div class="headline">
							<h2>Contact Us</h2>
						</div>
						<p>
							For more information, please contact us using the form below.
						</p>
						<br />

						<form action="http://htmlstream.com/preview/unify-v1.9/assets/php/sky-forms-pro/demo-contacts-process.php" method="post" id="sky-form3" class="sky-form contact-style">
							<fieldset class="no-padding">
								<label>Name <span class="color-red">*</span></label>
								<div class="row sky-space-20">
									<div class="col-md-7 col-md-offset-0">
										<div>
											<input type="text" name="name" id="name" class="form-control">
										</div>
									</div>
								</div>

								<label>Email <span class="color-red">*</span></label>
								<div class="row sky-space-20">
									<div class="col-md-7 col-md-offset-0">
										<div>
											<input type="text" name="email" id="email" class="form-control">
										</div>
									</div>
								</div>

								<label>Message <span class="color-red">*</span></label>
								<div class="row sky-space-20">
									<div class="col-md-11 col-md-offset-0">
										<div>
											<textarea rows="8" name="message" id="message" class="form-control"></textarea>
										</div>
									</div>
								</div>

								<p>
									<button type="submit" class="btn-u">
										Send Message
									</button>
								</p>
							</fieldset>

							<div class="message">
								<i class="rounded-x fa fa-check"></i>
								<p>
									Your message was successfully sent!
								</p>
							</div>
						</form>
					</div><!--/col-md-9-->

					<div class="col-md-3">
						<!-- Contacts -->
						<div class="headline">
							<h2>Contact</h2>
						</div>
						<ul class="list-unstyled who margin-bottom-30">
							<li>
								<a href="#">
									<i class="fa fa-home"></i>1055 West 7th St., 33rd Floor
									<br/>
									<i class="fa"></i>Los Angeles, CA 90017
								</a>
							</li>
							<li>
								<a href="#"><i class="fa fa-phone"></i>213-232-1683</a>
							</li>
							<li>
								<a href="mailto:info@ustotus.com"><i class="fa fa-envelope"></i>info@ustotus.com</a>
							</li>
						</ul>

						<!-- Business Hours -->
						<div class="headline">
							<h2>Business Hours</h2>
						</div>
						<ul class="list-unstyled margin-bottom-30">
							<li>
								<strong>Monday-Friday:</strong> 9am to 5pm
							</li>
							<li>
								<strong>Saturday-Sunday:</strong> Closed
							</li>
						</ul>
						
						<!-- Google Map -->
            <div id="map" class="map map-box map-box-space1"></div><!---/map-->
            <!-- End Google Map -->
					</div><!--/col-md-3-->
				</div><!--/row-->
			</div><!--/container-->
			<!--=== End Content Part ===-->

			<?php include_once("blocks/block_footer.php"); ?>
		</div><!--/wrapepr-->

		<?php include_once 'blocks/js.php'; ?>
		<!-- JS Page Level -->
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
		<script type="text/javascript" src="assets/plugins/gmap/gmap.js"></script>
		<script type="text/javascript" src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
		<script type="text/javascript" src="assets/plugins/sky-forms-pro/skyforms/js/jquery.form.min.js"></script>
		<script type="text/javascript" src="assets/plugins/sky-forms-pro/skyforms/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/forms/contact.js"></script>
		<script type="text/javascript" src="assets/js/pages/page_contacts.js"></script>
		<script type="text/javascript" src="assets/js/plugins/owl-carousel.js"></script>
		<script type="text/javascript">
			function pageInit() {
				ContactPage.initMap();
				ContactForm.initContactForm();
				OwlCarousel.initOwlCarousel();
			}
		</script>
		<!--[if lt IE 9]>
		<script src="assets/plugins/sky-forms-pro/skyforms/js/sky-forms-ie8.js"></script>
		<![endif]-->
		<!--[if lt IE 10]>
		<script src="assets/plugins/sky-forms-pro/skyforms/js/jquery.placeholder.min.js"></script>
		<![endif]-->

	</body>

	<!-- Cloned by RabinsXP.com-->
</html>
