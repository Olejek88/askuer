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
 echo "<title>Подробно по шкафам - Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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
<table border=0 align=center bgcolor=#ffffff>
<font class="main">

<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'SELECT * FROM shelf WHERE id=\''.$_GET["id"].'\'';
$e = mysql_query ($query,$i); 
if ($e) $ui = mysql_fetch_row ($e);
if ($ui == true) $sid=$ui[5];

print '<tr><td colspan=2><hr></td></tr>';
print '<tr><td valign=top>
	<table border=0 valign=top align=left>
	<tr><td><font class="fin1">Шкаф </font><font class="or1">'; print $ui[1]; print '</font></td></tr>';
	print '<tr><td><font class="fin1">Установлен в </font><font class="or1">'; 
	$query = 'SELECT name FROM korp WHERE korp_id=\''. $ui[3].'\'';
	$p = mysql_query ($query,$i);
	$uo = mysql_fetch_row ($p);
	if ($uo == true) print $uo[0];
	else print 'Unknown';
	print '</font></td></tr>';
    print '<tr><td><font class="fin1">Описание, расположение </font><br><br><font class="or1">'; 
    $query = 'SELECT * FROM shelf WHERE sid=\''.$sid.'\''; $mat='';
    $e = mysql_query ($query,$i); 
    $ui = mysql_fetch_row ($e);
    while ($ui)
   	{
	 $query = 'SELECT uzel FROM equipment WHERE shelf=\''.$ui[0].'\'';
	 $p = mysql_query ($query,$i); 
	 if ($p) $uo = mysql_fetch_row ($p);
	 if ($uo == true) $uzel=$uo[0];
	 $query = 'SELECT * FROM uzel WHERE id=\''.$uzel.'\'';
	 $p = mysql_query ($query,$i); 
	 if ($p) $uo = mysql_fetch_row ($p);
	 if ($uo == true) print '<a href="uzel.php?id='.$uzel.'">'.$uo[1].'</a>';

	 $ands='shelf=\''.$ui[0].'\'';
	 $mat=$mat.$ui[6];
	 print '<p>'.$ui[2].' <b>Ответственный, ключи: </b>'.$ui[4].'</p>';
	 $ui = mysql_fetch_row ($e);
	 if ($ui) $ands=$ands.' AND ';
	}
    print '</font></td></tr>';
    print '</table></td>';
    print '<td align=center width=300><a href="shelf/'.$sid.'.jpg"><img border=0 src="shelf/'.$sid.'_resize.jpg"></a></td>';
    print '</tr><tr><td colspan=2><hr></td></tr>';
    print '<tr><td valign=top><table>'; 
    print '<tr><td colspan=3 align=center><table>';
    $query = 'SELECT name,s_type,serial,shelf,date_dem_p,prichina_dem,date_mon_p,prichina_mon,Pmin,Pmax FROM equipment WHERE '.$ands;
    $max=10;
    print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td>
    <td bgcolor=#e6e6e6><font class="main">Тип прибора</td><td bgcolor=#e6e6e6><font class="main">Серийный номер</td>
    <td bgcolor=#e6e6e6><font class="main">Шкаф</td>
    <td bgcolor=#e6e6e6><font class="main">Дата последнего демонтажа</td><td bgcolor=#e6e6e6><font class="main">Причина демонтажа</td>
    <td bgcolor=#e6e6e6><font class="main">Дата последнего монтажа</td><td bgcolor=#e6e6e6><font class="main">Причина монтажа</td>
    <td bgcolor=#e6e6e6><font class="main">Pmin</td> <td bgcolor=#e6e6e6><font class="main">Pmax</td>';
    $e = mysql_query ($query,$i); 
    for ($z=1;$z<=100;$z++)
	{
	 $ui = mysql_fetch_row ($e);
	 if ($ui == true)
	   {
	    print '<tr>';
	    for ($j=0;$j<$max;$j++)    
        	{
                 print '<td bgcolor=#ffffff><font class="dd">';
	         if ($j==22)
	          {
	           $query = 'SELECT caption FROM energy_supply WHERE id='.'\''. $ui[$j].'\'';
        	   $p = mysql_query ($query,$i);
	           $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
        	   else print $ui[2];
	          }
                 else
	         if ($j==1)
	          {
	           $query = 'SELECT name FROM sensors WHERE id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
        	   $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
        	   else print 'Unknown';
	          }
                 else
        	 if ($j==10)
	          {
	           $query = 'SELECT name FROM uzel WHERE id='.'\''. $ui[$j].'\'';
        	   $p = mysql_query ($query,$i);
	           $uo = mysql_fetch_row ($p);
        	   if ($uo == true) 
                	{
	                  print '<a href="uzel.php?id='; print $ui[$j]; print '">'; 
        	          echo $uo[0];  print '</a>';
	                }
        	   else print 'Unknown';
	          }
                 else
	         if ($j==3)
	          {
	           $query = 'SELECT name FROM shelf WHERE id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
        	   $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
	           else print 'Unknown';
	          }
	         else
	         if ($j==23)
	          {
	           if ($ui[$j]==1) print 'Абсолютная';
	           else print 'Относительная';
        	  }
                 else  echo $ui[$j];
	         print '</td>';
	       	}
	   }
	}
    print '</table></td></tr>';			  
    print '<tr><td><table><tr><td align=center><br><font class="down">События узлов учета шкафа</font></td></tr>
    <tr><td align=center><br><font class="down">Выполненные по шкафу работы и расходные материалы</font></td></tr>';
    print '<tr><td align=center><br><font class="down">'.$mat.'</font></td></tr>';
    print '</table></td></tr></table></td>';                                                                                       
    print '<td><table><tr><td width=100 align=center valign=top align=center><a href="shelf/001.jpg" alt="Фотография установки датчика расхода"><img src="shelf/001_resize.jpg" width=100></a><br><font class="fin8">Узел в сборе</font></td>';
    print '<td width=100 align=center><a href="shelf/002.jpg" alt="Фотография установки датчика расхода"><img src="shelf/002_resize.jpg" width=100></a><br><font class="fin8">Установленный датчик температуры</font></td>';
    print '<td width=100 align=center><a href="shelf/003.jpg" alt="Фотография установки датчика расхода"><img src="shelf/003_resize.jpg" width=100></a><br><font class="fin8">Смонтированный расходомер на питьевую воду</font></td></tr>';
    print '<tr><td width=100 align=center><a href="shelf/004.jpg" alt="Фотография установки датчика расхода"><img src="shelf/004_resize.jpg" width=100></a><br><font class="fin8">Смонтированный расходомер на тепло</font></td>';
    print '<td width=100 align=center><a href="shelf/005.jpg" alt="Фотография установки датчика расхода"><img src="shelf/005_resize.jpg" width=100></a><br><font class="fin8">Смонтированный расходомер на тепло</font></td>';
    print '<td width=100 align=center><a href="shelf/006.jpg" alt="Фотография установки датчика расхода"><img src="shelf/006_resize.jpg" width=100></a><br><font class="fin8">Разодка питания в ШУЭР</font></td></tr>
    <tr><td colspan=3 align=center bgcolor=#e6e6e6><font class="down">Добавить фотографию</font></td></tr>
    <form name="reda" method=post action="tobd.php" enctype="multipart/form-data">
    <tr><td colspan=3><font class="down">Фото</font><input name="photo" size=30 class=log type="file" style="height:18px"></td></tr>
    <tr><td colspan=3><font class="down">Описание</font><input name="descr" size=25 class=log style="height:18px"><input alt="добавить" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="24"><input name="id" size=1 style="height:1;width:1;visibility:hidden" value="'.$sid.'"></td></tr></form></table></td>';
    print '</tr><tr><td colspan=3><hr></td></tr></table></td></tr>';
?>
</table>
</td></tr>
<? include ("inc/down.inc"); ?>
</td><tr>
</table>
</body>
</html>