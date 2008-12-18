<?php
function __autoload($filename) {
	require_once "autoload/{$filename}_loaded.php";
	require_once "{$filename}.php";
}
?>