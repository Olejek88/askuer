<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_line.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];

$source=1+$arr["source"];
$sour=$arr["source"];
$kor=0; $max=0;
if ($arr["source"]<99)
    {  
     if ($arr["idkor"]=='') $query = 'SELECT * FROM korp WHERE korp_id<100';
     else $query = 'SELECT * FROM korp WHERE korp_id='.$arr["idkor"];
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)
         {
          $uu = mysql_fetch_row ($t);
          if ($uu == true)
              {
	       $K=0;
               $query = 'SELECT SUM(K'.$source.') FROM obj WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1];
               $a = mysql_query ($query,$i);
               $uy = mysql_fetch_row ($a);
               if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
	       $voda=0;
	       if ($source==3) 
			{
			 $query = 'SELECT caption FROM buyers WHERE idx='.$arr["idbuy"];
		         $a = mysql_query ($query,$i);
		         $uy = mysql_fetch_row ($a);			 
		         $query = 'SELECT id'.$uu[1].' FROM people WHERE name=\''.$uy[0].'\'';
	                 $a = mysql_query ($query,$i);
                         $uy = mysql_fetch_row ($a);
		         if ($uy == true)  $voda=$uy[0] * 0.012;
			 if ($arr["otch"]==1) $voda=$voda/24;
			 if ($arr["otch"]==4) $voda=$voda*30;
			}
	       if ($K>0 || $source==8) {
               $x=1;
               //$data0[0]=$data1[0]=$data2[0]=$data3[0]=0;
	       $beghour=0; $endhour=$hour=23;
  	       $begday=$arr["day"];  $endday=$day=$arr["eday"];
	       $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
	       $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
	       $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
	       $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
	       $time=$etime;
               if ($arr["otch"]==1) { $mx=23; $mn=0; }
               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
               if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }
  	       for ($tm=$mx; $tm>=0; $tm--)
	           {			
		    if ($arr["otch"]==1)
  		    if ($tm<10)
	                {
	                 $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$year.$month.$day.'0'.$tm.'0000 AND korp='.$uu[1].' AND source='.$arr["source"];
	                 $dat[$x]=$day.' '.$tm.':00';
	                }
                    else
                        {
                         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$year.$month.$day.$tm.'0000 AND korp='.$uu[1].' AND source='.$arr["source"];
	                 $dat[$x]=$day.' '.$tm.':00';
		        }
		    if ($arr["otch"]==2)
  	  	        {
 	 	         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$year.$month.$day.'000000 OR date='.$year.$month.$day.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                         $dat[$x]=$day.'.'.$month;
                        }
                    if ($arr["otch"]==4)
		        {
		         $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$year.$month.'01000000 OR date='.$year.$month.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
    	    	         $dat[$x]=$month.'.'.$year;
		        }
		    include ("../inc/method_req3.inc");
		    include ("../inc/method_el3.inc");
                    $a = mysql_query ($query,$i); 
                    if ($a)
                    for ($l=1;$l<=200;$l++)
                        {
                         $uy = mysql_fetch_row ($a);
                         if ($uy == true)
                             {
		              if ($source==1)
                                  {
			           if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) { $data1[$x]=$data1[$x]+$uy[7]*$K; }
                                   if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data2[$x]=$data2[$x]+$uy[7]*$K; }
                                  }
			       if ($source==2) if (strstr ($uy[1],'тепловой энергии')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($source==3) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($source==4) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($source==5) if (strstr ($uy[1],'массы')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($source==6) if (strstr ($uy[1],'объема')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			       if ($source==7) if (strstr ($uy[1],'объема')) $data0[$x]=$data0[$x]+$uy[7]*$K;
 	 		       if ($source==8) $data0[$x]=$data0[$x]+$uy[7]*$K;
                             }                       
                        }
		    if ($data0[$x]==0) $data0[$x]=$voda;


	            if ($arr["otch"]==1)
			{
			 if ($hour) $hour--;
 			 if ($tm==0) 
			     { 
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
			     $day=31; $mx=32; $tm=32;
			     if ($month>1) { $month=$month-1; if ($month<10) $month='0'.$month; $day=31; $mx=31; }
				 else { $month=12; $day=31; $mx=31; $year--;}
			     if (!checkdate ($month,31,$year)) { $mx=31; $tm=$mx; $day=$mx; }
			     if (!checkdate ($month,30,$year)) { $mx=29; $tm=$mx; $day=$mx; }
			     if (!checkdate ($month,28,$year)) { $mx=28; $tm=$mx; $day=$mx; }
			    }
			 if ($day<10) $day='0'.$day;
			}
                    if ($arr["otch"]==4) 
			{ 
			 if ($month>1) $month--;
			 else { $year--; $mx=$month=12; $tm=13; }
			 if ($month<10) $month='0'.$month;
			}
		    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
		    if ($time<=$btime) break;                       
		    $x++;
                   }
		}
  	      }
         }
for ($i=0; $i<$x; $i++) 
	{ 
	 $data[$i]=$data0[$x-$i]-$data00[$x-$i]; 
	 if ($source==1) $data[$i]=($data1[$x-$i]-$data01[$x-$i])-($data2[$x-$i]-$data02[$x-$i]);
	 $tim[$i]=$dat[$x-$i];
	}
// Create the graph. These two calls are always required
$graph = new Graph(1000,400,"auto");	
$graph->SetScale("textlin");
$graph->SetShadow();
$graph->yaxis->HideZeroLabel();
$graph->xaxis->SetLabelAngle(45);
$graph->SetMarginColor('lavender');
// Create the linear plot
$lineplot=new LinePlot($data);
// Add the plot to the graph
$graph->img->SetMargin(50,50,20,40);
//----------- title --------------------
if ($arr["source"]==0)
	{
	 $graph->title->Set("Теплофикационная вода");
         $graph->yaxis->title->Set("M,kg");
	}
if ($arr["source"]==1)
	{
	 $graph->title->Set("Тепловая энергия");
         $graph->yaxis->title->Set("W,кДж");
        }
if ($arr["source"]==2)
	{
	 $graph->title->Set("Пожарно-питьевая вода");
         $graph->yaxis->title->Set("V,m3");
        }
if ($arr["source"]==3)
	{
	 $graph->title->Set("Водяной пар");
         $graph->yaxis->title->Set("V,m3");
        }
if ($arr["source"]==4)
	{
	 $graph->title->Set("Природный газ");
         $graph->yaxis->title->Set("M,kg");
        }
if ($arr["source"]==5)
	{
	 $graph->title->Set("Сжатый воздух");
         $graph->yaxis->title->Set("V,м3");
        }
if ($arr["source"]==6)
	{
	 $graph->title->Set("Кислород");
         $graph->yaxis->title->Set("V,м3");
        }
if ($arr["source"]==7)
	{
	 $graph->title->Set("Электрическая энергия");
         $graph->yaxis->title->Set("W,кВт");
        }
$graph->Add($lineplot);
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
$lineplot->SetColor("black");
$lineplot->SetWeight(1);
$lineplot->SetFillColor("blue");

$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($tim);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
if ($arr["source"]==0) $lineplot->SetLegend("Расход (M,кг)");
if ($arr["source"]==1) $lineplot->SetLegend("Тепловая энергия (W,кДж)");
if ($arr["source"]==2) $lineplot->SetLegend("Расход воды (V,м3)");
if ($arr["source"]==3) $lineplot->SetLegend("Расход пара (V,м3)");
if ($arr["source"]==4) $lineplot->SetLegend("Расход (M,кг)");
if ($arr["source"]==5 || $arr["source"]==6) $lineplot->SetLegend("Расход (V,м3)");
if ($arr["source"]==7) $lineplot->SetLegend("Мощность (W,кВт)");
//--------------------------------------
// Display the graph
$graph->Stroke();
    }
?>