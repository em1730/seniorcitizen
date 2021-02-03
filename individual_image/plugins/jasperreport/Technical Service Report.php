<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once("PHPJasperXML.inc.php");
// include_once ('setting.php');


$server = 'localhost';
$user = 'root';
$pass = '1234';
$db = 'scc_doctrack';
$objid_nogg = $_GET['objidno'];

$PHPJasperXML = new PHPJasperXML();
// $PHPJasperXML->debugsql=true;
// $PHPJasperXML->arrayParameter=array("employeeNo"=>'12345678');
$xml = $PHPJasperXML->load_xml_file("tsr.jrxml");

// $PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->sql = "SELECT * FROM tbl_repair where objid_no =" . $objid_nogg . " ";
$PHPJasperXML->transferDBtoArray($server, $user, $pass, $db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
?>

<!-- <html>
<title>FWEFEWF</title>

</html> -->