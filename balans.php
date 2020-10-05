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
 echo "<title>Баланасные схемы '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
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

<table border=0 align=center bgcolor=#ffffff valign=top width=100%>
<?php
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $today = getdate ();
 $edit=0; $del=0;
 $date=getdate(); $mon=$date['mon']; $year=$date['year'];
 $today=getdate ();
 for ($h=0;$h<=10;$h++) $sum[$x][$h]=$vhod[$x][$h]=0;
 $maxx=$x;
 if ($today["mday"]>1) $today["mday"]--;
 if ($today["mday"]<10) $today["mday"]='0'.$today["mday"];
 if ($today["mon"]<10)  $today["mon"]='0'.$today["mon"];
 $query = 'SELECT * FROM data WHERE type=2 AND (date='.$today["year"].$today["mon"].$today["mday"].'000000 OR date='.$today["year"].$today["mon"].$today["mday"].'120000)';
//echo $query;
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=1000;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
	 {          
	  if ($ui[6]==0) 
	     {
	      if ($ui[4]<100 && $ui[4]!=34 && $ui[4]!=39 && $ui[4]!=8 && $ui[4]!=30 && $ui[4]!=41 && $ui[4]!=35)
		 {
	      	  if (strstr ($ui[1],'подающей') && strstr ($ui[1],'массы')) { $sum[9]=$sum[9]+$ui[7]; $zn[9][$ui[4]]=$ui[7];}
	      	  if (strstr ($ui[1],'обратной') && strstr ($ui[1],'массы')) { $sum[10]=$sum[10]+$ui[7]; $zn[10][$ui[4]]=$ui[7];}
		 }
	      else 	
	      if ($ui[4]==101)
		 {
	      	  if (strstr ($ui[1],'подающей') && strstr ($ui[1],'асс')) $vhod[9]=$vhod[9]+$ui[7];
	      	  if (strstr ($ui[1],'обратной') && strstr ($ui[1],'асс')) $vhod[10]=$vhod[10]+$ui[7];
		 }
	     }
	  if ($ui[6]==1) 
	      if ($ui[4]<100 && $ui[4]!=34 && $ui[4]!=39 && $ui[4]!=8 && $ui[4]!=30 && $ui[4]!=41 && $ui[4]!=35)
	      	  { if (strstr ($ui[1],'энергии')) { $sum[1]=$sum[1]+$ui[7]; $zn[1][$ui[4]]=$ui[7]; }}
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'магистрали')) $vhod[1]=$vhod[1]+$ui[7]; }
	  if ($ui[6]==2) 
	      if ($ui[4]<100 && $ui[4]!=61 && $ui[4]!=6 && $ui[4]!=39 && $ui[4]!=38 && $ui[4]!=2 && $ui[4]!=31 && $ui[4]!=35  && $ui[4]!=22)
	      	  { $sum[2]=$sum[2]+$ui[7];  $zn[2][$ui[4]]=$ui[7]; }
	      else 
	      if ($ui[4]==101)
	      	  if (strstr ($ui[1],'бъем')) $vhod[2]=$vhod[2]+$ui[7]; 
	  if ($ui[6]==4) 
	      if ($ui[4]<100)
	      	  { if (strstr ($ui[1],'бъем')) { $sum[4]=$sum[4]+$ui[7];  $zn[4][$ui[4]]=$ui[7]; }}
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'бъем')) $vhod[4]=$vhod[4]+$ui[7]; }
	  if ($ui[6]==5 && $ui[4]!=61 && $ui[4]!=6 && $ui[4]!=39 && $ui[4]!=1 && $ui[4]!=31) 
	      if ($ui[4]<100)
	      	  { if (strstr ($ui[1],'бъем')) { $sum[5]=$sum[5]+$ui[7]; $zn[5][$ui[4]]=$ui[7]; }}
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'бъем')) $vhod[5]=$vhod[5]+$ui[7]; }
	  if ($ui[6]==6) 
	      if ($ui[4]<100)
	      	  { if (strstr ($ui[1],'объема')) { $sum[6]=$sum[6]+$ui[7]; $zn[6][$ui[4]]=$ui[7]; }}
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'объема')) $vhod[6]=$vhod[6]+$ui[7]; }
	 }
     } 

 $sum[0]=$sum[9]-$sum[10];
 $vhod[0]=$vhod[9]-$vhod[10];

 $vhod0[$h]=$vhod[9];
 $vhod1[$h]=$vhod[10];

 if ($sum[$x][9]+$vhod[$x][9]>0) if ($vhod[$x][9]>0) $pr1=($sum[$x][9]-$vhod[$x][9])*100/($vhod[$x][9]); else $pr1=100;
	else $pr1=0;
 if ($sum[$x][10]+$vhod[$x][9]>0) if ($vhod[$x][10]>0) $pr0 = ($sum[$x][10]-$vhod[$x][10])*100/($vhod[$x][10]); else $pr1=100;
    	else $pr0=0;

print '<tr><td bgcolor=#e6e6e6 width=80% align=center><font class="menu">Баланс потребления за последние расчетные сутки</font></td></tr>';
print '<tr><td bgcolor=#e6e6e6 width=80% align=center><font class="menu">Тепловая энергия и теплофикационная вода</font></td></tr>';
print '<tr><td><table border=0 align=center valign=top width=1000 cellpadding="0" cellspacing="0"><tr><td height=620 width=100%>';
print '<div style="position:relative;"><img src="files/teplo.jpg">';
print '<div style="position:absolute; top:25;left:220;width:100;height:30;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$vhod[9],$vhod[10],$vhod[1]); print '</font></div>';
print '<div style="position:absolute; top:85;left:110;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$sum[9],$sum[10],$sum[1]); print '</font></div>';
print '<div style="position:absolute; top:265;left:70;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][0],$zn[10][0],$zn[1][0]); print '</font></div>';
print '<div style="position:absolute; top:160;left:230;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][10],$zn[10][10],$zn[1][10]); print '</font></div>';
print '<div style="position:absolute; top:112;left:480;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][14],$zn[10][14],$zn[1][14]); print '</font></div>';
print '<div style="position:absolute; top:112;left:620;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][41],$zn[10][41],$zn[1][41]); print '</font></div>';
print '<div style="position:absolute; top:142;left:680;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][42],$zn[10][42],$zn[1][42]); print '</font></div>';
print '<div style="position:absolute; top:208;left:938;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][3],$zn[10][3],$zn[1][3]); print '</font></div>';
print '<div style="position:absolute; top:320;left:938;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][35],$zn[10][35],$zn[1][35]); print '</font></div>';
print '<div style="position:absolute; top:320;left:175;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][9],$zn[10][9],$zn[1][9]); print '</font></div>';
print '<div style="position:absolute; top:360;left:155;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][21],$zn[10][21],$zn[1][21]); print '</font></div>';
print '<div style="position:absolute; top:480;left:105;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][39],$zn[10][39],$zn[1][39]); print '</font></div>';
print '<div style="position:absolute; top:480;left:235;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][8],$zn[10][8],$zn[1][8]); print '</font></div>';
print '<div style="position:absolute; top:500;left:315;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][7],$zn[10][7],$zn[1][7]); print '</font></div>';
print '<div style="position:absolute; top:410;left:245;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][40],$zn[10][40],$zn[1][40]); print '</font></div>';
print '<div style="position:absolute; top:200;left:425;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][12],$zn[10][12],$zn[1][12]); print '</font></div>';
print '<div style="position:absolute; top:410;left:425;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=188\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][61],$zn[10][61],$zn[1][61]); print '</font></div>';
print '<div style="position:absolute; top:445;left:455;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][6],$zn[10][6],$zn[1][6]); print '</font></div>';
print '<div style="position:absolute; top:485;left:485;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][1],$zn[10][1],$zn[1][1]); print '</font></div>';
print '<div style="position:absolute; top:565;left:465;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][30],$zn[10][30],$zn[1][30]); print '</font></div>';
print '<div style="position:absolute; top:545;left:605;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][38],$zn[10][38],$zn[1][38]); print '</font></div>';
print '<div style="position:absolute; top:295;left:575;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][5],$zn[10][5],$zn[1][5]); print '</font></div>';
print '<div style="position:absolute; top:420;left:595;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=152\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][4],$zn[10][4],$zn[1][4]); print '</font></div>';
print '<div style="position:absolute; top:420;left:715;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=442\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][2],$zn[10][2],$zn[1][2]); print '</font></div>';
print '<div style="position:absolute; top:550;left:875;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=168\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][22],$zn[10][22],$zn[1][22]); print '</font></div>';
print '<div style="position:absolute; top:390;left:875;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=218\'"><font class="kart">';
printf ("%.2f / %.2f<br>%.2f",$zn[9][3],$zn[10][3],$zn[1][3]); print '</font></div>';
print '</div></td></tr></table></td></tr>';




print '<tr><td bgcolor=#e6e6e6 width=100% align=center><font class="menu">Пожарно-питьевая вода</font></td></tr>';
print '<tr><td><table border=0 align=center valign=top width=1000 cellpadding="0" cellspacing="0"><tr><td height=590 width=100%>';
print '<div style="position:relative;"><img src="files/ppv.jpg">';
print '<div style="position:absolute; top:80;left:70;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=550\'"><font class="kart">';
printf ("%.2f / %.2f",$vhod[2],$sum[2]); print '</font></div>';
print '<div style="position:absolute; top:170;left:240;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=81\'"><font class="kart">';
printf ("%.2f",$zn[2][10]); print '</font></div>';
print '<div style="position:absolute; top:265;left:210;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=43\'"><font class="kart">';
printf ("%.2f",$zn[2][9]); print '</font></div>';
print '<div style="position:absolute; top:310;left:210;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=83\'"><font class="kart">';
printf ("%.2f",$zn[2][21]); print '</font></div>';
print '<div style="position:absolute; top:360;left:210;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=541\'"><font class="kart">';
printf ("%.2f",$zn[2][40]); print '</font></div>';
print '<div style="position:absolute; top:510;left:280;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=35\'"><font class="kart">';
printf ("%.2f",$zn[2][1]); print '</font></div>';
print '<div style="position:absolute; top:555;left:190;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=139\'"><font class="kart">';
printf ("%.2f",$zn[2][39]); print '</font></div>';
print '<div style="position:absolute; top:555;left:390;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=527\'"><font class="kart">';
printf ("%.2f",$zn[2][38]); print '</font></div>';
print '<div style="position:absolute; top:145;left:350;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=76\'"><font class="kart">';
printf ("%.2f",$zn[2][12]); print '</font></div>';
print '<div style="position:absolute; top:255;left:350;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=189\'"><font class="kart">';
printf ("%.2f",$zn[2][61]); print '</font></div>';
print '<div style="position:absolute; top:355;left:350;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=160\'"><font class="kart">';
printf ("%.2f",$zn[2][6]); print '</font></div>';
print '<div style="position:absolute; top:415;left:350;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=149\'"><font class="kart">';
printf ("%.2f",$zn[2][7]); print '</font></div>';
print '<div style="position:absolute; top:555;left:475;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=533\'"><font class="kart">';
printf ("%.2f",$zn[2][2]); print '</font></div>';
print '<div style="position:absolute; top:150;left:600;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=210\'"><font class="kart">';
printf ("%.2f",$zn[2][5]); print '</font></div>';
print '<div style="position:absolute; top:185;left:740;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=153\'"><font class="kart">';
printf ("%.2f",$zn[2][4]); print '</font></div>';
print '<div style="position:absolute; top:360;left:670;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=153\'"><font class="kart">';
printf ("%.2f",$zn[2][13]); print '</font></div>';
print '<div style="position:absolute; top:510;left:630;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=169\'"><font class="kart">';
printf ("%.2f",$zn[2][22]); print '</font></div>';
print '<div style="position:absolute; top:310;left:780;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=530\'"><font class="kart">';
printf ("%.2f",$zn[2][3]); print '</font></div>';
print '<div style="position:absolute; top:410;left:780;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=173\'"><font class="kart">';
printf ("%.2f",$zn[2][35]); print '</font></div>';
print '<div style="position:absolute; top:355;left:890;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=521\'"><font class="kart">';
printf ("%.2f",$zn[2][31]); print '</font></div>';
print '</div></td></tr></table></td></tr>';


print '<tr><td bgcolor=#e6e6e6 width=100% align=center><font class="menu">Сжатый воздух</font></td></tr>';
print '<tr><td><table border=0 align=center valign=top width=1000 cellpadding="0" cellspacing="0"><tr><td height=550 width=100%>';
print '<div style="position:relative;"><img src="files/cv.jpg">';
print '<div style="position:absolute; top:80;left:100;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=548\'"><font class="kart">';
printf ("%.2f / %.2f",$vhod[5],$sum[5]); print '</font></div>';
print '<div style="position:absolute; top:175;left:260;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=44\'"><font class="kart">';
printf ("%.2f",$zn[5][10]); print '</font></div>';
print '<div style="position:absolute; top:275;left:220;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=40\'"><font class="kart">';
printf ("%.2f",$zn[5][9]); print '</font></div>';
print '<div style="position:absolute; top:325;left:220;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=37\'"><font class="kart">';
printf ("%.2f",$zn[5][21]); print '</font></div>';
print '<div style="position:absolute; top:150;left:350;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=80\'"><font class="kart">';
printf ("%.2f",$zn[5][12]); print '</font></div>';
print '<div style="position:absolute; top:280;left:350;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=52\'"><font class="kart">';
printf ("%.2f",$zn[5][61]); print '</font></div>';
print '<div style="position:absolute; top:280;left:410;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=55\'"><font class="kart">';
printf ("%.2f",$zn[5][6]); print '</font></div>';
print '<div style="position:absolute; top:580;left:330;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=85\'"><font class="kart">';
printf ("%.2f",$zn[5][39]); print '</font></div>';
print '<div style="position:absolute; top:535;left:430;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=28\'"><font class="kart">';
printf ("%.2f",$zn[5][1]); print '</font></div>';
print '<div style="position:absolute; top:345;left:500;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=161\'"><font class="kart">';
printf ("%.2f",$zn[5][5]); print '</font></div>';
print '<div style="position:absolute; top:195;left:610;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=178\'"><font class="kart">';
printf ("%.2f",$zn[5][4]); print '</font></div>';
print '<div style="position:absolute; top:325;left:760;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=34\'"><font class="kart">';
printf ("%.2f",$zn[5][3]); print '</font></div>';
print '<div style="position:absolute; top:325;left:890;width:100;height:35;cursor:hand;text-align:center" OnClick="window.location.href=\'uzel.php?id=33\'"><font class="kart">';
printf ("%.2f",$zn[5][31]); print '</font></div>';
print '</div></td></tr></table></td></tr>';
print '<tr><td height=300><div style="position:relative;"><img src="files/comm.jpg"></div></td></tr>';
?>
</table><br>
</td><tr>
</table>
<? include ("inc/down.inc"); ?>
</td><tr>
</table>
</body>
</html>