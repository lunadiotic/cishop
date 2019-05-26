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

}

/* End of file Cart.php */
