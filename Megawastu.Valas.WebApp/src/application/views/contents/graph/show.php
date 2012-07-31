<script type="text/javascript">
	$(function() {
		var seriesOptions = [],
		yAxisOptions = [],
		seriesCounter = 0,
		names = ['Ask', 'Bid'],
		colors = Highcharts.getOptions().colors;

		$.each(names, function(i, name) {
			$.getJSON('<?php echo base_url(); ?>index.php/api/rates/<?php echo $currency; ?>/'+name.toLowerCase()+'?callback=?', function(data) {
				seriesOptions[i] = {
					name: name,
					data: data
				};
				seriesCounter++;
				if (seriesCounter == names.length) {
					createChart();
				}
			});
		});

	// create the chart when all data is loaded
		function createChart() {
			chart = new Highcharts.StockChart({
				chart: {
					renderTo: 'container'
				},
				rangeSelector: {
					selected: 0,
					buttons: [{
						type: 'day',
						count: 1,
						text: '1d'
					}, {
						type: 'week',
						count: 1,
						text: '1w'
					}, {
						type: 'month',
						count: 1,
						text: '1m'
					}, {
						type: 'month',
						count: 3,
						text: '3m'
					}, {
						type: 'month',
						count: 6,
						text: '6m'
					}],
				},
				tooltip: {
					pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b><br/>',
					valueDecimals: 2
				},
				series: seriesOptions
			});
		}
	});
</script>

<script src="<?php echo base_url()?>assets/js/highstock.js"></script>
<script src="<?php echo base_url()?>assets/js/modules/exporting.js"></script>

<div id="container" style="height: 500px; min-width: 600px"></div>