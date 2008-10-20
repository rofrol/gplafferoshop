<?php
require_once('functions.php');

class products
{
/* Display results as associative arrays */
	public static function display($table)
	{
		f_products_update();

		if($result=database::getConn()->query("SELECT * FROM $table"))
		{
			echo '<br>'.$table.'<br>';
			echo '<table border="1"><thead>';
			$row=$result->fetch_array(MYSQL_BOTH);
			$array_of_keys=array_keys($row);
			echo '<tr>';
			while(list($a,$b)=each($array_of_keys))
			{
				if($a%2!=0)
				{
					echo '<th>'.$b.'</th>';
				}
			}
			echo '</tr>';
			echo '</thead>';
			echo '<tbody>';
#musze tu zrobic do...while poniewaz each() zmienia chyba pozycje wskaznika w fetch_array i przechodzi sam do nastepnego wiersza
			do
			{
				echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">';
				echo '<tr>';
				$array_of_keys=array_keys($row);
				while(list($a,$b)=each($array_of_keys))
				{
					if($a%2!=0)
					{
						echo '<td><input type="text" name="'.$b.'" value="'.$row[$b].'"';
						if(ereg("_id$", $b))
						{
							echo ' readonly="readonly"';
						}
						echo '></td>';
					}
				}
				echo '<td><input type="submit" name="submit" value="Zmien"></td>';
				echo '</tr>';
				echo '</form>';
			}
			while($row=$result->fetch_array(MYSQL_BOTH));
			echo '</tbody></table>';
			$result->free();
		}
	} #end function display()
} #end class products()

if(!class_exists(products_loaded))
{
	products::display('products','products_id');
	database::getConn()->close();
}
?>

