<?php
/*

http://www.helicron.net/php/
Untangling the document path with PHP

Many (most?) pages scripted using PHP seem to assume that the script is running under Apache. It is perfectly possible to run PHP with IIS on a Windows platform. Unfortunately, the environment variables available from IIS are different to thos available from Apache. Searching for tips and code fragments on the net will find you plenty of example but many of them simply assume the platform.

  One irritating problem that cropped up when writing the code that generates these pages was that Apache provides an environment variable called DOCUMENT_ROOT while IIS does not. This variable tells the script where, in the host filing system, the web pages are delivered from and may have a value something like this:

 /usr/local/apache/share/htdocs

  This information is essential if you want to have your PHP script locate a particular file, for example a configuration file. Absolute paths may not be appropriate as the scripts can be moved from host to host. Relative paths are equally awkward as scripts have to be in a fixed location relative to the required file.

  If we know where the root of the web is, a global configuration file can live in some fixed location relative to that. If running under Apache, we simply prepend the value of getenv("DOCUMENT_ROOT") to the beginning of the path and we are done. For example
*/
    $docRoot = getenv("DOCUMENT_ROOT");
include $docRoot."/includes/config.php";

/*
If running under IIS, we have no such convenient shortcut. Instead, we need to work out where the document root is from other information. Both IIS and Apache tell us the name and location of the currently executing script with an environment variable called SCRIPT_NAME. Thus we could write
*/
  print getenv("SCRIPT_NAME");
/*
and get a result like

 /product/description/index.php

The location is the full path of the script within the web server. That is, relative to the web root. PHP will allow us to find the absolute path of this file - relative to the entire server root - with a call to the realpath() function. To be on the safe side, we only want the name of the file for SCRIPT_NAME, not its full path so we add a call to the basename() function to extract that. Thus we can write

  print realpath(basename(getenv("SCRIPT_NAME")));

and get something like

 /usr/local/apache/share/htdocs/product/description/index.php

Now that we have the entire path to the current script, we can remove the part that refers to the site-relative file, leaving the document root behind. Just to be on the safe side, we can ensure that paths for Windows servers have their slashes pointing the same way.
*/
  $localpath=getenv("SCRIPT_NAME");
$absolutepath=realpath($localPath);
// a fix for Windows slashes
$absolutepath=str_replace("\\","/",$absolutepath);
$docroot=substr($absolutepath,0,strpos($absolutepath,$localpath));
// as an example of use
include($docroot."/includes/config.php");

/*
This little code fragment would have to go at the start of any script that needed to know where the document root is but now, your code will run equally with both IIS and Apache servers. Windows 2000 and above, by the way, are quite happy to accept forward slashes in an absolute document path.
*/
?>