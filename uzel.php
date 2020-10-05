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
 echo "<title>Подробно по узлам-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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
$query = 'SELECT * FROM uzel WHERE id=\''.$_GET["id"].'\'';
$e = mysql_query ($query,$i); 
if ($e)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<tr><td colspan=4><hr></td></tr>';
    print '<tr><td valign=top><table border=0 valign=top><tr><td><font class="fin1">Узел учета </font><font class="or1">'; print $ui[1]; print '</font></td></tr>';
    print '<tr><td><font class="zagl">Энергоресурс </font><font class="or1">'; 
    $query = 'SELECT caption FROM energy_supply WHERE id=\''. $ui[2].'\'';
    $p = mysql_query ($query,$i);
    $uo = mysql_fetch_row ($p);
    if ($uo == true) print $uo[0];
    else print $ui[2];
    print '</font></td></tr>';
    print '<tr><td><font class="zagl">Корпус </font><font class="or1">'; 
    $query = 'SELECT name FROM korp WHERE korp_id=\''. $ui[3].'\'';
    $p = mysql_query ($query,$i);
    $uo = mysql_fetch_row ($p);
    if ($uo == true) print $uo[0];
    else print 'Unknown';
    print '</font></td></tr>';
    print '<tr><td><hr></td></tr>';
    print '<tr><td><table>'; 
    //if ($ui[2]==7 || $ui[3]==101) $query = 'SELECT name,value FROM data WHERE korp=\''.$ui[3].'\' AND device=\''.$ui[4][3].$ui[4][4].$ui[4][0].$ui[4][1].'\' AND source=\''.$ui[2].'\'AND type=\'0\'';
    if ($ui[2]==7 || $ui[3]==101) $query = 'SELECT name,value FROM data WHERE device=\''.$ui[4][3].$ui[4][4].$ui[4][0].$ui[4][1].'\' AND source=\''.$ui[2].'\' AND type=\'0\'';
    else $query = 'SELECT name,value FROM data WHERE korp=\''.$ui[3].'\' AND device=\''.$ui[4][3].$ui[4][4].'\' AND source=\''.$ui[2].'\' AND type=\'0\'';
    //echo $query;
    $p = mysql_query ($query,$i);
    for ($h=0;$h<50;$h++)
        {
         $uo = mysql_fetch_row ($p);
         if ($uo == true) 
           {
            print '<tr><td><font class="or1">';
            print $uo[0]; print '</font><font class="menu"> ';
            print $uo[1]; 
            if (strstr ($uo[0],'Объемный расход') || strstr ($uo[0],'расхода воды по')) print ' (м3/ч)';
            if (strstr ($uo[0],'авлени')) print ' (МПа)';
            if (strstr ($uo[0],'емператур')) print ' (С)';
            if (strstr ($uo[0],'епловая мощность')) print ' (ГКал/ч)';
            if (strstr ($uo[0],'асс')) print ' (кг/ч)';
	    if ($ui[2]==7) print ' (кВт/ч)';
            print '</font></td></tr>';
           }    
        }
    print '</table></td></tr></table></td>';
    print '<td bgcolor=#ffffff valign=top><table><form name="redd" method=post action="report.php"><tr><td colspan=2 height=1 bgcolor=#e6e6e6>'; 
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="99" id="idbuy" name="idbuy"><input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[4].'" id="idkon" name="idkon">';
    $today = getdate (); if ($today[mon]<10) $mon='0'.$today[mon]; else $mon=$today[mon];
    if ($today[mday]<10) $mday='0'.$today[mday]; else $mday=$today[mday];
    print '<input size=1 style="height:1;width:1;visibility:hidden" id="otch" name="otch" value="11">';
    print '</td></tr></form>';

    print '<tr><td bgcolor=#e6e6e6><font class="down">Архивные данные</font></td><td  bgcolor=#e6e6e6></td></tr>';
	if ($ui[7]==1)
	   {
	    print '<tr><td colspan=2><form name="redd" method=post action="report.php">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="99" id="idbuy" name="idbuy">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[2].'" id="source" name="source">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[3].'" id="idkorp" name="idkorp">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[4].'" id="idkon" name="idkon">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" id="otch" name="otch" value="21">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$mday.'" id="day" name="day">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$mon.'" id="month" name="month">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$today[year].'" id="year" name="year"></td></tr>';
	    print '<tr><td><font class="down">Часовой</font></td><td><input alt="see" border=0 src="files/outp.gif" type=image align=right style="cursor: hand"></form></td></tr>';
	    print '<tr><td colspan=2><form name="redd" method=post action="report.php">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="99" id="idbuy" name="idbuy">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[2].'" id="source" name="source">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[3].'" id="idkorp" name="idkorp">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[4].'" id="idkon" name="idkon">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" id="otch" name="otch" value="22">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$mday.'" id="day" name="day">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$mon.'" id="month" name="month">';
	    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$today[year].'" id="year" name="year"></td></tr>';
	    print '<tr><td><font class="down">Дневной</font></td><td><input alt="see" border=0 src="files/outp.gif" type=image align=right style="cursor: hand"></form></td></tr>';
	  }
    print '<tr><td colspan=2><form name="redd" method=post action="report.php">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="99" id="idbuy" name="idbuy">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[2].'" id="source" name="source">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[3].'" id="idkorp" name="idkorp">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[4].'" id="idkon" name="idkon">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$ui[7].'" id="typ" name="typ">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" id="otch" name="otch" value="24">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$mday.'" id="day" name="day">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$mon.'" id="month" name="month">';
    print '<input size=1 style="height:1;width:1;visibility:hidden" value="'.$today[year].'" id="year" name="year"></td></tr>';
    print '<tr><td><font class="down">По месяцам</font></td><td><input alt="see" border=0 src="files/outp.gif" type=image align=right style="cursor: hand"></form></td></tr>';
    print '<tr><td colspan=2 bgcolor=#bebebe></td></tr>';
    print '<tr><td><br><font class="down">Параметры настройки</font></td><td><br><a href="unastr.php?idlog='.$ui[4][0].$ui[4][1].$ui[4][3].$ui[4][4].'"><img alt="see" border=0 src="files/outp.gif"></a></td></tr>';
    print '<tr><td colspan=2 bgcolor=#bebebe></td></tr>';
    print '<tr><td><font class="down">IP адрес преобразователя</font></td><td><font class="zagl">';
    if ($ui[5]=='com1') print '10.23.6.102';
    if ($ui[5]=='com3') print '10.22.14.11';
    if ($ui[5]=='com4') print '192.1.160.20';
    if ($ui[5]=='com5') print '10.10.6.104';
    if ($ui[5]=='com6') print '10.23.6.103';
    if ($ui[5]=='com8') print '10.22.14.110';
    if ($ui[5]=='com9') print '192.1.160.21';
    if ($ui[5]=='odbc') print '10.3.21.250 (tsu_srv.jsc.tpchel.ru)';
    print '</font></td></tr>';
    print '<tr><td><font class="down">Адрес на шине</font></td><td><font class="zagl">'.$ui[7].'</font></td></tr>';
    print '<tr><td><font class="down">Идентификатор</font></td><td><font class="zagl">'.$ui[4].'</font></td></tr>';

    print '</table></td>';
    if ($ui[2]<7)
	{
	   print '<td bgcolor=#ffffff valign=top><table>';
	   print '<tr><td align=center><table border=0><tr><td colspan=2 bgcolor=#e6e6e6><font class="down">Перерывы электропитания</font></td></tr>';
	   print '<tr><td bgcolor=#e6e6e6 width=120><font class="or1">Дата</font></td><td><font class="or1" bgcolor=#e6e6e6>Продолжительность (ч.)</font></td></tr>';
	   $query = 'SELECT * FROM elect WHERE logik_id LIKE \'%'.$ui[4][0].$ui[4][1].$ui[4][2].$ui[4][3].$ui[4][4].'%\' ORDER BY date DESC';
	   // echo $query;
	   $e = mysql_query ($query,$i);
	   for ($z=1;$z<=10;$z++)
	        {
        	 $ui = mysql_fetch_row ($e);
	         if ($ui == true) 
	            {
	             print '<tr>';
	                print '<td bgcolor=#e6e6e6><font class="dd">'.$ui[1][0].$ui[1][1].$ui[1][2].$ui[1][3].'-'.$ui[1][4].$ui[1][5].'-'.$ui[1][6].$ui[1][7].' '.$ui[1][8].$ui[1][9].':'.$ui[1][10].$ui[1][11].':'.$ui[1][12].$ui[1][13].'</font></td>';
	                print '<td><font class="dd">'.$ui[2].'</font></td>';
	             print '</tr>';
	            }
	        }
	    print '</table></td></tr></table></td>';  
	 }
    print '</tr><tr><td colspan=4><hr></td></tr></table></td></tr>';
    print '<tr><td colspan=4 align=center><table>';
    $query = 'SELECT name,s_type,serial,shelf,date_dem_p,prichina_dem,date_mon_p,prichina_mon,Pmin,Pmax FROM equipment WHERE uzel=\''.$_GET["id"].'\'';
    $max=10;
    print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td>
    <td bgcolor=#e6e6e6><font class="main">Тип прибора</td><td bgcolor=#e6e6e6><font class="main">Серийный номер</td>
    <td bgcolor=#e6e6e6><font class="main">Шкаф</td>
    <td bgcolor=#e6e6e6><font class="main">Дата последнего демонтажа</td><td bgcolor=#e6e6e6><font class="main">Причина демонтажа</td>
    <td bgcolor=#e6e6e6><font class="main">Дата последнего монтажа</td><td bgcolor=#e6e6e6><font class="main">Причина монтажа</td>
    <td bgcolor=#e6e6e6><font class="main">Pmin</td> <td bgcolor=#e6e6e6><font class="main">Pmax</td>';
    $e = mysql_query ($query,$i); 
    for ($z=1;$z<=1000;$z++)
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
    print '<tr><td colspan=10 valign=top align=center><table  align=center><tr><td bgcolor=#e6e6e6 colspan=3><font class="down">События узла учета [<a style="cursor: pointer" onclick="(imgs)=window.open(\'edit.php?uzel='.$_GET["id"].'\',\'_blank\',\'width=590,height=320,toolbar=no,menubar=no,location=no,status=no,resizable=no,scrollbars=no,top=0,left=0\');">добавить информацию</a>]</font></td></tr>
    <tr><td bgcolor=#e6e6e6><font class="main">Событие</td><td bgcolor=#e6e6e6><font class="main">Возникновение</td><td bgcolor=#e6e6e6><font class="main">Обнаружение</td><td bgcolor=#e6e6e6><font class="main">Узел учета</td><td bgcolor=#e6e6e6><font class="main">Описание</td><td bgcolor=#e6e6e6><font class="main">Датчик</td></tr>';
    $query = 'SELECT * FROM event2 WHERE uzel='.$_GET["id"].' ORDER BY date_end DESC'; 
    $e = mysql_query ($query,$i);
    $ui = mysql_fetch_row ($e);
    while ($ui)
	{
	 print '<tr>';
	 for ($j=1;$j<7;$j++)    
	 	{
                 print '<td bgcolor=#ffffff><font class="dd">';
	         if ($j==1)
	          {
	           $query = 'SELECT event FROM why WHERE id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
        	   $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
	           else print 'Unknown';
	          }
		 else
	         if ($j==4)
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
	         if ($j==6)
	          {
	           $query = 'SELECT name FROM equipment WHERE id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
        	   $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
        	   else print 'Не связано с датчиком';
	          }
		 else print $ui[$j];
		 print '</font></td>';				
		}
	 print '</tr>';
	 $ui = mysql_fetch_row ($e);
        }
    print '</table></td></tr>';
   }
}
?>
</table>
</td></tr>
<? include ("inc/down.inc"); ?>
</td><tr>
</table>
</body>
</html>