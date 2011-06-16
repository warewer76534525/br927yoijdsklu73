<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />  
	<title>Megawastu Valas</title> 
<style>
BODY{
	font: small "Bookman Old Style";
	margin-right: 1.5em;
}
.e{margin-left:1em;text-indent:-1em;margin-right:1em}
.b{color:red;font-family:'Courier New';font-weight:bold;text-decoration:none}
.m{color:blue}
.pi{color:blue}
.c{cursor:hand}
.t{color:#990000}
.tx{font-weight:bold}
.style6 {
	font-size: medium;
}
a {
	color: #FFFFFF;
}
.style64 {
	font-size: xx-large;
}
.style67 {
	text-decoration: none;
}
.style93 {
	border: 1px solid #FFFFFF;
	text-align: left;
		font-size: x-large;
		color: #E8D138;
		background-color: #2AABE2;
		font-weight: bold;
}
.style103 {
	border: 1px solid #FFFFFF;
	text-align: left;
	font-size: x-large;
	color: #FFFFFF;
	background-color: #93DFFF;
	font-weight: bold;
}
.style112 {
	border: 1px solid #FFFFFF;
	text-align: left;
		font-size: x-large;
		color: #E8D138;
		background-color: #2AABE2;
		font-weight: bold;
		letter-spacing: normal;
}
.style121 {
	border: 1px solid #000000;
	text-align: center;
	font-size: xx-large;
	color: #FFFFFF;
	background-color: #2AABE2;
	font-weight: bold;
	line-height: normal;
	letter-spacing: normal;
}
.style123 {
	color: #FFFFFF;
}
.style128 {
	font-size: xx-large;
	color: #FFFFFF;
}
.style132 {
	color: #FFFFFF;
}
a:active {
	color: #2F2F2F;
}
a:hover {
	color: #D1D0CC;
}
.bnews{
	color:blue;
}
.rnews{
	color:red;
}
.blnews{
	color:black;
}
</style> 
 
</head> 
 
 
<body style="margin: 0"> 
<?php if(!isset($title)){$title="";};?>
<table style="width: 100%; height: 100%;" cellpadding="5"> 
	<tbody> 
	<tr> 
		<td class="style121" style="height: 100%; width: 100%;"> 
			<span class="style123"> <?php echo anchor('mobile/kurs/usd', 'KURS USD', array('class'=>'style67'))?> | 
			<?php echo anchor('mobile/kurs/idr', 'KURS IDR', array('class'=>'style67'))?> | 
			<?php echo anchor('mobile/graphs', 'GRAPH', array('class'=>'style67'))?> | 
			<?php echo anchor('mobile/news', 'NEWS', array('class'=>'style67'))?></span>
		</td> 
	</tr>
	<?php echo $content; ?>
	<tr> 
		<td class="style112" style="height: 100%; line-height: normal; width: 100%;"> 
		<span class="style132">&nbsp;</span></td> 
	</tr> 
	<tbody>
	</table>
</body> 
</html>