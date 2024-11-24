<?php
    include_once '../includes/session.php'; 

    //set current page to update sidebar status
    $current_page = 'Upload File';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/uploads.css">
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  
</head>

<body>
<?php session_start(); // Start the session to use $_SESSION variables ?>
    <div class="container">
        <?php include '../includes/sidebar.php'; ?>


        <div class="containers">
            <div class="card">
                <h3>Upload Files</h3>
                <div class="drop_box">
                    <header>
                        <h4>Select File here</h4>
                    </header>
                    <p>Files Supported: PDF, TEXT, DOC , DOCX</p>
                    <input type="file" hidden accept=".doc,.docx,.pdf" id="fileID" style="display:none;">
                    <button class="btn">Choose File</button>
                </div>

            </div>
        </div>


    </div>
    <script>
        const dropArea = document.querySelector(".drop_box"),
            button = dropArea.querySelector("button"),
            dragText = dropArea.querySelector("header"),
            input = dropArea.querySelector("input");
        let file;
        var filename;

        button.onclick = () => {
            input.click();
        };

        input.addEventListener("change", function (e) {
            var fileName = e.target.files[0].name;
            let filedata = `
    <form action="" method="post">
    <div class="form">
    <h4>${fileName}</h4>
    <input type="text" placeholder="Rename file">
    <button class="btn">Upload</button>
    </div>
    </form>`;
            dropArea.innerHTML = filedata;
        });

    </script>
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
</body>

</html>