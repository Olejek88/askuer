<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_line.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
//------------------------------------------------------------------------
$x=0; $nx=1; $nn=1;
$today=getdate();
if ($arr["otch"]==21) $x=48+$today[hours];
if ($arr["otch"]==22)
	{
	 $ye=$arr["year"];
 	 if ($arr["month"]>1) $mm=$arr["month"]-1;
		else { $mm=12; $ye=$ye--; }
	 if (checkdate ($mm,31,$ye)) { $x=$arr["day"]+30; }
	 if (!checkdate ($mm,31,$ye)) { $x=$arr["day"]+29; }
	 if (!checkdate ($mm,30,$ye)) { $x=$arr["day"]+27; }
	 if (!checkdate ($mm,28,$ye)) { $x=$arr["day"]+26; }
	}
if ($arr["otch"]==24) $x=$arr["month"]+11;

$otch=$arr["otch"]-20;
if ($arr["otch"]==21) { $mx=$today[hours]; $mn=0; $nx=3; $nn=1; }
if ($arr["otch"]==22) { $mx=$arr["day"]; $mn=1; $nx=2; $nn=1; }
if ($arr["otch"]==23) { $mx=30; $mn=1; }
if ($arr["otch"]==24) { $mx=$arr["month"]; $mn=1; $nx=2; $nn=1;}
if ($arr["otch"]==25) { $mx=23; $mn=0; }
if ($arr["day"]>1) $day=$arr["day"]-1; else if ($arr["otch"]==22) { $day=30;  $mx=$day; if ($arr["month"]>1) $arr["month"]=$arr["month"]-1;}
if ($arr["month"]>1) $month=$arr["month"]; //-1
//if ($month<10) $month='0'.$month; else 
if ($arr["otch"]==22 && $arr["month"]<10 && $arr["day"]==1) $arr["month"]='0'.$arr["month"];
//if ($arr["otch"]==22 && $arr["day"]==1) $month='0'.$month; else $month=''.$month;
$mx=$mx+0;
for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     $data0[$x]=0; $dtt=-1;
     if ($arr["otch"]==21)
     if ($tm<10)
        {
         $query = 'SELECT * FROM data WHERE type='.$otch.' AND date='.$arr["year"].$arr["month"].$arr["day"].'0'.$tm.'0000 AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
         $dat[$x]=$arr["day"].' 0'.$tm.':00';
        }
     else
     	{
         $query = 'SELECT * FROM data WHERE type='.$otch.' AND date='.$arr["year"].$arr["month"].$arr["day"].$tm.'0000 AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
	 $dat[$x]=$arr["day"].' '.$tm.':00';
	}
     if ($arr["otch"]==22)
     if ($tm<10)
        {
         $query = 'SELECT * FROM data WHERE type='.$otch.' AND (date='.$arr["year"].$arr["month"].'0'.$tm.'000000 OR date='.$arr["year"].$arr["month"].'0'.$tm.'120000) AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
         $dat[$x]=$arr["month"].'.'.'0'.$tm;
        }
     else
        {
         $query = 'SELECT * FROM data WHERE type='.$otch.' AND (date='.$arr["year"].$arr["month"].$tm.'000000 OR date='.$arr["year"].$arr["month"].$tm.'120000) AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
         $dat[$x]=$arr["month"].'.'.$tm;
        }
     if ($arr["otch"]==24)
     if ($tm>9)
        {
         $query = 'SELECT * FROM data WHERE type='.$otch.' AND (date='.$arr["year"].$tm.'01000000 OR date='.$arr["year"].$tm.'01120000) AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
         $dat[$x]=$tm.'-'.$arr["year"];
        }
     else
        {
	 $query = 'SELECT * FROM data WHERE type='.$otch.' AND (date='.$arr["year"].'0'.$tm.'01000000 OR date='.$arr["year"].'0'.$tm.'01120000) AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
      	 $dat[$x]='0'.$tm.'-'.$arr["year"];
 	}
     if ($arr["source"]==7) 
	{
	 $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4].$arr["idkon"][0].$arr["idkon"][1];
	 //echo $query;
	}
     else $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4];
     //echo $query;
     $dt0=-1; $dt1=-1;
     $a = mysql_query ($query,$i);
     if ($a)
     for ($l=1;$l<=100;$l++)
         {
          $uy = mysql_fetch_row ($a);
          if ($uy == true)
             {
               if ($arr["source"]==0) if (strstr ($uy[1],'температуры') && strstr ($uy[1],'подающей'))  { $data0[$x]=$uy[7]; $dt0=1;}
               if ($arr["source"]==0) if (strstr ($uy[1],'температуры') && strstr ($uy[1],'обратной'))  { $data1[$x]=$uy[7]; $dt1=1;}
   
      	       if ($arr["source"]==4 || $arr["source"]==5 || $arr["source"]==6) if (strstr ($uy[1],'давления')) { $data0[$x]=$uy[7]; $dtt=1;}
      	       if ($arr["source"]==4 || $arr["source"]==5 || $arr["source"]==6) if (strstr ($uy[1],'температуры')) { $data1[$x]=$uy[7]; $dtt=1;}
	     }
         }
     if ($arr["otch"]==21)
	{
	 if ($arr["source"]==0)
	    {  
	     if ($dt0==-1) $data0[$x]=$pr0; else $pr0=$data0[$x];
	     if ($dt1==-1) $data1[$x]=$pr1; else $pr1=$data1[$x];
	    }
	 if ($arr["source"]>0) 
	     if ($dtt==-1) 
		  { $data0[$x]=$pr0; $data1[$x]=$pr1;} 
	     else { $pr0=$data0[$x]; $pr1=$data1[$x];}
	}
     $x--;
     if ($arr["otch"]==21) 
	{ 
	 $mx=23; 
	 if ($tn<4 && $tm==0) 
	    { 
	     if ($arr["day"]>1) 
		{ 
		 $arr["day"]--; 
		 if ($arr["day"]<10) 
			$arr["day"]='0'.$arr["day"]; 
		} 
	     else 
		{ 
		 $arr["day"]=31; $arr["hour"]=23; 
		 //$tn=1; $tm=1; 
		 if ($arr["month"]>1) $arr["month"]--;
		 if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		}
	    }
	}
     if ($arr["otch"]==24) { if ($tn==2 && $tm==1) { $arr["year"]--; $mx=12; }}
     if ($arr["otch"]==22) 
	{ 	 
	 if ($tn==2 && $tm==1)
		{
		 $mx=31; 
		 if ($arr["month"]>1) 
			{ 
			 $arr["month"]--;  if ($arr["month"]<10) $arr["month"]='0'.$arr["month"]; else $arr["month"]=''.$arr["month"];
			 if (!checkdate ($arr["month"],31,$arr["year"])) { $mx=30; }
			 if (!checkdate ($arr["month"],30,$arr["year"])) { $mx=28; }
			 if (!checkdate ($arr["month"],28,$arr["year"])) { $mx=27; }
			}
		 else 
		     { 
		      $arr["month"]=12; $arr["year"]--;
		     }
		 }
	}
   }
// Create the graph. These two calls are always required
$graph = new Graph(1000,400,"auto");	
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new LinePlot($data0);
$lineplot2=new LinePlot($data1);

$graph->xaxis->SetTickLabels($dat);
// Add the plot to the graph
$graph->img->SetMargin(50,50,20,40);
//----------- title --------------------
$graph->Add($lineplot);
if ($arr["source"]==0)
	{
	 $graph->title->Set("Теплофикационная вода");
         $graph->yaxis->title->Set("T,C");
	 $graph->Add($lineplot2);
	}
if ($arr["source"]==4)
	{
	 $graph->title->Set("Природный газ");
         $graph->yaxis->title->Set("P,МПа T,C");
	 $graph->SetY2Scale("lin");
	 $graph->AddY2($lineplot2);
        }
if ($arr["source"]==5)
	{
	 $graph->title->Set("Сжатый воздух");
         $graph->yaxis->title->Set("P,МПа T,C");
	 $graph->SetY2Scale("lin");
	 $graph->AddY2($lineplot2);
        }
if ($arr["source"]==6)
	{
	 $graph->title->Set("Кислород");
         $graph->yaxis->title->Set("P,МПа T,C");
	 $graph->SetY2Scale("lin");
	 $graph->AddY2($lineplot2);
        }
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
//$lineplot->value-> Show();
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
$graph->yaxis->HideZeroLabel();
$graph->xaxis->SetLabelAngle(45);
$graph->SetMarginColor('lavender');

$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);
$graph->yaxis->SetWeight(1);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
if ($arr["source"]==0) 
  {
   $lineplot->SetLegend("Температура по подающей (Т,С)");
   $lineplot2->SetLegend("Температура по обратной (Т,С)");   
  }
if ($arr["source"]==4 || $arr["source"]==5 || $arr["source"]==6) 
  {
   $lineplot->SetLegend("Давление (P,МПа)");
   $lineplot2->SetLegend("Температура (Т,С)");
  }
//--------------------------------------
// Display the graph
$graph->Stroke();
?>