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
			    		<a href="index.php"><img src="img/logo.png" alt="NATC Logo" title="NATC" /></a>
						<nav id="nav-menu-container">
							<ul class="nav-menu">
								<li class="menu-active"><a href="index.php">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="rates.php">Rates</a></li>
								<li><a href="tracking.html">Tracking</a></li>
								<li><a href="contact.html">Contact</a></li>
							    <ul class="nav-menu">
								<li class="menu-active"><a href="index.php">Home</a></li>
								<li><a href="about.html">About</a></li>
								<li><a href="rates.php">Rates</a></li>
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
								Book a Car
							</h1>	
							<p class="text-white link-nav"><a href="index.html">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="gallery.html"> Book a Car</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->	

			<!-- Start image-gallery Area -->
			<section class="image-booking-area">
                <br/>
				<div class="container">
                    <div class="row">
                        <?php if(isset($_POST)){ ?>
                        <div class="col-lg-6 col-md-6 header-right" style="background: transparent !important; border: none !important; text-align: left !important;">

                            <div>
                                <h4>Booking Details</h4>
                                <br/>
                                <table class="table table-responsive">
                                    <tr>
                                        <th scope="row">Name:</th>
                                        <td><?php echo $_POST['name']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Phone:</th>
                                        <td><?php echo $_POST['phone']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Email:</th>
                                        <td><?php echo $_POST['email']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pick-Up:</th>
                                        <td><?php echo $_POST['pickup']?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Date:</th>
                                        <td><?php echo $_POST['date']?></td>
                                    </tr>
                                </table>
                                <a href="#" onclick="history.back()" class="primary-btn text-uppercase">Reset and Go Back</a>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="col-lg-6  col-md-6 header-right" style="background: #bde6e2 !important; border: none !important;">
                            <div style="text-align: left">
                                <h4>Select Vehicle</h4>
                            </div>
                            <br/>
                            <form class="form" method="post" action="https://natcback-production.up.railway.app/addBooking.php">
                                <?php
                               $servername = getenv('MYSQLHOST');
							   $username = getenv('MYSQLUSER');
						       $password = getenv('MYSQLPASSWORD');
							   $dbname = getenv('MYSQLDATABASE');
							   $port = getenv('MYSQLPORT');

							// Update the connection line to include the port
							$conn = new mysqli($servername, $username, $password, $dbname, $port);
                                // Create connection
                                $sql = "SELECT * FROM natc_destination_rates";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
//                        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                                        $res[] = $row;
                                    }
                                }
                                $conn->close();
                                ?>
                                <input type="hidden" name="name" value="<?php echo $_POST['name']?>"/>
                                <input type="hidden" name="phone" value="<?php echo $_POST['phone']?>"/>
                                <input type="hidden" name="email" value="<?php echo $_POST['email']?>"/>
                                <input type="hidden" name="pickup" value="<?php echo $_POST['pickup']?>"/>
                                <input type="hidden" name="date" value="<?php echo $_POST['date']?>"/>
                                <div class="form-group">
                                    <div class="default-select" id="default-select">
                                        <select name="vehicle" required>
                                            <option value="" disabled selected hidden>Vehicle Type</option>
<!--                                            <option value="Sedan">Sedan</option>-->
<!--                                            <option value="SUV">SUV</option>-->
                                            <option value="Van">Van</option>
                                            <option value="Innova">Innova</option>
<!--                                            <option value="Luxury">Luxury</option>-->
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="default-select" id="default-select">
                                        <select name="destination" required>
                                            <option value="" disabled selected hidden>Destination</option>
                                            <?php foreach($res as $dest){?>
                                                <option value="<?php echo $dest['dr_id']?>"><?php echo $dest['dr_destination']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <a href="rates.html" target="_blank">Area Rates (Click here!)</a>
                                </div>
                                <div class="from-group">
                                    <input class="form-control txt-field" type="number" required name="passengers" placeholder="How many Passengers?" onfocus="this.placeholder = ''" onblur="this.placeholder = 'How many Passengers?'">
                                    <input class="form-control txt-field" type="number" required name="luggage" placeholder="How many Luggage?" onfocus="this.placeholder = ''" onblur="this.placeholder = 'How many Luggage?'">
                                </div>
                                <div class="from-group">
                                    <textarea class="form-control txt-field" type="number" required name="notes" placeholder="Notes to Driver" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Notes to Driver'"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-default btn-lg btn-block text-center text-uppercase">Finalize Booking</button>
                                </div>
                            </form>
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
									<form action="https://formsubmit.co/andreinituyacapili@gmail.com" method="POST" class="form-inline">
									<input class="form-control" name="email" placeholder="Enter Email" required="" type="email">
									<button class="click-btn btn btn-default"><span class="lnr lnr-arrow-right"></span></button>
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