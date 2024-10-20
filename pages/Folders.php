<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Folders</title>
    <link rel="stylesheet" href="../assets/css/user_style.css">
    <link rel="stylesheet" href="../assets/css/folders.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="main-container">
        <?php include '../includes/user_sidebar.php'; ?>
        <main class="content-area">
            <section class="content-box">
                <div class="page-header">
                    <h1>My Folders</h1>
                    <div class="search-bar">
                        <input type="text" placeholder="Search">
                        <div class="profile-icon">👤</div>
                    </div>
                </div>
                <section class="recent-items">
                    <div class="filter-options">
                        <button>Today</button>
                        <button>This Week</button>
                        <button>This Month</button>

                    </div>
                    <div class="item-list">
                        <div class="item blue">
                            <i class="fa-solid fa-folder fold"></i>
                            <p>Movie Review</p>
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item red">
                            <i class="fa-solid fa-folder fold"></i>
                            Class Notes
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item yellow">
                            <i class="fa-solid fa-folder fold"></i>
                            Book Lists
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item blue">
                            <i class="fa-solid fa-folder fold"></i>
                            <p>Movie Review</p>
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item red">
                            <i class="fa-solid fa-folder fold"></i>
                            Class Notes
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item yellow">
                            <i class="fa-solid fa-folder fold"></i>
                            Book Lists
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item blue">
                            <i class="fa-solid fa-folder fold"></i>
                            <p>Movie Review</p>
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item red">
                            <i class="fa-solid fa-folder fold"></i>
                            Class Notes
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        <div class="item yellow">
                            <i class="fa-solid fa-folder fold"></i>
                            Book Lists
                            <span class="date">12/12/2021</span>
                            <i class="fa-solid fa-ellipsis options-menu"></i>
                        </div>
                        
                    </div>
                </section>
            </section>
        </main>
    </div>

    <!-- <div class="folderr-container">
        <div class="folderr blue">
            <div class="folderr-front">
                <div class="label">Work</div>
            </div>
            <div class="papers"></div>
        </div>
        <div class="folderr pink">
            <div class="folderr-front">
                <div class="label">Personal</div>
            </div>
            <div class="papers"></div>
        </div>
        <div class="folderr blue">
            <div class="folderr-front">
                <div class="label">Work</div>
            </div>
            <div class="papers"></div>
        </div>
        <div class="folderr pink">
            <div class="folderr-front">
                <div class="label">Personal</div>
            </div>
            <div class="papers"></div>
        </div>
        <div class="folderr pink">
            <div class="folderr-front">
                <div class="label">Personal</div>
            </div>
            <div class="papers"></div>
        </div>

    </div> -->
    <script src="../assets/js/sidebar.js"></script>
</body>


</html>