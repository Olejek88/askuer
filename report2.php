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
<body bgcolor=black leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=center border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#000000>
<tr><td>
<table border=0 cellspacing=0 cellpadding=1 align=center width=100%>
<tr><td align=left width=100%>
<table border=0 align=center bgcolor=#000000>
<tr><td>
<table border=0 align=center bgcolor=#000000 align=center>
<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
//$param_num[8]={1,4,2,3,5,5,5,1};
//echo $_POST["idbuy"]; echo '<br>';
//echo $_POST["source"]; echo '<br>';
//echo $_POST["idkor"]; echo '<br>';
//echo $_POST["idkon"]; echo '<br>';
//echo $_POST["otch"]; echo '<br>';
//echo $_POST["day"]; echo '<br>';
//echo $_POST["month"]; echo '<br>'; 
//echo $_POST["year"]; echo '<br>';
//-------------------------------------------------------
if ($_POST["otch"]<10)
{
print '<tr><td align=center><table border=0><tr><td><font class="menu">Отчет по ';
if ($_POST["source"]==99) print 'потреблению всех энергоресурсов';
if ($_POST["source"]==0) print 'потреблению теплофикационной воды';
if ($_POST["source"]==1) print 'потреблению тепловой энергии';
if ($_POST["source"]==2) print 'потреблению пожарно-питьевой воды';
if ($_POST["source"]==3) print 'потреблению водяного пара';
if ($_POST["source"]==4) print 'потреблению природного газа';
if ($_POST["source"]==5) print 'потреблению сжатого воздуха';
if ($_POST["source"]==6) print 'потреблению кислорода';
if ($_POST["source"]==7) print 'потреблению электрической энергии';
print '</font></td></tr>';
print '<tr><td colspan=3 align=left><font class="menu">Арендатор: </font><font class="down">';
if ($_POST["idbuy"]==99) print 'все арендаторы';
else
{
 $query = 'SELECT * FROM buyers WHERE idx='.$_POST["idbuy"];
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
 if ($ui == true) print $ui[1];
}
print '</td><td colspan=4><font class="menu">Корпус: </font><font class="down">';
if ($_POST["idkor"]==99) print 'все корпуса';
else
{
 $query = 'SELECT name FROM korp WHERE korp_id='.$_POST["idkor"];
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
 if ($ui == true) print $ui[0];
}
print '</td></tr>';
print '<tr><td colspan=7 align=center><font class="menu">на расчетное время </font><font class="down">';
print $_POST["day"].'/'.$_POST["month"].'/'.$_POST["year"];
print '</td></tr></table></td></tr>';
print '<tr><td><table>';
for ($q=1;$q<8;$q++) $K[$q]=1;
//------------------------------------------------------------------------
if ($_POST["source"]==99)
{
 if ($_POST["idbuy"]==99) $query = 'SELECT * FROM buyers';
 else $query = 'SELECT * FROM buyers WHERE idx='.$_POST["idbuy"];
 $r = mysql_query ($query,$i);
 		       if ($_POST["day"]>1) $day=$_POST["day"]-1;
		       if ($_POST["month"]>1) $month=$_POST["month"]-1;
		       if ($month<10) $month=''.$month; else $month=''.$month;

 for ($j=1;$j<=20;$j++)
     {
      $uo = mysql_fetch_row ($r);
      if ($uo == true)
         {
          if ($_POST["idkor"]==99) $query = 'SELECT * FROM objects WHERE type<2';
          else $query = 'SELECT * FROM objects WHERE type<2 AND idkorp='.$_POST["idkor"];
          $t = mysql_query ($query,$i);
          for ($k=1;$k<=100;$k++)
              {
               $uu = mysql_fetch_row ($t);
               if ($uu == true)
                  {
                   $zagl = '<tr><td colspan=5 bgcolor=#000088 align=center><font class="or1">'.$uo[1].' ['.$uu[1].']</font></td></tr>';
                   $buykorp=0;
                   for ($dd=1; $dd<=8; $dd++)
                       {
	                $query = 'SELECT SUM(K'.$dd.') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[4];
        	        $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a);
                        if ($uy == true && $uy[0]>0)
                      	   {
                            $K[$dd]=$uy[0];
                            $buykorp=1;
		            if ($uu[5]==0) { $uy=true;  $uy[0]=1; } // субарендатор
                           }
                       }
                   if ($buykorp==1)
                      {
                       print $zagl;
                       print '<tr><td bgcolor=#880000 width=110 align=center><font class="main">Время</td><td bgcolor=#880000 colspan=4 align=center><font class="main">Теплофикационная вода</td><td bgcolor=#880000 colspan=1 align=center><font class="main">Тепловая энергия</td><td bgcolor=#880000 colspan=1><font class="main">Пожарно-питьевая вода</td><td bgcolor=#880000 align=center><font class="main">Водяной пар</td><td bgcolor=#880000 colspan=3 align=center><font class="main">Природный газ</td><td bgcolor=#880000 colspan=3 align=center><font class="main">Сжатый воздух</td><td bgcolor=#880000 colspan=3 align=center><font class="main">Кислород</td><td bgcolor=#880000 colspan=1 align=center><font class="main">Электр. энергия</td></tr>';
 	               print '<td bgcolor=#222222 align=center><font class="main"></td><td bgcolor=#222222 align=center><font class="main">Темп. под. трубе (С)</td><td bgcolor=#222222 align=center><font class="main">Темп. обр.трубе (м3)</td><td bgcolor=#222222 align=center><font class="main">Масса обр. трубе (С)</td><td bgcolor=#222222 align=center><font class="main">Масса под.трубе (м3)</td>';
                       print '<td bgcolor=#222222 align=center><font class="main">Тепловая энергия (ГДж/ч)</td>';
                       print '<td bgcolor=#222222 align=center><font class="main">Расход воды (м3)</td>';
                       print '<td bgcolor=#222222 align=center><font class="main">Расход пара (м3)</td>';
                       print '<td bgcolor=#222222 align=center><font class="main">Давление (МПа)</td><td bgcolor=#222222 align=center><font class="main">Темпе- ратура (С)</td><td bgcolor=#222222 align=center><font class="main">Массовый расход (кг/ч)</td>';
	               print '<td bgcolor=#222222 align=center><font class="main">Давление (МПа)</td><td bgcolor=#222222 align=center><font class="main">Темпе- ратура (С)</td><td bgcolor=#222222 align=center><font class="main">Объемный расход (м3)</td>';
         	       print '<td bgcolor=#222222 align=center><font class="main">Давление (МПа)</td><td bgcolor=#222222 align=center><font class="main">Темпе- ратура (С)</td><td bgcolor=#222222 align=center><font class="main">Объемный расход (м3)</td>';
	               print '<td bgcolor=#222222 align=center><font class="main">Мощность (кВт)</td></tr>';

                       $yeap=0;
                       for ($h=0;$h<18;$h++) $col[$h]=0.0;
                       if ($_POST["otch"]==1) { $mx=23; $mn=0; }
                       if ($_POST["otch"]==2) { $mx=31; $mn=1; }
                       if ($_POST["otch"]==3) { $mx=30; $mn=1; }
                       if ($_POST["otch"]==4) { $mx=12; $mn=1; }
                       if ($_POST["otch"]==5) { $mx=23; $mn=0; }
		       for ($tm=$mx; $tm>=$mn; $tm--)
		           {
		            if ($_POST["otch"]==1)
		               if ($tm<10)
		                  {
		                   $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date='.$_POST["year"].$_POST["month"].$day.'0'.$tm.'0000 AND korp='.$uu[4];
		                   $dat=$day.'-'.$_POST["month"].'-'.$_POST["year"].' 0'.$tm.':00';
		                  }
	                       else
	                       	  {
	                       	   $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date='.$_POST["year"].$_POST["month"].$day.$tm.'0000 AND korp='.$uu[4];
       		                   $dat=$day.'-'.$_POST["month"].'-'.$_POST["year"].' '.$tm.':00';
       		                  }
    		            if ($_POST["otch"]==2)
  	                       if ($tm<10)
  	                          {
  	                           $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.'0'.$tm.'000000 OR date='.$_POST["year"].$month.'0'.$tm.'120000) AND korp='.$uu[4];
                                   $dat='0'.$tm.'-'.$month.'-'.$_POST["year"].' 00:00';
  	                          }
 	                       else
 	                          {
 	                           $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$month.$tm.'000000 OR date='.$_POST["year"].$month.$tm.'120000) AND korp='.$uu[4];
                                   $dat=$tm.'-'.$month.'-'.$_POST["year"].' 00:00';
                                  }
		            if ($_POST["otch"]==3)
		               {
                                $dat=$tm.'-'.$month.'-'.$_POST["year"].' 00:00';
		                if ($tm>20) { $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date='.$_POST["year"].$_POST["month"].$tm.'000000 AND korp='.$uu[4]; $tm=21;}
		                else if ($tm>10) { $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date='.$_POST["year"].$_POST["month"].$tm.'000000 AND korp='.$uu[4]; $tm=11;}
	                        else { $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$_POST["month"].$tm.'000000 OR date='.$_POST["year"].$_POST["month"].$tm.'120000) AND korp='.$uu[4]; $tm=0;}
	                       }
		            if ($_POST["otch"]==4)
		               if ($tm>9)
		                  {
		                   $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].$tm.'01000000 OR date='.$_POST["year"].$tm.'01120000) AND korp='.$uu[4];
    			           $dat='01-'.$tm.'-'.$_POST["year"].' 00:00';
		                  }
	                       else
	                          {
	                           $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND (date='.$_POST["year"].'0'.$tm.'01000000 OR date='.$_POST["year"].'0'.$tm.'01120000) AND korp='.$uu[4];
      			           $dat='01-0'.$tm.'-'.$_POST["year"].' 00:00';
      			          }      			    
	                    print '<tr align=center><td bgcolor=#111111 align=left><font class="dd">'.$dat.'</font></td>';
			    $a = mysql_query ($query,$i); 
                            //echo $query.' ('.$a.')';
	                    if ($a)
                            for ($l=1;$l<=200;$l++)
                                {
                                 $uy = mysql_fetch_row ($a);
                                 if ($uy == true)
                                    {
                                     //print '$l='.$l.'$tm='.$tm;
	                             if ($l>1) $yeap=1;
         	                     if ($uy[6]==0)
                                        {
                                         if (strstr ($uy[1],'температур') && strstr ($uy[1],'подающей')) $col[0]=$uy[7];
                                         if (strstr ($uy[1],'температур') && strstr ($uy[1],'обратной')) $col[1]=$uy[7];
                                         if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $col[2]=$uy[7];
                                         if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) $col[3]=$uy[7];
                                        }
      	                             if ($uy[6]==1)
      	       	                        {
               	                         if (strstr ($uy[1],'тепловой энергии')) if ($K[2]>0) $col[4]=$uy[7]*$K[2]; else $col[4]=0;
      	                                }
               	      	             if ($uy[6]==2)
                       	                {
                       	                 if ($K[3]>0) $col[5]=$uy[7]*$K[3]; else $col[5]=0;
               	      	                }
                                     if ($uy[6]==3)
                                        {
                                         if ($K[3]>0) $col[6]=$uy[7]*$K[4]; else $col[6]=0;
               	               	        }
                                     if ($uy[6]==4)
                                        {
       	                                 if (strstr ($uy[1],'значений давления'))  $col[7]=$uy[7];
                	                 if (strstr ($uy[1],'значений температуры')) $col[8]=$uy[7];
	                                 if (strstr ($uy[1],'массы'))  $col[9]=$uy[7];
         	               	        }
                                     if ($uy[6]==5)
                                        {
       	                                 if (strstr ($uy[1],'значений давления'))  $col[10]=$uy[7];
                	                 if (strstr ($uy[1],'значений температуры')) $col[11]=$uy[7];
	                                 if (strstr ($uy[1],'объема'))  if ($K[6]>0) $col[12]=$uy[7]*$K[6]; else $col[12]=0;
         	               	        }
                                     if ($uy[6]==6)
                                        {
       	                                 if (strstr ($uy[1],'значений давления'))  $col[13]=$uy[7];
                	                 if (strstr ($uy[1],'значений температуры')) $col[14]=$uy[7];
	                                 if (strstr ($uy[1],'объема'))  $col[15]=$uy[7];
         	               	        }
                       		     if ($uy[6]==7) $col[16]=$uy[7];                                            
                                    }
                                }
  			    for ($h=0;$h<17;$h++)
	                        {
                                 print '<td bgcolor=#111111 align=center><font class="dd">'.$col[$h].'</font></td>';
                                }
                            print '</tr>';
                            for ($h=0;$h<18;$h++) $col[$h]=0.0;
                           }
                      }
                   print '</tr>';
                  }
              }
         }
     }
}
//------------------------------------------------------------------------
else
{
$query = 'SELECT * FROM energy_supply WHERE id='.$_POST["source"];
$e = mysql_query ($query,$i);
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
    {        
     if ($_POST["idbuy"]==99) $query = 'SELECT * FROM buyers';
     else $query = 'SELECT * FROM buyers WHERE idx='.$_POST["idbuy"];
     $r = mysql_query ($query,$i);
     for ($j=1;$j<=100;$j++)
         {
          $uo = mysql_fetch_row ($r);
          if ($uo == true)
             {
              if ($_POST["idkor"]==99) $query = 'SELECT * FROM objects WHERE type<2';
              else $query = 'SELECT * FROM objects WHERE type<2 AND idkorp='.$_POST["idkor"];
              //echo $query;
              $t = mysql_query ($query,$i);
              for ($k=1;$k<=100;$k++)
                  {
                   $uu = mysql_fetch_row ($t);
                   if ($uu == true)
                      {
                       for ($h=0;$h<18;$h++) $col[$h]=0.0;
	               $zagl = '<tr><td colspan=5 bgcolor=#000088 align=center><font class="or1">'.$uo[1].' ['.$uu[1].']</font></td></tr>';
                       $query = 'SELECT SUM(K'.$ui[0].') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[4];
                       //echo $query;
                       $a = mysql_query ($query,$i); $uy = mysql_fetch_row ($a);
                       if ($uu[5]==0) { $uy=true;  $uy[0]=1; } // субарендатор
                       if ($uy == true && $uy[0]>0)
                          {
                           $K=$uy[0];
                           $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date<'.$_POST["year"].$_POST["month"].$_POST["day"].'000000 AND korp='.$uu[4].' AND source='.$ui[2].' ORDER BY date';
                           $a = mysql_query ($query,$i);
                           if ($a)
                           for ($l=1;$l<=200;$l++)
                               {
                                $uy = mysql_fetch_row ($a);
                                if ($uy == true)
                                   {
                                    if ($l==1)
	                               {
        	                        $tim=$uy[3];
                	                print $zagl;
                  		        //print '<tr><td bgcolor=#880000><font class="main">Название параметра</td><td bgcolor=#880000><font class="main">Тип</td><td bgcolor=#880000><font class="main">Дата</td><td bgcolor=#880000><font class="main">Корпус</td><td bgcolor=#880000><font class="main">Устройство</td><td bgcolor=#880000><font class="main">Ресурс</td><td bgcolor=#880000><font class="main">Значение</td></tr>';
                                    	if ($uy[6]==0) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Разность температур (С)</td><td bgcolor=#880000><font class="main">Тепловая мощность по магистрали (ГДж/ч)</td></tr>';
	     		                if ($uy[6]==1) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Значение температуры воды по подающей трубе (С)</td><td bgcolor=#880000><font class="main">Объемный расход воды по подающей трубе (м3)</td><td bgcolor=#880000><font class="main">Значение температуры воды по обратной трубе (С)</td><td bgcolor=#880000><font class="main">Объемный расход воды по обратной трубе (м3)</td></tr>';
        			        if ($uy[6]==2) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход воды (м3)</td></tr>';                                         	 	
                        	    	if ($uy[6]==3) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Объемный расход пара (м3)</td></tr>';
                                    	if ($uy[6]==4) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#880000><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#880000><font class="main">Массовый расход газа (кг/ч)</td></tr>';
				    	if ($uy[6]==5) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#880000><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#880000><font class="main">Объемный расход (м3)</td></tr>';
              			    	if ($uy[6]==6) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#880000><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#880000><font class="main">Объемный расход (м3)</td></tr>';
	              		    	if ($uy[6]==7) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Мощность (кВт)</td></tr>';        
	                               }
                                    $max=0;
                                    if ($uy[6]==0)
                                       {
                                        if (strstr ($uy[1],'Разность')) $col[0]=$uy[7];
                                        if (strstr ($uy[1],'мощность')) $col[1]=$uy[7];
                                        $max=2;
                                       }
      	                            if ($uy[6]==1)
      	                               {
 	                                if (strstr ($uy[1],'температуры воды по подающей'))  $col[0]=$uy[7];
                                        if (strstr ($uy[1],'расход воды по подающей')) $col[1]=$uy[7];
	                                if (strstr ($uy[1],'температуры воды по обратной'))  $col[2]=$uy[7];
                                        if (strstr ($uy[1],'расход воды по обратной')) $col[3]=$uy[7];
                                        $max=4;
      	                               }
   	                       	    if ($uy[6]==2) { $col[0]=$uy[7]; $max=1;}
            	               	    if ($uy[6]==3) { $col[0]=$uy[7]; $max=1;}
            	               	    if ($uy[6]==4)
          	               	       {
                                        if (strstr ($uy[1],'значение давления'))  $col[0]=$uy[7]; 
                                        if (strstr ($uy[1],'значение температуры')) $col[1]=$uy[7];
                                        if (strstr ($uy[1],'расход'))  $col[2]=$uy[7];
                                        $max=3;
              	               	       }
            	               	    if ($uy[6]==5)
            	               	       {
                                        if (strstr ($uy[1],'значение давления'))  $col[0]=$uy[7];
                                        if (strstr ($uy[1],'значение температуры')) $col[1]=$uy[7];
                                        if (strstr ($uy[1],'расход'))  $col[2]=$uy[7];
                                        $max=3;
            	               	       }
            	               	    if ($uy[6]==6)
            	               	       {
                                        if (strstr ($uy[1],'значение давления'))  $col[0]=$uy[7];
                                        if (strstr ($uy[1],'значение температуры')) $col[1]=$uy[7];
                                        if (strstr ($uy[1],'расход'))  $col[2]=$uy[7];
                                        $max=3;
            	                       }
   				    if ($uy[6]==7) { $col[0]=$uy[7]; $max=1;}
	                            if ($tim!=$uy[3])
                                   	{
                                         if ($l>1)
                                   	    {
                                             print '<tr align=center><td bgcolor=#111111 align=left><font class="dd">'.$uy[3].'</font></td>';
	                                    }
                                         for ($h=0;$h<$max;$h++)
                                       	     {
                                       	      print '<td bgcolor=#111111><font class="dd">'.$col[$h].'</font></td>';
                                             }
                                         print '</tr>';
                                         $tim=$uy[3];
                                         for ($h=0;$h<5;$h++) $col[$h]=0.0;
                                        }
                                    //$uy[$n]*$K;
                              	}
                           }
                      }
                   }                            
                }
             }
          print '</tr>';
         }
      }
   }
}
//------------------------------------------------------------------------
}
//-------------------------------------------------------
if ($_POST["otch"]==11)
{ 
 print '<tr><td bgcolor=#111111 width=120><font class="or1">Дата</font></td><td><font class="or1" bgcolor=#111111>Продолжительность (ч.)</font></td></tr>';
 $query = 'SELECT * FROM elect WHERE logik_id=\''.$_POST["idkon"].'\' ORDER BY date';
// echo $query;
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=100;$z++)
        {
         $ui = mysql_fetch_row ($e);
         if ($ui == true) 
            {
             print '<tr>';
             for ($n=1;$n<3;$n++)
                print '<td bgcolor=#111111><font class="dd">'.$ui[$n].'</font></td>';
             print '</tr>';
            }
        }
}
//-------------------------------------------------------
if ($_POST["otch"]==12)
{
 print '<tr><td bgcolor=#111111 width=120><font class="or1">Дата</font></td><td><font class="or1" bgcolor=#111111>Описание</font></td><td><font class="or1" bgcolor=#111111>Параметр</font></td></tr>';
 $query = 'SELECT * FROM event WHERE logik_id=\''.$_POST["idkon"].'\' ORDER BY date';
// echo $query;
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=100;$z++)
        {
         $ui = mysql_fetch_row ($e);
         if ($ui == true) 
            {
             print '<tr>';
             for ($n=1;$n<4;$n++)
                print '<td bgcolor=#111111><font class="dd">'.$ui[$n].'</font></td>';
             print '</tr>';
            }
        }
}
?>
</table></td></tr>
</table><br>
</td><tr>
</table>
</body>
</html>