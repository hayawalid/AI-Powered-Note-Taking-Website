<?php
include_once '../includes/session.php';

$current_page = 'Quiz';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MCQ Quiz</title>
    <link href="../assets/css/mcqquiz.css" rel="stylesheet">
    <!-- Fonts and icons -->
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
    <div class="quiz-box" id="question1">
        <div class="text-center pb-4">
            <div class="h5 font-weight-bold">1 of 3 </div>
        </div>
        <div class="h4 font-weight-bold"> 1. Who is the Prime Minister of India?</div>
        <div class="pt-4">
            <form> 
                <label class="answer-options">Rahul Gandhi<input type="radio" name="option"> <span class="checkmark"></span> </label> 
                <label class="answer-options">Indira Gandhi<input type="radio" name="option"> <span class="checkmark"></span> </label> 
                <label class="answer-options">Narendra Modi <input type="radio" name="option" id="correct-answer" checked> <span class="checkmark"></span> </label> 
                <label class="answer-options">Ram Nath Kovind <input type="radio" name="option"> <span class="checkmark"></span> </label> 
            </form>
        </div>
        <div class="d-flex justify-content-end pt-2"> 
            <button class="btn1 btn1-primary" id="next-btn1">Next <span class="fas fa-arrow-right"></span> </button> 
        </div>
    </div>
    <div class="quiz-box" id="question2">
        <div class="text-center pb-4">
            <div class="h5 font-weight-bold"> <span id="quiz-counter"> </span>2 of 3 </div>
        </div>
        <div class="h4 font-weight-bold"> 2. IPV4 stand's for?</div>
        <div class="pt-4">
            <form> 
                <label class="answer-options">Internet Protocol <input type="radio" name="option2"> <span class="checkmark"></span> </label> 
                <label class="answer-options">Intranet Protocol <input type="radio" name="option2" checked> <span class="checkmark"></span> </label> 
                <label class="answer-options">internet Protocol <input type="radio" name="option2" id="correct-answer2"> <span class="checkmark"></span> </label> 
                <label class="answer-options">None of the above <input type="radio" name="option2"> <span class="checkmark"></span> </label> 
            </form>
        </div>
        <div class="d-flex justify-content-end pt-2"> 
            <button class="btn1 btn1-primary mx-3" id="back-btn1"> <span class="fas fa-arrow-left pr-1"></span>Previous </button> 
            <button class="btn1 btn1-primary" id="next-btn2">Next <span class="fas fa-arrow-right"></span> </button> 
        </div>
    </div>
    <div class="quiz-box" id="question3">
        <div class="text-center pb-4">
            <div class="h5 font-weight-bold"> <span id="quiz-counter"> </span>3 of 3 </div>
        </div>
        <div class="h4 font-weight-bold"> 3. What is the full form of CSS?</div>
        <div class="pt-4">
            <form> 
                <label class="answer-options">Clarity Style Sheets <input type="radio" name="option3"> <span class="checkmark"></span> </label> 
                <label class="answer-options">Cascading Style Sheets <input type="radio" name="option3"> <span class="checkmark"></span> </label> 
                <label class="answer-options">Confirm Style Sheets <input type="radio" name="option3" id="correct-answer3" checked> <span class="checkmark"></span> </label> 
                <label class="answer-options">Canvas Style Sheets <input type="radio" name="option3"> <span class="checkmark"></span> </label> 
            </form>
        </div>
        <div class="d-flex justify-content-end pt-2"> 
            <button class="btn1 btn1-primary mx-3" id="back-btn2"> <span class="fas fa-arrow-left pr-2"></span>Previous </button> 
            <button class="btn1 btn1-primary" id="submit-btn">Submit </button> 
        </div>
    </div>
</div>
<div class="go_dark">
<div class="d-flex flex-column ">
    <div class="h3 text-black">Go Dark</div> 
    <label class="switch"> <input type="checkbox"> <span class="slider round"></span> </label>
</div>
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
