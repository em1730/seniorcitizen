<?php

// $host = "localhost:8888";
// $db_name = "sccdrrmo";
// $username = "root";
// $password = "";



$servername = "127.0.0.1:3307";
$username = "root";
$password = "5zAhx4Et37Wr";
// Create connection
$conn = new mysqli($servername, $username, $password);
//
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

// // $conn = new mysqli($host, $username, $password, $db_name);
// // // Check connection
// // if ($conn->connect_error) {
// //     die("Connection failed: " . $conn->connect_error);
// // }

// try {
//     //database connection
//     $con = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
//     //initialize and error exception
//     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "connected";
// }
// catch (PDOEXCEPTION $error) {

//     echo "Connection Error: " . $error->getMessage();

// }


?>