<?php
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'; if ($z>9) print $z; else print '0'.$z; print '" ';
    if ($z==$today[mon]) print 'selected '; print '>'; 
    if ($z==1) print '������'; if ($z==2) print '�������';
    if ($z==3) print '�����';  if ($z==4) print '������';
    if ($z==5) print '���';    if ($z==6) print '����';
    if ($z==7) print '����';   if ($z==8) print '�������';
    if ($z==9) print '��������';   if ($z==10) print '�������';
    if ($z==11) print '������';    if ($z==12) print '�������';
   }
?>