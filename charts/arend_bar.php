<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today=getdate();
$ye=$today["year"];
$mm=$today["mon"];
$source=$arr["source"];
$idbuy=$arr["idbuy"];

if ($arr["year"]!='') $today["year"]=$arr["year"];
if ($arr["month"]!='')$today["mon"]=$arr["month"];

if ($today["mon"]<10) $edate=$today["year"].'0'.$today["mon"].'02000000';
else $edate=$today["year"].$today["mon"].'02000000';
$mx=$today["mon"]; $mn=1; $nx=2; $nn=1;
$ye=$today["year"]-1;
$year=$today["year"];
$bdate=$ye.'0101000000';
$max=$today["mon"]+11;
$x=$max; 
//echo $bdate.'-'.$edate;
for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     if ($tm<10) 
	{
	 $date1[$x]=$year.'-'.'0'.$tm.'-01 00:00:00';
	 $dat[$x]='0'.$tm.'-'.$year;
	}
     else
	{
	 $date1[$x]=$year.'-'.$tm.'-'.'01 00:00:00';
	 $dat[$x]=$tm.'-'.$year;
	}     
     if ($arr["source"]==7)
	{
	 $data0[$x]=0;
         if ($tm>9) $month=$tm; else $month='0'.$tm;
	 $day=1;
	 $arr["otch"]=4; $sour=7;
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
     if ($tn==2 && $tm==1) { $year--; $mx=12; }
    }
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
     $voda=$voda*30;
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
         $a = mysql_query ($query,$i); 
         $uy = mysql_fetch_row ($a); 
         if ($uy == true && $uy[0]>0) $K=$uy[0]; else $K=0;
         if ($K>0)
    	    {
  	     //if ($arr["source"]==0) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%масс%\' AND source='.$arr["source"];
	     if ($arr["source"]==1) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%энергии%\' AND source='.$arr["source"];
	     if ($arr["source"]==2) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==4) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==5) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==6) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND name LIKE \'%объема%\' AND source='.$arr["source"];
	     if ($arr["source"]==7) $query = 'SELECT * FROM data WHERE type=4 AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$uo[1].' AND source='.$arr["source"];
	     //echo $query.'<br>';
	     $a = mysql_query ($query,$i);
	     if ($a)
	     for ($l=1;$l<=100;$l++)
	         {
                  $uy = mysql_fetch_row ($a);
		  //echo $K.' > '.$uy[3].' > '.$uy[7].'<br>';
                  if ($uy == true)
      		      for ($o=0;$o<=$max; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]*$K;
		 }
	     }
         }
    }
}
if ($arr["source"]==7) for ($o=0;$o<=$max; $o++) $data0[$o]=$data[$o];
if ($arr["source"]==2) for ($o=0;$o<=$max; $o++) $data0[$o]=$data0[$o]+$voda;
//for ($o=0;$o<=$max; $o++) echo $data0[$x].'<br>';
//for ($o=0;$o<=$max; $o++) echo $date1[$o].' > '.$data0[$o].'<br>';

// Create the graph. These two calls are always required
$graph = new Graph(500,200,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
$graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->xaxis->SetLabelAngle(30);
$graph->SetMarginColor('lavender');
$lineplot->SetShadow();

// Add the plot to the graph
$graph->img->SetMargin(50,10,10,40);
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
