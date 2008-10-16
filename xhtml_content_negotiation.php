<?php
  // http://blog.lepszyinternet.com/2006/11/06/dlaczego-xhtml-to-zly-pomysl/
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) {
   header("Content-type: application/xhtml+xml");
}
else {
   header("Content-type: text/html");
}
?>