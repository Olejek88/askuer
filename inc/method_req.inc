<?php
if ($source<7)
   {
    $query2='';
    if ($arr["otch"]==1) $datts='date='.$year.$month.$day.'0'.$tm.'0000';
    if ($arr["otch"]==2) $datts='(date='.$year.$month.$day.'000000 OR date='.$year.$month.$day.'120000)';
    if ($arr["otch"]==4) $datts='(date='.$year.$month.'01000000 OR date='.$year.$month.'01120000)';
    // тепло и теплофикационная вода
    if ($source<3 && $uu[1]==3)    $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=35 AND source='.$sour;
    if ($source<3 && $uu[1]==13)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=22 AND source='.$sour;
    if ($source<3 && $uu[1]==14)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=41 AND source='.$sour;
    if ($source<3 && $uu[1]==40)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=8 OR korp=39 OR korp=34) AND source='.$sour;
    if ($source<3 && $uu[1]==38)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=30 AND source='.$sour;
    // пожарно-питьевая вода
    if ($source==3 && $uu[1]==13)  $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=22 AND source='.$sour;
    if ($source==3 && $uu[1]==35)  $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=35 AND source='.$sour;
    if ($source==3 && $uu[1]==1)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=38 OR korp=39 OR korp=2) AND source='.$sour;
    if ($source==3 && $uu[1]==61)  $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=6 AND source='.$sour;
    if ($source==3 && $uu[1]==12)  $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=61 OR korp=6) AND source='.$sour;
    if ($source==3 && $uu[1]==3)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=35 OR korp=31) AND source='.$sour;
    // воздух
    if ($source==6 && $uu[1]==12)  $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=61 AND source='.$sour;
    if ($source==6 && $uu[1]==5)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND (korp=6 OR korp=1 OR korp=39) AND source='.$sour;
    if ($source==6 && $uu[1]==1)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=39 AND source='.$sour;
    if ($source==6 && $uu[1]==3)   $query2='SELECT * FROM data WHERE type='.$arr["otch"].' AND '.$datts.' AND korp=31 AND source='.$sour;    
    $data07=$data00[$x];
    if ($query2!='')
	{
	 //echo $query2.'<br>';
	 $mt = mysql_query ($query2,$i); 
	 if ($mt)
	 for ($ml=1;$ml<=200;$ml++)
	     {
              $mu = mysql_fetch_row ($mt);
	      if ($mu == true)
	            {
		     if ($source==1)
                        {
			 if (strstr ($mu[1],'масс') && strstr ($mu[1],'подающей')) { $data01[$x]=$data01[$x]+$mu[7]*$K; }
                         if (strstr ($mu[1],'масс') && strstr ($mu[1],'обратной')) { $data02[$x]=$data02[$x]+$mu[7]*$K; }
                        }
		     if ($source==2) if (strstr ($mu[1],'тепловой энергии')) $data00[$x]=$data00[$x]+$mu[7]*$K;
		     if ($source==3) $data00[$x]=$data00[$x]+$mu[7]*$K;
		     if ($source==6) if (strstr ($uy[1],'объема')) $data00[$x]=$data00[$x]+$mu[7]*$K;
		     //echo 'sour='.$source.'| data='.$data00[$x].'<br>';
		    }
	      }
	}
//  echo 'K='.$K.',data='.$data00[$x].'<br>';
 }
?>