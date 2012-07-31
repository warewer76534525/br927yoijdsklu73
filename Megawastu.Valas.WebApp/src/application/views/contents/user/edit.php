<script>
	function checkForm()
	{
		var username = document.forms["useradd"]["username"].value;
		if (username == null || username == "")
		{
			alert("Username must be filled out");
			return false;
		}

		var password = document.forms["useradd"]["password"].value;
		if (password == null || password == "")
		{
			alert("Password must be filled out");
			return false;
		}

		return true;
	}
</script>

<?php echo form_open('users/update', array('name'=>'useradd', 'onSubmit'=>'return checkForm()')); ?>
	<label for="username"><strong>Username</strong></label>
	<input type="text" id="username" name="username" style="width: 50%; " value="<?php echo $user->username; ?>">
	<label for="status"><strong>Status</strong></label>
	<?php echo form_dropdown('status', array('0'=>'Inactive', '1'=>'Active'), $user->status); ?>
	<label for="group"><strong>Group</strong></label>
	<?php echo form_dropdown('group', array('0'=>'User', '1'=>'Administrator'), $user->group); ?>
	<?php echo form_hidden('__id', $user->id); ?>
	<hr>
	<div class="pull-right">
		<input type="submit" name="__submit" value="Update" class="btn btn-primary" style="width: 60px;">
		<input type="reset" name="__reset" value="Reset" class="btn" style="width: 50px;">
	</div>
<?php echo form_close(); ?>
<br>
<br>