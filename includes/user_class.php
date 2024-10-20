<?php

// include '../includes/config.php';

// Create connection
$con = new mysqli("localhost", "root", "", "smartnotes_db");

class User {
    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $password;
    public $birth_date;
    public $country;
    public $userType_obj;
    public $created_at;

    public function __construct($user_id) {
        if($user_id != "") {
            $sql = "SELECT * from users where id = $user_id";
            $User = mysqli_query($GLOBALS['con'], $sql);
            if($row = mysqli_fetch_array($User)) {
                $this->id = $row["id"];
                $this->first_name = $row["first_name"];
                $this->last_name = $row["last_name"];
                $this->email = $row["email"];
                $this->password = $row["password"];
                $this->birth_date = $row["birth_date"];
                $this->country = $row["country"];
                $this->userType_obj = new UserType($row["id"]);
                $this->created_at = $row["created_at"];
            }
        }
    }

    static function login($email, $password) {
        $sql = "S"
    }
}





?>