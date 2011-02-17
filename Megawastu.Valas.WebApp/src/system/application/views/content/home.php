<script>
		$(document).ready(function() {
			initTable();
			setInterval(function () {
				$.ajax({
					url: "http://localhost/megawastu/json/kurs.json",
					cache: false,
					dataType: "json",
					success: updateTableRow
				});
			}, 3000);
			
			function initTable() {
				$('#kurs').html(
				"<table id='kursTable' border = '1' cellspacing='0' cellpadding='2'>" +
					"<tr>" +
						"<td width='15%'><b>ASK</b></td>" +
						"<td width='15%'><b>HIGH ASK</b></td>" +
						"<td width='15%'><b>LOW ASK</b></td>" +
						"<td width='15%'><b>BID</b></td>" +
						"<td width='15%'><b>HIGH BID</b></td>" +
						"<td width='15%'><b>LOW BID</b></td>" +
						"<td><b>CURRENCY</b>" +
						"</td>" +
					"</tr>" +
				"</table>");
			}
			
			function updateTableRow(data) {
				$.each(data.rates, function(i,item){
					if ($("#currency-" + item.currency).length){
						updateRowValue(item.currency, item.ask, item.bid, item.highAsk, item.highBid, item.lowAsk, item.lowBid);
					} else {
						addRowValue(item.currency, item.ask, item.bid, item.highAsk, item.highBid, item.lowAsk, item.lowBid);
					}
				});
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
					$("<font color = 'blue'><b> UP</b></font>").appendTo('#ask-' + $currency);
				}
				if($ask < $lastAsk){
					$("<font color = 'red'><b> DOWN</b></font>").appendTo('#ask-' + $currency);
				}
				if($highAsk > $lastHighAsk){
					$("<font color = 'blue'><b> UP</b></font>").appendTo('#highask-' + $currency);
				}
				if($highAsk < $lastHighAsk){
					$("<font color = 'red'><b> DOWN</b></font>").appendTo('#highask-' + $currency);
				}
				if($lowAsk > $lastLowAsk){
					$("<font color = 'blue'><b> UP</b></font>").appendTo('#lowask-' + $currency);
				}
				if($lowAsk < $lastLowAsk){
					$("<font color = 'red'><b> DOWN</b></font>").appendTo('#lowask-' + $currency);
				}
				if($bid > $lastBid){
					$("<font color = 'blue'><b> UP</b></font>").appendTo('#bid-' + $currency);
				}
				if($bid < $lastBid){
					$("<font color = 'red'><b> DOWN</b></font>").appendTo('#bid-' + $currency);
				}
				if($highBid > $lastHighBid){
					$("<font color = 'blue'><b> UP</b></font>").appendTo('#highbid-' + $currency);
				}
				if($highBid < $lastHighBid){
					$("<font color = 'red'><b> DOWN</b></font>").appendTo('#highbid-' + $currency);
				}
				if($lowBid > $lastLowBid){
					$("<font color = 'blue'><b> UP</b></font>").appendTo('#lowbid-' + $currency);
				}
				if($lowBid < $lastLowBid){
					$("<font color = 'red'><b> DOWN</b></font>").appendTo('#lowbid-' + $currency);
				}
			}
			
			function addRowValue($currency, $ask, $bid, $highAsk, $highBid, $lowAsk, $lowBid) {
				$('#kursTable tr:last').after(
						"<tr class = 'light'>" + 
							"<td id='ask-" + $currency +"'>" + $ask + "</td>" +
							"<td id='highask-" + $currency +"'>" + $highAsk + "</td>" +
							"<td id='lowask-" + $currency +"'>" + $lowAsk + "</td>" +
							"<td id='bid-" + $currency +"'>" + $bid + "</td>" +
							"<td id='highbid-" + $currency +"'>" + $highBid + "</td>" +
							"<td id='lowbid-" + $currency +"'>" + $lowBid + "</td>" +
							"<td id='currency-" + $currency +"'>" + $currency + "</td>" +
						"</tr>");
			}
		});
		
	</script>
<span id='kurs'></span>
