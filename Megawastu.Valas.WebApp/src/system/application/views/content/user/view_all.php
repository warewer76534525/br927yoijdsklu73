<table class="table" border="1">
<tr class="tr_head">
	<th class="th">ID</th>
	<th class="th">Username</th>
	<th class="th">Password</th>
	<th class="th">Status</th>
	<th class="th">Action</th>
</tr>
<?php for($i = 0; $i < count($data); $i++){?>
<tr class="tr">
	<?php if(($i+1)%2==0) $cls = "td_alt"; else $cls = "td" ?>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['id']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['username']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['password']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['status']?></td>
	<td class="<?php echo $cls?>"><?php echo anchor('user/update/'.encode_for_uri($data[$i]['id']), 'edit')?> | <?php echo anchor('user/delete/'.encode_for_uri($data[$i]['id']), 'delete', array('onclick' => 'return confirmDelete();'))?> </td>
</tr>
<?php } ?>
</table>
