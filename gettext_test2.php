<?php
  // I18N support information here
$language = 'en_US.utf8';
putenv("LANG=$language"); 
setlocale(LC_ALL, $language);

// Set the text domain as 'messages'
$domain = 'messages';
bind_textdomain_codeset($domain, ‘UTF-8′);
bindtextdomain($domain, "/www/htdocs/site.com/locale"); 
textdomain($domain);

echo gettext("A second string to be translated would go here");
?>