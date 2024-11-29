<?php
include_once '../includes/session.php';

//set current page to update sidebar status
$current_page = 'Folders';
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
        /* Style for disabled buttons */
        button:disabled {
            background-color: #e0e0e0;
            /* Light gray background */
            color: #777;
            /* Dark gray text */
            cursor: not-allowed;
            /* Changes cursor to indicate disabled state */
            opacity: 0.6;
            /* Optional: Make button slightly transparent */
            border: none;
            /* Gray border */
        }

        /* Optional: More specific targeting if needed */
        .popover-btn:disabled {
            background-color: #e0e0e0;
            color: #888;
        }

        .black-placeholder::placeholder {
            color: black !important;
            opacity: 1;
        }

        .filter-buttons button.active {
            background-color: #f1f1f1;
            color: #555;
            border-radius: 5px;
            border-bottom: 1px solid black;


        }

        .filter-buttons {
            display: flex;
            gap: 10px;
        }


        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown button */
        .dropbtn {
            padding: 8px 12px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .dropbtn:hover {
            background-color: #0056b3;
        }

        /* Dropdown content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 4px;
            overflow: hidden;
        }

        /* Links inside dropdown */
        .dropdown-content a {
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        /* Show the dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include '../includes/sidebar.php'; ?>
        <div class="main-panel" id="main-panel">
            <?php include '../includes/user_navbar.php'; ?>
            <main class="content">
                <section class="bordered-content">
                    <h3 style="margin-bottom: 15px;">My Folders</h3>
                    <section class="recent-folders">
                    <div class="filter-buttons">
    <button class="filter-btn" data-filter="today">Today</button>
    <button class="filter-btn" data-filter="this week">This Week</button>
    <button class="filter-btn" data-filter="this month">This Month</button>
    <div class="dropdown">
        <button class="dropbtn">Sort by</button>
        <div class="dropdown-content">
            <a href="#" data-sort="name">Name</a>
            <a href="#" data-sort="created">Date Created</a>
            <a href="#" data-sort="modified">Last Modified</a>
        </div>
    </div>
</div>

                        <div class="folders">
                            <div class="folder empty"
                                style="display: flex; justify-content: center; align-items: center;">
                                <button class="new-note" style="margin: auto;" id="new-note">
                                    <i class="fa-solid fa-plus"></i> New Note
                                </button>
                            </div>
                            <?php
                            $current_folder_id = $_GET['folder_id'] ?? 1;
                            $user_id = $_SESSION['UserID'];
                            $obj = folder::readByParent($user_id, $current_folder_id);
                            $colors = ['blue', 'yellow', 'red'];
                            if ($obj) {
                                for ($j = 0; $j < count($obj); $j++) {
                                    $color = $colors[$j % count($colors)];
                                    $folderId = $obj[$j]['ID'];
                                    $folderName = strtolower($obj[$j]['name']);
                                    $isGeneral = ($folderId == 1 && $folderName == 'general');
                                    ?>
                                    <div class="folder <?php echo $color; ?>"
                                        data-created-at="<?php echo htmlspecialchars($obj[$j]['created_at']); ?>">
                                        <i class="fa-solid fa-folder fold"></i>
                                        <a href="folder_contents.php?folder_id=<?php echo $folderId; ?>"
                                            style="text-decoration: none; color: inherit;">
                                            <p><?php echo htmlspecialchars($obj[$j]['name']); ?></p>
                                        </a>
                                        <span><?php echo htmlspecialchars($obj[$j]['created_at']); ?></span>
                                        <i class="fa-solid fa-ellipsis ellipsis"></i>
                                        <div class="popover" id="popover" style="z-index: 300000; display: none;">
                                            <!-- Rename Button -->
                                            <button class="popover-btn rename"
                                                data-folder-id="<?php echo $folderId; ?>">Rename</button>
                                            <button class="popover-btn move"
                                                data-folder-id="<?php echo $folderId; ?>">Move</button>
                                            <!-- Delete Button -->
                                            <button class="popover-btn delete" data-folder-id="<?php echo $folderId; ?>"
                                                onclick="<?php echo !$isGeneral ? "openTrashModal('$folderId')" : ''; ?>">Delete</button>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>

                        </div>
                    </section>
                </section>
            </main>
        </div>
    </div>
    <script src="../assets/js/sidebar.js"></script>

    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <script src="../assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-buttons .filter-btn');
    const sortLinks = document.querySelectorAll('.dropdown-content a');
    const folders = document.querySelectorAll('.folder');

    // Function to sort folders based on selected sort criteria
    function sortElements(elements, sortBy) {
        let sortedElements = Array.from(elements);
        sortedElements.sort((a, b) => {
            if (sortBy === 'name') {
                return a.querySelector('p').textContent.localeCompare(b.querySelector('p').textContent);
            } else if (sortBy === 'created') {
                return new Date(a.getAttribute('data-created-at')) - new Date(b.getAttribute('data-created-at'));
            } else if (sortBy === 'modified') {
                return new Date(a.getAttribute('data-modified-at')) - new Date(b.getAttribute('data-modified-at'));
            }
        });
        return sortedElements;
    }

    // Function to apply filter and sort
    function applyFilterAndSort(filter = null, sortBy = null) {
        const today = new Date();
        let startDate;

        if (filter === 'today') {
            startDate = new Date(today.setHours(0, 0, 0, 0));
        } else if (filter === 'this week') {
            const firstDayOfWeek = today.getDate() - today.getDay();
            startDate = new Date(today.setDate(firstDayOfWeek));
            startDate.setHours(0, 0, 0, 0);
        } else if (filter === 'this month') {
            startDate = new Date(today.getFullYear(), today.getMonth(), 1);
            startDate.setHours(0, 0, 0, 0);
        }

        let filteredFolders = Array.from(folders);

        // Apply the filter if a filter is specified
        if (filter) {
            filteredFolders = filteredFolders.filter(folder => new Date(folder.getAttribute('data-created-at')) >= startDate);
        }

        // Apply sorting if a sort criterion is specified
        if (sortBy) {
            filteredFolders = sortElements(filteredFolders, sortBy);
        }

        // Update the folder container with sorted/filtered folders
        const folderContainer = document.querySelector('.folders');
        folderContainer.innerHTML = ''; // Clear current folder list
        filteredFolders.forEach(folder => folderContainer.appendChild(folder));
    }

    // Event listeners for filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const isActive = this.classList.contains('active');
            
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));

            // Toggle active class for the clicked button and apply filter
            if (isActive) {
                applyFilterAndSort();
            } else {
                this.classList.add('active');
                applyFilterAndSort(this.getAttribute('data-filter'));
            }
        });
    });

    // Event listeners for sort dropdown links
    sortLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();

            // Remove active class from all sort options
            sortLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');

            // Apply filter and sorting based on the selected option
            applyFilterAndSort(null, this.getAttribute('data-sort'));
        });
    });
});

</script>


</body>

</html>