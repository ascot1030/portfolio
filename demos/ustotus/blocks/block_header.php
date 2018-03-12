<?php
	if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];
	$current_page = basename($PHP_SELF);
?>
			<div class="header">
				<div class="container">
					<!-- Logo -->
					<a class="logo" href="http://ustotus.co" target="_blank" title="Go to Real Site"> <img src="assets/img/logo.png" alt="TOTUS Investments"> </a>
					<!-- End Logo -->

					<!-- Topbar -->
					<div class="topbar">
						<ul class="loginbar pull-right">
							<li>
								<a href="login.php">Login</a>
								or
								<a href="signup.php">Register</a>
							</li>
						</ul>
					</div>
					<!-- End Topbar -->

					<!-- Toggle get grouped for better mobile display -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="fa fa-bars"></span>
					</button>
					<!-- End Toggle -->
				</div><!--/end container-->

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse mega-menu navbar-responsive-collapse">
					<div class="container">
						<ul class="nav navbar-nav">
							<!-- Home -->
							<li class="<?php echo ($current_page == 'index.php' ? 'active' : ''); ?>">
								<a href="index.php"> Home </a>
							</li>
							<!-- End Home -->

							<!-- Who we are -->
							<li class="dropdown <?php echo (($current_page == 'who-we-are.php' || $current_page == 'our-firm.php' || $current_page == 'leadership-team.php') ? 'active' : ''); ?>">
								<a href="who-we-are.php"> Who We Are </a>
								<ul class="dropdown-menu">
									<li class="<?php echo ($current_page == 'our-firm.php' ? 'active' : ''); ?>"><a href="our-firm.php">Our Firm</a></li>
									<li class="<?php echo ($current_page == 'leadership-team.php' ? 'active' : ''); ?>"><a href="leadership-team.php">Leadership Team</a></li>
								</ul>
							</li> 
							<!-- End Who we are -->
							
							<!-- What We Do -->
							<li class="<?php echo ($current_page == 'what-we-do.php' ? 'active' : ''); ?>">
								<a href="what-we-do.php"> What We Do </a>
							</li>
							<!-- End What We Do -->
							
							<!-- Investors Portal -->
							<li class="<?php echo ($current_page == 'investors-portal.php' ? 'active' : ''); ?>">
								<a href="investors-portal.php"> Investors Portal </a>
							</li>
							<!-- End Investors Portal -->
							
							<!-- Blog -->
							<li class="<?php echo ($current_page == 'news.php' ? 'active' : ''); ?>">
								<a href="news.php"> News </a>
							</li>
							<!-- End Blog -->
							
							<!-- Contact US -->
							<li class="<?php echo ($current_page == 'contact.php' ? 'active' : ''); ?>">
								<a href="contact.php"> Contact </a>
							</li>
							<!-- End Contact US -->
							
						</ul>
					</div><!--/end container-->
				</div><!--/navbar-collapse-->
			</div>
			<!--=== End Header ===-->