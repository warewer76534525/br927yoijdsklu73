<?php if(!isset($choose_curr)){ ?>
<?php $choose_curr = "none"; $choose_time = "none"; ?>
<?php } ?>

<?php echo form_open('mobile/graphs/process'); ?>
<li>currency</li>
<li><?php echo form_dropdown('curr', $currency, $choose_curr)?></li>
<li>per</li>
<li><?php echo form_dropdown('time', $time, $choose_time)?></li>
<li><?php echo form_submit('__submit', 'go');?></li>
<?php echo form_close(); ?>