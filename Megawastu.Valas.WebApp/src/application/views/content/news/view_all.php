<table class="grid" width="100%">
<tr>
	<th>No</th>
	<th>Headline</th>
	<th width="15%">Date</th>
	<th width="15%">Action</th>
</tr>
<?php for($i = 0; $i < count($data); $i++){?>
<tr class="tr">
	<?php if(($i+1)%2==0) $cls = "td_alt"; else $cls = "td" ?>
	<td><?php echo $i+1 ?></td>
	<td><?php 
		if($data[$i]['type'] == 1){
			echo "<b><font color='red'>".$data[$i]['headline']."</a></b>";
		}else if($data[$i]['type'] == 2){
			echo "<b>".$data[$i]['headline']."</b>";
		}else{
			echo "<b><font color='blue'>".$data[$i]['headline']."</a></b>";
		}
	?></td>
	<td><?php echo $data[$i]['date']?></td>
	<td><?php echo anchor('news/view/'.encode_for_uri($data[$i]['id']), 'view') ?>
		<?php if($this->session->userdata('logged_group') == 1){?>
			<?php echo anchor('news/update/'.encode_for_uri($data[$i]['id']), 'edit')?> | <?php echo anchor('news/delete/'.encode_for_uri($data[$i]['id']), 'delete', array('onclick' => 'return confirmDelete();'))?>
		<?php } ?></td>
</tr>
<?php } ?>
</table>
