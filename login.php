<?

include "main.php";
include "head.php";

if(!$_POST[submit_user_data])
{ $resq = "SHOW TABLES FROM ".$sqlbase." LIKE 'users';";
  $rc=&$db->Execute($resq);
  if($rc && $rc->RecordCount()) 
   { 
    $resq = "SELECT *  FROM users WHERE user_priveleges=3;";
    $rc=&$db->Execute($resq);
      if($rc && $rc->RecordCount()) 
       {
         $myform = new HTML_Form($SELF,"POST");
         $myform->addText  ("user_name"    , "Имя пользователя","");
         $myform->addText  ("passwd"    , "Пароль","");
         $myform->addSubmit("submit_user_data", "Войти!");
         $myform->display();
       }else                    
       {
         $str  = "./new_admin.php";?>
        <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
       } 

   }
   else
   {
    $resq = "CREATE TABLE `users` (`idx` INTEGER(10) AUTO_INCREMENT PRIMARY KEY,`user` VARCHAR(50),`passwd` VARCHAR(1),`user_priveleges` INTEGER);"; 
    if($db->Execute($resq)!=false)
       {
        $str  = "./new_admin.php";?>
        <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
       } else echo "Error creating tables ".$db->ErrorMsg();
   }
}

if($_POST[submit_user_data])
{
 $resq = "SELECT * FROM users WHERE user='".$_POST[user_name]."' AND passwd='".$_POST[passwd]."';";
 $rc = &$db->Execute($resq);
 if($rc && $rc->RecordCount())
   {?>
     <meta http-equiv="Set-Cookie" CONTENT="user_name=<?echo $_POST[user_name];?>">
     <meta http-equiv="Set-Cookie" CONTENT="user_passwd=<?echo $_POST[passwd];?>">
     <meta http-equiv="Set-Cookie" CONTENT="user_priv=<?echo $rc->fields[user_priveleges];?>">
     <meta http-equiv="refresh" CONTENT="0; url=./index.php">
     <?
   }
    else
   {
     echo "Ошибка авторизации";
     $str  = "./login.php";?>
     <meta http-equiv="refresh" content="3; url=<?echo $str;?>"><?

   }
}  
 

 include "foot.php";
?>