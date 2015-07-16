<?php
class Attend_model extends CI_Model{
	
	function __construct(){
		parent::__construct();
		$this->load->database();	
	}
	
	//获取用户所在班级
	function getInfo($open_id){
		$this->db->where('user_open_id',$open_id);
		$result = $this->db->get('user')->result();
		return $result;
	}
	
	function getClassInfo($className,$week,$time){
		$sql = "SELECT * FROM lesson WHERE `lesson_class` like '$className' AND `lesson_day`='$week' AND `lesson_time`<=$time order by lesson_time desc limit 1";
		return $this->db->query($sql)->result();
	}
	
	function check_time($time,$class_name){
		$sql = "SELECT start_time from `attendent_start` where start_class like '%$class_name%' and start_time<'$time' and start_end=0";
		return $this->db->query($sql)->num_rows();
	}
	
	function notedown_attendent($time,$stu_id,$stu_name,$stu_class,$stu_lesson){
		$par = array(
			'attendent_time'=>$time,
			'attendent_stu_id'=>$stu_id,
			'attendent_stu_name'=>$stu_name,
			'attendent_stu_class'=>$stu_class,
			'attendent_stu_lesson'=>$stu_lesson
		);
		$this->db->insert('stu_attendent',$par);
	}
	
	function take_attendent($time,$lesson_name,$class_name){
		$sql = "SELECT * FROM stu_attendent WHERE attendent_time >= '$time' AND attendent_stu_lesson like '%$lesson_name%' AND attendent_stu_class like '%$class_name%'";
		return $this->db->query($sql)->result();
	}
	
	function startAttendent($lesson,$time,$tid,$class_name){
		$par = array(
			'start_time'=>$time,
			'start_class'=>$class_name,
			'start_lesson'=>$lesson,
			'start_teach_id'=>$tid,
		);
		$this->db->insert('attendent_start',$par);
	}
	
	function take_stuNum_to_class($class){
		$this->db->where('user_class',$class);
		$this->db->where('user_power',1);
		return $this->db->get('user')->num_rows();
	}
	
	function take_stuNum_attend($class_name){
		$this->db->where('attendent_stu_class',$class_name);
		return $this->db->get('stu_attendent')->num_rows();
	}
	
	function stop_attendent($tid,$time){
		$sql = "update attendent_start set start_end='1' where start_teach_id='$tid' and start_time='$time'";
		$this->db->query($sql);
	}
	
	//检测是否有绑定
	public function check_bind($user_openid)
	{
		$this->db->where('user_open_id',$user_openid);
		return $this->db->get('user');
	}
}

?>