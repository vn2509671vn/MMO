<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Danhsachnguoidung extends Admin {

	public function index()
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->library('pagination');
		$this->load->model('Thongtinuser_model');
      $this->config->load('my_config');
      $config['total_rows'] = $this->Thongtinuser_model->count_list_user();
      $config['per_page'] = 100;
      $config['base_url'] = admin_url() .'/user-list';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
     	$start_row = intval($this->input->get('bat-dau'));
		$data['list_user'] = $this->Thongtinuser_model->get_list_user($start_row, $config['per_page']);
		$this->layout = 'common/danhsachthanhvien';
		$this->render($data);
	}
}