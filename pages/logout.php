<?php
include_once "../includes/User.php";

session_start();
$user = new User($_SESSION['UserID']);
if($user->userType_obj->id == 2) SessionActivity::endSession($user->id);
session_destroy();
header("Location: index.php");
exit();
?>
