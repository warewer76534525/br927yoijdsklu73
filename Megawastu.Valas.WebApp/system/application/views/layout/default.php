<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<?php

	if (!isset($title)) {
		$appname = $this->config->item('appname');
		$title = $this->config->item('apptitle')." - ".$appname[$application].": ".$page;
	}

	if (!isset($header)) {
		$header = $page;
	}
	
	if (!isset($navigation)) {
		$navigation = "";
	}
	
	if (!isset($content)) {
		$content = "";
	}
	
?>

<head>
	<title><?= $title ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>styles/style.css" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>styles/jaka.style.css" />
	<script type="text/javascript" src="<?=base_url()?>scripts/common.js"></script>	
	<script type="text/javascript" src="<?=base_url()?>scripts/calendar.js"></script>
	<script type="text/javascript" src="<?=base_url()?>scripts/jquery-1.4.4.js"></script>
	<script type="text/javascript">var cal = new CalendarPopup();</script>
</head>

<body>

	<div id="header">
		<h1><?= $header ?></h1>
	</div>
	
	<div id="content">
		<div id="sidebar">
			<?= $this->load->view('nav/static', '', true) ?>
			<?= $navigation ?>
		</div>
		
		<div id="main-content">
			<?= $content ?>
		</div>
		
		<div class="clear"></div>
	</div>

	<div id="footer">
		<p>&copy; 2011 - TripleLands | We love to develop</p>
	</div>
	
</body>

</html>