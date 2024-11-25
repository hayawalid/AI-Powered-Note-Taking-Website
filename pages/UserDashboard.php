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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
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
        /* Make sure the .note div is positioned relatively so popovers can be placed relative to it */
        .note {
            position: relative;
        }

        /* Style the popover */
        .popover {
            position: absolute;
            top: 0;
            /* Adjust this if you want to move it up or down */
            width: 8em;
            right: 100%;
            /* Positions it to the right of the note div */
            margin-left: 10px;
            /* Optional: Adds space between the div and the popover */
            display: none;
            /* Hide the popover by default */
            background: #fff;
            /* Popover background */
            border: 1px solid #ccc;
            /* Optional: border for the popover */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            /* Optional: shadow for better visibility */
            z-index: 300000;
            /* Make sure the popover is on top */
        }

        /* Show the popover when it's needed (e.g., on hover or click) */
        .note:hover .popover {
            display: block;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div class="main-panel" id="main-panel">
            <?php include '../includes/user_navbar.php'?>
            <main class="content">
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
                                            <button class="popover-btn rename" data-folder-id="<?php echo $folderId; ?>">
                                                Rename
                                            </button>
                                            <button class="popover-btn move" data-folder-id="<?php echo $folderId; ?>">
                                                Move
                                            </button>
                                            <!-- Delete Button -->
                                            <button class="popover-btn delete" data-folder-id="<?php echo $folderId; ?>">
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

                            <?php

                            // Get the user ID from the session
                            $user_id = $_SESSION['UserID'];

                            // Get the folder_id from the URL, if provided
                            $folder_id = isset($_GET['folder_id']) ? $_GET['folder_id'] : null;

                            // Fetch the files for the current folder or general view (no folder filter)
                            $files = file::readAll($user_id, $folder_id);
                            ?>

                            <!-- Loop through the fetched files and display them -->
                            <?php if ($files): ?>
                                <?php foreach ($files as $index => $file): ?>
                                    <div class="note <?php echo $colors[$index % 3]; ?>">
                                        <span><?php echo date('d/m/Y', strtotime($file['created_at'])); ?></span>
                                        <h3><?php echo htmlspecialchars($file['name'], ENT_QUOTES, 'UTF-8'); ?>
                                            <i class="fa-solid fa-ellipsis ellipsis"></i>

                                            <div class="popover" style="z-index: 300000;">
                                                <!-- Rename Button -->
                                                <button class="popover-btn rename" data-folder-id="<?php echo $folderId; ?>">
                                                    Rename
                                                </button>
                                                <button class="popover-btn move" data-folder-id="<?php echo $folderId; ?>">
                                                    Move
                                                </button>
                                                <!-- Delete Button -->
                                                <button class="popover-btn delete" data-folder-id="<?php echo $folderId; ?>">
                                                    Delete
                                                </button>
                                            </div>
                                        </h3>
                                        <hr>
                                        <p><?php echo strlen($file['content']) > 100 ? substr($file['content'], 0, 100) . '...' : $file['content']; ?>
                                        </p>
                                        <span
                                            class="bottom"><?php echo "⏱️ " . date('h:i A, l', strtotime($file['created_at'])); ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>No files found for this folder.</p>
                            <?php endif; ?>

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