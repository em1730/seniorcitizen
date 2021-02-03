<?php

   include('db-config.php');
//variable declaration
  //  $alert_msg = '';
  //    echo "<pre>";
  //    print_r($_POST);
  //    echo "</pre>";

   //sign in button
    // if (isset($_POST['email'])){
        //to check if data are passed
        // echo "<pre>";
        //     print_r($_POST);
        // echo "</pre>";

        $username = $_POST['email'];
        $password = $_POST['password'];

        $check_username_sql = "SELECT * FROM tbl_users where username = :username";
        
        $username_data = $con->prepare($check_username_sql);
        $username_data ->execute([
          ':username' => $username
        ]);

          if ($username_data->rowCount() > 0){
            while ($result = $username_data->fetch(PDO::FETCH_ASSOC)) {
          
              //from database already hash
              $hash_password = $result['password'];
    
              //hash the $u_pass and compared to $hashed_password
              if (password_verify($password, $hash_password)) {
             
                    if ($result['status'] == "INACTIVE" || $result['status'] == "PENDING" ) {
                       echo "inactive";
                   }
                   
              }else{
                echo "invalid";
              } 
            }
            }else{
              echo "invalid";

      }

  

?>