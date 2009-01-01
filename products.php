<?php
require_once('functions.php');

class products extends module
{
  	public static function main()
        {
          //odczytanie __CLASS__ nie moze byc w funkcji w klasie nadrzędnej
          if(basename($_SERVER["SCRIPT_NAME"]) == __CLASS__.".php")
            {
              products::display(__CLASS__);
            }
        }
  	public static function display()
        {
          //jesli nazwa klasy rozni sie od nazwy tablic np. przyrostkiem, to mozna usunac
          //parent::display(ereg_replace('_load$', '', __CLASS__));
          parent::display(__CLASS__);
        }
}//end class products

products::main();
?>
