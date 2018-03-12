<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<!-- Cloned by RabinsXP.com-->
	<head>
		<title>Our Firm | TOTUS</title>

		<?php include_once("blocks/meta_tags.php"); ?>
		<?php include_once("blocks/css.php"); ?>
		
		<!-- CSS Page Style -->
		<link rel="stylesheet" href="assets/plugins/fancybox/source/jquery.fancybox.css">
		<link rel="stylesheet" href="assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
	</head>

	<body>
		<div class="wrapper">
			<?php include_once("blocks/block_header.php"); ?>

			<!--=== Breadcrumbs v3 ===-->
			<div class="breadcrumbs-v3 img-v5 text-center breadcrumbs-lg">
				<div class="container">
					<h1>Our Firm</h1>
				</div><!--/end container-->
			</div>
			<!--=== End Breadcrumbs v3 ===-->

			<!--=== Container Part ===-->
			<div>
				<div class="container content-sm">
					<div class="headline-center margin-bottom-60">
						<h2>Our Firm</h2>
						<p>
							You have important goals.
							<br/>
							Our team of trusted investment advisors can help you preserve and grow your wealth.
							<br/>
							We manage and administer your investment portfolio according to your long-term goals.
						</p>
					</div>
	
					<div class="owl-video">
						<div class="item">
							<a class="fbox-modal fancybox.iframe" href="http://player.vimeo.com/video/72343553"> 
								<img class="img-responsive" width="800" src="assets/img/main/img12.jpg" alt=""> 
								<img class="video-play" src="assets/img/icons/video-play.png" alt=""> 
							</a>
						</div>
						<div class="item">
							<a class="fbox-modal fancybox.iframe" href="https://www.youtube.com/embed/C9thrGPyN-k?rel=0&amp;showinfo=0"> 
								<img class="img-responsive" width="800" src="assets/img/main/img20.jpg" alt=""> 
								<img class="video-play" src="assets/img/icons/video-play.png" alt="">
							</a>
						</div>
					</div><!--/end owl video-->
				</div>
			</div>
			<!--=== End Container Part ===-->
			<?php include_once 'blocks/block_footer.php'; ?>
		</div><!--/wrapper-->

		<?php include_once 'blocks/js.php'; ?>
		<!-- JS Page Level -->
		<script type="text/javascript" src="assets/plugins/jquery-appear.js"></script>
		<script type="text/javascript" src="assets/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
		<script type="text/javascript" src="assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
		<script type="text/javascript" src="assets/js/plugins/fancy-box.js"></script>
		<script type="text/javascript" src="assets/js/plugins/owl-carousel.js"></script>
		<script type="text/javascript">
			function pageInit() {
				FancyBox.initFancybox();
				OwlCarousel.initOwlCarousel();
			};
		</script>

	</body>

	<!-- Cloned by RabinsXP.com-->
</html>
