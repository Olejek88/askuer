<?php include("config/local.php"); ?> 
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="shablon.css" type="text/css">
<?
include_once("../../adodb/adodb.inc.php");
$db= &ADONewConnection($sqldriver);
if (!$db->Connect($mysql_host, $mysql_user, $mysql_password, $mysql_db_name))

{die("Error: ".$db->ErrorMsg());}

 $resq = "SELECT * FROM users WHERE user='".$PHP_AUTH_USER."' AND passwd='".$PHP_AUTH_PW."';"; 
 $rc=&$db->Execute($resq);
 echo "<title>Распределение потребления энергоресурсов по арендаторам '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
?>
</head>
<body><table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
<tr><td><table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
<tr>
<td id="header" style="width:100%;background-image: url(files/14164-598x134.jpg);">
<a href="http://www.tpchel.ru/" title="На главную страницу ОАО Теплоприбор"><img src="files/logo.gif" alt="На главную страницу" class="logo" align="top" width="103" height="100" border="0"/>
</a><div class="transparent"><a href="http://www.rossich.ru/"><img src="files/transparent.gif" /></a></div>						
</div></td></tr></table></td></tr>

<tr><td>
<table border=0 align=center bgcolor=#ffffff>
<tr><td>
<? include ("inc/menu.inc"); ?>
</td></tr>
<tr><td>

<table border=0 align=center bgcolor=#ffffff valign=top width=950>
<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today = getdate ();
if ($_POST["year"]!='') $year=$_POST["year"];
else $year=$today[year];
if ($_POST["mon"]!='') $mon=$_POST["mon"];
else 
  {
   $mon=$today[mon];
   if ($mon>1) $mon=$mon-1; 
   else { $year=$year-1; $mon=12; } 
  }
//-------------------------------------------------------
print '<form name="redd" method=post action="lmon.php">';
print '<tr><td align=center><font class="menu">Месяц и год отчета: </font><select class=log id="mon" name="mon" style="height:18">';
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'; if ($z>9) print $z; else print '0'.$z; print '" ';
    if ($z==$mon) print 'selected '; print '>'; 
    if ($z==1) print 'Январь'; if ($z==2) print 'Февраль';
    if ($z==3) print 'Март';  if ($z==4) print 'Апрель';
    if ($z==5) print 'Май';    if ($z==6) print 'Июнь';
    if ($z==7) print 'Июль';   if ($z==8) print 'Август';
    if ($z==9) print 'Сентябрь';   if ($z==10) print 'Октябрь';
    if ($z==11) print 'Ноябрь';    if ($z==12) print 'Декабрь';
   }
print '</select><select class=log id="year" name="year" style="height:18">';
for ($z=0;$z<=5;$z++)
   {
    print '<option value="'; print $today[year]-$z; print '" ';
    if ($today[year]-$z == $year) print 'selected';
    print '>'; print $today[year]-$z;
   }
print '</select></td><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/outp.gif" type=image></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Тепловая энергия</font></td><td bgcolor=#e6e6e6><font class="menu">Подробно по объектам</font></td></tr>';
print '<tr><td width=700><img alt="Подождите, идет обработка данных для построения диаграммы" border=0 src="charts/pie.php?source=1&month='.$mon.'&year='.$year.'"></td><td valign=top>';
$query = 'SELECT * FROM buyers'; 
$r = mysql_query ($query,$i);
for ($m=1;$m<=50;$m++)  {
  $uo = mysql_fetch_row ($r);
  if ($uo == true) {
     $query = 'SELECT * FROM korp';
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)  {
         $uu = mysql_fetch_row ($t);
         if ($uu == true)  {
	    $query = 'SELECT SUM(K2) FROM obj WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
	    $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a); 
	    if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	    if ($K>0) { $k=88; print '<a href="list.php?source=1&idbuy='.$uo[0].'&month='.$mon.'&year='.$year.'"><font class="or1">'.$uo[1].'</font></a><br>'; }
   }}}}
print '</td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Пожарно питьевая вода</font></td><td bgcolor=#e6e6e6><font class="menu">Подробно по объектам</font></td></tr>';
print '<tr><td><img border=0 alt="Подождите, идет обработка данных для построения диаграммы" src="charts/pie.php?source=2&month='.$mon.'&year='.$year.'"></td><td valign=top>';
$query = 'SELECT * FROM buyers'; $r = mysql_query ($query,$i);
for ($m=1;$m<=50;$m++)  {
  $uo = mysql_fetch_row ($r);
  if ($uo == true) {
     $query = 'SELECT * FROM korp';
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)  {
         $uu = mysql_fetch_row ($t);
         if ($uu == true)  {
	    $query = 'SELECT SUM(K3) FROM obj WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
	    $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a); 
	    if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	    if ($K>0) 
		{ 
		 $k=88; 
		 print '<a href="list.php?source=2&idbuy='.$uo[0].'&month='.$mon.'&year='.$year.'">';
		 print '<font class="or1">'.$uo[1].'</font></a><br>'; 
		}
   }}}}
print '</td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Сжатый воздух</font></td><td bgcolor=#e6e6e6><font class="menu">Подробно по объектам</font></td></tr>';
print '<tr><td><img border=0 alt="Подождите, идет обработка данных для построения диаграммы" src="charts/pie.php?source=5&month='.$mon.'&year='.$year.'"></td><td valign=top>';
$query = 'SELECT * FROM buyers'; $r = mysql_query ($query,$i);
for ($m=1;$m<=50;$m++)  {
  $uo = mysql_fetch_row ($r);
  if ($uo == true) {
     $query = 'SELECT * FROM korp';
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)  {
         $uu = mysql_fetch_row ($t);
         if ($uu == true)  {
	    $query = 'SELECT SUM(K6) FROM obj WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
	    $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a); 
	    if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	    if ($K>0) 
		{ 
		 $k=88; 
		 print '<a href="list.php?source=5&idbuy='.$uo[0].'&month='.$mon.'&year='.$year.'">';
		 print '<font class="or1">'.$uo[1].'</font></a><br>'; 
		}
   }}}}
print '</td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Электрическая энергия</font></td><td bgcolor=#e6e6e6><font class="menu">Подробно по объектам</font></td></tr>';
print '<tr><td><img alt="Подождите, идет обработка данных для построения диаграммы" border=0 src="charts/pie.php?source=7&month='.$mon.'&year='.$year.'"></td><td valign=top>';
$query = 'SELECT * FROM buyers'; $r = mysql_query ($query,$i);
for ($m=1;$m<=50;$m++)  {
  $uo = mysql_fetch_row ($r);
  if ($uo == true) 
	{
	 print '<a href="list.php?source=7&idbuy='.$uo[0].'&month='.$mon.'&year='.$year.'">';
	 print '<font class="or1">'.$uo[1].'</font></a><br>'; 
	}
   }
print '</td></tr></form>';
?>
</table><br>
</td><tr>
</table><br>
</td><tr>
</table>
</body>
</html>