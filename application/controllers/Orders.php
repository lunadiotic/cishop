<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$role		= $this->session->userdata('role');
		if ($role != 'admin') {
			redirect(base_url());
			return;
		}
	}

	public function index($page = null)
	{
		$data['title']		= 'Orders';
		$data['content']	= $this->orders->orderBy('date', 'desc')->paginate($page)->get();
		$data['total_rows']	= $this->orders->count();
		$data['pagination']	= $this->orders->makePagination(site_url('orders'), 2, $data['total_rows']);
		$data['page']		= 'pages/orders/index';
		$this->view($data);
	}

	public function search($page = null)
	{
		if (isset($_POST['keyword'])) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		} else {
			redirect(base_url('orders'));
		}
		$keyword 			= $this->session->userdata('keyword'); 
		$data['content']	= $this->orders->like('invoice', $keyword)
								->orLike('status', $keyword)
								->orderBy('date', 'desc')
								->paginate($page)
								->get();
		$data['total_rows']	= $this->orders->like('invoice', $keyword)->orLike('status', $keyword)->count();
		$data['pagination']	= $this->orders->makePagination(site_url('orders/search'), 3, $data['total_rows']);
		$data['page']		= 'pages/orders/index';
		$this->view($data);
	}

	public function reset()
	{
		$this->session->unset_userdata('keyword');
		redirect(base_url('orders'));
	}

}

/* End of file Orders.php */
