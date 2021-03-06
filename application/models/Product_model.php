<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends MY_Model 
{

	protected $perPage = 5;

	public function getDefaultValues()
	{
		return [
			'id_category'	=> '',
			'slug'			=> '',
			'title'			=> '',
			'description'	=> '',
			'price'			=> '',
			'image'			=> '',
			'is_available'	=> ''
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field' => 'id_category',
				'label'	=> 'Kategori',
				'rules' => 'required',
			],
			[
				'field' => 'slug',
				'label'	=> 'Slug',
				'rules' => 'trim|required',
			],
			[
				'field' => 'title',
				'label'	=> 'Nama Produk',
				'rules' => 'trim|required',
			],
			[
				'field' => 'description',
				'label'	=> 'Deskripsi',
				'rules' => 'trim|required',
			],
			[
				'field' => 'price',
				'label'	=> 'Harga',
				'rules' => 'trim|required|numeric',
			],
			[
				'field' => 'is_available',
				'label'	=> 'Tersedia',
				'rules' => 'trim|required',
			]
		];

		return $validationRules;
	}

	/**
	 * Upload Image Product
	 *
	 * @param String $fieldName
	 * @param String $fileName
	 * @return void
	 */
	public function uploadImage($fieldName, $fileName)
	{
		$config = [
			'upload_path'	=> './images/product',
			'file_name'		=> $fileName,
			'allowed_types' => 'jpg|gif|png|jpeg|JPG|PNG',
			'max_size'		=> 1024, //1mb
			'max_width'		=> 0,
			'max_height'	=> 0,
			'overwrite'		=> true,
			'file_ext_tolower' => true
		];

		$this->load->library('upload', $config);
		if ($this->upload->do_upload($fieldName)) {
			return $this->upload->data();
		} else {
			$this->session->set_flashdata('image_error', $this->upload->display_errors('', ''));
			return false;
		}
	}

	/**
	 * Delete Old Image
	 *
	 * @param String $fileName
	 * @return void
	 */
	public function deleteImage($fileName)
	{
		if (file_exists("./images/product/$fileName")) {
			unlink("./images/product/$fileName");
		}
	}

}

/* End of file Product_model.php */
