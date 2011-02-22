<?php if($this->session->userdata('logged_group') == 0){?>
<li><?php echo anchor('news', 'View All News'); ?> </li>
<?php } else { ?>
<li><?php echo anchor('news', 'View All News'); ?> | </li>
<li><?php echo anchor('news/add', 'Add New News'); ?></li>
<?php } ?>
