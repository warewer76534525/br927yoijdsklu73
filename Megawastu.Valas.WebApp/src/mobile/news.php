<?php
$con = mysql_connect('localhost', 'valas', 'valas');
$db = mysql_select_db('valas', $con);

$result = mysql_query("select headline, type, date from mwp_news");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<title>Megawastu Kurs | News</title>
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<script src="js/jquery-1.4.4.js"></script>
    </head>
    <body>
		<div id="menu">
			<a class = 'menu' href="index.php" >KURS USD</a>  |
			<a class = 'menu' href="idrrate.php" >KURS IDR</a>  |  
			<a class = 'menu' href="#" >CHART</a> | 
			<a class = 'menu' href="news.php" >NEWS</a>
		</div>
		<br>
		<div><b>NEWS</b></div>
		<BR/>
		<span id='news'>
			<TABLE>
			<TR>
				<TD class = 'lightheader' width = '20%'>Date</TD>
				<TD class = 'lightheader' width = '20%'>Type</TD>
				<TD class = 'lightheader'>Headline</TD>
			</TR>

			<?php while($hasil = mysql_fetch_array($result)){ ?>
			<TR class = 'light'>
				<TD width = '20%'><?php echo $hasil['date']; ?></TD>
				<TD width = '20%'><?php 
					if($hasil['date'] ==  1) echo "Breaking News";
					else if($hasil['date'] == 2) echo "Regular News";
					else echo "Pengumuman";
				?></TD>
				<TD><a href='#'><?php echo $hasil['headline']; ?></a></TD>
			</TR>
			<?php } ?>

			</TABLE>
		</span>
    </body>
</html>
