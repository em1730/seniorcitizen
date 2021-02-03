<?php 
include ('config/db_config.php');
include ('admin/header.php');
$message = '';

if(isset($_GET['activation_code']))
{


$sql = "SELECT * FROM tbl_users where verification_code = :user_verification";
$check_user = $con->prepare($sql);
$check_user->execute(['user_verification' => $_GET['activation_code']]);
while($result = $check_user->fetch(PDO::FETCH_ASSOC)){
    $status = $result['status'];
}
$no_of_row = $check_user->rowCount();
if($no_of_row > 0)
	{
     if($status == 'PENDING'){
        $update = "UPDATE tbl_users SET status = 'ACTIVE'
        where verification_code = :user_verification";
        $update_user = $con->prepare($update);
        $update_user->execute(['user_verification' => $_GET['activation_code']]);

        $message = 'Account verified. You can now log in to the system.';

        
     } else
     {
         $message = 'The user is already active.';
     }
       
    }else{
      $message = 'Invalid verification code.';  
    }

}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>User Verification</title>		
		<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	</head>
	<body style = "align:center">
		
		<div class="container">
        <div class ="row">
        <div class ="col-12">
        <h3 style = "text-align:center;"><?php echo $message; ?></h3>
        </div>
        </div>
                <div class = "row ">
                <div class = "col-12">
              
         <img style = "width:500px;height:500px;"src="dist/img/scdrrmo_logo.png" class ="img-fluid ">
                </div>
                </div>
        <a href="http://35.241.87.123/sccdrrmo/">SCCDRRMO WEBSITE</a>

			
		
			
			
		</div>
	
	</body>
	
</html>