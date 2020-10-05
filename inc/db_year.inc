<?
for ($z=0;$z<=5;$z++)
   {    
    print '<option '; if ($date_buy_day==$today[year]-$z) print ' selected ';
    print 'value="'; print $today[year]-$z; print '">'; print $today[year]-$z;
   }
?>