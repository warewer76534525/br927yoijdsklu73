<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php echo $page; ?> | Megawastu</title>

		<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet">
		<style>
			body {
				background-color: #eee;
			}
			.logo {
				margin: 5px 0 5px 0;
			}
			.content {
				background-color: #fff;
				padding: 5px 5px 5px 0;
				-webkit-border-radius: 3px;
				-moz-border-radius: 3px;
				border-radius: 3px;
				-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
			    -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
			    box-shadow: 0 1px 2px rgba(0,0,0,.15);
			}
			.sidebar {
				margin-right: 5px;
				border-right: 1px solid #eee;
			}
			.main {
				padding-top: 5px;
				margin-left: 5px;
			}
			.footer {
				text-align: center;
				margin: 30px;
			}
			.fix {
				width: 900px;
			}
		</style>

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js"></script>
	</head>

	<body>
		<div class="container">
			<div class="row">
				<div class="logo">
					<img src="<?php echo base_url(); ?>assets/img/logo.png" title="Megawastu" />
				</div>
			</div>

			<div class="row">
				<div class="navbar">
					<div class="navbar-inner">
						<div class="container">
							<div class="nav-collapse">
								<?php echo $navigation; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row content">
				<div class="span12 fix">
					<div class="main">
						<h1> <?php echo $page; ?> <small class="pull-right"><?php echo $action; ?></small></h1>
						<hr>
						<?php echo $content; ?>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="footer">
					Copyright &copy; 2012 Megawastu. All right reserved.
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
	</body>
</html>
