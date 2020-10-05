<?php include("config/local.php");
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2 || $HTTP_COOKIE_VARS[user_name]=='nvudodova')
 
{


if ($_POST["frm"]=='1')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM buyers WHERE idx='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=1')";
print "</script>";
}
if ($_POST["frm"]=='2')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'SELECT korp_id FROM korp WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
if ($ui == true)
        {
         $query = 'ALTER TABLE people DROP '.$ui[0];
         $e = mysql_query ($query,$i);
        }
$query = 'DELETE FROM korp WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=2')";
print "</script>";
}
if ($_POST["frm"]=='3')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM data WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=3')";
print "</script>";
}
if ($_POST["frm"]=='4')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM energy_supply WHERE idx='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=4')";
print "</script>";
}
if ($_POST["frm"]=='5')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'SELECT name FROM users WHERE idx='.$_POST["idn"];
$ee = mysql_query ($query,$i);
$query = 'DELETE FROM users WHERE idx='.$_POST["idn"];
$e = mysql_query ($query,$i);
$query = 'INSERT INTO register (code,descr) VALUES (11,"Пользователь '.$HTTP_COOKIE_VARS[user_name].' произвел изменение таблицы users: удалил позователя - '.$ee[1].'")';
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=5')";
print "</script>";
}
if ($_POST["frm"]=='6')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM uzel WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=6&sort=4&sour=')";
print "</script>";
}
if ($_POST["frm"]=='7')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM terrirtory WHERE idx='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=7')";
print "</script>";
}
if ($_POST["frm"]=='8')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM methods WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=8')";
print "</script>";
}
if ($_POST["frm"]=='9')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM obj WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
$addr=$_SERVER['REMOTE_ADDR'];
$query = 'INSERT INTO register (code,descr,who,ip) VALUES (11,"Пользователь '.$PHP_AUTH_USER.' внес изменения в таблицу объектов: Удалил объект c id '.$_POST["idn"].'",'.'\''.$PHP_AUTH_USER.'\',\''.$addr.'\')';
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=9')";
print "</script>";
}
if ($_POST["frm"]=='10')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM people WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=10')";
print "</script>";
}
if ($_POST["frm"]=='11')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM production WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "Content-Type: text/html\n\n";
print "<script>";
print "imgs=window.navigate ('88.php?menu=11')";
print "</script>";
}
if ($_POST["frm"]=='13')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM shelf WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "<script>";
print "imgs=window.navigate ('88.php?menu=13')";
print "</script>";
}
if ($_POST["frm"]=='14')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM equipment WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "<script>";
print "imgs=window.navigate ('88.php?menu=14')";
print "</script>";
}
if ($_POST["frm"]=='15')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM register WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "<script>";
print "imgs=window.navigate ('88.php?menu=15')";
print "</script>";
}
if ($_POST["frm"]=='16')
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = 'DELETE FROM sensors WHERE id='.$_POST["idn"];
$e = mysql_query ($query,$i);
print "<script>";
print "imgs=window.navigate ('88.php?menu=16')";
print "</script>";
}


}

else echo "Нет доступа!!!";

?>