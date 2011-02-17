<p>
<?php
extract($data);

$n_records = count($result);

for ($i=0; (($i<$n_records) && (strcmp($result[$i][$key], $key_value) != 0)); $i++);

$index = $i;

$this->table->clear();
$this->table->set_caption('TABLE: '.$table.', RECORD: '.($index+1).'/'.$n_records);

foreach ($result[$index] as $_key => $_value) {
	$this->table->add_row($_key, $_value);
}

$this->table->set_horizontal(true);

echo $this->table->generate(); 

$data_nav_labels = $this->config->item('data_nav_labels');
$first = $data_nav_labels['FIRST'];
$prev = $data_nav_labels['PREV'];
$next = $data_nav_labels['NEXT'];
$last = $data_nav_labels['LAST'];
$update = $data_nav_labels['UPDATE'];
$separator = $this->config->item('data_nav_separator');
$wide_separator = $this->config->item('data_nav_wide_separator');

echo '<p class="data_nav">';
echo anchor($controller.'/view/'.encode_for_uri($key).'/'.encode_for_uri($result[0][$key]), $first);
echo $separator;
if ($index != 0) {	
	echo anchor($controller.'/view/'.encode_for_uri($key).'/'.encode_for_uri($result[$index-1][$key]), $prev);
} else {
	echo $prev;
}
echo $separator;
if ($index != ($n_records-1)) {
	echo anchor($controller.'/view/'.encode_for_uri($key).'/'.encode_for_uri($result[$index+1][$key]), $next);
} else {
	echo $next;
}
echo $separator;
echo anchor($controller.'/view/'.encode_for_uri($key).'/'.encode_for_uri($result[$n_records-1][$key]), $last);
echo $wide_separator;
echo anchor($controller.'/update/'.encode_for_uri($key).'/'.encode_for_uri($result[$index][$key]), $update);
echo "</p>";

?>
</p>