<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

 <?php 
	if(!isset($menu)){
		$menu = "";
	}

	if(!isset($submenu)){
		$submenu = "";
	}

	if(!isset($page)){
		$page = "";
	}

	if(!isset($content)){
		$content = "";
	}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title> Megawastu | Valuta Asing </title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/styles/style.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/styles/admin_style.css" />

	<script src="<?php echo base_url()?>assets/scripts/common.js"></script>
</head>

<body>
	<div id="ws_" class="ws">
		<h4>Megawastu<small>Valuta Asing</small></h4>
		<div class="main_container">
			<!-- begin admin menu-->
			<ul class="menus">
				<li><?php echo anchor('home', 'Kurs'); ?></li>
				<?php echo $menu; ?>
				<li><?php echo anchor('logout', 'Logout')?></li>
			</ul>
			<div class="sub_menu_container">
				<ul class="sub_menus">
					
					<?php echo $submenu; ?>
				</ul>
			</div>


			<div id="content_1" class="content">
				<div id="flashMessage" class="message"> <?php echo $this->session->flashdata('message')?> </div>
				<h2> <?php echo $page; ?> </h2>
				<hr><br>
				<?php echo $content; ?>
				<br><br><br>
			</div>
		
		</div>

	</div>
	<br><br>
	<div align=center>
		<p>&copy; 2011 - <a href="http://triplelands.com">TripleLands</a> | We Love to Develop<br></p>
	</div>


</body>


</html>
