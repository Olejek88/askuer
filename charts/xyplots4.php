<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_line.php");
include("../config/local.php");
$arr = get_defined_vars();
$today=getdate ();
$bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
if ($today["hours"]<10) $today["hours"]='0'.$today["hours"];
if ($today["day"]==$arr["day"])
    $edate=$arr["eyear"].$arr["emonth"].$arr["eday"].$today["hours"].'0000';
else
    $edate=$arr["eyear"].$arr["emonth"].$arr["eday"].'230000';
if ($arr["otch"]==4) 
{
 if ($arr["month"]>1) $arr["month"]--;
 else { $arr["month"]=12; $arr["year"]--; }
}

$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
$sour=$arr["source"];
$kor=0; $max=0; $K=1;
if ($arr["source"]<99)
    {  
     if ($arr["idkor"]=='' || $arr["idkor"]=='99') $query = 'SELECT * FROM korp WHERE korp_id<100';
     else $query = 'SELECT * FROM korp WHERE korp_id='.$arr["idkor"];
     $t = mysql_query ($query,$i);
     for ($k=1;$k<=50;$k++)
         {
          $uu = mysql_fetch_row ($t);
          if ($uu == true)
              {
               $x=1;
	       $voda=0;
	       if ($source==3) 
		  {
	           $query = 'SELECT SUM(id'.$uu[1].') FROM people';
 	           $a = mysql_query ($query,$i);
                   $uy = mysql_fetch_row ($a);
	           if ($uy == true)  $voda=$uy[0] * 0.012;
		   if ($arr["otch"]==2) $voda=$voda/24;
		   if ($arr["otch"]==4) $voda=$voda*30;
		  }
               //$data0[0]=$data1[0]=$data2[0]=$data3[0]=0;
	       $beghour=0; $endhour=$hour=23;
  	       $begday=$arr["day"];  $endday=$day=$arr["eday"];
	       $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
	       $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
	       $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
	       $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
	       if ($arr["otch"]==1 && $etime-$btime>400) $btime=$etime;
	       if ($etime==$btime) 
		  {
	  	   //echo $btime.'='.$etime;
		   if ($arr["day"]>1) { $arr["day"]--; $begday--;}
				   else { $arr["day"]=30; $arr["month"]--; $begmonth--;}
		   $btime=$begyear*100*100*100+$arr["month"]*100*100+$arr["day"]*100+$beghour;
		   if ($arr["day"]<10) $arr["day"]='0'.$arr["day"];
		   if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		   $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
		  }	       
	       $time=$etime;
               if ($arr["otch"]==1) { $mx=23; $mn=0; $int=($etime-$btime)/300; }
               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; $int=($etime-$btime)/1000;}
               if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; $int=1;}
  	       for ($tm=$mx; $tm>=0; $tm--)
	           {
		    include ("../inc/method_req.inc");
                    include ("../inc/rep_sub.inc");
		    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
 	  	    //echo $time.'<br>';
		    if ($time<$btime) break;
		    $x++;
		   }
	       $max=$x;
	       if ($arr["source"]==2) for ($o=0;$o<=$x; $o++) $data0[$o]=0;
	       else for ($o=0;$o<=$x; $o++) $data0[$o]=$data0[$o]+$voda;
 	       $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uu[1].' AND source='.$arr["source"];
		if ($arr["source"]==7 && $arr["idkor"]==101)
		 {
		 $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkor"].' AND source='.$arr["source"].' AND name LIKE \'%акт%\' AND name LIKE \'%Ввод%\'';
		 //echo $query;
		 }

	//	echo $query.'<br>';
               $a = mysql_query ($query,$i); 
	       if ($a)
               for ($l=1;$l<=50000;$l++)
                   {
                    $uy = mysql_fetch_row ($a);
                    if ($uy == true)
	               {
 	                if ($source==1)
                           {			    
			    if (strstr ($uy[1],'асс') && strstr ($uy[1],'подающей')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data1[$o]=$data1[$o]+$uy[7];
                            if (strstr ($uy[1],'асс') && strstr ($uy[1],'обратной')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data2[$o]=$data2[$o]+$uy[7];
			   }
			 if ($source==2) if (strstr ($uy[1],'тепловой энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==3) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
			 if ($source==4) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==5) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
			 if ($source==6) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$max; $o++)  { if (strstr($date1[$o],$uy[3])) { $data0[$o]=$data0[$o]+$uy[7]; break; }}
			 if ($source==7) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
 	 		 if ($source==8) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
                        }
                   }
  	      }
         }
//echo $max;
for ($i=0; $i<$max; $i++) 
    { 
     //echo $data1[$x-$i].'    '.$data01[$x-$i].'    '.$data2[$x-$i].'    '.$data02[$x-$i].'<br>';
     if ($source==1)	{ $data[$i]=($data1[$x-$i]-$data01[$x-$i])-($data2[$x-$i]-$data02[$x-$i]); } 
     else $data[$i]=$data0[$x-$i]-$data00[$x-$i]; 
     //echo $x-$i.' '.$datt[$x-$i].' '.$data[$i].'<br>';
     $tim[$i]=$datt[$x-$i];
     //echo $i.' '.$data[$i].' '.$tim[$i].'<br>';
    }
// Create the graph. These two calls are always required
$graph = new Graph(1000,400,"auto");	
$graph->SetMarginColor('white');
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new LinePlot($data);
// Add the plot to the graph
$graph->img->SetMargin(50,30,20,50);
//----------- title --------------------
if ($arr["source"]==0)
	{
	 $graph->title->Set("Теплофикационная вода");
         $graph->yaxis->title->Set("M,т.");
	}
if ($arr["source"]==1)
	{
	 $graph->title->Set("Тепловая энергия");
         $graph->yaxis->title->Set("W,ГКал");
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
$lineplot->SetWeight(2);
$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($tim);
if ($max>7) $graph->xaxis->SetTextTickInterval(round($int),0);
$graph->xaxis->SetLabelAngle(45);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
if ($arr["source"]==0) $lineplot->SetLegend("Масса утечек (M,т.)");
if ($arr["source"]==1) $lineplot->SetLegend("Тепловая энергия (W,ГКал)");
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