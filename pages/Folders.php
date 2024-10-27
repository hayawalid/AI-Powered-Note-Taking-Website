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
        /* Style for disabled buttons */
button:disabled {
    background-color: #e0e0e0; /* Light gray background */
    color: #777; /* Dark gray text */
    cursor: not-allowed; /* Changes cursor to indicate disabled state */
    opacity: 0.6; /* Optional: Make button slightly transparent */
    border: none; /* Gray border */
}

/* Optional: More specific targeting if needed */
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
                    <h1>My Folders</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Search">
                        <div class="profile-icon"><i class="fa-regular fa-user"></i></div>
                    </div>
                </div>
                <section class="recent-folders">
                    <div class="filter-buttons">
                        <button>Today</button>
                        <button>This Week</button>
                        <button>This Month</button>
                    </div>

                    <div class="folders">
                        <div class="folder empty" style="display: flex; justify-content: center; align-items: center; ">
                            <button class="new-note" style="margin: auto;">
                                <i class="fa-solid fa-plus"></i> New Note
                            </button>
                        </div>

                        <?php
// Fetch folders
$obj = folder::read();
$colors = ['blue', 'yellow', 'red'];

if ($obj) {
    for ($j = 0; $j < count($obj); $j++) {
        $color = $colors[$j % count($colors)];
        $folderId = $obj[$j]['ID'];
        $folderName = strtolower($obj[$j]['name']); // Normalize name for comparison

        // Check if the folder is the restricted "user guide" folder
        $isUserGuide = ($folderId == 1 && $folderName == 'user guide');
        ?>

        <div class="folder <?php echo $color; ?>">
            <i class="fa-solid fa-folder fold"></i>
            <?php
            echo "<p>" . htmlspecialchars($obj[$j]['name']) . "</p>";
            echo "<span>" . htmlspecialchars($obj[$j]['created_at']) . "</span>";
            ?>
            <i class="fa-solid fa-ellipsis ellipsis"></i>

            <div class="popover">
                <!-- Rename Button -->
                <button class="popover-btn rename"
                        data-folder-id="<?php echo $folderId; ?>"
                        <?php echo $isUserGuide ? 'disabled title="Cannot rename user guide folder"' : ''; ?>>
                    Rename
                </button>

                <button class="popover-btn move"
        data-folder-id="<?php echo $folderId; ?>"
        <?php echo $isUserGuide ? 'disabled title="Cannot move user guide folder"' : ''; ?>>
    Move
</button>

                <!-- Delete Button -->
                <button class="popover-btn delete"
                        data-folder-id="<?php echo $folderId; ?>"
                        <?php echo $isUserGuide ? 'disabled title="Cannot delete user guide folder"' : ''; ?>
                        onclick="<?php echo !$isUserGuide ? "openTrashModal('$folderId')" : ''; ?>">
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

                <!-- <section class="my-notes">
                    <h2>My Notes</h2>
                    <div class="filter-buttons">
                        <button>Today</button>
                        <button>This Week</button>
                        <button>This Month</button>
                        <button>Sort by</button>
                    </div>
                    <div class="notes">
                        <div class="note empty">
                            <button class="new-note">
                                <i class="fa-solid fa-plus"></i> New Note
                            </button>
                        </div>
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
                                exceeds the word limit.Details about mid test exam content and notes. This content will
                                also be truncated if it exceeds the word limit.</p>
                            <span class="bottom">⏱️ 10:30 PM, Monday</span>
                        </div>
                        <div class="note red">
                            <span>12/12/2021</span>
                            <h3>Jonas's Notes <i class="fa-solid fa-pen-to-square"></i></h3>
                            <hr>
                            <p>Details about mid test exam content and notes. This content will be truncated if it
                                exceeds a certain number of wordsDetails about mid test exam content and notes. This
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
                </section> -->
            </section>
        </main>
    </div>

    <script src="../assets/js/sidebar.js"></script>

</body>


</html>