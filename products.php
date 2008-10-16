<?php
require_once('functions.php');

class products
{
/* Display results as associative arrays */
	public static function display()
	{
		f_products_update();

		if($result=database::getConn()->query("SELECT * FROM products"))
		{
			echo '<br>products<br>';
			echo '<table border="1"><thead><tr><th>products_id</th><th>products_name</th><th>products_price</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
				echo '<tr><td><input type="text" readonly="readonly" name="products_id" value="' . $row['products_id'] . '"></td><td><input type="text" name="products_name" value="' . $row['products_name'] .'"></td><td><input type="text" name="products_price" value="' . $row['products_price'] . '"></td><td><input type="submit" name="submit" value="Zmien"></td></tr>';
				echo '</form>';
			}
			echo '</tbody></table>';
			$result->free();
		}
	}
}

if(!class_exists(products_loaded))
{
	products::display();
	database::getConn()->close();
}
?>