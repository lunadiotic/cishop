<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

	public function index($page = null)
	{
		$data['title']	= 'Index';
		$data['content']	= $this->home->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
		)->where('product.is_available', 1)->join('category')->paginate($page)->get();
		$data['total_rows']	= $this->home->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
		)->where('product.is_available', 1)->join('category')->count();
		$data['pagination']	= $this->home->makePagination(site_url('home'), 2, $data['total_rows']);
		$data['page']	= 'pages/index';
		$this->view($data);
	}

	public function sortby($sort, $page = null)
	{
		$data['title']	= 'Index';
		$data['content']	= $this->home->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
		)->where('product.is_available', 1)->join('category')->orderBy('product.price', $sort)->paginate($page)->get();
		$data['total_rows']	= $this->home->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
		)->where('product.is_available', 1)->join('category')->orderBy('product.price', $sort)->count();
		$data['pagination']	= $this->home->makePagination(site_url("home/sortby/$sort"), 4, $data['total_rows']);
		$data['page']	= 'pages/index';
		$this->view($data);
	}

}

/* End of file Home.php */
