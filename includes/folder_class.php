<?php
$con = new mysqli("localhost", "root", "", "smartnotes_db");

class folder {
    public $ID;
    public $name;
    public $created_at;

    public function __construct($id, $name, $created_at) {
        if($id != 0) {
            $sql = "SELECT * FROM folders WHERE ID = $id";
            $folders = mysqli_query($GLOBALS['con'], $sql);
            if ($row = mysqli_fetch_array($folders)) {
                $this->ID = $id;
                $this->name = $name;
                $this->created_at = $created_at;
            }
        }
        $this->ID = $id;
        $this->name = $name;
        $this->created_at = $created_at;
    }

    static function create($name) {
        global $con; // Ensure $con is globally accessible

        // Check if folder name already exists
        $check_sql = "SELECT * FROM folders WHERE name = '$name'";
        $check_result = mysqli_query($con, $check_sql);
        if (mysqli_num_rows($check_result) > 0) {
            echo "Folder name already exists.";
            return false;
        }

        // Insert new folder into database
        $sql = "INSERT INTO folders (name) VALUES ('$name')";
        if (mysqli_query($con, $sql)) {
            echo "Folder created successfully.";
            return true;
        } else {
            echo "Error: " . mysqli_error($con); // Add error feedback
            return false;
        }
    }
}
?>
