<?php
class Student_main extends CI_Controller {
    function __construct() {
        parent::__construct ();
        $this->load->model('comm/small_wechat_model');
    }

    public function index($open_id) {
        $student_info = $this->small_wechat_model->take_user_by_user_open_id($open_id);
        $user_power = $student_info[0]->user_power;
        $user_stu_name = $student_info[0]->user_stu_name;
        $user_image = $student_info[0]->user_image;
        $data['open_id'] = $open_id;
        $data['user_stu_name'] = $user_stu_name;
        $data['user_image'] = $user_image;
        $data['user_power'] = $user_power;
        $this->load->view ( 'student_main/student_main', $data );
    }

}
