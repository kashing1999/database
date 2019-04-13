<?php 

$servername = "Localhost";
$username = "hcytn1_mysqlgirl";
$password = "Mysqlgirls12345";
$dbname = "hcytn1_world";
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
 