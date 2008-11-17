<a href="products.php">products.php</a><br>
<a href="customers.php">customers.php</a><br>
<a href="transactions.php">transactions.php</a><br>
<a href="login.php">login.php</a><br>

<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php
http://www.devshed.com/c/a/MySQL/Implementing-Additional-Methods-with-mysqli-and-PHP-5/1/
(013147149X_book.pdf) Andi Gutmans, Stig S??her Bakken
and Derick Rethans - PHP 5 Power Programming -> 6.2.6 Queries
*/

require_once('functions.php');

display('products');
display('customers');
display('transactions');

database::getConn()->close();
?>