<?php

include('../config/db_config.php');

date_default_timezone_set('Asia/Manila');
$alert_msg = '';

<<<<<<< HEAD
$get_all_individual_sql = "SELECT fullname FROM tbl_individual ";
$get_all_individual_data = $con->prepare($get_all_individual_sql);
$get_all_individual_data->execute();

$get_all_individual2_sql = "SELECT fullname FROM tbl_individual";
$get_all_individual2_data = $con->prepare($get_all_individual2_sql);
$get_all_individual2_data->execute();

$get_all_individual3_sql = "SELECT fullname FROM tbl_individual";
$get_all_individual3_data = $con->prepare($get_all_individual3_sql);
$get_all_individual3_data->execute();

$get_all_individual4_sql = "SELECT fullname FROM tbl_individual";
$get_all_individual4_data = $con->prepare($get_all_individual4_sql);
$get_all_individual4_data->execute();

$get_all_individual5_sql = "SELECT fullname FROM tbl_individual";
$get_all_individual5_data = $con->prepare($get_all_individual5_sql);
$get_all_individual5_data->execute();

$get_all_individual6_sql = "SELECT fullname FROM tbl_individual";
$get_all_individual6_data = $con->prepare($get_all_individual6_sql);
$get_all_individual6_data->execute();
=======
$get_all_individual_sql = "SELECT entity_no,fullname,street,barangay,photo FROM tbl_individual ";
$get_all_individual_data = $con->prepare($get_all_individual_sql);
$get_all_individual_data->execute();

>>>>>>> 816c79eb385df77998643d102c4fd07d3a69e329



