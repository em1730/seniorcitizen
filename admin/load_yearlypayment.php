<?php
include('../config/db_config.php');
if (isset($_POST['objid5'])) {
    $objid5 =   $_POST['objid5'];
    $ydate_from =  date('Y-m-d', strtotime($_POST['ydate_from']));
    $ydate_to =    date('Y-m-d', strtotime($_POST['ydate_to']));


    $get_all_yearly_sql = "SELECT  * from yearduepayment t inner join registration r on r.objid = t.id where  t.id = '" . $objid5 . "' AND t.dateyeardue between '".$ydate_from."' and '".$ydate_to."'";


    $get_all_yearly_data = $con->prepare($get_all_yearly_sql);
    $get_all_yearly_data->execute();

    
    while ($list_yearly = $get_all_yearly_data->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>";
        echo $list_yearly['objidyear'];
        echo "</td>";
        echo "<td>";
        echo $list_yearly['dateyeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_yearly['oryeardue'];
        echo "</td>";
        echo "<td>";
        echo $list_yearly['amountyeardue'];
        echo "</td>";
        echo "<td>";
        echo "<button class='btn btn-danger delete btn-sm' data-placement='top' id='delete_yearly' name='delete_yearly' title='Delete Record'><i class='fa fa-trash-o'></i></button>";
        
        
        echo "</td>";
        echo "</tr>";

    }
 
}


?>