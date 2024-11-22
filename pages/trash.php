<?php
include_once '../includes/session.php';
include_once '../includes/trash_class.php';
$current_page = 'Trash';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css" rel="stylesheet" />
    <link href="../assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        .folder.red {
            background-color: #ffcccb;
            border: 1px solid #ff8885;
        }
        .folder.yellow {
            background-color: #fff7cc;
            border: 1px solid #ffd700;
        }
        .folder.blue {
            background-color: #cce5ff;
            border: 1px solid #85c1ff;
        }
        .folder {
            padding: 15px;
            margin: 10px;
            border-radius: 8px;
            text-align: center;
            position: relative;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }
        .action-buttons .btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.2rem;
        }
        .btn.restore {
            color: #4caf50;
        }
        .btn.delete {
            color: #f44336;
        }
    </style>
</head>

<body>
<div class="container">
<?php include '../includes/sidebar.php'; ?>
    <main class="main-content">
        <section class="bordered-content">
            <div class="page-header">
                <h1 style="color:#3a3a3a;">Recently Deleted</h1>
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <a class="profile-icon" style="cursor: pointer;" href="user_profile.php"><i class="fa-regular fa-user"></i></a>
                </div>
            </div>
            <section class="recent-folders">
                <div class="folders">
                    <?php
                    $user_id = $_SESSION['UserID'];  // Get user ID from session
                    $trashItems = trash::readTrash($user_id);  // Fetch trash items
                    $colors = ['red', 'yellow', 'blue']; // Color cycle array

                    if ($trashItems) {
                        foreach ($trashItems as $index => $item) {
                            $color = $colors[$index % count($colors)]; // Cycle through colors
                            ?>
                            <div class="folder <?php echo $color; ?>">
                                <i class="fa-solid fa-folder fold"></i>
                                <p><?php echo htmlspecialchars($item['name']); ?></p>
                                <span><?php echo htmlspecialchars($item['deleted_at']); ?></span>
                                <div class="action-buttons">
                                    <!-- Restore Icon -->
                                    <button class="btn restore" 
                                            onclick="restoreItem('<?php echo $item['folder_id']; ?>')"
                                            title="Restore">
                                        <i class="fa-solid fa-rotate-left" style="font-size: 1rem;"></i>
                                    </button>
                                    <!-- Delete Icon -->
                                    <button class="btn delete" 
                                            onclick="deletePermanently('<?php echo $item['folder_id']; ?>')"
                                            title="Delete Permanently">
                                        <i class="fa-solid fa-trash" style="font-size: 1rem;"></i>

                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="folder empty" style="display: flex; justify-content: center; align-items: center;">
                            <p>No items in trash.</p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </section>
        </section>
    </main>
</div>

<script src="../assets/js/sidebar.js"></script>


</body>
</html>
