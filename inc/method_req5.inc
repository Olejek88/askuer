<?php
 // тепло и теплофикационная вода
 if ($uy[6]==0)  {
 if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей'))
    {
     if ($uu[1]==3  && $uy[4]==35) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
     if ($uu[1]==13 && $uy[4]==22) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
     if ($uu[1]==14 && $uy[4]==41) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
     if ($uu[1]==40 && ($uy[4]==8 || $uy[4]==39 || $uy[4]==34)) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
     if ($uu[1]==38 && $uy[4]==30) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
    }
 if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной'))
    {
     if ($uu[1]==3  && $uy[4]==35) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data01[$o][$uy[6]]=$uy[7];
     if ($uu[1]==13 && $uy[4]==22) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data01[$o][$uy[6]]=$uy[7];
     if ($uu[1]==14 && $uy[4]==41) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data01[$o][$uy[6]]=$uy[7];
     if ($uu[1]==40 && ($uy[4]==8 || $uy[4]==39 || $uy[4]==34)) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data01[$o][$uy[6]]=$data01[$o][$uy[6]]+$uy[7];
     if ($uu[1]==38 && $uy[4]==30) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data01[$o][$uy[6]]=$uy[7];
    }}
 if ($uy[6]==1)
 if (strstr ($uy[1],'тепловой энергии'))
    {
     if ($uu[1]==3  && $uy[4]==35) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
     if ($uu[1]==13 && $uy[4]==22) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
     if ($uu[1]==14 && $uy[4]==41) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
     if ($uu[1]==40 && ($uy[4]==8 || $uy[4]==39 || $uy[4]==34)) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
     if ($uu[1]==38 && $uy[4]==30) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$uy[7];
    }
 // пожарно-питьевая вода
 if ($uy[6]==2 && $uu[1]==1 &&  ($uy[4]==38 || $uy[4]==39 || $uy[4]==2))  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==2 && $uu[1]==12 && ($uy[4]==61 || $uy[4]==6)) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==2 && $uu[1]==3 &&  ($uy[4]==31 || $uy[4]==35))  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==2 && $uu[1]==13 && $uy[4]==22) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==2 && $uu[1]==61 && $uy[4]==6) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];

 // воздух
 if ($uy[6]==5 && strstr ($uy[1],'объема') && $uu[1]==1 &&  $uy[4]==39)  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==5 && strstr ($uy[1],'объема') && $uu[1]==12 && $uy[4]==61)  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==5 && strstr ($uy[1],'объема') && $uu[1]==3 &&  $uy[4]==31)  for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];
 if ($uy[6]==5 && strstr ($uy[1],'объема') && $uu[1]==5 && ($uy[4]==6 || $uy[4]==61 || $uy[4]==39)) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data00[$o][$uy[6]]=$data00[$o][$uy[6]]+$uy[7];

// if ($korps!='') fwrite ($fp,'Потребление по корпусам '.$korps.' = '.$data00[$x][$source-1].'<br>');

?>