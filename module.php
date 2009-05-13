<?php
require_once('functions.php');

class module
{
    public static function display($table)
    {
        //sprawdzam czy byl wyslany formularz &&
        //czy dotyczy to aktualnie wyswietlanej tabeli
        //aby nie wyskoczyl blad invalid argument supplied to foreach
	if(isset($_REQUEST['submit']) && isset($_REQUEST[$table]))
	{
		if($_REQUEST['submit'] == "Change")
			module::update($table);
		else if($_REQUEST['submit'] == "Add")
			module::add($table);
	}

	$th = module::getColumns($table);
        
	if($result=database::getConn()->query("SELECT * FROM $table"))
        {
            $row=$result->fetch_array(MYSQL_BOTH);
            $array_of_keys=array_keys($row);

            echo '<br>'.$table.'<br>';
            echo '<table border="1"><thead><tr>';
	    foreach($th as $t)
	    	echo '<th>'.$t.'</th>';
            echo '</tr></thead><tbody>';

            //musze tu zrobic do...while poniewaz each() zmienia chyba pozycje wskaznika w fetch_array i przechodzi sam do nastepnego wiersza
	    //albo powinienem użyc reset()
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
                echo '<td><input type="submit" name="submit" value="Change"></td>';
                echo '</tr></form>';
            }while($row=$result->fetch_array(MYSQL_BOTH));
            
	    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><tr>';
            echo '<td>&nbsp;</td>';
	    foreach($th as $t)
	    {
	    	if($t != $table."_id")
	    	echo '<td><input type="text" name="'.$table.'['.$t.']" value=""></td>';
	    }
            echo '<td><input type="submit" name="submit" value="Add"></td>';
            echo '</tr></form>';
            echo '</tbody></table>';


            $result->free();
        }
    }//end function display()

    public static function update($table)
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
    }//end function update

    public static function add($table)
    {
	    $keys = "";
	    $values = "";
	    foreach($_REQUEST[$table] as $key=>$value)
	    {
		    $keys .= "$key,";
		    $values .= "'$value',";
	    }
	    //usuwam ostatni przecinek
	    $keys=substr_replace($keys ,"",-1);
	    $values=substr_replace($values ,"",-1);
	    $query = "INSERT INTO $table ($keys) VALUES($values)";
	    $result = database::getConn()->query($query);
    }//end function update

    public static function getColumns($table)
	{
		$th = array();
		$result = database::getConn()->query("select column_name from information_schema.columns where table_name='$table'");
		while($row=$result->fetch_array(MYSQL_NUM))
			foreach($row as $f)
				$th[] = $f;
		return $th;
	}


}//end class module

?>
