<?php 
	$dbname1 = 'bankman';
    $dbname2 = 'coupons';
    $dbpass = 'dexde3';
    $dbuser = 'root';

$mysql1 = new mysqli('localhost', $dbuser, $dbpass, $dbname1);
$mysql2 = new mysqli('localhost', $dbuser, $dbpass, $dbname2);

if($mysql1->connect_errno && $mysql2->connect_errno)
{
	echo "Failed to connect to MYSQL: ".$mysql1->connect_error." ".$mysql2->error;
}
 $mysql1->select_db($dbname1);
 $mysql2->select_db($dbname2);
 

?>

