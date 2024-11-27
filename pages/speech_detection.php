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
</head>
 
<body>
  <div class="wrapper">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-panel" id="main-panel">
    <main class="content">
    <section class="bordered-content">
      <div class="sound-recorder-wrapper">
        <h1>🎤 Sound Recorder</h1>
        <div class="instructions">
          <!-- <h3>📋 How to Use:</h3> -->
          <p><span class="emoji">🎧</span> Ensure your microphone is turned on and ready to go.</p>
          <p><span class="emoji">🔴</span> Press <strong>Start</strong> to begin recording your audio.</p>
          <p><span class="emoji">⏸️</span> Press <strong>Pause</strong> to stop recording.</p>
          <p><span class="emoji">💾</span> Press <strong>Save & Transcribe</strong> to save and convert your audio into
            text.</p>
        </div>

        <!-- <div class="sound-wave" id="soundWave"></div> -->
        <canvas id="sineCanvas" width="800" height="400"></canvas>
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