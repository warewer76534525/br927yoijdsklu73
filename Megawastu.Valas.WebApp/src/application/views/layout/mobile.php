<!DOCTYPE html>
<html lang="en">
    <head>
	<title>Megawastu | Valuta Asing : <?php echo $page; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/styles/mobile_style.css" />
    </head>
    <body>
		<div id="menu">
			<?php echo anchor('mobile/kurs/usd', 'KURS USD', array('class'=>'menu'))?> |
			<?php echo anchor('mobile/kurs/idr', 'KURS IDR', array('class'=>'menu'))?> |  
			<?php echo anchor('mobile/graphs', 'GRAPH', array('class'=>'menu'))?> | 
			<?php echo anchor('mobile/news', 'NEWS', array('class'=>'menu'))?>
		</div>
		<br>
		<?php echo $content; ?>
    </body>
</html>
