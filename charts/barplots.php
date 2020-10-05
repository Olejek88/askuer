<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
//------------------------------------------------------------------------
$x=0;  $nx=1; $nn=1;
$today=getdate();
$otch=$arr["otch"]-20;

if ($arr["otch"]==21) $x=48+$today[hours];
if ($arr["otch"]==22) 
	{
	 $ye=$arr["year"];
 	 if ($arr["month"]>1) $mm=$arr["month"]-1;
		else { $mm=12; $ye=$ye--; }
	 if (checkdate ($mm,31,$ye)) { $x=$arr["day"]+31; }
	 else if (checkdate ($mm,30,$ye)) { $x=$arr["day"]+30; }
	 else if (checkdate ($mm,29,$ye)) { $x=$arr["day"]+29; }
	 else if (checkdate ($mm,28,$ye)) { $x=$arr["day"]+28; }
 	 if (mm>1) $mm--;
		else { $mm=12; $ye=$ye--; }
	 if (checkdate ($mm,31,$ye)) { $x=$x+31; }
	 else if (checkdate ($mm,30,$ye)) { $x=$x+30; }
	 else if (checkdate ($mm,29,$ye)) { $x=$x+29; }
	 else if (checkdate ($mm,28,$ye)) { $x=$x+28; }
	}
if ($arr["otch"]==24) $x=$arr["month"]+11;

if ($arr["otch"]==21) { $mx=$today[hours]; $mn=0; $nx=3; $nn=1; }
if ($arr["otch"]==22) { $mx=$arr["day"]; $mn=1; $nx=3; $nn=1; }
if ($arr["otch"]==23) { $mx=30; $mn=1; }
if ($arr["otch"]==24) { $mx=$arr["month"]; $mn=1; $nx=2; $nn=1;}
if ($arr["otch"]==25) { $mx=23; $mn=0; }
if ($arr["day"]>1) $day=$arr["day"]-1; else if ($arr["otch"]==22) { $day=30;  $mx=$day; if ($arr["month"]>1) $arr["month"]=$arr["month"]-1;}
if ($arr["month"]>1) $month=$arr["month"]; //-1
if ($arr["otch"]==22 && $arr["month"]<10 && $arr["day"]==1) $arr["month"]='0'.$arr["month"];
//if ($month<10) $month='0'.$month; else 
$month=''.$month;
$mx=$mx+0;

if ($today["hour"]<10) $hour='0'.$today["hours"]; else $hour=$today["hours"];
if ($today["mday"]<10) $today["mday"]='0'.$today["mday"];
if ($today["mon"]<10) $today["mon"]='0'.$today["mon"];
$edate=$today["year"].$today["mon"].$today["mday"].$hour.'0000';
if ($arr["otch"]==22) $x=$x-1;
$maxx=$x;

for ($tn=$nx; $tn>=$nn; $tn--)
for ($tm=$mx; $tm>=$mn; $tm--)
    {
     $data0[$x]=0; $dtt=-1;
     $dt0[$x]=0; $dt1[$x]=0;
     if ($tm<10) $tm='0'.$tm;
     if ($arr["otch"]==21)
        {
	 $date1[$x]=$arr["year"].'-'.$arr["month"].'-'.$arr["day"].' '.$tm.':00:00';
         $dat[$x]=$arr["day"].' '.$tm.'.00';
	 $dats[$x]=$arr["year"].$arr["month"].$arr["day"].$tm.'0000';
        }
     if ($arr["otch"]==22)
        {
 	 $date1[$x]=$arr["year"].'-'.$arr["month"].'-'.$tm.' 00:00:00';
 	 $date2[$x]=$arr["year"].'-'.$arr["month"].'-'.$tm.' 12:00:00';
	 $dat[$x]=$tm.'-'.$arr["month"];
 	 $dats[$x]=$arr["year"].$arr["month"].$tm.'000000';
        }
     if ($arr["otch"]==24)
        {
	 $date1[$x]=$arr["year"].'-'.$tm.'-01 00:00:00';
	 $date2[$x]=$arr["year"].'-'.$tm.'-01 12:00:00';
         $dat[$x]=$tm.'-'.$arr["year"];
	 $dats[$x]=$arr["year"].$tm.'01000000';
	 }
     //echo '['.$x.'] '.$date1[$x].'<br>';
     $x--;
     if ($arr["otch"]==21) 
	{ 
	 $mx=23; 
	 if ($tn<4 && $tm==0) 
	    { 
	     if ($arr["day"]>1) 
		{ 
		 $arr["day"]--; 
		 if ($arr["day"]<10) $arr["day"]='0'.$arr["day"]; 
		} 
	     else 
		{ 
		 $arr["day"]=31;
		 if ($arr["month"]>1) $arr["month"]--;
		 else { $arr["month"]=12; $arr["year"]--; }
		 if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
		}
	    }
	}
     if ($arr["otch"]==24) { if ($tn==2 && $tm==1) { $arr["year"]--; $mx=12; }}
     if ($arr["otch"]==22) 
	{ 	 
	 if ($tn<4 && $tm==1)
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

if ($arr["otch"]==21) $bdate=$arr["year"].$arr["month"].$arr["day"].'000000';
if ($arr["otch"]==22) $bdate=$arr["year"].$arr["month"].'01000000';
if ($arr["otch"]==24) $bdate=$arr["year"].$arr["month"].'01000000';
$query = 'SELECT * FROM data WHERE type='.$otch.' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"];
if ($arr["source"]==7 || $arr["idkorp"]==101) 
   {
    if ($arr["typ"]==1 || $arr["typ"]=='') $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4].$arr["idkon"][0].$arr["idkon"][1];
    if ($arr["typ"]==2) $query = $query . ' AND device='.$arr["idkon"];
   }
else $query = $query . ' AND device='.$arr["idkon"][3].$arr["idkon"][4];
//echo $query.'<br>';
for ($o=0;$o<=$maxx; $o++) $data0[$o]=-1;

$a = mysql_query ($query,$i);
if ($a)
for ($l=1;$l<=2500;$l++)
    {
     $uy = mysql_fetch_row ($a);
     if ($uy == true)
        {
          if ($arr["source"]==0)
             {
              if (strstr ($uy[1],'подающей') && strstr ($uy[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $dt1[$o]=$uy[7];
              if (strstr ($uy[1],'обратной') && strstr ($uy[1],'асс')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $dt0[$o]=$uy[7];
             }
          if ($arr["source"]==1) if (strstr ($uy[1],'энергии') || strstr ($uy[1],'мощность')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$uy[7];
          if ($arr["source"]==2) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$uy[7];
          if ($arr["source"]==3) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$uy[7];
	  if ($arr["source"]==4) if (strstr ($uy[1],'бъема')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3]) || strstr($date2[$o],$uy[3])) $data0[$o]=$uy[7]; 
	  if ($arr["source"]==5) if (strstr ($uy[1],'бъем')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$uy[7]; 
	  if ($arr["source"]==6) if (strstr ($uy[1],'объема')) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$uy[7];
	  if ($arr["source"]==7) for ($o=0;$o<=$maxx; $o++) if (strstr($date1[$o],$uy[3])) $data0[$o]=$uy[7];

        }
     //if ($arr["otch"]==21) if ($dtt==-1) $data0[$x]=$pr; else $pr=$data0[$x];
   }
if ($arr["source"]==0) for ($o=0;$o<=$maxx; $o++) { if ($dt0[$o]!=0 && $dt1[$o]!=0) $data0[$o]=$dt1[$o]-$dt0[$o];}
$typ=$arr["otch"]-20;
for ($o=0;$o<=$maxx; $o++) if ($data0[$o]==-1)
 { 
  if ($arr["source"]==0)
     {		    
      $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$o].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%подающей%\')';
      $t = mysql_query ($query,$i);		
      if ($t)
	 {
	  $ut = mysql_fetch_row ($t);
	  if ($ut == true) $dtvhd=$ut[7];
	 }
      $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$o].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' AND name LIKE \'%обратной%\')';
      $t = mysql_query ($query,$i);		
      if ($t)
	 {
	  $ut = mysql_fetch_row ($t);
	  if ($ut == true) $dtvhd0=$ut[7];
	 }
     }
  else
     {			
      $query = 'SELECT * FROM data WHERE type='.$typ.' AND date=\''.$dats[$o].'\' AND korp=101 AND source='.$arr["source"].' AND (name LIKE \'%масса%\' OR name LIKE \'%расход%\' OR name LIKE \'%мощность%\')';
      $t = mysql_query ($query,$i);		
      if ($t)
	   {
	    $ut = mysql_fetch_row ($t);
	    if ($ut == true) $dtvhd=$ut[7];
	   }
     }
  $query = 'SELECT P14 FROM uzel WHERE idkon=\''.$arr["idkon"].'\'';
  $t = mysql_query ($query,$i);
  if ($t)
     {
      $ut = mysql_fetch_row ($t);
      if ($ut == true) $dtp14=$ut[0];
     }		    
  if ($arr["source"]==0) $data0[$o]=$dtp14*($dtvhd-$dtvhd0);
  if ($arr["source"]==1) $data0[$o]=$dtp14*$dtvhd;
  if ($arr["source"]==2) $data0[$o]=$dtp14*$dtvhd;
  if ($arr["source"]==5) $data0[$o]=$dtp14*$dtvhd; 
  //echo $dtp14.'--'.$dtvhd;
 }
//for ($tm=0; $tm<=100; $tm++) {echo $data0[$tm].'  '.$dat[$tm].'<br>';}
$graph = new Graph(1000,450,"auto");
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
$graph->img->SetMargin(50,50,20,50);
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
         $graph->yaxis->title->Set("M,м3");
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
// Display the graph
$graph->Stroke();
?>