<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'db-config.php';
	updateToken();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}

function updateToken(){
    global $con;

$userID = $_GET['loggedInUser'];
$token          = $_POST['token'];
   

$update_token_sql = "UPDATE tbl_users SET
       
        token               = :token
        WHERE id            = :userid";
        

$token_data = $con->prepare($update_token_sql);
$token_data->execute([
       
        ':token'            => $token,
        ':userid'           => $userID
        
        ]);
        
}
?>