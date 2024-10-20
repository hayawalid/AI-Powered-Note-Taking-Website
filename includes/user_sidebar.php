<aside class="sidebar" id="sidebar">
    <div class="logo">
        <h2>MINO</h2>
    </div>
    <button class="add-new">
        <div class="add-icon">+</div> New
        <div class="color-options">
            <span class="dot yellow"></span>
            <span class="dot green"></span>
            <span class="dot red"></span>
        </div>
    </button>

    <ul class="menu">

        <ul class="menu">
            <a href="./UserDashboard.php">
                <li>
                    <span class="icon"><i class="fa-solid fa-house" style="font-size:20px;"></i></span> Home
                </li>
            </a>
            <a href="./trash.php">
                <li>
                    <span class="icon">🗑️</span> Trash
                </li>
            </a>

            <a href="./Folders.php">
                <li>
                    <span class="icon">🗂️</span> Folders
                </li>
            </a>
            <a href="./.php">
                <li>
                    <span class="icon">🎤</span> Speech to Text
                </li>
            </a>
            <a href="./uploads.php">
                <li>
                    <span class="icon"><i class="fa-solid fa-upload" style="font-size:20px;"></i></span> Upload
                </li>
            </a>

        </ul>
    </ul>
    <div class="pro-upgrade">
        <img src="/images/Medal free icons designed by Freepik.jpg" alt="Upgrade icon">
        <p>Want to access unlimited notes taking experience?</p>
        <button>Upgrade Pro</button>
    </div>
</aside>
<main class="main-content">
    <header class="header">
        <div class="search-profile">
            <div class="toggle-sidebar">
                <i class="fa-solid fa-bars" id="hamburger-icon"></i>
                <i class="fa-solid fa-xmark" id="close-icon" style="display: none;"></i>
            </div>
        </div>
    </header>
</main>
<div class="pop-up">
    <div class="content">
        <div class="container">
            <div class="dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
            <span class="close"><i class="fa-solid fa-xmark"></i></span>
            <!-- <div class="title">
                <h1>Add</h1>
            </div> -->
            <div class="add-item">
                <!-- <form>
                        <label for="type">Type:</label>
                        <select id="type">
                            <option value="folder">Folder</option>
                            <option value="file">File</option>
                        </select>

                        <label for="name">Name:</label>
                        <input type="text" id="name" placeholder="Enter name" required>

                        <div class="buttons">
                            <button type="submit" class="save">Save</button>
                        </div>
                    </form> -->
                <form action="#">
                    <h1>What's on Your Mind?💡</h1>
                    <div class="form-row">
                        <img src="/images/flower.png" alt="Upgrade icon" width="100px">
                        <div class="input-data">
                            <input type="text" required>
                            <div class="underline"></div>
                            <label for="">Name</label>
                            <select id="dropdown" name="dropdown">
                                <option value="option1">Choose..</option>
                                <option value="option2">Folder</option>
                                <option value="option3">File</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data textarea">
                            <br />
                            <div class="underline"></div>
                            <br />
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <div class="inner"></div>
                                    <input type="submit" value="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>