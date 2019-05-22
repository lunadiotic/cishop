<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller 
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
		$data['title']		= 'User';
		$data['content']	= $this->user->paginate($page)->get();
		$data['total_rows']	= $this->user->count();
		$data['pagination']	= $this->user->makePagination(site_url('user'), 2, $data['total_rows']);
		$data['page']		= 'pages/user/index';
		$this->view($data);
	}

	public function search($page = null)
	{
		if (isset($_POST['keyword'])) {
			$this->session->set_userdata('keyword', $this->input->post('keyword'));
		} else {
			redirect(base_url('user'));
		}
		$keyword 			= $this->session->userdata('keyword'); 
		$data['content']	= $this->user->like('name', $keyword)
							  ->orLike('email', $keyword)
							  ->paginate($page)
							  ->get();
		$data['total_rows']	= $this->user->like('name', $keyword)->orLike('email', $keyword)->count();
		$data['pagination']	= $this->user->makePagination(site_url('user/search'), 3, $data['total_rows']);
		$data['page']		= 'pages/user/index';
		$this->view($data);
	}

	public function reset()
	{
		$this->session->unset_userdata('keyword');
		redirect(base_url('user'));
	}

	public function create()
	{
		if (!$_POST) {
			$input = (object) $this->user->getDefaultValues();
		} else {
			$input = (object) $this->input->post(null, true);
			$this->load->library('form_validation');			
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		}

		if (!empty($_FILES) && $_FILES['photo']['name'] !== '') {
			$imageName	= url_title($input->name, '-', true).'-'.date('YmdHis');
			$upload		= $this->user->uploadImage('photo', $imageName);
			if ($upload) {
				$input->photo = $upload['file_name'];
			} else {
				redirect('user/create');
			}
		}

		if (!$this->user->validate()) {
			$data['title']			= 'Tambah Pengguna';
			$data['input']			= $input;
			$data['form_action']	= '/user/create';
			$data['page']			= 'pages/user/form';
			$this->view($data);
			return;
		}

		if ($this->user->create($input)) {
			$this->session->set_flashdata('success', 'Data sudah berhasil disimpan!');
		} else {
			$this->session->set_flashdata('error', 'Oops! Terjadi Kesalahan!');
		}

		redirect('user');
	}
}

/* End of file User.php */
