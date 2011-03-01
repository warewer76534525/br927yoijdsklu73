<?php if($this->session->userdata('logged_group') == 0){?>
<li><?php echo anchor('users/change_password', 'Change Password'); ?> </li>
<?php } else { ?>
<li><?php echo anchor('users', 'View All Users'); ?> | </li>
<li><?php echo anchor('users/add', 'Add New Users'); ?></li>
<?php } ?>

