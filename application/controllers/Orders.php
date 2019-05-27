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

	public function detail($id = null)
	{
		$data['order'] = $this->orders->where('id', $id)->first();

		if (!$data['order']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan!');
			redirect(base_url('/orders'));
		}

		$data['title']	= 'Order Detail';
		$this->orders->table = 'orders_detail';
		$data['order_detail'] = $this->orders->select([
									'orders_detail.id_orders', 'orders_detail.id_product', 
									'orders_detail.qty', 'orders_detail.subtotal' , 
									'product.title', 'product.image', 'product.price'
								])
								->where('orders_detail.id_orders', $data['order']->id)
								->join('product')
								->get();

		if ($data['order']->status != 'waiting') {
			$this->orders->table = 'orders_confirm';
			$data['order_confirm'] = $this->orders->where('id_orders', $data['order']->id)->first();
		}

		$data['form_action']	= "orders/update/{$id}";
		$data['page']			= 'pages/orders/detail';
		$this->view($data);		
	}

	public function update($id = null)
	{
		if (!$_POST) {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
			redirect(base_url("orders/detail/$id"));
		}
		
		if ($this->orders->where('id', $id)->update(['status' => $this->input->post('status')])) {
			$this->session->set_flashdata('success', 'Data berhasil diperbaharui');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect(base_url("orders/detail/$id"));
	}

}

/* End of file Orders.php */
