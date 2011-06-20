<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jpgraph{

	function __construct()
	{
		require_once ('./assets/jpgraph/jpgraph.php');
		require_once ('./assets/jpgraph/jpgraph_line.php');
		require_once ('./assets/jpgraph/jpgraph_date.php');
	}
	
	function create($start, $end, $bid, $ask, $date, $time_align="day", $maxs=100, $mins=0)
	{
		// Create the new graph
		$graph = new Graph(540,300);
		 
		// Slightly larger than normal margins at the bottom to have room for
		// the x-axis labels
		$graph->SetMargin(40,40,30,130);
		 
		// Fix the Y-scale to go between [0,100] and use date for the x-axis
		$graph->SetScale('datlin',$mins,$maxs);
		$graph->title->Set("Kurs Chart");
		 
		// Set the angle for the labels to 90 degrees
		$graph->xaxis->SetLabelAngle(90);

		if($time_align == "day"){
			$scale_ticks = 3600;

			// Adjust the start/end to a specific alignment
			$graph->xaxis->scale->SetTimeAlign(HOURADJ_1);

			// The automatic format string for dates can be overridden
			$graph->xaxis->scale->SetDateFormat('H:i');
		}else if($time_align == "week"){
			$scale_ticks = 24*3600;

			// Adjust the start/end to a specific alignment
			$graph->xaxis->scale->SetTimeAlign(DAYADJ_1);

			$graph->xaxis->SetLabelFormatString('d, M, Y',true);
		}else if($time_align == "month"){
			$scale_ticks = 5*24*3600;

			// Adjust the start/end to a specific alignment
			$graph->xaxis->scale->SetTimeAlign(DAYADJ_1);

			$graph->xaxis->SetLabelFormatString('d, M, Y',true);
		}else{
			$scale_ticks = 10*24*3600;

			// Adjust the start/end to a specific alignment
			$graph->xaxis->scale->SetTimeAlign(DAYADJ_1);

			$graph->xaxis->SetLabelFormatString('d, M, Y',true);
		}

		// Adjust the time interval
		$graph->xaxis->scale->ticks->Set($scale_ticks);
		 
		$line[0] = new LinePlot($bid,$date);
		$line[1] = new LinePlot($ask,$date);
		//$line->SetLegend('Year 2005');
		//$line->SetFillColor('lightblue@0.5');
		$graph->Add($line);

		$graph_temp_directory = 'temp';  // in the webroot (add directory to .htaccess exclude)
		$graph_file_name = 'test.png';    
		
		$graph_file_location = $graph_temp_directory . '/' . $graph_file_name;

		if (file_exists($graph_file_location))
		{
		   unlink($graph_file_location);
		}
				
		$graph->Stroke('./'.$graph_file_location);  // create the graph and write to file

		return "<img src = '".base_url().$graph_file_location."'>";
	}

	function create_graph()
	{
		// Create a data set in range (50,70) and X-positions
		DEFINE('NDATAPOINTS',50);//360
		DEFINE('SAMPLERATE',240); 
		$start = time();
		$end = $start+NDATAPOINTS*SAMPLERATE;
		$data = array();
		$xdata = array();
		for( $i=0; $i < NDATAPOINTS; ++$i ) {
			$data[1][$i] = rand(30,100);
			$data[2][$i] = rand(20,70);
			$xdata[$i] = $start + $i * SAMPLERATE;
		}

		/*echo "<pre>";
		print_r($data);
		echo "</pre>";

		echo "<pre>";
		print_r($xdata);
		echo "</pre><br><br>";*/
		 
		 
		// Create the new graph
		$graph = new Graph(540,300);
		 
		// Slightly larger than normal margins at the bottom to have room for
		// the x-axis labels
		$graph->SetMargin(40,40,30,130);
		 
		// Fix the Y-scale to go between [0,100] and use date for the x-axis
		$graph->SetScale('datlin',0,100);
		$graph->title->Set("Kurs Chart");
		 
		// Set the angle for the labels to 90 degrees
		$graph->xaxis->SetLabelAngle(45);
		 
		// The automatic format string for dates can be overridden
		$graph->xaxis->scale->SetDateFormat('H:i');
		 
		// Adjust the start/end to a specific alignment
		$graph->xaxis->scale->SetTimeAlign(HOURADJ_1);

		// Adjust the time interval
		$graph->xaxis->scale->ticks->Set(3600);
		 
		$line[0] = new LinePlot($data[1],$xdata);
		$line[1] = new LinePlot($data[2],$xdata);
		//$line->SetLegend('Year 2005');
		//$line->SetFillColor('lightblue@0.5');
		$graph->Add($line);

		$graph_temp_directory = 'temp';  // in the webroot (add directory to .htaccess exclude)
		$graph_file_name = 'test.png';    
		
		$graph_file_location = $graph_temp_directory . '/' . $graph_file_name;

		if (file_exists($graph_file_location))
		{
		   unlink($graph_file_location);
		}
				
		$graph->Stroke('./'.$graph_file_location);  // create the graph and write to file

		return $graph_file_location;
	}

	function graph()
	{ 
		require_once ('./assets/jpgraph/jpgraph.php');
		require_once ('./assets/jpgraph/jpgraph_line.php');

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

		return $graph_file_location;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/home.php */