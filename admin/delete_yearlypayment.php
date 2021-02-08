<?php

include('../config/db_config.php');
if (isset($_POST['delete_yearly'])) {

    $deleteobjidmas = $_POST['yobjid'];
    $delete_user_sql = "DELETE FROM yearduepayment  WHERE objidyear = :id ";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$deleteobjidmas]);
    
}

?>