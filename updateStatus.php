<?php
// Database connection
$servername = getenv('MYSQLHOST');
$username   = getenv('MYSQLUSER');
$password   = getenv('MYSQLPASSWORD');
$dbname     = getenv('MYSQLDATABASE');
$port       = getenv('MYSQLPORT');

$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Get data from the Telegram button URL
$id = $_GET['id'];
$status = $_GET['status']; // 2 = Accepted, 3 = Rejected

if ($id && $status) {
    // Update the booking status in the database
    $sql = "UPDATE natc_booking SET status = '$status' WHERE booking_id = '$id'";
    
    if ($conn->query($sql)) {
        echo "<div style='text-align:center; padding-top:100px; font-family:sans-serif;'>";
        echo "<h1>" . ($status == 2 ? '✅ Booking Accepted' : '❌ Booking Rejected') . "</h1>";
        echo "<p>The customer tracking page has been updated. Drive safe!</p>";
        echo "<p><small>You can close this tab now.</small></p>";
        echo "</div>";
    } else {
        echo "Error updating database: " . $conn->error;
    }
}
$conn->close();
?>