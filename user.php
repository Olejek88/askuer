<?
include "main.php";
include "head.php";
include "menu.php";

$resq = "SELECT user_priveleges FROM users WHERE user='".$HTTP_COOKIE_VARS["user_name"]."' AND passwd='".$HTTP_COOKIE_VARS["user_passwd"]."';";
$rc = &$db->Execute($resq);
if($rc && $rc->RecordCount() && $rc->fields[user_priveleges]==3)
{
 if(!$_POST[submit_user_data] && !$_GET[cmd])
  {
  echo 'Пользователи системы';
  $resq = "SELECT * FROM users;";
  $rc = &$db->Execute($resq);
  if($rc && $rc->RecordCount())
   {
     $str ='<TABLE border="1" align="center">';
     $str .= "<tr><td><b>Имя пользователя</b></td><td><b>Статус</b></td><td><b>Изменить</td></b><td><b>Удалить</td></b></tr>";       
      while($rc && !$rc->EOF)
       {
        $str .= '<tr><td>'.$rc->fields[user].'</td><td>'.$priveleges[$rc->fields[user_priveleges]].'</td>';       
        $str .= '<td><a href="./user.php?cmd=user_up&us_id='.$rc->fields[idx].'"> <> </a></td><td><a href="./user.php?cmd=user_rm&us_id='.$rc->fields[idx].'"> <> </a></td></tr>';
        $rc->MoveNext();
       }
     $str .= '</TABLE>';
   }
  echo $str;

   echo "Новый пользователь";
   $myform = new HTML_Form($SELF,"POST");
   $myform->addHidden("cmd","new","");
   $myform->addText  ("user_name"    , "Имя пользователя","");
   $myform->addPassword  ("passwd"    , "Пароль","");
   $myform->addSelect ("priveleges"    , "Права", $priveleges,"1");
   $myform->addSubmit("submit_user_data", "Отправить");
   $myform->display();
  }
 
 
 if($_POST[submit_user_data] && $_POST[cmd]=='new')
  {
   if($_POST["passwd"]!=$_POST["passwd2"] || $_POST["passwd"]=='' || $_POST["user_name"=='']) 
    {
     echo "Не все данные или пароль и подтверждение не совпадают";
     $str  = "./user.php";?>
     <meta http-equiv="refresh" content="3; url=<?echo $str;?>"><?
    }else 
    {
     $resq = "SELECT * FROM users WHERE user='".$_POST[user_name]."';";
     $rc = &$db->Execute($resq);
     if($rc && $rc->RecordCount())
      {
       echo "Пользователь с таким именем уже существует";
       $str  = "./user.php";?>
       <meta http-equiv="refresh" content="3; url=<?echo $str;?>"><?
      }else  
      {
       $resq = "INSERT INTO users (user,passwd,user_priveleges) VALUES ('".$_POST[user_name]."','".$_POST[passwd]."',".$_POST[priveleges].");";
       if($db->Execute($resq)!=false)
        {
           $str  = "./user.php";
           ?>
           <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
        }else
         echo "Error inserting ".$db->ErrorMsg();
      }
   }
  }

if($_GET[cmd]=='user_rm' && $_GET[us_id])
 {
  $resq = "SELECT user_priveleges FROM users WHERE idx=".$_GET[us_id].";";
  $rc = &$db->Execute($resq);
  if($rc->fields[user_priveleges]==3)
   {
    $i=0;
    $resq = "SELECT idx FROM users WHERE user_priveleges=3";
    $rc = &$db->Execute($resq);
    if($rc && $rc->RecordCount())
     {
      while($rc && !$rc->EOF)
       {
        $i++;
        $rc->MoveNext();
       }
     }
    if($i>1)
     {
      $resq = "DELETE FROM users WHERE idx=".$_GET[us_id].";";
      if($db->Execute($resq))
        {
         $str  = "./user.php";?>
         <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
        } else echo "Error deleting ".$db->ErrorMsg(); 
     }else 
     {
      echo "Невозможно удалить единственного администратора системы";
      $str  = "./user.php";?>
      <meta http-equiv="refresh" content="4; url=<?echo $str;?>"><?
     }
   }
   else
   {
    $resq = "DELETE FROM users WHERE idx=".$_GET[us_id].";";
    if($db->Execute($resq))
      {
       $str  = "./user.php";?>
       <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
      } else echo "Error deleting ".$db->ErrorMsg();
    }
 }

if($_GET[cmd]=='user_up' && $_GET[us_id])
 {
  echo 'Пользователи системы';
  $resq = "SELECT * FROM users;";
  $rc = &$db->Execute($resq);
  if($rc && $rc->RecordCount())
   {
    $str ='<TABLE border="1" align="center">';
    $str .= "<tr><td><b>Имя пользователя</b></td><td><b>Статус</b></td><td><b>Изменить</td></b><td><b>Удалить</td></b></tr>";       
    while($rc && !$rc->EOF)
     {
      $str .= '<tr><td>'.$rc->fields[user].'</td><td>'.$priveleges[$rc->fields[user_priveleges]].'</td>';       
      $str .= '<td><a href="./user.php?cmd=user_up&us_id='.$rc->fields[idx].'"> <> </a></td><td><a href="./user.php?cmd=user_rm&us_id='.$rc->fields[idx].'"> <> </a></td></tr>';
      $rc->MoveNext();
     }
    $str .= '</TABLE>';
   }
  echo $str;
  $resq = "SELECT * FROM users WHERE idx=".$_GET[us_id].";";
  $rc = &$db->Execute($resq);
  echo "Редактировать";
  $myform = new HTML_Form($SELF,"POST");
  $myform->addHidden("cmd","user_up","");
  $myform->addHidden("us_id",$_GET[us_id],"");
  $myform->addText  ("user_name"    , "Имя пользователя",$rc->fields[user]);
  $myform->addPassword  ("passwd"    , "Пароль","");
  $myform->addSelect ("priveleges"    , "Права", $priveleges,$rc->fields[user_priveleges]);
  $myform->addSubmit("submit_user_data", "Отправить");
  $myform->display();
 }

 if($_POST[cmd]=='user_up' && $_POST[us_id])
 {
  if($_POST["passwd"]!=$_POST["passwd2"] || $_POST["passwd"]=='' || $_POST["user_name"=='']) 
   {
    echo "Не все данные или пароль и подтверждение не совпадают";
    $str  = "./user.php?cmd=user_up&us_id=".$_POST[us_id];?>
    <meta http-equiv="refresh" content="3; url=<?echo $str;?>"><?
   }else 
   {
    $resq = "SELECT * FROM users WHERE user='".$_POST[user_name]."' AND idx!=".$_POST[us_id].";";
    $rc = &$db->Execute($resq);
    if($rc && $rc->RecordCount())
     {
      echo "Пользователь с таким именем уже существует";
      $str  = "./user.php?cmd=user_up&us_id=".$_POST[us_id];?>
      <meta http-equiv="refresh" content="3; url=<?echo $str;?>"><?
     }else  
     {
      $resq = "UPDATE users set user='".$_POST[user_name]."',passwd='".$_POST[passwd]."',user_priveleges=".$_POST[priveleges]." WHERE idx=".$_POST[us_id].";";
      if($db->Execute($resq)!=false)
       {
        $str  = "./user.php";
        ?>
        <meta http-equiv="refresh" content="0; url=<?echo $str;?>"><?
       }else
        echo "Error updating ".$db->ErrorMsg();
     }
   }
 }

}
include "foot.php";

?>