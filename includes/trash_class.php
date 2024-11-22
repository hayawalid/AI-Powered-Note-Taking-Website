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
    public static function readTrash($user_id)
    {
        global $con;
        $sql = "SELECT folder_id, name, DATE_FORMAT(deleted_at, '%Y-%m-%d %H:%i:%s') as deleted_at FROM trash WHERE user_id = $user_id";
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
