<?php
session_start();
include_once 'path/to/note.php';  // Include note.php for generateQA function

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = $_SESSION['text'] ?? '';  // Get the text from session
    $qa = generateQA($text);

    // Send back the generated Q&A as a JSON response
    echo json_encode(['status' => 'success', 'qa' => $qa]);
}
?>
