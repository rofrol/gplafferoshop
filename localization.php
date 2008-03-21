<?php
  // http://mel.melaxis.com/devblog/2005/08/06/localizing-php-web-sites-using-gettext/
  // I18N support information here

class localization
{
	public static function display()
	{
		$locale = "en_US.utf8";
		if (isSet($_GET["locale"])) $locale = $_GET["locale"];
		putenv("LC_ALL=$locale");
		setlocale(LC_ALL, $locale);
// Set the text domain as 'messages'
		$domain = 'messages';
		bind_textdomain_codeset($domain, "UTF-8");
		bindtextdomain($domain, "./locale"); 
		textdomain($domain);
	}
}

if(!class_exists(localization_loaded))
{
	localization::display();
}
?>