<?php
if ($source<7)
   {
    $query2=''; $korps='';
    if ($arr["otch"]==1) $datts='date='.$year.$month.$day.'0'.$tm.'0000';
    if ($arr["otch"]==2) $datts='(date='.$year.$month.$day.'000000 OR date='.$year.$month.$day.'120000)';
    if ($arr["otch"]==4) $datts='(date='.$year.$month.'01000000 OR date='.$year.$month.'01120000)';
    // тепло и теплофикационная вода
    if ($source<3 && $uu[1]==3)    { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=35 AND source='.$sour; $korps='ИТМ ГО'; }
    if ($source<3 && $uu[1]==13)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=22 AND source='.$sour; $korps='Храм'; }
    if ($source<3 && $uu[1]==14)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=41 AND source='.$sour; $korps='Корпус №41'; }
    if ($source<3 && $uu[1]==40)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=8 OR korp=39 OR korp=34) AND source='.$sour; $korps='Мастерская, мойка'; }
    if ($source<3 && $uu[1]==38)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=30 AND source='.$sour; $korps=''; }
    // пожарно-питьевая вода
    if ($source==3 && $uu[1]==13)  { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=22 AND source='.$sour; $korps='Храм'; }
    if ($source==3 && $uu[1]==35)  { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=35 AND source='.$sour; $korps='ИТМ ГО'; }
    if ($source==3 && $uu[1]==1)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=38 OR korp=39 OR korp=2) AND source='.$sour; $korps='Проходная, Мастерская'; }
    if ($source==3 && $uu[1]==61)  { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=6 AND source='.$sour; $korps='Корпус №6'; }
    if ($source==3 && $uu[1]==12)  { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=61 OR korp=6) AND source='.$sour; $korps='Корпус №61, Корпус №6'; }
    if ($source==3 && $uu[1]==3)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=35 OR korp=31) AND source='.$sour; $korps='ИТМ ГО, ЧТКЗ'; }
    // воздух
    if ($source==6 && $uu[1]==12)  { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=61 AND source='.$sour; $korps='Корпус №61'; }
    if ($source==6 && $uu[1]==5)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=6 OR korp=1 OR korp=39) AND source='.$sour; $korps='Корпус №6, Корпус №61, Мастерская'; }
    if ($source==6 && $uu[1]==1)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=39 AND source='.$sour; $korps='Мастерская'; }
    if ($source==6 && $uu[1]==3)   { $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=31 AND source='.$sour; $korps='ЧТКЗ'; }

    //echo $query2;
    if ($query2!='')
	{
	 $mt = mysql_query ($query2,$i); 
	 if ($mt)
	 for ($ml=1;$ml<=200;$ml++)
	     {
              $mu = mysql_fetch_row ($mt);
	      if ($mu == true)
	            {
	             if ($mu[6]==0)
	                {
		         if (strstr ($mu[1],'масс') && strstr ($mu[1],'подающей')) $data00[$x][0]=$data00[$x][0]+$mu[7]*$K;
        	         if (strstr ($mu[1],'масс') && strstr ($mu[1],'обратной')) $data01[$x][0]=$data01[$x][0]+$mu[7]*$K;
	                }
		     if ($mu[6]==1) if (strstr ($uy[1],'тепловой энергии')) $data00[$x][1]=$data00[$x][1]+$mu[7]*$K;
		     if ($mu[6]==2) $data00[$x][2]=$data00[$x][2]+$mu[7]*$K;
		     if ($mu[6]==3) $data00[$x][3]=$data00[$x][3]+$mu[7]*$K;
		     if ($mu[6]==4) if (strstr ($uy[1],'массы')) $data00[$x][4]=$data00[$x][4]+$mu[7]*$K;
		     if ($mu[6]==5) if (strstr ($uy[1],'объема')) $data00[$x][5]=$data00[$x][5]+$mu[7]*$K;
		     if ($mu[6]==6) if (strstr ($uy[1],'объема')) $data00[$x][6]=$data00[$x][6]+$mu[7]*$K;
	 	     if ($mu[6]==7) $data00[$x][7]=$data00[$x][7]+$mu[7]*$K;
		    }
	      }
	}
 }
?>