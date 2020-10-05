<?php include("config/local.php"); 
include_once("../../adodb/adodb.inc.php");
$SELF      = $HTTP_SERVER_VARS["PHP_SELF"];
$db= &ADONewConnection($sqldriver);
if (!$db->Connect($mysql_host, $mysql_user, $mysql_password, $mysql_db_name))
{die("Error: ".$db->ErrorMsg());}

if (isset($PHP_AUTH_USER) && isset($PHP_AUTH_PW))
 {
  $resq = "SELECT * FROM users WHERE user='".$PHP_AUTH_USER."' AND passwd='".$PHP_AUTH_PW."';"; 
  $rc=&$db->Execute($resq);
  if($rc && $rc->RecordCount())
   {


?>
<meta http-equiv="Set-Cookie" CONTENT="user_priv=<?echo $rc->fields[user_priveleges];?>">
<meta http-equiv="Set-Cookie" CONTENT="user_name=<?echo $rc->fields[user];?>">
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="shablon.css" type="text/css">

<?php
$max=0;
$edit=1;
$del=1;
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'USE askuer';

if ($_GET["menu"]=='')
{
 $addr=$_SERVER['REMOTE_ADDR'];
 $resq = 'INSERT INTO register (code,descr,who,ip) VALUES (2,'.'\'Пользователь '.$PHP_AUTH_USER.' вошел в систему\','.'\''.$PHP_AUTH_USER.'\',\''.$addr.'\');';
// echo $resq;
 $db->Execute($resq);
 include ("./top.php");
 echo "<title>Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
}

if ($_GET["menu"]=='1')
{
 $query = 'SELECT * FROM buyers';
 $max=1;
 include ("./top.php");
 echo "<title>Арендаторы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#880000><font class="main">Название</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';
}
if ($_GET["menu"]=='2')
{
 $query = 'SELECT * FROM korp';
 $max=4;
 include ("./top.php");
 echo "<title>Корпуса-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#880000><font class="main">Идентификатор</td><td bgcolor=#880000><font class="main">Название</td><td bgcolor=#880000><font class="main">Описание</td><td bgcolor=#880000><font class="main">Тип</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='3')
{
 $query = 'SELECT * FROM data WHERE type=4 ORDER BY type,date DESC';
 $max=7; $edit=0;
 
 include ("./top.php");
 echo "<title>Данные-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#880000><font class="main">Название параметра</td><td bgcolor=#880000><font class="main">Тип</td><td bgcolor=#880000><font class="main">Дата</td><td bgcolor=#880000><font class="main">Корпус</td><td bgcolor=#880000><font class="main">Устройство</td><td bgcolor=#880000><font class="main">Ресурс</td><td bgcolor=#880000><font class="main">Значение</td><td bgcolor=#880000><font class="main">Уд.</td></tr>';
 
}
if ($_GET["menu"]=='4')
{
 $query = 'SELECT * FROM energy_supply';
 $max=3;

 include ("./top.php");
 echo "<title>Энергоресурсы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#880000><font class="main">Название ресурса</td><td bgcolor=#880000><font class="main">Идентификатор</td><td bgcolor=#880000><font class="main">Тариф</td><td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td></tr>';
}
if ($_GET["menu"]=='5')
{
 if ($HTTP_COOKIE_VARS[user_priv]==3)
  {
 $query = 'SELECT * FROM users';
 $max=3;

 include ("./top.php");
 echo "<title>Пользователи-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#880000><font class="main">Пользователь</td><td bgcolor=#880000><font class="main">Пароль</td><td bgcolor=#880000><font class="main">Категория</td><td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td></tr>';
  }
}
if ($_GET["menu"]=='6')
{
 // id,name,idres,idkor,idkon,port,address,date,conn,P1,P2,P3,P4
 if ($_GET["sour"]=='') $query = 'SELECT id,name,idres,idkor,idkon,port,address,date,conn,P1,P2,P3,P4 FROM uzel';
 else
        {
         if ($_GET["sour"]!='') $query = 'SELECT id,name,idres,idkor,idkon,port,address,date,conn,P1,P2,P3,P4 FROM uzel WHERE idres='.$_GET["sour"];
        }
 if ($_GET["sort"]==1) $query = $query . ' ORDER BY  address';
 if ($_GET["sort"]==2) $query = $query . ' ORDER BY  name';
 if ($_GET["sort"]==3) $query = $query . ' ORDER BY  idres';
 if ($_GET["sort"]==4) $query = $query . ' ORDER BY  idkor';
 if ($_GET["sort"]==5) $query = $query . ' ORDER BY  idkon';
 if ($_GET["sort"]==6) $query = $query . ' ORDER BY  port';
 $max=12;

 include ("./top.php");
 echo "<title>Узлы учета-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr>
 <td bgcolor=#880000><a href="88.php?menu=6&sort=2&sour='.$_GET["sour"].'"><font class="main">Название узла</font></a></td>
 <td bgcolor=#880000><a href="88.php?menu=6&sort=3&sour='.$_GET["sour"].'"><font class="main">Энергоресурс</font></a></td>
 <td bgcolor=#880000><a href="88.php?menu=6&sort=4&sour='.$_GET["sour"].'"><font class="main">Корпус</font></a></td>
 <td bgcolor=#880000><a href="88.php?menu=6&sort=5&sour='.$_GET["sour"].'"><font class="main">Контроллер</font></a></td>
 <td bgcolor=#880000><a href="88.php?menu=6&sort=6&sour='.$_GET["sour"].'"><font class="main">Порт</font></a></td>
 <td bgcolor=#880000><a href="88.php?menu=6&sort=1&sour='.$_GET["sour"].'"><font class="main">Адрес</font></td>
 <td bgcolor=#880000><font class="main">Дата</td><td bgcolor=#880000><font class="main">Связь</td><td bgcolor=#880000><font class="main">P1</td><td bgcolor=#880000><font class="main">P2</td><td bgcolor=#880000><font class="main">P3</td><td bgcolor=#880000><font class="main">P4</td>';
 
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='7')
{
 $query = 'SELECT * FROM territory';
 $max=27;

 include ("./top.php");
 echo "<title>Территория Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#111111 width=20 align=center colspan=13></td><td bgcolor=#222222 align=center colspan=7><font class="main">Потребляемые энергоресурсы</td><td align=center bgcolor=#222222 colspan=7><font class="main">Отдаваемые энергоресурсы</td><td bgcolor=#111111 colspan=2></td></tr>';
 print '<tr><td bgcolor=#880000><font class="main">Название</td><td bgcolor=#880000><font class="main">Входящие</td><td bgcolor=#880000><font class="main">Исходящие</td><td bgcolor=#880000><font class="main">Широта</td><td bgcolor=#880000><font class="main">Долгота</td><td bgcolor=#880000><font class="main">Высота</td><td bgcolor=#880000><font class="main">Площадь</td><td bgcolor=#880000><font class="main">Холодных дней</td><td bgcolor=#880000><font class="main">Температура</td><td bgcolor=#880000><font class="main">Давление</td><td bgcolor=#880000><font class="main">Влажность</td><td bgcolor=#880000><font class="main">Солнечных дней</td><td bgcolor=#880000><font class="main">Расчетная температура</td><td bgcolor=#880000><font class="main">Тепло</td><td bgcolor=#880000><font class="main">Вода</td><td bgcolor=#880000><font class="main">Газ</td><td bgcolor=#880000><font class="main">Кислород</td><td bgcolor=#880000><font class="main">Пар</td><td bgcolor=#880000><font class="main">Электроэнергия</td><td bgcolor=#880000><font class="main">Воздух</td><td bgcolor=#880000><font class="main">Тепло</td><td bgcolor=#880000><font class="main">Вода</td><td bgcolor=#880000><font class="main">Газ</td><td bgcolor=#880000><font class="main">Кислород</td><td bgcolor=#880000><font class="main">Пар</td><td bgcolor=#880000><font class="main">Электроэнергия</td><td bgcolor=#880000><font class="main">Воздух</td><td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td></tr>';
}
if ($_GET["menu"]=='8')
{
 $query = 'SELECT * FROM methods';
 $max=3;
 print '<tr><td bgcolor=#880000><font class="main">Идентификатор</td><td bgcolor=#880000><font class="main">Название</td><td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td></tr>';
}
if ($_GET["menu"]=='9')
{ 
 if ($_GET["korp"]=='' && $_GET["aren"]=='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,typeR,square,wall_square,K1,K2,K3,K5,K6,K7,K8 FROM objects';
 else 
        {
         if ($_GET["korp"]!='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,typeR,square,wall_square,K1,K2,K3,K5,K6,K7,K8 FROM objects WHERE idkorp='.$_GET["korp"];
         if ($_GET["aren"]!='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,typeR,square,wall_square,K1,K2,K3,K5,K6,K7,K8 FROM objects WHERE idbuy='.$_GET["aren"];
         if ($_GET["korp"]!='' && $_GET["aren"]!='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,typeR,square,wall_square,K1,K2,K3,K4,K5,K6,K7,K8 FROM objects WHERE idkorp='.$_GET["korp"].' AND idbuy='.$_GET["aren"];
        }
 if ($_GET["sort"]=='1') $query = $query . ' ORDER BY name';
 if ($_GET["sort"]=='2') $query = $query . ' ORDER BY idbuy';
 if ($_GET["sort"]=='3') $query = $query . ' ORDER BY idkorp';
 if ($_GET["sort"]=='4') $query = $query . ' ORDER BY type';
 $max=15;

 include ("./top.php");
 echo "<title>Объекты-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr>';
 print '<td bgcolor=#880000><a href="88.php?menu=9&sort=1&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Название</font></a></td>';
 print '<td bgcolor=#880000><a href="88.php?menu=9&sort=2&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Арендатор</font></a></td>';
 print '<td bgcolor=#880000><a href="88.php?menu=9&sort=3&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Корпус</font></a></td>';
 print '<td bgcolor=#880000><a href="88.php?menu=9&sort=4&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Тип</font></a></td><td bgcolor=#880000><font class="main">Номер БТИ</font></td>';
 print '<td bgcolor=#880000><font class="main">Тип помещения</td><td bgcolor=#880000><font class="main">Площадь</td>';
 print '<td bgcolor=#880000><font class="main">K(тепло)</td><td bgcolor=#880000><font class="main">K(т-вода)</td><td bgcolor=#880000><font class="main">K(вода)</td><td bgcolor=#880000><font class="main">K(пар)</td><td bgcolor=#880000><font class="main">K(газ)</td><td bgcolor=#880000><font class="main">K(сж.возд)</td><td bgcolor=#880000><font class="main">K(кислор)</td><td bgcolor=#880000><font class="main">K(электр)</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='10')
{
 include ("./top.php");
 echo "<title>Персонал-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";
 print '<tr><td bgcolor=#880000><font class="main">Название</td>';
 $query = 'SELECT name,korp_id FROM korp ORDER BY id';
 $p = mysql_query ($query,$i);
 $max=1;
 for ($z=1;$z<=50;$z++)
        {
         $uo = mysql_fetch_row ($p);    
         if ($uo == true)
           {
            print '<td bgcolor=#880000><font class="main">'; print $uo[0]; print '</td>';
            $max++;
           }
        }
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';

 $query = 'SELECT * FROM people';
}
if ($_GET["menu"]=='11')
{
 $query = 'SELECT * FROM production';
 $max=5;

 include ("./top.php");
 echo "<title>Продукция-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";

 print '<tr><td bgcolor=#880000><font class="main">Название</td><td bgcolor=#880000><font class="main">Корпус</td><td bgcolor=#880000><font class="main">Уд. потребление воды</td><td bgcolor=#880000><font class="main">Количество продукции</td><td bgcolor=#880000><font class="main">Арендатор</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='12')
{
 include ("./top.php");
 echo "<title>Отчеты-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
}
if ($_GET["menu"]=='13')
{
 $query = 'SELECT * FROM shelf';
 $max=3;
 include ("./top.php");
  echo "<title>Шкафы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";
 print '<tr><td bgcolor=#880000><font class="main">Название</td><td bgcolor=#880000><font class="main">Описание</td><td bgcolor=#880000><font class="main">Корпус</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';
}

if ($_GET["menu"]=='14')
{
 $max=23;
 include ("./top.php");
 $query = 'SELECT * FROM equipment WHERE (date_prov_s<10000000+NOW()) OR date_prov_s<NOW()';
 $e = mysql_query ($query,$i); 
 for ($z=1;$z<=500;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true)
	 {
          $query = 'SELECT name FROM uzel WHERE id='.'\''. $ui[10].'\'';
          $p = mysql_query ($query,$i); $uo = mysql_fetch_row ($p);
          if ($uo == true) $uzel=$uo[0]; else $uzel='неизвестен';
          $query = 'SELECT name FROM shelf WHERE id='.'\''. $ui[11].'\'';
          $p = mysql_query ($query,$i); $uo = mysql_fetch_row ($p);
          if ($uo == true) $shelf=$uo[0];
	  print '<tr><td bgcolor=#ff0000 colspan=15><font class="man">';
	  print 'Achtung! </font><font class="dr">'.$ui[1].' [s/n: '.$ui[9].' (Узел: '.$uzel.' / Шкаф: '.$shelf.') срок следующей поверки </font><font class="man">'.$ui[6];
	  print '</font></td></tr>';
	 }
     }
 $query = 'SELECT * FROM equipment'; 
 if ($_GET["sort"]=='1') $query = $query . ' ORDER BY shelf';
 if ($_GET["sort"]=='2') $query = $query . ' ORDER BY name';
 if ($_GET["sort"]=='3') $query = $query . ' ORDER BY uzel';

 echo "<title>Приборы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";
 print '<tr align=center><td bgcolor=#880000><a href="88.php?menu=14&sort=2"><font class="main">Название</font></a></td><td bgcolor=#880000><font class="main">Дата покупки</td><td bgcolor=#880000><font class="main">Дата пер.монтажа</td><td bgcolor=#880000><font class="main">Дата ввода в эксплуатацию</td><td bgcolor=#880000><font class="main">Дата пров. первичной проверки</td>
 <td bgcolor=#880000><font class="main">Дата пров. следующей проверки</td><td bgcolor=#880000><font class="main">Период между поверками</td>
 <td bgcolor=#880000><font class="main">Тип прибора</td><td bgcolor=#880000><font class="main">Серийный номер</td>
 <td bgcolor=#880000><a href="88.php?menu=14&sort=3"><font class="main">Узел учета</font></a></td><td bgcolor=#880000 align=center><a href="88.php?menu=14&sort=1"><font class="main">Шкаф</font></a></td>
 <td bgcolor=#880000><font class="main">Дата последнего демонтажа</td><td bgcolor=#880000><font class="main">Причина демонтажа</td>
 <td bgcolor=#880000><font class="main">Дата последнего монтажа</td><td bgcolor=#880000><font class="main">Причина монтажа</td>
 <td bgcolor=#880000><font class="main">История и отзывы</td><td bgcolor=#880000><font class="main">Диаметр</td> <td bgcolor=#880000><font class="main">Тип датчика</td>
 <td bgcolor=#880000><font class="main">Pmin</td> <td bgcolor=#880000><font class="main">Pmax</td>
 <td bgcolor=#880000><font class="main">Погрешность</td><td bgcolor=#880000><font class="main">Энергоресурс</td><td bgcolor=#880000><font class="main">Тип погрешности</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#880000><font class="main">Ред.</td><td bgcolor=#880000><font class="main">Уд.</td>';
 print '</tr>';

}

if ($_GET["menu"]=='15')
{
 $query = 'SELECT id,time,code,descr,who,ip FROM register';
 $edit=0;
 $max=5;
 include ("./top.php");
 echo "<title>Журнал-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#880000><font class="main">Время</td><td bgcolor=#880000><font class="main">Код ошибки</td><td bgcolor=#880000 align=center><font class="main">Описание</td><td bgcolor=#880000 align=center><font class="main">Кто</td><td bgcolor=#880000 align=center><font class="main">IP-адрес</td><td bgcolor=#880000><font class="main">Уд.</td>';
}

if ($_GET["menu"]=='16')
{
 $query = 'SELECT * FROM sensors';
 $edit=0; $max=2;

 include ("./top.php");
 echo "<title>Датчики-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#880000><font class="main">Название</td><td bgcolor=#880000><font class="main">Тип</td><td bgcolor=#880000><font class="main">Уд.</td></tr>';
}

if ($_GET["menu"]=='17')
{
 include ("./top.php");
 echo "<title>Баланс-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 $edit=0; $del=0;
 $date=getdate(); $mon=$date['mon']; $year=$date['year'];
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#880000 align=center><font class="main">Время</font></td>';
 for ($z=1;$z<=100;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true)       
	if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
		print '<td bgcolor=#880000 align=center><font class="main">'.$ui[1].'</td>';
     }
 print '</tr>';
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#880000><font class="main"></font></td>';
 for ($z=1;$z<=10;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
      if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
         {        
          if ($ui[2]==0) print '<td bgcolor=#880000 align=center><font class="main">Массовый расход (кг)</td>';
          if ($ui[2]==1) print '<td bgcolor=#880000 align=center><font class="main">Тепловая мощность(ГКал/ч)</td>';
          if ($ui[2]==2) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход воды (м3)</td>';                                         	 	
          if ($ui[2]==3) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход пара (м3)</td>';
          if ($ui[2]==4) print '<td bgcolor=#880000 align=center><font class="main">Массовый расход газа (кг)</td>';
          if ($ui[2]==5) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==6) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==7) print '<td bgcolor=#880000 align=center><font class="main">Мощность (кВт)</td>';        
         }
     }
 print '</tr>';
 for ($p=1; $p<=12; $p++)
     {
      if ($mon=='1') print '<tr><td><font class="down">Январь ('.$year.')</font></td>';
      if ($mon=='2') print '<tr><td><font class="down">Февраль ('.$year.')</font></td>';
      if ($mon=='3') print '<tr><td><font class="down">Март ('.$year.')</font></td>';
      if ($mon=='4') print '<tr><td><font class="down">Апрель ('.$year.')</font></td>';
      if ($mon=='5') print '<tr><td><font class="down">Май ('.$year.')</font></td>';
      if ($mon=='6') print '<tr><td><font class="down">Июнь ('.$year.')</font></td>';
      if ($mon=='7') print '<tr><td><font class="down">Июль ('.$year.')</font></td>';
      if ($mon=='8') print '<tr><td><font class="down">Август ('.$year.')</font></td>';
      if ($mon=='9') print '<tr><td><font class="down">Сентябрь ('.$year.')</font></td>';
      if ($mon=='10') print '<tr><td><font class="down">Октябрь ('.$year.')</font></td>';
      if ($mon=='11') print '<tr><td><font class="down">Ноябрь ('.$year.')</font></td>';
      if ($mon=='12') print '<tr><td><font class="down">Декабрь ('.$year.')</font></td>';
      $query = 'SELECT * FROM energy_supply';
      $e = mysql_query ($query,$i);
      for ($z=1;$z<=10;$z++)
  	  {
	   $ui = mysql_fetch_row ($e);
	   if ($ui == true) 
           if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	      {
	       if ($mon<10) $mont='0'.$mon; else $mont=$mon;
	       $sour=$ui[2]+1; $vhod=0; $sum=0;
	       $query = 'SELECT * FROM data WHERE korp=101 AND type=4 AND source='.$ui[2].' AND date='.$year.$mont.'01000000';	
	       $r = mysql_query ($query,$i);
	       if ($r)
	     	  {
	     	   $uo = mysql_fetch_row ($r);
		   $vhod=$uo[7];
	          }
	       if ($mon<12) { $mont1=$mon+1; $year1=$year;} else { $mont1=1; $year1=$year+1; }
	       if ($mont1<10) $mont1='0'.$mont1; else  $mont1=''.$mont1;
	       $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND type=4 AND source='.$ui[2].' AND (date='.$year1.$mont1.'01000000 OR date='.$year1.$mont1.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';
	       if ($ui[2]==1) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=35 AND korp!=22 AND type=4 AND source='.$ui[2].' AND (date='.$year1.$mont1.'01000000 OR date='.$year1.$mont1.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';
	       if ($ui[2]==2) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=61 AND korp!=6 AND korp!=38 AND korp!=39 AND korp!=31 AND korp!=35 AND korp!=22 AND type=4 AND source='.$ui[2].' AND (date='.$year1.$mont1.'01000000 OR date='.$year1.$mont1.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';			 
	       if ($ui[2]==5) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=61 AND korp!=6 AND korp!=1 AND korp!=39 AND korp!=31 AND type=4 AND source='.$ui[2].' AND (date='.$year1.$mont1.'01000000 OR date='.$year1.$mont1.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';

//	       echo $query; 
	       $r = mysql_query ($query,$i);
	       if ($r)
	     	  {
	     	   $uo = mysql_fetch_row ($r);
		   $sum=$uo[0]; if ($sum=='') $sum=0;
	          }
               if ($sum+$vhod>0) $pr = ($sum-$vhod)*100/($sum+$vhod);
               else $pr=0;
 	       print '<td><font class="down">'; 
	       printf ("%.3f",$sum); print ' / '.$vhod.' </font>';
  	       if (abs($pr)>20) print '<font class="nkor">'; 
	       else print '<font class="date">'; 
	       print ' ['; printf ("%.2f",$pr); print '%]</font></td>';
	     }
	 }
     if ($mon>1) $mon--;
     else
     	{
     	 $mon=12;
     	 $year--;
     	}
    }
}

if ($_GET["menu"]=='18')
{
 include ("./top.php");
 echo "<title>Баланс суточный-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 $edit=0; $del=0;
 $date=getdate(); $mon=$date['mon']; $year=$date['year'];
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#880000 align=center><font class="main">Время</font></td>';
 for ($z=1;$z<=10;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
	{
	 if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	    	print '<td bgcolor=#880000 align=center><font class="main">'.$ui[1].'</td>';
	 if ($ui[2]==0) print '<td colspan=2 bgcolor=#880000 align=center><font class="main">'.$ui[1].'</td>';
	}
     }
 print '</tr>';
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#880000><font class="main"></font></td>';
 for ($z=1;$z<=10;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
      if ($ui[2]==0 || $ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
         {        
          if ($ui[2]==0) print '<td bgcolor=#880000 align=center><font class="main">Масса по подающей (т.)</td><td bgcolor=#880000 align=center><font class="main">Масса по обратной (т.)</td>';
          if ($ui[2]==1) print '<td bgcolor=#880000 align=center><font class="main">Тепловая мощность(ГКал)</td>';
          if ($ui[2]==2) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход воды (м3)</td>';
          if ($ui[2]==3) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход пара (ГКал)</td>';
          if ($ui[2]==4) print '<td bgcolor=#880000 align=center><font class="main">Массовый расход газа (кг)</td>';
          if ($ui[2]==5) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==6) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==7) print '<td bgcolor=#880000 align=center><font class="main">Мощность (кВт)</td>';
         }
     }
 print '</tr>';
 $today=getdate ();
 $x=0; $mx=$today[mday]; $mn=1; $nx=2; $nn=1;
 $mx=$mx+0; $month=$today[mon]; $year=$today[year];
 for ($tn=$nx; $tn>=$nn; $tn--)
 for ($tm=$mx; $tm>=$mn; $tm--)
    {
     	   if ($tn==1 && $tm==31) 
		{ 
		 if ($month>1) $month--; 
			else { $month=12; $year--;}
		}
     if (checkdate ($month,$tm,$year))  
 	 {
           $mx=31;
	   if ($month<10) $mont='0'.$month; else $mont=''.$month;
	   if ($tm<10) { $dat='0'.$tm.'-'.$mont.'-'.$year.' 00:00'; $dats='0'.$tm; }
	   else { $dat=$tm.'-'.$mont.'-'.$year.' 00:00'; $dats=''.$tm; }
	   print '<tr><td><font class="down">'.$dat.'</font></td>';
	   $query = 'SELECT * FROM energy_supply';
	   $e = mysql_query ($query,$i);
	   for ($z=1;$z<=10;$z++)
	      {
		$ui = mysql_fetch_row ($e);
		if ($ui == true) 
	        if ($ui[2]==0 || $ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
		   {
	            if ($ui[2]!=0)
			{
	        	 $query = 'SELECT * FROM data WHERE type=2 AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND korp=101 AND source='.$ui[2];
  	  	         $sour=$ui[2]+1; $vhod=0; $sum=0;
 	        	 $r = mysql_query ($query,$i);
	  	         if ($r)
		     	    {
	     		     $uo = mysql_fetch_row ($r);
			     $vhod=$uo[7];
			     $o_vhod[$z][$tn][$tm]=$vhod;
		            }
			 $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND type=2 AND source='.$ui[2].' AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\') OR (name LIKE  \'%массы%\'))';
		         if ($ui[2]==1) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=35 AND korp!=22 AND type=2 AND source='.$ui[2].' AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\') OR (name LIKE  \'%массы%\'))';			 
			 if ($ui[2]==2) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=61 AND korp!=6 AND korp!=38 AND korp!=39 AND korp!=31 AND korp!=35 AND korp!=22 AND type=2 AND source='.$ui[2].' AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\') OR (name LIKE  \'%массы%\'))';			 
			 if ($ui[2]==5) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=61 AND korp!=6 AND korp!=1 AND korp!=39 AND korp!=31 AND type=2 AND source='.$ui[2].' AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\') OR (name LIKE  \'%массы%\'))';			 
	                 $r = mysql_query ($query,$i);
		         if ($r)
		     	       {
	     		        $uo = mysql_fetch_row ($r);
		        	$sum=$uo[0]; if ($sum=='') $sum=0;
		               }
        	         if ($sum+$vhod>0) $pr = ($sum-$vhod)*100/($sum+$vhod);
                	 else $pr=0;
	   	         print '<td><font class="down">'; printf ("%.2f",$sum); print ' / '.$vhod.' </font>'; 
		  	 if (abs($pr)>20) print '<font class="nkor">'; 
			 else print '<font class="date">'; 
			 print '['; printf ("%.1f",$pr); print '%]</font></td>';
			}
		    else
			{
	        	 $query = 'SELECT * FROM data WHERE type=2 AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND korp=101 AND source='.$ui[2];
  	  	         $sour=$ui[2]+1; $vhod1=0; $vhod0=0;
 	        	 $r = mysql_query ($query,$i);
	  	         if ($r)
		     	    {
  			     for ($ze=1;$ze<=10;$ze++)
				 {
	 	    		  $uo = mysql_fetch_row ($r);
				  if (strstr ($uo[1],'подающей')) { $vhod1=$uo[7]; $o_vhod1[$z][$tn][$tm]=$vhod1;}
			          if (strstr ($uo[1],'обратной')) { $vhod0=$uo[7]; $o_vhod0[$z][$tn][$tm]=$vhod0; }
				 }
		            }
		         $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=35 AND korp!=22 AND type=2 AND source='.$ui[2].' AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND name LIKE \'%подающей%\' AND name LIKE \'%массы%\'';
	                 $r = mysql_query ($query,$i);
		         if ($r) {
	     		        $uo = mysql_fetch_row ($r);
		        	$dt1=$uo[0]; if ($dt1=='') $dt1=0;  }
		         $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=35 AND korp!=22 AND type=2 AND source='.$ui[2].' AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND name LIKE \'%обратной%\' AND name LIKE \'%массы%\'';
	                 $r = mysql_query ($query,$i);
		         if ($r) {
	     		        $uo = mysql_fetch_row ($r);
		        	$dt0=$uo[0]; if ($dt0=='') $dt0=0;  }			 
        	         if ($dt1+$vhod1>0) $pr1 = ($dt1-$vhod1)*100/($dt1+$vhod1);
                	 else $pr1=0;
        	         if ($dt0+$vhod0>0) $pr0 = ($dt0-$vhod0)*100/($dt0+$vhod0);
                	 else $pr0=0;
	   	         print '<td><font class="down">'; printf ("%.2f",$dt1); print ' / '.$vhod1.' </font>'; 
		  	 if (abs($pr1)>20) print '<font class="nkor">'; 
			 else print '<font class="date">'; 
			 print '['; printf ("%.1f",$pr1); print '%]</font></td>';
	   	         print '<td><font class="down">'; printf ("%.2f",$dt0); print ' / '.$vhod0.' </font>'; 
		  	 if (abs($pr0)>20) print '<font class="nkor">'; 
			 else print '<font class="date">'; 
			 print '['; printf ("%.1f",$pr0); print '%]</font></td>';
			}		
	          }
	      }
	  print '</tr>';
	}
    }
}

$e = mysql_query ($query,$i); 
if ($query=='USE askuer') $ma=0;
else $ma=1000;
for ($z=1;$z<=$ma;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<tr>';
    for ($j=1;$j<=$max;$j++)    
        {
         if ($_GET["menu"]=='9' && $ui[4]=='1') print '<td bgcolor=#111155><font class="dd">';
         else print '<td bgcolor=#111111><font class="dd">';
         if ($_GET["menu"]=='5' && $j==3)
          {
                if ($ui[$j]==3) print 'Администратор';
                if ($ui[$j]==2) print 'Оператор';
                if ($ui[$j]==1) print 'Пользователь';
          }
         else 
         if (($_GET["menu"]=='6' && $j==2) || ($_GET["menu"]=='14' && $j==22))
          {
           $query = 'SELECT caption FROM energy_supply WHERE id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) print $uo[0];
           else print $ui[2];
          }
         else 
         if ($_GET["menu"]=='4' && $j==1)
          {
           print '<a href="88.php?menu=6&sour='; print $ui[2]; print '">'; 
           echo $ui[$j];  print '</a>';
          }
         else 
         if ($_GET["menu"]=='2' && $j==2)
          {
           print '<a href="88.php?menu=9&korp='; print $ui[1]; print '">'; 
           echo $ui[$j];  print '</a>';
          }
         else 
         if ($_GET["menu"]=='1' && $j==1)
          {
           print '<a href="88.php?menu=9&aren='; print $ui[0]; print '">'; 
           echo $ui[$j];  print '</a>';
          }
         else 
         if (($_GET["menu"]=='6' && $j==3) || ($_GET["menu"]=='13' && $j==3) || ($_GET["menu"]=='9' && $j==3) || ($_GET["menu"]=='11' && $j==2))
          {
           $query = 'SELECT name FROM korp WHERE korp_id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) 
                {
                  print '<a href="88.php?menu=9&korp='; print $ui[$j]; print '">'; 
                  echo $uo[0];  print '</a>';
                }
           else print 'Unknown';
          }
         else 
         if (($_GET["menu"]=='9' && $j==2) || ($_GET["menu"]=='11' && $j==5))
          {
           $query = 'SELECT caption FROM buyers WHERE idx='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) 
                {
                  print '<a href="88.php?menu=9&aren='; print $ui[$j]; print '">'; 
                  echo $uo[0];  print '</a>';
                }
           else print 'Unknown';
          }
         else 
         if ($_GET["menu"]=='9' && $j==4)
          {
           if ($ui[$j]=='1') print 'Корпус';
           if ($ui[$j]=='2') print 'Помещение';
           if ($ui[$j]=='3') print 'Агрегат';
          }
         else
         if ($_GET["menu"]=='9' && $j==6)
          {
           if ($ui[$j]=='1') print 'Вспомогательное';
           if ($ui[$j]=='2') print 'Производственное';
           if ($ui[$j]=='3') print 'Складское';
           if ($ui[$j]=='4') print 'Пустующее';
           if ($ui[$j]=='5') print 'Административное';
           if ($ui[$j]=='6') print 'Санитарно-бытовое';
          }
         else
         if ($_GET["menu"]=='14' && $j==8)
          {
           if ($ui[$j]=='1') print 'Контрольно-измерительное';
           if ($ui[$j]=='2') print 'Сетевое и коммуникационное';
           if ($ui[$j]=='3') print 'Источники питания и пуско-защита';
           if ($ui[$j]=='4') print 'Вспомогательное';
           if ($ui[$j]=='5') print 'Вычислители';
           if ($ui[$j]=='6') print 'Материалы';
          }
         else
         if ($_GET["menu"]=='14' && ($j==2 || $j==3 || $j==4 || $j==4 || $j==5 || $j==6 || $j==12 || $j==14))
	  {
           print substr ($ui[$j],0,10);
	  }
         else
         if ($_GET["menu"]=='14' && $j==10)
          {
           $query = 'SELECT name FROM uzel WHERE id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) 
                {
                  print '<a href="uzel.php?id='; print $ui[$j]; print '">'; 
                  echo $uo[0];  print '</a>';
                }
           else print 'Unknown';
          }
         else
         if ($_GET["menu"]=='14' && $j==18)
          {
           $query = 'SELECT name FROM sensors WHERE id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) print $uo[0];
           else print 'Unknown';
          }
         else
         if ($_GET["menu"]=='14' && $j==11)
          {
           $query = 'SELECT name FROM shelf WHERE id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) print $uo[0];
           else print 'Unknown';
          }
         else
         if ($_GET["menu"]=='14' && $j==23)
          {
           if ($ui[$j]==1) print 'Абсолютная';
           else print 'Относительная';
          }
         else
         if ($_GET["menu"]=='9' && $j>6)
          {
           printf ("%.9f",$ui[$j]);
          }
         else
         if ($_GET["menu"]=='6' && $j==8)
          {
           if ($ui[$j] == '1') print 'Есть';
           else print 'Нет';
          }
         else
         if ($_GET["menu"]=='6' && $j>8)
          {
           if ($ui[2]==0) 
                {
                 if ($j==11) 
			{
			 print '<font title="Измеренное значение температуры воды по подающей трубе (С)" class="dd">';
			 printf ("%.2f",$ui[$j]); print '(С)</font>';
			}
                 if ($j==9) 
			{
			 print '<font title="Объемный расход воды по подающей трубе (м3/ч)" class="dd">';
			 if ($ui[$j]<200) printf ("%.2f",$ui[$j]);
			 else printf ("%.2f",$ui[$j]/1000);
			 print '(м3/ч)</font>';
			}
                 if ($j==12) 
			{
			 print '<font title="Измеренное значение температуры воды по обратной трубе (С)" class="dd">';
			 printf ("%.2f",$ui[$j]); print '(С)</font>';
			}
                 if ($j==10) 
			{
			 print '<font title="Объемный расход воды по обратной трубе (м3/ч)" class="dd">';
			 if ($ui[$j]<200) printf ("%.2f",$ui[$j]);
			 else printf ("%.2f",$ui[$j]/1000);
			 print '(м3/ч)</font>';
			}
                }
           if ($ui[2]==1)
                {
                 if ($j==9) 
			{
			 print '<font title="Разность температур (С)" class="dd">';
			 printf ("%.2f",$ui[$j]); print '(С)</font>';
			}
                 if ($j==10) 
			{
			 if (!strstr($ui[5],"com8") && !strstr($ui[5],"com11") && !strstr($ui[5],"com3")) 
				{
	        	         $ui[$j]=$ui[$j]*1000;
				 if ($ui[$j]<0) { $ui[$j]=0; print '<font title="Тепловая мощность (!ошибка датчика)" class="dd">';}
				 else print '<font title="Тепловая мощность по магистрали (ККал/ч)" class="dd">';
				 printf ("%.3f",$ui[$j]); print '(ККал/ч)</font>';
				}
			 else
				{
	        	         $ui[$j]=$ui[$j]*1000;
				 if ($ui[$j]<0) { $ui[$j]=0; print '<font title="Тепловая мощность (!ошибка датчика)" class="dd">';}
				 else print '<font title="Тепловая мощность с начала часа (ККал)" class="dd">';
				 printf ("%.3f",$ui[$j]); print '(ККал)</font>';
				}
			}
                }
           if ($ui[2]==2)
                {
                 if ($j==9) 
			{
			 print '<font title="Объемный расход воды (м3/ч)" class="dd">';
			 printf ("%.2f",$ui[$j]); print '(м3/ч)</font>';
			}
                }
           if ($ui[2]==4 || $ui[2]==5 || $ui[2]==6)
                {
                 if ($j==9) print '<font title="Измеренное значение давления (МПа)" class="dd">'.$ui[$j].'(МПа)</font>';
                 if ($j==10) { print '<font title="Измеренное значение температуры (С)" class="dd">'; printf ("%.2f",$ui[$j]); print '(С)</font>';}
                 if ($j==11)  if ($ui[2]==4) print '<font title="Массовый расход (кг/ч)" class="dd">'.$ui[$j].'(кг/ч)</font>';
                 if ($j==11) if ($ui[2]==5 || $ui[2]==6) 
			{
			 print '<font title="Объемный расход (м3/ч)" class="dd">';
			 printf ("%.2f",$ui[$j]); print '(м3/ч)</font>';
			}
                }

           if ($ui[2]==7)
                {
                 if ($j==9) print '<font title="Мощность (кВт)" class="dd">'.$ui[$j].'(кВт/ч)</font>';
                }
          }
         else
         if ($_GET["menu"]=='6' && $j==1)
          {
           print '<a href="uzel.php?id='; print $ui[0]; print '">'; 
           echo $ui[$j];  print '</a>';
          }             
         else  echo $ui[$j];
         print '</td>';
        }
    if ($edit==1)
        {
        if(($HTTP_COOKIE_VARS[user_priv]==3) || ($HTTP_COOKIE_VARS[user_priv]==2))
         {
          print '';
          print '<td width=20><table><tr><form name="redr" method=post action="form_red.php"><td>';
          print '<input alt=Edit border=0 name=B1 src="files/chat.gif" type=image align=right style="cursor: hand"></td><td><input name="idn" style="width:1; height:1;  visibility:hidden" value="';   echo $ui[0];
          print '"><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="'; print $_GET["menu"]; print '"></td></form></tr></table></td>';
         }
        }
    if ($del==1)
        {
        if(($HTTP_COOKIE_VARS[user_priv]==3) || ($HTTP_COOKIE_VARS[user_priv]==2))
         {
         print '<form name="redd" method=post action="udbd.php">';
         print '<td width=20><table><tr><td><font class="down">';
         print '<input alt=Delete border=0 name=B1 src="files/backw.gif" type=image align=right style="cursor: hand"></td><td><input name="idn" style="width:1; height:1;  visibility:hidden" value="';   echo $ui[0];
         print '"><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="'; print $_GET["menu"]; print '"></td></tr></table></td></form>';
         }
        }
   }
}
?>
</table><br>
</td><tr>
<tr><td>
<table border=0 align=center bgcolor=#111111>
<?php
if ($_GET["menu"]=='1')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название арендатора </font></td><td><input name="nam" size=20 class=log style="height:18px"></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td></tr>';
print '<tr><td align=right><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="1"></td><td></td></tr></form>';

}
}
if ($_GET["menu"]=='2')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Идентификатор корпуса </font></td><td><input name="korp_id" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Тип корпуса </font></td><td>
<select class=log id="type" name="type" style="height:18">
<option value="1">Производственное здание
<option value="1">Административное здание
<option value="1">Складское здание
<option value="2">Теплица
<option value="5">Вход предприятия
<option value="6">Выход предприятия</select></td><td></td></tr>';
print '<tr><td><font class="down">Название корпуса </font></td><td><input name="name" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Краткое описание </font></td><td><textarea name="descr" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="2"></td></tr></form>';
}

}
if ($_GET["menu"]=='4')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название ресурса </font></td><td><input name="nam" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Идентификатор </font></td><td><input name="id" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Тариф за еденицу </font></td><td><input name="price" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="4"></td></tr></form>';
}

}
if ($_GET["menu"]=='5')
{
 if ($HTTP_COOKIE_VARS[user_priv]==3)
  {
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Пользователь </font></td><td><input name="user" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Пароль </font></td><td><input name="passwd" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Категория </font></td><td>
<select class=log id="user_priveleges" name="user_priveleges" style="height:18">
<option value="3">Администратор
<option value="2">Оператор
<option value="1">Пользователь</select></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="5"></td></tr></form>';
  }
}
if ($_GET["menu"]=='7')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название </font></td><td><input name="caption" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Входящие энергоресурсы </font></td><td><input name="inc_energy" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Исходящие энергоресурсы </font></td><td><input name="out_energy" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Широта </font></td><td><input name="latitude" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Долгота </font></td><td><input name="longtitude" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Высота </font></td><td><input name="height" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Площадь </font></td><td><input name="square" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Холодный период </font></td><td><input name="cold_period" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Температура </font></td><td><input name="temperature" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Давление </font></td><td><input name="atm_pressure" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Влажность </font></td><td><input name="humidity" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Солнечных дней </font></td><td><input name="sunny_days" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Расчетная температура для холодного времени года </font></td><td><input name="rs_temp" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="7"></td></tr></form>';
}
}
if ($_GET["menu"]=='8')
{
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Идентификатор методики </font></td><td><input name="idn" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Название методики </font></td><td><input name="name" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="8"></td></tr></form>';
}
if ($_GET["menu"]=='9')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="main">Название</td><td colspan=3><input name="name" size=70 class=log style="height:18px"></td></tr>';
print '<tr><td><font class="main">Арендаторы</td><td><select class=log id="idbuy" name="idbuy" style="height:18">';
print '<option value="0">'; print 'нет';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td><font class="main">Площадь объекта</td><td><input name="square" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td><td><select class=log id="idbuy2" name="idbuy2" style="height:18">';
print '<option value="0">'; print 'нет';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td><font class="main">Полезный объем (для помещений)</td><td><input name="wall_square" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td></td><td><select class=log id="idbuy3" name="idbuy3" style="height:18">';
print '<option value="0">'; print 'нет';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td><font class="main">Номер БТИ</td><td><input name="BTI" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td></td><td><select class=log id="idbuy4" name="idbuy4" style="height:18">';
print '<option value="0">'; print 'нет';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td><font class="main">Высота</td><td><input name="height" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td></td><td><select class=log id="idbuy5" name="idbuy5" style="height:18">';
print '<option value="0">'; print 'нет';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td><font class="main">Этаж</td><td><input name="level" size=10 class=log style="height:18px"></td></tr>';
//print '<tr><td><font class="main">Количество арендаторов, использующих объект</td><td><input name="buy_q" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="main">Корпус</td><td><select class=log id="idkorp" name="idkorp" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT korp_id,name FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td>';
print '<td><font class="main">Тип помещения/корпуса</td><td><select class=log id="typeR" name="typeR" style="height:18">';
print '<option value="1">Вспомогательное'; 
print '<option value="2">Производственное'; 
print '<option value="3">Складское'; 
print '<option value="4">Пустующее'; 
print '<option value="5">Административное'; 
print '<option value="6">Санитарно-бытовое'; 
print '</select></td></tr>';

print '<tr><td><font class="main">Тип объекта</td><td><select class=log id="type" name="type" style="height:18">';
print '<option value="1">Корпус'; 
print '<option value="2">Помещение'; 
print '<option value="3">Агрегат'; 
print '</select></td></tr>';
print '<tr><td><font class="main">Величина потребления сжатого воздуха</td><td><input name="Qszh" size=10 class=log style="height:18px"></td><td><font class="main">Потребляемая мощность</td><td><input name="Q_agr" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td><font class="main">Величина потребления кислорода</td><td><input name="Qkisl" size=10 class=log style="height:18px"></td>';

print '<tr><td><font class="main">Величина потребления газа</td><td><input name="Qgaza" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td><font class="main">Величина потребления воды</td><td><input name="Qvod" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td><font class="main">Величина потребления пара</td><td><input name="Qpara" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="9"></td></tr></form>';
}
}

if ($_GET["menu"]=='11')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="main">Название</td><td><input name="name" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="main">Арендатор</td><td><select class=log id="idbuy" name="idbuy" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">Корпус</td><td><select class=log id="idkor" name="idkor" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT name,korp_id FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[1]; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">Удельное потребление воды на еденицу </td><td><input name="udpr" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="main">Количество продукции в месяц</td><td><input name="quant" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="11"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='12')
{
print '<tr><td><table border=0 width=850 align=center>';
include("inc/report.php"); 
print '</table></td></tr>';
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='16')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
{
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название датчика</font></td><td><input name="name" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Тип датчика</td><td><select class=log id="type" name="type" style="height:18">';
print '<option value="1">Расход'; 
print '<option value="2">Давление'; 
print '<option value="3">Температура'; 
print '<option value="9">Остальное'; 
print '</select></td><td>
</td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="16"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='17')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
{
print '<form name="reda" method=post action="tobd.php">';
$date=getdate(); $mon=$date['mon']; $year=$date['year'];
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#880000 align=center><font class="main">Время</font></td>';
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
 if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	print '<td bgcolor=#880000 align=center><font class="main">'.$ui[1].'</td>';
}
print '</tr>';
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#111111><table><tr><td><font class="dd">изменить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></font></td></tr></table></td>';
for ($z=1;$z<=10;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
 if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
    {        
     if ($ui[2]==0) print '<td bgcolor=#880000 align=center><font class="main">Массовый расход (кг)</td>';
     if ($ui[2]==1) print '<td bgcolor=#880000 align=center><font class="main">Тепловая мощность(ГДж/ч)</td>';
     if ($ui[2]==2) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход воды (м3)</td>';                                         	 	
     if ($ui[2]==3) print '<td bgcolor=#880000 align=center><font class="main">Расход пара (Гкал)</td>';
     if ($ui[2]==4) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход газа (м3)</td>';
     if ($ui[2]==5) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==6) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==7) print '<td bgcolor=#880000 align=center><font class="main">Мощность (кВт)</td>';        
    }
}
print '</tr>';
for ($p=1; $p<=12; $p++)
    {
     if ($mon=='1') print '<tr><td><font class="down">Январь ('.$year.')</font></td>';
     if ($mon=='2') print '<tr><td><font class="down">Февраль ('.$year.')</font></td>';
     if ($mon=='3') print '<tr><td><font class="down">Март ('.$year.')</font></td>';
     if ($mon=='4') print '<tr><td><font class="down">Апрель ('.$year.')</font></td>';
     if ($mon=='5') print '<tr><td><font class="down">Май ('.$year.')</font></td>';
     if ($mon=='6') print '<tr><td><font class="down">Июнь ('.$year.')</font></td>';
     if ($mon=='7') print '<tr><td><font class="down">Июль ('.$year.')</font></td>';
     if ($mon=='8') print '<tr><td><font class="down">Август ('.$year.')</font></td>';
     if ($mon=='9') print '<tr><td><font class="down">Сентябрь ('.$year.')</font></td>';
     if ($mon=='10') print '<tr><td><font class="down">Октябрь ('.$year.')</font></td>';
     if ($mon=='11') print '<tr><td><font class="down">Ноябрь ('.$year.')</font></td>';
     if ($mon=='12') print '<tr><td><font class="down">Декабрь ('.$year.')</font></td>';

     $query = 'SELECT * FROM energy_supply';
     $e = mysql_query ($query,$i);
     for ($z=1;$z<=10;$z++)
	{
	 $ui = mysql_fetch_row ($e);
	 if ($ui == true) 
         if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	    {
	     if ($mon<10) $mont='0'.$mon; else $mont=$mon;
	     $sour=$ui[2]+1;
	     $query = 'SELECT * FROM data WHERE korp=101 AND type=4 AND source='.$ui[2].' AND date='.$year.$mont.'01000000';
	     //echo $query;
	     $r = mysql_query ($query,$i);
	     if ($r)
	     	{
	     	 $uo = mysql_fetch_row ($r);
 		 print '<td><input name="'.$mont.'-'.$sour.'-value" value="'.$uo[7].'" size=10 class=log style="height:18px">
 		 <input name="'.$mont.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
 		 <input name="'.$mont.'-'.$sour.'-date" value="'.$year.$mont.'01000000" size=1 style="height:1;width:1;visibility:hidden">
                 <input name="'.$mont.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>';
	        }
	     else
	     	{
		 print '<td><input name="'.$mont.'-'.$sour.'-value" value="0.0" size=10 class=log style="height:18px">
 		 <input name="'.$mont.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
 		 <input name="'.$mont.'-'.$sour.'-date" value="'.$year.$mont.'01000000" size=1 style="height:1;width:1;visibility:hidden">
                 <input name="'.$mont.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>';
                }
	    }
	}
     if ($mon>1) $mon--;
     else
     	{
     	 $mon=12;
     	 $year--;
     	}
    }
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="17"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='18')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
{
print '<form name="reda" method=post action="tobd.php">';
$date=getdate(); $mon=$date['mon']; $year=$date['year'];
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#880000 align=center><font class="main">Время</font></td>';
for ($z=1;$z<=10;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
    {
     if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	print '<td bgcolor=#880000 align=center><font class="main">'.$ui[1].'</td>';
     if ($ui[2]==0) print '<td bgcolor=#880000 colspan=2 align=center><font class="main">'.$ui[1].'</td>';
    }
}
print '</tr>';
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#111111><table><tr><td><font class="dd">изменить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></font></td></tr></table></td>';
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
 if ($ui[2]==0 || $ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
    {        
     if ($ui[2]==0) print '<td bgcolor=#880000 align=center><font class="main">Масса по подающей (т.)</td><td bgcolor=#880000 align=center><font class="main">Масса по обратной (т.)</td>'; 
     if ($ui[2]==1) print '<td bgcolor=#880000 align=center><font class="main">Тепловая мощность(ГКал)</td>';
     if ($ui[2]==2) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход воды (м3)</td>';
     if ($ui[2]==3) print '<td bgcolor=#880000 align=center><font class="main">Расход пара (Гкал)</td>';
     if ($ui[2]==4) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход газа (м3)</td>';
     if ($ui[2]==5) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==6) print '<td bgcolor=#880000 align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==7) print '<td bgcolor=#880000 align=center><font class="main">Мощность (кВт)</td>';        
    }
}
print '</tr>';

$today=getdate ();
$x=0; $mx=$today[mday]; $mn=1; $nx=2; $nn=1;
$mx=$mx+0; $month=$today[mon]; $year=$today[year];
for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
	  if ($tn==1 && $tm==31) 
		{ 
		 if ($month>1) $month--; 
			else { $month=12; $year--;}
		}
     if (checkdate ($month,$tm,$year))  
 	 {
          $mx=31;
          if ($month<10) $mont='0'.$month; else $mont=$month;
	  if ($tm<10) { $dat='0'.$tm.'-'.$mont.'-'.$year.' 00:00'; $dats='0'.$tm;}
	  else { $dat=$tm.'-'.$mont.'-'.$year.' 00:00'; $dats=$tm; }
	  print '<tr><td><font class="down">'.$dat.'</font></td>';
	  $query = 'SELECT * FROM energy_supply';
	  $e = mysql_query ($query,$i);
	  for ($z=1;$z<=10;$z++)
	      {
		$ui = mysql_fetch_row ($e);
		if ($ui == true) {
	        if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
		   {
        	    $query = 'SELECT * FROM data WHERE type=2 AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND korp=101 AND source='.$ui[2];
  	            $sour=$ui[2]+1; $vhod=0; $sum=0;
 //	            $r = mysql_query ($query,$i);
if (1)
//		    if ($r)
		     	{
//		     	 $uo = mysql_fetch_row ($r);
	 		 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-value" value="'.$o_vhod[$z][$tn][$tm].'" size=10 class=log style="height:18px">
	 		 <input name="'.$mont.'-'.$dats.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
	 		 <input name="'.$mont.'-'.$dats.'-'.$sour.'-date" value="'.$year.$mont.$dats.'000000" size=1 style="height:1;width:1;visibility:hidden">
        	         <input name="'.$mont.'-'.$dats.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>'; 
		        }
		     else
		     	{
			 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-value" value="0" size=10 class=log style="height:18px">
	 		 <input name="'.$mont.'-'.$dats.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
	 		 <input name="'.$mont.'-'.$dats.'-'.$sour.'-date" value="'.$year.$mont.$dats.'000000" size=1 style="height:1;width:1;visibility:hidden">
        	         <input name="'.$mont.'-'.$dats.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>';
	                }
	          }
		if ($ui[2]==0)
		   {
        	    $query = 'SELECT * FROM data WHERE type=2 AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND korp=101 AND source='.$ui[2].' AND name LIKE  \'%подающей%\'';
  	            $sour=$ui[2]+1;
 	            //$r = mysql_query ($query,$i);
			if (1)
		    //if ($r)
		     	{
//		     	 $uo = mysql_fetch_row ($r);
	 		 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-valus" value="'.$o_vhod1[$z][$tn][$tm].'" size=10 class=log style="height:18px">';
		        }
		     else
		     	{
			 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-valus" value="0" size=10 class=log style="height:18px">';
	                }
        	    $query = 'SELECT * FROM data WHERE type=2 AND (date='.$year.$mont.$dats.'000000 OR date='.$year.$mont.$dats.'120000) AND korp=101 AND source='.$ui[2].' AND name LIKE  \'%обратной%\'';
  	            $sour=$ui[2]+1;
 	            //$r = mysql_query ($query,$i);
		    //if ($r)
		    if (1)
		     	{
//		     	 $uo = mysql_fetch_row ($r);
	 		 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-value" value="'.$o_vhod0[$z][$tn][$tm].'" size=10 class=log style="height:18px">';
		        }
		     else
		     	{
			 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-value" value="0" size=10 class=log style="height:18px">';
	                }
	 	    print '<input name="'.$mont.'-'.$dats.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
   		 	   <input name="'.$mont.'-'.$dats.'-'.$sour.'-date" value="'.$year.$mont.$dats.'000000" size=1 style="height:1;width:1;visibility:hidden">
        	           <input name="'.$mont.'-'.$dats.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>';
		   }}
	      }
	  print '</tr>';
	}
    }
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="18"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='13')
{
// include ("./top.php");
 echo "<title>Шкафы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) 
{

print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название шкафа</font></td><td><input name="name" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Описание</font></td><td><textarea name="descr" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td><font class="down">Корпус</td><td><select class=log id="idkor" name="idkor" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT korp_id,name FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="13"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='14')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

$today = getdate ();
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название </font></td><td><input name="name" size=40 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Дата покупки </font></td>'; 
print '<td><table><tr><td><select class=log id="date_buy_day" name="date_buy_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_buy_month" name="date_buy_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_buy_year" name="date_buy_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Дата первичного монтажа </font></td>'; 
print '<td><table><tr><td><select class=log id="date_mon_1_day" name="date_mon_1_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_1_month" name="date_mon_1_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_1_year" name="date_mon_1_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Дата ввода в эксплуатацию </font></td>'; 
print '<td><table><tr><td><select class=log id="date_vvod_day" name="date_vvod_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_vvod_month" name="date_vvod_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_vvod_year" name="date_vvod_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Дата первичной поверки </font></td>'; 
print '<td><table><tr><td><select class=log id="date_prov_p_day" name="date_prov_p_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_p_month" name="date_prov_p_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_p_year" name="date_prov_p_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Дата следующей поверки </font></td>'; 
print '<td><table><tr><td><select class=log id="date_prov_s_day" name="date_prov_s_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_s_month" name="date_prov_s_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_s_year" name="date_prov_s_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Период проведения поверки (месяцы)</font></td><td><input name="period_p" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Тип оборудования</td><td><select class=log id="type" name="type" style="height:18">';
print '<option value="1">Контрольно-измерительное'; 
print '<option value="2">Сетевое и коммуникационное'; 
print '<option value="3">Источники питания и пуско-защита';
print '<option value="4">Вспомогательное'; 
print '<option value="5">Вычислители'; 
print '<option value="6">Материалы'; 
print '</select></td></tr>';
print '<tr><td><font class="down">Энергоресурс</font></td><td><select class=log id="source" name="source" style="height:18">';
$query = 'SELECT id,caption FROM energy_supply';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td><font class="down">Серийный номер</font></td><td><input name="serial" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td bgcolor=#111111 width=120><font class="down">Узел учета</font></td><td><select class=log id="uzel" name="uzel" style="height:18">';
$query = 'SELECT id,name FROM uzel';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td bgcolor=#111111 width=120><font class="down">Шкаф</font></td><td><select class=log id="shelf" name="shelf" style="height:18">';
$query = 'SELECT id,name FROM shelf';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td><font class="down">Дата последнего демонтажа </font></td>'; 
print '<td><table><tr><td><select class=log id="date_dem_p_day" name="date_dem_p_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_dem_p_month" name="date_dem_p_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_dem_p_year" name="date_dem_p_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Причина демонтажа</font></td><td><input name="prichina_dem" size=50 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Дата последнего монтажа </font></td>'; 
print '<td><table><tr><td><select class=log id="date_mon_p_day" name="date_mon_p_day" style="height:18">'; include ("inc/today_day.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_p_month" name="date_mon_p_month" style="height:18">'; include ("inc/today_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_p_year" name="date_mon_p_year" style="height:18">'; include ("inc/today_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">Причина монтажа</font></td><td><input name="prichina_mon" size=50 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Краткая история </font></td><td><textarea name="history" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td><font class="down">Диаметр</font></td><td><input name="Du" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td bgcolor=#111111 width=120><font class="down">Тип датчика</font></td><td><select class=log id="s_type" name="s_type" style="height:18">';
$query = 'SELECT id,name FROM sensors';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td><font class="down">Предел (мин.)</font></td><td><input name="Pmin" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Предел (макс.)</font></td><td><input name="Pmax" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Погрешность</font></td><td><input name="d" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Тип погрешности абсолютная</font></td><td><input name="d_type" type=checkbox></td><td></td></tr>';
print '<tr><td align=right><font class="dd">добавить</font></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="14"></td></tr></form>';
}
}
//--------------------------------------------------------------------------

if ($_GET["menu"]=='exit')
{
$PHP_AUTH_USER="";
$PHP_AUTH_PW="";
//phpinfo();
//header("Location: http://oleg/88.php");
//echo $SELF;
?><meta http-equiv="refresh" content="0; url=<?echo $SELF;?>"><?
}
?>
</table>
</td></tr>
<? include ("inc/down.inc"); ?>
</table>
</body>
</html>
<?  }
    else { 
    //header("HTTP/1.1 403 Forbidden");
    $addr=$_SERVER['REMOTE_ADDR'];
    $resq = 'INSERT INTO register (code,descr,who,ip) VALUES (401,'.'\'Пользователь '.$PHP_AUTH_USER.' ввел неправильный пароль ('.$PHP_AUTH_PW.')\','.'\''.$PHP_AUTH_USER.'\',\''.$addr.'\');';
    // echo $resq;
    $db->Execute($resq);
    echo "Нет доступа!!!";
    }
    
 }
 else
  {   
   header("WWW-Authenticate: Basic realm=\"Askuer\"");
   header("HTTP/1.1 401 Authorization Required");
  }
?>
