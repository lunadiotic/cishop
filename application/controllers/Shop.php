<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MY_Controller 
{
	public function sortby($sort, $page = null)
	{
		$data['title']	= 'Shop';
		$data['content']	= $this->shop->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
		)->where('product.is_available', 1)->join('category')->orderBy('product.price', $sort)->paginate($page)->get();
		$data['total_rows']	= $this->shop->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
		)->where('product.is_available', 1)->join('category')->orderBy('product.price', $sort)->count();
		$data['pagination']	= $this->shop->makePagination(site_url("shop/sortby/$sort"), 4, $data['total_rows']);
		$data['page']	= 'pages/index';
		$this->view($data);
	}

	public function category($category, $page = null)
	{
		$data['title']	= 'Index';
		$data['content']	= $this->shop->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title', 'category.slug AS category_slug']
		)->where('product.is_available', 1)->where('category.slug', $category)->join('category')->paginate($page)->get();
		$data['total_rows']	= $this->shop->select(
			['product.id', 'product.title', 'product.description', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title', 'category.slug AS category_slug']
		)->where('product.is_available', 1)->where('category.slug', $category)->join('category')->count();
		$data['pagination']	= $this->shop->makePagination(site_url("shop/sortby/$category"), 4, $data['total_rows']);
		$data['page']	= 'pages/index';
		$this->view($data);
	}
}

/* End of file Shop.php */
