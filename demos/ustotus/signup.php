<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
	<!--<![endif]-->

	<!-- Cloned by RabinsXP.com-->
	<head>
		<title>Registration | TOTUS</title>

		<?php include_once("blocks/meta_tags.php"); ?>
		<?php include_once("blocks/css.php"); ?>
		
		<!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/page_log_reg_v1.css">
	</head>

	<body>
		<div class="wrapper">
			<?php include_once("blocks/block_header.php"); ?>

			<!--=== Breadcrumbs ===-->
			<div class="breadcrumbs">
				<div class="container">
					<h1 class="pull-left">Registration</h1>
					<ul class="pull-right breadcrumb">
						<li>
							<a href="index.php">Home</a>
						</li>
						<li class="active">
							Registration
						</li>
					</ul>
				</div><!--/container-->
			</div><!--/breadcrumbs-->
			<!--=== End Breadcrumbs ===-->

			<!--=== Content Part ===-->
			<div class="container content">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
						<form class="reg-page">
							<div class="reg-header">
								<h2>Register a new account</h2>
								<p>
									Already Signed Up? Click <a href="login.php" class="color-green">Sign In</a> to login your account.
								</p>
							</div>

							<label>First Name</label>
							<input type="text" class="form-control margin-bottom-20">

							<label>Last Name</label>
							<input type="text" class="form-control margin-bottom-20">

							<label>Email Address <span class="color-red">*</span></label>
							<input type="text" class="form-control margin-bottom-20">

							<div class="row">
								<div class="col-sm-6">
									<label>Password <span class="color-red">*</span></label>
									<input type="password" class="form-control margin-bottom-20">
								</div>
								<div class="col-sm-6">
									<label>Confirm Password <span class="color-red">*</span></label>
									<input type="password" class="form-control margin-bottom-20">
								</div>
							</div>

							<hr>

							<div class="row">
								<div class="col-lg-6 checkbox">
									<label>
										<input type="checkbox">
										I read <a href="terms.php" class="color-green">Terms and Conditions</a> </label>
								</div>
								<div class="col-lg-6 text-right">
									<button class="btn-u" type="submit">
										Register
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div><!--/container-->
			<!--=== End Content Part ===-->

			<?php include_once("blocks/block_footer.php"); ?>
		</div>

		<?php include_once("blocks/js.php"); ?>

	</body>

	<!-- Cloned by RabinsXP.com-->
</html>
