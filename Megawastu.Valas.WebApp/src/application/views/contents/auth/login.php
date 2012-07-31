<?php echo form_open('login'); ?>
<label><strong>Username</strong></label>
<input type="text" name="username">
<label><strong>Password</strong></label>
<input type="password" name="password">
<hr>
<input type="submit" name="__submit" value="Login" class="btn btn-primary">
<?php echo form_close(); ?>