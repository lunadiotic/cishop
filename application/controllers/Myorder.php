<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Myorder extends MY_Controller 
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
		$data['title']		= 'Orders';
		$data['content']	= $this->myorder->where('id_user', $this->id_user)->orderBy('date', 'DESC')->get();
		$data['page']		= 'pages/myorder/index';
		$this->view($data);
	}

	public function detail($invoice = null)
	{
		$data['order']	= $this->myorder->where('invoice', $invoice)->first();

		if (!$data['order']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan!');
			redirect(base_url('/myorder'));
		}

		$data['order_detail'] = $this->db->select([
									'orders_detail.id_orders', 'orders_detail.id_product', 
									'orders_detail.qty', 'orders_detail.subtotal' , 
									'product.title', 'product.image', 'product.price'
								])
								->join('product', 'orders_detail.id_product = product.id', 'left')
								->where('orders_detail.id_orders', $data['order']->id)
								->get('orders_detail')
								->result();
		
		if ($data['order']->status != 'waiting') {
			$this->myorder->table = 'orders_confirm';
			$data['order_confirm'] = $this->myorder->where('id_orders', $data['order']->id)->first();
		}

		$data['page']	= 'pages/myorder/detail';
		$this->view($data);
	}

	public function confirm($invoice = null)
	{
		$data['order']	= $this->myorder->where('invoice', $invoice)->first();

		if (!$data['order']) {
			$this->session->set_flashdata('warning', 'Data tidak ditemukan!');
			redirect(base_url('/myorder'));
		}

		if ($data['order']->status !== 'waiting') {
			$this->session->set_flashdata('warning', 'Bukti transfer sudah dikirim!');
			redirect("myorder/confirm/{$invoice}");
		}

		if (!$_POST) {
			$data['input']			= (object) $this->myorder->getDefaultValues();
			$data['input']->invoice	= $invoice;
		} else {
			$data['input']	= (object) $this->input->post(null, true);
		}

		if (!empty($_FILES) && $_FILES['image']['name'] !== '') {
			$imageName	= url_title($invoice, '-', true).'-'.date('YmdHis');
			$upload		= $this->myorder->uploadImage('image', $imageName);
			if ($upload) {
				$data['input']->image = $upload['file_name'];
			} else {
				redirect("myorder/confirm/{$invoice}");
			}
		}

		if (!$this->myorder->validate()) {
			$data['title']			= 'Edit Product';
			$data['form_action']	= "myorder/confirm/{$invoice}";
			$data['page']			= 'pages/myorder/confirm';
			$this->view($data);
			return;
		}

		$this->myorder->table = 'orders_confirm';
		unset($data['input']->invoice);

		if ($this->myorder->create($data['input'])) {
			$this->myorder->table = 'orders';
			$this->myorder->where('id', $data['input']->id_orders)->update(['status' => 'paid']);
			$this->session->set_flashdata('success', 'Data sudah berhasil disimpan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect("myorder/detail/{$invoice}");
	}

	public function image_required()
	{
		if (empty($_FILES) || $_FILES['image']['name'] === '') {
			$this->session->set_flashdata('image_error', 'Bukti transfer tidak boleh kosong!');
			return false;
		}
		return true;
	}

}

/* End of file ProfileOrder.php */
