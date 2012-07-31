<?php $user = $this->auth->user(); ?>
<?php foreach($news as $n){ ?>
	<h2><?php echo anchor('news/detail/'.$n->id, $n->headline); ?> <?php if($user->group == 1){?><small class="pull-right" style="font-size:13px;"><?php echo anchor('news/delete/' . $n->id, '<i class="icon-trash"></i> Delete', 'onClick="return confirmDelete()"'); ?> | <?php echo anchor('news/edit/' . $n->id, '<i class="icon-edit"></i> Edit'); ?></small><?php } ?></h2>
	<p> <?php echo news_type($n->type); ?>  
		<?php echo date('d F Y H:i:s', strtotime($n->date)); ?>  
		</p>
	<p><?php echo word_limiter($n->content, 100); ?></p>
	<hr>
<?php } ?>

<div class="pagination pull-right">
	<ul>
		<li class="active"><a href="#">&larr; Prev</a></li>
		<li class="active"><a href="#">Next &rarr; </a></li>
	</ul>
</div>