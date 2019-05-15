<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

	public function index()
	{
		$data['title']	= 'Index';
		$data['page']	= 'pages/index';
		$this->view($data);
	}

}

/* End of file Home.php */
