<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model 
{

	protected $perPage = 5;

	public function getDefaultValues()
	{
		return [
			'name'		=> '',
			'email'		=> '',
			'password'	=> '',
			'role'		=> '',
			'photo'		=> '',
			'is_active'	=> '',
		];
	}

	public function getValidationRules()
	{
		$validationRules = [
			[
				'field'	=> 'name',
				'label' => 'Name',
				'rules'	=> 'trim|required'
			],
			[
				'field' => 'email',
				'label' => 'E-Mail',
				'rules' => 'trim|required|valid_email|is_unique[user.email]',
				'errors' => [
					'is_unique' => 'This %s already exists.'
				]
			],
			[
				'field'	=> 'role',
				'label' => 'Role',
				'rules'	=> 'required'
			],
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
			'upload_path'	=> './images/profile',
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
		if (file_exists("./images/profile/$fileName")) {
			unlink("./images/profile/$fileName");
		}
	}

}

/* End of file User_model.php */
