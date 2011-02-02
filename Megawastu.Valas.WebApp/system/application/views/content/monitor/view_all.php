<table class="table" border="1">
<tr class="tr_head">
	<th class="th">Auth</th>
	<th class="th">Date</th>
	<th class="th">IP Address</th>
	<th class="th">User Agent</th>
</tr>
<?php for($i = 0; $i < count($data); $i++){?>
<tr class="tr">
	<?php if(($i+1)%2==0) $cls = "td_alt"; else $cls = "td" ?>
	<td class="<?php echo $cls?>"><?php echo $users[$data[$i]['auth']]?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['date']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['ip_address']?></td>
	<td class="<?php echo $cls?>"><?php echo $data[$i]['user_agent']?></td>
</tr>
<?php } ?>
</table>

<p>user login : <?php echo $i; ?></p>
