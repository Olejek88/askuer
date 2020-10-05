<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
</head>
<font style="color: black; font-family: Arial,sans-serif; font-size: 10px;">
<?php
$ffile='tmp/'.$_GET["date"];
$fp=fopen($ffile,"r");
$contents = fread ($fp, filesize ($ffile));
fclose($fp);
echo $contents;
?>
</font>
</body>
</html>