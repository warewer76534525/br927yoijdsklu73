<?php echo form_open('user/process_update'); ?>
<table class="table" border="1">
<input type="hidden" name="id" value="<?php echo $data[0]['id']?>">
<tr class="tr_head">
	<td class="th">Username</td>
	<td><input type="text" name="username" size="40" value="<?php echo $data[0]['username']?>"></td>
</tr>
<tr class="tr_head">
	<td class="th">Password</td>
	<td><input type="password" name="password" size="40"> *fill to change password</td>
</tr>
<tr class="tr_head">
	<td class="th">Status</td>
	<td><?php echo form_dropdown('status',array('0' => 'Inactive', '1' => 'Active'), $data[0]['status'])?></td>
</tr>
<tr class="tr_alt">
	<td class="td" colspan='2' align=center><input type="submit" name="__submit" value="Update"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>