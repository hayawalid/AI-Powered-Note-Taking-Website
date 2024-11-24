<?php
error_reporting(E_ALL); // Enable error reporting
ini_set('display_errors', 1); // Display errors

include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $file_id = intval($_POST['file_id']);
    echo "Content: $content, File ID: $file_id\n";  // Debug output

    // Check if the file ID exists
    $check_sql = "SELECT * FROM files WHERE id=$file_id";
    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows == 0) {
        echo "File ID does not exist.\n";
        exit;
    }

    // Update content in the database
    $sql = "UPDATE files SET content='$content' WHERE id=$file_id";

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Record updated successfully\n";
        } else {
            echo "Update executed, but no rows were affected.\n";
        }
    } else {
        echo "Error updating record: " . $conn->error . "\n";
    }

    // Commit changes if using transaction mode
    $conn->commit();
}

// Fetch the content for the file with id 1
$file_id = 1;
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
