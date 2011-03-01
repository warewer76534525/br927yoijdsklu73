<div style="text-align:center;"><font color="red"><?php echo $this->session->flashdata('error'); ?></font></div>

<?php echo form_open('users/change_password'); ?>
<table class="form_container">
<tr>
	<td>Current Password</td>
	<td><input type="password" name="cur_password" size="75"></td>
</tr>
<tr>
	<td>New Password</td>
	<td><input type="password" name="new_password" size="75"></td>
</tr>
<tr>
	<td>Confirm New Password</td>
	<td><input type="password" name="con_password" size="75"></td>
</tr>
<tr>
	<td colspan='2' align=center><input type="submit" name="__submit" value="Change"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>