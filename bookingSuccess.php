	<!DOCTYPE html>
	<html lang="zxx" class="no-js">
	<head>
		<!-- Mobile Specific Meta -->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Favicon-->
		<link rel="shortcut icon" href="img/fav.png">
		<!-- Author Meta -->
		<meta name="author" content="colorlib">
		<!-- Meta Description -->
		<meta name="description" content="">
		<!-- Meta Keyword -->
		<meta name="keywords" content="">
		<!-- meta character set -->
		<meta charset="UTF-8">
		<!-- Site Title -->
		<title>Taxi</title>

		<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
			<!--
			CSS
			============================================= -->
			<link rel="stylesheet" href="css/linearicons.css">
			<link rel="stylesheet" href="css/font-awesome.min.css">
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/magnific-popup.css">
			<link rel="stylesheet" href="css/nice-select.css">
			<link rel="stylesheet" href="css/animate.min.css">
			<link rel="stylesheet" href="css/jquery-ui.css">
			<link rel="stylesheet" href="css/main.css">
		</head>
		<body>
			  <header id="header">
		  		<div class="header-top">
				</div>
			    <div class="container main-menu">
			    	<div class="row align-items-center justify-content-between d-flex">
			    		<a href="index.html"><img src="img/logo.png" alt="" title="" /></a>
						<nav id="nav-menu-container">
							<ul class="nav-menu">
							  <li class="menu-active"><a href="index.html">Home</a></li>
							  <li><a href="about.html">About</a></li>
							  <li><a href="rates.html">Rates</a></li>
                                <li><a href="tracking.html">Tracking</a></li>
							  <li><a href="contact.html">Contact</a></li>
							</ul>
						</nav><!-- #nav-menu-container -->
			    	</div>
			    </div>
			  </header><!-- #header -->
			<!-- start banner Area -->
			<section class="banner-area relative about-banner" id="home">
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white">
								Booking <br/> Success
							</h1>
							<p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="gallery.html"> Booking Success</a></p>
						</div>
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start image-gallery Area -->
			<section class="image-booking-area">
                <br/>
                <?php
                $servername = getenv('MYSQLHOST');
				$username   = getenv('MYSQLUSER');
				$password   = getenv('MYSQLPASSWORD');
				$dbname     = getenv('MYSQLDATABASE');
				$port       = getenv('MYSQLPORT');

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname, $port);
                $sql = "SELECT * FROM natc_booking WHERE booking_id={$_GET['bid']} limit 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
//                        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                        $res = $row;
                    }
                }
                $conn->close();
                ?>
				<div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 header-right" style="background: whitesmoke !important; border: none !important; text-align: left !important;">
                            <div>
                                <h4>Booking Details</h4>
                                <br/>
                                <table class="table table-responsive">
                                    <tr>
                                        <th scope="row">Name:</th>
                                        <td><?php echo $res['name']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone:</th>
                                        <td><?php echo $res['phone']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td><?php echo $res['email']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pick-Up:</th>
                                        <td><?php echo $res['pickup']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date:</th>
                                        <td><?php echo $res['booking_date']?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 header-right" style="background: whitesmoke !important; border: none !important; text-align: left !important;">
                            <div>
                                <h4>Vehicle Details</h4>
                                <br/>
                                <table class="table">
                                    <tr>
                                        <th scope="row">Vehicle:</th>
                                        <td><?php echo $res['vehicle_type']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Passengers:</th>
                                        <td><?php echo $res['passengers']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Luggage:</th>
                                        <td><?php echo $res['luggage']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Notes:</th>
                                        <td><?php echo $res['notes']?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-4  col-md-4 header-right" style="background: whitesmoke !important; border: none !important; text-align: left !important;">
                            <div>
                                <h4>Booking Status</h4>
                                <br/>
                                <table class="table">
                                    <tr>
                                        <th scope="row">Booking No.:</th>
                                        <td><?php echo $res['booking_no']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Status:</th>
                                        <td>Awaiting Confirmation</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Driver Name:</th>
                                        <td>None</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Plate No.:</th>
                                        <td>None</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <br/>
			</section>
			<!-- End image-gallery Area -->

			<!-- Start home-calltoaction Area -->
			<section class="home-calltoaction-area relative">
				<div class="container">
					<div class="overlay overlay-bg"></div>
					<div class="row align-items-center section-gap">
						<div class="col-lg-8">
							<h1>Experience Great Support</h1>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore  et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
							</p>
						</div>
						<div class="col-lg-4 btn-left">
							<a href="#" class="primary-btn">Reach Our Support Team</a>
						</div>
					</div>
				</div>
			</section>
			<!-- End home-calltoaction Area -->

			<!-- start footer Area -->
			<footer class="footer-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Quick links</h6>
								<ul>
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Brand Assets</a></li>
									<li><a href="#">Investor Relations</a></li>
									<li><a href="#">Terms of Service</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Features</h6>
								<ul>
									<li><a href="#">Jobs</a></li>
									<li><a href="#">Brand Assets</a></li>
									<li><a href="#">Investor Relations</a></li>
									<li><a href="#">Terms of Service</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Resources</h6>
								<ul>
									<li><a href="#">Guides</a></li>
									<li><a href="#">Research</a></li>
									<li><a href="#">Experts</a></li>
									<li><a href="#">Agencies</a></li>
								</ul>
							</div>
						</div>
						<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
							<div class="single-footer-widget">
								<h6>Follow Us</h6>
								<p>Let us be social</p>
								<div class="footer-social d-flex align-items-center">
									<a href="#"><i class="fa fa-facebook"></i></a>
									<a href="#"><i class="fa fa-twitter"></i></a>
									<a href="#"><i class="fa fa-dribbble"></i></a>
									<a href="#"><i class="fa fa-behance"></i></a>
								</div>
							</div>
						</div>
						<div class="col-lg-4  col-md-6 col-sm-6">
							<div class="single-footer-widget">
								<h6>Newsletter</h6>
								<p>Stay update with our latest</p>
								<div class="" id="mc_embed_signup">
									<form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
										<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
			                            	<button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
			                            	<div style="position: absolute; left: -5000px;">
												<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
											</div>

										<div class="info"></div>
									</form>
								</div>
							</div>
						</div>
						<p class="mt-80 mx-auto footer-text col-lg-12">
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This design is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						</p>
					</div>
				</div>
				<img class="footer-bottom" src="img/footer-bottom.png" alt="">
			</footer>
			<!-- End footer Area -->

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
  			<script src="js/easing.min.js"></script>
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.min.js"></script>
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>
 			<script src="js/jquery-ui.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>
			<script src="js/mail-script.js"></script>
			<script src="js/main.js"></script>
		</body>
	</html>