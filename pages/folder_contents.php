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
        .note, .folder {
            height: 12.5em !important;
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
                        <div class="folder empty" style="display: flex; justify-content: center; align-items: center; height: 12.5em !important;">
                            <button class="new-note" style="margin: auto;">
                                <i class="fa-solid fa-plus"></i> New Note
                            </button>
                        </div>
                        <?php
                        $sql = "SELECT * FROM folders WHERE folder_id = $current_folder_id";
                        $result = mysqli_query($con, $sql);
                        while ($folder = mysqli_fetch_assoc($result)) {
                            echo "<div class='folder blue'>";
                            echo "<a href='folder-content.php?folder_id=" . $folder['ID'] . "'>";
                            echo "<i class='fa-solid fa-folder fold'></i>";
                            echo "<p>" . htmlspecialchars($folder['name']) . "</p>";
                            echo "<span class='date'>" . htmlspecialchars($folder['created_at']) . "</span>";
                            echo "</a>";

                            echo "<i class='fa-solid fa-ellipsis ellipsis'></i>";
                            echo "<div class='popover'>";
                            echo "<button class='popover-btn'>Edit</button>";
                            echo "<button class='popover-btn'>Move</button>";
                            echo "<button class='popover-btn'>Delete</button>";
                            echo "</div>";
                            echo "</div>";
                        }
                        ?>
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
                    </div>
                </section>
            </section>
        </main>
    </div>
    <script src="../assets/js/sidebar.js"></script>
</body>
</html>
