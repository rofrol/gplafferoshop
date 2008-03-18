<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php
http://www.devshed.com/c/a/MySQL/Implementing-Additional-Methods-with-mysqli-and-PHP-5/1/
(013147149X_book.pdf) Andi Gutmans, Stig Sæther Bakken,
and Derick Rethans - PHP 5 Power Programming -> 6.2.6 Queries
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
  echo 'products<br>';
  echo '<table border="1"><thead><tr><th>id</th><th>name</th></tr></thead><tbody>';
  while($row=$result->fetch_array(MYSQLI_ASSOC)){
    echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td></tr>';
  }
  echo '</tbody></table>';
  $result->free();
 }

if($result=$mysqli->query("SELECT * FROM customers")){
  echo 'customers<br>';
  echo '<table border="1"><thead><tr><th>id</th><th>name</th></tr></thead><tbody>';
  while($row=$result->fetch_array(MYSQLI_ASSOC)){
    echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td></tr>';
  }
  echo '</tbody></table>';
  $result->free();
 }

$mysqli->close();
?>