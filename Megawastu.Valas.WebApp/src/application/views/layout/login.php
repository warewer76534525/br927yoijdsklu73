<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title> Megawastu | Login </title>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/styles/style.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/styles/login_style.css" />
</head>

<body>

<div id="ws_" class="ws">
	<div class="message" align="center"> </div>
	<div class="message" align="center"> <p><font color='red'><?php echo $this->session->flashdata('message'); ?></font></p></div>
    <div class="main_container">
        <div id="content_1" class="content">
			
        	<?php echo form_open('login/verify', array('name' => 'input_form')); ?>
			<div class="input text">
				<label for="Username">Username</label>
				<?php echo form_input('username', ''); ?> 
			</div>
			<div class="input password">
				<label for="Password">Password</label>
				<?php echo form_password('password', ''); ?> 
			</div>
			<div class="submit">
				<?php echo form_submit('__submit', 'Log In'); ?>
			</div>
			<?php echo form_close(); ?>      
        </div>
    </div>
</div>
<div align=center>
	<p>&copy; 2011 - <a href="http://triplelands.com">TripleLands</a> | We Love to Develop<br></p>
</div>

</body>
</html>