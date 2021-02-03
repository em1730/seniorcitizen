<?php

include('../config/db_config.php');


date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d');
$time = date('H:i:s');
$now = new DateTime();
$alert_msg = '';


if (isset($_POST['insert_yearlypayment'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alert_msg = ' ';
    //insert to tbl_individual
    $objid2 = $_POST['objid2'];
    
    $dateyeardue = date('Y-m-d', strtotime($_POST['dateyeardue']));
    $oryeardue = $_POST['oryeardue'];
    $lastname = $_POST['lastname'];
    $amountyeardue = $_POST['amountyeardue'];






    $insert_yearduepayment_sql = "INSERT INTO yearduepayment SET 

    id            = :id,
    dateyeardue        = :dateyeardue,
    oryeardue        = :oryeardue,
    amountyeardue        = :amountyeardue,
    yearduestatus        = :yearduestatus,
 
    masname        = :masname

   
    
    ";


    $yearduepayment_data = $con->prepare($insert_yearduepayment_sql);
    $yearduepayment_data->execute([

        ':id'         => $objid2,
        ':dateyeardue'     => $dateyeardue,
        ':oryeardue'         => $oryeardue,
        ':amountyeardue'        => $amountyeardue,
        ':yearduestatus'        => 'ACTIVE',
        ':masname'          => $lastname


   

    ]);




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

        ':id'         => $objid2,
        ':date'     => $date .' '. $time,
        ':orno'         => $oryeardue,
        ':amount'        => $amountyeardue,
        ':activity'        => 'ADDING NEW YEARLY PAYMENT',
        ':data_name'        => 'YEARLY PAYMENT',
        ':name'          => $lastname


   

    ]);


   

    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
        </div>    
      ';




    // echo print_r($objid1);


}
