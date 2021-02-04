<?php
include('../config/db_config.php');

$ornomas =   $_POST['ornomas'];
$barangay =   $_POST['barangay'];
$date_from =  date('Y-m-d', strtotime($_POST['date_from']));
$date_to =    date('Y-m-d', strtotime($_POST['date_to']));

if (isset($ornomas)) {

    $get_all_history_sql = "SELECT t.objidmas,t.id,t.datepayment,t.ornomas,
    t.amountmas,t.masname,r.barangay 
    from masdailypayment t inner join registration r on r.objid = t.id WHERE 
    t.ornomas = '" . $ornomas . "' AND r.barangay = '" . $barangay . "' 
    AND t.datepayment between '".$date_from."' and '".$date_to."' and t.status = 'ACTIVE'";


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

        echo "<td>";
        echo $list_history['barangay'];
        echo "</td>";
  
     
        echo "</tr>";

    }
 
}

if($barangay=='' && $ornomas != ''){
    
    $get_all_barangay_sql = "SELECT t.objidmas,t.id,t.datepayment,t.ornomas,
    t.amountmas,t.masname,r.barangay from masdailypayment t 
    inner join registration r on r.objid = t.id WHERE 
    t.ornomas = '" . $ornomas . "' AND t.datepayment between '".$date_from."' and '".$date_to."' AND t.status = 'ACTIVE'";


    $get_all_barangay_data = $con->prepare($get_all_barangay_sql);
    $get_all_barangay_data->execute();

    
    while ($list_barangay = $get_all_barangay_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td >";
        echo $list_barangay['objidmas'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['masname'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['datepayment'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['ornomas'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['amountmas'];
        echo "</td>";

        echo "<td>";
        echo $list_barangay['barangay'];
        echo "</td>";
  
     
        echo "</tr>";

    }

}




?>