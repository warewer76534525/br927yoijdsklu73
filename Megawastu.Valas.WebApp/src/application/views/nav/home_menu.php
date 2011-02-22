<?php if($this->session->userdata('logged_group') == 0){?>
<li><?php echo anchor('news', 'News'); ?></li>
<?php } else { ?>
<li><?php echo anchor('news', 'News'); ?></li>
<li><?php echo anchor('users', 'User'); ?></li>
<li><?php echo anchor('monitor', 'Monitor'); ?></li>
<?php } ?>