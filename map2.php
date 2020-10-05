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
 echo "<title>Карта ШУЭР и линий связи - Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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
 document.write('<img usemap="#menu" border=0 src="files/maps.jpg" name="der">');
 document.write('<map name="menu">');
 document.write('<area shape="rect" coords="387,690,407,716" href="shelf.php?id=3" target="_top" Onmouseover="document.all[\'inf3\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf3\'].style.visibility=\'hidden\'" alt="ШУЭР 1-1 (воздух, тепло, вода)" onFocus="this.blur()">'+
	'<area shape="rect" coords="131,693,150,719" href="shalf.php?id=63" target="_top" Onmouseover="document.all[\'inf4\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf4\'].style.visibility=\'hidden\'" alt="ШУЭР 1-2 (воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="531,347,550,372" href="shelf.php?id=8" target="_top" Onmouseover="document.all[\'inf8\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf8\'].style.visibility=\'hidden\'" alt="ШУЭР 5-1 (тепло, вода, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="290,448,309,474" href="shelf.php?id=6" target="_top" Onmouseover="document.all[\'inf6\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf6\'].style.visibility=\'hidden\'" alt="ШУЭР 7-1 (тепло, вода)" onFocus="this.blur()">'+
	'<area shape="rect" coords="830,359,848,385" href="shelf.php?id=11" target="_top" Onmouseover="document.all[\'inf11\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf11\'].style.visibility=\'hidden\'" alt="ШУЭР 3-1 (вода, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="691,235,711,262" href="shelf.php?id=13" target="_top" Onmouseover="document.all[\'inf13\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf13\'].style.visibility=\'hidden\'" alt="ШУЭР 4-1 (тепло)" onFocus="this.blur()">'+
	'<area shape="rect" coords="684,465,704,491" href="shelf.php?id=15" target="_top" Onmouseover="document.all[\'inf15\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf15\'].style.visibility=\'hidden\'" alt="ШУЭР 4-2 (воздух, тепло, вода)" onFocus="this.blur()">'+
	'<area shape="rect" coords="39,313,59,339" href="shelf.php?id=18" target="_top" Onmouseover="document.all[\'inf18\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf18\'].style.visibility=\'hidden\'" alt="ШУЭР 9-1 (тепло, вода)" onFocus="this.blur()">'+
	'<area shape="rect" coords="179,290,200,316" href="shelf.php?id=19" target="_top" Onmouseover="document.all[\'inf19\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf19\'].style.visibility=\'hidden\'" alt="ШУЭР 9-2 (вода, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="392,256,411,283" href="shelf.php?id=20" target="_top" Onmouseover="document.all[\'inf23\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf23\'].style.visibility=\'hidden\'" alt="ШУЭР 12-1 (вода, воздух, тепло)" onFocus="this.blur()">'+
	'<area shape="rect" coords="395,376,414,402" href="shelf.php?id=26" target="_top" Onmouseover="document.all[\'inf26\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf26\'].style.visibility=\'hidden\'" alt="ШУЭР 61-2 (кислород, природный газ)" onFocus="this.blur()">'+
	'<area shape="rect" coords="1004,572,1023,596" href="shelf.php?id=28" target="_top" Onmouseover="document.all[\'inf28\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf28\'].style.visibility=\'hidden\'" alt="ШУЭР 3-3 (вода, тепло)" onFocus="this.blur()">'+

	'<area shape="rect" coords="1156,274,1177,303" href="shelf.php?id=27" target="_top" Onmouseover="document.all[\'inf27\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf27\'].style.visibility=\'hidden\'" alt="ШУЭР 3-2 (тепло, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="675,38,695,64" href="shelf.php?id=31" target="_top" Onmouseover="document.all[\'inf31\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf31\'].style.visibility=\'hidden\'" alt="ШУЭР 41-1 (тепло)" onFocus="this.blur()">'+
	'<area shape="rect" coords="295,245,316,270" href="shelf.php?id=32" target="_top" Onmouseover="document.all[\'inf32\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf32\'].style.visibility=\'hidden\'" alt="ШУЭР 10-1 (вода, тепло, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="358,306,377,332" href="shelf.php?id=34" target="_top" Onmouseover="document.all[\'inf34\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf34\'].style.visibility=\'hidden\'" alt="ШУЭР 61-1 (вода, тепло, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="63,648,84,675" href="shelf.php?id=36" target="_top" Onmouseover="document.all[\'inf36\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf36\'].style.visibility=\'hidden\'" alt="ШУЭР ЭВС-1 (вода, тепло)" onFocus="this.blur()">'+
	'<area shape="rect" coords="533,692,553,718" href="shelf.php?id=37" target="_top" Onmouseover="document.all[\'inf37\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf37\'].style.visibility=\'hidden\'" alt="ШУЭР Пр-1 (вода, тепло)" onFocus="this.blur()">'+
	'<area shape="rect" coords="531,461,551,486" href="shelf.php?=39" target="_top" Onmouseover="document.all[\'inf39\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf39\'].style.visibility=\'hidden\'" alt="ШУЭР 5-2 (вода, тепло, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="939,672,958,699" href="shelf.php?id=43" target="_top" Onmouseover="document.all[\'inf43\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf43\'].style.visibility=\'hidden\'" alt="ШУЭР 13-1 (2хвода, 2хтепло)" onFocus="this.blur()">'+
	'<area shape="rect" coords="189,434,208,460" href="shelf.php?id=48" target="_top" Onmouseover="document.all[\'inf48\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf48\'].style.visibility=\'hidden\'" alt="ШУЭР 21-1 (вода, тепло, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="402,498,421,533" href="shelf.php?id=50" target="_top" Onmouseover="document.all[\'inf50\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf50\'].style.visibility=\'hidden\'" alt="ШУЭР 6-1 (тепло, вода, воздух)" onFocus="this.blur()">'+
	'<area shape="rect" coords="707,695,726,721" href="shelf.php?id=53" target="_top" Onmouseover="document.all[\'inf53\'].style.visibility=\'visible\'" Onmouseout="document.all[\'inf53\'].style.visibility=\'hidden\'" alt="ШУЭР 2-1 (тепло, вода)" onFocus="this.blur()">'+
	'</map>');
</script>   

</head>
</table>
</td></tr>
</table>

<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'SELECT * FROM shelf';
$e = mysql_query ($query,$i);
for ($t=1;$t<50;$t++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
	{
	 print '<div id=inf'.$ui[0].' style="position:absolute;top:70;left:500;width:500;height:130;margin-left:10;padding-left:10;background-color:#eeeeee;visibility:hidden;"><font class=fin45>'; 
	 print '<b>'.$ui[1].'</b> ';
    		$query = 'SELECT * FROM shelf WHERE sid=\''.$ui[5].'\'';
	    	$r = mysql_query ($query,$i); 
    		$uo = mysql_fetch_row ($r);
		while ($uo)
			{
			 print $uo[2].'<br>';
			 $uo = mysql_fetch_row ($r);
			}
	 print '</font><br></div>';
	}

}
?>
</body>
</html>