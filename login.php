<?php
session_start();

// Check if user is already logged in, redirect to dashboard if logged in
if(isset($_SESSION['userID'])) {
    header("Location: dashboard.php");
    exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include database connection file
    require_once "db_connection.php";

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if user exists
    $query = "SELECT * FROM Users WHERE username = '$username' AND user_password = '$password'";
    $result = mysqli_query($conn, $query);

    // Check if user exists
    if(mysqli_num_rows($result) == 1) {
        // User found, set session variables
        $row = mysqli_fetch_assoc($result);
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['username'] = $row['username'];

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        // User not found, display error message
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eventease</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Login to Eventease</h2>
        <?php if(isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
     
