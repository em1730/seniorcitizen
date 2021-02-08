<?php
include('../config/db_config.php');

$yornomas =   $_POST['yornomas'];
$ybarangay =   $_POST['ybarangay'];

$ydate_from =  date('Y-m-d', strtotime($_POST['ydate_from']));
$ydate_to =    date('Y-m-d', strtotime($_POST['ydate_to']));



if (isset($yornomas)) {

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
        echo $list_history['lastname'] .','.' '. $list_history['firstname'] ;
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

//WITHOUT BARANGAY
if($ybarangay=='' && $yornomas != '') {
    
    $get_all_barangay_sql = "SELECT  * from yearduepayment t inner join registration r on r.objid = t.id
     where t.oryeardue = '".$yornomas."' and t.dateyeardue between '".$ydate_from."' and '".$ydate_to."'
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

//WITHOUT OR AND BARANG WITH DATE FROM AND DATE TO
    if($ybarangay=='' && $yornomas == '' && $ydate_from != '' && $ydate_to != '') {
    
        $get_all_date_sql = "SELECT  * from yearduepayment t inner join registration r on r.objid = t.id
         where t.dateyeardue between '".$ydate_from."' and '".$ydate_to."'
        and yearduestatus = 'ACTIVE'";
    
        $get_all_date_data = $con->prepare($get_all_date_sql);
        $get_all_date_data->execute();
    
        
        while ($list_date = $get_all_date_data->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td >";
            echo $list_date['objidyear'];
            echo "</td>";
            echo "<td>";
            echo $list_date['lastname'] .','.' '. $list_date['firstname'] ;
            echo "</td>";
            echo "<td>";
            echo $list_date['dateyeardue'];
            echo "</td>";
            echo "<td>";
            echo $list_date['oryeardue'];
            echo "</td>";
            echo "<td>";
            echo $list_date['amountyeardue'];
            echo "</td>";
    
            echo "<td>";
            echo $list_date['barangay'];
            echo "</td>";
            echo "<td>";
            echo "<button class='btn btn-danger delete btn-sm' data-placement='top' id='delete' title='Delete Record'><i class='fa fa-trash-o'></i></button>";
            
            echo "</td>";
         
            echo "</tr>";
    
        }

}

//WITHOUR ORNO WITH BARANGAY AND DATE FROM
if($ybarangay !='' && $yornomas == '' && $ydate_from != '' && $ydate_to != '') {
    
    $get_all_brgy_sql = "SELECT  * from yearduepayment t inner join registration r on r.objid = t.id
     where r.barangay = '".$ybarangay."'  and t.dateyeardue between '".$ydate_from."' and '".$ydate_to."'
    and yearduestatus = 'ACTIVE'";

    $get_all_brgy_data = $con->prepare($get_all_brgy_sql);
    $get_all_brgy_data->execute();

    
    while ($list_brgy = $get_all_brgy_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td >";
        echo $list_brgy['objidyear'];
        echo "</td>";
        echo "<td>";
        echo $list_brgy['lastname'] .','.' '. $list_brgy['firstname'] ;
        echo "</td>";
        echo "<td>";
        echo $list_brgy['dateyeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_brgy['oryeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_brgy['amountyeardue'];
        echo "</td>";

        echo "<td>";
        echo $list_brgy['barangay'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger delete btn-sm' data-placement='top' id='delete' title='Delete Record'><i class='fa fa-trash-o'></i></button>";
        
        echo "</td>";
     
        echo "</tr>";

    }

}





?>