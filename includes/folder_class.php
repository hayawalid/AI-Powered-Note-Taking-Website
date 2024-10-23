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
        global $con;
        $this->ID = $id; // Always set the ID
    
        if ($id != 0) {
            $sql = "SELECT * FROM folders WHERE ID = $id";
            $folders = mysqli_query($con, $sql);
            if ($row = mysqli_fetch_array($folders)) {
                $this->name = $row['name'];
                $this->created_at = $row['created_at'];
                $this->folder_id = $row['folder_id'];
            } else {
                echo "Error: Folder not found.<br>";
            }
        }
    }
    
    

    static function create($name, $folder_id = null) {
        global $con;
        $folder_id = isset($folder_id) ? $folder_id : 'NULL';
        $sql = "INSERT INTO folders (name, folder_id) VALUES ('$name', $folder_id)";
        echo "SQL: $sql<br>";
        if (mysqli_query($con, $sql)) {
            echo "Folder created successfully.<br>";
            return true;
        } else {
            echo "Error: " . mysqli_error($con) . "<br>";
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
        if (isset($folder->ID)) {
            $sql = "DELETE FROM folders WHERE ID={$folder->ID}";
            echo "SQL: $sql<br>"; // Debugging statement
            if (mysqli_query($con, $sql)) {
                echo "Folder deleted successfully.<br>";
                return true;
            } else {
                echo "Failed: " . mysqli_error($con) . "<br>";
                return false;
            }
        } else {
            echo "Invalid folder ID.<br>";
            return false;
        }
    }
    
    public static function update($id, $newName) {
        global $con; // Assuming $con is the connection object
        $stmt = $con->prepare("UPDATE folders SET name = ? WHERE ID = ?");
        $stmt->bind_param("si", $newName, $id);
    
        if ($stmt->execute()) {
            return true;
        } else {
            // Print detailed error
            echo "Error: " . $stmt->error;
            return false;
        }
    }
    
    
    
    
}
?>
