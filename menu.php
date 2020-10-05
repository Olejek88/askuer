<?
   echo "<b>".$priveleges[$HTTP_COOKIE_VARS["user_priv"]]."</b><br>";
   switch($HTTP_COOKIE_VARS["user_priv"])
   {
      case 1:
      break;

      case 2:
       echo '<a href="./energy_supply.php">Энергоресурсы</a>&nbsp';
       echo '<a href="./buyers.php">Потребители</a>&nbsp';
       echo '<a href="./territory.php">Территория</a>&nbsp';
       echo '<a href="./uzli.php">Узлы учета</a>&nbsp';
      break;

      case 3:
       echo '<a href="./user.php">Пользователи системы</a>&nbsp';
       echo '<a href="./energy_supply.php">Энергоресурсы</a>&nbsp';
       echo '<a href="./buyers.php">Потребители</a>&nbsp';
       echo '<a href="./territory.php">Территория</a>&nbsp';
       echo '<a href="./uzli.php">Узлы учета</a>&nbsp';
      break;
   }
      echo '<a href="./exit.php">Выход</a><br>'; 
?>