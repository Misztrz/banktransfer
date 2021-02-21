<?php
  $dbname1 = 'heroku_5bed88585e7b234';
    $dbpass = '41f08082';
    $dbuser = 'bd78a604caf3aa';

$dbc = mysqli_connect('us-cdbr-east-02.cleardb.com', $dbuser, $dbpass, $dbname1);
if(!$dbc) {
    die('DATABASE CONNECTION FAILED:'.mysqli_error($dbc));
exit();
}

$dbs = mysqli_select_db($dbc, $dbname1);

if(!$dbs) {
    die('DATABASE SELECTION FAILED:'.mysqli_error($dbc));
exit();
}

$user_id = mysqli_real_escape_string($dbc, $_POST['atm']);
$psw = mysqli_real_escape_string($dbc, $_POST['pin']);

$sql = $dbc->query("SELECT * FROM customers WHERE ATM_NO='$user_id' AND PIN='$psw'");

 if (mysqli_num_rows($sql) > 0)
 {
    echo 'log in ok';
	// echo $csv_output;
   while ($rowr = mysqli_fetch_assoc($sql)) {	   
	  echo $rowr['First_name'].", ".$rowr['pin']; 	
 }
 }
 else {
     echo 'log in er';
 }
 mysqli_close($dbc);
?>
