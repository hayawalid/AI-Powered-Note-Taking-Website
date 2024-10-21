<?php
include '../includes/config.php';
include '../includes/User.php';

// Handle deletion if form is submitted via AJAX
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user_id'])) {
    $user_id = $_POST['delete_user_id'];
    $user = new User($user_id);
    $result = User::deleteUser($user);

    if ($result) {
        echo json_encode(["status" => "success", "message" => "User deleted successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error deleting user."]);
    }
    exit;
  }
?>
