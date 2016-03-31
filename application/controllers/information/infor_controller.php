<?php
class Infor_controller extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('attendent/attend_model');
		$this->load->model('infor/infor_model');
	}

	function index(){
		$openid=$_REQUEST['openid'];
		$detail['info']= $this->attend_model->getInfo($openid);
		$this->load->view('information/information',$detail);
	}

	function submit_info(){
		//从前台页面接受传值
		$data['infor_usr_id']=$_REQUEST['infor_usr_id'];
		$data['infor_date'] = $_REQUEST['infor_date'];
		$data['infor_type'] = $_REQUEST['infor_type'];
		switch ($data['infor_type']){
			case 'stay':$topic = '留校登记';break;
			case 'prize':$topic= '获奖登记';break;
			default:echo "<script>alert('请选择正确信息类型');history.go(-1);</script>";//如果用户没有选择
		}
		$data['infor_topic'] = $topic;
		$data['infor_content'] = $_REQUEST['infor_content'];
		$this->infor_model->submitInfor($data);
		echo "<script>alert('信息登记完成');history.go(-1); </script>";
	}

}
