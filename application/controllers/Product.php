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

}

/* End of file Product.php */
