<?php
session_start();

// Check if user is logged in
if(!isset($_SESSION['userID'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit;
}

// Include database connection file
require_once "db_connection.php";

// Fetch user data from database
$userID = $_SESSION['userID'];
$query = "SELECT * FROM Users WHERE userID = $userID";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Eventease</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <div class="search-container">
            <form action="search.php" method="GET">
                <input type="text" placeholder="Search for auditoriums..." name="query">
                <button type="submit">Search</button>
            </form>
        </div>
        <h2>Welcome to Your Dashboard, <?php echo $user['username']; ?>!</h2>
        <p>This is your personalized dashboard where you can manage your account and bookings.</p>
        <ul>
            <li><a href="profile.php">View Profile</a></li>
            <li><a href="bookings.php">View Bookings</a></li>
            <!-- Add more dashboard links as needed -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</body>
</html>
