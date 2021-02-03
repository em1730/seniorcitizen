<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// $alert= $_SESSION['user_type']
// echo "<p>";
// print_r($_SESSION['user_type']);
// echo "</p>";
if($_SESSION['user_type'] == 2){
    header('location: index');
 
}

?>