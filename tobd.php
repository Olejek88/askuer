<?php include("config/local.php"); ?> 
<?php
$shapka_err = '<html><head><style>
	 a:link  {font:8pt/11pt verdana; color:red}
	 a:visited {font:8pt/11pt verdana; color:#4e4e4e}
	 </style><meta HTTP-EQUIV="Content-Type" Content="text-html; charset=Windows-1251">
	 <title>Не пойдет!</title></head>
	 <body bgcolor="white" onload="initPage()">
	 <table width="400" cellpadding="3" cellspacing="5"><tr><td valign="top" align="left">
	 <img id="pagerrorImg" SRC="files/pagerror.gif" width="25" height="33"></td>
	 <td id="tableProps2" align="left" valign="middle" width="360"><h1 id="textSection1" style="COLOR: black; FONT: 13pt/15pt verdana">
	 <span id="errorText">Уважаемый посетитель, вы допустили ошибку при вводе данных.</span></h1>
	 </td></tr><tr><td id="tablePropsWidth" width="400" colspan="2"><font style="COLOR: black; FONT: 8pt/11pt verdana">
	 Допущенная вами ошибка легко может быть исправлена если вы последуете этим инструкциям.</font></td></tr><tr>
	 <td id="tablePropsWidth" width="400" colspan="2"><font style="COLOR: black; FONT: 8pt/11pt verdana"><hr color="#C0C0C0" noshade><p>Информация об ошибке:</p>';
$konec_err = '<li>Нажмите <a href="javascript:history.back(1)"><img valign=bottom border=0 src="files/back.gif"> Back</a> для редактирования новости.</li>
    	 </ul><p><br></p><h2 style="font:8pt/11pt verdana; color:black">Невозможно осуществить обновление данных в таблице БД.</h2></font>';
$konec2_err = '</td></tr></table></body></html>'; $error=""; $err = 0;
$direct = "pikt/";
$name_form = $HTTP_POST_VARS [frm];
//-------------------------------------------------------------------------
$errr[0] = "<li>[0] Не заполнено поле названия. </li>";
$errr[1] = "<li>[1] Не указан идентификатор. </li>";
$errr[2] = "<li>[2] Не заполнено поле заголовка.</li>";
$errr[3] = "<li>[3] Не указан один или несколько параметров. </li>";
$errr[4] = "<li>[4] Не указана цена. </li>";
$errr[5] = "<li>[5] Ошибка запроса БД.</li>";
$errr[6] = "<li>[6] Не заполнено поле текста. </li>";
//-------------------------------------------------------------------------
$today = getdate(); $month = $today[month]; $mday = $today[mday]; $year = $today[year];
$minutes = $today[minutes]; $hours = $today[hours];
if ($minutes<10) $minutes = "0" . $minutes;
//---------------------------------------------------------- так надо
if ($month=='March') $mont='Марта';	if ($month=='April') $mont='Апреля';
if ($month=='January') $mont='Января'; if ($month=='February') $mont='Февраля';
if ($month=='May') $mont='Мая'; if ($month=='June') $mont='Июня';
if ($month=='July') $mont='Июля'; if ($month=='August') $mont='Августа';
if ($month=='September') $mont='Сентября'; if ($month=='October') $mont='Октября';
if ($month=='November') $mont='Ноября'; if ($month=='December') $mont='Декабря';
//-------------------------------------------------------------------
if ($_POST["frm"]=='1')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["nam"]=='') { $err++; $arr[0] = 1;}
if ($err==0)
{
$query = 'INSERT INTO buyers(caption,type) VALUES ('.'\''.$_POST["nam"].'\',\''.$_POST["type"].'\')';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
$query = 'INSERT INTO people(name) VALUES ('.'\''.$_POST["nam"].'\')';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=1")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='2')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($_POST["korp_id"]=='') { $err++; $arr[1] = 1;}
if ($err==0)
{
$query = 'INSERT INTO korp(korp_id,name,descr,type) VALUES ('.'\''.$_POST["korp_id"].'\',\''.$_POST["name"].'\',\''.$_POST["descr"].'\',\''.$_POST["type"].'\')';
$e = mysql_query ($query,$i);
if ($e==0)    {   $err++; $arr[5] = 1;    }
$query = 'ALTER TABLE people ADD id'.$_POST["korp_id"].' DOUBLE';
echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {  $err++; $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=2")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='4')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["nam"]=='') { $err++; $arr[0] = 1;}
if ($_POST["id"]=='') { $err++; $arr[1] = 1;}
if ($_POST["price"]=='') { $err++; $arr[4] = 1;}
if ($err==0)
{
$query = 'INSERT INTO energy_supply(caption,id,price) VALUES ('.'\''.$_POST["nam"].'\',\''.$_POST["id"].'\',\''.$_POST["price"].'\')';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=4")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='5')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["user"]=='') { $err++; $arr[0] = 1;}
if ($err==0)
{
$query = 'INSERT INTO users(user,passwd,user_priveleges) VALUES ('.'\''.$_POST["user"].'\',\''.$_POST["passwd"].'\',\''.$_POST["user_priveleges"].'\')';
$e = mysql_query ($query,$i);
$query = 'INSERT INTO register (code,descr) VALUES (10,"Пользователь '.$HTTP_COOKIE_VARS[user_name].' внес изменения в таблицу users: Добавил пользователя - '.$_POST["user"].'")';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=5")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='6')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$atdat=$_POST["year"].$_POST["month"].'01000000';
if (($device>=8800 && $device<8900) || $device==1214) 
   { 
    $source=7;
    $name='Архив по месяцам расхода электроэнергии';	
    if ($device==8801 || $device==8802) $korp=101; else $korp=1;
   }
$query = 'SELECT * FROM data WHERE name=\''.$name.'\' AND type=\'4\' AND date=\''.$atdat.'\' AND device=\''.$device.'\' AND source=\''.$source.'\'';
//echo $query.'<br>';
$o = mysql_query ($query,$i);
$ui = mysql_fetch_row ($o);
if ($o && $ui)
   {
    $query = 'UPDATE data SET date=\''.$atdat.'\',value=\''.$_POST["value"].'\' WHERE type=\'4\' AND date=\''.$atdat.'\' AND device=\''.$device.'\' AND source=\''.$source.'\'';
    //echo $query.'<br>';
    $a = mysql_query ($query,$i);
    if ($a==0) { $err++;  $arr[5] = 1;}
   }
else
   {
    $query = 'INSERT INTO data(name,type,date,korp,device,source,value) VALUES ('.'\''.$name.'\',\'4\',\''.$atdat.'\',\''.$korp.'\',\''.$device.'\',\''.$source.'\',\''.$value.'\')';
    //echo $query.'<br>';
    $a = mysql_query ($query,$i);
    if ($a==0) { $err++;  $arr[5] = 1;}
   }
if ($e==0)    {     $err++;  $arr[5] = 1;    }
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=6&idd='.$device.'#1")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='7')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["caption"]=='') { $err++; $arr[0] = 1;}
if ($_POST["latiude"]=='') { $err++; $arr[3] = 1;}
if ($_POST["longtitude"]=='') { $err++; $arr[3] = 1;}
if ($err==0)
{
$query = 'INSERT INTO territory(caption, inc_energy, out_energy, latitude, longtitude, height, square, cold_period, temperature, atm_pressure, humidity, sunny_days, rs_temp, qp2, qo2, qp3, qo3, qp4, qo4, qp5, qo5, qp6, qo6, qp7, qo7, qp8, qo8) VALUES ('.'\''.$_POST["caption"].'\',\''.$_POST["inc_energy"].'\',\''.$_POST["out_energy"].'\',\''.$_POST["latitude"].'\',\''.$_POST["longtitude"].'\',\''.$_POST["height"].'\',\''.$_POST["square"].'\',\''.$_POST["cold_period"].'\',\''.$_POST["temperature"].'\',\''.$_POST["atm_pressure"].'\',\''.$_POST["humidity"].'\',\''.$_POST["sunny_days"].'\',\''.$_POST["rs_temp"].'\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\',\'0\''.'\')';
echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=7")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='8')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($_POST["idn"]=='') { $err++; $arr[1] = 1;}
if ($err==0)
{
$query = 'INSERT INTO methods(idn, name) VALUES ('.'\''.$_POST["idn"].'\',\''.$_POST["name"].'\')';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=8")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='16')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($err==0)
{
$query = 'INSERT INTO sensors(name,type) VALUES ('.'\''.$_POST["name"].'\','.$_POST["type"].')';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=16")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='17')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$pp=0;
while (list ($key,$val) = each($_POST))
 {
  //echo "$key => $val<br>";
  $tok = strtok ($key,"-"); $tk=0;
  while ($tok)
      {
       $ar[$pp/4][$tk]=$tok;
       $tok=strtok ("-");
       $tk++;
      }
  $ar[$pp/4][1]=$ar[$pp/4][1]-1;
  $at[$pp/4][$pp%4]=$val;
  if (strstr($ar[$pp/4][2],'value') || strstr($ar[$pp/4][2],'korp') || strstr($ar[$pp/4][2],'date') || strstr($ar[$pp/4][2],'source'))
     $pp++;
 }
for ($d=0; $d<$pp/4; $d++)
 {
  if ($ar[$d][1]==0) $name='Архив по месяцам массы теплоносителя';
  if ($ar[$d][1]==1) $name='Архив по месяцам тепловой энергии';
  if ($ar[$d][1]==2) $name='Архив по месяцам объема воды';
  if ($ar[$d][1]==3) $name='Архив по месяцам объема водяного пара';
  if ($ar[$d][1]==4) $name='Архив по месяцам массы газа';
  if ($ar[$d][1]==5) $name='Архив по месяцам объема сжатого воздуха';
  if ($ar[$d][1]==6) $name='Архив по месяцам объема кислорода';
  if ($ar[$d][1]==7) $name='Архив по месяцам мощности';

  $query = 'SELECT korp,date FROM data WHERE name=\''.$name.'\' AND type=\'4\' AND date=\''.$at[$d][2].'\' AND korp=\'101\' AND source=\''.$at[$d][3].'\'';  
  //echo $query.'<br>';
  $o = mysql_query ($query,$i);
  $ui = mysql_fetch_row ($o);
  if ($o && $ui)
     {
      $query = 'UPDATE data SET date=\''.$ui[1].'\',value=\''.$at[$d][0].'\' WHERE name=\''.$name.'\' AND type=\'4\' AND date=\''.$at[$d][2].'\' AND korp=\'101\' AND source=\''.$at[$d][3].'\'';  
      //echo $query.'<br>';
      $a = mysql_query ($query,$i);
      if ($a==0) { $err++;  $arr[5] = 1;}
     }
  else
     {
      $query = 'INSERT INTO data(name,type,date,korp,device,source,value) VALUES ('.'\''.$name.'\',\'4\',\''.$at[$d][2].'\',\'101\',\'1\',\''.$at[$d][3].'\',\''.$at[$d][0].'\')';
      //echo $query.'<br>';
      $a = mysql_query ($query,$i);
      if ($a==0) { $err++;  $arr[5] = 1;}
     }
 }
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=17")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='18')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$pp=0;
while (list ($key,$val) = each($_POST))
 {
  //echo "[$pp] $key => $val<br>";
  $tok = strtok ($key,"-"); $tk=0;
  while ($tok)
      {
       $ar[$pp/4][$tk]=$tok;
       $tok=strtok ("-");
       $tk++;
      }
  $ar[$pp/4][2]=$ar[$pp/4][2]-1;
  $at[$pp/4][$pp%4]=$val;
  if (strstr($ar[$pp/4][3],'valus')) { $ap[$pp/4]=$val;}
  if (strstr($ar[$pp/4][3],'value') || strstr($ar[$pp/4][3],'korp') || strstr($ar[$pp/4][3],'date') || strstr($ar[$pp/4][3],'source'))
     $pp++;
 }
for ($d=0; $d<$pp/4; $d++)
 {
  if ($ar[$d][2]==0) $name='Архив суточный значений массы теплоносителя по обратной трубе';
  if ($ar[$d][2]==1) $name='Архив суточный значений тепловой энергии';
  if ($ar[$d][2]==2) $name='Архив суточный значений объема воды';
  if ($ar[$d][2]==3) $name='Архив суточный значений объема водяного пара';
  if ($ar[$d][2]==4) $name='Архив суточный значений массы газа';
  if ($ar[$d][2]==5) $name='Архив суточный значений объема сжатого воздуха';
  if ($ar[$d][2]==6) $name='Архив суточный значений объема кислорода';
  if ($ar[$d][2]==7) $name='Архив суточный значений мощности';

  $query = 'SELECT korp,date FROM data WHERE name=\''.$name.'\' AND type=\'2\' AND date=\''.$at[$d][2].'\' AND korp=\'101\' AND source=\''.$at[$d][3].'\'';
  //echo $query.'<br>';
  $o = mysql_query ($query,$i);
  $ui = mysql_fetch_row ($o);
  if ($ar[$d][2]<7)
  if ($o && $ui)
     {
      $query = 'UPDATE data SET date=\''.$at[$d][2].'\',value=\''.$at[$d][0].'\' WHERE name=\''.$name.'\' AND type=\'2\' AND date=\''.$at[$d][2].'\' AND korp=\'101\' AND source=\''.$at[$d][3].'\'';  
      //echo $query.'<br>';
      $a = mysql_query ($query,$i);
      if ($a==0) { $err++;  $arr[5] = 1;}
     }
  else
     {
      $query = 'INSERT INTO data(name,type,date,korp,device,source,value) VALUES ('.'\''.$name.'\',\'2\',\''.$at[$d][2].'\',\'101\',\'1\',\''.$at[$d][3].'\',\''.$at[$d][0].'\')';
      //echo $query.'<br>';
      $a = mysql_query ($query,$i);
      if ($a==0) { $err++;  $arr[5] = 1;}
     }
   if ($at[$d][3]==0)
     {
      $name='Архив суточный значений массы теплоносителя по подающей трубе';	
      $query = 'SELECT korp,date FROM data WHERE name=\''.$name.'\' AND type=\'2\' AND date=\''.$at[$d][2].'\' AND korp=\'101\' AND source=\''.$at[$d][3].'\'';
      //echo $query.'<br>';
      $o = mysql_query ($query,$i);
      $ui = mysql_fetch_row ($o);
      if ($o && $ui)
    	 {
	  $query = 'UPDATE data SET date=\''.$at[$d][2].'\',value=\''.$ap[$d].'\' WHERE name=\''.$name.'\' AND type=\'2\' AND date=\''.$at[$d][2].'\' AND korp=\'101\' AND source=\''.$at[$d][3].'\'';
          //echo $query.'<br>';
          $a = mysql_query ($query,$i);
          if ($a==0) { $err++;  $arr[5] = 1;}
         }
      else
	 {
          $query = 'INSERT INTO data(name,type,date,korp,device,source,value) VALUES ('.'\''.$name.'\',\'2\',\''.$at[$d][2].'\',\'101\',\'1\',\''.$at[$d][3].'\',\''.$ap[$d].'\')';
          //echo $query.'<br>';
          $a = mysql_query ($query,$i);
          if ($a==0) { $err++;  $arr[5] = 1;}
         }
     }
 }
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=18")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='9')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($_POST["idbuy"]=='0') { $err++; $arr[3] = 1;}
$qbuy=1;
if ($_POST["idbuy2"]!='0') { $qbuy++; }
if ($_POST["idbuy3"]!='0') { $qbuy++; }
if ($_POST["idbuy4"]!='0') { $qbuy++; }
if ($_POST["idbuy5"]!='0') { $qbuy++; }
if ($_POST["idkorp"]=='') { $err++; $arr[3] = 1; }
if ($_POST["type"]=='') { $err++; $arr[3] = 1; }
if ($_POST["type"]!=3)
	{
	 if ($_POST["square"]=='') { $err++; $arr[3] = 1; }
	 if ($_POST["BTI"]=='') { $err++; $arr[3] = 1; }
	}

if ($err==0)
{
$addr=$_SERVER['REMOTE_ADDR'];
$query = 'INSERT INTO register (code,descr,who,ip) VALUES (10,"Пользователь '.$PHP_AUTH_USER.' внес изменения в таблицу объектов: Добавил объект - '.$_POST["name"].'",'.'\''.$PHP_AUTH_USER.'\',\''.$addr.'\')';
$e = mysql_query ($query,$i);
$query = 'INSERT INTO obj(name,idbuy,buy_q,idkorp,type,square,aren_square,BTI,K_agr,Q_agr,height,level,nPP,poll_square,volume,Qszh,Qkisl,Qgaza) 
          VALUES ('.'\''.$_POST["name"].'\',\''.$_POST["idbuy"].'\',\''.$qbuy.'\',\''.$_POST["idkorp"].'\',\''.$_POST["type"].'\',\''.$_POST["square"]
	.'\',\''.$_POST["aren_square"].'\',\''.$_POST["BTI"].'\',\''.$_POST["K_agr"].'\',\''.$_POST["Q_agr"].'\',\''.$_POST["height"].'\',\''.$_POST["level"].'\',\''.$_POST["nPP"].'\',\''.$_POST["poll_square"]
	.'\',\''.$_POST["volume"].'\',\''.$_POST["Qszh"].'\',\''.$_POST["Qkisl"].'\',\''.$_POST["Qgaza"].'\')';
//echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
for ($q=0;$q<$qbuy;$q++)
 {
  $query = 'SELECT id FROM objects WHERE name=\''.$_POST["name"].'\'';  
  $e = mysql_query ($query,$i);
  $ui = mysql_fetch_row ($e);
  if ($ui == true)
	{
	  $query = 'INSERT INTO soot(idobj,idbuy) VALUES ('.'\''.$ui[0].'\',\''.$_POST["idbuy"].'\')';
	  $e = mysql_query ($query,$i);
	  if ($e==0)    {     $err++;  $arr[5] = 1;    }
	}
 }
}
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=9")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='11')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($_POST["idkor"]=='') { $err++; $arr[3] = 1;}
if ($_POST["udpr"]=='') { $err++; $arr[3] = 1;}
if ($_POST["quant"]=='') { $err++; $arr[3] = 1;}
if ($_POST["idbuy"]=='') { $err++; $arr[3] = 1;}
if ($err==0)
{
$query = 'INSERT INTO production(name, idkor, udpr, quant, idbuy) VALUES ('.'\''.$_POST["name"].'\',\''.$_POST["idkor"].'\',\''.$_POST["udpr"].'\',\''.$_POST["quant"].'\',\''.$_POST["idbuy"].'\')';
echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=11")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='14')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($err==0)
{
$query = 'INSERT INTO equipment(name, date_buy, date_mon_1, date_vvod, date_prov_p, date_prov_s, period_p, type, serial, uzel, shelf, source, date_dem_p, prichina_dem, date_mon_p, prichina_mon, history, Du, s_type, Pmin, Pmax, d_type, d) VALUES 
('.'\''.$_POST["name"].'\',
\''.$_POST["date_buy_year"].$_POST["date_buy_month"].$_POST["date_buy_day"].'000000\',
\''.$_POST["date_mon_1_year"].$_POST["date_mon_1_month"].$_POST["date_mon_1_day"].'000000\',
\''.$_POST["date_vvod_year"].$_POST["date_vvod_month"].$_POST["date_vvod_day"].'000000\',
\''.$_POST["date_prov_p_year"].$_POST["date_prov_p_month"].$_POST["date_prov_p_day"].'000000\',
\''.$_POST["date_prov_s_year"].$_POST["date_prov_s_month"].$_POST["date_prov_s_day"].'000000\',
\''.$_POST["period_p"].'\',
\''.$_POST["type"].'\',
\''.$_POST["serial"].'\',
\''.$_POST["uzel"].'\',
\''.$_POST["shelf"].'\',
\''.$_POST["source"].'\',
\''.$_POST["date_dem_p_year"].$_POST["date_dem_p_month"].$_POST["date_dem_p_day"].'000000\',
\''.$_POST["prichina_dem"].'\',
\''.$_POST["date_mon_p_year"].$_POST["date_mon_p_month"].$_POST["date_mon_p_day"].'000000\',
\''.$_POST["prichina_mon"].'\',
\''.$_POST["history"].'\',
\''.$_POST["Du"].'\',
\''.$_POST["s_type"].'\',
\''.$_POST["Pmin"].'\',
\''.$_POST["Pmax"].'\',
\''.$_POST["d_type"].'\',
\''.$_POST["d"].'\')';
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=14")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='13')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($_POST["descr"]=='') { $err++; $arr[3] = 1;}
if ($_POST["idkor"]=='') { $err++; $arr[3] = 1;}
if ($err==0)
{
$query = 'INSERT INTO shelf(name, idkor, descr, otv, koor, rash) VALUES ('.'\''.$_POST["name"].'\',\''.$_POST["idkor"].'\',\''.$_POST["descr"].'\',\''.$_POST["otv"].'\',\''.$_POST["koor"].'\',\''.$_POST["rash"].'\')';
echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
}
if ($err==0)
   {
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=13")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='20')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["text"]=='') { $err++; $arr[6] = 1;}
if ($err==0)
{
$today=getdate();
if ($today[mon]<10) $mon='0'.$today[mon]; else $mon=$today[mon];
if ($today[mday]<10) $day='0'.$today[mday]; else $day=$today[mday];
if ($today[hours]<10) $hour='0'.$today[hours]; else $hour=$today[hour];
if ($today[minutes]<10) $minutes='0'.$today[minutes]; else $minutes=$today[minutes];
if ($today[seconds]<10) $seconds='0'.$today[seconds]; else $seconds=$today[seconds];
$query = 'INSERT INTO feedback(id_answer,level,who,text,answer,date) VALUES ('.'\''.$_POST["answer"].'\',\''.$_POST["level"].'\',\''.$_POST["who"].'\',\''.$_POST["text"].'\',\''.$_POST["answer"].'\',\''.$today[year].$mon.$day.$hours.$minutes.$seconds.'\')';
echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {   $err++; $arr[5] = 1;    }
}
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("88.php?menu=20")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='24')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$direct = "photo/";

if ($_FILES["photo"]["tmp_name"]!='')
    {
     $maxid=0;
     $query = 'SELECT MAX(id) FROM photo';
     $e = mysql_query ($query,$i);
     if ($e)
	{
	 $ui = mysql_fetch_row ($e);
	 if ($ui == true) $maxid=$ui[0]+1;
	}
     $dfile = $direct.'shelf'.$maxid.'.jpg';
     move_uploaded_file($_FILES["photo"]["tmp_name"], $dfile);
     $size=GetImageSize($dfile);
     if ($size[2]==1)  $mdfile = $direct.'shelf'. $maxid .'.gif';
     if ($size[2]==2)  $mdfile = $direct.'shelf'. $maxid .'.jpg';
     if ($size[2]==1)  $file = $direct.'shelf'. $maxid .'_m.gif';
     if ($size[2]==2)  $file = $direct.'shelf'. $maxid .'_m.jpg';
     $newsize=$size[1]/($size[0]/100);
     $im_dst = @imagecreatetruecolor (100, $newsize); 
     if ($size[2]==1) $im_src = @ImageCreateFromGIF ($dfile); 
     if ($size[2]==2) $im_src = @ImageCreateFromJPEG ($dfile); 
     imagecopyresampled ($im_dst, $im_src, 0, 0, 0, 0, 100, $newsize, $size[0], $size[1]);
     imageJPEG ($im_dst,$file);
     $pph=$mdfile;
    }  
$query = 'INSERT INTO photo(sid,photo,descr) VALUES ('.'\''.$_POST["id"].'\',\''.$pph.'\',\''.$_POST["descr"].'\')';
//echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {     $err++;  $arr[5] = 1;    }
if ($err==0)
   {
    print "Content-Type: text/html\n\n";
    print "<script>";
    print 'imgs=window.navigate ("shelf.php?id='.$_POST["id"].'")';
    print "</script>";
   }
}
//-------------------------------------------------------------------
if ($_POST["frm"]=='21')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);

$bdate=$_POST["day"].'-'.$_POST["month"].'-'.$_POST["year"];
$edate=$_POST["eday"].'-'.$_POST["emonth"].'-'.$_POST["eyear"];
if ($_POST["new_why"])
{
 $query = 'INSERT INTO why(event) VALUES("'.$_POST["new_why"].'")';
 $e = mysql_query ($query,$i); 
 $query = 'SELECT * FROM why WHERE event="'.$_POST["new_why"].'"';
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true) $why=$ui[0];
}
else $why=$_POST["why"];
$query = 'INSERT INTO event2(why, date_begin, date_end, uzel, descr, sensor) VALUES ('.'\''.$why.'\',\''.$bdate.'\',\''.$edate.'\',\''.$_POST["uzel"].'\',\''.$_POST["descr"].'\',\''.$_POST["sensors"].'\')';
echo $query;
$e = mysql_query ($query,$i);
if ($e==0)    {   $err++; $arr[5] = 1;    }
if ($err==0) print '<script> window.close (); </script>';
}
//-------------------------------------------------------------------
if ($err>0)
	{
	if ($arr[0]==1)	{ $error = $error . $errr[0]; }
	if ($arr[1]==1)	{ $error = $error . $errr[1]; }
	if ($arr[2]==1)	{ $error = $error . $errr[2]; }
	if ($arr[3]==1)	{ $error = $error . $errr[3]; }
	if ($arr[4]==1)	{ $error = $error . $errr[4]; }
	if ($arr[5]==1)	{ $error = $error . $errr[5]; }
	if ($arr[6]==1)	{ $error = $error . $errr[6]; }
	print $shapka_err;
	print $error;
	print $konec_err;
	print '<font style="font:8pt/11pt verdana; color:black">Всего ошибок:';
	print $err;
	print '</font>';
	print $konec2_err;
	}
?>