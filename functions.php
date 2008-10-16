<?php
#http://php.net/autoload
#Unlike class extensions, optional parameters with class restrictions may not load your class.
#$b->fun('No!');//this will not load class file for aClass
function __autoload($filename) {
	if(!ereg("_loaded$", $filename))
	{
		require_once "{$filename}_loaded.php";
		require_once "{$filename}.php";
	}
}

function f_products_update()
{
	if(isset($_REQUEST['submit']))
	{
		$result = database::getConn()->query("UPDATE products SET products_name='$_REQUEST[products_name]', products_price='$_REQUEST[products_price]' WHERE products_id='$_REQUEST[products_id]'");
	}
}

?>