<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lichsu extends Admin {

	public function get_lichsu($iduser)
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->model('Thongtintien_model');
		$this->load->library('pagination');
      $this->config->load('my_config');
		
      $config['total_rows'] = $this->Thongtintien_model->get_count_lichsu($iduser);
      $config['per_page'] = $this->config->item('per_page');
      $config['base_url'] = home_url() .'/tranfer-history';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
     	$start_row = intval($this->input->get('bat-dau'));
		$data['lichsu'] = $this->Thongtintien_model->get_lichsu($iduser, $start_row, $config['per_page']);
		$this->layout = 'common/lichsu';
		 //$this->load->view('admin/common/lichsu',$data);
		$this->render($data);
	}
}