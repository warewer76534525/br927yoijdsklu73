<script>
	function checkForm()
	{
		var headline = document.forms["newsadd"]["headline"].value;
		if (headline == null || headline == "")
		{
			alert("Headline must be filled out");
			return false;
		}

		var content = document.forms["newsadd"]["content"].value;
		if (content == null || content == "")
		{
			alert("Content must be filled out");
			return false;
		}

		return true;
	}
</script>

<?php echo form_open('news/create', array('name'=>'newsadd', 'onSubmit'=>'return checkForm()')); ?>
	<label for="headline"><strong>Headline</strong></label>
	<input type="text" id="headline" name="headline" style="width: 60%; ">
	<label for="content"><strong>Content</strong></label>
	<textarea id="content" name="content" style="width: 99%; height: 100px;"></textarea>
	<label for="type"><strong>Type</strong></label>
	<?php echo form_dropdown('type', news_type_array()); ?>
	<hr>
	<div class="pull-right">
		<input type="submit" name="__submit" value="Add" class="btn btn-primary" style="width: 50px;">
		<input type="reset" name="__reset" value="Reset" class="btn" style="width: 50px;">
	</div>
<?php echo form_close(); ?>
<br>
<br>