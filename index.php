<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php */
$mysqli = new mysqli("localhost", "root", "droot", "gplafferoshop");

/* check connection */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
 }

printf("Host information: %s\n", $mysqli->host_info);

$q = 'SELECT * FROM products';
$r = mysqli_query($mysqli, $q);

/* close connection */
$mysqli->close();
?>