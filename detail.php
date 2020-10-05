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
 echo "<title>Отчет по арендатору - Интерфейс'".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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

<table border=0 align=center bgcolor=#ffffff valign=top width=1000>
<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$arr = get_defined_vars();
//-------------------------------------------------------
$query = 'SELECT caption FROM buyers WHERE idx='.'\''.$idbuy.'\'';
$p = mysql_query ($query,$i);
$uo = mysql_fetch_row ($p);
if ($uo == true) $buyers=$uo[0];
else $buyers='Неизвестен';
print '<tr><td bgcolor=#e6e6e6 colspan=2><font class="menu"> </font></td></tr>';
print '<tr><td colspan=2><table><tr>';
$today = getdate ();
for ($o=0;$o<12;$o++)
{
 if ($today[mon]>1) $today[mon]--; 
 else 
   {
    $today[mon]=12; 
    $today[year]--;
   }
 if ($today[mon]==1)  $month1='Январь';   if ($today[mon]==2)  $month1='Февраль';
 if ($today[mon]==3)  $month1='Март';     if ($today[mon]==4)  $month1='Апрель';
 if ($today[mon]==5)  $month1='Май';      if ($today[mon]==6)  $month1='Июнь';
 if ($today[mon]==7)  $month1='Июль';     if ($today[mon]==8)  $month1='Август';
 if ($today[mon]==9)  $month1='Сентябрь'; if ($today[mon]==10) $month1='Октябрь';
 if ($today[mon]==11) $month1='Ноябрь';   if ($today[mon]==12) $month1='Декабрь';

 print '<td bgcolor=#f0f0f0><a href="detail.php?month='.$today["mon"].'&year='.$today["year"].'&idbuy='.$idbuy.'"><font class="menu">['.$month1.','.$today[year].']</font></td>';
}
print '</tr></table></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=2><font class="menu">Отчет по арендатору '.$buyers.' на '; 
 if ($arr["month"]==1)  $month1='Январь';   if ($arr["month"]==2)  $month1='Февраль';
 if ($arr["month"]==3)  $month1='Март';     if ($arr["month"]==4)  $month1='Апрель';
 if ($arr["month"]==5)  $month1='Май';      if ($arr["month"]==6)  $month1='Июнь';
 if ($arr["month"]==7)  $month1='Июль';     if ($arr["month"]==8)  $month1='Август';
 if ($arr["month"]==9)  $month1='Сентябрь'; if ($arr["month"]==10) $month1='Октябрь';
 if ($arr["month"]==11) $month1='Ноябрь';   if ($arr["month"]==12) $month1='Декабрь';
// if ($arr["month"]<12) $arr["month"]++; else { $arr["month"]=1; $arr["year"]++; }

if ($arr["year"]=="") print 'текущий момент';
else print $month1.','.$arr[year];
print '</font></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Тепловая энергия дневной W,ГКал</font></td><td bgcolor=#e6e6e6 colspan=1><font class="menu">Тепловая энергия по месяцам W,ГКал</font></td></tr>';
print '<tr><td width=500 colspan=1>';
print '<img border=0 src="charts/arend_xy.php?idbuy='.$idbuy.'&source=1&month='.$arr["month"].'&year='.$arr["year"].'"></td>';
print '<td width=500 colspan=1>';
print '<img border=0 src="charts/arend_bar.php?idbuy='.$idbuy.'&source=1&month='.$arr["month"].'&year='.$arr["year"].'"></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Пожарно-питьевая вода дневной V,м3</font></td><td bgcolor=#e6e6e6 colspan=1><font class="menu">Пожарно-питьевая вода по месяцам V,м3</font></td></tr>';
print '<tr><td width=500 colspan=1>';
print '<img border=0 src="charts/arend_xy.php?idbuy='.$idbuy.'&source=2&month='.$arr["month"].'&year='.$arr["year"].'"></td>';
print '<td width=500 colspan=1>';
print '<img border=0 src="charts/arend_bar.php?idbuy='.$idbuy.'&source=2&month='.$arr["month"].'&year='.$arr["year"].'"></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Сжатый воздух дневной V,м3</font></td><td bgcolor=#e6e6e6 colspan=1><font class="menu">Сжатый воздух по месяцам V,м3</font></td></tr>';
print '<tr><td width=500 colspan=1>';
print '<img border=0 src="charts/arend_xy.php?idbuy='.$idbuy.'&source=5&month='.$arr["month"].'&year='.$arr["year"].'"></td>';
print '<td width=500 colspan=1>';
print '<img border=0 src="charts/arend_bar.php?idbuy='.$idbuy.'&source=5&month='.$arr["month"].'&year='.$arr["year"].'"></td></tr>';
print '<tr><td bgcolor=#e6e6e6 colspan=1><font class="menu">Кислород дневной V,м3</font></td><td bgcolor=#e6e6e6 colspan=1><font class="menu">Электрическая энергия по месяцам W,кВт</font></td></tr>';
print '<tr><td width=500 colspan=1>';
print '<img border=0 src="charts/arend_xy.php?idbuy='.$idbuy.'&source=6&month='.$arr["month"].'&year='.$arr["year"].'"></td>';
print '<td width=500 colspan=1>';
print '<img border=0 src="charts/arend_bar.php?idbuy='.$idbuy.'&source=7&month='.$arr["month"].'&year='.$arr["year"].'"></td></tr>';

print '<tr><td colspan=2><font class="menu">Подробный расклад по объектам, принадлежащим арендатору</font></td></tr>';
print '<tr><td colspan=2><table border=0 align=center bgcolor=#ffffff valign=top width=1000>';

print '<tr>';
print '<td bgcolor=#e6e6e6 align=center><font class="main">Название</font></td>';
print '<td bgcolor=#e6e6e6 align=center><font class="main">Корпус</font></td>';
print '<td bgcolor=#e6e6e6 align=center><font class="main">Тип</font></td><td align=center bgcolor=#e6e6e6><font class="main">Номер БТИ / Инвентарный</font></td>';
print '<td align=center bgcolor=#e6e6e6><font class="main">Полезный объем</td>';
print '<td bgcolor=#e6e6e6 align=center><font class="main">Тепло W,ГКал</td><td align=center bgcolor=#e6e6e6><font class="main">Вода V,м3</td><td bgcolor=#e6e6e6 align=center><font class="main">Сжатый воздух V,м3</td>';
print '</tr>';

$today = getdate ();	
if ($today["mon"]<10) $today["mon"]='0'.$today["mon"];
if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
if ($arr["year"]!="") $bdate=$arr["year"].$arr["month"].'01000000';
else $bdate=$today["year"].$today["mon"].'01000000';	 

$query = 'SELECT * FROM korp WHERE korp_id<100';
$b = mysql_query ($query,$i);
if ($b)
for ($t=1;$t<=50;$t++)
    {
     $uo = mysql_fetch_row ($b);
     if ($uo == true)
        {
	 $tepl=0; $voda=0; $vozd=0;
	 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND date='.$bdate.' AND korp='.$uo[1].' AND name LIKE \'%энергии%\' AND source=1';
	 //echo $query.'<br>';
	 $a = mysql_query ($query,$i);
	 if ($a)
	    {
             $uy = mysql_fetch_row ($a);
             if ($uy == true) $tepl=$uy[0];
	    }
	 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND date='.$bdate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source=2';
	 $a = mysql_query ($query,$i);
	 if ($a)
	    {
             $uy = mysql_fetch_row ($a);
             if ($uy == true) $voda=$uy[0];
	    }
	 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND date='.$bdate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source=5';
	 $a = mysql_query ($query,$i);
	 if ($a)
	    {
             $uy = mysql_fetch_row ($a);
             if ($uy == true) $vozd=$uy[0];
	    }
	 //echo '['.$uo[2].'] '.$tepl.' '.$voda.' '.$vozd.'<br>';
         $query = 'SELECT name,idkorp,type,BTI,volume,K2,K3,K6 FROM obj WHERE type!=1 AND idbuy='.$idbuy.' AND idkorp='.$uo[1];
	 //echo  $query.'<br>';
         $a = mysql_query ($query,$i); 
	 for ($r=0;$r<300;$r++)
	     {
	      $uy = mysql_fetch_row ($a); 
              if ($uy == true)
	    	{
	     	 print '<tr>';
	     	 for ($y=0;$y<8;$y++)
		     {
		      print '<td>';
		      if ($y==1) print $uo[2];
		      else if ($y==2) 
			      {
			       if ($uy[2]=='1') print 'Корпус';
			       if ($uy[2]=='2') print 'Помещение';
			       if ($uy[2]=='3') print 'Агрегат';
			      }
		      else if ($y<5) print $uy[$y];
		      if ($y==5) printf ("%.5f",$uy[$y]*$tepl);
		      if ($y==6) printf ("%.5f",$uy[$y]*$voda);
		      if ($y==7) printf ("%.5f",$uy[$y]*$vozd);
		      print '</td>';
		     }
		}
 	      print '</tr>';
	     }
        }
   }
print '</table></td></tr>';
?>
</table><br>
</td><tr>
</table><br>
</td><tr>
</table>
</body>
</html>