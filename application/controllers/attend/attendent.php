<?php
date_default_timezone_set('prc');
class Attendent extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model('attendent/attend_model');
	}
	
	//考勤入口页面
	function index(){
		$this->load->library('detect');
		
		$week = $this->getWeek();//得到星期几
		$time = $this->getClass();//得到第几节课
		
		$openid = $_REQUEST['openid'];
		
		$userinfo = $this->attend_model->getInfo($openid);//获得用户资料
		$info = $userinfo[0];
		$data['user_info'] = $info;
// 		$data['time']=date("Y-m-d G:i:s");
		$data['time']="2015-06-09 10:06:28";//测试数据用完请注释
// 		if($time==0){
// 			echo "<script>alert(\"暂时还没有课程哦\");</script>";
// 			return;
// 		}//与下方测试数据会有冲突，下方测试数据取消时，请取消这部分注释
		$week = 2;//测试数据 假定现在是星期二
		$time = 3;//测试数据 假定现在是第三节课
		
		$classInfo = $this->attend_model->getClassInfo($info->user_class,$week,$time);
		
		$class = $classInfo[0];
		$data['lesson_name'] = $class->lesson_name;

		if ($info->user_power==2){//教师
			$this->teacher_index($data,$openid);
			$this->class_locat($class->lesson_name,$openid);
		}elseif ($info->user_power==1){//学生
			$this->student_index($data,$openid);
		}
	}
	
	//学生考勤页面
	function student_index($data,$openid){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		echo $this->cache->get("Latitude$openid").'<br>';
		echo $this->cache->get("Longitude$openid").'<br>';
		$this->load->view('attendent/index',$data);
	}
	
	//将老师的地理位置转换为教室的地理位置
	function class_locat($lesson,$openid){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$lat = $this->cache->get("Latitude$openid");
		$lon = $this->cache->get("Longitude$openid");
		$this->cache->file->save("Latitude$lesson","$lat",600);
		$this->cache->file->save("Longitude$lesson","$lon",600);
	}
	
	//学生提交考勤
	function submitAttendent(){
		$lesson=$_REQUEST['lesson'];
		$time=$_REQUEST['time'];
		$sname=$_REQUEST['sname'];
		$sid=$_REQUEST['sid'];
		$class_name=$_REQUEST['class_name'];
		$openid = $_REQUEST['openid'];
		$time="2015-6-9 11:00:00";//测试数据 测时候请直接删除
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$Class_lat=$this->cache->get("Latitude$lesson");
		$Class_lon=$this->cache->get("Longitude$lesson");
		$stu_lat=$this->cache->get("Latitude$openid");
		$stu_lon=$this->cache->get("Longitude$openid");
		if (!$this->check_attendTime($time, $class_name)){
			echo "nocheck";
			return;
		}
		elseif ($this->getDistance($Class_lat, $Class_lon, $stu_lat, $stu_lon)>300){
			echo "far";
			return;
		}
		$this->notedown_attendent($time, $sid, $sname, $class_name, $lesson);
		echo "success";
	}
	
	//教师考勤界面
	function teacher_index($data,$openid){
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		echo $this->cache->get("Latitude$openid").'<br>';
		echo $this->cache->get("Longitude$openid").'<br>';
		$this->load->view('attendent/tch_atd',$data);
	}
	
	//教师发起考勤
	function startAttendent(){
		$lesson=$_REQUEST['lesson'];
		$time=$_REQUEST['time'];
		$tid=$_REQUEST['tid'];
		$class_name=$_REQUEST['class_name'];
		$this->attend_model->startAttendent($lesson,$time,$tid,$class_name);
	}
	
	//教师结束考勤
	function endAttendent($tid,$time){
		$this->attend_model->stop_attendent($tid,$time);
	}
	
	//教师查看考勤	
	function take_attendent(){
		$time = $_REQUEST['time'];
		$lesson_name = $_REQUEST['lesson'];
		$class_name = $_REQUEST['class_name'];
		$tid=$_REQUEST['tid'];
		$this->endAttendent($tid, $time);
		$data['list']=$this->attend_model->take_attendent($time,$lesson_name,$class_name);
		$data['stu_count'] = $this->attend_model->take_stuNum_to_class($class_name);
		$data['stu_attend_count'] = $this->attend_model->take_stuNum_attend($class_name);
		$this->load->view('attendent/stu_list',$data);
	}
	
	//获取到星期几
	function getWeek(){
		return date('w');
	}
	
	//获取到现在是第几节课
	function getClass(){
		$time = date('Hi');
		if ($time>=830&&$time<920){
			$time = 1;
		}
		if ($time>=920&&$time<1010){
			$time = 2;
		}
		if ($time>=1010&&$time<1100){
			$time = 3;
		}
		if ($time>=1100&&$time<1150){
			$time = 4;
		}
		if ($time>=1330&&$time<1420){
			$time = 5;
		}
		if ($time>=1420&&$time<1510){
			$time = 6;
		}
		if ($time>=1510&&$time<1600){
			$time = 7;
		}
		if ($time>=1600&&$time<1650){
			$time = 8;
		}else{
			$time=0;
		}
		return $time;
	}
	
	//检查现在是否有考勤发起
	function check_attendTime($time,$class_name){
		if($this->attend_model->check_time($time,$class_name)==0){
			return false;
		}
		return true;
	}
	
	//学生提交考勤后记录进数据库
	function notedown_attendent($time,$stu_id,$stu_name,$stu_class,$stu_lesson){
		$this->attend_model->notedown_attendent($time,$stu_id,$stu_name,$stu_class,$stu_lesson);
	}
	
	//测量两点之间的距离经纬度
	function getDistance($lat1, $lng1, $lat2, $lng2)
	{
		$earthRadius = 6367000; //approximate radius of earth in meters
	
		/*
		 Convert these degrees to radians
		 to work with the formula
		 */
	
		$lat1 = ($lat1 * pi() ) / 180;
		$lng1 = ($lng1 * pi() ) / 180;
	
		$lat2 = ($lat2 * pi() ) / 180;
		$lng2 = ($lng2 * pi() ) / 180;
	
		/*
		 Using the
		 Haversine formula
	
		 http://en.wikipedia.org/wiki/Haversine_formula
	
		 calculate the distance
		 */
	
		$calcLongitude = $lng2 - $lng1;
		$calcLatitude = $lat2 - $lat1;
		$stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
		$stepTwo = 2 * asin(min(1, sqrt($stepOne)));
		$calculatedDistance = $earthRadius * $stepTwo;
	
		return round($calculatedDistance);
	}
	
}