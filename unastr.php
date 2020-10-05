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
 echo "<title>Настройки узлов-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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
print '<tr><td  align=center><table><tr><td><font class="down">Посмотреть параметры настройки узла </font></td><td>
<form name="reda" method=post action="unastr.php">
<select class=log id="idlog" name="idlog" style="height:18">';
$query = 'SELECT * FROM uzel WHERE idres<7 AND port!="odbc"';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=220;$z++)
{
 $ui = mysql_fetch_row ($e);
 while ($ui)
   {
    print '<option value="'; print $ui[4][0].$ui[4][1].$ui[4][3].$ui[4][4]; print '">'; print $ui[1];
    $ui = mysql_fetch_row ($e);
   }
}
print '</select></td>';
print '<td><input alt="see" border=0 src="files/outp.gif" type=image align=right style="cursor: hand"></form></td></tr>';
print '</table></td></tr>';
print '<table align=center><tr>';
print '<td bgcolor=#ffffff valign=top><table cellpadding="1" cellspacing="1">';
if ($_POST["idlog"]!='') $query = 'SELECT chan,par,ind,ed,name,value FROM logbase WHERE idlog=\''.$_POST["idlog"].'\'';
if ($_GET["idlog"]!='') $query = 'SELECT chan,par,ind,ed,name,value FROM logbase WHERE idlog=\''.$_GET["idlog"].'\'';
print '<tr align=center><td bgcolor=#e6e6e6><font class="main">Канал</td>
<td bgcolor=#e6e6e6><font class="main">Параметр</font></td>
<td bgcolor=#e6e6e6><font class="main">Индекс</td>
<td bgcolor=#e6e6e6><font class="main">Еденицы</td>
<td bgcolor=#e6e6e6><font class="main">Имя</td>
<td bgcolor=#e6e6e6><font class="main">Значение</td></tr>';
$max=6;
//echo $query;
$e = mysql_query ($query,$i); 
for ($z=1;$z<=1000;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui)
   {
    print '<tr>';
    for ($j=0;$j<$max;$j++)    
       	{
	 print '<td><font class="dd">';
         echo $ui[$j];
         print '</td>';
	}
   }
 else break;
}
?>
</table>
</td></tr>
<? include ("inc/down.inc"); ?>
</td><tr>
</table>
</body>
</html>