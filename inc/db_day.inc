<?php
for ($z=1;$z<=31;$z++)
   {
    if ($date_buy_day==$z) 
	{ print '<option selected value="'; if ($z>9) print $z; else print '0'.$z; print '">'; print $z; }
    else { print '<option value="'; if ($z>9) print $z; else print '0'.$z; print '">'; print $z; }
   }
?>