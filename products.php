<?php
require_once('functions.php');

function print_row($value, $key) {
  print("key: $key, value: $value<br>");
}

class products
{
/* Display results as associative arrays */
	public static function display($table)
	{
		f_products_update();

		if($result=database::getConn()->query("SELECT * FROM $table"))
		{
			echo "<br>$table<br>";
			echo "<table border=\"1\"><thead>";
			$i=1;
			while($row=$result->fetch_array(MYSQL_BOTH))
			{
				$array_of_keys=array_keys($row);
				if($i==1)
				{
					echo "<tr>";
					while(list($a,$b)=each($array_of_keys))
					{
						if($a%2!=0)
						{
							echo "<th>$b</th>";
						}
					}
					echo "</tr>";
					$i++;
				}
			}
			echo "</thead>";
		}
		if($result=database::getConn()->query("SELECT * FROM $table"))
		{
			echo "<tbody>";
			echo "<form action=\"$_SERVER['PHP_SELF']\" method=\"post\">";
			while($row=$result->fetch_array(MYSQL_BOTH))
			{
				echo "<tr>";
				$array_of_keys=array_keys($row);
				while(list($a,$b)=each($array_of_keys))
				{
					if($a%2!=0)
					{
						echo "<td>$row[$b]</td>";
					}
				}
				echo "</tr>";

				#array_walk($row, 'print_row');
/*

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