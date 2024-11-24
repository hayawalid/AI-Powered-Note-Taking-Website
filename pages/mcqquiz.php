<?php
session_start();
$current_page = 'Quiz';
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
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        button:disabled {
            background-color: #e0e0e0;
            color: #777;
            cursor: not-allowed; 
            opacity: 0.6;
            border: none;
        }
        .popover-btn:disabled {
            background-color: #e0e0e0;
            color: #888;
        }

        .black-placeholder::placeholder {
            color: black !important; 
            opacity: 1;
        }
    </style>

</head>
<?php include '../includes/sidebar.php'; ?>

<body>


<div class="wrapper">
    <div class="wrap" id="q1">
        <div class="text-center pb-4">
            <div class="h5 font-weight-bold"><span id="number"> </span>1 of 3 </div>
        </div>
        <div class="h4 font-weight-bold"> 1. Who is the Prime Minister of India?</div>
        <div class="pt-4">
            <form> <label class="options">Rahul Gandhi <input type="radio" name="radio"> <span class="checkmark"></span> </label> <label class="options">Indira Gandhi <input type="radio" name="radio"> <span class="checkmark"></span> </label> <label class="options">Narendra Modi <input type="radio" name="radio" id="rd" checked> <span class="checkmark"></span> </label> <label class="options">Ram Nath Kovind <input type="radio" name="radio"> <span class="checkmark"></span> </label> </form>
        </div>
        <div class="d-flex justify-content-end pt-2"> <button class="btn btn-primary" id="next1">Next <span class="fas fa-arrow-right"></span> </button> </div>
    </div>
    <div class="wrap" id="q2">
        <div class="text-center pb-4">
            <div class="h5 font-weight-bold"> <span id="number"> </span>2 of 3 </div>
        </div>
        <div class="h4 font-weight-bold"> 2. IPV4 stand's for?</div>
        <div class="pt-4">
            <form> <label class="options">Internet Protocol <input type="radio" name="radio"> <span class="checkmark"></span> </label> <label class="options">Intranet Protocol <input type="radio" name="radio" checked> <span class="checkmark"></span> </label> <label class="options">internet Protocol <input type="radio" name="radio" id="rd"> <span class="checkmark"></span> </label> <label class="options">None of the above <input type="radio" name="radio"> <span class="checkmark"></span> </label> </form>
        </div>
        <div class="d-flex justify-content-end pt-2"> <button class="btn btn-primary mx-3" id="back1"> <span class="fas fa-arrow-left pr-1"></span>Previous </button> <button class="btn btn-primary" id="next2">Next <span class="fas fa-arrow-right"></span> </button> </div>
    </div>
    <div class="wrap" id="q3">
        <div class="text-center pb-4">
            <div class="h5 font-weight-bold"> <span id="number"> </span>3 of 3 </div>
        </div>
        <div class="h4 font-weight-bold"> 3. What is the full form of CSS?</div>
        <div class="pt-4">
            <form> <label class="options">Clarity Style Sheets <input type="radio" name="radio"> <span class="checkmark"></span> </label> <label class="options">Cascading Style Sheets <input type="radio" name="radio"> <span class="checkmark"></span> </label> <label class="options">Confirm Style sheets <input type="radio" name="radio" id="rd" checked> <span class="checkmark"></span> </label> <label class="options">Canvas Style Sheets <input type="radio" name="radio"> <span class="checkmark"></span> </label> </form>
        </div>
        <div class="d-flex justify-content-end pt-2"> <button class="btn btn-primary mx-3" id="back2"> <span class="fas fa-arrow-left pr-2"></span>Previous </button> <button class="btn btn-primary" id="next3">Submit </button> </div>
    </div>
</div>
<div class="d-flex flex-column align-items-center">
    <div class="h3 font-weight-bold text-white">Go Dark</div> <label class="switch"> <input type="checkbox"> <span class="slider round"></span> </label>
</div>
<script src="../assets/js/sidebar.js"></script>

<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>

<script>
    var q1 = document.getElementById("q1");
var q2 = document.getElementById("q2");
var q3 = document.getElementById("q3");

var next1 = document.getElementById('next1')
var back1 = document.getElementById('back1')
var next2 = document.getElementById('next2')
var back2 = document.getElementById('back2')
document.addEventListener('DOMContentLoaded', function () {
let query = window.matchMedia("(max-width: 767px)");
if (query.matches) {
next1.onclick = function () {
q1.style.left = "-650px";
q2.style.left = "15px";
}
back1.onclick = function () {
q1.style.left = "15px";
q2.style.left = "650px";
}
back2.onclick = function () {
q2.style.left = "15px";
q3.style.left = "650px";
}
next2.onclick = function () {
q2.style.left = "-650px";
q3.style.left = "15px";
}
}
else {
next1.onclick = function () {
q1.style.left = "-650px";
q2.style.left = "50px";
}
back1.onclick = function () {
q1.style.left = "50px";
q2.style.left = "650px";
}
back2.onclick = function () {
q2.style.left = "50px";
q3.style.left = "650px";
}
next2.onclick = function () {
q2.style.left = "-650px";
q3.style.left = "50px";
}
}
});


function uncheck() {
var rad = document.getElementById('rd')
rad.removeAttribute('checked')
}
document.addEventListener('DOMContentLoaded', function () {
const main = document.querySelector('body')
const toggleSwitch = document.querySelector('.slider')

toggleSwitch.addEventListener('click', () => {
main.classList.toggle('dark-theme')
})
})
</script> 
</body>
</html>