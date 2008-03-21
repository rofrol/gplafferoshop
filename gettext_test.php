<?php
  // I18N support information here
$locale = "en_US.utf8";
if (isSet($_GET["locale"])) $locale = $_GET["locale"];
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);

// Set the text domain as 'messages'
$domain = 'messages';
bind_textdomain_codeset($domain, "UTF-8");
bindtextdomain($domain, "./locale"); 
textdomain($domain);

echo gettext("A string to be translated would go here");
?>