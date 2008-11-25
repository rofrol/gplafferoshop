<?php

class login
{
/* Display results as associative arrays */
	public static function display()
	{
		echo '
<br>login<br>
<form action="login.php" method="post">
<table>
<tr><td>email adress</td><td><input type="text" name="email" size="20" maxlength="80" /></td></tr>
<tr><td>password</td><td><input type="password" name="pass" size="20" maxlength="20" /></td></tr>
<tr><td colspan="2" style="text-align: right;"><input type="submit" name="submit" value="Login" /></td></tr>
</table>
<input type="hidden" name="submitted" value="TRUE" />
</form>
';
	}
}

if(!class_exists(login_loaded))
{
	require_once('database.php');
	login::display();
	database::getConn()->close();
}
?>