<!--<li><?php echo anchor('graphs/per_day', 'Graph Per Day'); ?> | </li>
<li><?php echo anchor('graphs/per_week', 'Graph Per Week'); ?> | </li>
<li><?php echo anchor('graphs/per_month', 'Graph Per Month'); ?> | </li>
<li><?php echo anchor('graphs/per_three_month', 'Graph Per Three Month'); ?></li>-->
<?php if(!isset($choose_curr)){ ?>
<?php $choose_curr = "none"; $choose_time = "none"; ?>
<?php } ?>

<?php echo form_open('graphs/process'); ?>
<li>currency</li>
<li><?php echo form_dropdown('curr', $currency, $choose_curr)?></li>
<li>per</li>
<li><?php echo form_dropdown('time', $time, $choose_time)?></li>
<li><?php echo form_submit('__submit', 'go');?></li>
<?php echo form_close(); ?>