<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php
http://www.devshed.com/c/a/MySQL/Implementing-Additional-Methods-with-mysqli-and-PHP-5/1/
(013147149X_book.pdf) Andi Gutmans, Stig Sæther Bakken,
and Derick Rethans - PHP 5 Power Programming -> 6.2.6 Queries
*/
require_once('database.php');

/* Display results as associative arrays */
if($result=$mysqli->query("SELECT * FROM products"))
{
	echo '<br>products<br>';
	echo '<table border="1"><thead><tr><th>products_id</th><th>products_name</th><th>products_price</th></tr></thead><tbody>';
	while($row=$result->fetch_array(MYSQLI_ASSOC))
	{
		echo '<tr><td>' . $row['products_id'] . '</td><td>' . $row['products_name'] . '</td><td>' . $row['products_price'] . '</td></tr>';
	}
	echo '</tbody></table>';
	$result->free();
}

if($result=$mysqli->query("SELECT * FROM customers"))
{
	echo '<br>customers<br>';
	echo '<table border="1"><thead><tr><th>customers_id</th><th>customers_name</th></tr></thead><tbody>';
	while($row=$result->fetch_array(MYSQLI_ASSOC))
	{
		echo '<tr><td>' . $row['customers_id'] . '</td><td>' . $row['customers_name'] . '</td></tr>';
	}
	echo '</tbody></table>';
	$result->free();
}

if($result=$mysqli->query("SELECT * FROM transactions"))
{
	echo '<br>transactions<br>';
	echo '<table border="1"><thead><tr><th>transactions_id</th><th>transactions_date</th><th>products_id</th><th>transactions_price</th><th>transactions_quantity</th><th>customers_id</th></tr></thead><tbody>';
	while($row=$result->fetch_array(MYSQLI_ASSOC))
	{
		echo '<tr><td>' . $row['transactions_id'] . '</td><td>' . $row['transactions_date'] . '</td><td>' . $row['products_id'] . '</td><td>' . $row['transactions_price'] . '</td><td>' . $row['transactions_quantity'] . '</td><td>' . $row['customers_id'] . '</td></tr>';
	}
	echo '</tbody></table>';
	$result->free();
}

$mysqli->close();
?>