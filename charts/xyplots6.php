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


 $arr = get_defined_vars();
 $today=getdate();
 $source=1+$arr["source"];
 $kor=0; $max=0; $K=1;
 $beghour=0; $endhour=$hour=$today["hour"];
 $begday=$arr["day"];  $endday=$day=$arr["eday"];
 $begmonth=$arr["month"]; $endmonth=$month=$arr["emonth"];
 $begyear=$arr["year"];  $endyear=$year=$arr["eyear"];
 $btime=$begyear*100*100*100+$begmonth*100*100+$begday*100+$beghour;
 $etime=$endyear*100*100*100+$endmonth*100*100+$endday*100+$endhour;
// echo $btime.'--'.$etime;

               if ($arr["otch"]==1) { $mx=23; $mn=0; $int=($etime-$btime)/300; }
               if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; $int=($etime-$btime)/3000;}
               if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; $int=1;}

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
 if ($arr["otch"]==1) { $mx=23; $mn=0; }
 if ($arr["otch"]==2) { $mx=$endday; $mn=$begday; }
 if ($arr["otch"]==4) { $mx=$endmonth; $mn=$begmonth; }

 for ($tm=$mx; $tm>=0; $tm--)
   {
    //include ("inc/method_req.inc");
    include ("../inc/rep_sub.inc");
    $time=$year*100*100*100+$month*100*100+$day*100+$hour;
//  	   echo $date1[$tm].'<br>';
    if ($time<$btime) break;
    $x++;
   }

 $max=$x;
 $query = 'SELECT * FROM uzel WHERE id='.$_GET["uzel"];
// echo $query;
 $a = mysql_query ($query,$i); 
 if ($a) $uy = mysql_fetch_row ($a);
 if ($uy)
	{
 	 $source=$uy[2]+1;
	 $arr["source"]=$uy[2];
 	 $arr["idkorp"]=$uy[3];
 	 $arr["idkon"]=$uy[4];
	}

 for ($o=0;$o<=$x; $o++) $data[$o]=0;
// for ($o=0;$o<=$x; $o++) echo $date1[$o];
 if ($arr["source"]>6) $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"].' AND device='.$arr["idkon"][3].$arr["idkon"][4].$arr["idkon"][0].$arr["idkon"][1];
 else  $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date>='.$bdate.' AND date<='.$edate.' AND korp='.$arr["idkorp"].' AND source='.$arr["source"].' AND device='.$arr["idkon"][3].$arr["idkon"][4];
 $a = mysql_query ($query,$i); 
 if ($a)
 for ($l=1;$l<=50000;$l++)
      {
       $uy = mysql_fetch_row ($a);
       if ($uy == true)
          {
           if ($source==1)
              {
	       if (strstr ($uy[1],'���') && strstr ($uy[1],'��������')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data1[$o]=$data1[$o]+$uy[7];
               if (strstr ($uy[1],'���') && strstr ($uy[1],'��������')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data2[$o]=$data2[$o]+$uy[7];
	       if (strstr ($uy[1],'���') && strstr ($uy[1],'��������')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data3[$o]=$data3[$o]+$uy[7];
               if (strstr ($uy[1],'���') && strstr ($uy[1],'��������')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data4[$o]=$data4[$o]+$uy[7];
	      }
    	   if ($source==2) if (strstr ($uy[1],'�������� �������') || strstr ($uy[1],'��������')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==3) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==4) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==5) if (strstr ($uy[1],'�����')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==6) if (strstr ($uy[1],'����')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
	   if ($source==7) if (strstr ($uy[1],'������')) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) $data0[$o]=$data0[$o]+$uy[7]; 
 	   if ($source==8) for ($o=0;$o<=$max; $o++)  if (strstr($date1[$o],$uy[3])) 
		{
		 $data0[$o]=$data0[$o]+$uy[7]; 
		 //echo $uy[7].'<br>';
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
	 $graph->title->Set("���������������� ����");
         $graph->yaxis->title->Set("M,�.");
	}
if ($arr["source"]==1)
	{
	 $graph->title->Set("�������� �������");
         $graph->yaxis->title->Set("W,����");
        }
if ($arr["source"]==2)
	{
	 $graph->title->Set("�������-�������� ����");
         $graph->yaxis->title->Set("V,m3");
        }
if ($arr["source"]==3)
	{
	 $graph->title->Set("������� ���");
         $graph->yaxis->title->Set("V,m3");
        }
if ($arr["source"]==4)
	{
	 $graph->title->Set("��������� ���");
         $graph->yaxis->title->Set("M,kg");
        }
if ($arr["source"]==5)
	{
	 $graph->title->Set("������ ������");
         $graph->yaxis->title->Set("V,�3");
        }
if ($arr["source"]==6)
	{
	 $graph->title->Set("��������");
         $graph->yaxis->title->Set("V,�3");
        }
if ($arr["source"]==7)
	{
	 $graph->title->Set("������������� �������");
         $graph->yaxis->title->Set("W,���");
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
if ($arr["source"]==0) $lineplot->SetLegend("����� ������ (M,�.)");
if ($arr["source"]==1) $lineplot->SetLegend("�������� ������� (W,����)");
if ($arr["source"]==2) $lineplot->SetLegend("������ ���� (V,�3)");
if ($arr["source"]==3) $lineplot->SetLegend("������ ���� (V,�3)");
if ($arr["source"]==4) $lineplot->SetLegend("������ (M,��)");
if ($arr["source"]==5 || $arr["source"]==6) $lineplot->SetLegend("������ (V,�3)");
if ($arr["source"]==7) $lineplot->SetLegend("�������� (W,���)");
//--------------------------------------
// Display the graph
$graph->Stroke();
?>