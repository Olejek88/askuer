<tr><td><table align=center bgcolor=#eeeeee><tr>
<? if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_name]=='nvudodova') 
     { ?>    
      <td  align=center width=110><a href="88.php?menu=4"><font class="menu">�������������</td> 
<?   } ?>
<td  align=center width=120><a href="map.php"><font class="menu">�����</td>
<td  align=center width=120><a href="map2.php"><font class="menu">����� ������</td>
<? if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) 
     { ?>
      <td  align=center width=120><a href="88.php?menu=1"><font class="menu">����������</td>
<?   } ?>
<td  align=center width=120><a href="88.php?menu=2"><font class="menu">�������</td>
<td  align=center width=120><a href="88.php?menu=14"><font class="menu">�������</td>
<td  align=center width=120><a href="88.php?menu=9"><font class="menu">�������</td>
<td  align=center width=120><a href="analyse.php"><font class="menu">������</td>
<td  align=center width=120><a href="88.php?menu=13"><font class="menu">�����</td>
<td  align=center width=120><a href="trends.php"><font class="menu">������</td>
<td  align=center width=120><a href="unastr.php"><font class="menu">���� ��������</td>
</tr><tr>
<? if ($HTTP_COOKIE_VARS[user_priv]==3) 
     {?>
      <td  align=center width=110><a href="88.php?menu=10"><font class="menu">��������</td> 
<?   } ?>
<td  align=center width=120><a href="88.php?menu=6&sort=4&sour="><font class="menu">���� �����</td>
<td  align=center width=120><a href="88.php?menu=12"><font class="menu">������</td>
<td  align=center width=120><a href="forum.php"><font class="menu">�������� �����</td>
<td  align=center width=120><a href="88.php?menu=19&diag=1"><font class="menu">�����������</td>
<td  align=center width=120><a href="viewxml.htm"><font class="menu">������� ���������</td>
<td  align=center width=120><a href="88.php?menu=18"><font class="menu">�������</td>
<td  align=center width=120><a href="lmon.php"><font class="menu">��������� ������</td>
<?  if ($HTTP_COOKIE_VARS[user_priv]==3 || $HTTP_COOKIE_VARS[user_priv]==2) 
     {
?>    <td  align=center width=120><a href="88.php?menu=15"><font class="menu">������</td><?
     }
?>
<td  align=center width=120><a href="balans.php"><font class="menu">����� ��������</td>
<td  align=center width=120><a href="88.php?menu=21"><font class="menu">�������������</td>
</table></tr></td></tr>