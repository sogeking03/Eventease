<?php
// Include database connection file
require_once "db_connection.php";

// Query to fetch available dates from the database
$sql = "SELECT DISTINCT date FROM Reservations WHERE available = 1";
$result = mysqli_query($conn, $sql);

$availableDates = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Add available dates to the array
        $availableDates[] = $row['date'];
    }
}

// Convert the array to JSON format and output
echo json_encode($availableDates);
?>
