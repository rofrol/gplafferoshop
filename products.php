<?php
require_once('functions.php');

class products
{
}#end class products

if(!class_exists(products_loaded))
{
	display('products');
	database::getConn()->close();
}
?>
