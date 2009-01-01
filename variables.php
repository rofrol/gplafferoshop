<?php
echo "Value of __CLASS__ : ".__CLASS__."<br>";
echo "Value of get_class(\$this) : ".get_class($this)."<br>";
echo "Value of get_class() : ".get_class()."<br>";
echo "Value of \$_SERVER[\"SCRIPT_NAME\"] :".$_SERVER["SCRIPT_NAME"]."<br>";
echo "Value of __FILE__ : ".__FILE__."<br>";
$script_directory = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));
echo $script_directory."<br>";
$script_directory2 = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], '/'));
echo $script_directory2."<br>";

?>