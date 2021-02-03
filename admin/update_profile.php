
 <?php

    $alert_msg = '';
    include('../config/db_config.php');



    if (isset($_POST['update_profile'])) {


        $get_entity_no              = $_POST['entity_no'];
        $get_username               = $_POST['username'];
        $get_new_password           = $_POST['password'];
        $hashed_password            = password_hash($get_new_password, PASSWORD_DEFAULT);
        $department                 =  $_POST['department'];
        $get_firstname              = $_POST['first_name'];
        $get_middlename             = $_POST['middle_name'];
        $get_lastname               = $_POST['last_name'];
        // $get_account                = $_POST['account_type'];
        $alert_msg = '';
        $alert_msg1 = '';




        if (empty($get_new_password)) {

            $insert_users_sql = "UPDATE tbl_users SET 
         
            
            fullname             = :full_name,
            firstname            = :first_name,
            middlename           = :middle_name,
            lastname             = :last_name,
            username             = :username,
            department           = :dept
            where entity_no      = :entityNo ";

            $add_user_data = $con->prepare($insert_users_sql);
            $add_user_data->execute([
                ':entityNo'                 => $get_entity_no,
                ':full_name'                => $get_firstname . ' ' . $get_middlename . ' ' . $get_lastname,
                ':first_name'               => $get_firstname,
                ':middle_name'              => $get_middlename,
                ':last_name'                => $get_lastname,
                ':username'                => $get_username,
                ':dept'                   => $department


            ]);
        } else {
            //update password
            $insert_users_sql = "UPDATE tbl_users SET 
         
            
            fullname             = :full_name,
            firstname            = :first_name,
            middlename           = :middle_name,
            lastname             = :last_name,
            username             = :username,
            department           = :dept,
            password           = :passs
            where entity_no      = :entityNo ";

            $add_user_data = $con->prepare($insert_users_sql);
            $add_user_data->execute([
                ':entityNo'                 => $get_entity_no,
                ':full_name'                => $get_firstname . ' ' . $get_middlename . ' ' . $get_lastname,
                ':first_name'               => $get_firstname,
                ':middle_name'              => $get_middlename,
                ':last_name'                => $get_lastname,
                ':username'                => $get_username,
                ':dept'                   => $department,
                ':passs'                   => $hashed_password


            ]);

            $alert_msg .= ' 
         <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
         <i class="icon fa fa-check"></i>You have successfully deleted the employee.
         </div>     
     ';
        }
    }
