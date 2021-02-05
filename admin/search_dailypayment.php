<?php

include('../config/db_config.php');
$objid = $_POST['objid'];

$date_from =  date('Y-m-d', strtotime($_POST['date_from']));
$date_to =    date('Y-m-d', strtotime($_POST['date_to']));

// echo "<p>";
// echo print_r($date_from);
// echo "</p>";
$columns= array( 
    // datatable column index  => database column name
        0 =>  'objid', 
        1 => 'datepayment',
        2 => 'ornomas',
        3 => 'masname'
   
    


    );
$requestData= $_REQUEST;

if(isset($_POST['date_from'])){

    $get_all_history_sql = " SELECT * FROM masdailypayment where id = '" . $objid . "'
    ORDER BY datepayment DESC, time DESC LIMIT ".$requestData['start']." ,".$requestData['length']." ";
        $data = array();
        $get_all_history_data = $con->prepare($get_all_history_sql);
        $get_all_history_data->execute();
        while ($list_history = $get_all_history_data->fetch(PDO::FETCH_ASSOC)) {
            $nestedData=array(); 

            $nestedData[] = $list_history["objid"];
            $nestedData[] = $list_history["masname"];
            $nestedData[] = $list_history["datepayment"];
            $nestedData[] = $list_history["ornomas"];
            $nestedData[] = $list_history["amount"]; 
            $data[] = $nestedData;

        }

        $count_stmt = "	SELECT COUNT(objidmas) as totalcount from masdailypayment where id = '".$objid."' and datepayment between '".$date_from."' and '".$date_to."'";
        $getrecordstmt = $con->prepare($count_stmt);
        $getrecordstmt->execute() or die("search_dailypayment.php");
        $getrecord = $getrecordstmt->fetch(PDO::FETCH_ASSOC);
        $totalData = $getrecord['totalcount'];
        $totalFiltered = $totalData;

        if(!empty($requestData['search']['value'])){


        }


        $json_data = array(
            "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal"    => intval( $totalData ),  // total number of records
            "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data"            => $data   // total data array
            );
        
            echo json_encode($json_data);  // send data as json format

}


?>