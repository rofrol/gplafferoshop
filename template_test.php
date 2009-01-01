<?php

// include the class
require_once('template.php');

// instantiate a new template Parser object
$tp=&new templateParser('template.htm');

// define parameters for the class
$tags=array(
    'title'=>'You are seeing the template parser class in action!',
    'header'=>'header.php',
    'navbar'=>'navigation bar.php',
    'leftcontent'=>'leftcontent.php',
    'maincontent'=>'maincontent.php',
    'rightcontent'=>'rightcontent.php',
    'footer'=>'footer.php');

// parse template file
$tp->parseTemplate($tags);

// display generated page
echo $tp->display();

?>