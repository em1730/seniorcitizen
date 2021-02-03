<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//this page controls the user access to the system.

//admin 
$registration_list='';


$user_id = $_SESSION['id'];
$account_type = $_SESSION['user_type'];
if($account_type == 1){
    require_once('user_controls.php');// THIS SCRIPT HOLDS ALL THE BUTTONS WHICH CAN BE ACCESS ONLY BY THE ADMIN.
} else {

}
// echo "<pre>";
// echo print_r($user_id);
// echo "</pre>";
if (!isset($_SESSION['id'])) {
    header('location:../index.php');
}

// IF UNREGISTERED USER BROWSE THE SITE OUTSIDE VIEW_POST, ONLY USED IN ANNOUNCEMENT
if($_SESSION['id'] == "guest") {
    header('location:../index.php');
}

?>