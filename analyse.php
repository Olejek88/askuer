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
 echo "<title>Анализ - Интерфейс'".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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
<table border=0 align=center bgcolor=#ffffff valign=top>
<tr><td>
<? include ("inc/menu.inc"); ?>
</td></tr>
<tr><td>

<table border=0 align=center bgcolor=#ffffff valign=top width=800>
<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today = getdate ();
if ($today[mon]>1) 
   { 
    $mon1=$today[mon]-1; 
    if ($mon1<10) $mon1='0'.$mon1;
    $year1=$today[year]; 
   } 
else 
   {
    $mon1=12; 
    $year1=$today[year]-1;
   }
if ($mon1==1)  $month1='Январь';   if ($mon1==2)  $month1='Февраль';
if ($mon1==3)  $month1='Март';     if ($mon1==4)  $month1='Апрель';
if ($mon1==5)  $month1='Май';      if ($mon1==6)  $month1='Июнь';
if ($mon1==7)  $month1='Июль';     if ($mon1==8)  $month1='Август';
if ($mon1==9)  $month1='Сентябрь'; if ($mon1==10) $month1='Октябрь';
if ($mon1==11) $month1='Ноябрь';   if ($mon1==12) $month1='Декабрь';

if ($mon1>1) 
   { 
    $mon2=$mon1-1; 
    if ($mon2<10) $mon2='0'.$mon2;
    $year2=$year1; 
   } 
else 
   {
    $mon2=12; 
    $year2=$year1-1;
   }

if ($mon2==1)  $month2='Январь';   if ($mon2==2)  $month2='Февраль';
if ($mon2==3)  $month2='Март';     if ($mon2==4)  $month2='Апрель';
if ($mon2==5)  $month2='Май';      if ($mon2==6)  $month2='Июнь';
if ($mon2==7)  $month2='Июль';     if ($mon2==8)  $month2='Август';
if ($mon2==9)  $month2='Сентябрь'; if ($mon2==10) $month2='Октябрь';
if ($mon2==11) $month2='Ноябрь';   if ($mon2==12) $month2='Декабрь';
//-------------------------------------------------------
print '<tr><td bgcolor=#e6e6e6 colspan=4><font class="menu">Анализ входной информации, потребления, расходов</font></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=2><font class="menu">'.$month2.'</font></td><td bgcolor=#e6e6e6 colspan=2><font class="menu">'.$month1.'</font></td></tr>';
print '<tr><td width=500 colspan=2>';
$fl='files/'.$mon2.'_'.$year2.'.bmp';
if (is_file($fl)) print '<img border=0 src="'.$fl.'"></td>';
else print '<img border=0 src="charts/pie2.php?month='.$mon2.'&year='.$year2.'"></td>';
print '<td width=500 colspan=2>';
$fl='files/'.$mon1.'_'.$year1.'.bmp';
if (is_file($fl)) print '<img border=0 src="'.$fl.'"></td>';
else print '<img border=0 src="charts/pie2.php?month='.$mon1.'&year='.$year1.'">';
print '</tr>';
print '<tr><td colspan=2><hr><br><font class="or1">';

$ffile='tmp/'.$mon2.'arend.htm';
$fp=fopen($ffile,"r");
$contents = fread ($fp, filesize ($ffile));
fclose($fp);
echo $contents;
print '</font></td>';

print '<td colspan=2><hr><br><font class="or1">';
$ffile='tmp/'.$mon1.'arend.htm';
$fp=fopen($ffile,"r");
$contents = fread ($fp, filesize ($ffile));
fclose($fp);
echo $contents;
print '</font></td></tr>';

print '<tr><td colspan=2><hr><font class="or1">Максимальное потребление за месяц '.$month2.' у ';
$ffile='tmp/'.$mon2.'maxx.htm';
$fp=fopen($ffile,"r");
$contents = fread ($fp, filesize ($ffile));
fclose($fp);
echo $contents;
print '</font></td>';
print '<td colspan=2><hr><font class="or1">Максимальное потребление за месяц '.$month1.' у ';
$ffile='tmp/'.$mon1.'maxx.htm';
$fp=fopen($ffile,"r");
$contents = fread ($fp, filesize ($ffile));
fclose($fp);
echo $contents;
print '</font></td></tr>';

print '<tr><td colspan=2 valign=top><table width=100% valign=top><tr><td><hr><font class="or1">Пиковое/наименьшее потребление тепловой энергии (ГКал) <br></font><font class="or2">';
$armfile='tmp/pike_1.htm';
$fp=fopen($armfile,"r");
$contents = fread ($fp, filesize ($ffile));
fclose($fp);
echo $contents;
print '</font></td></tr>';
sscanf($contents,"максимум %d-%d-%d %f<br>минимум  %d-%d-%d %f<br>",&$day1,&$month1,&$year1,&$val1,&$day2,&$month2,&$year2,&$val2);
if ($day1<10) $day1='0'.$day1;
if ($month1<10) $month1='0'.$month1;

$query = 'SELECT * FROM korp WHERE korp_id<100';
$b = mysql_query ($query,$i);
if ($b)
for ($l=1;$l<=80;$l++)
   {
    $ut = mysql_fetch_row ($b);
    if ($ut == true) 
	{
	 $idkorp = $ut[1];
	 if ($day1>1) $day3=$day1-1; else $day3=31;
	 $kname = $ut[2].' ('.$day3.','.$day1.'.'.$month1.'.'.$year1.')';
         $query = 'SELECT value FROM data WHERE type=2 AND date='.$year1.$month1.$day1.'000000 AND korp='.$idkorp.' AND source=1 AND name LIKE \'%энергии%\'';
         //echo $query.'<br>';
         $a = mysql_query ($query,$i);
	 if ($a)
	   {
	    $uy = mysql_fetch_row ($a);
	    if ($uy == true && $uy[0]>($val1/15)) 
		{
		 print '<tr><td bgcolor=#e6e6e6 colspan=2><font class=menu>'.$kname.'</font></td></tr>';
		 print '<tr><td  colspan=2><img border=0 src="charts/barplot.php?source=1&idkorp='.$idkorp.'&year='.$year1.'&month='.$month1.'&day='.$day1.'"></td></tr>';
		}
	   }
	}
   }
print '</table></td>';
print '<td colspan=2 valign=top><table valign=top><tr><td valign=top><hr><font class="or1">Пиковое/наименьшее потребление пожарно-питьевой воды (м3)<br></font><font class="or2">';
$armfile='tmp/pike_2.htm';
$fp=fopen($armfile,"r");
$contents = fread ($fp, filesize ($armfile));
fclose($fp);
echo $contents;
print '</font></td></tr>';
sscanf($contents,"максимум %d-%d-%d %f<br>минимум  %d-%d-%d %f<br>",&$day1,&$month1,&$year1,&$val1,&$day2,&$month2,&$year2,&$val2);
$query = 'SELECT * FROM korp WHERE korp_id<100';
$b = mysql_query ($query,$i);
if ($day1<10) $day1='0'.$day1;
if ($month1<10) $month1='0'.$month1;
if ($b)
for ($l=1;$l<=80;$l++)
   {
    $ut = mysql_fetch_row ($b);
    if ($ut == true) 
	{
	 $idkorp = $ut[1];
	 if ($day1>1) $day3=$day1-1; else $day3=31;
	 $kname = $ut[2].' ('.$day3.','.$day1.'.'.$month1.'.'.$year1.')';
         $query = 'SELECT value FROM data WHERE type=2 AND date='.$year1.$month1.$day1.'000000 AND korp='.$idkorp.' AND source=2 AND name LIKE \'%объем%\'';
         //echo $query.'<br>';
         $a = mysql_query ($query,$i);
	 if ($a)
	   {
	    $uy = mysql_fetch_row ($a);
	    if ($uy == true && $uy[0]>($val1/10)) 
		{
		 print '<tr><td bgcolor=#e6e6e6  colspan=2><font class=menu>'.$kname.'</font></td></tr>';
		 print '<tr><td  colspan=2><img border=0 src="charts/barplot.php?source=2&idkorp='.$idkorp.'&year='.$year1.'&month='.$month1.'&day='.$day1.'"></td></tr>';
		}
	   }
	}
   }
print '</table></td></tr>';

print '<tr><td colspan=2 valign=top><table width=100% valign=top><tr><td><hr><font class="or1">Пиковое/наименьшее потребление сжатого воздуха (м3)<br></font><font class="or2">';
$armfile='tmp/pike_5.htm';
$fp=fopen($armfile,"r");
$contents = fread ($fp, filesize ($armfile));
fclose($fp);
echo $contents;
print '</font></td></tr>';
sscanf($contents,"максимум %d-%d-%d %f<br>минимум  %d-%d-%d %f<br>",&$day1,&$month1,&$year1,&$val1,&$day2,&$month2,&$year2,&$val2);
if ($day1<10) $day1='0'.$day1;
if ($month1<10) $month1='0'.$month1;
$query = 'SELECT * FROM korp WHERE korp_id<100';
$b = mysql_query ($query,$i);
if ($b)
for ($l=1;$l<=80;$l++)
   {
    $ut = mysql_fetch_row ($b);
    if ($ut == true) 
	{
	 $idkorp = $ut[1];
	 if ($day1>1) $day3=$day1-1; else $day3=31;
	 $kname = $ut[2].' ('.$day3.','.$day1.'.'.$month1.'.'.$year1.')';
         $query = 'SELECT value FROM data WHERE type=2 AND date='.$year1.$month1.$day1.'000000 AND korp='.$idkorp.' AND source=5 AND name LIKE \'%объем%\'';
         //echo $query.'<br>';
         $a = mysql_query ($query,$i);
	 if ($a)
	   {
	    $uy = mysql_fetch_row ($a);
	    if ($uy == true && $uy[0]>($val1/50)) 
		{
		 print '<tr><td bgcolor=#e6e6e6 colspan=2><font class=menu>'.$kname.'</font></td></tr>';
		 print '<tr><td  colspan=2><img border=0 src="charts/barplot.php?source=5&idkorp='.$idkorp.'&year='.$year1.'&month='.$month1.'&day='.$day1.'"></td></tr>';
		}
	   }
	}
   }
print '</table></td>';
print '<td colspan=2 valign=top><table valign=top><tr><td><hr><font class="or1">Пиковое/наименьшее потребление электрической энергии (кВт)<br></font><font class="or2">';
$armfile='tmp/pike_7.htm';
$fp=fopen($armfile,"r");
$contents = fread ($fp, filesize ($armfile));
fclose($fp);
echo $contents;
print '</font></td></tr>';
sscanf($contents,"максимум %d-%d-%d %f<br>минимум  %d-%d-%d %f<br>",&$day1,&$month1,&$year1,&$val1,&$day2,&$month2,&$year2,&$val2);
if ($day1<10) $day1='0'.$day1;
if ($month1<10) $month1='0'.$month1;
$query = 'SELECT * FROM korp WHERE korp_id<100';
$b = mysql_query ($query,$i);
if ($b)
for ($l=1;$l<=80;$l++)
   {
    $ut = mysql_fetch_row ($b);
    if ($ut == true) 
	{
	 $idkorp = $ut[1];
	 if ($day1>1) $day3=$day1-1; else $day3=31;
	 $kname = $ut[2].' ('.$day3.','.$day1.'.'.$month1.'.'.$year1.')';
         $query = 'SELECT value FROM data WHERE type=2 AND date='.$year1.$month1.$day1.'000000 AND korp='.$idkorp.' AND source=7 AND name LIKE \'%энерг%\'';
         //echo $query.'<br>';
         $a = mysql_query ($query,$i);
	 if ($a)
	   {
	    $uy = mysql_fetch_row ($a);
	    if ($uy == true && $uy[0]>($val1/100)) 
		{
		 print '<tr><td bgcolor=#e6e6e6  colspan=2><font class=menu>'.$kname.'</font></td></tr>';
		 print '<tr><td  colspan=2><img border=0 src="charts/barplot.php?source=7&idkorp='.$idkorp.'&year='.$year1.'&month='.$month1.'&day='.$day1.'"></td></tr>';
		}
	   }
	}
   }
print '</table></td></tr>';

print '<tr><td colspan=2><font class="or1">прогноз потребления</font></td></tr>';
?>
</table><br>
</td><tr>
</table><br>
</td><tr>
</table>
</body>
</html>