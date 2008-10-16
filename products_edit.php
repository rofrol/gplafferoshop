<?php

class products_edit
{
/* Display results as associative arrays */
	public static function display()
	{
		if($result=database::getConn()->query("SELECT * FROM products"))
		{
			echo '<form action="products_edit.php" method="get">';
			echo '<br>products<br>';
			echo '<table border="1"><thead><tr><th>products_id</th><th>products_name</th><th>products_price</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<tr><td><input type="text" name="text" value="' . $row['products_id'] . '"></td><td><input type="text" name="text" value="' . $row['products_name'] .
'"</td><td><input type="text" name="text" value="' . $row['products_price'] . '"</td></tr>';
			}
			echo '</tbody></table>';
			echo '<input type="submit" name="change" value="Zmien"/>';
			echo '</form>';
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