<?php $class = array('1'=>"class = red", '2' => "class = black", '3' => 'class = blue') ?>
<?php
$con = mysql_connect('localhost', 'valas', 'valas');
$db = mysql_select_db('valas', $con);

$result = mysql_query("select headline, type, date from mwp_news order by date desc");

?>
<!DOCTYPE html>
<html lang="en">
    <head>
	<title>Megawastu | Valuta Asing</title>
	<link rel="stylesheet" type="text/css" href="../assets/styles/mobile_style.css" />
	<script src="../assets/scripts/jquery-1.4.4.js"></script>
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
					if($hasil['type'] ==  1) echo "Breaking News";
					else if($hasil['type'] == 2) echo "Regular News";
					else echo "Pengumuman";
				?></TD>
				<TD><a href='#' <?php echo $class[$hasil['type']]?>><?php echo $hasil['headline']; ?></a></TD>
			</TR>
			<?php } ?>

			</TABLE>
		</span><br>
		<div><b>LEGEND</b></div><br>
		<img src="../assets/img/red_legend.png"> <b>Breaking News</b><br>
		<img src="../assets/img/blue_legend.png"> <b>Pengumuman</b><br>
		<img src="../assets/img/black_legend.png"> <b>Regular News</b><br>
    </body>
</html>
