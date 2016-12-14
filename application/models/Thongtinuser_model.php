<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongtinuser_model extends CI_Model
{

   function add_user($params)
   {
      $this->db->insert('thongtinuser',$params);
      return $this->db->insert_id();
   }

   function check_login($username, $matkhau)
	{
		$this->db->where(array('username' => $username, 'matkhau' => $matkhau));
		$query = $this->db->get('userlogin', 1);
		if($query->num_rows() > 0)
			return true;
		return false;
	}

	function get_thongtin($iduser)
	{
		$this->db->where(array('iduser' => $iduser));
		$query = $this->db->get('thongtinuser', 1);
		return $query->row_array();
	}

	function get_infologin($username)
	{
		$this->db->where(array('username' => $username));
		$query = $this->db->get('userlogin', 1);
		return $query->row_array();
	}
	
	function get_infologin_byid($iduser)
	{
		$this->db->where(array('iduser' => $iduser));
		$query = $this->db->get('userlogin', 1);
		return $query->row_array();
	}
	
	function get_matkhau($iduser)
	{
		$this->db->select('matkhau');
		$this->db->where(array('iduser' => $iduser));
		$query = $this->db->get('userlogin',1);
		return $query->row()->matkhau;
	}

	function update_user($iduser,$params)
	{
		$this->db->where('iduser', $iduser);
		return $this->db->update('thongtinuser', $params);
	}

	function update_userlogin($iduser,$params)
	{
		$this->db->where('iduser', $iduser);
		return $this->db->update('userlogin', $params);
	}

	function get_list_kichhoat($start = 0, $numrow = 15)
	{
		$this->db->from('userlogin');
		$this->db->join('thongtinuser', 'thongtinuser.iduser = userlogin.iduser', 'left');
		$this->db->where(array('userlogin.kichhoat' => 0, 'userlogin.transactionhash !=' => ''));
		$this->db->order_by('thongtinuser.ngaythamgia', 'asc');
		$this->db->limit($numrow, $start);
		return $this->db->get()->result_array();
	}

	function count_list_kichhoat()
	{
		$this->db->from('userlogin');
		$this->db->join('thongtinuser', 'thongtinuser.iduser = userlogin.iduser', 'left');
		$this->db->where(array('userlogin.kichhoat' => 0));
		return $this->db->count_all_results();
	}

	function add_userlogin($params)
   {
      $this->db->insert('userlogin',$params);
      return $this->db->insert_id();
   }

   function get_list_user($start = 0, $numrow = 15)
   {
   		$this->db->from('userlogin');
		$this->db->join('thongtinuser', 'thongtinuser.iduser = userlogin.iduser', 'left');
		$this->db->join('bacnguoidung', 'bacnguoidung.iduser = userlogin.iduser', 'left');
		$this->db->where('(userlogin.kichhoat = "1" and userlogin.vaitro = "0")');
		$this->db->limit($numrow, $start);
		$this->db->order_by('thongtinuser.ngaythamgia', 'asc');
		return $this->db->get()->result_array();
   }

   function count_list_user()
   {
   	$this->db->from('userlogin');
		$this->db->join('thongtinuser', 'thongtinuser.iduser = userlogin.iduser', 'left');
		$this->db->where('userlogin.kichhoat', '1');
		return $this->db->count_all_results();
   }

   function tim_nguoiduocgioithieu($iduser)
	{
		$this->db->from('userlogin');
		$this->db->join('thongtinuser', 'thongtinuser.iduser = userlogin.iduser', 'left');
		$this->db->where(array('thongtinuser.nguoigioithieu'=> $iduser) );
		return $this->db->get()->result_array();
	}

	function get_nguoigioithieu($code)
	{
		$this->db->select('iduser');
		$this->db->where(array('code'=> $code) );
		$query = $this->db->get('thongtinuser');
		return $query->row()->iduser;
	}

	function delete_kichhoat($iduser)
	{
		$this->db->where('userlogin.iduser', $iduser);
		$this->db->delete('userlogin');
		$this->db->where('thongtinuser.iduser', $iduser);
		return $this->db->delete('thongtinuser');
	}

	function get_songuoiduoi($iduser, $ngaynhay, $levelhientai)
	{
		$this->db->from('bacnguoidung');
		$this->db->join('thongtinuser', 'bacnguoidung.iduser = thongtinuser.iduser', 'left');
		$this->db->where(array('thongtinuser.iduser !=' => $iduser, 'ngaynhay >' => $ngaynhay, 'isuser' => '0', 'levelhientai' => $levelhientai));
		$this->db->order_by('ngaynhay', 'asc');
		return $this->db->get()->result_array();
	}

   	function count_child($iduser)
   	{
   		$this->db->from('thongtinuser');
		$this->db->where(array('nguoigioithieu' => $iduser));
		return $this->db->count_all_results();
   	}

   	function update_ngaythamgia($id, $ngaythamgia)
	{
		$this->db->set('ngaythamgia', $ngaythamgia);
		$this->db->where('iduser', $id);
		$this->db->update('thongtinuser');
	}
	
	function send_mail($recipient_email,$subject,$body)
	{
		$result_mail = false;		
		$headers = "";
		$headers .= "From: SNOWBALLWORLD <snowballworld@snowballworld.net> \r\n";
		$headers .= "Reply-To:" . "snowballworld@snowballworld.net" . "\r\n" ."X-Mailer: PHP/" . phpversion();
		$headers .= 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";     
		ini_set('SMTP','relay-hosting.secureserver.net');// SMTP server
		ini_set('smtp_port',25);//SMTP server port  
		$mail = mail($recipient_email,$subject,$body,$headers);
		if($mail)
		{
			$result_mail = true;
		}
		else
		{
			$result_mail = false;
		}
		return $result_mail;
	}
	
}