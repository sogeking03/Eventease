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

// Fetch user's bookings from database
$userID = $_SESSION['userID'];
$query = "SELECT * FROM Reservations WHERE UserID = $userID";
$result = mysqli_query($conn, $query);

// Cancel booking if cancel button is clicked
if(isset($_POST['cancelBooking'])) {
    $reservationID = $_POST['reservationID'];

    // Delete booking from database
    $deleteQuery = "DELETE FROM Reservations WHERE ReservationID = $reservationID AND UserID = $userID";
    mysqli_query($conn, $deleteQuery);

    // Redirect to bookings page to refresh bookings list
    header("Location: bookings.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Eventease</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Bookings</h2>
        <table>
            <tr>
                <th>Auditorium Name</th>
                <th>Reservation Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['AuditoriumName']; ?></td>
                <td><?php echo $row['ReservationDate']; ?></td>
                <td><?php echo $row['StartTime']; ?></td>
                <td><?php echo $row['EndTime']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                    <?php if($row['Status'] == 'Pending' || $row['Status'] == 'Confirmed'): ?>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                            <input type="hidden" name="reservationID" value="<?php echo $row['ReservationID']; ?>">
                            <button type="submit" name="cancelBooking">Cancel</button>
                        </form>
                    <?php else: ?>
                        <!-- Display 'Not applicable' if status is not pending or confirmed -->
                        Not applicable
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
