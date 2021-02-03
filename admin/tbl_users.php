<?php
	//Start session
	// session_start();
	
	//Check whether the session variable id is present or not
	// if(!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) {
	// 	header("location: ../index.php");
	// 	exit();
	// }

$get_user_sql = "SELECT * FROM tbl_users WHERE user_id = :id";
$user_data = $con->prepare($get_user_sql);
$user_data->execute([':id' => $user_id]);
while ($result = $user_data->fetch(PDO::FETCH_ASSOC)) {
  $first_name     = $result['first_name'];
  $middle_name    = $result['middle_name'];
  $last_name      = $result['last_name'];
  $email_ad       = $result['email'];
  $contact_number = $result['contact_number'];
  $user_name      = $result['username'];
  $department        = $result['department'];
  $userfullname   = $result['first_name']." ".$result['middle_name']." ".$result['last_name'];
  $dateregister   = $result['date_started'];
}

?>