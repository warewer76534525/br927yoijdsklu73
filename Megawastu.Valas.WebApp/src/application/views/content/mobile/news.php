<?php $class = array('1'=>"rnews", '2' => "blnews", '3' => 'bnews') ?>

<?php for($i = 0; $i < count($news); $i++) {
if($news[$i]['type'] == 1){
	echo "<a href=".site_url('mobile/news/view/'.encode_for_uri($news[$i]['id']))."><b><font color='red'>".$news[$i]['headline']."</font></b></a>";
}else if($news[$i]['type'] == 2){
	echo "<a href=".site_url('mobile/news/view/'.encode_for_uri($news[$i]['id']))."><b>".$news[$i]['headline']."</font></b></a>";
}else{
	echo "<a href=".site_url('mobile/news/view/'.encode_for_uri($news[$i]['id']))."><b><font color='blue'>".$news[$i]['headline']."</font></b></a>";
}
echo "<br><br>";
}?>