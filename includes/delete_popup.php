<div id="deleteModal" class="modal" style="display:none;">
    <div class="modal-content">
        <p>Are you sure you want to delete this folder permanently?</p><br><br>
        <form id="deleteForm" method="post" action="">
            <input type="hidden" name="id" id="folder_id"> <!-- Folder ID hidden input -->
            <input type="hidden" name="action" value="delete_from_trash"> <!-- Action input -->
            <button type="submit" class="btn-confirm">Yes, delete</button>
            <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
        </form>
    </div>
</div>



<!-- Delete Trigger Button -->


<!-- Restriction Popup Modal -->
<div id="restrictionPopup" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('restrictionPopup')">&times;</span>
        <p id="restrictionMessage"></p>
    </div>
</div>

<?php
include_once '../includes/trash_class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $folderId = !empty($_POST['id']) ? intval($_POST['id']) : 0;

    error_log("Action: $action, Folder ID: $folderId"); // Log for debugging

    if ($folderId === 0) {
        error_log("Delete action failed: No folder ID provided.");
        echo "<script>alert('Error: No folder ID provided.');</script>";
    } elseif ($action === 'delete_from_trash') {
        $trashItem = new trash($folderId);
        if ($trashItem->delete()) {
            echo "<script>window.location.href = '../pages/trash.php';</script>";
        } else {
            echo "<script>alert('Error deleting folder.');</script>";
        }
    } elseif ($action === 'move_to_trash') {
        if (folder::moveToTrash($folderId)) {
            echo "<script>window.location.href = '../pages/folders.php';</script>";
        } 
    }
}
?>
