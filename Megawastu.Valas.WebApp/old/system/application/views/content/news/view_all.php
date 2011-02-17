<table class="table" border="1">
<tr class="tr_head">
	<th class="th">ID</th>
	<th class="th">Headline</th>
	<th class="th">Content</th>
	<th class="th">Type</th>
	<th class="th">Date</th>
	<th class="th">Author</th>
	<th class="th">Action</th>
</tr>
<?php for($i = 0; $i < count($data); $i++){?>
<tr class="tr">
	<?php if(($i+1)%2==0) $cls = "td_alt"; else $cls = "td" ?>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['id']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['headline']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['content']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['type']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['date']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['author']?></td>
	<td class="<?php echo $cls?>"><?php echo anchor('news/update/'.encode_for_uri($data[$i]['id']), 'edit')?> | <?php echo anchor('news/delete/'.encode_for_uri($data[$i]['id']), 'delete', array('onclick' => 'return confirmDelete();'))?> </td>
</tr>
<?php } ?>
</table>
