<?php
include '../includes/config.php';
use Smalot\PdfParser\Parser;

ini_set('display_errors', 1);
error_reporting(E_ALL);

$response = ["status" => false, "message" => "No file uploaded."];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileType = $_FILES['file']['type'];
        $extractedText = $_POST['content']; // Extracted text from JavaScript

        // Assign default values for `user_id`, `folder_id`, `file_type`
        $userId = 47; // Replace with actual user ID
        $folderId = 1; // Default folder
        $fileType = 1; // Fixed file type for PDFs

        // Check if the user ID exists
        $userCheckStmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
        $userCheckStmt->bind_param("i", $userId);
        $userCheckStmt->execute();
        $userCheckStmt->store_result();

        if ($userCheckStmt->num_rows === 0) {
            $response = ["status" => false, "message" => "Invalid user ID. Please ensure the user exists."];
        } else {
            // Save the file details and content to the database
            $stmt = $conn->prepare("INSERT INTO files (name, user_id, folder_id, content, file_type) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("siisi", $fileName, $userId, $folderId, $extractedText, $fileType);

            if ($stmt->execute()) {
                $response = ["status" => true, "message" => "File uploaded and content saved successfully!"];
            } else {
                $response = ["status" => false, "message" => "Failed to save file data: " . $stmt->error];
            }
            $stmt->close();
        }
        $userCheckStmt->close();
    } else {
        $response = ["status" => false, "message" => "File upload error: " . $_FILES['file']['error']];
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
