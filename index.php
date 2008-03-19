<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php
http://www.devshed.com/c/a/MySQL/Implementing-Additional-Methods-with-mysqli-and-PHP-5/1/
(013147149X_book.pdf) Andi Gutmans, Stig Sæther Bakken,
and Derick Rethans - PHP 5 Power Programming -> 6.2.6 Queries
*/

require_once('database.php');
require_once('products_loaded.php');
require_once('products.php');
require_once('customers_loaded.php');
require_once('customers.php');
require_once('transactions_loaded.php');
require_once('transactions.php');

products::display();
customers::display();
transactions::display();

database::getConn()->close();
?>