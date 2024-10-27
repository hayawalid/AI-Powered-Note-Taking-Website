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
    public static function moveToTrash($id) {
        global $con;
        $sql = "SELECT * FROM folders WHERE ID = $id";
        $result = mysqli_query($con, $sql);
        if ($folder = mysqli_fetch_assoc($result)) {
            echo "Folder found: " . json_encode($folder) . "<br>";
            
            // Assign ID and name correctly
            $folder_id = $folder['id'];
            $folder_name = $folder['name'];
            
            // Begin transaction
            mysqli_begin_transaction($con);
    
            try {
                // Move to trash
                $trash_sql = "INSERT INTO trash (folder_id, name) VALUES ($folder_id, '$folder_name')";
                echo $trash_sql . "<br>";
                if (!mysqli_query($con, $trash_sql)) {
                    throw new Exception("Error moving folder to trash: " . mysqli_error($con));
                }
    
                // Delete from folders
                $delete_sql = "DELETE FROM folders WHERE ID = $id";
                echo $delete_sql . "<br>";
                if (!mysqli_query($con, $delete_sql)) {
                    throw new Exception("Error deleting folder: " . mysqli_error($con));
                }
    
                // Commit transaction
                mysqli_commit($con);
                echo "Deleted from folders<br>";
                return true;
            } catch (Exception $e) {
                // Rollback transaction on error
                mysqli_rollback($con);
                echo $e->getMessage() . "<br>";
                return false;
            }
        } else {
            echo "Error: Folder not found.<br>";
            return false;
        }
    }
    public static function readTrash() {
        global $con;
        $sql = "SELECT folder_id, name, DATE_FORMAT(deleted_at, '%Y-%m-%d %H:%i:%s') as deleted_at FROM trash";
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
