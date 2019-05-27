<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller 
{

	public function index()
	{
		$data['cart'] 	= $this->db->select([
			'cart.id', 'cart.qty', 'cart.subtotal', 'product.id', 'product.title', 'product.image', 'product.price'
		])->join('product', 'cart.id_product = product.id', 'left')->get('cart')->result();

		if (!$data['cart']) {
			$this->session->set_flashdata('warning', 'Tidak ada produk dalam keranjang!');
			redirect(base_url('/'));
		}

		$data['page']	= 'pages/checkout/index';
		
		$this->view($data);
	}

}

/* End of file Checkout.php */
