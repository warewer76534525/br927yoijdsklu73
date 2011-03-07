<?php // content="text/plain; charset=utf-8"
	require_once ('./assets/lib/graph/jpgraph.php');
	require_once ('./assets/lib/graph/jpgraph_line.php');

	$datay1 = array(20.5 ,15, 23, 15, 17.5, 20.3, 15);

	// Setup the graph
	$graph = new Graph(500,300);
	$graph->SetMargin(40,30,40,120);
	$graph->SetScale("textlin");

	$theme_class=new UniversalTheme;

	$graph->SetTheme($theme_class);
	$graph->img->SetAntiAliasing(false);
	$graph->title->Set('Graph Kurs');
	$graph->subtitle->Set('USD');
	$graph->xaxis->title->Set('Day');
	$graph->yaxis->title->Set('value');
	$graph->SetBox(false);

	$graph->img->SetAntiAliasing();

	$graph->yaxis->HideZeroLabel();
	$graph->yaxis->HideLine(false);
	$graph->yaxis->HideTicks(false,false);

	$graph->xgrid->Show();
	$graph->xgrid->SetLineStyle("solid");
	$graph->xaxis->SetTickLabels(array('Senin','Selasa','Rabu','Kamis', 'Jumat', 'Sabtu', 'Minggu'));
	$graph->xgrid->SetColor('#E3E3E3');

	// Create the first line
	$p1 = new LinePlot($datay1);
	$graph->Add($p1);
	$p1->SetColor("#6495ED");
	$p1->value->Show();
	$p1->SetLegend('Kurs USD');

	$graph->legend->SetFrameWeight(1);

	$graph_temp_directory = 'temp';  // in the webroot (add directory to .htaccess exclude)
	$graph_file_name = 'test.png';    
	
	$graph_file_location = $graph_temp_directory . '/' . $graph_file_name;

	if (file_exists($graph_file_location))
	{
	   unlink($graph_file_location);
	}
			
	$graph->Stroke('./'.$graph_file_location);  // create the graph and write to file
?>
<img src="<?= base_url(). "$graph_file_location"?>"/>

