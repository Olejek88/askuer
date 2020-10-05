<?
if (! is_file("up.php")) { } else { include "up.php"; }
include "colors.php";
print "<table width=".$width." cellpadding=0 cellspacing=0 border=0 align=center><hr>
<tr><td width=20></td><td><font class=or1>&nbsp;&nbsp;Вы можете написать здесь любые замечания, предложения или неточности, замеченные в работе Системы или интерфейса</td><td width=150><li><a href='forum.php?x=add&user=".$_GET["user"]."'>Новая тема</a><li><a href='forum.php?show=all&user=";
print $_GET["user"]; print "'>Архив сообщений</a></td></tr></table><br>";
$x=$_GET["x"];
switch($x) :
default :
print "<table width=$width cellpadding=0 cellspacing=0 border=0 align=center>";
$data1 = file("forum.data");
$data1size = sizeof($data1);
$n = "$data1size";
$g = "0";
    do {
      $n2 = $n+1;

    $textdata = explode("|", $data1[$n]);
    $fiile = "forumfiles/$n2.txt";
      if (! is_file("$fiile")) { } else {
      $xx = "1";
      $data2 = file("$fiile");
      $data2size = sizeof($data2);
      if ($data2size < 2) { $tema = "tema0.gif"; } else { $tema = "tema.gif"; }
  $textdata[3] = substr($textdata[3],0,45);
  $textdata[1] = substr($textdata[1],0,10);
  print "  <tr><td bgcolor=$c01><img src=".$tema." width=20 height=20 align=left> <a href='forum.php?x=read&tema=".$n2."'>".$textdata[3]."</a></td> <td bgcolor=".$c01." width=150><b>"; if ($textdata[4] != "") { print "<a href='mailto:".$textdata[4]."'>"; } print "$textdata[1]</a></b></td> <td bgcolor=".$c01." width=110>".$textdata[2]."</td></tr><tr><td height=1 background=pset.gif colspan=3><img src=filesf/pset.gif width=1 height=1></td></tr>\r\n";     


      do {
      $textdata2 = explode("|", $data2[$xx]);
      if ($textdata2[1] != "") {
      if ($textdata2[0] > "4") { $textdata2[0] = "4"; }
       if ($data2size == "2" && $textdata2[0] == "1") { $textdata2[0] = "1e"; }
       if ($data2size == "3" && $textdata2[0] == "2") { $textdata2[0] = "2e"; }
       if ($data2size == "4" && $textdata2[0] == "3") { $textdata2[0] = "3e"; }
       if ($data2size == "5" && $textdata2[0] == "4") { $textdata2[0] = "4e"; }
       if ($data2size > "6" && $textdata2[0] > "5") { $textdata2[0] = "4e"; }
       $xx1 = $xx+1;
       if ($data2size == "$xx1" && $xx1 > "4") { $textdata2[0] = "4e"; }
  $textdata2[3] = substr($textdata2[3],0,45);
  $textdata2[1] = substr($textdata2[1],0,10);
      print "  <tr><td bgcolor=".$c02."><img src=filesf/_$textdata2[0].gif  height=20 align=left> <a href='forum.php?x=read&tema=".$n2."'>
      $textdata2[3]</a></td> <td bgcolor=".$c02."><b>".$textdata2[1]."</b></td> <td bgcolor=".$c02.">".$textdata2[2]."</td></tr><tr><td height=1 background=pset.gif colspan=3><img src=filesf/pset.gif width=1 height=1></td></tr>\r\n"; 
                               }
      $xx++; if ($xx > $limit && $show != "all") { $xx = "$data2size"; }
      } while($xx < $data2size);
      } 

    $n--;
    } while($n+1 > 0);
 
print "<tr><td bgcolor=".$c01.">&nbsp;<img src=filesf/new.png align=center>&nbsp;<b><a href='forum.php?x=add'>Новая тема</a></b></td>
           <td bgcolor=".$c01.">(Всего тем ".$data1size.")</td><td bgcolor=".$c01.">
<a href='forum.php?show=all'>Архив тем</a></td></tr></table>";

break;
case("read") :
if ($tema == "") { print "error"; exit; }
$ffile="forumfiles/".$tema.".txt";
$data1 = file($ffile);
$data1size = sizeof($data1);
$n = "0";
    do {
    $datatext = explode("|", $data1[$n]);
if ($n == "0") { $col = $c01; $subject = "$datatext[3]"; } else { $col = $c02; }
print "<table width=".$width." bgcolor=".$col." align=center><tr><td width=*>
<font size=3><b>".$datatext[3]."</font></b></td><td width=250 valign=top align=right>";  if ($datatext[5] != "") { print "<a href='mailto:".$datatext[5]."'>"; } print $datatext[1]."</a> (".$datatext[2].")</td></tr>
<tr><td colspan=2>".$datatext[4]."</td></tr></table><br><br>";
$n++; } while($n < $data1size);

print '<center><h2>Ответить:</h2></center>
<form action=forum.php?x=add2reply method=post>
<input type=hidden name=tema value='.$tema.'><table width=700 align=center border=0>
<tr><td colspan=2>Заголовок:&nbsp;<br><input type=text name=subject value="Re:'; print $subject; print '" style="width: 100%;"></td></tr>
<tr><td width=50%><input type=text name=name style="height:1;width:1;visibility:hidden" value="'.$PHP_AUTH_USER.'"></td>
<td width=50%><input type=text name=email style="height:1;width:1;visibility:hidden" value="'.$PHP_AUTH_USER.'@tpchel.ru"></td></tr>
<tr><td colspan=2>Текст ответа:&nbsp;<br><textarea rows=7 name=text style="width: 100%;" style=log></textarea></td></tr>
<tr><td colspan=2><input border=0 hspace=3 align=left src="files/forward.gif" type=image></td></tr>
</table>';

break;
case("add") :
print '<center><h2>Добавить тему</h2></center>
<form action=forum.php?x=add2tema method=post>
<table width=700 align=center>
<tr><td colspan=2 width=700>Заголовок:&nbsp;<br><input type=text name=subject value="" style="width: 100%;"></td></tr>
<tr><td width=50%><input type=text name=name style="height:1;width:1;visibility:hidden" value="'.$PHP_AUTH_USER.'">
</td><td width=50%><input type=text name=email style="height:1;width:1;visibility:hidden" value="'.$PHP_AUTH_USER.'@tpchel.ru"></td></tr>
<tr><td colspan=2>Текст:&nbsp;<br><textarea rows=7 name=text style="width: 100%;"></textarea></td></tr>
<tr><td colspan=2><input border=0 hspace=3 align=left src="files/forward.gif" type=image></td></tr>
</table>';
break;
case("add2tema"):
$ss = file("forum.data");
$s2size = sizeof($ss);
$s2size++;
$today = getdate();
if ($today[minutes]<10) $minutes='0'.$today[minutes]; else $minutes=$today[minutes];
$dat=$today[mday].".".$today[mon].".".$today[year]." ".$today[hours].":".$minutes;
$text1 = "$s2size|$name|$dat|$subject|$email|";
$text1 = stripslashes($text1);
$text1 = htmlspecialchars($text1);
$text1 = str_replace("\r\n", "<br>", $text1);

$fp=fopen("forum.data","a");
fputs($fp,"$text1\r\n");
fclose($fp);

$text2 = "main|$name|$dat|$subject|$text|$email|";
$text2 = stripslashes($text2);
$text2 = htmlspecialchars($text2);
$text2 = str_replace("\r\n", "<br>", $text2);
$fp=fopen("forumfiles/$s2size.txt","a+");
fputs($fp,"$text2\r\n");
fclose($fp);
print "
<script language=\"JavaScript\">
<!-- 
window.location.href = \"forum.php\"
// -->
</script>";

break;

case("add2reply"):
$ffile="forumfiles/".$tema.".txt";
$ss = file($ffile);
$s2size = sizeof($ss);
//$s2size++;
$today = getdate();
if ($today[minutes]<10) $minutes='0'.$today[minutes]; else $minutes=$today[minutes];
$dat=$today[mday].".".$today[mon].".".$today[year]." ".$today[hours].":".$minutes;
$text1 = "$s2size|$name|$dat|$subject|$text|$email|";
$text1 = stripslashes($text1);
$text1 = htmlspecialchars($text1);
$text1 = str_replace("\r\n", "<br>", $text1);
$ffile="forumfiles/".$tema.".txt";
$fp=fopen("$ffile","a");
fputs($fp,"$text1\r\n");
fclose($fp);
print "
<script language=\"JavaScript\">
<!-- 
window.location.href = \"forum.php?x=read&tema=".$tema."\"
// -->
</script>";
break;
endswitch;

if (! is_file("inc/down.inc")) { } else { include "inc/down.inc"; }
?>