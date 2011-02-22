<?php echo $content; ?>
<br><br>
<b>Posted in : </b> 
<?php 
if($type == 1){
	echo "Breaking News";
}else if($type == 2){
	echo "Regular News";
}else{
	echo "Pengumuman";
}
?><br>
<b>Date : </b> <?php echo $date; ?><br>
<b>Author : </b> <?php echo $author; ?><br>