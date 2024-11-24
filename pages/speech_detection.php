<?php 
include '../includes/config.php';
include '../includes/FileContent_class.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="../assets/css/soundvisualizer.css">
    <!-- <script src="../assets/js/sidebar.js"></script> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/microsoft-cognitiveservices-speech-sdk@latest/distrib/browser/microsoft.cognitiveservices.speech.sdk.bundle.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
	<link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'><link rel="stylesheet" href="./style.css">
	<title>detection</title>
</head>




<body>
  
  <div class="sound-recorder-wrapper">
    <h1>🎤 Sound Recorder</h1>
    <div class="instructions">
      <h3>📋 How to Use:</h3>
      <p><span class="emoji">🎧</span> Ensure your microphone is turned on and ready to go.</p>
      <p><span class="emoji">🔴</span> Press <strong>Start</strong> to begin recording your audio.</p>
      <p><span class="emoji">⏸️</span> Press <strong>Pause</strong> to stop recording.</p>
      <p><span class="emoji">💾</span> Press <strong>Save & Transcribe</strong> to save and convert your audio into text.</p>
    </div>
 
    <div class="sound-wave" id="soundWave"></div>
    <button id="start-recognition" >Start</button>
    <button id="stop-recognition" disabled>Pause</button>
    <button id="start-over" >Start Over</button>
    <button id="save-content" >Save & Transcribe</button>
  </div>

  <!-- <div class="speech-content" id="content"> -->
    
  </div>
  <!-- <script src="../assets/js/soundvisualizer.js"></script> -->
  <script src="../assets/js/Speech-detection.js"></script>
</body>

</html>