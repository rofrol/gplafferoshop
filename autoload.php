<?php
//autoload
//najpierw zeruje funkcje zarejestrowane jako autoload
//potem okreslam jakie rozszerzenia maja byc ladowane
//nastepnie okreslam rozne funkcje, np. jedna dla bibliotek, druga dla klas
//w funkcji moge sprawdzic czy nazwa pasuje do wzorca lub czy istnieje plik
//rejestruje funkcje

//http://www.phpro.org/tutorials/SPL-Autoload.html
/*** nullify any existing autoloads ***/
spl_autoload_register(null, false);

/*** specify extensions that may be loaded ***/
spl_autoload_extensions('.php, .class.php, .lib.php');

//http://php.net/autoload
//Unlike class extensions, optional parameters with class restrictions may not load your class.
//$b->fun('No!');//this will not load class file for aClass
function classLoader($classname)
{
  //mozna dodac ladowanie plikow tylko wg wzorca, np.
  //if(ereg(".+_load$", $classname))

  $script_directory = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));

  $path = "{$script_directory}/{$classname}.php";
  //moze dodac documentroot dla bezpieczenstwa
  //a co z include paths?
  if (is_readable($path))
    require_once $path;
  else {
    trigger_error("The class file $path was not found!", E_USER_ERROR);
  }

}

/*** register the loader functions ***/
spl_autoload_register('classLoader');

?>