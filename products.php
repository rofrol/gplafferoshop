<?php
require_once('functions.php');

function print_row($value, $key) {
  print("key: $key, value: $value<br>");
}

class products
{
/* Display results as associative arrays */
	public static function display($table, $col_id)
	{
		f_products_update();

		if($result=database::getConn()->query("SELECT * FROM $table"))
		{
			echo '<br>products<br>';
			echo '<table border="1"><thead><tr><th>'.$col_id.'</th><th>products_name</th><th>products_price</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQL_BOTH))
			{

				$array_of_keys = array_keys($row);
				while (list($a, $b) = each($array_of_keys))
				{
					echo "<tr><td>a: $a</td><td>b: $b</td><td>row[b]: $row[$b]<td></tr>";
				}

				echo "<tr><td>przejscie petli</td></tr>";
				#array_walk($row, 'print_row');
/*

				echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">';
				echo '<tr><td><input type="text" readonly="readonly" name="products_id" value="' . $row['products_id'] . '"></td><td><input type="text" name="products_name" value="' . $row['products_name'] .'"></td><td><input type="text" name="products_price" value="' . $row['products_price'] . '"></td><td><input type="submit" name="submit" value="Zmien"></td></tr>';
				echo '</form>';
*/
			}
			echo '</tbody></table>';
			$result->free();
		}
	}
}

if(!class_exists(products_loaded))
{
	products::display('products','products_id');
	database::getConn()->close();
}
?>