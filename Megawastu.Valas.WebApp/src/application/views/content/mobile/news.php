<?php $class = array('1'=>"rnews", '2' => "blnews", '3' => 'bnews') ?>

<?php for($i = 0; $i < count($news); $i++) { ?>
<tr> 
	<td class="style103" style="height: 100%; line-height: normal; letter-spacing: normal; width: 100%;"> 
	<?php //echo $news[$i]['date']; ?>
	<?php echo anchor('mobile/news/view/'.encode_for_uri($news[$i]['id']), $news[$i]['headline'], array('class'=>'style67 '.$class[$news[$i]['type']]))?></td>
</tr> 
<?php } ?>