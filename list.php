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

<table border=0 align=center bgcolor=#ffffff valign=top width=800>
<?php
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
$year=''.$arr["year"];
$month=''.$arr["month"];
$arr["month"]=$arr["month"]+0;
$month=$month+0;
if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
if ($month<10) $month='0'.$month;
$x=0;

$source=$arr["source"];
if ($source==2) 
   {
    $query = 'SELECT caption FROM buyers WHERE idx='.$arr["idbuy"];
    $a = mysql_query ($query,$i);
    $uy = mysql_fetch_row ($a);
    $query = 'SELECT * FROM people WHERE name=\''.$uy[0].'\'';
    $a = mysql_query ($query,$i);
    $uy = mysql_fetch_row ($a);
    $per=0;
    if ($uy == true) 
    for ($p=1;$p<=50;$p++) 
    if ($uy[$p]>0) $per=$per+$uy[$p];

    if ($uy == true)  $voda=$per * 0.012;
    $voda=$voda*30;
   }

$query = 'SELECT * FROM korp WHERE korp_id<99';
$t = mysql_query ($query,$i);
if ($source==1) print '<tr><td bgcolor=#e6e6e6 colspan=4><font class="menu">Тепловая энергия отопления</font></td></tr>';
if ($source==2) print '<tr><td bgcolor=#e6e6e6 colspan=4><font class="menu">Пожарно-питьевая вода</font></td></tr>';
if ($source==5) print '<tr><td bgcolor=#e6e6e6 colspan=4><font class="menu">Сжатый воздух</font></td></tr>';
if ($source==7) print '<tr><td bgcolor=#e6e6e6 colspan=4><font class="menu">Электрическая энергия</font></td></tr>';
$gsum=0;
for ($k=1;$k<=50;$k++)
    {
     $uu = mysql_fetch_row ($t);
     if ($source==7 && $uu == true) 
        {
	 $arr["otch"]=4; $sour=7;
         $ffile='tmp/pdr'.$arr["idbuy"].'.htm';
	 $fp=fopen($ffile,"w");
	     $source++;
         include ("inc/method_el1.inc");
 	 $source--;
         fclose($fp);
	 $fp=fopen($ffile,"r");
	 $contents = fread ($fp, filesize ($ffile));
         print '<tr><td bgcolor=#ffffff colspan=4><font class="or1">';
	 echo $contents;
	 print '</td></tr>';
	 fclose($fp);
	 $gsum=$data0[$x];
	}

     if ($source<7 && $uu == true)
        {
	 $data00[$x]=0;
         $sour=$source+1;
	 $query = 'SELECT SUM(K'.$sour.') FROM obj WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1];
      	 $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a); 
 	 if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	 
	 $arr["otch"]=4; $jpgg=88;
	 $source++; $sour--;
	 include ("inc/method_req.inc");
	 $source--;
         //$data00[$x]

	 $val=0;
         $today=getdate ();
   	 if ($today["year"]==$arr["year"] && $today["mon"]==$arr["month"]) 
	    {
	     $month=''.$arr["month"];
	     $query = 'SELECT * FROM data WHERE type=2 AND date>='.$arr["year"].$month.'01000000 AND korp='.$uu[1].' AND source='.$source;
	    }
	 else 
	    {
	     //if ($arr["month"]>1) $month=$arr["month"]-1;
	     //else { $month=12; $arr["year"]--; }
	     $month=''.$arr["month"];
	     $query = 'SELECT * FROM data WHERE type=4 AND (date='.$arr["year"].$month.'01000000 OR date='.$arr["year"].$month.'01120000) AND korp='.$uu[1].' AND source='.$source;
	    }		             
 //      	 $query = 'SELECT * FROM data WHERE type=4 AND (date='.$arr["year"].$month.'01000000 OR date='.$arr["year"].$month.'01120000) AND korp='.$uu[1].' AND source='.$source;
         $a = mysql_query ($query,$i);
	 for ($ff=0; $ff<300; $ff++)
	     {
		$uy = mysql_fetch_row ($a); 
	      if ($source==0)
             	 { 
                  if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) { $val=$uy[7]; $ed="тонн"; }
                  if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $val=$val-$uy[7]; $ed="тонн"; }
 	         }
         	if ($source==1)  if (strstr ($uy[1],'тепловой энергии')) { $val=$val+$uy[7]; $ed="ГКал"; }
    	 	if ($source==2)  { $val=$val+$uy[7]; $ed="м3"; }
	        if ($source==3)  { $val=$val+$uy[7]; $ed="м3"; }
        	if ($source==4)  if (strstr ($uy[1],'массы')) { $val=$val+$uy[7]; $ed="кг"; }
		if ($source==5)  if (strstr ($uy[1],'объема')) { $val=$val+$uy[7]; $ed="м3"; }
		if ($source==6)  if (strstr ($uy[1],'объема'))  { $val=$val+$uy[7]; $ed="м3"; }
	       	if ($source==7)  { $val=$val+$uy[7]; $ed="кВт"; }
	      }
	 if ($val>0 && $K>0)
	    {
	     //echo $uu[2].' '.$K.' '.$val.' - '.$data00[$x].'<br>';
	     $val=$val-$data00[$x];
  	     print '<tr><td bgcolor=#e6e6e6><font class="menu">'.$uu[2].'/ Название</font></td>';
	     print '<td bgcolor=#e6e6e6><font class="menu">Площадь</font></td>';
	     print '<td bgcolor=#e6e6e6><font class="menu">Номер БТИ</font></td>';
	     print '<td bgcolor=#e6e6e6 colspan=1><font class="menu">'.$val.'('.$ed.')['.$data00[$x].']</font></tr>';
             $sour=$source+1;
	     $query = 'SELECT K'.$sour.',name,square,BTI FROM obj WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1].' ORDER BY K'.$sour.' DESC';
	     $sum=0;
	     $a = mysql_query ($query,$i); 
	     for ($r=1;$r<=500;$r++)
	     	{
                 $uy = mysql_fetch_row ($a); 
	         if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;

	         if ($K>0)
     	            {
		     $vall=$val*$K;
		     $sum=$sum+$val*$K;
		     $gsum=$gsum+$val*$K;
		     print '<tr><td><font class="or1">'.$uy[1].'</font></td><td><font class="or1">'.$uy[2].'</font></td><td><font class="or1">'.$uy[3].'</font></td><td><font class="or1">'.$vall.'</font></td></tr>';
   	            }
 	        }
  	     print '<tr><td bgcolor=#e6e6e6 colspan=3><font class="menu">Итого по корпусу</font></td><td bgcolor=#e6e6e6><font class="menu">'.$sum.'</font></td></tr>';
  	     print '<tr><td colspan=4><br></td></tr>';
	   }
        }
    }
if ($source==2)
   { 
    $gsum=$gsum+$voda;
    print '<tr><td bgcolor=#e6e6e6 colspan=3><font class="menu">На хозяйственно-бытовые нужды</font></td><td bgcolor=#e6e6e6><font class="menu">'.$voda.'</font></td></tr>';
   }
 print '<tr><td bgcolor=#e6e6e6 colspan=3><font class="menu">Всего потреблено арендатором</font></td><td bgcolor=#e6e6e6><font class="menu">'.$gsum.'</font></td></tr>';
?>
</table><br>
</td><tr>
</table><br>
</td><tr>
</table>
</body>
</html>