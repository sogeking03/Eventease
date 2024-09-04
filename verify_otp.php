<?php
session_start();

// Check if OTP is stored in session
if(isset($_SESSION['otp'])) {
    $otp = $_SESSION['otp'];

    // Check if form is submitted
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve OTP entered by user
        $userOTP = $_POST['otp'];

        // Verify OTP
        if($userOTP == $otp) {
            // OTP verified successfully, registration complete
            // You can proceed to store user data in database here

            // Unset OTP from session
            unset($_SESSION['otp']);

            // Redirect to success page or dashboard
            header("Location: registration_success.php");
            exit;
        } else {
            // Invalid OTP, display error message
            $error = "Invalid OTP. Please try again.";
        }
    }
} else {
    // OTP not found in session, redirect to signup page
    header("Location: signup.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP - Eventease</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container">
        <h2>Verify OTP</h2>
        <?php if(isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <p>An OTP has been sent to your phone number. Please enter the OTP below to complete your registration.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="otp">OTP:</label>
                <input type="text" id="otp" name="otp" required>
            </div>
            <button type="submit" class="btn">Verify OTP</button>
        </form>
    </div>
</body>
</html>
