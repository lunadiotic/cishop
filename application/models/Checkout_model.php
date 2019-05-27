<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout_model extends MY_Model 
{

	protected $table = 'orders';
	
	public function getDefaultValues()
	{
		return [
			'id'		=> '',
			'id_user'	=> '',
			'invoice'	=> '',
			'name'		=> '',
			'address'	=> '',
			'phone'		=> '',
			'status'	=> '',
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field'	=> 'name',
				'label'	=> 'Nama',
				'rules' => 'trim|required'
			],
			[
				'field'	=> 'address',
				'label'	=> 'Alamat',
				'rules' => 'trim|required'
			],
			[
				'field'	=> 'phone',
				'label'	=> 'Telepon',
				'rules' => 'trim|required'
			]
		];

		return $validationRules;
	}

}

/* End of file Cart_model.php */
