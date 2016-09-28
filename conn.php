<?php
$dbhost='mysql.hostinger.co.uk';
$dbuser= "u770063538_sagun";
$dbpassword= "sagunis1";
$dbname="u770063538_work";


$conn =new mysqli($dbhost,$dbuser,$dbpassword,$dbname);

if (!$conn){

	die("Error in connection".mysql_error());
}
?>






