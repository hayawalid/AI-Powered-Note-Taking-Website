<?php
$con = new mysqli("localhost", "root", "", "smartnotes_db");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

class folder
{
    public $ID;
    public $name;
    public $created_at;
    public $folder_id;
    public $user_id;

    public function __construct($id)
    {
        global $con;
        $this->ID = $id;  // Always set the ID
        if ($id != 0) {
            $sql = "SELECT * FROM folders WHERE ID = $id";
            $folders = mysqli_query($con, $sql);
            if ($row = mysqli_fetch_array($folders)) {
                $this->name = $row['name'];
                $this->created_at = $row['created_at'];
                $this->folder_id = $row['folder_id'];
                $this->user_id = $row['user_id'];  // Include user_id
            } else {
                echo "Error: Folder not found.<br>";
            }
        }
    }

    static function create($name, $user_id, $folder_id = null)
    {
        global $con;

        // Check if the parent folder exists
        if ($folder_id !== null) {
            $check_sql = "SELECT ID FROM folders WHERE ID = $folder_id";
            $check_result = mysqli_query($con, $check_sql);
            if (mysqli_num_rows($check_result) == 0) {
                echo "Error: Parent folder ID $folder_id does not exist.<br>";  // Debug statement
                return false;
            }
        }

        $folder_id = isset($folder_id) ? $folder_id : '1';  // Use '1' to indicate the default root
        $sql = "INSERT INTO folders (name, folder_id, user_id) VALUES ('$name', $folder_id, $user_id)";
        echo "Executing SQL: $sql<br>";  // Debug statement
        if (mysqli_query($con, $sql)) {
            $new_id = mysqli_insert_id($con);
            echo "Folder created successfully with ID: $new_id.<br>";
            return $new_id;
        } else {
            echo "Error: " . mysqli_error($con) . "<br>";
            return false;
        }
    }

    static function readByParent($user_id, $parent_id = '1')
    {
        global $con;
        $sql = "SELECT ID, name, DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM folders WHERE folder_id = $parent_id AND user_id = $user_id";
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


    static function read($user_id)
    {
        global $con;
        $sql = "SELECT ID, name, DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM folders WHERE user_id = $user_id";
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

    static function readRecent($user_id)
    {
        global $con;
        $sql = "SELECT ID, name, DATE_FORMAT(created_at, '%Y-%m-%d') as created_at FROM folders WHERE user_id = $user_id ORDER BY created_at DESC LIMIT 3";
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

    public static function update($id, $newName)
    {
        global $con;
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


    public static function moveToTrash($id)
    {
        global $con;

        // Retrieve the user_id from session
        session_start();
        $user_id = $_SESSION['UserID'];

        // Find all child folders and move them to trash recursively
        $sql = "SELECT ID FROM folders WHERE folder_id = $id AND user_id = $user_id";
        $result = mysqli_query($con, $sql);

        while ($child = mysqli_fetch_assoc($result)) {
            self::moveToTrash($child['ID']);
        }

        // Get the folder details
        $sql = "SELECT * FROM folders WHERE ID = $id AND user_id = $user_id";
        $result = mysqli_query($con, $sql);
        if ($folder = mysqli_fetch_assoc($result)) {
            echo "Folder found: " . json_encode($folder) . "<br>";

            // Assign the parent folder ID and name correctly
            $parent_folder_id = $folder['folder_id'];
            $folder_name = $folder['name'];

            // Begin transaction
            mysqli_begin_transaction($con);

            try {
                // Move to trash
                $trash_sql = "INSERT INTO trash (folder_id, name, user_id) VALUES ($parent_folder_id, '$folder_name', $user_id)";
                echo $trash_sql . "<br>";
                if (!mysqli_query($con, $trash_sql)) {
                    throw new Exception("Error moving folder to trash: " . mysqli_error($con));
                }

                // Delete from folders
                $delete_sql = "DELETE FROM folders WHERE ID = $id AND user_id = $user_id";
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
