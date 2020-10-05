<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_line.php");

$ydata = array(3,3,8,12,5,1);
$ydata2 = array(13,19,15,17,22,14);
$datax = array("12.06","13.06","14.06","15.06","16.06","17.06");

// Create the graph. These two calls are always required
$graph = new Graph(240,130,"auto");	
$graph->SetScale("textlin");
//$graph->SetMarginColor("black");

// Create the linear plot
$lineplot=new LinePlot($ydata);

$lineplot2=new LinePlot($ydata2);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->Add($lineplot2);

$graph->img->SetMargin(40,20,20,40);
$graph->title->Set("Пожарно-питьевая вода");
$graph->yaxis->title->Set("V,м3");

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

$lineplot->SetColor("blue");
$lineplot->SetWeight(2);

$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

$graph->yaxis->SetWeight(1);
$graph->SetShadow();
$graph->xaxis->SetTickLabels($datax);

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,7);
$lineplot->SetLegend("V,м3");
$lineplot2->SetLegend("Т,С");

// Display the graph
$graph->Stroke();
?>