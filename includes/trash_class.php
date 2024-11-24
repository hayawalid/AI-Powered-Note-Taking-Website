<?php
$con = new mysqli("localhost", "root", "", "smartnotes_db");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

class trash {
    public $ID;
    public $name;
    public $deleted_at;
    public $folder_id;

    public function __construct($id) {
        global $con;
        $this->ID = $id;
        if ($id != 0) {
            $sql = "SELECT * FROM trash WHERE ID = $id"; // Change to trash table
            $trash = mysqli_query($con, $sql);
            if ($row = mysqli_fetch_array($trash)) {
                $this->name = $row['name'];
                $this->deleted_at = $row['deleted_at'];
                $this->folder_id = $row['folder_id'];
            } else {
                echo "Error: Folder not found in trash.<br>";
            }
        }
    }

    public function delete() {
        global $con;
        if ($this->ID != 0) {
            $sql = "DELETE FROM trash WHERE ID = $this->ID";
            if (mysqli_query($con, $sql)) {
                echo "Folder permanently deleted from trash.<br>";
                return true;
            } else {
                echo "Error deleting folder: " . mysqli_error($con) . "<br>";
                return false;
            }
        } else {
            echo "Invalid ID. Cannot delete.<br>";
            return false;
        }
    }

    public function restore() {
    global $con;

    if ($this->ID != 0) {
        $check_parent_sql = "SELECT * FROM folders WHERE ID = $this->folder_id";
        $check_parent_result = mysqli_query($con, $check_parent_sql);

        if (mysqli_num_rows($check_parent_result) > 0) {
            $restore_folder_id = $this->folder_id;
        } else {
            $restore_folder_id = 1; // Default parent folder
        }
        $user_id = $_SESSION['UserID'];  // Retrieve the current user's ID from the session

        // Insert into folders
        $sql = "
            INSERT INTO folders (name, created_at, folder_id, user_id)
            SELECT 
                name, 
                NOW(), 
                $restore_folder_id AS folder_id, 
                $user_id AS user_id
            FROM 
                trash
            WHERE 
                ID = $this->ID;
        ";
        
        if (mysqli_query($con, $sql)) {
            // Delete from trash
            $sqlDelete = "DELETE FROM trash WHERE ID = $this->ID";
            if (mysqli_query($con, $sqlDelete)) {
                echo "Folder successfully restored.<br>";
                return true;
            } else {
                echo "Error removing folder from trash: " . mysqli_error($con) . "<br>";
                error_log("Error removing folder from trash: " . mysqli_error($con));
                return false;
            }
        } else {
            echo "Error restoring folder: " . mysqli_error($con) . "<br>";
            error_log("Error restoring folder: " . mysqli_error($con));
            return false;
        }
    } else {
        echo "Invalid ID. Cannot restore.<br>";
        return false;
    }
}

    
    
    public static function readTrash($user_id) {
        global $con;
        $sql = "SELECT ID, folder_id, name, DATE_FORMAT(deleted_at, '%Y-%m-%d %H:%i:%s') as deleted_at 
                FROM trash WHERE user_id = $user_id";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $trash = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $trash[] = $row;
            }
            return $trash;
        } else {
            echo "Error: " . mysqli_error($con);
            return false;
        }
    }
}
?>
