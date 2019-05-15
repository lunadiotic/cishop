<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends MY_Model 
{

	public $table = 'user';

	public function getDefaultValues()
	{
		return [
			'name'		=> '',
			'email'		=> '',
			'password'	=> '',
			'role'		=> '',
			'is_active'	=> ''
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

	public function runRegister($input)
	{
		$data = [
			'name' 		=> $input->name,
			'email'		=> strtolower($input->email),
			'password'	=> $this->hash($input->password),
			'role'		=> 'member',
			'is_active'	=> true
		];
		
		$user			= $this->create($data);
		$sess_data = [
			'name'		=> $data['name'],
			'email'		=> $data['email'],
			'role'		=> $data['role'],
			'is_login'	=> true,
		];
		$this->session->set_userdata($sess_data);
		return true;
	}

}

/* End of file Register_model.php */
