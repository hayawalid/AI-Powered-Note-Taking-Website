<?php
include_once '../includes/session.php';

$current_page = 'Quiz';

if (isset($_SESSION['file_id']) && $_SESSION['file_id'] !== null) {
    $file_id = $_SESSION['file_id'];
    // Proceed with the SQL query
} else {
    echo "File ID is missing. Please go back and select a valid file.";
    exit; // Exit if file ID is missing
}


if (isset($_SESSION['mcq'])) {
    $mcq = $_SESSION['mcq'];
    unset($_SESSION['mcq']); // Optionally, clear the session to avoid showing old data
} else {
    echo "No mcq data found.";
    exit;
}

// $mcq = "";

// // Handle the form submission for generating multiple-choice questions
// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['regenerate_mcq'])) {
//     $mcq_prompt = "Generate many multiple-choice questions and their answers based on the following text: " . $text;

//     try {
//         $response = $client->request('POST', 'http://localhost:3000/summarize', [
//             'json' => [
//                 'prompt' => $mcq_prompt
//             ]
//         ]);
//         $data = json_decode($response->getBody(), true);
//         $mcq = $data['summary'] ?? 'No multiple-choice questions available';
//     } catch (Exception $e) {
//         echo "Error: " . $e->getMessage();
//         $logger->error('Error in generating MCQs', ['message' => $e->getMessage()]);
//     }
// }

// Parse the MCQs into an array
$mcq_lines = explode("\n", $mcq); // Split the text into lines
$questions = [];
$question = '';
$answers = [];
$correct_answer = '';

foreach ($mcq_lines as $line) {
    $line = trim($line);

    // Check for a new question line (e.g., "1. **Question text**")
    if (preg_match('/^\d+\.\s*\*\*(.*?)\*\*/', $line, $matches)) {
        // If a previous question exists, save it
        if (!empty($question)) {
            $questions[] = [
                'question' => $question,
                'answers' => $answers,
                'correct_answer' => $correct_answer,
            ];
        }

        // Start a new question
        $question = $matches[1];
        $answers = [];
        $correct_answer = '';
    }

    // Check for answer options (e.g., "a) Option 1")
    elseif (preg_match('/^[a-d]\)\s*(.+)/', $line, $matches)) {
        $answers[] = $matches[1];
    }

    // Check for the correct answer line (e.g., "Answer: a")
    elseif (preg_match('/^Answer:\s*([a-d])/', $line, $matches)) {
        $correct_answer = $matches[1];
    }
}

// Save the last question
if (!empty($question)) {
    $questions[] = [
        'question' => $question,
        'answers' => $answers,
        'correct_answer' => $correct_answer,
    ];
}

// Debug output
echo "<pre>";
print_r($questions);
echo "</pre>";

echo "<pre>";
echo htmlspecialchars($mcq); // Escape HTML for readability
echo "</pre>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MCQ Quiz</title>
    <link href="../assets/css/mcqquiz.css" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/user_style.css">

    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        button:not(:enabled) {
            background-color: #e0e0e0;
            color: #777;
            cursor: not-allowed; 
            opacity: 0.6;
            border: none;
        }
        .inactive-btn:disabled {
            background-color: #e0e0e0;
            color: #888;
        }

        .dark-placeholder::placeholder {
            color: black !important; 
            opacity: 1;
        }
    </style>

</head>

<body>
<?php include '../includes/sidebar.php'; ?>

<div class="quiz-container">
    <?php 
        $counter = 1;
        foreach ($questions as $question) {
            $isActive = ($counter === 1) ? 'active' : ''; // Set the first question as active
    ?>
    <div class="quiz-box <?= $isActive ?>" id="question<?= $counter ?>">
        <div class="text-center pb-4">
            <h5 class="font-weight-bold"><?= $counter ?> of <?= count($questions) ?></h5>
        </div>
        <h4 class="font-weight-bold"><?= htmlspecialchars($question['question']) ?></h4>
        <form>
            <?php foreach ($question['answers'] as $answer): ?>
                <label class="answer-options">
                    <input type="radio" name="option<?= $counter ?>" value="<?= htmlspecialchars($answer) ?>"> 
                    <span class="checkmark"></span> <?= htmlspecialchars($answer) ?>
                </label>
            <?php endforeach; ?>
        </form>
        <div class="d-flex">
            <?php if ($counter > 1): ?>
                <button class="btn1 btn-primary mx-3" onclick="navigateQuestion(<?= $counter - 1 ?>)">Previous</button>
            <?php endif; ?>
            <?php if ($counter < count($questions)): ?>
                <button class="btn1 btn-primary" onclick="navigateQuestion(<?= $counter + 1 ?>)">Next</button>
            <?php else: ?>
                <button class="btn1 btn-primary" onclick="submitQuiz()">Submit</button>
            <?php endif; ?>
        </div>
    </div>
    <?php 
            $counter++;
        } 
    ?>
</div>


<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/mcqquiz.js"></script>


<!-- Core JS Files -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!-- Notifications Plugin -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard -->
<script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
</body>
</html>
