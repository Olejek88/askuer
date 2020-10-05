<?
include "main.php";
include "head.php";

$resq = "SELECT * FROM users WHERE user_priveleges=3;";
$rc = &$db->Execute($resq);
if($rc && $rc->RecordCount())
{
$str  = "./login.php";
?><meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
}
else 
{
if(!$_POST[submit_user_data])
 {
   echo "Ввод администратора системы";
   $myform = new HTML_Form($SELF,"POST");
   $myform->addHidden("cmd","new","");
   $myform->addText  ("user_name"    , "Имя пользователя","administrator");
   $myform->addPassword  ("passwd"    , "Пароль","");
   $myform->addSelect ("priveleges"    , "Права", $priveleges,"3");
   $myform->addSubmit("submit_user_data", "Отправить");
   $myform->display();
 }

if($_POST[submit_user_data] && $_POST[cmd]="new")
 {
    if($_POST["passwd"]!=$_POST["passwd2"] || $_POST["passwd"]=='' || $_POST["user_name"==''])
    {echo "Не все данные или пароль и подтверждение не совпадают";
     $str  = "./new_admin.php";
     ?><meta http-equiv="refresh" content="3; url=<?echo $str;?>"><?
    }
    else
    {$resq = "INSERT INTO users (user,passwd,user_priveleges) VALUES ('".$_POST[user_name]."','".$_POST[passwd]."',".$_POST[priveleges].");";
     if($db->Execute($resq)!=false)
      {
       $str  = "./login.php";
       ?><meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
      }else
      echo "Error inserting ".$db->ErrorMsg();
    }

  }
}
include "foot.php";

?>
