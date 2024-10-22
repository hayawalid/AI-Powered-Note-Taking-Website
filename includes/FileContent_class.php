<?php
include '../includes/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $file_id = intval($_POST['file_id']);

    $sql = "UPDATE files SET content='$content' WHERE id=$file_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}




// Fetch the content for the file with id 1
$file_id = 1;
$sql = "SELECT content FROM files WHERE id=$file_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $content = $row["content"];
    }
} else {
    $content = "No content found.";
}
$conn->close();
?>
