<?php

class customers
{
/* Display results as associative arrays */
	public static function display()
	{
		if($result=database::getConn()->query("SELECT * FROM customers"))
		{
			echo '<br>customers<br>';
			echo '<table border="1"><thead><tr><th>customers_id</th><th>customers_name</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<tr><td>' . $row['customers_id'] . '</td><td>' . $row['customers_name'] . '</td></tr>';
			}
			echo '</tbody></table>';
			$result->free();
		}
	}
}

if(!class_exists(customers_loaded))
{
	require_once('database.php');
	customers::display();
	database::getConn()->close();
}
?>