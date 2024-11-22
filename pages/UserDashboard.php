<?php 
include_once '../includes/session.php';

//set current page to update sidebar status
$current_page = 'User dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Notes</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/user_style.css">
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
<body>
<div class="wrapper">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-panel" id="main-panel">
    <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute" style="margin-top: 20px;">
        <div class="container-fluid">
            <div class="navbar-wrapper">
            <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
                <!-- <h3 style="color: black;">Recents</h3> -->
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
                <div class="input-group no-border">
                <input type="text" value="" class="form-control black-placeholder" placeholder="Search..." style="color: black;">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <i class="now-ui-icons ui-1_zoom-bold" style="color: black;"></i>
                    </div>
                </div>
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" href="user_profile.php">
                    <i class="now-ui-icons users_single-02" style="color: black;"></i>
                    <p>
                        <span class="d-lg-none d-md-block" style="color: black;">Account</span>
                    </p>
                </a>
                </li>
            </ul>
            </div>
        </div>
    </nav>
    <main class="content" >
        <section class="bordered-content">
            <h3 style="margin-bottom: 15px;">Recents</h3>
        
            <section class="recent-folders">
                <div class="filter-buttons">
                    <button>Today</button>
                    <button>This Week</button>
                    <button>This Month</button>
                </div>
                <div class="folders">
                    <?php
                    include_once '../includes/folder_class.php'; 
                    include_once '../includes/session.php'; 
                    $user_id = $_SESSION['UserID']; 
                    $obj = folder::readRecent($user_id); 
                    $colors = ['blue', 'yellow', 'red'];
                    if ($obj) {
                        for ($j = 0; $j < count($obj); $j++) {
                            $color = $colors[$j % count($colors)];
                            $folderId = $obj[$j]['ID'];
                            $folderName = strtolower($obj[$j]['name']);
                            $isGeneral = ($folderId == 1 && $folderName == 'general');
                            ?>
                            <div class="folder <?php echo $color; ?>">
                                <i class="fa-solid fa-folder fold"></i>
                                <p><?php echo $obj[$j]['name']; ?></p>
                                <span><?php echo $obj[$j]['created_at']; ?></span>
                                <i class="fa-solid fa-ellipsis ellipsis"></i>
                                <div class="popover" style="z-index: 300000;">
                                    <!-- Rename Button -->
                                    <button class="popover-btn rename"
                                            data-folder-id="<?php echo $folderId; ?>"
                                            >
                                        Rename
                                    </button>
                                    <button class="popover-btn move"
                                            data-folder-id="<?php echo $folderId; ?>"
                                            >
                                        Move
                                    </button>
                                    <!-- Delete Button -->
                                    <button class="popover-btn delete"
                                            data-folder-id="<?php echo $folderId; ?>"
                                            <?php echo $isGeneral ? 'disabled title="Cannot delete General folder"' : ''; ?>
                                            >
                                        Delete
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </section>
            <section class="my-notes">
                <h3 style="margin-bottom: 15px;">My Notes</h3>
                <div class="filter-buttons">
                    <button>Today</button>
                    <button>This Week</button>
                    <button>This Month</button>
                    <button>Sort by</button>
                </div>
                <div class="notes">
                    <div class="note blue">
                        <span>12/12/2021</span>
                        <h3>Mid test exam <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will be truncated if it exceeds a certain number of words.</p>
                        <span class="bottom">⏱️ 10:30 PM, Monday</span>
                    </div>
                    <div class="note yellow">
                        <span>12/12/2021</span>
                        <h3>Mid test exam <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will also be truncated if it exceeds the word limit.</p>
                        <span class="bottom">⏱️ 10:30 PM, Monday</span>
                    </div>
                    <div class="note red">
                        <span>12/12/2021</span>
                        <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will be truncated if it exceeds a certain number of words. Details about mid test exam content and notes. This content will also be truncated if it exceeds the word limit.</p>
                        <span class="bottom">⏱️ 10:30 PM, Monday</span>
                    </div>
                    <div class="note blue">
                        <span>12/12/2021</span>
                        <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will be truncated if it exceeds a certain number of words. Details about mid test exam content and notes. This content will also be truncated if it exceeds the word limit.</p>
                        <span class="bottom">⏱️ 10:30 PM, Monday</span>
                    </div>
                    <div class="note yellow">
                        <span>12/12/2021</span>
                        <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will be truncated if it exceeds a certain number of words. Details about mid test exam content and notes. This content will also be truncated if it exceeds the word limit.</p>
                        <span class="bottom">⏱️ 10:30 PM, Monday</span>
                    </div>
                    <div class="note red">
                        <span>12/12/2021</span>
                        <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will be truncated if it exceeds a certain number of words. Details about mid test exam content and notes. This content will also be truncated if it exceeds the word limit.</p>
                        <span class="bottom">⏱️ 10:30 PM, Monday</span>
                    </div>
                    <div class="note blue">
                        <span>12/12/2021</span>
                        <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                        <hr>
                        <p>Details about mid test exam content and notes. This content will be truncated if it exceeds a certain number of words. Details about mid test exam content and notes. This content will also be truncated if it exceeds the word limit.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                        <div class="note yellow">
                            <span>12/12/2021</span>
                            <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                            <hr>
                            <p>Details about mid test exam content and notes. This content will be truncated if it
                                exceeds a certain number of words.Details about mid test exam content and notes. This
                                content will also be truncated if it exceeds the word limit.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                        <div class="note red">
                            <span>12/12/2021</span>
                            <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                            <hr>
                            <p>Details about mid test exam content and notes. This content will be truncated if it
                                exceeds a certain number of words.Details about mid test exam content and notes. This
                                content will also be truncated if it exceeds the word limit.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                        <div class="note blue">
                            <span>12/12/2021</span>
                            <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                            <hr>
                            <p>Details about mid test exam content and notes. This content will be truncated if it
                                exceeds a certain number of words.Details about mid test exam content and notes. This
                                content will also be truncated if it exceeds the word limit.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                    </div>
                </section>
            </section>
        </main>
    </div>
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

</body>

</html>