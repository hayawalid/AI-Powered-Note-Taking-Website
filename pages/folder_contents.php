<?php 
include_once '../includes/session.php';
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
    </style>
</head>

<body>
    <div class="container">
        <?php include '../includes/user_sidebar.php'; ?>
        <main class="main-content">
            <section class="bordered-content">
                <div class="page-header">
                    <h1>
                        <?php
                        $current_folder_id = $_GET['folder_id'] ?? 1;
                        $current_folder = new folder($current_folder_id);
                        echo htmlspecialchars($current_folder->name);
                        ?>
                    </h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Search">
                        <div class="profile-icon"></div>
                    </div>
                </div>
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
                            echo "<div class='popover' style='z-index: 300000;'>";
                            echo "<button class='popover-btn rename' data-folder-id='" . $folder['ID'] . "' " . ($isGeneral ? 'disabled title=\"Cannot rename General folder\"' : '') . ">Rename</button>";
                            echo "<button class='popover-btn move' data-folder-id='" . $folder['ID'] . "' " . ($isGeneral ? 'disabled title=\"Cannot move General folder\"' : '') . ">Move</button>";
                            echo "<button class='popover-btn delete' data-folder-id='" . $folder['ID'] . "' " . ($isGeneral ? 'disabled title=\"Cannot delete General folder\"' : '') . " onclick='" . (!$isGeneral ? "openTrashModal('{$folder['ID']}')" : '') . "'>Delete</button>";
                            echo "</div>";
                            echo "</div>";
                        }

                        ?>
                        <!-- Example of static note, replace with dynamic notes if needed -->
                        <div class="note blue">
                            <span>12/12/2021</span>
                            <h3>Mid test exam <i class="fa-solid fa-pen-to-square"></i></h3>
                            <hr>
                            <p>Details about mid test exam content and notes. This content will be truncated if it
                                exceeds a certain number of words.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                        <div class="note yellow">
                            <span>12/12/2021</span>
                            <h3>Mid test exam <i class="fa-solid fa-pen-to-square"></i></h3>
                            <hr>

                            <p>Details about mid test exam content and notes. This content will also be truncated if it
                                exceeds the word limit.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                    </div>
                </section>
            </section>
        </main>
    </div>
    <script src="../assets/js/sidebar.js"></script>
</body>

</html>