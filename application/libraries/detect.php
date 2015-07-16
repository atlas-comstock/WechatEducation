<?php 
class Detect{
	
	public $ci;
	
	function __construct(){
			$this->ci = &get_instance();
			$this->ci->load->model('attendent/attend_model');
			$this->check_bind();
	}
	
	function check_bind(){
		$open_id = $_REQUEST['openid'];
		$num = $this->ci->attend_model->check_bind($open_id)->num_rows();
		if ($num==0){
// 			redirect();//绑定界面
			echo "no bind";
		}
	}
}
?>