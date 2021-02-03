<?php

include('../config/db_config.php');


if (isset($_POST['deleteyearly'])) {

    $deleteobjidmasyearly = $_POST['yearly_delete'];
    $delete_yearly_sql = "DELETE FROM yearduepayment  WHERE objidyear = :id ";
    $delete_yearly_data = $con->prepare($delete_yearly_sql);
    $delete_yearly_data->execute([':id'=>$deleteobjidmasyearly]);
    
}

?>