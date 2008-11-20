<?php
require_once('functions.php');

class transactions
{
/* Display results as associative arrays */
	public static function display()
	{
		if($result=database::getConn()->query("SELECT * FROM transactions"))
		{
			echo '<br>transactions<br>';
			echo '<table border="1"><thead><tr><th>transactions_id</th><th>transactions_date</th><th>products_id</th><th>transactions_price</th><th>transactions_quantity</th><th>customers_id</th></tr></thead><tbody>';
			while($row=$result->fetch_array(MYSQLI_ASSOC))
			{
				echo '<tr><td>' . $row['transactions_id'] . '</td><td>' . $row['transactions_date'] . '</td><td>' . $row['products_id'] . '</td><td>' . $row['transactions_price'] . '</td><td>' . $row['transactions_quantity'] . '</td><td>' . $row['customers_id'] . '</td></tr>';
			}
			echo '</tbody></table>';
			$result->free();
		}
	}
}

if(!class_exists(transactions_loaded))
{
	require_once('database.php');
	display('transactions');
	database::getConn()->close();
}
?>