<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_log.php");
include ("../../../jpgraph/jpgraph_line.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
$kor=0; $max=0;
//---------------------------------------------------------------------------
$query = 'SELECT * FROM korp';
$t = mysql_query ($query,$i);
for ($k=1;$k<=50;$k++)
    {
     $uu = mysql_fetch_row ($t);
     if ($uu == true)
        {
         $query = 'SELECT * FROM buyers';
         //echo $query."<br>";      		       
         $buycnt=0;
	 $y = mysql_query ($query,$i);
	 for ($j=1;$j<=50;$j++)
	     {	     
              $uo = mysql_fetch_row ($y);
	      if ($uo == true)
        	 {
                  $K=0; $x=0;
        	  $buyname[$buycnt]=$uo[1];
        	  // dly vseh buyerov etogo korpusa zapominat
	 	  $query = 'SELECT SUM(K'.$source.') FROM objects WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
  	          //echo $query."<br>";      		       
		  $a = mysql_query ($query,$i);
		  $uy = mysql_fetch_row ($a);		  	  
		  if ($uy == true && $uy[0]>0)  $K=$uy[0];                  
                  $yeap=0; $cnt=0;
                  if ($arr["otch"]==1) { $mx=23; $mn=0; }
                  if ($arr["otch"]==2) { $mx=31; $mn=1; }
                  if ($arr["otch"]==3) { $mx=30; $mn=1; }
                  if ($arr["otch"]==4) { $mx=12; $mn=1; }
                  if ($arr["otch"]==5) { $mx=23; $mn=0; }
 	          if ($arr["day"]>1) $day=$arr["day"]-1;
 	          if ($arr["month"]>1) $month=$arr["month"]-1;
 	          if ($month<10) $month='0'.$month; else $month=''.$month;
                  if ($K>0)
  	          for ($tm=$mn; $tm<=$mx; $tm++)
	              {
		       if ($arr["otch"]==1)
  		       if ($tm<10)
	                  {
	                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.'0'.$tm.'0000 AND korp='.$uu[4].' AND source='.$arr["source"];
	                   $dat=$day.'-'.$arr["month"].'-'.$arr["year"].' 0'.$tm.':00';
	                  }
                       else
                       	  {
                       	   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$day.$tm.'0000 AND korp='.$uu[4].' AND source='.$arr["source"];
	                   $dat=$day.'-'.$arr["month"].'-'.$arr["year"].' '.$tm.':00';
	                  }
	               if ($arr["otch"]==2)
  	               if ($tm<10)
  	                  {
  	                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.'0'.$tm.'000000 OR date='.$arr["year"].$month.'0'.$tm.'120000) AND korp='.$uu[4].' AND source='.$arr["source"];
                           $dat='0'.$tm.'-'.$month.'-'.$arr["year"].' 00:00';
                           $time[$x]='0'.$tm.'-'.$month.'-'.$arr["year"];
  	                  }
 	               else
 	                  {
 	                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$month.$tm.'000000 OR date='.$arr["year"].$month.$tm.'120000) AND korp='.$uu[4].' AND source='.$arr["source"];
                           $dat=$tm.'-'.$month.'-'.$arr["year"].' 00:00';
                           $time[$x]=$tm.'-'.$month.'-'.$arr["year"];
                          }
	               if ($arr["otch"]==3)
	                  {
                           $dat=$tm.'-'.$month.'-'.$arr["year"].' 00:00';
	                   if ($tm>20) { $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$tm.'000000 AND korp='.$uu[4].' AND source='.$arr["source"]; $tm=21;}
	                   else if ($tm>10) { $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND date='.$arr["year"].$arr["month"].$tm.'000000 AND korp='.$uu[4].' AND source='.$arr["source"]; $tm=11;}
	                   else { $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$arr["month"].$tm.'000000 OR date='.$arr["year"].$arr["month"].$tm.'120000) AND korp='.$uu[4].' AND source='.$arr["source"]; $tm=0;}
	                  }
	               if ($arr["otch"]==4)
	               if ($tm>9)
	                  {
	                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].$tm.'01000000 OR date='.$arr["year"].$tm.'01120000) AND korp='.$uu[4].' AND source='.$arr["source"];
    		           $dat='01-'.$tm.'-'.$arr["year"].' 00:00';
			   $time[$x]=''.$tm.'-'.$arr["year"];
	                  }
	               else
	                  {
	                   $query = 'SELECT * FROM data WHERE type='.$arr["otch"].' AND (date='.$arr["year"].'0'.$tm.'01000000 OR date='.$arr["year"].'0'.$tm.'01120000) AND korp='.$uu[4].' AND source='.$arr["source"];
      	                   $dat='01-0'.$tm.'-'.$arr["year"].' 00:00';
                           $time[$x]='0'.$tm.'-'.$arr["year"];
      		          }      
		       //echo $query."<br>";
                       //$time[$x]=$dat;
 		       //echo "[".$x."]=".$time[$x]."<br>";
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
			           if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$buycnt][$x]=$uy[7]*$K;
                                   if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$buycnt][$x]=$data[$buycnt][$x]-$uy[7]*$K; $l=100;}
                                  }
			       if ($uy[6]==1)
			          {
			           if (strstr ($uy[1],'тепловой энергии')) $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
      	      	                  }
			       if ($uy[6]==2)
			          {
			           $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
			          }
		 	       if ($uy[6]==3)
                                  {
			           $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
			          }
			       if ($uy[6]==4)
			          {
		                   if (strstr ($uy[1],'массы')) $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
			          }
			       if ($uy[6]==5)
                                  {
			           if (strstr ($uy[1],'объема')) $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
			          }
			       if ($uy[6]==6)
                                  {
			           if (strstr ($uy[1],'объема'))  $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
			          }
			       if ($uy[6]==7)
                      	          {
			           $data[$buycnt][$x]=$data[$buycnt][$x]+$uy[7]*$K;
			          }
                              }                           
                          }
                       $x++;
                      }
                  $buycnt++;
                 }
             }
        }
    }
//print $arr["source"];
//print 'dsd='.$buycnt;
//for ($i=0;$i<30;$i++) print $data[0][$i]."<br>";
//for ($i=0;$i<30;$i++) print $data[1][$i]."<br>";
//for ($i=0;$i<30;$i++) print $data[2][$i]."<br>";
//for ($i=0;$i<30;$i++) print $data[3][$i]."<br>";
//for ($i=0;$i<30;$i++) print $data[4][$i]."<br>";
//for ($i=0;$i<30;$i++) print $time[$i]."<br>";
//-------------------------------------------------------------------
// Create the graph. These two calls are always required
$graph = new Graph(900,400,"auto");	
$graph->SetScale("textlin");
$graph->SetShadow();

// Create the linear plot
for ($i=0;$i<15;$i++)
    {
     $hy=0;
     for ($j=0;$j<$mx;$j++)
     	{
     	 //print 'data['.$i.']['.$j.']='.$data[$i][$j]."<br>";
         if ($data[$i][$j]>0) $hy=1;
         else $data[$i][$j]=0;
	}
     if ($hy==1)
     	{
     	 $lineplot[$i]=new LinePlot($data[$i]);
     	}
    }
// Add the plot to the graph
$graph->img->SetMargin(50,50,20,40);
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
}
if ($arr["source"]==6)
{
 $graph->title->Set("Кислород");
}
if ($arr["source"]==7)
{
 $graph->title->Set("Электрическая энергия");
}

for ($i=0,$c=0;$i<15;$i++)
    {
     $hy=0;
     for ($j=0;$j<$mx;$j++)
     	{
     	 //print 'data['.$i.']['.$j.']='.$data[$i][$j]."<br>";
         if ($data[$i][$j]>0) $hy=1;
	}
     if ($hy==1)
     	{
         $graph->Add($lineplot[$i]);
         if ($c==0) $lineplot[$i]->SetColor("blue");
         if ($c==1) $lineplot[$i]->SetColor("black");
         if ($c==2) $lineplot[$i]->SetColor("red");
         if ($c==3) $lineplot[$i]->SetColor("green");
         if ($c==4) $lineplot[$i]->SetColor("purple");
         $c++;
         $lineplot[$i]->SetWeight(1);     
     	}
    }
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($time);
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$graph->legend->Pos(0.15,0.02);
//----------- legend -------------------
for ($i=0;$i<15;$i++)
    {
     $hy=0;
     for ($j=0;$j<$mx;$j++)
     	{
         if ($data[$i][$j]>0) $hy=1;
	}
     if ($hy==1)
     	{
//     	 print $buyname[$i];
         $lineplot[$i]->SetLegend($buyname[$i]);
     	}
    }
//--------------------------------------
// Display the graph
$graph->Stroke();
?>