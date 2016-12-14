<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongtinthunhap extends Site {

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
      $config['total_rows'] = $this->get_count_income_info($id);
       $config['per_page'] = $this->config->item('per_page');
      $config['base_url'] = home_url() .'/income-info';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
     	$start_row = intval($this->input->get('bat-dau'));
		$data['income_info'] = $this->get_income_info($id,$start_row, $config['per_page']);
		$this->layout = 'common/thongtinthunhap';
		$this->render($data);
	}

	function get_income_info($iduser,$start = 0, $numrow = 15)
	{
		$this->load->model('Thongtinthunhap_model');
		return $this->Thongtinthunhap_model->get_income_info($iduser,$start,$numrow);
	}
	function get_count_income_info($iduser)
	{
		$this->load->model('Thongtinthunhap_model');
		return $this->Thongtinthunhap_model->get_count_income_info($iduser);
	}

	function get_history()
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
      $config['total_rows'] = $this->Thongtintien_model->get_count_hoahong($id);
      $config['per_page'] = $this->config->item('per_page');
      $config['base_url'] = home_url() .'/history-info';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
     	$start_row = intval($this->input->get('bat-dau'));
		$data['income_info'] = $this->Thongtintien_model->get_hoahong($id,$start_row, $config['per_page']);
		$this->layout = 'common/lichsuhoahong';
		$this->render($data);
	}
}