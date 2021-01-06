<?php 
    $dbname1 = 'heroku_5bed88585e7b234';
    $dbpass = '41f08082';
    $dbuser = 'bd78a604caf3aa';

$mysql1 = new mysqli('us-cdbr-east-02.cleardb.com', $dbuser, $dbpass, $dbname1);

if($mysql1->connect_errno)
{
	echo "Failed to connect to MYSQL: ".$mysql1->connect_error;
}
 $mysql1->select_db($dbname1);

?>

