<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    require 'db-config.php';
	registerUser();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}



function registerUser(){
    global $con;
    // ob_start();
   


    
    // If we wanted to change the base currency, we would uncomment the following line
  
    $username       = $_POST['username'];
    $firstname      = $_POST['firstname'];
    $middlename     = $_POST['middlename'];
    $lastname       = $_POST['lastname'];
    $email          = $_POST['emailAddress'];
    $password       = $_POST['password'];
    $birthdate      = date('Y-m-d', strtotime($_POST['birthdate']));
    $mobileNumber   = $_POST['mobileNumber'];
    $gender         = $_POST['gender'];
    $address        = $_POST['address'];
    $registered     = $_POST['dateAndTimeRegistered'];
    $deviceid       = $_POST['deviceid'];
    $verification = rand(100000,999999);

    $hashed_password  = password_hash($password, PASSWORD_DEFAULT);

    $queryToDetectIfExisting=mysqli_query($con,"SELECT * FROM tbl_users WHERE username='$username'");
    $numrows=mysqli_num_rows($queryToDetectIfExisting);
    $get_user1_sql = "SELECT * FROM tbl_users where username = :username";
    $user_data1 = $con->prepare($get_user1_sql);
    $user_data1->execute([':username' => $username]);
    $result = $user_data1->fetch(PDO::FETCH_ASSOC);
    
    if($result==0){

      // $queryToDetectIfExisting1=mysqli_query($con,"SELECT * FROM tbl_users WHERE email='$email'");
       //$numrows1=mysqli_num_rows($queryToDetectIfExisting1);
         $get_email_sql = "SELECT * FROM tbl_users where email = :email";
         $email_data = $con->prepare($get_email_sql);
         $email_data->execute([':email' => $email]);
         $result1 = $email_data->fetch(PDO::FETCH_ASSOC);
       
        if($result1==0){

            $get_deviceid_sql = "SELECT * FROM tbl_users where others = :deviceid";
            $deviceid_data = $con->prepare($get_deviceid_sql);
            $deviceid_data->execute([':deviceid' => $deviceid]);
            $result2 = $deviceid_data->fetch(PDO::FETCH_ASSOC);

            if($result2==0){
                

    
            
    $insert_users_sql = "INSERT INTO tbl_users SET
        username            = :username,
        firstname           = :fname,
        middlename          = :mname,
        lastname            = :lname,
        email               = :email,
        password            = :password,
        birthdate           = :bday,
        mobileno            = :mobileno,
        gender              = :gender,
        address             = :address,
        others              = :others,
        account_type        = '3',
        verification_code   = :verification, 
        status              = 'PENDING',
        created_at          = :created";



    $users_data = $con->prepare($insert_users_sql);
    $users_data->execute([
        ':username'         => $username,
        ':fname'            => $firstname,
        ':mname'            => $middlename,
        ':lname'            => $lastname,
        ':email'            => $email,
        ':password'         => $hashed_password,
        ':bday'             => $birthdate,
        ':mobileno'         => $mobileNumber,
        ':gender'           => $gender,
        ':address'          => $address,
        ':others'           => $deviceid,
        ':verification'     => $verification,
        ':created'          => $registered
        
        ]);

        require_once ('email_user.php');     
        // ob_end_clean();
        // echo "success";

    }else{ 
        echo "device";
    }    
        
    }else{ 
        echo "email";
        }    
    
    }else{
        echo "username"; 
    }

    
    }    
   
  

?>