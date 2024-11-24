<?php 
// include '../includes/user_sidebar.php';
include '../includes/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <!-- <script src="../assets/js/sidebar.js"></script> -->
    <script src="../assets/js/Note.js"></script>
    <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.css'><link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="../assets/css/Note.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body class="Bootstrap-body">

<!-- <h1 class="text-center">Esm el folder w el note el mafto7a</h1> -->
<div id="container-fluid">
  <div class="row come-in">
    
   
    
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 note-content centered">
      <div class="panel panel-info">
        <div class="panel-heading">Name your file
        <button class="btn btn-primary Edit">Edit</button> 
        <button class="btn btn-primary summarize">Summerize ✨</button> 
        </div>
       
        <div class="panel-body">
          <p> <?php include '../includes/FileContent_class.php'; echo $content; ?></p>
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




</body>
</html>