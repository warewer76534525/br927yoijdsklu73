<p>
<?php
extract($data);

$new_column = "AKSI";

$fields[] = $new_column;

for ($i=0; (($i<count($field_data)) && (strcasecmp($field_data[$i]['Key'], 'PRI') != 0)); $i++);

$PK_index = $i;

$key = $fields[$PK_index];

for ($i=0; $i<count($result); $i++) {
	$result[$i][$new_column] = anchor($controller.'/update/'.encode_for_uri($key).'/'.encode_for_uri($result[$i][$key]), 'update')." ".anchor($controller.'/delete/'.encode_for_uri($key).'/'.encode_for_uri($result[$i][$key]), 'delete', array('onclick' => 'return confirmDelete();'));
	$result[$i][$key] = anchor($controller.'/view/'.encode_for_uri($key).'/'.encode_for_uri($result[$i][$key]), $result[$i][$key]);
}

$this->table->clear();
$this->table->set_caption('TABLE: '.$table);
$this->table->set_heading($fields);
echo $this->table->generate($result); 
?>
</p>