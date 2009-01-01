<?php
require_once('functions.php');

class module
{
        public static function display($table)
        {
          module::update($table);
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

        public static function update($table)
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

}//end class module

?>
