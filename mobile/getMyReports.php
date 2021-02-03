<?php

    header('Content-Type: application/json; charset=utf-8');

     if($_SERVER["REQUEST_METHOD"] == "GET"){
        require 'db-config.php';
        showAllPost();
     }else{
         echo "Oops! We're sorry! You do not have access to this option!";
     }


function showAllPost(){
        global $con;
        //global $appUrl;
        $imageUrl = "http://34.92.117.58/sccdrrmo/mobile/images/";

        $listOfPosts = array();
        $userID = $_GET['userID'];

//fetch user from database
$get_announcement_sql = "SELECT * FROM tbl_incident where userid = :userid ORDER BY objid DESC";
$get_data = $con->prepare($get_announcement_sql);
$get_data->execute([':userid' => $userID]);
while ($result = $get_data->fetch(PDO::FETCH_ASSOC)) {

    $listOfPosts[$result['objid']] = [
        'id'                            => $result['objid'],
        'type'                          => $result['type'],
        'severity'                      => $result['severity'],
        'title'                         => $result['topic'],
        'image'                         => $imageUrl . $result['image'],
        'status'                        => $result['remarks'],
        'TopicLocationAddress'          => $result['location_address'],
        'fullname'                      => $result['reported_by'],
        'TopicDateAndTimePosted'        => $result['createdat']
        
    ];
}


      


        $data = [];
		foreach ($listOfPosts as $info) {
        $data[] = $info;
		 }
         echo json_encode(array('myReports'=>$data));
        
        }

?>



