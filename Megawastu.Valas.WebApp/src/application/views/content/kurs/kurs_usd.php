<?php $basurl = base_url(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/mobile_style.css" />
<script src="<?php echo base_url(); ?>assets/scripts/jquery-1.4.4.js"></script>
<script>
$(document).ready(function() {
	initTable();
	setInterval(function () {
		$.ajax({
			url: "<?php echo $basurl; ?>assets/json/kurs.json",
			cache: false,
			dataType: "json",
			success: updateTableRow
		});
	}, 3000);
	
	function initTable() {
		$('#kurs').html(
		"<table id='kursTable' border = '0' cellspacing='1' cellpadding='2'>" +
			"<tr class = 'lightheader'>" +
				"<td><b><font color='#FFFFFF'>CURRENCY</FONT></b>" +
				"<td width='15%'><b><font color='#FFFFFF'>ASK</FONT></b></td>" +
				"<td width='15%'><b><font color='#FFFFFF'>HIGH ASK</FONT></b></td>" +
				"<td width='15%'><b><font color='#FFFFFF'>LOW ASK</FONT></b></td>" +
				"<td width='15%'><b><font color='#FFFFFF'>BID</FONT></b></td>" +
				"<td width='15%'><b><font color='#FFFFFF'>HIGH BID</FONT></b></td>" +
				"<td width='15%'><b><font color='#FFFFFF'>LOW BID</FONT></b></td>" +
				"</td>" +
			"</tr>" +
		"</table>");
	}
	
	function updateTableRow(data) {
		$.each(data.rates, function(i,item){
			if(item.currency.substr(-3).toUpperCase() != "IDR" || item.currency.toUpperCase() == "IDR"){
				if ($("#currency-" + item.currency).length){
					updateRowValue(item.currency, item.ask, item.bid, item.highAsk, item.highBid, item.lowAsk, item.lowBid);
				} else {
					addRowValue(item.currency, item.ask, item.bid, item.highAsk, item.highBid, item.lowAsk, item.lowBid);
				}
			}
		});
		updateStaleStatus(data.stale);
	}

	function updateStaleStatus($stale){
		if($stale == "true") $('#staleness').html("<font color='red'><b>SERVER ISSUE: DATA NOT ACTUAL</b></font>");
		else $('#staleness').html('&nbsp');
	}
	
	function updateRowValue($currency, $ask, $bid, $highAsk, $highBid, $lowAsk, $lowBid) {
		$lastAsk = $('#ask-' + $currency).html();
		$lastBid = $('#bid-' + $currency).html();
		$lastHighAsk = $('#highask-' + $currency).html();
		$lastHighBid = $('#highbid-' + $currency).html();
		$lastLowAsk = $('#lowask-' + $currency).html();
		$lastLowBid = $('#lowbid-' + $currency).html();
		
		$('#ask-' + $currency).html($ask);
		$('#highask-' + $currency).html($highAsk);
		$('#lowask-' + $currency).html($lowAsk);
		$('#bid-' + $currency).html($bid);
		$('#highbid-' + $currency).html($highBid);
		$('#lowbid-' + $currency).html($lowBid);
		$('#currency-' + $currency).html($currency);
		
		if($ask > $lastAsk){
			$("<img src='<?php echo $basurl; ?>assets/img/blue.png'>").appendTo('#ask-' + $currency);
		}
		if($ask < $lastAsk){
			$("<img src='<?php echo $basurl; ?>assets/img/red.png'>").appendTo('#ask-' + $currency);
		}
		if($highAsk > $lastHighAsk){
			$("<img src='<?php echo $basurl; ?>assets/img/blue.png'>").appendTo('#highask-' + $currency);
		}
		if($highAsk < $lastHighAsk){
			$("<img src='<?php echo $basurl; ?>assets/img/red.png'>").appendTo('#highask-' + $currency);
		}
		if($lowAsk > $lastLowAsk){
			$("<img src='<?php echo $basurl; ?>assets/img/blue.png'>").appendTo('#lowask-' + $currency);
		}
		if($lowAsk < $lastLowAsk){
			$("<img src='<?php echo $basurl; ?>assets/img/red.png'>").appendTo('#lowask-' + $currency);
		}
		if($bid > $lastBid){
			$("<img src='<?php echo $basurl; ?>assets/img/blue.png'>").appendTo('#bid-' + $currency);
		}
		if($bid < $lastBid){
			$("<img src='<?php echo $basurl; ?>assets/img/red.png'>").appendTo('#bid-' + $currency);
		}
		if($highBid > $lastHighBid){
			$("<img src='<?php echo $basurl; ?>assets/img/blue.png'>").appendTo('#highbid-' + $currency);
		}
		if($highBid < $lastHighBid){
			$("<img src='<?php echo $basurl; ?>assets/img/red.png'>").appendTo('#highbid-' + $currency);
		}
		if($lowBid > $lastLowBid){
			$("<img src='<?php echo $basurl; ?>assets/img/blue.png'>").appendTo('#lowbid-' + $currency);
		}
		if($lowBid < $lastLowBid){
			$("<img src='<?php echo $basurl; ?>assets/img/red.png'>").appendTo('#lowbid-' + $currency);
		}
	}
	
	function addRowValue($currency, $ask, $bid, $highAsk, $highBid, $lowAsk, $lowBid) {
		$('#kursTable tr:last').after(
				"<tr class = 'light'>" + 
					"<td id='currency-" + $currency +"'>" + $currency + "</td>" +
					"<td id='ask-" + $currency +"'>" + $ask + "</td>" +
					"<td id='highask-" + $currency +"'>" + $highAsk + "</td>" +
					"<td id='lowask-" + $currency +"'>" + $lowAsk + "</td>" +
					"<td id='bid-" + $currency +"'>" + $bid + "</td>" +
					"<td id='highbid-" + $currency +"'>" + $highBid + "</td>" +
					"<td id='lowbid-" + $currency +"'>" + $lowBid + "</td>" +
				"</tr>");
	}
});

</script>
<div id='staleness'>&nbsp</div>
<BR/>
<span id='kurs'></span>
