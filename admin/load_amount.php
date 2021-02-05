<?php
include('../config/db_config.php');

$ornomas1 =   $_POST['ornomas'];



if (isset($ornomas1)) {

  $get_all_amount_sql = "SELECT sum(amountmas) as amount
    from masdailypayment WHERE 
    ornomas = '" . $ornomas1 . "' and status = 'ACTIVE'";


    $get_all_amount_data = $con->prepare($get_all_amount_sql);
    $get_all_amount_data->execute();

    
    while ($amount= $get_all_amount_data->fetch(PDO::FETCH_ASSOC)) {
 
        echo $amount = $result['amount'];
 
}

}

if($barangay=='' && $ornomas1 != ''){

    $get_all_amount_sql = "SELECT sum(amountmas) as amount
    from masdailypayment WHERE 
    ornomas = '" . $ornomas1 . "' and status = 'ACTIVE'";


    $get_all_amount_data = $con->prepare($get_all_amount_sql);
    $get_all_amount_data->execute();

    
    while ($amount= $get_all_amount_data->fetch(PDO::FETCH_ASSOC)) {
 
       echo  $amount = $result['amount'];
    
    }
 
}




?>