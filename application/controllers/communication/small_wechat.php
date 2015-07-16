<?php
error_reporting(E_ALL & ~E_NOTICE);
//require_once("/Users/yonghaohu/mycode/education/application/libraries/ServerAPI.php");
class Small_wechat extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->library('ServerAPI');
        $this->load->library('Base_infor');
        $this->load->model('comm/small_wechat_model');
    }

    public function index() {
        echo "in";
    }

    public function sign_in($user_id)
    {
        $student_info = $this->small_wechat_model->take_user_by_user_user_id($user_id);
        $user_stu_name = $student_info[0]->user_stu_name;
        $user_image = $student_info[0]->user_image;
        $p = new ServerAPI('kj7swf8o7csz2','G1KaP0ZPvEdJk');
        $r = $p->getToken($user_id, $user_stu_name, $user_image);
        $groupName = "ab";
        self::groupJoin($user_id, 1, $groupName);
        $arra = json_decode($r);
        $token = $arra->token;
        $data['token'] = $token;
        $data['user_id'] = $user_id;
        $data['user_stu_name'] = $user_stu_name;
        $data['user_image'] = $user_image;
        $this->load->view ( 'communicate/small_wechat', $data );
    }

    public function groupCreate($user_id, $groupName)
    {
        $p = new ServerAPI('kj7swf8o7csz2','G1KaP0ZPvEdJk');
        $group_Id = 1;
        $r = $p->groupCreate($user_id, $group_Id, $groupName);
    }

    public function groupJoin($user_id, $group_Id, $groupName)
    {
        $p = new ServerAPI('kj7swf8o7csz2','G1KaP0ZPvEdJk');
        $r = $p->groupJoin($user_id, $group_Id, $groupName);
    }
}
