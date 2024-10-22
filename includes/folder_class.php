<?php
$con = new mysqli("localhost", "root", "", "smartnotes_db");

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

class folder {
    public $ID;
    public $name;
    public $created_at;
    public $folder_id;

    public function __construct($id) {
        if ($id != 0) {
            $sql = "SELECT * FROM folders WHERE ID = $id";
            $folders = mysqli_query($GLOBALS['con'], $sql);
            if ($row = mysqli_fetch_array($folders)) {
                $this->ID = $id;
                $this->name = $row['name'];
                $this->created_at = $row['created_at'];
                $this->folder_id = $row['folder_id'];
            }
        }
    }

    static function create($name, $folder_id) {
        global $con;
        $sql = "INSERT INTO folders (name, folder_id) VALUES ('$name', $folder_id)";
        if (mysqli_query($con, $sql)) {
            return true;
        } else {
            echo "Error: " . mysqli_error($con);
            return false;
        }
    }

    static function read() {
        global $con;
        $sql = "SELECT ID, name, DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM folders";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $folders = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $folders[] = $row;
            }
            return $folders;
        } else {
            echo "Error: " . mysqli_error($con);
            return false;
        }
    }

    static function readRecent() {
        global $con;
        $sql = "SELECT ID, name, DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM folders ORDER BY created_at DESC LIMIT 3";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $folders = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $folders[] = $row;
            }
            return $folders;
        } else {
            echo "Error: " . mysqli_error($con);
            return false;
        }
    }

    static function delete($folder) {
        global $con;
        $sql = "DELETE FROM folders WHERE ID=" . $folder->ID;
        if (mysqli_query($con, $sql)) {
            return true;
        } else {
            echo "Failed: " . mysqli_error($con);
            return false;
        }
    }
}
