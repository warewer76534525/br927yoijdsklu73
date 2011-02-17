<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Table extends CI_Table {

	var $horizontal 		= false;
	
	
	function MY_Table()
	{
		parent::CI_Table();
		parent::set_template(array (
						'table_open' 			=> '<table class="table" border="1">',

						'heading_row_start' 	=> '<tr class="tr_head">',
						'heading_row_end' 		=> '</tr>',
						'heading_cell_start'	=> '<th class="th">',
						'heading_cell_end'		=> '</th>',

						'row_start' 			=> '<tr class="tr">',
						'row_end' 				=> '</tr>',
						'cell_start'			=> '<td class="td">',
						'cell_end'				=> '</td>',						
						'cell_heading_start'	=> '<td class="th">',
						'cell_heading_end'		=> '</td>',						

						'row_alt_start' 		=> '<tr class="tr_alt">',
						'row_alt_end' 			=> '</tr>',
						'cell_alt_start'		=> '<td class="td_alt">',
						'cell_alt_end'			=> '</td>',
						'cell_alt_heading_start'=> '<td class="th">',
						'cell_alt_heading_end'	=> '</td>',

						'table_close' 			=> '</table>'
					));
	}
	
	function set_horizontal($status)
	{
		$this->horizontal = $status;
	}
	
	function is_horizontal()
	{
		return $this->horizontal;
	}

	function generate($table_data = NULL) {
		if (!$this->is_horizontal()) {
			return parent::generate($table_data);
		} else {
			
			//XXX: Unable to generate from object/array yet
		
			$this->auto_heading = FALSE;
							
			// Is there anything to display?  No?  Smite them!
			if (count($this->rows) == 0)
			{
				return 'Undefined table data';
			}
		
			// Compile and validate the template date
			$this->_compile_template();
		
		
			// Build the table!
			
			$out = $this->template['table_open'];
			$out .= $this->newline;		

			// Add any caption here
			if ($this->caption)
			{
				$out .= $this->newline;
				$out .= '<caption>' . $this->caption . '</caption>';
				$out .= $this->newline;
			}

			// Build the table rows
			if (count($this->rows) > 0)
			{
				$i = 1;
				foreach($this->rows as $row)
				{
					if ( ! is_array($row))
					{
						break;
					}
				
					// We use modulus to alternate the row colors
					$name = (fmod($i++, 2)) ? '' : 'alt_';
				
					$out .= $this->template['row_'.$name.'start'];
					$out .= $this->newline;		
		
					$j = 1;					
					foreach($row as $cell)
					{
						if ($j==1) {
							$out .= $this->template['cell_'.$name.'heading_start'];
						} else {
							$out .= $this->template['cell_'.$name.'start'];
						}
						
						if ($cell === "")
						{
							$out .= $this->empty_cells;
						}
						else
						{
							$out .= $cell;
						}
						
						if ($j==1) {
							$out .= $this->template['cell_'.$name.'heading_end'];
						} else {
							$out .= $this->template['cell_'.$name.'end'];
						}
						$j++;
					}
		
					$out .= $this->template['row_'.$name.'end'];
					$out .= $this->newline;	
				}
			}

			$out .= $this->template['table_close'];
		
			return $out;
		}
	}
	
}


/* End of file Table.php */
/* Location: ./system/libraries/Table.php */