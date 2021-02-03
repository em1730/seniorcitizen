<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';


if (isset($_POST['insert_user'])) {

    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    $alert_msg = ' ';
    //insert to tbl_individual

    $date_register = date('Y-m-d', strtotime($_POST['date_register']));
    $time = $_POST['time'];
    $firstname = $_POST['first_name'];
    $middlename = $_POST['middle_name'];
    $lastname = $_POST['last_name'];
    $fullname = $_POST['first_name'] . ' ' . $_POST['middle_name'] . ' ' . $_POST['last_name'];
    $department = $_POST['department'];
    $account = $_POST['account_type'];
    $status = 'ACTIVE';

    // $department 

    $entity_no = $_POST['entity_no'];
    $user_name = $_POST['username'];
    $hashed_password  = password_hash($entity_no, PASSWORD_DEFAULT);

    $insert_user_sql = "INSERT INTO tbl_users SET 
        date_register       = :datee,
        time_reg       = :timee,
        entity_no           = :entity_no,
        username            = :username,
        fullname            = :fullname,
        firstname           = :fnamee,
        middlename          = :mnamee,
        lastname            = :lnamee,
        department          =:dept,
        password            = :pwooord,
        account_type        = :account,
        status              = :statuuus
    ";


    $user_data = $con->prepare($insert_user_sql);
    $user_data->execute([

        ':datee'         => $date_register,
        ':timee'         => $time,
        ':entity_no'     => $entity_no,
        ':username'         => $user_name,
        ':fullname'         => $fullname,
        ':fnamee'         => $firstname,
        ':mnamee'         => $middlename,
        ':lnamee'         => $lastname,

        ':dept'         => $department,
        ':pwooord'         => $hashed_password,
        ':account'         => $account,
        ':statuuus'         => $status




    ]);



    //INSERT ENTITY TABLE


    $alert_msg .= ' 
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="fa fa-check"></i>
                <strong> Success ! </strong> Data Inserted.
        </div>    
      ';

    $btn_enabled = 'disabled';
    $btnNew = 'enabled';
    $btnPrint = 'enabled';


    //echo print_r($firstname);


}
