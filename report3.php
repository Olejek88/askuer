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
<body align=left bgcolor=black leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=left border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#000000>
<tr><td>
<table border=0 cellspacing=0 cellpadding=1 align=center width=100%>
<tr><td align=left width=100%>
<table border=0 align=center bgcolor=#000000>
<tr><td>
<table border=0 align=center bgcolor=#000000 align=center>
<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
//-------------------------------------------------------
{
print '<tr><td align=center><table border=0><tr><td colspan=3><font class="menu">Отчет по ';
if ($_POST["source"]==99 || $_POST["source"]=='') print 'потреблению всех энергоресурсов';
if ($_POST["source"]=='0') print 'потреблению теплофикационной воды';
if ($_POST["source"]==1) print 'потреблению тепловой энергии';
if ($_POST["source"]==2) print 'потреблению пожарно-питьевой воды';
if ($_POST["source"]==3) print 'потреблению водяного пара';
if ($_POST["source"]==4) print 'потреблению природного газа';
if ($_POST["source"]==5) print 'потреблению сжатого воздуха';
if ($_POST["source"]==6) print 'потреблению кислорода';
if ($_POST["source"]==7) print 'потреблению электрической энергии';
print '</font><font class="menu"> на расчетное время </font><font class="down">';
print $_POST["day"].'/'.$_POST["month"].'/'.$_POST["year"];
print '</td></tr>';
print '<tr><td align=center><font class="menu">Тип отчета: </font><font class="down">';
if ($_POST["otch"]==1) print 'часовой';
if ($_POST["otch"]==2) print 'суточный';
if ($_POST["otch"]==3) print 'декадный';
if ($_POST["otch"]==4) print 'по месяцам';
if ($_POST["otch"]==5) print 'сменный';
print '</td><td align=center><font class="menu">Арендатор: </font><font class="down">';
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
$dataye=0;

if ($_POST["frm"]==1)
{
 $x=0; $y=0;
 $source=1+$_POST["source"]; 
 $query = 'SELECT * FROM buyers'; $r = mysql_query ($query,$i);
 for ($j=1;$j<=30;$j++)
     {
      $uo = mysql_fetch_row ($r);
      if ($uo == true)
         {
          $name_b[$y]=$uo[1]; $x=0;
	  $query = 'SELECT * FROM korp';
          $t = mysql_query ($query,$i);
          for ($k=1;$k<=50;$k++)
              {
               $uu = mysql_fetch_row ($t);
               if ($uu == true)
                  {
                   $name_k[$x]=$uu[2];
		   $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
		   $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a);
		   if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	           $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date<'.$_POST["year"].$_POST["month"].$_POST["day"].'000000 AND korp='.$uu[1].' AND source='.$_POST["source"].' ORDER BY date DESC';
		   $a = mysql_query ($query,$i);
                   if ($a)
                   for ($l=1;$l<=200;$l++)		   
		      {
		       $uy = mysql_fetch_row ($a);
		       if ($uy == true)
		          {
		           if ($l==1) $tim=$uy[3];
		           if ($tim!=$uy[3]) break;
		           if ($uy[6]==0)
                 	      {
		               if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$y][$x]=$uy[7]*$K;
                	       if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$y][$x]=$data[$y][$x]-$uy[7]*$K; $l=100;}
                	      }
		      	   if ($uy[6]==1)
		   	      {
		               if (strstr ($uy[1],'тепловой энергии')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
      	        	      }
		           if ($uy[6]==2)
		              {
		               $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		              }
	 	           if ($uy[6]==3)
                	      {
		               $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		              }
		           if ($uy[6]==4)
		              {
	           	       if (strstr ($uy[1],'массы')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		              }
		           if ($uy[6]==5)
                	      {
			       if (strstr ($uy[1],'объема')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		              }
		           if ($uy[6]==6)
                	      {
		               if (strstr ($uy[1],'объема'))  $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		              }
		           if ($uy[6]==7)
              		      {
		               $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
			      }
	                 }
        	      }
                   else $data[$y][$x]=0;
                   $x++;
                  }
    	      }
          $y++;
 	 }
     }
 print '<tr><td colspan=7><table bgcolor=#111111>';
 for ($i=-1; $i<$x; $i++)
     {
      if ($i>=0) print '<tr><td bgcolor=#880000 align=center><a href="rep_det.php?source='.$_POST["source"].'&idkor='.$name_k[$i].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&type=2"><font class="main">'.$name_k[$i].'</font></a></td>';
      else print '<tr><td></td>';
      for ($j=0; $j<$y; $j++)
      	  {
      	   if ($i==-1) print '<td bgcolor=#880000 align=center><a href="rep_det.php?source='.$_POST["source"].'&idkor='.$_POST["idkor"].'&idbuy='.$name_b[$j].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&type=1"><font class="main">'.$name_b[$j].'</font></a></td>';
	   else
	   	{
	   	 if ($data[$j][$i]=='') $data[$j][$i]=0;
	   	 print '<td bgcolor=#000000 align=center><font class="main">'.$data[$j][$i].'</td>';
	   	}
      	  }
      print '</tr>';
     }
 print '</table></td></tr>';
}

if ($_POST["frm"]==2)
{
 $x=0; $y=0;
 $query = 'SELECT * FROM buyers'; $r = mysql_query ($query,$i);
 //echo $query.'<br>';
 for ($j=1;$j<=20;$j++)
     {
      $uo = mysql_fetch_row ($r);
      if ($uo == true)
         {
          $name_b[$y]=$uo[1]; $x=0;
	  $query = 'SELECT * FROM energy_supply';
          //echo $query.'<br>';
          $t = mysql_query ($query,$i);
          for ($k=1;$k<=10;$k++)
              {
               $uu = mysql_fetch_row ($t);
               if ($uu == true)
                  {
                   $name_r[$x]=$uu[1];
                   if ($_POST["idkor"]!=99)
                      {
                       $source=$uu[2]+1;
		       $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$_POST["idkor"];
		       //echo $query.'<br>';
    		       $a = mysql_query ($query,$i);
    		       $uy = mysql_fetch_row ($a);
		       if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	  	       //print '[Kor='.$_POST["idkor"].',Buy='.$uo[1].',sour='.$source.']='.$K.'<br>';

                       //if ($_POST["day"]>1) $day=$_POST["day"]-1; else $day=31;
		       //if ($_POST["month"]>1) $month=$_POST["month"]-1;  else $month=12;
		       //if ($_POST["month"]<10) $month='0'.$_POST["month"]; else $month=''.$_POST["month"];
                       $month=''.$_POST["month"];
       		       if ($_POST["day"]<10) $day='0'.$_POST["day"]; else $day=''.$_POST["day"];
                       if ($_POST["otch"]==1)
	               		$query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date='.$_POST["year"].$month.$day.'000000 AND korp='.$_POST["idkor"].' AND source='.$uu[2];
	               if ($_POST["otch"]==2)
  	           		$query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.$day.'000000 OR date='.$_POST["year"].$month.$day.'120000) AND korp='.$_POST["idkor"].' AND source='.$uu[2];
                       if ($_POST["otch"]==3)
	    	 	        $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.'01000000 OR date='.$_POST["year"].$month.'01120000) AND korp='.$_POST["idkor"].' AND source='.$uu[2];
	               if ($_POST["otch"]==4)
	                        $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.'01000000 OR date='.$_POST["year"].$month.'01120000) AND korp='.$_POST["idkor"].' AND source='.$uu[2];
       		       //echo $query.'<br>';
		       $a = mysql_query ($query,$i);
                       if ($a)
                       for ($l=1;$l<=200;$l++)		   
		           {
		  	    $uy = mysql_fetch_row ($a);
		  	    if ($uy == true)
		  	       {
		  	        if ($l==1) $tim=$uy[3];
		  	        if ($tim!=$uy[3]) break;
		  	        if ($uu[2]==0)
                      	           {
		  	            if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$y][$x]=$uy[7]*$K;
                    	            if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$y][$x]=$data[$y][$x]-$uy[7]*$K; $l=100;}
                    	           }
		  	        if ($uu[2]==1)
		  	           {
		  	            if (strstr ($uy[1],'тепловой энергии')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
      	            	           }
		  	        if ($uu[2]==2)
		  	           {
		  	            $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		  	           }
		   	        if ($uu[2]==3)
                    	           {
		  	            $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		  	           }
		  	        if ($uu[2]==4)
		  	           {
	                 	    if (strstr ($uy[1],'массы')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		  	           }
		  	        if ($uu[2]==5)
                    	           {
				    if (strstr ($uy[1],'объема')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		  	           }
		  	        if ($uu[2]==6)
                    	           {
		  	            if (strstr ($uy[1],'объема'))  $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
		  	           }
		  	        if ($uu[2]==7)
          	      		   {
		  	            $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
				   }
	                       }
        	  	   }
                        $x++;
		      }
		   else
		      {
		 	$query = 'SELECT * FROM korp';
		        $p = mysql_query ($query,$i);
		        for ($n=1;$n<=25;$n++)
		              {
		               $ut = mysql_fetch_row ($p);
		               if ($ut == true)
		                  {		       
		                   $source=$uu[2]+1;
				   $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$ut[1];
				   //echo $query.'<br>';
		    		   $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a); $K=0;
				   if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
			  	   //print '[Kor='.$ut[1].',Buy='.$uo[1].',sour='.$source.']='.$K.'<br>';
			  	   if ($K>0)
			  	      {
                                       $month=''.$_POST["month"];
       	       		               if ($_POST["day"]<10) $day='0'.$_POST["day"]; else $day=''.$_POST["day"];
                                       if ($_POST["otch"]==1)
	   	                            $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date='.$_POST["year"].$month.$day.'000000 AND korp='.$ut[1].' AND source='.$uu[2];
	   	                       if ($_POST["otch"]==2)
  	     	               			$query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.$day.'000000 OR date='.$_POST["year"].$month.$day.'120000) AND korp='.$ut[1].' AND source='.$uu[2];
                                       if ($_POST["otch"]==3)
	   	    	   	   	        $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.'01000000 OR date='.$_POST["year"].$month.'01120000) AND korp='.$ut[1].' AND source='.$uu[2];
	   	                       if ($_POST["otch"]==4)
	   	                            $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.'01000000 OR date='.$_POST["year"].$month.'01120000) AND korp='.$ut[1].' AND source='.$uu[2];
       	       		               //echo $query.'<br>';
			               $a = mysql_query ($query,$i);
                                       if ($a)
                                       for ($l=1;$l<=10;$l++)		   
			                   {
			     	   	    $uy = mysql_fetch_row ($a);
			     	   	    if ($uy == true)
			     	   	           {
			           	    if ($l==1) $tim=$uy[3];
			           	    if ($tim!=$uy[3]) break;
			           	    if ($uu[2]==0)
                                               {
			           	        if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$y][$x]=$uy[7]*$K;
                                                if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$y][$x]=$data[$y][$x]-$uy[7]*$K; $l=100;}
	                                       }
			           	    if ($uu[2]==1)
			           	       {
			           	        if (strstr ($uy[1],'тепловой энергии')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
      	         	                       }
			           	    if ($uu[2]==2)
			           	       {
			           	        $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
			           	       }
			               	    if ($uu[2]==3)
                                               {
			           	        $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
			           	       }
			           	    if ($uu[2]==4)
			           	       {
	   	                            	if (strstr ($uy[1],'массы')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
			           	       }
			           	    if ($uu[2]==5)
                                       	       {
					        if (strstr ($uy[1],'объема')) $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
			           	       }
			           	    if ($uu[2]==6)
                                       	       {
			           	        if (strstr ($uy[1],'объема'))  $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
			           	       }
			           	    if ($uu[2]==7)
                    	             	       {
			           	        $data[$y][$x]=$data[$y][$x]+$uy[7]*$K;
					       }
	   	                            }	   	                      
	   	                         }
                	     	     }
                                  }                               
                              }
                          $x++;
		      }
                  }
    	      }
          $y++;
 	 }
     }
 print '<tr><td colspan=7><table bgcolor=#111111>';
// print '<form name="graph" method=post action="rep_det.php">';
// print '<input name="x" size=1 style="height:1;width:1;visibility:hidden" value="'.$x.'">';
// print '<input name="y" size=1 style="height:1;width:1;visibility:hidden" value="'.$y.'">';
 for ($i=-1; $i<$y; $i++)
     {
      if ($i>=0) print '<tr><td bgcolor=#880000 align=center><a href="rep_ddt.php?idkor='.$_POST["idkor"].'&idbuy='.$name_b[$i].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&type=1&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'"><font class="main">'.$name_b[$i].'</font></a></td>';
      else print '<tr><td></td>';
      for ($j=0; $j<$x; $j++)
      	  {
      	   if ($i==-1) print '<td bgcolor=#880000 align=center><a href="rep_det.php?source='.$name_r[$j].'&idbuy='.$name_b[$i].'&idkor='.$_POST["idkor"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&type=3&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'"><font class="main">'.$name_r[$j].'</font></a></td>';
	   else
	   	{
	   	 if ($data[$i][$j]=='') $data[$i][$j]=0;
	   	 print '<td bgcolor=#000000 align=center><font class="main">'.$data[$i][$j].'</td>';
//		 print '<input name="data'.$j.'_'.$i.'" size=1 style="height:1;width:1;visibility:hidden" value="'.$data[$j][$i].'">';
	   	}
      	  }
      print '</tr>';
     }
// print '</form>';
 print '</table></td></tr>';
}

if ($_POST["frm"]==3)
{
 $x=0; $y=0; $pr=0; $kr=0;
 $source=1+$_POST["source"];
 $query = 'SELECT * FROM korp';
 $t = mysql_query ($query,$i);
 for ($k=1;$k<=50;$k++)
     {
      $uu = mysql_fetch_row ($t);
      if ($uu == true)
         {
          $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date<'.$_POST["year"].$_POST["month"].$_POST["day"].'000000 AND korp='.$uu[1].' AND source='.$_POST["source"].' ORDER BY date DESC';
          $a = mysql_query ($query,$i);
          $cnt=0;
          if ($a)
          for ($l=1;$l<=2000;$l++)
              {		            
               $uy = mysql_fetch_row ($a);
               if ($uy == true)
                  {
		   if ($l==1) $tim=$uy[3];
		   if ($tim!=$uy[3]) { $name_t[$x]=$tim; $tim=$uy[3];  $x++; } // print '['.$x.']='.$name_t[$x].'='.$uy[7].'<br>';
		   if ($_POST["source"]==0)
                      {
		       if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$y][$x]=$uy[7];
              	       if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$y][$x]=$data[$y][$x]-$uy[7]; $l=100;}
                      }
		   if ($_POST["source"]==1)
		      {
		       if (strstr ($uy[1],'тепловой энергии')) $data[$y][$x]=$data[$y][$x]+$uy[7];
      	      	      }
		   if ($_POST["source"]==2)
		      {
		       $data[$y][$x]=$data[$y][$x]+$uy[7];
		      }
		   if ($_POST["source"]==3)
              	      {
		       $data[$y][$x]=$data[$y][$x]+$uy[7];
		      }
		   if ($_POST["source"]==4)
		      {
	               if (strstr ($uy[1],'массы')) $data[$y][$x]=$data[$y][$x]+$uy[7];
		      }
		   if ($_POST["source"]==5)
              	      {
		       if (strstr ($uy[1],'объема')) $data[$y][$x]=$data[$y][$x]+$uy[7];
		      }
		   if ($_POST["source"]==6)
              	      {
		       if (strstr ($uy[1],'объема'))  $data[$y][$x]=$data[$y][$x]+$uy[7];
		      }
		   if ($_POST["source"]==7)
        	      {
		       $data[$y][$x]=$data[$y][$x]+$uy[7];
		      }
		  }
	      }
	 } if ($pr<$x) $pr=$x;
	 $x=0; $y++;
     }

 $kr=$y; $x1=0; $y1=0;
 $query = 'SELECT * FROM buyers';
 $r = mysql_query ($query,$i);
 for ($j=1;$j<=20;$j++)
     {
      $uo = mysql_fetch_row ($r);
      if ($uo == true)
         {
          $name_b[$y1]=$uo[1]; $x1=0;
	  $query = 'SELECT * FROM korp';
          $t = mysql_query ($query,$i);
          for ($k=1;$k<=50;$k++)
              {
               $uu = mysql_fetch_row ($t);
               if ($uu == true)
                  {
		   $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
		   $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a);
		   if ($uy == true && $uy[0]>0)  $K[$y1][$x1]=$uy[0];
//		   if ($uy[0]>0) print 'K['.$y1.']['.$x1.']='.$K[$y1][$x1].'<br>';
                   $x1++;
		  }
              }
          $y1++;  $x1=0;
         }
     }     
//     12:00 11:00 10:00        1     2    3         12:00    11:00    10:00
//  1  158.1 256.1 146.1   Eco  0.4  0.5  0.2   Eco  0.4*158.1+0.5*151.1
//  2  151.1 126.3  56.1   CHT  0.6  0.5  0.8   CHT
 for ($i=0; $i<$pr; $i++)          // 2   
 for ($j=0; $j<$y1; $j++)          // 2   
 for ($k=0; $k<$kr; $k++)          // 2
     {
      // к-нт использование ресурса в данном корпусе арендатором * данные по данному корпусу за данное время
      $dat[$j][$i]=$dat[$j][$i] + $K[$i][$k] *  $data[$k][$j];
     }
 for ($j=-1; $j<$pr; $j++)
     {
      if ($j>=0) print '<tr><td bgcolor=#880000 align=center><font class="main">'.$name_t[$j].'</font></td>';
      else print '<tr><td></td>';
      for ($i=0; $i<$y1; $i++)
          {
           if ($j==-1) print '<td bgcolor=#880000 align=center><font class="main">'.$name_b[$i].'</font></td>';
	   else
	   	{
	   	 if ($dat[$j][$i]=='') $dat[$j][$i]=0;
	   	 print '<td bgcolor=#000000 align=center><font class="main">'.$dat[$j][$i].'</td>';
	   	}
          }
      print '</tr>';
     }
}

if ($_POST["frm"]==4)
{
 $x=0; $y=0; $z=0; $pr=0; $kr=0; $pz=0;
 $query = 'SELECT * FROM korp';
 $t = mysql_query ($query,$i);
 for ($j=1;$j<=25;$j++)
     {
      $uu = mysql_fetch_row ($t);
      if ($uu == true)
         {
	  $z=0;
	  $query = 'SELECT * FROM energy_supply';
	  $r = mysql_query ($query,$i);
	  for ($n=1;$n<=50;$n++)
              {
               $uo = mysql_fetch_row ($r);
               if ($uo == true)
        	  {
                   $name_r[$z]=$uo[1]; $x=0;
                   //print '['.$z.']='.$name_r[$z];
	           $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date<'.$_POST["year"].$_POST["month"].$_POST["day"].'000000 AND korp='.$uu[1].' AND source='.$uo[2].' ORDER BY date DESC';
        	   $a = mysql_query ($query,$i);
	           $cnt=0;
        	   if ($a)
	           for ($l=1;$l<=2000;$l++)
        	       {		            
                	$uy = mysql_fetch_row ($a);
                        if ($uy == true)
                           {	
                            //	print '['.$uu[1].']['.$uo[2].']='.$uy[7].'<br>';
                	    if ($l==1) $tim=$uy[3];
		            if ($tim!=$uy[3] && $tim>$uy[3]) { $name_t[$x]=$tim;  $tim=$uy[3];  $x++; } // print '['.$x.']='.$name_t[$x].'='.$uy[7].'<br>';
//                            print '['.$x.']='.$name_t[$x].'='.$uy[7].'<br>';
    		     	    if ($uo[2]==0)
                               {
		             	if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$y][$x][$z]=$uy[7];
              	             	if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$y][$x][$z]=$data[$y][$x][$z]-$uy[7]; $l=100;}
                            	}
		     	    if ($uo[2]==1)
		            	{
			     	 if (strstr ($uy[1],'тепловой энергии')) $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
      	      	    	    	}
		    	    if ($uo[2]==2)
		    	   	{
		    	    	 $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
		      	   	}
		      	    if ($uo[2]==3)
              	       	   	{
		       	    	 $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
		       	   	}
		      	    if ($uo[2]==4)
		                {
	               	    	 if (strstr ($uy[1],'массы')) $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
		       	   	}
		      	    if ($uo[2]==5)
              	       	   	{
		       	    	 if (strstr ($uy[1],'объема')) $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
		       	   	}
		      	    if ($uo[2]==6)
              	       	   	{
		       	    	 if (strstr ($uy[1],'объема'))  $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
		       	   	}
		      	    if ($uo[2]==7)
        	       	   	{
		       	    	 $data[$y][$x][$z]=$data[$y][$x][$z]+$uy[7];
		       	   	}
		  	   }	  	         
		        }
                   $z++;
                   if ($pr<$x) $pr=$x;
		   $x=0;
	      	  }
	      }
	  $pz=$z;
	  $y++;
	 }
     }

 $kr=$y; $x1=0; $y1=0;
 $query = 'SELECT * FROM energy_supply';
 $r = mysql_query ($query,$i);
 for ($j=1;$j<=20;$j++)
     {
      $uo = mysql_fetch_row ($r);
      if ($uo == true)
         {
          $x1=0;
	  $query = 'SELECT * FROM korp';
          $t = mysql_query ($query,$i);
          for ($k=1;$k<=50;$k++)
              {
               $uu = mysql_fetch_row ($t);
               if ($uu == true)
                  {
                   $sourc=$uo[2]+1;
		   $query = 'SELECT SUM(K'.$sourc.') FROM objects WHERE type!=1 AND idbuy='.$_POST["idbuy"].' AND idkorp='.$uu[1];
		   $a = mysql_query ($query,$i);  $uy = mysql_fetch_row ($a);
		   if ($uy == true && $uy[0]>0)  $K[$y1][$x1]=$uy[0];
//		   if ($uy[0]>0) print 'K['.$y1.']['.$x1.']='.$K[$y1][$x1].'<br>';
                   $x1++;
		  }
              }
          $y1++;  $x1=0;
         }
     }     
 for ($i=0; $i<$pr; $i++)          // time
 for ($j=0; $j<$y1; $j++)          // resource
 for ($k=0; $k<$kr; $k++)          // korpus
     {
      $dat[$j][$i]=$dat[$j][$i] + $data[$k][$i][$j]; // $K[$j][$k]
     }
 for ($j=-1; $j<$pr; $j++)
     {
      if ($j>=0) print '<tr><td bgcolor=#880000 align=center><font class="main">'.$name_t[$j].'</font></td>';
      else print '<tr><td></td>';
      for ($i=0; $i<$y1; $i++)
          {
           if ($j==-1) print '<td bgcolor=#880000 align=center><font class="main">'.$name_r[$i].'</font></td>';
	   else
	   	{
	   	 if ($dat[$i][$j]=='') $dat[$i][$j]=0;
	   	 print '<td bgcolor=#000000 align=center><font class="main">'.$dat[$i][$j].'</td>';
	   	}
          }
      print '</tr>';
     }
}

if ($_POST["frm"]==8)
{
 $arr = get_defined_vars();
 $source=1+$arr["source"];
 $kor=0; $max=0;
     	          if ($arr["day"]>1) $day=$arr["day"]-1;
    	          if ($arr["month"]>1) $month=$arr["month"]-1; else {$month=12; $arr["year"]--;}
 	          if ($month<10) $month='0'.$month; else $month=''.$month;

 if ($arr["idkor"]==99)
    {  
     $query = 'SELECT * FROM korp';
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)
         {
          $uu = mysql_fetch_row ($t);
          if ($uu == true)
             {
              $x=1;
              $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1];
              $a = mysql_query ($query,$i);
              for ($y=0; $y<1; $y++)
                  {
                   $data0[$y]=$data1[$y]=$data2[$y]=$data3[$y]=0; $time[$y]="1";
                  }
              $uy = mysql_fetch_row ($a);
              $cnt=1;
              if ($uy == true && $uy[0]>0)  $K=$uy[0];
              else $K=0;
              //echo $query.' '.$K.'<br>';
              if ($K>0)
                 {
                  $yeap=0; $cnt=1;
                  if ($arr["otch"]==1) { $mx=23; $mn=0; }
                  if ($arr["otch"]==2) { $mx=31; $mn=1; }
                  if ($arr["otch"]==3) { $mx=30; $mn=1; }
                  if ($arr["otch"]==4) { $mx=12; $mn=1; }
                  if ($arr["otch"]==5) { $mx=23; $mn=0; }
  	          for ($tm=$mn; $tm<=$mx; $tm++)
	              {
		       if ($arr["otch"]==1)
  		       if ($tm<10)
	                  {
	                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.'0'.$tm.'0000 AND korp='.$uu[4].' AND source='.$arr["source"];
	                   $dat[$x]=$day.'-'.$arr["month"].'-'.$arr["year"].' 0'.$tm.':00';
	                  }
                       else
                          {
                           $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.$tm.'0000 AND korp='.$uu[1].' AND source='.$arr["source"];
	                   $dat[$x]=$day.'-'.$arr["month"].'-'.$arr["year"].' '.$tm.':00';
		          }
		       if ($arr["otch"]==2)
  	  	       if ($tm<10)
  	  	          {
  	  	           $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.'0'.$tm.'000000 OR date='.$arr["year"].$month.'0'.$tm.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                           $dat[$x]='0'.$tm.'-'.$month.'-'.$arr["year"].' 00:00';
  	  	          }
 	 	       else
 	 	          {
 	 	           $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.$tm.'000000 OR date='.$arr["year"].$month.$tm.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                           $dat[$x]=$tm.'-'.$month.'-'.$arr["year"].' 00:00';
                          }
                       if ($arr["otch"]==4)
		       if ($tm>9)
		          {
		           $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$tm.'01000000 OR date='.$arr["year"].$tm.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
    	    	           $dat[$x]='01-'.$tm.'-'.$arr["year"].' 00:00';
		          }
		       else
		          {
		           $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].'0'.$tm.'01000000 OR date='.$arr["year"].'0'.$tm.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
      	      	           $dat[$x]='01-0'.$tm.'-'.$arr["year"].' 00:00';
      	      	          }      
 	 	       $a = mysql_query ($query,$i); 
                       if ($a)
                       for ($l=1;$l<=200;$l++)
                          {
                           $uy = mysql_fetch_row ($a);
                           if ($uy == true)
                              {
                               if ($l>1) $yeap=1;
                               //echo $uy[6].' '.$uy[1];
		               if ($uy[6]==0)
                                  {
			           if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data0[$x]=$uy[7]*$K;
                                   if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data0[$x]=$data0[$x]-$uy[7]*$K; $l=100;}
                                  }
			       if ($uy[6]==1) if (strstr ($uy[1],'тепловой энергии')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($uy[6]==2) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($uy[6]==3) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($uy[6]==4) if (strstr ($uy[1],'массы')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($uy[6]==5) if (strstr ($uy[1],'объема')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($uy[6]==6) if (strstr ($uy[1],'объема'))  $data0[$x]=$data0[$x]+$uy[7]*$K;
 	 		       if ($uy[6]==7) $data0[$x]=$data0[$x]+$uy[7]*$K;
                              }                       
                           }
                        $x++;
                      }
  	         }
             }
         }    
     if ($arr["source"]==0) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Тепловая мощность по магистрали (ГДж/ч)</td></tr>';
     if ($arr["source"]==1) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход воды (м3)</td></tr>';
     if ($arr["source"]==2) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход воды (м3)</td></tr>';                                         	 	
     if ($arr["source"]==3) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход пара (м3)</td></tr>';
     if ($arr["source"]==4) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Массовый расход газа (кг/ч)</td></tr>';
     if ($arr["source"]==5) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==6) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==7) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Мощность (кВт)</td></tr>';        
     if ($arr["otch"]==1) { $mx=23; $mn=0; }
     if ($arr["otch"]==2) { $mx=31; $mn=1; }
     if ($arr["otch"]==3) { $mx=30; $mn=1; }
     if ($arr["otch"]==4) { $mx=12; $mn=1; }
     if ($arr["otch"]==5) { $mx=23; $mn=0; }
     for ($tm=$mx; $tm>0; $tm--)
         {
          print '<tr align=center><td bgcolor=#111111 align=left><font class="dd">'.$dat[$tm].'</font></td>';
          print '<td bgcolor=#111111 align=center><font class="dd">'.$data0[$tm].'</font></td></tr>';
         }
    }
 else
    {
     $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$arr["idkor"];
     $a = mysql_query ($query,$i);
     for ($y=0; $y<1; $y++)
         {
          $data0[$y]=$data1[$y]=$data2[$y]=$data3[$y]=0; $time[$y]="1";
         }
     $uy = mysql_fetch_row ($a);
     $cnt=1;
     if ($uy == true && $uy[0]>0)  $K=$uy[0];
     if ($K>0)
        {
         $yeap=0; $cnt=1;
         if ($arr["otch"]==1) { $mx=23; $mn=0; }
         if ($arr["otch"]==2) { $mx=31; $mn=1; }
         if ($arr["otch"]==3) { $mx=30; $mn=1; }
         if ($arr["otch"]==4) { $mx=12; $mn=1; }
         if ($arr["otch"]==5) { $mx=23; $mn=0; }
    	 if ($arr["day"]>1) $day=$arr["day"]-1;
	 if ($arr["month"]>1) $month=$arr["month"]-1;
  	 if ($month<10) $month='0'.$month; else $month=''.$month;
    	 for ($tm=$mn; $tm<=$mx; $tm++)
	     {
	      if ($arr["otch"]==1)
    	      if ($tm<10)
	       	  {
	       	   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.'0'.$tm.'0000 AND korp='.$uu[4].' AND source='.$arr["source"];
	       	   $dat[$cnt]=$day.'-'.$arr["month"].'-'.$arr["year"].' 0'.$tm.':00';
	       	  }
              else
                  {
                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.$tm.'0000 AND korp='.$uu[1].' AND source='.$arr["source"];
	      	   $dat[$cnt]=$day.'-'.$arr["month"].'-'.$arr["year"].' '.$tm.':00';
	       	  }
	      if ($arr["otch"]==2)
    	      if ($tm<10)
       	       	  {
       	      	   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.'0'.$tm.'000000 OR date='.$arr["year"].$month.'0'.$tm.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                   $dat[$cnt]='0'.$tm.'-'.$month.'-'.$arr["year"].' 00:00';
       	       	  }
	      else
    	       	  {
    	       	   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.$tm.'000000 OR date='.$arr["year"].$month.$tm.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                   $dat[$cnt]=$tm.'-'.$month.'-'.$arr["year"].' 00:00';
                  }
              if ($arr["otch"]==4)
	      if ($tm>9)
	       	  {
	       	   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$tm.'01000000 OR date='.$arr["year"].$tm.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
        	   $dat[$cnt]='01-'.$tm.'-'.$arr["year"].' 00:00';
	       	  }	
	      else
	       	  {
	       	   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].'0'.$tm.'01000000 OR date='.$arr["year"].'0'.$tm.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                   $dat[$cnt]='01-0'.$tm.'-'.$arr["year"].' 00:00';
        	  }      
	     $a = mysql_query ($query,$i);
	     $cnt=1;
	     if ($a)
	     for ($l=1;$l<=500;$l++)
	         {
	          $uy = mysql_fetch_row ($a);
 	          if ($uy == true)
                   {
                    if ($l==1) $tim=$uy[3];
                    if ($uy[6]==0)
                        {
                         if (strstr ($uy[1],'температур') && strstr ($uy[1],'подающей')) { $data0[$cnt]=$uy[7]; $time[$cnt]=$uy[3]; }
                         if (strstr ($uy[1],'температур') && strstr ($uy[1],'обратной')) $data1[$cnt]=$uy[7];
                         if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data2[$cnt]=$uy[7];
                         if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) $data3[$cnt]=$uy[7];
                         $max=4;
                        }
            	    if ($uy[6]==1)
            	        {
                         if (strstr ($uy[1],'тепловой энергии')) $data0[$cnt]=$uy[7]*$K;
                         $max=1;
          	        }
                    if ($uy[6]==2 || $uy[6]==3 || $uy[6]==7)
                       {
                        $data0[$cnt]=$uy[7]*$K;
                        $max=1;
                       }
                    if ($uy[6]==4)
                        {
              	         if (strstr ($uy[1],'значений давления'))  { $data0[$cnt]=$uy[7]; $time[$cnt]=$uy[3]; }
                         if (strstr ($uy[1],'значений температуры')) $data1[$cnt]=$uy[7];
	          	 if (strstr ($uy[1],'массы'))  $data2[$cnt]=$uy[7]*$K;
                         $max=3;                 
                        }
                    if ($uy[6]==5 || $uy[6]==6)
                        {
              	         if (strstr ($uy[1],'значений давления'))  { $data0[$cnt]=$uy[7]; $time[$cnt]=$uy[3]; }
                         if (strstr ($uy[1],'значений температуры')) $data1[$cnt]=$uy[7];
		         if (strstr ($uy[1],'объема'))  $data2[$cnt]=$uy[7]*$K;
                         $max=3;                 
                        }
                   }
                 }
             }
        }
     if ($arr["source"]==0) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Разность температур (С)</td><td bgcolor=#880000><font class="main">Тепловая мощность по магистрали (ГДж/ч)</td></tr>';
     if ($arr["source"]==1) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Значение температуры воды по подающей трубе (С)</td><td bgcolor=#880000><font class="main">Объемный расход воды по подающей трубе (м3)</td><td bgcolor=#880000><font class="main">Значение температуры воды по обратной трубе (С)</td><td bgcolor=#880000><font class="main">Объемный расход воды по обратной трубе (м3)</td></tr>';
     if ($arr["source"]==2) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход воды (м3)</td></tr>';                                         	 	
     if ($arr["source"]==3) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход пара (м3)</td></tr>';
     if ($arr["source"]==4) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#880000><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#880000><font class="main">Массовый расход газа (кг/ч)</td></tr>';
     if ($arr["source"]==5) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#880000><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#880000><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==6) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#880000><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#880000><font class="main">Объемный расход (м3)</td></tr>';
     if ($arr["source"]==7) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Мощность (кВт)</td></tr>';        
     if ($arr["otch"]==1) { $mx=23; $mn=0; }
     if ($arr["otch"]==2) { $mx=31; $mn=1; }
     if ($arr["otch"]==3) { $mx=30; $mn=1; }
     if ($arr["otch"]==4) { $mx=12; $mn=1; }
     if ($arr["otch"]==5) { $mx=23; $mn=0; }
     for ($tm=$mx; $tm>=0; $tm--)
         {
          print '<tr align=center><td bgcolor=#111111 align=left><font class="dd">'.$dat[$tm].'</font></td>';
          for ($i=0;$i<$max;$i++)
	      {
               print '<td bgcolor=#111111 align=center><font class="dd">'.$col[$h].'</font></td>';
              }
          print '</tr>';
         }
    }
}
}
?>
</table></td></tr>
</table><br>
</td><tr>
<tr><td>
<table border=0 align=center bgcolor=#000000 align=center>
<?php
if ($_POST["frm"]==8)
// if ($dataye==1)
   print '<tr><td><img border=0 src="charts/xyplots.php?source='.$_POST["source"].'&idkor='.$_POST["idkor"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'"></td></tr>';
if ($_POST["frm"]==3)
   print '<tr><td><img border=0 src="charts/xyplots2.php?source='.$_POST["source"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'"></td></tr>';
// else    print '<tr><td><font class="down">Нет нужных данных</font></td></tr>';
?>
</table><br>
</td><tr>
</table>
</body>
</html>