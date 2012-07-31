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

<?php echo form_open('users/create', array('name'=>'useradd', 'onSubmit'=>'return checkForm()')); ?>
	<label for="username"><strong>Username</strong></label>
	<input type="text" id="username" name="username" style="width: 50%; ">
	<label for="password"><strong>Password</strong></label>
	<input type="password" id="password" name="password" style="width: 50%; ">
	<label for="status"><strong>Status</strong></label>
	<?php echo form_dropdown('status', array('0'=>'Inactive', '1'=>'Active')); ?>
	<label for="group"><strong>Group</strong></label>
	<?php echo form_dropdown('group', array('0'=>'User', '1'=>'Administrator')); ?>
	<hr>
	<div class="pull-right">
		<input type="submit" name="__submit" value="Add" class="btn btn-primary" style="width: 50px;">
		<input type="reset" name="__reset" value="Reset" class="btn" style="width: 50px;">
	</div>
<?php echo form_close(); ?>
<br>
<br>