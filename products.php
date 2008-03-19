<?php

class products
{
/* Display results as associative arrays */
	public static function display()
	{
		if($result=database::getConn()->query("SELECT * FROM products"))
		{
			echo '<br>products<br>';
			echo '<table border="1"><thead><tr><th>products_id</th><th>products_name</th><th>products_price</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<tr><td>' . $row['products_id'] . '</td><td>' . $row['products_name'] . '</td><td>' . $row['products_price'] . '</td></tr>';
			}
			echo '</tbody></table>';
			$result->free();
		}
	}
}

if(!class_exists(products_loaded))
{
	require_once('database.php');
	products::display();
	database::getConn()->close();
}
?>