<p><?php echo news_type($news->type); ?>  <?php echo date('d F Y H:i:s', strtotime($news->date)); ?></p>
<p><?php echo $news->content; ?></p>
<br><br>