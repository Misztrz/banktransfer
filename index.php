<?php

$dbc = mysqli_connect('localhost', 'root', 'dexde3', 'bankman'); 
if(!$dbc) {
    die('DATABASE CONNECTION FAILED:'.mysqli_error($dbc));
exit();
}

$dbs = mysqli_select_db($dbc, 'bankman');

if(!$dbs) {
    die('DATABASE SELECTION FAILED:'.mysqli_error($dbc));
exit();
}
$_GET['atm'] = 0;
$_GET['pin'] = 0;
$user_id = mysqli_real_escape_string($dbc, $_GET['atm']);
$psw = mysqli_real_escape_string($dbc, $_GET['pin']);

$sql = $dbc->query("SELECT * FROM customers WHERE ATM_NO='$user_id' AND PIN='$psw'");

 if (mysqli_num_rows($sql) > 0)
 {
    echo 'log in ok';
 }
 else {
     echo 'log in er';
 }
 mysqli_close($dbc);
?>
