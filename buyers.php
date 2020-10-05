<?
include "main.php";
include "head.php";
include "menu.php";

$resq = "SELECT user_priveleges FROM users WHERE user='".$HTTP_COOKIE_VARS["user_name"]."' AND passwd='".$HTTP_COOKIE_VARS["user_passwd"]."';";
$rc = &$db->Execute($resq);
if($rc && $rc->RecordCount() && ($rc->fields[user_priveleges]==3 || $rc->fields[user_priveleges]==2))
{

 if(!$_POST[submit_user_data])
 {
  $resq = "SHOW TABLES FROM ".$sqlbase." LIKE 'buyers';";
  $rc = &$db->Execute($resq);
  if($rc->RecordCount()==0)
    {
     $resq = "CREATE TABLE `buyers` (`idx` INTEGER(10) AUTO_INCREMENT PRIMARY KEY,`caption` VARCHAR(50));"; 
     if($db->Execute($resq)==false)
      {
       echo "Error creating tables ".$db->ErrorMsg();
      }
    }
     $resq = "SELECT * FROM buyers;";
     $rc = &$db->Execute($resq);
     if($rc && $rc->RecordCount())
      {
       $str = "<TABLE border='1' align='center' size='100%'><tr><td><b>Название</b></td><td><b>Удалить</td></b></tr>";
       while($rc && !$rc->EOF)
        {
         $str .= "<tr><td>".$rc->fields[caption]."</b></td><td><a href='./buyers.php?cmd=rm&us_id=".$rc->fields[idx]."'> <> </a></td></tr>"; 
         $rc->MoveNext();
        }
       $str .= "</TABLE>"; 
       echo $str;
      }
     $myform = new HTML_Form($SELF,"POST");
     $myform->addHidden("cmd","new","");
     $myform->addText  ("buyers_name"    , "Добавить нового","");
     $myform->addSubmit("submit_user_data", "Отправить");
     $myform->display();
 }  

 if($_POST[submit_user_data] && $_POST[cmd]='new')
 {
  $resq = "SELECT * FROM buyers WHERE caption='".$_POST[buyers_name]."';";
  $rc = &$db->Execute($resq);
  if($rc && $rc->RecordCount())
    {
     echo "Такая организация уже есть в базе";?>
     <meta http-equiv="refresh" content="3; url=<?echo $SELF;?>"><?
    }else
    {
     $resq = "INSERT INTO buyers (caption) VALUE ('".$_POST[buyers_name]."');";
     if($db->Execute($resq)!=false)
      {
       echo "Выполнено";
       echo $_GET[cmd];
       ?>
       <meta http-equiv="refresh" content="3; url=<?echo $SELF;?>"><?
      }else "Error inserting values ".$db->ErrorMsg();
    }
// echo $_POST[buyers_name];
 }

if($_GET[cmd]=='rm')
 {
  $resq = "DELETE FROM buyers WHERE idx=".$_GET[us_id].";";
  if($db->Execute($resq)!=false)
  {?>
  <meta http-equiv="refresh" content="0; url=<?echo $SELF;?>"><?
  }else "Error deleting values ".$db->ErrorMsg();
 }


}


include "foot.php";
?>