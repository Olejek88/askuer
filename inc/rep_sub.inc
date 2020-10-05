<?php
		    	    if ($tm<10) $tm='0'.$tm;
		    	    if ($arr["otch"]==1)
	                        {
				 $date1[$x]=$year.'-'.$month.'-'.$day.' '.$tm.':00:00';
        		         $dat[$x]=$day.'-'.$month.'-'.$year.' '.$tm.'.00';
        		         $datt[$x]=$day.' '.$tm.'.00';
			        }
			    if ($arr["otch"]==2)
  			        {
				 $date1[$x]=$year.'-'.$month.'-'.$day.' 00:00:00';
	                         $dat[$x]=$day.'-'.$month.'-'.$year.' 00.00';
	                         $datt[$x]=$day.'-'.$month.'-'.$year;
       		                }
               		    if ($arr["otch"]==4)
			        {
				 $date1[$x]=$year.'-'.$month.'-01 00:00:00';
    			         $dat[$x]='01-'.$month.'-'.$year.' 00.00';
				 $datt[$x]=$month.'-'.$year;
	        		}		    
		            if ($arr["otch"]==1)
				{
				 if ($hour) { $hour--; if ($hour<10) $hour='0'.$hour; }
 				 if ($tm==0) 
				     { 
				      for ($tm=$mx; $tm>=0; $tm--) $create[$tm]=0;
				      $mx=23; $tm=24; $mn=0; $hour=23;
				      if ($day>1) { $day=$day-1; if ($day<10) $day='0'.$day; }
				      else if ($month>1) 
						{ 
						 $month=$month-1; if ($month<10) $month='0'.$month; 
						 $day=31; 
					         if (!checkdate ($month,31,$year)) { $day=31; }
				        	 if (!checkdate ($month,30,$year)) { $day=29; }
					         if (!checkdate ($month,28,$year)) { $day=28; }
						}
					   else { $month=12; $day=31; }
				     }
				}
	        	    if ($arr["otch"]==2) 
				{ 
				 if ($day>1) $day--;
				 else 
				    {
				     $mx=32;
				     for ($tm=$mx; $tm>=0; $tm--) $create[$tm]=0;
				     $day=31;  $tm=32;
				     if ($month>1) { $month=$month-1; if ($month<10) $month='0'.$month; $day=31; $mx=31; }
					 else { $month=12; $day=31; $mx=31; $year--;}
				     if (checkdate ($month,31,$year)) { $mx=31; $tm=$mx; $day=$mx; }
				     else if (checkdate ($month,30,$year)) { $mx=30; $tm=$mx; $day=$mx; }
				     else if (checkdate ($month,29,$year)) { $mx=29; $tm=$mx; $day=$mx; }
				     else { $mx=28; $tm=$mx; $day=$mx; }
				     //echo $mx;
				    }
				 if ($day<10) $day='0'.$day;
				}
	                    if ($arr["otch"]==4) 
				{ 
				 if ($month>1) $month--;
				 else { $year--; $mx=$month=12; $tm=13; }
				 if ($month<10) $month='0'.$month;
				}
?>