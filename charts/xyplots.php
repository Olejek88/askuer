<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_line.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
$kor=0; $max=0;
if ($arr["idkor"]==99)
{  
 $query = 'SELECT * FROM korp';
 if ($arr["day"]>1) $day=$arr["day"]-1;
 if ($arr["otch"]==2) 
     {
       if ($arr["month"]>1) $month=$arr["month"]-1; else {$month=12; $arr["year"]--;}
     }
 if ($month<10) $month='0'.$month; else $month=''.$month;

 $t = mysql_query ($query,$i);
 for ($k=1;$k<=50;$k++)
     {
      $uu = mysql_fetch_row ($t);
      if ($uu == true)
         {
          $x=0;
          $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$uu[1];
          $a = mysql_query ($query,$i);
          $uy = mysql_fetch_row ($a);
          $cnt=0;
          if ($uy == true && $uy[0]>0)  $K=$uy[0];
          else $K=0;
          //echo $query.' '.$K.'<br>';
          if ($K>0)
             {
              for ($y=0; $y<1; $y++)
	         {
        	  $data0[$y]=$data1[$y]=$data2[$y]=$data3[$y]=0; $time[$y]="1";
                 }
              $yeap=0; $cnt=0; 
              if ($arr["otch"]==1) { $mx=23; $mn=0; }
              if ($arr["otch"]==2) { $mx=31; $mn=1; }
              if ($arr["otch"]==3) { $mx=30; $mn=1; }
              if ($arr["otch"]==4) { $mx=12; $mn=1; }
              if ($arr["otch"]==5) { $mx=23; $mn=0; }
  	      for ($tm=$mn; $tm<=$mx; $tm++)
	          {
                   if($data0[$x]=='')  $data0[$x]=0;
		   if ($arr["otch"]==1)
  		   if ($tm<10)
	              {
	               $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.'0'.$tm.'0000 AND korp='.$uu[4].' AND source='.$arr["source"];
	               $dat=$day.'-'.$arr["month"].'-'.$arr["year"].' 0'.$tm.':00';
	              }
                   else
                      {
                       $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.$tm.'0000 AND korp='.$uu[1].' AND source='.$arr["source"];
	               $dat=$day.'-'.$arr["month"].'-'.$arr["year"].' '.$tm.':00';
	              }
	           if ($arr["otch"]==2)
  	           if ($tm<10)
  	              {
  	               $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.'0'.$tm.'000000 OR date='.$arr["year"].$month.'0'.$tm.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                       $dat='0'.$tm.'-'.$month.'-'.$arr["year"].' 00:00';
                       $time[$x]='0'.$tm.'-'.$month;
  	              }
 	           else
 	              {
 	               $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.$tm.'000000 OR date='.$arr["year"].$month.$tm.'120000) AND korp='.$uu[1].' AND source='.$arr["source"];
                       $dat=$tm.'-'.$month.'-'.$arr["year"].' 00:00';
                       $time[$x]=$tm.'-'.$month;
                      }
               	   if ($arr["otch"]==4)
	           if ($tm>9)
	              {
	               $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$tm.'01000000 OR date='.$arr["year"].$tm.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
    		       $dat='01-'.$tm.'-'.$arr["year"].' 00:00';
		       $time[$x]=''.$tm.'-'.$arr["year"];
	              }
	           else
	              {
	               $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].'0'.$tm.'01000000 OR date='.$arr["year"].'0'.$tm.'01120000) AND korp='.$uu[1].' AND source='.$arr["source"];
      	               $dat='01-0'.$tm.'-'.$arr["year"].' 00:00';
                       $time[$x]='0'.$tm.'-'.$arr["year"];

                      }      
 		   $a = mysql_query ($query,$i); 
                   if ($a)
                   for ($l=1;$l<=200;$l++)
                       {
                        $uy = mysql_fetch_row ($a);
                        if ($uy == true)
                           {
                            if ($l>1) $yeap=1;
                            //echo $uy[6].' '.$uy[1];
			    if ($uy[6]==0)
                               {
			        if (strstr ($uy[1],'����') && strstr ($uy[1],'��������')) $data0[$x]=$uy[7]*$K;
                                if (strstr ($uy[1],'����') && strstr ($uy[1],'��������')) { $data0[$x]=$data0[$x]-$uy[7]*$K; $l=100;}
                               }
			    if ($uy[6]==1) if (strstr ($uy[1],'�������� �������')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			    if ($uy[6]==2) $data0[$x]=$data0[$x]+$uy[7]*$K;
		 	    if ($uy[6]==3) $data0[$x]=$data0[$x]+$uy[7]*$K;
		            if ($uy[6]==4) if (strstr ($uy[1],'�����')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			    if ($uy[6]==5) if (strstr ($uy[1],'������')) $data0[$x]=$data0[$x]+$uy[7]*$K;
			    if ($uy[6]==6) if (strstr ($uy[1],'������'))  $data0[$x]=$data0[$x]+$uy[7]*$K;
 		       	    if ($uy[6]==7) $data0[$x]=$data0[$x]+$uy[7]*$K;
                           }                       
                       }
                 //echo 'f='.$time[$x];
                 //echo 'f='.$data0[$x];
                  $x++;
                 }
	     }
         }
     }    
//for ($i=0; $i<31; $i++) print $time[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(900,400,"auto");	
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new LinePlot($data0);
// Add the plot to the graph
$graph->img->SetMargin(50,50,20,40);
//----------- title --------------------
if ($arr["source"]==0)
	{
	 $graph->title->Set("���������������� ����");
         $graph->yaxis->title->Set("M,�");
	}
if ($arr["source"]==1)
	{
	 $graph->title->Set("�������� �������");
         $graph->yaxis->title->Set("W,���");
        }
if ($arr["source"]==2)
	{
	 $graph->title->Set("�������-�������� ����");
         $graph->yaxis->title->Set("V,�3");
        }
if ($arr["source"]==3)
	{
	 $graph->title->Set("������� ���");
         $graph->yaxis->title->Set("V,�3");
        }
if ($arr["source"]==4)
	{
	 $graph->title->Set("��������� ���");
         $graph->yaxis->title->Set("M,��");
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
$lineplot->SetWeight(1);
$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($time);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
if ($arr["source"]==0) $lineplot->SetLegend("������ (M,��)");
if ($arr["source"]==1) $lineplot->SetLegend("�������� ������� (W,���)");
if ($arr["source"]==2) $lineplot->SetLegend("������ ���� (V,�3)");
if ($arr["source"]==3) $lineplot->SetLegend("������ ���� (V,�3)");
if ($arr["source"]==4) $lineplot->SetLegend("������ (M,��)");
if ($arr["source"]==5 || $arr["source"]==6) $lineplot->SetLegend("������ (V,�3)");
if ($arr["source"]==7) $lineplot->SetLegend("�������� (W,���)");
//--------------------------------------
// Display the graph
$graph->Stroke();
}
else
{
 $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$arr["idbuy"].' AND idkorp='.$arr["idkor"];
 $a = mysql_query ($query,$i);
 for ($y=0; $y<1; $y++)
 {
  $data0[$y]=$data1[$y]=$data2[$y]=$data3[$y]=0; $time[$y]="1";
 }
 $uy = mysql_fetch_row ($a);
 $cnt=0;
 if ($uy == true && $uy[0]>0)  $K=$uy[0];
 if ($K>0)
   {
    $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date<'.$arr["date"].'000000 AND korp='.$arr["idkor"].' AND source='.$arr["source"].' ORDER BY date DESC';
    $a = mysql_query ($query,$i);
    $cnt=0;
    if ($a)
    for ($l=1;$l<=500;$l++)
        {
         $uy = mysql_fetch_row ($a);
         if ($uy == true)
            {
             if ($l==1) $tim=$uy[3];
             if ($uy[6]==0)
                 {
                  if (strstr ($uy[1],'����������') && strstr ($uy[1],'��������')) { $data0[$cnt]=$uy[7]; $time[$cnt]=$uy[3]; }
                  if (strstr ($uy[1],'����������') && strstr ($uy[1],'��������')) $data1[$cnt]=$uy[7];
                  if (strstr ($uy[1],'����') && strstr ($uy[1],'��������')) $data2[$cnt]=$uy[7];
                  if (strstr ($uy[1],'����') && strstr ($uy[1],'��������')) $data3[$cnt]=$uy[7];
                  $max=4;
                 }
      	     if ($uy[6]==1)
      	        {
                 if (strstr ($uy[1],'�������� �������')) $data0[$cnt]=$uy[7]*$K;
                 $max=1;
     	        }
             if ($uy[6]==2 || $uy[6]==3 || $uy[6]==7)
                {
                 $data0[$cnt]=$uy[7]*$K;
                 $max=1;
                }
             if ($uy[6]==4)
                 {
       	          if (strstr ($uy[1],'�������� ��������'))  { $data0[$cnt]=$uy[7]; $time[$cnt]=$uy[3]; }
                  if (strstr ($uy[1],'�������� �����������')) $data1[$cnt]=$uy[7];
	          if (strstr ($uy[1],'�����'))  $data2[$cnt]=$uy[7]*$K;
                  $max=3;                 
                 }
             if ($uy[6]==5 || $uy[6]==6)
                 {
       	          if (strstr ($uy[1],'�������� ��������'))  { $data0[$cnt]=$uy[7]; $time[$cnt]=$uy[3]; }
                  if (strstr ($uy[1],'�������� �����������')) $data1[$cnt]=$uy[7];
	          if (strstr ($uy[1],'������'))  $data2[$cnt]=$uy[7]*$K;
                  $max=3;                 
                 }
              $timm=sprintf ("%s",$uy[3]);
              $tok=strtok ($timm,"-: \n"); $ct=0;
     	      while ($tok && $ct<6){
	       if ($arr["otch"]==1 && $ct==3) $time[$cnt]=$tok.'/'.$ar[2];;
	       if ($arr["otch"]==2 && $ct==2) $time[$cnt]=$tok.'/'.$ar[1];
               if ($arr["otch"]==3 && $ct==1) $time[$cnt]=$tok;
               if ($arr["otch"]==4 && $ct==1) $time[$cnt]=$tok;
               if ($arr["otch"]==5 && $ct==3) $time[$cnt]=$tok;
               $ar[$ct]=$tok;
       	       $tok=strtok ("-: \n");
               $ct++;}                   
              if ($tim!=$uy[3])
                 {
                  $cnt++;
                  $tim=$uy[3];
                 }
              if ($cnt>30) $l=1000;
            }
        }
    }
//-------------------------------------------------------------------
// Create the graph. These two calls are always required
$graph = new Graph(900,400,"auto");	
$graph->SetScale("textlin");
$graph->SetShadow();

// Create the linear plot
if ($arr["source"]==0)
   {
    $lineplot=new LinePlot($data0);
    $lineplot2=new LinePlot($data1);
    $lineplot3=new LinePlot($data2);
    $lineplot4=new LinePlot($data3);
    $graph->SetY2Scale("lin");
   }
if ($arr["source"]==1 || $arr["source"]==2 || $arr["source"]==3 || $arr["source"]==7)
   {
    $lineplot=new LinePlot($data0);
   }
if ($arr["source"]==4 || $arr["source"]==5 || $arr["source"]==6)
   {
    $lineplot=new LinePlot($data0);
    $lineplot2=new LinePlot($data1);
    $lineplot3=new LinePlot($data2);
    $graph->SetY2Scale("lin");
   }
// Add the plot to the graph
$graph->img->SetMargin(50,50,20,40);
//----------- title --------------------
if ($arr["source"]==0)
	{
	 $graph->title->Set("���������������� ����");
         $graph->yaxis->title->Set("T1,C T2,C M1,� M2,�");

	 $graph->AddY2($lineplot);
	 $graph->AddY2($lineplot2);
	 $graph->Add($lineplot3);
	 $graph->Add($lineplot4);
	}
if ($arr["source"]==1)
	{
	 $graph->title->Set("�������� �������");
         $graph->yaxis->title->Set("W,���");
	 $graph->Add($lineplot);
        }
if ($arr["source"]==2)
	{
	 $graph->title->Set("�������-�������� ����");
         $graph->yaxis->title->Set("V,m3");
	 $graph->Add($lineplot);
        }
if ($arr["source"]==3)
	{
	 $graph->title->Set("������� ���");
         $graph->yaxis->title->Set("V,m3");
	 $graph->Add($lineplot);
        }
if ($arr["source"]==4)
	{
	 $graph->title->Set("��������� ���");
         $graph->yaxis->title->Set("M,kg T,C P,MPa");
	 $graph->AddY2($lineplot);
	 $graph->AddY2($lineplot2);
	 $graph->Add($lineplot3);
        }
if ($arr["source"]==5)
	{
	 $graph->title->Set("������ ������");
         $graph->yaxis->title->Set("V,�3 T,C P,MPa");
	 $graph->AddY2($lineplot);
	 $graph->AddY2($lineplot2);
	 $graph->Add($lineplot3);
        }
if ($arr["source"]==6)
	{
	 $graph->title->Set("��������");
         $graph->yaxis->title->Set("V,�3 T,C P,MPa");
	 $graph->AddY2($lineplot);
	 $graph->AddY2($lineplot2);
	 $graph->Add($lineplot3);
        }
if ($arr["source"]==7)
	{
	 $graph->title->Set("������������� �������");
         $graph->yaxis->title->Set("W,���");
	 $graph->Add($lineplot);
        }
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 

if ($arr["source"]==0)
   {
    $lineplot->SetColor("blue");
    $lineplot->SetWeight(1);
    $lineplot2->SetColor("orange");
    $lineplot2->SetWeight(1);
    $lineplot3->SetColor("black");
    $lineplot3->SetWeight(1);
    $lineplot4->SetColor("red");
    $lineplot4->SetWeight(1);
   }
if ($arr["source"]==1 || $arr["source"]==2 || $arr["source"]==3 || $arr["source"]==7)
   {
    $lineplot->SetColor("blue");
    $lineplot->SetWeight(1);
   }
if ($arr["source"]==4 || $arr["source"]==5 || $arr["source"]==6)
   {
    $lineplot->SetColor("blue");
    $lineplot->SetWeight(1);
    $lineplot2->SetColor("orange");
    $lineplot2->SetWeight(1);
    $lineplot3->SetColor("black");
    $lineplot3->SetWeight(1);
   }
$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($time);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
if ($arr["source"]==0)
   {
    $lineplot->SetLegend("����������� ���. (�1,�)");
    $lineplot2->SetLegend("����������� ���. (�2,�)");
    $lineplot3->SetLegend("������ ���. (M1,�)");
    $lineplot4->SetLegend("������ ���. (M2,�)");
   }
if ($arr["source"]==1)
   {
    $lineplot->SetLegend("�������� ������� (W,���)");
   }
if ($arr["source"]==2)
   {
    $lineplot->SetLegend("������ ���� (V,�3)");
   }
if ($arr["source"]==3)
   {
    $lineplot->SetLegend("������ ���� (V,�3)");
   }
if ($arr["source"]==4)
   {
    $lineplot->SetLegend("�������� (P,���)");
    $lineplot2->SetLegend("����������� (�,�)");
    $lineplot3->SetLegend("������ (M,��)");
   }
if ($arr["source"]==5 || $arr["source"]==6)
   {
    $lineplot->SetLegend("�������� (P,���)");
    $lineplot2->SetLegend("����������� (�,�)");
    $lineplot3->SetLegend("������ (V,�3)");
   }
if ($arr["source"]==7)
   {
    $lineplot->SetLegend("�������� (W,���)");
   }
//--------------------------------------
// Display the graph
$graph->Stroke();
}
//print $arr["source"];
//for ($i=0;$i<30;$i++) print $data0[$i];
//for ($i=0;$i<30;$i++) print $time[$i];
?>