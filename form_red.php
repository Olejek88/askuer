<?php include("config/local.php"); ?> 
<?php
if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2)
{
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
//-------------------------------------------------------------------------
print '<html><head><meta http-equiv="content-type" content="text/html; charset=windows-1251">';
print '<link rel="stylesheet" href="shablon.css" type="text/css"><title>����� ���������.</title>';
print '</head>';
print '<body bgcolor=#ffffff><br><br><br><br><br><br><br><br><br><br><form name=form method=post action="upbd.php" enctype="multipart/form-data">';
//-------------------------------------------------------------------------
if ($_POST["frm"]=='1')
{
$query = 'SELECT caption,type FROM buyers WHERE idx=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$data = $ui[0];
$type = $ui[1];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� �����������</td></tr>
<tr><td><font class="dd"> �������� </td><td><input class=log name="nam" size=8 style="width: 170px; height:18px" value="';
print $data; print '"><br></td></tr>';
print '<tr><td><font class="down">��� ����������</font></td><td>
<select class=log id="type" name="type" style="height:18">
<option value="1">���������
<option value="2">����������</select></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="1">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='2')
{
$query = 'SELECT * FROM korp WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
$id = $ui[0]; $korp_id = $ui[1]; $name = $ui[2]; $descr = $ui[3]; $type = $ui[4];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ��������</td></tr>';
print '<tr><td><font class="down">������������� ������� </font></td><td><input name="korp_id" size=20 class=log style="height:18px" value="'; print $korp_id; print '"></td><td></td></tr>';
print '<tr><td><font class="down">��� ������� </font></td><td>
<select class=log id="type" name="type" style="height:18">
<option value="1">���������������� ������
<option value="1">���������������� ������
<option value="1">��������� ������
<option value="2">�������
<option value="5">���� �����������
<option value="6">����� �����������</select></td><td></td></tr>';
print '<tr><td><font class="down">�������� ������� </font></td><td><input name="name" size=20 class=log style="height:18px"  value="'; print $name; print '"></td><td></td></tr>';
print '<tr><td><font class="down">������� �������� </font></td><td><textarea name="descr" cols="50" rows="3" class=log>'; print $descr; print '</textarea></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="2">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='4')
{
$query = 'SELECT * FROM energy_supply WHERE idx=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$data = $ui[1]; $id = $ui[2];
$price= $ui[3];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ��������������</td></tr>
<tr><td><font class="dd"> �������� </font></td><td><input class=log name="nam" size=8 style="width: 170px; height:18px" value="';
print $data; print '"><br></td></tr>';
print '<tr><td><font class="dd"> ������������� </font></td><td><input class=log name="id" size=8 style="width: 170px; height:18px" value="';
print $id; print '"><br></td></tr>';
print '<tr><td><font class="dd"> ����� �� ������� </font></td><td><input class=log name="price" size=8 style="width: 170px; height:18px" value="';
print $price; print '"><br></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="4">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='5')
{
$query = 'SELECT * FROM users WHERE idx=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$user = $ui[1]; $passw = $ui[2]; $priv = $ui[3];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� �������������</td></tr>
<tr><td><font class="dd"> ������������ </font></td><td><input class=log name="user" size=8 style="width: 170px; height:18px" value="';
print $user; print '"><br></td></tr>';
print '<tr><td><font class="dd"> ������ </font></td><td><input class=log name="passwd" size=8 style="width: 170px; height:18px" value="';
print $passw; print '"><br></td></tr>';
print '<tr><td><font class="dd"> ��������� </font></td><td>';
print '<select class=log id="user_priveleges" name="user_priveleges" style="height:18">
<option value="3">�������������
<option value="2">��������
<option value="1">������������</select></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="5">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='6')
{
$query = 'SELECT * FROM uzel WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$name = $ui[1]; $idres=$ui[2]; $idkor = $ui[3];
$P6=$ui[15]; $P7=$ui[16]; $P8=$ui[17]; $P9=$ui[18]; 
$P10=$ui[19]; $P11=$ui[20]; $P12=$ui[21]; $P13=$ui[22]; 
$P14=$ui[23]; 
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ����� �����</td></tr>
<tr><td><font class="dd"> �������� ���� </font></td><td><input class=log name="name" size=8 style="width: 170px; height:18px" value="';
print $name; print '"><br></td></tr>';
print '<tr><td><font class="down">������</td><td><select class=log id="idkor" name="idkor" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT korp_id,name FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$ui[0].'" '; if ($idkor==$ui[0]) print 'selected'; print '>'; print $ui[1];
   }
}
print '</select></td></tr>';
if ($idres==0)
	{
	 print '<tr><td><font title="" class="dd">�������� ������ ���� �� �������� ����� (�3/�). ������� ������.</font></td><td>';
	 print '<input class=log name="P6" size=8 style="width: 70px; height:18px" value="'; print $P6; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� ������ ���� �� �������� ����� (�3/�). ������ ������.</font></td><td>';
	 print '<input class=log name="P7" size=8 style="width: 70px; height:18px" value="'; print $P7; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� ������ ���� �� �������� ����� (�3/�). ������� ������.</font></td><td>';
	 print '<input class=log name="P8" size=8 style="width: 70px; height:18px" value="'; print $P8; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� ������ ���� �� �������� ����� (�3/�). ������ ������.</font></td><td>';
	 print '<input class=log name="P9" size=8 style="width: 70px; height:18px" value="'; print $P9; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� ����������� ���� �� �������� ����� (�). ������� ������.</font></td><td>';
	 print '<input class=log name="P10" size=8 style="width: 70px; height:18px" value="'; print $P10; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� ����������� ���� �� �������� ����� (�). ������ ������.</font></td><td>';
	 print '<input class=log name="P11" size=8 style="width: 70px; height:18px" value="'; print $P11; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� ����������� ���� �� �������� ����� (�). ������� ������.</font></td><td>';
	 print '<input class=log name="P12" size=8 style="width: 70px; height:18px" value="'; print $P12; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� ����������� ���� �� �������� ����� (�). ������ ������.</font></td><td>';
	 print '<input class=log name="P13" size=8 style="width: 70px; height:18px" value="'; print $P13; print '"></td></tr>';
	}
if ($idres==1) 
	{
	 print '<tr><td><font title="" class="dd">�������� ���������� (�). ������� ������.</font></td><td>';
	 print '<input class=log name="P6" size=8 style="width: 70px; height:18px" value="'; print $P6; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� ���������� (�). ������ ������.</font></td><td>';
	 print '<input class=log name="P7" size=8 style="width: 70px; height:18px" value="'; print $P7; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� �������� �� ���������� (����/�). ������� ������.</font></td><td>';
	 print '<input class=log name="P8" size=8 style="width: 70px; height:18px" value="'; print $P8; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� �������� �� ���������� (����/�). ������ ������.</font></td><td>';
	 print '<input class=log name="P9" size=8 style="width: 70px; height:18px" value="'; print $P9; print '"></td></tr>';
	}
if ($idres==2)
	{
	 print '<tr><td><font title="" class="dd">�������� ������ ���� (�3/�). ������� ������.</font></td><td>';
	 print '<input class=log name="P6" size=8 style="width: 70px; height:18px" value="'; print $P6; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� ������ ���� (�3/�). ������ ������.</font></td><td>';
	 print '<input class=log name="P7" size=8 style="width: 70px; height:18px" value="'; print $P7; print '"></td></tr>';
	}
if ($idres==4 || $idres==5 || $idres==6) 
	{
	 print '<tr><td><font title="" class="dd">���������� �������� �������� (���). ������� ������.</font></td><td>';
	 print '<input class=log name="P6" size=8 style="width: 70px; height:18px" value="'; print $P6; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� �������� (���). ������ ������.</font></td><td>';
	 print '<input class=log name="P7" size=8 style="width: 70px; height:18px" value="'; print $P7; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� ����������� (�). ������� ������.</font></td><td>';
	 print '<input class=log name="P8" size=8 style="width: 70px; height:18px" value="'; print $P8; print '"></td></tr>';
	 print '<tr><td><font title="" class="dd">���������� �������� ����������� (�). ������ ������.</font></td><td>';
	 print '<input class=log name="P9" size=8 style="width: 70px; height:18px" value="'; print $P9; print '"></font></td></tr>';
	 print '<tr><td><font title="" class="dd">�������� ������ (�3/�). ������� ������.</font></td><td>';
	 print '<input class=log name="P10" size=8 style="width: 70px; height:18px" value="'; print $P10; print '"></td></tr>';
	 print '<tr><td><font class="dd">�������� ������ (�3/�). ������ ������.</font></td><td>';
	 print '<input class=log name="P11" size=8 style="width: 70px; height:18px" value="'; print $P11; print '"></td></tr>';
	}
print '<tr><td><font title="" class="dd">����������� ���������.</font>';	 
print '<font title="" class="dd"><b>'.$P14.'</b></font></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '"></td></tr>';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="6">';
print '</table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='7')
{
$query = 'SELECT * FROM territory WHERE idx=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ����������  </td></tr>';
print '<tr><td><font class="down">�������� </font></td><td><input name="caption" size=30 class=log style="height:18px" value="'; print $ui[1]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">�������� ������������� </font></td><td><input name="inc_energy" size=10 class=log style="height:18px" value="'; print $ui[2]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">��������� ������������� </font></td><td><input name="out_energy" size=10 class=log style="height:18px" value="'; print $ui[3]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">������ </font></td><td><input name="latitude" size=10 class=log style="height:18px" value="'; print $ui[4]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">������� </font></td><td><input name="longtitude" size=10 class=log style="height:18px" value="'; print $ui[5]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">������ </font></td><td><input name="height" size=10 class=log style="height:18px" value="'; print $ui[6]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">������� </font></td><td><input name="square" size=10 class=log style="height:18px" value="'; print $ui[7]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">�������� ������ </font></td><td><input name="cold_period" size=10 class=log style="height:18px" value="'; print $ui[8]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">����������� </font></td><td><input name="temperature" size=10 class=log style="height:18px" value="'; print $ui[9]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">�������� </font></td><td><input name="atm_pressure" size=10 class=log style="height:18px" value="'; print $ui[10]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">��������� </font></td><td><input name="humidity" size=10 class=log style="height:18px" value="'; print $ui[11]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">��������� ���� </font></td><td><input name="sunny_days" size=10 class=log style="height:18px" value="'; print $ui[12]; print '"></td><td></td></tr>';
print '<tr><td><font class="down">��������� ����������� ��� ��������� ������� ���� </font></td><td><input name="rs_temp" size=10 class=log style="height:18px" value="'; print $ui[13]; print '"></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="7">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='8')
{
$query = 'SELECT * FROM methods WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$idn = $ui[1]; $name = $ui[2];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ������� �������</td></tr>
<tr><td><font class="dd"> ������������� �������� </font></td><td><input class=log name="idx" size=8 style="width: 170px; height:18px" value="';
print $idn; print '"><br></td></tr>';
print '<tr><td><font class="dd"> �������� �������� </font></td><td><input class=log name="name" size=8 style="width: 170px; height:18px" value="';
print $name; print '"><br></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="8">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='11')
{
$query = 'SELECT * FROM production WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$name = $ui[1]; $idkor = $ui[2]; $udpr = $ui[3]; $quant = $ui[4]; $idbuy = $ui[5];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ���������</td></tr>';
print '<tr><td><font class="main">��������</td><td><input name="name" size=30 class=log style="height:18px" value="'; print $name; print '"></td><td></td></tr>';
print '<tr><td><font class="main">���������</td><td><select class=log id="idbuy" name="idbuy" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">������</td><td><select class=log id="idkor" name="idkor" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT name,korp_id FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $ui[1]; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">�������� ����������� ���� �� ������� </td><td><input name="udpr" size=10 class=log style="height:18px" value="'; print $udpr; print '"></td><td></td></tr>';
print '<tr><td><font class="main">���������� ��������� � �����</td><td><input name="quant" size=10 class=log style="height:18px" value="'; print $quant; print '"></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="11">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='10')
{
$query = 'SELECT * FROM people WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ���������: ��������� '; print $ui[1]; print '</td></tr>';
$query = 'SELECT name FROM korp ORDER BY id';
$p = mysql_query ($query,$i);
for ($z=2;$z<=50;$z++)
        {
         $uo = mysql_fetch_row ($p);    
         if ($uo == true)
           {
            print '<tr><td><font class="main">'; print $uo[0]; print '</td><td><input name="quant'; print $z; print '" size=10 class=log style="height:18px" value="'; print $ui[$z]; print '"></td><td></td></tr>';
           }
        }
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="10">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='13')
{
$query = 'SELECT * FROM shelf WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
$name=$ui[1]; $descr=$ui[2]; $idkor=$ui[3];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ������</td></tr>';
print '<tr><td><font class="down">�������� �����</font></td><td><input name="name" size=30 class=log style="height:18px" value="'.$name.'"></td><td></td></tr>';
print '<tr><td><font class="down">��������</font></td><td><textarea name="descr" cols="50" rows="3" class=log>'.$descr.'</textarea></td><td></td></tr>';
print '<tr><td><font class="down">������</td><td><select class=log id="idkor" name="idkor" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT korp_id,name FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$ui[0].'" '; if ($idkor==$ui[0]) print 'selected'; print '>'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td><font class="down">������������� �� ����</font></td><td><input name="otv" size=30 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="down">���������� ��������������</font></td><td><textarea name="koor" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td><font class="down">��������� ���������</font></td><td><textarea name="rash" cols="50" rows="3" class=log></textarea></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="13">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='14')
{
$query = 'SELECT * FROM equipment WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e);
$name=$ui[1]; $date_buy=$ui[2]; $date_mon_1=$ui[3]; $date_vvod=$ui[4]; 
$date_prov_p=$ui[5]; $date_prov_s=$ui[6]; $period_p=$ui[7]; 
$type=$ui[8]; $serial=$ui[9]; $uzel=$ui[10]; $shelf=$ui[11]; 
$date_dem_p=$ui[12]; $prichina_dem=$ui[13]; $date_mon_p=$ui[14]; $prichina_mon=$ui[15]; 
$history=$ui[16]; $Du=$ui[17]; $s_type=$ui[18]; $Pmin=$ui[19]; $Pmax=$ui[20]; $d=$ui[21]; 
$source = $ui[22];  $d_type = $ui[23]; 
$today = getdate ();
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ������������</td></tr>';
print '<tr><td><font class="down">�������� </font></td><td><input name="name" size=40 class=log style="height:18px" value="'.$name.'"></td><td></td></tr>';
print '<tr><td><font class="down">���� ������� </font></td>';
//$today[mday]=$date_buy_day;  $today[mon]=$date_buy_month;  $today[year]=$date_buy_year; 
print '<td><table><tr><td><select class=log id="date_buy_day" name="date_buy_day" style="height:18">'; 
$date_buy_day=$date_buy[8].$date_buy[9].'';
include ("inc/db_day.inc");
print '</select></td>';
print '<td><select class=log id="date_buy_month" name="date_buy_month" style="height:18">'; 
$date_buy_day=$date_buy[5].$date_buy[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc");
print '</select></td>';
print '<td><select class=log id="date_buy_year" name="date_buy_year" style="height:18">'; 
$date_buy_day=$date_buy[0].$date_buy[1].$date_buy[2].$date_buy[3].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_year.inc");
print '</select></td>';
print '<td><font class="dd">'.$date_buy.'</font></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">���� ���������� ������� </font></td>'; 
print '<td><table><tr><td><select class=log id="date_mon_1_day" name="date_mon_1_day" style="height:18">'; 
$date_buy_day=$date_mon_1[8].$date_mon_1[9].'';
include ("inc/db_day.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_1_month" name="date_mon_1_month" style="height:18">'; 
$date_buy_day=$date_mon_1[5].$date_mon_1[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc");
print '</select></td>';
print '<td><select class=log id="date_mon_1_year" name="date_mon_1_year" style="height:18">'; 
$date_buy_day=$date_mon_1[0].$date_mon_1[1].$date_mon_1[2].$date_mon_1[3].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_year.inc"); print '</select></td>';
print '<td><font class="dd">'.$date_mon_1.'</font></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">���� ����� � ������������ </font></td>'; 
print '<td><table><tr><td><select class=log id="date_vvod_day" name="date_vvod_day" style="height:18">'; 
$date_buy_day=$date_vvod[8].$date_vvod[9].'';
include ("inc/db_day.inc"); print '</select></td>';
print '<td><select class=log id="date_vvod_month" name="date_vvod_month" style="height:18">'; 
$date_buy_day=$date_vvod[5].$date_vvod[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_vvod_year" name="date_vvod_year" style="height:18">'; 
$date_buy_day=$date_vvod[0].$date_buy[1].$date_vvod[2].$date_vvod[3].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">���� ��������� ������� </font></td>'; 
print '<td><table><tr><td><select class=log id="date_prov_p_day" name="date_prov_p_day" style="height:18">'; 
$date_buy_day=$date_prov_p[8].$date_prov_p[9].'';
include ("inc/db_day.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_p_month" name="date_prov_p_month" style="height:18">'; 
$date_buy_day=$date_prov_p[5].$date_prov_p[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_p_year" name="date_prov_p_year" style="height:18">'; 
$date_buy_day=$date_prov_p[0].$date_prov_p[1].$date_prov_p[2].$date_prov_p[3].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_year.inc");
print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">���� ��������� ������� </font></td>'; 
print '<td><table><tr><td><select class=log id="date_prov_s_day" name="date_prov_s_day" style="height:18">'; 
$date_buy_day=$date_prov_s[8].$date_prov_s[9].'';
include ("inc/db_day.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_s_month" name="date_prov_s_month" style="height:18">'; 
$date_buy_day=$date_prov_s[5].$date_prov_s[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_prov_s_year" name="date_prov_s_year" style="height:18">'; 
$date_buy_day=$date_prov_s[0].$date_prov_s[1].$date_prov_s[2].$date_prov_s[3].''; $date_buy_day=$date_buy_day+0;
for ($z=0;$z<=5;$z++)
   {    
    print '<option '; if ($date_buy_day==$today[year]+$z) print ' selected ';
    print 'value="'; print $today[year]+$z; print '">'; print $today[year]+$z;
   }
print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">������ ���������� ������� (������)</font></td><td><input name="period_p" size=10 class=log style="height:18px" value="'.$period_p.'"></td><td></td></tr>';
print '<tr><td><font class="down">�������� �����</font></td><td><input name="serial" size=20 class=log style="height:18px" value="'.$serial.'"></td><td></td></tr>';
print '<tr><td bgcolor=#ffffff width=120><font class="down">���� �����</font></td><td><select class=log id="uzel" name="uzel" style="height:18">';
$query = 'SELECT id,name FROM uzel';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$ui[0].'" '; if ($ui[0]==$uzel) print selected; print '>'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td bgcolor=#ffffff width=120><font class="down">����</font></td><td><select class=log id="shelf" name="shelf" style="height:18">';
$query = 'SELECT id,name FROM shelf';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$ui[0].'" '; if ($ui[0]==$shelf) print 'selected'; print '>'.$ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td bgcolor=#ffffff width=120><font class="down">������������</font></td><td><select class=log id="source" name="source" style="height:18">';
$query = 'SELECT id,caption FROM energy_supply';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$ui[0].'" '; 
    if ($ui[0]==$source) print 'selected'; 
    print '>'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td><font class="down">���� ���������� ��������� </font></td>'; 
print '<td><table><tr><td><select class=log id="date_dem_p_day" name="date_dem_p_day" style="height:18">'; 
$date_buy_day=$date_dem_p[8].$date_dem_p[9].'';
include ("inc/db_day.inc"); print '</select></td>';
print '<td><select class=log id="date_dem_p_month" name="date_dem_p_month" style="height:18">'; 
$date_buy_day=$date_dem_p[5].$date_dem_p[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_dem_p_year" name="date_dem_p_year" style="height:18">'; 
$date_buy_day=$date_dem_p[0].$date_dem_p[1].$date_dem_p[2].$date_dem_p[3].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_year.inc");
print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">������� ���������</font></td><td><input name="prichina_dem" size=50 class=log style="height:18px" value="'.$prichina_dem.'"></td><td></td></tr>';
print '<tr><td><font class="down">���� ���������� ������� </font></td>'; 
print '<td><table><tr><td><select class=log id="date_mon_p_day" name="date_mon_p_day" style="height:18">'; 
$date_buy_day=$date_mon_p[8].$date_mon_p[9].'';
include ("inc/db_day.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_p_month" name="date_mon_p_month" style="height:18">'; 
$date_buy_day=$date_mon_p[5].$date_mon_p[6].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_mon.inc"); print '</select></td>';
print '<td><select class=log id="date_mon_p_year" name="date_mon_p_year" style="height:18">'; 
$date_buy_day=$date_mon_p[0].$date_mon_p[1].$date_mon_p[2].$date_mon_p[3].''; $date_buy_day=$date_buy_day+0;
include ("inc/db_year.inc"); print '</select></td>';
print '</tr></table></td></tr>';
print '<tr><td><font class="down">������� �������</font></td><td><input name="prichina_mon" size=50 class=log style="height:18px" value="'.$prichina_mon.'"></td><td></td></tr>';
print '<tr><td><font class="down">������� ������� </font></td><td><textarea name="history" cols="100" rows="10" class=log>'.$history.'</textarea></td><td></td></tr>';
print '<tr><td><font class="down">�������</font></td><td><input name="Du" size=10 class=log style="height:18px" value="'.$Du.'"></td><td></td></tr>';
print '<tr><td bgcolor=#ffffff width=120><font class="down">��� �������</font></td><td><select class=log id="s_type" name="s_type" style="height:18">';
$query = 'SELECT id,name FROM sensors';
$e = mysql_query ($query,$i); 
for ($z=0;$z<=120;$z++)
{
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$ui[0].'" ';  if ($ui[0]==$type_s) print 'selected'; print '>'; print $ui[1];
   }
}
print '</select></td></tr>';
print '<tr><td><font class="down">������ (���)</font></td><td><input name="Pmin" size=10 class=log style="height:18px" value="'.$Pmin.'"></td><td></td></tr>';
print '<tr><td><font class="down">������ (����)</font></td><td><input name="Pmax" size=10 class=log style="height:18px" value="'.$Pmax.'"></td><td></td></tr>';
print '<tr><td><font class="down">��������� ������</font></td><td><input name="d_type" type=checkbox '; if ($d_type==1) print 'checked'; print '></td><td></td></tr>';
print '<tr><td><font class="down">�����������</font></td><td><input name="d" size=10 class=log style="height:18px" value="'.$d.'"></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="14">';
print '</td></tr></table><br></form></body></html>';
}
//-------------------------------------------------------------------------
if ($_POST["frm"]=='9')
{
$query = 'SELECT * FROM obj WHERE id=' . $_POST["idn"];
$e = mysql_query ($query,$i);
$ui = mysql_fetch_row ($e);
$name = $ui[1]; $idbuy = $ui[2]; $buy_q = $ui[3]; $idkorp = $ui[4]; $type = $ui[5];
$square = $ui[14]; $aren_square = $ui[15]; $BTI = $ui[16]; $K_agr = $ui[17]; $Q_agr = $ui[18];
$height = $ui[19]; $level = $ui[20]; $nPP = $ui[21]; $poll_square = $ui[22]; $volume = $ui[23];
$Qszh = $ui[24]; $Qkisl = $ui[25]; $Qgaza = $ui[26];
print '<table bgcolor=#ffffff border=0 align=center><tr><td width=500 colspan=2><font class="menu">�������������� ��������</td></tr>';
print '<tr><td><font class="main">��������</td><td><input name="name" size=30 class=log style="height:18px" value="'; print $name; print '"></td><td></td></tr>';
print '<tr><td><font class="main">����������</td><td><select class=log id="idbuy" name="idbuy" style="height:18">';
print '<option value="0">'; print '���';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option '; if ($idbuy==$z) print 'selected';
    print ' value="'.$z.'">'.$ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td><td><select class=log id="idbuy2" name="idbuy2" style="height:18">';
print '<option value="0">'; print '���';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td></td><td><select class=log id="idbuy3" name="idbuy3" style="height:18">';
print '<option value="0">'; print '���';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'.$z.'">'.$ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td></td><td><select class=log id="idbuy4" name="idbuy4" style="height:18">';
print '<option value="0">'; print '���';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td></td><td><select class=log id="idbuy5" name="idbuy5" style="height:18">';
print '<option value="0">'; print '���';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT caption FROM buyers WHERE idx='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option value="'; print $z; print '">'; print $ui[0];
   }
}
print '</select></td><td></td></tr>';
//print '<tr><td><font class="main">���������� �����������, ������������ ������</td><td><input name="buy_q" size=10 class=log style="height:18px"></td><td></td></tr>';
print '<tr><td><font class="main">������</td><td><select class=log id="idkorp" name="idkorp" style="height:18">';
for ($z=1;$z<=120;$z++)
{
 $query = 'SELECT korp_id,name FROM korp WHERE id='. $z;
 $e = mysql_query ($query,$i); 
 $ui = mysql_fetch_row ($e);
 if ($ui == true)
   {
    print '<option '; if ($idkorp==$ui[0]) print 'selected';
    print ' value="'; print $ui[0]; print '">'; print $ui[1];
   }
}
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">��� �������</td><td><select class=log id="type" name="type" style="height:18">';
print '<option value="1" '; if ($type==1) print 'selected'; print '>������'; 
print '<option value="2" '; if ($type==2) print 'selected'; print '>���������'; 
print '<option value="3" '; if ($type==3) print 'selected'; print '>�������'; 
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">��� ���������/�������</td><td><select class=log id="typeR" name="typeR" style="height:18">';
print '<option value="1" '; if ($typeR==1) print 'selected'; print '>���������������'; 
print '<option value="2" '; if ($typeR==2) print 'selected'; print '>����������������'; 
print '<option value="3" '; if ($typeR==3) print 'selected'; print '>���������'; 
print '<option value="4" '; if ($typeR==4) print 'selected'; print '>���������'; 
print '<option value="5" '; if ($typeR==5) print 'selected'; print '>����������������'; 
print '<option value="6" '; if ($typeR==6) print 'selected'; print '>���������-�������'; 
print '</select></td><td></td></tr>';
print '<tr><td><font class="main">������� �������</td><td><input name="square" size=10 class=log style="height:18px" value="'; print $square; print '"></td><td></td></tr>';
print '<tr><td><font class="main">���������� �������</td><td><input name="aren_square" size=10 class=log style="height:18px" value="'; print $aren_square; print '"></td><td></td></tr>';
print '<tr><td><font class="main">����� ��� / ����������� �����</td><td><input name="BTI" size=10 class=log style="height:18px" value="'; print $BTI; print '"></td><td></td></tr>';
print '<tr><td><font class="main">������ ���������</td><td><input name="height" size=10 class=log style="height:18px" value="'; print $height; print '"></td><td></td></tr>';
print '<tr><td><font class="main">����</td><td><input name="level" size=10 class=log style="height:18px" value="'; print $level; print '"></td><td></td></tr>';
print '<tr><td><font class="main">���������� ���</td><td><input name="nPP" size=10 class=log style="height:18px" value="'; print $nPP; print '"></td><td></td></tr>';
print '<tr><td><font class="main">�������� �������</td><td><input name="poll_square" size=10 class=log style="height:18px" value="'; print $poll_square; print '"></td><td></td></tr>';
print '<tr><td><font class="main">�������� �����</td><td><input name="volume" size=10 class=log style="height:18px" value="'; print $volume; print '"></td><td></td></tr>';
print '<tr><td><font class="main">�������� ����������� ������� �������</td><td><input name="Qszh" size=10 class=log style="height:18px" value="'; print $Qszh; print '"></td><td></td></tr>';
print '<tr><td><font class="main">�������� ����������� ���������</td><td><input name="Qkisl" size=10 class=log style="height:18px" value="'; print $Qkisl; print '"></td><td></td></tr>';
print '<tr><td><font class="main">�������� ����������� ����</td><td><input name="Qgaza" size=10 class=log style="height:18px" value="'; print $Qgaza; print '"></td><td></td></tr>';
print '<tr><td><font class="main">����������� �������������</td><td><input name="K_agr" size=10 class=log style="height:18px" value="'; print $K_agr; print '"></td><td></td></tr>';
print '<tr><td><font class="main">������������ ��������</td><td><input name="Q_agr" size=10 class=log style="height:18px" value="'; print $Q_agr; print '"></td><td></td></tr>';
print '<tr><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/forward.gif" type=image></td><td>';
print '<input name="idn" style="width:1; height:1; visibility:hidden" value="';
print $_POST["idn"]; print '">';
print '<input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="9">';
print '</td></tr></table><br></form></body></html>';
}
}