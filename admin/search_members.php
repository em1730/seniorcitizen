<?php
include('../config/db_config.php');

$columns= array( 
    // datatable column index  => database column name
        0 =>  'objid', 
        1 => 'fullname',
        2 => 'barangay'
    
    );
    

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


$getAllIndividual = "SELECT objid,CONCAT(lastname,', ',firstname,' ',middlename,'.')as fullname,barangay FROM registration
                     ORDER BY datecreate DESC LIMIT ".$requestData['start']." ,".$requestData['length']."  ";

$getIndividualData = $con->prepare($getAllIndividual);
$getIndividualData->execute();                   

$countNoFilter = "SELECT COUNT(objid) as id from registration";
$getrecordstmt = $con->prepare($countNoFilter);
$getrecordstmt->execute() or die("search_members.php");
$getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
$totalData = $getrecord['id'];

$totalFiltered = $totalData;  
// when there is no search parameter then total number rows = total number filtered rows.


$getAllIndividual = "SELECT objid,CONCAT(lastname,', ',firstname,' ',middlename,'.')as fullname,barangay from registration where statusreg = 'ACTIVE' and ";
             
     if( !empty($requestData['search']['value']) ) {
        $getAllIndividual.=" (objid LIKE '%".$requestData['search']['value']."%'";
        $getAllIndividual.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
        $getAllIndividual.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";

  
        $getAllIndividual.=" OR barangay LIKE '%".$requestData['search']['value']."%') ";

        $getAllIndividual.=" ORDER BY objid DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
        $getIndividualData = $con->prepare($getAllIndividual);
        $getIndividualData->execute(); 

        $countfilter = "SELECT COUNT(objid) as id,CONCAT(lastname,', ',firstname,' ',middlename,'.')as fullname,barangay from registration where";
       $countfilter.=" (id LIKE '%".$requestData['search']['value']."%'";
       $countfilter.=" OR firstname LIKE '%".$requestData['search']['value']."%' ";
       $countfilter.=" OR lastname LIKE '%".$requestData['search']['value']."%' ";

       $countfilter.=" OR barangay LIKE '%".$requestData['search']['value']."%') ";
       $countfilter.="LIMIT ".$requestData['length']." " ;

        $getrecordstmt = $con->prepare($countfilter);
        $getrecordstmt->execute() or die("search_members.php");
        $getrecord1 = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['id'];
        $totalFiltered = $totalData;
     }

     $data = array();
// while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	while ($row = $getIndividualData->fetch(PDO::FETCH_ASSOC)){
	$nestedData=array(); 

	$nestedData[] = $row["objid"];
    $nestedData[] = $row["fullname"];
    $nestedData[] = $row["barangay"];
	// $nestedData[] = ucwords(strtolower($row["fullname"]));
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