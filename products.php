<?php
require_once('functions.php');

class products
{
/* Display results as associative arrays */

	public static function update()
	{
		if(isset($_REQUEST['submit']))
		{
			$result = database::getConn()->query("UPDATE products SET products_name='$_REQUEST[products_name]', products_price='$_REQUEST[products_price]' WHERE products_id='$_REQUEST[products_id]'");
		}
	}#end function update

}#end class products

if(!class_exists(products_loaded))
{
	display('products');
	database::getConn()->close();
}
?>
