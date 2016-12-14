<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongtin extends Site {

	function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('session_login'))
		{
			redirect(home_url());
		}
	}
	
	public function index()
	{
		$this->load->model('Thongtinuser_model');
		$data['info_user'] = $this->Thongtinuser_model->get_thongtin($this->session->userdata('iduser'));
		$data['thongtinbac'] = $this->get_thongtinbac();
		//++Duy add tong tien hoa hong
		$data['total_hoahongtructiep'] = $this->get_total_hoahongtructiep();
		$data['total_hoahongnhaycung'] = $this->get_total_hoahong() - $this->get_total_hoahongtructiep();
		$data['number_of_child'] = $this->get_total_child();
		//--
		$this->layout = 'common/thongtin';
		$this->render($data);
	}

	public function nguoiduoi()
	{
		$this->load->model('Thongtinuser_model');
		$check = $this->get_thongtinbac();
		$data['info_user'] = $this->Thongtinuser_model->get_songuoiduoi($check['iduser'], $check['ngaynhay'], $check['levelhientai']);
		$this->layout = 'common/nguoiduoi';
		$this->render($data);
	}

	public function nguoiduocgioithieu()
	{
		$data['list'] = $this->timnguoiduocgioithieu();
		$this->layout = 'common/nguoiduocgioithieu';
		$this->render($data);
	}

	function get_thongtinbac()
	{
		$this->load->model('Thongtinbac_model');
		$this->load->model('Thongtintien_model');
		return $this->Thongtinbac_model->get_thongtinbac($this->session->userdata('iduser'));
	}

	function timnguoiduocgioithieu()
	{
		$this->load->model('Thongtinuser_model');
		return $this->Thongtinuser_model->tim_nguoiduocgioithieu($this->session->userdata('iduser'));
	}

	//++Duy add tinh tong tien hoa hong
	function get_total_hoahong()
	{
		$this->load->model('Thongtinthunhap_model');
		return $this->Thongtinthunhap_model->get_total_hoahong($this->session->userdata('iduser'));
	}
	
	function get_total_hoahongtructiep()
	{
		$this->load->model('Thongtinthunhap_model');
		return $this->Thongtinthunhap_model->get_total_hoahongtructiep($this->session->userdata('iduser'));
	}
	//--

	//++Duy add tinh tong so con
	function get_total_child()
	{
		$this->load->model('Thongtinuser_model');
		return $this->Thongtinuser_model->count_child($this->session->userdata('iduser'));
	}
	//--
}