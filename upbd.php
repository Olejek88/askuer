<?php  include("config/local.php");
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
 
{

$shapka_err = '<html><head><style>
         a:link  {font:8pt/11pt verdana; color:red}
         a:visited {font:8pt/11pt verdana; color:#4e4e4e}
         </style><meta HTTP-EQUIV="Content-Type" Content="text-html; charset=Windows-1251">
         <title>Не пойдет!</title></head>
         <body bgcolor="white" onload="initPage()">
         <table width="400" cellpadding="3" cellspacing="5"><tr>
         <td valign="top" align="left">
         <img id="pagerrorImg" SRC="files/pagerror.gif" width="25" height="33"></td>
         <td id="tableProps2" align="left" valign="middle" width="360"><h1 id="textSection1" style="COLOR: black; FONT: 13pt/15pt verdana">
         <span id="errorText">Уважаемый редактор, вы допустили ошибку при вводе данных.</span></h1>
         </td></tr><tr><td id="tablePropsWidth" width="400" colspan="2"><font style="COLOR: black; FONT: 8pt/11pt verdana">
         Допущенная вами ошибка легко может быть исправлена если вы последуете этим инструкциям.</font></td></tr><tr>
         <td id="tablePropsWidth" width="400" colspan="2"><font style="COLOR: black; FONT: 8pt/11pt verdana"><hr color="#C0C0C0" noshade><p>Информация об ошибке:</p>';
$konec_err = '<li>Нажмите <a href="javascript:history.back(1)"><img valign=bottom border=0 src="files/back.gif"> Back</a> для редактирования новости.</li>
    </ul><p><br></p><h2 style="font:8pt/11pt verdana; color:black">Невозможно осуществить обновление данных в таблице БД.
    </h2></font>';
$konec2_err = '</td></tr></table></body></html>';
$error="";
$err = 0;

$errr[0] = "<li>[0] Не указано название </li>";
$errr[1] = "<li>[1] Неправильный логин или пароль к БД. Или БД не отвечает. Или неправильная структура запроса.</li>";
$errr[2] = "<li>[2] Не заполнено одно или несколько полей </li>";

if ($_POST["frm"]=='1')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["nam"]=='') { $err++; $arr[0] = 1;   }

if ($err == 0)
{
 $query = 'UPDATE buyers SET caption='.'\''.$_POST["nam"].'\',type='.'\''.$_POST["type"].'\''. ' WHERE idx='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=1')";
 print "</script>";
}
}

if ($_POST["frm"]=='2')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;}
if ($_POST["korp_id"]=='') { $err++; $arr[1] = 1;}

if ($err == 0)
{
 $query = 'UPDATE korp SET name='.'\''.$_POST["name"].'\''. ',korp_id='.'\''.$_POST["korp_id"].'\''. ',descr='.'\''.$_POST["descr"].'\''. ',type='.'\''.$_POST["type"].'\''. ' WHERE  id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=2')";
 print "</script>";
}
}

if ($_POST["frm"]=='4')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["nam"]=='') { $err++; $arr[0] = 1;   }

if ($err == 0)
{
 $query = 'UPDATE energy_supply SET caption='.'\''.$_POST["nam"].'\''. ',price='.'\''.$_POST["price"].'\''. ',id='.'\''.$_POST["id"].'\''. ' WHERE  idx='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
// print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=4')";
 print "</script>";
}
}

if ($_POST["frm"]=='5')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["user"]=='') { $err++; $arr[0] = 1;  }

if ($err == 0)
{
 $query = 'UPDATE users SET user='.'\''.$_POST["user"].'\''. ',passwd='.'\''.$_POST["passwd"].'\''. ',user_priveleges='.'\''.$_POST["user_priveleges"].'\''. ' WHERE  idx='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=5')";
 print "</script>";
}
}

if ($_POST["frm"]=='6')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }

if ($err == 0)
{
 $query = 'UPDATE uzel SET name='.'\''.$_POST["name"].'\''. ',idkor='.'\''.$_POST["idkor"].'\''.',
 P6='.'\''.$_POST["P6"].'\''.',
 P7='.'\''.$_POST["P7"].'\''.',
 P8='.'\''.$_POST["P8"].'\''.',
 P9='.'\''.$_POST["P9"].'\''.',
 P10='.'\''.$_POST["P10"].'\''.',
 P11='.'\''.$_POST["P11"].'\''.',
 P12='.'\''.$_POST["P12"].'\''.',
 P13='.'\''.$_POST["P13"].'\''.',
 P14='.'\''.$_POST["P14"].'\''. ' WHERE  id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=6&sort=4&sour=')";
 print "</script>";
}
}

if ($_POST["frm"]=='7')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["caption"]=='') { $err++; $arr[0] = 1;       }
if ($_POST["inc_energy"]=='') { $err++; $arr[2] = 1;    }
if ($_POST["out_energy"]=='') { $err++; $arr[2] = 1;    }
if ($_POST["latitude"]=='') { $err++; $arr[2] = 1;      }
if ($_POST["longtitude"]=='') { $err++; $arr[2] = 1;    }
if ($_POST["height"]=='') { $err++; $arr[2] = 1;        }
if ($_POST["square"]=='') { $err++; $arr[2] = 1;        }
if ($_POST["cold_period"]=='') { $err++; $arr[2] = 1;   }
if ($_POST["temperature"]=='') { $err++; $arr[2] = 1;   }
if ($_POST["atm_pressure"]=='') { $err++; $arr[2] = 1;  }
if ($_POST["humidity"]=='') { $err++; $arr[2] = 1;      }
if ($_POST["sunny_days"]=='') { $err++; $arr[2] = 1;    }
if ($_POST["rs_temp"]=='') { $err++; $arr[2] = 1;       }

if ($err == 0)
{
 $query = 'UPDATE territory SET caption='.'\''.$_POST["caption"].'\''. ',inc_energy='.'\''.$_POST["inc_energy"].'\''. ',out_energy='.'\''.$_POST["out_energy"].'\''. ',latitude='.'\''.$_POST["latitude"].'\''. ',longitude='.'\''.$_POST["longtitude"].'\''. ',height='.'\''.$_POST["height"].'\''. ',square='.'\''.$_POST["square"].'\''. ',cold_period='.'\''.$_POST["cold_period"].'\''. ',temperature='.'\''.$_POST["temperature"].'\''. ',atm_pressure='.'\''.$_POST["atm_pressure"].'\''. ',humidity='.'\''.$_POST["humidity"].'\''. ',sunny_days='.'\''.$_POST["sunny_days"].'\''. ',rs_temp='.'\''.$_POST["rs_temp"].'\''. ' WHERE  idx='.$_POST["idn"];
 echo  $query;
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 else 
        { 
         print "Content-Type: text/html\n\n";
         print "<script>";
         print "imgs=window.navigate ('88.php?menu=7')";
         print "</script>";
        }
}
}

if ($_POST["frm"]=='8')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }
if ($_POST["idn"]=='') { $err++; $arr[2] = 1;   }

if ($err == 0)
{
 $query = 'UPDATE methods SET name='.'\''.$_POST["name"].'\''. ',idn='.'\''.$_POST["idx"].'\''. ' WHERE  id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=8')";
 print "</script>";
}
}

if ($_POST["frm"]=='9')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }
if ($_POST["idn"]=='') { $err++; $arr[2] = 1;   }

if ($_POST["idbuy"]=='0') { $err++; $arr[3] = 1;}
$qbuy=1;
if ($_POST["idbuy2"]!='0') { $qbuy++; }
if ($_POST["idbuy3"]!='0') { $qbuy++; }
if ($_POST["idbuy4"]!='0') { $qbuy++; }
if ($_POST["idbuy5"]!='0') { $qbuy++; }

if ($err == 0)
{
 $query = 'UPDATE obj SET name='.'\''.$_POST["name"].'\''. ',
        idbuy='.'\''.$_POST["idbuy"].'\''. ',
        buy_q='.'\''.$qbuy.'\''. ',
        idkorp='.'\''.$_POST["idkorp"].'\''. ',
        type='.'\''.$_POST["type"].'\''. ',
        square='.'\''.$_POST["square"].'\''. ',
        aren_square='.'\''.$_POST["aren_square"].'\''. ',
        BTI='.'\''.$_POST["BTI"].'\''. ',
        K_agr='.'\''.$_POST["K_agr"].'\''. ',
        Q_agr='.'\''.$_POST["Q_agr"].'\''. ',
        height='.'\''.$_POST["height"].'\''. ',
        level='.'\''.$_POST["level"].'\''. ',
        nPP='.'\''.$_POST["nPP"].'\''. ',
        poll_square='.'\''.$_POST["poll_square"].'\''. ',
        volume='.'\''.$_POST["volume"].'\''. ',
        Qszh='.'\''.$_POST["Qszh"].'\''. ',
        Qkisl='.'\''.$_POST["Qkisl"].'\''. ',
        Qgaza='.'\''.$_POST["Qgaza"].'\''. ' WHERE  id='.$_POST["idn"]; 
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
//echo $query;
 include("script_no_out.php"); 
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=9')";
 print "</script>";
}
}

if ($_POST["frm"]=='10')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'SELECT korp_id,name FROM korp ORDER BY id';
$e = mysql_query ($query,$i);
$query2 = 'UPDATE people SET ';
$hui=0;
for ($z=2;$z<=50;$z++)
 {
  $ui = mysql_fetch_row ($e);
  if ($ui == true)
    {
     $nm='quant'.$z;
     if ($_POST[$nm]=='') { $err++; $arr[0] = 1;        }
     $query = 'SELECT name FROM korp WHERE korp_id=\''. $ui[0] . '\'';
     echo $query;     
     $q = mysql_query ($query,$i);
     $uo = mysql_fetch_row ($q);
     if ($uo == true)
        {
         if ($hui!=0) $query2 = $query2 . ',';
         $query2 = $query2 . 'id' . $ui[0] . '=\''.$_POST[$nm].'\'';
         $hui=1;
        }
    }
 }
$query2 = $query2 . ' WHERE  id='.$_POST["idn"];
echo $query2;

if ($err == 0)
{
 $e = mysql_query ($query2,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=10')";
 print "</script>";
}
}

if ($_POST["frm"]=='11')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }
if ($_POST["udpr"]=='') { $err++; $arr[2] = 1;  }
if ($_POST["quant"]=='') { $err++; $arr[2] = 1; }

if ($err == 0)
{
 $query = 'UPDATE production SET name='.'\''.$_POST["name"].'\''. ',idkor='.'\''.$_POST["idkor"].'\''. ',udpr='.'\''.$_POST["udpr"].'\''. ',quant='.'\''.$_POST["quant"].'\''. ',idbuy='.'\''.$_POST["idbuy"].'\''. ' WHERE  id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=11')";
 print "</script>";
}
}

if ($_POST["frm"]=='13')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }
if ($_POST["descr"]=='') { $err++; $arr[2] = 1; }

if ($err == 0)
{
 $query = 'UPDATE shelf SET name='.'\''.$_POST["name"].'\''. ',rash='.'\''.$_POST["rash"].'\''. ',idkor='.'\''.$_POST["idkor"].'\''. ',otv='.'\''.$_POST["otv"].'\''. ',koor='.'\''.$_POST["koor"].'\''. ',descr='.'\''.$_POST["descr"].'\''. ' WHERE id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=13')";
 print "</script>";
}
}

if ($_POST["frm"]=='14')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }
if ($_POST["d_type"]=='on') $d_type=1; else $d_type=0;
if ($err == 0)
{
 $query = 'UPDATE equipment SET name=\''.$_POST["name"].'\',date_buy=\''.$_POST["date_buy_year"].$_POST["date_buy_month"].$_POST["date_buy_day"].'000000\',
 date_mon_1=\''.$_POST["date_mon_1_year"].$_POST["date_mon_1_month"].$_POST["date_mon_1_day"].'000000\',
 date_vvod=\''.$_POST["date_vvod_year"].$_POST["date_vvod_month"].$_POST["date_vvod_day"].'000000\',
 date_prov_p=\''.$_POST["date_prov_p_year"].$_POST["date_prov_p_month"].$_POST["date_prov_p_day"].'000000\',
 date_prov_s=\''.$_POST["date_prov_s_year"].$_POST["date_prov_s_month"].$_POST["date_prov_s_day"].'000000\',
 period_p=\''.$_POST["period_p"].'\',
 type=\''.$_POST["type"].'\',
 serial=\''.$_POST["serial"].'\',
 uzel=\''.$_POST["uzel"].'\',
 shelf=\''.$_POST["shelf"].'\',
 source=\''.$_POST["source"].'\',
 date_dem_p=\''.$_POST["date_dem_p_year"].$_POST["date_dem_p_month"].$_POST["date_dem_p_day"].'000000\',
 prichina_dem=\''.$_POST["prichina_dem"].'\',
 date_mon_p=\''.$_POST["date_mon_p_year"].$_POST["date_mon_p_month"].$_POST["date_mon_p_day"].'000000\',
 prichina_mon=\''.$_POST["prichina_mon"].'\',
 history=\''.$_POST["history"].'\',
 Du=\''.$_POST["Du"].'\',
 s_type=\''.$_POST["s_type"].'\',
 Pmin=\''.$_POST["Pmin"].'\',
 Pmax=\''.$_POST["Pmax"].'\',
 d_type=\''.$d_type.'\',
 d=\''.$_POST["d"].'\' WHERE id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
//print "Content-Type: text/html\n\n";
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=14')";
 print "</script>";
}
}

if ($_POST["frm"]=='16')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
if ($_POST["name"]=='') { $err++; $arr[0] = 1;  }
if ($_POST["type"]=='') { $err++; $arr[2] = 1;  }

if ($err == 0)
{
 $query = 'UPDATE sensors SET name='.'\''.$_POST["name"].'\''. ',type='.'\''.$_POST["type"].' WHERE  id='.$_POST["idn"];
 $e = mysql_query ($query,$i);
 if ($e==0)    {     $err++;  $arr[1] = 1;    }
 print "<script>";
 print "imgs=window.navigate ('88.php?menu=16')";
 print "</script>";
}
}

if ($err>0)
        {
        if ($arr[0]==1) { $error = $error . $errr[0]; }
        if ($arr[1]==1) { $error = $error . $errr[1]; }
        print $shapka_err;
        print $error;
        print $konec_err;
        print '<font style="font:8pt/11pt verdana; color:black">Всего ошибок:';
        print $err;
        print '</font>';
        print $konec2_err;
        }
}

else echo "Нет доступа!!!";
?>