<?php
print '<tr><td width=100><font class="down">Энергоресурс</font></td><td align=right>
<select class=log id="source" name="source" style="height:18">';
print '<option value="99">Все энергоресурсы';
for ($z=0;$z<=120;$z++)
{
 $query = 'SELECT caption FROM energy_supply WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td></tr>';
?>