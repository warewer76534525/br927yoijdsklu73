<?php $class = array('1'=>"rnews", '2' => "blnews", '3' => 'bnews') ?>

<?php for($i = 0; $i < count($news); $i++) { ?>
<b><?php echo $news[$i]['headline']?></b><br>
<?php echo $news[$i]['content']?><br><br>
<?php } ?>