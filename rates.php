<?php
// Database connection using Railway environment variables
$servername = getenv('MYSQLHOST');
$username   = getenv('MYSQLUSER');
$password   = getenv('MYSQLPASSWORD');
$dbname     = getenv('MYSQLDATABASE');
$port       = getenv('MYSQLPORT');

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM natc_destination_rates";
$result = $conn->query($sql);
$res = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $res[] = $row;
    }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>NATC - Rates</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>  
    <header id="header">
        <div class="container main-menu">
            <div class="row align-items-center justify-content-between d-flex">
                <a href="index.php"><img src="img/logo.png" alt="NATC Logo" title="" /></a>     
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.html">About</a></li>
                        <li class="menu-active"><a href="rates.php">Rates</a></li>
                        <li><a href="tracking.html">Tracking</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>      
            </div>
        </div>
    </header>
      
    <section class="banner-area relative about-banner" id="home">   
        <div class="overlay overlay-bg"></div>
        <div class="container">             
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">RATES</h1>   
                    <p class="text-white link-nav"><a href="index.php">Home </a>  <span class="lnr lnr-arrow-right"></span>  <a href="rates.php"> RATES</a></p>
                </div>  
            </div>
        </div>
    </section>

    <section class="home-about-area section-gap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 about-right">
                    <h1>DESTINATION RATES</h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Location</th>
                                <th>Innova</th>
                                <th>Van</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($res as $dest){ ?>
                            <tr>
                                <td>
                                    <b><?php echo htmlspecialchars($dest['dr_destination']); ?></b> <br/>
                                    <small><?php echo htmlspecialchars($dest['dr_locations']); ?></small>
                                </td>
                                <td>₱<?php echo number_format($dest['dr_rate_innova'], 2); ?></td>
                                <td>₱<?php echo number_format($dest['dr_rate_van'], 2); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
    </section>

    <footer class="footer-area section-gap">
        <div class="container">
            <p class="footer-text col-lg-12">
                Copyright &copy;<?php echo date('Y'); ?> All rights reserved | Nasugbu Airport Transport Corp.
            </p>                            
        </div>
    </footer>   

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>   
    <script src="js/main.js"></script>  
</body>
</html>