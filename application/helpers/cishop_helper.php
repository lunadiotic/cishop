<?php 

// Get list of option for dropdown
function getDropdownList($table, $columns)
{
	$CI =& get_instance();
	$query = $CI->db->select($columns)->from($table)->get();

	if ($query->num_rows() >= 1) {
		$options1	= ['' => '- Select -'];
		$options2	= array_column($query->result_array(), $columns[1], $columns[0]);
		$options	= $options1 + $options2;
		return $options;
	}

	return $options	= ['' => '- Select -'];
}
