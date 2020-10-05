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
 // include ("./top.php");
 echo "<title>Отчеты-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
?>
<title>(data) портал.</title>
</head>
<body align=left bgcolor=#ffffff leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=left border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#ffffff>
<tr><td>
<table border=0 cellspacing=0 cellpadding=1 align=center width=100%>
<tr><td align=left width=100%>
<table border=0 align=center bgcolor=#ffffff>
<tr><td>
<table border=0 align=center bgcolor=#ffffff align=center>
<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
//-------------------------------------------------------
{
print '<tr><td align=center><table border=0><tr><td colspan=3><font class="menu">Отчет по ';
if (($_POST["source"]==99 || $_POST["source"]=='') && $_POST["uzel"]=='') print 'потреблению всех энергоресурсов';
if ($_POST["source"]=='0') print 'потреблению теплофикационной воды';
if ($_POST["source"]==1) print 'потреблению тепловой энергии';
if ($_POST["source"]==2) print 'потреблению пожарно-питьевой воды';
if ($_POST["source"]==3) print 'потреблению водяного пара';
if ($_POST["source"]==4) print 'потреблению природного газа';
if ($_POST["source"]==5) print 'потреблению сжатого воздуха';
if ($_POST["source"]==6) print 'потреблению кислорода';
if ($_POST["source"]==7) print 'потреблению электрической энергии';
print '</font><font class="menu"> за период с </font><font class="down">';
print $_POST["day"].'/'.$_POST["month"].'/'.$_POST["year"]; 
print '</font><font class="menu"> по </font><font class="down">';
print $_POST["eday"].'/'.$_POST["emonth"].'/'.$_POST["eyear"]; 
print '</font></td></tr>';
print '<tr><td align=center><font class="menu">Тип отчета: </font><font class="down">';
if ($_POST["otch"]==1) print 'часовой';
if ($_POST["otch"]==2) print 'суточный';
if ($_POST["otch"]==3) print 'декадный';
if ($_POST["otch"]==4) print 'по месяцам';
if ($_POST["otch"]==5) print 'сменный';
print '</td>';
print '<td align=center><font class="menu">Арендатор: </font><font class="down">';
if ($_POST["idbuy"]==99 || $_POST["idbuy"]=='') print 'все арендаторы';
else
{
 $query = 'SELECT * FROM buyers WHERE idx='.$_POST["idbuy"];
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
 if ($ui == true) print $ui[1];
}
print '</td><td align=center><font class="menu">Корпус: </font><font class="down">';
if ($_POST["idkor"]==99 || $_POST["idkor"]=='') print 'все корпуса';
else
{
 $query = 'SELECT name FROM korp WHERE korp_id='.$_POST["idkor"];
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
 if ($ui == true) print $ui[0];
}
print '</td><td></td></tr></table></td></tr>';
print '<tr><td><table>';

$arr = get_defined_vars();
$today=getdate ();
$bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
if ($today["hours"]<10) $today["hours"]='0'.$today["hours"];
if ($today["day"]==$arr["day"])
    $edate=$arr["eyear"].$arr["emonth"].$arr["eday"].$today["hours"].'0000';
else
    $edate=$arr["eyear"].$arr["emonth"].$arr["eday"].'230000';

//if ($arr["otch"]==2 && $arr["source"]>99) 
if ($arr["otch"]==2) 
{
$arr["day"]=$arr["day"]+0;
$arr["eday"]=$arr["eday"]+0;
// if ($arr["day"]>1) $arr["day"]--;
// else { $arr["month"]--; $arr["day"]=31; }
// if ($arr["eday"]>1) $arr["eday"]--;
// else { $arr["emonth"]--; $arr["eday"]=31; }
}
if ($arr["otch"]==4) 
{
 if ($arr["month"]>1) $arr["month"]--;
 else { $arr["month"]=12; $arr["year"]--; }
}
$arr["day"]=$arr["day"]+0;
$arr["month"]=$arr["month"]+0;
if ($arr["day"]<10) $arr["day"]='0'.$arr["day"];
if ($arr["eday"]<10) $arr["eday"]='0'.$arr["eday"];
if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
//if ($arr["emonth"]<10) $arr["emonth"]='0'.$arr["emonth"]; //!!!
//echo $arr["emonth"];

if ($_POST["frm"]==1)
{
 $source=1+$arr["source"];
 $info1=''; $info2=''; $first=1;
 $kor=0; $max=0;
 if ($arr["source"]<99)
    {  
     $sour=$arr["source"];
     if ($_POST["idkor"]=='') $query = 'SELECT * FROM korp WHERE korp_id<100';
     else $query = 'SELECT * FROM korp WHERE korp_id='.$_POST["idkor"];
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)
         {
          $uu = mysql_fetch_row ($t);
          if ($uu == true)
              {
	       $K=0; 
               $query = 'SELECT SUM(K'.$source.') FROM obj WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1];
               $a = mysql_query ($query,$i);
               $uy = mysql_fetch_row ($a);
               if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	       $voda=0;
	       if ($source==3) 
			{
			 $query = 'SELECT caption FROM buyers WHERE idx='.$arr["idbuy"];
		         $a = mysql_query ($query,$i);
		         $uy = mysql_fetch_row ($a);			 
		         $query = 'SELECT id'.$uu[1].' FROM people WHERE name=\''.$uy[0].'\'';
	                 $a = mysql_query ($query,$i);
                         $uy = mysql_fetch_row ($a);
		         if ($uy == true)  $voda=$uy[0] * 0.012;
			 if ($arr["otch"]==1) $voda=$voda/24;
			 if ($arr["otch"]==4) $voda=$voda*30;
			 $info2=$info2.'<br><b>'.$uu[2].'</b>';
       			 if ($voda>0) 
				$info2=$info2.'<br>Количество работающих человек = '.$uy[0].'<br> Норма потребления = 0.012 <br> Итого потреблено по корпусу на бытовые нужды = '.$voda.'<br>';
			}
	       if ($K>0 || $arr["source"]==7) {
	       $info2=$info2.'<b>'.$uo[1].'</b> '.$uu[2].'  K='.$K;
               $x=1; 
               //$data0[0]=$data1[0]=$data2[0]=$data3[0]=0;
	       $beghour=0; $endhour=$hour=23;
  	       $begday=$arr["day"];  $endday=$day=$arr["eday"];
	       $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
	       $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
	       $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
	       $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
//	       if ($arr["otch"]==1 && $etime-$btime>200) $btime=$etime;
	       if ($etime==$btime)
		  {
		   if ($arr["day"]>1) { $arr["day"]--; $begday--;}
				   else { $arr["day"]=30; $arr["month"]--; $begmonth--;}
		   $btime=$begyear*100*100*100+$arr["month"]*100*100+$arr["day"]*100+$beghour;
		   if ($arr["day"]<10) $arr["day"]='0'.$arr["day"];
		   if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		   $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
		  }
	       //echo $btime.'-'.$etime;
	       $time=$etime;
               if ($arr["otch"]==1) { $mx=23; $mn=0; }
               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
               if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }
	       //$bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
	       //$edate=$arr["eyear"].$arr["emonth"].$arr["eday"].'000000';

  	       for ($tm=$mx; $tm>=0; $tm--)
	           {
                    include ("inc/rep_sub.inc");
		    $ffile="tmp/$dat[$x]";
		    $fp=fopen($ffile,"w");
		    fwrite ($fp,' ');
		    include ("inc/method_req.inc");
		    include ("inc/method_el1.inc");
		    fclose($fp);
		    //echo $date1[$x].' '.$dat[$x].'<br>';
		    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
		    if ($time<=$btime) break;                       
		    $x++;
		  }
	       $max=$x;
               $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uu[1].' AND source='.$arr["source"];
	       if ($source!=2 && $source!=7) for ($o=0;$o<=$x; $o++) $data[$o]=0;
	       else if ($source==2) for ($o=0;$o<=$x; $o++) $data[$o]=$voda;
	       //echo $query.'<br>';
               $a = mysql_query ($query,$i); 
               if ($a && $source<7)
               for ($l=1;$l<=300000;$l++)
                   {
                    $uy = mysql_fetch_row ($a);
                    if ($uy == true)
                       {
			//echo $uy[3].'='.$uy[7].'<br>';
		        if ($source==1)
                           {
			    if (strstr ($uy[1],'асс') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) { $data1[$o]=$data1[$o]+$uy[7]*$K; }
                            if (strstr ($uy[1],'асс') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) { $data2[$o]=$data2[$o]+$uy[7]*$K; }
                           }
			if ($source==2) if (strstr ($uy[1],'тепловой энергии')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
		        if ($source==3) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
			if ($source==4) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
			if ($source==5) if (strstr ($uy[1],'массы')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
			if ($source==6) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
			if ($source==7) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
 	 		//if ($source==8) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data[$o]=$data[$o]+$uy[7]*$K;
 		        //$info1[$x]=$info1[$x].'<br><b>'.$uu[2].'</b> Q='.$uy[7]*$K;
                       }                       
                  }}
  	      }
         }
     //for ($o=0;$o<=$max; $o++) echo $date1[$o].' > '.$data0[$o].'<br>';

     if ($arr["source"]==0) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Масса под. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса обр. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса утечек (т.)</td></tr>';
     if ($arr["source"]==1) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Тепловая мощность по магистрали (Гкал)</td></tr>';
     if ($arr["source"]==2) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход воды (м3)</td></tr>';
     if ($arr["source"]==3) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход пара (м3)</td></tr>';
     if ($arr["source"]==4) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Массовый расход газа (кг/ч)</td></tr>';
     if ($arr["source"]==5) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==6) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==7) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Мощность (кВт)</td></tr>';        
     $sxdata2=$sxdata1=$sxdata0=0;
     for ($tm=1; $tm<=$max; $tm++)
         {
          print '<tr align=center><td bgcolor=#eeeeee align=left><font class=dd style="cursor: hand" title="посмотреть как просчитано" ';
	  print 'OnClick="window.open(\'report4d.php?date='.$dat[$tm].'\',\'_blank\',\'width=790,height=520,toolbar=no,menubar=no,location=no,status=no,resizable=yes,scrollbars=no,top=0,left=0\')">'.$dat[$tm].'</font></td>';
	  $xdata1=$data1[$tm]-$data01[$tm]; $xdata2=$data2[$tm]-$data02[$tm]; $xdata0=$data0[$tm]-$data00[$tm];
	  $sxdata2=$sxdata2+$xdata2; $sxdata1=$sxdata1+$xdata1; $sxdata0=$sxdata0+$xdata0;
          if ($arr["source"]==0)
		{
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata1.'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata2.'</font></td>';
		 $xdata0=$xdata1-$xdata2;
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata0.'</font></td>';
		}
	  else {  print '<td bgcolor=#ffffff align=center><font class="dd">'; printf ("%5.2f",$xdata0); print '</font></td>'; }
	  print '</tr>';
         }
     if ($arr["source"]==0) 
	 {
	  $sxdata0=$sxdata1-$sxdata2;
	  print '<tr><td bgcolor=#e6e6e6><font class="menu">Итого: </font></td><td bgcolor=#e6e6e6><font class="man">'.$sxdata1.'</font></td><td bgcolor=#e6e6e6><font class="man">'.$sxdata2.'</font></td><td bgcolor=#e6e6e6><font class="man">'.$sxdata0.'</font></td></tr>';
	 }
     else 
	  print '<tr><td bgcolor=#e6e6e6><font class="menu">Итого: </font></td><td bgcolor=#e6e6e6><font class="man">'.$sxdata0.'</font></td></tr>';	 
    }
 else
    { 
     $query = 'SELECT * FROM energy_supply';
     $r = mysql_query ($query,$i);
     for ($n=1;$n<=50;$n++)
         {	
          $uo = mysql_fetch_row ($r);
          if ($uo == true)
      	      {
	       $sour=$uo[2];
	       $source=$uo[2]+1; $first=0;
	       if ($_POST["idkor"]=='') $query = 'SELECT * FROM korp WHERE korp_id<100';
	       else $query = 'SELECT * FROM korp WHERE korp_id='.$_POST["idkor"];
	       $t = mysql_query ($query,$i);
	       for ($k=1;$k<=50;$k++)
	          {
	           $uu = mysql_fetch_row ($t);
	           if ($uu == true)
         	      {
		       $K=0; $info2='';
        	       $query = 'SELECT SUM(K'.$source.') FROM obj WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1];
		       //echo $query;
	               $a = mysql_query ($query,$i);
        	       $uy = mysql_fetch_row ($a);
	               if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;		       
		       $voda=0;
		       $query = 'SELECT caption,type FROM buyers WHERE idx='.$arr["idbuy"];
		       $a = mysql_query ($query,$i);
		       $uy = mysql_fetch_row ($a); 
		       if ($uy[1]==2) if (($uu[1]==22 && $arr["idbuy"]==34) || ($uu[1]==31 && $arr["idbuy"]==28) || ($uu[1]==28 && $arr["idbuy"]==29)) $K=1;
		       if ($source==3) 
				{
			         $query = 'SELECT id'.$uu[1].' FROM people WHERE name=\''.$uy[0].'\'';
	                	 $a = mysql_query ($query,$i);
	                         $uy = mysql_fetch_row ($a);
			         if ($uy == true)  $voda=$uy[0] * 0.012;
				 if ($arr["otch"]==1) $voda=$voda/24;
				 if ($arr["otch"]==4) $voda=$voda*30;
        			 if ($voda>0) 
					$info2=$info2.'<br>Количество работающих человек = '.$uy[0].'<br> Норма потребления = 0.012 <br> Итого потреблено по корпусу на бытовые нужды = '.$voda.'<br>';
				}
	//	    echo $uu[1].'='.$arr["idbuy"].'<br>';
		       if ($K>0 || $source==8) {
		       $info2=$info2.'<b>'.$uo[1].'</b> '.$uu[2].'  K='.$K.'<br>';
	               $x=0;
		       $beghour=0; $endhour=$hour=23;
		       $begday=$arr["day"];  $endday=$day=$arr["eday"];
		       $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
		       $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
		       $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
		       $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
		       if ($arr["otch"]==1 && $etime-$btime>200) 
			  {
			   $begday=$arr["day"];  $endday=$day=$arr["day"]+1;
			   $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
			   $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
			   $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
			   $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour; 
			  }
		       if ($etime==$btime)
			  {
			   if ($arr["day"]>1) { $arr["day"]--; $begday--; }
				   else { $arr["day"]=30; $begday=30; $arr["month"]--; $begmonth--; }
			   $btime=$begyear*100*100*100+$arr["month"]*100*100+$arr["day"]*100+$beghour;
			  }
		       $time=$etime;
	               if ($arr["otch"]==1) { $mx=23; $mn=0; }
	               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
         	       if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }		       
		
		       $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
		       $edate=$arr["eyear"].$arr["emonth"].$arr["eday"].'230000';

		       for ($tm=$mx; $tm>=0; $tm--) $create[$tm]=0;
	  	       for ($tm=$mx; $tm>=0; $tm--)
		           {
                            include ("inc/rep_sub.inc");
  			    $ffile="tmp/$dat[$x]";
			    if ($first==0 && $create[$tm]!=11) { $fp=fopen($ffile,"w"); $create[$tm]=11; }
			    else $fp=fopen($ffile,"a");
			    if ($tm==0) $first=1;			    
			    fwrite ($fp,$info2);
			    include ("inc/method_req2.inc");
                            include ("inc/method_el2.inc");
		            fclose($fp);
		            //echo $date1[$x].' 00='.$data00[$x][$source-1].' 02='.$data02[$x][$source-1].' 01='.$data01[$x][$source-1].' 0='.$data0[$x][$source-1].'<br>';
			    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
			    if ($time<$btime) break;                       
			    $x++;
			   }
			$max=$x;
	       		if ($uy[6]!=2 && $uy[6]!=7) for ($o=0;$o<=$x; $o++) $data[$o][$uy[6]]=0;
	       	   	else if ($uy[6]==2) for ($o=0;$o<=$x; $o++) $data[$o][$uy[6]]=$voda;
 		       $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uu[1].' AND source='.$uo[2];
			//echo $query.'<br>';
                       $a = mysql_query ($query,$i); 
	               if ($a)
        	       for ($l=1;$l<=50000;$l++)
                	   {
	                    $uy = mysql_fetch_row ($a);
        	            if ($uy == true)
                	       {
			        if ($uy[6]==0)
	                           {
			            if (strstr ($uy[1],'асс') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][0]=$data0[$o][0]+$uy[7]*$K;
        	                    if (strstr ($uy[1],'асс') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data1[$o][0]=$data1[$o][0]+$uy[7]*$K;
	                           }
				 if ($uy[6]==1) if (strstr ($uy[1],'тепловой энергии')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][1]=$data0[$o][1]+$uy[7]*$K;
			       	 if ($uy[6]==2) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][2]=$data0[$o][2]+$uy[7]*$K;
				 if ($uy[6]==3) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][3]=$data0[$o][3]+$uy[7]*$K;
				 if ($uy[6]==4) if (strstr ($uy[1],'массы'))  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][4]=$data0[$o][4]+$uy[7]*$K;
				 if ($uy[6]==5) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][5]=$data0[$o][5]+$uy[7]*$K;
				 if ($uy[6]==6) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][6]=$data0[$o][6]+$uy[7]*$K;
	 	 		 if ($uy[6]==7) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][7]=$data0[$o][7]+$uy[7]*$K;
	                       }                       
        	           }
		       }}
		  }
  	      }
         }
     print '<tr><td bgcolor=#e6e6e6 width=110 align=center><font class="main">Время</td><td bgcolor=#e6e6e6 colspan=2 align=center><font class="main">Теплофикационная вода</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Тепловая энергия</td><td bgcolor=#e6e6e6 colspan=1><font class="main">Пожарно-питьевая вода</td><td bgcolor=#e6e6e6 align=center><font class="main">Водяной пар</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Природный газ</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Сжатый воздух</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Кислород</td><td bgcolor=#e6e6e6 colspan=1><font class="main">Электр. энергия</td></tr>';
     print '<td bgcolor=#e6e6e6></td><td bgcolor=#e6e6e6><font class="main">Масса обр. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса под.трубе (т.)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Тепловая энергия (ГКал)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Расход воды (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Расход пара (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Массовый расход (кг/ч)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Мощность (кВт)</td></tr>';
     for ($cl=0; $cl<8; $cl++) { $sdata0[$cl]=0; $sdata1[$cl]=0; }
     for ($tm=0; $tm<=$max; $tm++)
         {
          print '<tr align=center><td bgcolor=#eeeeee align=left><font class=dd style="cursor: hand" title="посмотреть как просчитано" ';
	  print 'OnClick="window.open(\'report4d.php?date='.$dat[$tm].'\',\'_blank\',\'width=790,height=520,toolbar=no,menubar=no,location=no,status=no,resizable=yes,scrollbars=yes,top=0,left=0\')">'.$dat[$tm].'</font></td>';
	  for ($cl=0; $cl<8; $cl++)
	      {
	       $xdata0=$data0[$tm][$cl]-$data00[$tm][$cl]; $xdata1=$data1[$tm][$cl]-$data01[$tm][$cl]; 
	       $sdata0[$cl]=$sdata0[$cl]+$xdata0; $sdata1[$cl]=$sdata1[$cl]+$xdata1;
	       if ($cl==0) print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata0.'</font></td><td bgcolor=#ffffff align=center><font class="dd">'.$xdata1.'</font></td>';
	       else { print '<td bgcolor=#ffffff align=center><font class="dd">'; printf ("%5.2f",$xdata0); print '</font></td>'; }
	      }
	  print '</tr>';
         }
// $sdata0[$cl]=$xdata0; $sdata1[$cl]=$xdata1;
     print '<tr align=center><td bgcolor=#e6e6e6><font class="menu">Итого: </font></td>';
     for ($cl=0; $cl<8; $cl++)
     if ($cl==0) print '<td bgcolor=#e6e6e6><font class="man">'.$sdata0[$cl].'</font></td><td bgcolor=#e6e6e6><font class="man">'.$sdata1[$cl].'</font></td>';
     else        print '<td bgcolor=#e6e6e6><font class="man">'.$sdata0[$cl].'</font></td>';	 
     print '</tr>';
    }
}

if ($_POST["frm"]==2)
{
 $arr = get_defined_vars();
 $source=1+$arr["source"];
 $kor=0; $max=0; $K=1;
 if ($arr["source"]<99)
    {  
     $sour=$arr["source"];
     if ($_POST["idkor"]=='' || $_POST["idkor"]=='99') $query = 'SELECT * FROM korp WHERE korp_id<100';
     else $query = 'SELECT * FROM korp WHERE korp_id='.$_POST["idkor"];
//     echo $query;
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)
         {
          $uu = mysql_fetch_row ($t);
          if ($uu == true)
              {
               $x=1;
	       $voda=0;
	       if ($source==3) 
		  {
	           $query = 'SELECT SUM(id'.$uu[1].') FROM people';
 	           $a = mysql_query ($query,$i);
                   $uy = mysql_fetch_row ($a);
	           if ($uy == true)  $voda=$uy[0] * 0.012;
		   if ($arr["otch"]==1) $voda=$voda/24;
		   if ($arr["otch"]==4) $voda=$voda*30;
		  }
               //$data0[0]=$data1[0]=$data2[0]=$data3[0]=0;
	       $beghour=0; $endhour=$hour=23;
  	       $begday=$arr["day"];  $endday=$day=$arr["eday"];
	       $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
	       $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
	       $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
	       $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
		//echo $btime.'--'.$etime;

	       //if ($arr["otch"]==1 && $etime-$btime>400) $btime=$etime;
	       if ($etime==$btime) 
		  {
	  	   //echo $btime.'='.$etime;
		   if ($arr["day"]>1) { $arr["day"]--; $begday--;}
				   else { $arr["day"]=30; $arr["month"]--; $begmonth--;}
		   $btime=$begyear*100*100*100+$arr["month"]*100*100+$arr["day"]*100+$beghour;
		   if ($arr["day"]<10) $arr["day"]='0'.$arr["day"];
		   if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		   $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
		  }

	       $time=$etime;
               if ($arr["otch"]==1) { $mx=23; $mn=0; }
               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
               if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }

  	       for ($tm=$mx; $tm>=0; $tm--)
	           {
		    include ("inc/method_req.inc");
                    include ("inc/rep_sub.inc");
		    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
 	  	   //echo $time.'<br>';
		    if ($time<$btime) break;
		    $x++;
		   }
	       $max=$x;
	       if ($arr["source"]==2) for ($o=0;$o<=$x; $o++) $data[$o]=0;
	       else for ($o=0;$o<=$x; $o++) $data[$o]=$voda;
 	       $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uu[1].' AND source='.$arr["source"];
		if ($source==8 && $_POST["idkor"]==101)
		 {
		 $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uu[1].' AND source='.$arr["source"].' AND name LIKE \'%акт%\' AND name LIKE \'%Ввод%\'';
		 //echo $query;
		 }
               $a = mysql_query ($query,$i); 
	       if ($a)
               for ($l=1;$l<=50000;$l++)
                   {
                    $uy = mysql_fetch_row ($a);
                    if ($uy == true)
                       {
 	                if ($source==1)
                           {
			    if (strstr ($uy[1],'асс') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data1[$o]=$data1[$o]+$uy[7];
                            if (strstr ($uy[1],'асс') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data2[$o]=$data2[$o]+$uy[7];
			    if (strstr ($uy[1],'емп') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data3[$o]=$data3[$o]+$uy[7];
                            if (strstr ($uy[1],'емп') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data4[$o]=$data4[$o]+$uy[7];
			   }
			 if ($source==2) if (strstr ($uy[1],'тепловой энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==3) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==4) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==5) if (strstr ($uy[1],'массы')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==6) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==7) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
 	 		 if ($source==8) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) 
				{
				 $data0[$o]=$data0[$o]+$uy[7]; 
				 //echo $uy[7].'<br>';
				}
                        }
                   }
  	      }
         }
     if ($arr["source"]==0) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Температура подающей (С)</td><td bgcolor=#e6e6e6><font class="main">Температура обратной (С)</td><td bgcolor=#e6e6e6><font class="main">Масса под. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса обр. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса утечек (т.)</td></tr>';
     if ($arr["source"]==1) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Тепловая мощность по магистрали (Гкал)</td></tr>';
     if ($arr["source"]==2) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход воды (м3)</td></tr>';
     if ($arr["source"]==3) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход пара (м3)</td></tr>';
     if ($arr["source"]==4) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Массовый расход газа (кг/ч)</td></tr>';
     if ($arr["source"]==5) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==6) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==7) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Мощность (кВт)</td></tr>';        
     for ($tm=1; $tm<=$x; $tm++)
         {
          print '<tr align=center><td bgcolor=#eeeeee align=left><font class="dd">'.$dat[$tm].'</font></td>';
	  $xdata1=$data1[$tm]-$data01[$tm]; $xdata2=$data2[$tm]-$data02[$tm]; $xdata0=$data0[$tm]-$data00[$tm];
	  $sdata0=$sdata0+$xdata0;
	  $sdata2=$sdata2+$xdata2;
	  $sdata1=$sdata1+$xdata1;
          if ($arr["source"]==0) 
		{
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$data3[$tm].'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$data4[$tm].'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata1.'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata2.'</font></td>';
		 if ($data1[$tm] && $data2[$tm]) $xdata0=$xdata1-$xdata2;
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata0.'</font></td>';
		}
	  else { print '<td bgcolor=#ffffff align=center><font class="dd">'; printf ("%5.2f",$xdata0); print '</font></td>'; }
	  print '</tr>';
         }
    if ($arr["source"]>0)     
	{
	      print '<tr align=center><td bgcolor=#e6e6e6><font class="menu">Итого: </font></td>';
	     print '<td bgcolor=#e6e6e6><font class="man">'.$sdata0.'</font></td>';	 
	     print '</tr>';
	}
    }
 else
    { 
     $query = 'SELECT * FROM energy_supply';
     $r = mysql_query ($query,$i);
     for ($n=1;$n<=10;$n++)
         {	
          $uo = mysql_fetch_row ($r);
          if ($uo == true)
      	      {
	       $sour=$uo[2];
	       $source=$uo[2]+1;
	       if ($_POST["idkor"]=='' || $_POST["idkor"]=='99') $query = 'SELECT * FROM korp WHERE korp_id<99';
	       else $query = 'SELECT * FROM korp WHERE korp_id='.$_POST["idkor"];

	       $t = mysql_query ($query,$i);
	       for ($k=1;$k<=50;$k++)
	          {
	           $uu = mysql_fetch_row ($t);
	           if ($uu == true)
         	      {
	               $x=0; $voda=0;
		       if ($source==3) 
			  {
		           $query = 'SELECT SUM(id'.$uu[1].') FROM people';
 		           $a = mysql_query ($query,$i);
                	   $uy = mysql_fetch_row ($a);
		           if ($uy == true)  $voda=$uy[0] * 0.012;
			   if ($arr["otch"]==1) $voda=$voda/24;
			   if ($arr["otch"]==4) $voda=$voda*30;
			  }
		       $beghour=0; $endhour=$hour=23;
		       $begday=$arr["day"];  $endday=$day=$arr["eday"];
		       $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
		       $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
		       $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
		       $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
	  	       //if ($arr["otch"]==1 && $etime-$btime>200) $btime=$etime;
		       if ($etime==$btime) 
			  {
			   if ($arr["day"]>1) { $arr["day"]--; $begday--;}
				   else { $arr["day"]=30; $arr["month"]--; $begmonth--;}
			   $btime=$begyear*100*100*100+$arr["month"]*100*100+$arr["day"]*100+$beghour;
			  }
		       $time=$etime;
	               if ($arr["otch"]==1) { $mx=23; $mn=0; }
	               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
        	       if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }
	  	       for ($tm=$mx; $tm>=0; $tm--)
		           {
			    include ("inc/method_req4.inc");
                            include ("inc/rep_sub.inc");
			    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
			    if ($time<$btime) break;
			    $x++;
			   }
		        $max=$x;
	       		if ($uy[6]!=2) for ($o=0;$o<=$x; $o++) $data[$o][$uy[6]]=0;
	       		else for ($o=0;$o<=$x; $o++) $data[$o][$uy[6]]=$voda;
 		        $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uu[1].' AND source='.$uo[2];
                        $a = mysql_query ($query,$i); 
	                if ($a)
        	        for ($l=1;$l<=500;$l++)
                	   {
	                    $uy = mysql_fetch_row ($a);
        	            if ($uy == true)
                	       {
			        if ($uy[6]==0)
	                           {
			            if (strstr ($uy[1],'асс') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][0]=$data0[$o][0]+$uy[7];
        	                    if (strstr ($uy[1],'асс') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data1[$o][0]=$data1[$o][0]+$uy[7];
	                           }
				 if ($uy[6]==1) if (strstr ($uy[1],'тепловой энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][1]=$data0[$o][1]+$uy[7];
			       	 if ($uy[6]==2) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][2]=$data0[$o][2]+$uy[7];
				 if ($uy[6]==3) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][3]=$data0[$o][3]+$uy[7];
				 if ($uy[6]==4) if (strstr ($uy[1],'массы'))  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][4]=$data0[$o][4]+$uy[7];
				 if ($uy[6]==5) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][5]=$data0[$o][5]+$uy[7];
				 if ($uy[6]==6) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][6]=$data0[$o][6]+$uy[7];
	 	 		 if ($uy[6]==7) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o][7]=$data0[$o][7]+$uy[7];	
        	                }
                	    }			 
			 //if ($uy[6]==0) for ($o=0;$o<=$max; $o++)  { $data0[$o][0]=$data0[$o][0]-$data00[$o][0]; $data1[$o][0]=$data1[$o][0]-$data01[$o][0]; }
			 //else for ($o=0;$o<=$max; $o++)  $data0[$o][0]=$data0[$o][0]-$data00[$o][0];
			}
		  }
  	      }
         }
     print '<tr><td bgcolor=#e6e6e6 width=110 align=center><font class="main">Время</td><td bgcolor=#e6e6e6 colspan=2 align=center><font class="main">Теплофикационная вода</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Тепловая энергия</td><td bgcolor=#e6e6e6 colspan=1><font class="main">Пожарно-питьевая вода</td><td bgcolor=#e6e6e6 align=center><font class="main">Водяной пар</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Природный газ</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Сжатый воздух</td><td bgcolor=#e6e6e6 colspan=1 align=center><font class="main">Кислород</td><td bgcolor=#e6e6e6 colspan=1><font class="main">Электр. энергия</td></tr>';
     print '<td bgcolor=#e6e6e6></td><td bgcolor=#e6e6e6><font class="main">Масса обр. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса под.трубе (т.)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Тепловая энергия (ГКал)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Расход воды (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Расход пара (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Массовый расход (кг/ч)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
     print '<td bgcolor=#e6e6e6 align=center><font class="main">Мощность (кВт)</td></tr>';
     for ($tm=1; $tm<=$max; $tm++)
         {
          print '<tr align=center><td bgcolor=#eeeeee align=left><font class="dd">'.$dat[$tm].'</font></td>';
	  for ($cl=0; $cl<8; $cl++)
	      {		
	       $xdata1=$data1[$tm][$cl]-$data01[$tm][$cl]; $xdata0=$data0[$tm][$cl]-$data00[$tm][$cl];
	       $sdata0[$cl]=$sdata0[$cl]+$xdata0; $sdata1[$cl]=$sdata1[$cl]+$xdata1;
	       if ($cl==0) print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata0.'</font></td><td bgcolor=#ffffff align=center><font class="dd">'.$xdata1.'</font></td>';
	       else { print '<td bgcolor=#ffffff align=center><font class="dd">'; printf ("%5.2f",$xdata0); print '</font></td>'; }
	      }
	  print '</tr>';
         }
     print '<tr align=center><td bgcolor=#e6e6e6><font class="menu">Итого: </font></td>';
     for ($cl=0; $cl<8; $cl++)
     if ($cl==0) print '<td bgcolor=#e6e6e6><font class="man">'.$sdata0[$cl].'</font></td><td bgcolor=#e6e6e6><font class="man">'.$sdata1[$cl].'</font></td>';
     else        print '<td bgcolor=#e6e6e6><font class="man">'.$sdata0[$cl].'</font></td>';	 
     print '</tr>';
    }
}

if ($_POST["frm"]==3)
{
 $arr = get_defined_vars();
 $today=getdate();
 $source=1+$arr["source"];
 $kor=0; $max=0; $K=1;
 $beghour=0; $endhour=$hour=$today["hour"];
 $begday=$arr["day"];  $endday=$day=$arr["eday"];
 $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
 $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
 $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
 $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
// echo $btime.'--'.$etime;

 if ($etime==$btime) 
	  {
	  //echo $btime.'='.$etime;
	   if ($arr["day"]>1) { $arr["day"]--; $begday--;}
			   else { $arr["day"]=30; $arr["month"]--; $begmonth--;}
	   $btime=$begyear*100*100*100+$arr["month"]*100*100+$arr["day"]*100+$beghour;
	   if ($arr["day"]<10) $arr["day"]='0'.$arr["day"];
	   if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
	   $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
	  }

 $time=$etime;
 if ($arr["otch"]==1) { $mx=23; $mn=0; }
 if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
 if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }

 for ($tm=$mx; $tm>=0; $tm--)
   {
    //include ("inc/method_req.inc");
    include ("inc/rep_sub.inc");
    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
//  	   echo $date1[$tm].'<br>';
    if ($time<$btime) break;
    $x++;
   }

 $max=$x;
 $query = 'SELECT * FROM uzel WHERE id='.$_POST["uzel"];
// echo $query;
 $a = mysql_query ($query,$i); 
 if ($a) $uy = mysql_fetch_row ($a);
 if ($uy)
	{
 	 $source=$uy[2]+1;
	 $arr["source"]=$uy[2];
 	 $arr["idkorp"]=$uy[3];
 	 $arr["idkon"]=$uy[4];
	}

 for ($o=0;$o<=$x; $o++) $data[$o]=0;
 if ($arr["source"]>6) $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"].' AND device='.$arr["idkon"][3].$arr["idkon"][4].$arr["idkon"][0].$arr["idkon"][1];
 else  $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"].' AND device='.$arr["idkon"][3].$arr["idkon"][4];
// echo $query;
 $a = mysql_query ($query,$i); 
 if ($a)
 for ($l=1;$l<=50000;$l++)
      {
       $uy = mysql_fetch_row ($a);
       if ($uy == true)
          {
           if ($source==1)
              {
	       if (strstr ($uy[1],'асс') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data1[$o]=$data1[$o]+$uy[7];
               if (strstr ($uy[1],'асс') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data2[$o]=$data2[$o]+$uy[7];
	       if (strstr ($uy[1],'емп') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data3[$o]=$data3[$o]+$uy[7];
               if (strstr ($uy[1],'емп') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data4[$o]=$data4[$o]+$uy[7];
	      }
    	   if ($source==2) if (strstr ($uy[1],'тепловой энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==3) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==4) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==5) if (strstr ($uy[1],'массы')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==6) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==7) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
 	   if ($source==8) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) 
		{
		 $data0[$o]=$data0[$o]+$uy[7]; 
		 //echo $uy[7].'<br>';
		}
          }
      }
     if ($arr["source"]==0) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Температура подающей (С)</td><td bgcolor=#e6e6e6><font class="main">Температура обратной (С)</td><td bgcolor=#e6e6e6><font class="main">Масса под. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса обр. трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса утечек (т.)</td></tr>';
     if ($arr["source"]==1) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Тепловая мощность по магистрали (Гкал)</td></tr>';
     if ($arr["source"]==2) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход воды (м3)</td></tr>';
     if ($arr["source"]==3) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход пара (м3)</td></tr>';
     if ($arr["source"]==4) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Массовый расход газа (кг/ч)</td></tr>';
     if ($arr["source"]==5) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==6) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==7) print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Мощность (кВт)</td></tr>';        
     for ($tm=1; $tm<=$x; $tm++)
         {
          print '<tr align=center><td bgcolor=#eeeeee align=left><font class="dd">'.$dat[$tm].'</font></td>';
	  $xdata1=$data1[$tm]-$data01[$tm]; $xdata2=$data2[$tm]-$data02[$tm]; $xdata0=$data0[$tm]-$data00[$tm];
	  $sdata0=$sdata0+$xdata0;
	  $sdata2=$sdata2+$xdata2;
	  $sdata1=$sdata1+$xdata1;
          if ($arr["source"]==0) 
		{
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$data3[$tm].'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$data4[$tm].'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata1.'</font></td>';
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata2.'</font></td>';
		 if ($data1[$tm] && $data2[$tm]) $xdata0=$xdata1-$xdata2;
		 print '<td bgcolor=#ffffff align=center><font class="dd">'.$xdata0.'</font></td>';
		}
	  else { print '<td bgcolor=#ffffff align=center><font class="dd">'; printf ("%5.2f",$xdata0); print '</font></td>'; }
	  print '</tr>';
         }
    if ($arr["source"]>0)     
	{
	      print '<tr align=center><td bgcolor=#e6e6e6><font class="menu">Итого: </font></td>';
	     print '<td bgcolor=#e6e6e6><font class="man">'.$sdata0.'</font></td>';	 
	     print '</tr>';
	}
    }
}
?>
</table></td></tr>
</table><br>
</td><tr>
<tr><td>
<table border=0 align=center bgcolor=#ffffff align=center>
<?php
if ($_POST["frm"]==1 && $arr["source"]<99) print '<tr><td><img border=0 src="charts/xyplots3.php?source='.$_POST["source"].'&idkor='.$_POST["idkor"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'&eyear='.$_POST["eyear"].'&emonth='.$_POST["emonth"].'&eday='.$_POST["eday"].'"></td></tr>';
if ($_POST["frm"]==2 && $arr["source"]<99) print '<tr><td><img border=0 src="charts/xyplots4.php?source='.$_POST["source"].'&idkor='.$_POST["idkor"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'&eyear='.$_POST["eyear"].'&emonth='.$_POST["emonth"].'&eday='.$_POST["eday"].'"></td></tr>';
if ($_POST["frm"]==3 && $arr["source"]<99) print '<tr><td><img border=0 src="charts/xyplots6.php?source='.$_POST["source"].'&idkor='.$_POST["idkor"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'&eyear='.$_POST["eyear"].'&emonth='.$_POST["emonth"].'&eday='.$_POST["eday"].'&uzel='.$_POST["uzel"].'"></td></tr>';
//if ($_POST["frm"]==2 && $arr["source"]<99 && ($arr["idkor"]==99 || $_POST["idkor"]=='')) print '<tr><td><img border=0 src="charts/pieplots4.php?source='.$_POST["source"].'&idkor='.$_POST["idkor"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'&eyear='.$_POST["eyear"].'&emonth='.$_POST["emonth"].'&eday='.$_POST["eday"].'"></td></tr>';
?>
</table><br>
</td><tr>
</table>
</body>
</html>