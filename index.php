<?php
/* http://pl.php.net/manual/en/function.mysqli-connect.php
http://www.devshed.com/c/a/MySQL/Implementing-Additional-Methods-with-mysqli-and-PHP-5/1/
(013147149X_book.pdf) Andi Gutmans, Stig Sæther Bakken,
and Derick Rethans - PHP 5 Power Programming -> 6.2.6 Queries
*/

require_once('database.php');

function __autoload($filename) {
	require_once "{$filename}_loaded.php";
	require_once "{$filename}.php";
}

products::display();
customers::display();
transactions::display();

database::getConn()->close();
?>