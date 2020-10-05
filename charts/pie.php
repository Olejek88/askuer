<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_pie.php");
include ("../../../jpgraph/jpgraph_pie3d.php");
include("../config/local.php");
$arr = get_defined_vars();
$today=getdate ();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
$x=0;
$source=$arr["source"];
$year=''.$arr["year"];
$month=''.$arr["month"];
$arr["month"]=$arr["month"]+0;
$month=$month+0;
if ($arr["month"]<10) $arr["month"]='0'.$arr["month"];
if ($month<10) $month='0'.$month;

$query = 'SELECT * FROM buyers';
$r = mysql_query ($query,$i);

if ($source<8)
for ($m=1;$m<=50;$m++)
    {
     $uo = mysql_fetch_row ($r);
     if ($uo == true) 
	{
	 //echo '['.$x.']'.$uo[1].'<br>';
         $data[$x]=0;
	 $data00[$x]=0;
         if ($source==7) 
	     {
	      $arr["otch"]=4; $sour=7;
	      $arr["idbuy"]=$uo[0];
	      $ffile="../tmp/pie".$uo[0].".htm";
	      $fp=fopen($ffile,"w");
		$source++;
	      include ("../inc/method_el1.inc");
		 $source--;
	      fclose($fp);
	      $data[$x]=$data0[$x];
//		 echo $uo[1].' '.$x.'='.$data[$x].' <br>';	      
	     }
         else
	     {
	      $voda=0;
	      if ($source==2) 
	    	 {
		  $query = 'SELECT caption FROM buyers WHERE idx='.$uo[0];
		  $a = mysql_query ($query,$i);
		  $uy = mysql_fetch_row ($a);

		  $query = 'SELECT * FROM people WHERE name=\''.$uy[0].'\'';
	          $a = mysql_query ($query,$i);
	          $uy = mysql_fetch_row ($a);
		  $per=0;
		  if ($uy == true) 
			for ($p=1;$p<=50;$p++) 
				if ($uy[$p]>0) $per=$per+$uy[$p];
		  //echo $query.'<br>';
		  //echo ' s='.$per.'<br>';
		  if ($uy == true)  $voda=$per * 0.012;
		  $voda=$voda*30;
        	 }
		// echo $uo[1].' <br>';
	      $data[$x]=0;
     	      $query = 'SELECT * FROM korp WHERE korp_id<99';
	      $t = mysql_query ($query,$i);
              for ($k=1;$k<=50;$k++)
             	  {
              	   $uu = mysql_fetch_row ($t);
              	   if ($uu == true)
                      {
                  	 $sour=$source+1;
	          	 $query = 'SELECT SUM(K'.$sour.') FROM obj WHERE type!=1 AND idbuy='.$uo[0].' AND idkorp='.$uu[1];
		  	 //echo $query.'<br>';
	          	 $a = mysql_query ($query,$i); 
		  	 $uy = mysql_fetch_row ($a); 
		  	 if ($uy == true && $uy[0]>0)  $K=$uy[0]; else $K=0;
			 $arr["otch"]=4; $jpgg=88; $data00[$x]=0;
			 $source++; $sour--;
			 include ("../inc/method_req.inc");
			 $source--;
			 //echo $K.' '.$data00[$x].'<br>';
		         if ($K>0)
		      	    {                		             
                             $today=getdate ();
                	     if ($today["year"]==$arr["year"] && $today["mon"]==$arr["month"]) 
			         {
				  $month=''.$arr["month"];
				  $query = 'SELECT * FROM data WHERE type=2 AND date>='.$arr["year"].$month.'01000000 AND korp='.$uu[1].' AND source='.$source;
				 }
			     else 
				{
			         //if ($arr["month"]>1) $month=$arr["month"]-1;
			         //else { $arr["month"]=$month=12; $arr["year"]--; }
				 
				 $month=''.$arr["month"];
				 $query = 'SELECT * FROM data WHERE type=4 AND (date='.$arr["year"].$month.'01000000 OR date='.$arr["year"].$month.'01120000) AND korp='.$uu[1].' AND source='.$source;
				}		             			     
                	     $a = mysql_query ($query,$i);
                	     //echo $query."<br>";
		             if ($a)
                	     for ($l=1;$l<=200;$l++)		   
                                 {
  	  	   	          $uy = mysql_fetch_row ($a);
  	  	   	          if ($uy == true)
  	  	   	             {				      
		        	      if ($source==0)
                	                 { 
                		          if (strstr ($uy[1],'масс') && strstr ($uy[1],'подающей')) $data[$x]=$uy[7]*$K;
                     	           	  if (strstr ($uy[1],'масс') && strstr ($uy[1],'обратной')) { $data[$x]=$data[$x]-$uy[7]*$K; $l=100; }
		               	         }
                		      if ($source==1)
		        	           if (strstr ($uy[1],'тепловой энергии')) { $data[$x]=$data[$x]+$uy[7]*$K; }
		        	      if ($source==2) { $data[$x]=$data[$x]+$uy[7]*$K;  }
                    		      if ($source==3) { $data[$x]=$data[$x]+$uy[7]*$K; }
                		      if ($source==4)
                         		   if (strstr ($uy[1],'массы')) { $data[$x]=$data[$x]+$uy[7]*$K; }
		        	      if ($source==5)
				           if (strstr ($uy[1],'объема')) { $data[$x]=$data[$x]+$uy[7]*$K; }
		        	      if ($source==6)
                		           if (strstr ($uy[1],'объема'))  { $data[$x]=$data[$x]+$uy[7]*$K; }
                		      if ($source==7) { $data[$x]=$data[$x]+$uy[7]*$K; }
                	             }
			         }
			      //echo $uu[2].' K='.$K.'x'.$data[$x].' - '.$data00[$x].' <br>';
			      $data[$x]=$data[$x]-$data00[$x]*$K;
  	  		     }
   	   	         }
		    }
 	     }
	 //echo $uo[1].' '.$x.'='.$data[$x].' <br>';
	 //$data[$x]=$data[$x]-$data00[$x];
	 if ($source==2) $data[$x]=$data[$x]+$voda;
	 //echo '-['.$x.']'.$uo[1].' '.$data[$x].'<br>';
	 if ($data[$x]>0) { $name_k[$x]=$uo[1]; /*echo '['.$x.']'.$uo[1].' '.$data[$x].'<br>';*/ $x++; }
        }
    }
// Create the Pie Graph. 
$graph = new PieGraph(700,500,"auto");
$graph->SetShadow();

// Set A title for the plot
$graph->title->SetFont(FF_ARIAL,FS_BOLD);

// Create
$p1 = new PiePlot3D($data);
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);

$p1->SetLegends($name_k);
$graph->legend->SetAbsPos(10,10);
$graph->img->SetMargin(50,50,20,40);
$p1->SetCenter(0.45,0.55);
$p1->SetSize(0.5);
$p1->SetStartAngle(45); 
$p1->SetAngle(50);
//$p1->SetGuideLines ();
//$p1->ExplodeSlice(1);
$p1->ExplodeAll(10);

$graph->Add($p1);
if ($data[0]>0) $graph->Stroke();
?>