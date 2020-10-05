<?php include("config/local.php"); ?> 
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html>
<head>
<title>Ошибки датчиков системы </title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="shablon.css" type="text/css">
</head>
<body bgcolor=#ffffff leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=center border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#ffffff>
<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = 'SELECT * FROM uzel ORDER BY idkor';
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=200;$z++)
	{
	 $ui = mysql_fetch_row ($e);
	 if ($ui == true)
	   {
	    $name = $ui[1]; $idres=$ui[2]; $idkor = $ui[3];
	    $idkon = $ui[4]; $port = $ui[5]; $address = $ui[6]; $conn = $ui[9];
	    $P1=$ui[10]; $P2=$ui[11]; $P3=$ui[12]; $P4=$ui[13]; 
  	    $P6=$ui[15]; $P7=$ui[16]; $P8=$ui[17]; $P9=$ui[18]; 
	    $P10=$ui[19]; $P11=$ui[20]; $P12=$ui[21]; $P13=$ui[22]; $P14=$ui[23]; $P15=$ui[24];
	    if ($idres==0 && $port!='odbc')
		{
		 if ($P1>$P6) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход воды по подающей трубе </font><font class="nkor">'.$P1.'</font><font class="dd"> больше верхнего предела '.$P6.' </font></td><td>'; }
		 if ($P1<$P7) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход воды по подающей трубе </font><font class="nkor">'.$P1.'</font><font class="dd"> ниже нижнего предела '.$P7.' </font></td><td>'; }
		 if ($P2>$P8) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход воды по обратной трубе </font><font class="nkor">'.$P2.'</font><font class="dd"> больше верхнего предела '.$P8.' </font></td><td>'; }
		 if ($P2<$P9) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход воды по обратной трубе </font><font class="nkor">'.$P2.'</font><font class="dd"> ниже нижнего предела '.$P9.' </font></td><td>'; }
		 if ($P3>$P10) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение температуры воды по подающей трубе </font><font class="nkor">'.$P3.'</font><font class="dd"> больше верхнего предела '.$P10.' </font></td><td>'; }
		 if ($P3<$P11) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение температуры воды по подающей трубе </font><font class="nkor">'.$P3.'</font><font class="dd"> ниже нижнего предела '.$P11.' </font></td><td>'; }
		 if ($P4>$P12) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение температуры воды по обратной трубе </font><font class="nkor">'.$P4.'</font><font class="dd"> больше верхнего предела '.$P12.' </font></td><td>'; }
		 if ($P4<$P13) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение температуры воды по обратной трубе </font><font class="nkor">'.$P4.'</font><font class="dd"> ниже нижнего предела '.$P13.' </font></td><td>'; }
		 if ($P4>$P3) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')]  Температура по обратной трубе больше температуры по подающей '.$P4.'>'.$P3.' </font></td><td>'; }
		 if ($P2>$P1) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')]  Расход по обратной трубе больше расхода по подающей '.$P2.'>'.$P1.' </font></td><td>'; }
		}
	   if ($idres==1 && $port!='odbc') 
		{
		 if ($P1>$P6) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Разность температур </font><font class="nkor">'.$P1.'</font><font class="dd"> больше верхнего предела '.$P6.' </font></td><td>'; }
		 if ($P1<$P7) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Разность температур </font><font class="nkor">'.$P1.'</font><font class="dd"> ниже нижнего предела '.$P7.' </font></td><td>'; }
		 if ($P3>$P8) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Тепловая мощность по магистрали </font><font class="nkor">'.$P2.'</font><font class="dd"> больше верхнего предела '.$P8.' </font></td><td>'; }
		 if ($P3<$P9) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Тепловая мощность по магистрали </font><font class="nkor">'.$P2.'</font><font class="dd"> ниже нижнего предела '.$P9.' </font></td><td>'; }
		}
	   if ($idres==2 && $port!='odbc')
		{
		 if ($P1>$P6) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход воды </font><font class="nkor">'.$P1.'</font><font class="dd"> больше верхнего предела '.$P6.' </font></td><td>'; }
		 if ($P1<$P7) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход воды </font><font class="nkor">'.$P1.'</font><font class="dd"> ниже нижнего предела '.$P7.' </font></td><td>'; }
		}
	   if ($idres==4 || $idres==5 || $idres==6) 
		{
		 if ($P1>$P6) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение давления </font><font class="nkor">'.$P1.'</font><font class="dd"> больше верхнего предела '.$P6.' </font></td><td>'; }
		 if ($P1<$P7) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение давления </font><font class="nkor">'.$P1.'</font><font class="dd"> ниже нижнего предела '.$P7.' </font></td><td>'; }
		 if ($P2>$P8) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение температуры </font><font class="nkor">'.$P2.'</font><font class="dd"> больше верхнего предела '.$P8.' </font></td><td>'; }
		 if ($P2<$P9) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Измеренное значение температуры </font><font class="nkor">'.$P2.'</font><font class="dd"> ниже нижнего предела '.$P9.' </font></td><td>'; }
		 if ($P3>$P10) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход </font><font class="nkor">'.$P3.'</font><font class="dd"> больше верхнего предела '.$P10.' </font></td><td>'; }
		 if ($P3<$P11) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] Объемный расход </font><font class="nkor">'.$P3.'</font><font class="dd"> ниже нижнего предела '.$P11.' </font></td><td>'; }
		}
	    if ($conn==0 && $port!='hand') { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] нет связи с прибором </font></td><td>'; }
	    if ($P15==0) { print '<tr><td><font class="or1">'.$name.' </font></td><td><font class="dd">['.$idkon.'('.$port.'|'.$address.')] на приборе имеются нештатные ситуации</font></td><td>'; }
	   }
	}
?>
</table>
</html>