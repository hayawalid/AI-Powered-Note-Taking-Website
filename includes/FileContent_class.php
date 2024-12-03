<?php
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1); // Display errors

include '../includes/config.php';
//include 'session.php';
include_once 'file_class.php';

$user_id = isset($_SESSION['UserID']) ? $_SESSION['UserID'] : null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data
    $content = mysqli_real_escape_string($conn, $_POST['content']); // Sanitizing the input
    $user_id = intval($_POST['user_id']); // User ID passed from JS (make sure it's valid)
    $folder_id = intval($_POST['folder_id']); // Folder ID passed from JS (make sure it's valid)
    $file_type = $_POST['file_type']; // File type passed from JS

    // Generate a file name or receive it from the front-end (you can customize this logic as needed)
    $name = "speechToText" .$folder_id;

    // Now call the create function from file_class.php
    $result = file::create($name, $user_id, $folder_id, $content, $file_type);

    if($result){
        header("Location: ../pages/Note.php?id=". $result);
        exit();
    }else{
        echo "Failed to create file";
    }
    
}

// Fetch the content for the file with id 1
$file_id = isset($_GET['id']) ? intval($_GET['id']) : 1;
$sql = "SELECT content FROM files WHERE id=$file_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $content = $row["content"];
    }
} else {
    $content = "No content found.";
}

// Disable strict mode temporarily
$conn->query("SET sql_mode = ''");

$conn->close();
?>
