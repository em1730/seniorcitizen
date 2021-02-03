<?php
include ('../config/db_config.php');
// echo "<pre>";
// print_r("hello");
// echo "</pre>";
if(isset($_POST['id'])){

$update_credentials= "update tbl_users SET status =:status where id = :id";
$update_documents_data = $con->prepare($update_credentials);
    $update_documents_data->execute([
        ':status'             => 'ACTIVE',
        ':id'             => $_POST['id'],


    ]);
  
}
?>