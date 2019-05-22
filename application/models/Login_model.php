<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends MY_Model 
{

	public $table = 'user';

	public function getDefaultValues()
	{
		return [
			'email'		=> '',
			'password'	=> ''
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field'	=> 'email',
				'label'	=> 'E-Mail',
				'rules'	=> 'trim|required|valid_email'
			],
			[
				'field'	=> 'password',
				'label' => 'Password',
				'rules'	=> 'required'
			]
		];
		return $validationRules;
	}

	public function runLogin($input)
	{
		$user = $this->db->where('email', strtolower($input->email))
						 ->where('is_active', 1)
						 ->get($this->table)
						 ->row();

		if (!empty($user) && hashEncryptVerify($input->password, $user->password)) {
			$data = [
				'name'		=> $user->name,
				'email'		=> $user->email,
				'role'		=> $user->role,
				'is_login'	=> true,
			];

			$this->session->set_userdata($data);
			return true;
		}
		
		return false;
	}

}

/* End of file Login_model.php */
