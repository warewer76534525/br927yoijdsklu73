<?php if(!isset($choose_curr)){ ?>
<?php $choose_curr = "none"; $choose_time = "none"; ?>
<?php } ?>

<?php echo form_open('mobile/graphs/process'); ?>
Currency : <?php echo form_dropdown('curr', $currency, $choose_curr)?> | Per <?php echo form_dropdown('time', $time, $choose_time)?> <?php echo form_submit('__submit', 'go');?>
<?php echo form_close(); ?>