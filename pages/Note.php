<?php
// include '../includes/user_sidebar.php';
include '../includes/config.php';
include_once '../includes/session.php';

//set current page to update sidebar status
$current_page = 'My Note';
$file_id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($file_id !== null) {
  $sql = "SELECT content FROM files WHERE id=$file_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $content = $row["content"];
    }
  } else {
    $content = "No content found.";
  }
} else {
  $content = "Invalid file ID.";
}

// Disable strict mode temporarily
$conn->query("SET sql_mode = ''");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/user_style.css">
  <!-- <script src="../assets/js/sidebar.js"></script> -->
  <script src="../assets/js/Note.js"></script>
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'>
  <!-- <link rel="stylesheet" href="./style.css"> -->
  <link rel="stylesheet" href="../assets/css/Note.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;1,400&display=swap"
    rel="stylesheet">


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
  <title>Document</title>
</head>

<body class="Bootstrap-body">

  <!-- <h1 class="text-center">Esm el folder w el note el mafto7a</h1> -->
  <div id="container-fluid">
    <div class="wrapper">
      <?php include '../includes/sidebar.php'; ?>
      <div class="row come-in">



        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 note-content centered">
          <div class="panel panel-info">
            <div class="panel-heading">Name your file
              <button class="btn btn-primary Edit">Edit</button>
              <button class="btn btn-primary summarize">Summerize ✨</button>
            </div>

            <div class="panel-body">
              <p> <?php include '../includes/FileContent_class.php';
              echo $content; ?></p>
            </div>

          </div>

        </div>

        <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 summaried-class">
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
  </div>

  </div>


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