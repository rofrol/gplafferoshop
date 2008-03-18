<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php
http://www.devshed.com/c/a/MySQL/Implementing-Additional-Methods-with-mysqli-and-PHP-5/1/
PHP 5 Power Programming -> 6.2.6 Queries
 */
$mysqli = new mysqli("localhost", "root", "droot", "gplafferoshop");

/* check connection */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
 }

printf("Host information: %s\n<br>", $mysqli->host_info);

/* Display results as associative arrays */
if($result=$mysqli->query("SELECT * FROM products")){
  while($row=$result->fetch_array(MYSQLI_ASSOC)){
    echo 'id: ' . $row['id'] . ', name: ' . $row['name'] . '<br>';
  }
  $result->free();
 }

$mysqli->close();
?>