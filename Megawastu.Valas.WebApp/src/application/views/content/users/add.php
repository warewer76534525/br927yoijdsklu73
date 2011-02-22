<?php echo form_open('users/process_add'); ?>
<table class="form_container">
<tr>
	<td>Username</td>
	<td><input type="text" name="username" size="75"></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" name="password" size="75"></td>
</tr>
<tr>
	<td>Status</td>
	<td><?php echo form_dropdown('status',array('0' => 'Inactive', '1' => 'Active'))?></td>
</tr>
<tr>
	<td>Role</td>
	<td><?php echo form_dropdown('group',array('0' => 'User', '1' => 'Administrator'))?></td>
</tr>
<tr>
	<td colspan='2' align=center><input type="submit" name="__submit" value="Add"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>