<?php echo form_open('user/process_add'); ?>
<font color="red"><p><?php echo $this->session->flashdata('error'); ?></p></font>
<table class="table" border="1">
<tr class="tr_head">
	<td class="th">Username</td>
	<td><input type="text" name="username" size="40"></td>
</tr>
<tr class="tr_head">
	<td class="th">Password</td>
	<td class="td_alt"><input type="password" name="password" size="40"></td>
</tr>
<tr class="tr_head">
	<td class="th">Status</td>
	<td><?php echo form_dropdown('status',array('0' => 'Inactive', '1' => 'Active'), '0')?></td>
</tr>
<tr class="tr_alt">
	<td class="td" colspan='2' align=center><input type="submit" name="__submit" value="Add"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>