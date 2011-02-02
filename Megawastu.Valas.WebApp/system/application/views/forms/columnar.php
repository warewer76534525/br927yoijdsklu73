<p>
<?php
extract($data);

//echo "<pre>";
//print_r($data);
//echo "</pre>";

//echo $controller;

$n_fields = count($field_data);

$this->table->clear();
$this->table->set_caption('TABLE: '.$table);

$form_name = "input_form";

if (!isset($id)) {
	$id = '';
}

echo form_open('/'.$controller.'/process_'.$action.'/'.$id, array('name' => $form_name));

for ($i=0; $i<$n_fields; $i++) {
	//XXX: Find more elegant solution to this!
	if ((strcasecmp($field_data[$i]['Field'], 'CREATED_BY')!=0) &&
		(strcasecmp($field_data[$i]['Field'], 'TGL_CREATED')!=0) &&
		(strcasecmp($field_data[$i]['Field'], 'UPDATED_BY')!=0) &&
		(strcasecmp($field_data[$i]['Field'], 'TGL_UPDATED')!=0) &&
		(strcasecmp($field_data[$i]['Field'], 'IP_ADDRESS')!=0)
		) {	
			$field = $field_data[$i]['Field'];
			$type = $field_data[$i]['Type'];
			$is_key = (strcasecmp($field_data[$i]['Key'], "PRI")==0);
			$count = strpos($type, '(');
			if ($count) {
				$type = substr($type, 0, $count);
			}
			
			if (isset($record)) {
				$set_value = $record[$field];
			} else {
				$set_value = '';
			}
			
			if (($is_key) && (strcasecmp($action, "update")==0)) {
				$attr = 'readonly="readonly"';
			} else {
				$attr = '';
			}
			
			switch(strtolower($type)) {
				case "int":
					$input = form_input($field, $set_value, $attr); break;
				case "varchar":
					$input = form_input($field, $set_value, $attr); break;
				case "text":
					$input = form_textarea($field, $set_value, $attr); break;
				case "date":
					$input = form_input($field, $set_value, $attr)." <a href=\"#\"
   onClick=\"cal.select(document.forms['".$form_name."'].".$field.",'anchor".$i."','yyyy-MM-dd'); return false;\"
   NAME=\"anchor".$i."\" ID=\"anchor".$i."\">select</A>"; break;
				case "char":
					$input = form_input($field, $set_value, $attr); break;
				case "enum": 
					$options = stripslashes($field_data[$i]['Type']);
					$options = substr($options, strpos($options, '(')+1);
					$options = substr($options, 0, -1);
					$options = explode(',', $options);
					
					function remove_quotes(&$value, $key) {
						$value = substr($value, 1);
						$value = substr($value, 0, -1);
					}
					
					array_walk($options, 'remove_quotes');
															
					$first_option = $options[0];
					
					$_options = array();
					foreach ($options as $value) {
						$_options[$value] = $value;
					}
					
					if (!isset($record)) {
						$set_value = $first_option;
					}
					
					$options = $_options;
					
					$input = form_dropdown($field, $options, $set_value, $attr); break;
				default:
					$input = form_input($field, $set_value, $attr); break;
			}
		
			$this->table->add_row($field, $input);
	}
}

$this->table->add_row("", form_submit('__submit', 'Submit')." ".form_reset('__reset', 'Reset'));

$this->table->set_horizontal(true);

echo $this->table->generate(); 

//TODO: add cancel button!

echo form_close();
?>
</p>