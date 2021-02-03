<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
	require 'db-config.php';
	addPost();
}else{
	echo "Oops! We're sorry! You do not have access to this option!";
}



// session_start();
// $user_id = $_SESSION['id'];

     // echo "<pre>";
     // print_r($_POST);
     // echo "</pre>";

// $content = $_POST['Content_Type'];
function addPost(){

global $con;
date_default_timezone_set('Asia/Manila');


$type = $_POST['Type'];
$severity = $_POST['topicSeverity'];
$title = $_POST['topicTitle'];
$latitude= $_POST['latitude'];
$longitude = $_POST['longitude'];
$locationAddress = $_POST['topicLocationAddress'];
$postedBy = $_POST['topicPostedBy'];
$mobileno = $_POST['mobileNo'];
$created = $_POST['topicDateAndTimePosted'];
$date = date('Y-m-d');
$time = date('h:i:s');
$user_id = $_POST['userID'];

$insert_users_sql = "INSERT INTO tbl_incident SET
type                = :type,
severity            = :severity,
topic               = :topic,
date                = :date,
time                = :time,
latitude            = :latitude,
longitude           = :longitude,
location_address    = :locationAddress,
reported_by         = :reportedBy,
mobileno            = :mobileno,
createdat           = :createdAt,
userid              = :userid,
remarks             = 'NEW REPORT'";

$users_data = $con->prepare($insert_users_sql);
$users_data->execute([
':type'             => $type,
':severity'         => $severity,
':topic'            => $title,
':date'             => $date,
':time'             => $time,
':latitude'         => $latitude,
':longitude'        => $longitude,
':locationAddress'  => $locationAddress,
':reportedBy'       => $postedBy,
':userid'           => $user_id,
':mobileno'         => $mobileno,
':createdAt'        => $created

]);
}

echo "Incident Reported! We will contact you as soon as possible. Thank you!";


?>




