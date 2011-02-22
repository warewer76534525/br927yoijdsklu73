<?php $group = array('0'=>'user', '1'=>'administrator')?>
<table class="grid" width="100%">
<tr>
	<th>No</th>
	<th>User</th>
	<th>IP</th>
	<th>User Agent</th>
	<th width="15%">Last Activity</th>
</tr>
<?php for($i = 0; $i < count($data); $i++){?>
<?php $user = split("\"", $data[$i]['user_data'])?>
<tr class="tr">
	<td><?php echo $i+1 ?></td>
	<td><?php echo "ID: ". $user[3]. " <br>username: ". $user[7]." <br>role: ".$group[$user[11]]; ?></td>
	<td><?php echo $data[$i]['ip_address']?></td>
	<td><?php echo $data[$i]['user_agent']?></td>
	<td><?php echo $data[$i]['last_activity']?></td>
</tr>
<?php } ?>
</table>
