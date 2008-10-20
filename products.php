<?php
require_once('functions.php');

class products
{
/* Display results as associative arrays */
	public static function display($table)
	{
		products::update();

		if($result=database::getConn()->query("SELECT * FROM $table"))
		{
			echo '<br>'.$table.'<br>';
			echo '<table border="1"><thead><tr>';
			$row=$result->fetch_array(MYSQL_BOTH);
			$array_of_keys=array_keys($row);
			while(list($a,$b)=each($array_of_keys))
			{
				if($a%2!=0)
				{
					echo '<th>'.$b.'</th>';
				}
			}
			echo '</tr></thead><tbody>';
#musze tu zrobic do...while poniewaz each() zmienia chyba pozycje wskaznika w fetch_array i przechodzi sam do nastepnego wiersza
			do
			{
#TODO dodac filtrowanie argumentow php_self
				echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><tr>';
				$array_of_keys=array_keys($row);
				while(list($a,$b)=each($array_of_keys))
				{
					if($a%2!=0)
					{
						echo '<td><input type="text" name="'.$b.'" value="'.$row[$b].'"';
						#aby nie zmieniac identyfikatora
						if(ereg(".+_id$",$b))
						{
							echo ' readonly="readonly"';
						}
						echo '></td>';
					}
				}
				echo '<td><input type="submit" name="submit" value="Zmien"></td>';
				echo '</tr></form>';
			}while($row=$result->fetch_array(MYSQL_BOTH));
			echo '</tbody></table>';
			$result->free();
		}
	}#end function display()

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
	products::display('products');
	database::getConn()->close();
}
?>
