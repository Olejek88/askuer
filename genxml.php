<meta http-equiv="Pragma" content="no-cache"> 
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="shablon.css" type="text/css">

<?php include("config/local.php"); 
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<?php
 set_time_limit (12800);
 $query = 'SELECT id,name,idres,idkor,idkon,port,address,date,conn,P1,P2,P3,P4,P5,P6,P7,P8,P9,P10,P11,P12,P13,P14,P15 FROM uzel WHERE type=1';
 $query2 = 'SELECT * FROM elect ORDER BY date DESC LIMIT 50';
 // id,date,period,logik_id
 $avsob='';
 $recode='';
 while (1)
    {
     if (1)
	{
	 $avsob = '';
         $ffile="instdata.xml";
         $fp=fopen($ffile,"w");	 
         fwrite ($fp,"<?xml version=\"1.0\" encoding=\"windows-1251\"?>\n");
         fwrite ($fp,"<uzels>\n");
	 //echo $query.'<br>';
	 $e = mysql_query ($query,$i);
         $ui = mysql_fetch_row ($e);
	 while ($ui)
	     {		 
	      $name = $ui[1]; $idres=$ui[2]; $idkor = $ui[3];
	      $idkon = $ui[4]; $port = $ui[5]; $address = $ui[6]; $conn = $ui[8];
	      $P1=$ui[9]; $P2=$ui[10]; $P3=$ui[11]; $P4=$ui[12]; 
  	      $P6=$ui[14]; $P7=$ui[15]; $P8=$ui[16]; $P9=$ui[17]; 
 	      $P10=$ui[18]; $P11=$ui[19]; $P12=$ui[20]; $P13=$ui[21]; $P14=$ui[22]; $P15=$ui[23];

 	      fwrite ($fp,"\t");
	      $P1a=$P2a=$P3a=$P4a=$conna=$namea=0;
	      if ($idres==0 && $port!='odbc')
		{
		 if ($P1>$P6) { $P1a=2; $avsob = $avsob.'<tr><td><font class=or1>'.$name.' </font></td><td><font class=dd> Объемный расход воды по подающей трубе </font><font class=nkor>'.$P1.'</font><font class=dd> больше верхнего предела '.$P6.' </font></td></tr>'; }
		 if ($P1<$P7) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход воды по подающей трубе </font><font class=nkor>'.$P1.'</font><font class=dd> ниже нижнего предела '.$P7.' </font></td></tr>'; }
		 if ($P2>$P8) { $P2a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход воды по обратной трубе </font><font class=nkor>'.$P2.'</font><font class=dd> больше верхнего предела '.$P8.' </font></td></tr>'; }
		 if ($P2<$P9) { $P2a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход воды по обратной трубе </font><font class=nkor>'.$P2.'</font><font class=dd> ниже нижнего предела '.$P9.' </font></td></tr>'; }
		 if ($P4>$P3) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd>  Температура по обратной трубе больше температуры по подающей '.$P4.'>'.$P3.' </font></td></tr>'; }
		 if ($P2>$P1) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd>  Расход по обратной трубе больше расхода по подающей '.$P2.'>'.$P1.' </font></td></tr>'; }
		}
   	      if ($idres==1 && $port!='odbc') 
		{
		 if ($P1>$P6) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Разность температур </font><font class=nkor>'.$P1.'</font><font class=dd> больше верхнего предела '.$P6.' </font></td></tr>'; }
		 if ($P1<$P7) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Разность температур </font><font class=nkor>'.$P1.'</font><font class=dd> ниже нижнего предела '.$P7.' </font></td></tr>'; }
		 if ($P3>$P8) { $P3a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Тепловая мощность по магистрали </font><font class=nkor>'.$P2.'</font><font class=dd> больше верхнего предела '.$P8.' </font></td></tr>'; }
		 if ($P3<$P9) { $P3a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Тепловая мощность по магистрали </font><font class=nkor>'.$P2.'</font><font class=dd> ниже нижнего предела '.$P9.' </font></td></tr>'; }
		}
	      if ($idres==2 && $port!='odbc')
		{
		 if ($P1>$P6) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход воды </font><font class=nkor>'.$P1.'</font><font class=dd> больше верхнего предела '.$P6.' </font></td></tr>'; }
		 if ($P1<$P7) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход воды </font><font class=nkor>'.$P1.'</font><font class=dd> ниже нижнего предела '.$P7.' </font></td></tr>'; }
		}
	      if ($idres==4 || $idres==5 || $idres==6) 
		{
		 if ($P1>$P6) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Измеренное значение давления </font><font class=nkor>'.$P1.'</font><font class=dd> больше верхнего предела '.$P6.' </font></td></tr>'; }
		 if ($P1<$P7) { $P1a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Измеренное значение давления </font><font class=nkor>'.$P1.'</font><font class=dd> ниже нижнего предела '.$P7.' </font></td></tr>'; }
		 if ($P2>$P8) { $P2a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Измеренное значение температуры </font><font class=nkor>'.$P2.'</font><font class=dd> больше верхнего предела '.$P8.' </font></td></tr>'; }
		 if ($P2<$P9) { $P2a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Измеренное значение температуры </font><font class=nkor>'.$P2.'</font><font class=dd> ниже нижнего предела '.$P9.' </font></td></tr>'; }
		 if ($P3>$P10) { $P3a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход </font><font class=nkor>'.$P3.'</font><font class=dd> больше верхнего предела '.$P10.' </font></td></tr>'; }
		 if ($P3<$P11) { $P3a=2; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Объемный расход </font><font class=nkor>'.$P3.'</font><font class=dd> ниже нижнего предела '.$P11.' </font></td></tr>'; }
		}
	      if ($conn==0 && $port!='hand') { $conna=1; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> нет связи с прибором </font></td></tr>'; }
	      if ($P15==0 && $port!='odbc' && $port!='hand') { $namea=1; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> на приборе имеются нештатные ситуации</font></td></tr>'; }

              if ($ui[2]==4 || $ui[2]==5 || $ui[2]==6) 
		if ($P1==0) { $P1a=1; $avsob = $avsob.'<tr><td><font class=dd>'.$name.' </font></td><td><font class=dd> Измеренное значение давления </font><font class=nkor>'.$P1.'</font><font class=dd> равно 0! </font></td></tr>'; }
	      fwrite ($fp,'<uzel id="'.$ui[0].'" title="'.htmlspecialchars ($ui[1]).'" ');
	      fwrite ($fp,'date="'.$ui[7].'" ');
	      fwrite ($fp,'conn="'.$ui[8].'" ');
		fwrite ($fp,'P1="'.number_format($ui[9],2));
	      if ($idres==0) fwrite ($fp,'м3/ч" ');
	      if ($idres==1) fwrite ($fp,'C" ');
	      if ($idres==2) fwrite ($fp,'м3" ');
	      if ($idres==3 || $idres==4 || $idres==5 || $idres==6) fwrite ($fp,'МПа" ');
	      if ($idres==7) fwrite ($fp,'кВт" ');
	      fwrite ($fp,'P2="'.number_format($ui[10],2));
	      if ($idres==0) fwrite ($fp,'м3/ч" ');
	      if ($idres==1) fwrite ($fp,'т/ч" ');
	      if ($idres==2 || $idres==7) fwrite ($fp,'" ');
	      if ($idres==3 || $idres==4 || $idres==5 || $idres==6) fwrite ($fp,'C" ');
  	      fwrite ($fp,'P3="'.number_format($ui[11],2));
	      if ($idres==0) fwrite ($fp,'С" ');
	      if ($idres==1) fwrite ($fp,'ГКал" ');
	      if ($idres==2 || $idres==7) fwrite ($fp,'" ');
	      if ($idres==3 || $idres==4 || $idres==5 || $idres==6) fwrite ($fp,'м3/ч" ');
	      fwrite ($fp,'P4="'.number_format($ui[12],2));
	      if ($idres==0) fwrite ($fp,'С" ');
	      if ($idres==1 || $idres==2 || $idres==7) fwrite ($fp,'" ');
	      if ($idres==3 || $idres==4 || $idres==5 || $idres==6) fwrite ($fp,'" ');
	      fwrite ($fp,'P1a="'.$P1a.'" P2a="'.$P2a.'" P3a="'.$P3a.'" P4a="'.$P4a.'" namea="'.$namea.'">');
	      fwrite ($fp,"</uzel>\n");

	      $ui = mysql_fetch_row ($e);
	     }
	 fwrite ($fp,"</uzels>\n");
	 fclose ($fp);
	 //echo 'script worked';
         $ffile="avar.htm";
         $fp=fopen($ffile,"w");	                                                
         //fwrite ($fp,"<meta http-equiv=\"Content-Type\" content=\"text/plain; charset=windows-1251\">");
	 fwrite ($fp,'<table><tr><td bgcolor=#d6d6d6 align=center><font class=dd>Название</font></td><td bgcolor=#d6d6d6 align=center><font class=dd>Ошибка</font></td></tr>');
         //$recode = iconv("UTF-8", "windows-1251", $avsob);
	 //fwrite ($fp,$avsob);
	 fwrite ($fp,$recode);
	 fwrite ($fp,'</table>');
	 fclose ($fp);
	}

      $ffile="instav.xml";
      $fp=fopen($ffile,"w");	 
      fwrite ($fp,"<?xml version=\"1.0\" encoding=\"windows-1251\"?>\n");
      fwrite ($fp,"<events>\n");

	 $e = mysql_query ($query2,$i);
         $ui = mysql_fetch_row ($e);
	 while ($ui)
	     {		 
 	      fwrite ($fp,"\t");
	      fwrite ($fp,'<event time="'.$ui[1][0].$ui[1][1].$ui[1][2].$ui[1][3].'-'.$ui[1][4].$ui[1][5].'-'.$ui[1][6].$ui[1][7].'" ');
	      fwrite ($fp,'period="'.$ui[2].'" ');
	      fwrite ($fp,'logika="'.$ui[3].'">');
	      fwrite ($fp,"</event>\n");

	      $ui = mysql_fetch_row ($e);	      
	     }
      fwrite ($fp,"</events>\n");
      fclose ($fp);

      $dfile="servlast.log";
      $ffile="C:\Program Files\Теплоприбор-ЭКО\Program Files for ASKUER system\server.log";
      $fp=fopen($ffile,"r");
      $fw=fopen($dfile,"w");	 
	fwrite ($fw,"<font class=dd>");
      if ($fp)
	{
	 fseek($fp,-1100,SEEK_END);
	 $buffer = fgets($fp, 300);
	 while (!feof ($fp)) {
	    $buffer = fgets($fp, 300);
	     fwrite ($fw,$buffer."<br>");
		}
	}
      fclose ($fw);
      fclose ($fp);	
      sleep(10);     
    }
?>
