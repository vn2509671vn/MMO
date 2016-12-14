<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lockaccount_model extends CI_Model
{
	function count_list_lock($date)
	{
		$this->db->from('thongtinuser');
		$this->db->where(array('timeremain IS NOT NULL' => null, 'timeremain <=' => $date));
		return $this->db->count_all_results();
	}
	
    function get_list_lock($start = 0, $numrow = 15, $date)
   {
  	    $this->db->from('thongtinuser');
		$this->db->where(array('timeremain IS NOT NULL' => null, 'timeremain <=' => $date));
		$this->db->limit($numrow, $start);
		$this->db->order_by('timeremain', 'asc');
		return $this->db->get()->result_array();
   }
   
   function get_trangthaikhoa($iduser)
   {
        $this->db->select('trangthaikhoa');
		$this->db->where('iduser', $iduser);
		return $this->db->get('thongtinuser')->row()->trangthaikhoa;
   }
   
   function update_trangthaikhoa($iduser, $trangthaikhoa)
   {
       	$this->db->where('iduser', $iduser);
		return $this->db->update('thongtinuser', $trangthaikhoa);
   }
   
   function update_timeremain($iduser, $timeremain)
   {
       $this->db->where('iduser', $iduser);
		return $this->db->update('thongtinuser', $timeremain);
   }
}