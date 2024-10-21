<?php
// Create connection
$con = new mysqli("localhost", "root", "", "smartnotes_db");

class Page {
    public $id;
    public $friendly_name;
    public $link_address;

    public function __construct($id) {
        if($id != "") {
            $sql = "SELECT * FROM pages WHERE id = $id";
            $result = mysqli_query($GLOBALS['con'], $sql);
            if($row = mysqli_fetch_array[$result]) {
                $this->id = $row['id'];
                $this->friendly_name = $row['friendly_name'];
                $this->link_address = $row['link_address'];
            }
        }
    }

    static function selectAllPagesInDB() {
        $sql = "SELECT * FROM pages";
        $pageDataset = mysqli_query($GLOBALS['con'], $sql);
        $i = 0;
        $result;
        while($row = mysqli_fetch_array($pageDataset)) {
            $pageObj = new Page($row['id']);
            $result[$i] = $pageObj;
            $i++;
        }
        return $result;
    }
}

?>