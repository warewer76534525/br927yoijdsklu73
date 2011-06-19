<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns:lift="http://liftweb.net" xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
    <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" /> 
    <meta content="width=320" name="viewport" /> 
    <link href="<?php echo base_url(); ?>assets/styles/mstyle.css" type="text/css" rel="stylesheet" /> 
    <link href="<?php echo base_url(); ?>assets/styles/mmobile.css" type="text/css" rel="stylesheet" /> 
    <title>Megawastu Valas Mobile</title>
</head> 
<body> 
    <div> <?php echo anchor('mobile', 'KURS USD')?> |  <?php echo anchor('mobile/kurs/idr', 'KURS IDR')?> | <?php echo anchor('mobile/graphs', 'GRAPH')?> | <?php echo anchor('mobile/news', 'NEWS')?></div> 
    <hr /> 

    <div id="lift__noticesContainer__"></div> 
    <div> <?php echo $page; ?> </div> 
    <hr /> 

	<?php echo $content; ?>
   
    <hr /> 
    <div> Megawastu 2011</div> 
	</body> 
</html>  