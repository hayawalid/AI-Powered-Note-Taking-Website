<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Example user data (replace with database logic)
    $stored_email = "user@example.com";
    $stored_password = "password123"; // Replace with hashed password for production

    if ($email === $stored_email && $password === $stored_password) {
        header("Location: dashboard.php"); // Redirect to a dashboard page
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartNotes</title>

    <!-- Fonts and CSS Libraries -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="../assets/css/login.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 col-md-7 intro-section">
                <div class="brand-wrapper">
                    <h1><a href="https://stackfindover.com/">SmartNotes</a></h1>
                </div>
                <div class="intro-content-wrapper">
                    <h3 class="intro-title">Welcome to SmartNotes!</h3>
                    <p class="intro-text">
                    Log in to access powerful tools like speech-to-text, summarization, and question generation, all designed to boost your note-taking and productivity.</p>
                    <a href="#!" class="btn btn-read-more">Read more</a>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 form-section">
                <div class="login-wrapper">
                    <h2 class="login-title">Sign in</h2>
                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <input name="login" id="login" class="btn login-btn" type="submit" value="Login">
                            <a href="#!" class="forgot-password-link">Forgot Password?</a>
                        </div>
                    </form>
                    <p class="login-wrapper-footer-text">Need an account? <a href="#" id="signup-toggle" class="text-reset">Signup here</a></p>
                </div>
                
              
               <!-- Sign Up Form -->
<div class="sign-up-form" style="display: none;">
    <h2 class="login-title">Sign Up</h2>
    <form id="signup-form">
        <div class="form-group">
            <label for="signup-email" class="sr-only">Email</label>
            <input type="email" name="email" id="signup-email" class="form-control" placeholder="Email">
            <div id="email-error" class="text-danger" style="display: none;"></div> <!-- Error message for email -->
        </div>
        <div class="form-group mb-3">
            <label for="signup-password" class="sr-only">Password</label>
            <input type="password" name="password" id="signup-password" class="form-control" placeholder="Password">
            <div id="password-error" class="text-danger" style="display: none;"></div> <!-- Error message for password -->
        </div>
        <div class="form-group mb-3">
            <label for="confirm-password" class="sr-only">Confirm Password</label>
            <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm Password">
            <div id="confirm-password-error" class="text-danger" style="display: none;"></div> <!-- Error message for confirm password -->
        </div>
        <div class="form-group">
            <input type="checkbox" id="terms-checkbox">
            <label for="terms-checkbox">
        <a href="terms.html" target="_blank" class="terms-link">I agree to the terms and conditions</a>
    </label>
            <div id="error-message" class="text-danger" style="display: none;"></div> <!-- Error message for terms -->
        </div>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <input id="signup-btn" class="btn login-btn" type="button" value="Sign Up">
        </div>
    </form>
    <p class="login-wrapper-footer-text">Already have an account? <a href="#" id="signin-toggle" class="text-reset">Sign in here</a></p>
</div>




            </div>
        </div>
    </div>

    <!-- jQuery and Bootstrap Bundle JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/login.js"></script>
</body>
</html>
