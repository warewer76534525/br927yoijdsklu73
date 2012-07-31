<?php $group = array('0'=>'User', '1'=>'Administrator')?>
<table class="table">
	<tr>
		<th>User</th>
		<th>IP Address</th>
		<th>User Agent</th>
		<th>Last Activity</th>
	</tr>
	<?php foreach($monitors as $monitor){ ?>
	<tr>
		<td><?php echo $monitor->username;; ?></td>
		<td><?php echo $monitor->ip_address; ?></td>
		<td><?php echo $monitor->user_agent; ?></td>
		<td><?php echo $monitor->last_activity; ?></td>
	</tr>
	<?php } ?>
</table>