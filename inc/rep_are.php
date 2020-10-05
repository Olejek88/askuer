<?php
print '<tr><td width=100><font class="down">Арендатор</td><td align=right><select class=log id="idbuy" name="idbuy" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td></tr>';
?>