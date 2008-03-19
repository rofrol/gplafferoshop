<?php
class database
{
	public static function getConn()
	{
		static $mysqli;

		if(isset($mysqli))
		{
			return $mysqli;
		}

		$mysqli = new mysqli("localhost", "root", "droot", "gplafferoshop");

		/* check connection */
		if (mysqli_connect_errno())
		{
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		return $mysqli;
	}
}
?>