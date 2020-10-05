<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_pie.php");
include ("../../../jpgraph/jpgraph_pie3d.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$source=1+$arr["source"];
$x=0;
$source=$arr["source"];
$year=''.$arr["year"];
$month=''.$arr["month"];

$armfile="../tmp/".$arr["month"]."arend.htm";
$fp1=fopen($armfile,"w");

$query = 'SELECT * FROM buyers';
$r = mysql_query ($query,$i);
for ($m=1;$m<=50;$m++)
    {
     $uo = mysql_fetch_row ($r);
     if ($uo == true) 
	{
	 $data[$x]=0;
	 $name_k[$x]=$uo[1];
	 $tmaxx=$name_k[$x].' <br>';
	 $arfile="../tmp/".$arr["month"]."arend".$uo[0].".htm";
	 $fp=fopen($arfile,"w");

         //$ffile="../tmp/pie".$uo[0].".htm";
         //$fp=fopen($ffile,"w");

         $query = 'SELECT * FROM energy_supply WHERE id!=0 AND id!=3';
	 //echo $query."<br>";         
         $v = mysql_query ($query,$i);
         for ($b=1;$b<=10;$b++)
             {
              $uv = mysql_fetch_row ($v);
              if ($uv == true)
        	 {
		  $cost=$uv[3];
		  $source=$uv[2];
	 	  //echo $uv[1].'='.$cost."<br>";
		  //$info2=$uv[1].' ('.$cost.' руб. за еденицу измерения) <br>';	
		  //fwrite ($fp,$info2);
		  $data0[$x]=0;
                  if ($uv[2]==7) 
   	     	     {
	      	      $arr["otch"]=4; $sour=7;
	              $arr["idbuy"]=$uo[0];
		      $source++;
	              include ("../inc/method_el1.inc");
		      $source--;
//	              $data[$x]=$data[$x]+$cost*$data0[$x];
		      //echo 'elect['.$x.']='.$cost*$data0[$x].'<br>';
	     	     }
        	  else
		     {
	              $voda=0;
	              if ($uv[2]==2) 
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
		         //echo 'voda['.$x.']='.$voda.'<br>';
			 //$info2=$info2.'<br><b>'.$uu[2].'</b>';
       			 //if ($voda>0) $info2=$info2.'<br>Количество работающих человек = '.$uy[0].'<br> Норма потребления = 0.012 <br> Итого потреблено по корпусу на бытовые нужды = '.$voda.'<br>';
			 //fwrite ($fp,$info2);
        	 	} 			
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
		  	 	if ($uy == true && $uy[0]>0) $K=$uy[0]; else $K=0;
			 	$arr["otch"]=4; $jpgg=88;
			 	$source++; $sour--;
			 	include ("../inc/method_req.inc");
			 	$source--;
		         	if ($K>0)
		      	    	   {                
		             	    $month=''.$arr["month"];
                	     	    $query = 'SELECT * FROM data WHERE type=4 AND (date='.$arr["year"].$month.'01000000 OR date='.$arr["year"].$month.'01120000) AND korp='.$uu[1].' AND source='.$source;
                	     	    $a = mysql_query ($query,$i);
                	     	    //echo $query."<br>";
		             	    if ($a)
                	     	    for ($l=1;$l<=10;$l++)		   
		                                 	{
  	  	   	          	 $uy = mysql_fetch_row ($a);
  	  	   	          	 if ($uy == true)
  	  	   	             	    {		
					     //echo $uy[7].'<br>';
                		      	     if ($source==1)
		        	          	 if (strstr ($uy[1],'тепловой энергии')) { $data0[$x]=$data0[$x]+$uy[7]*$K; }
		        	     	     if ($source==2) { $data0[$x]=$data0[$x]+$uy[7]*$K;  }
                		      	     if ($source==4)
                         		   	if (strstr ($uy[1],'массы')) { $data0[$x]=$data0[$x]+$uy[7]*$K; }
		        	      	     if ($source==5)
				           	if (strstr ($uy[1],'объема')) { $data0[$x]=$data0[$x]+$uy[7]*$K; }
		        	      	     if ($source==6)
                		           	if (strstr ($uy[1],'объема'))  { $data0[$x]=$data0[$x]+$uy[7]*$K; }
                		      	     if ($source==7) { $data0[$x]=$data0[$x]+$uy[7]*$K; }
					    }
					}
				    //$info2=$uu[2].'='.$data0[$x].'<br>';
				    //fwrite ($fp,$info2);
                	           }
				//echo $data0[$x].'<br>';
			      }
 	     		  }
		     }
		  $data[$x]=$data[$x]+$cost*$data0[$x];
		  $strr="<font class=or1>[".$name_k[$x]."] ".$uv[1]." (".$cost."x".$data0[$x].") <b>".$cost*$data0[$x]."</b><br></font>";
		  $tmaxx=$tmaxx.">".$uv[1]." (".round($data0[$x],2)." x ".$cost."руб.) <b>".round($cost*$data0[$x],2)."р.</b><br> ";
		  fwrite ($fp,$strr);
	       	  //echo $uv[1].' > '.$cost*$data0[$x].'('.$cost.'/'.$data0[$x].') '.$data[$x]."<br>";
		 }
	     }
         fwrite  ($fp,"<font class=or1>Итого: <b>".$data[$x]."</b></font>");
	 if ($data[$x]>$max) { $maxx=$tmaxx; $max=$data[$x]; }
	 if ($data[$x]>0)
	 if ($source==7) 
	     fwrite ($fp1,"<font class=or1>".$name_k[$x]." ".ceil($data[$x])."руб.</font><a href=\"tmp/".$arr["month"]."arend".$uo[0].".htm\"><font class=dd>  подробнее >></font></a><br>");
	 else
	     fwrite ($fp1,"<font class=or1>".$name_k[$x]." ".ceil($data[$x])."руб.</font><a href=\"tmp/".$arr["month"]."arend".$uo[0].".htm\"><font class=dd>  подробнее >></font></a><br>");
       	 //echo $name_k[$x].' | '.$data[$x].'('.$cost.'/'.$data0[$x].')'."<br>";
 	 if ($source==2) $data[$x]=$data[$x]+$voda;
	 if ($data[$x]>0) { $name_k[$x]=$uo[1]; $x++; }
         fclose($fp);
	 //fclose ($fp2);
        }
    }
fclose ($fp1);
$armfile="../tmp/".$month."maxx.htm";
$fp1=fopen($armfile,"w");
fwrite ($fp1,$maxx);
fclose ($fp1);

// Create the Pie Graph. 
$graph = new PieGraph(550,400,"auto");
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