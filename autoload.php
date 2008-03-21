<?php
function __autoload($filename) {
	require_once "{$filename}_loaded.php";
	require_once "{$filename}.php";
}
?>