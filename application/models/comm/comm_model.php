<?php
class Comm_model extends CI_Model{
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function get_topic_total(){
		$this->db->from('topic');
		return $this->db->count_all_results();
	}
	
	function load_list($start=0,$offset=5){
		$this->db->select("*");
		$this->db->from('topic');
		$this->db->join('user','topic.topic_user_id=user.user_open_id');
		$this->db->join('mark_count','topic.topic_id=mark_count.count_content_id');
		$this->db->limit($offset,$start*$offset);
		$this->db->order_by("topic_date","desc");
		return $this->db->get()->result();
	}
	
	function load_hot(){
		$this->db->limit(3,0);
		$this->db->order_by("read_count","desc");
		return $this->db->get('topic')->result();
	}
	
	function get_username($id){
		$this->db->select('user_stu_name');
		$this->db->where('user_open_id',$id);
		return $this->db->get('user')->result();
	}
	
	function get_content(){
		$ques_id = $_REQUEST['quesid'];
		$sql = "UPDATE `topic` SET `read_count`=`read_count`+1 WHERE `topic_id`=$ques_id";
		$this->db->query($sql);
		$this->db->select("*");
		$this->db->from('topic');
		$this->db->join('user','topic.topic_user_id=user.user_open_id');
		$this->db->join('mark_count','topic.topic_id=mark_count.count_content_id');
		$this->db->where('count_type','topic');
		$this->db->where('topic_id',$ques_id);
		return $this->db->get()->result();
	}	
	
	function submit_answer($data){
		$this->db->insert('topic_reply',$data);
	}
	
	function get_reply(){
		$ques_id = $_REQUEST['quesid'];
		$this->db->select("*");
		$this->db->from('topic_reply');
		$this->db->join('user','topic_reply.reply_from_user_id=user.user_open_id');
		$this->db->order_by('reply_date','desc');
		$this->db->where('reply_content_id',$ques_id);
		return $this->db->get()->result();
	}
	
	//点赞
	function check_mark($type,$uid,$cid){
		$this->db->like('count_type',$type);
		$this->db->like('count_content_id',$cid);
		$this->db->from('mark_count');
		$num = $this->db->count_all_results();
		if ($num==0){
			$data = array(
					'count_type'=>$type,
					'count_content_id'=>$cid,
					'count_num'=>1
			);
			$this->db->insert('mark_count',$data);
			return 0;
		}else{
			$data = array(
					'mark_user_id'=>$uid,
					'mark_content_type'=>$type,
					'mark_content_id'=>$cid
			);
			$this->db->where($data);
			return $this->db->get('mark')->num_rows();
		}
		
	}
	
	function get_mark($type,$cid){
		$data = array(
				'count_type'=>$type,
				'count_content_id'=>$cid
		);
		$this->db->where($data);
		return $this->db->get('mark_count')->result();
	}
	
	function mark($type,$uid,$cid){
		$data = array(
				'mark_user_id'=>$uid,
				'mark_content_type'=>$type,
				'mark_content_id'=>$cid
		);
		$this->db->insert('mark',$data);
		$sql = "UPDATE `mark_count` set `count_num` = `count_num`+1 WHERE `count_type`='topic' AND `count_content_id`='$cid' ";
		$this->db->query($sql);
	}
	//点赞over
	
	//收藏代码
	function check_collect($type,$uid,$cid){
			$data = array(
					'collect_user_id'=>$uid,
					'collect_content_type'=>$type,
					'collect_content_id'=>$cid
			);
			$this->db->where($data);
			return $this->db->get('collect')->num_rows();
	}
	
	function get_collect($type,$uid){
		$this->db->distinct();
		$this->db->select("topic.topic_id,topic.topic_title,topic.topic_content,topic.topic_user_name,topic.topic_date");
		$this->db->like("collect_user_id",$uid);
		$this->db->from("collect");
		$this->db->join('topic',"collect.collect_content_id=topic.topic_id");
		return $this->db->get()->result();
	}
	
	function collect($type,$uid,$cid){
		$data = array(
				'collect_user_id'=>$uid,
				'collect_content_type'=>$type,
				'collect_content_id'=>$cid
		);
		$this->db->insert('collect',$data);
	}
	//收藏代码over
	
	function make_ques($data){
		$this->db->insert('topic',$data);
	}
	
	function load_answer($curr=0){
		$uid = $_REQUEST['openid'];
		$this->db->distinct();
		$this->db->select("topic.topic_id,topic.topic_title,topic.topic_content,topic.topic_user_name,topic.topic_date");
		$this->db->like("reply_from_user_id",$uid);
		$this->db->from("topic_reply");
		$this->db->join('topic',"topic_reply.reply_content_id=topic.topic_id");
		$this->db->group_by('topic.topic_id');
		return $this->db->get()->result();
	}
	
	function search($par,$child,$keyword){
		$sql ="SELECT * FROM  `topic` WHERE (par LIKE  '$par' AND child LIKE  '$child'	AND topic_title LIKE  '%$keyword%')	OR (par LIKE  '$par' AND child LIKE  '$child' AND topic_title LIKE  '%$keyword%' AND topic_content LIKE  '%$keyword%')";
// 		$this->db->select("*");
// 		$this->db->like('par',$par);
// 		$this->db->like('child',$child);
// 		$this->db->or_like('topic_title',"%$keyword%");
// 		$this->db->or_like('topic_content',"%$keyword%");
		return $this->db->query($sql)->result(); 
	}
	
}