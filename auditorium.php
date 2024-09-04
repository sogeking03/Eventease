<?php
// Include database connection file
require_once "db_connection.php";

// Check if AuditoriumID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize AuditoriumID to prevent SQL injection
    $auditoriumID = mysqli_real_escape_string($conn, $_GET['id']);

    // Retrieve auditorium details from database
    $sql = "SELECT * FROM Auditoriums WHERE AuditoriumID = $auditoriumID";
    $result = mysqli_query($conn, $sql);

    // Check if auditorium exists
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Auditorium details
        $auditoriumName = $row['Name'];
        $address = $row['Address'];
        $capacity = $row['Capacity'];
        $seatingArrangement = $row['SeatingArrangement'];
        $parkingCapacity = $row['ParkingCapacity'];
        $foodSectionCapacity = $row['FoodSectionCapacity'];
        $description = $row['Description'];

        // Display auditorium details
        echo "<h2>$auditoriumName</h2>";
        echo "<p><strong>Address:</strong> $address</p>";
        echo "<p><strong>Capacity:</strong> $capacity</p>";
        echo "<p><strong>Seating Arrangement:</strong> $seatingArrangement</p>";
        echo "<p><strong>Parking Capacity:</strong> $parkingCapacity</p>";
        echo "<p><strong>Food Section Capacity:</strong> $foodSectionCapacity</p>";
        echo "<p><strong>Description:</strong> $description</p>";

        // Retrieve feedbacks and ratings from database
        $feedbackSql = "SELECT * FROM Feedbacks WHERE AuditoriumID = $auditoriumID";
        $feedbackResult = mysqli_query($conn, $feedbackSql);

        // Display feedbacks and ratings
        if(mysqli_num_rows($feedbackResult) > 0) {
            echo "<h3>Feedbacks and Ratings:</h3>";
            while($feedbackRow = mysqli_fetch_assoc($feedbackResult)) {
                $feedback = $feedbackRow['Feedback'];
                $rating = $feedbackRow['Rating'];
                echo "<p><strong>Feedback:</strong> $feedback | <strong>Rating:</strong> $rating</p>";
            }
        } else {
            echo "<p>No feedbacks available.</p>";
        }

        // Link to booking page
        echo "<p><a href='booking.php?auditorium_id=$auditoriumID'>Book Now</a></p>";
    } else {
        // Auditorium not found
        echo "<h2>Auditorium not found.</h2>";
    }
} else {
    // Redirect to dashboard if AuditoriumID is not provided in the URL
    header("Location: dashboard.php");
    exit;
}
?>
