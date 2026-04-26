<?php 
error_reporting(0); 
// Database Connection
$servername = getenv('MYSQLHOST');
$username   = getenv('MYSQLUSER');
$password   = getenv('MYSQLPASSWORD');
$dbname     = getenv('MYSQLDATABASE');
$port       = getenv('MYSQLPORT');

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($_POST) {
    $bookingNo = $conn->real_escape_string($_POST['bId']);
    
    // 1. Fetch Primary Booking Details
    $sql = "SELECT * FROM natc_booking WHERE booking_no='$bookingNo' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $res = $result->fetch_assoc();
        
        // 2. Fetch Driver/Vehicle Assignment if it exists
        $sql2 = "SELECT c.driver_fullname, d.model, d.plate_no, a.status as assignment_status 
                 FROM natc_assign_booking a
                 INNER JOIN natc_vehicle_driver b ON (a.vd_id = b.vd_id)
                 INNER JOIN natc_driver c ON (b.driver_id = c.driver_id)
                 INNER JOIN natc_vehicles d ON (d.vehicle_id = b.vehicle_id)
                 WHERE a.booking_id='{$res['booking_id']}' LIMIT 1";
        
        $result2 = $conn->query($sql2);
        $res2 = ($result2->num_rows > 0) ? $result2->fetch_assoc() : null;
    } else {
        echo "<script>alert('Tracking Number Not Found'); window.location.href='tracking.html';</script>";
        exit;
    }
} else {
    header("Location: tracking.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <title>NATC - Track Booking</title>

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
            <a href="index.php"><img src="img/logo.png" alt="" title="" /></a>
            <nav id="nav-menu-container">
                <ul class="nav-menu">
                    <li class="menu-active"><a href="index.php">Home</a></li>
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
                <h1 class="text-white">Booking Details</h1>
                <p class="text-white link-nav"><a href="index.php">Home </a> <span class="lnr lnr-arrow-right"></span> <a href="tracking.html"> Tracking</a></p>
            </div>
        </div>
    </div>
</section>

<section class="image-booking-area section-gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4" style="background: #f9f9ff; padding: 20px; border-right: 1px solid #eee;">
                <h4>Passenger Details</h4>
                <table class="table">
                    <tr><th>Name:</th><td><?php echo $res['name']; ?></td></tr>
                    <tr><th>Phone:</th><td><?php echo $res['phone']; ?></td></tr>
                    <tr><th>Pickup:</th><td><?php echo $res['pickup']; ?></td></tr>
                    <tr><th>Date:</th><td><?php echo $res['booking_date']; ?></td></tr>
                </table>
            </div>

            <div class="col-lg-4 col-md-4" style="background: #f9f9ff; padding: 20px; border-right: 1px solid #eee;">
                <h4>Trip Details</h4>
                <table class="table">
                    <tr><th>Vehicle:</th><td><?php echo $res['vehicle_type']; ?></td></tr>
                    <tr><th>Pax:</th><td><?php echo $res['passengers']; ?></td></tr>
                    <tr><th>Luggage:</th><td><?php echo $res['luggage']; ?></td></tr>
                    <tr><th>Rate:</th><td>₱<?php echo number_format($res['booking_fare'], 2); ?></td></tr>
                </table>
            </div>

            <div class="col-lg-4 col-md-4" style="background: #f9f9ff; padding: 20px;">
                <h4>Live Status</h4>
                <table class="table">
                    <tr>
                        <th>Booking No:</th>
                        <td><strong><?php echo $res['booking_no']; ?></strong></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td>
                            <?php 
                                $status = $res['status'];
                                if ($status == 1) echo "<span class='badge badge-warning'>Awaiting Confirmation</span>";
                                elseif ($status == 2) echo "<span class='badge badge-success'>Confirmed</span>";
                                elseif ($status == 3) echo "<span class='badge badge-danger'>Rejected</span>";
                                else echo "<span class='badge badge-secondary'>Pending</span>";
                            ?>
                        </td>
                    </tr>
                    <?php if($res2): ?>
                    <tr><th>Driver:</th><td><?php echo $res2['driver_fullname']; ?></td></tr>
                    <tr><th>Plate:</th><td><?php echo $res2['plate_no']; ?></td></tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</section>

<footer class="footer-area section-gap">
    <div class="container" style="text-align: center;">
        <p>Copyright &copy; <?php echo date('Y'); ?> NATC Nasugbu Airport Transport Corp.</p>
    </div>
</footer>

<script src="js/vendor/jquery-2.2.4.min.js"></script>
<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>