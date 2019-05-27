<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder extends MY_Controller 
{
	private $id_user;

	public function __construct()
	{
		parent::__construct();
		$is_login		= $this->session->userdata('is_login');
		$this->id_user	= $this->session->userdata('id');

		if (!$is_login) {
			redirect(base_url('login'));
			return;
		}
	}

	public function index()
	{
		$data['title']		= 'Orders';
		$data['content']	= $this->myorder->where('id_user', $this->id_user)->orderBy('date', 'DESC')->get();
		$data['page']		= 'pages/myorder/index';
		$this->view($data);
	}

}

/* End of file ProfileOrder.php */
