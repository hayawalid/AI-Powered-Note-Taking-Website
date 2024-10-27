<?php
session_start();
include '../includes/User.php';

// Check if action is set
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'logout') {
        session_destroy();
        echo "Logged out successfully";
    } elseif ($action == 'deactivate') {
        // Get the user ID from the session
        $user_id = $_SESSION['UserID'];
        $userObject = new User($user_id);
        // Call the deactivate account function
        User::deleteUser($userObject);
        // Destroy the session
        session_destroy();
        echo "Account deactivated successfully";
    } else {
        echo "Invalid action";
    }
} else {
    echo "No action specified";
}
?>
