<?php
include_once '../includes/session.php';

//set current page to update sidebar status
$current_page = 'Folder Content';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Folders</title>
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="../assets/css/folders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .note,
        .folder {
            height: 12.5em !important;
        }

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
            <nav class="navbar navbar-expand-lg navbar-transparent bg-primary navbar-absolute"
                style="margin-top: 20px;">
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
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end mr-3" id="navigation">
                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control black-placeholder"
                                    placeholder="Search..." style="color: black;">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="now-ui-icons ui-1_zoom-bold" style="color: black;"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
            <main class="content">
                <section class="bordered-content">
                    <h3 style="margin-bottom: 15px;">
                        <?php
                        $current_folder_id = $_GET['folder_id'] ?? 1;
                        $current_folder = new folder($current_folder_id);
                        echo htmlspecialchars($current_folder->name);
                        ?>
                    </h3>
                    <section class="recent-folders">
                        <div class="filter-buttons">
                            <button>Today</button>
                            <button>This Week</button>
                            <button>This Month</button>
                        </div>
                        <div class="folders">
                            <div class="folder empty"
                                style="display: flex; justify-content: center; align-items: center; height: 12.5em !important;">
                                <button class="new-note" style="margin: auto;" id="new-note">
                                    <i class="fa-solid fa-plus"></i> New Note
                                </button>
                            </div>
                            <?php
                            include_once '../includes/folder_class.php';
                            $current_folder_id = $_GET['folder_id'] ?? 1;
                            $user_id = $_SESSION['UserID'];
                            if (!isset($_SESSION['UserID'])) {
                                die('User ID is not set in session. Please log in.');
                            }

                            if (!isset($user_id)) {
                                die('User ID is not set in session');
                            }

                            $folders = folder::readByParent($user_id, $current_folder_id);  // Pass both user ID and parent folder ID
                            
                            $colors = ['blue', 'yellow', 'red'];
                            foreach ($folders as $index => $folder) {
                                $isGeneral = ($folder['ID'] == 1 && strtolower($folder['name']) == 'general');  // Check if it's the "General" folder
                                $color = $colors[$index % count($colors)];
                                echo "<div class='folder $color'>";
                                echo "<a href='folder_contents.php?folder_id=" . $folder['ID'] . "'>";
                                echo "<i class='fa-solid fa-folder fold'></i>";
                                echo "<p>" . htmlspecialchars($folder['name']) . "</p>";
                                echo "<span class='date'>" . htmlspecialchars($folder['created_at']) . "</span>";
                                echo "</a>";
                                echo "<i class='fa-solid fa-ellipsis ellipsis'></i>";
                                echo "<div class='popover' style='z-index: 300000; display: none;'>";
                                echo "<button class='popover-btn rename' data-folder-id='" . $folder['ID'] . "' " . ($isGeneral ? 'disabled title=\"Cannot rename General folder\"' : '') . ">Rename</button>";
                                echo "<button class='popover-btn move' data-folder-id='" . $folder['ID'] . "' " . ($isGeneral ? 'disabled title=\"Cannot move General folder\"' : '') . ">Move</button>";
                                echo "<button class='popover-btn delete' data-folder-id='" . $folder['ID'] . "' " . ($isGeneral ? 'disabled title=\"Cannot delete General folder\"' : '') . " onclick='" . (!$isGeneral ? "openTrashModal('{$folder['ID']}')" : '') . "'>Delete</button>";
                                echo "</div>";
                                echo "</div>";
                            }

                            ?>
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
                                        <h3><?php echo htmlspecialchars($file['name'], ENT_QUOTES, 'UTF-8'); ?> <i
                                                class="fa-solid fa-pen-to-square"></i></h3>
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