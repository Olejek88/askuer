<?php
print '<tr><td width=100><font class="down">Узел учета</font></td><td align=right>
<select class=log id="uzel" name="uzel" style="height:18">';
$query = 'SELECT * FROM uzel WHERE port NOT LIKE \'%odbc%\' ORDER BY idres';
echo $query;
$e = mysql_query ($query,$i); 
$ui = mysql_fetch_row ($e);
while ($ui)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
    $ui = mysql_fetch_row ($e);
   }
print '</select></td></tr>';
?>