<?
   echo "<b>".$priveleges[$HTTP_COOKIE_VARS["user_priv"]]."</b><br>";
   switch($HTTP_COOKIE_VARS["user_priv"])
   {
      case 1:
      break;

      case 2:
       echo '<a href="./energy_supply.php">�������������</a>&nbsp';
       echo '<a href="./buyers.php">�����������</a>&nbsp';
       echo '<a href="./territory.php">����������</a>&nbsp';
       echo '<a href="./uzli.php">���� �����</a>&nbsp';
      break;

      case 3:
       echo '<a href="./user.php">������������ �������</a>&nbsp';
       echo '<a href="./energy_supply.php">�������������</a>&nbsp';
       echo '<a href="./buyers.php">�����������</a>&nbsp';
       echo '<a href="./territory.php">����������</a>&nbsp';
       echo '<a href="./uzli.php">���� �����</a>&nbsp';
      break;
   }
      echo '<a href="./exit.php">�����</a><br>'; 
?>