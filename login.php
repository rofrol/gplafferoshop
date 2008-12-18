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

	public static function check_login($dbc, $email = '', $pass = '')
	{
		if (!empty($errors))
		{
			echo '
<h1>Error!</h1>
<p class="error">The following error(s) occurred:<br />';
			foreach ($errors as $msg)
			{
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p>';
		}

		$errors = array();
		if (empty($email))
		{
			$errors[ ] = 'You forgot to enter your email address.';
		}
		else
		{
			$e = mysqli_real_escape_string ($dbc, trim($email));
		}
		if (empty($pass))
		{
			$errors[ ] = 'You forgot to enter your password.';
		}
		else
		{
			$p = mysqli_real_escape_string($dbc, trim($pass));
		}

		if (empty($errors))
		{ // If everything's OK.
// Retrieve the user_id and first_name for that email/password combination:
			$q = "SELECT user_id, first_name FROM users WHERE email='$e' AND pass=SHA1('$p')";
			$r = @mysqli_query ($dbc, $q); // Run the query.
// Check the result:
			if (mysqli_num_rows($r) == 1)
			{
// Fetch the record:
				$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
// Return true and the record:
				return array(true, $row);
			}
			else
			{ // Not a match!
				$errors[] = 'The email address and password entered do not match those on file.';
			}
		} // End of empty($errors) IF.
// Return false and the errors:
		return array(false, $errors);
	} // End of check_login() function.

} // End of class products.

if(!class_exists(login_loaded))
{
	require_once('database.php');
	login::display();
	database::getConn()->close();
}
?>