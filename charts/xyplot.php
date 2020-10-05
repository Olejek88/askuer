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
if ($today["mon"]>1) $mm=$today["mon"]-1;
else { $mm=12; $ye=$ye--; }

if (checkdate ($mm,31,$ye)) { $x=$today["mday"]+30; }
if (!checkdate ($mm,31,$ye)) { $x=$today["mday"]+29; }
if (!checkdate ($mm,30,$ye)) { $x=$today["mday"]+27; }
if (!checkdate ($mm,28,$ye)) { $x=$today["mday"]+26; }
if (mm>1) $mm--;
	else { $mm=12; $ye=$ye--; }
if (checkdate ($mm,31,$ye)) { $x=$x+30; }
if (!checkdate ($mm,31,$ye)) { $x=$x+29; }
if (!checkdate ($mm,30,$ye)) { $x=$x+27; }
if (!checkdate ($mm,28,$ye)) { $x=$x+26; }

$mx=$today["mday"]; $mn=1; $nx=3; $nn=1;

if ($today["mday"]>1) 
   $day=$today["mday"]-1; 
else 
   { 
    $day=30;  $mx=$day; $x=$x+29;
    if ($today["mon"]>1) $today["mon"]=$today["mon"]-1;
   }
$x=$x-$today["mday"]+1;

if ($today["mon"]>1) $month=$today["mon"];
if ($today["otch"]==22 && $today["month"]<10 && $today["mday"]==1) $today["month"]='0'.$today["month"];
$month=''.$month;
//echo $mx.'<br>';
//$mx=$mx+1;
$max=0; $min=1000000;
//echo $mx.'<br>';
if ($today["mday"]>1) { $mx--; $x--;}
//echo $mx.'<br>';
if ($today["mon"]<10) $today["mon"]='0'.$today["mon"];
for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     $data0[$x]=0; $data1[$x]=0; $dtt=-1;     
     if ($tm<10) 
	{
	 $date1=$today["year"].$today["mon"].'0'.$tm.'000000';
	 $date2=$today["year"].$today["mon"].'0'.$tm.'120000';
	 $dat[$x]='0'.$tm.'-'.$today["mon"];
	}
     else
	{
	 $date1=$today["year"].$today["mon"].$tm.'000000';
	 $date2=$today["year"].$today["mon"].$tm.'120000';
	 $dat[$x]=$tm.'-'.$today["mon"];
	}     
     if ($arr["source"]==0)
         $query = 'SELECT * FROM data WHERE type=2 AND (date='.$date1.' OR date='.$date2.') AND (korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=41 AND korp!=22 AND korp!=35) AND name LIKE \'%масс%\' AND source='.$arr["source"];
     if ($arr["source"]==1)
         $query = 'SELECT * FROM data WHERE type=2 AND (date='.$date1.' OR date='.$date2.') AND (korp<99 AND korp!=8 AND korp!=39 AND korp!=34 AND korp!=30 AND korp!=41 AND korp!=22 AND korp!=35) AND name LIKE \'%энергии%\' AND source='.$arr["source"];
     if ($arr["source"]==2)
         $query = 'SELECT * FROM data WHERE type=2 AND (date='.$date1.' OR date='.$date2.') AND (korp<99 AND korp!=61 AND korp!=6 AND korp!=39 AND korp!=38 AND korp!=31 AND korp!=35 AND korp!=22) AND name LIKE \'%объема%\' AND source='.$arr["source"];
     if ($arr["source"]==5)
         $query = 'SELECT * FROM data WHERE type=2 AND (date='.$date1.' OR date='.$date2.') AND (korp<99 AND korp!=1 AND korp!=39 AND korp!=5 AND korp!=6 AND korp!=31) AND name LIKE \'%объема%\' AND source='.$arr["source"];
     if ($arr["source"]==7)
         $query = 'SELECT * FROM data WHERE type=2 AND (date='.$date1.' OR date='.$date2.') AND korp<99 AND ((name LIKE \'%ТП 102(яч.1)%\') OR (name LIKE  \'%ТП 5(яч10)%\') OR (name LIKE  \'%ТП 4(яч.12)%\') OR (name LIKE \'%КНТП250(яч.14)%\') OR (name LIKE \'%ТП 101(яч.16)%\') OR (name LIKE \'%ТКР(яч.6)акт%\') OR (name LIKE \'%ТКР(яч.11)акт%\') OR (name LIKE \'%ЧЗСМ(яч.2)акт%\') OR (name LIKE \'%ТКР(яч.6)акт%\') OR (name LIKE \'%ЧЗСМ(яч-15)акт%\')) AND source='.$arr["source"];
//     echo $query.'<br>';
     $dt0=0; $dt1=0;
     $a = mysql_query ($query,$i);
     if ($a)
     for ($l=1;$l<=180;$l++)
         {
          $uy = mysql_fetch_row ($a);
          if ($uy == true)
             {
//	      echo  $dat.' '.$uy[1].' '.$uy[7].'<br>';
              if ($arr["source"]==0) 
		{
		 if (strstr ($uy[1],'подающ'))  
			{ $data0[$x]=$data0[$x]+$uy[7]; $dtt=1; }
		 if (strstr ($uy[1],'обратн'))  
			{ $data1[$x]=$data1[$x]+$uy[7]; $dtt=1; }
		}
	      else $data0[$x]=$data0[$x]+$uy[7];
	     }
         }
//     echo  $data0[$x].' '.$data1[$x].'<br>';
     if ($data0[$x]>$max) { $max=$data0[$x]; $datemax=$dat[$x]; }
     if ($data0[$x]<$min) { $min=$data0[$x]; $datemin=$dat[$x]; }
     $x--;
     if ($tn<4 && $tm==1)
	{
	 $mx=31; 
	 if ($tn==2) $mn=$today["mday"];
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

$armfile='../tmp/pike_'.$arr["source"].'.htm';
$fp1=fopen($armfile,"w");
fwrite ($fp1,"максимум "); fwrite ($fp1,$datemax.'-'.$ye); fwrite ($fp1," "); fwrite ($fp1,$max); fwrite ($fp1,"<br>");
fwrite ($fp1,"минимум  "); fwrite ($fp1,$datemin.'-'.$ye); fwrite ($fp1," "); fwrite ($fp1,$min); fwrite ($fp1,"<br>");
fclose ($fp1);

//for ($i=0; $i<31; $i++) print $time[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(1000,400,"auto");	
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new LinePlot($data0);
if ($arr["source"]==0) $lineplot2=new LinePlot($data1);

// Add the plot to the graph
$graph->img->SetMargin(50,20,20,40);
//----------- title --------------------
if ($arr["source"]==0)
	{
	 $graph->title->Set("Теплофикационная вода");
	}
if ($arr["source"]==1)
	{
	 $graph->title->Set("Тепловая энергия");
        }
if ($arr["source"]==2)
	{
	 $graph->title->Set("Пожарно-питьевая вода");
        }
if ($arr["source"]==3)
	{
	 $graph->title->Set("Водяной пар");
        }
if ($arr["source"]==4)
	{
	 $graph->title->Set("Природный газ");
        }
if ($arr["source"]==5)
	{
	 $graph->title->Set("Сжатый воздух");
	 $lineplot->value->SetColor("darkred");
	 $lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,6); 
	 $lineplot->value->SetFormat("$ %0.1f"); 
	 $line = new PlotLine(HORIZONTAL,2000,"red",2); 
	 $graph->AddLine($line); 
	 $line2 = new PlotLine(HORIZONTAL,25000,"red",2); 
	 $graph->AddLine($line2); 
        }
if ($arr["source"]==6)
	{
	 $graph->title->Set("Кислород");
         $graph->yaxis->title->Set("V,м3");
        }
if ($arr["source"]==7)
	{
	 $graph->title->Set("Электрическая энергия");
	 $lineplot->SetFillColor("lightblue");
        }
$graph->Add($lineplot);
if ($arr["source"]==0) $graph->Add($lineplot2);
$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
$graph->xaxis->SetLabelAngle(45);
$lineplot->SetColor("black");
$lineplot->SetWeight(2);
if ($arr["source"]==0)
   {
    $lineplot2->SetColor("red");
    $lineplot2->SetWeight(2);
   }
$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($dat);

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

//$band = new PlotBand(HORIZONTAL,BAND_SOLID,15,35,'khaki4');
//$band->ShowFrame(false);
//$graph->AddBand($band);

//$graph->AddBand($lband); 

//$lband=new PlotBand(HORIZONTAL,BAND_LDIAG,"min",0,"red"); 
//$lband->ShowFrame(false); 
//$lband->SetDensity(20); // 20% line density 
//$graph->AddBand($uband); 



//--------------------------------------
// Display the graph
$graph->Stroke();
?>