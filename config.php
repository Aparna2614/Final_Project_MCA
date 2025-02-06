<?php
session_start();
require 'loadenv.php';

$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('PARTITION_PROJECT');

// Create connection to video database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




//<?php
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "partition_project";

//$conn = new mysqli($servername, $username, $password, $dbname);
