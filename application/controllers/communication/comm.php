<?php
class Comm extends CI_Controller{

	var $viewplace="communicate";

	function __construct(){
		parent::__construct();
		$this->load->library('detect');
		$this->load->model('comm/comm_model');
	}

	//主页
	function index(){
		$data['hot']=$this->comm_model->load_hot();//热门话题
		$data['list']=$this->comm_model->load_list();//最新话题
		$data['total']=$this->comm_model->get_topic_total();//返给前端的 总共数目
		$this->load->view("$this->viewplace/index",$data);
	}

	//加载话题详细页面的头部话题 信息
	function load_topic(){
		$data['content']=$this->comm_model->get_content();
		$data['reply']=$this->comm_model->get_reply();
		$this->load->view("$this->viewplace/answer",$data);
	}

	//提交评论
	function submit_answer(){
		$reply_from_user_id = $_REQUEST['openid'];
		$reply_content_id = $_REQUEST['quesid'];
		$reply_title = $_REQUEST['topic'];
		$reply_content = $_REQUEST['content'];
		$name = $this->comm_model->get_username($reply_from_user_id);
		$reply_from_user_name = $name[0]->user_stu_name;
		$data = array(
				'reply_from_user_name'=>$reply_from_user_name,
				'reply_date'=>date("Y-m-d G:i:s"),
				'reply_from_user_id'=>$reply_from_user_id,
				'reply_content_id'=>$reply_content_id,
				'reply_title'=>$reply_title,
				'reply_content'=>$reply_content
		);
		$this->comm_model->submit_answer($data);
		echo 'success';
	}
	//点击按钮加载更多话题
	function take_more_topic(){
		$page = $_REQUEST['start'];
		$data['list']=$this->comm_model->load_list($page,5);
		$this->load->view("$this->viewplace/more_topic",$data);
	}
	//点赞
	function mark(){
		$mark_content_type="topic";
		$mark_content_id = $_REQUEST['quesid'];
		$mark_user_id = $_REQUEST['uid'];
		if($this->comm_model->check_mark($mark_content_type,$mark_user_id,$mark_content_id)!=0) {echo '已经点赞'; return;}
		$this->comm_model->mark($mark_content_type,$mark_user_id,$mark_content_id); echo "success";
	}

	//问题提交页面
	function new_ques(){
		$uid = $_REQUEST['openid'];
		$name = $this->comm_model->get_username($uid);
		$user_name = $name[0]->user_stu_name;
		$this->load->view("$this->viewplace/make_question",array('username'=>$user_name));
	}
	//问题提交
	function make_ques(){
		$data = array(
			'topic_title'=>$_POST['topic'],
			'par' => $_POST['par'],
			'child'=>$_POST['child'],
			'topic_content'=>$_POST['content'],
			'topic_date'=>date("Y-m-d G:i:s"),
			'topic_user_id'=>$_POST['openid'],
			'topic_user_name'=>$_POST['username']
		);
		$this->comm_model->make_ques($data);
		echo "<script type=\"text/javascript\">alert('发表成功');</script>";
		$this->new_ques();
	}
	//我的回答页面
	function mykey(){
		$data['list'] = $this->comm_model->load_answer();
		$this->load->view("$this->viewplace/my_answer",$data);
	}
	//我的收藏
	function mycollect(){
		$uid = $_REQUEST['openid'];
		$data['list']=$this->comm_model->get_collect('topic',$uid);
		$this->load->view("$this->viewplace/collect",$data);
	}
	//添加收藏
	function collect(){
		$collect_content_type="topic";
		$collect_content_id = $_REQUEST['quesid'];
		$collect_user_id = $_REQUEST['uid'];
		if($this->comm_model->check_collect($collect_content_type,$collect_user_id,$collect_content_id)!=0) {echo '已经收藏'; return;}
		$this->comm_model->collect($collect_content_type,$collect_user_id,$collect_content_id); echo "收藏完成";
	}
	//搜索 快速定位
	function search(){
		$this->load->view("$this->viewplace/channel");
	}
	//获取搜索结果
	function get_search(){
		$par = $_REQUEST['par'];
		if ($par=='all') $par='';
		$child = $_REQUEST['child'];
		if($child=='all') $child='';
		$keyword = $_REQUEST['keyword'];
		$data['list'] = $this->comm_model->search($par,$child,$keyword);
		$this->load->view("$this->viewplace/get_search",$data);
	}
}
