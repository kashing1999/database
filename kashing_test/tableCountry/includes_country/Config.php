<?php 

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "world";
$fields = array("name", "countrycode", "district", "population");
// Make new connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Enable special characters to show properly in the website
$conn->query("SET NAMES utf8;");
?>
 