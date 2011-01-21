<!DOCTYPE html>
<html lang="en">
    <head>
	<title>test</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/jquery-1.4.4.js"></script>
	<script>
		$(document).ready(function() {
		setInterval(function () {
			<!--$('#result').load('test_inner.php'); -->
			$.getJSON('json/kurs.json', function(data) {
				$('#result').html('');
				$.each(data.rates, function(i,item){
					$('#ask' + i).html(item.ask);
					$('#bid' + i).html(item.bid);
					$('#currency' + i).html(item.currency);
				});

				  //$('#cell1').html(data[1].bid);
				  //$('#cell2').html(data[1].ask);
			});
			}, 3000);
		});
		
	</script>
    </head>
    <body>
		<table border = '1' cellspacing='0' cellpadding='2'>
			<tr>
				<td><b>BID</b></td>
				<td><b>ASK</b></td>
				<td><b>CURRENCY</b></td>
			</tr>
		<?php
			for ($i=0; $i < 3; $i++){
				echo "<tr class='light'>";
					echo "<td><div id='bid".$i."'>0</div></td>";
					echo "<td><div id='ask".$i."'>0</div></td>";
					echo "<td><div id='currency".$i."'>0</div></td>";
				echo "</tr>";
			}
		?>
		</table>
		
        <p><span id="result"></span>
    </body>
</html>
