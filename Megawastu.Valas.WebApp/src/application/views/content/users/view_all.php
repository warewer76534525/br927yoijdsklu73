<?php $status = array('0' => 'Inactive', '1' => 'Active'); ?>
<?php $group = array('0' => 'User', '1' => 'Administrator'); ?>

<table class="grid" width="100%">
<tr>
	<th>No</th>
	<th>Username</th>
	<th>Status</th>
	<th>Group</th>
	<th width="15%">Action</th>
</tr>
<?php for($i = 0; $i < count($data); $i++){?>
<tr class="tr">
	<td><?php echo $i+1 ?></td>
	<td><?php echo $data[$i]['username']; ?></td>
	<td><?php echo $status[$data[$i]['status']]; ?></td>
	<td><?php echo $group[$data[$i]['group']]; ?></td>
	<td><?php echo anchor('users/update/'.encode_for_uri($data[$i]['id']), 'edit')?><?php //echo anchor('users/delete/'.encode_for_uri($data[$i]['id']), 'delete', array('onclick' => 'return confirmDelete();'))?> </td>
</tr>
<?php } ?>
</table>