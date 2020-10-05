<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_line.php");

$ydata = array(11,3,8,12,5,1,9,13,5,7);
$ydata2 = array(1,19,15,7,22,14,5,9,21,13);
$datax = array("Jan","Feb","Mar","Apr","Maj","Jun","Jul","Aug","Sep","Oct");

// Create the graph. These two calls are always required
$graph = new Graph(240,100,"auto");	
$graph->SetScale("textlin");
//$graph->SetMarginColor("black");

// Create the linear plot
$lineplot=new LinePlot($ydata);

$lineplot2=new LinePlot($ydata2);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);

$graph->img->SetMargin(40,20,20,40);
$graph->title->Set("Электроэнергия");
$graph->yaxis->title->Set("W,кВт");

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

$graph->yaxis->SetColor("red");
$graph->yaxis->SetWeight(2);
$graph->SetShadow();
$graph->xaxis->SetTickLabels($datax);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$lineplot->SetLegend("Субъект 1");
$lineplot2->SetLegend("Субъект 2");

// Display the graph
$graph->Stroke();
?>