<script>
$(document).ready(function() {
	initTable();
	setInterval(function () {
		$.ajax({
			url: "<?php echo base_url(); ?>assets/json/kurs.json",
			cache: false,
			dataType: "json",
			success: updateTableRow
		});
	}, 3000);
	
	function initTable() {
		$('#kurs').html(
		"<table id=\"kursTable\" class=\"table table-striped table-bordered table-bordedown table-condensed\">" +
			"<tr>" +
				"<th width='15%'>Currency</th>" +
				"<th width='14%'>Bid</th>" +
				"<th width='14%'>Ask</th>" +
				"<th width='14%'>High Bid</th>" +
				"<th width='14%'>Low Bid</th>" +
				"<th width='14%'>High Ask</th>" +
				"<th width='14%'>Low Ask</th>" +
			"</tr>" +
		"</table>");
	}
	
	function updateTableRow(data) {
		$.each(data.rates, function(i,item){
			if(item.currency.substr(-3).toUpperCase() == "IDR" && item.currency.length != 3){
				if ($("#currency-" + item.currency).length){
					updateRowValue(item.currency, item.bid, item.ask, item.highBid, item.lowBid, item.highAsk, item.lowAsk, item.fixed);
				} else {
					addRowValue(item.currency, item.bid, item.ask, item.highBid, item.lowBid, item.highAsk, item.lowAsk, item.fixed);
				}
			}
		});
		updateStaleStatus(data.stale);
		updateHolidayStatus(data.isHoliday);
		$('#loading').html('&nbsp');
	}

	function updateStaleStatus($stale){
		if($stale == true) $('#staleness').html("<font color='down'><b>SERVER ISSUE: DATA NOT ACTUAL</b></font>");
		else $('#staleness').html('&nbsp');
	}
	
	function updateHolidayStatus($isHoliday){
		if($isHoliday == true) $('#staleness').html("<font color='down'><b>HOLIDAY</b></font>");
	}
	

	function updateRowValue($currency, $bid, $ask, $highBid, $highAsk, $lowBid, $lowAsk, $fixed) {
		$lastAsk = $('#ask-hidden-' + $currency).html();
		$lastBid = $('#bid-hidden-' + $currency).html();

		
		$('#ask-' + $currency).html(formatDollar($ask, $fixed));
		$('#highask-' + $currency).html(formatDollar($highAsk, $fixed));
		$('#lowask-' + $currency).html(formatDollar($lowAsk, $fixed));
		$('#bid-' + $currency).html(formatDollar($bid, $fixed));
		$('#highbid-' + $currency).html(formatDollar($highBid, $fixed));
		$('#lowbid-' + $currency).html(formatDollar($lowBid, $fixed));
		$('#currency-' + $currency).html($currency);
		
		if($ask > $lastAsk){
			$('#ask-' + $currency).html("<img src='<?php echo base_url(); ?>assets/img/up.png' style='float:left;'> " + formatDollar($ask, $fixed));
		}
		if($ask < $lastAsk){
			$('#ask-' + $currency).html("<img src='<?php echo base_url(); ?>assets/img/down.png' style='float:left;'> " + formatDollar($ask, $fixed));
		}
		console.log($currency + ' '  + $bid + ' ' + $lastBid);
		if($bid > $lastBid){
			console.log('naik');
			$('#bid-' + $currency).html("<img src='<?php echo base_url(); ?>assets/img/up.png' style='float:left;'> " + formatDollar($bid, $fixed));
		}
		if($bid < $lastBid){
			$('#bid-' + $currency).html("<img src='<?php echo base_url(); ?>assets/img/down.png' style='float:left;'> " + formatDollar($bid, $fixed));
		}

		$('#bid-hidden-' + $currency).html($bid);
		$('#ask-hidden-' + $currency).html($ask);
	}
	
	function addRowValue($currency, $bid, $ask, $highBid, $highAsk, $lowBid, $lowAsk, $fixed) {
		$('#kursTable tr:last').after(
				"<tr>" + 
					"<td id='currency-" + $currency +"'>" + $currency + "</td>" +
					"<td style='text-align:right;' id='bid-" + $currency +"'>" + formatDollar($bid, $fixed) + "</td>" +
					"<td style='text-align:right;' id='ask-" + $currency +"'>" + formatDollar($ask, $fixed) + "</td>" +
					"<td style='text-align:right;' id='highbid-" + $currency +"'>" + formatDollar($highBid, $fixed) + "</td>" +
					"<td style='text-align:right;' id='highask-" + $currency +"'>" + formatDollar($highAsk, $fixed) + "</td>" +
					"<td style='text-align:right;' id='lowbid-" + $currency +"'>" + formatDollar($lowBid, $fixed) + "</td>" +
					"<td style='text-align:right;' id='lowask-" + $currency +"'>" + formatDollar($lowAsk, $fixed) + "</td>" +
					"<td style='text-align:right; display:none;' id='bid-hidden-" + $currency +"'>" + $bid + "</td>" +
					"<td style='text-align:right; display:none;' id='ask-hidden-" + $currency +"'>" + $ask + "</td>" +
				"</tr>");
	}
});
</script>
<div id='staleness'>&nbsp</div>
<span id='kurs'></span>
<span id='loading'><div class="progress progress-info progress-striped active"><div class="bar" style="width:100%;">Loading...</div></div></span>