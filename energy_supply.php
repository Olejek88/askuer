<?
include "main.php";
include "head.php";

include "menu.php";

$resq = "SELECT user_priveleges FROM users WHERE user='".$HTTP_COOKIE_VARS["user_name"]."' AND passwd='".$HTTP_COOKIE_VARS["user_passwd"]."';";
$rc = &$db->Execute($resq);
if($rc && $rc->RecordCount() && $rc->fields[user_priveleges]==3 || $rc->fields[user_priveleges]==2)
    {
     $resq = "SHOW TABLES FROM ".$sqlbase." LIKE 'energy_supply';";
     $rc=&$db->Execute($resq);
     if($rc->RecordCount()==0)
      {
       $resq = "CREATE TABLE `energy_supply` (`idx` INTEGER(10) AUTO_INCREMENT PRIMARY KEY,`caption` VARCHAR(50),id INTEGER(10));"; 
       if($db->Execute($resq)==false)
       echo "Error creating tables ".$db->ErrorMsg();
      }
     $resq = "SELECT * FROM energy_supply;";
     $rc=&$db->Execute($resq);
     if($rc && $rc->RecordCount())
      {
       $str = "<TABLE border='1' align='center'>";
       while($rc && !$rc->EOF)
         {
         $str .= "<tr><td><b>".$rc->fields[id]."</b></td><td>".$rc->fields[caption]."<br></td></tr>"; 
         $rc->MoveNext();
         }
       $str .= "</table>";
       echo $str;
      }else
      {
       $i=0;
       $energy_supply = explode(",",$energy_supply);
       $result = count($energy_supply);
       $resq = "INSERT INTO energy_supply (caption,id) VALUES ";
       while($i<$result)
        {
         $resq .= "('".$energy_supply[$i]."',".$i.")";
         if($i<$result-1)
         $resq .= ",";
         $i=$i+1;
        }
       $resq .= ";";
       if($db->Execute($resq)!=false)
       {$str  = "./index.php?cmd=energy_supply";?>
       <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
       }else "Error inserting values ".$db->ErrorMsg();
      }
    }

include "foot.php";
?>