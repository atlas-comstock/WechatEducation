<?php 
class Infor_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function submitInfor($data){
		$this->db->insert ('information',$data);
	}
}
?>