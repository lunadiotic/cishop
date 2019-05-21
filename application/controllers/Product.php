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
								['product.id', 'product.title', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
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
								['product.id', 'product.title', 'product.image', 'product.price', 'product.is_available', 'category.title AS category_title']
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

	public function create()
	{
		if (!$_POST) {
			$input = (object) $this->product->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
		}

		if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($input->title, '-', true).'-'.date('YmdHis');
			$upload		= $this->product->uploadImage('image', $imageName);
			if ($upload) {
				$input->image = $upload['file_name'];
			} else {
				redirect('product/create');
			}
		}

		if (!$this->product->validate()) {
			$data['title']			= 'Create Product';
			$data['input']			= $input;
			$data['form_action']	= '/product/create';
			$data['page']			= 'pages/product/form';
			$this->view($data);
			return;
		}

		if ($this->product->create($input)) {
			$this->session->set_flashdata('success', 'Data sudah berhasil disimpan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect('product');
	}

	public function edit($id = null)
	{
		$data['content'] = $this->product->where('id', $id)->first();

		if (!$data['content']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan!');
			redirect('product');
		}

		if (!$_POST) {
			$data['input']	= (object) $data['content'];
		} else {
			$data['input']	= (object) $this->input->post(null, true);
		}

		var_dump($data['input']);

		if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($data['input']->title, '-', true).'-'.date('YmdHis');
			$upload		= $this->product->uploadImage('image', $imageName);
			if ($upload) {
				if ($data['content']->image !== '') {
					$this->product->deleteImage($data['content']->image);
				}
				$data['input']->image = $upload['file_name'];
			} else {
				redirect('product/create');
			}
		}

		if (!$this->product->validate()) {
			$data['title']			= 'Edit Product';
			$data['form_action']	= "product/edit/{$id}";
			$data['page']			= 'pages/product/form';
			$this->view($data);
			return;
		}

		if ($this->product->where('id', $id)->update($data['input'])) {
			$this->session->set_flashdata('success', 'Data berhasil diperbaharui');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect('product');
	}

}

/* End of file Product.php */
