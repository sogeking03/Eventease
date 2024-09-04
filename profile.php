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

// Update user profile if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phoneNumber'];

    // Update user profile in database
    $updateQuery = "UPDATE Users SET fullName = '$fullName', email = '$email', phoneNumber = '$phoneNumber' WHERE userID = $userID";
    mysqli_query($conn, $updateQuery);

    // Refresh user data
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Eventease</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS file -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo $user['fullName']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" id="phoneNumber" name="phoneNumber" value="<?php echo $user['phoneNumber']; ?>" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>

    <!-- Bootstrap JS (optional, for certain components that require JS) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
