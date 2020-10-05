<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_line.php");
//include ("../../../jpgraph/jpgraph_plotband.php.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today=getdate();
$ye=$today["year"];
$mm=$today["mon"];
$source=$arr["source"];
$idbuy=$arr["idbuy"];

if ($arr["year"]!='') $today["year"]=$arr["year"];
if ($arr["month"]!='') 
   if ($arr["month"]<10) 
	$today["mon"]='0'.$arr["month"];
   else $today["mon"]=$arr["month"];
if ($arr["year"]!='' && $arr["month"]!='') 
   {
    if (checkdate  ($arr["month"],31,$arr["year"])) $today["mday"]=31;
    if (!checkdate ($arr["month"],31,$arr["year"])) $today["mday"]=30;
    if (!checkdate ($arr["month"],30,$arr["year"])) $today["mday"]=29;
    if (!checkdate ($arr["month"],29,$arr["year"])) $today["mday"]=28;
   }
if ($today["mon"]<10) $today["mon"]='0'.$today["mon"];
if ($today["mday"]<10) $edate=$today["year"].$today["mon"].'0'.$today["mday"].'000000';
else $edate=$today["year"].$today["mon"].$today["mday"].'000000';

if ($today["mon"]>1) $mm=$today["mon"]-1;
else { $mm=12; $ye=$ye-1;}

if (checkdate ($mm,31,$ye)) { $x=$today["mday"]+31; }
else if (checkdate ($mm,30,$ye)) { $x=$today["mday"]+30; }
else if (checkdate ($mm,28,$ye)) { $x=$today["mday"]+28; }
if ($mm>1) $mm--;
	else { $mm=12; $ye=$ye-1; }
if (checkdate ($mm,31,$ye)) { $x=$x+31; }
else if (checkdate ($mm,30,$ye)) { $x=$x+30; }
else if (checkdate ($mm,28,$ye)) { $x=$x+28; }

$mx=$today["mday"]; $mn=1; $nx=3; $nn=1;

if ($today["mday"]>1) 
   $day=$today["mday"]-1;
else 
   { 
    $day=30;  $mx=$day; 
    if ($today["mon"]>1) $today["mon"]=$today["mon"]-1;
   }
if ($mm<10) $mm='0'.$mm;
$bdate=$ye.$mm.'01000000';
//$x--;
$max=$x;

for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     if ($tm<10) 
	{
	 $date1[$x]=$today["year"].'-'.$today["mon"].'-'.'0'.$tm.' 00:00:00';
	 $dat[$x]='0'.$tm.'-'.$today["mon"];
	}
     else
	{
	 $date1[$x]=$today["year"].'-'.$today["mon"].'-'.$tm.' 00:00:00';
	 $dat[$x]=$tm.'-'.$today["mon"];
	}
     if ($arr["source"]==7)
	{
	 $year=$today["year"];
         $month=$today["mon"];
	 $day=$tm;
	 $arr["otch"]=2; $sour=7;
	 $ffile="../tmp/arends".$idbuy.$day.$month.".htm";
	 $fp=fopen($ffile,"w");
	 $source++;
	 include ("../inc/method_el1.inc");
	 $source--;
	 fclose($fp);
	 $data[$x]=$data0[$x];
	 //echo $date1.'===='.$data0[$x];
	}
     $x--;
     if ($tn<4 && $tm==1)
	{
	 $mx=31; 
	 if ($today["mon"]>1)
	    { 
	     $today["mon"]--;  
	     if ($today["mon"]<10) $today["mon"]='0'.$today["mon"]; else $today["mon"]=''.$today["mon"];
	     if (!checkdate ($today["mon"],31,$today["year"])) $mx=30;
	     if (!checkdate ($today["mon"],30,$today["year"])) $mx=28;
	     if (!checkdate ($today["mon"],28,$today["year"])) $mx=27;
	    }
	  else 
	    { 
	     $today["mon"]=12; $today["year"]--;
	    }
	 }
    }
$data0[$x]=0; $data1[$x]=0;
for ($o=0;$o<=$max; $o++) $data0[$o]=0;

if ($arr["source"]<7)
{
 $voda=0;
 if ($arr["source"]==2) 
    {
     $query = 'SELECT caption FROM buyers WHERE idx='.$idbuy;
     $a = mysql_query ($query,$i);
     $uy = mysql_fetch_row ($a);

     $query = 'SELECT * FROM people WHERE name=\''.$uy[0].'\'';
     $a = mysql_query ($query,$i);
     $uy = mysql_fetch_row ($a);
     $per=0;
     if ($uy == true) 
         for ($p=1;$p<=50;$p++) 
	     if ($uy[$p]>0) $per=$per+$uy[$p];
     if ($uy == true)  $voda=$per*0.012;
    }
$query = 'SELECT * FROM korp';
$b = mysql_query ($query,$i);
if ($b)
for ($t=1;$t<=50;$t++)
    {
     $uo = mysql_fetch_row ($b);
     if ($uo == true)
        {
	 $sour=$source+1;
         $query = 'SELECT SUM(K'.$sour.') FROM obj WHERE type!=1 AND idbuy='.$idbuy.' AND idkorp='.$uo[1];
	 //echo  $query.'<br>';
         $a = mysql_query ($query,$i); 
         $uy = mysql_fetch_row ($a); 
         if ($uy == true && $uy[0]>0) $K=$uy[0]; else $K=0;
         if ($K>0)
    	    {
  	     //if ($arr["source"]==0) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%масс%\' AND source='.$arr["source"];
	     if ($arr["source"]==1) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%энергии%\' AND source='.$arr["source"];
	     if ($arr["source"]==2) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==4) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==5) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==6) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==7) $query = 'SELECT * FROM data WHERE type=2 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND source='.$arr["source"];
	     //echo '['.$K.'] '.$query.'<br>';
	     $a = mysql_query ($query,$i);
	     if ($a)
	     for ($l=1;$l<=100;$l++)
	         {
                  $uy = mysql_fetch_row ($a);
		  //echo $uy[3].'>'.$uy[7].'<br>';
                  if ($uy == true)
      		      for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
		 }
	     }
         }
    }
}
if ($arr["source"]==7) $data0[$o]=$data[$o];
if ($arr["source"]==2) for ($o=0;$o<=$max; $o++) $data0[$o]=$data0[$o]+$voda;
//for ($o=0;$o<=$max; $o++) echo $date1[$o].' > '.$data0[$o].'<br>';

// Create the graph. These two calls are always required
$graph = new Graph(500,200,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new LinePlot($data0);
if ($arr["source"]==0) $lineplot2=new LinePlot($data1);

// Add the plot to the graph
$graph->img->SetMargin(50,20,20,40);
//----------- title --------------------
$graph->Add($lineplot);
if ($arr["source"]==0) $graph->Add($lineplot2);
$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
$lineplot->SetColor("black");
$lineplot->SetWeight(2);
if ($arr["source"]==0)
   {
    $lineplot2->SetColor("red");
    $lineplot2->SetWeight(2);
   }
$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($dat);
$graph->xaxis->SetTextTickInterval(3,0);
$graph->xaxis->SetLabelAngle(45);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
if ($arr["source"]==0) 
   {
    $lineplot->SetLegend("Расход по подающей (M,кг)");
    $lineplot2->SetLegend("Расход по обратной (M,кг)");
   }
if ($arr["source"]==1) $lineplot->SetLegend("Тепловая энергия (W,Гкал)");
if ($arr["source"]==2) $lineplot->SetLegend("Расход воды (V,м3)");
if ($arr["source"]==3) $lineplot->SetLegend("Расход пара (V,м3)");
if ($arr["source"]==4) $lineplot->SetLegend("Расход (M,кг)");
if ($arr["source"]==5 || $arr["source"]==6) $lineplot->SetLegend("Расход (V,м3)");
if ($arr["source"]==7) $lineplot->SetLegend("Мощность (W,кВт)");
//--------------------------------------
// Display the graph
$graph->Stroke();
?>
