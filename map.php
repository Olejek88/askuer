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
 echo "<title>Карта-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
?>

<title>(data) портал.</title>
<body leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=center border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#ffffff>
<tr><td>
<table border=0 cellspacing=0 cellpadding=1 align=center width=100%>
<tr><td align=left width=100%>
<table border=0 align=center bgcolor=#ffffff>
<tr><td>
<table border=0 align=center bgcolor=#ffffff>
<font class="main">

<script language="JavaScript1.2"> 
 if (screen.width<=800)   
    {src='gif800.gif';}
  else   
 if (screen.width<=1024)   
    {src='gif800.gif';}    
 else   
    { src='gif1000.gif'; }
 document.write('<img usemap="#menu" border=0 src="files/'+src+'" name="der">');
 document.write('<map name="menu">');
 if (src=='gif1000.gif')
document.write('<area shape="rect" coords="109,536,435,573" href="88.php?menu=9&korp=1" target="_top" Onmouseover="document.all[\'inf1\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf1\'].style.visibility=\'hidden\'" alt="корпус №1" onFocus="this.blur()">'+
	'<area shape="rect" coords="479,542,624,573" href="88.php?menu=9&korp=2" target="_top" Onmouseover="document.all[\'inf2\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf2\'].style.visibility=\'hidden\'" alt="корпус №2" onFocus="this.blur()">'+
	'<area shape="rect" coords="650,200,875,435" href="88.php?menu=9&korp=3" target="_top" Onmouseover="document.all[\'inf3\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf3\'].style.visibility=\'hidden\'" alt="корпус №3" onFocus="this.blur()">'+
	'<area shape="rect" coords="650,435,725,485" href="88.php?menu=9&korp=100" target="_top" Onmouseover="document.all[\'inf100\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf100\'].style.visibility=\'hidden\'" alt="вход Э/Э" onFocus="this.blur()">'+
	'<area shape="rect" coords="492,235,556,452" href="88.php?menu=9&korp=4" target="_top" Onmouseover="document.all[\'inf4\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf4\'].style.visibility=\'hidden\'" alt="корпус №4" onFocus="this.blur()">'+
	'<area shape="rect" coords="492,165,556,235" href="88.php?menu=9&korp=42" target="_top" Onmouseover="document.all[\'inf42\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf42\'].style.visibility=\'hidden\'" alt="корпус Кисловодск" onFocus="this.blur()">'+
	'<area shape="rect" coords="388,195,431,356" href="88.php?menu=9&korp=5" target="_top" Onmouseover="document.all[\'inf5\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf5\'].style.visibility=\'hidden\'" alt="корпус №5" onFocus="this.blur()">'+
	'<area shape="rect" coords="293,313,341,471" href="88.php?menu=9&korp=6" target="_top" Onmouseover="document.all[\'inf6\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf6\'].style.visibility=\'hidden\'" alt="корпус №6" onFocus="this.blur()">'+
	'<area shape="rect" coords="208,347,250,471" href="88.php?menu=9&korp=7" target="_top" Onmouseover="document.all[\'inf7\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf7\'].style.visibility=\'hidden\'" alt="корпус №7" onFocus="this.blur()">'+
	'<area shape="rect" coords="65,449,115,476" href="88.php?menu=9&korp=8" target="_top" Onmouseover="document.all[\'inf8\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf8\'].style.visibility=\'hidden\'" alt="корпус №8" onFocus="this.blur()">'+
	'<area shape="rect" coords="65,196,171,295" href="88.php?menu=9&korp=9" target="_top" Onmouseover="document.all[\'inf9\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf9\'].style.visibility=\'hidden\'" alt="корпус №9" onFocus="this.blur()">'+
	'<area shape="rect" coords="207,196,254,262" href="88.php?menu=9&korp=10" target="_top" Onmouseover="document.all[\'inf10\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf10\'].style.visibility=\'hidden\'" alt="корпус №10" onFocus="this.blur()">'+
	'<area shape="rect" coords="279,113,346,229" href="88.php?menu=9&korp=12" target="_top" Onmouseover="document.all[\'inf12\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf12\'].style.visibility=\'hidden\'" alt="корпус №12" onFocus="this.blur()">'+
	'<area shape="rect" coords="684,529,769,608" href="88.php?menu=9&korp=13" target="_top" Onmouseover="document.all[\'inf13\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf13\'].style.visibility=\'hidden\'" alt="корпус №13" onFocus="this.blur()">'+
	'<area shape="rect" coords="265,42,478,84" href="88.php?menu=9&korp=14" target="_top" Onmouseover="document.all[\'inf14\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf14\'].style.visibility=\'hidden\'" alt="корпус №14" onFocus="this.blur()">'+
	'<area shape="rect" coords="150,22,200,54" href="88.php?menu=9&korp=101" target="_top" Onmouseover="document.all[\'inf101\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf101\'].style.visibility=\'hidden\'" alt="вход" onFocus="this.blur()">'+
	'<area shape="rect" coords="505,27,575,61" href="88.php?menu=9&korp=41" target="_top" Onmouseover="document.all[\'inf41\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf41\'].style.visibility=\'hidden\'" alt="корпус №41" onFocus="this.blur()">'+
	'<area shape="rect" coords="60,344,185,436" href="88.php?menu=9&korp=40" target="_top" Onmouseover="document.all[\'inf40\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf40\'].style.visibility=\'hidden\'" alt="теплица" onFocus="this.blur()">'+
	'<area shape="rect" coords="63,510,90,578" href="88.php?menu=9&korp=39" target="_top" Onmouseover="document.all[\'inf39\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf39\'].style.visibility=\'hidden\'" alt="производственная мастерская" onFocus="this.blur()">'+
	'<area shape="rect" coords="436,511,476,572" href="88.php?menu=9&korp=38" target="_top" Onmouseover="document.all[\'inf38\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf38\'].style.visibility=\'hidden\'" alt="главная проходная" onFocus="this.blur()">'+
	'<area shape="rect" coords="290,231,344,312" href="88.php?menu=9&korp=61" target="_top" Onmouseover="document.all[\'inf61\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf61\'].style.visibility=\'hidden\'" alt="корпус №61" onFocus="this.blur()">'+
	'<area shape="rect" coords="817,544,891,658" href="88.php?menu=9&korp=38" target="_top" Onmouseover="document.all[\'inf35\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf35\'].style.visibility=\'hidden\'" alt="бомбоубежище" onFocus="this.blur()">'+
	'<area shape="rect" coords="26,250,41,295" href="88.php?menu=9&korp=34" target="_top" Onmouseover="document.all[\'inf34\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf34\'].style.visibility=\'hidden\'" alt="помещение для мойки автомобилей" onFocus="this.blur()">'+
	'<area shape="rect" coords="516,653,669,789" href="88.php?menu=9&korp=22" target="_top" Onmouseover="document.all[\'inf22\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf22\'].style.visibility=\'hidden\'" alt="храм" onFocus="this.blur()">'+
	'<area shape="rect" coords="108,325,176,348" href="88.php?menu=9&korp=21" target="_top" Onmouseover="document.all[\'inf21\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf21\'].style.visibility=\'hidden\'" alt="корпус №21" onFocus="this.blur()">'+
	'<area shape="rect" coords="925,197,983,246" href="88.php?menu=9&korp=31" target="_top" Onmouseover="document.all[\'inf31\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf31\'].style.visibility=\'hidden\'" alt="корпус №31(ЧКПЗ)" onFocus="this.blur()">'+
	'<area shape="rect" coords="883,248,983,339" href="88.php?menu=9&korp=31" target="_top" Onmouseover="document.all[\'inf31\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf31\'].style.visibility=\'hidden\'" alt="корпус №31(ЧКПЗ)" onFocus="this.blur()">'+
	'<area shape="rect" coords="883,339,983,479" href="88.php?menu=9&korp=28" target="_top" Onmouseover="document.all[\'inf28\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf28\'].style.visibility=\'hidden\'" alt="ЧЗСМ" onFocus="this.blur()">'+
	'<area shape="rect" coords="399,360,435,467" href="88.php?menu=9&korp=17" target="_top" Onmouseover="document.all[\'inf17\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf17\'].style.visibility=\'hidden\'" alt="участок №17" onFocus="this.blur()">'+
	'<area shape="rect" coords="795,26,830,46" target="_top" alt="склад древесной стружки" onFocus="this.blur()">'+
	'<area shape="rect" coords="854,67,870,106" target="_top" alt="отстойник" onFocus="this.blur()">'+
	'<area shape="rect" coords="787,91,805,123" target="_top" alt="отстойник усред." onFocus="this.blur()">'+
	'<area shape="rect" coords="131,449,176,474" target="_top" alt="склад Элвенса-Сервис" onFocus="this.blur()">'+
	'<area shape="rect" coords="17,18,157,80" target="_top" alt="ГСМ" onFocus="this.blur()">'+
	'<area shape="rect" coords="197,275,250,302" target="_top" alt="Склад СДЭ" onFocus="this.blur()">'+
	'<area shape="rect" coords="346,114,414,168" href="88.php?menu=9&korp=12" target="_top" target="_top" Onmouseover="document.all[\'inf12\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf12\'].style.visibility=\'hidden\'" alt="Теплоприбор Экспресс-Анализ" onFocus="this.blur()">'+
	'<area shape="rect" coords="64,327,108,344" target="_top" target="_top" alt="Теплоприбор-Авто" onFocus="this.blur()">'+
	'<area shape="rect" coords="382,602,425,615" href="88.php?menu=9&korp=30" target="_top" Onmouseover="document.all[\'inf30\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf30\'].style.visibility=\'hidden\'" alt="Магазин" onFocus="this.blur()">'+
	'<area shape="rect" coords="473,101,574,120" href="88.php?menu=9&korp=49" target="_top" Onmouseover="document.all[\'inf49\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf49\'].style.visibility=\'hidden\'" alt="Склад СДЭ" onFocus="this.blur()">'+
	'<area shape="rect" coords="12,410,22,486" href="88.php?menu=9&korp=51" target="_top" Onmouseover="document.all[\'inf51\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf51\'].style.visibility=\'hidden\'" alt="Ливнёвка" onFocus="this.blur()">'+        
	'</map>');
else if (src=='gif800.gif')
document.write('<area shape="rect" coords="90,416,348,442" href="88.php?menu=9&korp=1" target="_top" Onmouseover="document.all[\'inf1\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf1\'].style.visibility=\'hidden\'" alt="корпус №1" onFocus="this.blur()">'+
	'<area shape="rect" coords="388,422,500,442" href="88.php?menu=9&korp=2" target="_top" Onmouseover="document.all[\'inf2\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf2\'].style.visibility=\'hidden\'" alt="корпус №2" onFocus="this.blur()">'+
	'<area shape="rect" coords="524,148,700,330" href="88.php?menu=9&korp=3" target="_top" Onmouseover="document.all[\'inf3\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf3\'].style.visibility=\'hidden\'" alt="корпус №3" onFocus="this.blur()">'+
	'<area shape="rect" coords="524,330,600,368" href="88.php?menu=9&korp=100" target="_top" Onmouseover="document.all[\'inf100\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf100\'].style.visibility=\'hidden\'" alt="вход Э/Э" onFocus="this.blur()">'+
	'<area shape="rect" coords="395,161,445,347" href="88.php?menu=9&korp=4" target="_top" Onmouseover="document.all[\'inf4\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf4\'].style.visibility=\'hidden\'" alt="корпус №4" onFocus="this.blur()">'+
	'<area shape="rect" coords="395,121,445,161" href="88.php?menu=9&korp=42" target="_top" Onmouseover="document.all[\'inf42\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf42\'].style.visibility=\'hidden\'" alt="корпус Кисловодск" onFocus="this.blur()">'+
	'<area shape="rect" coords="312,141,349,276" href="88.php?menu=9&korp=5" target="_top" Onmouseover="document.all[\'inf5\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf5\'].style.visibility=\'hidden\'" alt="корпус №5" onFocus="this.blur()">'+
	'<area shape="rect" coords="237,236,274,362" href="88.php?menu=9&korp=6" target="_top" Onmouseover="document.all[\'inf6\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf6\'].style.visibility=\'hidden\'" alt="корпус №6" onFocus="this.blur()">'+
	'<area shape="rect" coords="168,264,202,369" href="88.php?menu=9&korp=7" target="_top" Onmouseover="document.all[\'inf7\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf7\'].style.visibility=\'hidden\'" alt="корпус №7" onFocus="this.blur()">'+
	'<area shape="rect" coords="51,346,93,367" href="88.php?menu=9&korp=8" target="_top" Onmouseover="document.all[\'inf8\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf8\'].style.visibility=\'hidden\'" alt="корпус №8" onFocus="this.blur()">'+
	'<area shape="rect" coords="51,146,138,222" href="88.php?menu=9&korp=9" target="_top" Onmouseover="document.all[\'inf9\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf9\'].style.visibility=\'hidden\'" alt="корпус №9" onFocus="this.blur()">'+
	'<area shape="rect" coords="167,143,203,199" href="88.php?menu=9&korp=10" target="_top" Onmouseover="document.all[\'inf10\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf10\'].style.visibility=\'hidden\'" alt="корпус №10" onFocus="this.blur()">'+
	'<area shape="rect" coords="224,78,277,167" href="88.php?menu=9&korp=12" target="_top" Onmouseover="document.all[\'inf12\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf12\'].style.visibility=\'hidden\'" alt="корпус №12" onFocus="this.blur()">'+
	'<area shape="rect" coords="551,410,617,473" href="88.php?menu=9&korp=13" target="_top" Onmouseover="document.all[\'inf13\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf13\'].style.visibility=\'hidden\'" alt="корпус №13" onFocus="this.blur()">'+
	'<area shape="rect" coords="213,20,384,54" href="88.php?menu=9&korp=14" target="_top" Onmouseover="document.all[\'inf14\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf14\'].style.visibility=\'hidden\'" alt="корпус №14" onFocus="this.blur()">'+
	'<area shape="rect" coords="130,10,170,35" href="88.php?menu=9&korp=101" target="_top" Onmouseover="document.all[\'inf101\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf101\'].style.visibility=\'hidden\'" alt="вход" onFocus="this.blur()">'+
	'<area shape="rect" coords="405,7,460,34" href="88.php?menu=9&korp=41" target="_top" Onmouseover="document.all[\'inf41\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf41\'].style.visibility=\'hidden\'" alt="корпус №41" onFocus="this.blur()">'+
	'<area shape="rect" coords="52,266,149,335" href="88.php?menu=9&korp=40" target="_top" Onmouseover="document.all[\'inf40\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf40\'].style.visibility=\'hidden\'" alt="теплица" onFocus="this.blur()">'+
	'<area shape="rect" coords="50,395,74,449" href="88.php?menu=9&korp=39" target="_top" Onmouseover="document.all[\'inf39\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf39\'].style.visibility=\'hidden\'" alt="производственная мастерская" onFocus="this.blur()">'+
	'<area shape="rect" coords="351,395,387,444" href="88.php?menu=9&korp=38" target="_top" Onmouseover="document.all[\'inf38\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf38\'].style.visibility=\'hidden\'" alt="главная проходная" onFocus="this.blur()">'+
	'<area shape="rect" coords="233,169,275,237" href="88.php?menu=9&korp=61" target="_top" Onmouseover="document.all[\'inf61\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf61\'].style.visibility=\'hidden\'" alt="вставка №6-61" onFocus="this.blur()">'+
	'<area shape="rect" coords="657,420,715,512" href="88.php?menu=9&korp=38" target="_top" Onmouseover="document.all[\'inf35\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf35\'].style.visibility=\'hidden\'" alt="бомбоубежище" onFocus="this.blur()">'+
	'<area shape="rect" coords="21,188,30,222" href="88.php?menu=9&korp=34" target="_top" Onmouseover="document.all[\'inf34\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf34\'].style.visibility=\'hidden\'" alt="помещение для мойки автомобилей" onFocus="this.blur()">'+
	'<area shape="rect" coords="410,506,529,598" href="88.php?menu=9&korp=22" target="_top" Onmouseover="document.all[\'inf22\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf22\'].style.visibility=\'hidden\'" alt="храм" onFocus="this.blur()">'+
	'<area shape="rect" coords="90,248,142,263" href="88.php?menu=9&korp=21" target="_top" Onmouseover="document.all[\'inf21\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf21\'].style.visibility=\'hidden\'" alt="корпус №21" onFocus="this.blur()">'+
	'<area shape="rect" coords="739,147,786,188" href="88.php?menu=9&korp=31" target="_top" Onmouseover="document.all[\'inf31\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf31\'].style.visibility=\'hidden\'" alt="корпус №31(ЧКПЗ)" onFocus="this.blur()">'+
	'<area shape="rect" coords="707,189,785,242" href="88.php?menu=9&korp=31" target="_top" Onmouseover="document.all[\'inf31\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf31\'].style.visibility=\'hidden\'" alt="корпус №31(ЧКПЗ)" onFocus="this.blur()">'+
	'<area shape="rect" coords="707,242,785,372" href="88.php?menu=9&korp=28" target="_top" Onmouseover="document.all[\'inf28\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf28\'].style.visibility=\'hidden\'" alt="ЧЗСМ" onFocus="this.blur()">'+
	'<area shape="rect" coords="323,280,350,363" href="88.php?menu=9&korp=17" target="_top" Onmouseover="document.all[\'inf17\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf17\'].style.visibility=\'hidden\'" alt="участок №17" onFocus="this.blur()">'+
	'<area shape="rect" coords="641,7,666,21" target="_top" alt="склад древесной стружки" onFocus="this.blur()">'+
	'<area shape="rect" coords="686,40,699,70" target="_top" alt="отстойник" onFocus="this.blur()">'+
	'<area shape="rect" coords="633,58,647,83" target="_top" alt="отстойник усред." onFocus="this.blur()">'+
	'<area shape="rect" coords="108,346,142,364" target="_top" alt="склад Элвенса-Сервис" onFocus="this.blur()">'+
	'<area shape="rect" coords="160,207,202,226" target="_top" alt="Склад СДЭ" onFocus="this.blur()">'+
	'<area shape="rect" coords="282,80,330,117" href="88.php?menu=9&korp=12" target="_top" target="_top" Onmouseover="document.all[\'inf12\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf12\'].style.visibility=\'hidden\'" alt="Теплоприбор Экспресс-Анализ" onFocus="this.blur()">'+
	'<area shape="rect" coords="52,247,87,261" target="_top" target="_top" alt="Теплоприбор-Авто" onFocus="this.blur()">'+
	'<area shape="rect" coords="309,469,344,479" href="88.php?menu=9&korp=30" target="_top" Onmouseover="document.all[\'inf30\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf30\'].style.visibility=\'hidden\'" alt="Магазин" onFocus="this.blur()">'+
	'<area shape="rect" coords="381,72,462,88" href="88.php?menu=9&korp=49" target="_top" Onmouseover="document.all[\'inf49\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf49\'].style.visibility=\'hidden\'" alt="Склад СДЭ" onFocus="this.blur()">'+
	'<area shape="rect" coords="17,320,27,368" href="88.php?menu=9&korp=51" target="_top" Onmouseover="document.all[\'inf51\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf51\'].style.visibility=\'hidden\'" alt="Ливнёвка" onFocus="this.blur()">'+
	'</map>');
</script>   

</head>
</table>
</td></tr>
</table>

<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'SELECT * FROM korp';
$e = mysql_query ($query,$i);
for ($t=1;$t<50;$t++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
	{
	 print '<div id=inf'.$ui[1].' style="position:absolute;top:20;left:650;width:330;height:100;margin-left:10;padding-left:10;background-color:#eeeeee;visibility:hidden;"><font class=fin44><br>'; 
	 $query = 'SELECT * FROM uzel WHERE idkor='.$ui[1].' AND port!="hand" AND name NOT LIKE \'%РУ-2%\'';
 	 if ($ui[1]==100) 
		$query = 'SELECT * FROM uzel WHERE (idkor=101 OR name LIKE \'%РУ-2%\') AND idres=7 ORDER BY idkor DESC';
	 if ($ui[1]==101) $query = 'SELECT * FROM uzel WHERE idkor=101 AND idres<7';
	 $r = mysql_query ($query,$i); 
	 for ($z=1;$z<=50;$z++)
		{
		 $uo = mysql_fetch_row ($r);
		 if ($uo == true) 
			{
			 if (strstr($uo[1],"РУ-2") && $hr!=1) { print '<hr>'; $hr=1; }
		 	 print '<b>'.$uo[1].'</b> ';
		         //$query = 'SELECT caption FROM energy_supply WHERE id='.'\''. $uo[2].'\'';
	        	 //$p = mysql_query ($query,$i);
			 //$up = mysql_fetch_row ($p);
			 //if ($up == true) print $up[0]; else print $uo[2];
			 if ($uo[2]==7)	print ' [W,кВт='.$uo[10].']<br>';
			 else if ($uo[2]==6 || $uo[2]==5 || $uo[2]==4) 
				{
				 print ' [T,C=';
				 printf ("%.2f",$uo[11]); 
				 print '][P,МПа=';
				 printf ("%.3f",$uo[10]); 
				 print '][V,м3=';
				 printf ("%.2f",$uo[12]); 
				 print ']<br>';
				}
                         else if ($uo[2]==0) 
				{
				 print ' [Vп,м3=';
				 printf ("%.2f",$uo[10]); 
				 print '][Vо,м3=';
				 printf ("%.2f",$uo[11]); 
				 print '][Tп,C=';
				 printf ("%.2f",$uo[12]); 
				 print '][Tо,C=';
				 printf ("%.2f",$uo[13]); 
				 print ']<br>';

				}
			 else if ($uo[2]==1) 
				{	
				 print ' [М,т/ч='.$uo[11].']<br>';
				 if ($uo[12]>0) print ' [W,ГКал='.$uo[12].']<br>';
				 else print ' [W,ГКал=0 (! ошибка датчика)]<br>';
				}
			 else if ($uo[2]==2) 
				 {
				  print ' [V,м3=';
				  if ($uo[10]<200) print $uo[10]; else print $uo[10]/1000;
				  print ']<br>';
				 } 
			}
		}
	 print '</font><br></div>';
	}
}
?>
</body>
</html>