<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller 
{

	public function __construct()
	{
		parent::__construct();
		$role = $this->session->userdata('role');
		if ($role != 'admin') {
			redirect(base_url());
			return;
		};
	}

	public function index($page = null)
	{
		$data['title']		= 'Product';
		$data['content']	= $this->product->select(
								['product.id', 'product.title', 'product.image', 'category.title AS category_title']
							)->join('category')->paginate($page)->get();
		$data['total_rows']	= $this->product->count();
		$data['pagination']	= $this->product->makePagination(site_url('product'), 2, $data['total_rows']);
		$data['page']		= 'pages/product/index';
		$this->view($data);
	}

	public function search($page = null)
	{
		if (isset($_POST['keyword'])) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		} else {
			redirect(base_url('category'));
		}
		$keyword 			= $this->session->userdata('keyword'); 
		$data['title']		= 'Product';
		$data['content']	= $this->product->select(
								['product.id', 'product.title', 'product.image', 'category.title AS category_title']
							)->join('category')->like('product.title', $keyword)->paginate($page)->get();
		$data['total_rows']	= $this->product->like('title', $keyword)->count();
		$data['pagination']	= $this->product->makePagination(site_url('product'), 3, $data['total_rows']);
		$data['page']		= 'pages/product/index';
		$this->view($data);
	}

	public function reset()
	{
		$this->session->unset_userdata('keyword');
		redirect(base_url('product'));
	}

}

/* End of file Product.php */
