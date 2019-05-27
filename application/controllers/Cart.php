<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MY_Controller 
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
		$data['title']		= 'Cart';
		$data['content']	= $this->cart->select([
			'cart.id', 'cart.qty', 'cart.subtotal' , 'product.title', 'product.image', 'product.price'
		])->join('product')->get();
		$data['page']		= 'pages/cart/index';
		
		$this->view($data);
	}
	

	public function add()
	{
		if (!$_POST) {
			redirect(base_url('/'));
		} else {
			$input		= (object) $this->input->post(null, true);
			$total		= $input->qty * $input->price;
			$data		= [
				'id_user'		=> $this->id_user,
				'id_product'	=> $input->id_product,
				'qty'			=> $input->qty,
				'subtotal'		=> $total
			];
		}

		if ($this->cart->create($data)) {
			$this->session->set_flashdata('success', 'Produk berhasil ditambahkan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi kesalahan!');
		}

		redirect(base_url('/'));
	}

	public function update($id = null)
	{
		if (!$_POST || $this->input->post('qty') <= 0) {
			redirect(base_url('/cart/index'));
		}

		$data['content'] = $this->cart->where('id', $id)->first();

		if (!$data['content']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan!');
			redirect(base_url('/cart/index'));
		}

		$data['input']	= (object) $this->input->post(null, true);
		$cart			= [
			'qty'		=> $data['input']->qty,
			'subtotal'	=> $data['input']->price * $data['input']->qty
		];

		if ($this->cart->where('id', $id)->update($cart)) {
			$this->session->set_flashdata('success', 'Data sudah berhasil diubah!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect(base_url('/cart/index'));
	}

	public function delete($id = null)
	{
		if (!$_POST) {
			redirect(base_url('/cart/index'));
		}

		$content = $this->cart->where('id', $id)->first();

		if (!$content) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan!');
			redirect('category');
		}

		if ($this->cart->where('id', $id)->delete()) {
			$this->session->set_flashdata('success', 'Data sudah berhasil dihapus!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect(base_url('/cart/index'));
	}

}

/* End of file Cart.php */
