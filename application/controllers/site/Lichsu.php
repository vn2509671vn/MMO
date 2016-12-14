<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lichsu extends Site {

	public function index()
	{
		if(!$this->session->has_userdata('session_login'))
		{
			redirect(home_url());
		}
		if($this->session->has_userdata('role'))
		{
			redirect(home_url());
		}
		$this->load->model('Thongtintien_model');
		$this->load->library('pagination');
      $this->config->load('my_config');
		$id = $this->session->userdata('iduser');
      $config['total_rows'] = $this->Thongtintien_model->get_count_lichsu($id);
      $config['per_page'] = $this->config->item('per_page');
      $config['base_url'] = home_url() .'/tranfer-history';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
     	$start_row = intval($this->input->get('bat-dau'));
		$data['lichsu'] = $this->Thongtintien_model->get_lichsu($id, $start_row, $config['per_page']);
		$this->layout = 'common/lichsu';
		$this->render($data);
	}
}