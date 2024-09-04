<?php
session_start();

// Check if user is already logged in, redirect to dashboard if logged in
if(isset($_SESSION['userID'])) {
    header("Location: dashboard.php");
    exit;
}

// Check if form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process login form
    if(isset($_POST['login'])) {
        // Handle login logic here
        // Example: Redirect to login.php for handling login
        header("Location: login.php");
        exit;
    }
    // Process signup form
    elseif(isset($_POST['signup'])) {
        // Handle signup logic here
        // Example: Redirect to signup.php for handling signup
        header("Location: signup.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Eventease</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Your custom CSS file -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4 text-center">Welcome to Eventease</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <button type="submit" name="login" class="btn btn-primary btn-block mb-3">Login</button>
                    <button type="submit" name="signup" class="btn btn-secondary btn-block">Sign Up</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for certain components that require JS) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
