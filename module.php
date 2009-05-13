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
		if($_REQUEST['submit'] == "&#8629;")
			module::update($table);
		else if($_REQUEST['submit'] == "+")
			module::add($table);
		else if($_REQUEST['submit'] == "x")
			module::delete($table);
	}
        
	if($result=database::getConn()->query("SELECT * FROM $table"))
        {
	    //get column names, i will use it for displaying table heading and adding record
	    $th = module::getColumns($table);

            echo '<br>'.$table.'<br>';
            echo '<table border="0"><thead><tr>';
	    foreach($th as $t)
	    	echo '<th>'.$t.'</th>';
	    echo '</tr></thead><tbody>';

	    while($row=$result->fetch_array(MYSQL_ASSOC))
            {
                //TODO dodac filtrowanie argumentow php_self
                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><tr>';
		list($key,$value)=each($row);
		echo '<td><input type="text" name="'.$table.'['.$key.']" value="'.$value.'" readonly="readonly"></td>';
		while(list($key,$value)=each($row))
			echo '<td><input type="text" name="'.$table.'['.$key.']" value="'.$value.'"></td>';
	        echo '<td><input type="submit" name="submit" value="&#8629;"></td>';
	        echo '<td><input type="submit" name="submit" value="x"></td>';
                echo '</tr></form>';
            }
            
	    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><tr>';
            echo '<td></td>';
	    reset($th);
	    next($th);
	    while(list(,$value)=each($th))
	    	echo '<td><input type="text" name="'.$table.'['.$value.']" value=""></td>';
            echo '<td><input type="submit" name="submit" value="+"></td>';
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
		    $query1.=$key.'=\''.$value.'\',';
	    //usuwam ostatni przecinek
	    $query1=substr_replace($query1 ,"",-1);
	    $query2 = "UPDATE $table SET $query1 WHERE $table"."_id='$id'";
	    $result = database::getConn()->query($query2);
    }//end function update

    public static function add($table)
    {
	    foreach($_REQUEST[$table] as $key=>$value)
	    {
		    $keys .= "$key,";
		    $values .= "'$value',";
	    }
	    //remove last comma
	    $keys=substr_replace($keys ,"",-1);
	    $values=substr_replace($values ,"",-1);
	    $query = "INSERT INTO $table ($keys) VALUES($values)";
	    $result = database::getConn()->query($query);
    }//end function add

    public static function delete($table)
    {
	    $query = "DELETE FROM $table WHERE ".$table."_id = '".$_REQUEST[$table][$table."_id"]."'";
	    $result = database::getConn()->query($query);
    }//end function delete

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
