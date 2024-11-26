<?php
// include '../includes/config.php';
include_once 'UserType.php';
include_once 'UserActivity.php';

// Create connection
$con = new mysqli("localhost", "root", "", "smartnotes_db");

class User {
    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $country;
    public $userType_obj;
    public $created_at;

    public function __construct($user_id) {
        if($user_id != "") {
            $sql = "SELECT * from users where id = $user_id";
            $User = mysqli_query($GLOBALS['con'], $sql);
            if($row = mysqli_fetch_array($User)) {
                $this->id = $row["id"];
                $this->username = $row["username"];
                $this->first_name = $row["first_name"];
                $this->last_name = $row["last_name"];
                $this->email = $row["email"];
                $this->password = $row["password"];
                $this->country = $row["country"];
                $this->userType_obj = new UserType($row["user_type"]);
                $this->created_at = $row["created_at"];
            }
        }
    }

    //ghaiart el login function el adima ashan el adim kan bi compare hashed password to plain password 
    static function login($email, $password) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($GLOBALS['con'], $sql);
        if ($row = mysqli_fetch_array($result)) {
            // Verify password
            if (password_verify($password, $row['password'])) {
                $user = new User($row['id']); 
    
                if ($user->userType_obj->id == 2) {
                    SessionActivity::startSession($user->id); // Start session tracking
                }
    
                return $user; 
            }
        }
        return null; // Return null if login fails
    }
    

    static function getAllUsers() {
        $sql = "SELECT * FROM users WHERE user_type = 2";
        $users = mysqli_query($GLOBALS['con'], $sql);
        $result = [];
        while($row = mysqli_fetch_array($users)) {
            $userObj = new User($row["id"]);
            $result[] = $userObj;
        }
        return $result;
    }

    static function getAllAdmins() {
        $sql = "SELECT * FROM users WHERE user_type = 1";
        $admins = mysqli_query($GLOBALS['con'], $sql);
        $result = [];
        while($row = mysqli_fetch_array($admins)) {
            $adminObj = new User($row["id"]);
            $result[] = $adminObj;
        }
        return $result;
    }

    static function deleteUser($objUser) {
        $sql = "DELETE from users WHERE id = ".$objUser->id;
        if(mysqli_query($GLOBALS['con'], $sql)) {
            return true;
        }
        else 
            return false;
    }

    static function insertUser($username, $first_name, $last_name, $email, $password, $country, $usertype_id) {
        // Check if email already exists
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $check_result = mysqli_query($GLOBALS['con'], $check_sql);
        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>console.log('Email already exists.');</script>";
            return false;
        }

        $sql = "INSERT INTO users (username, first_name, last_name, email, password, country, user_type) VALUES ('$username', '$first_name', '$last_name', '$email', '$password', '$country', '$usertype_id')";
        if (mysqli_query($GLOBALS['con'], $sql)) {
            echo "<script>console.log('Database operation successful.');</script>";
            return true;
        } else {
            echo "<script>console.log('Database operation failed.');</script>";
            return false;
        }
    }
    

    public function updateUser() {
        $sql = "UPDATE users SET 
            username = '$this->username',
            first_name = '$this->first_name', 
            last_name = '$this->last_name', 
            email = '$this->email', 
            password = '$this->password', 
            country = '$this->country', 
            user_type = '".$this->userType_obj->id."' 
            WHERE id = $this->id";
        return mysqli_query($GLOBALS['con'], $sql);
    }

    static function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = mysqli_query($GLOBALS['con'], $sql);
        
        if ($row = mysqli_fetch_array($result)) {
            return new User($row["id"]);
        }
        return null;
    }

    static function getUserByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($GLOBALS['con'], $sql);
        if ($row = mysqli_fetch_array($result)) {
            return new User($row["id"]);
        }
        return null;
    }
}
?>