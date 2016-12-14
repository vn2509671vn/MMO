<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruttien extends Admin {

	public function index()
	{
		if($this->session->userdata('role') != 1)
		{
			redirect(home_url());
		}
		$this->load->library('pagination');
		$this->load->model('Thongtintien_model');
		$this->load->model('Thongtinbac_model');

      $this->config->load('my_config');
      $config['total_rows'] = $this->Thongtintien_model->count_list_rutien();
      $config['per_page'] = $this->config->item('per_page');
      $config['base_url'] = admin_url() .'/approve-withdraw';
      $this->pagination->initialize($config);
      $data['pagination'] = $this->pagination->create_links();
    	$start_row = intval($this->input->get('bat-dau'));
		$data['thongtin_tien'] = $this->Thongtintien_model->get_list_rutien($start_row, $config['per_page']);
		$this->layout = 'common/ruttien';
		$this->render($data);
	}

	function get_ruttien()
	{
		if($this->input->post())
		{
			$id = $this->input->post('id');
			$mahash = $this->input->post('transaction_hash');
			$this->load->model('Thongtintien_model');
			date_default_timezone_set('Asia/Ho_Chi_Minh');
			$params = array(
				'trangthai' => 1,
				'mahash' => $mahash,
				'ngayduoctra' => date('Y-m-d H:i:s')
			);
			
			$this->load->model('Thongtintien_model');
			$this->Thongtintien_model->get_sotienrut($id);
			$this->load->model('Thongtinbac_model');
			$iduser_ttt = $this->Thongtintien_model->get_iduser_ttt($id); 
			$sotienhienco = $this->Thongtinbac_model->get_sotienhienco($iduser_ttt); 
			$sotienrut = $this->Thongtintien_model->get_sotienrut($id); 
			$sotienhienco_update = $sotienhienco - $sotienrut;// NEW
			$params_tien = array('sotienhienco'=> $sotienhienco_update);  // NEW
			if($sotienhienco >= $sotienrut) // NEW
			{
				$this->Thongtintien_model->update_sotienhienco($iduser_ttt, $params_tien); // NEW
				$this->Thongtintien_model->update_thongtintien($id, $params);
				
				$this->load->model('Thongtinuser_model');
				$user_info = $this->Thongtinuser_model->get_thongtin($iduser_ttt);
				//++Duy add inform level up -> mail to user
				$recipient_email = $user_info['email'];
				$subject = "[Snowballworld] Withdraw cash";
				$htmlStr = "<a href='https://snowballworld.net' target='_blank'>Snowball World.</a><br />";
				$body = 'Your withdraw cash request has been approved.
				<br />Check your cash in '.$htmlStr;
				$mail = $this->Thongtinuser_model->send_mail($recipient_email,$subject,$body);
				//--
					
				$this->session->set_flashdata('mess','Approve withdraw successfully'); 			
				// echo admin_url('approve-withdraw');
			}
			else
			{
				$this->Thongtintien_model->delete_lichsu($id);
				// echo 'f';
			}

		}
	}
}