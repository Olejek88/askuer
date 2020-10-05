<?
include "main.php";
include "head.php";
include "menu.php";

$resq = "SELECT user_priveleges FROM users WHERE user='".$HTTP_COOKIE_VARS["user_name"]."' AND passwd='".$HTTP_COOKIE_VARS["user_passwd"]."';";
$rc = &$db->Execute($resq);
if($rc && $rc->RecordCount() && $rc->fields[user_priveleges]==3 || $rc->fields[user_priveleges]==2)
{
  if(!$_POST[submit_user_data])
    { 
     $resq = "SHOW TABLES FROM ".$sqlbase." LIKE 'territory';";
     $rc = &$db->Execute($resq);
     if($rc->RecordCount()==0)
       {
        $resq = "CREATE TABLE `territory` (`idx` INTEGER(10) AUTO_INCREMENT PRIMARY KEY,`caption` VARCHAR(255),`inc_energy` INTEGER(10),`out_energy` INTEGER(10),`latitude` INTEGER(10),`longitude` INTEGER(10),`height` INTEGER(10),`square` DOUBLE,`cold_period` INTEGER(10),`temperature` DOUBLE,`atm_pressure` DOUBLE,`humidity` DOUBLE,`sunny_days` INTEGER(10));";
        if($db->Execute($resq)==false)
        echo "Error inserting values ".$db->ErrorMsg();
       }

     $resq = "SELECT idx,caption FROM territory;";
     $rc = &$db->Execute($resq);
      if($rc && $rc->RecordCount())
       {
         $str = "<TABLE>";
         $str .="<TR><TD><b>Териитории:</b></TD></TR>";
         while($rc && !$rc->EOF)
          {
           $str .= '<TR><TD><a href="./territory.php?cmd=lst&idx='.$rc->fields[idx].'">'.$rc->fields[caption].'</a><br></TD></TR>';
           
           $rc->MoveNext();
          }
         $str .= "</TABLE>";
       }

     echo $str;

     $str = "<TABLE align='center'>";
     $str .="<TR><TD><b>Добавить новую территорию:</b></TD></TR>";
     $str .= "</TABLE>";
     echo $str;

     $myform = new HTML_Form($SELF,"POST");
     $myform->addHidden("cmd","new","");
     $myform->addText  ("caption"    , "Наименование","");
 
     $resq = "SELECT * FROM energy_supply;";
     $rc = &$db->Execute($resq);
     if($rc && $rc->RecordCount())
       {
     $myform->addText  (""    , "","Входящие данные","");
         while($rc && !$rc->EOF)
          {
           $myform->addCheckbox  ("in".$rc->fields[id]    , $rc->fields[caption],"");
           $rc->MoveNext();
          }

       }


     $resq = "SELECT * FROM energy_supply;";
     $rc = &$db->Execute($resq);
     if($rc && $rc->RecordCount())
       {
     $myform->addText  (""    , "","Исходящие данные","");
         while($rc && !$rc->EOF)
          {
           $myform->addCheckbox  ("out".$rc->fields[id]    , $rc->fields[caption],"");
           $rc->MoveNext();
          }

       }
     $myform->addText  ("latitude"    , "Широта","");
     $myform->addText  ("longitude"    , "Долгота","");
     $myform->addText  ("height"    , "Положение над уровнем моря","");     
     $myform->addText  ("square"    , "Занимаемая площадь","");
     $myform->addText  ("cold_period"    , "Продолжительность отопительного периода","");               
     $myform->addText  ("temperature"    , "Среднегодовая температура","");     
     $myform->addText  ("atm_pressure"    , "Среднегодовое атмосферное давление","");     
     $myform->addText  ("humidity"    , "Среднегодовая влажность","");     
     $myform->addText  ("sunny_days"    , "Среднегодовое количество солнечных дней","");     
     $myform->addSubmit("submit_user_data", "Отправить");
     $myform->display();
    }

   if($_POST[submit_user_data] && $_POST[cmd]='new')
   {
    if($_POST[caption]!="" || $_POST[latitude]!="" || $_POST[longitude]!="" || $_POST[height]!="" || $_POST[square]!="" || $_POST[cold_period]!="" || $_POST[temperature]!="" || $_POST[atm_pressure]!="" || $_POST[humidity]!="" || $_POST[sunny_days]!="")
//    if($_POST[sunny_days]!="" || $_POST[caption]!="" || $_POST[latitude]!="" || $_POST[longitude]!="" || $_POST[height]!="" || $_POST[square]!="" || $_POST[cold_period]!="" || $_POST[temperature]!="" || $_POST[atm_pressure]!="")
    {
    $resq = "SELECT * FROM energy_supply;";
    $rc = &$db->Execute($resq);
    $i = $rc->RecordCount()-1;
    $in_str="";
    while($i>=0)
      {
       $s = "in".$i;
       if($_POST[$s]=="on")
         {$in_str .= "1";}
       else
         {$in_str .= "0";}
       $i=$i-1;
      }
    $resq = "SELECT * FROM energy_supply;";
    $rc = &$db->Execute($resq);
    $i = $rc->RecordCount()-1;
    $out_str="";
    while($i>=0)
      {
       $s = "out".$i;
       if($_POST[$s]=="on")
         {$out_str .= "1";}
       else
         {$out_str .= "0";}
       $i=$i-1;
      }
    $resq  = "INSERT INTO territory ";
    $resq .= "(caption,inc_energy,out_energy,latitude,longitude,height,square,cold_period,temperature,atm_pressure,humidity,sunny_days) ";
    $resq .= "VALUE ";
    $resq .= "('".$_POST[caption]."',".bindec($in_str).",".bindec($out_str).",".$_POST[latitude].",".$_POST[longitude].",".$_POST[height].",".$_POST[square].",".$_POST[cold_period].",".$_POST[temperature].",".$_POST[atm_pressure].",".$_POST[humidity].",".$_POST[sunny_days].");";
    if($db->Execute($resq)!=false)
     {
      echo "Выполнено";
      ?><meta http-equiv="refresh" content="2; url=<?echo $SELF;?>"><?
     }
      else echo "Error ".$db->ErrorMsg();
   }else 
   {echo "Не все данные!!!";
    ?><meta http-equiv="refresh" content="2; url=<?echo $SELF;?>"><?
   }
   }

}

include "foot.php";

?>