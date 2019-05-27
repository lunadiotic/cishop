<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller 
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
		$data['cart'] 	= $this->db->select([
			'cart.id', 'cart.qty', 'cart.subtotal', 'product.id', 'product.title', 'product.image', 'product.price'
		])->join('product', 'cart.id_product = product.id', 'left')->get('cart')->result();

		if (!$data['cart']) {
			$this->session->set_flashdata('warning', 'Tidak ada produk dalam keranjang!');
			redirect(base_url('/'));
		}

		$data['title']	= 'Checkout';
		$data['input']	= (object) $this->checkout->getDefaultValues();
		$data['page']	= 'pages/checkout/index';
		
		$this->view($data);
	}

	function done()
	{
		if (!$this->checkout->validate()) {
			return $this->index();
		}

		$input = (object) $this->input->post(null, true);
		$total = $this->db->select_sum('subtotal')->where('id_user', $this->id_user)->get('cart')->row()->subtotal;
		
		$data = [
			'id_user'	=> $this->id_user,
			'date'		=> date('Y-m-d'),
			'invoice'	=> $this->id_user.date('YmdHis'),
			'total'		=> $total,
			'name'		=> $input->name,
			'address'	=> $input->address,
			'phone'		=> $input->phone,
			'status'	=> 'waiting'
		];

		// var_dump($data);

		if ($this->checkout->create($data)) {
			$this->session->set_flashdata('success', 'Data sudah berhasil disimpan!');
			$data['title']		= 'Checkout Berhasil';
			$data['page']		= 'pages/checkout/success';
			$data['content']	= (object) $data;
			return $this->view($data);
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
			return $this->index();
		}
	}

}

/* End of file Checkout.php */
