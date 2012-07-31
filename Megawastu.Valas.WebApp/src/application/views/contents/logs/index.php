<table class="table">
	<tr>
		<th>Date</th>
		<th>User</th>
		<th>Rate</th>
	</tr>
	<?php foreach($logs as $log){ ?>
	<tr>
		<td><?php echo date('d F Y H:i:s', strtotime($log->date))?></td>
		<td><?php echo $log->user; ?></td>
		<td><?php echo $log->kurs; ?></td>
	</tr>
	<?php } ?>
</table>