<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="shablon.css" type="text/css">
<title>detail</title></head>
<body align=left bgcolor=black leftmargin=0 topmargin=5 rightmargin=0 bottommargin=0 marginwidth=0 marginheight=0>
<table align=left border=0 cellspacing=0 cellpadding=0 width=100% bgcolor=#000000>
<tr><td align=center>
<?php
$arr = get_defined_vars();
print '<img border=0 src="charts/pie.php?source='.$arr["source"].'&idkor='.$arr["idkor"].'&idbuy='.$arr["idbuy"].'&otch='.$arr["otch"].'&date='.$arr["date"].'&type='.$arr["type"].'&year='.$arr["year"].'&month='.$arr["month"].'&day='.$arr["day"].'">';
?>
</td><tr>
</table>
</body>
</html>