 <!-- <?php 
// include '../includes/user_sidebar.php';
//include '../includes/config.php';
// include_once '../includes/session.php';

// Set current page to update sidebar status
// $current_page = 'My Note';
// $file_id = isset($_GET['id']) ? intval($_GET['id']) : null; // Change file_id to id

// $sql = "SELECT content FROM files WHERE id=$file_id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // Output data of each row
//     while ($row = $result->fetch_assoc()) {
//         $content = $row["content"];
//     }
// } else {
//     $content = "No content found.";
// }

// // Disable strict mode temporarily
// $conn->query("SET sql_mode = ''");

// $conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <script src="../assets/js/Note.js"></script>
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'>
    <link rel="stylesheet" href="../assets/css/Note.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body class="Bootstrap-body">

<div id="container-fluid">
  <div class="row come-in">
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 note-content centered">
      <div class="panel panel-info">
        <div class="panel-heading">Name your file
        <button class="btn btn-primary Edit">Edit</button> 
        <button class="btn btn-primary summarize">Summarize ✨</button> 
        </div>
       
        <div class="panel-body">
          <p><?php //echo $content; ?></p>
        </div>
      </div>   
    </div>
    
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 summarized-class">
      <div class="panel panel-warning">
        <div class="panel-heading">Summarized Text
        <button class="btn btn-primary save">Save</button>
        </div>
        <div class="panel-body">
          <p>"Don't speak of it, I beg of you," replied the Woodman.  
            "I have no heart, you know, so I am careful to help all those who may need a friend, 
            even if it happens to be only a mouse."</p>
        </div>
      </div> 
    </div>
  </div>
</div>
</body>
</html>  -->



<!-- the upcoming commented implement the logic of the generate summary and save summary in the db  -->

<?php
include '../includes/user_sidebar.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../includes/config.php';
require_once __DIR__ . '/../vendor/autoload.php'; 

// <?php

use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$logger = new Logger('summary_logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/app.log', Logger::DEBUG));

$client = new Client();
$summary = '';
$message = '';

// Handle POST request for summarization
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {
    $originalText = $_POST['originalText'] ?? '';
    $prompt = "summarize the following text: " . $originalText;

    try {
        $response = $client->request('POST', 'http://localhost:3000/summarize', [
            'json' => ['prompt' => $prompt]
        ]);
        $data = json_decode($response->getBody(), true);
        $summary = $data['summary'] ?? 'No summary available';
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
        $logger->error('Error during summarization', ['error' => $e->getMessage()]);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <!-- <script src="../assets/js/Note.js"></script> -->
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'>
    <link rel="stylesheet" href="../assets/css/Note.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
</head>
<body class="Bootstrap-body">
<div id="container-fluid">
  <div class="row come-in">
    <!-- Input Section -->
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 note-content centered">
      <div class="panel panel-info">
        <div class="panel-heading">
          Name your file
          <button class="btn btn-primary Edit">Edit</button>
        </div>
        <div class="panel-body">
          <form method="POST" id="summarizeForm">
            <textarea id="originalText" name="originalText" rows="5" cols="50" placeholder="Enter text to summarize"><?= htmlspecialchars($_POST['originalText'] ?? '') ?></textarea>
            <button type="submit" name="generate" class="btn btn-info mt-3">Generate Summary</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Summary Section -->
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 summarized-class">
      <?php if (!empty($summary)): ?>
        <div class="panel panel-warning">
          <div class="panel-heading">
            Summarized Text
          </div>
          <div class="panel-body">
            <p id="summaryText"><?= htmlspecialchars($summary) ?></p>
          </div>
          <!-- Save Summary Form -->
          <form id="saveForm">
            <button type="submit" id="save" class="btn btn-success" name="save" data-summary="<?= htmlspecialchars($summary) ?>">Save Summary</button>
          </form>
          <div id="message"><?= htmlspecialchars($message) ?></div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<script>
    // Prevent form submission and handle the save button logic
    $('#saveForm').on('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting (page reload)

        // Get the summary from the button's data-summary attribute
        var summary = $('#save').data('summary');
        var jsonSummary = JSON.stringify({ Summary: summary });

        // Prepare data for AJAX request
        var postData = {
            name: 'Summary File',
            user_id: 47, // Replace with actual user ID
            folder_id: 75, // Replace with actual folder ID
            content: jsonSummary, // Send JSON-formatted summary
            created_at: new Date().toISOString(),
            file_type: 2 // Assuming 2 corresponds to "Summary"
        };

        // AJAX call to save the summary
        $.ajax({
            url: 'sava_db_Q&A.php', // Your save endpoint
            method: 'POST',
            data: postData,  // Send form data
            success: function (response) {
                $('#message').html('Summary saved successfully!').css('color', 'green');
            },
            error: function (xhr, status, error) {
                $('#message').html('Error saving summary: ' + error).css('color', 'red');
            }
        });
    });
</script>

</body>
</html>
