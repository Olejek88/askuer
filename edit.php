<?php include("config/local.php"); ?> 
<?php
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
//-------------------------------------------------------------------------
print '<html><head><meta http-equiv="content-type" content="text/html; charset=windows-1251">';
print '<link rel="stylesheet" href="shablon.css" type="text/css"><title>Добавить событие, влияющее на учет</title>';
print '</head>';
print '<body bgcolor=#ffffff><br><br><form name=form method=post action="tobd.php" enctype="multipart/form-data">';
//-------------------------------------------------------------------------
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">Добавление события</td></tr>
<tr><td><font class="dd"> Тип события </font></td><td>
<select class=log id="why" name="why" style="height:18">';
$query = 'SELECT * FROM why';
$e = mysql_query ($query,$i); 
$ui = mysql_fetch_row ($e);
while ($ui == true)
   {
    print '<option value="'.$ui[0].'">'; print $ui[1];
    $ui = mysql_fetch_row ($e);
   }
print '</select></td></tr>';
print '<tr><td><font class="dd">Новый тип, если нету в списке</font></td><td><input class=log name="new_why" size=8 style="width: 170px; height:18px"><br></td></tr>';
print '<tr><td><font class="dd">Описание события</font></td><td><textarea name="descr" cols="50" rows="3" class=log></textarea></td></tr>';
print '<tr><td width=120><font class="down">Дата начала проблемы</td><td align=right><table><tr><td><select class=log id="day" name="day" style="height:18">';
include ("inc/today_day.inc");
print '</select></td><td><select class=log id="month" name="month" style="height:18">';
include ("inc/today_mon.inc");
print '</select></td><td><select class=log id="year" name="year" style="height:18">';
include ("inc/today_year.inc");
print '</select></tr></table></tr>';
print '<tr><td width=120><font class="down">Дата конца проблемы</td><td align=right><table><tr><td><select class=log id="eday" name="eday" style="height:18">';
include ("inc/today_day.inc");
print '</select></td><td><select class=log id="emonth" name="emonth" style="height:18">';
include ("inc/today_mon.inc");
print '</select></td><td><select class=log id="eyear" name="eyear" style="height:18">';
include ("inc/today_year.inc");
print '</select></tr></table></tr></td></tr>';
print '<tr><td><font class="dd"> Если события связано с датчиком, указать его </font></td><td>
<select class=log id="sensors" name="sensors" style="height:18">';
$query = 'SELECT * FROM equipment ORDER BY name';
$e = mysql_query ($query,$i); 
$ui = mysql_fetch_row ($e);
print '<option value="0">Не связано с датчиком';
while ($ui)
   {
    print '<option value="'.$ui[0].'">'; print $ui[1].' (s/n '.$ui[9].')';
    $ui = mysql_fetch_row ($e);
   }
print '</select></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="uzel" style="width:1; height:1; visibility:hidden" value="'.$_GET["uzel"].'">';
print '<input name="frm" style="width:1; height:1; visibility:hidden" value="21">';
print '</td></tr></table><br></form></body></html>';
}