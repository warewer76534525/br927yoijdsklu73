<?php echo form_open('news/process_update'); ?>
<table class="table" border="1">
<input type="hidden" name="id" value="<?php echo $data[0]['id']?>">
<tr class="tr_head">
	<td class="th">Headline</td>
	<td><input type="text" name="headline" size="75" value="<?php echo $data[0]['headline']?>"></td>
</tr>
<tr class="tr_head">
	<td class="th">Content</td>
	<td class="td_alt"><textarea name="content" cols="60"><?php echo $data[0]['content']?></textarea></td>
</tr>
<tr class="tr_head">
	<td class="th">Type</td>
	<td><?php echo form_dropdown('type',array('1' => 'Breaking News', '2' => 'Regular News', '3' => 'Pengumuman'), $data[0]['type'])?></td>
</tr>
<tr class="tr_alt">
	<td class="td" colspan='2' align=center><input type="submit" name="__submit" value="Update"> <input type="reset" name="__reset" value="Reset"></td>
</tr>
</table>
<?php echo form_close(); ?>