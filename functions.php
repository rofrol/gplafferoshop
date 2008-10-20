<?php
#http://php.net/autoload
#Unlike class extensions, optional parameters with class restrictions may not load your class.
#$b->fun('No!');//this will not load class file for aClass
function __autoload($filename) {
	if(!ereg("_loaded$", $filename))
	{
		require_once "{$filename}_loaded.php";
		require_once "{$filename}.php";
	}
}

?>