<?php if($this->session->flashdata('error')){?>
<div class="alert">
  <button class="close" data-dismiss="alert">×</button>
  <?php echo $this->session->flashdata('error'); ?>
</div>
<?php } ?>
<?php echo form_open('password/update'); ?>
<label><strong>Current Password</strong></label>
<input type="password" name="current">
<label><strong>New Password</strong></label>
<input type="password" name="new">
<label><strong>Confirm New Password</strong></label>
<input type="password" name="confirm">
<?php $user = $this->auth->user(); ?>
<?php echo form_hidden('__id', $user->id); ?>
<hr>
<input type="submit" name="__submit" value="Update" class="btn btn-primary">
<?php echo form_close(); ?>