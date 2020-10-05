<?php include("config/local.php"); ?> 
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="shablon.css" type="text/css">
<title>detail</title></head>
<body align=left bgcolor=black leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=left border=0 cellspacing=0 cellpadding=1 width=100% bgcolor=#000000>
<tr><td>
<?php
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $arr = get_defined_vars();
 $x=0; $y=0;
 $query = 'SELECT * FROM buyers WHERE caption=\''.$arr["idbuy"].'\'';
 $r = mysql_query ($query,$i);
 $uo = mysql_fetch_row ($r);
 if ($uo == true) $buy=$uo[0];
 print '<tr>';
 print '<td bgcolor=#880000><font class="main">Название</font></td>';
 print '<td bgcolor=#880000><font class="main">Корпус</font></td>';
 print '<td bgcolor=#880000><font class="main">Тип</font></td>';
 print '<td bgcolor=#880000><font class="main">Тип помещения</td><td bgcolor=#880000><font class="main">Площадь</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Масса (кг)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Тепловая энергия (ГДж/ч)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Расход воды (м3)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Расход пара (м3)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Массовый расход (кг/ч)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
 print '<td bgcolor=#880000 align=center><font class="main">Мощность (кВт)</td></tr>';

 $source=$ut[2]+1;
 if ($arr["idkor"]==99) $query = 'SELECT * FROM objects WHERE type!=1 AND idbuy='.$buy;
 else $query = 'SELECT * FROM objects WHERE type!=1 AND idbuy='.$buy.' AND idkorp='.$uu[1];
 $a = mysql_query ($query,$i);
 for ($p=1;$p<=500;$p++)
     {
      $uu = mysql_fetch_row ($a);
      if ($uu == true)
         {
  	  print '<tr>';
	  print '<td><font class="dd">'.$uu[1].'</font></td>';
          print '<td><font class="dd">';
          $query = 'SELECT name FROM korp WHERE korp_id='.'\''. $uu[4].'\'';
          $p = mysql_query ($query,$i); $up = mysql_fetch_row ($p);
          if ($up == true) print $up[0];
          else print 'Unknown'; print '</font></td>';
	  print '<td><font class="dd">'; 
          if ($uu[5]=='1') print 'Корпус ';
          if ($uu[5]=='2') print 'Помещение ';
          if ($uu[5]=='3') print 'Агрегат ';
          print '</font></td>';
	  print '<td><font class="dd">';
          if ($uu[38]=='1') print 'Вспомогательное';
          if ($uu[38]=='2') print 'Производственное';
          if ($uu[38]=='3') print 'Складское';
          if ($uu[38]=='4') print 'Пустующее';
          if ($uu[38]=='5') print 'Административное';
          if ($uu[38]=='6') print 'Санитарно-бытовое';
          print '</font></td>';
	  print '<td><font class="main">'.$uu[14].'</td>';

	  $query = 'SELECT * FROM energy_supply';
    	  $t = mysql_query ($query,$i);
	  for ($y=1;$y<=8;$y++)
	      {
	       $ut = mysql_fetch_row ($t);
	       if ($ut)
	       if ($uu[6+$ut[2]]>0)
	          {
                   $data=0;
    	           if ($arr["day"]<10) $day='0'.$arr["day"]; else $day=''.$arr["day"];
                   if ($arr["otch"]==1)
                         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$month.$day.'000000 AND korp='.$uu[4].' AND source='.$ut[2];
                   if ($arr["otch"]==2)
                         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.$day.'000000 OR date='.$arr["year"].$month.$day.'120000) AND korp='.$uu[4].' AND source='.$ut[2];
                   if ($arr["otch"]==3)
  	     	         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.'01000000 OR date='.$arr["year"].$month.'01120000) AND korp='.$uu[4].' AND source='.$ut[2];
                   if ($arr["otch"]==4)
                         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.'01000000 OR date='.$arr["year"].$month.'01120000) AND korp='.$uu[4].' AND source='.$ut[2];
                   $K=$uu[6+$ut[2]]; 
		   //echo $query;
	           $z = mysql_query ($query,$i);
	           if ($z)
	           for ($o=1;$o<=10;$o++)
       	               {
                        $uo = mysql_fetch_row ($z);
                        if ($uo == true)
                           {
                            //echo $ut[2].' '.$uo[1].' '.$uo[7];
	   	            if ($ut[2]==0)
                     	       {
	   	            	if (strstr ($uo[1],'масс') && strstr ($uo[1],'подающей')) $data=$uo[7]*$K;
                     	        if (strstr ($uo[1],'масс') && strstr ($uo[1],'обратной')) { $data=$data-$uo[7]*$K; $o=100;}
                     	       }
		  	    if ($ut[2]==1)
		  	    	if (strstr ($uo[1],'тепловой энергии')) $data=$data+$uo[7]*$K;
			    if ($ut[2]==2) $data=$uo[7]*$K;
		   	    if ($ut[2]==3) $data=$uo[7]*$K;
		  	    if ($ut[2]==4)
	                        if (strstr ($uo[1],'массы')) $data=$uo[7]*$K;
		  	    if ($ut[2]==5)
			    	if (strstr ($uo[1],'объема')) $data=$uo[7]*$K;
		  	    if ($ut[2]==6)
		  	    	if (strstr ($uo[1],'объема'))  $data=$uo[7]*$K;
		  	    if ($ut[2]==7) $data=$uo[7]*$K;
		      	   }
                       }
		 print '<td align=center><font class="dd">'.$data.'</td>';
		}
		else print '<td align=center><font class="dd">0</td>';
    	      }
  	  print '</tr>';	
 	 }
     }
?>
</td><tr>
</table>
</body>
</html>