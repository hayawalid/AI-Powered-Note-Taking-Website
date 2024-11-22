<?php
include_once '../includes/User.php';
include '../includes/folder_class.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $type = $_POST['dropdown'];
    $parent_folder_id = $_GET['folder_id'] ?? 1;
    $user_id = $_SESSION['UserID']; 

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }
    if ($type == "option2") {
        $new_folder_id = folder::create($name, $user_id, $parent_folder_id); 
        if ($new_folder_id) {
            
            header("Location:../pages/folder_contents.php?folder_id=$new_folder_id");
            // header("Location:../pages/UserDashboard.php");
            exit();
        } else {
            echo "ERROR!";
        }
    } else {
        echo "Invalid folder type!";
    }
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    echo "Received Folder ID: " . $id . "<br>";
    if ($id) {
        if (folder::moveToTrash($id)) {
            header("Location: ../pages/Folders.php");
            exit();
        } else {
            echo "Error moving folder to trash.";
        }
    } else {
        echo "No folder ID provided.";
    }
}

$user = new User($_SESSION['UserID']);
if (!$user) {
  header("Location: " . htmlspecialchars('./index.php'));
}
?>
<div class="sidebar" data-color="white">
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      📝  SMARTNOTES
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <?php
        if($user->userType_obj->id == 2) {
          echo "
          </li>
          <li class='' id='add-new'>
            <a href='' style='display:flex; border-color: black;' onclick='event.preventDefault();'>
              <i class='now-ui-icons ui-1_simple-add add-icon' style='transform: scaleX(-1);'></i>
              <p>New</p>
              <div class='color-options'>
                <span class='dot yellow'></span>
                <span class='dot green'></span>
                <span class='dot red'></span>
              </div>
            </a>
          </li>
          ";
        }
        foreach ($user->userType_obj->pages_array as $page) {
          $friendly_name = htmlspecialchars($page->friendly_name, ENT_QUOTES, 'UTF-8');
          $url = htmlspecialchars($page->link_address, ENT_QUOTES, 'UTF-8');
          $is_active = ($current_page == $friendly_name) ? 'active' : '';
          $icon = htmlspecialchars($page->link_icon, ENT_QUOTES, 'UTF-8');

          echo "
          <li class='$is_active'>
            <a href='$url'>
              <i class='now-ui-icons $icon'></i>
              <p>$friendly_name</p>
            </a>
          </li>";
        }
      ?>
      <li class="active-pro">
        <a href="./logout.php">
          <i class="now-ui-icons sport_user-run" style="transform: scaleX(-1);"></i>
          <p>Log out</p>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="overlay"></div>
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

                <form action="" method="post">
                    <h3>What's on Your Mind?💡</h3>
                    <div class="form-row">
                      <div style="display: flex; align-content: center; justify-content: center;">
                        <img src="../assets/images/flower.png" alt="Upgrade icon" width="100px">
                        <div class="input-data">
                            <input type="text" id="name" name="name" required>
                            <div class="underline"></div>
                            <label for="">Name</label>
                            <select id="dropdown" name="dropdown">
                                <option value="option1">Choose..</option>
                                <option value="option2">Folder</option>
                                <option value="option3">File</option>
                            </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-row">
                        <div class="input-data">
                            <br />
                            <div class="form-row submit-btn">
                                <div class="input-data">
                                    <div class="inner"></div>
                                    <input type="submit" value="Save" name="submit">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Trash Modal -->
<div id="trashModal" class="modal" style="display:none;">
    <div class="modal-content">
        <p>Are you sure you want to move this folder to trash?</p><br><br>
        <form id="trashForm" method="post" action="">
            <input type="hidden" id="folder_id" name="id">
            <button type="submit" class="btn-confirm">Yes, move to trash</button>
            <button type="button" class="btn-cancel" onclick="closeModal('trashModal')">Cancel</button>
        </form>
    </div>
</div>

<div id="deleteModal" class="modal" style="display:none;">
    <div class="modal-content">
        <p>Are you sure you want to delete this folder permanently?</p><br><br>
        <form id="deleteForm" method="post" action="">
            <input type="hidden" name="id" id="folder_id">
            <input type="hidden" name="action" value="delete_from_trash">
            <button type="submit" class="btn-confirm">Yes, delete</button>
            <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
        </form>
    </div>
</div>

<!-- Restriction Popup Modal -->
<div id="restrictionPopup" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('restrictionPopup')">&times;</span>
        <p id="restrictionMessage"></p>
    </div>
</div>
