<?php
include('../config/db_config.php');

$yornomas =   $_POST['yornomas'];
$ybarangay =   $_POST['ybarangay'];

$ydate_from =  date('Y-m-d', strtotime($_POST['ydate_from']));
$ydate_to =    date('Y-m-d', strtotime($_POST['ydate_to']));

if (isset($ornomas)) {

    $get_all_history_sql = "SELECT  * from yearduepayment t inner join registration r on r.objid = t.id
     where  t.oryeardue = '" . $yornomas . "' and r.barangay = '". $ybarangay ."' AND t.dateyeardue between '".$ydate_from."' and '".$ydate_to."'
    and yearduestatus = 'ACTIVE'";


    $get_all_history_data = $con->prepare($get_all_history_sql);
    $get_all_history_data->execute();

    
    while ($list_history = $get_all_history_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td >";
        echo $list_history['objidyear'];
        echo "</td>";
        echo "<td>";
        echo $list_history['lastname' + 'firstname'];
        echo "</td>";
        echo "<td>";
        echo $list_history['dateyeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_history['oryeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_history['amountyeardue'];
        echo "</td>";

        echo "<td>";
        echo $list_history['barangay'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger delete btn-sm' data-placement='top' id='delete' title='Delete Record'><i class='fa fa-trash-o'></i></button>";
        
        echo "</td>";
     
        echo "</tr>";

    }
 
}


if($ybarangay=='' && $yornomas != ''){
    
    $get_all_barangay_sql = "SELECT  * from yearduepayment t inner join registration r on r.objid = t.id
     where  t.oryeardue = '" . $yornomas . "' AND t.dateyeardue between '".$ydate_from."' and '".$ydate_to."'
    and yearduestatus = 'ACTIVE'";

    $get_all_barangay_data = $con->prepare($get_all_barangay_sql);
    $get_all_barangay_data->execute();

    
    while ($list_barangay = $get_all_barangay_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td >";
        echo $list_barangay['objidyear'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['lastname'] .','.' '. $list_barangay['firstname'] ;
        echo "</td>";
        echo "<td>";
        echo $list_barangay['dateyeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['oryeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_barangay['amountyeardue'];
        echo "</td>";

        echo "<td>";
        echo $list_barangay['barangay'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger delete btn-sm' data-placement='top' id='delete' title='Delete Record'><i class='fa fa-trash-o'></i></button>";
        
        echo "</td>";
     
        echo "</tr>";

    }

}





?>