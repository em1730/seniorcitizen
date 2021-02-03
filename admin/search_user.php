<?php
/* Database connection start */
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "sccdrrmo";
include('../config/db_config.php');
// $office = $_POST['office'];


// echo "<pre>";
// echo print_r("test");
// echo "</pre>";
// $conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());


/* Database connection end */


// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


 $columns= array( 
// datatable column index  => database column name
	0 =>'id', 
	1 => 'fullname',
	2 => 'username',
	3 => 'email',
	4 => 'mobileno',
  	5 => 'status'
	


);



// getting total number records without any search

$sql = "SELECT CONCAT(firstname,' ',LEFT(middlename, 1),'. ',lastname) as fullname,id,username, email, mobileno, status  FROM tbl_users ";
$sql.="where status != 'INACTIVE'  ORDER BY id DESC  LIMIT 1000 ";
$get_user_data = $con->prepare($sql);
$get_user_data->execute();
// $query=mysqli_query($conn, $sql) or die("search_user.php");
// PDOStatement::rowCount

$countnofilter= "SELECT COUNT(id) as id from tbl_users"; //count all rows w/o filter
$getrecordstmt = $con->prepare($countnofilter);
$getrecordstmt->execute() or die("search_user.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
// $totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT CONCAT(firstname,' ',LEFT(middlename, 1),'. ',lastname) as fullname,id,username, email, mobileno, status  FROM tbl_users where status !='INACTIVE'";

if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
	$sql.="  and (id LIKE '%".$requestData['search']['value']."%' ";    
	$sql.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR username LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR email LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR gender LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR address LIKE '%".$requestData['search']['value']."%' ";
	$sql.=" OR mobileno LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR birthdate LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR account_type LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR status LIKE '%".$requestData['search']['value']."%' )";

// $query=mysqli_query($conn, $sql) or die("search_user.php");


// $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
$sql.="   ORDER BY id DESC  LIMIT 100  ";
$get_user_data = $con->prepare($sql);
$get_user_data->execute();
// $totalData = $get_user_data->fetch(PDOStatement::rowCount);
// $totalFiltered = $totalData;
// $query=mysqli_query($conn, $sql) or die("search_user.php");

	$countfilter= "SELECT COUNT(id) as id from tbl_users where ";
	$countfilter.="  (id LIKE '%".$requestData['search']['value']."%' ";    
	$countfilter.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR middlename LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR username LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR email LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR gender LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR address LIKE '%".$requestData['search']['value']."%' ";
	$countfilter.=" OR mobileno LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR birthdate LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR account_type LIKE '%".$requestData['search']['value']."%' ";
    $countfilter.=" OR status LIKE '%".$requestData['search']['value']."%' )";

$countfilter.="LIMIT 100 " ;//count all rows w/ filter
$getrecordstmt = $con->prepare($countfilter);
$getrecordstmt->execute() or die("search_user.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];
$totalFiltered = $totalData;
}
$data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $get_user_data->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["id"];
	$nestedData[] = $row["fullname"];
	$nestedData[] = $row["username"];
	$nestedData[] = $row["email"];
	$nestedData[] = $row["mobileno"];
    $nestedData[] = $row["status"];
	$data[] = $nestedData;
}



$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
