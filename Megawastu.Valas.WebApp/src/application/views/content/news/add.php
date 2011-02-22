<?php echo form_open('news/process_add'); ?>
<table class="form_container">
<tr>
	<td>Headline</td>
	<td><input type="text" name="headline" size="75"></td>
</tr>
<tr>
	<td>Content</td>
	<td><textarea name="content" cols="60"></textarea></td>
</tr>
<tr>
	<td>Type</td>
	<td><?php echo form_dropdown('type',array('1' => 'Breaking News', '2' => 'Regular News', '3' => 'Pengumuman'))?></td>
</tr>
<tr>
	<td colspan='2' align=center><input type="submit" name="__submit" value="Add"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>