<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Thongtintien_model extends CI_Model
{
	
	function get_iduser($sodienthoai)
	{
		$this->db->select('iduser');
		$this->db->where(array('sodienthoai' => $sodienthoai));
		$query = $this->db->get('thongtinuser');
		return $query->row()->iduser;
	}

	function add_lichsu($params)
	{
		$this->db->insert('thongtintien',$params);
	}
	
	function get_lichsu($id, $start = 0, $numrow = 15)
	{
		$this->db->from('thongtintien');
		$this->db->join('thongtinuser','thongtinuser.iduser = thongtintien.iduser');
		$this->db->where(array('thongtintien.iduser' => $id));
		$this->db->limit($numrow, $start);
		$this->db->order_by('thongtintien.ngayduoctra', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_count_lichsu($id)
	{
		$this->db->from('thongtintien');
		$this->db->join('thongtinuser','thongtinuser.iduser = thongtintien.iduser');
		$this->db->where(array('thongtintien.iduser' => $id));
		return $this->db->count_all_results();
	}

	function get_hoahong($id, $start = 0, $numrow = 15)
	{
		$this->db->from('lichsuhoahong');
		$this->db->join('thongtinuser','thongtinuser.iduser = lichsuhoahong.iduser');
		$this->db->where(array('lichsuhoahong.iduser' => $id));
		$this->db->limit($numrow, $start);
		$this->db->order_by('lichsuhoahong.id', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_count_hoahong($id)
	{
		$this->db->from('lichsuhoahong');
		$this->db->join('thongtinuser','thongtinuser.iduser = lichsuhoahong.iduser');
		$this->db->where(array('lichsuhoahong.iduser' => $id));
		return $this->db->count_all_results();
	}

	function add_thongtintien($params)
	{
		$this->db->insert('thongtintien',$params);
      return $this->db->insert_id();
	}

	function get_list_rutien($start = 0, $numrow = 15)
	{
		$this->db->where(array('thongtintien.trangthai' => 0, 'thongtintien.mahash' => ''));
		$this->db->from('thongtintien');
		$this->db->join('thongtinuser', 'thongtintien.iduser = thongtinuser.iduser', 'left');
		$this->db->limit($numrow, $start);
		$this->db->order_by('thongtintien.ngayruttien', 'asc');
		return $this->db->get()->result_array();
	}

	function count_list_rutien()
	{
		$this->db->where(array('thongtintien.trangthai' => 0, 'thongtintien.mahash' => ''));
		$this->db->from('thongtintien');
		$this->db->join('thongtinuser', 'thongtintien.iduser = thongtinuser.iduser', 'left');
		return $this->db->count_all_results();
	}

	function update_thongtintien($id,$params)
	{
		$this->db->where('id', $id);
		return $this->db->update('thongtintien', $params);
	}

	function get_thongtinuser($sodienthoai)
	{
		$this->db->where(array('sodienthoai' => $sodienthoai));
		$query = $this->db->get('thongtinuser');
		return $query->result_array();
	}

	function update_sotienhienco($iduser,$params)
	{
		$this->db->where('iduser', $iduser);
		return $this->db->update('bacnhay',$params);
	}

	function get_sotienrut($id)
	{
		$this->db->select('sotienrut');
		$this->db->where('id', $id);
		return $this->db->get('thongtintien')->row()->sotienrut;

	}

	function add_thongtinthunhap($params)
	{
		$this->db->insert('thongtinthunhap',$params);
	}

	function get_iduser_ttt($id)
	{
		$this->db->select('iduser');
		$this->db->where(array('id' => $id));
		$query = $this->db->get('thongtintien');
		return $query->row()->iduser;
	}
	function delete_lichsu($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('thongtintien');
	}

	//++Duy add tinh tong tien hoa hong
	function get_total_waiting_cash($iduser)
	{
	$query = $this->db->select_sum('sotienrut', 'Total_sotienrut');
	$query = $this->db->where(array('iduser' => $iduser, 'trangthai' => 0));
	$query = $this->db->get('thongtintien');
	$result = $query->result();
	return $result[0]->Total_sotienrut;
	}
	//--
}
