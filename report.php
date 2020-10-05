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
<body bgcolor=#ffffff leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=center border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#ffffff>
<tr><td>
<table border=0 cellspacing=0 cellpadding=1 align=center width=100%>
<tr><td align=left width=100%>
<table border=0 align=center bgcolor=#ffffff>
<tr><td>
<table border=0 align=center bgcolor=#ffffff align=center>
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
print '<tr><td align=center><table border=0 bgcolor=#e6e6e6><tr><td colspan=2><font class="menu">Отчет по ';
if ($_POST["source"]==99) print 'потреблению всех энергоресурсов';
if ($_POST["source"]==0) print 'потреблению теплофикационной воды';
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
print '<tr><td align=center><font class="menu">Арендатор: </font><font class="down">';
if ($_POST["idbuy"]==99) print 'все арендаторы';
else
{
 $query = 'SELECT * FROM buyers WHERE idx='.$_POST["idbuy"];
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
 if ($ui == true) print $ui[1];
}
print '</td><td align=center><font class="menu">Корпус: </font><font class="down">';
if ($_POST["idkor"]==99) print 'все корпуса';
else
{
 $query = 'SELECT name FROM korp WHERE korp_id='.$_POST["idkor"];
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
 if ($ui == true) print $ui[0];
}
print '</td></tr></table></td></tr>';
print '<tr><td><table>';
//------------------------------------------------------------------------
if ($_POST["source"]==99)
{
 if ($_POST["idbuy"]==99) $query = 'SELECT * FROM buyers';
 else $query = 'SELECT * FROM buyers WHERE idx='.$_POST["idbuy"];
 $r = mysql_query ($query,$i);
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
                   for ($h=0;$h<18;$h++) $col[$h]=0.0;
                   $query = 'SELECT * FROM data WHERE type='.$_POST["otch"].' AND date<'.$_POST["year"].$_POST["month"].$_POST["day"].'000000 AND korp='.$uu[4].' ORDER BY date DESC';
//                  echo $query;
                   $a = mysql_query ($query,$i);
                   if ($a)
                   for ($l=1;$l<=1000;$l++)
                       {
                        $uy = mysql_fetch_row ($a);
                        if ($uy == true)
                           {
                            if ($l==1)
                               {
                                $tim=$uy[3];
                                print $zagl;
                                print '<tr><td bgcolor=#e6e6e6 width=110 align=center><font class="main">Время</td><td bgcolor=#880000 colspan=4 align=center><font class="main">Теплофикационная вода</td><td bgcolor=#880000 colspan=1 align=center><font class="main">Тепловая энергия</td><td bgcolor=#880000 colspan=1><font class="main">Пожарно-питьевая вода</td><td bgcolor=#880000 align=center><font class="main">Водяной пар</td><td bgcolor=#880000 colspan=3 align=center><font class="main">Природный газ</td><td bgcolor=#880000 colspan=3 align=center><font class="main">Сжатый воздух</td><td bgcolor=#880000 colspan=3 align=center><font class="main">Кислород</td><td bgcolor=#880000 colspan=1><font class="main">Электр. энергия</td></tr>';
 	                        print '<td bgcolor=#e6e6e6 align=center><font class="main"></td><td bgcolor=#e6e6e6><font class="main">Темп. под. трубе (С)</td><td bgcolor=#e6e6e6><font class="main">Темп. обр.трубе (м3)</td><td bgcolor=#e6e6e6><font class="main">Масса обр. трубе (С)</td><td bgcolor=#e6e6e6><font class="main">Масса под.трубе (м3)</td>';
                                print '<td bgcolor=#e6e6e6 align=center><font class="main">Тепловая энергия (ГКал)</td>';
                	        print '<td bgcolor=#e6e6e6 align=center><font class="main">Расход воды (м3)</td>';
                        	print '<td bgcolor=#e6e6e6 align=center><font class="main">Расход пара (м3)</td>';
                                print '<td bgcolor=#e6e6e6 align=center><font class="main">Давление (МПа)</td><td bgcolor=#e6e6e6 align=center><font class="main">Темпе- ратура (С)</td><td bgcolor=#e6e6e6 align=center><font class="main">Массовый расход (кг/ч)</td>';
				print '<td bgcolor=#e6e6e6 align=center><font class="main">Давление (МПа)</td><td bgcolor=#e6e6e6 align=center><font class="main">Темпе- ратура (С)</td><td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
              			print '<td bgcolor=#e6e6e6 align=center><font class="main">Давление (МПа)</td><td bgcolor=#e6e6e6 align=center><font class="main">Темпе- ратура (С)</td><td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
	              		print '<td bgcolor=#e6e6e6 align=center><font class="main">Мощность (кВт)</td></tr>';
                               }
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
      	                        //$col[5]=$uy[7];
              	               }
                       	    if ($uy[6]==3)
                       	       {
                       	        if ($K[3]>0) $col[6]=$uy[7]*$K[4]; else $col[6]=0;
      	                        //$col[6]=$uy[7];
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
              		    if ($uy[6]==7) 
				{
			 	 $col[16]=$uy[7];				 
				}
                            //$uy[$n]*$K;

                            if ($tim!=$uy[3])
                               {
                                if ($l>1)
                                   {
                                    print '<tr align=center><td bgcolor=#e6e6e6 align=left><font class="dd">'.$uy[3].'</font></td>';
                                   }
                                for ($h=0;$h<17;$h++)
	                           {
                                    print '<td bgcolor=#e6e6e6 align=center><font class="dd">'.$col[$h].'</font></td>';
                                   }
                                print '</tr>';
                                $tim=$uy[3];
                                for ($h=0;$h<18;$h++) $col[$h]=0.0;
                               }
                         }
                      }
                   print '</tr>';
                   } //
                  }
              }
        }
    }
}
//------------------------------------------------------------------------
else
{
$query = 'SELECT * FROM energy_supply WHERE id='.$_POST["source"];
//echo $query;
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
                                    	if ($uy[6]==0) print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Разность температур (С)</td><td bgcolor=#880000><font class="main">Тепловая мощность по магистрали (ГКал)</td></tr>';
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
   				    if ($uy[6]==7) 
					{ 
					 //if (strstr ($uy[1],'часовой'))  
				         $col[0]=$uy[7]; 
					 $max=1;
					}
	                            if ($tim!=$uy[3])
                                   	{
                                         if ($l>1)
                                   	    {
                                             print '<tr align=center><td bgcolor=#e6e6e6 align=left><font class="dd">'.$uy[3].'</font></td>';
	                                    }
                                         for ($h=0;$h<$max;$h++)
                                       	     {
                                       	      print '<td bgcolor=#e6e6e6><font class="dd">'.$col[$h].'</font></td>';
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
 print '<tr><td align=center><table border=0><tr><td colspan=2  bgcolor=#e0e0e0><font class="menu">Отчет по перерывам электропитания узла учета</font></td></tr>';
 print '<tr><td bgcolor=#e6e6e6 width=120><font class="or1">Дата</font></td><td><font class="or1" bgcolor=#e6e6e6>Продолжительность (ч.)</font></td></tr>';
 $query = 'SELECT * FROM elect WHERE logik_id LIKE \'%'.$_POST["idkon"][0].$_POST["idkon"][1].$_POST["idkon"][2].$_POST["idkon"][3].$_POST["idkon"][4].'%\' ORDER BY date DESC';
// echo $query;
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=100;$z++)
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
}
//-------------------------------------------------------
if ($_POST["otch"]==12)
{
 print '<tr><td bgcolor=#e6e6e6 width=120><font class="or1">Дата</font></td><td><font class="or1" bgcolor=#e6e6e6>Описание</font></td><td><font class="or1" bgcolor=#e6e6e6>Параметр</font></td></tr>';
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
                print '<td bgcolor=#e6e6e6><font class="dd">'.$ui[$n].'</font></td>';
             print '</tr>';
            }
        }
}
//-------------------------------------------------------
if ($_POST["otch"]>20)
{
$arr = get_defined_vars();
print '<tr><td align=center><table border=0 bgcolor=#e6e6e6><tr><td colspan=2><font class="menu">Отчет по узлу учета ';
if ($_POST["source"]==0) print 'теплофикационной воды';
if ($_POST["source"]==1) print 'тепловой энергии';
if ($_POST["source"]==2) print 'пожарно-питьевой воды';
if ($_POST["source"]==3) print 'водяного пара';
if ($_POST["source"]==4) print 'природного газа';
if ($_POST["source"]==5) print 'сжатого воздуха';
if ($_POST["source"]==6) print 'кислорода';
if ($_POST["source"]==7) print 'электрической энергии';
print '</font><font class="menu"> на расчетное время </font><font class="down">';
print $_POST["day"].'/'.$_POST["month"].'/'.$_POST["year"]; print '</td></tr>';
print '<tr><td colspan=1 align=center><font class="menu">Тип отчета: </font><font class="down">';
if ($arr["otch"]==21) print "часовой";
if ($arr["otch"]==22) print "суточный";
if ($arr["otch"]==23) print "";
if ($arr["otch"]==24) print "по месяцам";
if ($arr["otch"]==25) print "декадный";
print '</td><td colspan=1 align=center><font class="menu">Корпус: </font><font class="down">';

if ($_POST["idkorp"]=='')
{
 $query = 'SELECT * FROM uzel WHERE id='.$_POST["uzel"];
 $e = mysql_query ($query,$i); 
 if ($e) $ui = mysql_fetch_row ($e);
 $_POST["idkorp"]=$ui[3];
}

if ($_POST["idkor"]==99) print 'все корпуса';
else
{
 $query = 'SELECT name FROM korp WHERE korp_id='.$_POST["idkorp"];
 $e = mysql_query ($query,$i); 
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) print $ui[0];
}
print '</td></tr></table></td></tr>';
print '<tr><td align=center><table>';
//------------------------------------------------------------------------
if ($arr["source"]==0) { $max=5; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Значение температуры воды по подающей трубе (С)</td><td bgcolor=#e6e6e6><font class="main">Значение температуры воды по обратной трубе (С)</td><td bgcolor=#e6e6e6><font class="main">Массовый расход воды по подающей трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Массовый расход воды по обратной трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса потерь воды (т.)</td></tr>'; }
if ($arr["source"]==1) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Тепловая мощность по магистрали (ГКал)</td></tr>'; }
if ($arr["source"]==2) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход воды (м3)</td></tr>'; }
if ($arr["source"]==3) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход пара (м3)</td></tr>'; }
if ($arr["source"]==4) { $max=3; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#e6e6e6><font class="main">Объемный расход газа (м3/ч)</td></tr>'; }
if ($arr["source"]==5) { $max=3; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>'; }
if ($arr["source"]==6) { $max=3; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>'; }
if ($arr["source"]==7) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Мощность (кВт)</td></tr>'; }

$x=0; $otch=$arr["otch"]-20; $nx=1; $nn=1;
$today=getdate ();

if ($arr["otch"]==21) { $mx=$today[hours]; $mn=0; $nx=4; $nn=1; }
if ($arr["otch"]==22) { $mx=$arr["day"]; $mn=1; $nx=2; $nn=1; }
if ($arr["otch"]==23) { $mx=30; $mn=1; }
if ($arr["otch"]==24) { $mx=$arr["month"]; $mn=1; $nx=2; $nn=1;}
if ($arr["otch"]==25) { $mx=23; $mn=0; }

if ($arr["day"]>1) 
	$day=$arr["day"]-1; 
else if ($arr["otch"]==22) 
	{ 
	 $day=30;  $mx=$day; 
	 if ($arr["month"]>1) 
	    $arr["month"]=$arr["month"]-1;
	}
if ($arr["month"]>1) $month=$arr["month"];
$month=''.$month;
$mx=$mx+0;
if ($arr["otch"]==22 && $arr["month"]<10 && $arr["day"]==1) $arr["month"]='0'.$arr["month"];
for ($h=0;$h<8;$h++) $prcol[$h]=-1;
$_POST["month"]=$arr["month"]; 
if ($arr["otch"]==22)  $_POST["day"]=$mx;

if ($today["hour"]<10) $hour='0'.$today["hours"]; else $hour=$today["hours"];
if ($today["mday"]<10) $today["mday"]='0'.$today["mday"];
if ($arr["otch"]==22 || $arr["otch"]==24)  $hour='00'; 
if ($today["mon"]<10) $today["mon"]='0'.$today["mon"];
$edate=$today["year"].$today["mon"].$today["mday"].$hour.'0000';

if ($_POST["uzel"])
{
 if ($arr["otch"]==21) { $mx=$today[ehour]; $mn=0; $nx=4; $nn=1; }
 if ($arr["otch"]==22) { $mx=$arr["eday"]; $mn=1; $nx=2; $nn=1; }
 if ($arr["otch"]==24) { $mx=$arr["emonth"]; $mn=1; $nx=2; $nn=1;}
 if ($arr["otch"]==25) { $mx=23; $mn=0; }

 $arr["year"]=$_POST["year"];
// if ($_POST["month"]>10) 
$arr["month"]=$_POST["month"];
// else  $arr["month"]='0'.$_POST["month"];
 if ($_POST["day"]>10) 
$arr["day"]=$_POST["day"];
// else  $arr["day"]='0'.$_POST["day"];

 if ($_POST["eday"]<10) $_POST["eday"]='0'.$_POST["eday"];
 if ($_POST["emonth"]<10) $_POST["emonth"]='0'.$_POST["emonth"];
 $edate=$_POST["year"].$_POST["emonth"].$_POST["eday"].'000000';
}

for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     if ($arr["otch"]==24) { $mx=12; if ($tn==1 && $tm==12) $arr["year"]--; }
     if ($arr["otch"]==22) 
	{ 
	 $mx=31; 
	 if ($tn<2 && $tm==$mx)
		{ 
		 if ($arr["month"]>1) { $arr["month"]--; if ($arr["month"]<10) $arr["month"]='0'.$arr["month"]; } else { $arr["month"]=12; $arr["year"]--;}
		 if (!checkdate ($arr["month"],31,$arr["year"])) { $mx=30; $tm=$mx; }
		 if (!checkdate ($arr["month"],30,$arr["year"])) { $mx=29; $tm=$mx; }
		 if (!checkdate ($arr["month"],29,$arr["year"])) { $mx=28; $tm=$mx; }
		 if (!checkdate ($arr["month"],28,$arr["year"])) { $mx=27; $tm=$mx; }
		}
	}
     if ($arr["otch"]==21) 
	{ 
	 $mx=23; 
	 if ($tn<4 && $tm==23) 
	    { 
	     if ($arr["day"]>1) 
		{ 
		 $arr["day"]--; 
		 if ($arr["day"]<10) $arr["day"]='0'.$arr["day"]; 
		} 
	     else 
		{
		 $arr["day"]=31;
		 $arr["hour"]=23; 
		 if ($arr["month"]>1) $arr["month"]--;
		 else { $arr["month"]=12; $arr["year"]--; }
		 if (!checkdate ($arr["month"],31,$arr["year"])) $arr["day"]=30;
		 if (!checkdate ($arr["month"],30,$arr["year"])) $arr["day"]=29;
		 if (!checkdate ($arr["month"],29,$arr["year"])) $arr["day"]=28;

		 if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		}
	     }
	}
    if ($tm<10) $tm='0'.$tm;
    if ($arr["otch"]==21)
       {
	$date1[$x]=$arr["year"].'-'.$arr["month"].'-'.$arr["day"].' '.$tm.':00:00';
        $dat[$x]=$arr["day"].'-'.$arr["month"].'-'.$arr["year"].' '.$tm.'.00';
	$dats[$x]=$arr["year"].$arr["month"].$arr["day"].$tm.'0000';
       }
    if ($arr["otch"]==22)
       {
	$date1[$x]=$arr["year"].'-'.$arr["month"].'-'.$tm.' 00:00:00';
	$date2[$x]=$arr["year"].'-'.$arr["month"].'-'.$tm.' 12:00:00';
	$dat[$x]=$tm.'-'.$arr["month"].'-'.$arr["year"].' 00.00';
	$dats[$x]=$arr["year"].$arr["month"].$tm.'000000';
       }
    if ($arr["otch"]==24)
       {
	$date1[$x]=$arr["year"].'-'.$tm.'-01 00:00:00';
	$date2[$x]=$arr["year"].'-'.$tm.'-01 12:00:00';
        $dat[$x]='01-'.$tm.'-'.$arr["year"].' 00.00';
	$dats[$x]=$arr["year"].$tm.'01000000';
	}
     $x++;
    }
 $maxx=$x;
 if ($arr["otch"]==21) $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
 if ($arr["otch"]==22) $bdate=$arr["year"].$arr["month"].'01000000';
 if ($arr["otch"]==24) $bdate=$arr["year"].$arr["month"].'01000000';

 $query = 'SELECT * FROM data WHERE type='.$otch.' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
 if ($arr["source"]==7 || $arr["idkorp"]==101) 
    {
     if ($arr["typ"]==1 || $arr["typ"]=='') $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4].$arr["idkon"][0].$arr["idkon"][1];
     if ($arr["typ"]==2) $query = $query . ' AND device='.$arr["idkon"];
    }
 else $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4];
// echo $query.'<br>';

 for ($o=0;$o<=$maxx; $o++)  for ($h=0;$h<8;$h++) $col[$o][$h]=-1;
 $a = mysql_query ($query,$i); 
 if ($a)
 for ($l=1;$l<=9200;$l++)
     {
      $uy = mysql_fetch_row ($a);
      if ($uy == true)
         {
          if ($arr["source"]==0)
             {
              if (strstr ($uy[1],'подающей') && strstr ($uy[1],'емператур'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
              if (strstr ($uy[1],'обратной') && strstr ($uy[1],'емператур'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'подающей') && strstr ($uy[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][2]=$uy[7];
              if (strstr ($uy[1],'обратной') && strstr ($uy[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][3]=$uy[7];
             }
          if ($arr["source"]==1)
             {
              if (strstr ($uy[1],'энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
             }
          if ($arr["source"]==2) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
          if ($arr["source"]==3) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
	  if ($arr["source"]==4)
	     {
              if (strstr ($uy[1],'давления'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3]) || strstr($date2[$o],$uy[3])) $col[$o][0]=$uy[7]; 
              if (strstr ($uy[1],'температуры')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])  || strstr($date2[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3]) || strstr($date2[$o],$uy[3])) $col[$o][2]=$uy[7];
	     }
	  if ($arr["source"]==5)
	     {
              if (strstr ($uy[1],'давления'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
              if (strstr ($uy[1],'температуры')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][2]=$uy[7];
	     }
	  if ($arr["source"]==6)
	     {
              if (strstr ($uy[1],'давления')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
              if (strstr ($uy[1],'температуры')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][2]=$uy[7];
	     }
	  if ($arr["source"]==7)  
	     {
	      for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
	     }	    
         }
     }
  for ($x=0;$x<$maxx;$x++)
      {
       print '<tr align=center><td bgcolor=#e6e6e6 align=left><font class="dd">'.$dat[$x].'</font></td>';
       for ($h=0;$h<$max;$h++)
           { 
            print '<td bgcolor=#ffffff><font class="dd">'; 
	    if ($arr["source"]==0 && $h==4) $col[$x][$h]=$col[$x][2]-$col[$x][3];
	    //if ($prcol[$h]!=-1 && $col[$x][$h]==-1 && $arr["otch"]==21 && $arr["source"]<4) printf ("%.2f",$prcol[$h]);
	    if ($col[$x][$h]==-1 && $arr["source"]<7)
	       {
		$typ=$arr["otch"]-20;
		if ($arr["source"]==0)
		   {		    
		    if ($tm<10) $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%подающей%\')';
		    else        $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%подающей%\')';
			$t = mysql_query ($query,$i);		
			if ($t)
			   {
			    $ut = mysql_fetch_row ($t);
			    if ($ut == true) $dtvhd=$ut[7];
			   }
		    if ($tm<10) $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%обратной%\')';
		    else        $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%обратной%\')';
			$t = mysql_query ($query,$i);		
			if ($t)
			   {
			    $ut = mysql_fetch_row ($t);
			    if ($ut == true) $dtvhd0=$ut[7];
			   }
		   }
		else
		   {			
		    if ($tm<10) $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' OR name LIKE \'%расход%\' OR name LIKE \'%мощность%\')';
		    else        $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' OR name LIKE \'%расход%\' OR name LIKE \'%мощность%\')';
			$t = mysql_query ($query,$i);		
			if ($t)
			   {
			    $ut = mysql_fetch_row ($t);
			    if ($ut == true) $dtvhd=$ut[7];
			   }
		   }
		 $query = 'SELECT P14 FROM uzel WHERE idkon=\''.$arr["idkon"].'\'';
		 $t = mysql_query ($query,$i);
		 if ($t)
		   {
		    $ut = mysql_fetch_row ($t);
		    if ($ut == true) $dtp14=$ut[0];
		   }		    
		 if ($arr["source"]==0 && $h==2) printf ("%.2f*",$dtp14*$dtvhd);
		 if ($arr["source"]==0 && $h==3) printf ("%.2f*",$dtp14*$dtvhd0);
		 if ($arr["source"]==0 && $h==4) printf ("%.2f*",$dtp14*($dtvhd-$dtvhd0));
		 if ($arr["source"]==1 && $h==0) printf ("%.2f*",$dtp14*$dtvhd);
		 if ($arr["source"]==2 && $h==0) printf ("%.2f*",$dtp14*$dtvhd);
		 if ($arr["source"]==5 && $h==2) printf ("%.2f*",$dtp14*$dtvhd);
		}	    
 	    if ($col[$x][$h]!=-1) 
	       { 
		 $prcol[$h]=$col[$x][$h];
		 if ($arr["source"]>3 && $h==0)
		    printf ("%.3f",$col[$x][$h]); 
		 else printf ("%.2f",$col[$x][$h]);
		}
	    print '</font></td>';
	  }
       print '</tr>';  
      }
}





if ($_POST["otch"]>40)
{
$arr = get_defined_vars();
 $query = 'SELECT * FROM uzel WHERE id='.$_POST["uzel"];
 $e = mysql_query ($query,$i); 
 if ($e) $ui = mysql_fetch_row ($e);
 $_POST["idkorp"]=$ui[3];
 $_POST["source"]=$ui[2];

print '<tr><td align=center><table border=0 bgcolor=#e6e6e6><tr><td colspan=2><font class="menu">Отчет по узлу учета ';
if ($_POST["source"]==0) print 'теплофикационной воды';
if ($_POST["source"]==1) print 'тепловой энергии';
if ($_POST["source"]==2) print 'пожарно-питьевой воды';
if ($_POST["source"]==3) print 'водяного пара';
if ($_POST["source"]==4) print 'природного газа';
if ($_POST["source"]==5) print 'сжатого воздуха';
if ($_POST["source"]==6) print 'кислорода';
if ($_POST["source"]==7) print 'электрической энергии';
print '</font><font class="menu"> на расчетное время </font><font class="down">';
print $_POST["day"].'/'.$_POST["month"].'/'.$_POST["year"]; print '</td></tr>';
print '<tr><td colspan=1 align=center><font class="menu">Тип отчета: </font><font class="down">';
if ($arr["otch"]==41) print "часовой";
if ($arr["otch"]==42) print "суточный";
if ($arr["otch"]==44) print "по месяцам";
if ($arr["otch"]==45) print "декадный";
print '</td><td colspan=1 align=center><font class="menu">Корпус: </font><font class="down">';

 $query = 'SELECT name FROM korp WHERE korp_id='.$_POST["idkorp"];
 $e = mysql_query ($query,$i); 
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) print $ui[0];

print '</td></tr></table></td></tr>';
print '<tr><td align=center><table>';
//------------------------------------------------------------------------
if ($arr["source"]==0) { $max=5; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Значение температуры воды по подающей трубе (С)</td><td bgcolor=#e6e6e6><font class="main">Значение температуры воды по обратной трубе (С)</td><td bgcolor=#e6e6e6><font class="main">Массовый расход воды по подающей трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Массовый расход воды по обратной трубе (т.)</td><td bgcolor=#e6e6e6><font class="main">Масса потерь воды (т.)</td></tr>'; }
if ($arr["source"]==1) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Тепловая мощность по магистрали (ГКал)</td></tr>'; }
if ($arr["source"]==2) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход воды (м3)</td></tr>'; }
if ($arr["source"]==3) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Объемный расход пара (м3)</td></tr>'; }
if ($arr["source"]==4) { $max=3; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#e6e6e6><font class="main">Объемный расход газа (м3/ч)</td></tr>'; }
if ($arr["source"]==5) { $max=3; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>'; }
if ($arr["source"]==6) { $max=3; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение давления (МПа)</td><td bgcolor=#e6e6e6><font class="main">Измеренное значение температуры (С)</td><td bgcolor=#e6e6e6><font class="main">Объемный расход (м3)</td></tr>'; }
if ($arr["source"]==7) { $max=1; print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Мощность (кВт)</td></tr>'; }

$x=0; $otch=$arr["otch"]-20; $nx=1; $nn=1;
$today=getdate ();

if ($arr["otch"]==41) { $mx=$today[hours]; $mn=0; $nx=4; $nn=1; }
if ($arr["otch"]==42) { $mx=$arr["day"]; $mn=1; $nx=2; $nn=1; }
if ($arr["otch"]==44) { $mx=$arr["month"]; $mn=1; $nx=2; $nn=1;}
if ($arr["otch"]==45) { $mx=23; $mn=0; }

if ($arr["day"]>1) 
	$day=$arr["day"]-1; 
else if ($arr["otch"]==22) 
	{ 
	 $day=30;  $mx=$day; 
	 if ($arr["month"]>1) 
	    $arr["month"]=$arr["month"]-1;
	}
if ($arr["month"]>1) $month=$arr["month"];
$month=''.$month;
$mx=$mx+0;
if ($arr["otch"]==22 && $arr["month"]<10 && $arr["day"]==1) $arr["month"]='0'.$arr["month"];
for ($h=0;$h<8;$h++) $prcol[$h]=-1;
$_POST["month"]=$arr["month"]; 
if ($arr["otch"]==22)  $_POST["day"]=$mx;

if ($today["hour"]<10) $hour='0'.$today["hours"]; else $hour=$today["hours"];
if ($today["mday"]<10) $today["mday"]='0'.$today["mday"];
if ($arr["otch"]==22 || $arr["otch"]==24)  $hour='00'; 
if ($today["mon"]<10) $today["mon"]='0'.$today["mon"];
$edate=$today["year"].$today["mon"].$today["mday"].$hour.'0000';

if ($_POST["uzel"])
{
 if ($arr["otch"]==21) { $mx=$today[ehour]; $mn=0; $nx=4; $nn=1; }
 if ($arr["otch"]==22) { $mx=$arr["eday"]; $mn=1; $nx=2; $nn=1; }
 if ($arr["otch"]==24) { $mx=$arr["emonth"]; $mn=1; $nx=2; $nn=1;}
 if ($arr["otch"]==25) { $mx=23; $mn=0; }

 $arr["year"]=$_POST["year"];
// if ($_POST["month"]>10) 
$arr["month"]=$_POST["month"];
// else  $arr["month"]='0'.$_POST["month"];
 if ($_POST["day"]>10) 
$arr["day"]=$_POST["day"];
// else  $arr["day"]='0'.$_POST["day"];

 if ($_POST["eday"]<10) $_POST["eday"]='0'.$_POST["eday"];
 if ($_POST["emonth"]<10) $_POST["emonth"]='0'.$_POST["emonth"];
 $edate=$_POST["year"].$_POST["emonth"].$_POST["eday"].'000000';
}

for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     if ($arr["otch"]==24) { $mx=12; if ($tn==1 && $tm==12) $arr["year"]--; }
     if ($arr["otch"]==22) 
	{ 
	 $mx=31; 
	 if ($tn<2 && $tm==$mx)
		{ 
		 if ($arr["month"]>1) { $arr["month"]--; if ($arr["month"]<10) $arr["month"]='0'.$arr["month"]; } else { $arr["month"]=12; $arr["year"]--;}
		 if (!checkdate ($arr["month"],31,$arr["year"])) { $mx=30; $tm=$mx; }
		 if (!checkdate ($arr["month"],30,$arr["year"])) { $mx=29; $tm=$mx; }
		 if (!checkdate ($arr["month"],29,$arr["year"])) { $mx=28; $tm=$mx; }
		 if (!checkdate ($arr["month"],28,$arr["year"])) { $mx=27; $tm=$mx; }
		}
	}
     if ($arr["otch"]==21) 
	{ 
	 $mx=23; 
	 if ($tn<4 && $tm==23) 
	    { 
	     if ($arr["day"]>1) 
		{ 
		 $arr["day"]--; 
		 if ($arr["day"]<10) $arr["day"]='0'.$arr["day"]; 
		} 
	     else 
		{
		 $arr["day"]=31;
		 $arr["hour"]=23; 
		 if ($arr["month"]>1) $arr["month"]--;
		 else { $arr["month"]=12; $arr["year"]--; }
		 if (!checkdate ($arr["month"],31,$arr["year"])) $arr["day"]=30;
		 if (!checkdate ($arr["month"],30,$arr["year"])) $arr["day"]=29;
		 if (!checkdate ($arr["month"],29,$arr["year"])) $arr["day"]=28;

		 if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		}
	     }
	}
    if ($tm<10) $tm='0'.$tm;
    if ($arr["otch"]==21)
       {
	$date1[$x]=$arr["year"].'-'.$arr["month"].'-'.$arr["day"].' '.$tm.':00:00';
        $dat[$x]=$arr["day"].'-'.$arr["month"].'-'.$arr["year"].' '.$tm.'.00';
	$dats[$x]=$arr["year"].$arr["month"].$arr["day"].$tm.'0000';
       }
    if ($arr["otch"]==22)
       {
	$date1[$x]=$arr["year"].'-'.$arr["month"].'-'.$tm.' 00:00:00';
	$date2[$x]=$arr["year"].'-'.$arr["month"].'-'.$tm.' 12:00:00';
	$dat[$x]=$tm.'-'.$arr["month"].'-'.$arr["year"].' 00.00';
	$dats[$x]=$arr["year"].$arr["month"].$tm.'000000';
       }
    if ($arr["otch"]==24)
       {
	$date1[$x]=$arr["year"].'-'.$tm.'-01 00:00:00';
	$date2[$x]=$arr["year"].'-'.$tm.'-01 12:00:00';
        $dat[$x]='01-'.$tm.'-'.$arr["year"].' 00.00';
	$dats[$x]=$arr["year"].$tm.'01000000';
	}
     $x++;
    }
 $maxx=$x;
 if ($arr["otch"]==21) $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
 if ($arr["otch"]==22) $bdate=$arr["year"].$arr["month"].'01000000';
 if ($arr["otch"]==24) $bdate=$arr["year"].$arr["month"].'01000000';

 $query = 'SELECT * FROM data WHERE type='.$otch.' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
 if ($arr["source"]==7 || $arr["idkorp"]==101) 
    {
     if ($arr["typ"]==1 || $arr["typ"]=='') $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4].$arr["idkon"][0].$arr["idkon"][1];
     if ($arr["typ"]==2) $query = $query . ' AND device='.$arr["idkon"];
    }
 else $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4];
// echo $query.'<br>';

 for ($o=0;$o<=$maxx; $o++)  for ($h=0;$h<8;$h++) $col[$o][$h]=-1;
 $a = mysql_query ($query,$i); 
 if ($a)
 for ($l=1;$l<=9200;$l++)
     {
      $uy = mysql_fetch_row ($a);
      if ($uy == true)
         {
          if ($arr["source"]==0)
             {
              if (strstr ($uy[1],'подающей') && strstr ($uy[1],'емператур'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
              if (strstr ($uy[1],'обратной') && strstr ($uy[1],'емператур'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'подающей') && strstr ($uy[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][2]=$uy[7];
              if (strstr ($uy[1],'обратной') && strstr ($uy[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][3]=$uy[7];
             }
          if ($arr["source"]==1)
             {
              if (strstr ($uy[1],'энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
             }
          if ($arr["source"]==2) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
          if ($arr["source"]==3) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
	  if ($arr["source"]==4)
	     {
              if (strstr ($uy[1],'давления'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3]) || strstr($date2[$o],$uy[3])) $col[$o][0]=$uy[7]; 
              if (strstr ($uy[1],'температуры')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])  || strstr($date2[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3]) || strstr($date2[$o],$uy[3])) $col[$o][2]=$uy[7];
	     }
	  if ($arr["source"]==5)
	     {
              if (strstr ($uy[1],'давления'))  for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
              if (strstr ($uy[1],'температуры')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][2]=$uy[7];
	     }
	  if ($arr["source"]==6)
	     {
              if (strstr ($uy[1],'давления')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
              if (strstr ($uy[1],'температуры')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][1]=$uy[7];
              if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][2]=$uy[7];
	     }
	  if ($arr["source"]==7)  
	     {
	      for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $col[$o][0]=$uy[7];
	     }	    
         }
     }
  for ($x=0;$x<$maxx;$x++)
      {
       print '<tr align=center><td bgcolor=#e6e6e6 align=left><font class="dd">'.$dat[$x].'</font></td>';
       for ($h=0;$h<$max;$h++)
           { 
            print '<td bgcolor=#ffffff><font class="dd">'; 
	    if ($arr["source"]==0 && $h==4) $col[$x][$h]=$col[$x][2]-$col[$x][3];
	    //if ($prcol[$h]!=-1 && $col[$x][$h]==-1 && $arr["otch"]==21 && $arr["source"]<4) printf ("%.2f",$prcol[$h]);
	    if ($col[$x][$h]==-1 && $arr["source"]<7)
	       {
		$typ=$arr["otch"]-20;
		if ($arr["source"]==0)
		   {		    
		    if ($tm<10) $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%подающей%\')';
		    else        $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%подающей%\')';
			$t = mysql_query ($query,$i);		
			if ($t)
			   {
			    $ut = mysql_fetch_row ($t);
			    if ($ut == true) $dtvhd=$ut[7];
			   }
		    if ($tm<10) $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%обратной%\')';
		    else        $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%обратной%\')';
			$t = mysql_query ($query,$i);		
			if ($t)
			   {
			    $ut = mysql_fetch_row ($t);
			    if ($ut == true) $dtvhd0=$ut[7];
			   }
		   }
		else
		   {			
		    if ($tm<10) $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' OR name LIKE \'%расход%\' OR name LIKE \'%мощность%\')';
		    else        $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$x].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' OR name LIKE \'%расход%\' OR name LIKE \'%мощность%\')';
			$t = mysql_query ($query,$i);		
			if ($t)
			   {
			    $ut = mysql_fetch_row ($t);
			    if ($ut == true) $dtvhd=$ut[7];
			   }
		   }
		 $query = 'SELECT P14 FROM uzel WHERE idkon=\''.$arr["idkon"].'\'';
		 $t = mysql_query ($query,$i);
		 if ($t)
		   {
		    $ut = mysql_fetch_row ($t);
		    if ($ut == true) $dtp14=$ut[0];
		   }		    
		 if ($arr["source"]==0 && $h==2) printf ("%.2f*",$dtp14*$dtvhd);
		 if ($arr["source"]==0 && $h==3) printf ("%.2f*",$dtp14*$dtvhd0);
		 if ($arr["source"]==0 && $h==4) printf ("%.2f*",$dtp14*($dtvhd-$dtvhd0));
		 if ($arr["source"]==1 && $h==0) printf ("%.2f*",$dtp14*$dtvhd);
		 if ($arr["source"]==2 && $h==0) printf ("%.2f*",$dtp14*$dtvhd);
		 if ($arr["source"]==5 && $h==2) printf ("%.2f*",$dtp14*$dtvhd);
		}	    
 	    if ($col[$x][$h]!=-1) 
	       { 
		 $prcol[$h]=$col[$x][$h];
		 if ($arr["source"]>3 && $h==0)
		    printf ("%.3f",$col[$x][$h]); 
		 else printf ("%.2f",$col[$x][$h]);
		}
	    print '</font></td>';
	  }
       print '</tr>';  
      }
}

?>
</table></td></tr>
<tr><td>
<table border=0 align=center bgcolor=#ffffff align=center>
<?php
if ($_POST["otch"]>20)
   {
    print '<tr><td><img border=0 src="charts/barplots.php?source='.$_POST["source"].'&idkorp='.$arr["idkorp"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'&idkon='.$arr["idkon"].'&typ='.$_POST["typ"].'"></td></tr>';
    if (($arr["source"]==0 || $arr["source"]==4 || $arr["source"]==5 || $arr["source"]==6) && $_POST["otch"]<4)
	 print '<tr><td><img border=0 src="charts/xyplots5.php?source='.$_POST["source"].'&idkorp='.$arr["idkorp"].'&idbuy='.$_POST["idbuy"].'&otch='.$_POST["otch"].'&date='.$_POST["year"].$_POST["month"].$_POST["day"].'&year='.$_POST["year"].'&month='.$_POST["month"].'&day='.$_POST["day"].'&idkon='.$arr["idkon"].'"></td></tr>';
   }
?>
</table><br>
</td><tr>
</table><br>
</td><tr>
</table>
</body>
</html>