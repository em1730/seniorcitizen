<?php
if (isset($_POST['deletepayment'])) {

    $deleteobjidmas = $_POST['objid6'];
    $delete_user_sql = "DELETE FROM masdailypayment  WHERE objidmas = :id ";
    $delete_user_data = $con->prepare($delete_user_sql);
    $delete_user_data->execute([':id'=>$deleteobjidmas]);
    
}

?>