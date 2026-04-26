<?php
if(isset($_POST)){
    // Use Railway environment variables for Database
    $servername = getenv('MYSQLHOST');
    $username   = getenv('MYSQLUSER');
    $password   = getenv('MYSQLPASSWORD');
    $dbname     = getenv('MYSQLDATABASE');
    $port       = getenv('MYSQLPORT');

    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        $time = date('H:i:s');
        $originalDate = $_POST['date'];
        $newDate = date("Y-m-d", strtotime($originalDate));
        
        // Note: Using standard escaping for SQL safety
        $name = $conn->real_escape_string($_POST['name']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $email = $conn->real_escape_string($_POST['email']);
        $pickup = $conn->real_escape_string($_POST['pickup']);
        $vehicle = $conn->real_escape_string($_POST['vehicle']);
        $passengers = $conn->real_escape_string($_POST['passengers']);
        $luggage = $conn->real_escape_string($_POST['luggage']);
        $notes = $conn->real_escape_string($_POST['notes']);
        $destination_id = $conn->real_escape_string($_POST['destination']);

        $sql = "INSERT INTO natc_booking (booking_no, booking_date, booking_time, driver_id, vehicle_id, status, booking_fare, name, phone, email, pickup, vehicle_type, passengers, luggage, notes, dr_id)
                VALUES ('none', '{$newDate}', '{$time}', 0, 0, 1, 0, '{$name}', '{$phone}', '{$email}', '{$pickup}', '{$vehicle}', '{$passengers}', '{$luggage}', '{$notes}', '{$destination_id}')";

        if (!mysqli_query($conn, $sql)) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        } else {
            $last_id = $conn->insert_id;
            // Generate unique tracking number
            $bookingNo = strtoupper(substr(md5(base64_encode($last_id.$newDate."natc".$time)), 0, 10));
            $sql = "UPDATE natc_booking SET booking_no='{$bookingNo}' WHERE booking_id=$last_id";

            if ($conn->query($sql)) {
                // Fetch destination details and rates
                $sql_rate = "SELECT * FROM natc_destination_rates WHERE dr_id={$destination_id} LIMIT 1";
                $result = $conn->query($sql_rate);
                $res = $result->fetch_assoc();

                $rate = 0;
                if($vehicle == 'Innova') $rate = $res['dr_rate_innova'];
                if($vehicle == 'Van') $rate = $res['dr_rate_van'];

                // Prepare HTML Email Message
                $message = "
                    <html><head><title>NATC BOOKING</title></head>
                    <body>
                    <p>Hello {$name}, you have booked a/an {$vehicle}</p>
                    <table border='1' style='width:100%; border-collapse: collapse; text-align: left;'>
                    <tr style='background-color: #f2f2f2;'>
                        <th>Tracking No.</th><th>Pickup</th><th>Destination</th><th>Schedule</th><th>Rate</th>
                    </tr>
                    <tr>
                        <td>{$bookingNo}</td>
                        <td>{$pickup}</td>
                        <td>{$res['dr_destination']}</td>
                        <td>{$newDate}</td>
                        <td>{$rate} php</td>
                    </tr>
                    </table>
                    <p>Total Passengers: {$passengers} | Luggage: {$luggage}</p>
                    </body></html>
                ";

                // --- MAILJET API INTEGRATION ---
                $mj_api_key = getenv('MJ_APIKEY_PUBLIC'); 
                $mj_api_secret = getenv('MJ_APIKEY_PRIVATE');

                $mj_payload = [
                    'Messages' => [
                        [
                            'From' => [
                                'Email' => "andreicapili4@gmail.com", // Make sure this is ACTIVE in Mailjet
                                'Name' => "NATC Transport"
                            ],
                            'To' => [
                                [
                                    'Email' => $email,
                                    'Name' => $name
                                ]
                            ],
                            'Subject' => "Booking Confirmation: " . $bookingNo,
                            'HTMLPart' => $message
                        ]
                    ]
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://api.mailjet.com/v3.1/send");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($mj_payload));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
                curl_setopt($ch, CURLOPT_USERPWD, "{$mj_api_key}:{$mj_api_secret}");

                $response = curl_exec($ch);
                curl_close($ch);
                // --- END MAILJET API ---

                // Redirect to success page
                header('Location: https://natc-production.up.railway.app/bookingSuccess.php?bid='.$last_id);
                exit;
            }
        }
    }
}
?>