<?php


session_start();

include('../config/db_config.php');

if (isset($_POST['id'])) {
//     echo "<pre>";
//     print_r($_POST);
// echo "</pre>";


$id = $_POST['id'];

$check_id_sql = "SELECT * FROM registration where id = :id";
        
$check_id_data = $con->prepare($check_id_sql);
$check_id_data ->execute([
  ':id' => $id
]);

if ($check_id_data->rowCount() > 0){

  echo '<div style="color: red;"> <b>'.$id.'</b> is already in use! </div>';
  }else{
  echo '<div style="color: green;"> <b>'.$id.'</b> is avaialable! </div>';
  }

die();

}


