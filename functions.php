<?php
#http://php.net/autoload
#Unlike class extensions, optional parameters with class restrictions may not load your class.
#$b->fun('No!');//this will not load class file for aClass
function __autoload($filename) {
        if(!ereg("_loaded$", $filename))
        {
                require_once "{$filename}_loaded.php";
                require_once "{$filename}.php";
        }
}

function display($table)
{
        products::update();
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
#musze tu zrobic do...while poniewaz each() zmienia chyba pozycje wskaznika w fetch_array i przechodzi sam do nastepnego wiersza
                        do
                        {
#TODO dodac filtrowanie argumentow php_self
                                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><tr>';
                                $array_of_keys=array_keys($row);
                                while(list($a,$b)=each($array_of_keys))
                                {
                                        if($a%2!=0)
                                        {
                                                echo '<td><input type="text" name="'.$b.'" value="'.$row[$b].'"';
#aby nie zmieniac identyfikatora
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
}#end function display()


?>