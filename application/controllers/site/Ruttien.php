<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruttien extends Site {
	function __construct()
	{
		parent::__construct();
		if(!$this->session->has_userdata('session_login'))
		{
			redirect(home_url());
		}
		if($this->session->has_userdata('role'))
		{
			redirect(home_url());
		}
	}
	
	public function index()
	{
		$this->load->model('Thongtinuser_model');
		$this->load->model('Thongtintien_model');
		$data['thongtin_user'] = $this->Thongtinuser_model->get_infologin_byid($this->session->userdata('iduser'));
				$this->load->library('form_validation');
		$this->form_validation->set_rules('sotien', 'Amount of money', 'required|trim|regex_match[/^\s*(?=.*[1-9])\d*(?:\.\d{1,2})?\s*$/]');
		$this->form_validation->set_rules('kiemtratien', 'Amount of money', 'callback_kiemtratien');
		if( $this->form_validation->run() == TRUE)
		{
			// idUser
			$id = $this->session->userdata('iduser');
			$sotien = $this->input->post('sotien');
			$params = array('sotienrut' => $sotien,
				'iduser' => $id,
				'trangthai' => '0',
				'ngayruttien' => date('Y-m-d H:i:s'),
				'mahash' =>'');
			$this->Thongtintien_model->add_lichsu($params);
			redirect(home_url('tranfer-history'));
		} 
		$this->load->model('Thongtintien_model');
		// thông tin user
		$data['thongtin'] = $this->Thongtintien_model->get_thongtinuser($this->session->userdata('info_login'));
		$data['Available_Cash'] = $this->get_sotienhienco();
		$this->layout = 'common/ruttien';
		$this->render($data);
	}

	function get_ruttien()
	{	
		$this->load->model('Thongtinbac_model');
		$this->Thongtinbac_model->get_sotienhienco($this->session->userdata('iduser'));
		
		return $this->Thongtinbac_model->get_sotienhienco($id);
	}

	function get_sotienhienco()
	{
		$this->load->model('Thongtinbac_model');
		return $this->Thongtinbac_model->get_sotienhienco($this->session->userdata('iduser'));
	}
	
	//++Duy add lay tong so tien co the rut duoc
	function get_availablemoney()
	{
		$this->load->model('Thongtinbac_model');
		$tongtien = $this->Thongtinbac_model->get_sotienhienco($this->session->userdata('iduser'));
		$waiting = $this->Thongtintien_model->get_total_waiting_cash($this->session->userdata('iduser'));
		return $tongtien - $waiting;
	}
	//--
	
	function kiemtratien()
	{
		$this->load->model('Thongtinuser_model');
		$user_info = $this->Thongtinuser_model->get_thongtin($this->session->userdata('iduser'));
		$sotienhienco = $this->get_availablemoney();
		$sotienrut = $this->input->post('sotien');
		// $sotien = $sotienrut + $sotienrut*(10/100); xóa dòng này NEW

		 if ($sotienrut <=  $sotienhienco) // NEW
	      {
	      	//++Duy add inform level up -> mail to admin
			$recipient_email = 'snowball.us2016@gmail.com';
			$subject = "[Snowballworld] New withdraw cash";
			$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
			$body = $user_info['hoten'].' has just withdrawed cash.
			<br />Please approve it '.$htmlStr;
			$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
			//--
	    	return true;
	      }
	      else
	      {	
		      $this->form_validation->set_message('kiemtratien', 'Withdraw cash must be less than available cash! 
		      Please check your tranfer history.');
	         return FALSE;
	      }
	}

}