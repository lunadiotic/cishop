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

	function getCategories()
	{
		$CI =& get_instance();
		$query = $CI->db->get('category')->result();
		return $query;
	}

	function getCart()
	{
		$CI 	=& get_instance();
		$userId	= $CI->session->userdata('id');
		if ($userId) {
			$query	= $CI->db->where('id_user', $userId)->count_all_results('cart');
			return $query;
		}
		return false;		
	}

	/**
	 * Hashing input or password
	 *
	 * @param [type] $input
	 * @return boolean
	 */
	function hashEncrypt($input)
	{
		$hash = password_hash($input, PASSWORD_DEFAULT);
		return $hash;
	}

	/**
	 * Verify between input password
	 * with hashed string
	 *
	 * @param String $password
	 * @param String $hash
	 * @return void
	 */
	function hashEncryptVerify($password, $hash) {
		if (password_verify($password, $hash)) {
			return true;
		} else {
			return false;
		}
	}
