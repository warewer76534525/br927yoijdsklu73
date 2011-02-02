<?php echo form_open('auth/process_login'); ?>
<font color="red"><p><?php echo $this->session->flashdata('message'); ?></p></font>
<table class="table" border="1">
<tr class="tr_head">
	<td class="th">Username</td>
	<td><input type="text" name="username" size="40"></td>
</tr>
<tr class="tr_head">
	<td class="th">Password</td>
	<td><input type="password" name="password" size="40"></td>
</tr>
<tr class="tr_alt">
	<td class="td" colspan='2' align=center><input type="submit" name="__submit" value="Login"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>