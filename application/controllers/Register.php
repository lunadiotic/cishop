<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$is_login	= $this->session->userdata('is_login');
		
		if ($is_login) {
			redirect(base_url());
			return;
		}
			
	}

	public function index()
	{
		if (!$_POST) {
			$input	= (object) $this->register->getDefaultValues();
		} else {
			$input	= (object) $this->input->post(null, true);
		}

		if (!$this->register->validate()) {
			$data['title']	= 'Register';
			$data['page']	= 'pages/auth/register';
			$data['input']	= $input;
			$this->view($data);
			return;
		}

		if ($this->register->runRegister($input)) {
			redirect(base_url());
		} else {
			$this->session->set_flashdata('error', 'Oops! Something error!.');
			redirect('register');
		}
	}

}

/* End of file Register.php */
