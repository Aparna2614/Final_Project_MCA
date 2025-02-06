<?php
session_start();
require 'loadenv.php';

$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$dbname = getenv('UPLOADDB');

// Create connection to video database
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



//<?php
//$servername = "localhost"; // Change this if your database is hosted elsewhere
//$username = "root"; // Change this to your database username
//$password = ""; // Change this to your database password
//$dbname = "uploaddb"; // Change this to your database name

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
//if ($conn->connect_error) {
 //   die("Connection failed: " . $conn->connect_error);
//}
