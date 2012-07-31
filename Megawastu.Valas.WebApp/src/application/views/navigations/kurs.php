<?php 
$header = 'Kurs';
$menus = array(
	array(
		'icon' => 'list', 'name' => 'Kurs IDR', 'url' => 'kurs/idr',
	),
	array(
		'icon' => 'list', 'name' => 'Kurs USD', 'url' => 'kurs/usd',
	),
)?>
<ul class="breadcrumb">
	<?php $i = 1; ?>
	<?php foreach ($menus as $menu) { ?>
		<li> <?php echo anchor($menu['url'], '<i class="icon-'. $menu['icon'] .'"></i> '. $menu['name']); ?> </li>
		<?php echo ($i != count($menus))? '<span class="divider">|</span>' : ''; ?>
		<?php $i++; ?>
	<?php }?>
</ul>