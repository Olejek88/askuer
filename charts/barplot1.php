<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
//------------------------------------------------------------------------
$year=$arr["year"]; $day=$arr["day"]; $month=$arr["month"];

if ($arr["day"]>1) $day--;
else { $day=30; $month--;}
if ($arr["day"]<10) $day='0'.$day;

$edate=$arr["year"].$arr["month"].$arr["day"].'230000';
$bdate=$arr["year"].$month.$day.'000000';

$day=$arr["day"]; $month=$arr["month"];
$x=47; $mx=24; $mn=0; $nx=2; $nn=1;
$max=$x;

for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     if ($tm<10) 
	{
	 $date1[$x]=$year.'-'.$month.'-'.$day.' 0'.$tm.':00:00';
	 $dat[$x]='0'.$tm.':00';
	}
     else
	{
	 $date1[$x]=$year.'-'.$month.'-'.$day.' '.$tm.':00:00';
	 $dat[$x]=$tm.':00';
	}     

     if ($arr["source"]==7)
	{
	 $data0[$x]=0;
	 $arr["otch"]=1; $sour=7;
	 $ffile="../tmp/arends".$idbuy.$year.$month.".htm";
	 $fp=fopen($ffile,"w");
	 $source++;
	 include ("../inc/method_el1.inc");
	 $source--;
	 fclose($fp);
	 $data[$x]=$data0[$x];
	}
     //echo $date1[$x].'<br>';
     $x--;
     $mx=23; 
     if ($tn<3 && $tm==0) 
	{ 
	 if ($day>1) 
	    { 
	     $day--; 
	     if ($day<10) $day='0'.$day; 
	    } 
	 else 
	    { 
	     $day=31;
	     if ($month>1) $month--;
	     if ($month<10) $month='0'.$month;
	    }
	}
    }
for ($o=0;$o<=$max; $o++) $data0[$o]=0;

$query = 'SELECT * FROM data WHERE type=1 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
//echo $query.'<br>';
$a = mysql_query ($query,$i);
if ($a)
for ($l=1;$l<=300;$l++)
    {
     $uy = mysql_fetch_row ($a);
     if ($uy == true)
        {
         if ($arr["source"]==1 && strstr ($uy[1],'энергии')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
         if ($arr["source"]==2) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
         if ($arr["source"]==3) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
         if ($arr["source"]==4 && strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
         if ($arr["source"]==5 && strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
         if ($arr["source"]==6 && strstr ($uy[1],'объема')) for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7];
         if ($arr["source"]==7) $data0[$x]=$data0[$x]+$uy[7];
        }
    }
//for ($o=0;$o<=$max; $o++) echo $date1[$o].' > '.$data0[$o].'<br>';
$graph = new Graph(500,200,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
$graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->xaxis->SetLabelAngle(45);
$graph->SetMarginColor('lavender');
$lineplot->SetShadow();

// Add the plot to the graph
$graph->img->SetMargin(40,10,10,40);
//----------- title --------------------
$graph->Add($lineplot);
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
// Display the graph
$graph->Stroke();
?>