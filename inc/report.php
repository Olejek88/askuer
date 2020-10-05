<?php
//------------------------------------------------------------------------
print '<tr><td width=350 bgcolor=#e6e6e6 align=center><font class="menu">Отчет по арендатору</font></td><td width=350 bgcolor=#e6e6e6 align=center><font class="menu">Отчет по корпусу</font></td><td width=350 bgcolor=#e6e6e6 align=center><font class="menu">Отчет по узлу учета</font></td></tr>';
print '<tr><form name="reda" method=post action="report4.php"><td width=400><table>';
include("rep_are.php"); 
include("rep_res.php"); 
include("report_inc.php");
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="1">';
print '</table></td></form>';
print '<form name="reda" method=post action="report4.php"><td width=400><table>';
include("rep_kor.php");
include("rep_res.php"); 
include("report_inc.php"); 
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="2">';
print '</table></td></form>';
print '<form name="reda" method=post action="report4.php"><td width=400><table>';
include("rep_uzl.php");
include("report_inc.php"); 
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="3">';
print '</table></td></form></tr>';
//------------------------------------------------------------------------
?>
