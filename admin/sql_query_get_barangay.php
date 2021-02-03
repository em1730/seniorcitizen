<?php


include ('../config/db_config.php');

if (isset($_POST['brgy'])) {


  $barangay = $_POST['brgy'];


  

  // $user_id = $_SESSION['id  //select all data type
  $get_all_brgy_sql = "SELECT * FROM barangay WHERE brgy = :brgy";
  $get_all_brgy_data = $con->prepare($get_all_brgy_sql);
  $get_all_brgy_data->execute([':brgy'=> $barangay]);  
   while ($result = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) {
    
    
    $barangay =  $result['brgy'];


   
 
   }

  $data = array(
    'statuscode' => 200,
    'data' => $barangay,
   


  
    'message' => 'success'
  );
  echo json_encode($data);










}
?>