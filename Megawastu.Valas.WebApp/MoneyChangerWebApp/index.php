<!DOCTYPE html>
<html lang="en">
    <head>
	<title>test</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/jquery-1.4.4.js"></script>
	<script>
		$(document).ready(function() {
			initTable();
			setInterval(function () {
				$.ajax({
					url: "json/kurs.json",
					cache: false,
					dataType: "json",
					success: updateTableRow
				});
			}, 3000);
			
			function initTable() {
				$('#kurs').html(
				"<table id='kursTable' border = '1' cellspacing='0' cellpadding='2'>" +
					"<tr>" +
						"<td width='30%'><b>BID</b></td>" +
						"<td width='30%'><b>ASK</b></td>" +
						"<td width='30%'><b>CURRENCY</b>" +
						"</td>" +
					"</tr>" +
				"</table>");
			}
			
			function updateTableRow(data) {
				$.each(data.rates, function(i,item){
					if ($("#currency-" + item.currency).length){
						updateRowValue(item.currency, item.ask, item.bid);
					} else {
						addRowValue(item.currency, item.ask, item.bid);
					}
				});
			}
			
			function updateRowValue($currency, $ask, $bid) {
				$('#ask-' + $currency).html($ask);
				$('#bid-' + $currency).html($bid);
				$('#currency-' + $currency).html($currency);
			}
			
			function addRowValue($currency, $ask, $bid) {
				$('#kursTable tr:last').after(
						"<tr>" + 
							"<td id='ask-" + $currency +"'>" + $ask + "</td>" +
							"<td id='bid-" + $currency +"'>" + $bid + "</td>" +
							"<td id='currency-" + $currency +"'>" + $currency + "</td>" +
						"</tr>");
			}
			
		});
		
	</script>
    </head>
    <body>
		<span id='kurs'></span>
    </body>
</html>
