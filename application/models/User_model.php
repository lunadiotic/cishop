<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model 
{

	protected $perPage = 5;

	public function getDefaultValues()
	{
		return [
			'name'		=> '',
			'email'		=> '',
			'password'	=> '',
			'role'		=> '',
			'photo'		=> '',
			'is_active'	=> '',
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field'	=> 'name',
				'label' => 'Name',
				'rules'	=> 'trim|required'
			],
			[
				'field' => 'email',
				'label' => 'E-Mail',
				'rules' => 'trim|required|valid_email|is_unique[user.email]',
				'errors' => [
					'is_unique' => 'This %s already exists.'
				]
			],
			[
				'field'	=> 'password',
				'label' => 'Password',
				'rules'	=> 'trim|required|min_length[8]',
			],
			[
				'field'	=> 'password_confirmation',
				'label' => 'Password Confirmation',
				'rules' => 'required|matches[password]'
			]
		];

		return $validationRules;
	}

}

/* End of file User_model.php */
