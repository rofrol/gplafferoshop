<?php

//http://www.java2s.com/Code/Php/Class/CreateClassinstance.htm
//used to created _loaded classes
class ClassName{}

//http://php.net/autoload
//Unlike class extensions, optional parameters with class restrictions may not load your class.
//$b->fun('No!');//this will not load class file for aClass
function __autoload($filename) {
        if(!ereg("_loaded$", $filename))
        {
          //require_once "autoload/{$filename}_loaded.php";
          //nie trzeba juz tworzyc dodatkowych plikiow *_loaded.php
          ${$filename.'_loaded'} = &new ClassName;
          require_once "{$filename}.php";
        }
}

function display($table)
{
        update($table);
        if($result=database::getConn()->query("SELECT * FROM $table"))
        {
                echo '<br>'.$table.'<br>';
                echo '<table border="1"><thead><tr>';
                $row=$result->fetch_array(MYSQL_BOTH);
                $array_of_keys=array_keys($row);
                        while(list($a,$b)=each($array_of_keys))
                        {
                                if($a%2!=0)
                                {
                                        echo '<th>'.$b.'</th>';
                                }
                        }
                        echo '</tr></thead><tbody>';
                        //musze tu zrobic do...while poniewaz each() zmienia chyba pozycje wskaznika w fetch_array i przechodzi sam do nastepnego wiersza
                        do
                        {
                          //TODO dodac filtrowanie argumentow php_self
                                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><tr>';
                                $array_of_keys=array_keys($row);
                                while(list($a,$b)=each($array_of_keys))
                                {
                                        if($a%2!=0)
                                        {
                                                echo '<td><input type="text" name="'.$table.'['.$b.']" value="'.$row[$b].'"';
                                                //aby nie zmieniac identyfikatora
                                                if(ereg($table."_id$",$b))
                                                {
                                                        echo ' readonly="readonly"';
                                                }
                                                echo '></td>';
                                        }
                                }
                                echo '<td><input type="submit" name="submit" value="Zmien"></td>';
                                echo '</tr></form>';
                        }while($row=$result->fetch_array(MYSQL_BOTH));
                        echo '</tbody></table>';
                        $result->free();
        }
}//end function display()

function update($table)
{
  //sprawdzam czy byl wyslany formularz &&
  //czy dotyczy to aktualnie wyswietlanej tabeli
  //aby nie wyskoczyl blad invalid argument supplied to foreach
	if(isset($_REQUEST['submit']) && isset($_REQUEST[$table]))
	{
		//zachowuje id
		$id=$_REQUEST[$table][$table.'_id'];
		//aby teraz je usunac z tablicy
		unset($_REQUEST[$table][$table.'_id']);
		//zeby zbudowac string
		foreach($_REQUEST[$table] as $key=>$value)
		{
			$query1.=$key.'=\''.$value.'\',';
		}
		//usuwam ostatni przecinek
		$query1=substr_replace($query1 ,"",-1);
		$query2 = "UPDATE $table SET $query1 WHERE $table"."_id='$id'";
		$result = database::getConn()->query($query2);
	}
}//end function update

function display_module($name)
{
  if(!class_exists($name.'_loaded'))
    {
      display($name);
      database::getConn()->close();
    }
}

?>