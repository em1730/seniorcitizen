<?php
if (isset($_POST['delete_member'])) {

    $deleteobjidmas = $_POST['objid5'];
    $delete_user_sql = "DELETE FROM registration  WHERE objid = :id ";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$deleteobjidmas]);

    $deleteobjidmas = $_POST['objid5'];
    $delete_user_sql = "DELETE FROM masdailypayment  WHERE id = :id ";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$deleteobjidmas]);
    
}

?>