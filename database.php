<?php
/*mysql or mysqli
http://www.johnjawed.com/benchmarks/
Conclusions
The data showed that mysql_query outperforms mysqli_query head to head. For the specific task of inserting 100,000 rows into a table, using mysqli_multi_query more than doubled our script execution time. At this point, you may start wondering what the point of using MySQLi is if the traditional MySQL extension is getting the upper hand on MySQLi.

However, using MySQLi statements we got better results, in fact it outperformed mysql_query by as much as mysql_query outperformed mysqli_query. Though this might not be enough reason for you to change existing code, remember that MySQLi statements are "pre-escaped", meaning that there is no need for you to do mysql_real_escape_string on any of the variables. It's apparent that given this fact about MySQLi statements, if we had made the extra function call of mysql_real_escape_string to the four inserted values, we would have greatly increased our execution time (good for character escaping user input and stopping SQL injection).

mysqli vs pdo
http://www.santosj.name/general/mysqli-vs-pdo/

*/

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