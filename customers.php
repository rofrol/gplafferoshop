<?php
require_once('functions.php');

class customers
{
}#end class customers


if(!class_exists(customers_loaded))
{
	require_once('database.php');
	display('customers');
	database::getConn()->close();
}
?>