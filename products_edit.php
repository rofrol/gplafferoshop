<?php

class products_edit
{
/* Display results as associative arrays */
	public static function display()
	{
		if (isset($_REQUEST['submit']))
		{
			$result = database::getConn()->query("UPDATE products SET products_name='$_REQUEST[products_name]', products_price='$_REQUEST[products_price]' WHERE products_id='$_REQUEST[products_id]'");
		}

		if($result=database::getConn()->query("SELECT * FROM products"))
		{
			echo '<br>products<br>';
			echo '<table border="1"><thead><tr><th>products_id</th><th>products_name</th><th>products_price</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<form action="products_edit.php" method="post">';
				echo '<tr><td><input type="text" readonly="readonly" name="products_id" value="' . $row['products_id'] . '"></td><td><input type="text" name="products_name" value="' . $row['products_name'] .'"></td><td><input type="text" name="products_price" value="' . $row['products_price'] . '"></td><td><input type="submit" name="submit" value="Zmien"></td></tr>';
				echo '</form>';
			}
			echo '</tbody></table>';
			$result->free();
		}
	}
}

if(!class_exists(products_edit__loaded))
{
	require_once('database.php');
	products_edit::display();
	database::getConn()->close();
}
?>