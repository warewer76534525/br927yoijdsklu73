<table class="table table-bordered">
	<tr>
		<th>No</th>
		<th>Username</th>
		<th>Status</th>
		<th>Group</th>
		<th width="15%">Action</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach($users as $user){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $user->username; ?></td>
			<td><?php echo ($user->status)? 'Active' : 'Inactive'; ?></td>
			<td><?php echo ($user->group == 1)? 'Administrator' : 'User'; ?></td>
			<td><?php echo anchor('users/delete/' . $user->id, '<i class="icon-trash"></i> Delete', 'onClick="return confirmDelete()"'); ?> | <?php echo anchor('users/edit/' . $user->id, '<i class="icon-edit"></i> Edit'); ?></td>
		</tr>
		<?php $i++; ?>
	<?php } ?>
</table>
<div class="pagination pull-right">
	<ul>
		<li class="active"><a href="#">&larr; Prev</a></li>
		<li class="active"><a href="#">Next &rarr; </a></li>
	</ul>
</div>