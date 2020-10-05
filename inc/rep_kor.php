<?php
print '<tr><td width=100><font class="down">Корпус</font></td><td align=right><select class=log id="idkor" name="idkor" style="height:18">';
print '<option value="99">Все корпуса';
for ($z=0;$z<=120;$z++)
{
 $query = 'SELECT name,korp_id FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[1]; print '">'; print $ui[0];
   }
}
print '</select></td></tr><tr>';
?>