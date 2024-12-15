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

// Assuming $mcq is a string that contains your MCQs
$mcq_lines = explode("\n", $mcq);
$questions = [];
$question = '';
$answers = [];
$correct_answer = '';

$question_pattern = '/^\d+\.\s*(.*)$/';
$answer_pattern = '/^([a-d])\)\s*(.*)$/';
$correct_answer_pattern = '/^\*\*Answer:\s*([a-d])\*\*$/';

foreach ($mcq_lines as $line) {
    $line = trim($line);

    if (preg_match($question_pattern, $line, $matches)) {
        if (!empty($question)) {
            $questions[] = [
                'question' => trim($question, "**"),
                'answers' => $answers,
                'correct_answer' => trim($correct_answer, "**"),
            ];
        }
        $question = $matches[1];
        $answers = [];
        $correct_answer = '';
    } elseif (preg_match($answer_pattern, $line, $matches)) {
        $answers[] = trim($matches[2], "**");
    } elseif (preg_match($correct_answer_pattern, $line, $matches)) {
        $correct_answer = $matches[1];
    }
}

if (!empty($question)) {
    $questions[] = [
        'question' => trim($question, "**"),
        'answers' => $answers,
        'correct_answer' => trim($correct_answer, "**"),
    ];
}


// Debugging: Check the parsed output
// echo "<pre>";
// print_r($questions);
// echo "</pre>";


// // echo "<pre>";
// // echo htmlspecialchars($mcq); // Escape HTML for readability
// // echo "</pre>";
// echo "<pre>";
// print_r($mcq_lines);  // Print the lines to check for any unexpected variations in format
// echo "</pre>";


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
        $isActive = ($counter === 1) ? 'active' : '';
    ?>
        <div class="quiz-box <?= $isActive ?>" id="question<?= $counter ?>" data-correct-answer="<?= htmlspecialchars($question['correct_answer']) ?>">
            <div class="text-center pb-4">
                <h5 class="font-weight-bold">Question <?= $counter ?> of <?= count($questions) ?></h5>
            </div>
            <h4 class="font-weight-bold"><?= htmlspecialchars($question['question']) ?></h4>
            <form>
                <?php foreach ($question['answers'] as $key => $answer): ?>
                    <div class="answer-options-container">
                    <label class="answer-options">
                        <input type="radio" name="option<?= $counter ?>" value="<?= htmlspecialchars($answer) ?>">
                        <?= htmlspecialchars($answer) ?>
                        <span class="checkmark"></span>
                    </label>
                    </div>
                <?php endforeach; ?>
            </form>
            <div class="d-flex justify-content-between mt-3">
                <?php if ($counter > 1): ?>
                    <button type="button" class="btn btn-primary" onclick="navigateQuestion(-1)">Previous</button>
                <?php endif; ?>
                <?php if ($counter < count($questions)): ?>
                    <button type="button" class="btn btn-primary" onclick="navigateQuestion(1)">Next</button>
                <?php else: ?>
                    <button type="button" class="btn btn-success" onclick="submitQuiz()">Submit</button>
                <?php endif; ?>
            </div>
        </div>
    <?php
        $counter++;
    }
    ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const questions = document.querySelectorAll('.quiz-box');
    let currentQuestionIndex = 0;

    function showQuestion(index) {
        questions.forEach((question, idx) => {
            question.classList.remove('active');
            if (idx === index) {
                question.classList.add('active');
            }
        });
    }

    window.navigateQuestion = function (direction) {
        currentQuestionIndex += direction;
        if (currentQuestionIndex < 0) {
            currentQuestionIndex = 0;
        } else if (currentQuestionIndex >= questions.length) {
            currentQuestionIndex = questions.length - 1;
        }
        showQuestion(currentQuestionIndex);
    };

    window.submitQuiz = function () {
        let score = 0;
        questions.forEach((question, index) => {
            const correctAnswer = question.dataset.correctAnswer.trim();
            const selectedOption = document.querySelector(`input[name="option${index + 1}"]:checked`);
            if (selectedOption && selectedOption.value.trim() === correctAnswer) {
                score++;
            }
        });
        alert(`You scored ${score} out of ${questions.length}!`);
    };

    showQuestion(currentQuestionIndex);
});
</script>

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
