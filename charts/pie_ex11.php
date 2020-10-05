<?php
include ("../../../jpgraph/jpgraph.php");
include ("../../../jpgraph/jpgraph_pie.php");

// Some data
$data = array(10,23,67);

// Create the Pie Graph. 
$graph = new PieGraph(240,100,"auto");
$graph->SetShadow();

// Set A title for the plot
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
//$graph->title->Set("Дочки");

// Create
$p1 = new PiePlot($data);
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
$p1->SetLegends(array("Объект А","Объект Б","Объект В"));
$p1->SetCenter(0.3,0.5);
$graph->Add($p1);
$graph->Stroke();

?>


