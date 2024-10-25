<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
// Include config and User class files
include '../includes/config.php';
include '../includes/User.php';

// Resume user session
session_start();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        // Handle login
        $email = htmlspecialchars(trim($_POST["email"]));
        $password = htmlspecialchars(trim($_POST["password"]));

        // Authenticate user
        $user = User::login($email, $password);

        if ($user) {
            $_SESSION['user_id'] = $user->id;
            echo "<script>alert('Login successful');</script>";
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid email or password');</script>";
        }
    } elseif (isset($_POST['signup'])) {
        // Handle signup
        $username = htmlspecialchars(trim($_POST["username"]));
        $first_name = htmlspecialchars(trim($_POST["first_name"]));
        $last_name = htmlspecialchars(trim($_POST["last_name"]));
        $email = htmlspecialchars(trim($_POST["signup_email"])); // Match the input name
        $password = htmlspecialchars(trim($_POST["signup_password"])); // Match the input name
        $confirm_password = htmlspecialchars(trim($_POST["confirm_password"])); // Match the input name
        $country = htmlspecialchars(trim($_POST["country"]));
        $usertype_id = 2; // Regular user ID

        // Validate signup form
        if ($password !== $confirm_password) {
            echo "<script>alert('Passwords do not match.');</script>";
        } elseif (empty($username) || empty($first_name) || empty($last_name) || empty($email) || empty($password) || empty($country)) {
            echo "<script>alert('Please fill in all fields.');</script>";
        } else {
            // Insert new user into the database
            $isInserted = User::insertUser($username, $first_name, $last_name, $email, $password, $country, $usertype_id);

            if ($isInserted) {
                echo "<script>alert('Signup successful! Please log in.');</script>";
                header("Location: login.php");
                exit();
            } else {
                echo "<script>alert('Signup failed. Email might already be in use.');</script>";
            }
        }
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
                    <h1 ><a href="https://stackfindover.com/">SmartNotes</a></h1>
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
                    <form action="login.php" method="POST"> <!-- Ensure the form submits to login.php -->
                        <div class="form-group">
                            <label for="username" class="sr-only">Username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                        </div>

                        <!-- First Name and Last Name on the same row -->
                        <div class="form-group d-flex justify-content-between">
                            <div style="flex: 1; margin-right: 10px;">
                                <label for="first_name" class="sr-only">First Name</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div style="flex: 1; margin-left: 10px;">
                                <label for="last_name" class="sr-only">Last Name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" required>
                            </div>
                        </div>
                        <!-- Country dropdown for major countries -->
                        <div class="form-group mb-3">
                            <label for="country" class="sr-only">Country</label>
                            <select name="country" id="country" class="form-control" required>
                                <option value="Argentina">Argentina</option>
                                <option value="Australia">Australia</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="Egypt" selected>Egypt</option> <!-- Default selected option -->
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Nigeria">Nigeria</option>
                                <option value="Russia">Russia</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="South Africa">South Africa</option>
                                <option value="South Korea">South Korea</option>
                                <option value="Turkey">Turkey</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="signup-email" class="sr-only">Email</label>
                            <input type="email" name="signup_email" id="signup-email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="signup-password" class="sr-only">Password</label>
                            <input type="password" name="signup_password" id="signup-password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm-password" class="sr-only">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm-password" class="form-control" placeholder="Confirm Password" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" id="terms-checkbox" required>
                            <label for="terms-checkbox">
                                <a href="terms.html" target="_blank" class="terms-link">I agree to the terms and conditions</a>
                            </label>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <input name="signup" id="signup-btn" class="btn login-btn" type="submit" value="Sign Up">
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
