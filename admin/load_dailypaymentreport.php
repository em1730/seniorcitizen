<?php
include('../config/db_config.php');
if (isset($_POST['ornomas'])) {
    $ornomas =   $_POST['ornomas'];
    $barangay =   $_POST['barangay'];
    $date_from =  date('Y-m-d', strtotime($_POST['date_from']));
    $date_to =    date('Y-m-d', strtotime($_POST['date_to']));


    $get_all_history_sql = "SELECT t.objidmas,t.id,t.datepayment,t.ornomas,t.amountmas,t.masname,r.barangay from masdailypayment t inner join registration r on r.objid = t.id WHERE t.ornomas = '" . $ornomas . "' AND r.barangay = '" . $barangay . "' AND t.datepayment between '".$date_from."' and '".$date_to."'";


    $get_all_history_data = $con->prepare($get_all_history_sql);
    $get_all_history_data->execute();

    
    while ($list_history = $get_all_history_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td >";
        echo $list_history['objidmas'];
        echo "</td>";
        echo "<td>";
        echo $list_history['masname'];
        echo "</td>";
        echo "<td>";
        echo $list_history['datepayment'];
        echo "</td>";
        echo "<td>";
        echo $list_history['ornomas'];
        echo "</td>";
        echo "<td>";
        echo $list_history['amountmas'];
        echo "</td>";
  
     
        echo "</tr>";

    }
 
}


?>