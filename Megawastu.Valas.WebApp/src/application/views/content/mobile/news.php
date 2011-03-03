<?php $class = array('1'=>"red", '2' => "black", '3' => 'blue') ?>
<div><b>NEWS</b></div>
<br/>
<span id='news'>
	<table>
	<tr>
		<td class = 'lightheader' width = '20%'>Date</td>
		<td class = 'lightheader'>Headline</td>
	</tr>
	<?php for($i = 0; $i < count($news); $i++) { ?>
	<tr class = 'light'>
		<td width = '20%'><?php echo $news[$i]['date']; ?></td>
		<td><?php echo anchor('mobile/news/view/'.encode_for_uri($news[$i]['id']), $news[$i]['headline'], array('class'=>$class[$news[$i]['type']]))?></td>
	</tr>
	<?php } ?>
	</table>
</span><br><br>
<div><b>LEGEND : </b></div>
<img src="<?php echo base_url(); ?>assets/img/red_legend.png"> <b>Breaking News</b><br>
<img src="<?php echo base_url(); ?>assets/img/blue_legend.png"> <b>Pengumuman</b><br>
<img src="<?php echo base_url(); ?>assets/img/black_legend.png"> <b>Regular News</b><br>