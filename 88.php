<?php include("config/local.php");

?>
<meta http-equiv="Set-Cookie" CONTENT="user_priv=<?echo $rc->fields[user_priveleges];?>">
<meta http-equiv="Set-Cookie" CONTENT="user_name=<?echo $rc->fields[user];?>">
<meta http-equiv="Pragma" content="no-cache"> 
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
// $db->Execute($resq);
 include ("./top.php");
 echo "<title>Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td colspan=2><table width=800 align=center><tr><td colspan=2 align=center><h5> Добро пожаловать в систему АСКУЭР группы предприятий &quot;Теплоприбор&quot;</h5>';
 print '<p>АСКУЭР - информационно-вычислительная система, предназначеная для организации автоматизированного технического учёта движения и распределения энергоресурсов в инфраструктуре ОАО "Теплоприбор".</p></td></tr></table></td></tr>';

 $query = 'SELECT id,date,descr FROM news ORDER BY date DESC';
 $e = mysql_query ($query,$i); 
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
     {
      print '<tr><td><font class="dr1">'.$ui[1].'</font></td><td><font class="dd2">'.$ui[2].'</font></td></tr>';
      $ui = mysql_fetch_row ($e);
     }
 $query='USE askuer'; 
}
if ($_GET["menu"]=='20')
{
 include ("./top.php");
 echo "<title>Обратная связь Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 $query='USE askuer';  $max=3; $edit=0; $del=0;
}

if ($_GET["menu"]=='1')
{
 $query = 'SELECT * FROM buyers';
 $max=2;
 include ("./top.php");
 echo "<title>Арендаторы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Тип</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';
}
if ($_GET["menu"]=='2')
{
 $query = 'SELECT * FROM korp';
 $max=4;
 include ("./top.php");
 echo "<title>Корпуса-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Идентификатор</td><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Описание</td><td bgcolor=#e6e6e6><font class="main">Тип</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='3')
{
 $query = 'SELECT * FROM data WHERE type=4 ORDER BY type,date DESC';
 $max=7; $edit=0;
 
 include ("./top.php");
 echo "<title>Данные-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#e6e6e6><font class="main">Название параметра</td><td bgcolor=#e6e6e6><font class="main">Тип</td><td bgcolor=#e6e6e6><font class="main">Дата</td><td bgcolor=#e6e6e6><font class="main">Корпус</td><td bgcolor=#e6e6e6><font class="main">Устройство</td><td bgcolor=#e6e6e6><font class="main">Ресурс</td><td bgcolor=#e6e6e6><font class="main">Значение</td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
 
}
if ($_GET["menu"]=='4')
{
 $query = 'SELECT * FROM energy_supply';
 $max=3;
 include ("./top.php");
 echo "<title>Энергоресурсы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#e6e6e6><font class="main">Название ресурса</td><td bgcolor=#e6e6e6><font class="main">Идентификатор</td><td bgcolor=#e6e6e6><font class="main">Тариф</td><td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
}
if ($_GET["menu"]=='5')
{
 if ($HTTP_COOKIE_VARS[user_priv]==3)
  {
 $query = 'SELECT * FROM users';
 $max=3;

 include ("./top.php");
 echo "<title>Пользователи-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#e6e6e6><font class="main">Пользователь</td><td bgcolor=#e6e6e6><font class="main">Пароль</td><td bgcolor=#e6e6e6><font class="main">Категория</td><td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
  }
}
if ($_GET["menu"]=='6')
{
 // id,name,idres,idkor,idkon,port,address,date,conn,P1,P2,P3,P4
 if ($_GET["sour"]=='') $query = 'SELECT id,name,idres,idkor,port,address,date,conn,P1,P2,P3,P4,P5,P6,P7 FROM uzel WHERE type=1';
 else
        {
         if ($_GET["sour"]!='') $query = 'SELECT id,name,idres,idkor,port,address,date,conn,P1,P2,P3,P4 FROM uzel WHERE idres='.$_GET["sour"].' AND type=1';
        }
 if ($_GET["sort"]==1) $query = $query . ' ORDER BY  address';
 if ($_GET["sort"]==2) $query = $query . ' ORDER BY  name';
 if ($_GET["sort"]==3) $query = $query . ' ORDER BY  idres';
 if ($_GET["sort"]==4) $query = $query . ' ORDER BY  idkor';
 if ($_GET["sort"]==5) $query = $query . ' ORDER BY  idkon';
 if ($_GET["sort"]==6) $query = $query . ' ORDER BY  port';
 $max=11;

 include ("./inc/top2.php");
 echo "<title>Узлы учета-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr>
 <td bgcolor=#e6e6e6 align=center><a href="88.php?menu=6&sort=2&sour='.$_GET["sour"].'"><font class="main">Название узла</font></a></td>
 <td bgcolor=#e6e6e6 align=center><a href="88.php?menu=6&sort=3&sour='.$_GET["sour"].'"><font class="main">Энергоресурс</font></a></td>
 <td bgcolor=#e6e6e6 align=center><a href="88.php?menu=6&sort=4&sour='.$_GET["sour"].'"><font class="main">Местонахождение</font></a></td>
 <td bgcolor=#e6e6e6 align=center><a href="88.php?menu=6&sort=6&sour='.$_GET["sour"].'"><font class="main">Порт</font></a></td>
 <td bgcolor=#e6e6e6 align=center><a href="88.php?menu=6&sort=1&sour='.$_GET["sour"].'"><font class="main">Адрес</font></td>
 <td bgcolor=#e6e6e6 align=center><font class="main">Дата</td><td bgcolor=#e6e6e6 align=center><font class="main">Связь</td><td bgcolor=#e6e6e6 align=center><font class="main">P1</td><td bgcolor=#e6e6e6 align=center><font class="main">P2</td><td bgcolor=#e6e6e6 align=center><font class="main">P3</td><td bgcolor=#e6e6e6 align=center><font class="main">P4</td>';
 
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='7')
{
 $query = 'SELECT * FROM territory';
 $max=27;

 include ("./top.php");
 echo "<title>Территория Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#ffffff width=20 align=center colspan=13></td><td bgcolor=#dddddd align=center colspan=7><font class="main">Потребляемые энергоресурсы</td><td align=center bgcolor=#dddddd colspan=7><font class="main">Отдаваемые энергоресурсы</td><td bgcolor=#ffffff colspan=2></td></tr>';
 print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Входящие</td><td bgcolor=#e6e6e6><font class="main">Исходящие</td><td bgcolor=#e6e6e6><font class="main">Широта</td><td bgcolor=#e6e6e6><font class="main">Долгота</td><td bgcolor=#e6e6e6><font class="main">Высота</td><td bgcolor=#e6e6e6><font class="main">Площадь</td><td bgcolor=#e6e6e6><font class="main">Холодных дней</td><td bgcolor=#e6e6e6><font class="main">Температура</td><td bgcolor=#e6e6e6><font class="main">Давление</td><td bgcolor=#e6e6e6><font class="main">Влажность</td><td bgcolor=#e6e6e6><font class="main">Солнечных дней</td><td bgcolor=#e6e6e6><font class="main">Расчетная температура</td><td bgcolor=#e6e6e6><font class="main">Тепло</td><td bgcolor=#e6e6e6><font class="main">Вода</td><td bgcolor=#e6e6e6><font class="main">Газ</td><td bgcolor=#e6e6e6><font class="main">Кислород</td><td bgcolor=#e6e6e6><font class="main">Пар</td><td bgcolor=#e6e6e6><font class="main">Электроэнергия</td><td bgcolor=#e6e6e6><font class="main">Воздух</td><td bgcolor=#e6e6e6><font class="main">Тепло</td><td bgcolor=#e6e6e6><font class="main">Вода</td><td bgcolor=#e6e6e6><font class="main">Газ</td><td bgcolor=#e6e6e6><font class="main">Кислород</td><td bgcolor=#e6e6e6><font class="main">Пар</td><td bgcolor=#e6e6e6><font class="main">Электроэнергия</td><td bgcolor=#e6e6e6><font class="main">Воздух</td><td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
}
if ($_GET["menu"]=='8')
{
 $query = 'SELECT * FROM methods';
 $max=3;
 print '<tr><td bgcolor=#e6e6e6><font class="main">Идентификатор</td><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
}
if ($_GET["menu"]=='9')
{ 
// INSERT INTO obj (name,idbuy,buy_q,idkorp,type,K1,K2,K3,K4,K5,K6,K7,K8,square,aren_square,BTI,K_agr,Q_agr,height,level,nPP,poll_square,volume) VALUES ('єьvтры№эшъ','18','1','41','2','0','0','0','0','0','0','0','0','2.200000','0.000000','','0.000000','0.000000','0.000000','0','0','0.000000','0.000000')
 include ("./top.php");
 echo "<title>Объекты-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 if ($_GET["korp"]!='')
    {
     $query = 'SELECT name FROM korp WHERE korp_id='.'\''. $_GET["korp"].'\'';
     $p = mysql_query ($query,$i);
     $uo = mysql_fetch_row ($p);
     if ($uo == true) print '<tr><td bgcolor=#e6e6e6><font class="dd">Вывод потребления по предприятиям в '.$uo[0].'</font></a></td>';
     else print '<tr><td bgcolor=#e6e6e6><font class="dd">Вывод потребления по предприятиям в корпусе '.$_GET["korp"].'</font></a></td>';
     $query = 'SELECT DISTINCT idbuy FROM obj WHERE idkorp='.$_GET["korp"]; 
     $e = mysql_query ($query,$i); 
     for ($z=1;$z<=20;$z++)
	{
	 $ui = mysql_fetch_row ($e);
	 if ($ui == true)
	    {
             $query = 'SELECT caption FROM buyers WHERE idx='.'\''. $ui[0].'\'';
             $p = mysql_query ($query,$i);
             $uo = mysql_fetch_row ($p);
             if ($uo == true) 
	         print '<td bgcolor=#ffffff><font class="dd"><a href="detail.php?idbuy='.$ui[0].'">'.$uo[0].'</a></font></td>';
	    }
	}
     print '</tr>';
    }
 print '</table><table border=0 align=center bgcolor=#ffffff>'; 
 if ($_GET["korp"]=='' && $_GET["aren"]=='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,square,poll_square,height,volume,K1,K2,K3,K5,K6,K7,K8 FROM obj';
 else 
        {
         if ($_GET["korp"]!='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,square,poll_square,height,volume,K1,K2,K3,K5,K6,K7,K8 FROM obj WHERE idkorp='.$_GET["korp"];
         if ($_GET["aren"]!='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,square,poll_square,height,volume,K1,K2,K3,K5,K6,K7,K8 FROM obj WHERE idbuy='.$_GET["aren"];
         if ($_GET["korp"]!='' && $_GET["aren"]!='') $query = 'SELECT id,name,idbuy,idkorp,type,BTI,square,poll_square,height,volume,K1,K2,K3,K5,K6,K7,K8 FROM obj WHERE idkorp='.$_GET["korp"].' AND idbuy='.$_GET["aren"];
        }
 if ($_GET["sort"]=='1') $query = $query . ' ORDER BY name';
 if ($_GET["sort"]=='2') $query = $query . ' ORDER BY idbuy';
 if ($_GET["sort"]=='3') $query = $query . ' ORDER BY idkorp';
 if ($_GET["sort"]=='4') $query = $query . ' ORDER BY type';
 if ($_GET["sort"]=='5') $query = $query . ' ORDER BY BTI';
 $max=16;

 print '<tr>';
 print '<td bgcolor=#e6e6e6 align=center><a href="88.php?menu=9&sort=1&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Название</font></a></td>';
 print '<td bgcolor=#e6e6e6 align=center><a href="88.php?menu=9&sort=2&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Арендатор</font></a></td>';
 print '<td bgcolor=#e6e6e6 align=center><a href="88.php?menu=9&sort=3&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Корпус</font></a></td>';
 print '<td bgcolor=#e6e6e6 align=center><a href="88.php?menu=9&sort=4&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">Тип</font></a></td><td align=center bgcolor=#e6e6e6><a href="88.php?menu=9&sort=5&korp='.$_GET["korp"].'&aren='.$_GET["aren"].'"><font class="main">№БТИ / Инвентарный</font></a></td>';
 print '<td bgcolor=#e6e6e6 align=center><font class="main">Площадь</td><td bgcolor=#e6e6e6 align=center><font class="main">Пол. площадь</td><td align=center bgcolor=#e6e6e6><font class="main">Высота</td><td align=center bgcolor=#e6e6e6><font class="main">Пол. объем</td>';
 print '<td bgcolor=#e6e6e6 align=center><font class="main">K(тепло)</td><td bgcolor=#e6e6e6 align=center><font class="main">K(т-вода)</td><td align=center bgcolor=#e6e6e6><font class="main">K(вода)</td><td align=center bgcolor=#e6e6e6><font class="main">K(газ)</td><td bgcolor=#e6e6e6 align=center><font class="main">K(сж.возд)</td><td align=center bgcolor=#e6e6e6><font class="main">K(кислор)</td><td bgcolor=#e6e6e6 align=center><font class="main">K(электр)</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';

}
if ($_GET["menu"]=='10')
{
 include ("./top.php");
 echo "<title>Персонал-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td>';
 $query = 'SELECT name,korp_id FROM korp ORDER BY id';
 $p = mysql_query ($query,$i);
 $max=1;
 for ($z=1;$z<=50;$z++)
        {
         $uo = mysql_fetch_row ($p);    
         if ($uo == true)
           {
            print '<td bgcolor=#e6e6e6><font class="main">'; print $uo[0]; print '</td>';
            $max++;
           }
        }
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';

 $query = 'SELECT * FROM people';
}
if ($_GET["menu"]=='11')
{
 $query = 'SELECT * FROM production';
 $max=5;

 include ("./top.php");
 echo "<title>Продукция-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";

 print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Корпус</td><td bgcolor=#e6e6e6><font class="main">Уд. потребление воды</td><td bgcolor=#e6e6e6><font class="main">Количество продукции</td><td bgcolor=#e6e6e6><font class="main">Арендатор</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
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
 $max=5;
 include ("./top.php");
  echo "<title>Шкафы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Описание</td><td bgcolor=#e6e6e6><font class="main">Корпус</td><td bgcolor=#e6e6e6><font class="main">Ответственный</td><td bgcolor=#e6e6e6><font class="main">Координаты</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';
}

if ($_GET["menu"]=='14')
{
 $max=20;
 include ("./top.php");
 $query = 'SELECT id,name,date_buy,date_mon_1,date_vvod,date_prov_p,date_prov_s,period_p,s_type,serial,uzel,shelf,date_dem_p,prichina_dem,date_mon_p,prichina_mon,history,Du,Pmin,Pmax,d,source,d_type FROM equipment WHERE d_type=1 ORDER BY name';
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 while ($ui)
     {
          $query = 'SELECT name FROM uzel WHERE id='.'\''. $ui[10].'\'';
          $p = mysql_query ($query,$i); $uo = mysql_fetch_row ($p);
          if ($uo == true) $uzel=$uo[0]; else $uzel='неизвестен';
          $query = 'SELECT name FROM shelf WHERE id='.'\''. $ui[11].'\'';
          $p = mysql_query ($query,$i); $uo = mysql_fetch_row ($p);
          if ($uo == true) $shelf=$uo[0];
	  print '<tr><td colspan=15><table bgcolor=#d0d0d0><tr>';
	  print '<td><font class="man4">Требуется замена! </font></td><td><font class="dr">'.$ui[1].' [s/n: '.$ui[9].'</td><td><font class="dr">(Узел: '.$uzel.' / Шкаф: '.$shelf.')</td><td><font class="dr">срок следующей поверки </font><font class="man">'.$ui[6];
	  print '</font></td></tr></table></td></tr>';
      $ui = mysql_fetch_row ($e);
     }

 $query = 'SELECT id,name,date_buy,date_mon_1,date_vvod,date_prov_p,date_prov_s,period_p,s_type,serial,uzel,shelf,date_dem_p,prichina_dem,date_mon_p,prichina_mon,history,Du,Pmin,Pmax,d,source,d_type FROM equipment WHERE (date_prov_s<10000000+NOW()) AND date_prov_s>NOW()  ORDER BY name';
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
	  print '<tr><td bgcolor=#d0d0d0 colspan=15><table bgcolor=#d0d0d0><tr>';
	  print '<font class="man2">';
	  print 'Внимание! </font></td><td><font class="dr">'.$ui[1].'</font></td><td><font class="dr">[s/n: '.$ui[9].'</font></td><td><font class="dr">(Узел: '.$uzel.' / Шкаф: '.$shelf.')</font></td><td><font class="dr">срок следующей поверки </font><font class="man">'.$ui[6];
	  print '</font></td></tr></table></td></tr>';
	 }
     }
 $query = 'SELECT id,name,date_buy,date_mon_1,date_vvod,date_prov_p,date_prov_s,period_p,s_type,serial,uzel,shelf,date_dem_p,prichina_dem,date_mon_p,prichina_mon,history,Du,Pmin,Pmax,d,source,d_type FROM equipment WHERE date_prov_s<NOW()  ORDER BY name';
 $e = mysql_query ($query,$i); 
 print '<tr><td bgcolor=#d0d0d0 colspan=15><table bgcolor=#d0d0d0>';
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
	  print '<tr><td bgcolor=#d0d0d0 colspan=15>';
	  print '<font class="man3">Внимание! </font></td><td><font class="dr">'.$ui[1].'</font></td><td><font class="dr">[s/n: '.$ui[9].']</font></td><td><font class="dr">(Узел: '.$uzel.' / Шкаф: '.$shelf.')</font></td><td><font class="dr">срок следующей поверки </font><font class="man">'.$ui[6];
	  print '</font></td></tr>';
	 }
     }
 print '</table></td></tr>';

 $query = 'SELECT id,name,date_buy, date_mon_1,date_vvod,date_prov_p,date_prov_s,period_p,s_type,serial,uzel,shelf,date_dem_p,prichina_dem,date_mon_p,prichina_mon,history,Du,Pmin,Pmax,d,source,d_type FROM equipment'; 
 if ($_GET["sort"]=='1') $query = $query . ' ORDER BY shelf';
 if ($_GET["sort"]=='2') $query = $query . ' ORDER BY name';
 if ($_GET["sort"]=='3') $query = $query . ' ORDER BY uzel';
 if ($_GET["sort"]=='4') $query = $query . ' ORDER BY s_type';

 if ($_GET["sort"]=='5') $query = $query . ' ORDER BY serial';
 if ($_GET["sort"]=='6') $query = $query . ' ORDER BY date_prov_p';
 if ($_GET["sort"]=='7') $query = $query . ' ORDER BY period_p';
 if ($_GET["sort"]=='8') $query = $query . ' ORDER BY date_buy';

 if ($_GET["sort"]=='9') $query = $query . ' ORDER BY date_prov_s';
 if ($_GET["sort"]=='10') $query = $query . ' ORDER BY date_mon_p';

 echo "<title>Приборы-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head>";
 print '<tr align=center><td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=2"><font class="main">Название</font></a></td><td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=8"><font class="main">Дата покупки</td><td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=10"><font class="main">Дата пер.монтажа</td><td bgcolor=#e6e6e6><font class="main">Дата ввода в эксплуатацию</font></td><td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=6"><font class="main">Дата пров. первичной проверки</font></a></td>
 <td bgcolor=#e6e6e6><font class="main">Дата пров. следующей проверки</td><td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=7"><font class="main">Период между поверками</font></a></td>
 <td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=4"><font class="main">Тип прибора</td><td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=5"><font class="main">Серийный номер</font></a></td>
 <td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=3"><font class="main">Узел учета</font></a></td><td bgcolor=#e6e6e6 align=center><a href="88.php?menu=14&sort=1"><font class="main">Шкаф</font></a></td>
 <td bgcolor=#e6e6e6><font class="main">Дата последнего демонтажа</td><td bgcolor=#e6e6e6><font class="main">Причина демонтажа</td>
 <td bgcolor=#e6e6e6><a href="88.php?menu=14&sort=10"><font class="main">Дата последнего монтажа</font></a></td><td bgcolor=#e6e6e6><font class="main">Причина монтажа</td>
 <td bgcolor=#e6e6e6><font class="main">История и отзывы</td><td bgcolor=#e6e6e6><font class="main">Диаметр</td>
 <td bgcolor=#e6e6e6><font class="main">Pmin</td> <td bgcolor=#e6e6e6><font class="main">Pmax</td>
 <td bgcolor=#e6e6e6><font class="main">Погрешность</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) print '<td bgcolor=#e6e6e6><font class="main">Ред.</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';

}

if ($_GET["menu"]=='15')
{
 $query = 'SELECT id,time,code,descr,who,ip FROM register ORDER BY id DESC';
 $edit=0;
 $max=5;
 include ("./top.php");
 echo "<title>Журнал-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";

 print '<tr><td bgcolor=#e6e6e6><font class="main">Время</td><td bgcolor=#e6e6e6><font class="main">Код ошибки</td><td bgcolor=#e6e6e6 align=center><font class="main">Описание</td><td bgcolor=#e6e6e6 align=center><font class="main">Кто</td><td bgcolor=#e6e6e6 align=center><font class="main">IP-адрес</td><td bgcolor=#e6e6e6><font class="main">Уд.</td>';
}

if ($_GET["menu"]=='16')
{
 $query = 'SELECT * FROM sensors';
 $edit=0; $max=2;

 include ("./top.php");
 echo "<title>Датчики-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Название</td><td bgcolor=#e6e6e6><font class="main">Тип</td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
}

if ($_GET["menu"]=='17')
{
 include ("./top.php");
 echo "<title>Баланс-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Баланс по месяцам перенесен</td></tr>';
}

if ($_GET["menu"]=='19')
{
 $query = 'SELECT * FROM event ORDER BY date DESC';
 $edit=0; $max=5;
 include ("./top.php");
 if ($_GET["diag"]!='')  print '<script> imgs=window.open("func.php","_blank","width=880,height=520,toolbar=no,menubar=no,location=no,status=no,resizable=no,scrollbars=no,top=0,left=0"); </script>';

 echo "<title>Диагностика-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#e6e6e6><font class="main">Дата события</td><td bgcolor=#e6e6e6><font class="main">Описание</td><td bgcolor=#e6e6e6><font class="main">Значение параметра</td><td bgcolor=#e6e6e6><font class="main">Устройство</td><td bgcolor=#e6e6e6><font class="main">Код события</td>';
 if($HTTP_COOKIE_VARS[user_priv]==3) print '<td bgcolor=#e6e6e6><font class="main">Уд.</td>';
 print '</tr>';
}

if ($_GET["menu"]=='21')
{
 $max=6;
 include ("./top.php");
 echo "<title>События узлов учета-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 print '<tr><td bgcolor=#e6e6e6 align=center><font class="main">Событие</td><td bgcolor=#e6e6e6><a href="88.php?menu=21&sort=1"><font class="main">Возникновение</font></a></td><td bgcolor=#e6e6e6><a href="88.php?menu=21&sort=2"><font class="main">Обнаружение</font></a></td><td bgcolor=#e6e6e6><a href="88.php?menu=21&sort=3"><font class="main">Узел учета</font></a></td><td bgcolor=#e6e6e6  align=center><font class="main">Описание</td><td bgcolor=#e6e6e6 align=center><a href="88.php?menu=21&sort=4"><font class="main">Датчик</font></a></td><td bgcolor=#e6e6e6><font class="main">Уд.</td></tr>';
 $del=1; $edit=0;
 $query = 'SELECT * FROM event2'; 
 if ($_GET["sort"]=='1') $query = $query . ' ORDER BY date begin';
 if ($_GET["sort"]=='2') $query = $query . ' ORDER BY date_end';
 if ($_GET["sort"]=='3') $query = $query . ' ORDER BY uzel';
 if ($_GET["sort"]=='4') $query = $query . ' ORDER BY sensor';
}

if ($_GET["menu"]=='18')
{
 include ("./top.php");
 echo "<title>Баланс суточный-Интерфейс '".$priveleges[$rc->fields[user_priveleges]]."'</title></head><body>";
 $edit=0; $del=0;
 $date=getdate(); $mon=$date['mon']; $year=$date['year'];
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td><table>';
 print '<tr><td bgcolor=#e6e6e6 align=center><font class="main">Время</font></td>';
 for ($z=1;$z<=10;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
	{
	 if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	    	print '<td bgcolor=#e6e6e6 align=center><font class="main">'.$ui[1].'</td>';
	 if ($ui[2]==0) print '<td colspan=2 bgcolor=#e6e6e6 align=center><font class="main">'.$ui[1].'</td>';
	}
     }
 print '</tr>';
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#e6e6e6><font class="main"></font></td>';
 for ($z=1;$z<=10;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
      if ($ui[2]==0 || $ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
         {        
          if ($ui[2]==0) print '<td bgcolor=#e6e6e6 align=center><font class="main">Масса по подающей (т.)</td><td bgcolor=#e6e6e6 align=center><font class="main">Масса по обратной (т.)</td>';
          if ($ui[2]==1) print '<td bgcolor=#e6e6e6 align=center><font class="main">Тепловая мощность(ГКал)</td>';
          if ($ui[2]==2) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход воды (м3)</td>';
          if ($ui[2]==3) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход пара (ГКал)</td>';
          if ($ui[2]==4) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход газа (м3)</td>';
          if ($ui[2]==5) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==6) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==7) print '<td bgcolor=#e6e6e6 align=center><font class="main">Мощность (кВт)</td>';
         }
     }
 print '</tr>';
 $today=getdate ();
 $x=0; $mx=$today[mday]-1; $mn=1; $nx=2; $nn=1;
 $mx=$mx+0; $month=$today[mon]; $year=$today[year];
 for ($tn=$nx; $tn>=$nn; $tn--)
 for ($tm=$mx; $tm>=$mn; $tm--)
    {
     for ($h=0;$h<=10;$h++) $sum[$x][$h]=$vhod[$x][$h]=0;
     if ($tn==1 && $tm==31)
	{ 
	 $mn=$today[mday];
	 if ($month>1) $month--; else { $month=12; $year--;}
	}
     if (checkdate ($month,$tm,$year))  
 	 {
          $mx=31;
	  if ($month<10) $mont='0'.$month; else $mont=''.$month;
	  if ($tm<10) { $dat[$x]='0'.$tm.'-'.$mont.'-'.$year.' 00:00'; $dats='0'.$tm; $date1[$x]=$year.'-'.$mont.'-0'.$tm.' 00:00:00'; $dats[$x]=$year.$mont.'0'.$tm.'000000';}
	  else { $dat[$x]=$tm.'-'.$mont.'-'.$year.' 00:00'; $dats=''.$tm; $date1[$x]=$year.'-'.$mont.'-'.$tm.' 00:00:00'; $dats[$x]=$year.$mont.$tm.'000000';}
	  $x++;
         }     
    }                 
 $x--;
 $maxx=$x;
 if ($month<10) $month='0'.$month;
 if ($today["mday"]<10) $today["mday"]='0'.$today["mday"];
 if ($today["mon"]<10)  $today["mon"]='0'.$today["mon"];
 $query = 'SELECT * FROM data WHERE type=2 AND (date>='.$year.$month.'01000000 AND date<='.$today["year"].$today["mon"].$today["mday"].'120000)';
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=100000;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
	 {          
	  if ($ui[6]==0) 
	     {
	      if ($ui[4]<100 && $ui[4]!=34 && $ui[4]!=39 && $ui[4]!=8 && $ui[4]!=30 && $ui[4]!=41 && $ui[4]!=35)
		 {
	      	  if (strstr ($ui[1],'подающей') && strstr ($ui[1],'массы')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][9]=$sum[$o][9]+$ui[7];
	      	  if (strstr ($ui[1],'обратной') && strstr ($ui[1],'массы')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][10]=$sum[$o][10]+$ui[7];
		 }
	      else 	
	      if ($ui[4]==101)
		 {
	      	  if (strstr ($ui[1],'подающей') && strstr ($ui[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][9]=$vhod[$o][9]+$ui[7];
	      	  if (strstr ($ui[1],'обратной') && strstr ($ui[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][10]=$vhod[$o][10]+$ui[7];
		 }
	     }
	  if ($ui[6]==1) 
	      if ($ui[4]<100 && $ui[4]!=34 && $ui[4]!=39 && $ui[4]!=8 && $ui[4]!=30 && $ui[4]!=41 && $ui[4]!=35)
	      	  { if (strstr ($ui[1],'энергии')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][1]=$sum[$o][1]+$ui[7]; }
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'магистрали')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][1]=$vhod[$o][1]+$ui[7]; }
	  if ($ui[6]==2) 
	      if ($ui[4]<100 && $ui[4]!=61 && $ui[4]!=6 && $ui[4]!=39 && $ui[4]!=38 && $ui[4]!=2 && $ui[4]!=31 && $ui[4]!=35  && $ui[4]!=22)
	      	  { for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][2]=$sum[$o][2]+$ui[7]; }
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][2]=$vhod[$o][2]+$ui[7]; }
	  if ($ui[6]==4) 
	      if ($ui[4]<100)
	      	  { if (strstr ($ui[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][4]=$sum[$o][4]+$ui[7]; }
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][4]=$vhod[$o][4]+$ui[7]; }
	  if ($ui[6]==5 && $ui[4]!=61 && $ui[4]!=6 && $ui[4]!=39 && $ui[4]!=1 && $ui[4]!=31) 
	      if ($ui[4]<100)
	      	  { if (strstr ($ui[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][5]=$sum[$o][5]+$ui[7]; }
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][5]=$vhod[$o][5]+$ui[7]; }
	  if ($ui[6]==6) 
	      if ($ui[4]<100)
	      	  { if (strstr ($ui[1],'объема')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][6]=$sum[$o][6]+$ui[7]; }
	      else 
	      if ($ui[4]==101)
	      	  { if (strstr ($ui[1],'объема')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][6]=$vhod[$o][6]+$ui[7]; }
	  if ($ui[6]==7) 
	      if ($ui[4]<100)
	      	  { 
		   if (strstr ($ui[1],'ТП 102(яч.1)') || strstr ($ui[1],'ТП 5(яч10)') || strstr ($ui[1],'ТП 4(яч.12)') || strstr ($ui[1],'КНТП250(яч.14)') || strstr ($ui[1],'ТП 101(яч.16)') || strstr ($ui[1],'ТКР(яч.6)акт') || strstr ($ui[1],'ТКР(яч.11)акт') || strstr ($ui[1],'ЧЗСМ(яч.2)акт') || strstr ($ui[1],'ТКР(яч.6)акт') || strstr ($ui[1],'ЧЗСМ(яч-15)акт')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $sum[$o][7]=$sum[$o][7]+$ui[7]; 

		   if (strstr ($ui[5],'0125')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][0]=$ui[7];
 	 	   if (strstr ($ui[5],'0132')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][1]=$ui[7];
	   	   if (strstr ($ui[5],'0111')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][2]=$ui[7];
	 	   if (strstr ($ui[5],'0112')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][3]=$ui[7];
	 	   if (strstr ($ui[5],'0113')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][4]=$ui[7];
	 	   if (strstr ($ui[5],'0114')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][5]=$ui[7];
	 	   if (strstr ($ui[5],'0115')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][6]=$ui[7];
	 	   if (strstr ($ui[5],'0116')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][7]=$ui[7];
	 	   if (strstr ($ui[5],'0121')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][8]=$ui[7];
	 	   if (strstr ($ui[5],'0123')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][9]=$ui[7];
	 	   if (strstr ($ui[5],'0124')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][10]=$ui[7];
	 	   if (strstr ($ui[5],'0126')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][11]=$ui[7];
	 	   if (strstr ($ui[5],'0127')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][12]=$ui[7];
	 	   if (strstr ($ui[5],'0215')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][13]=$ui[7];
	 	   if (strstr ($ui[5],'0131')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][14]=$ui[7];
	 	   if (strstr ($ui[5],'0128')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][15]=$ui[7];
	 	   if (strstr ($ui[5],'1104')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][16]=$ui[7];

	 	   if (strstr ($ui[5],'1102')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][17]=$ui[7];
	 	   if (strstr ($ui[5],'1103')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][18]=$ui[7];
	 	   if (strstr ($ui[5],'1101')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][19]=$ui[7];
	 	   if (strstr ($ui[5],'1106')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $bl[$o][20]=$ui[7];
		   if (strstr ($ui[5],'1212')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $ru[$o]=$ui[7];

		   if (strstr ($ui[5],'1211')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][0]=$ui[7];
	 	   if (strstr ($ui[5],'1210')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][1]=$ui[7];
	   	   if (strstr ($ui[5],'1209')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][2]=$ui[7];
	 	   if (strstr ($ui[5],'1213')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][3]=$ui[7];
	 	   if (strstr ($ui[5],'1212')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][4]=$ui[7];

	 	   if (strstr ($ui[5],'1207')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][5]=$ui[7];
	 	   if (strstr ($ui[5],'1205')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][6]=$ui[7];
	 	   if (strstr ($ui[5],'1201')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][7]=$ui[7];
	 	   if (strstr ($ui[5],'1203')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][8]=$ui[7];
	 	   if (strstr ($ui[5],'1214')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $el[$o][9]=$ui[7];

		  }
	      else 
	      	  { 
		   if (strstr ($ui[1],'Ввод') && strstr ($ui[1],'акт')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $vhod[$o][7]=$vhod[$o][7]+$ui[7]; 
	 	   if (strstr ($ui[5],'1301')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $elv[$o][0]=$ui[7];
	 	   if (strstr ($ui[5],'1401')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$ui[3])) $elv[$o][1]=$ui[7];
		  }
	 }
     } 
 for ($x=0; $x<=$maxx; $x++)
     {
      print '<tr><td><font class="down">'.$dat[$x].'</font></td>';
      for ($h=0; $h<=7; $h++)
      if ($h!=3)
	 {   
	     if ($h==6) $vhod[$x][$h]=$sum[$x][$h];
	     if ($h==0) 
	     	{
	     	 $sum[$x][0]=$sum[$x][9]-$sum[$x][10];
	       	 $vhod[$x][0]=$vhod[$x][9]-$vhod[$x][10];

	       	 $vhod0[$x][$h]=$vhod[$x][9];
		 $vhod1[$x][$h]=$vhod[$x][10];

        	 if ($sum[$x][9]+$vhod[$x][9]>0) if ($vhod[$x][9]>0) $pr1=($sum[$x][9]-$vhod[$x][9])*100/($vhod[$x][9]); else $pr1=100;
               	 else $pr1=0;
       	         if ($sum[$x][10]+$vhod[$x][9]>0) if ($vhod[$x][10]>0) $pr0 = ($sum[$x][10]-$vhod[$x][10])*100/($vhod[$x][10]); else $pr1=100;
                 else $pr0=0;
	   	 print '<td><font class="down">'; printf ("%.2f",$sum[$x][9]); print ' / '; printf ("%.2f",$vhod[$x][9]); print ' </font>'; 
	  	 if (abs($pr1)>20) print '<font class="nkor">'; 
		 else print '<font class="date">'; 
		 print '['; printf ("%.1f",$pr1); print '%]</font></td>';
   	         print '<td><font class="down">'; printf ("%.2f",$sum[$x][10]); print ' / '; printf ("%.2f",$vhod[$x][10]); print ' </font>'; 
		 if (abs($pr0)>20) print '<font class="nkor">'; 
		 else print '<font class="date">'; 
		 print '['; printf ("%.1f",$pr0); print '%]</font></td>';
	     	}
	      else 
	     	{
	       	 $vhod0[$x][$h]=$vhod[$x][$h];
              	 if ($sum[$x][$h]+$vhod[$x][$h]>0) if ($vhod[$x][$h]>0) $pr = ($sum[$x][$h]-$vhod[$x][$h])*100/($vhod[$x][$h]); else $pr=100;
    	      	 else $pr=0;
	  	 print '<td><font class="down">'; printf ("%.2f",$sum[$x][$h]); print ' / '; printf ("%.2f",$vhod[$x][$h]); print ' </font>'; 
		 if (abs($pr)>20) print '<font class="nkor">'; 
   	  	 else print '<font class="date">'; 
	  	 print '['; printf ("%.1f",$pr); print '%]</font></td>';
	 	}
	 }
       print '</tr>';
    }
 print '<tr><td bgcolor=#e6e6e6></td><td bgcolor=#e6e6e6 colspan=8 align=center><font class="main">Сумма по всем узлам / Значение по входному узлу учета [относительная разница в %]</font></td></tr>';
 print '<tr><td colspan=22 align=center><font class="main">Баланс показаний по ТП-101</font></td></tr>';
 print '<tr><td colspan=22 align=center><table>';
 print '<tr bgcolor=#e8e8e8><td><font class="down">Время</font></td>';
 print '<td><font class="down">W16</font></td><td><font class="down">W22</font></td>'; 
 print '<td><font class="down">W18</font></td><td><font class="down">W20</font></td>'; 
 print '<td><font class="down">W19</font></td><td><font class="down">W3</font></td>'; 
 print '<td><font class="down">W4</font></td><td><font class="down">W5</font></td>'; 
 print '<td><font class="down">W8</font></td><td><font class="down">W10</font></td>'; 
 print '<td><font class="down">W11</font></td><td><font class="down">W14</font></td>'; 
 print '<td><font class="down">W15</font></td><td><font class="down">W24a</font></td>'; 
 print '<td><font class="down">W21</font></td><td><font class="down">W13</font></td>'; 
 print '<td><font class="down">W23</font></td><td><font class="down">ТП101 ф6</font></td>'; 
 print '<td><font class="down">ТП101 ф7</font></td><td><font class="down">ТП101 ф12</font></td>'; 
 print '<td><font class="down">ТП102 ф9</font></td>'; 
 print '<td><font class="down">Сумма</font></td><td><font class="down">РУ-2 (ТП 101)</font></td><td><font class="down">Разн.</font></td>';
 for ($x=0; $x<=$maxx; $x++)
     {      
      $smm=0;
      print '<tr><td bgcolor=#e8e8e8><font class="down">'.$dat[$x].'</font></td>';
      for ($h=0; $h<=20; $h++)
	 {
  	  print '<td><font class="down">'; printf ("%.2f",$bl[$x][$h]); print '</font></td>'; 
	  $smm=$smm+$bl[$x][$h];
	 }      
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f",$smm); print '</font></td>';
      print '<td bgcolor=#efefef><font class="down">'; printf ("%.2f",$ru[$x]); print '</font></td>';
      if ($ru[$x]>0) $prr=($smm-$ru[$x])*100/$ru[$x]; else $prr=0;
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f %%",$prr); print '</font></td>';
      print '</tr>';
    }
 print '</table></td></tr>';

 print '<tr><td colspan=22 align=center><font class="main">Баланс показаний по входу электрической энергии</font></td></tr>';
 print '<tr><td colspan=22 align=center><font class="main">Wвх.терр.=W5a+W13a=Wдр.акт.+Wсуб.акт=W1,ТП-102+W10,ТП-5+W12,ТП-4+W14,КНТП-250+W16,ТП-101 + W11,ТКР+W6,ТКР+W2,ЧЗСМ+W15,ЧЗСМ</font></td></tr>';
 print '<tr><td colspan=22 align=center><table>';
 print '<tr bgcolor=#e8e8e8><td><font class="down">Время</font></td>';
 print '<td><font class="down">W1,ТП-102</font></td><td><font class="down">W10,ТП-5</font></td>';
 print '<td><font class="down">W12,ТП-4</font></td><td><font class="down">W14,КНТП-250</font></td>'; 
 print '<td><font class="down">W16,ТП-101</font></td><td><font class="down"></font></td>'; 
 print '<td><font class="down">W11,ТКР</font></td><td><font class="down">W6,ТКР</font></td>'; 
 print '<td><font class="down">W2,ЧЗСМ</font></td><td><font class="down">W15,ЧЗСМ</font></td>'; 
 print '<td><font class="down"></font></td>'; 
 print '<td><font class="down">W5а</font></td><td><font class="down">W13а</font></td>'; 
 print '<td><font class="down"></font></td><td><font class="down">Wвх.акт.</font></td>'; 
 print '<td><font class="down">Wдр.акт.</font></td><td><font class="down">Wсуб.акт.</font></td>'; 
 print '<td><font class="down"></font></td><td><font class="down">разница</font></td>'; 
 for ($x=0; $x<=$maxx; $x++)
     {      
      $smm=0; $smm2=0;
      print '<tr><td bgcolor=#e8e8e8><font class="down">'.$dat[$x].'</font></td>';
      for ($h=0; $h<=4; $h++)
	 {
  	  print '<td><font class="down">'; printf ("%.2f",$el[$x][$h]); print '</font></td>'; 
	  $smm=$smm+$el[$x][$h];
	 }      
      print '<td bgcolor=#efefef></font></td>';
      for ($h=5; $h<=8; $h++)
	 {
  	  print '<td><font class="down">'; printf ("%.2f",$el[$x][$h]); print '</font></td>'; 
	  $smm2=$smm2+$el[$x][$h];
	 }      
      print '<td bgcolor=#efefef></font></td>';
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f",$elv[$x][0]); print '</font></td>';
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f",$elv[$x][1]); print '</font></td>';
      print '<td bgcolor=#efefef></font></td>';
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f",$elv[$x][0]+$elv[$x][1]); print '</font></td>';
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f",$smm); print '</font></td>';
      print '<td bgcolor=#e6e6e6><font class="down">'; printf ("%.2f",$smm2); print '</font></td>';
      print '<td bgcolor=#efefef></td>';
      if ($elv[$x][0]+$elv[$x][1]>0) $ru=(($smm+$smm2)-($elv[$x][0]+$elv[$x][1]))*100/($elv[$x][0]+$elv[$x][1]);
	else $ru=0;
      print '<td bgcolor=#efefef><font class="down">'; printf ("%.2f%%",$ru); print '</font></td>';
      print '</tr>';
    }
 print '</table></td></tr>';
 print '</table></td></tr>';

 print '<tr><td align=center><font class="main">Баланс показаний по месяцам</font></td></tr>';
 print '<tr><td align=center><table>';
 $edit=0; $del=0;
 $date=getdate(); $mon=$date['mon']; $year=$date['year'];
 if ($mon>1) $mon--;
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#ffffff align=center><font class="main">Время</font></td>';
 for ($z=1;$z<=100;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true)       
	if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
		print '<td bgcolor=#e6e6e6 align=center><font class="main">'.$ui[1].'</td>';
     }
 print '</tr>';
 $query = 'SELECT * FROM energy_supply';
 $e = mysql_query ($query,$i);
 print '<tr><td bgcolor=#e6e6e6><font class="main"></font></td>';
 for ($z=1;$z<=10;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
      if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
         {        
          if ($ui[2]==0) print '<td bgcolor=#e6e6e6 align=center><font class="main">Массовый расход (кг)</td>';
          if ($ui[2]==1) print '<td bgcolor=#e6e6e6 align=center><font class="main">Тепловая мощность(ГКал)</td>';
          if ($ui[2]==2) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход воды (м3)</td>';
          if ($ui[2]==3) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход пара (м3)</td>';
          if ($ui[2]==4) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход газа (м3)</td>';
          if ($ui[2]==5) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==6) print '<td bgcolor=#e6e6e6 align=center><font class="main">Объемный расход (м3)</td>';
          if ($ui[2]==7) print '<td bgcolor=#e6e6e6 align=center><font class="main">Мощность (кВт)</td>';
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
	       $mont=$mon; $yeart=$year;
//	       if ($ui[2]<7) if ($mon<12) $mont=$mon+1; else { $mont=1; $yeart=$year+1;}
	       if ($mont<10) $mont='0'.$mont;

	       $sour=$ui[2]+1; $vhod=0; $sum=0;
	       if ($ui[2]==7) $query = 'SELECT SUM(value) FROM data WHERE korp=101 AND type=4 AND source='.$ui[2].' AND name LIKE \'%акт%\' AND name LIKE \'%Ввод%\' AND date='.$year.$mont.'01000000';
	       if ($ui[2]==1 || $ui[2]==2 || $ui[2]==5) $query = 'SELECT SUM(value) FROM data WHERE korp=101 AND type=4 AND source='.$ui[2].' AND date='.$yeart.$mont.'01000000';
	       if ($ui[2]==4) $query = 'SELECT SUM(value) FROM data WHERE type=4 AND korp=101 AND source='.$ui[2].' AND name LIKE \'%объем%\' AND (date='.$yeart.$mont.'01120000 OR date='.$yeart.$mont.'01000000)';
	       if ($ui[2]==6) $query = 'SELECT SUM(value) FROM data WHERE type=4 AND korp=101 AND source='.$ui[2].' AND name LIKE \'%объем%\' AND (date='.$yeart.$mont.'01120000 OR date='.$yeart.$mont.'01000000)';
		//echo $query;
	       $r = mysql_query ($query,$i);
	       if ($r)
	     	  {
	     	   $uo = mysql_fetch_row ($r);
		   $vhod=$uo[0];
		   //echo $vhod;
	          }
	       if ($ui[2]<7) if ($mon<12) $mont=$mon+1; else { $mont=1; $yeart=$year+1;}
		 $mont=$mont+0;
	       if ($mont<10) $mont='0'.$mont;

	       $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND type=4 AND source='.$ui[2].' AND (date='.$yeart.$mont.'01000000 OR date='.$yeart.$mont.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';
	       if ($ui[2]==1) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=35 AND korp!=22 AND type=4 AND source='.$ui[2].' AND (date='.$yeart.$mont.'01000000 OR date='.$yeart.$mont.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';
	       if ($ui[2]==2) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=61 AND korp!=6 AND korp!=38 AND korp!=39 AND korp!=31 AND korp!=35 AND korp!=22 && korp!=2 AND type=4 AND source='.$ui[2].' AND (date='.$yeart.$mont.'01000000 OR date='.$yeart.$mont.'01120000) AND ((name LIKE  \'%объем%\'))';
	       if ($ui[2]==4) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp=61 AND type=4 AND source='.$ui[2].' AND (date='.$yeart.$mont.'01000000 OR date='.$yeart.$mont.'01120000) AND ((name LIKE  \'%массы%\'))';
	       if ($ui[2]==5) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND korp!=61 AND korp!=6 AND korp!=1 AND korp!=39 AND korp!=31 AND type=4 AND source='.$ui[2].' AND (date='.$yeart.$mont.'01000000 OR date='.$yeart.$mont.'01120000) AND ((name LIKE  \'%объема%\') OR (name LIKE  \'%энерги%\'))';
               if ($ui[2]==7) $query = 'SELECT SUM(value) FROM data WHERE korp<99 AND type=4 AND source=7 AND date='.$yeart.$mont.'01000000 AND ((name LIKE  \'%ТП 102(яч.1)%\') OR (name LIKE  \'%ТП 5(яч10)%\') OR (name LIKE  \'%ТП 4(яч.12)%\') OR (name LIKE \'%КНТП250(яч.14)%\') OR (name LIKE \'%ТП 101(яч.16)%\') OR (name LIKE \'%ТКР(яч.6)акт%\') OR (name LIKE \'%ТКР(яч.11)акт%\') OR (name LIKE \'%ЧЗСМ(яч.2)акт%\') OR (name LIKE \'%ТКР(яч.6)акт%\') OR (name LIKE \'%ЧЗСМ(яч-15)акт%\'))';
	       //echo $query; 
	       $r = mysql_query ($query,$i);
	       if ($r)
	     	  {
	     	   $uo = mysql_fetch_row ($r);
		   $sum=$uo[0]; if ($sum=='') $sum=0;
	          }
               if ($vhod>0) $pr = ($sum-$vhod)*100/($vhod);
               else $pr=0;
		if ($ui[2]==4 || $ui[2]==6) $vhod=$sum;

 	       print '<td><font class="down">'; 
	       printf ("%.3f",$sum); print ' / '; 	       printf ("%.3f",$vhod); print ' </font>';
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
 print '<tr><td bgcolor=#e6e6e6></td><td bgcolor=#e6e6e6 colspan=6 align=center><font class="main">Сумма по всем узлам / Значение по входному узлу учета [относительная разница в %]</font></td></tr>';
 print '</table></td></tr>';
 $query = 'USE askuer';
}

$e = mysql_query ($query,$i); 
if ($query=='USE askuer') $ma=0;
else $ma=1800;
for ($z=1;$z<=$ma;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<tr>';
    for ($j=1;$j<=$max;$j++)    
        {
         if ($_GET["menu"]=='9' && $ui[4]=='1') print '<td bgcolor=#111155><font class="dd">';
         else if ($_GET["menu"]=='6') print '<td bgcolor=#ffffff style="padding-left:3;margin-left:3;padding-right:2;"><font class="dd">';
	 else print '<td bgcolor=#ffffff><font class="dd">';
         if ($_GET["menu"]=='5' && $j==3)
          {
                if ($ui[$j]==3) print 'Администратор';
                if ($ui[$j]==2) print 'Оператор';
                if ($ui[$j]==1) print 'Пользователь';
          }
         else 
         if (($_GET["menu"]=='6' && $j==2) || ($_GET["menu"]=='14' && $j==21))
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
         if ($_GET["menu"]=='2' && $j==4)
          {
	   if ($ui[$j]=='1') print 'Производственное здание';
	   if ($ui[$j]=='2') print 'Теплица';
 	   if ($ui[$j]=='5') print 'Вход предприятия';
	   if ($ui[$j]=='6') print 'Выход предприятия';
          }
         else 
         if ($_GET["menu"]=='1' && $j==1)
          {
           print '<a href="88.php?menu=9&aren='; print $ui[0]; print '">'; 
           echo $ui[$j];  print '</a>';
          }
         else 
         if (($_GET["menu"]=='13' && $j==1))
          {
           print '<a href="shelf.php?id='; print $ui[0]; print '">'.$ui[$j]; 
          }
         else 
         if (($_GET["menu"]=='13' && $j==3) || ($_GET["menu"]=='9' && $j==3) || ($_GET["menu"]=='11' && $j==2))
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
         if ($_GET["menu"]=='6' && $j==3)
          {
           $query = 'SELECT name FROM korp WHERE korp_id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) 
                {
                  echo $uo[0];
                }
           else print 'Unknown';
          }
         else
         if ($_GET["menu"]=='1' && $j==2)
          {
           if ($ui[$j]=='1') print 'Арендатор';
           if ($ui[$j]=='2') print 'Субабонент';
	  }
         else
	         if ($_GET["menu"]=='21' && $j==1)
	          {
	           $query = 'SELECT event FROM why WHERE id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
        	   $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
	           else print 'Unknown';
	          }
		 else
	         if ($_GET["menu"]=='21' && $j==4)
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
	         if ($_GET["menu"]=='21' && $j==6)
	          {
	           $query = 'SELECT name FROM equipment WHERE id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
        	   $uo = mysql_fetch_row ($p);
	           if ($uo == true) print $uo[0];
        	   else print 'Не связано с датчиком';
	          }
	 else 
         if ($_GET["menu"]=='1' && $j==2)
          {
           if ($ui[$j]=='1') print 'Арендатор';
           if ($ui[$j]=='2') print 'Субабонент';
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
           else print 'н/у';
          }
         else
         if ($_GET["menu"]=='14' && $j==8)
          {
           $query = 'SELECT name FROM sensors WHERE id='.'\''. $ui[$j].'\'';
           $p = mysql_query ($query,$i);
           $uo = mysql_fetch_row ($p);
           if ($uo == true) print $uo[0];
           else print 'б/ш';
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
         if ($_GET["menu"]=='14' && $j==22)
          {
           if ($ui[$j]==1) print 'Абсолютная';
           else print 'Относительная';
          }
         else
         if ($_GET["menu"]=='9' && $j>9)
          {
           printf ("%.7f",$ui[$j]);
          }
         else
         if ($_GET["menu"]=='6' && $j==7)
          {
           if ($ui[$j] == '1') print 'Есть';
           else print 'Нет';
          }
         else
         if ($_GET["menu"]=='6' && $j>7)
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
			 print '<font title="Массовый расход утечек" class="dd">';
			 printf ("%.2f",$ui[$j]); print '(т/ч)</font>';
			}
                 if ($j==11) 
			{
	        	 //$ui[$j]=$ui[$j]*1000;
			 if ($ui[$j]<0) { $ui[$j]=0; print '<font title="Тепловая мощность (!ошибка датчика)" class="dd">';}
			 else print '<font title="Тепловая мощность по магистрали (ГКал/ч)" class="dd">';
			 printf ("%.3f",$ui[$j]); print '(ГКал/ч)</font>';
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
                 if ($j==9) { print '<font title="Измеренное значение давления (МПа)" class="dd'; if ($ui[9]<$ui[15]) print '4'; print '">'; printf ("%.4f",$ui[$j]); print '(МПа)</font>';}
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
	   $query = 'SELECT * FROM knt WHERE idkon=\''.$ui[4].'\'';
           $p = mysql_query ($query,$i);
	   if ($p) { $uo = mysql_fetch_row ($p); }
           print '<a href="uzel.php?id='; print $ui[0]; 
	   if ($ui[2]==7 && $p && $uo) print '" title="Коэффициент трансформации '.$uo[2];
	   print '">'; 
           echo $ui[$j];  print '</a>';
          }             
         else
	 if ($_GET["menu"]!='20') 
	    echo $ui[$j];
         if ($_GET["menu"]=='9')
          {
           $sm9[$j]=$sm9[$j]+$ui[$j];
          }
         print '</td>';
        }
    if ($edit==1)
        {
         if(($HTTP_COOKIE_VARS[user_priv]==3) || ($HTTP_COOKIE_VARS[user_priv]==2) || $HTTP_COOKIE_VARS[user_name]=='eabalandina')
         {
          print '';
          print '<td width=10 bgcolor=#ffffff><table><tr><form name="redr" method=post action="form_red.php"><td>';
          print '<input alt=Edit border=0 name=B1 src="files/chat.gif" type=image align=right style="cursor: hand"></td><td><input name="idn" style="width:1; height:1;  visibility:hidden" value="';   echo $ui[0];
          print '"><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="'; print $_GET["menu"]; print '"></td></form></tr></table></td>';
         }
        }
    if ($del==1)
        {
        if(($HTTP_COOKIE_VARS[user_priv]==3) || ($HTTP_COOKIE_VARS[user_priv]==2)  || $HTTP_COOKIE_VARS[user_name]=='eabalandina')
         {
         print '<form name="redd" method=post action="udbd.php">';
         print '<td width=10 bgcolor=#ffffff><table><tr><td><font class="down">';
         print '<input alt=Delete border=0 name=B1 src="files/backw.gif" type=image align=right style="cursor: hand"></td><td><input name="idn" style="width:1; height:1;  visibility:hidden" value="';   echo $ui[0];
         print '"><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="'; print $_GET["menu"]; print '"></td></tr></table></td></form>';
         }
        }
   }
}
if ($_GET["menu"]=='9')
{
 print '<tr><td bgcolor=#e0e0e0><font class="dd"><b>Итого:</b></font></td>';
 for ($j=2;$j<=$max;$j++)    
     {
      if ($j==6 || $j==7 || $j==9) print '<td bgcolor=#e0e0e0><font class="dd"><b>'.$sm9[$j].'</b></font></td>';
      else print '<td bgcolor=#e0e0e0></td>';
     }
 print '</tr>';
}
if ($_GET["menu"]=='6')
{
 print '<tr><td bgcolor=#e6e6e6 colspan=14 align=center><font class="dd">Неподключенные узлы</font></td></tr>';
 $query = 'SELECT id,name,idres,idkor,idkon,port,address,date,conn,P1,P2,P3,P4,P5,P6,P7 FROM uzel WHERE type=2';
 $e = mysql_query ($query,$i);
 for ($z=1;$z<=100;$z++)
     {
      $ui = mysql_fetch_row ($e);
      if ($ui == true) 
	 {
	  print '<tr>';
	  for ($j=1;$j<=$max+2;$j++)    
	      {
               print '<td bgcolor=#ffffff><font class="dd">';
	       if (($_GET["menu"]=='6' && $j==2))
	          {
	           $query = 'SELECT caption FROM energy_supply WHERE id='.'\''. $ui[$j].'\'';
        	   $p = mysql_query ($query,$i);
	           $uo = mysql_fetch_row ($p);
        	   if ($uo == true) print $uo[0];
	           else print $ui[2];
	          }
	        else 
	        if ($_GET["menu"]=='6' && $j==3)
	          {
	           $query = 'SELECT name FROM korp WHERE korp_id='.'\''. $ui[$j].'\'';
	           $p = mysql_query ($query,$i);
	           $uo = mysql_fetch_row ($p);
        	   if ($uo == true) 
        	          echo $uo[0];
	           else print 'Unknown';
	          }
		else
	        if ($_GET["menu"]=='6' && $j==8)
	          {
	           print 'Есть';
	          }
	        else
	        if ($_GET["menu"]=='6' && $j==9)
	           {
	  	     $query = 'SELECT * FROM data WHERE device=\''.$ui[4].'\' ORDER BY id DESC';
		     $p = mysql_query ($query,$i);
	 	     if ($p) { $uo = mysql_fetch_row ($p); }
		     print $uo[7].' (кВт/ч)'; 
		     $ui[10]=$uo[3];
                   }
	         else
	         if ($_GET["menu"]=='6' && $j==1)
	            {
	  	     $query = 'SELECT * FROM knt WHERE idkon=\''.$ui[4].'\'';
		     $p = mysql_query ($query,$i);
	 	     if ($p) { $uo = mysql_fetch_row ($p); }
	             print '<a href="uzel.php?id='; print $ui[0]; 
		     print '">'; 
	             echo $ui[$j];  print '</a>';
	            }             
	         else
		    echo $ui[$j];
	 	 print '</td>';
		}
	  print '</tr>';
	 }
     }
}
//$sm9[$j]
?>
</table><br>
</td><tr>
<tr><td>
<table border=0 align=center bgcolor=#ffffff>
<?php
if ($_GET["menu"]=='1')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название арендатора </font></td><td><input name="nam" size=20 class=log style="height:18px"></td></tr>';
print '<tr><td><font class="down">Тип арендатора </font></td><td>
<select class=log id="type" name="type" style="height:18">
<option value="1">Арендатор
<option value="2">Субабонент</select></td><td></td></tr>';
print '<tr><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td></tr>';
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="2"></td></tr></form>';
}

}
if ($_GET["menu"]=='4')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_name]=='nvudodova')
 
{
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Название ресурса </font></td><td><input name="nam" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Идентификатор </font></td><td><input name="id" size=20 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Тариф за еденицу </font></td><td><input name="price" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="4"></td></tr></form>';
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="5"></td></tr></form>';
  }
}
if ($_GET["menu"]=='6')
{
 if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_name]=='nvudodova')
  {
   print '<form name="reda" method=post action="tobd.php">';
   print '<tr><td colspan=3><a name="1"></a><font class="down">Добавить данные по неподключенному узлу учета</font></td></tr>';
   print '<tr><td><font class="down">Узел учета</font></td><td>';
   $today = getdate ();
   print '<select class=log id="device" name="device" style="height:18">';
   print '<option value="8801" '; if ($_GET["idd"]=="8801") print 'selected'; print '>Wф14-13 ГПП14';
   print '<option value="8802" '; if ($_GET["idd"]=="8802") print 'selected'; print '>Wф14-31 ГПП14';
   print '<option value="8803" '; if ($_GET["idd"]=="8803") print 'selected'; print '>Р23 показания эл.счетчика ф23';
   print '<option value="8804" '; if ($_GET["idd"]=="8804") print 'selected'; print '>W3* освещение на 2-м этаже корпуса 1(свободные площади ЧТП)';
   print '<option value="8805" '; if ($_GET["idd"]=="8805") print 'selected'; print '>W10* силовые нагрузки на 2-м этаже (свободные площади ЧТП)';
   print '<option value="8806" '; if ($_GET["idd"]=="8806") print 'selected'; print '>W11* расход по счетчику ОАСУП на 2-м этаже';
//   print '<option value="8807" '; if ($_GET["idd"]=="8807") print 'selected'; print '>Wр1 расход эл.энергии "Экспресс-Анализ" по РП-102-1-1-12-1';
//   print '<option value="8808" '; if ($_GET["idd"]=="8808") print 'selected'; print '>Wр2 расход эл.энергии "Экспресс-Анализ" по РП-102-2-1-12-1';
   print '<option value="8809" '; if ($_GET["idd"]=="8809") print 'selected'; print '>Wскл расход эл.энергии склада "бумаги", спирта';
   print '<option value="8810" '; if ($_GET["idd"]=="8810") print 'selected'; print '>Wр загот.уч';
   print '<option value="8811" '; if ($_GET["idd"]=="8811") print 'selected'; print '>Столовая подвал (ТП4)';
   print '<option value="8812" '; if ($_GET["idd"]=="8812") print 'selected'; print '>"Э-А" 1эт. ф17(ТП4)';
   print '<option value="8813" '; if ($_GET["idd"]=="8813") print 'selected'; print '>"Э-А" 2эт. ф7(ТП4)';
   print '<option value="8814" '; if ($_GET["idd"]=="8814") print 'selected'; print '>Wтеле расход энергии по вышке Теле2';
   print '<option value="8815" '; if ($_GET["idd"]=="8815") print 'selected'; print '>Wтары расход в корпусе №21';
   print '<option value="8816" '; if ($_GET["idd"]=="8816") print 'selected'; print '>Wэлв-сер1 расход Элвенса-Сервис W2';
   print '<option value="8817" '; if ($_GET["idd"]=="8817") print 'selected'; print '>Wэлв-сер2 расход Элвенса-Сервис W3';
   print '<option value="8818" '; if ($_GET["idd"]=="8818") print 'selected'; print '>Wсер-тран расход по счетчику Сервис-Транс';
   print '<option value="8819" '; if ($_GET["idd"]=="8819") print 'selected'; print '>Wхим.лаб. - потребление хим. лаборатории';
   print '<option value="1214" '; if ($_GET["idd"]=="1214") print 'selected'; print '>Храм';
   print '</select></td><td></td></tr>';
   print '<tr><td bgcolor=#ffffff><font class="down">Месяц / Год </font></td><td><select class=log id="month" name="month" style="height:18">';
   include ("inc/today_mon.inc"); print '</select><select class=log id="year" name="year" style="height:18">';
   include ("inc/today_year.inc");  print '</select></td><td></td></tr>';
   print '<tr><td bgcolor=#ffffff><font class="down">Расход Э/Э (кВт/ч)</font></td><td><input name="value" size=10 class=log style="height:18px"></td><td></td></tr>';
   print '<tr><td align=right bgcolor=#ffffff></td><td bgcolor=#ffffff><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td bgcolor=#ffffff><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="6"></td></tr></form>';
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="7"></td></tr></form>';
}
}
if ($_GET["menu"]=='8')
{
print '<form name="reda" method=post action="tobd.php">';
print '<tr><td><font class="down">Идентификатор методики </font></td><td><input name="idn" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Название методики </font></td><td><input name="name" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="8"></td></tr></form>';
}
if ($_GET["menu"]=='9')
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2 || $HTTP_COOKIE_VARS[user_name]=='nvudodova')
 
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
print '</select></td><td><font class="main">Полезный объем (для помещений)</td><td><input name="volume" size=10 class=log style="height:18px"></td></tr>';
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="9"></td></tr></form>';
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="11"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='12')
{
print '<tr><td><table border=0 align=center>';
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="16"></td></tr></form>';
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
print '<tr><td bgcolor=#ffffff align=center><font class="main">Время</font></td>';
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
 if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
	print '<td bgcolor=#ffffff align=center><font class="main">'.$ui[1].'</td>';
}
print '</tr>';
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#ffffff><table><tr><td></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></font></td></tr></table></td>';
for ($z=1;$z<=10;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
 if ($ui[2]==1 || $ui[2]==2 || $ui[2]==4 || $ui[2]==5 || $ui[2]==6 || $ui[2]==7) 
    {        
     if ($ui[2]==0) print '<td bgcolor=#ffffff align=center><font class="main">Массовый расход (кг)</td>';
     if ($ui[2]==1) print '<td bgcolor=#ffffff align=center><font class="main">Тепловая мощность(ГДж/ч)</td>';
     if ($ui[2]==2) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход воды (м3)</td>';
     if ($ui[2]==3) print '<td bgcolor=#ffffff align=center><font class="main">Расход пара (Гкал)</td>';
     if ($ui[2]==4) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход газа (м3)</td>';
     if ($ui[2]==5) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==6) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==7) print '<td bgcolor=#ffffff align=center><font class="main">Мощность (кВт)</td>';
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
	     $mont=$mon; $yeart=$year;
	     if ($ui[2]<7) if ($mon<12) $mont=$mon+1; else { $mont=1; $yeart=$year+1;}
	     if ($mont<10) $mont='0'.$mont;
	     $sour=$ui[2]+1;
	     if ($ui[2]==1 || $ui[2]==2 || $ui[2]==5) $query = 'SELECT SUM(value) FROM data WHERE korp=101 AND type=4 AND source='.$ui[2].' AND date='.$yeart.$mont.'01000000';
	     if ($ui[2]==4) $query = 'SELECT SUM(value) FROM data WHERE type=4 AND korp=101 AND source='.$ui[2].' AND name LIKE \'%массы%\' AND (date='.$yeart.$mont.'01120000 OR date='.$yeart.$mont.'01000000)';
	     if ($ui[2]==6) $query = 'SELECT SUM(value) FROM data WHERE type=4 AND korp=101 AND source='.$ui[2].' AND name LIKE \'%объема%\' AND (date='.$yeart.$mont.'01120000 OR date='.$yeart.$mont.'01000000)';
	     if ($ui[2]==7) $query = 'SELECT SUM(value) FROM data WHERE type=4 AND source='.$ui[2].' AND name LIKE \'%акт%\' AND name LIKE \'%Ввод%\' AND date='.$yeart.$mont.'01000000';
	     //echo $query;
	     $r = mysql_query ($query,$i);
	     if ($r)
	     	{
	     	 $uo = mysql_fetch_row ($r);
 		 print '<td><input name="'.$mont.'-'.$sour.'-value" value="'.$uo[0].'" size=10 class=log style="height:18px">
 		 <input name="'.$mont.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
 		 <input name="'.$mont.'-'.$sour.'-date" value="'.$yeart.$mont.'01000000" size=1 style="height:1;width:1;visibility:hidden">
                 <input name="'.$mont.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>';
	        }
	     else
	     	{
		 print '<td><input name="'.$mont.'-'.$sour.'-value" value="0.0" size=10 class=log style="height:18px">
 		 <input name="'.$mont.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
 		 <input name="'.$mont.'-'.$sour.'-date" value="'.$yeart.$mont.'01000000" size=1 style="height:1;width:1;visibility:hidden">
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
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="17"></td></tr></form>';
}
}
//--------------------------------------------------------------------------
if ($_GET["menu"]=='48') //???!!!!
{
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
{
print '<form name="reda" method=post action="tobd.php">';
$date=getdate(); $mon=$date['mon']; $year=$date['year'];
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#ffffff align=center><font class="main">Время</font></td>';
for ($z=1;$z<=10;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
    {
     if ($ui[2]==1 || $ui[2]==2 || $ui[2]==5 || $ui[2]==7) 
	print '<td bgcolor=#ffffff align=center><font class="main">'.$ui[1].'</td>';
     if ($ui[2]==0) print '<td bgcolor=#ffffff colspan=2 align=center><font class="main">'.$ui[1].'</td>';
    }
}
print '</tr>';
$query = 'SELECT * FROM energy_supply';
$e = mysql_query ($query,$i);
print '<tr><td bgcolor=#ffffff><table><tr><td></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></font></td></tr></table></td>';
for ($z=1;$z<=100;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true) 
 if ($ui[2]==0 || $ui[2]==1 || $ui[2]==2 || $ui[2]==5 || $ui[2]==7) 
    {        
     if ($ui[2]==0) print '<td bgcolor=#ffffff align=center><font class="main">Масса по подающей (т.)</td><td bgcolor=#ffffff align=center><font class="main">Масса по обратной (т.)</td>'; 
     if ($ui[2]==1) print '<td bgcolor=#ffffff align=center><font class="main">Тепловая мощность(ГКал)</td>';
     if ($ui[2]==2) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход воды (м3)</td>';
     if ($ui[2]==3) print '<td bgcolor=#ffffff align=center><font class="main">Расход пара (Гкал)</td>';
     if ($ui[2]==4) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход газа (м3)</td>';
     if ($ui[2]==5) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==6) print '<td bgcolor=#ffffff align=center><font class="main">Объемный расход (м3)</td>';
     if ($ui[2]==7) print '<td bgcolor=#ffffff align=center><font class="main">Мощность (кВт)</td>';        
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
		if ($ui == true) 
		   {
		    $sour=$ui[2]+1;
	            if ($ui[2]==1 || $ui[2]==2 || $ui[2]==5 || $ui[2]==7) 
		   	{
 		    	 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-value" value="'.$vhod0[$x][$ui[2]].'" size=10 class=log style="height:18px">
	 	    	 	<input name="'.$mont.'-'.$dats.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
	 		 	<input name="'.$mont.'-'.$dats.'-'.$sour.'-date" value="'.$year.$mont.$dats.'000000" size=1 style="height:1;width:1;visibility:hidden">
        	         	<input name="'.$mont.'-'.$dats.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>'; 
	           	}
		    if ($ui[2]==0)
		   	{
	 	    	 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-valus" value="'.$vhod0[$x][0].'" size=10 class=log style="height:18px">';
	 	    	 print '<td><input name="'.$mont.'-'.$dats.'-'.$sour.'-value" value="'.$vhod1[$x][0].'" size=10 class=log style="height:18px">';
		 	 print '<input name="'.$mont.'-'.$dats.'-'.$sour.'-korp" value="101" size=1 style="height:1;width:1;visibility:hidden">
   		 	   	<input name="'.$mont.'-'.$dats.'-'.$sour.'-date" value="'.$year.$mont.$dats.'000000" size=1 style="height:1;width:1;visibility:hidden">
        	           	<input name="'.$mont.'-'.$dats.'-'.$sour.'-source" value="'.$ui[2].'" size=1 style="height:1;width:1;visibility:hidden"></td>';
		   	}
		  }
	      }
	  print '</tr>';
	  $x++;
	}
    }
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="18"></td></tr></form>';
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
print '</select></td></tr>';
print '<tr><td><font class="down">Ответственный за шкаф</font></td><td><input name="otv" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">Координаты ответственного</font></td><td><textarea name="koor" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td><font class="down">Расходные материалы</font></td><td><textarea name="rash" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="13"></td></tr></form>';
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
print '<tr><td bgcolor=#ffffff width=120><font class="down">Узел учета</font></td><td><select class=log id="uzel" name="uzel" style="height:18">';
$query = 'SELECT id,name FROM uzel';
$e = mysql_query ($query,$i); 
print '<option value="0">Не установлен';
for ($z=0;$z<=220;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td bgcolor=#ffffff width=120><font class="down">Шкаф</font></td><td><select class=log id="shelf" name="shelf" style="height:18">';
$query = 'SELECT id,name FROM shelf';
$e = mysql_query ($query,$i); 
print '<option value="0">Без шкафа';
for ($z=0;$z<=220;$z++)
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
print '<tr><td><font class="down">Краткая история </font></td><td><textarea name="history" cols="100" rows="10" class=log></textarea></td><td></td></tr>';
print '<tr><td><font class="down">Диаметр</font></td><td><input name="Du" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td bgcolor=#ffffff width=120><font class="down">Тип датчика</font></td><td><select class=log id="s_type" name="s_type" style="height:18">';
$query = 'SELECT id,name FROM sensors';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=220;$z++)
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
print '<tr><td><font class="down">Требуется замена</font></td><td><input name="d_type" type=checkbox></td><td></td></tr>';
print '<tr><td align=right></td><td><input alt="Add" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="14"></td></tr></form>';
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
<? 
?>
