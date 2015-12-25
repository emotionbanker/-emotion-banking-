<?php 

include ("../src/jpgraph.php");
include ("../src/jpgraph_bar.php");
include ("../src/jpgraph_line.php");

include ("../src/jpgraph_pie.php");
include ("../src/jpgraph_pie3d.php");
// Some data
$data = array(40,21,17);

// Create the Pie Graph. 
$graph = new PieGraph(500,500);

$theme_class="DefaultTheme";
//$graph->SetTheme(new $theme_class());

// Set A title for the plot
$graph->title->Set("Sparkasse Mecklenburg");
$graph->SetBox(true);

// Create
$p1 = new PiePlot($data);
$graph->Add($p1);

$p1->ShowBorder();
$p1->SetColor('black');
$p1->SetSliceColors(array('#1E90FF','#2E8B57','#ADFF2F'));
$graph->Stroke();
?>