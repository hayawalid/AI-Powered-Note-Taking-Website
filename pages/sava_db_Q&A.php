<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smartnotes_db"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if data is received from the AJAX request
if (isset($_POST['name']) && isset($_POST['user_id']) && isset($_POST['folder_id']) && isset($_POST['content']) && isset($_POST['file_type'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $user_id = $_POST['user_id'];
    $folder_id = $_POST['folder_id'];
    $content = $conn->real_escape_string($_POST['content']);
    $created_at = $_POST['created_at']; // Use the timestamp sent from AJAX
    $file_type = $_POST['file_type']; // Assuming file type is passed as an integer

    // SQL query to insert the data
    $sql = "INSERT INTO files (name, user_id, folder_id, content, created_at, file_type) 
            VALUES ('$name', $user_id, $folder_id, '$content', '$created_at', $file_type)";

    if ($conn->query($sql) === TRUE) {
        echo "Summary saved successfully!";
    } else {
        echo "Error saving the summary: " . $conn->error;
    }
    
    $conn->close();
} else {
    echo "Invalid data received.";
}
?>
