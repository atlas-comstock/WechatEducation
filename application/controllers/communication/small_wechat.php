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

    public function student_index($open_id) {
        $student_info = $this->small_wechat_model->take_user_by_user_open_id($open_id);
        $user_id = $student_info[0]->user_id;
        $data['user_id'] = $user_id;
        $this->load->view ( 'communicate/student_index', $data );
    }

    public function create_group($user_id) {
        $data['user_id'] = $user_id;
        $this->load->view ( 'communicate/create_group', $data );
    }

    public function create_group_action($user_id) {
        $data['user_id'] = $user_id;
        $group_name = $_REQUEST ['group_name'];
        self::groupCreate($user_id, $group_name);
    }

    public function show_groups($user_id) {
        $groups = $this->small_wechat_model->get_groups();
        $data['groups'] = $groups;
        $data['user_id'] = $user_id;
        $this->load->view ( 'communicate/student_sign_in', $data );
    }

    public function student_sign_in_action($user_id) {
        $group_id = $_REQUEST ['group_id'];
        $group_name = $this->small_wechat_model->get_group_name($group_id);
        $group_name = $group_name[0]->group_name;
        self::student_sign_in($user_id, $group_id, $group_name);
    }


    public function student_sign_in($user_id, $groupId, $groupName)
    {
        $student_info = $this->small_wechat_model->take_user_by_user_user_id($user_id);
        $user_stu_name = $student_info[0]->user_stu_name;
        $user_image = $student_info[0]->user_image;
        $p = new ServerAPI();
//        $p = new ServerAPI('kj7swf8o7csz2','G1KaP0ZPvEdJk');
        $r = $p->getToken($user_id, $user_stu_name, $user_image);

        self::groupJoin($user_id, $groupId, $groupName);
        $arra = json_decode($r);
        $token = $arra->token;
        $data['token'] = $token;
        $data['user_id'] = $user_id;
        $data['user_stu_name'] = $user_stu_name;
        $data['user_image'] = $user_image;
        $data['groupId'] = $groupId;
        $data['groupName'] = $groupName;
        $this->load->view ( 'communicate/small_wechat', $data );
    }

//    public function delete_group($user_id) {
//        $group_id = $_REQUEST ['group_id'];
//        $group = $this->small_wechat_model->get_group_header_id($group_id);
//        $group_header_id = $group[0]->group_header_id;
//        if($user_id == $group_header_id)
//    }


    public function groupCreate($user_id, $groupName)
    {
        $p = new ServerAPI();
        $group_Id = $this->small_wechat_model->get_group_latest_id();
        $group_Id = $group_Id[0]->group_id+1;
        $r = $p->groupCreate($user_id, $group_Id, $groupName);
        $group_lesson = "English";
        $group_class = "1";
        $group_teach_id = 1;
        $group_number = 1;
        $arr = array (
            'group_lesson' => $group_lesson,
            'group_class' => $group_class,
            'group_teach_id' => $group_teach_id,
            'group_number' => $group_number,
            'group_name' => $groupName,
            'group_header_id' => $user_id,
            'group_from_time' => time()
        );
        $this->small_wechat_model->insert_group( $arr );
        self::show_groups($user_id);
    }

    public function groupJoin($user_id, $group_Id, $groupName)
    {
        $p = new ServerAPI();
        $r = $p->groupJoin($user_id, $group_Id, $groupName);
    }
}
