<?php $user = $this->auth->user(); ?>
<?php $group = ($user->group == 1)? 'admin' : 'user'; ?>
<?php $user = ucfirst($user->username); ?>
<?php $nav = $this->config->item('nav'); ?>
<?php $menus = $nav[$group]; ?>

<ul class="nav">
	<?php foreach ($menus as $menu) { ?>
		<?php $class = ($this->uri->segment(1) == $menu['url'])? 'class="active"' : ''; ?>
		<li <?php echo $class?>> <?php echo anchor($menu['url'], $menu['name']); ?> </li>
	<?php } ?>
</ul>


<div class="pull-right">
	<ul class="nav">
		<li> <?php echo anchor('password', "Change Password"); ?> </li>
		<li> <?php echo anchor('logout', "$user "."[Logout]"); ?> </li>
	</ul>
</div>