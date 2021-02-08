<?php

include('../config/db_config.php');




date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$now = new DateTime();
$alert_msg1 = '';







if (isset($_POST['insert_dailypayment'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alert_msg1 = ' ';
    //insert to tbl_individual
    $objid1 = $_POST['objid1'];
    $date_payment = date('Y-m-d', strtotime($_POST['date_payment']));
    $ornomas = $_POST['ornomas1'];
    $lastname = $_POST['fullname1'];
    $amount = $_POST['amount1'];






    $insert_dailypayment_sql = "INSERT INTO masdailypayment SET 

    id            = :id,
    datepayment        = :datepayment,
    ornomas        = :ornomas,
    amountmas        = :amountmas,
    status        = :status,
 
    masname        = :masname

   
    
    ";

    $dailypayment_data = $con->prepare($insert_dailypayment_sql);
    $dailypayment_data->execute([

        ':id'         => $objid1,
        ':datepayment'     => $date_payment,
        ':ornomas'         => $ornomas,
        ':amountmas'        => $amount,
        ':status'        => 'ACTIVE',
        ':masname'          => $lastname


   

    ]);

    $dailypayment_data = $con->prepare($insert_dailypayment_sql);
    if($dailypayment_data)
    {
    
    
    $_SESSION['status'] = "PAYMENT ADDED";
    $_SESSION['status'] = 'success';
    }

    //INSERT USER LOGS TABLE

    
    $insert_userlogs_sql = "INSERT INTO userlogs SET 

    id            = :id,
    date        = :date,
    orno        = :orno,
    amount        = :amount,
    activity        = :activity,
    data_name        = :data_name,
 
    person_name        = :name

   
    
    ";




    $userlogs_data = $con->prepare($insert_userlogs_sql);
    $userlogs_data->execute([

        ':id'         => $objid1,
        ':date'     => $date .' '. $time,
        ':orno'         => $ornomas,
        ':amount'        => $amount,
        ':activity'        => 'ADDING NEW PAYMENT',
        ':data_name'        => 'DAILY PAYMENT',
        ':name'          => $lastname


   

    ]);

   
  

    $alert_msg1 .= ' 
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="fa fa-check"></i>
            <strong> Success ! </strong> Data Inserted.
    </div>    
  ';

     




}
