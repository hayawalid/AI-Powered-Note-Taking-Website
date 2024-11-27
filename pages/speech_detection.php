<?php
include '../includes/config.php';
include '../includes/FileContent_class.php';
include_once '../includes/session.php';

//set current page to update sidebar status
$current_page = 'Speech To Text';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../assets/css/user_style.css">
  <link rel="stylesheet" href="../assets/css/soundvisualizer.css">
  <script src="../assets/js/sidebar.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <script
    src="https://cdn.jsdelivr.net/npm/microsoft-cognitiveservices-speech-sdk@latest/distrib/browser/microsoft.cognitiveservices.speech.sdk.bundle.js"></script>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
  <link href="../assets/css/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/css/user_style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <title>Speech Detection</title>
  <style>
    .header-text {
      margin-bottom: 34px;
    }

    .header-text h3 {
      font-weight: bold !important;
      font-size: 28px !important;
      margin-bottom: 5px;
    }

    .header-text p {
      font-weight: bold !important;
      font-size: 13px !important;
      text-transform: uppercase;
    }

    .instructions {
      display: flex;
      justify-content: center;
    }

    .instructions div {
      margin: 50px;
    }

    .instructions p {
      font-size: 13px;
      width: 175px;
    }

    img {
      height: 100px;
      width: 100px;
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-panel" id="main-panel">
      <main class="content">
        <section class="bordered-content">
          <div class="sound-recorder-wrapper">
            <div class="header-text">
              <h3><span class="mr-2"><i class="bi bi-mic"></i></span> Sound Recorder</h3>
              <p>Make sure your microphone is turned on and <br> ready to go.</p>
            </div>
            <div class="instructions">
              <!-- <h3>📋 How to Use:</h3> -->
              <div>
                <img src="../assets/images/record.png" alt="record icon">
                <p>Press <strong>Start</strong> to begin recording your audio.</p>
              </div>
              <div>
                <img src="../assets/images/pause.png" alt="pause icon">
                <p>Press <strong>Pause</strong> to stop recording.</p>
              </div>
              <div>
                <img src="../assets/images/save.png" alt="save icon">
                <p>Press <strong>Save & Transcribe</strong> to save and convert your audio into
                  text.</p>
              </div>
            </div>

            <!-- <div class="sound-wave" id="soundWave"></div> -->
            <canvas id="sineCanvas" width="800" height="200"></canvas>
            <button id="start-recognition">Start</button>
            <button id="stop-recognition" disabled>Pause</button>
            <button id="start-over">Start Over</button>
            <button id="save-content">Save & Transcribe</button>
          </div>

          <!-- <div class="speech-content" id="content"> -->
        </section>
      </main>
    </div>
  </div>
  </div>
  <!-- <script src="../assets/js/soundvisualizer.js"></script> -->
  <script src="../assets/js/Speech-detection.js"></script>
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

</body>

</html>