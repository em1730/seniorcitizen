<?php

include('../config/db_config.php');
if (isset($_POST['delete_payment'])) {

    $deleteobjidmas = $_POST['objid5'];
    $delete_user_sql = "DELETE FROM masdailypayment  WHERE objidmas = :id ";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$deleteobjidmas]);
    
}

?>