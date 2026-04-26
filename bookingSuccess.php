<?php
// Database connection using Railway environment variables
$servername = getenv('MYSQLHOST');
$username   = getenv('MYSQLUSER');
$password   = getenv('MYSQLPASSWORD');
$dbname     = getenv('MYSQLDATABASE');
$port       = getenv('MYSQLPORT');

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed");
}

// Get the booking ID from the URL
$bid = isset($_GET['bid']) ? $conn->real_escape_string($_GET['bid']) : 0;

// Fetch the booking details
$sql = "SELECT * FROM natc_booking WHERE booking_id='$bid' LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $res = $result->fetch_assoc();
    $currentStatus = $res['status']; // This is the crucial part
} else {
    header("Location: index.php");
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="img/fav.png">
    <meta charset="UTF-8">
    <title>NATC - Booking Success</title>

    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/main.css">
    
    <?php if($currentStatus == 1): ?>
    <script>
        // Refresh every 5 seconds only while status is Awaiting (1)
        setTimeout(function(){
           location.reload();
        }, 5000);
    </script>
    <?php endif; ?>
</head>

<body>
    <header id="header">
        <div class="container main-menu">
            <div class="row align-items-center justify-content-between d-flex">
                <a href="index.php"><img src="img/logo.png" alt="NATC Logo" /></a>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="rates.php">Rates</a></li>
                        <li><a href="tracking.php">Tracking</a></li>
                        <li><a href="contact.php">Contact</a></li>
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
                    <h1 class="text-white">Booking Success</h1>
                    <p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="#"> Success</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="image-booking-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4" style="background: whitesmoke; padding: 20px; border-radius: 5px;">
                    <h4>Booking Details</h4>
                    <table class="table table-sm mt-3">
                        <tr><th>Name:</th><td><?php echo htmlspecialchars($res['name']); ?></td></tr>
                        <tr><th>Phone:</th><td><?php echo htmlspecialchars($res['phone']); ?></td></tr>
                        <tr><th>Pick-Up:</th><td><?php echo htmlspecialchars($res['pickup']); ?></td></tr>
                        <tr><th>Date:</th><td><?php echo htmlspecialchars($res['booking_date']); ?></td></tr>
                    </table>
                </div>

                <div class="col-lg-4 col-md-4" style="background: whitesmoke; padding: 20px; border-radius: 5px;">
                    <h4>Vehicle Details</h4>
                    <table class="table table-sm mt-3">
                        <tr><th>Vehicle:</th><td><?php echo htmlspecialchars($res['vehicle_type']); ?></td></tr>
                        <tr><th>Passengers:</th><td><?php echo htmlspecialchars($res['passengers']); ?></td></tr>
                        <tr><th>Luggage:</th><td><?php echo htmlspecialchars($res['luggage']); ?></td></tr>
                        <tr><th>Notes:</th><td><?php echo htmlspecialchars($res['notes']); ?></td></tr>
                    </table>
                </div>

                <div class="col-lg-4 col-md-4" style="background: #e9ecef; padding: 20px; border-radius: 5px;">
                    <h4>Live Status</h4>
                    <table class="table table-sm mt-3">
                        <tr><th>Booking No:</th><td><strong><?php echo $res['booking_no']; ?></strong></td></tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <?php 
                                    if ($currentStatus == 1) {
                                        echo "<span class='badge' style='background-color: #ffc107; color: black; padding: 8px;'>Awaiting Confirmation</span>";
                                    } elseif ($currentStatus == 2) {
                                        echo "<span class='badge' style='background-color: #28a745; color: white; padding: 8px;'>Confirmed</span>";
                                    } elseif ($currentStatus == 3) {
                                        echo "<span class='badge' style='background-color: #dc3545; color: white; padding: 8px;'>Rejected</span>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php if($currentStatus == 2): ?>
                        <tr><th>Driver:</th><td>Ready to assist</td></tr>
                        <tr><th>Plate:</th><td>On the way</td></tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <section class="home-calltoaction-area relative">
        <div class="container">
            <div class="overlay overlay-bg"></div>
            <div class="row align-items-center section-gap">
                <div class="col-lg-8">
                    <h1>Experience Great Support</h1>
                    <p>
                        Providing market-leading standards in the field of vehicle rental services, 
                        Nasugbu Airport Transport Corp. offers Sedan, AUV, SUV and Van for daily 
                        rental or to meet corporate requirements. Customers can be confident of 
                        finding a tailor-made solution to their needs and budgets.
                    </p>
                    <p style="font-size: 0.8em; opacity: 0.7;">
                        Website made by: Andrei Capili (BSCPE 4-1)
                    </p>
                </div>
                <div class="col-lg-4 btn-left">
                    <a href="contact.php" class="primary-btn">Reach Our Support Team</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-area section-gap">
        <div class="container text-center">
            <p class="footer-text">Copyright &copy;<?php echo date('Y'); ?> Nasugbu Airport Transport Corp.</p>
        </div>
    </footer>

    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
</body>
</html>